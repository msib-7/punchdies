<?php

namespace App\Http\Controllers\disposal;

use App\Events\NotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Dies;
use App\Models\ApprovalDisposal;
use App\Models\PengukuranAwalDies;
use App\Models\PengukuranAwalPunch;
use App\Models\PengukuranRutinDies;
use App\Models\PengukuranRutinPunch;
use App\Models\Punch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DisposalController extends Controller
{
    public function index(){
        $approval = ApprovalDisposal::with('users')->where('is_approved', '!=', '1')->orderBy('created_at', 'DESC')->get();
        $dataPunch = Punch::latest()->get();
        $dataDies = Dies::latest()->get();

        return view('disposal.index', compact('approval', 'dataPunch', 'dataDies'));
    }

    public function show($id){
        $dataApproval = ApprovalDisposal::find($id);

        if($dataApproval->punch_id === null){
            if ($dataApproval->is_draft == '1') {
                session()->put('store', 'dies_id');
                return redirect()->route('pnd.request.disposal.create', $dataApproval->dies_id)->with('warning', 'You are in draft mode!');
            } elseif ($dataApproval->is_revisi == '1') {
                session()->put('store', 'dies_id');
                return redirect()->route('pnd.request.disposal.create', $dataApproval->dies_id)->with('warning', 'You are in revisi mode!');
            } else {
                $data = Dies::where('dies_id', $dataApproval->dies_id)->latest()->first();
            }
        }elseif($dataApproval->dies_id === null){
            if ($dataApproval->is_draft == '1') {
                session()->put('store', 'punch_id');
                return redirect()->route('pnd.request.disposal.create', $dataApproval->punch_id)->with('warning', 'You are in draft mode!');
            } elseif ($dataApproval->is_revisi == '1') {
                session()->put('store', 'punch_id');
                return redirect()->route('pnd.request.disposal.create', $dataApproval->punch_id)->with('warning', 'You are in revisi mode!');
            } else {
                $data = Punch::where('punch_id', $dataApproval->punch_id)->latest()->first();
            }
        }
        
        return view('disposal.show', compact('dataApproval', 'data'));
    }

    public function create($id) 
    {
        session()->remove('store');
        $queryPunch = Punch::where('punch_id', $id);
        $queryDies = Dies::where('dies_id', $id);

        $punchExist = $queryPunch->exists();
        $diesExist = $queryDies->exists();

        $labelIdentitas = $queryPunch->latest()->first() ?? $queryDies->latest()->first();

        if ($punchExist) {
            $draft = ApprovalDisposal::where('punch_id', $id)->latest()->first();
            $masaPengukuran = $labelIdentitas ? $labelIdentitas->masa_pengukuran : null;
            if ($masaPengukuran == 'pengukuran awal') {
                $dataPengukuran = PengukuranAwalPunch::where(['punch_id' => $id, 'masa_pengukuran' => $masaPengukuran])->latest()->get();
                $data = PengukuranAwalPunch::where(['punch_id' => $id, 'masa_pengukuran' => $masaPengukuran])->latest()->first();
            } else {
                $dataPengukuran = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => $masaPengukuran])->latest()->get();
                $data = PengukuranRutinPunch::where(['punch_id' => $id, 'masa_pengukuran' => $masaPengukuran])->latest()->first();
            }
        }elseif ($diesExist) {
            $draft = ApprovalDisposal::where('dies_id', $id)->latest()->first();
            $masaPengukuran = $labelIdentitas ? $labelIdentitas->masa_pengukuran : null;
            if ($masaPengukuran == 'pengukuran awal') {
                $dataPengukuran = PengukuranAwalDies::where(['dies_id' => $id, 'masa_pengukuran' => $masaPengukuran])->latest()->get();
                $data = PengukuranAwalDies::where(['dies_id' => $id, 'masa_pengukuran' => $masaPengukuran])->latest()->first();
            } else {
                $dataPengukuran = PengukuranRutinDies::where(['dies_id' => $id, 'masa_pengukuran' => $masaPengukuran])->latest()->get();
                $data = PengukuranRutinDies::where(['dies_id' => $id, 'masa_pengukuran' => $masaPengukuran])->latest()->first();
            }
        }

        // Periksa apakah terdapat NOK
        $hasNok = $dataPengukuran->contains(function ($item) {
            return $item->status === 'NOK';
        });

        if($hasNok){
            $statusPengukuran = '<span class="badge badge-danger fs-6">NOK</span>';
        }else{
            $statusPengukuran = '<span class="badge badge-success fs-6">OK</span>';
        }

        if($punchExist){
            session()->put('store', 'punch_id');
            return view('disposal.punch.create', compact('labelIdentitas', 'dataPengukuran', 'data', 'statusPengukuran', 'draft'));
        }elseif($diesExist){
            session()->put('store', 'dies_id');
            return view('disposal.dies.create', compact('labelIdentitas', 'dataPengukuran', 'data', 'statusPengukuran', 'draft'));
        }
    }

    public function store(Request $request, $id)
    {
        // Determine if there is an existing draft
        $existingDraft = ApprovalDisposal::where(session('store'), $id)->first();
        // Validate the request
        $request->validate([
            'dokumen1' => $existingDraft && $existingDraft->attach_1 ? 'file|mimes:pdf,jpg,jpeg,png|max:2048' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen2' => $existingDraft && $existingDraft->attach_2 ? 'file|mimes:pdf,jpg,jpeg,png|max:2048' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen3' => $existingDraft && $existingDraft->attach_3 ? 'file|mimes:pdf,jpg,jpeg,png|max:2048' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen4' => $existingDraft && $existingDraft->attach_4 ? 'file|mimes:pdf,jpg,jpeg,png|max:2048' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen5' => $existingDraft && $existingDraft->attach_5 ? 'file|mimes:pdf,jpg,jpeg,png|max:2048' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Determine punch_id and dies_id based on existence
        // $data = Punch::where('punch_id', $id)->first() ?? Dies::where('dies_id', $id)->first();
        $data = Punch::where('punch_id', $id)->first() ?? Dies::where('dies_id', $id)->first();
        $punch_id = $data instanceof Punch ? $data->punch_id : null;
        $dies_id = $data instanceof Dies ? $data->dies_id : null;

        // Generate unique request ID
        $autonum = ApprovalDisposal::where('req_id', 'like', 'DIS' . date('ymd') . '%')->latest()->first();
        $newId = !$autonum ? "DIS" . date("ymd") . "0001" : "DIS" . date("ymd") . sprintf("%04s", (int) substr($autonum->req_id, 9, 4) + 1);

        $filePaths = [];
        foreach (range(1,5) as $i) {
            $file = $request->file('dokumen' . $i);
            if($file){
                $fileName = 'disposal_' . $newId . '_' . $i . '_' . time() . '.' . $file->extension();
                $file->move(public_path('assets/img/disposals'), $fileName);
                $filePaths['attach_' . $i] = $fileName;
            } else {
                $filePaths['attach_' . $i] = $existingDraft ? $existingDraft->{'attach_' . $i} : '-';
            }
        }

        // // Handle file uploads
        // $filePaths = [];
        // foreach (range(1, 5) as $i) {
        //     $file = $request->file('dokumen' . $i);
        //     if ($file) {
        //         $fileName = 'disposal_' . $newId . '_' . $i . '_' . time() . '.' . $file->getClientOriginalExtension();
        //         $filePaths['attach_' . $i] = $file->storeAs('uploads', $fileName, 'public');
        //     } else {
        //         // If no new file is uploaded, retain the existing file path
        //         $filePaths['attach_' . $i] = $existingDraft ? $existingDraft->{'attach_' . $i} : '-';
        //     }
        // }

        // Create or update the record
        ApprovalDisposal::updateOrCreate([session('store') => $id], array_merge([
            'req_id' => $newId,
            'punch_id' => $punch_id,
            'dies_id' => $dies_id,
            'user_id' => auth()->user()->id,
            'tgl_submit' => now(),
            'due_date' => now()->addDays(6),
            'by' => auth()->user()->id,
            'at' => now(),
            'req_note' => $request->note,
            'is_draft' => '0',
            'is_waiting' => '1',
            'is_approved' => '0',
            'is_rejected' => '0',
            'is_revisi' => '0',
        ], $filePaths));

        // Retrieve the newly created or updated record
        $newApproval = ApprovalDisposal::where(session('store'), $id)->latest()->first();
        $disposalId = $newApproval->id;

        $users = User::whereHas('roles', function ($query) {
            $query->where('role_name', 'Manager Produksi');
            //   ->orWhere('role_name', 'Administraor');
        })->get();

        // if ($punchId == null || $punchId == '-') {
        //     $idView = $diesId;
        // } elseif ($diesId == null || $diesId == '-') {
        //     $idView = $punchId;
        // }
        $dataJenis = $data->jenis;
        if ($dataJenis == 'punch-atas') {
            $jenis = 'atas';
        } elseif($dataJenis == 'punch-bawah') {
            $jenis = 'bawah';
        } elseif($dataJenis == 'dies'){
            $jenis = 'dies';
        }

        if($data->masa_pengukuran == 'pengukuran awal'){
            $mp = 'pa';
        }else{
            $mp = 'pr';
        }

        // Buat NOtifikasi Ke Pengirim
        event(new NotificationEvent(
            auth()->user()->id,
            'Success Sending Disposal',
            'Data Permintaan Disposal telah dikirim oleh ' . auth()->user()->nama . ' ke Approval menunggu response dari Manager ',
            route('pnd.'.$mp.'.'.$jenis.'.index')
        ));

        $userEmails = []; // Array to store user emails
        $failedEmails = []; // Array to store emails that failed to send

        foreach ($users as $user) {
            // $userEmails[] = $user->email; // Store the email in the array

            // Buat NOtifikasi Ke Penerima
            event(new NotificationEvent(
                $user->user_id,
                'Waiting!, Approval Disposal',
                'User ' . auth()->user()->nama . ' telah mengirim data approval dan menunggu persetujuan Anda.',
                route('pnd.approval.dis.show', $newId)
            ));

            $message = 'Halo anda baru saja menerima permintaan persetujuan Disposal  yang telah dibuat oleh ' . auth()->user()->nama . ' Silahkan lakukan persetujuan segera.';
            $data = [
                'status' => 'Waiting Approval',
                'link' => route('pnd.approval.dis.show', $newId),
                'penerima' => $user->nama,
                'body' => $message
            ];

            try {
                // // Attempt to send notification to the user
                Mail::to($user->email)->send(new \App\Mail\SendApproval($data));
            } catch (\Exception $e) {
                // Log the error message
                Log::error('Failed to send email to ' . $user->email . ': ' . $e->getMessage());

                // Optionally, store the failed email for further processing or reporting
                $failedEmails[] = $user->email;
            }
        }

        // Optionally, log the successful emails sent
        Log::info('Emails sent to: ', $userEmails);

        // Optionally, log the failed emails
        if (!empty($failedEmails)) {
            Log::warning('Failed to send emails to: ', $failedEmails);
        }

        return redirect()->route('pnd.request.disposal.show', $disposalId)->with('success', 'Files uploaded successfully!');
    }

    public function saveDraft(Request $request)
    {
        $id = $request->id;
        // Validate the request
        $request->validate([
            'dokumen1' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen2' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen3' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen4' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen5' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Generate unique request ID
        $autonum = ApprovalDisposal::where('req_id', 'like', 'DIS' . date('ymd') . '%')->latest()->first();
        $newId = !$autonum ? "DIS" . date("ymd") . "0001" : "DIS" . date("ymd") . sprintf("%04s", (int) substr($autonum->req_id, 9, 4) + 1);

        // Handle file uploads
        $filePaths = [];
        foreach (range(1, 5) as $i) {
            $file = $request->file('dokumen' . $i);
            if ($file) {
                $fileName = 'disposal_' . $newId . '_' . $i . '_' . time() . '.' . $file->extension();
                $file->move(public_path('assets/img/disposals'), $fileName);
                $filePaths['attach_' . $i] = $fileName;
            } else {
                // If no new file is uploaded, keep the existing value
                $existingDraft = ApprovalDisposal::where(session('store'), $id)->first();
                $filePaths['attach_' . $i] = $existingDraft ? $existingDraft->{'attach_' . $i} : '-'; // Default value if no existing draft
            }
        }

        //Periksa Apakah data ini sudah pernah di draft sebelumnya
        $dataDraft = ApprovalDisposal::where(session('store'), $id)->orWhere('dies_id', $id);

        
        if($dataDraft->exists()){
            $isRevisi = $dataDraft->latest()->first();

            if ($isRevisi->is_revisi == '1') {
                // Update the existing record
                ApprovalDisposal::updateOrCreate([session('store') => $id], array_merge([
                    'user_id' => auth()->user()->id,
                    'tgl_submit' => now(),
                    'req_note' => $request->note ?? '-',
                    'is_draft' => '1',
                    'is_waiting' => '0',
                    'is_approved' => '0',
                    'is_rejected' => '0',
                    'is_revisi' => '1',
                ], $filePaths))->latest();

                session()->remove('store');
                return redirect()->back()->with('success', 'Data Revisi Saved to Draft!');
            } else {
                // Update the existing record
                ApprovalDisposal::updateOrCreate([session('store') => $id], array_merge([
                    'user_id' => auth()->user()->id,
                    'tgl_submit' => now(),
                    'req_note' => $request->note ?? '-',
                    'is_draft' => '1',
                    'is_waiting' => '0',
                    'is_approved' => '0',
                    'is_rejected' => '0',
                    'is_revisi' => '0',
                ], $filePaths))->latest();

                session()->remove('store');
                return redirect()->back()->with('success', 'Data Saved to Draft!');
            }
        }else{
            // Create a new record
            // Determine punch_id and dies_id based on existence
            $data = Punch::where('punch_id', $id)->first() ?? Dies::where('dies_id', $id)->first();
            $punch_id = $data instanceof Punch ? $data->punch_id : null;
            $dies_id = $data instanceof Dies ? $data->dies_id : null;


            ApprovalDisposal::updateOrCreate([session('store') => $id], array_merge([
                'req_id' => $newId,
                'punch_id' => $punch_id,
                'dies_id' => $dies_id,
                'user_id' => auth()->user()->id,
                'tgl_submit' => now(),
                'due_date' => null,
                'by' => auth()->user()->id,
                'at' => now(),
                'approved_note' => '-',
                'req_note' => $request->note ?? '-',
                'is_draft' => '1',
                'is_waiting' => '0',
                'is_approved' => '0',
                'is_rejected' => '0',
                'is_revisi' => '0',
            ], $filePaths))->latest();

            session()->remove('store');
            return redirect()->back()->with('warning', 'Data Saved to Draft!');
        }
    }
}
