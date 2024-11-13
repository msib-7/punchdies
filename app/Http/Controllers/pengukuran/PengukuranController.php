<?php

namespace App\Http\Controllers\pengukuran;

use App\Http\Controllers\Controller;
use App\Models\Audit_tr;
use App\Models\M_Pengukuran_Punch;
use App\Models\M_Punch;
use Illuminate\Http\Request;

class PengukuranController extends Controller
{
    public function create_data_punch(Request $request)
    {
        $merk = $request->merk;
        $bulan_pembuatan = $request->bulan_pembuatan;
        $tahun_pembuatan = $request->tahun_pembuatan;
        $nama_mesin_cetak = $request->nama_mesin_cetak;
        $nama_produk = $request->nama_produk;
        $kode_produk = $request->kode_produk;
        $line_id = $request->line_id;
        $jenis_punch = $request->segment(2);

        $cekDataPunch = M_Punch::where([
                                        'merk' => $merk, 
                                        'bulan_pembuatan' => $bulan_pembuatan,
                                        'tahun_pembuatan' => $tahun_pembuatan,
                                        'nama_mesin_cetak' => $nama_mesin_cetak,
                                        'nama_produk' => $nama_produk,
                                        'kode_produk' => $kode_produk,
                                        'line_id' => $line_id,
                                        'jenis' => $jenis_punch,
                                        ])->first();
        if (!$cekDataPunch) {
            $createData = [
                'merk' => $merk,
                'bulan_pembuatan' => $bulan_pembuatan,
                'tahun_pembuatan' => $tahun_pembuatan,
                'nama_mesin_cetak' => $nama_mesin_cetak,
                'nama_produk' => $nama_produk,
                'kode_produk' => $kode_produk,
                'line_id' => $line_id,
                'jenis' => $jenis_punch,
            ];

            //Data Audit
            $logdate = date('Y-m-d H:i:s');
            $dataAudit = [
                'event' => 'Punch Created',
                'logdate' => $logdate,
                'user_id' => session('user_id'),
                'line' => session('line_user'),
                'category' => 'Create',
                'detail' => 'User ' . session('username') . ', Create Punch "' . $merk . '", ' . $logdate,
            ];

            session()->put($createData);
            M_Punch::create($createData);
            Audit_tr::create($dataAudit);
        } else {
            //Data Audit
            $logdate = date('Y-m-d H:i:s');
            $dataAudit = [
                'event' => 'Punch Created',
                'logdate' => $logdate,
                'user_id' => session('user_id'),
                'line' => session('line_user'),
                'category' => 'Create',
                'detail' => 'User ' . session('username') . ',Failed to Create Punch "' . $merk . '", ' . $logdate,
            ];
            Audit_tr::create($dataAudit);
        }
    }

    public function create_data_pengukuran_awal(Request $request)
    {
        $jmlPunch = $request->jumlah_data_punch;

        session()->put('jumlah_punch', $jmlPunch);

        $dataPunch = M_Punch::where([
                                    'merk'=> session('merk'), 
                                    'bulan_pembuatan' => session('bulan_pembuatan'),
                                    'tahun_pembuatan' => session('tahun_pembuatan'),
                                    'nama_mesin_cetak' => session('nama_mesin_cetak'),
                                    'nama_produk' => session('nama_produk'),
                                    'kode_produk' => session('kode_produk'),
                                    'line_id' => session('line_id'),
                                    'jenis' => session('jenis'),
                                ])->first();

        for($i = 1; $i <= $jmlPunch; $i++) {
            $createDraftPengukuran = [
                'punch_id' => $dataPunch->id,
                'user_id' => session('user_id'),
                'head_outer_diameter' => 0,
                'neck_diameter' => 0,
                'barrel' => 0,
                'overall_length' => 0,
                'tip_diameter_1' => 0,
                'tip_diameter_2' => 0,
                'cup_depth' => 0,
                'working_length' => 0,
                'head_configuration' => '',
                'masa_pengukuran' => 'pengukuran awal',
                'note' => '',
                'is_draft' => '1',
                'is_delete_pp' => '0',
                'is_edit' => '0',
            ];
            M_Pengukuran_Punch::create($createDraftPengukuran);
        }

        session()->put('punch_id', $dataPunch->id);
        return redirect('/data/punch-atas/pengukuran-awal/view_pengukuran');
    }

    public function view_form_pengukuran()
    {
        $ArrayPengukuran = [];
        $showPengukuranAll = M_Pengukuran_Punch::where(['punch_id' => session('punch_id')])
                                                    ->whereAny([
                                                        'head_outer_diameter',
                                                        'neck_diameter',
                                                        'barrel',
                                                        'overall_length',
                                                        'tip_diameter_1',
                                                        'tip_diameter_2',
                                                        'cup_depth',
                                                        'working_length',
                                                    ], '=', 0)->limit(10)->get();
        $ArrayPengukuran[] = $showPengukuranAll;
        $data['draftPengukuran'] = $showPengukuranAll;
        $data['count'] = count($showPengukuranAll);
        return view('engineer.data.form.pengukuran', $data);
        // dd($dataPengukuranPunch );
    }
}