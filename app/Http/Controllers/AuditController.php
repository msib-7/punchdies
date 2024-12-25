<?php

namespace App\Http\Controllers;

use App\Models\Audit_tr;
use Illuminate\Http\Request;
use Route;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        // Fetch data from the database
        $dataAudit = Audit_tr::with(['users', 'users.lines']) // Eager load relationships
            ->orderBy('created_at', 'desc') // Order by date
            ->get();

        // Return data as JSON
        return response()->json($dataAudit);
    }

    public function audit_trail_guest(Request $request)
    {
        $dataAudit = Audit_tr::with('users')
            ->orderBy('created_at', 'Desc')
            ->get();

        // Inisialisasi array untuk menyimpan semua perubahan
        $allChanges = [];

        // Iterasi setiap catatan audit
        foreach ($dataAudit as $audit) {
            // Periksa apakah new_data dan old_data adalah string sebelum mendekode
            $newData = is_string($audit->new_data) ? json_decode($audit->new_data, true) : $audit->new_data;
            $oldData = is_string($audit->old_data) ? json_decode($audit->old_data, true) : $audit->old_data;

            // Jika newData bukan array, set menjadi array kosong
            if (!is_array($newData)) {
                $newData = []; // Set newData menjadi array kosong jika bukan array
            }

            // Jika oldData bukan array, set menjadi null
            if (!is_array($oldData)) {
                $oldData = null; // Set oldData menjadi null jika bukan array
            }

            // Hapus field yang tidak ingin ditampilkan dari newData
            $fieldsToHideFromNewData = ['user_id', 'role_id', 'model_id', 'line_id', 'password'];
            foreach ($fieldsToHideFromNewData as $field) {
                unset($newData[$field]);
            }

            // Hapus created_at dan updated_at dari oldData jika ada
            if (is_array($oldData)) {
                unset($oldData['created_at']);
                unset($oldData['updated_at']);
            }

            // Inisialisasi array untuk menyimpan perubahan untuk catatan audit saat ini
            $changes = [];

            // Bandingkan kedua array
            foreach ($newData as $key => $newValue) {
                // Pastikan oldData adalah array sebelum memeriksa kunci
                if (is_array($oldData) && array_key_exists($key, $oldData)) {
                    if ($oldData[$key] !== $newValue) {
                        $changes[$key] = [
                            'old' => $oldData[$key],
                            'new' => $newValue,
                        ];
                    }elseif($oldData[$key] === $newValue){
                        $changes[$key] = [
                            'old' => $oldData[$key],
                            'new' => $newValue,
                        ];
                    }
                } else {
                    // Jika oldData adalah null, Anda juga dapat menangani kasus ini jika diperlukan
                    if ($oldData === null) {
                        $changes[$key] = [
                            'old' => null,
                            'new' => $newValue,
                        ];
                    }
                }
            }

            // Hanya tambahkan perubahan jika ada
            if (!empty($changes)) {
                $allChanges[$audit->id] = $changes; // Mengasumsikan `id` adalah pengidentifikasi unik untuk setiap catatan audit
            }
        }

        return view("audit/audit_guest", compact('dataAudit', 'allChanges'));
    }
}
