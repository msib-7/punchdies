<?php

namespace App\Http\Controllers;

use App\Models\KalibrasiTool;
use Illuminate\Http\Request;

class KalibrasiToolController extends Controller
{
    public function index()
    {
        $data = KalibrasiTool::all();
        return view('admin.system.Kalibrasi.index',compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            // Add other validation rules as needed
        ]);

        KalibrasiTool::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('admin.system.kalibrasi.index')->with('success', 'Kalibrasi Tool created successfully.');
    }

    public function edit($id)
    {
        $tool = KalibrasiTool::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'Tools Data',
            'data' => $tool
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title_edit' => 'required',
            'description_edit' => 'required',
            // Add other validation rules as needed
        ]);

        KalibrasiTool::where('id', $request->id_tools)->update([
            'title' => $request->title_edit,
            'description' => $request->description_edit,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('admin.system.kalibrasi.index')->with('success', 'Kalibrasi Tool updated successfully.');
    }

    public function destroy($id)
    {
        $mesin = KalibrasiTool::findOrFail($id);
        $mesin->delete();
        return redirect()->route('admin.system.kalibrasi.index')->with('success', 'Kalibrasi Tool deleted successfully.');
    }
}
