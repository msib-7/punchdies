<?php

namespace App\Http\Controllers;

use App\Models\Permissions;

class APIContr extends Controller
{
    public function getDataPermission_api()
    {

        // $Permission = new Permissions();
        $dataPermission = Permissions::all();

        dd($dataPermission);
    }
}
