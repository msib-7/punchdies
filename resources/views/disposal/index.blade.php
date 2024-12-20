@extends('layout.metronic')
@section('main-content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Create Disposal Request</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->	
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/dashboard" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Request Disposal</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
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
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title fw-bold text-dark">New Disposal</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table style="border: none;">
                                                    <tbody>
                                                        <tr style="border: none; height: 30px;">
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                Merk Punch
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">:
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                {{-- {{ strtoupper($labelPunch->merk) }} --}}
                                                            </td>
                                                        </tr>
                                                        <tr style="border: none; height: 30px;">
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                Bulan/Tahun Pembuatan
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">:
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                {{-- {{ strtoupper($labelPunch->bulan_pembuatan).' '.$labelPunch->tahun_pembuatan }} --}}
                                                            </td>
                                                        </tr>
                                                        <tr style="border: none; height: 30px;">
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                Nama Mesin Cetak
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">:
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                {{-- {{ strtoupper($labelPunch->nama_mesin_cetak) }} --}}
                                                            </td>
                                                        </tr>
                                                        <tr style="border: none; height: 30px;">
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                Kode/Nama Produk
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">:
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                {{-- @if(strtoupper($labelPunch->nama_produk) == strtoupper($labelPunch->kode_produk))
                                                                    {{ strtoupper($labelPunch->nama_produk)}}
                                                                @else
                                                                    {{ strtoupper($labelPunch->nama_produk)."/".strtoupper($labelPunch->kode_produk)}}
                                                                @endif --}}
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
                                                                class="fs-6 px-4 my-4">
                                                                Masa Pengukuran
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">:
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                {{-- {{ ucwords($labelPunch->masa_pengukuran) }} --}}
                                                            </td>
                                                        </tr>
                                                        <tr style="border: none; height: 30px;">
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                Tanggal Pengukuran
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">:
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                {{-- {{ date_format($tglPengukuran->created_at, 'd M Y') }} --}}
                                                                {{-- {{ $labelPunch->created_at }} --}}
                                                            </td>
                                                        </tr>
                                                        <tr style="border: none; height: 30px;">
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                Diukur oleh
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">:
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                {{-- {{ ucwords($labelPunch->username) }} --}}
                                                            </td>
                                                        </tr>
                                                        <tr style="border: none; height: 30px;">
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                Status Pengukuran
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">:
                                                            </td>
                                                            <td style="border: none;"
                                                                class="fs-6 px-4 my-4">
                                                                {{-- {{ $statusPengukuran }} --}}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator border-3 my-10"></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <td></td>
                                        </tbody>
                                    </table>
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
                                                                    $micrometer = $labelPunch->kalibrasi_micrometer ? new DateTime($labelPunch->kalibrasi_micrometer) : null;
                                                                    $caliper = $labelPunch->kalibrasi_caliper ? new DateTime($labelPunch->kalibrasi_caliper) : null;
                                                                    $dial_indicator = $labelPunch->kalibrasi_dial_indicator ? new DateTime($labelPunch->kalibrasi_dial_indicator) : null;
                                                                    ?>

                                                                    <tr>
                                                                        <td>Micrometer Digital</td>
                                                                        <td>
                                                                            <input type="text" value="{{ $micrometer ? date_format($micrometer, 'd M Y') : '' }}" name="micrometer_digital" id="micrometer_digital" class="form-control" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Caliper Digital</td>
                                                                        <td>
                                                                            <input type="text" value="{{ $caliper ? date_format($caliper, 'd M Y') : '' }}" name="caliper_digital" id="caliper_digital" class="form-control" @readonly(true)>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Dial Indicator Digital</td>
                                                                        <td>
                                                                            <input type="text" value="{{ $dial_indicator ? date_format($dial_indicator, 'd M Y') : '' }}" name="dial_indicator_digital" id="dial_indicator_digital" class="form-control" @readonly(true)>
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
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content container-->
</div>
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
                Set Your helper title
            </div>
            <!--end::Title-->
        </div>
        <!--end::Card header-->
        <div class="card-body">
            put your content here
        </div>
    </div>
</div>
<!--end::Bantuan Pengukuran-->

<script>
    $(document).ready(function () {
        
    });
</script>
<!--end::Content-->
@endsection
