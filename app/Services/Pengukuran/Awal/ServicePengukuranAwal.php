<?php

namespace App\Services\Pengukuran\Awal;

use App\Models\Dies;
use App\Models\Punch;

/**
 * Class ServicePengukuranAwal.
 */
class ServicePengukuranAwal
{
    public function addNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $micrometer_digital, $caliper_digital, $dial_indicator_digital)
    {
        // $route = $this->getRoute($route);
        if (in_array($route, ['punch-atas', 'punch-bawah', 'dies'])) {
            $this->removeSessionVariables();
            
            if (in_array($route, ['punch-atas', 'punch-bawah'])) {
                $this->updatePunchNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $micrometer_digital, $caliper_digital, $dial_indicator_digital);
            } elseif ($route == 'dies') {
                $this->updateDiesNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $micrometer_digital, $caliper_digital, $dial_indicator_digital);
            }
        }
        
        return redirect(route('pnd.pa.'. $this->getRoute($route) .'.view', $id));
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

    private function updatePunchNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $micrometer_digital, $caliper_digital, $dial_indicator_digital)
    {
        Punch::updateOrCreate([
            'punch_id' => session('punch_id'),
            'masa_pengukuran' => 'pengukuran awal'
        ], [
            'referensi_drawing' => $referensi_drawing,
            'catatan' => $catatan,
            'kesimpulan' => $kesimpulan,
            'kalibrasi_micrometer' => $micrometer_digital,
            'kalibrasi_caliper' => $caliper_digital,
            'kalibrasi_dial_indicator' => $dial_indicator_digital,
        ]);
        return (new SetDraftStatusServiceAwal)->handle($id, $jenis, $route);
    }

    private function updateDiesNote($id, $note, $jenis, $route, $referensi_drawing, $catatan, $kesimpulan, $micrometer_digital, $caliper_digital, $dial_indicator_digital)
    {
        Dies::updateOrCreate([
            'dies_id' => session('dies_id'),
            'masa_pengukuran' => 'pengukuran awal'
        ], [
            'referensi_drawing' => $referensi_drawing,
            'catatan' => $catatan,
            'kesimpulan' => $kesimpulan,
            'kalibrasi_micrometer' => $micrometer_digital,
            'kalibrasi_caliper' => $caliper_digital,
            'kalibrasi_dial_indicator' => $dial_indicator_digital,
        ]);
        return (new SetDraftStatusServiceAwal)->handle($id, $jenis, $route);
    }
}
