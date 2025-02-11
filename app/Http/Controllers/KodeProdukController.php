<?php

namespace App\Http\Controllers;

use App\Models\Dies;
use App\Models\KodeProduk;
use App\Models\Punch;
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
        return redirect()->route('admin.system.kodeProduk.index')->with('success', 'Kode Produk created successfully.');
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
            'waktu_rutin_edit' => 'required|integer',
            'description_edit' => 'required',
        ]);

        $id = $request->id_KodeProduk;

        // Update KodeProduk
        KodeProduk::where('id', $id)->update([
            'title' => $request->title_edit,
            'waktu_rutin' => $request->waktu_rutin_edit,
            'description' => $request->description_edit,
            'user_id' => auth()->user()->id
        ]);

        // Update Punch and Dies
        $this->updateNextPengukuran(Punch::class, $id, $request->waktu_rutin_edit);
        $this->updateNextPengukuran(Dies::class, $id, $request->waktu_rutin_edit);

        return redirect()->route('admin.system.kodeProduk.index')->with('success', 'Kode Produk updated successfully.');
    }

    private function updateNextPengukuran($modelClass, $kodeProdukId, $waktuRutin)
    {
        $data = $modelClass::where('kode_produk', $kodeProdukId)
            ->where('is_approved', '!=', 1)
            ->get();

        foreach ($data as $item) {
            $item->next_pengukuran = $item->created_at->addMonths((int) $waktuRutin);
            $item->save();
        }
    }

    public function destroy($id)
    {
        $kodeProduk = KodeProduk::findOrFail($id);
        $kodeProduk->delete();
        return redirect()->route('admin.system.kodeProduk.index')->with('success', 'Kode Produk deleted successfully.');
    }
}
