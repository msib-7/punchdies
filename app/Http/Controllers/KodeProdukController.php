<?php

namespace App\Http\Controllers;

use App\Models\KodeProduk;
use Illuminate\Http\Request;

class KodeProdukController extends Controller
{
    public function index()
    {
        $data = KodeProduk::all();
        return view('admin.system.kodeProduk.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'waktu_rutin' => 'required',
            'description' => 'required',
            // Add other validation rules as needed
        ]);

        KodeProduk::create([
            'title' => $request->title,
            'waktu_rutin' => $request->waktu_rutin,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('admin.system.kodeProduk.index')->with('success', 'Nama Produk created successfully.');
    }

    public function edit($id)
    {
        $kodeProduk = KodeProduk::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'User Data',
            'data' => $kodeProduk
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title_edit' => 'required',
            'waktu_rutin_edit' => 'required',
            'description_edit' => 'required',
            // Add other validation rules as needed
        ]);

        KodeProduk::where('id', $request->id_KodeProduk)->update([
            'title' => $request->title_edit,
            'waktu_rutin' => $request->waktu_rutin_edit,
            'description' => $request->description_edit,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('admin.system.kodeProduk.index')->with('success', 'Nama Produk updated successfully.');
    }

    public function destroy($id)
    {
        $kodeProduk = KodeProduk::findOrFail($id);
        $kodeProduk->delete();
        return redirect()->route('admin.system.kodeProduk.index')->with('success', 'Nama Produk deleted successfully.');
    }
}
