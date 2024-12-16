@extends('layout.metronic')
@section('main-content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Engage-->
	<div class="app-engage " id="kt_app_engage">  
		<!--begin::Prebuilts toggle-->
        <a href="{{route('pnd.pa.dies.print', $labelDies->dies_id)}}" class="app-engage-btn hover-dark" id="kt_drawer_example_basic_button">
            <i class="ki-duotone ki-printer fs-1 pt-1 mb-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
                <span class="path5"></span>
            </i>
            Print/PDF
        </a>
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
                                            <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                                                <span class="fs-2 fw-bold">{{ strtoupper($labelDies->merk) }}</span>
                                            </button>
                                        </h2>
                                        <div id="kt_accordion_1_body_1" class="accordion-collapse collapse show" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
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
                                                                                    <?php echo $statusPengukuran ?>
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
                                    <div class="card-body">
                                        <div class="table-resposive">
                                        <table class="table table-bordered" style="width:100%">
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
                                        </div>
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
                                                    <input type="text" class="form-control" value="{{$labelDies->referensi_drawing}}" id="referensi_drawing" name="referensi_drawing" placeholder="Insert Reference Drawing" @readonly(true) />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-12 mt-3">
                                                        <div class="d-flex flex-column mx-2">
                                                            <label for="catatan" class="form-label">Catatan</label>
                                                            <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Insert Your Message" @readonly(true)>{{$labelDies->catatan}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="d-flex flex-column mx-2">
                                                            <label for="kesimpulan" class="form-label">Kesimpulan</label>
                                                            <textarea class="form-control" id="kesimpulan" name="kesimpulan" rows="3" placeholder="Insert Your Message" @readonly(true)>{{$labelDies->kesimpulan}}</textarea>
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
                                                                $micrometer = $labelDies->kalibrasi_micrometer ? new DateTime($labelDies->kalibrasi_micrometer) : null;
                                                                $caliper = $labelDies->kalibrasi_caliper ? new DateTime($labelDies->kalibrasi_caliper) : null;
                                                                $dial_indicator = $labelDies->kalibrasi_dial_indicator ? new DateTime($labelDies->kalibrasi_dial_indicator) : null;
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
