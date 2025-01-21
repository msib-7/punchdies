<?php

namespace App\Http\Controllers;

use App\Models\Dies;
use App\Models\Lines;
use App\Models\Punch;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // $data = $request->session()->all();
        // dd($data);
        $selectedLineId = $request->input('line_id');

        // Define a method to fetch punch data
        $getPunchData = function ($type) use ($selectedLineId) {
            return Punch::query()
                ->select(
                    'punch_id',
                    DB::raw('MAX(merk) as merk'),
                    DB::raw('MAX(bulan_pembuatan) as bulan_pembuatan'),
                    DB::raw('MAX(tahun_pembuatan) as tahun_pembuatan'),
                    DB::raw('MAX(nama_mesin_cetak) as nama_mesin_cetak'),
                    DB::raw('MAX(nama_produk) as nama_produk'),
                    DB::raw('MAX(jenis) as jenis'),
                    DB::raw('MAX(line_id) as line_id'),
                    DB::raw('MAX(is_delete_punch) as is_delete_punch')
                )
                ->where('jenis', $type)
                ->where('is_delete_punch', 0)
                ->when($selectedLineId, function ($query) use ($selectedLineId) {
                    return $query->where('line_id', $selectedLineId);
                })
                ->groupBy('punch_id')
                ->get();
        };

        // Get all data
        $dataPunchAtas = $getPunchData('punch-atas');
        $dataPunchBawah = $getPunchData('punch-bawah');

        // Get all data for Dies
        $dataDies = Dies::query()
            ->select(
                'dies_id',
                DB::raw('MAX(merk) as merk'),
                DB::raw('MAX(bulan_pembuatan) as bulan_pembuatan'),
                DB::raw('MAX(tahun_pembuatan) as tahun_pembuatan'),
                DB::raw('MAX(nama_mesin_cetak) as nama_mesin_cetak'),
                DB::raw('MAX(nama_produk) as nama_produk'),
                DB::raw('MAX(jenis) as jenis'),
                DB::raw('MAX(line_id) as line_id'),
                DB::raw('MAX(is_delete_dies) as is_delete_dies')
            )
            ->where('jenis', 'dies')
            ->where('is_delete_dies', 0)
            ->when($selectedLineId, function ($query) use ($selectedLineId) {
                return $query->where('line_id', $selectedLineId);
            })
            ->groupBy('dies_id')
            ->get();

        $draftCount = $this->isDraft($selectedLineId);
        $waitingCount = $this->isWaiting($selectedLineId);
        $approvedCount = $this->isApproved($selectedLineId);
        // Get lines excluding 'All Line'
        $lines = Lines::where('nama_line', '!=', 'All Line')->get();
        $uri = 'dashboard';

        if ($request->ajax()) {
            return view('partials.dashboard_content', compact('dataPunchAtas', 'dataPunchBawah', 'dataDies', 'lines', 'uri', 'draftCount', 'waitingCount', 'approvedCount'));
        }

        return view("dashboard", compact('dataPunchAtas', 'dataPunchBawah', 'dataDies', 'lines', 'uri', 'draftCount', 'waitingCount', 'approvedCount'));
    }

    private function isDraft($selectedLineId)
    {
        // Count draft Punch items
        $isDraftPunch = Punch::where(['is_draft' => '1', 'is_delete_punch' => '0'])
            ->when($selectedLineId, function ($query) use ($selectedLineId) {
                return $query->where('line_id', $selectedLineId);
            })
            ->get();

        // Count draft Dies items
        $isDraftDies = Dies::where(['is_draft' => '1', 'is_delete_dies' => '0'])
            ->when($selectedLineId, function ($query) use ($selectedLineId) {
                return $query->where('line_id', $selectedLineId);
            })
            ->get();

        // Count total draft items
        $totalDraftCount = count($isDraftPunch) + count($isDraftDies);


        $pengukuranAwalPunch = $isDraftPunch->where('masa_pengukuran', 'pengukuran awal')->count();
        $pengukuranAwalDies = $isDraftDies->where('masa_pengukuran', 'pengukuran awal')->count();
        // Count draft Punch items where masa_pengukuran is 'pengukuran awal'
        $draftPengukuranAwalCount = $pengukuranAwalPunch + $pengukuranAwalDies;

        $pengukuranRutinPunch = $isDraftPunch->where('masa_pengukuran','!=', 'pengukuran awal')->count();
        $pengukuranRutinDies = $isDraftDies->where('masa_pengukuran','!=', 'pengukuran awal')->count();
        // Count draft Punch items where masa_pengukuran is 'pengukuran rutin'
        $draftPengukuranRutinCount = $pengukuranRutinPunch + $pengukuranRutinDies;


        // Return total draft count and counts for 'pengukuran awal'
        return [
            'draftCount' => $totalDraftCount,
            'draftPengukuranAwalCount' => $draftPengukuranAwalCount,
            'draftPengukuranRutinCount' => $draftPengukuranRutinCount,
        ];
    }

    private function isWaiting($selectedLineId)
    {
        $isWaitingPunch = Punch::where('is_draft', '0')
            ->where('is_delete_punch', '0')
            ->where('is_approved' ,'!=', '1') // Adjust the column name and value as necessary
            ->when($selectedLineId, function ($query) use ($selectedLineId) {
                return $query->where('line_id', $selectedLineId);
            })
            ->get();
        $isWaitingDies = Dies::where('is_draft', '0')
            ->where('is_delete_dies', '0')
            ->where('is_approved', '!=', '1') // Adjust the column name and value as necessary
            ->when($selectedLineId, function ($query) use ($selectedLineId) {
                return $query->where('line_id', $selectedLineId);
            })
            ->get();

        // Count total draft items
        $totalWaitingCount = count($isWaitingPunch) + count($isWaitingDies);


        $pengukuranAwalPunch = $isWaitingPunch->where('masa_pengukuran', 'pengukuran awal')->count();
        $pengukuranAwalDies = $isWaitingDies->where('masa_pengukuran', 'pengukuran awal')->count();
        // Count draft Punch items where masa_pengukuran is 'pengukuran awal'
        $waitingPengukuranAwalCount = $pengukuranAwalPunch + $pengukuranAwalDies;

        $pengukuranRutinPunch = $isWaitingPunch->where('masa_pengukuran', '!=', 'pengukuran awal')->count();
        $pengukuranRutinDies = $isWaitingDies->where('masa_pengukuran', '!=', 'pengukuran awal')->count();
        // Count draft Punch items where masa_pengukuran is 'pengukuran rutin'
        $waitingPengukuranRutinCount = $pengukuranRutinPunch + $pengukuranRutinDies;

        // Count items with waiting status
        return [
            'waitingCount' => $totalWaitingCount,
            'waitingPengukuranAwalCount' => $waitingPengukuranAwalCount,
            'waitingPengukuranRutinCount' => $waitingPengukuranRutinCount,
        ];
    }
    private function isApproved($selectedLineId)
    {
        $isApprovedPunch = Punch::where([
            'is_draft' => '0',
            'is_delete_punch' => '0',
            'is_approved' => '1'
            ]) // Adjust the column name and value as necessary
            ->when($selectedLineId, function ($query) use ($selectedLineId) {
                return $query->where('line_id', $selectedLineId);
            })
            ->get();
        $isApprovedDies = Dies::where([
            'is_draft' => '0',
            'is_delete_dies' => '0',
            'is_approved' => '1'
            ]) // Adjust the column name and value as necessary
            ->when($selectedLineId, function ($query) use ($selectedLineId) {
                return $query->where('line_id', $selectedLineId);
            })
            ->get();

        // Count total draft items
        $totalApprovedCount = count($isApprovedPunch) + count($isApprovedDies);

        $pengukuranAwalPunch = $isApprovedPunch->where('masa_pengukuran', 'pengukuran awal')->count();
        $pengukuranAwalDies = $isApprovedDies->where('masa_pengukuran', 'pengukuran awal')->count();
        // Count draft Punch items where masa_pengukuran is 'pengukuran awal'
        $approvedPengukuranAwalCount = $pengukuranAwalPunch + $pengukuranAwalDies;

        $pengukuranRutinPunch = $isApprovedPunch->where('masa_pengukuran', '!=', 'pengukuran awal')->count();
        $pengukuranRutinDies = $isApprovedDies->where('masa_pengukuran', '!=', 'pengukuran awal')->count();
        // Count draft Punch items where masa_pengukuran is 'pengukuran rutin'
        $approvedPengukuranRutinCount = $pengukuranRutinPunch + $pengukuranRutinDies;

        // Count items with waiting status
        return [
            'approvedCount' => $totalApprovedCount,
            'approvedPengukuranAwalCount' => $approvedPengukuranAwalCount,
            'approvedPengukuranRutinCount' => $approvedPengukuranRutinCount,
        ];
    }
}
