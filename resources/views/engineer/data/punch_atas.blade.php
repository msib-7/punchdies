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
                Data Punch Atas</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted text-hover-primary">Total Punch: <b>111</b></span>
                </li>
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Primary button-->
            <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                data-bs-target="#modal_create_data_punch">
                Create Data Punch
            </a>
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->
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
                    <div class="col-12">
                        <div class="row">
                            <div class="col-10">
                                <table id="PA_Table_List" class="" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Data Punch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-active-light-dark"
                                                    style="border: 1px solid #E2E2E9;width: -webkit-fill-available; text-align: left">
                                                    <div class="col-12">
                                                        {{-- <div class="row">
                                                            <div class="col-12 mb-5">
                                                                <h1>{ Merk Punch }</h1>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Bulan/Tahun Pembuatan
                                                                            </div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama Mesin Cetak</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Mesin Cetak}</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama/Kode Produk</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Produk}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Status Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Tanggal Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">29 September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-5">Status</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">
                                                                                <span
                                                                                    class="badge badge-light-success">Approval</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="row">
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        {{-- <div class="d-flex flex-center"> --}}
                                                                        {{-- <span class="fs-1">{MERK PUNCH}</span> --}}
                                                                        {{-- </div> --}}
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-1">ALTINEX</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Bulan/Tahun Pembuatan
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JUNI 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Nama Mesin Cetak
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JCMCO</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Kode/Nama Produk
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            TCRV3</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    {{-- <div class="col-12">
                                                                        <h3>JCMCO</h3>
                                                                    </div> --}}
                                                                    <div class="col-12">
                                                                        <span class="fs-3">Pengukuran Awal</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Tanggal Pengukuran
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            14 Juli 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Diukur oleh
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            Teknisi 1</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;" colspan="3">
                                                                                            <span class="badge badge-light-success fs-5">Approved</span>
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
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-active-light-dark"
                                                    style="border: 1px solid #E2E2E9;width: -webkit-fill-available; text-align: left">
                                                    <div class="col-12">
                                                        {{-- <div class="row">
                                                            <div class="col-12 mb-5">
                                                                <h1>{ Merk Punch }</h1>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Bulan/Tahun Pembuatan
                                                                            </div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama Mesin Cetak</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Mesin Cetak}</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama/Kode Produk</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Produk}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Status Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Tanggal Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">29 September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-5">Status</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">
                                                                                <span
                                                                                    class="badge badge-light-success">Approval</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="row">
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        {{-- <div class="d-flex flex-center"> --}}
                                                                        {{-- <span class="fs-1">{MERK PUNCH}</span> --}}
                                                                        {{-- </div> --}}
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-1">ALTINEX</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Bulan/Tahun Pembuatan
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JUNI 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Nama Mesin Cetak
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JCMCO</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Kode/Nama Produk
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            TCRV3</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    {{-- <div class="col-12">
                                                                        <h3>JCMCO</h3>
                                                                    </div> --}}
                                                                    <div class="col-12">
                                                                        <span class="fs-3">Pengukuran Awal</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Tanggal Pengukuran
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            14 Juli 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Diukur oleh
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            Teknisi 1</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;" colspan="3">
                                                                                            <span class="badge badge-light-success fs-5">Approved</span>
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
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-active-light-dark"
                                                    style="border: 1px solid #E2E2E9;width: -webkit-fill-available; text-align: left">
                                                    <div class="col-12">
                                                        {{-- <div class="row">
                                                            <div class="col-12 mb-5">
                                                                <h1>{ Merk Punch }</h1>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Bulan/Tahun Pembuatan
                                                                            </div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama Mesin Cetak</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Mesin Cetak}</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama/Kode Produk</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Produk}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Status Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Tanggal Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">29 September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-5">Status</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">
                                                                                <span
                                                                                    class="badge badge-light-success">Approval</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="row">
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        {{-- <div class="d-flex flex-center"> --}}
                                                                        {{-- <span class="fs-1">{MERK PUNCH}</span> --}}
                                                                        {{-- </div> --}}
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-1">ALTINEX</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Bulan/Tahun Pembuatan
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JUNI 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Nama Mesin Cetak
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JCMCO</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Kode/Nama Produk
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            TCRV3</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    {{-- <div class="col-12">
                                                                        <h3>JCMCO</h3>
                                                                    </div> --}}
                                                                    <div class="col-12">
                                                                        <span class="fs-3">Pengukuran Awal</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Tanggal Pengukuran
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            14 Juli 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Diukur oleh
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            Teknisi 1</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;" colspan="3">
                                                                                            <span class="badge badge-light-success fs-5">Approved</span>
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
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-active-light-dark"
                                                    style="border: 1px solid #E2E2E9;width: -webkit-fill-available; text-align: left">
                                                    <div class="col-12">
                                                        {{-- <div class="row">
                                                            <div class="col-12 mb-5">
                                                                <h1>{ Merk Punch }</h1>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Bulan/Tahun Pembuatan
                                                                            </div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama Mesin Cetak</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Mesin Cetak}</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama/Kode Produk</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Produk}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Status Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Tanggal Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">29 September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-5">Status</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">
                                                                                <span
                                                                                    class="badge badge-light-success">Approval</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="row">
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        {{-- <div class="d-flex flex-center"> --}}
                                                                        {{-- <span class="fs-1">{MERK PUNCH}</span> --}}
                                                                        {{-- </div> --}}
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-1">ALTINEX</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Bulan/Tahun Pembuatan
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JUNI 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Nama Mesin Cetak
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JCMCO</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Kode/Nama Produk
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            TCRV3</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    {{-- <div class="col-12">
                                                                        <h3>JCMCO</h3>
                                                                    </div> --}}
                                                                    <div class="col-12">
                                                                        <span class="fs-3">Pengukuran Awal</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Tanggal Pengukuran
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            14 Juli 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Diukur oleh
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            Teknisi 1</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;" colspan="3">
                                                                                            <span class="badge badge-light-success fs-5">Approved</span>
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
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-active-light-dark"
                                                    style="border: 1px solid #E2E2E9;width: -webkit-fill-available; text-align: left">
                                                    <div class="col-12">
                                                        {{-- <div class="row">
                                                            <div class="col-12 mb-5">
                                                                <h1>{ Merk Punch }</h1>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Bulan/Tahun Pembuatan
                                                                            </div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama Mesin Cetak</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Mesin Cetak}</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama/Kode Produk</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Produk}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Status Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Tanggal Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">29 September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-5">Status</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">
                                                                                <span
                                                                                    class="badge badge-light-success">Approval</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="row">
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        {{-- <div class="d-flex flex-center"> --}}
                                                                        {{-- <span class="fs-1">{MERK PUNCH}</span> --}}
                                                                        {{-- </div> --}}
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-1">ALTINEX</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Bulan/Tahun Pembuatan
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JUNI 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Nama Mesin Cetak
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JCMCO</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Kode/Nama Produk
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            TCRV3</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    {{-- <div class="col-12">
                                                                        <h3>JCMCO</h3>
                                                                    </div> --}}
                                                                    <div class="col-12">
                                                                        <span class="fs-3">Pengukuran Awal</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Tanggal Pengukuran
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            14 Juli 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Diukur oleh
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            Teknisi 1</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;" colspan="3">
                                                                                            <span class="badge badge-light-success fs-5">Approved</span>
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
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-active-light-dark"
                                                    style="border: 1px solid #E2E2E9;width: -webkit-fill-available; text-align: left">
                                                    <div class="col-12">
                                                        {{-- <div class="row">
                                                            <div class="col-12 mb-5">
                                                                <h1>{ Merk Punch }</h1>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Bulan/Tahun Pembuatan
                                                                            </div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama Mesin Cetak</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Mesin Cetak}</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama/Kode Produk</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Produk}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Status Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Tanggal Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">29 September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-5">Status</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">
                                                                                <span
                                                                                    class="badge badge-light-success">Approval</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="row">
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        {{-- <div class="d-flex flex-center"> --}}
                                                                        {{-- <span class="fs-1">{MERK PUNCH}</span> --}}
                                                                        {{-- </div> --}}
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-1">ALTINEX</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Bulan/Tahun Pembuatan
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JUNI 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Nama Mesin Cetak
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JCMCO</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Kode/Nama Produk
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            TCRV3</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    {{-- <div class="col-12">
                                                                        <h3>JCMCO</h3>
                                                                    </div> --}}
                                                                    <div class="col-12">
                                                                        <span class="fs-3">Pengukuran Awal</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Tanggal Pengukuran
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            14 Juli 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Diukur oleh
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            Teknisi 1</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;" colspan="3">
                                                                                            <span class="badge badge-light-success fs-5">Approved</span>
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
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-active-light-dark"
                                                    style="border: 1px solid #E2E2E9;width: -webkit-fill-available; text-align: left">
                                                    <div class="col-12">
                                                        {{-- <div class="row">
                                                            <div class="col-12 mb-5">
                                                                <h1>{ Merk Punch }</h1>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Bulan/Tahun Pembuatan
                                                                            </div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama Mesin Cetak</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Mesin Cetak}</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama/Kode Produk</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Produk}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Status Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Tanggal Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">29 September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-5">Status</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">
                                                                                <span
                                                                                    class="badge badge-light-success">Approval</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="row">
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        {{-- <div class="d-flex flex-center"> --}}
                                                                        {{-- <span class="fs-1">{MERK PUNCH}</span> --}}
                                                                        {{-- </div> --}}
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-1">ALTINEX</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Bulan/Tahun Pembuatan
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JUNI 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Nama Mesin Cetak
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JCMCO</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Kode/Nama Produk
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            TCRV3</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    {{-- <div class="col-12">
                                                                        <h3>JCMCO</h3>
                                                                    </div> --}}
                                                                    <div class="col-12">
                                                                        <span class="fs-3">Pengukuran Awal</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Tanggal Pengukuran
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            14 Juli 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Diukur oleh
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            Teknisi 1</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;" colspan="3">
                                                                                            <span class="badge badge-light-success fs-5">Approved</span>
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
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="btn btn-active-light-dark"
                                                    style="border: 1px solid #E2E2E9;width: -webkit-fill-available; text-align: left">
                                                    <div class="col-12">
                                                        {{-- <div class="row">
                                                            <div class="col-12 mb-5">
                                                                <h1>{ Merk Punch }</h1>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Bulan/Tahun Pembuatan
                                                                            </div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama Mesin Cetak</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Mesin Cetak}</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Nama/Kode Produk</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">{Nama Produk}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="row">
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Status Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-5">
                                                                        <div class="row">
                                                                            <div class="col-5">Tanggal Pengukuran</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">29 September 2024</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-5">Status</div>
                                                                            <div class="col-1">:</div>
                                                                            <div class="col-6">
                                                                                <span
                                                                                    class="badge badge-light-success">Approval</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="row">
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        {{-- <div class="d-flex flex-center"> --}}
                                                                        {{-- <span class="fs-1">{MERK PUNCH}</span> --}}
                                                                        {{-- </div> --}}
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-1">ALTINEX</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Bulan/Tahun Pembuatan
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JUNI 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Nama Mesin Cetak
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            JCMCO</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Kode/Nama Produk
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            TCRV3</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 d-flex flex-center">
                                                                <div class="row">
                                                                    {{-- <div class="col-12">
                                                                        <h3>JCMCO</h3>
                                                                    </div> --}}
                                                                    <div class="col-12">
                                                                        <span class="fs-3">Pengukuran Awal</span>
                                                                        <div class="table-responsive">
                                                                            <table style="border: none;">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Tanggal Pengukuran
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            14 Juli 2024</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;">
                                                                                            Diukur oleh
                                                                                        </td>
                                                                                        <td style="border: none;">:
                                                                                        </td>
                                                                                        <td style="border: none;">
                                                                                            Teknisi 1</td>
                                                                                    </tr>
                                                                                    <tr
                                                                                        style="border: none; height: 30px;">
                                                                                        <td style="border: none;" colspan="3">
                                                                                            <span class="badge badge-light-success fs-5">Approved</span>
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
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Sort by:</h4>
                                        <div class="row mt-5">
                                            <div class="col-12 mb-3">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value="" name='pa_sort'
                                                        id="tgl_pengukuran" checked />
                                                    <label class="form-check-label" for="tgl_pengukuran">
                                                        Tanggal Pengukuran
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value="" name='pa_sort'
                                                        id="flexRadioDefault" />
                                                    <label class="form-check-label" for="flexRadioDefault">
                                                        Default radio
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value="" name='pa_sort'
                                                        id="flexRadioDefault" />
                                                    <label class="form-check-label" for="flexRadioDefault">
                                                        Default radio
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="separator my-3"></div>
                                            <div class="col-12 mb-3 d-flex flex-center">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value=""
                                                        name='pa_order' id="asc" checked />
                                                    <label class="form-check-label" for="asc">
                                                        ASC
                                                    </label>
                                                    <div class="mx-5"></div>
                                                    <input class="form-check-input" type="radio" value=""
                                                        name='pa_order' id="desc" />
                                                    <label class="form-check-label" for="desc">
                                                        DESC
                                                    </label>
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

<div class="modal fade" tabindex="-1" id="modal_create_data_punch">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Create Data Punch Atas</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-5">
                                <label for="exampleFormControlInput1" class="required form-label">
                                    Merk Punch</label>
                                <input type="email" class="form-control form-control-solid"
                                    placeholder="Example input" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <label for="exampleFormControlInput1" class="required form-label">
                                    Bulan & Tahun Pembuatan</label>
                                <div class="col-6">
                                    <select class="form-select" aria-label="Select example">
                                        <option>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select class="form-select" aria-label="Select example">
                                        <option>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-10"></div>
                        <div class="col-12">
                            <div class="mb-5">
                                <label for="exampleFormControlInput1" class="required form-label">
                                    Nama Mesin Cetak
                                </label>
                                <input type="email" class="form-control form-control-solid"
                                    placeholder="Example input" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-5">
                                        <label for="exampleFormControlInput1" class="required form-label">
                                            Nama Produk</label>
                                        <input type="email" class="form-control form-control-solid"
                                            placeholder="Example input" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-5">
                                        <label for="exampleFormControlInput1" class="required form-label">
                                            Kode Produk</label>
                                        <input type="email" class="form-control form-control-solid"
                                            placeholder="Example input" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="">
                                <label for="exampleFormControlInput1" class="required form-label">
                                    Pilih Line untuk Punch
                                </label>
                                <select class="form-select" aria-label="Select example">
                                    <option>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
