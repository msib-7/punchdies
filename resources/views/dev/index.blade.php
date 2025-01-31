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
                Developer Menu</h1>
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
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card card-flush">
            <div class="card-header">
                <h3 class="card-title">Developers Email</h3>
            </div>
            <div class="card-body">
                @include('dev.settings.mail.index')
            </div>
        </div>
        <hr>
        <form action="{{ route('dev.store') }}" method="POST">
            @csrf
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title">Form Settings</h3>
                </div>
                <div class="card-body">
                    @include('dev.settings.form.index')
                </div>
            </div>
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title">Apps Settings</h3>
                </div>
                <div class="card-body">
                    @include('dev.settings.apps.index')
                </div>
            </div>
            <div class="card card-flush">
                <div class="card-footer ">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection