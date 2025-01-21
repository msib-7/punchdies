<script>
    // var hostUrl = "assets/"; 
    $(document).ready(function () {
        $('#form_table').DataTable({
            responsive: true,
            paging: false,
            info: false,
        });
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

<script>
    let idleTime = 0;
    let idleMin = 0;
    const idleLimit = 3540; // 60 minutes in seconds
    const idleDisplay = document.getElementById('idle_time');

    // Increment the idle time counter every second
    const idleInterval = setInterval(() => {
        idleTime++;
        
        // Calculate total idle time in minutes and seconds
        const totalIdleTime = idleTime % 3600; // Total seconds in an hour
        const minutes = Math.floor(totalIdleTime / 60);
        const seconds = totalIdleTime % 60;

        // Format minutes and seconds to always show two digits
        const formattedMinutes = String(minutes).padStart(2, '0');
        const formattedSeconds = String(seconds).padStart(2, '0');
        
        idleDisplay.textContent = `Idle Time: ${formattedMinutes}:${formattedSeconds}`;

        if (minutes > 59) { 
            window.location.href = '{{ route("logout") }}'; // Update this route as needed
        }
    }, 1000); // Check every second

    // Reset the idle timer on user activity
    const resetIdleTime = () => {
        idleTime = 0;
        idleDisplay.textContent = 'Idle Time: 00:00'; // Reset display
    };

    // Listen for user activity
    document.addEventListener('mousemove', resetIdleTime);
    document.addEventListener('keypress', resetIdleTime);
    document.addEventListener('click', resetIdleTime);
    document.addEventListener('scroll', resetIdleTime);
    document.addEventListener('touchstart', resetIdleTime);
</script>

<script>
    // Function to check orientation and update display
    function checkOrientation() {
        if (window.innerHeight > window.innerWidth) {
            // Portrait mode
            document.getElementById('kt_app_content').style.display = 'none'; // Hide content
            alert("Please rotate your device to landscape mode."); // Show alert
        } else {
            // Landscape mode
            document.getElementById('kt_app_content').style.display = 'block'; // Show content
        }
    }

    // Initial check on page load
    checkOrientation();

    // Add event listener for orientation change
    window.addEventListener("orientationchange", function() {
        checkOrientation();
    });

    // Also listen for resize events (for browsers that don't support orientationchange)
    window.addEventListener("resize", function() {
        checkOrientation();
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
