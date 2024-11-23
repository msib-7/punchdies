<?php

namespace App\Http\Controllers;

use App\Models\Lines;
use Illuminate\Http\Request;

class LineController extends Controller
{
    public function manajemen_line()
    {
        $dataLine = Lines::all();
        $data['dataLine'] = $dataLine;

        return view('admin.manajemen-line.data-line', $data);
    }

    public function add_line(Request $request)
    {
        $nama_line = strtoupper($request->nama_line);
        $cekLine = Lines::where('nama_line', '=', $nama_line)->first();
        if (!$cekLine) {
            $saveLine = [
                'nama_line' => $nama_line,
            ];
            Lines::create($saveLine);
            return redirect(route('user'))->with('success', 'User ' . $nama_line . ' berhasil dibuat!');
        } else {
            return redirect(route('user'))->with('error', 'Username sudah ada!');
        }
    }
    public function edit_line(Request $request, $nline)
    {
        $data = Lines::where('nama_line', '=', $nline)->first();
        $request->session()->put('nline', $nline);
        return response()->json([
            'success' => true,
            'message' => 'User Data',
            'data' => $data
        ]);
    }
    public function update_line(Request $request)
    {
        $nline = session()->get('nline');
        $nama_line = ucwords($request->nama_line_edit);
        $dataUpdate = [
            'nama_line' => $nama_line,
        ];
        Lines::where('nama_line', '=', $nline)->update($dataUpdate);
        return redirect(route('lines'))->with('success', 'Line Name berhasil diUpdate!');
    }
}
