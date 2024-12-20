<?php

namespace App\Http\Controllers\disposal;

use App\Http\Controllers\Controller;
use App\Models\M_ApprDisposal;
use App\Models\PengukuranAwalPunch;
use App\Models\PengukuranRutinPunch;
use App\Models\Punch;
use Illuminate\Http\Request;

class DisposalController extends Controller
{
    public function index(){
        return view('disposal.index');
    }

    public function create($id) {
        $labelPunch = Punch::where('punch_id', $id)->latest()->first();

        $masaPengukuran = $labelPunch->masa_pengukuran;
        if($masaPengukuran == 'pengukuran awal'){
            $dataPengukuran = PengukuranAwalPunch::where(['punch_id' => $id, 'masa_pengukuran' => $masaPengukuran])->latest()->get();
            $data = PengukuranAwalPunch::where(['punch_id' => $id, 'masa_pengukuran' => $masaPengukuran])->latest()->first();
        }else{
            $dataPengukuran = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => $masaPengukuran])->latest()->get();
            $data = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => $masaPengukuran])->latest()->first();
        }

        // Periksa apakah terdapat NOK
        $hasNok = $dataPengukuran->contains(function ($item) {
            return $item->status === 'NOK'; // Asumsikan 'status' adalah nama kolom
        });

        if($hasNok){
            $statusPengukuran = '<span class="badge badge-danger fs-6">NOK</span>';
        }

        // dd($dataPengukuran);
        return view('disposal.punch.pengukuran-rutin.create', compact('labelPunch', 'dataPengukuran', 'data', 'statusPengukuran'));
    }

    public function store(Request $request) {
        // Validate the request
        $request->validate([
            'dokumen1' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen2' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen3' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen4' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen5' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Handle file uploads
        $filePaths = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('dokumen' . $i)) {
                $file = $request->file('dokumen' . $i);

                // Create a custom file name
                $customFileName = 'dokumen_' . $i . '_' . time() . '.' . $file->getClientOriginalExtension();

                // Store the file with the custom name
                $filePath = $file->storeAs('uploads', $customFileName, 'public'); // Store in 'storage/app/public/uploads'
                $filePaths[] = $filePath; // Store the file path for further processing
            }
        }

        // dd($filePaths);
        // Optionally, save the file paths to the database or perform other actions

        return redirect()->back()->with('success', 'Files uploaded successfully!');

    }

    public function saveDraft(Request $request)
    {
        // Validate the request
        $request->validate([
            'dokumen1' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen2' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen3' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen4' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen5' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Handle file uploads and save paths
        $draft = new M_ApprDisposal();
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('dokumen' . $i)) {
                $file = $request->file('dokumen' . $i);
                $filePath = $file->store('drafts', 'public'); // Store in 'storage/app/public/drafts'
                $draft->{'dokumen' . $i} = $filePath; // Save the file path in the draft
            }
        }

        $draft->save(); // Save the draft to the database

    }
}
