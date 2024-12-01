<?php

namespace App\Http\Controllers;

use App\Models\Audit_tr;
use App\Models\Dies;
use App\Models\M_Dies;
use App\Models\M_Pengukuran_Dies;
use App\Models\PengukuranAwalDies;
use Illuminate\Http\Request;

class DiesController extends Controller
{
    public function show_all_dies(Request $request)
    {
        $dataDies = Dies::
            where(['jenis' => $request->segment(2), 'is_delete_dies' => '0'])
            ->orderBy('created_at', "desc")
            ->get();
        $data['dataDies'] = $dataDies;

        $ttlDies = Dies::
            where(['jenis' => $request->segment(2), 'is_delete_dies' => '0'])
            ->orderBy('created_at', "desc")
            ->count();
        $data['ttlDies'] = $ttlDies;

        $data['jenis'] = 'dies';

        $dataPengukuranAll = PengukuranAwalDies::all();
        $data['dataPengukuran'] = $dataPengukuranAll;

        $dataPengukuran = PengukuranAwalDies::where(['dies_id' => session('dies_id'), 'is_draft' => '1'])->count();
        if ($dataPengukuran > 0) {
            $status = 'draft';
        }

        return view('engineer.data.dies', $data);
    }

    public function create_data(Request $request)
    {
        $Dies = new Dies();
        $merk = $request->merk;
        $bulan_pembuatan = $request->bulan_pembuatan;
        $tahun_pembuatan = $request->tahun_pembuatan;
        $nama_mesin_cetak = $request->nama_mesin_cetak;
        $nama_produk = $request->nama_produk;
        $kode_produk = $request->kode_produk;
        $line_id = $request->line_id;
        $jenis = $request->segment(2);

        session()->remove('created_id');
        session()->remove('create_id');

        $autonum = $Dies->autoId(["substr(dies_id,3,6)" => date('ymd')])->first();
        if (!$autonum) {
            $id = str_shuffle("DIS" . date("ymd")) . "0001";
        } else {
            $dies_id = $autonum->dies_id;
            $noUrut = (int) substr($dies_id, 9, 4);
            $noUrut++;
            $id = str_shuffle("DIS" . date("ymd")) . sprintf("%04s", $noUrut);
        }

        $cekDataDies = Dies::where([
            'merk' => $merk,
            'bulan_pembuatan' => $bulan_pembuatan,
            'tahun_pembuatan' => $tahun_pembuatan,
            'nama_mesin_cetak' => $nama_mesin_cetak,
            'nama_produk' => $nama_produk,
            'kode_produk' => $kode_produk,
            'line_id' => $line_id,
            'jenis' => $jenis,
        ])->first();
        if (!$cekDataDies) {
            $createData = [
                'dies_id' => $id,
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
                'is_delete_dies' => '0',
                'is_edit' => '0',
                'is_approved' => '-',
                'is_rejected' => '-',
            ];
            //Data Audit
            // $logdate = date('Y-m-d H:i:s');
            // $dataAudit = [
            //     'event' => 'Dies Created',
            //     'logdate' => $logdate,
            //     'user_id' => session('user_id'),
            //     'line' => session('line_user'),
            //     'category' => 'Create',
            //     'detail' => 'User ' . session('username') . ', Create Dies "' . $merk . '", ' . $logdate,
            // ];
            session()->put('dies_id', $id);
            Dies::create($createData);
            // Audit_tr::create($dataAudit);
        } else {
            //Data Audit
            // $logdate = date('Y-m-d H:i:s');
            // $dataAudit = [
            //     'event' => 'Dies Created',
            //     'logdate' => $logdate,
            //     'user_id' => session('user_id'),
            //     'line' => session('line_user'),
            //     'category' => 'Create',
            //     'detail' => 'User ' . session('username') . ',Failed to Create Dies "' . $merk . '", ' . $logdate,
            // ];
            // Audit_tr::create($dataAudit);
        }
    }

    public function delete_data(Request $request, $id)
    {

        $delDies = [
            'is_delete_dies' => '1',
        ];
        $delPengukuran = [
            'is_delete_pd' => '1',
        ];

        Dies::where(['dies_id' => $id])->update($delDies);

        PengukuranAwalDies::where(['dies_id' => $id])->update($delPengukuran);

        return redirect('/data/'.$request->segment(2));
    }
}
