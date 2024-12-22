<?php

namespace App\Http\Controllers\approval;

use App\Http\Controllers\Controller;
use App\Models\Dies;
use App\Models\M_ApprDisposal;
use App\Models\Punch;
use Illuminate\Http\Request;

class ApprovalDisposalController extends Controller
{
    public function index() {
        $approval = M_ApprDisposal::with('users')->where('is_draft', '!=', '1')->get();
        $dataPunch = Punch::latest()->get();
        $dataDies = Dies::latest()->get();

        return view('approval.disposal.index', compact('approval', 'dataPunch', 'dataDies'));
    }

    public function show(Request $request, $id) {
        $dataApproval = M_ApprDisposal::find($id);

        if($dataApproval->punch_id != null || $dataApproval->punch_id != '-'){
            $data = Punch::where('punch_id', $dataApproval->punch_id)->latest()->first();
        }else{
            $data = Dies::where('dies_id', $dataApproval->dies_id)->latest()->first();
        }

        return view('approval.disposal.show', compact('dataApproval', 'data'));
    }

    public function setStatus($id){
        $status = request('status');
        $note = request('note');

        if($status == 'approve'){
            $this->approve($id);
        }elseif($status == 'reject'){
            $this->reject($id);
        }elseif($status == 'revisi'){
            $this->revisi($note, $id);
        }

        return redirect()->route('pnd.approval.dis.index')->with('success', 'Approval has been successfully done!');
    }

    private function approve($id) {
        $data = [
            'is_draft' => '0',
            'is_waiting' => '0',
            'is_approved' => '1',
            'is_rejected' => '0',
            'is_revisi' => '0',
            'by' => auth()->user()->id,
            'at' => now(),
            'approved_note' => '-'
        ];
        M_ApprDisposal::updateOrCreate(['id' => $id], $data);
    }

    private function reject($id) {
        $data = [
            'is_draft' => '0',
            'is_waiting' => '0',
            'is_approved' => '0',
            'is_rejected' => '1',
            'is_revisi' => '0',
            'by' => auth()->user()->id,
            'at' => now(),
            'approved_note' => '-'
        ];
        M_ApprDisposal::updateOrCreate(['id' => $id], $data);
    }

    private function revisi($note, $id) {
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
        M_ApprDisposal::updateOrCreate(['id' => $id], $data);
    }
}
