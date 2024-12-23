<?php

namespace App\Http\Controllers\disposal;

use App\Http\Controllers\Controller;
use App\Models\Dies;
use App\Models\ApprovalDisposal;
use App\Models\PengukuranAwalPunch;
use App\Models\PengukuranRutinPunch;
use App\Models\Punch;
use Illuminate\Http\Request;

class DisposalController extends Controller
{
    public function index(){
        $approval = ApprovalDisposal::with('users')->get();
        $dataPunch = Punch::latest()->get();
        $dataDies = Dies::latest()->get();

        return view('disposal.index', compact('approval', 'dataPunch', 'dataDies'));
    }

    public function show($id){
        $dataApproval = ApprovalDisposal::find($id);

        if($dataApproval->punch_id != null || $dataApproval->punch_id != '-'){
            if ($dataApproval->is_draft == '1') {
                return redirect()->route('pnd.request.disposal.create', $dataApproval->punch_id)->with('warning', 'You are in draft mode!');
            }elseif($dataApproval->is_revisi == '1'){
                return redirect()->route('pnd.request.disposal.create', $dataApproval->punch_id)->with('warning', 'You are in revisi mode!');
            }else{
                $data = Punch::where('punch_id', $dataApproval->punch_id)->latest()->first();
            }
        }else{
            if ($dataApproval->is_draft == '1') {
                return redirect()->route('pnd.request.disposal.create', $dataApproval->dies_id)->with('warning', 'You are in draft mode!');
            }elseif($dataApproval->is_revisi == '1'){
                return redirect()->route('pnd.request.disposal.create', $dataApproval->dies_id)->with('warning', 'You are in revisi mode!');
            }else{
                $data = Dies::where('dies_id', $dataApproval->dies_id)->latest()->first();
            }
        }

        return view('disposal.show', compact('dataApproval', 'data'));
    }

    public function create($id) {
        $labelPunch = Punch::where('punch_id', $id)->latest()->first();
        $draft = ApprovalDisposal::where('punch_id', $id)->latest()->first();
        // dd($draft);

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
        return view('disposal.punch.pengukuran-rutin.create', compact('labelPunch', 'dataPengukuran', 'data', 'statusPengukuran', 'draft'));
    }

    public function store(Request $request, $id)
    {
        // Determine if there is an existing draft
        $existingDraft = ApprovalDisposal::where('punch_id', $id)->first();

        // Validate the request
        $request->validate([
            'dokumen1' => $existingDraft && $existingDraft->attach_1 ? 'file|mimes:pdf,jpg,jpeg,png|max:2048' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen2' => $existingDraft && $existingDraft->attach_2 ? 'file|mimes:pdf,jpg,jpeg,png|max:2048' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen3' => $existingDraft && $existingDraft->attach_3 ? 'file|mimes:pdf,jpg,jpeg,png|max:2048' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen4' => $existingDraft && $existingDraft->attach_4 ? 'file|mimes:pdf,jpg,jpeg,png|max:2048' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen5' => $existingDraft && $existingDraft->attach_5 ? 'file|mimes:pdf,jpg,jpeg,png|max:2048' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Determine punch_id and dies_id based on existence
        $data = Punch::where('punch_id', $id)->first() ?? Dies::where('dies_id', $id)->first();
        $punch_id = $data instanceof Punch ? $data->punch_id : null;
        $dies_id = $data instanceof Dies ? $data->dies_id : null;

        // Generate unique request ID
        $autonum = ApprovalDisposal::where('req_id', 'like', 'DIS' . date('ymd') . '%')->latest()->first();
        $newId = !$autonum ? "DIS" . date("ymd") . "0001" : "DIS" . date("ymd") . sprintf("%04s", (int) substr($autonum->req_id, 9, 4) + 1);

        // Handle file uploads
        $filePaths = [];
        foreach (range(1, 5) as $i) {
            $file = $request->file('dokumen' . $i);
            if ($file) {
                $fileName = 'disposal_' . $newId . '_' . $i . '_' . time() . '.' . $file->getClientOriginalExtension();
                $filePaths['attach_' . $i] = $file->storeAs('uploads', $fileName, 'public');
            } else {
                // If no new file is uploaded, retain the existing file path
                $filePaths['attach_' . $i] = $existingDraft ? $existingDraft->{'attach_' . $i} : '-';
            }
        }

        // Create or update the record
        ApprovalDisposal::updateOrCreate(['punch_id' => $id], array_merge([
            'req_id' => $newId,
            'punch_id' => $punch_id,
            'dies_id' => $dies_id,
            'user_id' => auth()->user()->id,
            'tgl_submit' => now(),
            'due_date' => now()->addDays(6),
            'by' => '-',
            'at' => null,
            'req_note' => $request->note,
            'is_draft' => '0',
            'is_waiting' => '1',
            'is_approved' => '0',
            'is_rejected' => '0',
            'is_revisi' => '0',
        ], $filePaths));

        return redirect()->back()->with('success', 'Files uploaded successfully!');
    }

    public function saveDraft(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'dokumen1' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen2' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen3' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen4' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen5' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $isRevisi = ApprovalDisposal::where('punch_id', $id)->first();

        // Determine punch_id and dies_id based on existence
        $data = Punch::where('punch_id', $id)->first() ?? Dies::where('dies_id', $id)->first();
        $punch_id = $data instanceof Punch ? $data->punch_id : null;
        $dies_id = $data instanceof Dies ? $data->dies_id : null;

        // Generate unique request ID
        $autonum = ApprovalDisposal::where('req_id', 'like', 'DIS' . date('ymd') . '%')->latest()->first();
        $newId = !$autonum ? "DIS" . date("ymd") . "0001" : "DIS" . date("ymd") . sprintf("%04s", (int) substr($autonum->req_id, 9, 4) + 1);

        // Handle file uploads
        $filePaths = [];
        foreach (range(1, 5) as $i) {
            $file = $request->file('dokumen' . $i);
            if ($file) {
                $fileName = 'disposal_' . $newId . '_' . $i . '_' . time() . '.' . $file->getClientOriginalExtension();
                $filePaths['attach_' . $i] = $file->storeAs('uploads', $fileName, 'public');
            } else {
                // If no new file is uploaded, keep the existing value
                $existingDraft = ApprovalDisposal::where('punch_id', $id)->first();
                $filePaths['attach_' . $i] = $existingDraft ? $existingDraft->{'attach_' . $i} : '-'; // Default value if no existing draft
            }
        }

        if ($isRevisi != null) {
            if($isRevisi->is_revisi == '1'){
                // Update the existing record
                ApprovalDisposal::updateOrCreate(['punch_id' => $id], array_merge([
                    'user_id' => auth()->user()->id,
                    'tgl_submit' => now(),
                    'req_note' => $request->note ?? '-',
                    'is_draft' => '1',
                    'is_waiting' => '0',
                    'is_approved' => '0',
                    'is_rejected' => '0',
                    'is_revisi' => '1',
                ], $filePaths))->latest();

                return redirect()->back()->with('success', 'Data Revisi Saved to Draft!');
            }
            // Create or update the record
            ApprovalDisposal::updateOrCreate(['punch_id' => $id], array_merge([
                'req_id' => $newId,
                'punch_id' => $punch_id,
                'dies_id' => $dies_id,
                'user_id' => auth()->user()->id,
                'tgl_submit' => now(),
                'due_date' => null,
                'by' => '-',
                'at' => null,
                'approved_note' => '-',
                'req_note' => $request->note ?? '-',
                'is_draft' => '1',
                'is_waiting' => '0',
                'is_approved' => '0',
                'is_rejected' => '0',
                'is_revisi' => '0',
            ], $filePaths))->latest();

            return redirect()->back()->with('warning', 'Data Saved to Draft!');
        }

    }
}
