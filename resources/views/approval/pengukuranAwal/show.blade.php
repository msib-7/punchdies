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
                                            <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                                                <span class="fs-2 fw-bold">{{ strtoupper($labelIdentitas->merk) }}</span>
                                            </button>
                                        </h2>
                                        <div id="kt_accordion_1_body_1" class="accordion-collapse collapse show" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-9">
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
                                                                                            {{ strtoupper($labelIdentitas->merk) }}</td>
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
                                                                                            {{ strtoupper($labelIdentitas->bulan_pembuatan).' '.$labelIdentitas->tahun_pembuatan }}</td>
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
                                                                                            {{ strtoupper($labelIdentitas->nama_mesin_cetak) }}</td>
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
                                                                                            <?php if(strtoupper($labelIdentitas->nama_produk) == strtoupper($labelIdentitas->kode_produk)) {?>
                                                                                                {{ strtoupper($labelIdentitas->nama_produk)}}
                                                                                            <?php } else {?>
                                                                                                {{ strtoupper($labelIdentitas->nama_produk)."/".strtoupper($labelIdentitas->kode_produk)}}
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
                                                                                            {{ ucwords($labelIdentitas->masa_pengukuran) }}</td>
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
                                                                                            {{-- {{ $labelIdentitas->created_at }} --}}
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
                                                                                            {{ ucwords($labelIdentitas->nama) }}</td>
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
                                                                                            <?php echo $status ?>
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
                                                    <div class="col-12 col-md-3">
                                                        <div class="row">
                                                            <div class="col-12 d-flex align-items-center justify-content-center border border-3 rounded-3 h-100 d-inline-block">
                                                                @if ($data->is_approved != 1 || $data->is_rejected != 1)
                                                                    <div class="flex-fill d-flex align-items-center justify-content-center" style="height: 180px">
                                                                        <a href="{{route('pnd.approval.pa.approve', $data->id)}}">
                                                                            <button class="btn btn-success btn-lg w-100" style="height: 100%; min-height: 5vh; max-height: 8vh;">
                                                                                Approve
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                    <div class="flex-fill d-flex align-items-center justify-content-center" style="height: 180px">
                                                                        <a href="{{route('pnd.approval.pa.reject', $data->id)}}">
                                                                            <button class="btn btn-danger btn-lg w-100" style="height: 100%; min-height: 5vh; max-height: 8vh;">
                                                                                Rejected
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <div class="flex-fill d-flex align-items-center justify-content-center" style="height: 180px">
                                                                        <button class="btn btn-success btn-lg w-100 p-2" style="height: 100%; min-height: 5vh; max-height: 8vh;">
                                                                            <div class="col-12 py-2">
                                                                                <span class='badge badge-light-success fs-5'>
                                                                                    diApprove oleh:
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <span class='badge badge-light-success fs-5'>
                                                                                    {{$data->approved_by}}
                                                                                </span>
                                                                            </div>
                                                                        </button>
                                                                    </div>
                                                                @endif
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
                                    <div class="card-body">
                                        @if ($show == 'punch')
                                            <table id="dboard_Table1" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No Punch</th>
                                                        <th class="text-center">Head Outer D</th>
                                                        <th class="text-center">Neck Dmtr</th>
                                                        <th class="text-center">Barrel</th>
                                                        <th class="text-center">Overall Length</th>
                                                        <th class="text-center">Tip Dmtr 1</th>
                                                        <th class="text-center">Tip Dmtr 2</th>
                                                        <th class="text-center">Cup Depth</th>
                                                        <th class="text-center">Working Length</th>
                                                        <th class="text-center">Status</th>
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
                                        @else
                                            <table id="dboard_Table1" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No Punch</th>
                                                        <th class="text-center">Outer Diameter</th>
                                                        <th class="text-center">Inner Diameter 1</th>
                                                        <th class="text-center">Inner Diameter 2</th>
                                                        <th class="text-center">Ketinggian Dies</th>
                                                        <th class="text-center">Visual</th>
                                                        <th class="text-center">Kesesuaian Dies</th>
                                                        <th class="text-center">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    @foreach ($dataPengukuran as $item)
                                                        <tr>
                                                            <td class="text-center">{{ $no++ }}</td>
                                                            <td class="text-center">{{ $item->outer_diameter }}</td>
                                                            <td class="text-center">{{ $item->inner_diameter_1 }}</td>
                                                            <td class="text-center">{{ $item->inner_diameter_2 }}</td>
                                                            <td class="text-center">{{ $item->ketinggian_dies }}</td>
                                                            <td class="text-center">{{ $item->visual }}</td>
                                                            <td class="text-center">{{ $item->kesesuaian_dies }}</td>
                                                            <td class="text-center">{{ $item->status }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
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

{{-- Modal Konfirmasi Data Pengukuran --}}
<script>
</script>
<!--end::Content-->
@endsection
