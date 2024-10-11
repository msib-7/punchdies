@extends('layout.metronic')
@section('main-content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Users List
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
                <li class="breadcrumb-item text-muted">Users</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Primary button-->
            <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                data-bs-target="#kt_modal_add_user">Create User</a>
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card card-flush">
            <!--begin::Card header-->
            {{-- <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-user-table-filter="search"
                            class="form-control form-control-solid w-250px ps-13" placeholder="Search user" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Filter-->
                        <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Filter</button>
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bold">Filter Options</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Separator-->
                            <!--begin::Content-->
                            <div class="px-7 py-5" data-kt-user-table-filter="form">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-semibold">Role:</label>
                                    <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                        data-placeholder="Select option" data-allow-clear="true"
                                        data-kt-user-table-filter="role" data-hide-search="true">
                                        <option></option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Analyst">Analyst</option>
                                        <option value="Developer">Developer</option>
                                        <option value="Support">Support</option>
                                        <option value="Trial">Trial</option>
                                    </select>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-semibold">Two Step Verification:</label>
                                    <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                        data-placeholder="Select option" data-allow-clear="true"
                                        data-kt-user-table-filter="two-step" data-hide-search="true">
                                        <option></option>
                                        <option value="Enabled">Enabled</option>
                                    </select>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset"
                                        class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                                    <button type="submit" class="btn btn-primary fw-semibold px-6"
                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Menu 1-->
                        <!--end::Filter-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none"
                        data-kt-user-table-toolbar="selected">
                        <div class="fw-bold me-5">
                            <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                        <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete
                            Selected</button>
                    </div>
                    <!--end::Group actions-->
                </div>
                <!--end::Card toolbar-->
            </div> --}}
            <!--end::Card header-->
            <div class="card-body">
                <table id="table_user" class="table align-middle table-row-dashed fs-6 gy-5" style="width:100%">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="text-center w-100px">No</th>
                            <th class="min-w-130px">User</th>
                            <th class="min-w-130px">Role</th>
                            <th class="min-w-100px">Last login</th>
                            <th class="w-50px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="d-flex align-items-center">
                                <!--begin::User details-->
                                <div class="d-flex flex-column">
                                    <a href="../../demo1/dist/apps/user-management/users/view.html"
                                        class="text-gray-800 text-hover-primary mb-1">Emma Smith</a>
                                    <span>smith@kpmg.com</span>
                                </div>
                                <!--begin::User details-->
                            </td>
                            <td>Administrator</td>
                            <td>
                                <div class="badge badge-light fw-bold">Yesterday</div>
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered modal-dialog-sm">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add User</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5">
                <!--begin::Form-->
                <form id="kt_modal_add_user_form" class="form" action="{{route('add-user')}}">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Username</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="username" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Username" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold fs-6 mb-2 required">
                                    New Password
                                </label>
                                <!--end::Label-->

                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-solid" type="password"
                                        placeholder="********" name="password" autocomplete="off" />

                                    <span
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
                                        <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span></i>
                                        <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span></i>
                                    </span>
                                </div>
                                <!--end::Input wrapper-->

                                <!--begin::Meter-->
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                                <!--end::Meter-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Hint-->
                            <div class="text-muted">
                                Use 8 or more characters with a mix of letters, numbers & symbols.
                            </div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group--->
                        {{-- <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <div class="row">
                                <div class="col-6">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">
                                        Password
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-6 text-end">
                                    <a href="" class="text-right" data-bs-toggle="tooltip"
                                        data-bs-custom-class="tooltip-inverse" data-bs-placement="top"
                                        title="Kalbefarma1">
                                        <small><i>default</i></small>
                                    </a>
                                </div>
                            </div>
                            <!--begin::Input-->
                            <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="********" value="Kalbefarma1" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group--> --}}
                        <!--begin::Input group-->
                        <div class="mb-5">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">Role</label>
                            <!--end::Label-->
                            <!--begin::Roles-->
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="user_role" type="radio" value="0"
                                        id="kt_modal_update_role_option_0" checked='checked' />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_0">
                                        <div class="fw-bold text-gray-800">Administrator</div>
                                        <div class="text-gray-600">Best for business owners and company administrators
                                        </div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class='separator separator-dashed my-5'></div>
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="user_role" type="radio" value="1"
                                        id="kt_modal_update_role_option_1" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_1">
                                        <div class="fw-bold text-gray-800">Developer</div>
                                        <div class="text-gray-600">Best for developers or people primarily using the API
                                        </div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class='separator separator-dashed my-5'></div>
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="user_role" type="radio" value="2"
                                        id="kt_modal_update_role_option_2" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_2">
                                        <div class="fw-bold text-gray-800">Analyst</div>
                                        <div class="text-gray-600">Best for people who need full access to analytics
                                            data, but don't need to update business settings</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class='separator separator-dashed my-5'></div>
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="user_role" type="radio" value="3"
                                        id="kt_modal_update_role_option_3" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_3">
                                        <div class="fw-bold text-gray-800">Support</div>
                                        <div class="text-gray-600">Best for employees who regularly refund payments and
                                            respond to disputes</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class='separator separator-dashed my-5'></div>
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="user_role" type="radio" value="4"
                                        id="kt_modal_update_role_option_4" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_4">
                                        <div class="fw-bold text-gray-800">Trial</div>
                                        <div class="text-gray-600">Best for people who need to preview content data, but
                                            don't need to make any updates</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <!--end::Roles-->
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
<!--end::Modal - Add task-->
@endsection
