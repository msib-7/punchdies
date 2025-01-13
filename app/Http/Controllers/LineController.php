<?php

namespace App\Http\Controllers;

use App\Models\Lines;
use DB;
use Illuminate\Http\Request;
use Log;

class LineController extends Controller
{
    public function manajemen_line()
    {
        $dataLine = Lines::orderBy('nama_line')->get();
        $data['dataLine'] = $dataLine;

        return view('admin.manajemen-line.data-line', $data);
    }

    public function add_line(Request $request)
    {
        $cekLine = Lines::where('nama_line', '=', $request->nama_line)->first();
        if (!$cekLine) {
            if($request->nama_line == ''){
                return redirect(route('admin.line.index'))->with('error', "field cannot be empty!");
            }else{
                try {
                    DB::beginTransaction();
                    
                    Lines::create([
                        'nama_line' => strtoupper($request->nama_line),
                    ]);

                    DB::commit();
                    
                    return redirect(route('admin.line.index'))->with('success', $request->nama_line . ' berhasil dibuat!');
                    
                } catch (\Throwable $th) {
                    DB::rollBack();
                    // Log error untuk debugging
                    Log::error('Error Add Line : ' . $th->getMessage());
                    
                    return redirect(route('admin.line.index'))->with('error', 'Something Went Wrong!');
                }
            }
        }else{

            return redirect(route('admin.line.index'))->with('error', $request->nama_line . ' Sudah Ada!');

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
        $cekLine = Lines::where('nama_line', '=', $nama_line)->exists();
        if (!$cekLine) {
            if ($nama_line == '') {
                return redirect(route('admin.line.index'))->with('error', "field cannot be empty!");
            } else {
                try {
                    DB::beginTransaction();

                    $dataUpdate = [
                        'nama_line' => $nama_line,
                    ];
                    Lines::where('nama_line', '=', $nline)->update($dataUpdate);

                    DB::commit();

                    return redirect(route('admin.line.index'))->with('success', 'Nama Line berhasil diUpdate!');

                } catch (\Throwable $th) {
                    DB::rollBack();
                    // Log error untuk debugging
                    Log::error('Error Add Line : ' . $th->getMessage());

                    return redirect(route('admin.line.index'))->with('error', 'Something Went Wrong!');
                }
            }
        } else {

            return redirect(route('admin.line.index'))->with('error', $nama_line . ' Sudah Ada!');

        }
    }
    public function delete_line($id)
    {
        Lines::where('id', '=', $id)->delete();
        return redirect(route('admin.line.index'))->with('success', 'Line deleted successfully');
    }
}
