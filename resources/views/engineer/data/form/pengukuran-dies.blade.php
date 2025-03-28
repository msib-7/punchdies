@extends('layout.metronic')
@section('main-content')
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
                                                                                            {{ strtoupper($labelDies->bulan_pembuatan) . ' ' . $labelDies->tahun_pembuatan }}</td>
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
                                                                                            <?php if (strtoupper($labelDies->nama_produks->title) == strtoupper($labelDies->kode_produks->title)) {?>
                                                                                                {{ strtoupper($labelDies->nama_produks->title)}}
                                                                                            <?php } else {?>
                                                                                                {{ strtoupper($labelDies->nama_produks->title) . "/" . strtoupper($labelDies->kode_produks->title)}}
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
                                            <form action="{{ route('pnd.pa.dies.store') }}" method="POST" enctype="multipart/form-data" id="form_data_pengukuran">
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
                                                        <table id="form_table" class="display row-border">
                                                            <thead>
                                                                <tr class="fw-semibold fs-6 border-bottom border-gray-200">
                                                                    <th class="min-width-responsive text-center text-white align-center">No</th>
                                                                    <th class="min-width-responsive text-center text-white align-center">L. Outer Diameter</th>
                                                                    <th class="min-width-responsive text-center text-white align-center">M. Inner Diameter 1</th>
                                                                    <th class="min-width-responsive text-center text-white align-center">N. Inner Diameter 2</th>
                                                                    <th class="min-width-responsive text-center text-white align-center">O. Ketinggian Dies</th>
                                                                    <th class="min-width-responsive text-center text-white align-center">Visual</th>
                                                                    <th class="min-width-responsive text-center text-white align-center">Kesesuaian Dies</th>
                                                                    <th class="text-center"></th>
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

        {{-- Create Data Punch Modal --}}
        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" id="modal_confirm_pengukuran">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
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
                            <form action="{{route('pnd.pa.dies.create-note')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <input type="text" name="id" value="{{$labelDies->dies_id}}" hidden>
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
                                                                <td>
                                                                    <select name="kalibrasi_tools_1" aria-label="Select a Tool" data-control="select2" data-dropdown-parent="#modal_confirm_pengukuran" data-placeholder="Select a item..." class="form-select fw-bold" required>
                                                                        <option value="">Select Tool</option>
                                                                        @foreach ($kalibrasiTools as $item)
                                                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="date" name="tgl_kalibrasi_1" id="tgl_kalibrasi_1" class="form-control" required>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <select name="kalibrasi_tools_2" aria-label="Select a Tool" data-control="select2" data-dropdown-parent="#modal_confirm_pengukuran" data-placeholder="Select a item..." class="form-select fw-bold" required>
                                                                        <option value="">Select Tool</option>
                                                                        @foreach ($kalibrasiTools as $item)
                                                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="date" name="tgl_kalibrasi_2" id="tgl_kalibrasi_2" class="form-control" required>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <select name="kalibrasi_tools_3" aria-label="Select a Tool" data-control="select2" data-dropdown-parent="#modal_confirm_pengukuran" data-placeholder="Select a item..." class="form-select fw-bold" required>
                                                                        <option value="">Select Tool</option>
                                                                        @foreach ($kalibrasiTools as $item)
                                                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="date" name="tgl_kalibrasi_3" id="tgl_kalibrasi_3" class="form-control" required>
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
                        <button type="submit" class="btn btn-primary" onclick="showLoading()">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                // alert({{session('jumlah_ukur')}}); 
                //Table Body


                //No
                <?php
    $ch = $count_header;
    $no = 0;
    foreach ($draftPengukuran as $data) { ?>

                    var tr = document.createElement('tr');
                    var td = tr.appendChild(document.createElement('td'));
                    var x = td.appendChild(document.createElement('INPUT')); // Create a new input
                        x.setAttribute("class", "form-control text-center");
                        x.setAttribute("type", "button");
                        x.setAttribute("style", "cursor: pointer; font-size: 16px; font-weight: bold; border: none; background: transparent;");
                        x.setAttribute("value", "Dies <?= $ch++?>");
                        x.setAttribute("readonly", "readonly");

                    var td = tr.appendChild(document.createElement('td'));
                    var x = td.appendChild(document.createElement('INPUT'));
                    x.setAttribute("type", "text");
                    x.setAttribute("data-index", "<?= $no ?>");
                    x.setAttribute("class", "inputs form-control text-center");
                    x.setAttribute("maxlength", "{{ $form_setting->outer_diameter }}");
                    x.setAttribute("name", "otd[]");
                    x.setAttribute("style", "cursor: pointer;");
                    x.setAttribute("style", "background-color: #eaeaea; cursor: pointer;box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                    x.setAttribute("autocomplete", "off");
                    x.setAttribute("value", "<?= $draftPengukuran[$no]['outer_diameter']; ?>");

                    var td = tr.appendChild(document.createElement('td'));
                    var x = td.appendChild(document.createElement('INPUT'));
                    x.setAttribute("type", "text");
                    x.setAttribute("data-index", "<?= $no ?>");
                    x.setAttribute("class", "inputs form-control text-center");
                    x.setAttribute("maxlength", "{{ $form_setting->inner_diameter_1 }}");
                    x.setAttribute("name", "inn1[]");
                    x.setAttribute("style", "cursor: pointer;");
                    x.setAttribute("style", "background-color: #eaeaea; cursor: pointer;box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                    x.setAttribute("autocomplete", "off");
                    x.setAttribute("value", "<?= $draftPengukuran[$no]['inner_diameter_1']; ?>");

                    var td = tr.appendChild(document.createElement('td'));
                    var x = td.appendChild(document.createElement('INPUT'));
                    x.setAttribute("type", "text");
                    x.setAttribute("data-index", "<?= $no ?>");
                    x.setAttribute("class", "inputs form-control text-center");
                    x.setAttribute("maxlength", "{{ $form_setting->inner_diameter_2 }}");
                    x.setAttribute("name", "inn2[]");
                    x.setAttribute("style", "cursor: pointer;");
                    x.setAttribute("style", "background-color: #eaeaea; cursor: pointer;box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                    x.setAttribute("autocomplete", "off");
                    x.setAttribute("value", "<?= $draftPengukuran[$no]['inner_diameter_2']; ?>");

                    var td = tr.appendChild(document.createElement('td'));
                    var x = td.appendChild(document.createElement('INPUT'));
                    x.setAttribute("type", "text");
                    x.setAttribute("data-index", "<?= $no ?>");
                    x.setAttribute("class", "inputs form-control text-center");
                    x.setAttribute("maxlength", "{{ $form_setting->ketinggian_dies }}");
                    x.setAttribute("name", "ktd[]");
                    x.setAttribute("style", "cursor: pointer;");
                    x.setAttribute("style", "background-color: #eaeaea; cursor: pointer;box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                    x.setAttribute("autocomplete", "off");
                    x.setAttribute("value", "<?= $draftPengukuran[$no]['ketinggian_dies']; ?>");

                    var td = tr.appendChild(document.createElement('td'));
                    var select = td.appendChild(document.createElement('select'));
                    select.setAttribute('class', 'form-select text-center');
                    select.setAttribute("style", "background-color: #eaeaea; cursor: pointer;box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                    select.setAttribute('id', 'select_ok');
                    select.setAttribute('name', 'vis[]');
                    select.setAttribute("value", "<?= $draftPengukuran[$no]['visual']; ?>");
                    var option_null = document.createElement('option');
                    var option_ok = document.createElement('option');
                    var option_nok = document.createElement('option');
                    option_null.text = '-';
                    option_null.setAttribute('value', '-')
                    option_ok.text = 'OK';
                    option_ok.setAttribute('value', 'OK')
                    option_nok.text = 'NOK';
                    option_nok.setAttribute('value', 'NOK')
                    select.appendChild(option_null);
                    select.appendChild(option_ok);
                    select.appendChild(option_nok);

                    var td = tr.appendChild(document.createElement('td'));
                    var select = td.appendChild(document.createElement('select'));
                    select.setAttribute('class', 'form-select text-center');
                    select.setAttribute("style", "background-color: #eaeaea; cursor: pointer;box-shadow: inset 0px 0px 7px 1px rgba(0, 0, 0, 0.1);");
                    select.setAttribute('id', 'select_ok');
                    select.setAttribute('name', 'ksd[]');
                    select.setAttribute("value", "<?= $draftPengukuran[$no]['kesesuaian_dies']; ?>");
                    var option_null = document.createElement('option');
                    var option_ok = document.createElement('option');
                    var option_nok = document.createElement('option');
                    option_null.text = '-';
                    option_null.setAttribute('value', '-')
                    option_ok.text = 'OK';
                    option_ok.setAttribute('value', 'OK')
                    option_nok.text = 'NOK';
                    option_nok.setAttribute('value', 'NOK')
                    select.appendChild(option_null);
                    select.appendChild(option_ok);
                    select.appendChild(option_nok);

                    var td = tr.appendChild(document.createElement('td'));
                    var a = td.appendChild(document.createElement('INPUT'));
                    a.setAttribute("type", "hidden");
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
                    btn_cancel.setAttribute("href", "{{route('pnd.pa.dies.index')}}");
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

                // $(".inputs").keyup(function () {
                //     if (this.value.length == this.maxLength) {
                //         $(this).next('.inputs').focus();
                //     }
                // });

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
                if (<?= $page ?> == <?= session('jumlah_dies') ?>) {
                    $('#modal_confirm_pengukuran').modal('show');
                    // $('#modal_preview_pengukuran').modal('show');
                } else {
                    form.submit();
                }
                // If no invalid fields, proceed with saving data
            }

            function saveData() {
                $.ajax({
                    url: "{{route('pnd.pa.dies.store')}}",
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
