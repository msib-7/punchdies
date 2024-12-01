<?php

namespace App\Http\Controllers;

use App\Models\Lines;
use App\Models\M_Pengukuran_Punch;
use App\Models\Punch;
use DB;
use Illuminate\Http\Request;

class PunchController extends Controller
{
    public function show_all_punch(Request $request)
    {
        if($request->segment(2) == 'rutin'){
            $dataPunch = Punch::query()
                            ->select('punch_id',
                                DB::raw('MAX(merk) as merk'), 
                                DB::raw('MAX(bulan_pembuatan) as bulan_pembuatan'), 
                                DB::raw('MAX(tahun_pembuatan) as tahun_pembuatan'), 
                                DB::raw('MAX(nama_mesin_cetak) as nama_mesin_cetak'), 
                                DB::raw('MAX(nama_produk) as nama_produk'), 
                                DB::raw('MAX(kode_produk) as kode_produk'), 
                                DB::raw('MAX(jenis) as jenis'), 
                                DB::raw('MAX(masa_pengukuran) as masa_pengukuran'), 
                                DB::raw('MAX(is_delete_punch) as is_delete_punch'),
                                DB::raw('MAX(is_draft) as is_draft'),
                                DB::raw('MAX(is_edit) as is_edit'),
                                DB::raw('MAX(is_approved) as is_approved'),
                                DB::raw('MAX(is_rejected) as is_rejected'),
                                DB::raw('MAX(created_at) as created_at')
                                )
                            ->where('jenis', $request->segment(3))
                            ->where('masa_pengukuran', '!=', 'pengukuran awal')
                            ->where('masa_pengukuran', '!=', '-')
                            ->orWhere('masa_pengukuran', 'pengukuran awal')
                            ->orWhere('is_draft', '1')
                            ->where('is_delete_punch', '0')
                            ->groupBy('punch_id')
                            ->orderBy('created_at', "desc")
                            ->get();
            $data['dataPunch'] = $dataPunch;

            $ttlPunch = Punch::
                where(['jenis' => $request->segment(3), 'is_delete_punch' => '0'])
                ->orderBy('created_at', "desc")
                ->count();
            $data['ttlPunch'] = $ttlPunch;

            $Dataline = Lines::all();
            $data['DataLine'] = $Dataline;

            if ($request->segment(3) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(3) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
            }

            return view('operator.data.punch', $data);
        }elseif($request->segment(2) != 'rutin'){
            $dataPunch = Punch::query()
                ->where('jenis', $request->segment(2))
                ->where('masa_pengukuran', 'pengukuran awal')
                ->orWhere('masa_pengukuran', '-')
                ->where('is_delete_punch', '0')
                ->orderBy('created_at', "desc")
                ->get();
            $data['dataPunch'] = $dataPunch;

            $ttlPunch = Punch::
                where(['jenis' => $request->segment(2), 'is_delete_punch' => '0'])
                ->orderBy('created_at', "desc")
                ->count();
            $data['ttlPunch'] = $ttlPunch;

            $Dataline = Lines::all();
            $data['DataLine'] = $Dataline;

            if ($request->segment(2) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(2) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
            }

            return view('engineer.data.punch', $data);
        }
    }

    public function create_data(Request $request)
    {
        $Punch = new Punch();
        $merk = $request->merk;
        $bulan_pembuatan = $request->bulan_pembuatan;
        $tahun_pembuatan = $request->tahun_pembuatan;
        $nama_mesin_cetak = $request->nama_mesin_cetak;
        $nama_produk = $request->nama_produk;
        $kode_produk = $request->kode_produk;
        $line_id = $request->line_id;
        if($request->segment(2) == 'rutin'){
            $jenis = $request->segment(3);
        }elseif($request->segment(2) != 'rutin'){
            $jenis = $request->segment(2);
        }
        session()->remove('created_id');
        session()->remove('create_id');

        $autonum = $Punch->autoId(["substr(punch_id,3,6)" => date('ymd')])->first();
        if (!$autonum) {
            $id = str_shuffle("PID" . date("ymd")) . "0001";
        } else {
            $punch_id = $autonum->punch_id;
            $noUrut = (int) substr($punch_id, 9, 4);
            $noUrut++;
            $id = str_shuffle("PID" . date("ymd")) . sprintf("%04s", $noUrut);
        }

        $cekDataPunch = Punch::where([
            'merk' => $merk,
            'bulan_pembuatan' => $bulan_pembuatan,
            'tahun_pembuatan' => $tahun_pembuatan,
            'nama_mesin_cetak' => $nama_mesin_cetak,
            'nama_produk' => $nama_produk,
            'kode_produk' => $kode_produk,
            'line_id' => $line_id,
            'jenis' => $jenis,
        ])->first();
        if (!$cekDataPunch) {
            $createData = [
                'punch_id' => $id,
                'merk' => $merk,
                'bulan_pembuatan' => $bulan_pembuatan,
                'tahun_pembuatan' => $tahun_pembuatan,
                'nama_mesin_cetak' => $nama_mesin_cetak,
                'nama_produk' => $nama_produk,
                'kode_produk' => $kode_produk,
                'line_id' => $line_id,
                'jenis' => $jenis,
                'masa_pengukuran' => '-',
                'is_draft' => '1',
                'is_delete_punch' => '0',
                'is_edit' => '0',
                'is_approved' => '-',
                'is_rejected' => '-',
            ];
            //Data Audit
            $logdate = date('Y-m-d H:i:s');
            // $dataAudit = [
            //     'event' => 'Punch Created',
            //     'logdate' => $logdate,
            //     'user_id' => session('user_id'),
            //     'line' => session('line_user'),
            //     'category' => 'Create',
            //     'detail' => 'User ' . session('username') . ', Create Punch "' . $merk . '", ' . $logdate,
            // ];
            session()->put('punch_id', $id);
            Punch::create($createData);
            // Audit_tr::create($dataAudit);
        } else {
            //Data Audit
            $logdate = date('Y-m-d H:i:s');
            // $dataAudit = [
            //     'event' => 'Punch Created',
            //     'logdate' => $logdate,
            //     'user_id' => session('user_id'),
            //     'line' => session('line_user'),
            //     'category' => 'Create',
            //     'detail' => 'User ' . session('username') . ',Failed to Create Punch "' . $merk . '", ' . $logdate,
            // ];
            // Audit_tr::create($dataAudit);
        }
    }

    public function delete_data(Request $request, $id)
    {

        $delPunch = [
            'is_delete_punch' => '1',
        ];
        $delPengukuran = [
            'is_delete_pp' => '1',
        ];

        Punch::where(['punch_id' => $id])->update($delPunch);

        M_Pengukuran_Punch::where(['punch_id' => $id])->update($delPengukuran);

        if($request->segment(2) == 'rutin'){
            return redirect('/data/rutin/' . $request->segment(3));
        }elseif($request->segment(2) != 'rutin'){
            return redirect('/data/' . $request->segment(2));
        }

    }
}
