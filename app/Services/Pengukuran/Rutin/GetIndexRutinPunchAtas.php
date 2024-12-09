<?php

namespace App\Services\Pengukuran\Rutin;

use App\Models\M_Punch;
use Request;

/**
 * Class GetIndexRutinPunchAtas.
 */
class GetIndexRutinPunchAtas
{
    public function handle(Request $request)
    {
        $data = M_Punch::query()
            ->where('jenis', $request->segment(3))
            ->where('is_delete_punch','0')
            ->where('is_approved', '-')
            ->where('masa_pengukuran', '!=', '-')
            ->orderBy('created_at', 'desc')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('action', function ($row) {
                $btn_1 = '<a href="' . route('v1.ss.edit', $row->id) . '" class="avtar avtar-s btn-link-info editPost"><i class="ti ti-eye f-20"></i></a>';
                $btn = $btn_1 . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-url="' . route('v1.ss.destroy', $row->id) . '" data-original-title="Delete" class="avtar avtar-s btn-link-danger deletePost"><i class="ti ti-trash f-20"></i></a>';
                return $btn;
            })
            ->addColumn('approvalnya', function ($row) {
                return $row->statusApproval->description;
            })
            ->addColumn('status', function ($row) {
                if ($row->status === 'draft') {
                    return '<span class="badge bg-danger">Draft</span>';
                } elseif ($row->status === 'publish') {
                    return '<span class="badge bg-success">Publish</span>';
                }
            })

            ->rawColumns(['action', 'approvalnya', 'status'])
            ->make(true);
    }
}
