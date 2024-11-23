@extends('layout.metronic')
@section('main-content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
            <div class="col-12">
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title fs-1 fw-bold">Log History Approved and Rejected</h3>
                    </div>
                </div>
                
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title fs-3 fw-bold">Pengukuran</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table id="log_approval_1" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Merk</th>
                                            <th>Jenis</th>
                                            <th>Submission by</th>
                                            <th>Submission date</th>
                                            <th class="text-center">Status</th>
                                            <th>Approve by</th>
                                            <th>Approved at</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1 ?>
                                        @foreach ($dataApprPengukuran as $item)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            @if ($item->punch_id != null)
                                                @foreach ($dataPunch as $punch)
                                                    @if ($item->punch_id == $punch->id)
                                                    <td>{{$punch->merk}}</td>
                                                    <td>{{$punch->jenis}}</td>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if ($item->dies_id != null)
                                                @foreach ($dataDies as $dies)
                                                    @if ($item->dies_id == $dies->id)
                                                        <td>{{$dies->merk}}</td>
                                                        <td>{{$dies->jenis}}</td>
                                                    @endif
                                                @endforeach
                                            @endif
                                            <td>{{$item->username}}</td>
                                            <td>{{$item->tgl_submit}}</td>
                                            @if ($item->is_approved == '1' and $item->is_rejected == '0')
                                                <td class="text-center">
                                                    <button class="btn btn-success btn-sm w-100 fs-5 fw-semibold">
                                                        Approved
                                                    </button>
                                                </td>
                                            @endif
                                            @if ($item->is_approved == '0' and $item->is_rejected == '1')
                                                <td class="text-center">
                                                    <button class="btn btn-danger btn-sm w-100 fs-5 fw-semibold">
                                                        Rejected
                                                    </button>
                                                </td>
                                            @endif
                                            <td>{{$item->approved_by}}</td>
                                            <td>{{$item->approved_at}}</td>
                                            <td class="text-center">
                                                <a href="/data/approval/history/pengukuran/{{$item->req_id}}">
                                                    <button class="btn btn-secondary btn-sm fw-bold">
                                                        <i class="lab la-sistrix fs-2"></i>
                                                        open
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title fs-3 fw-bold">Disposal</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table id="log_approval_2" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Merk</th>
                                            <th>Jenis</th>
                                            <th>Submission by</th>
                                            <th>Submission date</th>
                                            <th class="text-center">Status</th>
                                            <th>Approve by</th>
                                            <th>Approved at</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1 ?>
                                        @foreach ($dataApprDisposal as $item)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            @if ($item->punch_id != null)
                                                @foreach ($dataPunch as $punch)
                                                    @if ($item->punch_id == $punch->id)
                                                    <td>{{$punch->merk}}</td>
                                                    <td>{{$punch->jenis}}</td>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if ($item->dies_id != null)
                                                @foreach ($dataDies as $dies)
                                                    @if ($item->dies_id == $dies->id)
                                                        <td>{{$dies->merk}}</td>
                                                        <td>{{$dies->jenis}}</td>
                                                    @endif
                                                @endforeach
                                            @endif
                                            <td>{{$item->username}}</td>
                                            <td>{{$item->tgl_submit}}</td>
                                            @if ($item->is_approved == '1' and $item->is_rejected == '0')
                                                <td class="text-center">
                                                    <button class="btn btn-success btn-sm w-100 fs-5 fw-semibold">
                                                        Approved
                                                    </button>
                                                </td>
                                            @endif
                                            @if ($item->is_approved == '0' and $item->is_rejected == '1')
                                                <td class="text-center">
                                                    <button class="btn btn-danger btn-sm w-100 fs-5 fw-semibold">
                                                        Rejected
                                                    </button>
                                                </td>
                                            @endif
                                            <td>{{$item->approved_by}}</td>
                                            <td>{{$item->approved_at}}</td>
                                            <td class="text-center">
                                                <a href="#">
                                                    <button class="btn btn-secondary btn-sm fw-bold">
                                                        <i class="lab la-sistrix fs-2"></i>
                                                        open
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection