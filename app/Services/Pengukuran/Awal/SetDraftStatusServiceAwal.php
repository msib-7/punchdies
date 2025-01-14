<?php

namespace App\Services\Pengukuran\Awal;

use App\Events\NotificationEvent;
use App\Models\Dies;
use App\Models\ApprovalPengukuran;
use App\Models\PengukuranAwalDies;
use App\Models\PengukuranAwalPunch;
use App\Models\PengukuranRutinDies;
use App\Models\PengukuranRutinPunch;
use App\Models\Punch;
use App\Models\User;
use App\Notifications\SendApproval;
use App\Services\Mail\ApprovalMailService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class SetDraftStatusService.
 */
class SetDraftStatusServiceAwal
{
    public function handle($id, $jenis, $route)
    {
        // dd($jenis);
        session()->remove('first_id');

        $updateDraftStatus = [
            'is_draft' => 0,
            'is_waiting' => 1,
            'is_approved' => 0,
            'is_rejected' => 0,
        ];

        if ($jenis == 'pengukuran-awal') {
            if (in_array($route, ['punch-atas', 'punch-bawah'])) {
                $this->updatePunchDraftStatus($id, $updateDraftStatus, $this->getRoute($route));
            } elseif ($route == 'dies') {
                $this->updateDiesDraftStatus($id, $updateDraftStatus);
            }
        }
    }

    private function getRoute($segment)
    {
        if ($segment == 'punch-atas') {
            return 'atas';
        } elseif ($segment == 'punch-bawah') {
            return 'bawah';
        } elseif($segment == 'dies'){
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

    private function updatePunchDraftStatus($id, $updateDraftStatus, $route)
    {
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
            $alert = 'warning';
            $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';
        } else {
            $alert = 'success';
            $msg = 'Pengukuran Awal Selesai Dilakukan! Data Dikirim ke Approval'; 

            Punch::updateOrCreate([
                'punch_id' => session('punch_id'),
                'masa_pengukuran' => 'pengukuran awal'
            ], [
                'is_draft' => 0,
                'is_waiting' => 1,
                'is_approved' => 0,
                'is_rejected' => 0,
            ]);

            $this->sendToApproval($this->getSegment($route));

        }

    }

    private function updateDiesDraftStatus($id, $updateDraftStatus)
    {
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
            $alert = 'warning';
            $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';
        } else {
            $alert = 'success';
            $msg = 'Pengukuran Awal Selesai Dilakukan! Data Dikirim ke Approval';

            Dies::updateOrCreate([
                'dies_id' => session('dies_id'), 
                'masa_pengukuran' => 'pengukuran awal'
            ], [
                'is_draft' => 0,
                'is_waiting' => 1,
                'is_approved' => 0,
                'is_rejected' => 0,
            ]);

            $this->sendToApproval('dies');
        }

    }

    private function sendToApproval($jenis)
    {
        $ApprovalPengukuran = new ApprovalPengukuran();

        if (in_array($jenis, ['punch-atas', 'punch-bawah'])) {
            $this->createApprovalRequest($ApprovalPengukuran, 'RPU', session('punch_id'), null, $jenis);
        } elseif ($jenis == 'dies') {
            $this->createApprovalRequest($ApprovalPengukuran, 'RDI', null, session('dies_id'), $jenis);
        }
    }

    private function createApprovalRequest($model, $prefix, $punchId, $diesId, $jenis)
    {
        $autonum = $model->autonumber(["substr(req_id,3,6)" => date('ymd')])->first();
        $id = !$autonum ? $prefix . date("ymd") . "0001" : $this->generateNewId($autonum->req_id, $prefix);

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
                'Data Pengukuran Awal telah dikirim oleh '. auth()->user()->nama .' ke Approval menunggu response dari Supervisor ',
                route('pnd.pa.'. $this->getRoute($jenis) .'.view', $idView)
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
    }

    private function generateNewId($req_id, $prefix)
    {
        $noUrut = (int) substr($req_id, 9, 4);
        $noUrut++;
        return $prefix . date("ymd") . sprintf("%04s", $noUrut);
    }
}
