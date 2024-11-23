<?php

namespace App\Http\Controllers;

use App\Models\Audit_tr;
use App\Models\M_ApprPengukuran;
use App\Models\M_Pengukuran_Punch;
use App\Models\M_Punch;
use Illuminate\Http\Request;

class PunchController extends Controller
{
    public function show_all_punch(Request $request)
    {
        if($request->segment(2) == 'rutin'){
            // dd($request->user());
            // $dataPunch = M_Punch::
            //     where('jenis', $request->segment(3))
            //     ->where( 'is_delete_punch', '0')
            //     ->where('masa_pengukuran', '!=', '-')
            //     // ->Where('masa_pengukuran', '!=', 'pengukuran awal')
            //     ->orderBy('created_at', "desc")
            //     ->get();
            $dataPunch = M_ApprPengukuran::leftJoin('tbl_punch', 'tbl_approval_pengukuran.punch_id', '=', 'tbl_punch.id')
                ->where('jenis', $request->segment(3))
                // ->Where('masa_pengukuran', '!=', 'pengukuran awal')
                ->orderBy('tbl_approval_pengukuran.created_at', "desc")
                ->get();
            $data['dataPunch'] = $dataPunch;

            $ttlPunch = M_Punch::
                where(['jenis' => $request->segment(3), 'is_delete_punch' => '0'])
                ->orderBy('created_at', "desc")
                ->count();
            $data['ttlPunch'] = $ttlPunch;

            if ($request->segment(3) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
            } elseif ($request->segment(3) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
            }

            return view('operator.data.punch', $data);
        }elseif($request->segment(2) != 'rutin'){
            $dataPunch = M_Punch::
                where(['jenis' => $request->segment(2), 'is_delete_punch' => '0'])
                ->orderBy('created_at', "desc")
                ->get();
            $data['dataPunch'] = $dataPunch;

            $ttlPunch = M_Punch::
                where(['jenis' => $request->segment(2), 'is_delete_punch' => '0'])
                ->orderBy('created_at', "desc")
                ->count();
            $data['ttlPunch'] = $ttlPunch;

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

        $cekDataPunch = M_Punch::where([
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
            session()->put($createData);
            M_Punch::create($createData);
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

        M_Punch::where(['id' => $id])->update($delPunch);

        M_Pengukuran_Punch::where(['punch_id' => $id])->update($delPengukuran);

        if($request->segment(2) == 'rutin'){
            return redirect('/data/rutin/' . $request->segment(3));
        }elseif($request->segment(2) != 'rutin'){
            return redirect('/data/' . $request->segment(2));
        }

    }
}
