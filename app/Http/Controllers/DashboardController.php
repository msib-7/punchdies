<?php

namespace App\Http\Controllers;

use App\Models\Dies;
use App\Models\Punch;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //Get All Data Punch Atas
        //Menampilkan dan Menggabungkan Data yang memiliki Punch_id yang sama
        $dataPunchAtas = Punch::query()
            ->select(
                'punch_id',
                DB::raw('MAX(merk) as merk'),
                DB::raw('MAX(bulan_pembuatan) as bulan_pembuatan'),
                DB::raw('MAX(tahun_pembuatan) as tahun_pembuatan'),
                DB::raw('MAX(nama_mesin_cetak) as nama_mesin_cetak'),
                DB::raw('MAX(nama_produk) as nama_produk'),
                DB::raw('MAX(jenis) as jenis'),
                DB::raw('MAX(is_delete_punch) as is_delete_punch')
            )
            ->where('jenis', 'punch-atas')
            ->where('is_delete_punch', 0)
            ->groupBy('punch_id')
            ->get();

        $data['dataPunchAtas'] = $dataPunchAtas;

        //Get All Data Puch Bawah
        $dataPunchBawah = Punch::where(['jenis' => 'punch-bawah', 'is_delete_punch' => '0'])->get();
        $data['dataPunchBawah'] = $dataPunchBawah;

        //Total Punch
        $totalPunch = Punch::where('is_delete_punch', '0')->count();
        $data['totalPunch'] = $totalPunch;

        //Get All Data Dies
        $dataDies = Dies::where(['jenis' => 'dies', 'is_delete_dies' => '0'])->get();
        $data['dataDies'] = $dataDies;

        //Total Dies
        $totalDies = Dies::where('is_delete_dies', '0')->count();
        $data['totalDies'] = $totalDies;

        $data['uri'] = 'dashboard';

        return view("admin.dashboard", $data);
    }
}
