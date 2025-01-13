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
                                                                                            Merk Dies
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
                                                                                            {{ ucwords($labelIdentitas->username) }}</td>
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
                                                                        <a href="{{route('pnd.approval.pr.approve', $data->id)}}">
                                                                            <button class="btn btn-success btn-lg w-100" style="height: 100%; min-height: 5vh; max-height: 8vh;">
                                                                                Approve
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                    <div class="flex-fill d-flex align-items-center justify-content-center" style="height: 180px">
                                                                        <a href="{{route('pnd.approval.pr.reject', $data->id)}}">
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
                                        <table id="dboard_Table1" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No Dies</th>
                                                    <th class="text-center">Cincin Tidak Berbayang</th>
                                                    <th class="text-center">Tidak Gompal</th>
                                                    <th class="text-center">Tidak Retak</th>
                                                    <th class="text-center">Tidak Pecah</th>
                                                    <th class="text-center">Visual/Segment Dies</th>
                                                    <th class="text-center">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                @foreach ($dataPengukuran as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $no++ }}</td>
                                                        <td class="text-center">{{ $item->is_cincin_berbayang }}</td>
                                                        <td class="text-center">{{ $item->is_gompal }}</td>
                                                        <td class="text-center">{{ $item->is_retak }}</td>
                                                        <td class="text-center">{{ $item->is_pecah }}</td>
                                                        <td class="text-center">{{ $item->visual_dies }}</td>
                                                        <td class="text-center">{{ $item->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex flex-column mx-2">
                                                    <label for="referensi_drawing" class="form-label">Referensi Drawing</label>
                                                    <input type="text" class="form-control" value="{{$labelIdentitas->referensi_drawing}}" id="referensi_drawing" name="referensi_drawing" placeholder="Insert Reference Drawing" @readonly(true) />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-12 mt-3">
                                                        <div class="d-flex flex-column mx-2">
                                                            <label for="catatan" class="form-label">Catatan</label>
                                                            <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Insert Your Message" @readonly(true)>{{$labelIdentitas->catatan}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="d-flex flex-column mx-2">
                                                            <label for="kesimpulan" class="form-label">Kesimpulan</label>
                                                            <textarea class="form-control" id="kesimpulan" name="kesimpulan" rows="3" placeholder="Insert Your Message" @readonly(true)>{{$labelIdentitas->kesimpulan}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="d-flex flex-column mt-5">
                                                    <label for="" class="form-label">Kalibrasi Tools</label>
                                                    <div class="table-responsive">
                                                        <table class="table table-rounded table-bordered">
                                                            <thead>
                                                                <tr class="fw-bold fs-6 text-gray-800">
                                                                    <th>Tools</th>
                                                                    <th>Tgl Kalibrasi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $micrometer = $labelIdentitas->kalibrasi_micrometer ? new DateTime($labelIdentitas->kalibrasi_micrometer) : null;
                                                                $caliper = $labelIdentitas->kalibrasi_caliper ? new DateTime($labelIdentitas->kalibrasi_caliper) : null;
                                                                $dial_indicator = $labelIdentitas->kalibrasi_dial_indicator ? new DateTime($labelIdentitas->kalibrasi_dial_indicator) : null;
                                                                ?>

                                                                <tr>
                                                                    <td>Micrometer Digital</td>
                                                                    <td>
                                                                        <input type="text" value="{{ $micrometer ? date_format($micrometer, 'd M Y') : '' }}" name="micrometer_digital" id="micrometer_digital" class="form-control" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Caliper Digital</td>
                                                                    <td>
                                                                        <input type="text" value="{{ $caliper ? date_format($caliper, 'd M Y') : '' }}" name="caliper_digital" id="caliper_digital" class="form-control" @readonly(true)>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Dial Indicator Digital</td>
                                                                    <td>
                                                                        <input type="text" value="{{ $dial_indicator ? date_format($dial_indicator, 'd M Y') : '' }}" name="dial_indicator_digital" id="dial_indicator_digital" class="form-control" @readonly(true)>
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
