<?php

namespace App\Http\Controllers;

use App\Models\Audit_tr;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function audit_trail_guest()
    {
        $dataAudit = Audit_tr::leftJoin('users', 'audit_tr.user_id','=','users.id')->orderBy('logdate','desc')->get();
        $data['dataAudit'] = $dataAudit;
        // dd($data);
        return view("audit/audit_guest", $data);
    }
}
