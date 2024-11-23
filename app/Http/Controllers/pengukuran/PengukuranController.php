<?php

namespace App\Http\Controllers\pengukuran;

use App\Http\Controllers\Controller;
use App\Models\Audit_tr;
use App\Models\M_ApprDisposal;
use App\Models\M_ApprPengukuran;
use App\Models\M_Dies;
use App\Models\M_Pengukuran_Dies;
use App\Models\M_Pengukuran_Punch;
use App\Models\M_Punch;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\IsNull;

class PengukuranController extends Controller
{
    //Pengukuran Awal
    public function create_data_pengukuran_awal(Request $request)
    {
        //Buat Data Pengukuran Untuk Punch
        if($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah'){
            $jmlPunch = $request->jumlah_data_punch;

            session()->put('jumlah_punch', $jmlPunch);
            
            $create_id = session('create_id');

            if($create_id == null){
                $dataPunch = M_Punch::where([
                    'merk' => session('merk'),
                    'bulan_pembuatan' => session('bulan_pembuatan'),
                    'tahun_pembuatan' => session('tahun_pembuatan'),
                    'nama_mesin_cetak' => session('nama_mesin_cetak'),
                    'nama_produk' => session('nama_produk'),
                    'kode_produk' => session('kode_produk'),
                    'line_id' => session('line_id'),
                    'jenis' => session('jenis'),
                ])->first();
            }else{
                $dataPunch = M_Punch::where('id','=',$create_id)->first();
            }

            $updateMasaPengukuran = [
                'masa_pengukuran' => 'pengukuran awal'
            ];
            M_Punch::where('id', '=', $dataPunch->id)->update($updateMasaPengukuran);

            for($i = 1; $i <= $jmlPunch; $i++) {
                $createDraftPengukuran = [
                    'punch_id' => $dataPunch->id,
                    'user_id' => session('user_id'),
                    'head_outer_diameter' => null,
                    'neck_diameter' => null,
                    'barrel' => null,
                    'overall_length' => null,
                    'tip_diameter_1' => null,
                    'tip_diameter_2' => null,
                    'cup_depth' => null,
                    'working_length' => null,
                    'head_configuration' => '',
                    'masa_pengukuran' => 'pengukuran awal',
                    'note' => '',
                    'is_draft' => '1',
                    'is_delete_pp' => '0',
                    'is_edit' => '0',
                    'is_approved' => '-',
                    'is_rejected' => '-',
                ];
                M_Pengukuran_Punch::create($createDraftPengukuran);
            }

            session()->put('punch_id', $dataPunch->id);
            session()->put('first_id', 0);
            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            session()->remove('start_count');

            return redirect('/data/'.$request->segment(2).'/pengukuran-awal/form_pengukuran');

        }elseif($request->segment(2) == 'dies'){        //Buat Data Pengukuran Untuk Dies
            $jmlDies = $request->jumlah_data_dies;

            session()->put('jumlah_dies', $jmlDies);

            $create_id = session('create_id');

            if ($create_id == null) {
                $dataDies = M_Dies::where([
                    'merk' => session('merk'),
                    'bulan_pembuatan' => session('bulan_pembuatan'),
                    'tahun_pembuatan' => session('tahun_pembuatan'),
                    'nama_mesin_cetak' => session('nama_mesin_cetak'),
                    'nama_produk' => session('nama_produk'),
                    'kode_produk' => session('kode_produk'),
                    'line_id' => session('line_id'),
                    'jenis' => session('jenis'),
                ])->first();
            } else {
                $dataDies = M_Dies::where('id', '=', $create_id)->first();
            }

            $updateMasaPengukuran = [
                'masa_pengukuran' => 'pengukuran awal'
            ];
            M_Dies::where('id', '=', $dataDies->id)->update($updateMasaPengukuran);

            for ($i = 1; $i <= $jmlDies; $i++) {
                $createDraftPengukuran = [
                    'dies_id' => $dataDies->id,
                    'user_id' => session('user_id'),
                    'outer_diameter' => 0,
                    'inner_diameter_1' => 0,
                    'inner_diameter_2' => 0,
                    'ketinggian_dies' => 0,
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
                M_Pengukuran_Dies::create($createDraftPengukuran);
            }

            session()->put('dies_id', $dataDies->id);
            session()->put('first_id', 0);
            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            session()->remove('start_count');

            return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/form_pengukuran');
        }
    }
    public function buat_pengukuran($id)
    {
        session()->remove('create_id');
        
        session()->put('create_id', $id);
    }
    public function cek_pengukuran(Request $request, $id)
    {
        if($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah'){
            $showPengukuranAll = M_Pengukuran_Punch::where('punch_id', '=', $id)->get();

            if (count($showPengukuranAll) == 0) {
                return redirect('/data/' . $request->segment(2) . '')->with('error', 'Data Pengukuran Tidak ditemukan silahkan Buat Pengukuran!');
            } else {
                session()->remove('count_num');
                session()->put('punch_id', $request->segment(5));
                return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/view_pengukuran/' . session('punch_id'));
            }
        }elseif($request->segment(2) == 'dies'){
            $showPengukuranAll = M_Pengukuran_Dies::where('dies_id', '=', $id)->get();

            if (count($showPengukuranAll) == 0) {
                return redirect('/data/' . $request->segment(2) . '')->with('error', 'Data Pengukuran Tidak ditemukan silahkan Buat Pengukuran!');
            } else {
                session()->remove('count_num');
                session()->put('dies_id', $request->segment(5));
                return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/view_pengukuran/' . session('dies_id'));
            }
        }
    }

    public function view_pengukuran(Request $request, $id)
    {
        session()->remove('create_id');
        if($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah'){
            if ($request->segment(2) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(2) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
            }

            $cekDraft = M_Punch::where('id', '=', $id)->first();
            if($cekDraft->is_draft == '1'){
                session()->remove('jumlah_punch');
                session()->remove('punch_id');
                session()->remove('count');
                session()->remove('show_id');
                session()->remove('start_count');
                session()->put('first_id', 0);
                session()->put('punch_id', $id);
                
                $jumlahPunch = M_Pengukuran_Punch::where('punch_id','=',$id)->count();
                session()->put('jumlah_punch', $jumlahPunch);

                return redirect('/data/'.$request->segment(2).'/pengukuran-awal/form_pengukuran');
            }else{
                // session()->remove('count');
                $LabelPunch = M_Punch::leftJoin('tbl_pengukuran_punch', 'tbl_punch.id', '=', 'tbl_pengukuran_punch.punch_id')
                                        ->leftJoin('users', 'tbl_pengukuran_punch.user_id', '=', 'users.id')
                                        ->where('tbl_punch.id', $id)->first();
                $data['labelPunch'] = $LabelPunch;

                $dataPengukuran = M_Pengukuran_Punch::where('punch_id', '=', $id)->first();
                $data['tglPengukuran'] = $dataPengukuran;

                $checkStatus = M_Pengukuran_Punch::where(['punch_id' => $id, 'is_draft' => '1'])->count();
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
                $showPengukuranAll = M_Pengukuran_Punch::where('punch_id','=', $id)->get();

                $data['dataPengukuran'] = $showPengukuranAll;
                return view('engineer.data.view.pengukuran-punch', $data);
            }
        }elseif($request->segment(2) == 'dies'){
            $data['jenis'] = 'dies';

            $cekDraft = M_Dies::where('id', '=', $id)->first();
            if($cekDraft->is_draft == '1'){
                session()->remove('jumlah_dies');
                session()->remove('dies_id');
                session()->remove('count');
                session()->remove('show_id');
                session()->remove('start_count');
                session()->put('first_id', 0);
                session()->put('dies_id', $id);
                
                $jumlahDies = M_Pengukuran_Dies::where('dies_id','=',$id)->count();
                session()->put('jumlah_dies', $jumlahDies);

                return redirect('/data/'.$request->segment(2).'/pengukuran-awal/form_pengukuran');
            }else{
                // session()->remove('count');
                $LabelDies = M_Dies::leftJoin('tbl_pengukuran_dies', 'tbl_dies.id', '=', 'tbl_pengukuran_dies.dies_id')
                                        ->leftJoin('users', 'tbl_pengukuran_dies.user_id', '=', 'users.id')
                                        ->where('tbl_dies.id', $id)->first();
                $data['labelDies'] = $LabelDies;

                $dataPengukuran = M_Pengukuran_Dies::where('dies_id', '=', $id)->first();
                $data['tglPengukuran'] = $dataPengukuran;

                $checkStatus = M_Pengukuran_Dies::where(['dies_id' => $id, 'is_draft' => '1'])->count();
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
                $showPengukuranAll = M_Pengukuran_Dies::where('dies_id','=', $id)->get();

                $data['dataPengukuran'] = $showPengukuranAll;
                return view('engineer.data.view.pengukuran-dies', $data);
            }
        }
    }
    public function form_pengukuran(Request $request)
    {
        session()->remove('create_id');
        if($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah'){
            $LabelPunch = M_Punch::leftJoin('tbl_pengukuran_punch', 'tbl_punch.id', '=', 'tbl_pengukuran_punch.punch_id')
                ->leftJoin('users', 'tbl_pengukuran_punch.user_id', '=', 'users.id')
                ->where('tbl_punch.id', session('punch_id'))->first();
            $data['labelPunch'] = $LabelPunch;

            $dataPengukuran = M_Pengukuran_Punch::where('punch_id', '=', session('punch_id'))->first();
            $data['tglPengukuran'] = $dataPengukuran;

            if ($request->segment(2) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(2) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
            }

            $checkStatus = M_Pengukuran_Punch::where(['punch_id' => session('punch_id'), 'is_draft' => '1'])->count();
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
            $showPengukuranAll = M_Pengukuran_Punch::whereRaw('punch_id = ' . session('punch_id') . ' AND id > ' . $start_id)->orderBy('id')->limit(10)->get();
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

            return view('engineer.data.form.pengukuran-punch', $data);

        }elseif($request->segment(2) == 'dies'){
            $LabelDies = M_Dies::leftJoin('tbl_pengukuran_dies', 'tbl_dies.id', '=', 'tbl_pengukuran_dies.dies_id')
                ->leftJoin('users', 'tbl_pengukuran_dies.user_id', '=', 'users.id')
                ->where('tbl_dies.id', session('dies_id'))->first();
            $data['labelDies'] = $LabelDies;

            $dataPengukuran = M_Pengukuran_Dies::where('dies_id', '=', session('dies_id'))->first();
            $data['tglPengukuran'] = $dataPengukuran;

            $data['jenis'] = 'dies';

            $checkStatus = M_Pengukuran_Dies::where(['dies_id' => session('dies_id'), 'is_draft' => '1'])->count();
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
            $showPengukuranAll = M_Pengukuran_Dies::whereRaw('dies_id = ' . session('dies_id') . ' AND id > ' . $start_id)->orderBy('id')->limit(10)->get();
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

            return view('engineer.data.form.pengukuran-dies', $data);
        }
    }

    public function simpan_pengukuran(Request $request)
    {
        if($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah'){
            if ($request->segment(2) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(2) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
            }

            session()->remove('count');
            session()->remove('show_id');
            session()->remove('count_num');
            if(session('jumlah_punch')<=session('page'))
            {
                // $last_id = $request->last_id;
                // $count_num = $request->count_num;
                // session()->put('count_num', $count_num + 1);
                session()->remove('show_id');
                session()->put('show_id', session('first_id'));
                // dd(session('show_id'));
                // $count = session('start_count') + session('count');
                // $count = session('count');
                // session()->put('count', $count);

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
                    M_Pengukuran_Punch::where('id', $update_id[$i])->update($createDraftPengukuran);
                    $i++;
                }

            }elseif(session('jumlah_punch') > session('page'))
            {
                $last_id = $request->last_id;
                // dd($last_id);
                $count_num = $request->count_num;
                // session()->remove('start_count');
                session()->put('first_id', $request->update_id[0]-1);
                // dd(session('first_id'));
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
                    // dd(count($hdo));
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
                    M_Pengukuran_Punch::where('id', $update_id[$i])->update($createDraftPengukuran);
                    $i++;
                }
                return redirect('/data/'.$request->segment(2).'/pengukuran-awal/form_pengukuran');
            }
        }elseif($request->segment(2) == 'dies'){
            $data['jenis'] = 'dies';

            session()->remove('count');
            session()->remove('show_id');
            session()->remove('count_num');
            if (session('jumlah_dies') <= session('page')) {
                // $last_id = $request->last_id;
                // $count_num = $request->count_num;
                // session()->put('count_num', $count_num + 1);
                session()->remove('show_id');
                session()->put('show_id', session('first_id'));
                // dd(session('show_id'));
                // $count = session('start_count') + session('count');
                // $count = session('count');
                // session()->put('count', $count);

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
                    M_Pengukuran_Dies::where('id', $update_id[$i])->update($createDraftPengukuran);
                    $i++;
                }
                // return redirect('/data/'.$request->segment(2).'')->with('success', 'Pengukuran Awal Selesai Dilakukan!');

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
                    M_Pengukuran_Dies::where('id', $update_id[$i])->update($createDraftPengukuran);
                    $i++;
                }
                return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/form_pengukuran');
            }
        }
    }

    public function add_note_pa(Request $request)
    {
        if($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah'){
            if ($request->segment(2) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(2) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
            }
            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            $note = $request->note;
            $createDraftPengukuran = [
                'note' => $note,
            ];
            M_Pengukuran_Punch::where([
                'punch_id' => session('punch_id'),
                'masa_pengukuran' => 'pengukuran awal'
            ])->update($createDraftPengukuran);

            return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/set-status');
        }elseif($request->segment(2) == 'dies'){
            $data['jenis'] = 'dies';

            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            $note = $request->note;
            $createDraftPengukuran = [
                'note' => $note,
            ];
            M_Pengukuran_Dies::where([
                'dies_id' => session('dies_id'),
                'masa_pengukuran' => 'pengukuran awal'
            ])->update($createDraftPengukuran);

            return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/set-status');
        }
    }

    public function set_draft_status(Request $request)
    {
        $M_ApprPengukuran = new M_ApprPengukuran();

        session()->remove('first_id');
        $updateDraftStatus = [
            'is_draft' => 0,
        ];

        if($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah'){
            $getData = M_Pengukuran_Punch::where([
                'punch_id' => session('punch_id'),
                'masa_pengukuran' => 'pengukuran awal',
            ])
                ->where('head_outer_diameter', '!=', '0')
                ->where('neck_diameter', '!=', '0')
                ->where('barrel', '!=', '0')
                ->where('overall_length', '!=', '0')
                ->where('tip_diameter_1', '!=', '0')
                ->where('tip_diameter_2', '!=', '0')
                ->where('cup_depth', '!=', '0')
                ->where('working_length', '!=', '0');

            $getData->update($updateDraftStatus);

            $cekStatus = M_Pengukuran_Punch::where([
                'punch_id' => session('punch_id'),
                'masa_pengukuran' => 'pengukuran awal',
                'is_draft' => '1'
            ])->count();

            if ($cekStatus > 0) {
                $alert = 'warning';
                $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';
            } else {
                $alert = 'success';
                $msg = 'Pengukuran Awal Selesai Dilakukan! Menunggu Approval dari Manager QA';

                $updateStatus = [
                    'is_draft' => 0
                ];

                M_Punch::where('id', '=', session('punch_id'))->update($updateStatus);
                $this->send_to_approval($request->segment(2));
            }
            // dd($cekStatus);

            return redirect('/data/' . $request->segment(2))->with($alert, $msg);

        }elseif($request->segment(2) == 'dies'){
            $getData = M_Pengukuran_Dies::where([
                'dies_id' => session('dies_id'),
                'masa_pengukuran' => 'pengukuran awal',
            ])
                ->where('outer_diameter', '!=', '0')
                ->where('inner_diameter_1', '!=', '0')
                ->where('inner_diameter_2', '!=', '0')
                ->where('ketinggian_dies', '!=', '0')
                ->where('visual', '!=', '-')
                ->where('kesesuaian_dies', '!=', '-');

            $getData->update($updateDraftStatus);

            $cekStatus = M_Pengukuran_Dies::where([
                'dies_id' => session('dies_id'),
                'masa_pengukuran' => 'pengukuran awal',
                'is_draft' => '1'
            ])->count();

            if ($cekStatus > 0) {
                $alert = 'warning';
                $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';
            } else {
                $alert = 'success';
                $msg = 'Pengukuran Awal Selesai Dilakukan! Menunggu Approval dari Manager QA';

                $updateStatus = [
                    'is_draft' => 0
                ];

                M_Dies::where('id', '=', session('dies_id'))->update($updateStatus);
                $this->send_to_approval($request->segment(2));
            }
            // dd($cekStatus);

            return redirect('/data/' . $request->segment(2))->with($alert, $msg);
        }
    }

    private function send_to_approval($jenis)
    {
        $M_ApprPengukuran = new M_ApprPengukuran();
        $M_ApprDisposal = new M_ApprDisposal();

        if($jenis == 'punch-atas' or $jenis == 'punch-bawah'){
            //Approval Data
            //AutoNumber for Request ID Approval
            $autonum = $M_ApprPengukuran->autonumber(["substr(req_id,3,6)" => date('ymd')])->first();
            if (!$autonum) {
                $id = "RID" . date("ymd") . "0001";
            } else {
                $req_id = $autonum->req_id;
                $noUrut = (int) substr($req_id, 9, 4);
                $noUrut++;
                $id = "RID" . date("ymd") . sprintf("%04s", $noUrut);
            }

            //Send Data To Approval
            $dateNow = date('Y-m-d H:i:s');
            $dataApproval = [
                'req_id' => $id,
                'punch_id' => session('punch_id'),
                'dies_id' => null,
                'user_id' => session('user_id'),
                'tgl_submit' => $dateNow,
                'due_date' => date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . " +6 days")),
                'approved_by' => '-',
                'approved_at' => null,
                'is_approved' => '-',
                'is_rejected' => '-',
            ];
            M_ApprPengukuran::create($dataApproval);

        }elseif($jenis == 'dies'){
           //Approval Data
                //AutoNumber for Request ID Approval
                $autonum = $M_ApprDisposal->autonumber(["substr(req_id,3,6)" => date('ymd')])->first();
                if (!$autonum) {
                    $id = "RID" . date("ymd") . "0001";
                } else {
                    $req_id = $autonum->req_id;
                    $noUrut = (int) substr($req_id, 9, 4);
                    $noUrut++;
                    $id = "RID" . date("ymd") . sprintf("%04s", $noUrut);
                }

                //Send Data To Approval
                $dateNow = date('Y-m-d H:i:s');
                $dataApproval = [
                    'req_id' => $id,
                    'punch_id' => null,
                    'dies_id' => session('dies_id'),
                    'user_id' => session('user_id'),
                    'tgl_submit' => $dateNow,
                'due_date' => date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . " +6 days")),
                    'approved_by' => '-',
                    'approved_at' => null,  
                    'is_approved' => '-',
                    'is_rejected' => '-',
                ];
                M_ApprPengukuran::create($dataApproval); 
        }
    }

    //Pengukuran Rutin
    public function opsi_pengukuran($id)
    {
        session()->remove('create_id');

        session()->put('create_id', $id);
    }
    public function info_pengukuran(Request $request,$id)
    {
        if($request->segment(2) == 'punch-atas' or $request->segment(2) =='punch-bawah'){
            $dataPengukuran = M_Punch::leftJoin('tbl_pengukuran_punch', 'tbl_punch.id', '=','tbl_pengukuran_punch.punch_id')
                                    ->leftJoin('users', 'tbl_pengukuran_punch.user_id','=','users.id')
                                    ->where('tbl_punch.id',session('create_id'))
                                    ->orderby('tbl_pengukuran_punch.id', 'desc')
                                    ->first();
            return response()->json([
                'success' => true,
                'message' => 'Punch Data',
                'data' => $dataPengukuran
            ]);
        }elseif($request->segment(2) == 'dies'){

        }
    }
    public function create_data_pengukuran_rutin(Request $request, $id)
    {

        //Buat Data Pengukuran Untuk Punch
        if ($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah') {
            $dataPunch = M_Punch::where('id', '=', $id)->first();

            $pengukuran = $dataPunch->masa_pengukuran;
            $jmlPunch = M_Pengukuran_Punch::where(['punch_id' => $id, 'masa_pengukuran' => $pengukuran])->count();
            session()->put('jumlah_punch', $jmlPunch);

            if ($pengukuran != "pengukuran awal") {
                $noUrut = (int) substr($pengukuran, 17);
                $masa_pengukuran_pre = 'pengukuran rutin ' . $noUrut;
                $masa_pengukuran = 'pengukuran rutin ' . $noUrut + 1;
                $updateMasaPengukuran = [
                    'masa_pengukuran' => $masa_pengukuran,
                ];
            } elseif ($pengukuran == "pengukuran awal") {
                $masa_pengukuran_pre = "pengukuran awal";

                $masa_pengukuran = "pengukuran rutin 1";
                $updateMasaPengukuran = [
                    'masa_pengukuran' => $masa_pengukuran,
                ];

            }

            $createData = [
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
            //Data Audit
            // $logdate = date('Y-m-d H:i:s');
            // $dataAudit = [
            //     'event' => 'Punch Created',
            //     'logdate' => $logdate,
            //     'user_id' => session('user_id'),
            //     'line' => session('line_user'),
            //     'category' => 'Create',
            //     'detail' => 'User ' . session('username') . ', Create Punch "' . $merk . '", ' . $logdate,
            // ];
            session()->put($createData);
            M_Punch::create($createData);

            // M_Punch::where('id', '=', $dataPunch->id)->update($updateMasaPengukuran);

            for ($i = 1; $i <= $jmlPunch; $i++) {
                $createDraftPengukuran = [
                    'punch_id' => $dataPunch->id,
                    'user_id' => auth()->user()->id,
                    'head_outer_diameter' => null,
                    'neck_diameter' => null,
                    'barrel' => null,
                    'overall_length' => null,
                    'tip_diameter_1' => null,
                    'tip_diameter_2' => null,
                    'cup_depth' => null,
                    'working_length' => null,
                    'head_configuration' => '',
                    'masa_pengukuran' => $masa_pengukuran,
                    'note' => '',
                    'is_draft' => '1',
                    'is_delete_pp' => '0',
                    'is_edit' => '0',
                    'is_approved' => '-',
                    'is_rejected' => '-',
                ];
                M_Pengukuran_Punch::create($createDraftPengukuran);
            }

            session()->put('punch_id', $dataPunch->id);
            session()->put('first_id', 0);
            session()->put('masa_pengukuran', $masa_pengukuran);
            session()->put('masa_pengukuran_pre', $masa_pengukuran_pre);
            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            session()->remove('start_count');

            return redirect('/data/' . $request->segment(2) . '/pengukuran-rutin/form_pengukuran');

        } elseif ($request->segment(2) == 'dies') {        //Buat Data Pengukuran Untuk Dies
            $jmlDies = $request->jumlah_data_dies;

            session()->put('jumlah_dies', $jmlDies);

            $create_id = session('create_id');

            if ($create_id == null) {
                $dataDies = M_Dies::where([
                    'merk' => session('merk'),
                    'bulan_pembuatan' => session('bulan_pembuatan'),
                    'tahun_pembuatan' => session('tahun_pembuatan'),
                    'nama_mesin_cetak' => session('nama_mesin_cetak'),
                    'nama_produk' => session('nama_produk'),
                    'kode_produk' => session('kode_produk'),
                    'line_id' => session('line_id'),
                    'jenis' => session('jenis'),
                ])->first();
            } else {
                $dataDies = M_Dies::where('id', '=', $create_id)->first();
            }

            $updateMasaPengukuran = [
                'masa_pengukuran' => 'pengukuran awal'
            ];
            M_Dies::where('id', '=', $dataDies->id)->update($updateMasaPengukuran);

            for ($i = 1; $i <= $jmlDies; $i++) {
                $createDraftPengukuran = [
                    'dies_id' => $dataDies->id,
                    'user_id' => session('user_id'),
                    'outer_diameter' => 0,
                    'inner_diameter_1' => 0,
                    'inner_diameter_2' => 0,
                    'ketinggian_dies' => 0,
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
                M_Pengukuran_Dies::create($createDraftPengukuran);
            }

            session()->put('dies_id', $dataDies->id);
            session()->put('first_id', 0);
            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            session()->remove('start_count');

            return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/form_pengukuran');
        }
    }

    public function form_pengukuran_rutin(Request $request)
    {
        session()->remove('create_id');
        if ($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah') {
            $LabelPunch = M_Punch::leftJoin('tbl_pengukuran_punch', 'tbl_punch.id', '=', 'tbl_pengukuran_punch.punch_id')
                ->leftJoin('users', 'tbl_pengukuran_punch.user_id', '=', 'users.id')
                ->select('tbl_punch.*', 'tbl_pengukuran_punch.*', 'users.*',
                        'tbl_punch.masa_pengukuran AS punch_masa_pengukuran')
                ->where('tbl_punch.id', session('punch_id'))->first();
            $data['labelPunch'] = $LabelPunch;

            // dd($LabelPunch);

            $dataPengukuran = M_Pengukuran_Punch::where(['punch_id' => session('punch_id'), 'masa_pengukuran' => session('masa_pengukuran')])->first();
            $data['tglPengukuran'] = $dataPengukuran;

            if ($request->segment(2) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(2) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
            }

            $checkStatus = M_Pengukuran_Punch::where(['punch_id' => session('punch_id'), 'is_draft' => '1'])->count();
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
            $showPengukuranPre = M_Pengukuran_Punch::whereRaw("punch_id = " . session('punch_id') . " AND masa_pengukuran = '".session('masa_pengukuran_pre')."'". " AND id > " . $start_id)->orderBy('id')->limit(10)->get();
            $data['draftPengukuranPre'] = $showPengukuranPre;

            //menampilkan form pengukuran yang akan dibuat
            $showPengukuranAll = M_Pengukuran_Punch::whereRaw("punch_id = " . session('punch_id') . " AND masa_pengukuran = '".session('masa_pengukuran')."'". " AND id > " . $start_id)->orderBy('id')->limit(10)->get();
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

            session()->remove('start_count');
            session()->put('start_count', $count);

            return view('operator.data.form.pengukuran-punch', $data);

        } elseif ($request->segment(2) == 'dies') {
            $LabelDies = M_Dies::leftJoin('tbl_pengukuran_dies', 'tbl_dies.id', '=', 'tbl_pengukuran_dies.dies_id')
                ->leftJoin('users', 'tbl_pengukuran_dies.user_id', '=', 'users.id')
                ->where('tbl_dies.id', session('dies_id'))->first();
            $data['labelDies'] = $LabelDies;

            $dataPengukuran = M_Pengukuran_Dies::where('dies_id', '=', session('dies_id'))->first();
            $data['tglPengukuran'] = $dataPengukuran;

            $data['jenis'] = 'dies';

            $checkStatus = M_Pengukuran_Dies::where(['dies_id' => session('dies_id'), 'is_draft' => '1'])->count();
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
            $showPengukuranAll = M_Pengukuran_Dies::whereRaw('dies_id = ' . session('dies_id') . ' AND id > ' . $start_id)->orderBy('id')->limit(10)->get();
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

            return view('engineer.data.form.pengukuran-dies', $data);
        }
    }

    public function simpan_pengukuran_rutin(Request $request)
    {
        if ($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah') {
            if ($request->segment(2) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(2) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
            }

            session()->remove('count');
            session()->remove('show_id');
            session()->remove('count_num');
            if (session('jumlah_punch') <= session('page')) {
                // $last_id = $request->last_id;
                // $count_num = $request->count_num;
                // session()->put('count_num', $count_num + 1);
                session()->remove('show_id');
                session()->put('show_id', session('first_id'));
                // dd(session('show_id'));
                // $count = session('start_count') + session('count');
                // $count = session('count');
                // session()->put('count', $count);

                $update_id = $request->update_id;
                $ovl = $request->ovl;
                $cup = $request->cup;
                $wkl = $request->wkl;
                $hcf = $request->hcf;

                $i = 0;
                while ($i < count($update_id)) {
                    $createDraftPengukuran = [
                        'head_outer_diameter' => 0,
                        'neck_diameter' => 0,
                        'barrel' => 0,
                        'overall_length' => $ovl[$i],
                        'tip_diameter_1' => 0,
                        'tip_diameter_2' => 0,
                        'cup_depth' => $cup[$i],
                        'working_length' => $wkl[$i],
                    ];
                    M_Pengukuran_Punch::where('id', $update_id[$i])->update($createDraftPengukuran);
                    $i++;
                }

            } elseif (session('jumlah_punch') > session('page')) {
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
                $ovl = $request->ovl;
                $cup = $request->cup;
                $wkl = $request->wkl;
                $hcf = $request->hcf;

                $i = 0;
                while ($i < count($update_id)) {
                    // dd(count($hdo));
                    $createDraftPengukuran = [
                        'head_outer_diameter' => 0,
                        'neck_diameter' => 0,
                        'barrel' => 0,
                        'overall_length' => $ovl[$i],
                        'tip_diameter_1' => 0,
                        'tip_diameter_2' => 0,
                        'cup_depth' => $cup[$i],
                        'working_length' => $wkl[$i],
                    ];
                    M_Pengukuran_Punch::where('id', $update_id[$i])->update($createDraftPengukuran);
                    $i++;
                }
                return redirect('/data/' . $request->segment(2) . '/pengukuran-rutin/form_pengukuran');
            }
        } elseif ($request->segment(2) == 'dies') {
            $data['jenis'] = 'dies';

            session()->remove('count');
            session()->remove('show_id');
            session()->remove('count_num');
            if (session('jumlah_dies') <= session('page')) {
                // $last_id = $request->last_id;
                // $count_num = $request->count_num;
                // session()->put('count_num', $count_num + 1);
                session()->remove('show_id');
                session()->put('show_id', session('first_id'));
                // dd(session('show_id'));
                // $count = session('start_count') + session('count');
                // $count = session('count');
                // session()->put('count', $count);

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
                    M_Pengukuran_Dies::where('id', $update_id[$i])->update($createDraftPengukuran);
                    $i++;
                }
                // return redirect('/data/'.$request->segment(2).'')->with('success', 'Pengukuran Awal Selesai Dilakukan!');

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
                    M_Pengukuran_Dies::where('id', $update_id[$i])->update($createDraftPengukuran);
                    $i++;
                }
                return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/form_pengukuran');
            }
        }
    }
    public function simpan_pengukuran_rutin_interval(Request $request)
    {
        $update_id = $request->update_id;
        $ovl = $request->ovl;
        $wkl = $request->wkl;
        $cup = $request->cup;
        $hcf = $request->hcf;
        $i = 0;
        while ($i < count($update_id)) {
            $createDraftPengukuran = [
                'head_outer_diameter' => 0,
                'neck_diameter' => 0,
                'barrel' => 0,
                'overall_length' => $ovl[$i],
                'tip_diameter_1' => 0,
                'tip_diameter_2' => 0,
                'cup_depth' => $cup[$i],
                'working_length' => $wkl[$i],
                'head_configuration' => $hcf[$i],
            ];
            M_Pengukuran_Punch::where('id', $update_id[$i])->update($createDraftPengukuran);
            $i++;
        }
    }
}