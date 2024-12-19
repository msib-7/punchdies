<?php

namespace App\Services\Rumus;

use App\Models\Dies;
use App\Models\PengukuranRutinDies;
use Illuminate\Http\Request;

/**
 * Class GetRumusPengukuranRutinDies.
 */
class GetRumusPengukuranRutinDies
{
    public function handle($update_id, $icb, $igp, $irt, $ipc)
    {
        $kesimpulan1 = '';
        $kesimpulan2 = '';
        $kesimpulan3 = '';
        $kesimpulan4 = '';
        $status = 'OK';
        $visual_dies = 'OK';

        // Ambil dies_id dari Pengukuran
        $dies = PengukuranRutinDies::select('dies_id', 'masa_pengukuran')->where('no', $update_id)->first();

        $i = 0;
        while ($i < count($update_id)) {
            $createDraftPengukuran = [
                'is_cincin_berbayang' => $icb[$i],
                'is_gompal' => $igp[$i],
                'is_retak' => $irt[$i],
                'is_pecah' => $ipc[$i],
            ];

            // Update the PengukuranRutinDies record
            PengukuranRutinDies::where('no', $update_id[$i])->latest()->update($createDraftPengukuran);

            // Check for "NOK" in any of the fields
            if ($icb[$i] === 'NOK') {
                $kesimpulan1 = "- Pengukuran NOK karena terdapat Cincin Berbayang pada Dies\n";
                $status = 'NOK';
                $visual_dies = 'NOK';
            }
            if ($igp[$i] === 'NOK') {
                $kesimpulan2 = "- Pengukuran NOK karena terdapat Gompal pada Dies\n";
                $status = 'NOK';
                $visual_dies = 'NOK';
            }
            if ($irt[$i] === 'NOK') {
                $kesimpulan3 = "- Pengukuran NOK karena terdapat Retak pada Dies\n";
                $status = 'NOK';
                $visual_dies = 'NOK';
            }
            if ($ipc[$i] === 'NOK') {
                $kesimpulan4 = "- Pengukuran NOK karena terdapat Pecah pada Dies\n";
                $status = 'NOK';
                $visual_dies = 'NOK';
            }

            $i++;
        }

        $kesimpulan = $kesimpulan1 . $kesimpulan2 . $kesimpulan3 . $kesimpulan4;
        //Perbarui Kesimpulan dari Pengukuran
        Dies::where(['dies_id' => $dies->dies_id, 'masa_pengukuran' => $dies->masa_pengukuran])->update(['kesimpulan' => $kesimpulan]);
        // Perbarui Status Pengukuran
        PengukuranRutinDies::where('dies_id', $dies->dies_id)->update(['status' => $status, 'visual_dies' => $visual_dies]);

        return response()->json(['kesimpulan' => $kesimpulan]);
    }
}