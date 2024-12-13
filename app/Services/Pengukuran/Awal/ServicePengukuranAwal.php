<?php

namespace App\Services\Pengukuran\Awal;

use App\Models\Dies;
use App\Models\M_ApprDisposal;
use App\Models\M_ApprPengukuran;
use App\Models\PengukuranAwalDies;
use App\Models\PengukuranAwalPunch;
use App\Models\PengukuranRutinDies;
use App\Models\PengukuranRutinPunch;
use App\Models\Punch;
use DB;
use Request;

/**
 * Class ServicePengukuranAwal.
 */
class ServicePengukuranAwal
{
    public function addNote($note, $jenis, $route)
    {
        // $route = $this->getRoute($route);
        if (in_array($route, ['punch-atas', 'punch-bawah', 'dies'])) {
            $this->removeSessionVariables();

            if (in_array($route, ['punch-atas', 'punch-bawah'])) {
                $this->updatePunchNote($note, $jenis, $route);
            } elseif ($route == 'dies') {
                $this->updateDiesNote($note, $jenis, $route);
            }
        }

        return redirect(route('pnd.pa.atas.index'));
    }

    private function getRoute($segment)
    {
        if ($segment == 'punch-atas') {
            return 'atas';
        } elseif ($segment == 'punch-bawah') {
            return 'bawah';
        }
    }

    private function removeSessionVariables()
    {
        session()->remove('show_id');
        session()->remove('count');
        session()->remove('count_num');
    }

    private function updatePunchNote($note, $jenis, $route)
    {
        PengukuranAwalPunch::updateOrCreate([
            'punch_id' => session('punch_id'),
            'masa_pengukuran' => 'pengukuran awal'
        ], [
            'note' => $note,
        ]);
        return (new SetDraftStatusService)->handle($jenis, $route);
    }

    private function updateDiesNote($note, $jenis, $route)
    {
        PengukuranAwalDies::updateOrCreate([
            'dies_id' => session('dies_id'),
            'masa_pengukuran' => 'pengukuran awal'
        ], [
            'note' => $note,
        ]);
        return (new SetDraftStatusService)->handle($jenis, $route);
    }
}
