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
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Filter Options
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#filterAccordion">
            <div class="accordion-body">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
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
                        <input type="text" id="namaMesinFilter" class="form-control" placeholder="Nama Mesin..." onkeyup="filterCards()" title="Filter by machine name">
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="bulanFilter" class="form-label">Month</label>
                        <select id="bulanFilter" class="form-select" onchange="filterCards()" title="Filter by month of production">
                            <option value="">All Months</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March </option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="tahunFilter" class="form-label">Year</label>
                        <input type="number" id="tahunFilter" class="form-control" placeholder="Tahun..." onkeyup="filterCards()" title="Filter by year of production">
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
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Accordion -->

<!--begin Content-->
<div class="mb-4 mx-10">
    <div class="row g-5 gx-xl-10" id="cardContainer">
        @foreach ($dataPunch as $data)
            <div class="col-12 col-md-6 col-lg-4 card-item mb-4" 
                data-status="{{ $data->is_approved == '1' ? 'approved' : ($data->is_rejected == '1' ? 'rejected' : ($data->is_draft == '1' ? 'draft' : 'waiting')) }}" 
                data-merk="{{ strtolower($data->merk) }}" 
                data-nama-mesin="{{ strtolower($data->nama_mesin_cetak) }}" 
                data-tanggal-pengukuran="{{ date_format($data->created_at, 'Y-m-d') }}" 
                data-bulan="{{ $data->bulan_pembuatan }}" 
                data-tahun="{{ $data->tahun_pembuatan }}"
                data-line="{{ $data->line_id }}">
                <div class="card shadow-sm border-0 rounded-3 h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ strtoupper($data->merk) }}
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
                        </h5>
                        <div class="separator border-info border-3 my-4"></div>
                        <p class="card-text">Bulan/Tahun Pembuatan: <strong>{{$data->bulan_pembuatan}} {{$data->tahun_pembuatan}}</strong></p>
                        <p class="card-text">Nama Mesin: <strong>{{ strtoupper($data->nama_mesin_cetak) }}</strong></p>
                        <p class="card-text">Kode Produk: <strong>{{ strtoupper($data->kode_produk) }}</strong></p>
                        <p class="card-text">Nama Produk: <strong>{{ strtoupper($data->nama_produk) }}</strong></p>
                        <p class="card-text">Pengukuran Terakhir: <strong>{{ ucwords($data->masa_pengukuran) }}</strong></p>
                        <p class="card-text">Tanggal Pengukuran: <strong>{{ date_format($data->created_at, 'd M Y')}}</strong></p>
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
    <div class="d-flex justify-content-center mt-4">
        <ul class="pagination"></ul>
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
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Mesin" name="nama_mesin_cetak" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">Nama Produk</label>
                                            <input type="text" class="form-control" placeholder="Masukkan Nama Produk" name="nama_produk" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">Kode Produk</label>
                                            <input type="text" class="form-control" placeholder="Masukkan Kode Produk" name="kode_produk" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="">
                                    <label for="exampleFormControlInput1" class="required form-label">Pilih Line untuk Punch</label>
                                    <select class="form-select" aria-label="Select example" name="line_id">
                                        <option disabled selected> - </option>
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
    let currentPage = 1;
    const itemsPerPage = 9;

    function filterCards() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const status = document.getElementById('statusFilter').value.toLowerCase();
        const merk = document.getElementById('merkFilter').value.toLowerCase();
        const tanggalPengukuran = document.getElementById('tanggalPengukuranFilter').value;
        const namaMesin = document.getElementById('namaMesinFilter').value.toLowerCase();
        const bulan = document.getElementById('bulanFilter').value;
        const tahun = document.getElementById('tahunFilter').value;
        const line = document.getElementById('lineFilter').value;
        const cards = document.querySelectorAll('.card-item');

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
            const cardBulan = card.getAttribute('data-bulan');
            const cardTahun = card.getAttribute('data-tahun');
            const cardLine = card.getAttribute('data-line');

            const matchesSearch = title.includes(input) || bodyText.includes(input);
            const matchesStatus = status === '' || cardStatus === status;
            const matchesMerk = cardMerk.includes(merk);
            const matchesNamaMesin = cardNamaMesin.includes(namaMesin);
            const matchesTanggal = tanggalPengukuran === '' || cardTanggalPengukuran === tanggalPengukuran;
            const matchesBulan = bulan === '' || cardBulan === bulan;
            const matchesTahun = tahun === '' || cardTahun === tahun;
            const matchesLine = line === '' || cardLine === line;

            return matchesSearch && matchesStatus && matchesMerk && matchesNamaMesin && matchesTanggal && matchesBulan && matchesTahun && matchesLine;
        });

        // Show only the visible cards
        visibleCards.forEach(card => {
            card.style.display = '';
        });

        setupPagination(visibleCards);
        showPage(currentPage, visibleCards);
    }

    function setupPagination(visibleCards) {
        const totalPages = Math.ceil(visibleCards.length / itemsPerPage);
        const paginationLinks = document.querySelector('.pagination');
        paginationLinks.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const link = document.createElement('a');
            link.textContent = i;
            link.className = 'page-link';
            link.href = '#';
            link.onclick = (e) => {
                e.preventDefault();
                currentPage = i;
                showPage(currentPage, visibleCards);
            };
            const listItem = document.createElement('li');
            listItem.className = 'page-item';
            listItem.appendChild(link);
            paginationLinks.appendChild(listItem);
        }
    }

    function showPage(page, visibleCards) {
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        visibleCards.forEach((card, index) => {
            card.style.display = (index >= start && index < end) ? '' : 'none';
        });
    }

    window.onload = () => {
        filterCards(); // Initial filter to show all cards
    };
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
        const requiredFields = ['merk', 'nama_mesin_cetak', 'nama_produk', 'kode_produk'];

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
        const selectFields = ['line_id', 'bulan_pembuatan', 'tahun_pembuatan'];
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
        // // this is the id of the form
        // $("#form_create_punch").submit(function (e) {

        //     e.preventDefault(); // avoid to execute the actual submit of the form.
        //     $('.btn-create').html('Sending..');

        //     var form = $(this);

        //     $.ajax({
        //         type: "POST",
        //         url: "{{route('pnd.pa.'.$route.'.create')}}",
        //         data: form.serialize(), // serializes the form's elements.
        //         beforeSend: function (){
        //             $('.btn-create').prop('disabled', true);
        //         },
        //         success: function (data) {
        //             if(data.success == false){
        //                 Swal.fire({
        //                     icon: "error",
        //                     title: "Access Forbidden",
        //                     text: data.message,
        //                 });
        //                 $('#modal_create_data_punch').modal('hide');
        //             }else{   
        //                 // console.log('oke');
        //                 $('#modal_create_data_punch').modal('hide');
        //                 $('#modal_buat_pengukuran_1').modal('show');
        //                 // show response from the php script.
        //             }
        //         },
        //         error: function () {
        //             Swal.fire({
        //                     icon: "error",
        //                     title: 'Error!',
        //                     text: "Fields Cannot be Empty!",
        //                 });
        //         },
        //         complete: function() {
        //             $('.btn-create').prop('disabled', false);
        //             $('.btn-create').html('Create Punch');
        //         }
        //     });

        // });

    })
</script>
@endsection