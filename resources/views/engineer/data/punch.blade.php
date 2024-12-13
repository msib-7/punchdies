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
            <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#modal_create_data_punch">
                Create Data Punch
            </a>
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
                            <option value="success">Success/Approved</option>
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
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option <option value="12">December</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <label for="tahunFilter" class="form-label">Year</label>
                        <input type="number" id="tahunFilter" class="form-control" placeholder="Tahun..." onkeyup="filterCards()" title="Filter by year of production">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Accordion -->

<!--begin::Search Bar and Filters-->
<div class="mb-4 mx-10">
    <div class="row g-5 gx-xl-10" id="cardContainer">
        @foreach ($dataPunch as $data)
        <div class="col-12 col-md-6 col-lg-4 card-item mb-4" 
             data-status="{{ $data->is_draft == '1' ? 'draft' : ($data->is_draft == '0' ? 'waiting' : 'success') }}" 
             data-merk="{{ strtolower($data->merk) }}" 
             data-nama-mesin="{{ strtolower($data->nama_mesin_cetak) }}" 
             data-tanggal-pengukuran="{{ date_format($data->created_at, 'Y-m-d') }}" 
             data-bulan="{{ $data->bulan_pembuatan }}" 
             data-tahun="{{ $data->tahun_pembuatan }}">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ strtoupper($data->merk) }}
                        @if ($data->is_draft == '1')
                            <span class="badge badge-square badge-outline badge-dark">Draft</span>
                        @elseif ($data->is_draft == '0')
                            <span class="badge badge-square badge-outline badge-warning">Waiting</span>
                        @else
                            <span class="badge badge-square badge-outline badge-success">Success</span>
                        @endif
                    </h5>
                    <p class="card-text">Bulan/Tahun Pembuatan: <strong>{{$data->bulan_pembuatan}} {{$data->tahun_pembuatan}}</strong></p>
                    <p class="card-text">Nama Mesin: <strong>{{ strtoupper($data->nama_mesin_cetak) }}</strong></p>
                    <p class="card-text">Kode Produk: <strong>{{ strtoupper($data->kode_produk) }}</strong></p>
                    <p class="card-text">Nama Produk: <strong>{{ strtoupper($data->nama_produk) }}</strong></p>
                    <p class="card-text">Pengukuran Terakhir: <strong>{{ ucwords($data->masa_pengukuran) }}</strong></p>
                    <p class="card-text">Tanggal Pengukuran: <strong>{{ date_format($data->created_at, 'd M Y')}}</strong></p>
                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-primary" id="{{$data->punch_id}}" onclick="buatPengukuran(this)">Buat Pengukuran</button>
                        <button class="btn btn-secondary" id="{{$data->punch_id}}" onclick="pilihPengukuran(this)">Lihat Data Pengukuran</button>
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

<script>
    function filterCards() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const status = document.getElementById('statusFilter').value.toLowerCase();
 const merk = document.getElementById('merkFilter').value.toLowerCase();
        const tanggalPengukuran = document.getElementById('tanggalPengukuranFilter').value;
        const namaMesin = document.getElementById('namaMesinFilter').value.toLowerCase();
        const bulan = document.getElementById('bulanFilter').value;
        const tahun = document.getElementById('tahunFilter').value;
        const cards = document.querySelectorAll('.card-item');

        cards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const bodyText = card.querySelector('.card-text').textContent.toLowerCase();
            const cardStatus = card.getAttribute('data-status');
            const cardMerk = card.getAttribute('data-merk');
            const cardNamaMesin = card.getAttribute('data-nama-mesin');
            const cardTanggalPengukuran = card.getAttribute('data-tanggal-pengukuran');
            const cardBulan = card.getAttribute('data-bulan');
            const cardTahun = card.getAttribute('data-tahun');

            const matchesSearch = title.includes(input) || bodyText.includes(input);
            const matchesStatus = status === '' || cardStatus === status;
            const matchesMerk = cardMerk.includes(merk);
            const matchesNamaMesin = cardNamaMesin.includes(namaMesin);
            const matchesTanggal = tanggalPengukuran === '' || cardTanggalPengukuran === tanggalPengukuran;
            const matchesBulan = bulan === '' || cardBulan === bulan;
            const matchesTahun = tahun === '' || cardTahun === tahun;

            if (matchesSearch && matchesStatus && matchesMerk && matchesNamaMesin && matchesTanggal && matchesBulan && matchesTahun) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    };

    function setupPagination() {
        const cards = document.querySelectorAll('.card-item');
        const itemsPerPageLg = 9;
        const itemsPerPageSm = 5;
        const itemsPerPage = window.innerWidth >= 992 ? itemsPerPageLg : itemsPerPageSm;
        const totalPages = Math.ceil(cards.length / itemsPerPage);

        let currentPage = 1;

        function showPage(page) {
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            cards.forEach((card, index) => {
                card.style.display = (index >= start && index < end) ? '' : 'none';
            });
        }

        showPage(currentPage);

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
                showPage(currentPage);
            };
            const listItem = document.createElement('li');
            listItem.className = 'page-item';
            listItem.appendChild(link);
            paginationLinks.appendChild(listItem);
        }
    }

    window.onload = () => {
        setupPagination();
        filterCards(); // Initial filter to show all cards
    };
    window.onresize = setupPagination; // Recalculate on window resize
</script>
@endsection