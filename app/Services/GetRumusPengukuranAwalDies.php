<?php

namespace App\Services;

use App\Models\PengukuranAwalDies;

/**
 * Class GetRumusPengukuranAwalDies.
 */
class GetRumusPengukuranAwalDies
{
    public function handle($update_id)
    {
        // Ambil dies_id dari Pengukuran
        $dies = PengukuranAwalDies::select('dies_id')->where('no', $update_id)->first();

        // Ambil nilai dari Pengukuran
        $VisualDies = PengukuranAwalDies::where('dies_id', $dies->dies_id)->get();
        $KesesuaianDies = PengukuranAwalDies::where('dies_id', $dies->dies_id)->get();

        // Inisialisasi status sebagai OK
        $status = ['status' => 'OK'];

        // Periksa apakah terdapat NOK di VisualDies atau KesesuaianDies
        $hasNokInVisual = $VisualDies->contains(function ($item) {
            return $item->status === 'NOK'; // Asumsikan 'status' adalah nama kolom
        });

        $hasNokInKesesuaian = $KesesuaianDies->contains(function ($item) {
            return $item->status === 'NOK'; // Asumsikan 'status' adalah nama kolom
        });

        // Jika NOK ditemukan di salah satu koleksi, set status menjadi NOK
        if ($hasNokInVisual || $hasNokInKesesuaian) {
            $status = ['status' => 'NOK'];
        } else {
            $status = ['status' => 'OK'];
        }
        // Perbarui Status Pengukuran
        PengukuranAwalDies::where('dies_id', $dies->dies_id)->update($status);
    }
}
