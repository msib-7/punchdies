<?php

namespace App\Http\Controllers;

use App\Models\Dies;
use App\Models\KodeProduk;
use App\Models\Lines;
use App\Models\Mesin;
use App\Models\NamaProduk;
use App\Models\PengukuranAwalDies;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class DiesController extends Controller
{
    public function show_all_dies(Request $request)
    {
        if ($request->segment(2) == 'pengukuran-rutin') {
            if (auth()->user()->lines->nama_line == 'All Line') {
                $dataDies = Dies::query()->with('kode_produks')->with('nama_produks')
                    ->select(
                        'dies_id',
                        DB::raw('MAX(merk) as merk'),
                        DB::raw('MAX(bulan_pembuatan) as bulan_pembuatan'),
                        DB::raw('MAX(tahun_pembuatan) as tahun_pembuatan'),
                        DB::raw('MAX(nama_mesin_cetak) as nama_mesin_cetak'),
                        DB::raw('MAX(nama_produk::text) as nama_produk'),
                        DB::raw('MAX(kode_produk::text) as kode_produk'),
                        DB::raw('MAX(jenis) as jenis'),
                        DB::raw('MAX(masa_pengukuran) as masa_pengukuran'),
                        DB::raw('MAX(is_delete_dies) as is_delete_dies'),
                        DB::raw('MAX(is_draft) as is_draft'),
                        DB::raw('MAX(is_waiting) as is_waiting'),
                        DB::raw('MAX(is_edit) as is_edit'),
                        DB::raw('MAX(is_approved) as is_approved'),
                        DB::raw('MAX(is_rejected) as is_rejected'),
                        DB::raw('MAX(created_at) as created_at'),
                        DB::raw('MAX(next_pengukuran) as next_pengukuran'),
                    )
                    ->where(function ($query) use ($request) {
                        $query->where('jenis', $request->segment(3))
                            ->where('is_delete_dies', '0')
                            ->where(function ($query) {
                                $query
                                    ->where(function ($query) {
                                        $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                            ->where('is_approved', '=', '-');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->where('masa_pengukuran', '=', 'pengukuran awal')
                                            ->where('is_draft', '=', '0')
                                            ->where('is_approved', '=', '0');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                            ->where('is_draft', '1')
                                            ->where('is_approved', '=', '-');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                            ->where('is_draft', '0')
                                            ->where('is_approved', '=', '-');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                            ->where('is_draft', '0')
                                            ->where('is_approved', '=', '1');
                                    });
                            })
                            ->orWhere('jenis', $request->segment(3))
                            ->where('is_delete_dies', '0')
                            ->where(function ($query) {
                                $query->where(function ($query) {
                                    $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                        ->where('is_approved', '=', '0');
                                })
                                    ->orWhere(function ($query) {
                                        $query->where('masa_pengukuran', '=', 'pengukuran awal')
                                            ->where('is_approved', '=', '1');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->where('masa_pengukuran', '!=', 'pengukuran awal')
                                            ->where('is_draft', '0')
                                            ->where('is_approved', '=', '1');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                            ->where('is_draft', '1')
                                            ->where('is_approved', '=', '-');
                                    });
                            });
                    })
                    ->groupBy('dies_id')
                    ->orderBy('created_at', "desc")
                    ->get();
            } else {
                $dataDies = Dies::query()->with('kode_produks')->with('nama_produks')
                    ->select(
                        'dies_id',
                        DB::raw('MAX(merk) as merk'),
                        DB::raw('MAX(bulan_pembuatan) as bulan_pembuatan'),
                        DB::raw('MAX(tahun_pembuatan) as tahun_pembuatan'),
                        DB::raw('MAX(nama_mesin_cetak) as nama_mesin_cetak'),
                        DB::raw('MAX(nama_produk::text) as nama_produk'),
                        DB::raw('MAX(kode_produk::text) as kode_produk'),
                        DB::raw('MAX(jenis) as jenis'),
                        DB::raw('MAX(masa_pengukuran) as masa_pengukuran'),
                        DB::raw('MAX(is_delete_dies) as is_delete_dies'),
                        DB::raw('MAX(is_draft) as is_draft'),
                        DB::raw('MAX(is_waiting) as is_waiting'),
                        DB::raw('MAX(is_edit) as is_edit'),
                        DB::raw('MAX(is_approved) as is_approved'),
                        DB::raw('MAX(is_rejected) as is_rejected'),
                        DB::raw('MAX(created_at) as created_at'),
                        DB::raw('MAX(next_pengukuran) as next_pengukuran'),
                    )
                    ->where(function ($query) use ($request) {
                        $query->where('jenis', $request->segment(3))
                            ->where('line_id', auth()->user()->line_id)
                            ->where('is_delete_dies', '0')
                            ->where(function ($query) {
                                $query
                                    ->where(function ($query) {
                                        $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                            ->where('is_approved', '=', '-');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->where('masa_pengukuran', '=', 'pengukuran awal')
                                            ->where('is_draft', '=', '0')
                                            ->where('is_approved', '=', '0');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                            ->where('is_draft', '1')
                                            ->where('is_approved', '=', '-');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                            ->where('is_draft', '0')
                                            ->where('is_approved', '=', '-');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                            ->where('is_draft', '0')
                                            ->where('is_approved', '=', '1');
                                    });
                            })
                            ->orWhere('jenis', 'dies')
                            ->where('is_delete_dies', '0')
                            ->where(function ($query) {
                                $query->where(function ($query) {
                                    $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                        ->where('is_approved', '=', '0');
                                })
                                    ->orWhere(function ($query) {
                                        $query->where('masa_pengukuran', '=', 'pengukuran awal')
                                            ->where('is_approved', '=', '1');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->where('masa_pengukuran', '!=', 'pengukuran awal')
                                            ->where('is_draft', '0')
                                            ->where('is_approved', '=', '1');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                            ->where('is_draft', '1')
                                            ->where('is_approved', '=', '-');
                                    });
                            });
                    })
                    ->groupBy('dies_id')
                    ->orderBy('created_at', "desc")
                    ->latest()
                    ->get();
            }
            // Separate dataDies into two collections
            $oneYearAgo = Carbon::now()->subYear();
            $dataDiesOlderThanOneYear = $dataDies->filter(function ($dies) use ($oneYearAgo) {
                return $dies->created_at <= $oneYearAgo;
            });

            $dataDiesRecent = $dataDies->filter(function ($dies) use ($oneYearAgo) {
                return $dies->created_at >= $oneYearAgo;
            });

            // Add the separated data to the data array
            $data['dataDiesOlderThanOneYear'] = $dataDiesOlderThanOneYear;
            $data['dataDiesRecent'] = $dataDiesRecent;
            // $data['dataDies'] = $dataDies;
            // dd($dataDies);

            $ttlDies = Dies::
                where(['jenis' => $request->segment(3), 'is_delete_dies' => '0'])
                ->orderBy('created_at', "desc")
                ->count();
            $data['ttlDies'] = $ttlDies;

            $data['DataMesin'] = Mesin::select('id', 'title')->get();
            $data['DataNamaProduk'] = NamaProduk::select('id', 'title')->get();
            $data['DataKodeProduk'] = KodeProduk::select('id', 'title')->get();
            $Dataline = Lines::where('nama_line', '!=', 'All Line')->get();
            $data['DataLine'] = $Dataline;

            $data['jenis'] = 'dies';
            $data['route'] = 'dies';

            // dd($dataDies);

            return view('operator.data.dies', $data);
        } elseif ($request->segment(2) == 'pengukuran-awal') {
            if (auth()->user()->lines->nama_line == 'All Line') {
                $dataDies = Dies::query()
                    ->where('jenis', $request->segment(3))
                    ->where('masa_pengukuran', 'pengukuran awal')
                    ->where('is_delete_dies', '0')
                    ->orWhere('masa_pengukuran', '-')
                    ->where('is_delete_dies', '0')
                    ->orderBy('created_at', "desc")
                    ->get();
            } else {
                $dataDies = Dies::query()
                    ->where('jenis', $request->segment(3))
                    ->where('masa_pengukuran', 'pengukuran awal')
                    ->where('line_id', auth()->user()->line_id)
                    ->where('is_delete_dies', '0')
                    ->orWhere('masa_pengukuran', '-')
                    ->where('line_id', auth()->user()->line_id)
                    ->where('is_delete_dies', '0')
                    ->orderBy('created_at', "desc")
                    ->get();
            }
            // Separate dataDies into two collections
            $oneYearAgo = Carbon::now()->subYear();
            $dataDiesOlderThanOneYear = $dataDies->filter(function ($dies) use ($oneYearAgo) {
                return $dies->created_at <= $oneYearAgo;
            });

            $dataDiesRecent = $dataDies->filter(function ($dies) use ($oneYearAgo) {
                return $dies->created_at >= $oneYearAgo;
            });

            // Add the separated data to the data array
            $data['dataDiesOlderThanOneYear'] = $dataDiesOlderThanOneYear;
            $data['dataDiesRecent'] = $dataDiesRecent;
            // $data['dataDies'] = $dataDies;

            $hasPengukuranAwal = Dies::where('masa_pengukuran', 'pengukuran awal')
                ->where('jenis', $request->segment(3))
                ->where('is_delete_dies', '0')
                ->exists(); // This will return true or false

            $data['hasPengukuranAwal'] = !$hasPengukuranAwal; // Invert the value to show button if no data

            $ttlDies = $dataDies->count();
            $data['ttlDies'] = $ttlDies;
            // dd($ttlDies);

            $data['DataMesin'] = Mesin::select('id', 'title')->get();
            $data['DataNamaProduk'] = NamaProduk::select('id', 'title')->get();
            $data['DataKodeProduk'] = KodeProduk::select('id', 'title')->get();
            $Dataline = Lines::where('nama_line', '!=', 'All Line')->get();
            $data['DataLine'] = $Dataline;

            $data['jenis'] = 'dies';
            $data['route'] = 'dies';

            return view('engineer.data.dies', $data);
        }
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
        $jenis = $request->segment(3);

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

        //get masa pengukuran dari kode_produk
        $kodeProduk = KodeProduk::where('id', $kode_produk)->first();
        $waktu_rutin = $kodeProduk ? $kodeProduk->waktu_rutin : '-';
        
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
                'next_pengukuran' => Carbon::now()->addMonths($waktu_rutin),
            ];
            session()->put('dies_id', $id);
            Dies::create($createData);
        } else {
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

        if ($request->segment(2) == 'pengukuran-rutin') {
            return redirect(route('pnd.pr.dies.index'));
        } elseif ($request->segment(2) != 'pengukuran-rutin') {
            return redirect(route('pnd.pa.dies.index'));
        }
    }
}
