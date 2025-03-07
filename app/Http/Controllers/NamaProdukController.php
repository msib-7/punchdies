<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NamaProduk;

class NamaProdukController extends Controller
{
    public function index()
    {
        $data = NamaProduk::all();
        return view('admin.system.NamaProduk.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            // Add other validation rules as needed
        ]);

        NamaProduk::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('admin.system.NamaProduk.index')->with('success', 'Nama Produk created successfully.');
    }

    public function edit($id)
    {
        $namaProduk = NamaProduk::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'User Data',
            'data' => $namaProduk
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title_edit' => 'required',
            'description_edit' => 'required',
            // Add other validation rules as needed
        ]);

        NamaProduk::where('id', $request->id_NamaProduk)->update([
            'title' => $request->title_edit,
            'description' => $request->description_edit,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('admin.system.NamaProduk.index')->with('success', 'Nama Produk updated successfully.');
    }

    public function destroy($id)
    {
        $namaProduk = NamaProduk::findOrFail($id);
        $namaProduk->delete();
        return redirect()->route('admin.system.NamaProduk.index')->with('success', 'Nama Produk deleted successfully.');
    }
}