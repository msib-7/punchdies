<?php

namespace App\Http\Controllers\pengukuran\rutin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RutinPunchAtasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return (new SsGetIndexToDbService)->handle();
        }

        return view('v1.ss.operator.index');
    }
}
