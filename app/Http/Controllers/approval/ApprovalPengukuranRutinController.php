<?php

namespace App\Http\Controllers\approval;

use App\Http\Controllers\Controller;
use App\Models\Dies;
use App\Models\M_ApprPengukuran;
use App\Models\PengukuranAwalPunch;
use App\Models\PengukuranRutinDies;
use App\Models\PengukuranRutinPunch;
use App\Models\Punch;
use DB;
use Illuminate\Http\Request;
use Log;

class ApprovalPengukuranRutinController extends Controller
{
    public function index(){
        $approval = M_ApprPengukuran::with('users')->where('masa_pengukuran', '!=','pengukuran awal')->get();
        $dataPunch = Punch::all();
        $dataDies = Dies::all();

        return view('approval.pengukuranRutin.index', compact('approval', 'dataPunch', 'dataDies'));
    }

    public function show(Request $request, $id){
        $data = M_ApprPengukuran::find($id);

        if ($data->punch_id !== null) {
            $query = Punch::query()
                ->leftJoin('pengukuran_rutin_punchs', 'punchs.punch_id', '=', 'pengukuran_rutin_punchs.punch_id')
                ->leftJoin('users', 'pengukuran_rutin_punchs.user_id', '=', 'users.id')
                ->where('pengukuran_rutin_punchs.masa_pengukuran', $data->masa_pengukuran)
                ->where('punchs.punch_id', $data->punch_id);

            $labelIdentitas = $query->first();
            $dataPengukuran = PengukuranRutinPunch::where('punch_id', $data->punch_id)
                ->where('masa_pengukuran', $data->masa_pengukuran)
                ->get();
            $tglPengukuran = PengukuranRutinPunch::where('punch_id', $data->punch_id)->first();
        } else {
            $query = Punch::query()
                ->leftJoin('pengukuran_rutin_diess', 'diess.dies_id', '=', 'pengukuran_rutin_diess.dies_id')
                ->leftJoin('users', 'pengukuran_rutin_diess.user_id', '=', 'users.id')
                ->where('pengukuran_rutin_diess.masa_pengukuran', $data->masa_pengukuran)
                ->where('diess.dies_id', $data->dies_id);

            $labelIdentitas = $query->first();
            $dataPengukuran = PengukuranRutinDies::where('dies_id', $data->dies_id)
                ->where('masa_pengukuran', $data->masa_pengukuran)
                ->get();
            $tglPengukuran = PengukuranRutinDies::where('dies_id', $data->dies_id)->first();
        }

        $checkStatus = M_ApprPengukuran::where('req_id', $data->req_id)->first();
        $status = match (true) {
            $checkStatus->is_approved === '-' && $checkStatus->is_rejected === '-' => '<span class="badge badge-square badge-outline badge-light-warning fs-4">Waiting For Approval</span>',
            $checkStatus->is_approved === '1' && $checkStatus->is_rejected === '0' => "<span class='badge badge-light-success fs-3'>Approved</span>",
            default => ''
        };

        return view('approval.pengukuranRutin.show', compact('labelIdentitas', 'dataPengukuran', 'tglPengukuran', 'status', 'data'));
    }

    public function approve($id) {
        $data = M_ApprPengukuran::find($id);

        try {
            DB::beginTransaction();
            $update = [
                'is_approved' => '1',
                'is_rejected' => '0',
                'approved_by' => auth()->user()->nama,
                'approved_at' => date('Y-m-d H:i:s'),
            ];
            // M_ApprPengukuran::where('req_id', $data->req_id)->update($update);
            M_ApprPengukuran::updateOrCreate(['req_id' => $data->req_id], $update);

            $updateStatusApproved = [
                'is_approved' => '1',
                'is_rejected' => '0',
            ];
            // Punch::where(['punch_id' => $data->punch_id, 'masa_pengukuran' => $data->masa_pengukuran])->update($updateStatusApproved);
            // PengukuranRutinPunch::where('punch_id', $data->punch_id)->update($updateStatusApproved);
            Punch::updateOrCreate(['punch_id' => $data->punch_id, 'masa_pengukuran' => $data->masa_pengukuran], $updateStatusApproved);
            PengukuranRutinPunch::updateOrCreate(['punch_id' => $data->punch_id], $updateStatusApproved);

            DB::commit();

            return redirect(route('pnd.approval.pr.index'))->with('success', 'Data Approved Successfully! by '.auth()->user()->nama);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error Approving Data : ' . $th->getMessage());
            return redirect(route('pnd.approval.pr.index'))->with('error', 'Error Approving Data!');
        }

    }
}