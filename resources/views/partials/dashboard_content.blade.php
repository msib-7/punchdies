{{-- Total Punch Atas --}}
<div class="col-12 col-md-4">
    <!--begin::Card widget for Punch Atas-->
    <div class="card h-lg-100 mb-3 shadow-sm">
        <!--begin::Body-->
        <div class="card-body d-flex justify-content-between align-items-start flex-column">
            <div class="m-0">
                <span class="fw-semibold fs-3">Total Punch Atas</span>
            </div>
            <div class="d-flex flex-column mt-5">
                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ count($dataPunchAtas) }}</span>
                <div class="m-0">
                    <span class="fw-semibold fs-6 text-gray-400">Items</span>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card widget for Punch Atas-->
</div>
{{-- Total Punch Bawah --}}
<div class="col-12 col-md-4">
    <!--begin::Card widget for Punch Bawah-->
    <div class="card h-lg-100 mb-3 shadow-sm">
        <!--begin::Body-->
        <div class="card-body d-flex justify-content-between align-items-start flex-column">
            <div class="m-0">
                <span class="fw-semibold fs-3">Total Punch Bawah</span>
            </div>
            <div class="d-flex flex-column mt-5">
                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ count($dataPunchBawah) }}</span>
                <div class="m-0">
                    <span class="fw-semibold fs-6 text-gray-400">Items</span>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card widget for Punch Bawah-->
</div>
{{-- Total Dies --}}
<div class="col-12 col-md-4">
    <!--begin::Card widget for Dies-->
    <div class="card h-lg-100 mb-3 shadow-sm">
        <!--begin::Body-->
        <div class="card-body d-flex justify-content-between align-items-start flex-column">
            <div class="m-0">
                <span class="fw-semibold fs-3">Total Dies</span>
            </div>
            <div class="d-flex flex-column mt-5">
                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ count($dataDies) }}</span>
                <div class="m-0">
                    <span class="fw-semibold fs-6 text-gray-400">Items</span>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card widget for Dies-->
</div>
<div class="separator my-10 shadow-sm"></div>
{{-- Total Draft --}}
<div class="col-12 col-md-4">
    <!--begin::Card widget for Dies-->
    <div class="card h-lg-100 mb-3 shadow-sm">
        <!--begin::Body-->
        <div class="card-body d-flex justify-content-between align-items-start flex-column">
            <div class="m-0">
                <span class="fw-semibold fs-3">
                    <span class="badge badge-square badge-outline badge-dark fs-2">Draft</span>
                </span>
            </div>
            <div class="d-flex flex-column mt-5">
                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$draftCount['draftCount']}}</span>
                <div class="m-0">
                    <span class="fw-semibold fs-6 text-gray-400">Pengukuran Awal: {{$draftCount['draftPengukuranAwalCount']}}</span>
                </div>
                <div class="m-0">
                    <span class="fw-semibold fs-6 text-gray-400">Pengukuran Rutin: {{$draftCount['draftPengukuranRutinCount']}}</span>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card widget for Dies-->
</div>
{{-- Total Waiting --}}
<div class="col-12 col-md-4">
    <!--begin::Card widget for Dies-->
    <div class="card h-lg-100 mb-3 shadow-sm">
        <!--begin::Body-->
        <div class="card-body d-flex justify-content-between align-items-start flex-column">
            <div class="m-0">
                <span class="fw-semibold fs-3">
                    <span class="badge badge-square badge-outline badge-warning fs-2">Waiting Approval</span>
                </span>
            </div>
            <div class="d-flex flex-column mt-5">
                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$waitingCount['waitingCount']}}</span>
                <div class="m-0">
                    <span class="fw-semibold fs-6 text-gray-400">Pengukuran Awal: {{$waitingCount['waitingPengukuranAwalCount']}}</span>
                </div>
                <div class="m-0">
                    <span class="fw-semibold fs-6 text-gray-400">Pengukuran Rutin: {{$waitingCount['waitingPengukuranRutinCount']}}</span>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card widget for Dies-->
</div>
{{-- Total Approved --}}
<div class="col-12 col-md-4">
    <!--begin::Card widget for Dies-->
    <div class="card h-lg-100 mb-3 shadow-sm">
        <!--begin::Body-->
        <div class="card-body d-flex justify-content-between align-items-start flex-column">
            <div class="m-0">
                <span class="fw-semibold fs-3">
                    <span class="badge badge-square badge-outline badge-success fs-2">Approved</span>
                </span>
            </div>
            <div class="d-flex flex-column mt-5">
                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$approvedCount['approvedCount']}}</span>
                <div class="m-0">
                    <span class="fw-semibold fs-6 text-gray-400">Pengukuran Awal: {{$approvedCount['approvedPengukuranAwalCount']}}</span>
                </div>
                <div class="m-0">
                    <span class="fw-semibold fs-6 text-gray-400">Pengukuran Rutin: {{$approvedCount['approvedPengukuranRutinCount']}}</span>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card widget for Dies-->
</div>