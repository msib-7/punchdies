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
            <div class="col-12 col-md-4 col-sm-4">
                <!--begin::Card-->
                <div class="card h-md-100 hover-elevate-up shadow-sm parent-hover">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-center">
                        <!--begin::Button-->
                        <button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_add_role">
                            <!--begin::Illustration-->
                            <img src="assets/media/illustrations/sketchy-1/4.png" alt="" class="mw-100 mh-150px mb-7" />
                            <!--end::Illustration-->
                            <!--begin::Label-->
                            <div class="fw-bold fs-3 text-gray-600 text-hover-primary">Add New Role</div>
                            <!--end::Label-->
                        </button>
                        <!--begin::Button-->
                    </div>
                    <!--begin::Card body-->
                </div>
                <!--begin::Card-->
            </div>
            @foreach ($dataRoles as $data)
            <div class="col-12 col-md-4 col-sm-4">
                <!--begin::Card-->
                <div class="card card-flush h-md-100 hover-elevate-up shadow-sm parent-hover">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>{{ $data->role_name }}</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-1">
                        <?php 
                            $role_id = $data->id;
                            $no = 1;
                        ?>
                        <!--begin::Users-->
                        <div class="fw-bold text-gray-600 mb-5">Allowed URL: {{$permissions->where('role_id', $role_id)->count()}}</div>
                        <!--end::Users-->
                        <!--begin::Permissions-->
                        <div class="d-flex flex-column text-gray-600">
                            @foreach ($permissions as $item)
                                @if ($item->role_id == $role_id)
                                    @if ($no <= 5) 
                                    <div class="d-flex align-items-center py-2">
                                        <span class="bullet bg-primary me-3"></span>
                                        {{ $item->url }}
                                    <?php $no++;?>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                            @if ($no>5)
                            <div class="d-flex align-items-center py-2">
                                <span class="bullet bg-primary me-3"></span>
                                <i>{{ ucfirst('Lebih banyak...') }}</i>
                            </div>
                            @endif
                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer flex-wrap pt-0">
                        <div class="row">
                            <div class="col-6 d-flex flex-center">
                                <a href="{{ route('admin.role.view',$data->id) }}" class="btn btn-light btn-active-primary my-1 me-2">
                                    View Role
                                </a>
                            </div>
                            <div class="col-6 d-flex flex-center">
                                <button type="button" class="btn btn-light btn-active-light-primary my-1" id="btn-edit"
                            data-id="{{ $data->id }}">Edit Role</button>
                            </div>
                        </div>
                    </div>
                    <!--end::Card footer-->
                </div>
            <!--end::Card-->
            </div>
            @endforeach
        </div>
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
<!--begin::Modal - Add Role-->
<div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-1000px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add a Role</h2>
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
                <form id="kt_modal_update_role_form" class="form" action="{{ route('admin.role.create') }}" method="POST">
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
                            <input class="form-control form-control-solid" id="roleName" placeholder="Enter a role name"
                                name="role_name" />
                            <!--end::Input-->
                            @error('name')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Permissions-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">Permissions</label>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        @foreach ($routes as $routeName => $route)
                                            @if (str_starts_with($routeName, 'log'))
                                                <div class="col-12 pb-2">
                                                    <div class="form-check">
                                                        <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                                            class="form-check-input" checked id="route_{{ $loop->index }}">
                                                        <label class=""
                                                            for="route_{{ $loop->index }}">{{ $routeName }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        @foreach ($routes as $routeName => $route)
                                            @if (str_starts_with($routeName, 'dashboard'))
                                                <div class="col-12 pb-2">
                                                    <div class="form-check">
                                                        <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                                            class="form-check-input" checked id="route_{{ $loop->index }}">
                                                        <label class=""
                                                            for="route_{{ $loop->index }}">{{ $routeName }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4 mb-3">
                                    <label class="fs-5 fw-semibold" for="checkAll">
                                        Administrator
                                    </label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="checkAll" class="form-check-input">
                                        <label class="fs-5 fw-semibold" for="checkAll">Check All</label>
                                    </div>
                                </div>
                            </div>
                            <!--end::Label-->
                            <div class="row">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="fs-4 fw-bold my-3">User Management</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            @foreach ($routes as $routeName => $route)
                                                @if (str_starts_with($routeName, 'admin.'))
                                                    <div class="col-md-4 col-sm-6 pb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                                                class="form-check-input route-checkbox" id="route_{{ $loop->index }}">
                                                            <label class=""
                                                                for="route_{{ $loop->index }}">{{ $routeName }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-check mt-3">
                                            <input type="checkbox" id="checkPA" class="form-check-input route-checkbox">
                                            <label class="fs-4 fw-bold" for="checkPA">
                                                Pengukuran Awal
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="fs-5 my-2">
                                                    Punch Atas
                                                </label>
                                            </div>
                                            @foreach ($routes as $routeName => $route)
                                                @if (str_starts_with($routeName, 'pnd.pa.atas'))
                                                    <div class="col-md-4 col-sm-6 pb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                                                class="form-check-input route-checkbox route-pa" id="route_{{ $loop->index }}">
                                                            <label class=""
                                                                for="route_{{ $loop->index }}">{{ $routeName }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="fs-5 my-2">
                                                    Punch Bawah
                                                </label>
                                            </div>
                                            @foreach ($routes as $routeName => $route)
                                                @if (str_starts_with($routeName, 'pnd.pa.bawah'))
                                                    <div class="col-md-4 col-sm-6 pb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                                                class="form-check-input route-checkbox route-pa" id="route_{{ $loop->index }}">
                                                            <label class=""
                                                                for="route_{{ $loop->index }}">{{ $routeName }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="fs-5 my-2">
                                                    Dies
                                                </label>
                                            </div>
                                            @foreach ($routes as $routeName => $route)
                                                @if (str_starts_with($routeName, 'pnd.pa.dies'))
                                                    <div class="col-md-4 col-sm-6 pb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                                                class="form-check-input route-checkbox route-pa" id="route_{{ $loop->index }}">
                                                            <label class=""
                                                                for="route_{{ $loop->index }}">{{ $routeName }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-check mt-3">
                                            <input type="checkbox" id="checkPR" class="form-check-input route-checkbox">
                                            <label class="fs-4 fw-bold" for="checkPR">
                                                Pengukuran Rutin
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="fs-5 my-2">
                                                    Punch Atas
                                                </label>
                                            </div>
                                            @foreach ($routes as $routeName => $route)
                                                @if (str_starts_with($routeName, 'pnd.pr.atas'))
                                                    <div class="col-md-4 col-sm-6 pb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                                                class="form-check-input route-checkbox route-pr" id="route_{{ $loop->index }}">
                                                            <label class=""
                                                                for="route_{{ $loop->index }}">{{ $routeName }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="fs-5 my-2">
                                                    Punch Bawah
                                                </label>
                                            </div>
                                            @foreach ($routes as $routeName => $route)
                                                @if (str_starts_with($routeName, 'pnd.pr.bawah'))
                                                    <div class="col-md-4 col-sm-6 pb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                                                class="form-check-input route-checkbox route-pr" id="route_{{ $loop->index }}">
                                                            <label class=""
                                                                for="route_{{ $loop->index }}">{{ $routeName }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="fs-5 my-2">
                                                    Dies
                                                </label>
                                            </div>
                                            @foreach ($routes as $routeName => $route)
                                                @if (str_starts_with($routeName, 'pnd.pr.dies'))
                                                    <div class="col-md-4 col-sm-6 pb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                                                class="form-check-input route-checkbox route-pr" id="route_{{ $loop->index }}">
                                                            <label class=""
                                                                for="route_{{ $loop->index }}">{{ $routeName }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-check mt-3">
                                            <input type="checkbox" id="checkApproval" class="form-check-input route-checkbox">
                                            <label class="fs-4 fw-bold" for="checkApproval">
                                                Approval
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="fs-5 my-2">
                                                    Pengukuran
                                                </label>
                                            </div>
                                            @foreach ($routes as $routeName => $route)
                                                @if (str_starts_with($routeName, 'pnd.approval.pengukuran'))
                                                    <div class="col-md-4 col-sm-6 pb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                                                class="form-check-input route-checkbox route-approval" id="route_{{ $loop->index }}">
                                                            <label class=""
                                                                for="route_{{ $loop->index }}">{{ $routeName }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="fs-5 my-2">
                                                    Disposal
                                                </label>
                                            </div>
                                            @foreach ($routes as $routeName => $route)
                                                @if (str_starts_with($routeName, 'pnd.approval.disposal'))
                                                    <div class="col-md-4 col-sm-6 pb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                                                class="form-check-input route-checkbox route-approval" id="route_{{ $loop->index }}">
                                                            <label class=""
                                                                for="route_{{ $loop->index }}">{{ $routeName }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="fs-5 my-2">
                                                    History
                                                </label>
                                            </div>
                                            @foreach ($routes as $routeName => $route)
                                                @if (str_starts_with($routeName, 'pnd.approval.histori'))
                                                    <div class="col-md-4 col-sm-6 pb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                                                class="form-check-input route-checkbox route-approval" id="route_{{ $loop->index }}">
                                                            <label class=""
                                                                for="route_{{ $loop->index }}">{{ $routeName }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                {{-- @foreach ($routes as $routeName => $route)
                                    <div class="col-md-4 col-sm-6 pb-2">
                                        <div class="form-check">
                                            <input type="checkbox"  name="urls[]" value="{{ $routeName }}"
                                                class="form-check-input" id="route_{{ $loop->index }}">
                                            <label class=""
                                                for="route_{{ $loop->index }}">{{ $routeName }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach --}}
                            </div>
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
<!--end::Modal - Add Role-->
<!--begin::Modal - Edit Role-->
<div class="modal fade" id="kt_modal_edit_role" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
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
                <form id="kt_modal_update_role_form" action="{{route('admin.role.update')}}" method="POST">
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
    $(document).ready(function() {
        $('#checkAll').change(function() {
            $('.route-checkbox').prop('checked', this.checked);
        });
        $('#checkPA').change(function() {
            $('.route-pa').prop('checked', this.checked);
        });
        $('#checkPR').change(function() {
            $('.route-pr').prop('checked', this.checked);
        });
        $('#checkApproval').change(function() {
            $('.route-approval').prop('checked', this.checked);
        });
    });
</script>
<script>
    //button create post event
    $('body').on('click', '#btn-edit', function () {

        let edit_id = $(this).data('id');

        //fetch detail post with ajax
        $.ajax({
            url: "{{route('admin.role.edit', ':id')}}".replace(':id', edit_id),
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
