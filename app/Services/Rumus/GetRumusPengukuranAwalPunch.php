<?php

namespace App\Services\Rumus;

use App\Models\PengukuranAwalPunch;

/**
 * Class GetRumusPengukuranAwalPunch.
 */
class GetRumusPengukuranAwalPunch
{
    public function handle($update_id)
    {
        //Get punch_id dari Pengukuran
        $punch = PengukuranAwalPunch::select('punch_id')->where('no', $update_id)->first();
        //Get Max Value dari Pengukuran
        $maxVal = PengukuranAwalPunch::where('punch_id', $punch->punch_id)->max('working_length');
        $minVal = PengukuranAwalPunch::where('punch_id', $punch->punch_id)->min('working_length');
        // hitung selisih max & min value
        $SelisihVal = bcadd($maxVal - $minVal, '0', '2');
        if ($SelisihVal <= 0.05) {
            $status = [
                'status' => 'OK',
            ];
        } else {
            $status = [
                'status' => 'NOK',
            ];
        }
        //update Status Pengukuran
        PengukuranAwalPunch::where('punch_id', $punch->punch_id)->update($status);
    }
}
