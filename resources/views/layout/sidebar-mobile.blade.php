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
        <!--begin:Menu item-->
        <a href="{{ route('dashboard') }}"
        class="menu-item menu-lg-down-accordion me-0 me-lg-2 {{ request()->is('dashboard') ? 'here show menu-here-bg' : '' }} ">
        <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-title">Dashboards</span>
                <span class="menu-arrow d-lg-none"></span>
            </span>
            <!--end:Menu link-->
        </a>
        <!--end:Menu item-->
        <!--begin:Menu item-->
        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
            class="menu-item menu-lg-down-accordion me-0 me-lg-2 {{ request()->is('pnd/pengukuran-awal*') || request()->is('pnd/pengukuran-rutin*') ? 'here show menu-here-bg' : '' }}">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-title">Form Pengukuran</span>
                <span class="menu-arrow d-lg-none"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-500px">
                <!--begin:Dashboards menu-->
                <div class="menu-active-bg pt-1 pb-3 px-3 py-lg-6 px-lg-6" data-kt-menu-dismiss="true">
                    <!--begin:Row-->
                    <div class="row">
                        <!--begin:Col-->
                        <div class="col-12">
                            <!--begin:Row-->
                            <div class="row">
                                <!--begin:Col-->
                                <div class="col-lg-6 mb-3">
                                    <!--begin:Heading-->
                                    <h4 class="fs-6 fs-lg-4 text-gray-800 fw-bold mt-3 mb-3 ms-4">Pengkuran Awal</h4>
                                    <!--end:Heading-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="{{route('pnd.pa.atas.index')}}" class="menu-link {{ request()->is('pnd/pengukuran-awal/punch-atas*') ? 'active' : '' }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">Punch Atas</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="{{route('pnd.pa.bawah.index')}}" class="menu-link {{ request()->is('pnd/pengukuran-awal/punch-bawah*') ? 'active' : '' }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">Punch Bawah</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="{{route('pnd.pa.dies.index')}}" class="menu-link {{ request()->is('pnd/pengukuran-awal/dies*') ? 'active' : '' }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">Dies</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Col-->
                                <!--begin:Col-->
                                <div class="col-lg-6 mb-3">
                                    <!--begin:Heading-->
                                    <h4 class="fs-6 fs-lg-4 text-gray-800 fw-bold mt-3 mb-3 ms-4">Pengukuran Rutin</h4>
                                    <!--end:Heading-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="{{route('pnd.pr.atas.index')}}" class="menu-link {{ request()->is('pnd/pengukuran-rutin/punch-atas*') ? 'active' : '' }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">Punch Atas</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="{{route('pnd.pr.bawah.index')}}" class="menu-link {{ request()->is('pnd/pengukuran-rutin/punch-bawah*') ? 'active' : '' }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">Punch Bawah</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="{{route('pnd.pr.dies.index')}}" class="menu-link {{ request()->is('pnd/pengukuran-rutin/dies*') ? 'active' : '' }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">Dies</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Col-->
                            </div>
                        </div>
                        <!--end:Col-->
                    </div>
                    <!--end:Row-->
                </div>
                <!--end:Dashboards menu-->
            </div>
            <!--end:Menu sub-->
        </div>
        <!--end:Menu item-->
        <!--begin:Menu item-->
        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
            class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2 {{ request()->is('pnd/approval*') || request()->is('pnd/request/dis*') ? 'here show menu-here-bg' : '' }}">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-title">Approval Menu</span>
                <span class="menu-arrow d-lg-none"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                    class="menu-item menu-lg-down-accordion {{ request()->is('pnd/approval*') ? 'here' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <b><span class="menu-title">Waiting List</span></b>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-active-bg px-lg-2 py-lg-4 w-lg-225px {{ request()->is('pnd/approval*') ? 'show' : '' }}">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ request()->is('pnd/approval/pengukuran-awal*') ? 'active' : '' }}" href="{{route('pnd.approval.pa.index')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Approval Pengukuran Awal</span>
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
                                <span class="menu-title">Approval Pengukuran Rutin</span>
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
                                <span class="menu-title">Approval Disposal</span>
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
                    <a class="menu-link {{ request()->is('pnd/approval/histori*') ? 'active' : '' }}" href="{{route('pnd.approval.histori.index')}}">
                        <b><span class="menu-title">History</span></b>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->is('pnd/request/disposal*') ? 'active' : '' }}" href="{{route('pnd.request.disposal.index')}}">
                        <b><span class="menu-title">Request Disposal</span></b>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
            </div>
            <!--end:Menu sub-->
        </div>
        <!--end:Menu item-->
        <!--begin:Menu item-->
        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
            class="menu-item menu-lg-down-accordion me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-title">Admin Tools</span>
                <span class="menu-arrow d-lg-none"></span>
            </span>
            <!--end:Menu link-->
            <!--begin:Menu sub-->
            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-500px">
                <!--begin:Dashboards menu-->
                <div class="menu-active-bg pt-1 pb-3 px-3 py-lg-6 px-lg-6" data-kt-menu-dismiss="true">
                    <!--begin:Row-->
                    <div class="row">
                        <!--begin:Col-->
                        <div class="col-12">
                            <!--begin:Row-->
                            <div class="row">
                                <!--begin:Col-->
                                <div class="col-lg-6 mb-3">
                                    <!--begin:Heading-->
                                    <h4 class="fs-6 fs-lg-4 text-gray-800 fw-bold mt-3 mb-3 ms-4">System</h4>
                                    <!--end:Heading-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="#" class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">Master Mesin</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="#" class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">Master Nama Produk</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="#" class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">Master Kode Produk</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="#" class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">Master Tools Kalibrasi</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Col-->
                                <!--begin:Col-->
                                <div class="col-lg-6 mb-3">
                                    <!--begin:Heading-->
                                    <h4 class="fs-6 fs-lg-4 text-gray-800 fw-bold mt-3 mb-3 ms-4">User Management</h4>
                                    <!--end:Heading-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="#" class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">User</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="#" class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">Line</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="#" class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">Role</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="#" class="menu-link">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot bg-gray-300i h-6px w-6px"></span>
                                            </span>
                                            <span class="menu-title">Permissions</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Col-->
                            </div>
                        </div>
                        <!--end:Col-->
                    </div>
                    <!--end:Row-->
                </div>
                <!--end:Dashboards menu-->
            </div>
            <!--end:Menu sub-->
        </div>
        <!--end:Menu item-->
    </div>
    <!--end::Menu-->
</div>
<!--end::Menu wrapper-->