<?php

namespace App\Http\Controllers\approval;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Dies;
use App\Models\ApprovalPengukuran;
use App\Models\PengukuranAwalPunch;
use App\Models\PengukuranRutinDies;
use App\Models\PengukuranRutinPunch;
use App\Models\Punch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class ApprovalPengukuranRutinController extends Controller
{
    public function index(){
        $approval = ApprovalPengukuran::with('users')
                                        ->where('masa_pengukuran', '!=','pengukuran awal')
                                        ->where('is_approved', '!=', '1')
                                        ->where('is_rejected', '!=', '1')
                                        ->get();
        $dataPunch = Punch::all();
        $dataDies = Dies::all();

        return view('approval.pengukuranRutin.index', compact('approval', 'dataPunch', 'dataDies'));
    }

    public function show(Request $request, $id){
        $data = ApprovalPengukuran::find($id);

        $checkStatus = ApprovalPengukuran::where('req_id', $data->req_id)->first();
        $status = match (true) {
            $checkStatus->is_approved === '-' && $checkStatus->is_rejected === '-' => '<span class="badge badge-square badge-outline badge-light-warning fs-4">Waiting For Approval</span>',
            $checkStatus->is_approved === '1' && $checkStatus->is_rejected === '0' => "<span class='badge badge-light-success fs-3'>Approved</span>",
            default => ''
        };

        if ($data->punch_id !== null) {
            $query = Punch::query()
                ->leftJoin('pengukuran_rutin_punchs', 'punchs.punch_id', '=', 'pengukuran_rutin_punchs.punch_id')
                ->leftJoin('users', 'pengukuran_rutin_punchs.user_id', '=', 'users.id')
                ->where('pengukuran_rutin_punchs.masa_pengukuran', $data->masa_pengukuran)
                ->where('punchs.punch_id', $data->punch_id);

            $labelIdentitas = $query->orderBy('punchs.created_at', 'desc')->first();
            $dataPengukuran = PengukuranRutinPunch::where('punch_id', $data->punch_id)
                ->where('masa_pengukuran', $data->masa_pengukuran)
                ->get();
            $tglPengukuran = PengukuranRutinPunch::where('punch_id', $data->punch_id)->first();

            return view('approval.pengukuranRutin.punch.show', compact('labelIdentitas', 'dataPengukuran', 'tglPengukuran', 'status', 'data'));
        } else {
            $query = Dies::query()
            ->leftJoin('pengukuran_rutin_diess', 'diess.dies_id', '=', 'pengukuran_rutin_diess.dies_id')
            ->leftJoin('users', 'pengukuran_rutin_diess.user_id', '=', 'users.id')
            ->where('pengukuran_rutin_diess.masa_pengukuran', $data->masa_pengukuran)
            ->where('diess.dies_id', $data->dies_id);
            
            $labelIdentitas = $query->orderBy('diess.created_at', 'desc')->first();
            $dataPengukuran = PengukuranRutinDies::where('dies_id', $data->dies_id)
            ->where('masa_pengukuran', $data->masa_pengukuran)
            ->get();
            $tglPengukuran = PengukuranRutinDies::where('dies_id', $data->dies_id)->first();
            return view('approval.pengukuranRutin.dies.show', compact('labelIdentitas', 'dataPengukuran', 'tglPengukuran', 'status', 'data'));
        }

    }

    public function approve(Request $request, $id) {

        $pass = $request->pass;
        if ($request->ajax()) {
            if ($pass == 'true') {
                $this->approved_update($id);
            }
            return response()->json([
                'message' => 'Data Successfully Approved by, ',
                'by' => auth()->user()->nama
            ]);
        } else {
            return redirect()->back()->with('error', 'You are not authorized to approve this request.');
        }

    }
    public function reject(Request $request, $id)
    {
        $pass = $request->pass;
        if ($request->ajax()) {
            if ($pass == 'true') {
                $this->rejected_update($id);
            }
            return response()->json([
                'message' => 'Data Successfully Rejeected by, ',
                'by' => auth()->user()->nama
            ]);
        } else {
            return redirect()->back()->with('error', 'You are not authorized to reject this request.');
        }
    }

    private function approved_update($id)
    {
        $data = ApprovalPengukuran::find($id);

        try {
            DB::beginTransaction();
            $update = [
                'is_approved' => '1',
                'is_rejected' => '0',
                'by' => auth()->user()->nama,
                'at' => date('Y-m-d H:i:s'),
            ];
            // ApprovalPengukuran::where('req_id', $data->req_id)->update($update);
            ApprovalPengukuran::updateOrCreate(['req_id' => $data->req_id], $update);

            $updateStatusApproved = [
                'is_draft' => '0',
                'is_waiting' => '0',
                'is_approved' => '1',
                'is_rejected' => '0',
            ];
            //periksa apakah punch_id kosong/null
            $isNullPunchId = is_null($data->punch_id);

            //periksa apakah dies_id kosong/null
            $isNullDiesId = is_null($data->dies_id);

            if (!$isNullPunchId) { //JIka Tidak Kosong update status approved pada table punch
                Punch::where(['punch_id' => $data->punch_id, 'masa_pengukuran' => $data->masa_pengukuran])->update($updateStatusApproved);
                PengukuranRutinPunch::where('punch_id', $data->punch_id)->update($updateStatusApproved);
            } elseif (!$isNullDiesId) { //JIka Tidak Kosong update status approved pada table diess
                Dies::where(['dies_id' => $data->dies_id, 'masa_pengukuran' => $data->masa_pengukuran])->update($updateStatusApproved);
                PengukuranRutinDies::where('dies_id', $data->dies_id)->update($updateStatusApproved);
            }

            // Buat NOtifikasi Ke Penerima
            event(new NotificationEvent(
                $data->user_id,
                'Approved!, Pengukuran Rutin',
                'Pengukuran Rutin telah approved oleh Supervisor ' . auth()->user()->nama,
                route('pnd.pr.atas.index')
            ));

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error Approving Data : ' . $th->getMessage());

            return response()->json([
                'message' => 'Error Approving Data!',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    private function rejected_update($id)
    {

        $data = ApprovalPengukuran::find($id);

        try {
            DB::beginTransaction();
            $update = [
                'is_approved' => '0',
                'is_rejected' => '1',
                'by' => auth()->user()->nama,
                'at' => date('Y-m-d H:i:s'),
            ];
            // ApprovalPengukuran::where('req_id', $data->req_id)->update($update);
            ApprovalPengukuran::updateOrCreate(['req_id' => $data->req_id], $update);

            $updateStatusApproved = [
                'is_draft' => '0',
                'is_waiting' => '0',
                'is_approved' => '0',
                'is_rejected' => '1',
            ];
            $isNullPunchId = is_null($data->punch_id);

            //periksa apakah dies_id kosong/null
            $isNullDiesId = is_null($data->dies_id);

            if (!$isNullPunchId) { //JIka Tidak Kosong update status approved pada table punch
                Punch::where(['punch_id' => $data->punch_id, 'masa_pengukuran' => $data->masa_pengukuran])->update($updateStatusApproved);
                PengukuranRutinPunch::where('punch_id', $data->punch_id)->update($updateStatusApproved);
            } elseif (!$isNullDiesId) { //JIka Tidak Kosong update status approved pada table diess
                Dies::where(['dies_id' => $data->dies_id, 'masa_pengukuran' => $data->masa_pengukuran])->update($updateStatusApproved);
                PengukuranRutinDies::where('dies_id', $data->dies_id)->update($updateStatusApproved);
            }

            // Buat NOtifikasi Ke Penerima
            event(new NotificationEvent(
                $data->user_id,
                'Rejected, Pengukuran Rutin',
                'Pengukuran Rutin telah rejected oleh Supervisor ' . auth()->user()->nama,
                route('pnd.pr.atas.index')
            ));
            // Buat NOtifikasi Ke Pengirim
            event(new NotificationEvent(
                auth()->user()->id,
                'Success Rejected Pengukuran Rutin',
                'Pengukuran Rutin telah rejected oleh Supervisor ' . auth()->user()->nama,
                route('pnd.approval.pr.index')
            ));

            $userEmail = $data->users->email;
            $userName = $data->users->nama; // Array to store user emails
            $failedEmail = []; // Array to store emails that failed to send

            $message = 'Halo, Supervisor telah menolak approval Anda. Silakan periksa kembali data yang telah Anda ajukan dan lakukan perbaikan jika diperlukan.';
            $data = [
                'status' => 'Rejected',
                'link' => route('pnd.pr.atas.index'),
                'penerima' => $userName,
                'body' => $message
            ];

            try {
                // // Attempt to send notification to the user
                Mail::to($userEmail)->send(new \App\Mail\SendApproval($data));
            } catch (\Exception $e) {
                // Log the error message
                Log::error('Failed to send email to ' . $userEmail . ': ' . $e->getMessage());

                // Optionally, store the failed email for further processing or reporting
                $failedEmails[] = $userEmail;
            }

            // Optionally, log the successful emails sent
            Log::info('Emails sent to: ', [$userEmail]);

            // Optionally, log the failed emails
            if (!empty($failedEmails)) {
                Log::warning('Failed to send email to: ', $failedEmail);
            }

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error Approving Data : ' . $th->getMessage());

            return response()->json([
                'message' => 'Error Rejeected Data!',
                'error' => $th->getMessage()
            ], 500);
        }

    }
}