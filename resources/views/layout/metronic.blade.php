<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    @include('layout.head')
</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_app_body"
    @if(!$browser->isMobile())
        data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true"
        data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" 
        data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" 
        data-kt-app-sidebar-push-toolbar="true"
        @if(Request::segment(4) == 'form_pengukuran' || $browser->isMobile())
        data-kt-app-sidebar-minimize="on"
        @endif
        data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" 
    @endif
    class="app-default" style="background-image: url('/assets/img/bglineB.svg'); background-repeat: repeat-y;">

    <!--begin::Page loading(append to body)-->
    <div class="page-loading">
        <div class="page-loader flex-column bg-light bg-opacity-50">
            <span class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status"></span>
            <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
        </div>
    </div>
    <!--end::Page loading-->
    
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
            @if ($browser->isMobile())
                @include('layout.header-mobile')
            @else
                @include('layout.header')
            @endif
            <!--end::Header-->

            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                @if (!$browser->isMobile())
                    @include('layout.sidebar')
                @endif
                <!--end::Sidebar-->

                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        @yield('main-content')
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