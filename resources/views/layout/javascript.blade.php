<script>
    // var hostUrl = "assets/"; 
    $(document).ready(function () {
        $('#dboard_Table1').DataTable({
            layout: {
                topStart: {
                    buttons: [{
                        extend: 'copy',
                        className: "btn btn-secondary"
                    }, {
                        extend: 'print',
                        className: "btn btn-light-dark"
                    }, {
                        extend: 'collection',
                        className: 'btn btn-light-primary',
                        text: 'Export',
                        buttons: ['csv', 'excel', 'pdf']
                    }],
                },
                topEnd: {
                    search: {
                        placeholder: 'Type search here'
                    }
                },
                bottomStart: {
                    pageLength: true,
                },
                bottom4End: {
                    info: true,
                }
            },
            initComplete: function () {
                var btns = $('.dt-button');
                btns.removeClass('dt-button');
                btns.removeClass('dt-button');
            },
            responsive: true,
            keys: true,
        });
        $('#Table_pengukuran').DataTable({
            responsive: true,
            lengthMenu: [
                [10]
            ]
        });
        $('#PA_Table_List').DataTable({
            responsive: false,
            lengthMenu: [
                [5, 10, 25],
                [5, 10, 25]
            ],
            columnDefs: [
                {
                    searchable: false,  
                    target: 0,
                    visible: false,
                },
                {
                    searchable: true,  
                    target: 1,
                    visible: true,
                },
                {
                    searchable: true,  
                    target: 2,
                    visible: false,
                },
                {
                    searchable: true,  
                    target: 3,
                    visible: false,
                },
                {
                    searchable: true,  
                    target: 4,
                    visible: false,
                },
                {
                    searchable: true,  
                    target: 5,
                    visible: false,
                },
                {
                    searchable: true,  
                    target: 6,
                    visible: false,
                }
            ]
        });
        $('#dboard_Table2').DataTable({
            layout: {
                topStart: {
                    buttons: [{
                        extend: 'copy',
                        className: "btn btn-secondary"
                    }, {
                        extend: 'print',
                        className: "btn btn-light-dark"
                    }, {
                        extend: 'collection',
                        className: 'btn btn-light-primary',
                        text: 'Export',
                        buttons: ['csv', 'excel', 'pdf']
                    }],
                },
                topEnd: {
                    search: {
                        placeholder: 'Type search here'
                    }
                },
                bottomStart: {
                    pageLength: true,
                },
                bottom4End: {
                    info: true,
                }
            },
            initComplete: function () {
                var btns = $('.dt-button');
                btns.removeClass('dt-button');
                btns.removeClass('dt-button');
            },
            responsive: true,
            keys: true,
        });
        $('#dboard_Table3').DataTable({
            layout: {
                topStart: {
                    buttons: [{
                        extend: 'copy',
                        className: "btn btn-secondary"
                    }, {
                        extend: 'print',
                        className: "btn btn-light-dark"
                    }, {
                        extend: 'collection',
                        className: 'btn btn-light-primary',
                        text: 'Export',
                        buttons: ['csv', 'excel', 'pdf']
                    }],
                },
                topEnd: {
                    search: {
                        placeholder: 'Type search here'
                    }
                },
                bottomStart: {
                    pageLength: true,
                },
                bottom4End: {
                    info: true,
                }
            },
            initComplete: function () {
                var btns = $('.dt-button');
                btns.removeClass('dt-button');
                btns.removeClass('dt-button');
            },
            responsive: true,
            keys: true,
        });
        $('#table_user').DataTable({
            layout: {
                topStart: {
                    buttons: [{
                        extend: 'copy',
                        className: "btn btn-sm btn-secondary"
                    }, {
                        extend: 'print',
                        className: "btn btn-sm btn-light-dark"
                    }, {
                        extend: 'collection',
                        className: 'btn btn-sm btn-light-primary',
                        text: 'Export',
                        buttons: ['csv', 'excel', 'pdf']
                    }],
                },
                topEnd: {
                    search: {
                        placeholder: 'Type anything here'
                    }
                },
                bottomEnd: {
                    paging: {
                        type: 'simple'
                    },
                },
                bottom4Start: {
                    pageLength: true,
                },
            },
            initComplete: function () {
                var btns = $('.dt-button');
                btns.removeClass('dt-button');
                btns.removeClass('dt-button');
            },
            responsive: true,
            keys: true,
        });
        $('#table_role').DataTable({
            layout: {
                topEnd: {
                    search: {
                        placeholder: 'Type anything here'
                    }
                },
                bottomEnd: {
                    paging: {
                        type: 'simple'
                    },
                }
            },
            initComplete: function () {
                var btns = $('.dt-button');
                btns.removeClass('dt-button');
                btns.removeClass('dt-button');
            },
            responsive: true,
            keys: true,
        });
        $('#table_user_role').DataTable({
            layout: {
                topEnd: {
                    search: {
                        placeholder: 'Type anything here'
                    }
                },
                bottomEnd: {
                    paging: {
                        type: 'simple'
                    },
                },
            },
            responsive: true,
            keys: true,
        });
        $('#table_audit').DataTable({
            layout: {
                topEnd: {
                    search: {
                        placeholder: 'Type anything here'
                    }
                },
                bottomEnd: {
                    paging: {
                        type: 'simple'
                    },
                },
            },
            initComplete: function () {
                var btns = $('.dt-button');
                btns.removeClass('dt-button');
                btns.removeClass('dt-button');
            },
            responsive: true,
            lengthMenu: [
                [25, 50, 100],
                [25, 50, 100]
            ],
            keys: true,
        });
        $('#log_approval_1').DataTable({
            layout: {
                topStart: {
                    buttons: [{
                        extend: 'copy',
                        className: "btn btn-secondary"
                    }, {
                        extend: 'print',
                        className: "btn btn-light-dark"
                    }, {
                        extend: 'collection',
                        className: 'btn btn-light-primary',
                        text: 'Export',
                        buttons: ['csv', 'excel', 'pdf']
                    }],
                },
                topEnd: {
                    search: {
                        placeholder: 'Type search here'
                    }
                },
                bottomStart: {
                    pageLength: true,
                },
                bottom4End: {
                    info: true,
                }
            },
            initComplete: function () {
                var btns = $('.dt-button');
                btns.removeClass('dt-button');
                btns.removeClass('dt-button');
            },
            responsive: true,
            keys: true,
        });
        $('#log_approval_2').DataTable({
            layout: {
                topStart: {
                    buttons: [{
                        extend: 'copy',
                        className: "btn btn-secondary"
                    }, {
                        extend: 'print',
                        className: "btn btn-light-dark"
                    }, {
                        extend: 'collection',
                        className: 'btn btn-light-primary',
                        text: 'Export',
                        buttons: ['csv', 'excel', 'pdf']
                    }],
                },
                topEnd: {
                    search: {
                        placeholder: 'Type search here'
                    }
                },
                bottomStart: {
                    pageLength: true,
                },
                bottom4End: {
                    info: true,
                }
            },
            initComplete: function () {
                var btns = $('.dt-button');
                btns.removeClass('dt-button');
                btns.removeClass('dt-button');
            },
            responsive: true,
            keys: true,
        });
    });
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="/assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
<script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="{{asset('assets/plugins/custom/draggable/draggable.bundle.js')}}"></script>
{{-- <script src="{{asset('assets/DataTables/datatables.min.js')}}"></script> --}}
<script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{asset('assets/js/custom/apps/user-management/users/list/table.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/export-users.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/add.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/add2.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/permissions/list.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/permissions/add-permission.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/permissions/update-permission.js')}}"></script>
<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
<!--end::Custom Javascript-->

@include('layout.alert')
