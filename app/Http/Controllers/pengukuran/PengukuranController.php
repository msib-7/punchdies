<?php

namespace App\Http\Controllers\pengukuran;

use App\Http\Controllers\Controller;
use App\Models\Dies;
use App\Models\M_ApprDisposal;
use App\Models\M_ApprPengukuran;
use App\Models\PengukuranAwalPunch;
use App\Models\PengukuranAwalDies;
use App\Models\PengukuranRutinDies;
use App\Models\PengukuranRutinPunch;
use App\Models\Punch;
use App\Services\GetJenisPunch;
use App\Services\Pengukuran\Awal\ServicePengukuranAwal;
use App\Services\Rumus\GetRumusPengukuranAwalDies;
use App\Services\Rumus\GetRumusPengukuranAwalPunch;
use App\Services\Rumus\GetRumusPengukuranRutinPunch;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\IsNull;

class PengukuranController extends Controller
{
    //Pengukuran Awal
    public function create_data_pengukuran_awal(Request $request)
    {
        //Buat Data Pengukuran Untuk Punch
        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }

        if($request->segment(3) == 'punch-atas' or $request->segment(3) == 'punch-bawah'){
            
            $jmlPunch = $request->jumlah_data_punch;

            session()->put('jumlah_punch', $jmlPunch);
            if(session('create_id') === null){
                $create_id = $request->create_id;
            }else{
                $create_id = session('create_id');
            }

            if($create_id == null){
                $dataPunch = Punch::where([
                    'punch_id' => session('punch_id'),
                ])->first();
            }else{
                $dataPunch = Punch::where('punch_id','=',$create_id)->first();
            }

            $updateMasaPengukuran = [
                'masa_pengukuran' => 'pengukuran awal'
            ];
            Punch::where('punch_id', '=', $dataPunch->punch_id)->update($updateMasaPengukuran);

            for($i = 1; $i <= $jmlPunch; $i++) {
                $createDraftPengukuran = [
                    'punch_id' => $dataPunch->punch_id,
                    'user_id' => session('user_id'),
                    'head_outer_diameter' => null,
                    'neck_diameter' => null,
                    'barrel' => null,
                    'overall_length' => null,
                    'tip_diameter_1' => null,
                    'tip_diameter_2' => null,
                    'cup_depth' => null,
                    'working_length' => null,
                    'status' => '-',
                    'masa_pengukuran' => 'pengukuran awal',
                    'note' => '',
                    'is_draft' => '1',
                    'is_delete_pp' => '0',
                    'is_edit' => '0',
                    'is_approved' => '-',
                    'is_rejected' => '-',
                ];
                PengukuranAwalPunch::create($createDraftPengukuran);
            }

            session()->put('punch_id', $dataPunch->punch_id);
            session()->put('first_id', 0);
            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            session()->remove('start_count');

            return redirect(route('pnd.pa.'.$route.'.show-form'));

        }elseif($request->segment(3) == 'dies'){        
            //Buat Data Pengukuran Untuk Dies
            $jmlDies = $request->jumlah_data_dies;

            session()->put('jumlah_dies', $jmlDies);

            if (session('create_id') === null) {
                $create_id = $request->create_id;
            } else {
                $create_id = session('create_id');
            }

            if ($create_id == null) {
                $dataDies = Dies::where([
                    'dies_id' => session('dies_id'),
                ])->first();
            } else {
                $dataDies = Dies::where('dies_id', '=', $create_id)->first();
            }

            $updateMasaPengukuran = [
                'masa_pengukuran' => 'pengukuran awal'
            ];
            Dies::where('dies_id', '=', $dataDies->dies_id)->update($updateMasaPengukuran);

            for ($i = 1; $i <= $jmlDies; $i++) {
                $createDraftPengukuran = [
                    'dies_id' => $dataDies->dies_id,
                    'user_id' => session('user_id'),
                    'outer_diameter' => null,
                    'inner_diameter_1' => null,
                    'inner_diameter_2' => null,
                    'ketinggian_dies' => null,
                    'visual' => '-',
                    'kesesuaian_dies' => '-',
                    'masa_pengukuran' => 'pengukuran awal',
                    'note' => '',
                    'is_draft' => '1',
                    'is_delete_pd' => '0',
                    'is_edit' => '0',
                    'is_approved' => '-',
                    'is_rejected' => '-',
                ];
                PengukuranAwalDies::create($createDraftPengukuran);
            }

            session()->put('dies_id', $dataDies->dies_id);
            session()->put('first_id', 0);
            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            session()->remove('start_count');

            return redirect(route('pnd.pa.dies.show-form'));
        }
    }
    public function buat_pengukuran($id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data Punch',

        ]);
        // session()->remove('create_id');
        
        // session()->put('create_id', $id);

    }
    public function cek_pengukuran(Request $request, $id)
    {
        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }

        $pengukuran = $request->pilih_pengukuran;
        session()->put('masa_pengukuran_view', $pengukuran);

        if($request->segment(3) == 'punch-atas' or $request->segment(3) == 'punch-bawah'){
            $showPengukuranAll = PengukuranAwalPunch::where('punch_id', '=', $id)->get();

            if (count($showPengukuranAll) == 0) {
                return redirect(route('pnd.pa.'.$route.'.index'))->with('error', 'Data Pengukuran Tidak ditemukan silahkan Buat Pengukuran!');
            } else {
                session()->remove('count_num');
                session()->put('punch_id', $request->segment(5));
                return redirect(route('pnd.pa.'.$route.'.view', session('punch_id')));
            }
        }elseif($request->segment(3) == 'dies'){
            $showPengukuranAll = PengukuranAwalDies::where('dies_id', '=', $id)->get();

            if (count($showPengukuranAll) == 0) {
                return redirect(route('pnd.pa.dies.index'))->with('error', 'Data Pengukuran Tidak ditemukan silahkan Buat Pengukuran!');
            } else {
                session()->remove('count_num');
                session()->put('dies_id', $request->segment(5));
                return redirect(route('pnd.pa.dies.view', session('dies_id')));
            }
        }
    }

    public function view_pengukuran(Request $request, $id)
    {
        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }
        session()->remove('create_id');
        if($request->segment(3) == 'punch-atas' or $request->segment(3) == 'punch-bawah'){
            if ($request->segment(3) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
                $data['route'] = 'atas';
            } elseif ($request->segment(3) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
                $data['route'] = 'bawah';
            }
            //Get Jenis Punch Berdasarkan Url
            (new GetJenisPunch())->handle($request->segment(3));

            //Memeriksa status Draft Pengukuran
            $cekDraft = Punch::where('punch_id', '=', $id)->first();
            if($cekDraft->is_draft == '1'){
                session()->remove('jumlah_punch');
                session()->remove('punch_id');
                session()->remove('count');
                session()->remove('show_id');
                session()->remove('start_count');
                session()->put('first_id', 0);
                session()->put('punch_id', $id);
                
                $jumlahPunch = PengukuranAwalPunch::where('punch_id','=',$id)->count();
                session()->put('jumlah_punch', $jumlahPunch);

                //Mengarahkan user ke tampilan form
                return redirect(route('pnd.pa.'.$route.'.show-form'));
            }else{
                $pengukuran = session('masa_pengukuran_view');
                if ($pengukuran == 'pengukuran awal') {
                    $LabelPunch = Punch::leftJoin('pengukuran_awal_punchs', 'punchs.punch_id', '=', 'pengukuran_awal_punchs.punch_id')
                        ->leftJoin('users', 'pengukuran_awal_punchs.user_id', '=', 'users.id')
                        ->where('punchs.punch_id', $id)
                        ->first();
                    $data['labelPunch'] = $LabelPunch;
                } else {
                    $LabelPunch = Punch::leftJoin('pengukuran_rutin_punchs', 'punchs.punch_id', '=', 'pengukuran_rutin_punchs.punch_id')
                        ->leftJoin('users', 'pengukuran_rutin_punchs.user_id', '=', 'users.id')
                        ->where('punchs.punch_id', $id)
                        ->where('pengukuran_rutin_punchs.masa_pengukuran', session('masa_pengukuran_view'))
                        ->first();
                    $data['labelPunch'] = $LabelPunch;
                }

                // $dataPengukuran = PengukuranAwalPunch::where('punch_id', '=', $id)->first();
                // $data['tglPengukuran'] = $dataPengukuran;

                $checkStatus = PengukuranAwalPunch::where(['punch_id' => $id, 'is_draft' => '1'])->count();
                if($checkStatus != 0){
                    $status = "<span class='badge badge-light-warning fs-3'>Draft</span>";
                }else{
                    $status = '';
                }
                $data['statusPengukuran'] = $status;

                if(session('show_id') === null){
                    $start_id = session('first_id');
                }else{
                    $start_id = session('show_id');
                }

                $cekPengukuran = PengukuranRutinPunch::query()
                    ->where('punch_id', $id)
                    ->where('masa_pengukuran', '=', session('masa_pengukuran_view'))
                    ->exists();

                if(!$cekPengukuran){
                    $dataPengukuran = PengukuranAwalPunch::where('punch_id', '=', $id)->first();
                    $data['tglPengukuran'] = $dataPengukuran;
                    $showPengukuranAll = PengukuranAwalPunch::where('punch_id', '=', $id)->get();
                    $data['dataPengukuran'] = $showPengukuranAll;
                    $data['masaPengukuran'] = 'pa';

                    return view('engineer.data.view.pengukuran-punch', $data);
                }else{
                    $dataPengukuran = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => session('masa_pengukuran_view')])->first();
                    $data['tglPengukuran'] = $dataPengukuran;
                    $showPengukuranAll = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => session('masa_pengukuran_view')])->get();
                    $data['dataPengukuran'] = $showPengukuranAll;
                    $data['masaPengukuran'] = 'pr';

                    return view('operator.data.view.pengukuran-punch', $data);

                }
                // return view('engineer.data.view.pengukuran-punch', $data);
            }

        }elseif($request->segment(3) == 'dies'){
            $cekDraft = Dies::where('dies_id', '=', $id)->first();
            if($cekDraft->is_draft == '1'){
                session()->remove('jumlah_dies');
                session()->remove('dies_id');
                session()->remove('count');
                session()->remove('show_id');
                session()->remove('start_count');
                session()->put('first_id', 0);
                session()->put('dies_id', $id);
                
                $jumlahDies = PengukuranAwalDies::where('dies_id','=',$id)->count();
                session()->put('jumlah_dies', $jumlahDies);

                return redirect(route('pnd.pa.dies.show-form'));
            }else{
                // session()->remove('count');
                $LabelDies = Dies::leftJoin('pengukuran_awal_diess', 'diess.dies_id', '=', 'pengukuran_awal_diess.dies_id')
                                        ->leftJoin('users', 'pengukuran_awal_diess.user_id', '=', 'users.id')
                                        ->where('diess.dies_id', $id)
                                        ->first();
                $data['labelDies'] = $LabelDies;

                $dataPengukuran = PengukuranAwalDies::where('dies_id', '=', $id)->first();
                $data['tglPengukuran'] = $dataPengukuran;

                $checkStatus = PengukuranAwalDies::where(['dies_id' => $id, 'is_draft' => '1'])->count();
                if($checkStatus != 0){
                    $status = "<span class='badge badge-light-warning fs-3'>Draft</span>";
                }else{
                    $status = '';
                }
                $data['statusPengukuran'] = $status;

                if(session('show_id') === null){
                    $start_id = session('first_id');
                }else{
                    $start_id = session('show_id');
                }
                $showPengukuranAll = PengukuranAwalDies::where('dies_id','=', $id)->get();

                $data['dataPengukuran'] = $showPengukuranAll;
                return view('engineer.data.view.pengukuran-dies', $data);
            }
        }
    }
    public function form_pengukuran(Request $request)
    {
        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }
        session()->remove('create_id');
        if($request->segment(3) == 'punch-atas' or $request->segment(3) == 'punch-bawah'){
            $LabelPunch = Punch::leftJoin('pengukuran_awal_punchs', 'punchs.punch_id', '=', 'pengukuran_awal_punchs.punch_id')
                ->leftJoin('users', 'pengukuran_awal_punchs.user_id', '=', 'users.id')
                ->where('punchs.punch_id', session('punch_id'))->first();
            $data['labelPunch'] = $LabelPunch;

            $dataPengukuran = PengukuranAwalPunch::where('punch_id', '=', session('punch_id'))->first();
            $data['tglPengukuran'] = $dataPengukuran;

            if ($request->segment(3) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
                $data['route'] = 'atas';
            } elseif ($request->segment(3) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
                $data['route'] = 'bawah';
            }

            $checkStatus = PengukuranAwalPunch::where(['punch_id' => session('punch_id'), 'is_draft' => '1'])->count();
            if ($checkStatus != 0) {
                $status = "<span class='badge badge-light-warning fs-3'>Draft</span>";
            } else {
                $status = '';
            }
            $data['statusPengukuran'] = $status;

            if (session('show_id') === null) {
                $start_id = session('first_id');
            } else {
                $start_id = session('show_id');
            }

            $queryPengukuran = PengukuranAwalPunch::query()
                ->where('punch_id', session('punch_id'))
                ->where('no', '>', $start_id)
                ->orderBy('no', 'asc')
                ->limit(10);
                
            $draftPengukuran = $queryPengukuran->get();
            $masa_pengukuran = $draftPengukuran->last()->masa_pengukuran;
            session()->put('masa_pengukuran', $masa_pengukuran);
            $data['draftPengukuran'] = $draftPengukuran;
            $data['count'] = count($draftPengukuran);
            $count = count($draftPengukuran) + session('count');
            $data['page'] = $count;
            session()->put('page', $count);
            if (session('count_num') == '' or session('count_num') == null) {
                $count_num = 1;
            } else {
                $count_num = session('count_num');
            }
            $data['count_header'] = $count_num;

            // session()->remove('show_id');
            session()->remove('start_count');
            session()->put('start_count', $count);

            return view('engineer.data.form.pengukuran-punch', $data);

        }elseif($request->segment(3) == 'dies'){
            $LabelDies = Dies::leftJoin('pengukuran_awal_diess', 'diess.dies_id', '=', 'pengukuran_awal_diess.dies_id')
                ->leftJoin('users', 'pengukuran_awal_diess.user_id', '=', 'users.id')
                ->where('diess.dies_id', session('dies_id'))->first();
            $data['labelDies'] = $LabelDies;

            $dataPengukuran = PengukuranAwalDies::where('dies_id', '=', session('dies_id'))->first();
            $data['tglPengukuran'] = $dataPengukuran;

            $data['jenis'] = 'dies';
            $data['route'] = 'dies';

            $checkStatus = PengukuranAwalDies::where(['dies_id' => session('dies_id'), 'is_draft' => '1'])->count();
            if ($checkStatus != 0) {
                $status = "<span class='badge badge-light-warning fs-3'>Draft</span>";
            } else {
                $status = '';
            }
            $data['statusPengukuran'] = $status;

            if (session('show_id') === null) {
                $start_id = session('first_id');
            } else {
                $start_id = session('show_id');
            }
            $queryPengukuran = PengukuranAwalDies::query()
                                ->where('dies_id', session('dies_id'))
                                ->where('no', '>', $start_id)
                                ->orderBy('no', 'asc')
                                ->limit(10);
                                // ->whereRaw('dies_id = ' . session('dies_id') . ' AND id > ' . $start_id)->orderBy('id')->limit(10)->get();
            $draftPengukuran = $queryPengukuran->get();
            $masa_pengukuran = $queryPengukuran->latest()->first()->masa_pengukuran;
            session()->put('masa_pengukuran', $masa_pengukuran);
            $data['draftPengukuran'] = $draftPengukuran;
            $data['count'] = count($draftPengukuran);
            $count = count($draftPengukuran) + session('count');
            $data['page'] = $count;
            session()->put('page', $count);
            if (session('count_num') == '' or session('count_num') == null) {
                $count_num = 1;
            } else {
                $count_num = session('count_num');
            }
            $data['count_header'] = $count_num;

            // session()->remove('show_id');
            session()->remove('start_count');
            session()->put('start_count', $count);

            return view('engineer.data.form.pengukuran-dies', $data);
        }
    }

    public function simpan_pengukuran(Request $request)
    {
        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }
        if($request->segment(3) == 'punch-atas' or $request->segment(3) == 'punch-bawah'){
            if ($request->segment(3) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(3) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
            }
            session()->remove('count');
            session()->remove('show_id');
            session()->remove('count_num');
            if(session('jumlah_punch') <= session('page'))
            {
                session()->remove('show_id');
                session()->put('show_id', session('first_id'));

                $update_id = $request->update_id;
                $hdo = $request->hdo;
                $ned = $request->ned;
                $bar = $request->bar;
                $ovl = $request->ovl;
                $tip1 = $request->tip1;
                $tip2 = $request->tip2;
                $cup = $request->cup;
                $wkl = $request->wkl;


                $i = 0;
                while ($i < count($update_id)) {
                    $createDraftPengukuran = [
                        'head_outer_diameter' => $hdo[$i],
                        'neck_diameter' => $ned[$i],
                        'barrel' => $bar[$i],
                        'overall_length' => $ovl[$i],
                        'tip_diameter_1' => $tip1[$i],
                        'tip_diameter_2' => $tip2[$i],
                        'cup_depth' => $cup[$i],
                        'working_length' => $wkl[$i],
                    ];
                    PengukuranAwalPunch::updateOrCreate(['no' => $update_id[$i]],$createDraftPengukuran);
                    // PengukuranAwalPunch::where('no', $update_id[$i])->update($createDraftPengukuran);
                    $i++;
                };

                return (new GetRumusPengukuranAwalPunch)->handle($update_id);                

            }elseif(session('jumlah_punch') > session('page')) {
                $last_id = $request->last_id;
                $count_num = $request->count_num;
                session()->put('first_id', $request->update_id[0]-1);
                session()->put('count_num', $count_num + 1);
                session()->put('show_id', $last_id);
                $count = session('start_count') + session('count');
                session()->put('count', $count);

                $update_id = $request->update_id;
                $hdo = $request->hdo;
                $ned = $request->ned;
                $bar = $request->bar;
                $ovl = $request->ovl;
                $tip1 = $request->tip1;
                $tip2 = $request->tip2;
                $cup = $request->cup;
                $wkl = $request->wkl;

                $i = 0;
                while ($i < count($update_id)) {
                    PengukuranAwalPunch::updateOrCreate(['no' => $update_id[$i]], 
                    [
                        'head_outer_diameter' => $hdo[$i],
                        'neck_diameter' => $ned[$i],
                        'barrel' => $bar[$i],
                        'overall_length' => $ovl[$i],
                        'tip_diameter_1' => $tip1[$i],
                        'tip_diameter_2' => $tip2[$i],
                        'cup_depth' => $cup[$i],
                        'working_length' => $wkl[$i],
                    ]);
                    $i++;
                }
                return redirect(route('pnd.pa.'.$route.'.show-form'));
            }
        }elseif($request->segment(3) == 'dies'){
            session()->remove('count');
            session()->remove('show_id');
            session()->remove('count_num');
            if (session('jumlah_dies') <= session('page')) {
                session()->remove('show_id');
                session()->put('show_id', session('first_id'));

                $update_id = $request->update_id;
                $otd = $request->otd;
                $inn1 = $request->inn1;
                $inn2 = $request->inn2;
                $ktd = $request->ktd;
                $vis = $request->vis;
                $ksd = $request->ksd;

                $i = 0;
                while ($i < count($update_id)) {
                    $createDraftPengukuran = [
                        'outer_diameter' => $otd[$i],
                        'inner_diameter_1' => $inn1[$i],
                        'inner_diameter_2' => $inn2[$i],
                        'ketinggian_dies' => $ktd[$i],
                        'visual' => $vis[$i],
                        'kesesuaian_dies' => $ksd[$i],
                    ];
                    PengukuranAwalDies::where('no', $update_id[$i])->update($createDraftPengukuran);
                    $i++;
                }

                return (new GetRumusPengukuranAwalDies)->handle($update_id);    

            } elseif (session('jumlah_dies') > session('page')) {
                $last_id = $request->last_id;
                $count_num = $request->count_num;
                session()->put('first_id', $request->update_id[0] - 1);
                session()->put('count_num', $count_num + 1);
                session()->put('show_id', $last_id);
                $count = session('start_count') + session('count');
                session()->put('count', $count);

                $update_id = $request->update_id;
                $otd = $request->otd;
                $inn1 = $request->inn1;
                $inn2 = $request->inn2;
                $ktd = $request->ktd;
                $vis = $request->vis;
                $ksd = $request->ksd;

                $i = 0;
                while ($i < count($update_id)) {
                    $createDraftPengukuran = [
                        'outer_diameter' => $otd[$i],
                        'inner_diameter_1' => $inn1[$i],
                        'inner_diameter_2' => $inn2[$i],
                        'ketinggian_dies' => $ktd[$i],
                        'visual' => $vis[$i],
                        'kesesuaian_dies' => $ksd[$i],
                    ];
                    PengukuranAwalDies::updateOrCreate(['no' => $update_id[$i]], 
                    [
                        'outer_diameter' => $otd[$i],
                        'inner_diameter_1' => $inn1[$i],
                        'inner_diameter_2' => $inn2[$i],
                        'ketinggian_dies' => $ktd[$i],
                        'visual' => $vis[$i],
                        'kesesuaian_dies' => $ksd[$i],
                    ]);
                    // PengukuranAwalDies::where('no', $update_id[$i])->update($createDraftPengukuran);
                    $i++;
                }
                return redirect(route('pnd.pa.dies.show-form'));
            }
        }
    }

    public function add_note_pa(Request $request)
    {
        $note  = $request->note;
        $jenis = $request->segment(2);
        $route = $request->segment(3);
        $referensi_drawing = $request->referensi_drawing;
        $catatan = $request->catatan;
        $kesimpulan = $request->kesimpulan;
        $micrometer_digital = $request->micrometer_digital;
        $caliper_digital = $request->caliper_digital;
        $dial_indicator_digital = $request->dial_indicator_digital;

        return (new ServicePengukuranAwal)->addNote($note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $micrometer_digital, $caliper_digital, $dial_indicator_digital);
    }

    //Pengukuran Rutin
    public function cek_pengukuran_rutin(Request $request, $id)
    {
        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }

        $pengukuran = $request->pilih_pengukuran;

        if ($request->segment(3) == 'punch-atas' or $request->segment(3) == 'punch-bawah') {
            if ($pengukuran == null) {
                $dataPunch = Punch::where('punch_id', $id)->latest('created_at')->first();
                $masa_pengukuran = $dataPunch->masa_pengukuran;
            } else {
                $masa_pengukuran = $pengukuran;
            }
            $cekPengukuran = PengukuranRutinPunch::
                                                where('punch_id', $id)
                                                ->where('masa_pengukuran', $masa_pengukuran)
                                                ->exists();
            if(!$cekPengukuran){
                $is_draft = Punch::query()
                                ->where('punch_id', $id)
                                ->where('masa_pengukuran', $masa_pengukuran)
                                ->where('is_draft', '1')
                                ->exists();
                if(!$is_draft){
                    $showPengukuranAll = PengukuranAwalPunch::query()
                    ->where('punch_id', '=', $id)
                    ->where('masa_pengukuran', $masa_pengukuran)
                    ->get();
                }else{
                    return redirect(route('pnd.pr.'.$route.'.index'))->with('error', 'Data Pengukuran Awal Belum Selesai!');
                }
            }else{
                $showPengukuranAll = PengukuranRutinPunch::query()
                                                    ->where('punch_id', '=', $id)
                                                    ->where('masa_pengukuran', $masa_pengukuran)
                                                    ->get();
            }

            if (count($showPengukuranAll) == 0) {
                return redirect(route('pnd.pr.'.$route.'.index'))->with('error', 'Data Pengukuran Tidak ditemukan silahkan Buat Pengukuran!');
            } else {
                session()->remove('count_num');
                session()->put('punch_id', $id);
                session()->put('masa_pengukuran_view', $masa_pengukuran);
                return redirect(route('pnd.pr.'.$route.'.view', session('punch_id')));
            }
        } elseif ($request->segment(3) == 'dies') {
            if ($pengukuran == null) {
                $dataDies = Dies::where('dies_id', $id)->latest()->first();
                $masa_pengukuran = $dataDies->masa_pengukuran;
            } else {
                $masa_pengukuran = $pengukuran;
            }
            $cekPengukuran = PengukuranRutinDies::
                where('dies_id', $id)
                ->where('masa_pengukuran', $masa_pengukuran)
                ->exists();
            if (!$cekPengukuran) {
                $is_draft = Dies::query()
                    ->where('dies_id', $id)
                    ->where('masa_pengukuran', $masa_pengukuran)
                    ->where('is_draft', '1')
                    ->exists();
                if (!$is_draft) {
                    $showPengukuranAll = PengukuranAwalDies::query()
                        ->where('dies_id', '=', $id)
                        ->where('masa_pengukuran', $masa_pengukuran)
                        ->get();
                } else {
                    return redirect(route('pnd.pr.dies.index'))->with('error', 'Data Pengukuran Awal Belum Selesai!');
                }
            } else {
                $showPengukuranAll = PengukuranRutinDies::query()
                    ->where('dies_id', '=', $id)
                    ->where('masa_pengukuran', $masa_pengukuran)
                    ->get();
            }

            if (count($showPengukuranAll) == 0) {
                return redirect('pnd.pr.dies.index')->with('error', 'Data Pengukuran Tidak ditemukan silahkan Buat Pengukuran!');
            } else {
                session()->remove('count_num');
                session()->put('dies_id', $id);
                return redirect('pnd.pr.dies.view', session('dies_id'));
            }
        }
    }
    public function opsi_pengukuran(Request $request,$id)
    {
        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }

        if($request->segment(3) == 'punch-atas' || $request->segment(3) == 'punch-bawah'){
            $dataPunch = Punch::where(['punch_id' => $id, 'is_draft' => '1'])->latest()->first();
            // dd($dataPunch);
            if ($dataPunch == null) {
                $query = M_ApprPengukuran::query()->where('punch_id', $id);
                //Cek Data Approval ada / tidak
                $cekApproval = $query->exists();
                if ($cekApproval) {
                    //Get Data Approval 
                    $dataApproval = $query->latest()->first();

                    if ($dataApproval->is_approved == '-') { // Jika Data Pengukuran Belum diapprove tidak bisa buat pengukuran baru
                        return response()->json([
                            'success' => false,
                            'message' => 'Data Pengukuran belum di Approve!',
                        ]);
                    } elseif ($dataApproval->is_approved == '0') {
                        return response()->json([
                            'success' => false,
                            'message' => 'Pengukuran Tidak Dapat Dilakukan Karena Data Gagal diApprove!',
                        ]);
                    } else {
                        return response()->json([
                            'success' => true,
                            'message' => 'Data Pengukuran Baru',
                        ]);
                    }
                }
            } else {
                if ($dataPunch->masa_pengukuran == 'pengukuran awal') {
                    return response()->json([
                        'isdraft' => true,
                        'status' => 'awal',
                        'success' => false,
                        'message' => 'Pengukuran Awal Belum Selesai!',
                    ]);
                } else {
                    if ($dataPunch != null) {
                        return response()->json([
                            'isdraft' => true,
                            'status' => 'rutin',
                            'success' => false,
                            'message' => 'Pengukuran Sebelumnya belum diselesaikan! lanjutkan pengukuran?',
                            'url' => route('pnd.pr.' . $route . '.cek-pengukuran', $id),
                        ]);
                    }
                }
            }
        }elseif($request->segment(3) == 'dies'){
            $dataDies = Dies::where(['dies_id' => $id, 'is_draft' => '1'])->latest()->first();
            if ($dataDies == null) {
                $query = M_ApprPengukuran::query()->where('dies_id', $id);
                //Cek Data Approval ada / tidak
                $cekApproval = $query->exists();
                if ($cekApproval) {
                    //Get Data Approval 
                    $dataApproval = $query->latest()->first();

                    if ($dataApproval->is_approved == '-') { // Jika Data Pengukuran Belum diapprove tidak bisa buat pengukuran baru
                        return response()->json([
                            'success' => false,
                            'message' => 'Data Pengukuran belum di Approve!',
                        ]);
                    } elseif ($dataApproval->is_approved == '0') {
                        return response()->json([
                            'success' => false,
                            'message' => 'Pengukuran Tidak Dapat Dilakukan Karena Data Gagal diApprove!',
                        ]);
                    } else {
                        return response()->json([
                            'success' => true,
                            'message' => 'Data Pengukuran Baru',
                        ]);
                    }
                }
            } else {
                if ($dataDies->masa_pengukuran == 'pengukuran awal') {
                    return response()->json([
                        'isdraft' => true,
                        'status' => 'awal',
                        'success' => false,
                        'message' => 'Pengukuran Awal Belum Selesai!',
                    ]);
                } else {
                    if ($dataDies != null) {
                        return response()->json([
                            'isdraft' => true,
                            'status' => 'rutin',
                            'success' => false,
                            'message' => 'Pengukuran Sebelumnya belum diselesaikan! lanjutkan pengukuran?',
                            'url' => route('pnd.pr.dies.cek-pengukuran', $id),
                        ]);
                    }
                }
            }
        }
    }
    public function info_pengukuran(Request $request,$id)
    {
        if($request->segment(3) == 'punch-atas' or $request->segment(3) =='punch-bawah'){
            $dataPunch = Punch::where('punch_id', $id)->latest()->first();
            $pengukuran = $dataPunch->masa_pengukuran;
            if($dataPunch->masa_pengukuran == "pengukuran awal"){
                $dataPengukuran = Punch::leftJoin('pengukuran_awal_punchs', 'punchs.punch_id', '=','pengukuran_awal_punchs.punch_id')
                                        ->leftJoin('users', 'pengukuran_awal_punchs.user_id','=','users.id')
                                        ->where('punchs.punch_id',$id)
                                        ->orderby('pengukuran_awal_punchs.punch_id', 'desc')
                                        ->first();
            }else{
                $dataPengukuran = Punch::leftJoin('pengukuran_rutin_punchs', 'punchs.punch_id', '=','pengukuran_rutin_punchs.punch_id')
                                        ->leftJoin('users', 'pengukuran_rutin_punchs.user_id','=','users.id')
                                        ->where('punchs.punch_id',$id)
                                        ->orderby('punchs.punch_id', 'desc')
                                        ->orderBy('punchs.id', 'desc')
                                        ->first();
            }
            // dd($dataPengukuran);
            if ($pengukuran == "pengukuran awal") {
                $masa_pengukuran = "pengukuran rutin 1";
            } else {
                $noUrut = (int) substr($pengukuran, 17);
                $masa_pengukuran = 'pengukuran rutin ' . $noUrut + 1;
            }
            // dd($dataPengukuran);
            return response()->json([
                'success' => true,
                'message' => 'Punch Data',
                'masa_pengukuran_pre' => $pengukuran,
                'masa_pengukuran' => $masa_pengukuran,
                'data' => $dataPengukuran
            ]);
        }elseif($request->segment(3) == 'dies'){
            $dataDies = Dies::where('dies_id', $id)->latest()->first();
            $pengukuran = $dataDies->masa_pengukuran;
            if ($dataDies->masa_pengukuran == "pengukuran awal") {
                $dataPengukuran = Dies::leftJoin('pengukuran_awal_diess', 'diess.dies_id', '=', 'pengukuran_awal_diess.diess_id')
                    ->leftJoin('users', 'pengukuran_awal_diess.user_id', '=', 'users.id')
                    ->where('diess.dies_id', $id)
                    ->orderby('pengukuran_awal_diess.diess_id', 'desc')
                    ->first();
            } else {
                $dataPengukuran = Dies::leftJoin('pengukuran_rutin_diess', 'diess.dies_id', '=', 'pengukuran_rutin_diess.dies_id')
                    ->leftJoin('users', 'pengukuran_rutin_diess.user_id', '=', 'users.id')
                    ->where('diess.dies_id', $id)
                    ->orderby('diess.dies_id', 'desc')
                    ->orderBy('diess.id', 'desc')
                    ->first();
            }
            if ($pengukuran == "pengukuran awal") {
                $masa_pengukuran = "pengukuran rutin 1";
            } else {
                $noUrut = (int) substr($pengukuran, 17);
                $masa_pengukuran = 'pengukuran rutin ' . $noUrut + 1;
            }
            // dd($dataPengukuran);
            return response()->json([
                'success' => true,
                'message' => 'Punch Data',
                'masa_pengukuran_pre' => $pengukuran,
                'masa_pengukuran' => $masa_pengukuran,
                'data' => $dataPengukuran
            ]);
        }
    }
    public function pilih_pengukuran(Request $request, $id) 
    {
        if($request->segment(3) == 'punch-atas' or $request->segment(3) =='punch-bawah'){
            $dataPunch = Punch::where('punch_id', $id)->get();
            
            $arrayData = json_decode($dataPunch, true);
            foreach($arrayData as $data){
                // dd($data['masa_pengukuran']);
                echo '<option value="'.$data['masa_pengukuran'].'">'.$data['masa_pengukuran'].'</option>';
            }
        }elseif($request->segment(3) == 'dies'){
            $dataDies = Dies::where('dies_id', $id)->get();

            $arrayData = json_decode($dataDies, true);
            foreach ($arrayData as $data) {
                // dd($data['masa_pengukuran']);
                echo '<option value="' . $data['masa_pengukuran'] . '">' . $data['masa_pengukuran'] . '</option>';
            }
        }
    }
    public function view_pengukuran_rutin(Request $request, $id)
    {
        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }

        session()->remove('create_id');
        session()->remove('masa_pengukuran_pre');
        if ($request->segment(3) == 'punch-atas' or $request->segment(3) == 'punch-bawah') {
            if ($request->segment(3) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
                $data['route'] = 'atas';
            } elseif ($request->segment(3) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
                $data['route'] = 'bawah';
            }

            $cekDraft = Punch::where('punch_id', '=', $id)
                        ->where('masa_pengukuran', session('masa_pengukuran_view'))
                        ->first();
            $pengukuran = session('masa_pengukuran_view');
            if($pengukuran == "pengukuran rutin 1"){
                $masa_pengukuran_pre = "pengukuran awal";
                $masa_pengukuran = $pengukuran;
            }else{
                $noUrut = (int) substr($pengukuran, 17);
                $masa_pengukuran_pre = 'pengukuran rutin ' . $noUrut - 1;
                $masa_pengukuran = $pengukuran;
            }
            if ($cekDraft->is_draft == '1') {
                session()->remove('jumlah_punch');
                session()->remove('punch_id');
                session()->remove('count');
                session()->remove('show_id');
                session()->remove('start_count');
                session()->put('first_id', 0);
                session()->put('punch_id', $id);

                $jumlahPunch = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => $pengukuran])->count();
                session()->put('jumlah_punch', $jumlahPunch);
                session()->put('masa_pengukuran_pre', $masa_pengukuran_pre);
                session()->put('masa_pengukuran', $masa_pengukuran);

                return redirect(route('pnd.pr.'.$route.'.form'));
            } else {
                if($pengukuran == 'pengukuran awal'){
                    $LabelPunch = Punch::leftJoin('pengukuran_awal_punchs', 'punchs.punch_id', '=', 'pengukuran_awal_punchs.punch_id')
                        ->leftJoin('users', 'pengukuran_awal_punchs.user_id', '=', 'users.id')
                        ->where('punchs.punch_id', $id)
                        ->orderBy('punchs.created_at', 'desc')
                        ->first();
                    $data['labelPunch'] = $LabelPunch;
                }else{
                    $LabelPunch = Punch::leftJoin('pengukuran_rutin_punchs', 'punchs.punch_id', '=', 'pengukuran_rutin_punchs.punch_id')
                        ->leftJoin('users', 'pengukuran_rutin_punchs.user_id', '=', 'users.id')
                        ->where('punchs.punch_id', $id)
                        ->where('pengukuran_rutin_punchs.masa_pengukuran', session('masa_pengukuran_view'))
                        ->orderBy('punchs.created_at', 'desc')
                        ->first();
                    $data['labelPunch'] = $LabelPunch;
                }
                // dd($LabelPunch);
                // session()->remove('count');

                $checkStatus = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => session('masa_pengukuran_view'), 'is_draft' => '1'])->count();
                if ($checkStatus != 0) {
                    $status = "<span class='badge badge-light-warning fs-3'>Draft</span>";
                } else {
                    $status = '';
                }
                $data['statusPengukuran'] = $status;

                if (session('show_id') === null) {
                    $start_id = session('first_id');
                } else {
                    $start_id = session('show_id');
                }

                $cekPengukuran = PengukuranRutinPunch::query()
                    ->where('punch_id', $id)
                    ->where('masa_pengukuran', '=', session('masa_pengukuran_view'))
                    ->exists();

                if(!$cekPengukuran){
                    $dataPengukuran = PengukuranAwalPunch::where('punch_id', '=', $id)->first();
                    $data['tglPengukuran'] = $dataPengukuran;
                    $showPengukuranAll = PengukuranAwalPunch::where('punch_id', '=', $id)->get();
                    $data['dataPengukuran'] = $showPengukuranAll;
                    $data['masaPengukuran'] = 'pa';

                    return view('engineer.data.view.pengukuran-punch', $data);
                }else{
                    $dataPengukuran = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => session('masa_pengukuran_view')])->first();
                    $data['tglPengukuran'] = $dataPengukuran;
                    $showPengukuranAll = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => session('masa_pengukuran_view')])->get();
                    $data['dataPengukuran'] = $showPengukuranAll;
                    $data['masaPengukuran'] = 'pr';

                    return view('operator.data.view.pengukuran-punch', $data);
                }
            }
        } elseif ($request->segment(3) == 'dies') {
            $data['jenis'] = 'dies';

            $cekDraft = Dies::where('dies_id', '=', $id)
                ->where('masa_pengukuran', session('masa_pengukuran_view'))
                ->first();
            $pengukuran = $cekDraft->masa_pengukuran;
            if ($pengukuran == "pengukuran rutin 1") {
                $masa_pengukuran_pre = "pengukuran awal";
                $masa_pengukuran = $pengukuran;
            } else {
                $noUrut = (int) substr($pengukuran, 17);
                $masa_pengukuran_pre = 'pengukuran rutin ' . $noUrut - 1;
                $masa_pengukuran = $pengukuran;
            }
            if ($cekDraft->is_draft == '1') {
                session()->remove('jumlah_punch');
                session()->remove('dies_id');
                session()->remove('count');
                session()->remove('show_id');
                session()->remove('start_count');
                session()->put('first_id', 0);
                session()->put('dies_id', $id);

                $jumlahPunch = PengukuranRutinDies::where(['dies_id' => $id, 'masa_pengukuran' => $pengukuran])->count();
                session()->put('jumlah_punch', $jumlahPunch);
                session()->put('masa_pengukuran_pre', $masa_pengukuran_pre);
                session()->put('masa_pengukuran', $masa_pengukuran);

                return redirect(route('pnd.pr.dies.form'));
            } else {
                if ($pengukuran == 'pengukuran awal') {
                    $LabelDies = Dies::leftJoin('pengukuran_awal_diess', 'diess.dies_id', '=', 'pengukuran_awal_diess.punch_id')
                        ->leftJoin('users', 'pengukuran_awal_diess.user_id', '=', 'users.id')
                        ->where('diess.dies_id', $id)
                        ->first();
                    $data['labelDies'] = $LabelDies;
                } else {
                    $LabelDies = Dies::leftJoin('pengukuran_rutin_diess', 'diess.dies_id', '=', 'pengukuran_rutin_diess.dies_id')
                        ->leftJoin('users', 'pengukuran_rutin_diess.user_id', '=', 'users.id')
                        ->where('diess.dies_id', $id)
                        ->where('pengukuran_rutin_diess.masa_pengukuran', session('masa_pengukuran_view'))
                        ->first();
                    $data['labelDies'] = $LabelDies;
                }

                $checkStatus = PengukuranRutinDies::where(['dies_id' => $id, 'masa_pengukuran' => session('masa_pengukuran_view'), 'is_draft' => '1'])->count();
                if ($checkStatus != 0) {
                    $status = "<span class='badge badge-light-warning fs-3'>Draft</span>";
                } else {
                    $status = '';
                }
                $data['statusPengukuran'] = $status;

                if (session('show_id') === null) {
                    $start_id = session('first_id');
                } else {
                    $start_id = session('show_id');
                }

                $cekPengukuran = PengukuranRutinDies::query()
                    ->where('dies_id', $id)
                    ->where('masa_pengukuran', '=', session('masa_pengukuran_view'))
                    ->exists();

                if (!$cekPengukuran) {
                    $dataPengukuran = PengukuranAwalDies::where('dies_id', '=', $id)->first();
                    $data['tglPengukuran'] = $dataPengukuran;
                    $showPengukuranAll = PengukuranAwalDies::where('dies_id', '=', $id)->get();
                    $data['dataPengukuran'] = $showPengukuranAll;

                    return view('engineer.data.view.pengukuran-dies', $data);
                } else {
                    $dataPengukuran = PengukuranRutinDies::where(['dies_id' => $id, 'masa_pengukuran' => session('masa_pengukuran_view')])->first();
                    $data['tglPengukuran'] = $dataPengukuran;
                    $showPengukuranAll = PengukuranRutinDies::where(['dies_id' => $id, 'masa_pengukuran' => session('masa_pengukuran_view')])->get();
                    $data['dataPengukuran'] = $showPengukuranAll;

                    return view('operator.data.view.pengukuran-dies', $data);
                }
            }
        }
    }
    public function create_data_pengukuran_rutin(Request $request, $id)
    {
        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }
        //Buat Data Pengukuran Untuk Punch
        if ($request->segment(3) == 'punch-atas' or $request->segment(3) == 'punch-bawah') {
            $dataPunch = Punch::where('punch_id', $id)->latest()->first();
            $pengukuran = $dataPunch->masa_pengukuran;
            if($dataPunch->masa_pengukuran == "pengukuran awal"){
                $jmlPunch = PengukuranAwalPunch::where(['punch_id' => $id, 'masa_pengukuran' => $pengukuran])->count();
            }
            else{
                $jmlPunch = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => $pengukuran])->count();
            }

            session()->put('jumlah_punch', $jmlPunch);

            if ($pengukuran == "pengukuran awal") {
                $masa_pengukuran_pre = "pengukuran awal";

                $masa_pengukuran = "pengukuran rutin 1";
                $updateMasaPengukuran = [
                    'masa_pengukuran' => $masa_pengukuran,
                ];
            } else {
                $noUrut = (int) substr($pengukuran, 17);
                $masa_pengukuran_pre = $pengukuran;
                $masa_pengukuran = 'pengukuran rutin ' . $noUrut + 1;
                $updateMasaPengukuran = [
                    'masa_pengukuran' => $masa_pengukuran,
                ];
            }

            $createData = [
                'punch_id' => $dataPunch->punch_id,
                'merk' => $dataPunch->merk,
                'bulan_pembuatan' => $dataPunch->bulan_pembuatan,
                'tahun_pembuatan' => $dataPunch->tahun_pembuatan,
                'nama_mesin_cetak' => $dataPunch->nama_mesin_cetak,
                'nama_produk' => $dataPunch->nama_produk,
                'kode_produk' => $dataPunch->kode_produk,
                'line_id' => $dataPunch->line_id,
                'jenis' => $dataPunch->jenis,
                'masa_pengukuran' => $masa_pengukuran,
                'is_draft' => '1',
                'is_delete_punch' => '0',
                'is_edit' => '0',
                'is_approved' => '-',
                'is_rejected' => '-',
            ];
            session()->put('punch_id', $dataPunch->punch_id);
            Punch::create($createData);

            // Punch::where('id', '=', $dataPunch->punch_id)->update($updateMasaPengukuran);
            
            $punch_id = Punch::latest()->first()->punch_id;

            for ($i = 1; $i <= $jmlPunch; $i++) {
                $createDraftPengukuran = [
                    'punch_id' => $punch_id,
                    'user_id' => auth()->user()->id,
                    'overall_length' => null,
                    'working_length_awal' => null,
                    'working_length_rutin' => null,
                    'cup_depth' => null,
                    'head_configuration' => '',
                    'masa_pengukuran' => $masa_pengukuran,
                    'note' => '',
                    'is_draft' => '1',
                    'is_delete_pp' => '0',
                    'is_edit' => '0',
                    'is_approved' => '-',
                    'is_rejected' => '-',
                ];
                PengukuranRutinPunch::create($createDraftPengukuran);
            }

            session()->put('punch_id', $punch_id);
            session()->put('first_id', 0);
            session()->put('masa_pengukuran', $masa_pengukuran);
            session()->put('masa_pengukuran_pre', $masa_pengukuran_pre);
            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            session()->remove('start_count');

            return redirect(route('pnd.pr.'.$route.'.form'));

        } elseif ($request->segment(3) == 'dies') {  
            //Buat Data Pengukuran Untuk Dies
            $dataDies = Dies::where('dies_id', $id)->latest()->first();
            $pengukuran = $dataDies->masa_pengukuran;
            if ($dataDies->masa_pengukuran == "pengukuran awal") {
                $jmlDies = PengukuranAwalDies::where(['dies_id' => $id, 'masa_pengukuran' => $pengukuran])->count();
            } else {
                $jmlDies = PengukuranRutinDies::where(['dies_id' => $id, 'masa_pengukuran' => $pengukuran])->count();
            }

            session()->put('jumlah_dies', $jmlDies);

            if ($pengukuran == "pengukuran awal") {
                $masa_pengukuran_pre = "pengukuran awal";

                $masa_pengukuran = "pengukuran rutin 1";
                $updateMasaPengukuran = [
                    'masa_pengukuran' => $masa_pengukuran,
                ];
            } else {
                $noUrut = (int) substr($pengukuran, 17);
                $masa_pengukuran_pre = $pengukuran;
                $masa_pengukuran = 'pengukuran rutin ' . $noUrut + 1;
                $updateMasaPengukuran = [
                    'masa_pengukuran' => $masa_pengukuran,
                ];
            }

            $createData = [
                'dies_id' => $dataDies->punch_id,
                'merk' => $dataDies->merk,
                'bulan_pembuatan' => $dataDies->bulan_pembuatan,
                'tahun_pembuatan' => $dataDies->tahun_pembuatan,
                'nama_mesin_cetak' => $dataDies->nama_mesin_cetak,
                'nama_produk' => $dataDies->nama_produk,
                'kode_produk' => $dataDies->kode_produk,
                'line_id' => $dataDies->line_id,
                'jenis' => $dataDies->jenis,
                'masa_pengukuran' => $masa_pengukuran,
                'is_draft' => '1',
                'is_delete_punch' => '0',
                'is_edit' => '0',
                'is_approved' => '-',
                'is_rejected' => '-',
            ];
            session()->put('dies_id', $dataDies->punch_id);
            Dies::create($createData);

            $dies_id = Dies::latest()->first()->dies_id;

            for ($i = 1; $i <= $jmlDies; $i++) {
                $createDraftPengukuran = [
                    'dies_id' => $dataDies->dies_id,
                    'user_id' => auth()->user()->id,
                    'outer_diameter' => null,
                    'inner_diameter_1' => null,
                    'inner_diameter_2' => null,
                    'ketinggian_dies' => null,
                    'visual' => '-',
                    'kesesuaian_dies' => '-',
                    'masa_pengukuran' => $masa_pengukuran,
                    'note' => '',
                    'is_draft' => '1',
                    'is_delete_pd' => '0',
                    'is_edit' => '0',
                    'is_approved' => '-',
                    'is_rejected' => '-',
                ];
                PengukuranRutinDies::create($createDraftPengukuran);
            }

            session()->put('dies_id', $dies_id);
            session()->put('first_id', 0);
            session()->put('masa_pengukuran', $masa_pengukuran);
            session()->put('masa_pengukuran_pre', $masa_pengukuran_pre);
            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            session()->remove('start_count');

            return redirect(route('pnd.pr.dies.form'));
        }
    }
    public function form_pengukuran_rutin(Request $request)
    {
        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }
        $pengukuran_pre = session('masa_pengukuran_pre');
        $pengukuran = session('masa_pengukuran');
        // dd($pengukuran_pre);
        session()->remove('create_id');
        if ($request->segment(3) == 'punch-atas' or $request->segment(3) == 'punch-bawah') {
            $id = session('punch_id');
            $LabelPunch = Punch::leftJoin('pengukuran_rutin_punchs', 'punchs.punch_id', '=', 'pengukuran_rutin_punchs.punch_id')
                ->leftJoin('users', 'pengukuran_rutin_punchs.user_id', '=', 'users.id')
                ->select('punchs.*', 'pengukuran_rutin_punchs.*', 'users.*',
                        'punchs.masa_pengukuran AS punch_masa_pengukuran')
                ->where('punchs.punch_id', $id)
                ->where('pengukuran_rutin_punchs.masa_pengukuran', $pengukuran)
                ->orderBy('punchs.created_at', 'desc')
                ->first();
            $data['labelPunch'] = $LabelPunch;
            // dd($LabelPunch);

            $data['tglPengukuran'] = PengukuranRutinPunch::where('punch_id', $id)->first();

            if ($request->segment(3) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
                $data['route'] = 'atas';
            } elseif ($request->segment(3) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
                $data['route'] = 'bawah';
            }

            $checkStatus = PengukuranRutinPunch::where(['punch_id' => $id, 'is_draft' => '1'])->count();
            if ($checkStatus != 0) {
                $status = "<span class='badge badge-light-warning fs-3'>Draft</span>";
            } else {
                $status = '';
            }
            $data['statusPengukuran'] = $status;

            if (session('show_id') === null) {
                $start_id = session('first_id');
            } else {
                $start_id = session('show_id');
            }


            //menampilkan hasil pengukuran sebelumnya
            if($pengukuran_pre == "pengukuran awal"){
                $showPengukuranPre = PengukuranAwalPunch::where("punch_id",$id)
                    ->orderBy('no')
                    ->limit(10)
                    ->get();
                $data['draftPengukuranPre'] = $showPengukuranPre;
            }else{
                $showPengukuranPre = PengukuranRutinPunch::query()
                    ->where('punch_id', $id)
                    ->where('masa_pengukuran', $pengukuran_pre)
                    ->where('no','>', $start_id)
                    // ->whereRaw("punch_id = " . $id . " AND masa_pengukuran = '" . $pengukuran_pre . "'" . " AND id > " . $start_id)
                ->orderBy('no')
                ->limit(10)
                ->get();
                $data['draftPengukuranPre'] = $showPengukuranPre;
            }

            // dd(session('show_id'));
            // dd($showPengukuranPre);
            
            //menampilkan form pengukuran yang akan dibuat
            $showPengukuranAll = PengukuranRutinPunch::query()
                                                ->where('punch_id', session('punch_id'))
                                                ->where('masa_pengukuran', session('masa_pengukuran'))
                                                ->where('no','>', $start_id)
                                                // ->whereRaw("punch_id = " . session('punch_id') . " AND masa_pengukuran = '".session('masa_pengukuran')."'". " AND id > " . $start_id)
                                                ->orderBy('no')
                                                ->limit(10)
                                                ->get();
            $data['draftPengukuran'] = $showPengukuranAll;

            //mengambil jumlah punch yang akan diukur
            $data['count'] = count($showPengukuranAll);
            $count = count($showPengukuranAll) + session('count');
            $data['page'] = $count;
            session()->put('page', $count);
            if (session('count_num') == '' or session('count_num') == null) {
                $count_num = 1;
            } else {
                $count_num = session('count_num');
            }
            $data['count_header'] = $count_num;

            dd($count_num);
            session()->remove('start_count');
            session()->put('start_count', $count);

            return view('operator.data.form.pengukuran-punch', $data);

        } elseif ($request->segment(3) == 'dies') {
            $id = session('punch_id');
            $LabelDies = Dies::leftJoin('pengukuran_rutin_diess', 'diess.dies_id', '=', 'pengukuran_rutin_diess.punch_id')
                ->leftJoin('users', 'pengukuran_rutin_diess.user_id', '=', 'users.id')
                ->select(
                    'punchs.*',
                    'pengukuran_rutin_diess.*',
                    'users.*',
                    'punchs.masa_pengukuran AS punch_masa_pengukuran'
                )
                ->where('diess.dies_id', $id)
                ->where('pengukuran_rutin_diess.masa_pengukuran', $pengukuran)
                ->orderBy('diess.created_at', 'desc')
                ->first();
            $data['labelDies'] = $LabelDies;

            $data['tglPengukuran'] = PengukuranRutinDies::where('dies_id', $id)->latest()->first();

            $data['jenis'] = 'dies';

            $checkStatus = PengukuranRutinDies::where(['dies_id' => $id, 'is_draft' => '1'])->count();
            if ($checkStatus != 0) {
                $status = "<span class='badge badge-light-warning fs-3'>Draft</span>";
            } else {
                $status = '';
            }
            $data['statusPengukuran'] = $status;

            if (session('show_id') === null) {
                $start_id = session('first_id');
            } else {
                $start_id = session('show_id');
            }

            //menampilkan form pengukuran yang akan dibuat
            $showPengukuranAll = PengukuranRutinDies::query()
                ->where('punch_id', session('dies_id'))
                ->where('masa_pengukuran', session('masa_pengukuran'))
                ->where('no', '>', $start_id)
                // ->whereRaw("punch_id = " . session('punch_id') . " AND masa_pengukuran = '".session('masa_pengukuran')."'". " AND id > " . $start_id)
                ->orderBy('no')
                ->limit(10)
                ->get();
            $data['draftPengukuran'] = $showPengukuranAll;

            $data['count'] = count($showPengukuranAll);
            $count = count($showPengukuranAll) + session('count');
            $data['page'] = $count;
            session()->put('page', $count);
            if (session('count_num') == '' or session('count_num') == null) {
                $count_num = 1;
            } else {
                $count_num = session('count_num');
            }
            $data['count_header'] = $count_num;

            // session()->remove('show_id');
            session()->remove('start_count');
            session()->put('start_count', $count);

            return view('operator.data.form.pengukuran-dies', $data);
        }
    }

    public function simpan_pengukuran_rutin(Request $request)
    {
        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }
        if ($request->segment(3) == 'punch-atas' or $request->segment(3) == 'punch-bawah') {
            //Get Jenis Punch Berdasarkan Url
            if ($request->segment(3) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(3) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
            }

            session()->remove('count');
            session()->remove('show_id');
            session()->remove('count_num');
            if (session('jumlah_punch') <= session('page')) {
                session()->remove('show_id');
                session()->remove('count');
                session()->remove('count_num');
                session()->put('show_id', session('first_id'));

                // Check if the required request parameters are present
                $update_id = $request->update_id ?? [];
                $ovl = $request->ovl ?? [];
                $cup = $request->cup ?? [];
                $wkl_awal = $request->wkl_awal ?? [];
                $hcf = $request->hcf ?? [];

                // Check if any of the arrays are empty
                if (empty($update_id) || empty($ovl) || empty($cup) || empty($wkl_awal) || empty($hcf)) {
                    return redirect()->back()->withErrors('One or more required fields are empty.');
                }

                // Calculate working_length_rutin for each index
                $wkl_rutin = [];
                for ($i = 0; $i < count($ovl); $i++) {
                    $wkl_rutin[$i] = $ovl[$i] - $cup[$i];
                }

                $i = 0;
                while ($i < count($update_id)) {
                    $createDraftPengukuran = [
                        'overall_length' => $ovl[$i],
                        'working_length_awal' => $wkl_awal[$i],
                        'working_length_rutin' => $wkl_rutin[$i],
                        'cup_depth' => $cup[$i],
                        'head_configuration' => $hcf[$i],
                    ];
                    PengukuranRutinPunch::where('no', $update_id[$i])->latest()->update($createDraftPengukuran);
                    $i++;
                }
                return (new GetRumusPengukuranRutinPunch)->handle($update_id, $wkl_awal);


            } elseif (session('jumlah_punch') > session('page')) {
                $last_id = $request->last_id;
                $count_num = $request->count_num;
                session()->put('first_id', $request->update_id[0]);
                session()->put('count_num', $count_num + 1);
                session()->put('show_id', $last_id);
                $count = session('start_count') + session('count');
                session()->put('count', $count);

                $update_id = $request->update_id;
                $ovl = $request->ovl;
                $cup = $request->cup;
                $wkl_awal = $request->wkl_awal;
                // $wkl_rutin = $request->wkl_rutin;
                $hcf = $request->hcf;

                // dd($update_id);
                $wkl_rutin = [];

                for ($i = 0; $i < count($ovl); $i++) {
                    // Calculate working_length_rutin for each index
                    $wkl_rutin[$i] = $ovl[$i] - $cup[$i];
                }

                $i = 0;
                while ($i < count($update_id)) {
                    PengukuranRutinPunch::updateOrCreate(
                        ['no' => $update_id[$i]],
                        [
                            'overall_length' => $ovl[$i],
                            'working_length_awal' => $wkl_awal[$i],
                            'working_length_rutin' => $wkl_rutin[$i],
                            'cup_depth' => $cup[$i],
                            'head_configuration' => $hcf[$i],
                        ]
                    );
                    $i++;
                }
                return redirect(route('pnd.pr.' . $route . '.form'));
            }
        } elseif ($request->segment(3) == 'dies') {
            $data['jenis'] = 'dies';

            session()->remove('count');
            session()->remove('show_id');
            session()->remove('count_num');
            if (session('jumlah_dies') <= session('page')) {
                session()->remove('show_id');
                session()->put('show_id', session('first_id'));

                $update_id = $request->update_id;
                $otd = $request->otd;
                $inn1 = $request->inn1;
                $inn2 = $request->inn2;
                $ktd = $request->ktd;
                $vis = $request->vis;
                $ksd = $request->ksd;

                $i = 0;
                while ($i < count($update_id)) {
                    $createDraftPengukuran = [
                        'outer_diameter' => $otd[$i],
                        'inner_diameter_1' => $inn1[$i],
                        'inner_diameter_2' => $inn2[$i],
                        'ketinggian_dies' => $ktd[$i],
                        'visual' => $vis[$i],
                        'kesesuaian_dies' => $ksd[$i],
                    ];
                    PengukuranRutinDies::where('no', $update_id[$i])->latest()->update($createDraftPengukuran);
                    $i++;
                }
                // return redirect('/data/'.$request->segment(3).'')->with('success', 'Pengukuran Awal Selesai Dilakukan!');

            } elseif (session('jumlah_dies') > session('page')) {
                $last_id = $request->last_id;
                // dd($last_id);
                $count_num = $request->count_num;
                // session()->remove('start_count');
                session()->put('first_id', $request->update_id[0] - 1);
                // dd(session('first_id'));
                session()->put('count_num', $count_num + 1);
                session()->put('show_id', $last_id);
                $count = session('start_count') + session('count');
                session()->put('count', $count);

                $update_id = $request->update_id;
                $otd = $request->otd;
                $inn1 = $request->inn1;
                $inn2 = $request->inn2;
                $ktd = $request->ktd;
                $vis = $request->vis;
                $ksd = $request->ksd;

                $i = 0;
                while ($i < count($update_id)) {
                    $createDraftPengukuran = [
                        'outer_diameter' => $otd[$i],
                        'inner_diameter_1' => $inn1[$i],
                        'inner_diameter_2' => $inn2[$i],
                        'ketinggian_dies' => $ktd[$i],
                        'visual' => $vis[$i],
                        'kesesuaian_dies' => $ksd[$i],
                    ];
                    PengukuranRutinDies::where('no', $update_id[$i])->latest()->update($createDraftPengukuran);
                    $i++;
                }
                return redirect(route('pnd.pr.dies.show-form'));
            }
        }
    }

    public function add_note_rutin(Request $request)
    {
        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }

        $referensi_drawing = $request->referensi_drawing;
        $catatan = $request->catatan;
        $kesimpulan = $request->kesimpulan;
        $micrometer_digital = $request->micrometer_digital;
        $caliper_digital = $request->caliper_digital;
        $dial_indicator_digital = $request->dial_indicator_digital;

        if ($request->segment(3) == 'punch-atas' or $request->segment(3) == 'punch-bawah') {
            if ($request->segment(3) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(3) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
            }
            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            $note = $request->note;

            Punch::updateOrCreate(
                [
                    'punch_id' => session('punch_id'),
                    'masa_pengukuran' => session('masa_pengukuran')
                ],
                [
                    'referensi_drawing' => $referensi_drawing,
                    'catatan' => $catatan,
                    'kesimpulan' => $kesimpulan,
                    'kalibrasi_micrometer' => $micrometer_digital,
                    'kalibrasi_caliper' => $caliper_digital,
                    'kalibrasi_dial_indicator' => $dial_indicator_digital,
                ]
            );

            return redirect(route('pnd.pr.' . $route . '.draft'));
        } elseif ($request->segment(3) == 'dies') {
            $data['jenis'] = 'dies';

            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            $note = $request->note;
            // $createDraftPengukuran = [
            //     'note' => $note,
            // ];
            // PengukuranRutinDies::where([
            //     'dies_id' => session('dies_id'),
            //     'masa_pengukuran' => session('masa_pengukuran')
            // ])->update($createDraftPengukuran);
            Dies::updateOrCreate([
                'dies_id' => session('dies_id'),
                'masa_pengukuran' => session('masa_pengukuran')],
                [
                    'referensi_drawing' => $referensi_drawing,
                    'catatan' => $catatan,
                    'kesimpulan' => $kesimpulan,
                    'kalibrasi_micrometer' => $micrometer_digital,
                    'kalibrasi_caliper' => $caliper_digital,
                    'kalibrasi_dial_indicator' => $dial_indicator_digital,
                ]);

            return redirect(route('pnd.pr.dies.draft'));
        }
    }
    public function set_draft_status_rutin(Request $request)
    {

        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }

        session()->remove('first_id');
        $updateDraftStatus = [
            'is_draft' => 0,
        ];

        if ($request->segment(3) == 'punch-atas' or $request->segment(3) == 'punch-bawah') {
            $getData = PengukuranRutinPunch::where([
                'punch_id' => session('punch_id'),
                'masa_pengukuran' => session('masa_pengukuran'),
            ])
                ->where('overall_length', '!=', null)
                ->where('cup_depth', '!=', null)
                ->where('working_length_rutin', '!=', null)
                ->where('head_configuration', '!=', '-');

            $getData->update($updateDraftStatus);

            $cekStatus = PengukuranRutinPunch::where([
                'punch_id' => session('punch_id'),
                'masa_pengukuran' => session('masa_pengukuran'),
                'is_draft' => '1'
            ])->count();

            if ($cekStatus > 0) {
                $alert = 'warning';
                $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';
            } else {
                $alert = 'success';
                $msg = 'Pengukuran Awal Selesai Dilakukan! Menunggu Approve';

                $updateStatus = [
                    'is_draft' => 0
                ];

                Punch::where('punch_id', '=', session('punch_id'))->update($updateStatus);
                $this->send_to_approval_rutin($request->segment(3));
            }
            // dd($cekStatus);

            return redirect(route('pnd.pr.'.$route.'.index'))->with($alert, $msg);

        } elseif ($request->segment(3) == 'dies') {
            $getData = PengukuranRutinDies::where([
                'dies_id' => session('dies_id'),
                'masa_pengukuran' => session('masa_pengukuran'),
            ])
                ->where('outer_diameter', '!=', null)
                ->where('inner_diameter_1', '!=', null)
                ->where('inner_diameter_2', '!=', null)
                ->where('ketinggian_dies', '!=', null)
                ->where('visual', '!=', '-')
                ->where('kesesuaian_dies', '!=', '-');

            $getData->update($updateDraftStatus);

            $cekStatus = PengukuranRutinDies::where([
                'dies_id' => session('dies_id'),
                'masa_pengukuran' => session('masa_pengukuran'),
                'is_draft' => '1'
            ])->count();

            if ($cekStatus > 0) {
                $alert = 'warning';
                $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';
            } else {
                $alert = 'success';
                $msg = 'Pengukuran Awal Selesai Dilakukan! Menunggu Approve';

                $updateStatus = [
                    'is_draft' => 0
                ];

                Dies::where('dies_id', '=', session('dies_id'))->update($updateStatus);
                $this->send_to_approval($request->segment(3));
            }
            // dd($cekStatus);

            return redirect(route('pnd.pr.dies.index'))->with($alert, $msg);
        }
    }

    private function send_to_approval_rutin($jenis)
    {
        $M_ApprPengukuran = new M_ApprPengukuran();
        $M_ApprDisposal = new M_ApprDisposal();

        if ($jenis == 'punch-atas' or $jenis == 'punch-bawah') {
            //Approval Data
            //AutoNumber for Request ID Approval
            $autonum = $M_ApprPengukuran->autonumber(["substr(req_id,3,6)" => date('ymd')])->first();
            if (!$autonum) {
                $id = "RPU" . date("ymd") . "0001";
            } else {
                $req_id = $autonum->req_id;
                $noUrut = (int) substr($req_id, 9, 4);
                $noUrut++;
                $id = "RPU" . date("ymd") . sprintf("%04s", $noUrut);
            }
            //Send Data To Approval
            $dateNow = date('Y-m-d H:i:s');
            $dataApproval = [
                'req_id' => $id,
                'punch_id' => session('punch_id'),
                'dies_id' => null,
                'masa_pengukuran' => session('masa_pengukuran'),
                'user_id' => session('user_id'),
                'tgl_submit' => $dateNow,
                'due_date' => date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . " +6 days")),
                'by' => '-',
                'at' => null,
                'is_approved' => '-',
                'is_rejected' => '-',
            ];
            M_ApprPengukuran::create($dataApproval);

        } elseif ($jenis == 'dies') {
            //Approval Data
            //AutoNumber for Request ID Approval
            $autonum = $M_ApprDisposal->autonumber(["substr(req_id,3,6)" => date('ymd')])->first();
            if (!$autonum) {
                $id = "RDI" . date("ymd") . "0001";
            } else {
                $req_id = $autonum->req_id;
                $noUrut = (int) substr($req_id, 9, 4);
                $noUrut++;
                $id = "RDI" . date("ymd") . sprintf("%04s", $noUrut);
            }
            //Send Data To Approval
            $dateNow = date('Y-m-d H:i:s');
            $dataApproval = [
                'req_id' => $id,
                'punch_id' => null,
                'dies_id' => session('dies_id'),
                'masa_pengukuran' => session('masa_pengukuran'),
                'user_id' => session('user_id'),
                'tgl_submit' => $dateNow,
                'due_date' => date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . " +6 days")),
                'by' => '-',
                'at' => null,
                'is_approved' => '-',
                'is_rejected' => '-',
            ];
            M_ApprPengukuran::create($dataApproval);
        }
    }

    public function print(Request $request, $id)
    {
        if ($request->segment(3) == 'punch-atas' or $request->segment(3) == 'punch-bawah') {
            $checkStatus = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => session('masa_pengukuran_view'), 'is_draft' => '1'])->count();
            $status = $checkStatus != 0 ? "<span class='badge badge-light-warning fs-3'>Draft</span>" : '';

            $data['statusPengukuran'] = $status;

            if ($request->segment(2) == 'pengukuran-awal') {
                $LabelPunch = Punch::leftJoin('pengukuran_awal_punchs', 'punchs.punch_id', '=', 'pengukuran_awal_punchs.punch_id')
                    ->leftJoin('users', 'pengukuran_awal_punchs.user_id', '=', 'users.id')
                    ->where('punchs.punch_id', $id)
                    ->first();
                $data['labelPunch'] = $LabelPunch;

                $dataPengukuran = PengukuranAwalPunch::where('punch_id', '=', $id)->first();
                $data['tglPengukuran'] = $dataPengukuran;

                $showPengukuranAll = PengukuranAwalPunch::where('punch_id', '=', $id)->get();
                $data['dataPengukuran'] = $showPengukuranAll;

                // Load the view and set the paper size to A4
                $pdf = Pdf::loadView('partials.pdf.punch.pengukuranAwalPDF', $data)
                    ->setPaper('A4', 'landscape'); // Set paper size and orientation

                return $pdf->stream('pengukuran_awal.pdf');
            } elseif ($request->segment(2) == 'pengukuran-rutin') {
                $LabelPunch = Punch::leftJoin('pengukuran_rutin_punchs', 'punchs.punch_id', '=', 'pengukuran_rutin_punchs.punch_id')
                    ->leftJoin('users', 'pengukuran_rutin_punchs.user_id', '=', 'users.id')
                    ->where('punchs.punch_id', $id)
                    ->where('pengukuran_rutin_punchs.masa_pengukuran', session('masa_pengukuran_view'))
                    ->first();
                $data['labelPunch'] = $LabelPunch;

                $dataPengukuran = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => session('masa_pengukuran_view')])->first();
                $data['tglPengukuran'] = $dataPengukuran;

                $showPengukuranAll = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => session('masa_pengukuran_view')])->get();
                $data['dataPengukuran'] = $showPengukuranAll;

                // Load the view and set the paper size to A4
                $pdf = Pdf::loadView('partials.pdf.punch.pengukuranRutinPDF', $data)
                    ->setPaper('A4', 'portrait'); // Set paper size and orientation

                return $pdf->download('pengukuran_rutin.pdf');
            }
        } elseif ($request->segment(3) == 'dies') {
            $dataDies = Dies::where('dies_id', $id)->get();
            $arrayData = json_decode($dataDies, true);
            foreach ($arrayData as $data) {
                echo '<option value="' . $data['masa_pengukuran'] . '">' . $data['masa_pengukuran'] . '</option>';
            }
        }
    }
}