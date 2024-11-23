<?php

namespace App\Http\Controllers\approval;

use App\Http\Controllers\Controller;
use App\Models\M_ApprDisposal;
use App\Models\M_ApprPengukuran;
use App\Models\M_Dies;
use App\Models\M_Pengukuran_Dies;
use App\Models\M_Pengukuran_Punch;
use App\Models\M_Punch;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function dashboard_approval(Request $request)
    {
        $showApproval = $request->segment(3);

        if($showApproval == 'pengukuran'){
            $dataApproval = M_ApprPengukuran::all();
            $data['dataApproval'] = $dataApproval;
        }elseif($showApproval == 'disposal'){
            $dataApproval = M_ApprDisposal::all();
            $data['dataApproval'] = $dataApproval;
        }
    }
    public function show_data_approval(Request $request)
    {
        $showApproval = $request->segment(3);

        if ($showApproval == 'pengukuran') {
            $dataApproval = M_ApprPengukuran::leftJoin('users', 'tbl_approval_pengukuran.user_id', '=', 'users.id')
                                            ->leftJoin('tbl_line', 'users.line_id', '=', 'tbl_line.id')
                                            ->get();
            $dataPunch = M_Punch::where('is_delete_punch','0')->get();
            $dataDies = M_Dies::where('is_delete_dies','0')->get();

            $data['dataApproval'] = $dataApproval;
            $data['dataPunch'] = $dataPunch;
            $data['dataDies'] = $dataDies;
            $data['jenis'] = $showApproval;
            
            return view('qa.data.approval', $data);
            
        } elseif ($showApproval == 'disposal') {
            $dataApproval = M_ApprDisposal::leftJoin('users', 'tbl_approval_disposal.user_id', '=', 'users.id')
                ->leftJoin('tbl_line', 'users.line_id', '=', 'tbl_line.id')
                ->get();
            $dataPunch = M_Punch::where('is_delete_punch', '0')->get();
            $dataDies = M_Dies::where('is_delete_dies', '0')->get();

            $data['dataApproval'] = $dataApproval;
            $data['dataPunch'] = $dataPunch;
            $data['dataDies'] = $dataDies;
            $data['jenis'] = $showApproval;

            return view('qa.data.approval', $data);
        }
    }
    public function show_history(Request $request)
    {
        $dataApprPengukuran = M_ApprPengukuran::leftJoin('users', 'tbl_approval_pengukuran.user_id', '=', 'users.id')
            ->leftJoin('tbl_line', 'users.line_id', '=', 'tbl_line.id')
            ->where('is_approved','!=', '-')
            ->where('is_rejected','!=', '-')
            ->orderBy('req_id', 'desc')
            ->get();
        $dataApprDisposal = M_ApprDisposal::leftJoin('users', 'tbl_approval_disposal.user_id', '=', 'users.id')
            ->leftJoin('tbl_line', 'users.line_id', '=', 'tbl_line.id')
            ->where('is_approved','!=', '-')
            ->where('is_rejected','!=', '-')
            ->orderBy('req_id', 'desc')
            ->get();
        $dataPunch = M_Punch::where('is_delete_punch', '0')->get();
        $dataDies = M_Dies::where('is_delete_dies', '0')->get();

        $data['dataApprPengukuran'] = $dataApprPengukuran;
        $data['dataApprDisposal'] = $dataApprDisposal;
        $data['dataPunch'] = $dataPunch;
        $data['dataDies'] = $dataDies;

        return view('qa.data.history', $data);

    }

    public function detail_data_approval($req_id)
    {
        $dataRequest = M_ApprPengukuran::where('req_id', $req_id)->first();
        $data['segment'] = 'approval';

        if($dataRequest->punch_id != null){
            $id = $dataRequest->punch_id;
            $labelIdentitas = M_Punch::leftJoin('tbl_pengukuran_punch', 'tbl_punch.id', '=', 'tbl_pengukuran_punch.punch_id')
                                ->leftJoin('users', 'tbl_pengukuran_punch.user_id', '=', 'users.id')
                                ->where('tbl_punch.id', $id)->first();
            $dataPengukuran = M_Pengukuran_Punch::where('punch_id', $id)->get();
            $tglPengukuran = M_Pengukuran_Punch::where('punch_id', '=', $id)->first();

            $checkStatus = M_ApprPengukuran::where(['req_id' => $req_id])->first();
            if ($checkStatus->is_approved == '-' and $checkStatus->is_rejected == '-') {
                $status = '<span class="badge badge-square badge-outline badge-light-warning fs-4">Waiting For Approval</span>';
            } elseif ($checkStatus->is_approved == '1' and $checkStatus->is_rejected == '0') {
                $status = "<span class='badge badge-light-success fs-3'>Approved</span>";
            } elseif ($checkStatus->is_approved == '0' and $checkStatus->is_rejected == '1') {
                $status = "<span class='badge badge-light-danger fs-3'>Rejected</span>";
            }
            
            $data['labelIdentitas'] = $labelIdentitas;
            $data['dataPengukuran'] = $dataPengukuran;
            $data['tglPengukuran'] = $tglPengukuran;
            $data['statusPengukuran'] = $status;
            $data['req_id'] = $req_id;
            $data['jenis'] = 'punch';

            return view('qa.form.detail-pengukuran', $data);
        }elseif($dataRequest->dies_id != null){
            $id = $dataRequest->dies_id;
            $labelIdentitas = M_Dies::leftJoin('tbl_pengukuran_dies', 'tbl_dies.id', '=', 'tbl_pengukuran_dies.dies_id')
                ->leftJoin('users', 'tbl_pengukuran_dies.user_id', '=', 'users.id')
                ->where('tbl_dies.id', $id)->first();
            $dataPengukuran = M_Pengukuran_Dies::where('dies_id', $id)->get();
            $tglPengukuran = M_Pengukuran_Dies::where('dies_id', '=', $id)->first();

            $checkStatus = M_ApprPengukuran::where(['req_id' => $req_id])->first();
            if ($checkStatus->is_approved == '-' and $checkStatus->is_rejected == '-') {
                $status = '<span class="badge badge-square badge-outline badge-light-warning fs-4">Waiting For Approval</span>';
            } elseif ($checkStatus->is_approved == '1' and $checkStatus->is_rejected == '0') {
                $status = "<span class='badge badge-light-success fs-3'>Approved</span>";
            } elseif ($checkStatus->is_approved == '0' and $checkStatus->is_rejected == '1') {
                $status = "<span class='badge badge-light-danger fs-3'>Rejected</span>";
            }

            $data['labelIdentitas'] = $labelIdentitas;
            $data['dataPengukuran'] = $dataPengukuran;
            $data['tglPengukuran'] = $tglPengukuran;
            $data['statusPengukuran'] = $status;
            $data['req_id'] = $req_id;
            $data['jenis'] = 'dies';

            return view('qa.form.detail-pengukuran', $data);
        }
    }

    public function detail_data_history(Request $request, $req_id)
    {
        $getHistory = $request->segment(4);

        if($getHistory == 'pengukuran'){
            $dataRequest = M_ApprPengukuran::where('req_id', $req_id)->first();
            $data['segment'] = 'history';

            if ($dataRequest->punch_id != null) {
                $id = $dataRequest->punch_id;
                $labelIdentitas = M_Punch::leftJoin('tbl_pengukuran_punch', 'tbl_punch.id', '=', 'tbl_pengukuran_punch.punch_id')
                    ->leftJoin('users', 'tbl_pengukuran_punch.user_id', '=', 'users.id')
                    ->where('tbl_punch.id', $id)->first();
                $dataPengukuran = M_Pengukuran_Punch::where('punch_id', $id)->get();
                $tglPengukuran = M_Pengukuran_Punch::where('punch_id', '=', $id)->first();

                $checkStatus = M_ApprPengukuran::where(['req_id' => $req_id])->first();
                if ($checkStatus->is_approved == '-' and $checkStatus->is_rejected == '-') {
                    $status = '<span class="badge badge-square badge-outline badge-light-warning fs-4">Waiting For Approval</span>';
                } elseif ($checkStatus->is_approved == '1' and $checkStatus->is_rejected == '0') {
                    $status = '<button class="btn btn-lg btn-outline btn-outline-success btn-active-light-success fs-2">Approved</button>';
                } elseif ($checkStatus->is_approved == '0' and $checkStatus->is_rejected == '1') {
                    $status = '<button class="btn btn-lg btn-outline btn-outline-danger btn-active-light-danger fs-2">Rejected</button>';
                }

                $data['labelIdentitas'] = $labelIdentitas;
                $data['dataPengukuran'] = $dataPengukuran;
                $data['tglPengukuran'] = $tglPengukuran;
                $data['statusPengukuran'] = $status;
                $data['req_id'] = $req_id;
                $data['jenis'] = 'punch';

                return view('qa.form.detail-pengukuran', $data);
            } elseif ($dataRequest->dies_id != null) {
                $id = $dataRequest->dies_id;
                $labelIdentitas = M_Dies::leftJoin('tbl_pengukuran_dies', 'tbl_dies.id', '=', 'tbl_pengukuran_dies.dies_id')
                    ->leftJoin('users', 'tbl_pengukuran_dies.user_id', '=', 'users.id')
                    ->where('tbl_dies.id', $id)->first();
                $dataPengukuran = M_Pengukuran_Dies::where('dies_id', $id)->get();
                $tglPengukuran = M_Pengukuran_Dies::where('dies_id', '=', $id)->first();

                $checkStatus = M_ApprPengukuran::where(['req_id' => $req_id])->first();
                if ($checkStatus->is_approved == '-' and $checkStatus->is_rejected == '-') {
                    $status = '<span class="badge badge-square badge-outline badge-light-warning fs-4">Waiting For Approval</span>';
                } elseif ($checkStatus->is_approved == '1' and $checkStatus->is_rejected == '0') {
                    $status = "<span class='badge badge-light-success fs-3'>Approved</span>";
                } elseif ($checkStatus->is_approved == '0' and $checkStatus->is_rejected == '1') {
                    $status = "<span class='badge badge-light-danger fs-3'>Rejected</span>";
                }

                $data['labelIdentitas'] = $labelIdentitas;
                $data['dataPengukuran'] = $dataPengukuran;
                $data['tglPengukuran'] = $tglPengukuran;
                $data['statusPengukuran'] = $status;
                $data['req_id'] = $req_id;
                $data['jenis'] = 'dies';

                return view('qa.form.detail-pengukuran', $data);
            }
        }elseif($getHistory == 'disposal'){

        }
    }
    public function update_approval_status(Request $request, $req_id)
    {
        if($request->segment(3) == 'pengukuran'){
            $ApprovalData = M_ApprPengukuran::where('req_id', $req_id)->first();
            if($ApprovalData->punch_id != null){
                if ($request->segment(4) == 'approve') {
                    $setApproved = [
                        'is_approved' => '1',
                        'is_rejected' => '0',
                        'approved_by' => auth()->user()->nama,
                        'approved_at' => date('Y-m-d H:i:s'),
                    ];
                    M_ApprPengukuran::where('req_id', $req_id)->update($setApproved);
                    $updateStatusApproved = [
                        'is_approved' => '1',
                        'is_rejected' => '0',
                    ];
                    M_Punch::where('id', $ApprovalData->punch_id)->update($updateStatusApproved);
                    M_Pengukuran_Punch::where('punch_id', $ApprovalData->punch_id)->update($updateStatusApproved);
                    return redirect('/data/approval/pengukuran')->with('success', 'Data Pengukuran berhasil di Approve!');
                } elseif ($request->segment(4) == 'reject') {
                    $setRejected = [
                        'is_approved' => '0',
                        'is_rejected' => '1',
                        'approved_by' => auth()->user()->nama,
                        'approved_at' => date('Y-m-d H:i:s'),
                    ];
                    M_ApprPengukuran::where('req_id', $req_id)->update($setRejected);
                    $updateStatusApproved = [
                        'is_approved' => '0',
                        'is_rejected' => '1',
                    ];
                    M_Punch::where('id', $ApprovalData->punch_id)->update($updateStatusApproved);
                    M_Pengukuran_Punch::where('punch_id', $ApprovalData->punch_id)->update($updateStatusApproved);
                    return redirect('/data/approval/pengukuran')->with('success', 'Data Pengukuran di Reject!');
                }
            }elseif($ApprovalData->dies_id != null){

                if ($request->segment(4) == 'approve') {
                    $setApproved = [
                        'is_approved' => '1',
                        'is_rejected' => '0',
                        'approved_by' => auth()->user()->nama,
                        'approved_at' => date('Y-m-d H:i:s'),
                    ];
                    M_ApprPengukuran::where('req_id', $req_id)->update($setApproved);
                    $updateStatusApproved = [
                        'is_approved' => '1',
                        'is_rejected' => '0',
                    ];
                    M_Dies::where('id', $ApprovalData->dies_id)->update($updateStatusApproved);
                    M_Pengukuran_Punch::where('dies_id', $ApprovalData->dies_id)->update($updateStatusApproved);
                    return redirect('/data/approval/pengukuran')->with('success', 'Data Pengukuran berhasil di Approve!');
                } elseif ($request->segment(4) == 'reject') {
                    $setRejected = [
                        'is_approved' => '0',
                        'is_rejected' => '1',
                        'approved_by' => auth()->user()->nama,
                        'approved_at' => date('Y-m-d H:i:s'),
                    ];
                    M_ApprPengukuran::where('req_id', $req_id)->update($setRejected);
                    $updateStatusApproved = [
                        'is_approved' => '0',
                        'is_rejected' => '1',
                    ];
                    M_Dies::where('id', $ApprovalData->dies_id)->update($updateStatusApproved);
                    M_Pengukuran_Punch::where('dies_id', $ApprovalData->dies_id)->update($updateStatusApproved);
                    return redirect('/data/approval/pengukuran')->with('success', 'Data Pengukuran di Reject!');
                }
            }
        }elseif($request->segment(3) == 'disposal'){
            if ($request->segment(4) == 'approve') {
                $setApproved = [
                    'is_approved' => '1',
                    'is_rejected' => '0',
                    'approved_by' => session('username'),
                    'approved_at' => date('Y-m-d H:i:s'),
                ];
                M_ApprDisposal::where('req_id', $req_id)->update($setApproved);
                return redirect('/data/approval/pengukuran')->with('success', 'Permintaan Disposal berhasil di Approve!');
            } elseif ($request->segment(4) == 'reject') {
                $setRejected = [
                    'is_approved' => '0',
                    'is_rejected' => '1',
                    'approved_by' => session('username'),
                    'approved_at' => date('Y-m-d H:i:s'),
                ];
                M_ApprDisposal::where('req_id', $req_id)->update($setRejected);
                return redirect('/data/approval/pengukuran')->with('success', 'Permintaan Disposal di Reject!');
            }
        }
    }
}
