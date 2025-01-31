<div id="kt_app_footer" class="app-footer">
    <!--begin::Footer container-->
    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-semibold me-1">2024&copy;</span>
            <a href="" target="_blank" class="text-gray-800 text-hover-primary">Plant Technical Support</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
            <li class="menu-item">
                @php
                    $isDevUrl = request()->is('dev*');
                @endphp
                <button onclick="devMenu('{{auth()->user()->id}}')" class="btn {{ $isDevUrl ? 'btn-dark' : 'btn-secondary' }} btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Developer Menu">
                    <i class="ki-solid ki-setting-2 fs-3 m-0 p-0"></i>
                </button>
                <a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">
                    
                </a>
            </li>
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Footer container-->
</div>
