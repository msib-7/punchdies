@extends('layout.metronic')
@section('main-content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Create Disposal Request</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->	
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/dashboard" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Request Disposal</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
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
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title fw-bold text-dark">New Disposal</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <h4 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-semibold text-dark">Input Dokumen Disposal</span>
                                </h4>
                                <div class="card">
                                    <div class="card-body">
                                       <!--begin::Form-->
                                        <form class="form" action="/disposal/store/{{$labelPunch->punch_id}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div>
                                                <label for="formFile1" class="required form-label">Dokumen 1</label>
                                                <input class="form-control" type="file" name="dokumen1" id="formFile1" accept=".pdf, .jpg, .jpeg, .png" onchange="handleFileChange(this)">
                                                <div id="fileInfo1" class="file-info"></div>
                                                <div id="error1" class="error-message text-danger" style="display: none;"></div>
                                                <small class="text-muted text-end" style="display: block;">Max file size: 2 MB. Allowed formats: PDF, JPG, JPEG, PNG.</small>
                                            </div>
                                            <div>
                                                <label for="formFile2" class="required form-label">Dokumen 2</label>
                                                <input class="form-control" type="file" name="dokumen2" id="formFile2" accept=".pdf, .jpg, .jpeg, .png" onchange="handleFileChange(this)">
                                                <div id="fileInfo2" class="file-info"></div>
                                                <div id="error2" class="error-message text-danger" style="display: none;"></div>
                                                <small class="text-muted text-end" style="display: block;">Max file size: 2 MB. Allowed formats: PDF, JPG, JPEG, PNG.</small>
                                            </div>
                                            <div>
                                                <label for="formFile3" class="required form-label">Dokumen 3</label>
                                                <input class="form-control" type="file" name="dokumen3" id="formFile3" accept=".pdf, .jpg, .jpeg, .png" onchange="handleFileChange(this)">
                                                <div id="fileInfo3" class="file-info"></div>
                                                <div id="error3" class="error-message text-danger" style="display: none;"></div>
                                                <small class="text-muted text-end" style="display: block;">Max file size: 2 MB. Allowed formats: PDF, JPG, JPEG, PNG.</small>
                                            </div>
                                            <div>
                                                <label for="formFile4" class="required form-label">Dokumen 4</label>
                                                <input class="form-control" type="file" name="dokumen4" id="formFile4" accept=".pdf, .jpg, .jpeg, .png" onchange="handleFileChange(this)">
                                                <div id="fileInfo4" class="file-info"></div>
                                                <div id="error4" class="error-message text-danger" style="display: none;"></div>
                                                <small class="text-muted text-end" style="display: block;">Max file size: 2 MB. Allowed formats: PDF, JPG, JPEG, PNG.</small>
                                            </div>
                                            <div>
                                                <label for="formFile5" class="required form-label">Dokumen 5</label>
                                                <input class="form-control" type="file" name="dokumen5" id="formFile5" accept=".pdf, .jpg, .jpeg, .png" onchange="handleFileChange(this)">
                                                <div id="fileInfo5" class="file-info"></div>
                                                <div id="error5" class="error-message text-danger" style="display: none;"></div>
                                                <small class="text-muted text-end" style="display: block;">Max file size: 2 MB. Allowed formats: PDF, JPG, JPEG, PNG.</small>
                                            </div>
                                            <div>
                                                <label for="formFile5" class="form-label">Catatan</label>
                                                <textarea name="note" class="form-control" cols="30" rows="5">-</textarea>
                                            </div>
                                            <div class="mt-15">
                                                    <button type="submit" class="btn btn-light-primary  w-100 mb-1">
                                                        Create Disposal
                                                    </button>
                                                    <button type="button" onclick="saveDraft()" class="btn btn-light-warning  w-100">
                                                        Draft
                                                    </button>
                                            </div>
                                            {{-- <!--begin::Input group-->
                                            <div class="fv-row">
                                                <!--begin::Dropzone-->
                                                <div class="dropzone" id="kt_dropzonejs_example_1">
                                                    <!--begin::Message-->
                                                    <div class="dz-message needsclick">
                                                        <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>

                                                        <!--begin::Info-->
                                                        <div class="ms-4">
                                                            <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                                            <span class="fs-7 fw-semibold text-gray-500">Upload 5 dokumen</span>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Dropzone-->
                                            </div>
                                            <!--end::Input group--> --}}
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                </div>
                                <div class="separator border-3 my-6"></div>
                                <h4 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-semibold text-dark">Detail Pengukuran</span>
                                </h4>
                                <div class="col-12 mb-3">
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
                                                                                class="fs-6 px-5 my-4">
                                                                                Merk Punch
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-2 my-4">:
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                {{ strtoupper($labelPunch->merk) }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="border: none; height: 30px;">
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                Bulan/Tahun Pembuatan
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-2 my-4">:
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                {{ strtoupper($labelPunch->bulan_pembuatan).' '.$labelPunch->tahun_pembuatan }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="border: none; height: 30px;">
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                Nama Mesin Cetak
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-2 my-4">:
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                {{ strtoupper($labelPunch->nama_mesin_cetak) }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="border: none; height: 30px;">
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                Kode/Nama Produk
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-2 my-4">:
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                @if(strtoupper($labelPunch->nama_produk) == strtoupper($labelPunch->kode_produk))
                                                                                    {{ strtoupper($labelPunch->nama_produk)}}
                                                                                @else
                                                                                    {{ strtoupper($labelPunch->nama_produk)."/".strtoupper($labelPunch->kode_produk)}}
                                                                                @endif
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
                                                                                class="fs-6 px-5 my-4">
                                                                                Masa Pengukuran
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-2 my-4">:
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                {{ ucwords($labelPunch->masa_pengukuran) }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="border: none; height: 30px;">
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                Tanggal Pengukuran
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-2 my-4">:
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                {{-- {{ date_format($tglPengukuran->created_at, 'd M Y') }} --}}
                                                                                {{ date_format($labelPunch->created_at, 'd M Y') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="border: none; height: 30px;">
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                Diukur oleh
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-2 my-4">:
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                {{ ucwords($data->users->nama) }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="border: none; height: 30px;">
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                Status Pengukuran
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-2 my-4">:
                                                                            </td>
                                                                            <td style="border: none;"
                                                                                class="fs-6 px-5 my-4">
                                                                                <?= $statusPengukuran; ?>
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
                                @if ($labelPunch->masa_pengukuran == 'pengukuran awal')
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Head Outer Diameter</th>
                                                <th class="text-center">Neck Diameter</th>
                                                <th class="text-center">Barrel</th>
                                                <th class="text-center">Overall Length</th>
                                                <th class="text-center">Tip Diameter 1</th>
                                                <th class="text-center">Tip Diameter 2</th>
                                                <th class="text-center">Cup Depth</th>
                                                <th class="text-center">Working Length</th>
                                                <th class="text-center">Status</th>
                                            </thead>
                                            <tbody>
                                                <?php $no=1; ?>
                                                @foreach ($dataPengukuran as $punch)
                                                <tr>
                                                    <td class="text-center">{{$no++}}</td>
                                                    <td class="text-center">{{$punch->head_outer_diameter}}</td>
                                                    <td class="text-center">{{$punch->neck_diameter}}</td>
                                                    <td class="text-center">{{$punch->barrel}}</td>
                                                    <td class="text-center">{{$punch->overall_length}}</td>
                                                    <td class="text-center">{{$punch->tip_diameter_1}}</td>
                                                    <td class="text-center">{{$punch->tip_diameter_2}}</td>
                                                    <td class="text-center">{{$punch->cup_depth}}</td>
                                                    <td class="text-center">{{$punch->working_length}}</td>
                                                    <td class="text-center">{{$punch->status}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>No</th>
                                                <th>Overall Length</th>
                                                <th>Working Length (Awal)</th>
                                                <th>Working Length (Rutin)</th>
                                                <th>Cup Depth</th>
                                                <th>Status</th>
                                            </thead>
                                            <tbody>
                                                <?php $no=0; ?>
                                                @foreach ($dataPengukuran as $punch)
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$punch->overall_length}}</td>
                                                    <td>{{$punch->working_length_awal}}</td>
                                                    <td>{{$punch->working_length_rutin}}</td>
                                                    <td>{{$punch->cup_depth}}</td>
                                                    <td>{{$punch->status}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="d-flex flex-column mx-2">
                                                        <label for="referensi_drawing" class="form-label">Referensi Drawing</label>
                                                        <input type="text" class="form-control" value="{{$labelPunch->referensi_drawing}}" id="referensi_drawing" name="referensi_drawing" placeholder="Insert Reference Drawing" @readonly(true) />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="row">
                                                        <div class="col-12 mt-3">
                                                            <div class="d-flex flex-column mx-2">
                                                                <label for="catatan" class="form-label">Catatan</label>
                                                                <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Insert Your Message" @readonly(true)>{{$labelPunch->catatan}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="d-flex flex-column mx-2">
                                                                <label for="kesimpulan" class="form-label">Kesimpulan</label>
                                                                <textarea class="form-control" id="kesimpulan" name="kesimpulan" rows="3" placeholder="Insert Your Message" @readonly(true)>{{$labelPunch->kesimpulan}}</textarea>
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
                                                                    $micrometer = $labelPunch->kalibrasi_micrometer ? new DateTime($labelPunch->kalibrasi_micrometer) : null;
                                                                    $caliper = $labelPunch->kalibrasi_caliper ? new DateTime($labelPunch->kalibrasi_caliper) : null;
                                                                    $dial_indicator = $labelPunch->kalibrasi_dial_indicator ? new DateTime($labelPunch->kalibrasi_dial_indicator) : null;
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
                Set Your helper title
            </div>
            <!--end::Title-->
        </div>
        <!--end::Card header-->
        <div class="card-body">
            put your content here
        </div>
    </div>
</div>
<!--end::Bantuan Pengukuran-->

<script>
    function handleFileChange(input) {
        const file = input.files[0];
        const fileInfoDiv = document.getElementById('fileInfo' + input.id.charAt(input.id.length - 1));
        const errorDiv = document.getElementById('error' + input.id.charAt(input.id.length - 1));

        // Clear previous error message
        errorDiv.style.display = 'none';
        errorDiv.innerHTML = '';

        if (file) {
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2); // Convert size to MB
            const fileName = file.name.split('\\').pop().split('/').pop(); // Get the file name

            if (file.size > 2 * 1024 * 1024) { // Check if file size is greater than 2 MB
                errorDiv.style.display = 'block'; // Show error message
                errorDiv.innerHTML = 'File size exceeds 2 MB. Please upload a smaller file.';
                input.value = ''; // Clear the input
                fileInfoDiv.innerHTML = ''; // Clear the file info
            } else {
                fileInfoDiv.innerHTML = `${fileName} (${fileSizeMB} MB)`; // Display file name and size
            }
        } else {
            fileInfoDiv.innerHTML = ''; // Clear the file info if no file is selected
            errorDiv.style.display = 'none'; // Hide error message if no file is selected
        }
    }
</script>

<script>
    $(document).ready(function () {
        var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
            url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 5,
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            accept: function(file, done) {
                if (file.name == "wow.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        });
    });
</script>
<!--end::Content-->
@endsection
