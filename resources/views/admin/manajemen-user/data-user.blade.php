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
            <button class="btn btn-sm fw-bold btn-danger btn-reset2" onclick="resetPasswords()">Reset</button>
            <!--end::Primary button-->
            <!--begin::Primary button-->
            <button class="btn btn-sm fw-bold btn-primary btn-select-all">Select All</button>
            <!--end::Primary button-->
            <!--begin::Primary button-->
            <button class="btn btn-sm fw-bold btn-secondary btn-cancel">Cancel</button>
            <!--end::Primary button-->
            <!--begin::Primary button-->
            <button class="btn btn-sm fw-bold btn-secondary btn-reset">Reset Password</button>
            <!--end::Primary button-->
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
            <div class="card-body">
                <table id="table_user" class="table align-middle table-row-dashed fs-6 gy-5" style="width:100%">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th></th>
                            <th class="text-center w-100px">No</th>
                            <th class="min-w-130px">User</th>
                            <th class="min-w-130px">Role</th>
                            <th class="min-w-100px">Last login</th>
                            <th class="min-w-100px">Status</th>
                            <th class="w-50px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1?>
                        @foreach ($dataUser as $data)
                        <tr>
                            <td> 
                                <div class="form-check">
                                    <input class="form-check-input user-checkbox" type="checkbox" id="flexCheckDefault" data-id="{{ $data->id }}"/>
                                </div>
                            </td>
                            <td class="text-center">{{$no++}}</td>
                            <td class="d-flex align-items-center">
                                <!--begin::User details-->
                                <div class="d-flex flex-column">
                                    <a href=""
                                        class="text-gray-800 text-hover-primary mb-1">{{ ucwords($data->username)}}</a>
                                </div>
                                <!--begin::User details-->
                            </td>
                            <td>{{$data->roles->role_name}}</td>
                            <td>
                                @if ($data->last_login_at == null)
                                    n/a
                                @endif
                                @if ($data->last_login_at != null)
                                    {{ date('d M Y H:i:s', strtotime($data->last_login_at))}}
                                @endif
                            </td>
                            <td>
                                @if ($data->is_blocked == true)
                                    <span class="badge badge-light-danger fs-5">blocked</span>
                                @else
                                    <span class="badge badge-light-success fs-5">active</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded fw-semibold fs-7 w-125px py-4"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <button id="btn-edit" data-id="{{ $data->username }}" class="btn btn-light-warning menu-link px-3 w-100">
                                            Edit
                                        </button>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="{{route('admin.users.delete', $data->id)}}" class="menu-link px-3 btn btn-light-danger"
                                            data-kt-users-table-filter="delete_row">Delete</a>
                                    </div>
                                    <!--end::Menu item-->
                                    @if ($data->is_blocked == true)
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.users.unblock', $data->id) }}">
                                                <button class="btn btn-info menu-link px-3 w-100">
                                                    Unblock User
                                                </button>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <!--end::Menu-->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

<!--begin::Modal - Add User-->
<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add User</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
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
                <form id="kt_modal_add_user_form" action="{{route('admin.users.create')}}" method="POST" class="form">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="row">
                            <!--begin::Input group-->
                            <div class="col-12 col-md-6 fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Nama</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="nama" class="form-control form-control-solid mb-3 mb-lg-0"
                                    placeholder="Name" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="col-12 col-md-6 fv-row">
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
                            <div class="col-12 col-md-6 fv-row">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0"
                                    placeholder="Email" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="col-12 col-md-6 fv-row">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Line</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <Select class="form-select form-select-solid mb-3 mb-lg-0" name="line_id">
                                    <option value="">Open this select menu</option>
                                    @foreach ($dataLines as $item)
                                        <option value="{{$item->id}}">{{$item->nama_line}}</option>
                                    @endforeach
                                </Select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            </div>
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold fs-6 mb-2 required">
                                        Password
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
                            <!--begin::Input group-->
                            <div class="mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-5">Role</label>
                                <!--end::Label-->
                                <!--begin::Roles-->
                                <?php $no=1; ?>
                                @foreach ($dataRoles as $data)
                                <!--begin::Input row-->
                                <div class="d-flex fv-row">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="user_role" type="radio" value="{{ $data->id}}"
                                            id="kt_modal_update_role_option_{{$no}}" />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_{{$no}}">
                                            <div class="fw-bold text-gray-800">{{ $data->role_name }}</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Input row-->
                                <div class='separator separator-dashed my-5'></div>
                                <?php $no++ ?>
                                @endforeach
                                <!--end::Roles-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--begin::Actions-->
                        <div class="text-center pt-10">
                            <button type="reset" class="btn btn-light me-3"
                                data-bs-dismiss="modal">Discard</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Scroll-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add User-->

<!--begin::Modal - Edit User-->
<div class="modal fade" id="kt_modal_edit_user" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit a User</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5">
                <!--begin::Form-->
                <form id="kt_modal_add_user_form" action="{{route('admin.users.update')}}" method="POST">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="row">
                            <!--begin::Input group-->
                            <div class="col-12 col-md-6 fv-row mb-7">
                                <input type="hidden" name="id_user" id="id_user" />
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Nama</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="nama_edit" id="nama_edit" class="form-control form-control-solid mb-3 mb-lg-0"
                                    placeholder="Name" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="col-12 col-md-6 fv-row  mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Username</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="username_edit" id="username_edit" class="form-control form-control-solid mb-3 mb-lg-0"
                                    placeholder="Username" readonly/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="col-12 col-md-6 fv-row  mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="email" name="email_edit" id="email_edit" class="form-control form-control-solid mb-3 mb-lg-0"
                                    placeholder="Email" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="col-12 col-md-6 fv-row  mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Line</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <Select class="form-select form-select-solid mb-3 mb-lg-0" name="line_id_edit" id="line_id_edit">
                                    <option value="">Open this select menu</option>
                                    @foreach ($dataLines as $item)
                                        <option value="{{$item->id}}">{{$item->nama_line}}</option>
                                    @endforeach
                                </Select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            </div>
                            <!--begin::Input group-->
                            <div class="mb-5 fv-row  mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-5">Role</label>
                                <!--end::Label-->
                                <!--begin::Roles-->
                                <?php $no=1; ?>
                                @foreach ($dataRoles as $data)
                                <!--begin::Input row-->
                                <div class="d-flex fv-row">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="user_role_edit" type="radio" value="{{ $data->id}}"
                                            id="kt_modal_update_role_option_{{$no}}"/>
                                        <!--end::Input--> 
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_{{$no}}">
                                            <div class="fw-bold text-gray-800">{{ $data->role_name }}</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Input row-->
                                <div class='separator separator-dashed my-5'></div>
                                <?php $no++ ?>
                                @endforeach
                                <!--end::Roles-->
                            </div>
                            <!--end::Input group-->
                        </div>
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
                    </div>
                    <!--end::Scroll-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Edit User-->

<script>
    $(document).ready(function(){
         // Hide checkboxes initially
        $('.user-checkbox').hide();
        $('.btn-reset2').hide();
        $('.btn-select-all').hide();
        $('.btn-cancel').hide();

        // Show checkboxes when the reset button is clicked
        $('body').on('click', '.btn-reset', function() {
            $('.user-checkbox').toggle(); // Toggle visibility of checkboxes
            $('.btn-reset2').toggle();
            $('.btn-select-all').toggle();
            $('.btn-cancel').toggle();
            $('.btn-reset').hide();
        });

        $('body').on('click', '.btn-cancel', function() {
            $('.user-checkbox').hide(); // Toggle visibility of checkboxes
            $('.btn-reset2').hide();
            $('.btn-select-all').hide();
            $('.btn-cancel').hide();
            $('.btn-reset').toggle();
        });

        // Select all checkboxes
        $('body').on('click', '.btn-select-all', function() {
            // Check if all checkboxes are checked
            const allChecked = $('.user-checkbox:checked').length === $('.user-checkbox').length;

            // Toggle checkboxes based on the current state
            $('.user-checkbox').prop('checked', !allChecked);
        });

        // Uncheck all checkboxes when the cancel button is clicked
        $('.btn-cancel').click(function() {
            $('.user-checkbox').prop('checked', false);
        });

        //button create post event
        $('body').on('click', '#btn-edit', function () {

            let edit_id = $(this).data('id');

            //fetch detail post with ajax
            $.ajax({
                url: "{{route('admin.users.edit', ':id')}}".replace(':id', edit_id),
                type: "GET",
                cache: false,
                success: function (response) {

                    //fill data to form
                    $('#id_user').val(response.data.id);
                    $('#nama_edit').val(response.data.nama);
                    $('#username_edit').val(response.data.username);
                    $('#email_edit').val(response.data.email);
                    $('#line_id_edit').val(response.data.line_id);
                    $('input[name="user_role_edit"][value="' + response.data.role_id + '"]').prop('checked', true);

                    //open modal
                    $('#kt_modal_edit_user').modal('show');
                }
            });
        });
    });

    function resetPasswords() {
        // Gather selected user IDs
        let selectedUsers = [];
        $('.user-checkbox:checked').each(function() {
            selectedUsers.push($(this).data('id'));
        });

        if (selectedUsers.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No users selected',
                text: 'Please select at least one user to reset the password.'
            });
            return;
        }
        
        Swal.fire({
            icon: 'question',
            title: 'Are You Sure?',
            text: 'This action will reset the passwords for the selected users.',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, reset selected"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Set New Password",
                    input: "text",
                    inputAttributes: {
                        autocapitalize: "off"
                    },
                    showCancelButton: true,
                    confirmButtonText: "Update password",
                    allowOutsideClick: false,
                    
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.users.reset_selected_password") }}', // Update this route
                        data: {
                            user_ids: selectedUsers,
                            new_password: result.value,
                            _token: '{{ csrf_token() }}' // Include CSRF token
                        },
                        cache: false,
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Processing...',
                                text: 'Please wait while we process your request.',
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                willOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },
                        success: function(response) {
                            if (response.success == false) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Something went wrong!',
                                    text: response.message + ' ' + response.by
                                });
                            } else {
                                let timerInterval;
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successful',
                                    text: response.message + ' ' + response.by,
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                    willOpen: () => {
                                        Swal.showLoading();
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval);
                                        window.location.href = '{{ route("admin.users.index") }}';
                                    }
                                });
                            }
                        },
                    });
                    }
                });
            }
        });
    }
</script>
@endsection
