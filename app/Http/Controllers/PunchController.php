<?php

namespace App\Http\Controllers;

use App\Models\M_Punch;
use Illuminate\Http\Request;

class PunchController extends Controller
{
    public function show_all_punch(Request $request)
    {
        $dataPunch = M_Punch::where(['jenis' => $request->segment(2)])->get();

        $data['dataPunch'] = $dataPunch;
        return view('engineer.data.punch_atas', $data);
    }
}
