<?php

namespace App\Http\Controllers;

use App\Models\KodeProduk;
use App\Models\Lines;
use App\Models\Mesin;
use App\Models\NamaProduk;
use App\Models\PengukuranAwalPunch;
use App\Models\PengukuranRutinPunch;
use App\Models\Punch;
use App\Services\LogService;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class PunchController extends Controller
{
    public function index($segment)
    {
        if (auth()->user()->lines->nama_line == 'All Line') {
            $dataPunch = Punch::query()
                ->where('masa_pengukuran', 'pengukuran awal')
                ->where('jenis', $segment)
                ->where('is_delete_punch', '0')
                ->orWhere('masa_pengukuran', '-')
                ->where('jenis', $segment)
                ->where('is_delete_punch', '0')
                ->orderBy('created_at', "desc")
                ->get();
        } else {
            $dataPunch = Punch::query()
                ->where('masa_pengukuran', 'pengukuran awal')
                ->where('jenis', $segment)
                ->where('line_id', auth()->user()->line_id)
                ->where('is_delete_punch', '0')
                ->orWhere('masa_pengukuran', '-')
                ->where('jenis', $segment)
                ->where('line_id', auth()->user()->line_id)
                ->where('is_delete_punch', '0')
                ->orderBy('created_at', "desc")
                ->get();
        }

        $data['dataPunch'] = $dataPunch;

        $ttlPunch = $dataPunch->count();
        $data['ttlPunch'] = $ttlPunch;

        $Dataline = Lines::where('nama_line', '!=', 'All Line')->get();
        $data['DataLine'] = $Dataline;

        if ($segment == 'punch-atas') {
            $data['jenisPunch'] = 'Punch Atas';
            $data['jenis'] = 'punch-atas';
            $data['route'] = 'atas';
        } elseif ($segment == 'punch-bawah') {
            $data['jenisPunch'] = 'Punch Bawah';
            $data['jenis'] = 'punch-bawah';
            $data['route'] = 'bawah';
        }

        return view('engineer.data.punch', $data);
    }
    public function show_all_punch(Request $request)
    {
        if($request->segment(2) == 'pengukuran-rutin'){
            if(auth()->user()->lines->nama_line == 'All Line'){
                $dataPunch = Punch::query()->with('kode_produks')->with('nama_produks')
                    ->select(
                        'punch_id',
                        DB::raw('MAX(id::text) as id'),
                        DB::raw('MAX(merk) as merk'),
                        DB::raw('MAX(bulan_pembuatan) as bulan_pembuatan'),
                        DB::raw('MAX(tahun_pembuatan) as tahun_pembuatan'),
                        DB::raw('MAX(nama_mesin_cetak) as nama_mesin_cetak'),
                        DB::raw('MAX(nama_produk::text) as nama_produk'),
                        DB::raw('MAX(kode_produk::text) as kode_produk'),
                        DB::raw('MAX(line_id) as line_id'),
                        DB::raw('MAX(jenis) as jenis'),
                        DB::raw('MAX(masa_pengukuran) as masa_pengukuran'),
                        DB::raw('MAX(is_delete_punch) as is_delete_punch'),
                        DB::raw('MAX(is_draft) as is_draft'),
                        DB::raw('MAX(is_edit) as is_edit'),
                        DB::raw('MAX(is_waiting) as is_waiting'),
                        DB::raw('MAX(is_approved) as is_approved'),
                        DB::raw('MAX(is_rejected) as is_rejected'),
                        DB::raw('MAX(created_at) as created_at'),
                        DB::raw('MAX(updated_at) as updated_at'),
                        DB::raw('MAX(next_pengukuran) as next_pengukuran'),
                    )
                    ->where(function ($query) use ($request) {
                        $query->where('jenis', $request->segment(3))
                            ->where('is_delete_punch', '0')
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
                                    $query->whereLike('masa_pengukuran',  'pengukuran rutin%')
                                        ->where('is_draft', '1')
                                        ->where('is_approved', '=', '-');
                                })
                                ->orWhere(function ($query) {
                                    $query->whereLike('masa_pengukuran',  'pengukuran rutin%')
                                        ->where('is_draft', '0')
                                        ->where('is_approved', '=', '-');
                                })
                                ->orWhere(function ($query) {
                                    $query->whereLike('masa_pengukuran',  'pengukuran rutin%')
                                        ->where('is_draft', '0')
                                        ->where('is_approved', '=', '0');
                                })
                                ->orWhere(function ($query) {
                                    $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                        ->where('is_draft', '0')
                                        ->where('is_waiting', '0')
                                        ->where('is_approved', '=', '1');
                                })
                                ->orWhere(function ($query) {
                                    $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                        ->where('is_waiting', '1')
                                        ->where('is_approved', '0');
                                });
                            })
                            ->orWhere('jenis', $request->segment(3))
                            ->where('is_delete_punch', '0')
                            ->where(function ($query) {
                                $query->where(function ($query) {
                                    $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                        ->where('is_approved', '=', '0');
                                })
                                    ->orWhere(function ($query) {
                                        $query->where('masa_pengukuran', '!=', 'pengukuran awal')
                                            ->where('is_draft', '0')
                                            ->where('is_waiting', '0')
                                            ->where('is_approved', '=', '1');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                            ->where('is_draft', '1')
                                            ->where('is_approved', '=', '-');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                            ->where('is_draft', '0')
                                            ->where('is_approved', '=', '0');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->whereLike('masa_pengukuran', 'pengukuran rutin%')
                                            ->where('is_waiting', '1')
                                            ->where('is_approved', '0');
                                    })
                                    ->orWhere(function ($query) {
                                        $query->where('masa_pengukuran', '=', 'pengukuran awal')
                                            ->where('is_approved', '=', '1')
                                            ->where('is_waiting', '=', '0');
                                    });
                            });
                    })
                    ->groupBy('punch_id')
                    ->latest()
                    ->get();

                                    // dd($dataPunch);
            }else{
                $dataPunch = Punch::query()->with('kode_produks')->with('nama_produks')
                    ->select(
                        'punch_id',
                        DB::raw('MAX(id::text) as id'),
                        DB::raw('MAX(merk) as merk'),
                        DB::raw('MAX(bulan_pembuatan) as bulan_pembuatan'),
                        DB::raw('MAX(tahun_pembuatan) as tahun_pembuatan'),
                        DB::raw('MAX(nama_mesin_cetak) as nama_mesin_cetak'),
                        DB::raw('MAX(nama_produk::text) as nama_produk'),
                        DB::raw('MAX(kode_produk::text) as kode_produk'),
                        DB::raw('MAX(line_id) as line_id'),
                        DB::raw('MAX(jenis) as jenis'),
                        DB::raw('MAX(masa_pengukuran) as masa_pengukuran'),
                        DB::raw('MAX(is_delete_punch) as is_delete_punch'),
                        DB::raw('MAX(is_draft) as is_draft'),
                        DB::raw('MAX(is_edit) as is_edit'),
                        DB::raw('MAX(is_approved) as is_approved'),
                        DB::raw('MAX(is_rejected) as is_rejected'),
                        DB::raw('MAX(created_at) as created_at'),
                        DB::raw('MAX(updated_at) as updated_at'),
                        DB::raw('MAX(next_pengukuran) as next_pengukuran'),
                    )
                    ->where(function ($query) use ($request) {
                        $query->where('jenis', $request->segment(3))
                            ->where('line_id', auth()->user()->line_id)
                            ->where('is_delete_punch', '0')
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
                            ->where('is_delete_punch', '0')
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
                    ->groupBy('punch_id')
                    ->orderBy('created_at', "desc")
                    ->latest()
                    ->get();
            }
            // Separate dataPunch into two collections
            $oneYearAgo = Carbon::now()->subYear();
            $dataPunchOlderThanOneYear = $dataPunch->filter(function ($punch) use ($oneYearAgo) {
                return $punch->created_at <= $oneYearAgo;
            });

            $dataPunchRecent = $dataPunch->filter(function ($punch) use ($oneYearAgo) {
                return $punch->created_at >= $oneYearAgo;
            });

             // Reminder logic for next_pengukuran
            $currentDate = Carbon::now();
            $reminderData = $dataPunch->filter(function ($punch) use ($currentDate) {
                return $punch->next_pengukuran && $punch->next_pengukuran <= $currentDate;
            });
            
            // Add the separated data to the data array
            $data['dataPunchOlderThanOneYear'] = $dataPunchOlderThanOneYear;
            $data['dataPunchRecent'] = $dataPunchRecent;
            $data['reminderData'] = $reminderData;
            // dd($reminderData);
            
            // $data['dataPunch'] = $dataPunch;

            $ttlPunch = Punch::
                where(['jenis' => $request->segment(3), 'is_delete_punch' => '0'])
                ->orderBy('created_at', "desc")
                ->count();
            $data['ttlPunch'] = $ttlPunch;

            $data['DataMesin'] = Mesin::select('id', 'title')->get();
            $data['DataNamaProduk'] = NamaProduk::select('id', 'title')->get();
            $data['DataKodeProduk'] = KodeProduk::select('id', 'title')->get();
            
            $Dataline = Lines::where('nama_line', '!=', 'All Line')->get();
            $data['DataLine'] = $Dataline;

            if ($request->segment(3) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
                $data['route'] = 'atas';
            } elseif ($request->segment(3) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
                $data['route'] = 'bawah';
            }

            return view('operator.data.punch', $data);
        }elseif($request->segment(2) == 'pengukuran-awal'){
            if(auth()->user()->lines->nama_line == 'All Line'){
                $dataPunch = Punch::query()->with('kode_produks')->with('nama_produks')
                    ->where('masa_pengukuran', 'pengukuran awal')
                    ->where('jenis', $request->segment(3))
                    ->where('is_delete_punch', '0')
                    ->orWhere('masa_pengukuran', '-')
                    ->where('jenis', $request->segment(3))
                    ->where('is_delete_punch', '0')
                    ->orderBy('created_at', "desc")
                    ->get();
            }else{  
                $dataPunch = Punch::query()->with('kode_produks')->with('nama_produks')
                    ->where('masa_pengukuran', 'pengukuran awal')
                    ->where('jenis', $request->segment(3))
                    ->where('line_id', auth()->user()->line_id)
                    ->where('is_delete_punch', '0')
                    ->orWhere('masa_pengukuran', '-')
                    ->where('jenis', $request->segment(3))
                    ->where('line_id', auth()->user()->line_id)
                    ->where('is_delete_punch', '0')
                    ->orderBy('created_at', "desc")
                    ->get();
            }

            // Separate dataPunch into two collections
            $oneYearAgo = Carbon::now()->subYear();
            $dataPunchOlderThanOneYear = $dataPunch->filter(function ($punch) use ($oneYearAgo) {
                return $punch->created_at <= $oneYearAgo;
            });

            $dataPunchRecent = $dataPunch->filter(function ($punch) use ($oneYearAgo) {
                return $punch->created_at >= $oneYearAgo;
            });

            // Reminder logic for next_pengukuran
            $currentDate = Carbon::now();
            $reminderData = $dataPunch->filter(function ($punch) use ($currentDate) {
                return $punch->next_pengukuran && $punch->next_pengukuran <= $currentDate;
            });

            // Add the separated data to the data array
            $data['dataPunchOlderThanOneYear'] = $dataPunchOlderThanOneYear;
            $data['dataPunchRecent'] = $dataPunchRecent;
            $data['reminderData'] = $reminderData;
            // dd($reminderData);

            // $data['dataPunch'] = $dataPunch;
            
            $ttlPunch = $dataPunch->count();
            $data['ttlPunch'] = $ttlPunch;
            // dd($ttlPunch);

            $data['DataMesin'] = Mesin::select('id', 'title')->get();
            $data['DataNamaProduk'] = NamaProduk::select('id', 'title')->get();
            $data['DataKodeProduk'] = KodeProduk::select('id', 'title')->get();
            $Dataline = Lines::where('nama_line', '!=', 'All Line')->get();
            $data['DataLine'] = $Dataline;

            if ($request->segment(3) == 'punch-atas') {
                $data['jenisPunch'] = 'Punch Atas';
                $data['jenis'] = 'punch-atas';
                $data['route'] = 'atas';
            } elseif ($request->segment(3) == 'punch-bawah') {
                $data['jenisPunch'] = 'Punch Bawah';
                $data['jenis'] = 'punch-bawah';
                $data['route'] = 'bawah';
            }

            return view('engineer.data.punch', $data);
        }
    }

    public function create_data(Request $request)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'bulan_pembuatan' => 'required',
            'tahun_pembuatan' => 'required',
            'nama_mesin_cetak' => 'required',
            'nama_produk' => 'required',
            'kode_produk' => 'required',
            'line_id' => 'required',
        ]);

        $Punch = new Punch();
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

        //get masa pengukuran dari kode_produk
        $kodeProduk = KodeProduk::where('id', $kode_produk)->first();
        $waktu_rutin = $kodeProduk ? $kodeProduk->waktu_rutin : '-';
        
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
                'next_pengukuran' => Carbon::now()->addMonths($waktu_rutin),
            ];
            session()->put('punch_id', $id);
            Punch::create($createData);
        } else {
        }
    }

    public function delete_data(Request $request, $id)
    {
        $ip = request()->ip();
        $user = auth()->user(); // Get the authenticated user
        $punch = Punch::where('punch_id', $id)->first();

        if ($request->segment(3) == 'punch-atas') {
            $route = 'atas';
        } elseif ($request->segment(3) == 'punch-bawah') {
            $route = 'bawah';
        }
        $delPunch = [
            'is_delete_punch' => '1',
            'is_draft' => '0',
            'is_waiting' => '0',
            'is_edit' => '0',
            'is_approved' => '0',
            'is_rejected' => '0',
            'is_disposal' => '0',
        ];
        $delPengukuran = [
            'is_delete_pp' => '1',
        ];

        // Punch::where(['punch_id' => $id])->update($delPunch);
        Punch::updateOrCreate(['punch_id' => $id], $delPunch);

        PengukuranAwalPunch::where(['punch_id' => $id])->update($delPengukuran);
        PengukuranRutinPunch::where(['punch_id' => $id])->update($delPengukuran);

        $oldData = [
            'punch_id' => $punch->punch_id,
            'merk' => $punch->merk,
            'bulan_pembuatan' => $punch->bulan_pembuatan,
            'tahun_pembuatan' => $punch->tahun_pembuatan,
            'nama_mesin_cetak' => $punch->nama_mesin_cetak,
            'nama_produk' => $punch->nama_produk,
            'kode_produk' => $punch->kode_produk,
            'line_id' => $punch->line_id,
            'jenis' => $punch->jenis,
            'masa_pengukuran' => $punch->masa_pengukuran,
            'catatan' => $punch->catatan,
            'kesimpulan' => $punch->kesimpulan,
            'is_draft' => $punch->is_draft,
            'is_delete_punch' => $punch->is_delete_punch,
            'is_edit' => $punch->is_edit,
            'is_approved' => $punch->is_approved,
            'is_rejected' => $punch->is_rejected,
            'is_disposal' => $punch->is_disposal,
            'next_pengukuran' => $punch->next_pengukuran,
        ];
        $newData = [
            'punch_id' => $punch->punch_id,
            'merk' => $punch->merk,
            'bulan_pembuatan' => $punch->bulan_pembuatan,
            'tahun_pembuatan' => $punch->tahun_pembuatan,
            'nama_mesin_cetak' => $punch->nama_mesin_cetak,
            'nama_produk' => $punch->nama_produk,
            'kode_produk' => $punch->kode_produk,
            'line_id' => $punch->line_id,
            'jenis' => $punch->jenis,
            'masa_pengukuran' => $punch->masa_pengukuran,
            'catatan' => $punch->catatan,
            'kesimpulan' => $punch->kesimpulan,
            'is_draft' => '0',
            'is_delete_punch' => '1',
            'is_edit' => '0',
            'is_approved' => '0',
            'is_rejected' => '0',
            'is_disposal' => '0',
            'next_pengukuran' => $punch->next_pengukuran,
        ];

        $logData = [
            'model' => Punch::class,
            'model_id' => null,
            'user_id' => $user->id,
            'action' => 'deleted',
            'location' => $ip,
            'reason' => 'Data Removal',
            'how' => 'User Action',
            'timestamp' => now(),
            'old_data' => $oldData,
            'new_data' => $newData,
        ];
        (new LogService)->handle($logData);

        if($request->segment(2) == 'pengukuran-rutin'){
            return redirect(route('pnd.pr.'.$route.'.index'))->with('success', 'Data berhasil dihapus');
        }elseif($request->segment(2) != 'pengukuran-rutin'){
            return redirect(route('pnd.pa.' . $route . '.index'))->with('success', 'Data berhasil dihapus');
        }

    }
}
