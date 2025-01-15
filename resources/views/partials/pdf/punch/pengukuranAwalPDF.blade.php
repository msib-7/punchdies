<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href="../" />
    <title>Punch n Dies</title>
    <meta charset="utf-8" />
    {{-- <meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
            <meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" /> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/logo/logo_only.png') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>

    <style>
        div.dt-container .dt-search input {
            height: 40px;
            width: 200px;
            border-radius: 12px;
        }
    </style>
</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default"
    style="background-image: url('/assets/img/bglineB.svg'); background-repeat: repeat-y;">

    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }

    </script>
    <!--end::Theme mode setup on page load-->

    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" >
            <!--begin::Wrapper-->
            <div class=" flex-column flex-row-fluid">
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" >
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="accordion" id="kt_accordion_1">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="kt_accordion_1_header_1">
                                                                    <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                                                                        <span class="fs-2 fw-bold">{{ strtoupper($labelPunch->merk) }}</span>
                                                                    </button>
                                                                </h2>
                                                                <div id="kt_accordion_1_body_1" class="accordion-collapse collapse show" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                                                                    <div class="accordion-body">
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-6">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="table-responsive">
                                                                                            <table style="border: none;">
                                                                                                <tbody>
                                                                                                    <tr style="border: none; height: 30px;">
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            Merk Punch
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">:
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            {{ strtoupper($labelPunch->merk) }}</td>
                                                                                                    </tr>
                                                                                                    <tr style="border: none; height: 30px;">
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            Bulan/Tahun Pembuatan
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">:
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            {{ strtoupper($labelPunch->bulan_pembuatan).' '.$labelPunch->tahun_pembuatan }}</td>
                                                                                                    </tr>
                                                                                                    <tr style="border: none; height: 30px;">
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            Nama Mesin Cetak
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">:
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            {{ strtoupper($labelPunch->nama_mesin_cetak) }}</td>
                                                                                                    </tr>
                                                                                                    <tr style="border: none; height: 30px;">
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            Kode/Nama Produk
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">:
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            <?php if(strtoupper($labelPunch->nama_produk) == strtoupper($labelPunch->kode_produk)) {?>
                                                                                                                {{ strtoupper($labelPunch->nama_produk)}}
                                                                                                            <?php } else {?>
                                                                                                                {{ strtoupper($labelPunch->nama_produk)."/".strtoupper($labelPunch->kode_produk)}}
                                                                                                            <?php }?>
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
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            Masa Pengukuran
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">:
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            {{ ucwords($labelPunch->masa_pengukuran) }}</td>
                                                                                                    </tr>
                                                                                                    <tr style="border: none; height: 30px;">
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            Tanggal Pengukuran
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">:
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            {{ date_format($tglPengukuran->created_at, 'd M Y') }}
                                                                                                            {{-- {{ $labelPunch->created_at }} --}}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr style="border: none; height: 30px;">
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            Diukur oleh
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">:
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            {{ ucwords($labelPunch->username) }}</td>
                                                                                                    </tr>
                                                                                                    <tr style="border: none; height: 30px;">
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            Status
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">:
                                                                                                        </td>
                                                                                                        <td style="border: none;"
                                                                                                            class="fs-5 px-4 my-4">
                                                                                                            @if ($labelPunch->is_approved == '1')
                                                                                                                <span class="badge badge-square badge-outline badge-success">Approved</span>
                                                                                                            @elseif ($labelPunch->is_rejected == '1') <!-- Check for rejection -->
                                                                                                                <span class="badge badge-square badge-outline badge-danger">Rejected</span>
                                                                                                            @else
                                                                                                                @if ($labelPunch->is_draft == '1')
                                                                                                                    <span class="badge badge-square badge-outline badge-dark">Draft</span>
                                                                                                                @elseif ($labelPunch->is_draft == '0')
                                                                                                                    <span class="badge badge-square badge-outline badge-warning">Waiting</span>
                                                                                                                @endif
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
                                                    </div>
                                                    <div class="col-12 mt-5">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table  class="table table-bordered" style="width:100%">
                                                                        <thead>
                                                                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                                                                <th class="text-center">No Punch</th>
                                                                                <th class="text-center">Head Outer Diamter</th>
                                                                                <th class="text-center">Neck Diameter</th>
                                                                                <th class="text-center">Barrel</th>
                                                                                <th class="text-center">Overall Length</th>
                                                                                <th class="text-center">Tip Diameter 1</th>
                                                                                <th class="text-center">Tip Diameter 2</th>
                                                                                <th class="text-center">Cup Depth</th>
                                                                                <th class="text-center">Working Length</th>
                                                                                <th class="text-center">Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php $no = 1; ?>
                                                                            @foreach ($dataPengukuran as $item)
                                                                                <tr>
                                                                                    <td class="text-center">{{ $no++ }}</td>
                                                                                    <td class="text-center">{{ $item->head_outer_diameter }}</td>
                                                                                    <td class="text-center">{{ $item->neck_diameter }}</td>
                                                                                    <td class="text-center">{{ $item->barrel }}</td>
                                                                                    <td class="text-center">{{ $item->overall_length }}</td>
                                                                                    <td class="text-center">{{ $item->tip_diameter_1 }}</td>
                                                                                    <td class="text-center">{{ $item->tip_diameter_2 }}</td>
                                                                                    <td class="text-center">{{ $item->cup_depth }}</td>
                                                                                    <td class="text-center">{{ $item->working_length }}</td>
                                                                                    <td class="text-center">{{ $item->status }}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                <!--end::Row-->
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    
                    <!--begin::Footer-->
                    <div id="kt_app_footer" class="app-footer">
                        <!--begin::Footer container-->
                        <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                            <!--begin::Copyright-->
                            <div class="text-dark order-2 order-md-1">
                                <span class="text-muted fw-semibold me-1">2024&copy;</span>
                                <a href="" target="_blank" class="text-gray-800 text-hover-primary">Plant Technical Support</a>
                            </div>
                        <!--end::Footer container-->
                    </div>

                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-outline ki-arrow-up"></i>
    </div>
    <!--end::Scrolltop-->

    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="/assets/plugins/global/plugins.bundle.js"></script>
    <script src="/assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
    <script src="{{asset('assets/js/custom/widgets.js')}}"></script>
    <!--end::Javascript-->
</body>
<!--end::Body-->
</html>