<?php

namespace App\Services\Pengukuran\Awal;

use App\Models\Dies;
use App\Models\ApprovalPengukuran;
use App\Models\PengukuranAwalDies;
use App\Models\PengukuranAwalPunch;
use App\Models\PengukuranRutinDies;
use App\Models\PengukuranRutinPunch;
use App\Models\Punch;

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
                'is_waiting' => 1
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
            ]);

            $this->sendToApproval('dies');
        }

    }

    private function sendToApproval($jenis)
    {
        $ApprovalPengukuran = new ApprovalPengukuran();

        if (in_array($jenis, ['punch-atas', 'punch-bawah'])) {
            $this->createApprovalRequest($ApprovalPengukuran, 'RPU', session('punch_id'), null);
        } elseif ($jenis == 'dies') {
            $this->createApprovalRequest($ApprovalPengukuran, 'RDI', null, session('dies_id'));
        }
    }

    private function createApprovalRequest($model, $prefix, $punchId, $diesId)
    {
        $autonum = $model->autonumber(["substr(req_id,3,6)" => date('ymd')])->first();
        $id = !$autonum ? $prefix . date("ymd") . "0001" : $this->generateNewId($autonum->req_id, $prefix);

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
    }

    private function generateNewId($req_id, $prefix)
    {
        $noUrut = (int) substr($req_id, 9, 4);
        $noUrut++;
        return $prefix . date("ymd") . sprintf("%04s", $noUrut);
    }
}
