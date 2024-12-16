<?php

namespace App\Http\Controllers\approval;

use App\Http\Controllers\Controller;
use App\Models\Dies;
use App\Models\M_ApprPengukuran;
use App\Models\PengukuranAwalDies;
use App\Models\PengukuranAwalPunch;
use App\Models\Punch;
use Illuminate\Http\Request;

class ApprovalPengukuranAwalController extends Controller
{
    public function index(){
        $approval = M_ApprPengukuran::with('users')->where('masa_pengukuran', 'pengukuran awal')->get();
        $dataPunch = Punch::all();
        $dataDies = Dies::all();

        return view('approval.pengukuranAwal.index', compact('approval', 'dataPunch', 'dataDies'));
    }

    public function show(Request $request, $id){
        
        $data = M_ApprPengukuran::find($id);

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

        $checkStatus = M_ApprPengukuran::where(['req_id' => $data->req_id])->first();
        if ($checkStatus->is_approved == '-' and $checkStatus->is_rejected == '-') {
            $status = '<span class="badge badge-square badge-outline badge-light-warning fs-4">Waiting For Approval</span>';
        } elseif ($checkStatus->is_approved == '1' and $checkStatus->is_rejected == '0') {
            $status = "<span class='badge badge-light-success fs-3'>Approved</span>";
        }

        return view('approval.pengukuranAwal.show', compact('labelIdentitas', 'dataPengukuran', 'tglPengukuran', 'status', 'data', 'show'));
    }

    public function approve($id) {
        $data = M_ApprPengukuran::find($id);

        $update = [
            'is_approved' => '1',
            'is_rejected' => '0',
            'by' => auth()->user()->nama,
            'at' => date('Y-m-d H:i:s'),
        ];
        M_ApprPengukuran::where('req_id', $data->req_id)->update($update);

        $updateStatusApproved = [
            'is_approved' => '1',
            'is_rejected' => '0',
        ];
        Punch::where(['punch_id' => $data->punch_id, 'masa_pengukuran' => $data->masa_pengukuran])->update($updateStatusApproved);
        PengukuranAwalPunch::where('punch_id', $data->punch_id)->update($updateStatusApproved);
        
        return redirect(route('pnd.approval.pa.index'))->with('success', 'Data Approved Successfully! by '.auth()->user()->nama);
    }
    public function reject($id) {
        $data = M_ApprPengukuran::find($id);

        $update = [
            'is_approved' => '0',
            'is_rejected' => '1',
            'by' => auth()->user()->nama,
            'at' => date('Y-m-d H:i:s'),
        ];
        M_ApprPengukuran::where('req_id', $data->req_id)->update($update);

        $updateStatusApproved = [
            'is_approved' => '0',
            'is_rejected' => '1',
        ];
        Punch::where(['punch_id' => $data->punch_id, 'masa_pengukuran' => $data->masa_pengukuran])->update($updateStatusApproved);
        PengukuranAwalPunch::where('punch_id', $data->punch_id)->update($updateStatusApproved);
        
        return redirect(route('pnd.approval.pa.index'))->with('success', 'Data Rejected! by '.auth()->user()->nama);
    }
}
