@extends('layout.metronic')
@section('main-content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Permission
                List
            </h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">User Management</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Permission</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
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
        <div class="card">
            <div class="card-body fs-6">
                <div class="row">
                    @foreach ($routes as $routeName => $route)
                        <div class="col-md-3 col-sm-6 pb-2">
                            <div class="form-check">
                                <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                    class="form-check-input" id="route_{{ $loop->index }}">
                                <label class=""
                                    for="route_{{ $loop->index }}">{{ $routeName }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <table id="table_user" class="table align-middle table-row-dashed fs-6 gy-5" style="width:100%">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="text-center w-100px">No</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1?>
                        @foreach ($dataPermission as $data)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="d-flex align-items-center">
                                <!--begin::User details-->
                                <div class="d-flex flex-center">
                                    <a href=""
                                        class="text-gray-800 text-hover-primary mb-1">{{ $data->url}}</a>
                                </div>
                                <!--begin::User details-->
                            </td>
                        @endforeach
                    </tbody>
                </table> --}}
                <div class="col-12 form-check-label fs-5 mt-10">
                    <i>*pa = Pengukuran Awal, *pr = Pengukuran Rutin</i>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

{{-- <!--begin::Modal - Add Permission-->
<div class="modal fade" id="kt_modal_add_permission" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered modal-dialog-sm">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add a Permission</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5">
                <!--begin::Form-->
                <form id="kt_modal_add_permission_form" class="form" action="{{route('admin.permission.create')}}">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_permission_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_permission_header"
                        data-kt-scroll-wrappers="#kt_modal_add_permission_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Permission Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="permission_name"
                                class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Enter a permission name" value="" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3"
                            data-kt-users-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add Permission-->

<!--begin::Modal - Edit Permission-->
<div class="modal fade" id="kt_modal_edit_permission" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered modal-dialog-sm">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit a Permission</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5">
                <form class="form" action="{{route('admin.permission.update')}}" method="POST">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_permission_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_permission_header"
                        data-kt-scroll-wrappers="#kt_modal_add_permission_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Permission Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="hidden" name="id_permission" id="id_permissions" />
                            <input type="text" name="permission_name_edit"
                                class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Enter a permission name" id="edit-name-permission" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3"
                            data-kt-users-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-warning" id="btn-update">
                            <span class="indicator-label">Update</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Edit Permission--> --}}

{{-- <script>
    //button create post event
    $('body').on('click', '#btn-edit', function () {

        let edit_id = $(this).data('id');

        //fetch detail post with ajax
        $.ajax({
            url: "{{route('admin.permission.edit', ':id')}}".replace(':id', edit_id),
            type: "GET",
            cache: false,
            success: function (response) {

                //fill data to form
                $('#id_permissions').val(response.data.id);
                $('#edit-name-permission').val(response.data.name);
                //open modal
                $('#kt_modal_edit_permission').modal('show');
            }
        });
    });

</script> --}}
@endsection
