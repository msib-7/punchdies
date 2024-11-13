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
                                <table id="PA_Table_List" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Data Punch</th>
                                            <th>Merk</th>
                                            <th>Bulan/Tahun</th>
                                            <th>Nama Mesin</th>
                                            <th>Kode/Nama Produk</th>
                                            <th>Pengukuran</th>
                                            <th>Tgl Pengukuran</th>
                                            <th>diukur oleh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataPunch as $data)
                                        <tr>
                                            <td>
                                                <div class="btn btn-active-light-dark"
                                                    style="border: 1px solid #E2E2E9;width: -webkit-fill-available; text-align: left">
                                                    <div class="col-12">
                                                        <div class="px-10">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="d-flex">
                                                                        <div class="me-auto">
                                                                            <h1 class="p-4 d-flex align-items-center">
                                                                                {{ strtoupper($data->merk)}}
                                                                                &nbsp;
                                                                                <span
                                                                                    class="badge badge-square badge-outline badge-primary px-2">New</span>
                                                                            </h1>
                                                                        </div>
                                                                        <div class="p-2">
                                                                            <button href="#" data-bs-toggle="modal"
                                                                                data-bs-target="#modal_cek_pengukuran"
                                                                                class="btn btn-secondary p-2">
                                                                                <i
                                                                                    class="ki-duotone ki-magnifier fs-1 px-2">
                                                                                    <span class="path1"></span>
                                                                                    <span class="path2"></span>
                                                                                </i>
                                                                                Lihat Data Pengukuran</button>
                                                                        </div>
                                                                        <div class="p-2">
                                                                            <button class="btn btn-outline p-2">
                                                                                <i
                                                                                    class="ki-outline ki-dots-vertical fs-1 p-0"></i>
                                                                            </button>
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
                                                                                                Kode/Nama Produk
                                                                                            </td>
                                                                                            <td style="border: none;"
                                                                                                class="fs-3 px-4 my-4">:
                                                                                            </td>
                                                                                            <td style="border: none;"
                                                                                                class="fs-3 px-4 my-4">
                                                                                                TCRV3</td>
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
                                                                                                Pengukuran Awal</td>
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
                                                                                                14 Juli 2024</td>
                                                                                        </tr>
                                                                                        <tr
                                                                                            style="border: none; height: 30px;">
                                                                                            <td style="border: none;"
                                                                                                class="fs-3 px-4 my-4">
                                                                                                Diukur oleh
                                                                                            </td>
                                                                                            <td style="border: none;"
                                                                                                class="fs-3 px-4 my-4">:
                                                                                            </td>
                                                                                            <td style="border: none;"
                                                                                                class="fs-3 px-4 my-4">
                                                                                                Teknisi 1</td>
                                                                                        </tr>
                                                                                        <tr
                                                                                            style="border: none; height: 30px;">
                                                                                            <td style="border: none;"
                                                                                                class="fs-3 px-4 my-4"
                                                                                                colspan="3">
                                                                                                <span
                                                                                                    class="badge badge-light-success fs-5">Approved</span>
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
                                            </td>
                                            <td>{{$data->merk}}</td>
                                            <td>{{$data->bulan_pembuatan}} {{$data->tahun_pembuatan}}</td>
                                            <td>{{$data->nama_mesin_cetak}}</td>
                                            <td>{{$data->kode_produk}}</td>
                                            <td></td>
                                            <td></td>
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
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <select class="form-select" aria-label="Select example" name="tahun_pembuatan">
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
                                        <option value="1">Line 8A</option>
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

            <form action="{{ url('/data/punch-atas/pengukuran-awal') }}">
                @csrf
                <div class="modal-body">
                    <div class="d-flex flex-column justify-content-center">
                        <p class="text-center fs-4">Masukkan Jumlah Punch</p>
                        <div class="mb-10">
                            <div class="position-relative">
                                <div class="required position-absolute top-0"></div>
                                <input type="number" class="form-control form-control-solid required text-center"
                                    placeholder="Jumlah Punch" name="jumlah_data_punch" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="p-2">
                        <button type="submit" class="btn btn-sm btn-primary">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // alert('ok');
        // this is the id of the form
        $("#form_create_punch").submit(function (e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);

            $.ajax({
                type: "POST",
                url: '/data/punch-atas/create-data',
                data: form.serialize(), // serializes the form's elements.
                success: function (data) {
                    // console.log('oke');
                    $('#modal_create_data_punch').modal('hide');
                    $('#modal_buat_pengukuran_1').modal('show');
                    // show response from the php script.
                }
            });

        });
    });

</script>
@endsection
