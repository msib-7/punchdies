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
        // $approval = ApprovalDisposal::with('users')
        //                             ->where('is_draft', '!=', '1')
        //                             ->where('is_approved', '!=', '1')
        //                             ->where('is_rejected', '!=', '1')
        //                             ->get();
        // $dataPunch = Punch::latest()->get();
        // $dataDies = Dies::latest()->get();

        // Get all punches that are not deleted
        $validPunchIds = Punch::where('is_delete_punch', '!=', 1)->pluck('punch_id')->toArray();
        $validDiesIds = Dies::where('is_delete_dies', '!=', 1)->pluck('dies_id')->toArray();

        // Get approvals that have valid punches
        $approval1 = ApprovalDisposal::with('users')
            ->where('is_draft', '!=', '1')
            ->where('is_approved', '!=', '1')
            ->where('is_rejected', '!=', '1')
            ->whereIn('punch_id', $validPunchIds) // Filter by valid punch IDs
            ->orderBy('tgl_submit', 'DESC')
            ->get();
            
            // Get approvals that have valid dies
        $approval2 = ApprovalDisposal::with('users')
            ->where('is_draft', '!=', '1')
            ->where('is_approved', '!=', '1')
            ->where('is_rejected', '!=', '1')
            ->whereIn('dies_id', $validDiesIds) // Filter by valid dies IDs
            ->orderBy('tgl_submit', 'DESC')
            ->get();

        // Merge the two approval collections
        $approval = $approval1->merge($approval2)->sortByDesc('created_at');

        // Get only valid dies
        $dataDies = Dies::where('is_delete_dies', '!=', 1)->get();

        // Get all punches
        $dataPunch = Punch::where('is_delete_punch', '!=', 1)->get(); // Ensure this line is included to define $dataPunch

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
            'Rejected, Disposal',
            'Disposal telah rejected oleh Supervisor ' . auth()->user()->nama,
            route('pnd.request.disposal.show', $data->id)
        ));
        // Buat NOtifikasi Ke Pengirim
        event(new NotificationEvent(
            auth()->user()->id,
            'Success Rejected Disposal',
            'Disposal telah rejected oleh Supervisor ' . auth()->user()->nama,
            route('pnd.approval.dis.show', $data->id)
        ));

        $userEmail = $data->users->email;
        $userName = $data->users->nama; // Array to store user emails
        $failedEmail = []; // Array to store emails that failed to send

        $message = 'Halo, Supervisor telah menolak approval Anda. Silakan periksa kembali data yang telah Anda ajukan dan lakukan perbaikan jika diperlukan.';
        $data = [
            'status' => 'Rejected',
            'link' => route('pnd.request.disposal.show', $data->id),
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
        $data = ApprovalDisposal::find($id);
        $dataUpdate = [
            'is_draft' => '0',
            'is_waiting' => '0',
            'is_approved' => '0',
            'is_rejected' => '0',
            'is_revisi' => '1',
            'by' => auth()->user()->id,
            'at' => now(),
            'approved_note' => $note
        ];
        ApprovalDisposal::updateOrCreate(['id' => $id], $dataUpdate);

        // Buat NOtifikasi Ke Penerima
        event(new NotificationEvent(
            $data->user_id,
            'Revisi, Approval Disposal!',
            'Permintaan Revisi Approval Disposal oleh Supervisor ' . auth()->user()->nama,
            route('pnd.request.disposal.show', $data->id)
        ));
        // Buat NOtifikasi Ke Pengirim
        event(new NotificationEvent(
            auth()->user()->id,
            'Revisi, Approval Disposal Succesfull!',
            'Permintaan Revisi untuk Approval Disposal oleh, ' . auth()->user()->nama,
            route('pnd.approval.dis.show', $data->id)
        ));

        $userEmail = $data->users->email;
        $userName = $data->users->nama; // Array to store user emails
        $failedEmail = []; // Array to store emails that failed to send

        $message = 'Halo, Supervisor telah menolak approval Anda. Silakan periksa kembali data yang telah Anda ajukan dan lakukan perbaikan jika diperlukan.';
        $data = [
            'status' => 'Rejected',
            'link' => route('pnd.request.disposal.show', $data->id),
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
}
