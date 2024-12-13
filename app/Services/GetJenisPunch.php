<?php

namespace App\Services;

use Request;

/**
 * Class GetJenisPunch.
 */
class GetJenisPunch
{
    public function handle($jenis)
    {
        if ($jenis == 'punch-atas') {
            $data['jenisPunch'] = 'Punch Atas';
            $data['jenis'] = 'punch-atas';
            $data['route'] = 'atas';
        } elseif ($jenis == 'punch-bawah') {
            $data['jenisPunch'] = 'Punch Bawah';
            $data['jenis'] = 'punch-bawah';
            $data['route'] = 'bawah';
        }

        return $data;                                           
    }
}
