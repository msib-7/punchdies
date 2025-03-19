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
        <a href="{{ route('login') }}"
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
            class="menu-item menu-lg-down-accordion me-0 me-lg-2">
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
            class="menu-item menu-lg-down-accordion me-0 me-lg-2">
            <!--begin:Menu link-->
            <span class="menu-link">
                <span class="menu-title">Approval Menu</span>
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
                                    <h4 class="fs-6 fs-lg-4 text-gray-800 fw-bold mt-3 mb-3 ms-4">Pengkuran Awal</h4>
                                    <!--end:Heading-->
                                    <!--begin:Menu item-->
                                    <div class="menu-item p-0 m-0">
                                        <!--begin:Menu link-->
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
                                        <a href="#" class="menu-link">
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
    </div>
    <!--end::Menu-->
</div>
<!--end::Menu wrapper-->