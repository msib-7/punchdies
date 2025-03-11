<?php

namespace App\Services\Pengukuran\Awal;

use App\Events\NotificationEvent;
use App\Models\ApprovalPengukuran;
use App\Models\Dies;
use App\Models\PengukuranAwalDies;
use App\Models\PengukuranAwalPunch;
use App\Models\Punch;
use App\Models\User;
use DB;
use Log;
use Mail;

/**
 * Class ServiceDraftPengukuranAwal.
 */
class ServiceDraftPengukuranAwal
{
    private function getRoute($segment)
    {
        if ($segment == 'punch-atas') {
            return 'atas';
        } elseif ($segment == 'punch-bawah') {
            return 'bawah';
        } elseif ($segment == 'dies') {
            return 'dies';
        }
    }

    private function getSegment($route)
    {
        if ($route == 'atas') {
            return 'punch-atas';
        } elseif ($route == 'bawah') {
            return 'punch-bawah';
        }
    }

    public function addNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3)
    {
        // $route = $this->getRoute($route);
        if (in_array($route, ['punch-atas', 'punch-bawah', 'dies'])) {
            $this->removeSessionVariables();

            if (in_array($route, ['punch-atas', 'punch-bawah'])) {
                // $this->updatePunchNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3);
                Punch::updateOrCreate([
                    'punch_id' => session('punch_id'),
                    'masa_pengukuran' => 'pengukuran awal'
                ], [
                    'referensi_drawing' => $referensi_drawing,
                    'catatan' => $catatan,
                    'kesimpulan' => $kesimpulan,
                    'kalibrasi_tools_1' => $kalibrasi_tools_1,
                    'kalibrasi_tools_2' => $kalibrasi_tools_2,
                    'kalibrasi_tools_3' => $kalibrasi_tools_3,
                    'tgl_kalibrasi_tools_1' => $tgl_kalibrasi_1,
                    'tgl_kalibrasi_tools_2' => $tgl_kalibrasi_2,
                    'tgl_kalibrasi_tools_3' => $tgl_kalibrasi_3,
                ]);
                // $this->handle($id, $jenis, $route);
                session()->remove('first_id');

                $updateDraftStatus = [
                    'is_draft' => 0,
                    'is_waiting' => 1,
                    'is_approved' => 0,
                    'is_rejected' => 0,
                ];

                if ($jenis == 'pengukuran-awal') {
                    // return $this->updatePunchDraftStatus($id, $updateDraftStatus, $this->getRoute($route));
                    $getData = PengukuranAwalPunch::query()
                        ->where('punch_id', '=', session('punch_id'))
                        ->where('masa_pengukuran', '=', 'pengukuran awal')
                        ->where('head_outer_diameter', '!=', '0')
                        ->where('neck_diameter', '!=', '0')
                        ->where('barrel', '!=', '0')
                        ->where('overall_length', '!=', '0')
                        ->where('tip_diameter_1', '!=', '0')
                        ->where('tip_diameter_2', '!=', '0')
                        ->where('cup_depth', '!=', '0')
                        ->where('working_length', '!=', '0')
                        //
                        ->orWhere('punch_id', '=', session('punch_id'))
                        ->where('masa_pengukuran', '=', 'pengukuran awal')
                        ->where('head_outer_diameter', '!=', null)
                        ->where('neck_diameter', '!=', null)
                        ->where('barrel', '!=', null)
                        ->where('overall_length', '!=', null)
                        ->where('tip_diameter_1', '!=', null)
                        ->where('tip_diameter_2', '!=', null)
                        ->where('cup_depth', '!=', null)
                        ->where('working_length', '!=', null);

                    $getData->update($updateDraftStatus);

                    $cekStatus = PengukuranAwalPunch::where([
                        'punch_id' => session('punch_id'),
                        'masa_pengukuran' => 'pengukuran awal',
                        'is_draft' => '1'
                    ])->count();

                    if ($cekStatus > 0) {
                        $alert = 'info';
                        $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';

                        return redirect(route('pnd.pa.' . $this->getRoute($route) . '.index'))->with($alert, $msg);
                    } else {
                        $alert = 'success';
                        $msg = 'Pengukuran Awal Selesai Dilakukan! Data Dikirim ke Approval';
                        $prefix = 'RPU';
                        $punchId = session('punch_id');
                        $diesId = null;
                        $jenis = $this->getRoute($route);
                        
                        Punch::updateOrCreate([
                            'punch_id' => session('punch_id'),
                            'masa_pengukuran' => 'pengukuran awal'
                        ], [
                            'is_draft' => 0,
                            'is_waiting' => 1,
                            'is_approved' => 0,
                            'is_rejected' => 0,
                        ]);
                        
                        return $this->sendToApproval($jenis, $prefix, $punchId, $diesId, $alert, $msg);
                        // return $this->sendToApproval($this->getRoute($route), new ApprovalPengukuran(), 'RPU', session('punch_id'), null, $alert, $msg);

                    }
                }


            } elseif ($route == 'dies') {
                // $this->updateDiesNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3);
                Dies::updateOrCreate([
                    'dies_id' => session('dies_id'),
                    'masa_pengukuran' => 'pengukuran awal'
                ], [
                    'referensi_drawing' => $referensi_drawing,
                    'catatan' => $catatan,
                    'kesimpulan' => $kesimpulan,
                    'kalibrasi_tools_1' => $kalibrasi_tools_1,
                    'kalibrasi_tools_2' => $kalibrasi_tools_2,
                    'kalibrasi_tools_3' => $kalibrasi_tools_3,
                    'tgl_kalibrasi_tools_1' => $tgl_kalibrasi_1,
                    'tgl_kalibrasi_tools_2' => $tgl_kalibrasi_2,
                    'tgl_kalibrasi_tools_3' => $tgl_kalibrasi_3,
                ]);
                session()->remove('first_id');

                    $updateDraftStatus = [
                        'is_draft' => 0,
                        'is_waiting' => 1,
                        'is_approved' => 0,
                        'is_rejected' => 0,
                    ];

                    if ($jenis == 'pengukuran-awal') {
                    $getData = PengukuranAwalDies::query()
                        ->where('dies_id', session('dies_id'))
                        ->where('masa_pengukuran', 'pengukuran awal')
                        ->where('outer_diameter', '!=', '0')
                        ->where('inner_diameter_1', '!=', '0')
                        ->where('inner_diameter_2', '!=', '0')
                        ->where('ketinggian_dies', '!=', '0')
                        ->where('visual', '!=', '-')
                        ->where('kesesuaian_dies', '!=', '-')
                        //
                        ->orWhere('dies_id', session('dies_id'))
                        ->where('masa_pengukuran', 'pengukuran awal')
                        ->where('outer_diameter', '!=', null)
                        ->where('inner_diameter_1', '!=', null)
                        ->where('inner_diameter_2', '!=', null)
                        ->where('ketinggian_dies', '!=', null)
                        ->where('visual', '!=', '-')
                        ->where('kesesuaian_dies', '!=', '-');

                    $getData->update($updateDraftStatus);

                    $cekStatus = PengukuranAwalDies::where([
                        'dies_id' => session('dies_id'),
                        'masa_pengukuran' => 'pengukuran awal',
                        'is_draft' => '1'
                    ])->count();

                    if ($cekStatus > 0) {
                        $alert = 'info';
                        $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';

                        return redirect(route('pnd.pa.' . $this->getRoute($route) . '.index'))->with($alert, $msg);
                    } else {
                        $alert = 'success';
                        $msg = 'Pengukuran Awal Selesai Dilakukan! Data Dikirim ke Approval';
                        $prefix = 'RDI';
                        $punchId = null;
                        $diesId = session('dies_id');
                        $jenis = $this->getRoute($route);

                        Dies::updateOrCreate([
                            'dies_id' => session('dies_id'),
                            'masa_pengukuran' => 'pengukuran awal'
                        ], [
                            'is_draft' => 0,
                            'is_waiting' => 1,
                            'is_approved' => 0,
                            'is_rejected' => 0,
                        ]);
                        
                        return $this->sendToApproval($jenis, $prefix, $punchId, $diesId, $alert, $msg);
                    }
                }
            }
        }
        // return redirect(route('pnd.pa.'. $this->getRoute($route) .'.view', $id));
        // return redirect(route('pnd.pa.' . $this->getRoute($route) . '.index'));
    }

    private function removeSessionVariables()
    {
        session()->remove('show_id');
        session()->remove('count');
        session()->remove('count_num');
    }
    
    // private function updatePunchNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3)
    // {
        
    //     // (new SetDraftStatusServiceAwal)->handle($id, $jenis, $route);

    //     // return redirect(route('pnd.pa.'. $this->getRoute($route) .'.view', $id));
    // }

    // private function updateDiesNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3)
    // {
        
    // }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // public function handle($id, $jenis, $route)
    // {
    //     // dd($jenis);
    //     session()->remove('first_id');

    //     $updateDraftStatus = [
    //         'is_draft' => 0,
    //         'is_waiting' => 1,
    //         'is_approved' => 0,
    //         'is_rejected' => 0,
    //     ];

    //     if ($jenis == 'pengukuran-awal') {
    //         if (in_array($route, ['punch-atas', 'punch-bawah'])) {
    //             return $this->updatePunchDraftStatus($id, $updateDraftStatus, $this->getRoute($route));
    //         } elseif ($route == 'dies') {
    //             return $this->updateDiesDraftStatus($id, $updateDraftStatus);
    //         }
    //     }
    // }

    // private function updatePunchDraftStatus($id, $updateDraftStatus, $route)
    // {
    //     $getData = PengukuranAwalPunch::query()
    //         ->where('punch_id', '=', session('punch_id'))
    //         ->where('masa_pengukuran', '=', 'pengukuran awal')
    //         ->where('head_outer_diameter', '!=', '0')
    //         ->where('neck_diameter', '!=', '0')
    //         ->where('barrel', '!=', '0')
    //         ->where('overall_length', '!=', '0')
    //         ->where('tip_diameter_1', '!=', '0')
    //         ->where('tip_diameter_2', '!=', '0')
    //         ->where('cup_depth', '!=', '0')
    //         ->where('working_length', '!=', '0')
    //         //
    //         ->orWhere('punch_id', '=', session('punch_id'))
    //         ->where('masa_pengukuran', '=', 'pengukuran awal')
    //         ->where('head_outer_diameter', '!=', null)
    //         ->where('neck_diameter', '!=', null)
    //         ->where('barrel', '!=', null)
    //         ->where('overall_length', '!=', null)
    //         ->where('tip_diameter_1', '!=', null)
    //         ->where('tip_diameter_2', '!=', null)
    //         ->where('cup_depth', '!=', null)
    //         ->where('working_length', '!=', null);

    //     $getData->update($updateDraftStatus);

    //     $cekStatus = PengukuranAwalPunch::where([
    //         'punch_id' => session('punch_id'),
    //         'masa_pengukuran' => 'pengukuran awal',
    //         'is_draft' => '1'
    //     ])->count();

    //     if ($cekStatus > 0) {
    //         $alert = 'warning';
    //         $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';

    //         // dd('oke');
    //         return response()->json([
    //             'alert' => $alert,
    //             'msg' => $msg,
    //         ], 200);
    //     } else {
    //         $alert = 'success';
    //         $msg = 'Pengukuran Awal Selesai Dilakukan! Data Dikirim ke Approval';

    //         Punch::updateOrCreate([
    //             'punch_id' => session('punch_id'),
    //             'masa_pengukuran' => 'pengukuran awal'
    //         ], [
    //             'is_draft' => 0,
    //             'is_waiting' => 1,
    //             'is_approved' => 0,
    //             'is_rejected' => 0,
    //         ]);

    //         $this->sendToApproval($this->getSegment($route));

    //         return redirect(route('pnd.pa.' . $this->getRoute($route) . '.index'));

    //     }

    // }

    // private function updateDiesDraftStatus($id, $updateDraftStatus)
    // {
    //     $getData = PengukuranAwalDies::query()
    //         ->where('dies_id', session('dies_id'))
    //         ->where('masa_pengukuran', 'pengukuran awal')
    //         ->where('outer_diameter', '!=', '0')
    //         ->where('inner_diameter_1', '!=', '0')
    //         ->where('inner_diameter_2', '!=', '0')
    //         ->where('ketinggian_dies', '!=', '0')
    //         ->where('visual', '!=', '-')
    //         ->where('kesesuaian_dies', '!=', '-')
    //         //
    //         ->orWhere('dies_id', session('dies_id'))
    //         ->where('masa_pengukuran', 'pengukuran awal')
    //         ->where('outer_diameter', '!=', null)
    //         ->where('inner_diameter_1', '!=', null)
    //         ->where('inner_diameter_2', '!=', null)
    //         ->where('ketinggian_dies', '!=', null)
    //         ->where('visual', '!=', '-')
    //         ->where('kesesuaian_dies', '!=', '-');

    //     $getData->update($updateDraftStatus);

    //     $cekStatus = PengukuranAwalDies::where([
    //         'dies_id' => session('dies_id'),
    //         'masa_pengukuran' => 'pengukuran awal',
    //         'is_draft' => '1'
    //     ])->count();

    //     if ($cekStatus > 0) {
    //         $alert = 'warning';
    //         $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';
    //     } else {
    //         $alert = 'success';
    //         $msg = 'Pengukuran Awal Selesai Dilakukan! Data Dikirim ke Approval';

    //         Dies::updateOrCreate([
    //             'dies_id' => session('dies_id'),
    //             'masa_pengukuran' => 'pengukuran awal'
    //         ], [
    //             'is_draft' => 0,
    //             'is_waiting' => 1,
    //             'is_approved' => 0,
    //             'is_rejected' => 0,
    //         ]);

    //         $this->sendToApproval('dies');
    //     }

    // }

    
    private function sendToApproval($jenis, $prefix, $punchId, $diesId, $alert, $msg)
    {
        $model = new ApprovalPengukuran();
        // $this->createApprovalRequest($ApprovalPengukuran, 'RPU', session('punch_id'), null, $jenis);
        $autonum = $model->autonumber(["substr(req_id,3,6)" => date('ymd')])->first();
        $id = !$autonum ? $prefix . date("ymd") . "0001" : $this->generateNewId($autonum->req_id, $prefix);
        // dd($id);

        try {
            DB::beginTransaction();

            $dataApproval = [
                'req_id' => $id,
                'punch_id' => $punchId,
                'dies_id' => $diesId,
                'masa_pengukuran' => session('masa_pengukuran'),
                'user_id' => session('user_id'),
                'tgl_submit' => date('Y-m-d H:i:s'),
                'due_date' => date('Y-m-d H:i:s', strtotime(date('Y-m-d 23:59:59') . " +6 days")),
                'by' => '-',
                'at' => null,
                'is_approved' => '0',
                'is_rejected' => '0',
            ];
            // dd($model::create($dataApproval));
            $model::create($dataApproval);


            $users = User::whereHas('roles', function ($query) {
                $query->where('role_name', 'Supervisor Engineering');
                //   ->orWhere('role_name', 'Administraor');
            })->get();

            if ($punchId == null || $punchId == '-') {
                $idView = $diesId;
            } elseif ($diesId == null || $diesId == '-') {
                $idView = $punchId;
            }

            // Buat NOtifikasi Ke Pengirim
            event(new NotificationEvent(
                auth()->user()->id,
                'Success Sending Approval',
                'Data Pengukuran Awal telah dikirim oleh ' . auth()->user()->nama . ' ke Approval menunggu response dari Supervisor ',
                route('pnd.pa.' . $jenis . '.view', $idView)
            ));

            $userEmails = []; // Array to store user emails
            $failedEmails = []; // Array to store emails that failed to send

            foreach ($users as $user) {
                // $userEmails[] = $user->email; // Store the email in the array

                $uuid = ApprovalPengukuran::where('req_id', $id)->latest()->first()->id;
                // Buat NOtifikasi Ke Penerima
                event(new NotificationEvent(
                    $user->user_id,
                    'Waiting!, Approval Pengukuran Awal',
                    'User ' . auth()->user()->nama . ' telah mengirim data approval dan menunggu persetujuan Anda.',
                    route('pnd.approval.pa.show', $uuid)
                ));

                $message = 'Halo anda baru saja menerima permintaan persetujuan Pengukuran Awal ' . $jenis . ' yang telah dibuat oleh ' . auth()->user()->nama . ' Silahkan lakukan persetujuan segera.';
                $data = [
                    'status' => 'Waiting Approval',
                    'link' => route('pnd.approval.pa.show', $uuid),
                    'penerima' => $user->nama,
                    'body' => $message
                ];

                try {
                    // // Attempt to send notification to the user
                    Mail::to($user->email)->send(new \App\Mail\SendApproval($data));
                } catch (\Exception $e) {
                    // Log the error message
                    Log::error('Failed to send email to ' . $user->email . ': ' . $e->getMessage());

                    // Optionally, store the failed email for further processing or reporting
                    $failedEmails[] = $user->email;
                }
            }

            // Optionally, log the successful emails sent
            Log::info('Emails sent to: ', $userEmails);

            // Optionally, log the failed emails
            if (!empty($failedEmails)) {
                Log::warning('Failed to send emails to: ', $failedEmails);
            }

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Error added create Approval : ' . $th->getMessage());
        }

        return redirect(route('pnd.pa.' . $jenis . '.index'))->with($alert, $msg);
    }

    // private function createApprovalRequest($model, $prefix, $punchId, $diesId, $jenis)
    // {
        
    // }

    private function generateNewId($req_id, $prefix)
    {
        $noUrut = (int) substr($req_id, 9, 4);
        $noUrut++;
        return $prefix . date("ymd") . sprintf("%04s", $noUrut);
    }
}
