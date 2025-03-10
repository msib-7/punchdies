<?php

namespace App\Services\Pengukuran\Awal;

use App\Models\Dies;
use App\Models\Punch;

/**
 * Class ServicePengukuranAwal.
 */
class ServicePengukuranAwal
{
    public function addNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3)
    {
        // $route = $this->getRoute($route);
        if (in_array($route, ['punch-atas', 'punch-bawah', 'dies'])) {
            $this->removeSessionVariables();
            
            if (in_array($route, ['punch-atas', 'punch-bawah'])) {
                $this->updatePunchNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3);
            } elseif ($route == 'dies') {
                $this->updateDiesNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3);
            }
        }
        
        // return redirect(route('pnd.pa.'. $this->getRoute($route) .'.view', $id));
        return redirect(route('pnd.pa.'. $this->getRoute($route) .'.index'));
    }

    private function getRoute($segment)
    {
        if ($segment == 'punch-atas') {
            return 'atas';
        } elseif ($segment == 'punch-bawah') {
            return 'bawah';
        }elseif ($segment == 'dies') {
            return 'dies';
        }
    }

    private function removeSessionVariables()
    {
        session()->remove('show_id');
        session()->remove('count');
        session()->remove('count_num');
    }

    private function updatePunchNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3)
    {
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
        return (new SetDraftStatusServiceAwal)->handle($id, $jenis, $route);
        // (new SetDraftStatusServiceAwal)->handle($id, $jenis, $route);

        // return redirect(route('pnd.pa.'. $this->getRoute($route) .'.view', $id));
    }

    private function updateDiesNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $kalibrasi_tools_1, $kalibrasi_tools_2, $kalibrasi_tools_3, $tgl_kalibrasi_1, $tgl_kalibrasi_2, $tgl_kalibrasi_3)
    {
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
        return (new SetDraftStatusServiceAwal)->handle($id, $jenis, $route);
    }
}
