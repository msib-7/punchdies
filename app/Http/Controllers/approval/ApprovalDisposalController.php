<?php

namespace App\Http\Controllers\approval;

use App\Http\Controllers\Controller;
use App\Models\M_ApprDisposal;
use Illuminate\Http\Request;

class ApprovalDisposalController extends Controller
{
    public function index() {
        $approval = M_ApprDisposal::with('users')->where('masa_pengukuran', 'pengukuran awal')->get();
        $dataPunch = Punch::all();
        $dataDies = Dies::all();

        return view('approval.pengukuranAwal.index', compact('approval', 'dataPunch', 'dataDies'));
    }
}
