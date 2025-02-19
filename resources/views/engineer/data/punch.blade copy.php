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
                Data {{$jenisPunch}}</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted text-hover-primary">Total Punch: <b>{{ $ttlPunch }}</b></span>
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
                                <table id="PA_Table_List" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Tgl Pengukuran</th>
                                            <th>Data Punch</th>
                                            <th>Merk</th>
                                            <th>Bulan/Tahun</th>
                                            <th>Nama Mesin</th>
                                            <th>Kode/Nama Produk</th>
                                            <th>Pengukuran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataPunch as $data)
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div class="card shadow-lg border-3 rounded-2"
                                                    style="border: 1px solid #E2E2E9;width: -webkit-fill-available; text-align: left">
                                                    <div class="card-body">
                                                        <div class="col-12">
                                                            <div class="px-8">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="d-flex">
                                                                            <div class="me-auto">
                                                                                <h1 class="p-4 d-flex align-items-center">
                                                                                    {{ strtoupper($data->merk)}}
                                                                                    &nbsp;
                                                                                    @if ($data->is_draft == '1')
                                                                                        <span class="badge badge-square badge-outline badge-dark fs-3">Draft</span>
                                                                                    @endif
                                                                                    @if ($data->is_draft == '0')
                                                                                        <span class="badge badge-square badge-outline badge-warning fs-3">Waiting</span>
                                                                                    @endif
                                                                                </h1>
                                                                            </div>
                                                                            <div class="p-2">
                                                                                @if ($data->masa_pengukuran == "-")
                                                                                    <button class="btn btn-primary p-2 create-awl" id="{{$data->punch_id}}" onclick="buatPengukuran(this)">
                                                                                        <i class="ki-duotone ki-add-files fs-1">
                                                                                            <span class="path1"></span>
                                                                                            <span class="path2"></span>
                                                                                            <span class="path3"></span>
                                                                                        </i>
                                                                                        Buat Pengukuran
                                                                                    </button>
                                                                                @endif
                                                                                @if ($data->masa_pengukuran != "-")
                                                                                    <button type="submit" class="btn btn-secondary p-2" id="{{$data->punch_id}}" onclick="pilihPengukuran(this)">
                                                                                        <i class="ki-duotone ki-magnifier fs-1">
                                                                                            <span class="path1"></span>
                                                                                            <span class="path2"></span>
                                                                                        </i>
                                                                                        Lihat Data Pengukuran
                                                                                    </button>
                                                                                @endif
                                                                            </div>
                                                                            <div class="p-2">
                                                                                <!--begin::Action Button-->
                                                                                <div class="me-0">
                                                                                    <button class="btn btn-sm btn-icon btn-light-danger  btn-active-color-white" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                                                        <i class="ki-solid ki-dots-horizontal fs-2x"></i>
                                                                                    </button>
                                                                                    <!--begin:: Button List-->
                                                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 fw-semibold w-auto py-0" data-kt-menu="true">
                                                                                        <!--begin:: Delete button-->
                                                                                        <div class="menu-item rounded shadow border p-0">
                                                                                            <a href="{{route('pnd.pa.'.$route.'.delete', $data->punch_id)}}" class="menu-link p-0 d-flex justify-content-center">
                                                                                                <button class="btn btn-outline btn-outline-danger d-inline-flex p-3">
                                                                                                    &nbsp;<i class="ki-duotone ki-trash fs-2x">
                                                                                                        <span class="path1"></span>
                                                                                                        <span class="path2"></span>
                                                                                                        <span class="path3"></span>
                                                                                                        <span class="path4"></span>
                                                                                                        <span class="path5"></span>
                                                                                                    </i>
                                                                                                </button>
                                                                                            </a>
                                                                                        </div>
                                                                                        <!--end::Delete Button-->
                                                                                    </div>
                                                                                    <!--end::BUtton List-->
                                                                                </div>
                                                                                <!--end::Action Button-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="table-responsive">
                                                                                    <table style="border: none;">
                                                                                        <tbody>
                                                                                            <tr
                                                                                                style="border: none; height: 30px;">
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">
                                                                                                    Bulan/Tahun Pembuatan
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">:
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">
                                                                                                    {{$data->bulan_pembuatan}}
                                                                                                    {{$data->tahun_pembuatan}}
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr
                                                                                                style="border: none; height: 30px;">
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">
                                                                                                    Nama Mesin Cetak
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">:
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">
                                                                                                    {{ strtoupper($data->nama_mesin_cetak)}}
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr
                                                                                                style="border: none; height: 30px;">
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">
                                                                                                    Kode Produk
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">:
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">
                                                                                                        {{ strtoupper($data->kode_produk)}}
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr
                                                                                                style="border: none; height: 30px;">
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">
                                                                                                    Nama Produk
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">:
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">
                                                                                                        {{ strtoupper($data->nama_produk) }}
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="table-responsive">
                                                                                    <table style="border: none;">
                                                                                        <tbody>
                                                                                            <tr
                                                                                                style="border: none; height: 30px;">
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">
                                                                                                    Pengukuran Terakhir
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">:
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">
                                                                                                    {{ ucwords($data->masa_pengukuran) }}</td>
                                                                                            </tr>
                                                                                            <tr
                                                                                                style="border: none; height: 30px;">
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">
                                                                                                    Tanggal Pengukuran
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">:
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">
                                                                                                    {{ date_format($data->created_at, 'd M Y')}}</td>
                                                                                            </tr>
                                                                                            <tr style="border: none; height: 30px;">
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4"> 
                                                                                                    Status
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">:
                                                                                                </td>
                                                                                                <td style="border: none;"
                                                                                                    class="fs-3 px-4 my-4">
                                                                                                    @if ($data->is_draft == '1')
                                                                                                        <span class="badge badge-square badge-outline badge-light-dark fs-3">Draft</span>
                                                                                                    @endif
                                                                                                    @if ($data->is_draft == '0')
                                                                                                        <span class="badge badge-square badge-outline badge-light-warning fs-4">
                                                                                                            Waiting For Approval
                                                                                                        </span>
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
                                                </div>
                                            </td>
                                            <td>{{$data->merk}}</td>
                                            <td>{{$data->bulan_pembuatan}} {{$data->tahun_pembuatan}}</td>
                                            <td>{{$data->nama_mesin_cetak}}</td>
                                            <td>{{$data->kode_produk}}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
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

{{-- Create Data Punch Modal --}}
<div class="modal fade" tabindex="-1" id="modal_create_data_punch">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Create Data {{$jenisPunch}}</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="col-12">
                    <form id="form_create_punch">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <label for="exampleFormControlInput1" class="required form-label">
                                        Merk Punch</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Masukkan Merk Punch" name="merk" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <label for="exampleFormControlInput1" class="required form-label">
                                        Bulan & Tahun Pembuatan</label>
                                    <div class="col-6">
                                        <select class="form-select" aria-label="Select example" name="bulan_pembuatan">
                                            <option>Open this select menu</option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <select class="form-select" aria-label="Select example" name="tahun_pembuatan" id="tahun_buat">
                                            <option>Open this select menu</option>\
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
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Masukkan Nama Mesin" name="nama_mesin_cetak" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">
                                                Nama Produk</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Masukkan Nama Produk" name="nama_produk" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">
                                                Kode Produk</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Masukkan Kode Produk" name="kode_produk" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="">
                                    <label for="exampleFormControlInput1" class="required form-label">
                                        Pilih Line untuk Punch
                                    </label>
                                    <select class="form-select" aria-label="Select example" name="line_id">
                                        <option>Open this select menu</option>
                                        @foreach ($DataLine as $item)
                                        <option value="{{$item->id}}">{{$item->nama_line}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- Konfirmasi Lanjut Pegukuran --}}
<div class="modal fade" tabindex="-1" id="modal_lanjut_pengukuran">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Data</h4>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="d-flex flex-column justify-content-center">
                    <p class="text-center fs-4">Data Punch Berhasil Dibuat!</p>
                    <p class="text-center fs-4">Lanjutkan Pengukuran</p>
                </div>
            </div>

            <div class="modal-footer">
                <div class="p-2">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-stacked-modal="#modal_buat_pengukuran_1">Pengukuran</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Pilih Pengukuran untuk dilihat --}}
<div class="modal fade" tabindex="-1" id="modal_pilih_pengukuran">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Pilih Pengukuran</h6>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="col-12">
                    <form id="form_pilih_pengukuran" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <div class="form-floating">
                                        <select class="form-select" id="pilih_pengukuran" name="pilih_pengukuran" aria-label="Floating label select example">
                                            
                                        </select>
                                        <label for="floatingSelect">Masa Pengukuran</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Open</button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- Kondisi Pengukuran tidak Ditemukan! --}}
<div class="modal fade" tabindex="-1" id="modal_cek_pengukuran">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Data</h4>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="d-flex flex-column justify-content-center">
                    <p class="text-center fs-4">Data Pengukuran Tidak Ditemukan!</p>
                </div>
            </div>

            <div class="modal-footer">
                <div class="me-auto">
                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="p-2">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-stacked-modal="#modal_buat_pengukuran_1">Buat Pengukuran Awal</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Buat Data Pengukuran --}}
<div class="modal fade" tabindex="-1" id="modal_buat_pengukuran_1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buat Data Pengukuran</h4>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <form action="{{route('pnd.pa.'.$route.'.create-punch')}}">
                @csrf
                <div class="modal-body">
                    <div class="d-flex flex-column justify-content-center">
                        <p class="text-center fs-4">Masukkan Jumlah Punch</p>
                        <div class="mb-10">
                            <div class="position-relative">
                                <div class="required position-absolute top-0"></div>
                                <input type="number" class="form-control form-control-solid required text-center"
                                    placeholder="Jumlah Punch" name="jumlah_data_punch" />
                                <input type="hidden" name="create_id" id="create_id"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="p-2">
                        <button type="submit" class="btn btn-sm btn-primary" onclick="this.form.submit(); this.disabled = true; this.value='Creating...'">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function buatPengukuran(elem) {
        var id = elem.id;
        $.ajax({
            type: "GET",
            url: "{{route('pnd.pa.'.$route.'.create-pengukuran', ':id')}}".replace(':id', id),
            beforeSend: function (){
                $('#'+elem.id).prop('disabled', true);
            },
            success: function (data) {
                if(data.success == false){
                    Swal.fire({
                        icon: "error",
                        title: "Access Forbidden",
                        text: data.message,
                    });
                }else{
                    $('#create_id').val(elem.id);
                    $('#modal_buat_pengukuran_1').modal('show');
                }
            },
            complete: function() {
                $('#'+elem.id).prop('disabled', false);
            }
        })
    }

    function pilihPengukuran(elem) {
        $.ajax({
            type: "GET",
            url: "{{route('pnd.pr.'.$route.'.list', ':id')}}".replace(':id', elem.id),
            success: function (masa_pengukuran) {
                $('select[id=pilih_pengukuran]').html(masa_pengukuran);
                $('#form_pilih_pengukuran').attr('action', "{{route('pnd.pa.'.$route.'.cek-pengukuran', ':id')}}".replace(':id', elem.id));
                $('#modal_pilih_pengukuran').modal('show');
            }
        })
    }

    $(document).ready(function () {
        var start = 2010;
        var now = new Date().getFullYear();
        var options = "";

        for (var year = now; year >= start; year--) {
            options += `<option value='${year}'>${year}</option>`;
        }
        document.getElementById("tahun_buat").innerHTML = options;

        $('#submit').on('click', function (e) {
            e.preventDefault();

            var data = table.$('input, select').serialize();

            alert(
                'The following data would have been submitted to the server: \n\n' +
                data.substr(0, 120) +
                '...'
            );
        });

        // this is the id of the form
        $("#form_create_punch").submit(function (e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);

            $.ajax({
                type: "POST",
                url: "{{route('pnd.pa.'.$route.'.create')}}",
                data: form.serialize(), // serializes the form's elements.
                success: function (data) {
                    if(data.success == false){
                        Swal.fire({
                            icon: "error",
                            title: "Access Forbidden",
                            text: data.message,
                        });
                        $('#modal_create_data_punch').modal('hide');
                    }else{   
                        // console.log('oke');
                        $('#modal_create_data_punch').modal('hide');
                        $('#modal_buat_pengukuran_1').modal('show');
                        // show response from the php script.
                    }
                }
            });

        });

    })
</script>
@endsection
