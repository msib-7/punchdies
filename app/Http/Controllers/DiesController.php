<?php

namespace App\Http\Controllers;

use App\Models\Audit_tr;
use App\Models\M_Dies;
use App\Models\M_Pengukuran_Dies;
use Illuminate\Http\Request;

class DiesController extends Controller
{
    public function show_all_dies(Request $request)
    {
        $dataDies = M_Dies::
            where(['jenis' => $request->segment(2), 'is_delete_dies' => '0'])
            ->orderBy('created_at', "desc")
            ->get();
        $data['dataDies'] = $dataDies;

        $ttlDies = M_Dies::
            where(['jenis' => $request->segment(2), 'is_delete_dies' => '0'])
            ->orderBy('created_at', "desc")
            ->count();
        $data['ttlDies'] = $ttlDies;

        $data['jenis'] = 'dies';

        $dataPengukuranAll = M_Pengukuran_Dies::all();
        $data['dataPengukuran'] = $dataPengukuranAll;

        $dataPengukuran = M_Pengukuran_Dies::where(['dies_id' => session('dies_id'), 'is_draft' => '1'])->count();
        if ($dataPengukuran > 0) {
            $status = 'draft';
        }

        return view('engineer.data.dies', $data);
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
        $jenis = $request->segment(2);
        session()->remove('created_id');

        $cekDataDies = M_Dies::where([
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
            $logdate = date('Y-m-d H:i:s');
            $dataAudit = [
                'event' => 'Dies Created',
                'logdate' => $logdate,
                'user_id' => session('user_id'),
                'line' => session('line_user'),
                'category' => 'Create',
                'detail' => 'User ' . session('username') . ', Create Dies "' . $merk . '", ' . $logdate,
            ];
            session()->put($createData);
            M_Dies::create($createData);
            Audit_tr::create($dataAudit);
        } else {
            //Data Audit
            $logdate = date('Y-m-d H:i:s');
            $dataAudit = [
                'event' => 'Dies Created',
                'logdate' => $logdate,
                'user_id' => session('user_id'),
                'line' => session('line_user'),
                'category' => 'Create',
                'detail' => 'User ' . session('username') . ',Failed to Create Dies "' . $merk . '", ' . $logdate,
            ];
            Audit_tr::create($dataAudit);
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

        M_Dies::where(['id' => $id])->update($delDies);

        M_Pengukuran_Dies::where(['dies_id' => $id])->update($delPengukuran);

        return redirect('/data/'.$request->segment(2));
    }
}
