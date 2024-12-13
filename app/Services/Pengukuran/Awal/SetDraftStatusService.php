<?php

namespace App\Services\Pengukuran\Awal;

use App\Http\Controllers\PunchController;
use App\Models\Dies;
use App\Models\M_ApprDisposal;
use App\Models\M_ApprPengukuran;
use App\Models\PengukuranAwalDies;
use App\Models\PengukuranAwalPunch;
use App\Models\PengukuranRutinDies;
use App\Models\PengukuranRutinPunch;
use App\Models\Punch;
use Request;

/**
 * Class SetDraftStatusService.
 */
class SetDraftStatusService
{
    public function handle($jenis, $route)
    {
        // dd($jenis);
        session()->remove('first_id');

        $updateDraftStatus = [
            'is_draft' => 0,
        ];

        if ($jenis == 'pengukuran-awal') {
            if (in_array($route, ['punch-atas', 'punch-bawah'])) {
                $this->updatePunchDraftStatus($updateDraftStatus, $this->getRoute($route));
            } elseif ($route == 'dies') {
                $this->updateDiesDraftStatus($updateDraftStatus);
            }
        } elseif ($jenis == 'pengukuran-rutin') {
            if (in_array($route, ['punch-atas', 'punch-bawah'])) {
                $this->updatePunchRutinDraftStatus($updateDraftStatus, $this->getRoute($route));
            } elseif ($route == 'dies') {
                $this->updateDiesRutinDraftStatus($updateDraftStatus);
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

    private function updatePunchDraftStatus($updateDraftStatus, $route)
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
            $msg = 'Pengukuran Awal Selesai Dilakukan! Menunggu Approval dari Manager QA'; 

            Punch::updateOrCreate([
                'punch_id' => session('punch_id'),
                'masa_pengukuran' => 'pengukuran awal'
            ], [
                'is_draft' => 0
            ]);

            $this->sendToApproval('punch');
        }
        
        // return (new PunchController)->index($this->getSegment($route));
        // return redirect(route('pnd.pa.' . $route . '.index'))->with($alert, $msg);
        
    }

    private function updateDiesDraftStatus($updateDraftStatus)
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
            $msg = 'Pengukuran Awal Selesai Dilakukan! Menunggu Approval dari Manager QA';

            Dies::updateOrCreate([
                'dies_id' => session('dies_id'), 
                'masa_pengukuran' => 'pengukuran awal'
            ], [
                'is_draft' => 0
            ]);

            $this->sendToApproval('dies');
        }

        return redirect(route('pnd.pa.dies.index'))->with($alert, $msg);
    }

    private function updatePunchRutinDraftStatus($updateDraftStatus, $route)
    {
        $getData = PengukuranRutinPunch::where([
            'punch_id' => session('punch_id'),
            'masa_pengukuran' => session('masa_pengukuran'),
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
            'masa_pengukuran' => session('masa_pengukuran'),
            'is_draft' => '1'
        ])->count();

        if ($cekStatus > 0) {
            $alert = 'warning';
            $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';
        } else {
            $alert = 'success';
            $msg = session('masa_pengukuran') . ' Selesai Dilakukan! Menunggu Approval dari Manager QA';

            Punch::updateOrCreate([
                'punch_id' => session('punch_id'),
                'masa_pengukuran' => 'pengukuran awal'
            ], [
                'is_draft' => 0
            ]);

            $this->sendToApproval('punch');
        }

        return redirect(route('pnd.pr.' . $route . '.index'))->with($alert, $msg);
    }

    private function updateDiesRutinDraftStatus($updateDraftStatus)
    {
        $getData = PengukuranRutinDies::where([
            'dies_id' => session('dies_id'),
            'masa_pengukuran' => session('masa_pengukuran'),
        ])
            ->where('outer_diameter', '!=', '0')
            ->where('inner_diameter_1', '!=', '0')
            ->where('inner_diameter_2', '!=', '0')
            ->where('ketinggian_dies', '!=', '0')
            ->where('visual', '!=', '-')
            ->where('kesesuaian_dies', '!=', '-');

        $getData->update($updateDraftStatus);

        $cekStatus = PengukuranRutinDies::where([
            'dies_id' => session('dies_id'),
            'masa_pengukuran' => session('masa_pengukuran'),
            'is_draft' => '1'
        ])->count();

        if ($cekStatus > 0) {
            $alert = 'warning';
            $msg = 'Pengukuran Disimpan sebagai Draft karena belum terisi Sepenuhnya';
        } else {
            $alert = 'success';
            $msg = session('masa_pengukuran') . ' Selesai Dilakukan! Menunggu Approval dari Manager QA';

            Dies::updateOrCreate([
                'dies_id' => session('dies_id'), 
                'masa_pengukuran' => 'pengukuran awal'
            ], [
                'is_draft' => 0
            ]);

            $this->sendToApproval('dies');
        }

        return redirect(route('pnd.pr.dies.index'))->with($alert, $msg);
    }

    private function sendToApproval($jenis)
    {
        $M_ApprPengukuran = new M_ApprPengukuran();
        $M_ApprDisposal = new M_ApprDisposal();

        if (in_array($jenis, ['punch-atas', 'punch-bawah'])) {
            $this->createApprovalRequest($M_ApprPengukuran, 'RPU', session('punch_id'), null);
        } elseif ($jenis == 'dies') {
            $this->createApprovalRequest($M_ApprPengukuran, 'RDI', null, session('dies_id'));
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
            'approved_by' => '-',
            'approved_at' => null,
            'is_approved' => '-',
            'is_rejected' => '-',
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
