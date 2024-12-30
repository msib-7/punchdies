@extends('layout.metronic')
@section('main-content')
<style>
    .table td {
        width: 20%; /* Adjust this value based on the number of columns */
        text-align: center; /* Center align text */
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
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="accordion" id="kt_accordion_1">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="kt_accordion_1_header_1">
                                            <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                                                <span class="fs-2 fw-bold">{{ strtoupper($labelDies->merk) }}</span>
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
                                                                                    Merk Dies
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">:
                                                                                </td>
                                                                                <td style="border: none;"
                                                                                    class="fs-5 px-4 my-4">
                                                                                    {{ strtoupper($labelDies->merk) }}</td>
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
                                                                                    {{ strtoupper($labelDies->bulan_pembuatan).' '.$labelDies->tahun_pembuatan }}</td>
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
                                                                                    {{ strtoupper($labelDies->nama_mesin_cetak) }}</td>
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
                                                                                    <?php if(strtoupper($labelDies->nama_produk) == strtoupper($labelDies->kode_produk)) {?>
                                                                                        {{ strtoupper($labelDies->nama_produk)}}
                                                                                    <?php } else {?>
                                                                                        {{ strtoupper($labelDies->nama_produk)."/".strtoupper($labelDies->kode_produk)}}
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
                                                                                    {{ ucwords($labelDies->masa_pengukuran) }}</td>
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
                                                                                    {{-- {{ $labelDies->created_at }} --}}
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
                                                                                    {{ ucwords($labelDies->username) }}</td>
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
                                    <form action="{{ route('pnd.pr.dies.store') }}"method="POST" enctype="multipart/form-data" id="form_data_pengukuran">
                                        @csrf
                                        <div class="card-header">
                                            <h3 class="card-title">Insert New Data</h3>
                                            <div class="card-toolbar">
                                                <input type="hidden" name="count_num" value="{{$page }}">
                                                <h5>
                                                    {{ $page }}/{{session('jumlah_dies')}}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="form_table" class="table display" style="width:100%">
                                                    <thead id="table_head">
                                                        <tr class="fw-bold fs-7 text-gray-800">
                                                            <td class="text-center">No</td>
                                                            <td class="text-center">Cincin Tidak Berbayang</td>
                                                            <td class="text-center">Tidak Gompal</td>
                                                            <td class="text-center">Tidak Retak</td>
                                                            <td class="text-center">Tidak Pecah</td>
                                                            <td class="text-center"></td>
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
                <img src="{{asset('assets/img/guide_dies.png')}}" style="height: -webkit-fill-available" alt="helper">
            </div>
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
                    <form action="{{route('pnd.pr.dies.create-note')}}" method="POST" enctype="multipart/form-data">
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
                                                <textarea class="form-control" id="kesimpulan" name="kesimpulan" rows="5" placeholder="Insert Your Message" required></textarea>
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

<script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    // Function to check orientation and update display
    function checkOrientation() {
        if (window.innerHeight > window.innerWidth) {
            // Portrait mode
            document.getElementById('kt_app_content').style.display = 'none'; // Hide content
            alert("Please rotate your device to landscape mode."); // Show alert
        } else {
            // Landscape mode
            document.getElementById('content').style.display = 'block'; // Show content
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
        // alert({{session('jumlah_ukur')}}); 

        //Table Body
        
        var tr = document.createElement('tr');

        //No
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = $count_header;
            foreach($draftPengukuran as $data){ ?>
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("class", "form-control text-center mb-2");
                x.setAttribute("type", "text");
                x.setAttribute("readonly", "readonly");
                x.setAttribute("value", "Punch <?= $no++?>");
            <?php }?>
            document.getElementById("table_body").appendChild(tr);
        //

        //Cincin Berbayang
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data) {
                $isCincinBerbayangValue = $draftPengukuran[$no]['is_cincin_berbayang'];
            ?>
                var select = td.appendChild(document.createElement('select'));
                select.setAttribute('class', 'form-select text-center mb-2');
                select.setAttribute('id', 'select_ok');
                select.setAttribute('name', 'icb[]');

                // Define options
                var options = ['-', 'OK', 'NOK'];

                // Create and append options
                options.forEach(function(optionValue) {
                    var option = document.createElement('option');
                    option.text = optionValue;
                    option.value = optionValue;
                    select.appendChild(option);

                    // Set the selected option based on the head_configuration value
                    if (optionValue === '<?= $isCincinBerbayangValue; ?>') {
                        option.selected = true;
                    }
                });

                // Append the select to the table body
                document.getElementById("table_body").appendChild(tr);
                <?php 
                $no++;
            }
            ?>
        //

        //Tidak Gompal
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data) {
                $isGompalValue = $draftPengukuran[$no]['is_gompal'];
            ?>
                var select = td.appendChild(document.createElement('select'));
                select.setAttribute('class', 'form-select text-center mb-2');
                select.setAttribute('id', 'select_ok');
                select.setAttribute('name', 'igp[]');

                // Define options
                var options = ['-', 'OK', 'NOK'];

                // Create and append options
                options.forEach(function(optionValue) {
                    var option = document.createElement('option');
                    option.text = optionValue;
                    option.value = optionValue;
                    select.appendChild(option);

                    // Set the selected option based on the head_configuration value
                    if (optionValue === '<?= $isGompalValue; ?>') {
                        option.selected = true;
                    }
                });

                // Append the select to the table body
                document.getElementById("table_body").appendChild(tr);
                <?php 
                $no++;
            }
            ?>
        //

        //Tidak Retak
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data) {
                $isRetakValue = $draftPengukuran[$no]['is_retak'];
            ?>
                var select = td.appendChild(document.createElement('select'));
                select.setAttribute('class', 'form-select text-center mb-2');
                select.setAttribute('id', 'select_ok');
                select.setAttribute('name', 'irt[]');

                // Define options
                var options = ['-', 'OK', 'NOK'];

                // Create and append options
                options.forEach(function(optionValue) {
                    var option = document.createElement('option');
                    option.text = optionValue;
                    option.value = optionValue;
                    select.appendChild(option);

                    // Set the selected option based on the head_configuration value
                    if (optionValue === '<?= $isRetakValue; ?>') {
                        option.selected = true;
                    }
                });

                // Append the select to the table body
                document.getElementById("table_body").appendChild(tr);
                <?php 
                $no++;
            }
            ?>
        //

        //Tidak Retak
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data) {
                $isPecahValue = $draftPengukuran[$no]['is_pecah'];
            ?>
                var select = td.appendChild(document.createElement('select'));
                select.setAttribute('class', 'form-select text-center mb-2');
                select.setAttribute('id', 'select_ok');
                select.setAttribute('name', 'ipc[]');

                // Define options
                var options = ['-', 'OK', 'NOK'];

                // Create and append options
                options.forEach(function(optionValue) {
                    var option = document.createElement('option');
                    option.text = optionValue;
                    option.value = optionValue;
                    select.appendChild(option);

                    // Set the selected option based on the head_configuration value
                    if (optionValue === '<?= $isPecahValue; ?>') {
                        option.selected = true;
                    }
                });

                // Append the select to the table body
                document.getElementById("table_body").appendChild(tr);
                <?php 
                $no++;
            }
            ?>
        //

        //Update id
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var a = td.appendChild(document.createElement('INPUT'));
                    a.setAttribute("type", "hidden");
                    a.setAttribute("name", "update_id[]");
                    a.setAttribute("value", "<?= $draftPengukuran[$no++]['no']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
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
            btn_next.setAttribute("type", "button");
            btn_next.setAttribute("onclick", "this.disabled=true; this.innerHTML ='Processing...'; form.submit();");
            if (<?= $page ?> == <?= session('jumlah_punch') ?>) {
                btn_next.setAttribute("onclick", "saveData()");
            }
            var title2 = document.createTextNode("Next");
            btn_next.appendChild(title2);

            // Append the button to the DOM
            document.getElementById("btn-next").appendChild(btn_next);
        //

        $(".inputs").keyup(function () {
            if (this.value.length == this.maxLength) {
                setTimeout(() => {
                    $(this).next('.inputs').focus();
                }, 500)
            }
        });
    });

    function saveData() {
        $.ajax({
            url: "{{route('pnd.pr.dies.store')}}",
            type: "POST",
            data: $('#form_data_pengukuran').serialize(),
            success: function(response) {
                $('#kesimpulan').val(response.kesimpulan);
                $('#modal_confirm_pengukuran').modal('show');
                // console.log(response.kesimpulan);
                
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
