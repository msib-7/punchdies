<!--begin::Header-->
<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}"
    data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}"
    data-kt-sticky-animation="false">
    <!--begin::Header container-->
    <div class="app-container  container-xxl d-flex align-items-stretch justify-content-between "
        id="kt_app_header_container">
        <!--begin::Logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
            <a href="?page=index">
                <img alt="Logo" src="{{asset('assets/logo/Logo-Kalbe-&-BSB_Original.png')}}"
                    class="h-60px app-sidebar-logo-default theme-light-show" />
                <img alt="Logo" src="{{asset('assets/logo/Logo-Kalbe-&-BSB_Original.png')}}"
                    class="h-60px app-sidebar-logo-default theme-dark-show" style="filter: contrast(0);"/>
            </a>
        </div>
        <!--end::Logo-->
        <!--begin::Header wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            @include('layout.sidebar-mobile')
            <!--begin::Navbar-->
            <div class="app-navbar flex-shrink-0">
                <div class="app-navbar-item ms-1 ms-md-4" id="idle_time_display">
                    <span id="idle_time" class="text-muted">Idle Time: 00:00</span>
                </div>
                <!--begin::Notifications-->
                <div class="app-navbar-item ms-1 ms-md-4">
                    <!--begin::Menu- wrapper-->
                    <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px position-relative pulse pulse-success"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">
                        <i class="ki-outline ki-notification-status fs-2"></i>
                        @if(auth()->user()->notify()->count() > 0)
                            <span
                                class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
                            <span class="pulse-ring"></span>
                        @endif
                    </div>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-500px" data-kt-menu="true"
                        id="kt_menu_notifications">
                        <!--begin::Heading-->
                        <div class="d-flex flex-column bgi-no-repeat rounded-top"
                            style="background-image: url('/assets/media/misc/menu-header-bg.jpg'); background-size: cover; background-position: center;">
                            <!--begin::Title-->
                            <div class="d-flex flex-stack p-5">
                                <div class="d-flex">
                                    <h3 class="text-white fw-semibold px-9 mt-10 mb-6">Notifications
                                        {{-- <span class="fs-8 opacity-75 ps-3">24 reports</span> --}}
                                    </h3>
                                </div>
                            </div>
                            <!--end::Title-->
                            <!--begin::Tabs-->
                            <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9">
                                <li class="nav-item">
                                    <a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab"
                                        href="#kt_topbar_notifications_3"></a>
                                </li>
                            </ul>
                            <!--end::Tabs-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab panel-->
                            <div class="tab-pane fade show active" id="kt_topbar_notifications_3" role="tabpanel">
                                <!--begin::Items-->
                                <div class="scroll-y mh-325px my-5 px-8">
                                    @forelse (auth()->user()->notify() as $notif)
                                                                        @php
    // Cek apakah notifikasi dari hari ini
    $isToday = Carbon\Carbon::parse($notif->created_at)->isToday();
    // Format waktu relative seperti "2 min ago"
    $relativeTime = Carbon\Carbon::parse($notif->created_at)->diffForHumans();
                                                                        @endphp

                                                                        <!--begin::Item-->
                                                                        <div class="d-flex flex-stack">
                                                                            <!--begin::Section-->
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="card mb-2">
                                                                                    <div class="card-body">
                                                                                        <!--begin::Label-->
                                                                                        <span
                                                                                            class="badge {{ $isToday ? 'badge-success' : 'badge-warning' }} fs-8 float-end">{{ $isToday ? 'Today' : 'Kemarin' }}</span>
                                                                                        <!--end::Label-->
                                                                                        <span class="text-sm text-muted">{{ $relativeTime }}</span>
                                                                                        <h5 class="text-body mb-2 mt-2">{{ $notif->title }}</h5>
                                                                                        <p class="mb-0">{{ $notif->message }}</p>
                                                                                        <p class="mb-0">
                                                                                            @if($notif->url)
                                                                                                <a href="{{ $notif->url }}">
                                                                                                    <button class="btn btn-secondary btn-sm float-end">direct</button>
                                                                                                </a>
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--end::Section-->
                                                                        </div>
                                                                        <!--end::Item-->
                                    @empty
                                        <div class="d-flex flex-stack">
                                            <div class="d-flex align-items-center w-100 justify-content-center">
                                                <h6 class="text-body mb-2 mt-2 text-gray-600">Tidak Ada Notifikasi</h6>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                                <!--end::Items-->
                                <!--begin::View more-->
                                <div class="py-1 text-center border-top">
                                    <button class="btn btn-color-gray-600 btn-active-color-danger w-100" onclick="clearNotif()">
                                        Clear all notification
                                    </button>
                                </div>
                                <!--end::View more-->
                            </div>
                            <!--end::Tab panel-->
                        </div>
                        <!--end::Tab content-->
                    </div>
                    <!--end::Menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Notifications-->
            
                <!--begin::User menu-->
                <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                    <div class="d-flex flex-column px-2 align-items-end">
                        <div class="d-flex fs-6">
                            {{auth()->user()->nama}}
                        </div>
                        <div class="d-flex fs-8 fw-semibold">
                            ({{auth()->user()->lines->nama_line}})
                        </div>
                    </div>
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <img src="/assets/media/avatars/blank.png" class="rounded-3" alt="user" />
                    </div>
                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="/assets/media/avatars/blank.png" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">
                                        {{auth()->user()->nama}}
                                        <div class="d-flex">
                                            <small
                                                class="badge badge-light-success fw-bold fs-10 px-2 py-1 ms-2">{{ auth()->user()->roles->role_name }}</small>
                                        </div>
                                    </div>
                                    <small class="fw-semibold text-muted fs-9">{{session('email_user')}}</small>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
            
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                            <a href="#" class="menu-link px-5">
                                <span class="menu-title position-relative">Mode
                                    <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                        <i class="ki-duotone ki-night-day theme-light-show fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                            <span class="path7"></span>
                                            <span class="path8"></span>
                                            <span class="path9"></span>
                                            <span class="path10"></span>
                                        </i>
                                        <i class="ki-duotone ki-moon theme-dark-show fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                data-kt-menu="true" data-kt-element="theme-mode-menu">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-duotone ki-night-day fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                <span class="path6"></span>
                                                <span class="path7"></span>
                                                <span class="path8"></span>
                                                <span class="path9"></span>
                                                <span class="path10"></span>
                                            </i>
                                        </span>
                                        <span class="menu-title">Light</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-duotone ki-moon fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <span class="menu-title">Dark</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-duotone ki-screen fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </span>
                                        <span class="menu-title">System</span>
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Menu item-->
            
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <button onclick="changePassword()" class="btn menu-link w-100 px-5">
                                <span class="menu-title position-relative">Change Password
                                    <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                        <i class="ki-duotone ki-arrows-loop fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                </span>
                            </button>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="{{route('logout')}}" class="menu-link px-5">Sign Out</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
            
                <!--begin::Header menu toggle-->
                {{-- <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
                    <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_header_menu_toggle">
                        <i class="ki-outline ki-element-4 fs-1"></i>
                    </div>
                </div> --}}
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

<script>
    function changePassword() {
        Swal.fire({
            icon: 'question',
            title: 'Are You Sure?',
            text: 'This action will change your current password.',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Set New Password",
                    input: "text",
                    inputAttributes: {
                        autocapitalize: "off"
                    },
                    showCancelButton: true,
                    confirmButtonText: "Update password",
                    allowOutsideClick: false,

                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '{{ url("user/update-password") }}', // Update this route
                            data: {
                                id: '{{ auth()->user()->id }}',
                                new_password: result.value,
                                _token: '{{ csrf_token() }}' // Include CSRF token
                            },
                            cache: false,
                            beforeSend: function () {
                                Swal.fire({
                                    title: 'Processing...',
                                    text: 'Please wait while we process your request.',
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    willOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                            },
                            success: function (response) {
                                if (response.success == false) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Something went wrong!',
                                        text: response.message + ' ' + response.by
                                    });
                                } else {
                                    let timerInterval;
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Successful',
                                        text: response.message + ' ' + response.by,
                                        allowOutsideClick: false,
                                        showConfirmButton: false,
                                        timer: 2000,
                                        timerProgressBar: true,
                                        willOpen: () => {
                                            Swal.showLoading();
                                        },
                                        willClose: () => {
                                            clearInterval(timerInterval);
                                        }
                                    });
                                }
                            },
                        });
                    }
                });
            }
        });
    }

    function clearNotif() {
        $.ajax({
            type: 'POST',
            url: '{{ url("user/clear-notifications") }}', // Update this route
            data: {
                _token: '{{ csrf_token() }}' // Include CSRF token
            },
            cache: false,
            beforeSend: function () {
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait while we process your request.',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function (response) {
                if (response.success == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Notifications Cleared',
                        text: response.message,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong!',
                        text: response.message
                    });
                }
            },
        });
    }
</script>