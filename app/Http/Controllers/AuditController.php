<?php

namespace App\Http\Controllers;

use App\Models\Audit_tr;
use Illuminate\Http\Request;
use Route;

class AuditController extends Controller
{
    public function audit_trail_guest(Request $request)
    {
        $dataAudit = Audit_tr::orderBy('created_at','desc')->get();
        $data['dataAudit'] = $dataAudit;
        // dd($dataAudit->new_data['masa_pengukuran']);
        // return response()->json([

        // ]);
        // dd($data);
        return view("audit/audit_guest", $data);
    }
}
