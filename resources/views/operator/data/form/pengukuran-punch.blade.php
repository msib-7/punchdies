@extends('layout.metronic')
@section('main-content')
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
            <div class="card">
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
                                    <form action="{{ route('pnd.pr.'.$route.'.store') }}" method="POST" enctype="multipart/form-data" id="form_data_pengukuran">
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
                                            <table id="form_table" class="display" style="width:100%">
                                                <thead id="table_head">
                                                    <tr class="fw-bold fs-7 text-gray-800">
                                                        <td class="text-center">No</td>
                                                        <td class="text-center">G. Overall Length</td>
                                                        <td class="text-center">L. Working Length <br> <b>(AWAL)</b></td>
                                                        <td class="text-center">L. Working Length <br> <b>(RUTIN)</b></td>
                                                        <td class="text-center">K. Cup Depth</td>
                                                        <td class="text-center">Head Configuration</td>
                                                        <td class="text-center"></td>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_body">
                                                    {{-- <tr>
                                                        <td>
                                                            <input type="text" class="form-control" readonly value="Punch 1">
                                                            <input type="text" class="form-control" readonly value="Punch 2">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="inputs form-control text-center mb-2" maxlength="4">
                                                            <input type="text" class="inputs form-control text-center mb-2" maxlength="4">
                                                        </td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
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
            <img src="{{asset('assets/img/standar_rutin.png')}}" style="max-width: 200px" alt="rule">
        </div>
    </div>
</div>
<!--end::Bantuan Pengukuran-->
{{-- Create Data Punch Modal --}}
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
                <div class="col-12">
                    <form action="{{route('pnd.pr.'.$route.'.create-note')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                        <div class="card-body">
                            <div class="row">
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
        //Table Body

        //No
        <?php
        $ch = $count_header;
        $no = 0;
        foreach($draftPengukuran as $data){ ?>

            var tr = document.createElement('tr');
            
            //NO
            var td = tr.appendChild(document.createElement('td'));
            var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("class", "form-control text-center mb-2");
                x.setAttribute("data-index", "<?= $no ?>");
                x.setAttribute("readonly", "readonly");
                x.setAttribute("style", "cursor: not-allowed;");
                x.setAttribute("value", "Punch <?= $ch++?>");
            

            //G. Overall Length
            var td = tr.appendChild(document.createElement('td'));
            var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("data-index", "<?= $no ?>");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("name", "ovl[]");
                x.setAttribute("maxlength", "4");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no]['overall_length']; ?>");
            
            //L. Working Length (AWAL)
            var td = tr.appendChild(document.createElement('td'));
            <?php $wklRutin = $draftPengukuranPre[$no]['working_length_rutin']; ?>
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("data-index", "<?= $no ?>");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("name", "wkl_awal[]");
                x.setAttribute("maxlength", "4");
                x.setAttribute("readonly", "readonly");
                x.setAttribute("placeholder", "00.00");
                <?php
                if($wklRutin == null){ ?>
                    x.setAttribute("value", "<?= $draftPengukuranPre[$no]['working_length']; ?>");
                <?php }else{ ?>
                    x.setAttribute("value", "<?= $draftPengukuranPre[$no]['working_length_rutin']; ?>");
                <?php } ?>

            //L. Working Length (RUTIN)
            var td = tr.appendChild(document.createElement('td'));
            var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("readonly", "readonly");
                x.setAttribute("name", "wkl_rutin[]");
                x.setAttribute("maxlength", "4");
                x.setAttribute("value", "<?= $draftPengukuran[$no]['working_length_rutin']; ?>");

            //K. Cup Depth
            var td = tr.appendChild(document.createElement('td'));
            var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("data-index", "<?= $no ?>");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("name", "cup[]");
                x.setAttribute("maxlength", "4");
                x.setAttribute("value", "<?= $draftPengukuran[$no]['cup_depth']; ?>");

            //Head Configuration
            var td = tr.appendChild(document.createElement('td'));
            // Get the head_configuration value from PHP
            var select = td.appendChild(document.createElement('select'));
            select.setAttribute('class', 'form-select text-center mb-2');
            select.setAttribute('id', 'select_ok');
            select.setAttribute('name', 'hcf[]');

            // Define options
            var options = ['-', 'OK', 'NOK'];

            // Create and append options
            options.forEach(function(optionValue) {
                var option = document.createElement('option');
                option.text = optionValue;
                option.value = optionValue;
                select.appendChild(option);

                // Set the selected option based on the head_configuration value
                if (optionValue === '<?= $draftPengukuran[$no]['head_configuration']; ?>') {
                    option.selected = true;
                }
            });

            //Update ID
            var td = tr.appendChild(document.createElement('td'));
            var a = td.appendChild(document.createElement('INPUT'));
                a.setAttribute("type", "hidden");
                a.setAttribute("readonly", "readonly");
                a.setAttribute("name", "update_id[]");
                a.setAttribute("value", "<?= $draftPengukuran[$no]['no']; ?>");

                
            document.getElementById("table_body").appendChild(tr);
        <?php $no++; }?>
        //

        //Get Last Id per page
            var last_id = td.appendChild(document.createElement('INPUT'));
            last_id.setAttribute("type", "hidden");
            last_id.setAttribute("name", "last_id");
            last_id.setAttribute("value", "<?= $draftPengukuran[$no-1]['no']; ?>");
            document.getElementById("last_id").appendChild(last_id);
        //    
        //Get Last Id per page
            var last_id = td.appendChild(document.createElement('INPUT'));
            last_id.setAttribute("type", "hidden");
            last_id.setAttribute("name", "last_id_pre");
            last_id.setAttribute("value", "<?= $draftPengukuranPre[$no-1]['no']; ?>");
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

        function convertToDecimal(input) {
            // Get the value of the input field
            var value = parseFloat(input.value);
            
            // Check if the value is a valid number
            if (!isNaN(value)) {
                // Format the value to 2 decimal places
                input.value = value.toFixed(2);
            }
        }


        // $(".inputs").keyup(function () {
        //     if (this.value.length == this.maxLength) {
        //         $(this).next('.inputs').focus();
        //     }
        // }); 
        
    });

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
            url: "{{route('pnd.pr.'.$route.'.store')}}",
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

    // function saveDataRutin() {
    //     $.ajax({
    //         url: "{{route('pnd.pr.'.$route.'.store')}}",
    //         type: "POST",
    //         data: $('#form_data_pengukuran').serialize(),
    //         success: function(response) {
    //             // Reload the table data after successful save
    //             $('#Table_pengukuran').DataTable().ajax.reload();
    //             alert('Data saved successfully!');
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Error saving data:', error);
    //             alert('Failed to save data. Please try again.');
    //         }
    //     });
    // }
</script>
<!--end::Content-->
@endsection
