@extends('layout.metronic')
@section('main-content')
            {{-- <style>
                @media (max-width: 576px) { /* Bootstrap's sm breakpoint */
                    .min-width-responsive {
                        min-width: 150px;
                    }
                }

                @media (min-width: 576px) and (max-width: 768px) { /* Bootstrap's md breakpoint */
                    .min-width-responsive {
                        min-width: 130px;
                    }
                }

                /* Style for odd rows */
                /* #form_table tbody tr:nth-child(odd) {
                    background-color: gainsboro;
                } */

                /* Style for even rows */
                /* #form_table tbody tr:nth-child(even) {
                    background-color: whitesmoke;
                } */

                /* To ensure the rounded corners are visible, you may need to add this */
                #form_table tbody tr {
                    overflow: hidden; /* Prevents overflow of rounded corners */
                }

                /* Style for the DataTable */
                #form_table {
                    border-collapse: separate; /* Ensure borders are separate for rounded corners */
                    border-radius: 10px; /* Adjust the value for desired roundness */
                    overflow: hidden; /* Prevent overflow of rounded corners */
                }

                /* Style for the table header */
                #form_table thead {
                    background-color: green; /* Change this to your desired header background color */
                    color: white; /* Change this to your desired text color */
                }

                /* Style for the table cells */
                #form_table th, #form_table td {
                    border: 1px solid #dee2e6; /* Add border to cells */
                    border-radius: 0; /* Reset border-radius for cells */
                }

                /* Optional: Add rounded corners to the first and last cells of the header and body */
                /* #form_table thead th:first-child {
                    border-top-left-radius: 10px; 
                }

                #form_table thead th:last-child {
                    border-top-right-radius: 10px; 
                }

                #form_table tbody tr:last-child td:first-child {
                    border-bottom-left-radius: 10px;
                }

                #form_table tbody tr:last-child td:last-child {
                    border-bottom-right-radius: 10px;
                } */
            </style> --}}
            <style>
                /* Custom styles for the table */
                #form_table {
                    width: 100%;
                    border-radius: 5px;
                    overflow: hidden;
                }

                #form_table thead {
                    background-color: #074282; /* Bootstrap primary color */
                    color: white;
                }

                #form_table th, #form_table td {
                    padding: 10px 10px; /* Increased padding for better spacing */
                    text-align: center;
                }

                #form_table tbody tr {
                    transition: background-color 0.3s; /* Smooth transition for hover effect */
                }

                #form_table tbody tr:hover {
                    background-color: #f1f1f1; /* Light gray background on hover */
                }

                /* Responsive adjustments */
                @media (max-width: 576px) {
                    #form_table th, #form_table td {
                        font-size: 12px; /* Smaller font size on small screens */
                    }
                }
                @media (max-width: 576px) { /* Bootstrap's sm breakpoint */
                    .min-width-responsive {
                        min-width: 150px;
                    }
                }

                @media (min-width: 576px) and (max-width: 768px) { /* Bootstrap's md breakpoint */
                    .min-width-responsive {
                        min-width: 200px;
                    }
                }
            </style>
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Engage-->
                <div class="app-engage " id="kt_app_engage">  
                    <!--begin::Prebuilts toggle-->
                    <button class="app-engage-btn hover-dark" id="kt_drawer_example_basic_button">
                        <i class="ki-duotone ki-information fs-1 pt-1 mb-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        Bantuan
                    </button>
                </div>
                <!--end::Engage-->
                {{-- Start Content --}}
                <div class="row">
                    <div class="col-12">
                        <div class="accordion" id="kt_accordion_1">
                            <div class="accordion-item ribbon ribbon-end ribbon-clip">
                                <div class="ribbon-label">
                                    <span class="fw-semibold"><?= $statusPengukuran?></span>
                                    <span class="ribbon-inner bg-warning"></span>
                                </div>
                                <h2 class="accordion-header" id="kt_accordion_1_header_1">
                                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#kt_accordion_1_body_1" aria-expanded="true"
                                        aria-controls="kt_accordion_1_body_1">
                                        <span class="fs-2 fw-bold">{{ strtoupper($labelPunch->merk) }}</span>
                                    </button>
                                </h2>

                                <div id="kt_accordion_1_body_1" class="accordion-collapse collapse"
                                    aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table style="border: none;">
                                                                <tbody>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            Merk Punch
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            {{ strtoupper($labelPunch->merk) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            Bulan/Tahun Pembuatan
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            {{ strtoupper($labelPunch->bulan_pembuatan) . ' ' . $labelPunch->tahun_pembuatan }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            Nama Mesin Cetak
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            {{ strtoupper($labelPunch->nama_mesin_cetak) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            Kode/Nama Produk
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            <?php if (strtoupper($labelPunch->nama_produks->title) == strtoupper($labelPunch->kode_produks->title)) {?>
                                                                            {{ strtoupper($labelPunch->nama_produks->title)}}
                                                                            <?php } else {?>
                                                                            {{ strtoupper($labelPunch->nama_produks->title) . "/" . strtoupper($labelPunch->kode_produks->title)}}
                                                                            <?php }?>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table style="border: none;">
                                                                <tbody>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            Masa Pengukuran
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            {{ ucwords($labelPunch->masa_pengukuran) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            Tanggal Pengukuran
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            {{ date_format($tglPengukuran->created_at, 'd M Y') }}
                                                                            {{-- {{ $labelPunch->created_at }} --}}
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            Diukur oleh
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            {{ ucwords($labelPunch->username) }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            Status
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;" class="fs-5 px-4 my-4">
                                                                            <?php echo $statusPengukuran?>
                                                                        </td>
                                                                    </tr>
                                                                    {{-- <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;" class="fs-3 px-4 my-4" colspan="3">
                                                                            <span class="badge badge-light-success fs-5">Approved</span>
                                                                        </td>
                                                                    </tr> --}}
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="card">
                            <form action="{{ route('pnd.pa.' . $route . '.store') }}" method="POST" enctype="multipart/form-data"
                                id="form_data_pengukuran">
                                @csrf
                                <div class="card-header">
                                    <h3 class="card-title">Insert New Data</h3>
                                    <div class="card-toolbar">
                                        <input type="hidden" name="count_num" value="{{$page }}">
                                        <h5>
                                            {{ $page }}/{{session('jumlah_punch')}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        {{-- <table id="form_table" class="table table-rounded table-bordered table-striped border">
                                            --}}
                                            <table id="form_table" class="display row-border">
                                                <thead>
                                                    <tr class="fw-semibold fs-6 border-bottom border-gray-200">
                                                        <th class="min-width-responsive text-center text-white align-center">
                                                            No</th>
                                                        <th class="min-width-responsive text-center text-white align-center">
                                                            A. Head Outer Diameter</th>
                                                        <th class="min-width-responsive text-center text-white align-center">
                                                            E. Neck Diameter</th>
                                                        <th class="min-width-responsive text-center text-white align-center">
                                                            F. Barrel</th>
                                                        <th class="min-width-responsive text-center text-white align-center">
                                                            G. Overall Length</th>
                                                        <th class="min-width-responsive text-center text-white align-center">
                                                            I. Tip Diameter 1</th>
                                                        <th class="min-width-responsive text-center text-white align-center">
                                                            J. Tip Diameter 2</th>
                                                        <th class="min-width-responsive text-center text-white align-center">
                                                            K. Cup Depth</th>
                                                        <th class="min-width-responsive text-center text-white align-center">
                                                            L. Working Length</th>
                                                        <td class="hidden"></td>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_body">
                                                    <!-- Dynamic rows will be inserted here -->
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div id="last_id"></div>
                                    <div class="d-flex justify-content-between">
                                        <div class="col">
                                            <a href="#" id="btn-cancel">
                                            </a>
                                        </div>
                                        <div class="col text-end" id="btn-next">
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 mt-10">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" name="CheckBoxDraft" type="checkbox" value="enabled"
                                                id="flexSwitch" checked='checked' />
                                            <label class="form-check-label" for="flexSwitch">
                                                Simpan Draft untuk saat ini
                                            </label>
                                        </div>
                                    </div> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- end Content --}}
            </div>

            <!--Bantuan Pengukuran-->
            <div
                id="kt_drawer_example_basic"

                class="bg-white"
                data-kt-drawer="true"
                data-kt-drawer-activate="true"
                data-kt-drawer-toggle="#kt_drawer_example_basic_button"
                data-kt-drawer-close="#kt_drawer_example_basic_close"
                data-kt-drawer-width="300px">
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header pe-5">
                        <!--begin::Title-->
                        <div class="card-title">
                            Bantuan Pengukuran Punch
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Card header-->
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{asset('assets/img/guide_punch.png')}}" style="max-width: 200px" alt="helper">
                        </div>
                        <img src="{{asset('assets/img/standar_awal.png')}}" style="max-width: 200px" alt="rule">
                    </div>
                </div>
            </div>
            <!--end::Bantuan Pengukuran-->

            {{-- Confirm Data Pengukuran --}}
            <div class="modal fade" tabindex="-1" id="modal_confirm_pengukuran">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title">Konfirmasi</h6>

                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                            <!--end::Close-->
                        </div>

                        <div class="modal-body">
                            <div class="col-12">
                                <div class="text-center fs-2 fw-bold">
                                    Yakin Data Sudah Benar?
                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <form action="{{route('pnd.pa.' . $route . '.create-note')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <input type="text" name="id" value="{{$labelPunch->punch_id}}" hidden>
                                            <div class="col-12">
                                                <div class="d-flex flex-column mx-2">
                                                    <label for="referensi_drawing" class="required form-label">Referensi Drawing</label>
                                                    <input type="text" class="form-control" id="referensi_drawing" name="referensi_drawing" placeholder="Insert Reference Drawing" value="{{ $labelPunch->referensi_drawing ?? '' }}" required />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-12 mt-3">
                                                        <div class="d-flex flex-column mx-2">
                                                            <label for="catatan" class="required form-label">Catatan</label>
                                                            <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Insert Your Message" required>{{ $labelPunch->catatan ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="d-flex flex-column mx-2">
                                                            <label for="kesimpulan" class="required form-label">Kesimpulan</label>
                                                            <textarea class="form-control" id="kesimpulan" name="kesimpulan" rows="3" placeholder="Insert Your Message" required>{{ $labelPunch->kesimpulan ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="d-flex flex-column mt-5">
                                                    <label for="" class="required form-label">Kalibrasi Tools</label>
                                                    <div class="table-responsive">
                                                        <table class="table table-rounded table-bordered">
                                                            <thead>
                                                                <tr class="fw-bold fs-6 text-gray-800">
                                                                    <th>Tools</th>
                                                                    <th>Tgl Kalibrasi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <select name="kalibrasi_tools_1" aria-label="Select a Tool" data-control="select2" data-dropdown-parent="#modal_confirm_pengukuran" data-placeholder="Select a item..." class="form-select fw-bold" required>
                                                                            <option value="">Select Tool</option>
                                                                            @foreach ($kalibrasiTools as $item)
                                                                                <option value="{{$item->id}}" {{ $labelPunch->kalibrasi_tools_1 == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="date" name="tgl_kalibrasi_1" id="tgl_kalibrasi_1" class="form-control" value="{{ date('Y-m-d', strtotime($labelPunch->tgl_kalibrasi_tools_1)) }}" required>
                                                                        {{-- <input type="text" name="tgl_kalibrasi_1" id="tgl_kalibrasi_1" class="form-control" value="{{ date('d/m/Y',strtotime($labelPunch->tgl_kalibrasi_1)) }}" required> --}}
                                                                        {{-- <input type="text" name="tgl_kalibrasi_1" id="tgl_kalibrasi_1" class="form-control" value="{{ $labelPunch->tgl_kalibrasi_tools_1 }}" required> --}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <select name="kalibrasi_tools_2" aria-label="Select a Tool" data-control="select2" data-dropdown-parent="#modal_confirm_pengukuran" data-placeholder="Select a item..." class="form-select fw-bold" required>
                                                                            <option value="">Select Tool</option>
                                                                            @foreach ($kalibrasiTools as $item)
                                                                                <option value="{{$item->id}}" {{ $labelPunch->kalibrasi_tools_2 == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="date" name="tgl_kalibrasi_2" id="tgl_kalibrasi_2" class="form-control" value="{{ date('Y-m-d', strtotime($labelPunch->tgl_kalibrasi_tools_2)) }}" required>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <select name="kalibrasi_tools_3" aria-label="Select a Tool" data-control="select2" data-dropdown-parent="#modal_confirm_pengukuran" data-placeholder="Select a item..." class="form-select fw-bold" required>
                                                                            <option value="">Select Tool</option>
                                                                            @foreach ($kalibrasiTools as $item)
                                                                                <option value="{{$item->id}}" {{ $labelPunch->kalibrasi_tools_3 == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="date" name="tgl_kalibrasi_3" id="tgl_kalibrasi_3" class="form-control" value="{{ date('Y-m-d', strtotime($labelPunch->tgl_kalibrasi_tools_3)) }}" required>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <script>
                $(document).ready(function () {
                    $('#form_data_pengukuran').on('submit', function (e) {
                        // Prevent form submission
                        e.preventDefault();

                        // Check if all required fields are filled
                        var isValid = true;

                        // Check Referensi Drawing
                        if ($('#referensi_drawing').val() === '') {
                            alert('Referensi Drawing is required.');
                            isValid = false;
                        }

                        // Check Catatan
                        if ($('#catatan').val() === '') {
                            alert('Catatan is required.');
                            isValid = false;
                        }

                        // Check Kesimpulan
                        if ($('#kesimpulan').val() === '') {
                            alert('Kesimpulan is required.');
                            isValid = false;
                        }

                        // Check kalibrasi tool 1
                        if ($('select[name="kalibrasi_tools_1"]').val() === '') {
                            alert('Kalibrasi tool 1 is required.');
                            isValid = false;
                        }

                        // Check kalibrasi tool 2
                        if ($('select[name="kalibrasi_tools_2"]').val() === '') {
                            alert('Kalibrasi tool 2 is required.');
                            isValid = false;
                        }

                        // Check kalibrasi tool 3
                        if ($('select[name="kalibrasi_tools_3"]').val() === '') {
                            alert('Kalibrasi tool 3 is required.');
                            isValid = false;
                        }

                        // Check 1
                        if ($('#tgl_kalibrasi_1').val() === '') {
                            alert('Calibration date is required.');
                            isValid = false;
                        }

                        // Check 2
                        if ($('#tgl_kalibrasi_2').val() === '') {
                            alert('Calibration date is required.');
                            isValid = false;
                        }

                        // Check 3
                        if ($('#tgl_kalibrasi_3').val() === '') {
                            alert('Calibration date is required.');
                            isValid = false }

                        // If all fields are valid, submit the form
                        if (isValid) {
                            this.submit();
                        }
                    });
                });
            </script>

            <script>
                $(document).ready(function () {
                    // Check threshold for all inputs on document load
                    // new checkAllThresholds();

                    //Table Body
                    //No
                    <?php
    $ch = $count_header;
    $no = 0;
    foreach ($draftPengukuran as $data) { ?>

                            // No Punch
                            var tr = document.createElement('tr'); // Create a new row
                            var td = tr.appendChild(document.createElement('td')); // Create a new column
                            var x = td.appendChild(document.createElement('INPUT')); // Create a new input
                            x.setAttribute("class", "form-control text-center");
                            x.setAttribute("type", "button");
                            x.setAttribute("style", "cursor: pointer; font-size: 16px; font-weight: bold; border: none; background: transparent;");
                            x.setAttribute("value", "Punch <?= $ch++?>");
                            x.setAttribute("readonly", "readonly");
                            // var td = tr.appendChild(document.createElement('td')); // Create a new column
                            // var x = td.appendChild(document.createElement('INPUT')); // Create a new input
                            // x.setAttribute("class", "form-control text-center");
                            // x.setAttribute("type", "button");
                            // x.setAttribute("style", "cursor: pointer; font-size: 14px; font-weight: bold; background-color: #1f8bff; color: white;");
                            // x.setAttribute("readonly", "readonly");


                            // Head Outer Diameter
                            var td = tr.appendChild(document.createElement('td'));
                            var x = td.appendChild(document.createElement('INPUT'));
                            x.setAttribute("type", "text");
                            x.setAttribute("data-index", "<?= $no ?>");
                            x.setAttribute("class", "inputs form-control text-center mx-0");
                            x.setAttribute("maxlength", "{{ $form_setting->head_outer_diameter }}");
                            x.setAttribute("id", "hdo<?=$no?>");
                            x.setAttribute("name", "hdo[]");
                            x.setAttribute("autocomplete", "off");
                            // x.setAttribute("placeholder", "00.00");
                            x.setAttribute("value", "<?= $draftPengukuran[$no]['head_outer_diameter']; ?>");
                            // x.setAttribute("onkeypress", "return event.keyCode != 13;"); 
                            x.setAttribute("style", "background-color: #eaeaea; cursor: pointer; box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                            <?php    if ($no == 10) { ?>
                                x.setAttribute("onkeyup", "saveData()");
                            <?php    } ?>

                            // Neck Diameter
                            var td = tr.appendChild(document.createElement('td'));
                            var x = td.appendChild(document.createElement('INPUT'));
                            x.setAttribute("type", "text");
                            x.setAttribute("data-index", "<?= $no ?>");
                            x.setAttribute("class", "inputs form-control text-center");
                            x.setAttribute("name", "ned[]");
                            x.setAttribute("id", "ned<?=$no?>");
                            x.setAttribute("autocomplete", "off");
                            // x.setAttribute("placeholder", "00.00");
                            x.setAttribute("maxlength", "{{ $form_setting->neck_diameter }}");
                            x.setAttribute("value", "<?= $draftPengukuran[$no]['neck_diameter']; ?>");
                            // x.setAttribute("onkeypress", "return event.keyCode != 13;"); 
                            x.setAttribute("style", "background-color: #eaeaea; cursor: pointer; box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                            <?php    if ($no == 10) { ?>
                                x.setAttribute("onkeyup", "saveData()");
                            <?php    } ?>

                            // Barrel
                            var td = tr.appendChild(document.createElement('td'));
                            var x = td.appendChild(document.createElement('INPUT'));
                            x.setAttribute("type", "text");
                            x.setAttribute("data-index", "<?= $no ?>");
                            x.setAttribute("class", "inputs form-control text-center");
                            x.setAttribute("name", "bar[]");
                            x.setAttribute("id", "bar<?=$no?>");
                            x.setAttribute("autocomplete", "off");
                            x.setAttribute("maxlength", "{{ $form_setting->barrel }}");
                            // x.setAttribute("placeholder", "00.00");
                            x.setAttribute("value", "<?= $draftPengukuran[$no]['barrel']; ?>");
                            // x.setAttribute("onkeypress", "return event.keyCode != 13;"); 
                            x.setAttribute("style", "background-color: #eaeaea; cursor: pointer;box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                            <?php    if ($no == 10) { ?>
                                x.setAttribute("onkeyup", "saveData()");
                            <?php    } ?>

                            // Overall Length
                            var td = tr.appendChild(document.createElement('td'));
                            var x = td.appendChild(document.createElement('INPUT'));
                            x.setAttribute("type", "text");
                            x.setAttribute("data-index", "<?= $no ?>");
                            x.setAttribute("class", "inputs form-control text-center");
                            x.setAttribute("name", "ovl[]");
                            x.setAttribute("id", "ovl<?=$no?>");
                            x.setAttribute("autocomplete", "off");
                            x.setAttribute("maxlength", "{{ $form_setting->overall_length }}");
                            // x.setAttribute("placeholder", "00.00");
                            x.setAttribute("value", "<?= $draftPengukuran[$no]['overall_length']; ?>");
                            // x.setAttribute("onkeypress", "return event.keyCode != 13;"); 
                            x.setAttribute("style", "background-color: #eaeaea; cursor: pointer;box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                            <?php    if ($no == 10) { ?>
                                x.setAttribute("onkeyup", "saveData()");
                            <?php    } ?>

                            // Tip Diameter 1
                            var td = tr.appendChild(document.createElement('td'));
                            var x = td.appendChild(document.createElement('INPUT'));
                            x.setAttribute("type", "text");
                            x.setAttribute("data-index", "<?= $no ?>");
                            x.setAttribute("class", "inputs form-control text-center");
                            x.setAttribute("name", "tip1[]");
                            x.setAttribute("id", "tip1<?=$no?>");
                            x.setAttribute("autocomplete", "off");
                            x.setAttribute("maxlength", "{{ $form_setting->tip_diameter_1 }}");
                            // x.setAttribute("placeholder", "00.00");
                            x.setAttribute("value", "<?= $draftPengukuran[$no]['tip_diameter_1']; ?>");
                            // x.setAttribute("onkeypress", "return event.keyCode != 13;"); 
                            x.setAttribute("style", "background-color: #eaeaea; cursor: pointer;box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                            <?php    if ($no == 10) { ?>
                                x.setAttribute("onkeyup", "saveData()");
                            <?php    } ?>

                            // Tip Diameter 2
                            var td = tr.appendChild(document.createElement('td'));
                            var x = td.appendChild(document.createElement('INPUT'));
                            x.setAttribute("type", "text");
                            x.setAttribute("data-index", "<?= $no ?>");
                            x.setAttribute("class", "inputs form-control text-center");
                            x.setAttribute("name", "tip2[]");
                            x.setAttribute("id", "tip2<?=$no?>");
                            x.setAttribute("autocomplete", "off");
                            x.setAttribute("maxlength", "{{ $form_setting->tip_diameter_2 }}");
                            // x.setAttribute("placeholder", "00.00");
                            x.setAttribute("value", "<?= $draftPengukuran[$no]['tip_diameter_2']; ?>");
                            // x.setAttribute("onkeypress", "return event.keyCode != 13;"); 
                            x.setAttribute("style", "background-color: #eaeaea; cursor: pointer;box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                            <?php    if ($no == 10) { ?>
                                x.setAttribute("onkeyup", "saveData()");
                            <?php    } ?>

                            // Cup Depth
                            var td = tr.appendChild(document.createElement('td'));
                            var x = td.appendChild(document.createElement('INPUT'));
                            x.setAttribute("type", "text");
                            x.setAttribute("data-index", "<?= $no ?>");
                            x.setAttribute("class", "inputs form-control text-center");
                            x.setAttribute("name", "cup[]");
                            x.setAttribute("id", "cup<?=$no?>");
                            x.setAttribute("autocomplete", "off");
                            x.setAttribute("maxlength", "{{ $form_setting->cup_depth }}");
                            // x.setAttribute("placeholder", "00.00");
                            x.setAttribute("value", "<?= $draftPengukuran[$no]['cup_depth']; ?>");
                            // x.setAttribute("onkeypress", "return event.keyCode != 13;"); 
                            x.setAttribute("style", "background-color: #eaeaea; cursor: pointer;box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                            <?php    if ($no == 10) { ?>
                                x.setAttribute("onkeyup", "saveData()");
                            <?php    } ?>

                            // Working Length
                            var td = tr.appendChild(document.createElement('td'));
                            var x = td.appendChild(document.createElement('INPUT'));
                            x.setAttribute("type", "text");
                            x.setAttribute("data-index", "<?= $no ?>");
                            x.setAttribute("class", "inputs form-control text-center");
                            x.setAttribute("name", "wkl[]");
                            x.setAttribute("id", "wkl<?=$no?>");
                            x.setAttribute("autocomplete", "off");
                            x.setAttribute("maxlength", "{{ $form_setting->working_length }}");
                            // x.setAttribute("placeholder", "00.00");
                            x.setAttribute("value", "<?= $draftPengukuran[$no]['working_length']; ?>");
                            // x.setAttribute("onkeypress", "return event.keyCode != 13;"); 
                            x.setAttribute("style", "background-color: #eaeaea; cursor: pointer;box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                            <?php    if ($no == 10) { ?>
                                x.setAttribute("onkeyup", "saveData()");
                            <?php    } ?>

                            // Update Id
                            var td = tr.appendChild(document.createElement('td'));
                            var a = td.appendChild(document.createElement('INPUT'));
                                a.setAttribute("type", "hidden");
                                a.setAttribute("readonly", "readonly");
                                a.setAttribute("name", "update_id[]");
                                a.setAttribute("value", "<?= $draftPengukuran[$no]['no']; ?>");

                            document.getElementById("table_body").appendChild(tr);
                    <?php    $no++;
    } ?>

                    //
                    //Get Last Id per page
                        var last_id = td.appendChild(document.createElement('INPUT'));
                        last_id.setAttribute("type", "hidden");
                        last_id.setAttribute("name", "last_id");
                        last_id.setAttribute("value", "<?= $draftPengukuran[$no - 1]['no']; ?>");
                        document.getElementById("last_id").appendChild(last_id);
                    //    

                    //Create Button Cancel
                        var btn_cancel = document.createElement("a");
                        btn_cancel.setAttribute("class", "btn btn-secondary btn-small");
                        btn_cancel.setAttribute("href", "{{route('pnd.pa.' . $route . '.index')}}");
                        var title1 = document.createTextNode("Cancel");
                        btn_cancel.appendChild(title1);
                        document.getElementById("btn-cancel").appendChild(btn_cancel);
                    //

                    // Create Button Next
                        form = document.getElementById('form_data_pengukuran');

                        var btn_next = document.createElement("BUTTON");
                        btn_next.setAttribute("class", "btn btn-primary btn-small");
                        btn_next.setAttribute("id", "btn_next");
                        btn_next.setAttribute("type", "button");
                        btn_next.setAttribute("onclick", "checkInvalid()");

                        var title2 = document.createElement('span');
                        title2.innerHTML = 'Next <i class="ki-duotone ki-arrow-right fw-bold"><span class="path1"></span><span class="path2"></span></i>';
                        btn_next.appendChild(title2);

                        // Append the button to the DOM
                        document.getElementById("btn-next").appendChild(btn_next);
                    //

                    // Ketika Tab / Enter di click
                    $(".inputs").keydown(function (e) {
                        // Check if the pressed key is Tab or Enter
                        if (e.key === "Tab" || e.key === "Enter") {
                            e.preventDefault(); // Prevent the default tab behavior

                            // Get the current input field
                            var currentInput = $(this);
                            var currentRow = currentInput.closest('tr'); // Get the current row
                            var currentIndex = currentInput.data('index'); // Get the data-index of the current input


                            // Find the next row
                            var nextRow = currentRow.next('tr'); // Get the next row

                            // If there is no next row, wrap around to the first row
                            if (nextRow.length === 0) {
                                nextRow = currentRow.siblings().first(); // Get the first row
                            }

                            // Find the input in the next row with the same data-index + 1 and same name
                            var nextInput = nextRow.find('input[data-index="' + (parseInt(currentIndex) + 1) + '"][name="' + currentInput.attr('name') + '"]');

                            // If the next input does not exist, move to the next column in the same row
                            if (nextInput.length === 0) {
                                // Find the next input with the same data-index + 1 in the same row
                                nextInput = currentRow.find('input[data-index="' + (parseInt(currentIndex) + 1) + '"]');

                                // If the next input still does not exist, move to the next row and reset the data-index to 0
                                if (nextInput.length === 0) {
                                    nextInput = nextRow.find('input[data-index="0"][name="' + currentInput.attr('name') + '"]');
                                }
                            }

                            // If the next input exists, focus on it
                            if (nextInput.length > 0) {
                                nextInput.focus();
                            }
                        }
                    });

                    // Add event listener for input on inputs
                    $(".inputs").on("input", function () {
                        // Check if the input value length is equal to its maxlength
                        if (this.value.length >= this.maxLength) {
                            // Trigger the Enter key event
                            var event = jQuery.Event("keydown", { key: "Enter" });
                            $(this).trigger(event);
                            // convertToDecimal(this);
                        }

                        // checkThreshold(this);
                        // Check for threshold
                    });

                    $(".inputs").on("blur", function () {
                        // convertToDecimal(this);
                    });

                    // function checkAllThresholds() {
                    //     var input = document.querySelectorAll('.inputs'); // Get all input fields

                    //     $(input).each(function () {
                    //         checkThreshold(this); // Call checkThreshold for each input
                    //     });
                    // }

                    // function checkThreshold(input) {
                    //     var value = parseFloat(input.value); // Get the value of the input field
                    //     var warningIcon = $(input).siblings('.warning-icon'); // Get the warning icon

                    //     if (!isNaN(value) && value > 50) { // Check if the value is a number and greater than 10
                    //         $(input).addClass('is-invalid'); // Add a red border to the input field
                    //         input.focus(); // Optionally focus back on the input field
                    //     } else {
                    //         warningIcon.hide(); // Hide the warning icon if the value is within the threshold
                    //         $(input).removeClass('is-invalid'); // Remove the red border if the value is within the threshold
                    //     }
                    // }

                    function convertToDecimal(input) {
                        // Get the value of the input field
                        var value = parseFloat(input.value);

                        // Check if the value is a valid number
                        if (!isNaN(value)) {
                            // Format the value to 2 decimal places
                            input.value = value.toFixed(2);
                        }
                    }


                });
                function checkWorkingLengthThreshold() {
                    let workingLengths = [];

                    // Collect all working length values
                    $("input[name='wkl[]']").each(function() {
                        let value = parseFloat($(this).val());
                        if (!isNaN(value)) {
                            workingLengths.push(value);
                        }
                    });

                    if (workingLengths.length > 0) {
                        let maxLength = Math.max(...workingLengths);
                        let minLength = Math.min(...workingLengths);
                        let difference = maxLength - minLength;

                        // Check if the difference exceeds 0.05
                        if (difference > 0.05) {
                            // Show error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'The difference between the maximum and minimum Working Length exceeds 0.05!',
                            });
                            return false; // Indicate that there is an error
                        }
                    }
                    return true; // No error
                }

                function checkInvalid() {
                    // Check if there are any fields with the 'is-invalid' class
                    if ($('.is-invalid').length > 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please fill in all required fields correctly!',
                        });
                        return; // Prevent further action
                    }
                    saveData(); // Call your saveData function
                    if (<?= $page ?> == <?= session('jumlah_punch') ?>) {
                        $('#modal_confirm_pengukuran').modal('show');
                        // $('#modal_preview_pengukuran').modal('show');
                    } else {
                        form.submit();
                    }
                    // If no invalid fields, proceed with saving data
                }

                function saveData() {
                    $.ajax({
                        url: "{{route('pnd.pa.' . $route . '.store')}}",
                        type: "POST",
                        data: $('#form_data_pengukuran').serialize(),
                        success: function(response) {
                            // Handle success (e.g., show a success message, redirect, etc.)
                        },
                        error: function(xhr, status, error) {
                            // Handle error (e.g., show an error message)
                            // Re-enable the button if needed
                            document.querySelector("#btn-next button").disabled = false; // Re-enable the button
                            document.querySelector("#btn-next button").innerHTML = "Next"; // Reset button text
                        }
                    });
                }
            </script>
            <!--end::Content-->
@endsection
