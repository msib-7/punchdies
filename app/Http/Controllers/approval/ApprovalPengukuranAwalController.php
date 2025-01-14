<?php

namespace App\Http\Controllers\approval;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Dies;
use App\Models\ApprovalPengukuran;
use App\Models\PengukuranAwalDies;
use App\Models\PengukuranAwalPunch;
use App\Models\Punch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ApprovalPengukuranAwalController extends Controller
{
    public function index(){
        $approval = ApprovalPengukuran::with('users')->where('masa_pengukuran', 'pengukuran awal')->get();
        $dataPunch = Punch::all();
        $dataDies = Dies::all();

        return view('approval.pengukuranAwal.index', compact('approval', 'dataPunch', 'dataDies'));
    }

    public function show(Request $request, $id){
        
        $data = ApprovalPengukuran::find($id);

        if($data->punch_id != null){   
            $labelIdentitas = Punch::query()
            ->leftJoin('pengukuran_awal_punchs', 'punchs.punch_id', '=', 'pengukuran_awal_punchs.punch_id')
            ->leftJoin('users', 'pengukuran_awal_punchs.user_id', '=', 'users.id')
            ->where('punchs.punch_id', $data->punch_id)
            ->first();
            $dataPengukuran = PengukuranAwalPunch::where('punch_id', $data->punch_id)->get();
            $tglPengukuran = PengukuranAwalPunch::where('punch_id', '=', $data->punch_id)->first();
            $show = 'punch';
        }else{
            $labelIdentitas = Dies::query()
            ->leftJoin('pengukuran_awal_diess', 'diess.dies_id', '=', 'pengukuran_awal_diess.dies_id')
            ->leftJoin('users', 'pengukuran_awal_diess.user_id', '=', 'users.id')
            ->where('diess.dies_id', $data->dies_id)
            ->first();
            $dataPengukuran = PengukuranAwalDies::where('dies_id', $data->dies_id)->get();
            $tglPengukuran = PengukuranAwalDies::where('dies_id', '=', $data->dies_id)->first();
            $show = 'dies';
        }

        $checkStatus = ApprovalPengukuran::where(['req_id' => $data->req_id])->first();
        if ($checkStatus->is_approved == '0' and $checkStatus->is_rejected == '0') {
            $status = '<span class="badge badge-square badge-outline badge-light-warning fs-4">Waiting For Approval</span>';
        } elseif ($checkStatus->is_approved == '1' and $checkStatus->is_rejected == '0') {
            $status = "<span class='badge badge-light-success fs-3'>Approved</span>";
        } elseif($checkStatus->is_approved == '0' and $checkStatus->is_rejected == '1'){
            $status = "<span class='badge badge-light-danger fs-3'>Rejected</span>";
        }

        return view('approval.pengukuranAwal.show', compact('labelIdentitas', 'dataPengukuran', 'tglPengukuran', 'status', 'data', 'show'));
    }

    public function approve($id) {
        $data = ApprovalPengukuran::find($id);
        // dd($data);
        //Set Status to approved
        $updateStatusApproved = [
            'is_draft' => '0',
            'is_waiting' => '0',
            'is_approved' => '1',
            'is_rejected' => '0',
        ];

        //Update status Approved pada table Approval
        $update = [
            'is_approved' => '1',
            'is_rejected' => '0',
            'by' => auth()->user()->nama,
            'at' => date('Y-m-d H:i:s'),
        ];
        ApprovalPengukuran::where('req_id', $data->req_id)->update($update);

        //periksa apakah punch_id kosong/null
        $isNullPunchId = is_null($data->punch_id);

        //periksa apakah dies_id kosong/null
        $isNullDiesId = is_null($data->dies_id);

        if(!$isNullPunchId){ //JIka Tidak Kosong update status approved pada table punch
            Punch::where(['punch_id' => $data->punch_id, 'masa_pengukuran' => $data->masa_pengukuran])->update($updateStatusApproved);
            PengukuranAwalPunch::where('punch_id', $data->punch_id)->update($updateStatusApproved);
        }elseif(!$isNullDiesId){ //JIka Tidak Kosong update status approved pada table diess
            Dies::where(['dies_id' => $data->dies_id, 'masa_pengukuran' => $data->masa_pengukuran])->update($updateStatusApproved);
            PengukuranAwalDies::where('dies_id', $data->dies_id)->update($updateStatusApproved);
        }

        // Buat NOtifikasi Ke Penerima
        event(new NotificationEvent(
            $data->user_id,
            'Approved!, Pengukuran Awal',
            'Pengukuran Awal telah approved oleh Supervisor ' . auth()->user()->nama,
            route('pnd.pa.atas.index')
        ));
        
        return redirect(route('pnd.approval.pa.index'))->with('success', 'Data Approved Successfully! by '.auth()->user()->nama);
    }
    public function reject($id) {
        $data = ApprovalPengukuran::find($id);

        $updateStatusApproved = [
            'is_draft' => '0',
            'is_waiting' => '0',
            'is_approved' => '0',
            'is_rejected' => '1',
        ];

        $update = [
            'is_approved' => '0',
            'is_rejected' => '1',
            'by' => auth()->user()->nama,
            'at' => date('Y-m-d H:i:s'),
        ];
        ApprovalPengukuran::where('req_id', $data->req_id)->update($update);

        //periksa apakah punch_id kosong/null
        $isNullPunchId = is_null($data->punch_id);

        //periksa apakah dies_id kosong/null
        $isNullDiesId = is_null($data->dies_id);

        if (!$isNullPunchId) { //JIka Tidak Kosong update status approved pada table punch
            Punch::where(['punch_id' => $data->punch_id, 'masa_pengukuran' => $data->masa_pengukuran])->update($updateStatusApproved);
            PengukuranAwalPunch::where('punch_id', $data->punch_id)->update($updateStatusApproved);
        } elseif (!$isNullDiesId) { //JIka Tidak Kosong update status approved pada table diess
            Dies::where(['dies_id' => $data->dies_id, 'masa_pengukuran' => $data->masa_pengukuran])->update($updateStatusApproved);
            PengukuranAwalDies::where('dies_id', $data->dies_id)->update($updateStatusApproved);
        }

        // Buat NOtifikasi Ke Penerima
        event(new NotificationEvent(
            $data->user_id,
            'Rejected, Pengukuran Awal',
            'Pengukuran Awal telah rejected oleh Supervisor ' . auth()->user()->nama,
            route('pnd.pa.atas.index')
        ));
        // Buat NOtifikasi Ke Pengirim
        event(new NotificationEvent(
            auth()->user()->id,
            'Success Rejected Pengukuran Awal',
            'Pengukuran Awal telah rejected oleh Supervisor ' . auth()->user()->nama,
            route('pnd.approval.pa.show', $data->id)
        ));

        $userEmail = $data->users->email; 
        $userName = $data->users->nama; // Array to store user emails
        $failedEmail = []; // Array to store emails that failed to send

        $message = 'Halo, Supervisor telah menolak approval Anda. Silakan periksa kembali data yang telah Anda ajukan dan lakukan perbaikan jika diperlukan.';
        $data = [
            'status' => 'Rejected',
            'link' => route('pnd.pa.atas.index'),
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
        
        return redirect(route('pnd.approval.pa.index'))->with('success', 'Data Rejected! by '.auth()->user()->nama);
    }
}
