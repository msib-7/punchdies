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
                                            <table id="Table_pengukuran" class="display" style="width:100%">
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
                <img src="data:image/png;base64,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" 
                style="height: -webkit-fill-available" alt="helper">
            </div>
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

        //Overall Length
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("name", "ovl[]");
                x.setAttribute("maxlength", "4");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['overall_length']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Working Length Awal
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ 
                $wklRutin = $draftPengukuranPre[$no]['working_length_rutin'];
                ?>
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
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
                <?php } $no++; ?>
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Working Length Rutin
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("name", "wkl_rutin[]");
                x.setAttribute("maxlength", "4");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['working_length_rutin']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Cup Depth
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("name", "cup[]");
                x.setAttribute("maxlength", "4");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['cup_depth']; ?>");
                // x.addEventListener('input', function() {
                //     if (this.value) {
                //         saveDataRutin();
                //     }
                // });
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Head Configuration
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data) {
                // Get the head_configuration value from PHP
                $headConfigurationValue = $draftPengukuran[$no]['head_configuration'];
            ?>
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
                    if (optionValue === '<?= $headConfigurationValue; ?>') {
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
                    a.setAttribute("value", "<?= $draftPengukuran[$no]['no']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            $no++;
            }
            ?>
        //

        //Get Last Id per page
            var last_id = td.appendChild(document.createElement('INPUT'));
            last_id.setAttribute("type", "text");
            last_id.setAttribute("name", "last_id");
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

        //Create Button Next
            var btn_next = document.createElement("BUTTON");
            btn_next.setAttribute("class", "btn btn-primary btn-small");
            btn_next.setAttribute("type", "submit");
            if (<?= $page ?> == <?= session('jumlah_punch') ?>) {
                btn_next.setAttribute("onclick", "saveDataRutin()");
                btn_next.setAttribute("type", "button");
                btn_next.setAttribute("data-bs-toggle", "modal");
                btn_next.setAttribute("data-bs-target", "#modal_confirm_pengukuran");
            }
            var title2 = document.createTextNode("Next");
            btn_next.appendChild(title2);
            document.getElementById("btn-next").appendChild(btn_next);
        //

        $(".inputs").keyup(function () {
            if (this.value.length == this.maxLength) {
                $(this).next('.inputs').focus();
            }
        }); 
        
    });

    function saveDataRutin() {
        $.ajax({
            url: "{{route('pnd.pr.'.$route.'.store')}}",
            type: "POST",
            data: $('#form_data_pengukuran').serialize(),
            success: function(response) {
                // Reload the table data after successful save
                $('#Table_pengukuran').DataTable().ajax.reload();
                alert('Data saved successfully!');
            },
            error: function(xhr, status, error) {
                console.error('Error saving data:', error);
                alert('Failed to save data. Please try again.');
            }
        });
    }

    $('#Table_pengukuran').DataTable({
        ajax: {
            url: "{{ route('pnd.pr.'.$route.'.form') }}", // Adjust this route to fetch data
            type: "GET",
            dataSrc: ""
        },
        columns: [
            { data: "No" },
            { data: "OverallLength" },
            { data: "WorkingLengthAwal" },
            { data: "WorkingLengthRutin" },
            { data: "CupDepth" },
            { data: "HeadConfiguration" },
        ]
    });
</script>
<!--end::Content-->
@endsection
