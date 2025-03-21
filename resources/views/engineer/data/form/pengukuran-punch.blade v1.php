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
                                    <form action="{{ url('data/'.$jenis.'/pengukuran-awal/simpan') }}" method="POST" enctype="multipart/form-data" id="form_data_pengukuran">
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
        $(".inputs").keyup(function () {
            if (this.value.length == this.maxLength) {
                $(this).next('.inputs').focus();
            }
        });

        //Table Head
            var tr = document.createElement('tr');
            var th = tr.appendChild(document.createElement('th'));
            var no = th.appendChild(document.createTextNode("No"));
            th.appendChild(no);
            // for (var j = 1; j <= {{ $count }} ; j++) {
            <?php
            $no = $count_header;
            foreach($draftPengukuran as $data){ ?>
                // tr.setAttribute('id', 'tr-'+j);
                var no_punch = '<?= $no++ ?>';
                var th = tr.appendChild(document.createElement('th'));
                var z = th.appendChild(document.createTextNode("Punch "+no_punch));
                // z.setAttribute("class", "text-center");
                document.getElementById("table_head").appendChild(tr);
            <?php 
            }
            ?>
            // };
        //

        //Table Body
        
        //Head Outer Diameter
            var tr = document.createElement('tr');
            var td = tr.appendChild(document.createElement('td'));
            var hod = td.appendChild(document.createTextNode("Head Outer Diameter"));
            td.appendChild(hod);
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var td = tr.appendChild(document.createElement('td'));
                //Update_id
                    var a = td.appendChild(document.createElement('INPUT'));
                    a.setAttribute("type", "hidden");
                    a.setAttribute("name", "update_id[]");
                    a.setAttribute("value", "<?= $draftPengukuran[$no]['id']; ?>");
                //End Update id

                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("class", "form-control text-center inputs");
                x.setAttribute("type", "text");
                x.setAttribute("maxlength", "4");
                x.setAttribute("name", "hdo[]");
                x.setAttribute("id", "hdo<?=$no?>");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("onkeypress", "checkMaxHod(<?=$no?>)");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['head_outer_diameter']; ?>");
                document.getElementById("table_body").appendChild(tr);
                <?php 
            }
            ?>
            //
            
        //Neck Diameter
            var tr = document.createElement('tr');
            var td = tr.appendChild(document.createElement('td'));
            var ned = td.appendChild(document.createTextNode("Neck Diameter"));
            td.appendChild(ned);
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "form-control text-center");
                x.setAttribute("name", "ned[]");
                x.setAttribute("id", "ned<?=$no?>");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("maxlength", "3");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['neck_diameter']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Barrel
            var tr = document.createElement('tr');
            var td = tr.appendChild(document.createElement('td'));
            var bar = td.appendChild(document.createTextNode("Barrel"));
            td.appendChild(bar);
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "form-control text-center");
                x.setAttribute("name", "bar[]");
                x.setAttribute("id", "bar<?=$no?>");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['barrel']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Overall Length
            var tr = document.createElement('tr');
            var td = tr.appendChild(document.createElement('td'));
            var ovl = td.appendChild(document.createTextNode("Overall Length"));
            td.appendChild(ovl);
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "form-control text-center");
                x.setAttribute("name", "ovl[]");
                x.setAttribute("id", "ovl<?=$no?>");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['overall_length']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Tip Diameter 1
            var tr = document.createElement('tr');
            var td = tr.appendChild(document.createElement('td'));
            var tip1 = td.appendChild(document.createTextNode("Tip Diameter 1"));
            td.appendChild(tip1);
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "form-control text-center");
                x.setAttribute("name", "tip1[]");
                x.setAttribute("id", "tip1<?=$no?>");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['tip_diameter_1']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Tip Diameter 2
            var tr = document.createElement('tr');
            var td = tr.appendChild(document.createElement('td'));
            var tip2 = td.appendChild(document.createTextNode("Tip Diameter 2"));
            td.appendChild(tip2);
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "form-control text-center");
                x.setAttribute("name", "tip2[]");
                x.setAttribute("id", "tip2<?=$no?>");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['tip_diameter_2']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Cup Depth
            var tr = document.createElement('tr');
            var td = tr.appendChild(document.createElement('td'));
            var cup = td.appendChild(document.createTextNode("Cup Depth"));
            td.appendChild(cup);
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "form-control text-center");
                x.setAttribute("name", "cup[]");
                x.setAttribute("id", "cup<?=$no?>");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['cup_depth']; ?>");
                document.getElementById("table_body").appendChild(tr);
            <?php 
            }
            ?>
        //

        //Working Length
            var tr = document.createElement('tr');
            var td = tr.appendChild(document.createElement('td'));
            var wkl = td.appendChild(document.createTextNode("Working Length"));
            td.appendChild(wkl);
            <?php
            $no = 0;
            foreach($draftPengukuran as $data){ ?>
                var td = tr.appendChild(document.createElement('td'));
                var x = td.appendChild(document.createElement('INPUT'));
                x.setAttribute("type", "text");
                x.setAttribute("class", "form-control text-center");
                x.setAttribute("name", "wkl[]");
                x.setAttribute("id", "wkl<?=$no?>");
                x.setAttribute("placeholder", "00.00");
                x.setAttribute("value", "<?= $draftPengukuran[$no++]['working_length']; ?>");
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
            if (<?= $page ?> == <?= session('jumlah_punch') ?>) {
                btn_next.setAttribute("onclick", "saveData()");
                btn_next.setAttribute("type", "button");
                btn_next.setAttribute("data-bs-toggle", "modal");
                btn_next.setAttribute("data-bs-target", "#modal_confirm_pengukuran");
            }
            var title2 = document.createTextNode("Next");
            btn_next.appendChild(title2);
            document.getElementById("btn-next").appendChild(btn_next);
        //


        var myinp = document.querySelectorAll(".inputs");
        // var maxl_hdo = document.getElementById('hdo').maxLength;
        // console.log(maxl_hdo);
        
        // var l = 1;
        // while(l < maxl_hdo) {
        //     if(l < maxl_hdo){
        //         l++;
        //     }else{
        //         myinp[i].addEventListener("keyup", function() {
        //             this.nextElementSibling.focus();
        //         })
        //     }
        // }
        console.log(myinp);
        for ( var i =0; i = myinp ; i++){
            myinp[i].addEventListener("keyup", function() {
                this.nextElementSibling.focus();
            })
        }
        
    });

    function saveData() {
            $.ajax({
                url: "/data/<?= $jenis ?>/pengukuran-awal/simpan",
                type: "POST",
                data: $('#form_data_pengukuran').serialize(),
            })
        }
    
    function checkMaxHod(i){
        var dom = document.getElementById("hod" + i);
        if (!dom) return; // Ensure the current element exists

        var ml = dom.maxLength || dom.getAttribute("maxlength"); // Safely get maxLength
        var lg = dom.value.length;

        if (lg >= ml) {
            var nextDom = document.getElementById("hod" + (i + 1));
            if (nextDom) {
                nextDom.focus();
            }
        }
    }
</script>
<!--end::Content-->
@endsection
