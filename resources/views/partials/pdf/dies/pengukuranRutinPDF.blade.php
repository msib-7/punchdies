<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/logo/logo_only.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 20px;
            background: #f9f9f9;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td {
            background-color: #fff;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.9rem;
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }
        .table-header{
            font-size: small;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            table {
                page-break-inside: auto;
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            .footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                text-align: center;
                font-size: 0.9rem;
                padding: 10px 0;
                border-top: 1px solid #ddd;
            }
            .new-page {
                margin-top: 20px; /* Adjust this value as needed */
            }
        }

    </style>
</head>

<body>
    <div class="container">
        <h3>Data Pengukuran Awal {{ $jenis }}</h3>
        
        <div class="section">
            <h3>Product Information</h3>
            <table>
                <tr>
                    <th>Merk Dies</th>
                    <td>{{ strtoupper($labelDies->merk) }}</td>
                </tr>
                <tr>
                    <th>Bulan/Tahun Pembuatan</th>
                    <td>{{ strtoupper($labelDies->bulan_pembuatan) . ' ' . $labelDies->tahun_pembuatan }}</td>
                </tr>
                <tr>
                    <th>Nama Mesin Cetak</th>
                    <td>{{ strtoupper($labelDies->nama_mesin_cetak) }}</td>
                </tr>
                <tr>
                    <th>Kode/Nama Produk</th>
                    <td>
                        <?php if(strtoupper($labelDies->nama_produks->title) == strtoupper($labelDies->kode_produks->title)) {?>
                            {{ strtoupper($labelDies->nama_produks->title)}}
                        <?php } else {?>
                            {{ strtoupper($labelDies->nama_produks->title)."/".strtoupper($labelDies->kode_produks->title)}}
                        <?php }?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <?php $no = 1; ?>
            @foreach (array_chunk($dataPengukuran->toArray(), 26) as $chunk)
            <table class="{{ !$loop->last ? 'new-page' : '' }}">
                <thead>
                    <tr>
                        <th class="table-header text-center">No Dies</th>
                        <th class="table-header text-center">Visual Dies/Segment Dies</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chunk as $item)
                        <tr>
                            <td class="text-center">{{ $no }}</td>
                            <td class="text-center">{{ $item['status'] }}</td>
                        </tr>
                        <?php $no++; ?>
                    @endforeach
                </tbody>
            </table>
            @if (!$loop->last)
                @pageBreak
            </div>
        </div>
        <div class="container mt-10">
            <div class="section">
                <h3>Data Pengukuran Awal {{ $jenis }}</h3>
        
                <div class="section">
                    <h3>Product Information</h3>
                    <table>
                        <tr>
                            <th>Merk Dies</th>
                            <td>{{ strtoupper($labelDies->merk) }}</td>
                        </tr>
                        <tr>
                            <th>Bulan/Tahun Pembuatan</th>
                            <td>{{ strtoupper($labelDies->bulan_pembuatan) . ' ' . $labelDies->tahun_pembuatan }}</td>
                        </tr>
                        <tr>
                            <th>Nama Mesin Cetak</th>
                            <td>{{ strtoupper($labelDies->nama_mesin_cetak) }}</td>
                        </tr>
                        <tr>
                            <th>Kode/Nama Produk</th>
                            <td>
                                <?php if(strtoupper($labelDies->nama_produk) == strtoupper($labelDies->kode_produk)) {?>
                                    {{ strtoupper($labelDies->nama_produk) }}
                                <?php } else {?>
                                    {{ strtoupper($labelDies-> nama_produk) . "/" . strtoupper($labelDies->kode_produk) }}
                                <?php }?>
                            </td>
                        </tr>
                    </table>
                </div>
            @endif
        @endforeach
        </div>
        
        <div class="section">
            <table>
                <tbody>
                    <tr>
                        <td>Referensi Drawing</td>
                        <td>{{ $labelDies->referensi_drawing }}</td>
                    </tr>
                    <tr>
                        <td>Catatan</td>
                        <td>{{ $labelDies->catatan }}</td>
                    </tr>
                    <tr>
                        <td>Kesimpulan</td>
                        <td>{{ $labelDies->kesimpulan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <div class="row">
                <div class="col-6">
                    <table>
                        <thead>
                            <tr>
                                <th>Tools</th>
                                <th>Tgl Kalibrasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $labelDies->kalibrasi1->title }}</td>
                                <td>
                                    <?php 
                                    $tgl_kalibrasi_1 = $labelDies->tgl_kalibrasi_tools_1 ? new DateTime($labelDies->tgl_kalibrasi_tools_1) : null;
                                    echo $tgl_kalibrasi_1 ? date_format($tgl_kalibrasi_1, 'd M Y') : ''; 
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>{{$labelDies->kalibrasi2->title}}</td>
                                <td>
                                    <?php 
                                    $tgl_kalibrasi_2 = $labelDies->tgl_kalibrasi_tools_2 ? new DateTime($labelDies->tgl_kalibrasi_tools_2) : null;
                                    echo $tgl_kalibrasi_2 ? date_format($tgl_kalibrasi_2, 'd M Y') : ''; 
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>{{$labelDies->kalibrasi3->title}}</td>
                                <td>
                                    <?php 
                                    $tgl_kalibrasi_3 = $labelDies->tgl_kalibrasi_tools_3 ? new DateTime($labelDies->tgl_kalibrasi_tools_3) : null;
                                    echo $tgl_kalibrasi_3 ? date_format($tgl_kalibrasi_3, 'd M Y') : ''; 
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <table>
                        <thead>
                            <th class="text-center">Diukur Oleh</th>
                            <th class="text-center">Diverifikasi Oleh</th>
                            <th class="text-center">Status</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    {{ $labelDies->nama }}
                                    <p>
                                        {{ date_format($tglPengukuran->created_at, 'd M Y') }}
                                    </p>
                                </td>
                                <td class="text-center">
                                    {{ $approvalInfo->by }}
                                    <p>
                                        @if ($approvalInfo->at == null)
                                            -
                                        @else
                                            {{ date_format(new DateTime($approvalInfo->at), 'd M Y') }}
                                        @endif
                                    </p>
                                </td>
                                <td class="text-center">
                                    @if ($labelDies->is_approved == '1')
                                        <span class="badge badge-square badge-outline badge-success">Approved</span>
                                    @elseif ($labelDies->is_rejected == '1') <!-- Check for rejection -->
                                        <span class="badge badge-square badge-outline badge-danger">Rejected</span>
                                    @elseif ($labelDies->is_draft == '1')
                                        <span class="badge badge-square badge-outline badge-dark">Draft</span>
                                    @elseif ($labelDies->is_waiting == '1')
                                        <span class="badge badge-square badge-outline badge-warning">Waiting</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <span id="print-date"></span>
    </div>

    <script src="/assets/plugins/global/plugins.bundle.js"></script>
    <script src="/assets/js/scripts.bundle.js"></script>
    <script>
        // Set the print date
        document.getElementById('print-date').innerText = 'Printed on: ' + new Date().toLocaleString('en-GB', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
    </script>
</body>
</html>