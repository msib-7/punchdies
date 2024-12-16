<?php

namespace App\Services\Rumus;

use App\Models\PengukuranRutinPunch;

/**
 * Class GetRumusPengukuranRutinPunch.
 */
class GetRumusPengukuranRutinPunch
{
    public function handle($update_id) {
        //Get punch_id dari Pengukuran
        $punch = PengukuranRutinPunch::select('punch_id')->where('no', $update_id)->first();

        // Definisikan nilai working length
        $workingLengthMax = PengukuranRutinPunch::where('punch_id', $punch->punch_id)->max('working_length_rutin'); // Contoh nilai maksimum
        $workingLengthMin = PengukuranRutinPunch::where('punch_id', $punch->punch_id)->min('working_length_rutin'); // Contoh nilai minimum
        $workingLengthInitial = array(1.22, 1.23, 1.21, 1.24); // Contoh array nilai pengukuran awal

        // Hitung selisih
        $selisihMaxMin = $workingLengthMax - $workingLengthMin;

        // Tentukan batas penerimaan
        $batasMaxMin = 0.05;
        $batasInitial = 0.025;

        // Cek apakah selisih memenuhi batas penerimaan
        if ($selisihMaxMin <= $batasMaxMin) {
            // Cek untuk setiap nilai pengukuran awal
            $diterima = true;
            foreach ($workingLengthInitial as $nilai) {
                $selisihInitial = abs($workingLengthMax - $nilai);
                if ($selisihInitial > $batasInitial) {
                    $diterima = false;
                    break;
                }
            }
            
            if ($diterima) {
                $status = [
                    'status' => 'OK',
                ];
            } else {
                $status = [
                    'status' => 'NOK',
                ];
            }
        } else {
            $status = [
                'status' => 'NOK',
            ];
        }

        PengukuranRutinPunch::where('punch_id', $punch->punch_id)->update($status);
    }
}
