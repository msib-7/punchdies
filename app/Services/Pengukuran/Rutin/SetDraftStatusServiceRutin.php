<?php

namespace App\Services\Pengukuran\Rutin;

use App\Events\NotificationEvent;
use App\Models\Dies;
use App\Models\ApprovalPengukuran;
use App\Models\PengukuranAwalDies;
use App\Models\PengukuranAwalPunch;
use App\Models\PengukuranRutinDies;
use App\Models\PengukuranRutinPunch;
use App\Models\Punch;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class SetDraftStatusServiceRutin.
 */
class SetDraftStatusServiceRutin
{
    public function handle($route, $masa_pengukuran)
    {
        // dd($jenis);
        session()->remove('first_id');

        $updateDraftStatus = [
            'is_draft' => 0,
            'is_waiting' => 1,
            'is_approved' => 0,
            'is_rejected' => 0,
        ];

        if (in_array($route, ['punch-atas', 'punch-bawah'])) {
            $this->updatePunchRutinDraftStatus($updateDraftStatus, $this->getRoute($route), $masa_pengukuran);
        } elseif ($route == 'dies') {
            $this->updateDiesRutinDraftStatus($updateDraftStatus, $masa_pengukuran);
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

    private function updatePunchRutinDraftStatus($updateDraftStatus, $route, $masa_pengukuran)
    {
        $getData = PengukuranRutinPunch::where([
            'punch_id' => session('punch_id'),
            'masa_pengukuran' => $masa_pengukuran,
        ])
            ->where('overall_length', '!=', '0')
            ->orWhere('overall_length', '!=', null)
            ->where('cup_depth', '!=', '0')
            ->orWhere('cup_depth', '!=', null)
            ->where('working_length_rutin', '!=', '0')
            ->orWhere('working_length_rutin', '!=', null);

        $getData->update($updateDraftStatus);

        $cekStatus = PengukuranRutinPunch::where([
            'punch_id' => session('punch_id'),
            'masa_pengukuran' => $masa_pengukuran,
            'is_draft' => '1'
        ])->count();

        if ($cekStatus > 0) {
            $alert = 'warning';
            $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';
        } else {
            $alert = 'success';
            $msg = $masa_pengukuran . ' Selesai Dilakukan! Data Dikirim ke Approval';

            Punch::updateOrCreate([
                'punch_id' => session('punch_id'),
                'masa_pengukuran' => $masa_pengukuran
            ], [
                'is_draft' => 0,
                'is_waiting' => 1,
                'is_approved' => 0,
                'is_rejected' => 0,
            ]);

            $this->sendToApproval($this->getSegment($route), $masa_pengukuran);
        }

        return redirect(route('pnd.pr.' . $route . '.index'))->with($alert, $msg);
    }

    private function updateDiesRutinDraftStatus($updateDraftStatus, $masa_pengukuran)
    {
        $getData = PengukuranRutinDies::where([
            'dies_id' => session('dies_id'),
            'masa_pengukuran' => $masa_pengukuran,
        ])
            ->where('is_cincin_berbayang', '!=', '-')
            ->where('is_gompal', '!=', '-')
            ->where('is_retak', '!=', '-')
            ->where('is_pecah', '!=', '-');

            // dd($getData->get());
        $getData->update($updateDraftStatus);

        $cekStatus = PengukuranRutinDies::where([
            'dies_id' => session('dies_id'),
            'masa_pengukuran' => $masa_pengukuran,
            'is_draft' => '1'
        ])->count();

        if ($cekStatus > 0) {
            $alert = 'warning';
            $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';
        } else {
            $alert = 'success';
            $msg = $masa_pengukuran . ' Selesai Dilakukan! Data Dikirim ke Approval';

            Dies::updateOrCreate([
                'dies_id' => session('dies_id'), 
                'masa_pengukuran' => $masa_pengukuran
            ], [
                'is_draft' => 0,
                'is_waiting' => 1,
                'is_approved' => 0,
                'is_rejected' => 0,
            ]);

            $this->sendToApproval('dies', $masa_pengukuran);
        }

        return redirect(route('pnd.pr.dies.index'))->with($alert, $msg);
    }

    private function sendToApproval($jenis, $masa_pengukuran)
    {
        $ApprovalPengukuran = new ApprovalPengukuran();

        if (in_array($jenis, ['punch-atas', 'punch-bawah'])) {
            $this->createApprovalRequest($ApprovalPengukuran, 'RPU', session('punch_id'), null, $masa_pengukuran, $jenis);
        } elseif ($jenis == 'dies') {
            $this->createApprovalRequest($ApprovalPengukuran, 'RDI', null, session('dies_id'), $masa_pengukuran, $jenis);
        }
    }

    private function createApprovalRequest($model, $prefix, $punchId, $diesId, $masa_pengukuran, $jenis)
    {
        $autonum = $model->autonumber(["substr(req_id,3,6)" => date('ymd')])->first();
        $id = !$autonum ? $prefix . date("ymd") . "0001" : $this->generateNewId($autonum->req_id, $prefix);

        $dataApproval = [
            'req_id' => $id,
            'punch_id' => $punchId,
            'dies_id' => $diesId,
            'masa_pengukuran' => $masa_pengukuran,
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
            $query->where('role_name', 'Supervisor Produksi');
        })->get();

        if($punchId==null || $punchId=='-'){
            $idView = $diesId;
        }elseif($diesId==null || $diesId=='-'){
            $idView = $punchId;
        }
        // Buat NOtifikasi Ke Pengirim
        event(new NotificationEvent(
            auth()->user()->id,
            'Success Sending Approval',
            'Data Pengukuran Rutin telah dikirim oleh ' . auth()->user()->nama . ' ke Approval menunggu response dari Supervisor ',
            route('pnd.pr.'. $this->getRoute($jenis) .'.view', $idView)
        ));

        $userEmails = []; // Array to store user emails
        $failedEmails = []; // Array to store emails that failed to send

        foreach ($users as $user) {
            // $userEmails[] = $user->email; // Store the email in the array

            $uuid = ApprovalPengukuran::where('req_id', $id)->latest()->first()->id;
            // Buat NOtifikasi Ke Penerima
            event(new NotificationEvent(
                $user->user_id,
                'Waiting!, Approval Pengukuran Rutin',
                'User ' . auth()->user()->nama . ' telah mengirim data approval dan menunggu persetujuan Anda.',
                route('pnd.approval.pr.show', $uuid)
            ));

            $message = 'Halo anda baru saja menerima permintaan persetujuan Pengukuran Rutin ' . $jenis . ' yang telah dibuat oleh ' . auth()->user()->nama . ' Silahkan lakukan persetujuan segera.';
            $data = [
                'status' => 'Waiting Approval',
                'link' => route('pnd.approval.pr.show', $uuid),
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
    }

    private function generateNewId($req_id, $prefix)
    {
        $noUrut = (int) substr($req_id, 9, 4);
        $noUrut++;
        return $prefix . date("ymd") . sprintf("%04s", $noUrut);
    }
}
