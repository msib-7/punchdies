<?php

namespace App\Services\Pengukuran\Rutin;

use App\Models\Dies;
use App\Models\Punch;

/**
 * Class ServicePengukuranRutin
 */
class ServicePengukuranRutin
{
    public function addNote($note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3, $masa_pengukuran)
    {
        // $route = $this->getRoute($route);
        if (in_array($route, ['punch-atas', 'punch-bawah', 'dies'])) {
            $this->removeSessionVariables();

            if (in_array($route, ['punch-atas', 'punch-bawah'])) {
                $this->updatePunchNote($route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3, $masa_pengukuran);
            } elseif ($route == 'dies') {
                $this->updateDiesNote($route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3, $masa_pengukuran);
            }
        }

        return redirect(route('pnd.pr.'.$this->getRoute($route).'.index'));
    }

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

    private function removeSessionVariables()
    {
        session()->remove('show_id');
        session()->remove('count');
        session()->remove('count_num');
    }

    private function updatePunchNote($route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3, $masa_pengukuran)
    {
        Punch::updateOrCreate([
            'punch_id' => session('punch_id'),
            'masa_pengukuran' => $masa_pengukuran
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
        return (new SetDraftStatusServiceRutin)->handle($route, $masa_pengukuran);
    }

    private function updateDiesNote($route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3, $masa_pengukuran)
    {
        Dies::updateOrCreate([
            'dies_id' => session('dies_id'),
            'masa_pengukuran' => $masa_pengukuran
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
        return (new SetDraftStatusServiceRutin)->handle($route, $masa_pengukuran);
    }
}
