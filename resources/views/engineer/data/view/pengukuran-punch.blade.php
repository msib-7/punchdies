@extends('layout.metronic')
@section('main-content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Engage-->
	<div class="app-engage " id="kt_app_engage">  
		<!--begin::Prebuilts toggle-->
        <a href="{{route('pnd.'.$masaPengukuran.'.'.$route.'.print', request()->segment(5))}}" class="app-engage-btn hover-dark" id="kt_drawer_example_basic_button">
            <i class="ki-duotone ki-printer fs-1 pt-1 mb-2">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
            <span class="path5"></span>
            </i>
            Print/PDF
        </a>
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
                                                <span class="fs-2 fw-bold">{{ strtoupper($labelPunch->merk) }}</span>
                                            </button>
                                        </h2>
                                        <div id="kt_accordion_1_body_1" class="accordion-collapse collapse show" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
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
                                                                                    {{ strtoupper($labelPunch->merk) }}</td>
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
                                                                                    {{ strtoupper($labelPunch->bulan_pembuatan).' '.$labelPunch->tahun_pembuatan }}</td>
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
                                                                                    {{ strtoupper($labelPunch->nama_mesin_cetak) }}</td>
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
                                                                                    <?php if(strtoupper($labelPunch->nama_produks->title) == strtoupper($labelPunch->kode_produks->title)) {?>
                                                                                        {{ strtoupper($labelPunch->nama_produks->title)}}
                                                                                    <?php } else {?>
                                                                                        {{ strtoupper($labelPunch->nama_produks->title)."/".strtoupper($labelPunch->kode_produks->title)}}
                                                                                    <?php }?>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
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
                                                                                    {{ ucwords($labelPunch->masa_pengukuran) }}</td>
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
                                                                                    {{-- {{ $labelPunch->created_at }} --}}
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
                                                                                    {{ ucwords($labelPunch->username) }}</td>
                                                                            </tr>
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
                                                                                    @if ($labelPunch->is_approved == '1')
                                                                                        <span class="badge badge-square badge-outline badge-success">Approved</span>
                                                                                    @elseif ($labelPunch->is_rejected == '1') <!-- Check for rejection -->
                                                                                        <span class="badge badge-square badge-outline badge-danger">Rejected</span>
                                                                                    @elseif ($labelPunch->is_draft == '1')
                                                                                        <span class="badge badge-square badge-outline badge-dark">Draft</span>
                                                                                    @elseif ($labelPunch->is_waiting == '1')
                                                                                        <span class="badge badge-square badge-outline badge-warning">Waiting</span>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 mt-5">
                                                        <div class="table-responsive">
                                                            <table style="border: none;">
                                                                <tbody>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;"
                                                                            class="fs-5 px-4 my-4">
                                                                            {{-- Check if any item in the collection has a status of 'NOK' --}}
                                                                            @if ($dataPengukuran->contains(function ($item) {
                                                                                return strtoupper($item->status) === 'NOK';
                                                                            }) && $labelPunch->is_waiting == '0')
                                                                                <a href="{{ route('pnd.request.disposal.create', $labelPunch->punch_id) }}" class="btn btn-danger
                                                                                    ">Disposal</a>
                                                                                <br>
                                                                                <small>
                                                                                <span class="text-danger">Disposal Dapat Dilakukan! <br> Status NOK</span>
                                                                                </small>
                                                                                @endif
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
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table  class="table table-bordered" style="width:100%">
                                                <thead>
                                                    <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                                        <th class="text-center">No Punch</th>
                                                        <th class="text-center">Head Outer Diamter</th>
                                                        <th class="text-center">Neck Diameter</th>
                                                        <th class="text-center">Barrel</th>
                                                        <th class="text-center">Overall Length</th>
                                                        <th class="text-center">Tip Diameter 1</th>
                                                        <th class="text-center">Tip Diameter 2</th>
                                                        <th class="text-center">Cup Depth</th>
                                                        <th class="text-center">Working Length</th>
                                                        <th class="text-center">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    @foreach ($dataPengukuran as $item)
                                                        <tr>
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
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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
                                                    <input type="text" class="form-control" value="{{$labelPunch->referensi_drawing}}" id="referensi_drawing" name="referensi_drawing" placeholder="Insert Reference Drawing" @readonly(true) />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-12 mt-3">
                                                        <div class="d-flex flex-column mx-2">
                                                            <label for="catatan" class="form-label">Catatan</label>
                                                            <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Insert Your Message" @readonly(true)>{{$labelPunch->catatan}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="d-flex flex-column mx-2">
                                                            <label for="kesimpulan" class="form-label">Kesimpulan</label>
                                                            <textarea class="form-control" id="kesimpulan" name="kesimpulan" rows="3" placeholder="Insert Your Message" @readonly(true)>{{$labelPunch->kesimpulan}}</textarea>
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
                                                                $tgl_kalibrasi_1 = $labelPunch->tgl_kalibrasi_tools_1 ? new DateTime($labelPunch->tgl_kalibrasi_tools_1) : null;
                                                                $tgl_kalibrasi_2 = $labelPunch->tgl_kalibrasi_tools_2 ? new DateTime($labelPunch->tgl_kalibrasi_tools_2) : null;
                                                                $tgl_kalibrasi_3 = $labelPunch->tgl_kalibrasi_tools_3 ? new DateTime($labelPunch->tgl_kalibrasi_tools_3) : null;
                                                                ?>

                                                                <tr>
                                                                    <td>
                                                                        <input type="text" value="{{ $labelPunch->kalibrasi1->title }}" class="form-control" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" value="{{ $tgl_kalibrasi_1 ? date_format($tgl_kalibrasi_1, 'd M Y') : '' }}" name="tgl_kalibrasi_1" id="tgl_kalibrasi_1" class="form-control" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" value="{{ $labelPunch->kalibrasi2->title }}" class="form-control" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" value="{{ $tgl_kalibrasi_2 ? date_format($tgl_kalibrasi_2, 'd M Y') : '' }}" name="tgl_kalibrasi_2" id="tgl_kalibrasi_2" class="form-control" @readonly(true)>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" value="{{ $labelPunch->kalibrasi3->title }}" class="form-control" readonly>
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
</div>
<!--end::Content-->
@endsection
