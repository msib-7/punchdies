@extends('layout.metronic')
@section('main-content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Data {{$jenisPunch}}
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted text-hover-primary">Total Punch: <b>{{ $ttlPunch }}</b></span>
                </li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <button class="btn btn-sm fw-bold btn-primary" id="createPunch" data-bs-toggle="modal" data-bs-target="#modal_create_data_punch">
                Create Data Punch
            </button>
        </div>
    </div>
</div>
<!--end::Toolbar-->

<!--begin::Accordion for Filters-->
<div class="accordion mb-4 mx-10" id="filterAccordion">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Filter Options
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#filterAccordion">
            <div class="accordion-body">
                <div class="row g-3">
                    <div class="col-12 col-md-2">
                        <label for="searchInput" class="form-label">Search</label>
                        <input type="text" id="searchInput" class="form-control" placeholder="Search..." onkeyup="filterCards()" title="Search by any keyword">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="statusFilter" class="form-label">Status</label>
                        <select id="statusFilter" class="form-select" onchange="filterCards()" title="Filter by status">
                            <option value="">All Statuses</option>
                            <option value="draft">Draft</option>
                            <option value="waiting">Waiting</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="merkFilter" class="form-label">Merk</label>
                        <input type="text" id="merkFilter" class="form-control" placeholder="Merk..." onkeyup="filterCards()" title="Filter by merk">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="tanggalPengukuranFilter" class="form-label">Measurement Date</label>
                        <input type="date" id="tanggalPengukuranFilter" class="form-control" onchange="filterCards()" title="Select the measurement date">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="namaMesinFilter" class="form-label">Machine Name</label>
                        <select id="namaMesinFilter" onchange="filterCards()" data-control="select2" data-dropdown-parent="#collapseOne" data-placeholder="Select a item..." class="form-select fw-bold">
                            <option value=""></option>
                            @foreach ($DataMesin as $item)
                                <option value="{{$item->title}}">{{$item->title}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" id="namaMesinFilter" class="form-control" placeholder="Nama Mesin..."  title="Filter by machine name"> --}}
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="lineFilter" class="form-label">Line</label>
                        <select id="lineFilter" class="form-select" onchange="filterCards()" title="Filter by line">
                            <option value="">All Lines</option>
                            @foreach ($DataLine as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_line }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-light" id="resetFilters">Reset Filters</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Accordion -->

{{-- Tabs --}}
<div class="mx-10">
    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
        <li class="nav-item">
            <a class="btn btn-light-primary shadow shadow-sm mx-1 active" data-bs-toggle="tab" href="#all_data_tab">All</a>
        </li>
        <li class="nav-item">
            <a class="btn btn-light-warning shadow shadow-sm mx-1" data-bs-toggle="tab" href="#perlu_ukur_tab">
                Perlu Pengukuran 
                <span class="badge badge-circle badge-light " id="badgePerluPengukuran">{{ count($dataPunchOlderThanOneYear) ?? '' }}</span>
            </a>
        </li>
    </ul>
</div>
{{-- end tabs --}}
<!--begin Content-->
<div class="mb-4 mx-10">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="all_data_tab" role="tabpanel">
            {{-- All --}}
            {{-- Content --}}
            <div class="row g-5 gx-xl-10" id="cardContainer">
                @foreach ($dataPunchRecent as $data)
                    <div class="col-12 col-md-6 col-lg-4 card-item mb-4" 
                        data-status="{{ $data->is_approved == '1' ? 'approved' : ($data->is_rejected == '1' ? 'rejected' : ($data->is_draft == '1' ? 'draft' : 'waiting')) }}" 
                        data-merk="{{ strtolower($data->merk) }}" 
                        data-nama-mesin="{{ strtolower($data->nama_mesin_cetak) }}" 
                        data-tanggal-pengukuran="{{ date_format($data->created_at, 'Y-m-d') }}" 
                        data-line="{{ $data->line_id }}">
                        <div class="card shadow-sm border-0 rounded-3 h-100">
                            <div class="card-header">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">{{ strtoupper($data->merk) }}</span>
                                </h3>
                                <!--end::Title-->
                                <!--begin::Toolbar-->
                                <div class="card-toolbar">
                                    @if ($data->is_approved == '1')
                                            <span class="badge badge-square badge-outline badge-success">Approved</span>
                                    @elseif ($data->is_rejected == '1') <!-- Check for rejection -->
                                        <span class="badge badge-square badge-outline badge-danger">Rejected</span>
                                    @else
                                        @if ($data->is_draft == '1')
                                            <span class="badge badge-square badge-outline badge-dark">Draft</span>
                                        @elseif ($data->is_draft == '0' &&  $data->is_waiting == '1')
                                            <span class="badge badge-square badge-outline badge-warning">Waiting</span>
                                        @endif
                                    @endif
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <div class="card-body">
                                <table class="card-text">
                                    <tbody>
                                        <tr>
                                            <td><strong>Bulan/Tahun Pembuatan</strong></td>
                                            <td><span class="px-2">:</span></td>
                                            <td>{{$data->bulan_pembuatan}} {{$data->tahun_pembuatan}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama Mesin</strong></td>
                                            <td><span class="px-2">:</span></td>
                                            <td>{{ strtoupper($data->nama_mesin_cetak) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kode Produk</strong></td>
                                            <td><span class="px-2">:</span></td>
                                            <td>{{ strtoupper($data->kode_produks->title ?? '-') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama Produk</strong></td>
                                            <td><span class="px-2">:</span></td>
                                            <td>{{ strtoupper($data->nama_produks->title ?? '-') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Pengukuran Terakhir</strong></td>
                                            <td><span class="px-2">:</span></td>
                                            <td>{{ strtoupper($data->masa_pengukuran) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal Pengukuran</strong></td>
                                            <td><span class="px-2">:</span></td>
                                            <td>{{ date_format($data->created_at, 'd M Y')}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex flex-column flex-md-row justify-content-between mt-3">
                                    @if($data->masa_pengukuran == '-') <!-- Check if there's no pengukuran awal -->
                                        <button class="btn btn-primary mb-2 mb-md-0" id="{{$data->punch_id}}" onclick="buatPengukuran(this)">Buat Pengukuran</button>
                                    @endif
                                    <button class="btn btn-secondary" id="{{$data->punch_id}}" onclick="pilihPengukuran(this)">
                                        <i class="ki-outline ki-eye fs-2"></i>
                                        Lihat Data Pengukuran
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4" id="paginationAllData">
                <ul class="pagination"></ul>
            </div>
        </div>
        <div class="tab-pane fade" id="perlu_ukur_tab" role="tabpanel">
            {{-- Data Perlu Pengukuran --}}
            {{-- Content --}}
            <div class="row g-5 gx-xl-10" id="cardContainer">
                @foreach ($dataPunchOlderThanOneYear as $data)
                    <div class="col-12 col-md-6 col-lg-4 card-item mb-4" 
                        data-status="{{ $data->is_approved == '1' ? 'approved' : ($data->is_rejected == '1' ? 'rejected' : ($data->is_draft == '1' ? 'draft' : 'waiting')) }}" 
                        data-merk="{{ strtolower($data->merk) }}" 
                        data-nama-mesin="{{ strtolower($data->nama_mesin_cetak) }}" 
                        data-tanggal-pengukuran="{{ date_format($data->created_at, 'Y-m-d') }}" 
                        data-bulan="{{ $data->bulan_pembuatan }}" 
                        data-tahun="{{ $data->tahun_pembuatan }}"
                        data-line="{{ $data->line_id }}">
                        <div class="card shadow-sm border-0 rounded-3 h-100">
                            <div class="card-header">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">{{ strtoupper($data->merk) }}</span>
                                </h3>
                                <!--end::Title-->
                                <!--begin::Toolbar-->
                                <div class="card-toolbar">
                                    @if ($data->is_approved == '1')
                                            <span class="badge badge-square badge-outline badge-success">Approved</span>
                                        @elseif ($data->is_rejected == '1') <!-- Check for rejection -->
                                            <span class="badge badge-square badge-outline badge-danger">Rejected</span>
                                        @else
                                            @if ($data->is_draft == '1')
                                                <span class="badge badge-square badge-outline badge-dark">Draft</span>
                                            @elseif ($data->is_draft == '0')
                                                <span class="badge badge-square badge-outline badge-warning">Waiting</span>
                                            @endif
                                        @endif
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <div class="card-body">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><strong>Bulan/Tahun Pembuatan</strong></td>
                                            <td><span class="px-2">:</span></td>
                                            <td>{{$data->bulan_pembuatan}} {{$data->tahun_pembuatan}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama Mesin</strong></td>
                                            <td><span class="px-2">:</span></td>
                                            <td>{{ strtoupper($data->nama_mesin_cetak) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kode Produk</strong></td>
                                            <td><span class="px-2">:</span></td>
                                            <td>{{ strtoupper($data->kode_produks->title ?? '-') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama Produk</strong></td>
                                            <td><span class="px-2">:</span></td>
                                            <td>{{ strtoupper($data->nama_produks->title ?? '-') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Pengukuran Terakhir</strong></td>
                                            <td><span class="px-2">:</span></td>
                                            <td>{{ strtoupper($data->masa_pengukuran) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal Pengukuran</strong></td>
                                            <td><span class="px-2">:</span></td>
                                            <td>{{ date_format($data->created_at, 'd M Y')}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="card-text"></p>
                                <div class="d-flex flex-column flex-md-row justify-content-between mt-3">
                                    @if($data->masa_pengukuran == '-') <!-- Check if there's no pengukuran awal -->
                                        <button class="btn btn-primary mb-2 mb-md-0" id="{{$data->punch_id}}" onclick="buatPengukuran(this)">Buat Pengukuran</button>
                                    @endif
                                    <button class="btn btn-secondary" id="{{$data->punch_id}}" onclick="pilihPengukuran(this)">
                                        <i class="ki-outline ki-eye fs-2"></i>
                                        Lihat Data Pengukuran
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4" id="paginationPerluPengukuran" style="display: none;">
                <ul class="pagination"></ul>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->

{{-- Create Data Punch Modal --}}
<div class="modal fade" tabindex="-1" id="modal_create_data_punch">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Create Data {{$jenisPunch}}</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <form id="form_create_punch">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <label for="exampleFormControlInput1" class="required form-label">Merk Punch</label>
                                    <input type="text" class="form-control @error('merk') is-invalid @enderror" placeholder="Masukkan Merk Punch" name="merk" />
                                    @error('merk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="exampleFormControlInput1" class="required form-label">Bulan Pembuatan</label>
                                        <select class="required form-select" aria-label="Select example" name="bulan_pembuatan">
                                            <option value="" disabled selected> - </option>
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
                                        <label for="exampleFormControlInput1" class="required form-label">Tahun Pembuatan</label>
                                        <select class="required form-select" aria-label="Select example" name="tahun_pembuatan" id="tahun_buat">
                                            <option disabled selected> - </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="separator my-10"></div>
                            <div class="col-12">
                                <div class="mb-5">
                                    <label for="exampleFormControlInput1" class="required form-label">Nama Mesin Cetak</label>
                                    <!--begin::Input-->
                                    <select name="nama_mesin_cetak" aria-label="Select a Nama Mesin" data-control="select2" data-dropdown-parent="#modal_create_data_punch" data-placeholder="Select a item..." class="form-select fw-bold">
                                        <option value="">Select</option>
                                        @foreach ($DataMesin as $item)
                                            <option value="{{$item->title}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">Nama Produk</label>
                                            <select name="nama_produk" aria-label="Select a Nama Produk" data-control="select2" data-dropdown-parent="#modal_create_data_punch" data-placeholder="Select a item..." class="form-select fw-bold">
                                                <option value="">Select</option>
                                                @foreach ($DataNamaProduk as $item)
                                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" placeholder="Masukkan Nama Produk" name="nama_produk" /> --}}
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">Kode Produk</label>
                                            <select name="kode_produk" aria-label="Select a Kode Produk" data-control="select2" data-dropdown-parent="#modal_create_data_punch" data-placeholder="Select a item..." class="form-select fw-bold">
                                                <option value="">Select</option>
                                                @foreach ($DataKodeProduk as $item)
                                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" class="form-control" placeholder="Masukkan Kode Produk" name="kode_produk" /> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="">
                                    <label for="exampleFormControlInput1" class="required form-label">Pilih Line untuk Punch</label>
                                    <select name="line_id" aria-label="Select a Line" data-control="select2" data-dropdown-parent="#modal_create_data_punch" data-placeholder="Select a item..." class="form-select fw-bold">
                                        <option value="">Select a Line</option>
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
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</ button>
                <button type="submit" class="btn btn-primary btn-create">Create Punch</button>
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

{{-- Filter Tools --}}
<script>
    let currentPageAllData = 1;
    let currentPagePerluPengukuran = 1;
    const itemsPerPage = 9;

    function filterCards() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const status = document.getElementById('statusFilter').value.toLowerCase();
        const merk = document.getElementById('merkFilter').value.toLowerCase();
        const tanggalPengukuran = document.getElementById('tanggalPengukuranFilter').value;
        const namaMesin = document.getElementById('namaMesinFilter').value; // Get the selected value
        const line = document.getElementById('lineFilter').value;

        // Get the currently active tab
        const activeTab = document.querySelector('.nav-tabs .active').getAttribute('href').substring(1);
        const cards = document.querySelectorAll(`#${activeTab} .card-item`);

        // Hide all cards initially
        cards.forEach(card => {
            card.style.display = 'none';
        });

        const visibleCards = Array.from(cards).filter(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const bodyText = card.querySelector('.card-text').textContent.toLowerCase();
            const cardStatus = card.getAttribute('data-status');
            const cardMerk = card.getAttribute('data-merk');
            const cardNamaMesin = card.getAttribute('data-nama-mesin');
            const cardTanggalPengukuran = card.getAttribute('data-tanggal-pengukuran');
            const cardLine = card.getAttribute('data-line');

            const matchesSearch = title.includes(input) || bodyText.includes(input);
            const matchesStatus = status === '' || cardStatus === status;
            const matchesMerk = cardMerk.includes(merk);
            const matchesNamaMesin = cardNamaMesin.includes(namaMesin); // Check against the selected machine name
            const matchesTanggal = tanggalPengukuran === '' || cardTanggalPengukuran === tanggalPengukuran;
            const matchesLine = line === '' || cardLine === line;

            return matchesSearch && matchesStatus && matchesMerk && matchesNamaMesin && matchesTanggal && matchesLine;
        });

        // Show only the visible cards
        visibleCards.forEach(card => {
            card.style.display = '';
        });

        // Setup pagination based on the active tab
        if (activeTab === 'all_data_tab') {
            setupPagination(visibleCards, 'paginationAllData');
            showPage(currentPageAllData, visibleCards, 'paginationAllData');
        } else if (activeTab === 'perlu_ukur_tab') {
            setupPagination(visibleCards, 'paginationPerluPengukuran');
            showPage(currentPagePerluPengukuran, visibleCards, 'paginationPerluPengukuran');
        }
    }

    function setupPagination(visibleCards, paginationId) {
        const totalPages = Math.ceil(visibleCards.length / itemsPerPage);
        const paginationLinks = document.querySelector(`#${paginationId} .pagination`);
        paginationLinks.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const link = document .createElement('a');
            link.textContent = i;
            link.className = 'page-link';
            link.href = '#';
            link.onclick = (e) => {
                e.preventDefault();
                if (paginationId === 'paginationAllData') {
                    currentPageAllData = i;
                    showPage(currentPageAllData, visibleCards, paginationId);
                } else {
                    currentPagePerluPengukuran = i;
                    showPage(currentPagePerluPengukuran, visibleCards, paginationId);
                }
            };
            const listItem = document.createElement('li');
            listItem.className = 'page-item';
            listItem.appendChild(link);
            paginationLinks.appendChild(listItem);
        }
    }

    function showPage(page, visibleCards, paginationId) {
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        visibleCards.forEach((card, index) => {
            card.style.display = (index >= start && index < end) ? '' : 'none';
        });

        // Show or hide the pagination based on the number of visible cards
        const paginationContainer = document.getElementById(paginationId);
        paginationContainer.style.display = visibleCards.length > itemsPerPage ? 'flex' : 'none';
    }

    window.onload = () => {
        filterCards(); // Initial filter to show all cards
    };
</script>

{{-- Reset Filter --}}
<script>
    document.getElementById('resetFilters').addEventListener('click', function() {
        // Reset the search input
        document.getElementById('searchInput').value = '';

        // Reset the status filter
        document.getElementById('statusFilter').value = '';

        // Reset the merk filter
        document.getElementById('merkFilter').value = '';

        // Reset the tanggal pengukuran filter
        document.getElementById('tanggalPengukuranFilter').value = '';

        // Reset the nama mesin filter
        document.getElementById('namaMesinFilter').value = '';

        // Reset the line filter
        document.getElementById('lineFilter').value = '';

        // Call the filterCards function to refresh the displayed cards
        filterCards();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const createButton = document.getElementById('createPunch');
        const modal = document.getElementById('modal_create_data_punch');

        // Disable the button when clicked
        createButton.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default action
            createButton.disabled = true; // Disable the button
        });

        // Enable the button when the modal is closed
        modal.addEventListener('hidden.bs.modal', function () {
            createButton.disabled = false; // Enable the button
        });
    });

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

        if ({{ count($dataPunchOlderThanOneYear) }} > 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Attention!',
                text: 'Terdapat data yang memerlukan pengukuran rutin!',
                confirmButtonText: 'Okay'
            });
        }
        
        document.querySelectorAll('.nav-tabs a').forEach(tab => {
            tab.addEventListener('click', filterCards);
        });

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

        $("#form_create_punch").submit(function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            $('.btn-create').html('Sending..');

            // Clear previous error messages
            $('.invalid-feedback').remove();

            // Validate required fields
            let isValid = true;
            const requiredFields = ['merk'];

            requiredFields.forEach(field => {
                const input = $(`[name="${field}"]`);
                if (input.val().trim() === '') {
                    isValid = false;
                    input.addClass('is-invalid'); // Add invalid class for Bootstrap styling
                    input.after(`<div class="invalid-feedback">This field is required.</div>`); // Show error message
                } else {
                    input.removeClass('is-invalid'); // Remove invalid class if field is filled
                }
            });

            // Check if the select fields are selected
            const selectFields = ['nama_mesin_cetak', 'kode_produk', 'nama_produk','line_id', 'bulan_pembuatan', 'tahun_pembuatan'];
            selectFields.forEach(field => {
                const select = $(`[name="${field}"]`);
                if (select.val() === null || select.val() === '') {
                    isValid = false;
                    select.addClass('is-invalid'); // Add invalid class for Bootstrap styling
                    select.after(`<div class="invalid-feedback">This field is required.</div>`); // Show error message
                } else {
                    select.removeClass('is-invalid'); // Remove invalid class if field is filled
                }
            });

            if (!isValid) {
                $('.btn-create').html('Create Punch'); // Reset button text
                return; // Stop the form submission
            }

            var form = $(this);

            $.ajax({
                type: "POST",
                url: "{{route('pnd.pa.'.$route.'.create')}}",
                data: form.serialize(), // serializes the form's elements.
                beforeSend: function (){
                    $('.btn-create').prop('disabled', true);
                },
                success: function (data) {
                    if(data.success == false){
                        Swal.fire({
                            icon: "error",
                            title: "Access Forbidden",
                            text: data.message,
                        });
                        $('#modal_create_data_punch').modal('hide');
                    }else{   
                        $('#modal_create_data_punch').modal('hide');
                        $('#modal_buat_pengukuran_1').modal('show');
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: "An unexpected error occurred!",
                    });
                    $('.btn-create').html('Create Punch');
                },
                complete: function() {
                    $('.btn-create').prop('disabled', false);
                    $('.btn-create').html('Create Punch');
                }
            });
        });
    })
</script>
@endsection