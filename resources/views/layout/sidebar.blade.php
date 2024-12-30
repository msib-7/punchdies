<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6 pt-10" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a>
            <img alt="Logo" src="{{asset('assets/logo/Logo-Kalbe-&-BSB_Original.png')}}"
                class="w-100 app-sidebar-logo-default theme-light-show" />
            <img alt="Logo" src="{{asset('assets/logo/Logo-Kalbe-&-BSB_Original.png')}}"
                class="w-100 app-sidebar-logo-default theme-dark-show" style="filter: contrast(0);" />
            <img alt="Logo" src="{{asset('assets/logo/logo_only.png')}}" class="h-50px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->

        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate <?php if(Request::segment(4) == 'form_pengukuran'){echo 'active';}?>"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">

                    <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    {{-- Dashboard --}}
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-element-11 fs-2"></i>
                            </span>
                            <span class="menu-title text-gray-600">Dashboard</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class=" fw-bold text-uppercase fs-8 text-gray-800">Form Pengukuran</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    @foreach (auth()->user()->permissions as $item)
                        {{-- {{ $item->url }} --}}
                        @if (str_starts_with($item->url, 'pnd.pa.atas.index') || str_starts_with($item->url, 'pnd.pa.bawah.index') || str_starts_with($item->url, 'pnd.pa.dies.index'))
                            {{-- Data Pengukuran Awal--}}
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is('pnd/pengukuran-awal*') ? 'here show' : '' }}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-add-files fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title text-gray-600">Data Pengukuran Awal</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is('pnd/pengukuran-awal/punch*') ? 'here show' : '' }}">
                                        <!--begin:Menu link-->
                                        <span class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">Punch</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <!--end:Menu link-->
                                        <!--begin:Menu sub-->
                                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                                            <!--begin:Menu item-->
                                            <div class="menu-item">
                                                <!--begin:Menu link-->
                                                <a class="menu-link {{ request()->is('pnd/pengukuran-awal/punch-atas*') ? 'active' : '' }}" href="{{route('pnd.pa.atas.index')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title text-gray-600">Punch Atas</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item">
                                                <!--begin:Menu link-->
                                                <a class="menu-link {{ request()->is('pnd/pengukuran-awal/punch-bawah*') ? 'active' : '' }}" href="{{route('pnd.pa.bawah.index')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title text-gray-600">Punch Bawah</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                        </div>
                                        <!--end:Menu sub-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('pnd/pengukuran-awal/dies*') ? 'active' : '' }}" href="{{route('pnd.pa.dies.index')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">Dies</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            @break
                        @endif
                    @endforeach

                    @foreach (auth()->user()->permissions as $item)
                        {{-- {{ $item->url }} --}}
                        @if (str_starts_with($item->url, 'pnd.pr.atas.index') || str_starts_with($item->url, 'pnd.pr.bawah.index') || str_starts_with($item->url, 'pnd.pr.dies.index'))
                            {{-- Data Pengukuran Rutin--}}
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is('pnd/pengukuran-rutin*') ? 'here show' : '' }}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-update-file fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title text-gray-600">Data Pengukuran Rutin</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is('pnd/pengukuran-rutin/punch*') ? 'here show' : '' }}">
                                        <!--begin:Menu link-->
                                        <span class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">Punch</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <!--end:Menu link-->
                                        <!--begin:Menu sub-->
                                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                                            <!--begin:Menu item-->
                                            <div class="menu-item">
                                                <!--begin:Menu link-->
                                                <a class="menu-link  {{ request()->is('pnd/pengukuran-rutin/punch-atas*') ? 'active' : '' }}" href="{{route('pnd.pr.atas.index')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title text-gray-600">Punch Atas</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                            <!--begin:Menu item-->
                                            <div class="menu-item">
                                                <!--begin:Menu link-->
                                                <a class="menu-link  {{ request()->is('pnd/pengukuran-rutin/punch-bawah*') ? 'active' : '' }}" href="{{route('pnd.pr.bawah.index')}}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title text-gray-600">Punch Bawah</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                        </div>
                                        <!--end:Menu sub-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link  {{ request()->is('pnd/pengukuran-rutin/dies*') ? 'active' : '' }}" href="{{route('pnd.pr.dies.index')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">Dies</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            @break
                        @endif
                    @endforeach

                    <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="text-gray-800 fw-bold text-uppercase fs-8">Approval Menu</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    @foreach (auth()->user()->permissions as $item)
                        {{-- {{ $item->url }} --}}
                        @if (str_starts_with($item->url, 'pnd.approval'))
                            {{-- Waiting List Approval --}}
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is('pnd/approval*') ? 'here show' : '' }}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-information-3 fs-2"></i>
                                    </span>
                                    <span class="menu-title text-gray-600">Waiting List</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('pnd/approval/pengukuran-awal*') ? 'active' : '' }}" href="{{route('pnd.approval.pa.index')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">Approval Pengukuran Awal</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('pnd/approval/pengukuran-rutin*') ? 'active' : '' }}" href="{{route('pnd.approval.pr.index')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">Approval Pengukuran Rutin</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('pnd/approval/disposal*') ? 'active' : '' }}" href="{{route('pnd.approval.dis.index')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">Approval Disposal</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->

                            {{-- Approval History --}}
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{route('pnd.approval.histori.index')}}">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-archive fs-2"></i>
                                    </span>
                                    <span class="menu-title text-gray-600">History</span>
                                </a>
                                <!--end:Menu link-->
                            </div>

                            {{-- Disposal Menu --}}
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ request()->is('pnd/request/disposal*') ? 'active' : '' }}" href="{{route('pnd.request.disposal.index')}}">
                                {{-- <a class="menu-link" href="#"> --}}
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-disconnect fs-2"></i>
                                    </span>
                                    <span class="menu-title text-gray-600">Request Disposal</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            @break
                        @endif
                    @endforeach

                    <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="text-gray-800 fw-bold text-uppercase fs-8">Admin Tools</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    @foreach (auth()->user()->permissions as $item)
                        @if (str_starts_with($item->url, 'admin.'))
                            {{-- Master Machine --}}
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is('Admin*') ? 'here show' : '' }}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-more-2 fs-2"></i>
                                    </span>
                                    <span class="menu-title text-gray-600">Systems</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('Admin/mesin*') ? 'active' : '' }}" href="{{route('admin.mesin.index')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">Master Mesin</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('Admin/nama-produk*') ? 'active' : '' }}" href="{{route('admin.namaProduk.index')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">Master Nama Produk</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('Admin/kode-produk*') ? 'active' : '' }}" href="{{route('admin.kodeProduk.index')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">Master Kode Produk</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->

                            {{-- Manajemen User --}}
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is('Admin*') ? 'here show' : '' }}">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-user fs-2"></i>
                                    </span>
                                    <span class="menu-title text-gray-600">User Management</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('Admin/users*') ? 'active' : '' }}" href="{{route('admin.users.index')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">User</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('Admin/line*') ? 'active' : '' }}" href="{{route('admin.line.index')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">Line</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('Admin/role*') ? 'active' : '' }}" href="{{route('admin.role.index')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">Role</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ request()->is('Admin/permission*') ? 'active' : '' }}" href="{{route('admin.permission.index')}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title text-gray-600">Permission</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            @break
                        @endif
                    @endforeach
                    
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="{{ route('audit') }}" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="200+ in-house components and 3rd-party plugins">
            <span class="btn-label">Audit Trial</span>
            <i class="ki-duotone ki-document btn-icon fs-2 m-0">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </a>
    </div>
    <!--end::Footer-->
</div>
