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
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table style="border: none;">
                                                                <tbody>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">
                                                                            Merk Punch
                                                                        </td>
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">
                                                                            ALTINEX</td>
                                                                    </tr>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">
                                                                            Bulan/Tahun Pembuatan
                                                                        </td>
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">
                                                                            JUNI 2024</td>
                                                                    </tr>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">
                                                                            Nama Mesin Cetak
                                                                        </td>
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">
                                                                            JCMCO</td>
                                                                    </tr>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">
                                                                            Kode/Nama Produk
                                                                        </td>
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">
                                                                            TCRV3</td>
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
                                                                            class="fs-3 px-4 my-4">
                                                                            Pengukuran Terakhir
                                                                        </td>
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">
                                                                            Pengukuran Awal</td>
                                                                    </tr>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">
                                                                            Tanggal Pengukuran
                                                                        </td>
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">:
                                                                        </td>
                                                                        <td style="border: none;"
                                                                            class="fs-3 px-4 my-4">
                                                                            14 Juli 2024</td>
                                                                    </tr>
                                                                    <tr style="border: none; height: 30px;">
                                                                        <td style="border: none;" class="fs-3 px-4 my-4"
                                                                            colspan="3">
                                                                            <span
                                                                                class="badge badge-light-success fs-5">Approved</span>
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
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Insert New Data</h3>
                                        <div class="card-toolbar">
                                            10/{{session('jumlah_punch')}}
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
<script>
    $(document).ready(function () {
        // alert({{session('jumlah_ukur')}}); 

        //Table Head
        var tr = document.createElement('tr');
        var th = tr.appendChild(document.createElement('th'));
        var no = th.appendChild(document.createTextNode("No"));
        // no.setAttribute("style", "min-width:10vw;");
        th.appendChild(no);
        for (var j = 1; j <= {{ $count }} ; j++) {
            // tr.setAttribute('id', 'tr-'+j);
            var th = tr.appendChild(document.createElement('th'));
            var z = th.appendChild(document.createTextNode("Punch "+j));
            // z.setAttribute("class", "text-center");
            document.getElementById("table_head").appendChild(tr);
        };


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
            var x = td.appendChild(document.createElement('INPUT'));
            x.setAttribute("type", "number");
            x.setAttribute("class", "form-control text-center");
            x.setAttribute("name", "hdo-<?= $draftPengukuran[$no]['id'];?>");
            x.setAttribute("placeholder", "00.00");
            x.setAttribute("value", "<?= $draftPengukuran[$no++]['head_outer_diameter']; ?>");
            document.getElementById("table_body").appendChild(tr);
        <?php 
        }
        ?>
        // for(j = 0; j <= <?= $count; $no=0+1; ?> ; j++) {
            // tr.setAttribute('id', 'tr-'+j);
            
        // };

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
            x.setAttribute("type", "number");
            x.setAttribute("class", "form-control text-center");
            x.setAttribute("name", "ned-<?= $draftPengukuran[$no]['id'];?>");
            x.setAttribute("placeholder", "00.00");
            x.setAttribute("value", "<?= $draftPengukuran[$no++]['neck_diameter']; ?>");
            document.getElementById("table_body").appendChild(tr);
        <?php 
        }
        ?>

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
            x.setAttribute("type", "number");
            x.setAttribute("class", "form-control text-center");
            x.setAttribute("name", "bar-<?= $draftPengukuran[$no]['id'];?>");
            x.setAttribute("placeholder", "00.00");
            x.setAttribute("value", "<?= $draftPengukuran[$no++]['barrel']; ?>");
            document.getElementById("table_body").appendChild(tr);
        <?php 
        }
        ?>

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
            x.setAttribute("type", "number");
            x.setAttribute("class", "form-control text-center");
            x.setAttribute("name", "ovl-<?= $draftPengukuran[$no]['id'];?>");
            x.setAttribute("placeholder", "00.00");
            x.setAttribute("value", "<?= $draftPengukuran[$no++]['overall_length']; ?>");
            document.getElementById("table_body").appendChild(tr);
        <?php 
        }
        ?>

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
            x.setAttribute("type", "number");
            x.setAttribute("class", "form-control text-center");
            x.setAttribute("name", "tip1-<?= $draftPengukuran[$no]['id'];?>");
            x.setAttribute("placeholder", "00.00");
            x.setAttribute("value", "<?= $draftPengukuran[$no++]['tip_diameter_1']; ?>");
            document.getElementById("table_body").appendChild(tr);
        <?php 
        }
        ?>

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
            x.setAttribute("type", "number");
            x.setAttribute("class", "form-control text-center");
            x.setAttribute("name", "tip2-<?= $draftPengukuran[$no]['id'];?>");
            x.setAttribute("placeholder", "00.00");
            x.setAttribute("value", "<?= $draftPengukuran[$no++]['tip_diameter_2']; ?>");
            document.getElementById("table_body").appendChild(tr);
        <?php 
        }
        ?>

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
            x.setAttribute("type", "number");
            x.setAttribute("class", "form-control text-center");
            x.setAttribute("name", "cup-<?= $draftPengukuran[$no]['id'];?>");
            x.setAttribute("placeholder", "00.00");
            x.setAttribute("value", "<?= $draftPengukuran[$no++]['cup_depth']; ?>");
            document.getElementById("table_body").appendChild(tr);
        <?php 
        }
        ?>

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
            x.setAttribute("type", "number");
            x.setAttribute("class", "form-control text-center");
            x.setAttribute("name", "wkl-<?= $draftPengukuran[$no]['id'];?>");
            x.setAttribute("placeholder", "00.00");
            x.setAttribute("value", "<?= $draftPengukuran[$no++]['working_length']; ?>");
            document.getElementById("table_body").appendChild(tr);
        <?php 
        }
        ?>

        //Last VAlue
        var tr = document.createElement('tr');
        var td = tr.appendChild(document.createElement('td'));
        var hcf = td.appendChild(document.createTextNode("Head Configuration"));
        td.appendChild(hcf);
        for (var j = 1; j <= {{ $count }} ; j++) {
            // tr.setAttribute('id', 'tr-'+j);
            var td = tr.appendChild(document.createElement('td'));
            var x = td.appendChild(document.createElement('INPUT'));
            x.setAttribute("type", "number");
            x.setAttribute("class", "form-control text-center");
            x.setAttribute("name", "hcf-"+j);
            x.setAttribute("placeholder", "00.00");
            document.getElementById("table_body").appendChild(tr);
        };
        // //Head Configuration
        // var tr = document.createElement('tr');
        // var td = tr.appendChild(document.createElement('td'));
        // var hcf = td.appendChild(document.createTextNode("Head Configuration"));
        // td.appendChild(hcf);
        // for (var j = 1; j <= {{ $count }} ; j++) {
        //     // tr.setAttribute('id', 'tr-'+j);
        //     var td = tr.appendChild(document.createElement('td'));
        //     var x = td.appendChild(document.createElement('INPUT'));
        //     x.setAttribute("type", "number");
        //     x.setAttribute("class", "form-control text-center");
        //     x.setAttribute("name", "hcf-"+j);
        //     x.setAttribute("placeholder", "00.00");
        //     document.getElementById("table_body").appendChild(tr);
        // };

        // var td = tr.appendChild(document.createElement('td'));
        // var select = td.appendChild(document.createElement('select'));
        // select.setAttribute('class', 'form-select')
        // select.setAttribute('id', 'select_ok')
        // var option_ok = document.createElement('option');
        // var option_nok = document.createElement('option');
        // option_ok.text = 'OK';
        // option_nok.text = 'NOK';
        // select.appendChild(option_ok);
        // select.appendChild(option_nok);
    });
</script>
<!--end::Content-->
@endsection
