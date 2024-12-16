<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Punch n Dies</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <style>
        @font-face {
            font-family: 'Inter';
            src: url('fonts/Inter-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 20px;
            background: white;
        }

        h1, h2, h3 {
            margin: 0;
            padding: 10px 0;
            color: #333;
        }

        h1 {
            font-size: 2rem;
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        h2 {
            font-size: 1.5rem;
            text-align: center;
            margin-top: 10px;
        }

        h3 {
            font-size: 1.25rem;
            margin-top: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid #000;
            padding: 12px;
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

        .fw-bold {
            font-weight: bold;
        }

        .fs-5 {
            font-size: 1.25rem;
        }

        .fs-6 {
            font-size: 1rem;
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
        }
    </style>
</head>

<body>
    <h1>Punch n Dies Report</h1>
    <h2>{{ strtoupper($labelPunch->merk) }}</h2>
    
    <table>
        <tr>
            <th>Merk Punch</th>
            <td>{{ strtoupper($labelPunch->merk) }}</td>
        </tr>
        <tr>
            <th>Bulan/Tahun Pembuatan</th>
            <td>{{ strtoupper($labelPunch->bulan_pembuatan) . ' ' . $labelPunch->tahun_pembuatan }}</td>
        </tr>
        <tr>
            <th>Nama Mesin Cetak</th>
            <td>{{ strtoupper($labelPunch->nama_mesin_cetak) }}</td>
        </tr>
        <tr>
            <th>Kode/Nama Produk</th>
            <td>
                <?php if(strtoupper($labelPunch->nama_produk) == strtoupper($labelPunch->kode_produk)) {?>
                    {{ strtoupper($labelPunch->nama_produk) }}
                <?php } else {?>
                    {{ strtoupper($labelPunch->nama_produk) . "/" . strtoupper($labelPunch->kode_produk) }}
                <?php }?>
            </td>
        </tr>
    </table>

    <h3>Measurement Data</h3>
    <table>
        <thead>
            <tr>
                <th>No Punch</th>
                <th>Head Outer Diameter</th>
                <th>Neck Diameter</th>
                <th>Barrel</th>
                <th>Overall Length</th>
                <th>Tip Diameter 1</th>
                <th>Tip Diameter 2</th>
                <th>Cup Depth</th>
                <th>Working Length</th>
                <th>Status </th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach ($dataPengukuran as $item)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $item->head_outer_diameter }}</td>
                    <td class="text-center">{{ $item->neck_diameter }}</td>
                    <td class="text-center">{{ $item->barrel }}</td>
                    <td class="text-center">{{ $item->overall_length }}</td>
                    <td class="text-center">{{ $item->tip_diameter_1 }}</td>
                    <td class="text-center">{{ $item->tip_diameter_2 }}</td>
                    <td class="text-center">{{ $item->cup_depth }}</td>
                    <td class="text-center">{{ $item->working_length }}</td>
                    <td class="text-center">{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Calibration Tools</h3>
    <table>
        <thead>
            <tr>
                <th>Tools</th>
                <th>Tgl Kalibrasi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Micrometer Digital</td>
                <td>
                    <?php 
                    $micrometerDate = $labelPunch->kalibrasi_micrometer ? new DateTime($labelPunch->kalibrasi_micrometer) : null;
                    echo $micrometerDate ? date_format($micrometerDate, 'd M Y') : ''; 
                    ?>
                </td>
            </tr>
            <tr>
                <td>Caliper Digital</td>
                <td>
                    <?php 
                    $caliperDate = $labelPunch->kalibrasi_caliper ? new DateTime($labelPunch->kalibrasi_caliper) : null;
                    echo $caliperDate ? date_format($caliperDate, 'd M Y') : ''; 
                    ?>
                </td>
            </tr>
            <tr>
                <td>Dial Indicator Digital</td>
                <td>
                    <?php 
                    $dialIndicatorDate = $labelPunch->kalibrasi_dial_indicator ? new DateTime($labelPunch->kalibrasi_dial_indicator) : null;
                    echo $dialIndicatorDate ? date_format($dialIndicatorDate, 'd M Y') : ''; 
                    ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>Notes</h3>
    <p>{{ $labelPunch->catatan }}</p>

    <h3>Conclusion</h3>
    <p>{{ $labelPunch->kesimpulan }}</p>
</body>
</html>