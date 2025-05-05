<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../" />
    <title>PT Kalbe Farma</title>
    <meta charset="utf-8" />
    {{-- <meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" /> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - Bootstrap Admin Template, HTML, VueJS, React, Angular. Laravel, Asp.Net Core, Ruby on Rails, Spring Boot, Blazor, Django, Express.js, Node.js, Flask Admin Dashboard Theme & Template" />
    <meta property="og:url" content="https://bit.ly/kfoperation" />
    <meta property="og:site_name" content="PT Kalbe Farma" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <link rel="shortcut icon" href="{{ asset('assets/logo/favicon.ico') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="{{ asset('assets/css/inter_font_api.css') }}" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }

    </script>
    <link href="{{ asset('assets/css/sweetalert2.min.css')}}" rel="stylesheet">
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center"
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
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('assets/media/auth/bg10.jpeg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('assets/media/auth/bg10-dark.jpeg');
            }

        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-center flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <!--begin::Wrapper-->
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-500px p-10 shadow border">
                    <!--begin::Content-->
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-10 pb-lg-15">
                            <!--begin::Form-->
                            <form class="form w-100" id="loginForm">
                                @csrf
                                <!--begin::Heading-->
                                <span class="d-flex flex-center">
                                    <img alt="Logo" src="{{asset('assets/logo/Logo-Kalbe-&-BSB_Original.png')}}"
                                        class="h-100px app-sidebar-logo-default theme-light-show" />
                                    <img alt="Logo" src="{{asset('assets/logo/Logo-Kalbe-&-BSB_Original.png')}}"
                                        class="h-100px app-sidebar-logo-default theme-dark-show"
                                        style="filter: contrast(0);" />
                                </span>
                                <!--begin::Heading-->
                                <!--begin::Heading-->
                                <div class="text-center mb-8">
                                    <!--begin::Title-->
                                    <h1 class="text-dark fw-bolder">Sign In</h1>
                                    <!--end::Title-->
                                    <!--begin::Subtitle-->
                                    <div class="text-gray-500 fw-semibold fs-6">Portal Punch n Dies</div>
                                    <!--end::Subtitle=-->
                                </div>
                                <!--begin::Heading-->
                                @if ($errors->any())
                                <!--begin::Alert-->
                                <div
                                    class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10">
                                    <!--begin::Icon-->
                                    {{-- <i class="ki-solid ki-security-check fs-2hx text-danger me-4 mb-5 mb-sm-0"></i> --}}
                                    <!--end::Icon-->

                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column text-danger pe-0 pe-sm-10">

                                        <!--begin::Content-->
                                        <span>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </span>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->

                                    <!--begin::Close-->
                                    <button type="button"
                                        class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                                        data-bs-dismiss="alert">
                                        <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </button>
                                    <!--end::Close-->
                                </div>
                                <!--end::Alert-->
                                @endif
                                <!--begin::Input group=-->
                                <div class="fv-row my-2">
                                    <!--begin::Username-->
                                    <label for="username" class="required form-label text-gray-600">Username</label>
                                    <input type="text" id="username" placeholder="jhon doe" name="username" autocomplete="off"
                                    class="form-control" />
                                    <!--end::Username-->
                                </div>
                                <!--end::Input group=-->
                                <div class="fv-row mt-3 mb-2">
                                    <!--begin::Password-->
                                    <label for="password" class="required form-label  text-gray-600">Password</label>
                                    <input type="password" id="password" placeholder="********" name="password" autocomplete="off"
                                        class="form-control" />
                                    <!--end::Password-->
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Submit button-->
                                <div class="d-grid mt-8">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary bg-primary bg-gradient">
                                        <span class="indicator-label">Log in Account</span>
                                    </button>
                                </div>
                                <!--end::Submit button-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Wrapper-->
                        <div class="separator"></div>
                        {{-- <div class="separator separator-content"><i>guest</i></div>
                        <!--begin::Footer-->
                        <div class="d-grid my-5">
                            <!--begin::Links-->
                            <div class="d-grid fw-semibold text-primary fs-base gap-5">
                                <a href="{{url('audit-trail')}}" class="btn btn-outline btn-outline-dashed btn-outline" style="width: auto;">
                                    <i class="ki-duotone ki-graph-3 fs-1"><span class="path1"></span><span
                                            class="path2"></span></i>
                                    Audit Trail
                                </a>
                            </div>
                        </div>
                        <!--end::Footer--> --}}
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    <script src="{{ asset('assets/js/jquery-3.7.1.js') }}"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Get the values of the input fields
                var username = $('input[name="username"]').val();
                var password = $('input[name="password"]').val();

                // Check if fields are empty
                if (username === '' || password === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Field Required',
                        text: 'Please fill in both username and password.',
                    });
                    return; // Stop the form submission
                }

                // If fields are filled, proceed with AJAX submission
                $.ajax({
                    url: "{{ url('/login-auth') }}",
                    type: "POST",
                    data: 
                        $(this).serialize()
                    ,
                    beforeSend: function() {
                        $('#kt_sign_in_submit').attr('disabled', true);
                        $('#kt_sign_in_submit').html(
                            '<span class="indicator-label">Logging in...</span>'
                        );
                    },
                    success: function(response) {
                        if (response.reminder == true) {
                            let timerInterval;
                            Swal.fire({
                                icon: 'info',
                                title: "Password Reminder!",
                                html: response.message,
                                allowOutsideClick: false, // Tidak bisa ditutup dengan klik luar
                                allowEscapeKey: false, // Tidak bisa ditutup dengan klik esc
                                timer: 5000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                                willClose: () => {
                                    clearInterval(timerInterval);
                                    window.location.href = "{{ route('dashboard') }}";
                                }
                            });
                        } else {
                            let timerInterval;
                        Swal.fire({
                            icon: 'success',
                            title: "Login Successfully!",
                            html: "you will redirect in 3 second....",
                            allowOutsideClick: false, // Tidak bisa ditutup dengan klik luar
                            allowEscapeKey: false, // Tidak bisa ditutup dengan klik esc
                            timer: 3050,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                                window.location.href = "{{ route('dashboard') }}";
                            }
                        });
                        }
                    },
                    error: function(xhr) {
                        // Show alert if login fails
                        if (xhr.status === 401) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Failed',
                                text: xhr.responseJSON.error,
                            });
                        }
                        if (xhr.status === 403) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Account Blocked',
                                text: xhr.responseJSON.error,
                            });
                        }
                        $('#kt_sign_in_submit').attr('disabled', false);
                        $('#kt_sign_in_submit').html(
                            '<span class="indicator-label">Log in Accout</span>'
                        );
                    }
                });
            });
        });
    </script>
    
    @include('layout.alert')
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    {{-- <script src="{{asset('assets/js/custom/authentication/sign-in/general.js')}}"></script> --}}
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
