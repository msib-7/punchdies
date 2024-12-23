<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use Illuminate\Http\Request;

class MesinController extends Controller
{
    public function index(){
        $data = Mesin::all();
        return view('admin.system.Mesin.index', compact('data'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            // Add other validation rules as needed
        ]);

        Mesin::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('admin.mesin.index')->with('success', 'Mesin created successfully.');
    }

    public function edit($id){
        $mesin = Mesin::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'User Data',
            'data' => $mesin
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'title_edit' => 'required',
            'description_edit' => 'required',
            // Add other validation rules as needed
        ]);

        Mesin::where('id', $request->id_mesin)->update([
            'title' => $request->title_edit,
            'description' => $request->description_edit,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('admin.mesin.index')->with('success', 'Mesin updated successfully.');
    }

    public function destroy($id){
        $mesin = Mesin::findOrFail($id);
        $mesin->delete();
        return redirect()->route('admin.mesin.index')->with('success', 'Mesin deleted successfully.');
    }
}
