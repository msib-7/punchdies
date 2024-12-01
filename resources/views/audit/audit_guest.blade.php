<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    @include('layout.head')
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="light-header" data-kt-app-header-fixed="true"
    data-kt-app-toolbar-enabled="true" class="app-default">

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
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <div id="kt_app_header" class="app-header" data-kt-sticky="true"
                data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize"
                data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
                <!--begin::Header container-->
                <div class="app-container container-xxl d-flex align-items-stretch justify-content-between"
                    id="kt_app_header_container">
                    <!--begin::Logo-->
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
                        <a href="#">
                            <img alt="Logo" src="{{asset('assets/logo/kalbe_farma_svg.svg')}}"
                                class="h-50px app-sidebar-logo-default theme-light-show" />
                            <img alt="Logo" src="{{asset('assets/logo/kalbe_farma_svg.svg')}}"
                                class="h-50px app-sidebar-logo-default theme-dark-show" style="filter: contrast(0);" />
                            <img alt="Logo" src="{{asset('assets/logo/logo_only.png')}}"
                                class="h-50px app-sidebar-logo-minimize" />
                        </a>
                    </div>
                    <!--end::Logo-->
                    <!--begin::Header wrapper-->
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
                        id="kt_app_header_wrapper">
                        <!--begin::Menu wrapper-->
                        <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                            data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                            data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                            data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                            data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                            data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                            <!--begin::Menu-->
                            <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
                                id="kt_app_header_menu" data-kt-menu="true">
                                {{-- <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start"
                                    class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                                    <!--begin:Menu link-->
                                    <span class="menu-link">
                                        <span class="menu-title"><h3>Audit Trail</h3></span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </span>
                                    <!--end:Menu link-->
                                </div> --}}
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Menu wrapper-->
                        <!--begin::Navbar-->
                        <div class="app-navbar flex-shrink-0">
                            <!--begin::User menu-->
                            <div class="app-navbar-item ms-1 ms-md-4">
                                <!--begin::Menu wrapper-->
                                <div class="cursor-pointer symbol symbol-35px"
                                    data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-end">
                                    <a href="{{url('/')}}" class="btn btn-light-danger btn-lg"><i
                                            class="ki-solid ki-exit-left fs-1"></i> Back</a>
                                </div>
                                <!--end::Menu wrapper-->
                            </div>
                            <!--end::User menu-->
                            <!--begin::Header menu toggle-->
                            <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
                                <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px"
                                    id="kt_app_header_menu_toggle">
                                    <i class="ki-outline ki-element-4 fs-1"></i>
                                </div>
                            </div>
                            <!--end::Header menu toggle-->
                            <!--begin::Aside toggle-->
                            <!--end::Header menu toggle-->
                        </div>
                        <!--end::Navbar-->
                    </div>
                    <!--end::Header wrapper-->
                </div>
                <!--end::Header container-->
            </div>
            <!--end::Header-->

            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <div class="card card-flush">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0 pt-6">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h3>Audit Trail</h3>
                                        </div>
                                        <!--begin::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <div class="card-body">
                                        <table id="table_audit" class="table align-middle table-row-dashed fs-6 gy-5"
                                            style="width:100%">
                                            <thead>
                                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                    <th>Log date</th>
                                                    <th>Event</th>
                                                    <th>User</th>
                                                    <th>Line</th>
                                                    <th>Category</th>
                                                    <th>Event Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dataAudit as $data)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-center">
                                                            <a href=""
                                                                class="text-gray-800 mb-1">{{ $data->created_at}}</a>
                                                        </div>
                                                    </td>
                                                    <td class="d-flex align-items-center">
                                                        <!--begin::User details-->
                                                        <div class="d-flex flex-center">
                                                            <a href=""
                                                                class="text-gray-800 text-hover-primary mb-1">{{ json_encode($data->new_data, JSON_PRETTY_PRINT).' '.$data->action}}</a>
                                                        </div>
                                                        <!--begin::User details-->
                                                    </td>
                                                    <td>
                                                        <div class="text-gray-800">{{ ucwords($data->username)}}</div>
                                                    </td>
                                                    <td>
                                                        <div class="text-gray-800">{{ $data->line}}</div>
                                                    </td>
                                                    <td>
                                                        <div class="text-gray-800">{{ $data->category}}</div>
                                                    </td>
                                                    <td>
                                                        <div class="text-gray-800">{{ $data->detail}}</div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->

                    <!--begin::Footer-->
                    @include('layout.footer')
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
    @include('layout.javascript')
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
