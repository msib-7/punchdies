<?php

namespace App\Http\Controllers\disposal;

use App\Http\Controllers\Controller;
use App\Models\Dies;
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
        }else{
            $statusPengukuran = '<span class="badge badge-success fs-6">OK</span>';
        }

        // dd($dataPengukuran);
        return view('disposal.punch.pengukuran-rutin.create', compact('labelPunch', 'dataPengukuran', 'data', 'statusPengukuran'));
    }

    public function store(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'dokumen1' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen2' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen3' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen4' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen5' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Determine punch_id and dies_id based on existence
        $data = Punch::where('punch_id', $id)->first() ?? Dies::where('dies_id', $id)->first();
        $punch_id = $data instanceof Punch ? $data->punch_id : null;
        $dies_id = $data instanceof Dies ? $data->dies_id : null;

        // Generate unique request ID
        $autonum = M_ApprDisposal::where('req_id', 'like', 'DIS' . date('ymd') . '%')->latest()->first();
        $newId = !$autonum ? "DIS" . date("ymd") . "0001" : "DIS" . date("ymd") . sprintf("%04s", (int) substr($autonum->req_id, 9, 4) + 1);

        // Handle file uploads
        $filePaths = [];
        foreach (range(1, 5) as $i) {
            $file = $request->file('dokumen' . $i);
            if ($file) {
                $fileName = 'disposal_' . $newId . '_' . $i . '_' . time() . '.' . $file->getClientOriginalExtension();
                $filePaths['attach_' . $i] = $file->storeAs('uploads', $fileName, 'public');
            } else {
                $filePaths['attach_' . $i] = '-'; // Default value if no file is uploaded
            }
        }

        // Create or update the record
        M_ApprDisposal::updateOrCreate(['punch_id' => $id], array_merge([
            'req_id' => $newId,
            'punch_id' => $punch_id,
            'dies_id' => $dies_id,
            'user_id' => auth()->user()->id,
            'tgl_submit' => now(),
            'due_date' => now()->addDays(6),
            'by' => '-',
            'at' => null,
            'approved_note' => '-',
            'req_note' => $request->note,
            'is_draft' => '0',
            'is_waiting' => '1',
            'is_approved' => '0',
            'is_rejected' => '0',
        ], $filePaths));

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
