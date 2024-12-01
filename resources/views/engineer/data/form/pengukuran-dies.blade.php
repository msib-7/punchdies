@extends('layout.metronic')
@section('main-content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
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
                                    <form action="{{ url('data/'.$jenis.'/pengukuran-awal/simpan') }}" method="POST" enctype="multipart/form-data" id="form_data_pengukuran">
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
                                            <table id="Table_pengukuran" class="display" style="width:100%">
                                                <thead id="table_head">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Outer Diameter</th>
                                                        <th>Inner Diameter 1</th>
                                                        <th>Inner Diameter 2</th>
                                                        <th>Ketinggian Dies</th>
                                                        <th>Visual</th>
                                                        <th>Kesesuaian Dies</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_body">
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

{{-- Create Data Punch Modal --}}
<div class="modal fade" tabindex="-1" id="modal_confirm_pengukuran">
    <div class="modal-dialog modal-dialog-centered">
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
                    <form action="{{url('data/'. $jenis .'/pengukuran-awal/simpan/note')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <label for="exampleFormControlInput1" class="required form-label">
                                        Catatan
                                    </label>
                                    <div class="form-floating mb-7">
                                        <textarea class="form-control" name="note" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px"></textarea>
                                        <label for="floatingTextarea">tambahkan catatan</label>
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
                x.setAttribute("value", "Dies <?= $no++?>");
            <?php }?>
            document.getElementById("table_body").appendChild(tr);
        //
        
        //Outer Diameter
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("maxlength", "4");
                x.setAttribute("name", "otd[]");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['outer_diameter']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Inner Diameter 1
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("maxlength", "4");
                x.setAttribute("name", "inn1[]");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['inner_diameter_1']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Inner Diameter 2
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("maxlength", "4");
                x.setAttribute("name", "inn2[]");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['inner_diameter_2']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Ketinggian Dies
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "inputs form-control text-center mb-2");
                x.setAttribute("maxlength", "4");
                x.setAttribute("name", "ktd[]");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['ketinggian_dies']; ?>");
                document.getElementById("table_body").appendChild(tr);
                <?php 
            }
            ?>
        //
            
        //Visual Dies
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var select = td.appendChild(document.createElement('select'));
                select.setAttribute('class', 'form-select text-center mb-2');
                select.setAttribute('id', 'select_ok');
                select.setAttribute('name', 'vis[]');
                select.setAttribute("value", "<?= $draftPengukuran[$no++]['visual']; ?>");
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
                document.getElementById("table_body").appendChild(tr);
                <?php 
            }
            ?>
        //

        //Kesesuaian Dies
            var td = tr.appendChild(document.createElement('td'));
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var select = td.appendChild(document.createElement('select'));
                select.setAttribute('class', 'form-select text-center mb-2');
                select.setAttribute('id', 'select_ok');
                select.setAttribute('name', 'ksd[]');
                select.setAttribute("value", "<?= $draftPengukuran[$no++]['kesesuaian_dies']; ?>");
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
                document.getElementById("table_body").appendChild(tr);
                <?php 
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
                    a.setAttribute("value", "<?= $draftPengukuran[$no++]['id']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Get Last Id per page
            var last_id = td.appendChild(document.createElement('INPUT'));
            last_id.setAttribute("type", "hidden");
            last_id.setAttribute("name", "last_id");
            last_id.setAttribute("value", "<?= $draftPengukuran[$no-1]['id']; ?>");
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
            if (<?= $page ?> == <?= session('jumlah_dies') ?>) {
                btn_next.setAttribute("onclick", "saveData()");
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
</script>
<script>
    function saveData() {
            $.ajax({
                url: "/data/<?= $jenis ?>/pengukuran-awal/simpan",
                type: "POST",
                data: $('#form_data_pengukuran').serialize(),
            })
        }
</script>
<!--end::Content-->
@endsection
