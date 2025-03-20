<base href="../" />
<title>Punch n Dies</title>
<meta charset="utf-8" />
{{-- <meta name="viewport" content="width=device-width, initial-scale=1" /> --}}
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ asset('assets/logo/logo_only.png') }}" />
<!--begin::Fonts(mandatory for all pages)-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Vendor Stylesheets(used for this page only)-->
<link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />


<link href="{{asset('assets/DataTables/datatables.min.css')}}" rel="stylesheet">
<script src="{{asset('assets/DataTables/datatables.min.js')}}"></script>
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