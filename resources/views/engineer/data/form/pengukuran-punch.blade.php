@extends('layout.metronic')
@section('main-content')
<style>
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
    #form_table tbody tr:nth-child(odd) {
        background-color: gainsboro; /* Darker gray for odd rows */
        border-radius: 10px; /* Adjust the value as needed for rounding */
    }

    /* Style for even rows */
    #form_table tbody tr:nth-child(even) {
        background-color: whitesmoke; /* Light gray for even rows */
        border-radius: 10px; /* Adjust the value as needed for rounding */
    }

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
        background-color: burlywood; /* Change this to your desired header background color */
        color: white; /* Change this to your desired text color */
    }

    /* Style for the table cells */
    #form_table th, #form_table td {
        border: 1px solid #dee2e6; /* Add border to cells */
        border-radius: 0; /* Reset border-radius for cells */
    }

    /* Optional: Add rounded corners to the first and last cells of the header and body */
    #form_table thead th:first-child {
        border-top-left-radius: 10px; /* Top left corner */
    }

    #form_table thead th:last-child {
        border-top-right-radius: 10px; /* Top right corner */
    }

    #form_table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 10px; /* Bottom left corner */
    }

    #form_table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 10px; /* Bottom right corner */
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
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="accordion" id="kt_accordion_1">
                                    <div class="accordion-item ribbon ribbon-end ribbon-clip">
                                        <div class="ribbon-label">
                                            <span class="fw-semibold"><?= $statusPengukuran?></span>
                                            <span class="ribbon-inner bg-warning"></span>
                                        </div>
                                        <h2 class="accordion-header" id="kt_accordion_1_header_1">
                                            <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                                                <span class="fs-2 fw-bold">{{ strtoupper($labelPunch->merk) }}</span>
                                            </button>
                                        </h2>
                                        
                                        <div id="kt_accordion_1_body_1" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="table-responsive">
                                                                    <table style="border: none;">
                                                                        <tbody>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Merk Punch
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    {{ strtoupper($labelPunch->merk) }}</td>
                                                                            </tr>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Bulan/Tahun Pembuatan
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    {{ strtoupper($labelPunch->bulan_pembuatan).' '.$labelPunch->tahun_pembuatan }}</td>
                                                                            </tr>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Nama Mesin Cetak
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    {{ strtoupper($labelPunch->nama_mesin_cetak) }}</td>
                                                                            </tr>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Kode/Nama Produk
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    <?php if(strtoupper($labelPunch->nama_produk) == strtoupper($labelPunch->kode_produk)) {?>
                                                                                        {{ strtoupper($labelPunch->nama_produk)}}
                                                                                    <?php } else {?>
                                                                                        {{ strtoupper($labelPunch->nama_produk)."/".strtoupper($labelPunch->kode_produk)}}
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
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Masa Pengukuran
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    {{ ucwords($labelPunch->masa_pengukuran) }}</td>
                                                                            </tr>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Tanggal Pengukuran
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    {{ date_format($tglPengukuran->created_at, 'd M Y') }}
                                                                                    {{-- {{ $labelPunch->created_at }} --}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Diukur oleh
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    {{ ucwords($labelPunch->username) }}</td>
                                                                            </tr>
                                                                            <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    Status
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    <?php echo $statusPengukuran?>
                                                                                </td>
                                                                            </tr>
                                                                            {{-- <tr style="border: none; height: 30px;">
                                                                                <td style="border: none;" class="fs-3 px-4 my-4"
                                                                                    colspan="3">
                                                                                    <span
                                                                                        class="badge badge-light-success fs-5">Approved</span>
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
                                    <form action="{{ route('pnd.pa.'.$route.'.store') }}" method="POST" enctype="multipart/form-data" id="form_data_pengukuran">
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
                                                <table id="form_table" class="display" style="width:100%">
                                                    <thead id="table_head">
                                                        <tr>
                                                            <th class="min-width-responsive text-center">No</th>
                                                            <th class="min-width-responsive text-center">A. Head Outer Diameter</th>
                                                            <th class="min-width-responsive text-center">E. Neck Diameter</th>
                                                            <th class="min-width-responsive text-center">F. Barrel</th>
                                                            <th class="min-width-responsive text-center">G. Overall Length</th>
                                                            <th class="min-width-responsive text-center">I. Tip Diameter 1</th>
                                                            <th class="min-width-responsive text-center">J. Tip Diameter 2</th>
                                                            <th class="min-width-responsive text-center">K. Cup Depth</th>
                                                            <th class="min-width-responsive text-center">L. Working Length</th>
                                                            <td class="text-center hidden"></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_body">
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
                                                    <input class="form-check-input" name="CheckBoxDraft" type="checkbox" value="enabled" id="flexSwitch" checked='checked'/>
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
                    </div>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content container-->
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
                    <form action="{{route('pnd.pa.'.$route.'.create-note')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <input type="text" name="id" value="{{$labelPunch->punch_id}}" hidden>
                                <div class="col-12">
                                    <div class="d-flex flex-column mx-2">
                                        <label for="referensi_drawing" class="required form-label">Referensi Drawing</label>
                                        <input type="text" class="form-control" id="referensi_drawing" name="referensi_drawing" placeholder="Insert Reference Drawing" required />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12 mt-3">
                                            <div class="d-flex flex-column mx-2">
                                                <label for="catatan" class="required form-label">Catatan</label>
                                                <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Insert Your Message" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="d-flex flex-column mx-2">
                                                <label for="kesimpulan" class="required form-label">Kesimpulan</label>
                                                <textarea class="form-control" id="kesimpulan" name="kesimpulan" rows="3" placeholder="Insert Your Message" required></textarea>
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
                                                        <td>Micrometer Digital</td>
                                                        <td>
                                                            <input type="date" name="micrometer_digital" id="micrometer_digital" class="form-control" required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Caliper Digital</td>
                                                        <td>
                                                            <input type="date" name="caliper_digital" id="caliper_digital" class="form-control" required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Dial Indicator Digital</td>
                                                        <td>
                                                            <input type="date" name="dial_indicator_digital" id="dial_indicator_digital" class="form-control" required>
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

            // Check Micrometer Digital
            if ($('#micrometer_digital').val() === '') {
                alert('Micrometer Digital calibration date is required.');
                isValid = false;
            }

            // Check Caliper Digital
            if ($('#caliper_digital').val() === '') {
                alert('Caliper Digital calibration date is required.');
                isValid = false;
            }

            // Check Dial Indicator Digital
            if ($('#dial_indicator_digital').val() === '') {
                alert('Dial Indicator Digital calibration date is required.');
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
            foreach($draftPengukuran as $data){ ?>

                // No Punch
                var tr = document.createElement('tr'); // Create a new row
                var td = tr.appendChild(document.createElement('td')); // Create a new column
                var x = td.appendChild(document.createElement('INPUT')); // Create a new input
                x.setAttribute("class", "form-control text-center mb-2 ");
                x.setAttribute("type", "text");
                x.setAttribute("readonly", "readonly");
                x.setAttribute("style", "cursor: not-allowed;");
                x.setAttribute("value", "Punch <?= $ch++?>");

                // Head Outer Diameter
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("data-index", "<?= $no ?>");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("maxlength", "6");
                x.setAttribute("id", "hdo<?=$no?>");
                x.setAttribute("name", "hdo[]");    
                // x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no]['head_outer_diameter']; ?>");
                // x.setAttribute("onkeypress", "return event.keyCode != 13;");
                x.setAttribute("style", "cursor: pointer;");
                <?php if($no == 10){ ?>
                    x.setAttribute("onkeyup", "saveData()");
                <?php } ?>

                // Neck Diameter
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("data-index", "<?= $no ?>");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("name", "ned[]");
                x.setAttribute("id", "ned<?=$no?>");
                // x.setAttribute("placeholder", "00.00");
                x.setAttribute("maxlength", "4");
                x.setAttribute("value", "<?= $draftPengukuran[$no]['neck_diameter']; ?>");
                // x.setAttribute("onkeypress", "return event.keyCode != 13;");
                x.setAttribute("style", "cursor: pointer;");
                <?php if($no == 10){ ?>
                    x.setAttribute("onkeyup", "saveData()");
                <?php } ?>

                // Barrel
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("data-index", "<?= $no ?>");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("name", "bar[]");
                x.setAttribute("id", "bar<?=$no?>");
                x.setAttribute("maxlength", "4");
                // x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no]['barrel']; ?>");
                // x.setAttribute("onkeypress", "return event.keyCode != 13;");
                x.setAttribute("style", "cursor: pointer;");
                <?php if($no == 10){ ?>
                    x.setAttribute("onkeyup", "saveData()");
                <?php } ?>

                // Overall Length
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("data-index", "<?= $no ?>");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("name", "ovl[]");
                x.setAttribute("id", "ovl<?=$no?>");
                x.setAttribute("maxlength", "4");
                // x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no]['overall_length']; ?>");
                // x.setAttribute("onkeypress", "return event.keyCode != 13;");
                x.setAttribute("style", "cursor: pointer;");
                <?php if($no == 10){ ?>
                    x.setAttribute("onkeyup", "saveData()");
                <?php } ?>

                // Tip Diameter 1
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("data-index", "<?= $no ?>");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("name", "tip1[]");
                x.setAttribute("id", "tip1<?=$no?>");
                x.setAttribute("maxlength", "4");
                // x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no]['tip_diameter_1']; ?>");
                // x.setAttribute("onkeypress", "return event.keyCode != 13;");
                x.setAttribute("style", "cursor: pointer;");
                <?php if($no == 10){ ?>
                    x.setAttribute("onkeyup", "saveData()");
                <?php } ?>

                // Tip Diameter 2
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("data-index", "<?= $no ?>");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("name", "tip2[]");
                x.setAttribute("id", "tip2<?=$no?>");
                x.setAttribute("maxlength", "4");
                // x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no]['tip_diameter_2']; ?>");
                // x.setAttribute("onkeypress", "return event.keyCode != 13;");
                x.setAttribute("style", "cursor: pointer;");
                <?php if($no == 10){ ?>
                    x.setAttribute("onkeyup", "saveData()");
                <?php } ?>

                // Cup Depth
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("data-index", "<?= $no ?>");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("name", "cup[]");
                x.setAttribute("id", "cup<?=$no?>");
                x.setAttribute("maxlength", "4");
                // x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no]['cup_depth']; ?>");
                // x.setAttribute("onkeypress", "return event.keyCode != 13;");
                x.setAttribute("style", "cursor: pointer;");
                <?php if($no == 10){ ?>
                    x.setAttribute("onkeyup", "saveData()");
                <?php } ?>

                // Working Length
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("data-index", "<?= $no ?>");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("name", "wkl[]");
                x.setAttribute("id", "wkl<?=$no?>");
                x.setAttribute("maxlength", "6");
                // x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no]['working_length']; ?>");
                // x.setAttribute("onkeypress", "return event.keyCode != 13;");
                x.setAttribute("style", "cursor: pointer;");
                <?php if($no == 10){ ?>
                    x.setAttribute("onkeyup", "saveData()");
                <?php } ?>

                // Update Id
                var td = tr.appendChild(document.createElement('td'));
                var a = td.appendChild(document.createElement('INPUT'));
                    a.setAttribute("type", "hidden");
                    a.setAttribute("readonly", "readonly");
                    a.setAttribute("name", "update_id[]");
                    a.setAttribute("value", "<?= $draftPengukuran[$no]['no']; ?>");
                
                document.getElementById("table_body").appendChild(tr);
        <?php $no++; } ?>

        //
        //Get Last Id per page
            var last_id = td.appendChild(document.createElement('INPUT'));
            last_id.setAttribute("type", "hidden");
            last_id.setAttribute("name", "last_id");
            last_id.setAttribute("value", "<?= $draftPengukuran[$no-1]['no']; ?>");
            document.getElementById("last_id").appendChild(last_id);
        //    

        //Create Button Cancel
            var btn_cancel = document.createElement("BUTTON");
            btn_cancel.setAttribute("class", "btn btn-secondary btn-small");
            btn_cancel.setAttribute("type", "button");
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
            
            var title2 = document.createTextNode("Next");
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
            url: "{{route('pnd.pa.'.$route.'.store')}}",
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
