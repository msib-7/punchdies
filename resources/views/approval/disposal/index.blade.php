@extends('layout.metronic')
@section('main-content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title fs-1 fw-bold">Request Approval Disposal</h3>
                            <div class="card-toolbar">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="fs-3 fw-semibold">
                                            <span>Waiting List: {{ $approval->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 order-sm-first">
                                    <table id="dboard_Table1" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>ID Request</th>
                                                <th>Merk</th>
                                                <th>Jenis</th>
                                                <th>Pengukuran</th>
                                                <th>Submission Date</th>
                                                <th>Submission by</th>
                                                <th>Line</th>
                                                <th>Due Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;?>
                                            @foreach ($approval as $item)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$item->req_id}}</td>
                                                @if ($item->punch_id != null)
                                                    @foreach ($dataPunch as $punch)
                                                        @if ($item->punch_id == $punch->punch_id)
                                                            <td>{{$punch->merk}}</td>
                                                            <td>{{$punch->jenis}}</td>
                                                            <td>{{$punch->masa_pengukuran}}</td>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                @endif
                                                @if ($item->dies_id != null)
                                                    @foreach ($dataDies as $dies)
                                                        @if ($item->dies_id == $dies->dies_id)
                                                            <td>{{$dies->merk}}</td>
                                                            <td>{{$dies->jenis}}</td>
                                                            <td>{{$dies->masa_pengukuran}}</td>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                @endif
                                                {{-- @if ($item->punch_id != null || $item->punch_id != '-')
                                                    @foreach ($dataPunch as $punch)
                                                        @if ($item->punch_id == $punch->punch_id)
                                                            <td>{{$punch->merk}}</td>
                                                            <td>{{$punch->jenis}}</td>
                                                            <td>{{$punch->masa_pengukuran}}</td>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                @if ($item->dies_id != null || $item->dies_id != '-')
                                                    @foreach ($dataDies as $dies)
                                                        @if ($item->dies_id == $dies->dies_id)
                                                            <td>{{$dies->merk}}</td>
                                                            <td>{{$dies->jenis}}</td>
                                                            <td>{{$dies->masa_pengukuran}}</td>
                                                        @endif
                                                    @endforeach
                                                @endif --}}
                                                <td>{{$item->tgl_submit}}</td>
                                                <td>{{$item->users->nama}}</td>
                                                <td>{{$item->users->lines->nama_line}}</td>
                                                <td>{{$item->due_date}}</td>
                                                <td class="text-center">
                                                    @if ($item->is_approved == '1' && $item->is_rejected == '0')
                                                        <button class="btn btn-success btn-sm w-100 fs-5 fw-semibold">
                                                            Approved
                                                        </button>
                                                    @elseif ($item->is_rejected == '1' && $item->is_approved == '0')
                                                        <button class="btn btn-danger btn-sm w-100 fs-5 fw-semibold">
                                                            Rejected
                                                        </button>
                                                    @else
                                                        <a href="{{route('pnd.approval.dis.show', $item->id)}}">
                                                            <button class="btn btn-sm btn-primary">
                                                                <i class="las la-search fs-2"></i>
                                                                Open
                                                            </button>
                                                        </a>
                                                    @endif
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