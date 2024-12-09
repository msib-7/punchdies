@extends('layout.metronic')
@section('main-content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Dashboard</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted text-hover-primary">Total Punch: <b>{{$totalPunch}}</b></span>
                </li>
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted text-hover-primary">Total Dies: <b>{{$totalDies}}</b></span>
                </li>
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
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
            <div class="card">
                <div class="card-body">
                    <!--begin::Accordion-->
                    <div class="accordion accordion-icon-toggle" id="kt_accordion_2">
                        <!--begin::Item-->
                        <div class="mb-5">
                            <!--begin::Header-->
                            <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                data-bs-target="#kt_accordion_2_item_1">
                                <span class="accordion-icon">
                                    <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </span>
                                <h3 class="fs-3 fw-semibold mb-0 ms-4">Punch Atas</h3>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div id="kt_accordion_2_item_1" class="fs-6 collapse show ps-10"
                                data-bs-parent="#kt_accordion_2">
                                <div class="row">
                                    <div class="col-12">
                                        <table id="dboard_Table1" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Merk Punch</th>
                                                    <th>Bulan/Tahun Pembuatan</th>
                                                    <th>Nama Mesin Cetak</th>
                                                    <th>Nama/Kode Produk</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1 ?>
                                                @foreach ($dataPunchAtas as $data)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $data->merk }}</td>
                                                    <td>{{ $data->bulan_pembuatan }} {{ $data->tahun_pembuatan }}</td>
                                                    <td>{{ $data->nama_mesin_cetak }}</td>
                                                    <td>{{ $data->nama_produk }}</td>
                                                    <td>{{ $data->jenis }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- <div class="col-3">
                                        <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                                            <div class="card-body align-items">
                                                <div class="row d-flex flex-center">
                                                    <div class="col-6">
                                                        <h2>Status</h2>
                                                        <h1>
                                                            <span class="badge badge-light-success fs-3">OK</span>
                                                        </h1>
                                                    </div>
                                                    <div class="col-6">
                                                        <h1 class="fs-2 fw-bold">90</h1>
                                                        <h5>punch</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div> --}}
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <div class="mb-5">
                            <!--begin::Header-->
                            <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse"
                                data-bs-target="#kt_accordion_2_item_2" style="border">
                                <span class="accordion-icon">
                                    <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </span>
                                <h3 class="fs-3 fw-semibold mb-0 ms-4">Punch Bawah</h3>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div id="kt_accordion_2_item_2" class="collapse fs-6 ps-10"
                                data-bs-parent="#kt_accordion_2">
                                <table id="dboard_Table2" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Merk Punch</th>
                                            <th>Bulan/Tahun Pembuatan</th>
                                            <th>Nama Mesin Cetak</th>
                                            <th>Nama/Kode Produk</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1 ?>
                                        @foreach ($dataPunchBawah as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->merk }}</td>
                                            <td>{{ $data->bulan_pembuatan }} {{ $data->tahun_pembuatan }}</td>
                                            <td>{{ $data->nama_mesin_cetak }}</td>
                                            <td>{{ $data->nama_produk }}</td>
                                            <td>{{ $data->jenis }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <div class="mb-5">
                            <!--begin::Header-->
                            <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse"
                                data-bs-target="#kt_accordion_2_item_3">
                                <span class="accordion-icon">
                                    <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </span>
                                <h3 class="fs-3 fw-semibold mb-0 ms-4">Dies</h3>
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div id="kt_accordion_2_item_3" class="collapse fs-6 ps-10"
                                data-bs-parent="#kt_accordion_2">
                                <table id="dboard_Table3" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Merk Dies</th>
                                            <th>Bulan/Tahun Pembuatan</th>
                                            <th>Nama Mesin Cetak</th>
                                            <th>Nama/Kode Produk</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1 ?>
                                        @foreach ($dataDies as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->merk }}</td>
                                            <td>{{ $data->bulan_pembuatan }} {{ $data->tahun_pembuatan }}</td>
                                            <td>{{ $data->nama_mesin_cetak }}</td>
                                            <td>{{ $data->nama_produk }}</td>
                                            <td>{{ $data->jenis }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Accordion-->
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
