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
                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2" data-kt-countup="true" data-kt-countup-value="{{ count($dataPunchAtas) }}" data-kt-countup-prefix="">{{ count($dataPunchAtas) }}</span>
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
                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2" data-kt-countup="true" data-kt-countup-value="{{ count($dataPunchBawah) }}" data-kt-countup-prefix="">{{ count($dataPunchBawah) }}</span>
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
                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2" data-kt-countup="true" data-kt-countup-value="{{ count($dataDies) }}" data-kt-countup-prefix="">{{ count($dataDies) }}</span>
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
        <div class="card-body">
            <div class="m-0">
                <span class="fw-semibold fs-3">
                    <span class="fs-2 fw-bold btn btn-secondary bg-gradient">Draft</span>
                </span>
            </div>
            <div class="d-flex flex-column mt-10">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <span class="fw-semibold fs-4x text-gray-800 lh-1 ls-n2" data-kt-countup="true" data-kt-countup-value="{{$draftCount['draftCount']}}" data-kt-countup-prefix="">{{$draftCount['draftCount']}}</span>
                        <div class="mx-1">
                            <span class="fw-semibold fs-6 text-gray-400">Items</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="m-2">
                            <span class="fw-semibold fs-6 text-gray-800">Pengukuran Awal: </span>
                            <span class="fw-semibold fs-6 text-gray-800" data-kt-countup="true" data-kt-countup-value="{{$draftCount['draftPengukuranAwalCount']}}">{{$draftCount['draftPengukuranAwalCount']}}</span>
                        </div>
                        <div class="m-2">
                            <span class="fw-semibold fs-6 text-gray-800">Pengukuran Rutin: </span>
                            <span class="fw-semibold fs-6 text-gray-800" data-kt-countup="true" data-kt-countup-value="{{$draftCount['draftPengukuranRutinCount']}}">{{$draftCount['draftPengukuranRutinCount']}}</span>
                        </div>
                    </div>
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
    <div class="card h-lg-100 mb-3 shadow">
        <!--begin::Body-->
        <div class="card-body">
            <div class="m-0">
                <span class="fw-semibold fs-3">
                    <span class="fs-2 fw-bold btn btn-warning bg-gradient">Waiting Approval</span>
                </span>
            </div>
            <div class="d-flex flex-column mt-10">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <span class="fw-semibold fs-4x text-gray-800 lh-1 ls-n2" data-kt-countup="true" data-kt-countup-value="{{$waitingCount['waitingCount']}}">{{$waitingCount['waitingCount']}}</span>
                        <div class="mx-1">
                            <span class="fw-semibold fs-6 text-gray-400">Items</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="m-2">
                            <span class="fw-semibold fs-6 text-gray-800">Pengukuran Awal: </span>
                            <span class="fw-semibold fs-6  text-gray-800" data-kt-countup="true" data-kt-countup-value="{{$waitingCount['waitingPengukuranAwalCount']}}">{{$waitingCount['waitingPengukuranAwalCount']}}</span>
                        </div>
                        <div class="m-2">
                            <span class="fw-semibold fs-6 text-gray-800">Pengukuran Rutin: </span>
                            <span class="fw-semibold fs-6  text-gray-800" data-kt-countup="true" data-kt-countup-value="{{$waitingCount['waitingPengukuranRutinCount']}}">{{$waitingCount['waitingPengukuranRutinCount']}}</span>
                        </div>
                    </div>
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
        <div class="card-body">
            <div class="m-0">
                <span class="fw-semibold fs-3">
                    <span class="fs-2 fw-bold btn btn-success bg-gradient">Approved</span>
                </span>
            </div>
            <div class="d-flex flex-column mt-10">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <span class="fw-semibold fs-4x text-gray-800 lh-1 ls-n2">{{$approvedCount['approvedCount']}}</span>
                        <div class="mx-1">
                            <span class="fw-semibold fs-6 text-gray-400">Items</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="m-2">
                            <span class="fw-semibold fs-6 text-gray-800">Pengukuran Awal: </span>
                            <span class="fw-semibold fs-6 text-gray-800" data-kt-countup="true" data-kt-countup-value="{{$approvedCount['approvedPengukuranAwalCount']}}">{{$approvedCount['approvedPengukuranAwalCount']}}</span>
                        </div>
                        <div class="m-2">
                            <span class="fw-semibold fs-6 text-gray-800">Pengukuran Rutin: </span>
                            <span class="fw-semibold fs-6 text-gray-800" data-kt-countup="true" data-kt-countup-value="{{$approvedCount['approvedPengukuranRutinCount']}}">{{$approvedCount['approvedPengukuranRutinCount']}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card widget for Dies-->
</div>