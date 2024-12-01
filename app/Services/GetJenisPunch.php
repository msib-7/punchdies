<?php

namespace App\Services;

use Request;

/**
 * Class GetJenisPunch.
 */
class GetJenisPunch
{
    public function handle(Request $request)
    {
        if ($request->segment(2) == 'punch-atas') {
            $data['jenisPunch'] = 'Punch Atas';
            $data['jenis'] = 'punch-atas';
        } elseif ($request->segment(2) == 'punch-bawah') {
            $data['jenisPunch'] = 'Punch Bawah';
            $data['jenis'] = 'punch-bawah';
        }
    }
}
