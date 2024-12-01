@extends('layout.metronic')
@section('main-content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Roles List
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
                <li class="breadcrumb-item text-muted">Roles</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Detail</li>
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
        <div class="row">
            <div class="col-4 col-md-4 col-sm-5">
                <!--begin::Card-->
                <div class="card card-flush h-md-100 hover-elevate-up shadow-sm parent-hover">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>{{ $roles->role_name }}</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-1">
                        <!--begin::Users-->
                        <div class="fw-bold text-gray-600 mb-5">Total users with this role: {{count($users)}}</div>
                        <div class="fw-bold text-gray-600 mb-5">Allowed url: {{count($permissions)}}</div>
                        <!--end::Users-->
                        <!--begin::Permissions-->
                        <div class="d-flex flex-column text-gray-600">
                            @foreach ($permissions as $item)
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>
                                    {{ $item->url }}
                                </div>
                            @endforeach
                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer flex-wrap pt-0">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-light btn-active-light-primary my-1" id="btn-edit"
                                    data-id="{{ $roles->id }}">Edit Role</button>
                            </div>
                            <div class="col-6" style="text-align: right;">
                                <a href='{{ url("delete-role/".$roles->id) }}'
                                    class="btn btn-light btn-active-light-danger my-1">
                                    <i class="ki-solid ki-trash fs-3"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                    <!--end::Card footer-->
                </div>
                <!--end::Card-->
            </div>
            <div class="col-8 col-md-8 col-sm-7">
                <!--begin::Card-->
                <div class="card shadow-sm">
                    <!--begin::Card body-->
                    <div class="card-body">
                        <table id="table_user_role" class="table align-middle table-row-dashed " style="width:100%">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-center w-100px">No</th>
                                    <th class="min-w-130px">Username</th>
                                    <th class="min-w-100px">Created at</th>
                                    <th class="w-50px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1?>
                                @if($users->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No users found for this role.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @else
                                    @foreach ($users as $data)
                                    <tr>
                                        <td class="text-center">{{$no++}}</td>
                                        <td>{{$data->username}}</td>
                                        <td>{{$data->created_at}}</td>
                                        <td class="text-center">
                                            <a href="#"
                                                class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../demo1/dist/apps/user-management/users/view.html"
                                                        class="menu-link px-3">Edit</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3"
                                                        data-kt-users-table-filter="delete_row">Delete</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!--begin::Card body-->
                </div>
                <!--begin::Card-->
            </div>
        </div>
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

<!--begin::Modal - Edit Role-->
<div class="modal fade" id="kt_modal_edit_role" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-1000px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Update Role</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_update_role_form" action="{{url('update-role')}}" method="POST">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header"
                        data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">
                                <span class="required">Role name</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="hidden" name="id_permission" id="id_permissions" />
                            <input class="form-control form-control-solid" placeholder="Enter a role name"
                                name="role_name_edit" id="edit-role-name" />
                            <!--end::Input-->
                            @error('name')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Permissions-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
                            <!--end::Label-->
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600 fw-semibold">
                                        <!--begin::Table row-->
                                        <tr>
                                            <td class="text-gray-800">Administrator Access
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Allows a full access to the system">
                                                </span>
                                            </td>
                                            <td>
                                                <!--begin::Checkbox-->
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="kt_roles_select_all" wire:model.defer="check_all"
                                                        wire:change="checkAll" />
                                                    <span class="form-check-label" for="kt_roles_select_all">Select
                                                        all</span>
                                                </label>
                                                <!--end::Checkbox-->
                                            </td>
                                        </tr>
                                        <!--end::Table row-->
                                        {{-- @foreach($permissions_by_group as $group => $permissions)
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Label-->
                                            <td class="text-gray-800">{{ ucwords($group) }}</td>
                                            <!--end::Label-->
                                            <!--begin::Input group-->
                                            @foreach($permissions as $permission)
                                            <td>
                                                <!--begin::Wrapper-->
                                                <div class="d-flex">
                                                    <!--begin::Checkbox-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="permission_value[]" value="{{ $permission->id }}" />
                                                        <span
                                                            class="form-check-label">{{ ucwords(Str::before($permission->name, ' ')) }}</span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </td>
                                            @endforeach
                                            <!--end::Input group-->
                                        </tr>
                                        <!--end::Table row-->
                                        @endforeach --}}
                                        <!--begin::Table row-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close"
                            wire:loading.attr="disabled">Discard</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label" wire:loading.remove>Submit</span>
                            <span class="indicator-progress" wire:loading wire:target="submit">
                                Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
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
<!--end::Modal - Edit Role-->

<script>
    //button create post event
    $('body').on('click', '#btn-edit', function () {

        let edit_id = $(this).data('id');

        //fetch detail post with ajax
        $.ajax({
            url: `/edit-role/${edit_id}`,
            type: "GET",
            cache: false,
            success: function (response) {

                //fill data to form
                $('#id_role').val(response.data.id);
                $('#edit-role-name').val(response.data.role_name);
                //open modal
                $('#kt_modal_edit_role').modal('show');
            }
        });
    });

</script>
@endsection
