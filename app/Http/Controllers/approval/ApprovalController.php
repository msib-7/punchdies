<?php

namespace App\Http\Controllers\approval;

use App\Http\Controllers\Controller;
use App\Models\ApprovalDisposal;
use App\Models\ApprovalPengukuran;
use App\Models\Dies;
use App\Models\PengukuranAwalDies;
use App\Models\PengukuranAwalPunch;
use App\Models\PengukuranRutinDies;
use App\Models\PengukuranRutinPunch;
use App\Models\Punch;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        $showApproval = $request->segment(3);

        if($showApproval == 'pengukuran'){
            $dataApproval = ApprovalPengukuran::all();
            $data['dataApproval'] = $dataApproval;
        }elseif($showApproval == 'disposal'){
            $dataApproval = ApprovalDisposal::all();
            $data['dataApproval'] = $dataApproval;
        }
    }
    public function show_data_approval(Request $request)
    {
        $showApproval = $request->segment(3);

        if ($showApproval == 'pengukuran') {
            $dataApproval = ApprovalPengukuran::leftJoin('users', 'approval_pengukurans.user_id', '=', 'users.id')
                                            ->leftJoin('lines', 'users.line_id', '=', 'lines.id')
                                            ->where('is_approved', '!=', '1')
                                            ->get();
            $dataPunch = Punch::where('is_delete_punch','0')->get();
            $dataDies = Dies::where('is_delete_dies','0')->get();

            $data['dataApproval'] = $dataApproval;
            $data['dataPunch'] = $dataPunch;
            $data['dataDies'] = $dataDies;
            $data['jenis'] = $showApproval;
            
            return view('qa.data.approval', $data);
            
        } elseif ($showApproval == 'disposal') {
            $dataApproval = ApprovalDisposal::leftJoin('users', 'approval_disposals.user_id', '=', 'users.id')
                ->leftJoin('lines', 'users.line_id', '=', 'lines.id')
                ->get();
            $dataPunch = Punch::where('is_delete_punch', '0')->get();
            $dataDies = Dies::where('is_delete_dies', '0')->get();

            $data['dataApproval'] = $dataApproval;
            $data['dataPunch'] = $dataPunch;
            $data['dataDies'] = $dataDies;
            $data['jenis'] = $showApproval;

            return view('qa.data.approval', $data);
        }
    }
    public function show_history(Request $request)
    {
        $dataApprPengukuran = ApprovalPengukuran::leftJoin('users', 'approval_pengukurans.user_id', '=', 'users.id')
            ->leftJoin('lines', 'users.line_id', '=', 'lines.id')
            ->where('is_approved','!=', '-')
            ->where('is_rejected','!=', '-')
            ->orderBy('tgl_submit', 'desc')
            ->get();
        $dataApprDisposal = ApprovalDisposal::leftJoin('users', 'approval_disposals.user_id', '=', 'users.id')
            ->leftJoin('lines', 'users.line_id', '=', 'lines.id')
            ->where('is_approved','!=', '-')
            ->where('is_rejected','!=', '-')
            ->orderBy('tgl_submit', 'desc')
            ->get();
        $dataPunch = Punch::get();
        $dataDies = Dies::get();

        $data['dataApprPengukuran'] = $dataApprPengukuran;
        $data['dataApprDisposal'] = $dataApprDisposal;
        $data['dataPunch'] = $dataPunch;
        $data['dataDies'] = $dataDies;

        return view('qa.data.history', $data);

    }

    public function detail_data_approval($req_id)
    {
        $dataRequest = ApprovalPengukuran::where('req_id', $req_id)->first();
        $data['segment'] = 'approval';

        if($dataRequest->punch_id != null){
            $id = $dataRequest->punch_id;
            $dataPunch = Punch::where('punch_id', $id)->first();
            if($dataPunch->masa_pengukuran == 'pengukuran awal'){
                $labelIdentitas = Punch::leftJoin('pengukuran_awal_punchs', 'punchs.punch_id', '=', 'pengukuran_awal_punchs.punch_id')
                                    ->leftJoin('users', 'pengukuran_awal_punchs.user_id', '=', 'users.id')
                                    ->where('punchs.punch_id', $id)->first();
                $dataPengukuran = PengukuranAwalPunch::where('punch_id', $id)->get();
                $tglPengukuran = PengukuranAwalPunch::where('punch_id', '=', $id)->first();
            }else{
                $labelIdentitas = Punch::leftJoin('pengukuran_rutin_punchs', 'punchs.punch_id', '=', 'pengukuran_rutin_punchs.punch_id')
                                    ->leftJoin('users', 'pengukuran_rutin_punchs.user_id', '=', 'users.id')
                                    ->where('punchs.punch_id', $id)->first();
                $dataPengukuran = PengukuranRutinPunch::where('punch_id', $id)->get();
                $tglPengukuran = PengukuranRutinPunch::where('punch_id', '=', $id)->first();
            }

            $checkStatus = ApprovalPengukuran::where(['req_id' => $req_id])->first();
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
            $dataDies = Dies::where('dies_id', $id)->first();
            //Periksa MasaPengukuran
            if($dataDies->masa_pengukuran == "pengukuran awal"){ //Get LabelIdentitas Pengukuran Awal
                $labelIdentitas = Dies::leftJoin('pengukuran_awal_diess', 'diess.dies_id', '=', 'pengukuran_awal_diess.dies_id')
                    ->leftJoin('users', 'pengukuran_awal_diess.user_id', '=', 'users.id')
                    ->where('diess.dies_id', $id)
                    ->first();
                $dataPengukuran = PengukuranAwalDies::where('dies_id', $id)->get();
                $tglPengukuran = PengukuranAwalDies::where('dies_id', '=', $id)->first();
            }else{ //Get LabelIdentitas Pengukuran Rutin
                $labelIdentitas = Dies::leftJoin('pengukuran_rutin_diess', 'diess.dies_id', '=', 'pengukuran_rutin_diess.dies_id')
                    ->leftJoin('users', 'pengukuran_rutin_diess.user_id', '=', 'users.id')
                    ->where('diess.dies_id', $id)
                    ->first();
                $dataPengukuran = PengukuranRutinDies::where('dies_id', $id)->get();
                $tglPengukuran = PengukuranRutinDies::where('dies_id', '=', $id)->first();
            }

            $checkStatus = ApprovalPengukuran::where(['req_id' => $req_id])->first();
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
            $dataRequest = ApprovalPengukuran::where('req_id', $req_id)->first();
            $data['segment'] = 'history';


            if ($dataRequest->punch_id != null) {
                $id = $dataRequest->punch_id;
                if ($dataRequest->masa_pengukuran == 'pengukuran awal') {
                    $labelIdentitas = Punch::leftJoin('pengukuran_awal_punchs', 'punchs.punch_id', '=', 'pengukuran_awal_punchs.punch_id')
                        ->leftJoin('users', 'pengukuran_awal_punchs.user_id', '=', 'users.id')
                        ->where('punchs.punch_id', $id)
                        ->where('punchs.masa_pengukuran', $dataRequest->masa_pengukuran)
                        ->first();
                    $dataPengukuran = PengukuranAwalPunch::where('punch_id', $id)->get();
                    $tglPengukuran = PengukuranAwalPunch::where('punch_id', '=', $id)->first();
                    $mp = 'awal';
                } else {
                    $labelIdentitas = Punch::leftJoin('pengukuran_rutin_punchs', 'punchs.punch_id', '=', 'pengukuran_rutin_punchs.punch_id')
                        ->leftJoin('users', 'pengukuran_rutin_punchs.user_id', '=', 'users.id')
                        ->where('punchs.punch_id', $id)
                        ->where('punchs.masa_pengukuran', $dataRequest->masa_pengukuran)
                        ->latest('punchs')
                        ->first();
                    $dataPengukuran = PengukuranRutinPunch::where('punch_id', $id)->get();
                    $tglPengukuran = PengukuranRutinPunch::where('punch_id', '=', $id)->first();
                    $mp = 'rutin';
                }

                $checkStatus = ApprovalPengukuran::where(['req_id' => $req_id])->first();
                if ($checkStatus->is_approved == '-' && $checkStatus->is_rejected == '-' || $checkStatus->is_approved == '0' && $checkStatus->is_rejected == '0') {
                    $status = '<span class="badge badge-square badge-outline badge-light-secondary fs-4">Belum diTinjau</span>';
                } elseif ($checkStatus->is_approved == '1' and $checkStatus->is_rejected == '0') {
                    $status = '<button class="btn btn-lg btn-outline btn-outline-success btn-active-light-success fs-2">Approved</button>';
                } elseif ($checkStatus->is_approved == '0' and $checkStatus->is_rejected == '1') {
                    $status = '<button class="btn btn-lg btn-outline btn-outline-danger btn-active-light-danger fs-2">Rejected</button>';
                }else{
                    $status = '<span class="badge badge-square badge-outline badge-light-secondary fs-4">Belum diTinjau</span>';
                }

                if($labelIdentitas->jenis == 'punch-atas'){
                    $route = 'atas';
                }elseif($labelIdentitas->jenis == 'punch-bawah'){
                    $route = 'bawah';
                }elseif($labelIdentitas->jenis == 'dies'){
                    $route = 'dies';
                }

                if ($dataRequest->masa_pengukuran == 'pengukuran awal') {
                    $masaPengukuran = 'pa';
                } else {
                    $masaPengukuran = 'pr';
                }

                $data['masaPengukuran'] = $masaPengukuran;
                $data['route'] = $route;
                $data['labelIdentitas'] = $labelIdentitas;
                $data['dataPengukuran'] = $dataPengukuran;
                $data['tglPengukuran'] = $tglPengukuran;
                $data['statusPengukuran'] = $status;
                $data['req_id'] = $req_id;
                $data['jenis'] = 'punch';
                $data['mp'] = $mp;
                $data['approvalInfo'] = $dataRequest;

                return view('qa.form.detail-pengukuran', $data);
            } elseif ($dataRequest->dies_id != null) {
                $id = $dataRequest->dies_id;
                if($dataRequest->masa_pengukuran == 'pengukuran awal'){
                    $labelIdentitas = Dies::leftJoin('pengukuran_awal_diess', 'diess.dies_id', '=', 'pengukuran_awal_diess.dies_id')
                        ->leftJoin('users', 'pengukuran_awal_diess.user_id', '=', 'users.id')
                        ->where('diess.dies_id', $id)->first();
                    $dataPengukuran = PengukuranAwalDies::where('dies_id', $id)->get();
                    $tglPengukuran = PengukuranAwalDies::where('dies_id', '=', $id)->first();
                    $mp = 'awal';
                } else {
                    $labelIdentitas = Dies::leftJoin('pengukuran_rutin_diess', 'diess.dies_id', '=', 'pengukuran_rutin_diess.dies_id')
                        ->leftJoin('users', 'pengukuran_rutin_diess.user_id', '=', 'users.id')
                        ->where('diess.dies_id', $id)
                        ->where('diess.masa_pengukuran', $dataRequest->masa_pengukuran)
                        ->latest('diess')
                        ->first();
                    $dataPengukuran = PengukuranRutinDies::where('dies_id', $id)->get();
                    $tglPengukuran = PengukuranRutinDies::where('dies_id', '=', $id)->first();
                    $mp = 'rutin';
                }

                $checkStatus = ApprovalPengukuran::where(['req_id' => $req_id])->first();
                if ($checkStatus->is_approved == '-' and $checkStatus->is_rejected == '-' || $checkStatus->is_approved == '0' && $checkStatus->is_rejected == '0') {
                    $status = '<span class="badge badge-square badge-outline badge-light-warning fs-4">Waiting For Approval</span>';
                } elseif ($checkStatus->is_approved == '1' and $checkStatus->is_rejected == '0') {
                    $status = "<span class='badge badge-light-success fs-3'>Approved</span>";
                } elseif ($checkStatus->is_approved == '0' and $checkStatus->is_rejected == '1') {
                    $status = "<span class='badge badge-light-danger fs-3'>Rejected</span>";
                } else {
                    $status = '<span class="badge badge-square badge-outline badge-light-secondary fs-4">Belum diTinjau</span>';
                }

                if ($labelIdentitas->jenis == 'punch-atas') {
                    $route = 'atas';
                } elseif ($labelIdentitas->jenis == 'punch-bawah') {
                    $route = 'bawah';
                } elseif( $labelIdentitas->jenis == 'dies'){
                    $route = 'dies';
                }

                if($dataRequest->masa_pengukuran == 'pengukuran awal'){
                    $masaPengukuran = 'pa';
                }else{
                    $masaPengukuran = 'pr';
                }

                $data['masaPengukuran'] = $masaPengukuran;
                $data['route'] = $route;
                $data['labelIdentitas'] = $labelIdentitas;
                $data['dataPengukuran'] = $dataPengukuran;
                $data['tglPengukuran'] = $tglPengukuran;
                $data['statusPengukuran'] = $status;
                $data['req_id'] = $req_id;
                $data['jenis'] = 'dies';
                $data['mp'] = $mp;
                $data['approvalInfo'] = $dataRequest;

                return view('qa.form.detail-pengukuran', $data);
            }
        }elseif($getHistory == 'disposal'){

        }
    }
    public function update_approval_status(Request $request, $req_id)
    {
        if($request->segment(3) == 'pengukuran'){
            $ApprovalData = ApprovalPengukuran::where('req_id', $req_id)->first();

            if($ApprovalData->punch_id != null){
                if ($request->segment(4) == 'approve') {
                    $setApproved = [
                        'is_approved' => '1',
                        'is_rejected' => '0',
                        'approved_by' => auth()->user()->nama,
                        'approved_at' => date('Y-m-d H:i:s'),
                    ];
                    ApprovalPengukuran::where('req_id', $req_id)->update($setApproved);
                    $updateStatusApproved = [
                        'is_approved' => '1',
                        'is_rejected' => '0',
                    ];
                    Punch::where(['punch_id' => $ApprovalData->punch_id, 'masa_pengukuran' => $ApprovalData->masa_pengukuran])->update($updateStatusApproved);
                    if($ApprovalData->masa_pengukuran == 'pengukuran awal'){
                        PengukuranAwalPunch::where('punch_id', $ApprovalData->punch_id)->update($updateStatusApproved);
                    }else{
                        PengukuranRutinPunch::where(['punch_id'=> $ApprovalData->punch_id, 'masa_pengukuran' => $ApprovalData->masa_pengukuran])->update($updateStatusApproved);
                    }
                    return redirect('/data/approval/pengukuran')->with('success', 'Data Pengukuran berhasil di Approve!');
                } elseif ($request->segment(4) == 'reject') {
                    $setRejected = [
                        'is_approved' => '0',
                        'is_rejected' => '1',
                        'approved_by' => auth()->user()->nama,
                        'approved_at' => date('Y-m-d H:i:s'),
                    ];
                    ApprovalPengukuran::where('req_id', $req_id)->update($setRejected);
                    $updateStatusApproved = [
                        'is_approved' => '0',
                        'is_rejected' => '1',
                    ];
                    Punch::where('punch_id', $ApprovalData->punch_id)->update($updateStatusApproved);
                    PengukuranAwalPunch::where('punch_id', $ApprovalData->punch_id)->update($updateStatusApproved);
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
                    ApprovalPengukuran::where('req_id', $req_id)->update($setApproved);
                    $updateStatusApproved = [
                        'is_approved' => '1',
                        'is_rejected' => '0',
                    ];
                    Dies::where('dies_id', $ApprovalData->dies_id)->update($updateStatusApproved);
                    PengukuranAwalDies::where('dies_id', $ApprovalData->dies_id)->update($updateStatusApproved);
                    return redirect('/data/approval/pengukuran')->with('success', 'Data Pengukuran berhasil di Approve!');
                } elseif ($request->segment(4) == 'reject') {
                    $setRejected = [
                        'is_approved' => '0',
                        'is_rejected' => '1',
                        'approved_by' => auth()->user()->nama,
                        'approved_at' => date('Y-m-d H:i:s'),
                    ];
                    ApprovalPengukuran::where('req_id', $req_id)->update($setRejected);
                    $updateStatusApproved = [
                        'is_approved' => '0',
                        'is_rejected' => '1',
                    ];
                    Dies::where('dies_id', $ApprovalData->dies_id)->update($updateStatusApproved);
                    PengukuranAwalDies::where('dies_id', $ApprovalData->dies_id)->update($updateStatusApproved);
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
                ApprovalDisposal::where('req_id', $req_id)->update($setApproved);
                return redirect('/data/approval/pengukuran')->with('success', 'Permintaan Disposal berhasil di Approve!');
            } elseif ($request->segment(4) == 'reject') {
                $setRejected = [
                    'is_approved' => '0',
                    'is_rejected' => '1',
                    'approved_by' => session('username'),
                    'approved_at' => date('Y-m-d H:i:s'),
                ];
                ApprovalDisposal::where('req_id', $req_id)->update($setRejected);
                return redirect('/data/approval/pengukuran')->with('success', 'Permintaan Disposal di Reject!');
            }
        }
    }

    public function detail_disposal_history(Request $request, $req_id)
    {
        $dataApproval = ApprovalDisposal::where('req_id', $req_id)->first();

        if ($dataApproval->punch_id != null) {
            if ($dataApproval->is_draft == '1') {
                return redirect()->route('pnd.request.disposal.create', $dataApproval->punch_id)->with('warning', 'You are in draft mode!');
            } elseif ($dataApproval->is_revisi == '1') {
                return redirect()->route('pnd.request.disposal.create', $dataApproval->punch_id)->with('warning', 'You are in revisi mode!');
            } else {
                $data = Punch::where('punch_id', $dataApproval->punch_id)->latest()->first();
            }
        } else {
            if ($dataApproval->is_draft == '1') {
                return redirect()->route('pnd.request.disposal.create', $dataApproval->dies_id)->with('warning', 'You are in draft mode!');
            } elseif ($dataApproval->is_revisi == '1') {
                return redirect()->route('pnd.request.disposal.create', $dataApproval->dies_id)->with('warning', 'You are in revisi mode!');
            } else {
                $data = Dies::where('dies_id', $dataApproval->dies_id)->latest()->first();
            }
        }

        return view('disposal.show', compact('dataApproval', 'data'));
    }
}
