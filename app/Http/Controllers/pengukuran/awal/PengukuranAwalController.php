<?php

namespace App\Http\Controllers\pengukuran\awal;

use App\Http\Controllers\Controller;
use App\Models\Dies;
use App\Models\M_ApprDisposal;
use App\Models\M_ApprPengukuran;
use App\Models\PengukuranAwalDies;
use App\Models\PengukuranAwalPunch;
use App\Models\Punch;
use Illuminate\Http\Request;

class PengukuranAwalController extends Controller
{
    public function create_data_pengukuran_awal(Request $request)
    {
        //Buat Data Pengukuran Untuk Punch
        if ($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah') {
            $jmlPunch = $request->jumlah_data_punch;

            session()->put('jumlah_punch', $jmlPunch);

            $create_id = session('create_id');

            if ($create_id == null) {
                $dataPunch = Punch::where([
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
                $dataPunch = Punch::where('id', '=', $create_id)->first();
            }

            $updateMasaPengukuran = [
                'masa_pengukuran' => 'pengukuran awal'
            ];
            Punch::where('id', '=', $dataPunch->id)->update($updateMasaPengukuran);

            for ($i = 1; $i <= $jmlPunch; $i++) {
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
                PengukuranAwalPunch::create($createDraftPengukuran);
            }

            session()->put('punch_id', $dataPunch->id);
            session()->put('first_id', 0);
            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            session()->remove('start_count');

            return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/form_pengukuran');

        } elseif ($request->segment(2) == 'dies') {        //Buat Data Pengukuran Untuk Dies
            $jmlDies = $request->jumlah_data_dies;

            session()->put('jumlah_dies', $jmlDies);

            $create_id = session('create_id');

            if ($create_id == null) {
                $dataDies = Dies::where([
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
                $dataDies = Dies::where('id', '=', $create_id)->first();
            }

            $updateMasaPengukuran = [
                'masa_pengukuran' => 'pengukuran awal'
            ];
            Dies::where('id', '=', $dataDies->id)->update($updateMasaPengukuran);

            for ($i = 1; $i <= $jmlDies; $i++) {
                $createDraftPengukuran = [
                    'dies_id' => $dataDies->id,
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
        if ($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah') {
            $showPengukuranAll = PengukuranAwalPunch::where('punch_id', '=', $id)->get();

            if (count($showPengukuranAll) == 0) {
                return redirect('/data/' . $request->segment(2) . '')->with('error', 'Data Pengukuran Tidak ditemukan silahkan Buat Pengukuran!');
            } else {
                session()->remove('count_num');
                session()->put('punch_id', $request->segment(5));
                return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/view_pengukuran/' . session('punch_id'));
            }
        } elseif ($request->segment(2) == 'dies') {
            $showPengukuranAll = PengukuranAwalDies::where('dies_id', '=', $id)->get();

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
        if ($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah') {
            if ($request->segment(2) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(2) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
            }

            $cekDraft = Punch::where('id', '=', $id)->first();
            if ($cekDraft->is_draft == '1') {
                session()->remove('jumlah_punch');
                session()->remove('punch_id');
                session()->remove('count');
                session()->remove('show_id');
                session()->remove('start_count');
                session()->put('first_id', 0);
                session()->put('punch_id', $id);

                $jumlahPunch = PengukuranAwalPunch::where('punch_id', '=', $id)->count();
                session()->put('jumlah_punch', $jumlahPunch);

                return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/form_pengukuran');
            } else {
                // session()->remove('count');
                $LabelPunch = Punch::leftJoin('pengukuran_awal_punchs', 'punchs.id', '=', 'pengukuran_awal_punchs.punch_id')
                    ->leftJoin('users', 'pengukuran_awal_punchs.user_id', '=', 'users.id')
                    ->where('punchs.id', $id)->first();
                $data['labelPunch'] = $LabelPunch;

                $dataPengukuran = PengukuranAwalPunch::where('punch_id', '=', $id)->first();
                $data['tglPengukuran'] = $dataPengukuran;

                $checkStatus = PengukuranAwalPunch::where(['punch_id' => $id, 'is_draft' => '1'])->count();
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
                $showPengukuranAll = PengukuranAwalPunch::where('punch_id', '=', $id)->get();

                $data['dataPengukuran'] = $showPengukuranAll;
                return view('engineer.data.view.pengukuran-punch', $data);
            }
        } elseif ($request->segment(2) == 'dies') {
            $data['jenis'] = 'dies';

            $cekDraft = Dies::where('id', '=', $id)->first();
            if ($cekDraft->is_draft == '1') {
                session()->remove('jumlah_dies');
                session()->remove('dies_id');
                session()->remove('count');
                session()->remove('show_id');
                session()->remove('start_count');
                session()->put('first_id', 0);
                session()->put('dies_id', $id);

                $jumlahDies = PengukuranAwalDies::where('dies_id', '=', $id)->count();
                session()->put('jumlah_dies', $jumlahDies);

                return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/form_pengukuran');
            } else {
                // session()->remove('count');
                $LabelDies = Dies::leftJoin('pengukuran_awal_diess', 'diess.id', '=', 'pengukuran_awal_diess.dies_id')
                    ->leftJoin('users', 'pengukuran_awal_diess.user_id', '=', 'users.id')
                    ->where('diess.id', $id)->first();
                $data['labelDies'] = $LabelDies;

                $dataPengukuran = PengukuranAwalDies::where('dies_id', '=', $id)->first();
                $data['tglPengukuran'] = $dataPengukuran;

                $checkStatus = PengukuranAwalDies::where(['dies_id' => $id, 'is_draft' => '1'])->count();
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
                $showPengukuranAll = PEngukuranAwalDies::where('dies_id', '=', $id)->get();

                $data['dataPengukuran'] = $showPengukuranAll;
                return view('engineer.data.view.pengukuran-dies', $data);
            }
        }
    }
    public function form_pengukuran(Request $request)
    {
        session()->remove('create_id');
        if ($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah') {
            $LabelPunch = Punch::leftJoin('pengukuran_awal_punchs', 'punchs.id', '=', 'pengukuran_awal_punchs.punch_id')
                ->leftJoin('users', 'pengukuran_awal_punchs.user_id', '=', 'users.id')
                ->where('punchs.id', session('punch_id'))->first();
            $data['labelPunch'] = $LabelPunch;

            $dataPengukuran = PengukuranAwalPunch::where('punch_id', '=', session('punch_id'))->first();
            $data['tglPengukuran'] = $dataPengukuran;

            if ($request->segment(2) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(2) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
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
            $showPengukuranAll = PengukuranAwalPunch::whereRaw('punch_id = ' . session('punch_id') . ' AND id > ' . $start_id)->orderBy('id')->limit(10)->get();
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

        } elseif ($request->segment(2) == 'dies') {
            $LabelDies = Dies::leftJoin('pengukuran_awal_diess', 'diess.id', '=', 'pengukuran_awal_diess.dies_id')
                ->leftJoin('users', 'pengukuran_awal_diess.user_id', '=', 'users.id')
                ->where('diess.id', session('dies_id'))->first();
            $data['labelDies'] = $LabelDies;

            $dataPengukuran = PengukuranAwalDies::where('dies_id', '=', session('dies_id'))->first();
            $data['tglPengukuran'] = $dataPengukuran;

            $data['jenis'] = 'dies';

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
            $showPengukuranAll = PengukuranAwalDies::whereRaw('dies_id = ' . session('dies_id') . ' AND id > ' . $start_id)->orderBy('id')->limit(10)->get();
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
                    PengukuranAwalPunch::where('id', $update_id[$i])->update($createDraftPengukuran);
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
                    PengukuranAwalPunch::where('id', $update_id[$i])->update($createDraftPengukuran);
                    $i++;
                }
                return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/form_pengukuran');
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
                    PengukuranAwalDies::where('id', $update_id[$i])->update($createDraftPengukuran);
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
                    PengukuranAwalDies::where('id', $update_id[$i])->update($createDraftPengukuran);
                    $i++;
                }
                return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/form_pengukuran');
            }
        }
    }

    public function add_note_pa(Request $request)
    {
        if ($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah') {
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
            PengukuranAwalPunch::where([
                'punch_id' => session('punch_id'),
                'masa_pengukuran' => 'pengukuran awal'
            ])->update($createDraftPengukuran);

            return redirect('/data/' . $request->segment(2) . '/pengukuran-awal/set-status');
        } elseif ($request->segment(2) == 'dies') {
            $data['jenis'] = 'dies';

            session()->remove('show_id');
            session()->remove('count');
            session()->remove('count_num');
            $note = $request->note;
            $createDraftPengukuran = [
                'note' => $note,
            ];
            PengukuranAwalDies::where([
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

        if ($request->segment(2) == 'punch-atas' or $request->segment(2) == 'punch-bawah') {
            $getData = PengukuranAwalPunch::where([
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

            $cekStatus = PengukuranAwalPunch::where([
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

                Punch::where('id', '=', session('punch_id'))->update($updateStatus);
                $this->send_to_approval($request->segment(2));
            }
            // dd($cekStatus);

            return redirect('/data/' . $request->segment(2))->with($alert, $msg);

        } elseif ($request->segment(2) == 'dies') {
            $getData = PengukuranAwalDies::where([
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

            $cekStatus = PengukuranAwalDies::where([
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

                Dies::where('id', '=', session('dies_id'))->update($updateStatus);
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

        if ($jenis == 'punch-atas' or $jenis == 'punch-bawah') {
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

        } elseif ($jenis == 'dies') {
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
}
