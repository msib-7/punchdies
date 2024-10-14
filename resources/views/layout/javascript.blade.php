<script>
    var hostUrl = "assets/";
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
        $('#PA_Table_List').DataTable({
            responsive: true,
            lengthMenu: [
                [5, 10, 25],
                [5, 10, 25]
            ],
            ordering: true
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
    });

</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{asset('assets/DataTables/datatables.min.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{asset('assets/js/custom/apps/user-management/users/list/table.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/export-users.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/users/list/add.js')}}"></script>
<script src="assets/js/custom/apps/user-management/permissions/list.js"></script>
<script src="assets/js/custom/apps/user-management/permissions/add-permission.js"></script>
<script src="assets/js/custom/apps/user-management/permissions/update-permission.js"></script>
<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
<!--end::Custom Javascript-->

@include('layout.alert')
