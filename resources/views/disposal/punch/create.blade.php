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
                        @if (isset($draft))
                        <h3 class="card-title fw-bold text-dark">Draft Disposal</h3>
                        @else
                        <h3 class="card-title fw-bold text-dark">New Disposal</h3>
                        @endif
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
                                @if (isset($draft) && $draft->is_revisi == '1')
                                    <div class="alert alert-info" role="alert">
                                        <h4 class="alert-heading">Perhatian!</h4>
                                        <p class="mb-0">Draft ini merupakan revisi dari disposal sebelumnya. <br>
                                            Catatan revisi: <br>
                                            <p> <i>"{{ $draft->approved_note }}"</i> </p>
                                        </p>
                                    </div>
                                    
                                @endif
                                <h4 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-semibold text-dark">Input Dokumen Disposal</span>
                                </h4>
                                <div class="card">
                                    <div class="card-body">
                                       <!--begin::Form-->
                                        <form class="form" action="{{ route('pnd.request.disposal.store', $labelIdentitas->punch_id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $labelIdentitas->punch_id }}">
                                            <div>
                                                <label for="formFile1" class="required form-label">Dokumen 1</label>
                                                <input class="form-control" type="file" value="{{ $draft->attach_1 ?? '-'}}" name="dokumen1" id="formFile1" accept=".pdf, .jpg, .jpeg, .png" onchange="handleFileChange(this)">
                                                
                                                <!-- Display the filename if it exists -->
                                                @if(isset($draft) && $draft->attach_1)
                                                    <div class="file-info">Current file: {{ basename($draft->attach_1) }}</div>
                                                @else
                                                    <div class="file-info">No file attached.</div>
                                                @endif

                                                <div id="error1" class="error-message text-danger" style="display: none;"></div>
                                                <small class="text-muted text-end" style="display: block;">Max file size: 2 MB. Allowed formats: PDF, JPG, JPEG, PNG.</small>
                                            </div>
                                            <div>
                                                <label for="formFile2" class="required form-label">Dokumen 2</label>
                                                <input class="form-control" type="file" value="{{ $draft->attach_2 ?? '-'}}" name="dokumen2" id="formFile2" accept=".pdf, .jpg, .jpeg, .png" onchange="handleFileChange(this)">

                                                <!-- Display the filename if it exists -->
                                                @if(isset($draft) && $draft->attach_2)
                                                    <div class="file-info">Current file: {{ basename($draft->attach_2) }}</div>
                                                @else
                                                    <div class="file-info">No file attached.</div>
                                                @endif

                                                <div id="error2" class="error-message text-danger" style="display: none;"></div>
                                                <small class="text-muted text-end" style="display: block;">Max file size: 2 MB. Allowed formats: PDF, JPG, JPEG, PNG.</small>
                                            </div>
                                            <div>
                                                <label for="formFile3" class="required form-label">Dokumen 3</label>
                                                <input class="form-control" type="file" value="{{ $draft->attach_3 ?? '-'}}" name="dokumen3" id="formFile3" accept=".pdf, .jpg, .jpeg, .png" onchange="handleFileChange(this)">
                                                
                                                <!-- Display the filename if it exists -->
                                                @if(isset($draft) && $draft->attach_3)
                                                    <div class="file-info">Current file: {{ basename($draft->attach_3) }}</div>
                                                @else
                                                    <div class="file-info">No file attached.</div>
                                                @endif

                                                <div id="error3" class="error-message text-danger" style="display: none;"></div>
                                                <small class="text-muted text-end" style="display: block;">Max file size: 2 MB. Allowed formats: PDF, JPG, JPEG, PNG.</small>
                                            </div>
                                            <div>
                                                <label for="formFile4" class="required form-label">Dokumen 4</label>
                                                <input class="form-control" type="file" value="{{ $draft->attach_4 ?? '-'}}" name="dokumen4" id="formFile4" accept=".pdf, .jpg, .jpeg, .png" onchange="handleFileChange(this)">
                                                
                                                <!-- Display the filename if it exists -->
                                                @if(isset($draft) && $draft->attach_4)
                                                    <div class="file-info">Current file: {{ basename($draft->attach_4) }}</div>
                                                @else
                                                    <div class="file-info">No file attached.</div>
                                                @endif

                                                <div id="error4" class="error-message text-danger" style="display: none;"></div>
                                                <small class="text-muted text-end" style="display: block;">Max file size: 2 MB. Allowed formats: PDF, JPG, JPEG, PNG.</small>
                                            </div>
                                            <div>
                                                <label for="formFile5" class="required form-label">Dokumen 5</label>
                                                <input class="form-control" type="file" value="{{ $draft->attach_5 ?? '-'}}" name="dokumen5" id="formFile5" accept=".pdf, .jpg, .jpeg, .png" onchange="handleFileChange(this)">
                                                
                                                <!-- Display the filename if it exists -->
                                                @if(isset($draft) && $draft->attach_5)
                                                    <div class="file-info">Current file: {{ basename($draft->attach_5) }}</div>
                                                @else
                                                    <div class="file-info">No file attached.</div>
                                                @endif

                                                <div id="error5" class="error-message text-danger" style="display: none;"></div>
                                                <small class="text-muted text-end" style="display: block;">Max file size: 2 MB. Allowed formats: PDF, JPG, JPEG, PNG.</small>
                                            </div>
                                            <div>
                                                <label for="formFile5" class="form-label">Catatan</label>
                                                <textarea name="note" class="form-control" cols="30" rows="5">{{$draft->req_note ?? ''}}</textarea>
                                            </div>
                                            <div class="mt-15">
                                                @if (isset($draft) && $draft->is_revisi == '1' ?? '')
                                                    <button type="submit" class="btn btn-light-primary  w-100 mb-1">
                                                        Submit Revisi
                                                    </button>

                                                    <button type="button" onclick="saveRevisi()" class="btn btn-light-warning  w-100">
                                                        Draft Revisi
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-light-primary  w-100 mb-1">
                                                        Create Disposal
                                                    </button>
                                                    
                                                    <button type="button" onclick="saveDraft()" class="btn btn-light-warning  w-100">
                                                        Draft
                                                    </button>
                                                @endif
                                                    
                                            </div>
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
                                                                                {{ strtoupper($labelIdentitas->merk) }}
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
                                                                                {{ strtoupper($labelIdentitas->bulan_pembuatan).' '.$labelIdentitas->tahun_pembuatan }}
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
                                                                                {{ strtoupper($labelIdentitas->nama_mesin_cetak) }}
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
                                                                                @if(strtoupper($labelIdentitas->nama_produks->title) == strtoupper($labelIdentitas->kode_produks->title))
                                                                                    {{ strtoupper($labelIdentitas->nama_produks->title)}}
                                                                                @else
                                                                                    {{ strtoupper($labelIdentitas->nama_produks->title)."/".strtoupper($labelIdentitas->kode_produks->title)}}
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
                                                                                {{ ucwords($labelIdentitas->masa_pengukuran) }}
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
                                                                                {{ date_format($labelIdentitas->created_at, 'd M Y') }}
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
                                @if ($labelIdentitas->masa_pengukuran == 'pengukuran awal')
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
                                                                $tgl_kalibrasi_1 = $labelIdentitas->tgl_kalibrasi_tools_1 ? new DateTime($labelIdentitas->tgl_kalibrasi_tools_1) : null;
                                                                $tgl_kalibrasi_2 = $labelIdentitas->tgl_kalibrasi_tools_2 ? new DateTime($labelIdentitas->tgl_kalibrasi_tools_2) : null;
                                                                $tgl_kalibrasi_3 = $labelIdentitas->tgl_kalibrasi_tools_3 ? new DateTime($labelIdentitas->tgl_kalibrasi_tools_3) : null;
                                                                ?>

                                                                <tr>
                                                                    <td>
                                                                        <input type="text" value="{{ $labelIdentitas->kalibrasi1->title }}" class="form-control" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" value="{{ $tgl_kalibrasi_1 ? date_format($tgl_kalibrasi_1, 'd M Y') : '' }}" name="tgl_kalibrasi_1" id="tgl_kalibrasi_1" class="form-control" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" value="{{ $labelIdentitas->kalibrasi2->title }}" class="form-control" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" value="{{ $tgl_kalibrasi_2 ? date_format($tgl_kalibrasi_2, 'd M Y') : '' }}" name="tgl_kalibrasi_2" id="tgl_kalibrasi_2" class="form-control" @readonly(true)>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" value="{{ $labelIdentitas->kalibrasi3->title }}" class="form-control" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" value="{{ $tgl_kalibrasi_3 ? date_format($tgl_kalibrasi_3, 'd M Y') : '' }}" name="tgl_kalibrasi_3" id="tgl_kalibrasi_3" class="form-control" @readonly(true)>
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
    $(document).ready(function () {
        // Set up CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function saveDraft() {
        // Create a FormData object to hold the form data
        var formData = new FormData();
        
        // Append the files and other data to the FormData object
        for (let i = 1; i <= 5; i++) {
            let fileInput = document.getElementById('formFile' + i);
            if (fileInput.files.length > 0) {
                formData.append('dokumen' + i, fileInput.files[0]);
            }
        }
        
        // Append other form data
        formData.append('note', document.querySelector('textarea[name="note"]').value);
        formData.append('id', document.querySelector('input[name="id"]').value);

        // Make the AJAX request
        $.ajax({
            url: "{{ route('pnd.request.disposal.draft') }}", // Use the route name
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Draft saved successfully.',
                    showConfirmButton: false,
                    timer: 1500
                });
            },
            error: function(xhr) {
                // Handle errors
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    var errorMessage = '';
                    for (var key in errors) {
                        errorMessage += errors[key].join(', ') + '\n';
                    }
                    alert(errorMessage);
                } else {
                    alert('An error occurred while saving the draft.');
                }
            }
        });
    }

    function saveRevisi() {
        // Create a FormData object to hold the form data
        var formData = new FormData();
        
        // Append the files and other data to the FormData object
        for (let i = 1; i <= 5; i++) {
            let fileInput = document.getElementById('formFile' + i);
            if (fileInput.files.length > 0) {
                formData.append('dokumen' + i, fileInput.files[0]);
            }
        }
        
        // Append other form data
        formData.append('note', document.querySelector('textarea[name="note"]').value);
        formData.append('id', document.querySelector('input[name="id"]').value);

        // Make the AJAX request
        $.ajax({
            url: "{{ route('pnd.request.disposal.draft') }}", // Use the route name
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Draft Revisi saved successfully.',
                    showConfirmButton: false,
                    timer: 1500
                });
            },
            error: function(xhr) {
                // Handle errors
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    var errorMessage = '';
                    for (var key in errors) {
                        errorMessage += errors[key].join(', ') + '\n';
                    }
                    alert(errorMessage);
                } else {
                    alert('An error occurred while saving the draft.');
                }
            }
        });
    }

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
