<?php

namespace App\Http\Controllers\approval;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Dies;
use App\Models\ApprovalDisposal;
use App\Models\Punch;
use Illuminate\Http\Request;
use Log;
use Mail;

class ApprovalDisposalController extends Controller
{
    public function index() {
        $approval = ApprovalDisposal::with('users')
                                    ->where('is_draft', '!=', '1')
                                    ->where('is_approved', '!=', '1')
                                    ->where('is_rejected', '!=', '1')
                                    ->get();
        $dataPunch = Punch::latest()->get();
        $dataDies = Dies::latest()->get();

        return view('approval.disposal.index', compact('approval', 'dataPunch', 'dataDies'));
    }

    public function show(Request $request, $id) {
        $dataApproval = ApprovalDisposal::find($id);

        if($dataApproval->punch_id != null || $dataApproval->punch_id != '-'){
            $data = Punch::where('punch_id', $dataApproval->punch_id)->latest()->first();
        }else{
            $data = Dies::where('dies_id', $dataApproval->dies_id)->latest()->first();
        }

        return view('approval.disposal.show', compact('dataApproval', 'data'));
    }

    // public function setStatus($id){
    //     $status = request('status');
    //     $note = request('note');

    //     if($status == 'approve'){
    //         $this->approve(request(),$id);
    //     }elseif($status == 'reject'){
    //         $this->reject(request(),$id);
    //     }elseif($status == 'revisi'){
    //         $this->revisi(request(), $note, $id);
    //     }

    //     return redirect()->route('pnd.approval.dis.index')->with('success', 'Approval has been successfully done!');
    // }

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

    public function reject(Request $request,$id) {
        $pass = $request->pass;
        if ($request->ajax()) {
            if ($pass == 'true') {
                $this->rejected_update($id);
            }
            return response()->json([
                'message' => 'Data Successfully Rejected by, ',
                'by' => auth()->user()->nama
            ]);
        } else {
            return redirect()->back()->with('error', 'You are not authorized to approve this request.');
        }
    }

    public function revisi(Request $request, $id) {
        $pass = $request->pass;
        $note = $request->note;
        if ($request->ajax()) {
            if ($pass == 'true') {
                $this->revisi_update($note,$id);
            }
            return response()->json([
                'message' => 'Data Status Set to Revisi by, ',
                'by' => auth()->user()->nama
            ]);
        } else {
            return redirect()->back()->with('error', 'You are not authorized to approve this request.');
        }
    }

    public function approved_update($id){
        $dataUpdate = [
            'is_draft' => '0',
            'is_waiting' => '0',
            'is_approved' => '1',
            'is_rejected' => '0',
            'is_revisi' => '0',
            'by' => auth()->user()->id,
            'at' => now(),
            'approved_note' => '-'
        ];
        ApprovalDisposal::updateOrCreate(['id' => $id], $dataUpdate);
    }

    public function rejected_update($id){
        $data = ApprovalDisposal::find($id);
        $dataUpdate = [
            'is_draft' => '0',
            'is_waiting' => '0',
            'is_approved' => '0',
            'is_rejected' => '1',
            'is_revisi' => '0',
            'by' => auth()->user()->id,
            'at' => now(),
            'approved_note' => '-'
        ];
        ApprovalDisposal::updateOrCreate(['id' => $id], $dataUpdate);

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
    }

    public function revisi_update($note, $id){
        if ($note == null || $note == '') {
            $note = '-';
        }
        $data = [
            'is_draft' => '0',
            'is_waiting' => '0',
            'is_approved' => '0',
            'is_rejected' => '0',
            'is_revisi' => '1',
            'by' => auth()->user()->id,
            'at' => now(),
            'approved_note' => $note
        ];
        ApprovalDisposal::updateOrCreate(['id' => $id], $data);
    }
}
