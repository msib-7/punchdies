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
        $approval = M_ApprDisposal::with('users')->get();
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
}
