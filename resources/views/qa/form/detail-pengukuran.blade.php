@extends('layout.metronic')
@section('main-content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
     <!--begin::Engage-->
	<div class="app-engage " id="kt_app_engage">  
		<!--begin::Prebuilts toggle-->
        <button class="app-engage-btn hover-dark" id="kt_drawer_example_basic_button">
            <i class="ki-duotone ki-information fs-1 pt-1 mb-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i>
            Bantuan
        </button>
	</div>
	<!--end::Engage-->
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="accordion" id="kt_accordion_1">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="kt_accordion_1_header_1">
                                            <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                                                <span class="fs-2 fw-bold">{{ strtoupper($labelIdentitas->merk) }}</span>
                                            </button>
                                        </h2>
                                        <div id="kt_accordion_1_body_1" class="accordion-collapse collapse show" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 col-lg-4">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="table-responsive">
                                                                    <table style="border: none;">
                                                                        <tbody>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Merk Punch
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    {{ strtoupper($labelIdentitas->merk) }}</td>
                                                                            </tr>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Bulan/Tahun Pembuatan
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    {{ strtoupper($labelIdentitas->bulan_pembuatan).' '.$labelIdentitas->tahun_pembuatan }}</td>
                                                                            </tr>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Nama Mesin Cetak
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    {{ strtoupper($labelIdentitas->nama_mesin_cetak) }}</td>
                                                                            </tr>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Kode/Nama Produk
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    <?php if(strtoupper($labelIdentitas->nama_produks->title) == strtoupper($labelIdentitas->kode_produks->title)) {?>
                                                                                        {{ strtoupper($labelIdentitas->nama_produks->title)}}
                                                                                    <?php } else {?>
                                                                                        {{ strtoupper($labelIdentitas->nama_produks->title)."/".strtoupper($labelIdentitas->kode_produks->title)}}
                                                                                    <?php }?>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-4">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="table-responsive">
                                                                    <table style="border: none;">
                                                                        <tbody>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Masa Pengukuran
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    {{ ucwords($labelIdentitas->masa_pengukuran) }}</td>
                                                                            </tr>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Tanggal Pengukuran
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    {{ date_format($tglPengukuran->created_at, 'd M Y') }}
                                                                                    {{-- {{ $labelIdentitas->created_at }} --}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Diukur oleh
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    {{ ucwords($labelIdentitas->username) }}</td>
                                                                            </tr>
                                                                            @if ($segment == 'approval')
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Status
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                </td>
                                                                            </tr>
                                                                            @endif
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-12 col-lg-4 d-flex align-items-center justify-content-center">
                                                        @if ($segment == 'approval')
                                                            <div class="flex-fill p-2">
                                                            <a href="/data/approval/pengukuran/reject/{{$req_id}}">
                                                                <button class="btn btn-danger btn-lg w-100 p-2" style="height: 100%; min-height: 5vh; max-height: 8vh;">
                                                                    Reject
                                                                </button>
                                                            </a>
                                                        </div>
                                                        <div class="flex-fill p-2">
                                                            <a href="/data/approval/pengukuran/approve/{{$req_id}}">
                                                                <button class="btn btn-success btn-lg w-100 p-2" style="height: 100%; min-height: 5vh; max-height: 8vh;">
                                                                    Approve
                                                                </button>
                                                            </a>
                                                        </div>
                                                        @endif
                                                        <?php
                                                            $at = $approvalInfo->at ? new DateTime($approvalInfo->at) : null;
                                                        ?>
                                                        @if ($segment == 'history')
                                                            <div class="row text-center">
                                                                <div class="col-12 mb-4">
                                                                    <?= $statusPengukuran ?>
                                                                </div>
                                                                <div class="col-12">
                                                                    <span class="badge badge-secondary fs-6 mb-2">{{ $approvalInfo->by }}</span>
                                                                    <br>
                                                                    <span class="badge badge-secondary fs-6">{{ $at ? date_format($at, 'd M Y') : '' }}</span>
                                                                    {{-- <span class="badge badge-secondary">by: </span>
                                                                    <span class="text-dark">{{ $approvalInfo->by }}</span> --}}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        @if ($jenis == 'punch')
                                        <div class="table-responsive">
                                            <table class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr style="background-color: ">
                                                        @if ($mp == 'awal')
                                                            {{-- Pengukuran Awal --}}
                                                            <th class="min-width-responsive text-center">No</th>
                                                            <th class="min-width-responsive text-center">A. Head Outer Diameter</th>
                                                            <th class="min-width-responsive text-center">E. Neck Diameter</th>
                                                            <th class="min-width-responsive text-center">F. Barrel</th>
                                                            <th class="min-width-responsive text-center">G. Overall Length</th>
                                                            <th class="min-width-responsive text-center">I. Tip Diameter 1</th>
                                                            <th class="min-width-responsive text-center">J. Tip Diameter 2</th>
                                                            <th class="min-width-responsive text-center">K. Cup Depth</th>
                                                            <th class="min-width-responsive text-center">L. Working Length</th>
                                                            <th class="text-center">Status</th>
                                                        @elseif ($mp == 'rutin')
                                                            {{-- Pengukuran Rutin --}}
                                                            <th class="min-width-responsive text-center">No</th>
                                                            <th class="min-width-responsive text-center">G. Overall Length</th>
                                                            <th class="min-width-responsive text-center">L. Working Length <b>(AWAL)</b></th>
                                                            <th class="min-width-responsive text-center">L. Working Length <b>(RUTIN)</b></th>
                                                            <th class="min-width-responsive text-center">K. Cup Depth</th>
                                                            <th class="min-width-responsive text-center">Head Configuration</th>
                                                            <th class="text-center">Status</th>

                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    @foreach ($dataPengukuran as $item)
                                                        <tr>
                                                            @if ($mp == 'awal')
                                                                <td class="text-center">{{ $no++ }}</td>
                                                                <td class="text-center">{{ $item->head_outer_diameter }}</td>
                                                                <td class="text-center">{{ $item->neck_diameter }}</td>
                                                                <td class="text-center">{{ $item->barrel }}</td>
                                                                <td class="text-center">{{ $item->overall_length }}</td>
                                                                <td class="text-center">{{ $item->tip_diameter_1 }}</td>
                                                                <td class="text-center">{{ $item->tip_diameter_2 }}</td>
                                                                <td class="text-center">{{ $item->cup_depth }}</td>
                                                                <td class="text-center">{{ $item->working_length }}</td>
                                                                <td class="text-center">{{ $item->status }}</td>
                                                            @elseif ($mp == 'rutin')
                                                                <td class="text-center">{{ $no++ }}</td>
                                                                <td class="text-center">{{ $item->overall_length }}</td>
                                                                <td class="text-center">{{ $item->working_length_awal }}</td>
                                                                <td class="text-center">{{ $item->working_length_rutin }}</td>
                                                                <td class="text-center">{{ $item->cup_depth }}</td>
                                                                <td class="text-center">{{ $item->head_configuration }}</td>
                                                                <td class="text-center">{{ $item->status }}</td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                        @if ($jenis == 'dies')
                                        <div class="table-responsive">
                                            <table class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        @if ($mp == 'awal')
                                                        <th class="text-center">No Dies</th>
                                                        <th class="text-center">L. Outer Diameter</th>
                                                        <th class="text-center">M. Inner Diameter 1</th>
                                                        <th class="text-center">N. Inner Diameter 2</th>
                                                        <th class="text-center">O. Ketinggian Dies</th>
                                                        <th class="text-center">Visual</th>
                                                        <th class="text-center">Kesesuaian Dies</th>
                                                        <th class="text-center">Status</th>
                                                        @elseif($mp == 'rutin')
                                                        <th class="text-center">No Dies</th>
                                                        <th class="text-center">Visual Dies/Segment Dies</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    @foreach ($dataPengukuran as $item)
                                                        <tr>
                                                            @if ($mp == 'awal')
                                                            <td class="text-center">{{ $no++ }}</td>
                                                            <td class="text-center">{{ $item->outer_diameter }}</td>
                                                            <td class="text-center">{{ $item->inner_diameter_1 }}</td>
                                                            <td class="text-center">{{ $item->inner_diameter_2 }}</td>
                                                            <td class="text-center">{{ $item->ketinggian_dies }}</td>
                                                            <td class="text-center">{{ $item->visual }}</td>
                                                            <td class="text-center">{{ $item->kesesuaian_dies }}</td>
                                                            <td class="text-center">{{ $item->status }}</td>
                                                            @elseif ($mp == 'rutin')
                                                            <td class="text-center">{{ $no++ }}</td>
                                                            <td class="text-center">{{ $item->visual_dies }}</td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex flex-column mx-2">
                                                    <label for="referensi_drawing" class="form-label">Referensi Drawing</label>
                                                    <input type="text" class="form-control" value="{{$labelIdentitas->referensi_drawing}}" id="referensi_drawing" name="referensi_drawing" placeholder="Insert Reference Drawing" @readonly(true) />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-12 mt-3">
                                                        <div class="d-flex flex-column mx-2">
                                                            <label for="catatan" class="form-label">Catatan</label>
                                                            <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Insert Your Message" @readonly(true)>{{$labelIdentitas->catatan}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="d-flex flex-column mx-2">
                                                            <label for="kesimpulan" class="form-label">Kesimpulan</label>
                                                            <textarea class="form-control" id="kesimpulan" name="kesimpulan" rows="3" placeholder="Insert Your Message" @readonly(true)>{{$labelIdentitas->kesimpulan}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="d-flex flex-column mt-5">
                                                    <label for="" class="form-label">Kalibrasi Tools</label>
                                                    <div class="table-responsive">
                                                        <table class="table table-rounded table-bordered">
                                                            <thead>
                                                                <tr class="fw-bold fs-6 text-gray-800">
                                                                    <th>Tools</th>
                                                                    <th>Tgl Kalibrasi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $tgl_kalibrasi_1 = $labelIdentitas->tgl_kalibrasi_tools_1 ? new DateTime($labelIdentitas->tgl_kalibrasi_tools_1) : null;
                                                                $tgl_kalibrasi_2 = $labelIdentitas->tgl_kalibrasi_tools_2 ? new DateTime($labelIdentitas->tgl_kalibrasi_tools_2) : null;
                                                                $tgl_kalibrasi_3 = $labelIdentitas->tgl_kalibrasi_tools_3 ? new DateTime($labelIdentitas->tgl_kalibrasi_tools_3) : null;
                                                                ?>

                                                                <tr>
                                                                    <td>
                                                                        <input type="text" value="{{ $labelIdentitas->kalibrasi1->title }}" class="form-control" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" value="{{ $tgl_kalibrasi_1 ? date_format($tgl_kalibrasi_1, 'd M Y') : '' }}" name="tgl_kalibrasi_1" id="tgl_kalibrasi_1" class="form-control" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" value="{{ $labelIdentitas->kalibrasi2->title }}" class="form-control" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" value="{{ $tgl_kalibrasi_2 ? date_format($tgl_kalibrasi_2, 'd M Y') : '' }}" name="tgl_kalibrasi_2" id="tgl_kalibrasi_2" class="form-control" @readonly(true)>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" value="{{ $labelIdentitas->kalibrasi3->title }}" class="form-control" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" value="{{ $tgl_kalibrasi_3 ? date_format($tgl_kalibrasi_3, 'd M Y') : '' }}" name="tgl_kalibrasi_3" id="tgl_kalibrasi_3" class="form-control" @readonly(true)>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content container-->

    <!--Bantuan Pengukuran-->
<div
    id="kt_drawer_example_basic"

    class="bg-white"
    data-kt-drawer="true"
    data-kt-drawer-activate="true"
    data-kt-drawer-toggle="#kt_drawer_example_basic_button"
    data-kt-drawer-close="#kt_drawer_example_basic_close"
    data-kt-drawer-width="300px">
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header pe-5">
            <!--begin::Title-->
            <div class="card-title">
                Bantuan Pengukuran Punch
            </div>
            <!--end::Title-->
        </div>
        <!--end::Card header-->
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
                <img src="{{asset('assets/img/guide_punch.png')}}" style="max-width: 200px" alt="helper">
            </div>
            <img src="{{asset('assets/img/standar_awal.png')}}" style="max-width: 200px" alt="rule">
        </div>
    </div>
</div>
<!--end::Bantuan Pengukuran-->
</div>

{{-- Modal Konfirmasi Data Pengukuran --}}
<script>
</script>
<!--end::Content-->
@endsection
