@extends('layout.metronic')
@section('main-content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Dashboard
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            {{-- begin Shortcut Menu --}}
            {{-- <div class="row mb-3">
                <h3 class="page-heading">
                    Menu
                </h3>
                @include('partials.dashboard_shortcut')
            </div> --}}
            {{-- end shortcut menu --}}
            <div class="separator my-10"></div>
            <!--begin::Filter Form-->
            <div class="row mb-3">
                <div class="col-md-4">
                    <form id="lineFilterForm">
                        <select id="lineFilter" name="line_id" class="form-select shadow-sm">
                            <option value="">All Line</option>
                            @foreach($lines as $line)
                                <option value="{{ $line->id }}" {{ request('line_id') == $line->id ? 'selected' : '' }}>{{ $line->nama_line }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            <!--end::Filter Form-->
            <!--begin::Row-->
            <div class="row" id="dashboardContent">
                <!-- Content will be loaded here via AJAX -->
                @include('partials.dashboard_content', ['dataPunchAtas' => $dataPunchAtas, 'dataPunchBawah' => $dataPunchBawah, 'dataDies' => $dataDies])
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('#lineFilter').change(function() {
                var lineId = $(this).val();
                $.ajax({
                    url: '{{ route('dashboard') }}', // Adjust this route if necessary
                    type: 'GET',
                    data: { line_id: lineId },
                    success: function(response) {
                        $('#dashboardContent').html(response);
                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                });
            });
        });
    </script>
@endsection