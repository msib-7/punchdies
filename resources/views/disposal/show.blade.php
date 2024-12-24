@extends('layout.metronic')
@section('main-content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Lembar Disposal</h3>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-md-7">
                                <h4>Detail</h4>
                                <div class="separator border-2 my-3"></div>
                                <div class="row">
                                    {{-- Tanggal Pengajuan --}}
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div class="col-4">Tanggal Pengajuan</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col">:</div>
                                                    <div class="col-11">
                                                        {{ $dataApproval->tgl_submit}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Diajukan Oleh --}}
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div class="col-4">Diajukan Oleh</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col">:</div>
                                                    <div class="col-11">
                                                        {{ $dataApproval->users->nama }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Line --}}
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div class="col-4">Line</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col">:</div>
                                                    <div class="col-11">
                                                        {{ $dataApproval->users->lines->nama_line }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Diposal untuk --}}
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div class="col-4">Disposal Untuk</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col">:</div>
                                                    <div class="col-11">
                                                        @if ($dataApproval->punch_id != null || $dataApproval->punch_id != '-')
                                                            {{ ucwords($dataApproval->punch->jenis) }}
                                                        @else
                                                            {{ ucwords($dataApproval->dies->jenis) }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Merk Punch --}}
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div class="col-4">Merk Punch</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col">:</div>
                                                    <div class="col-11">
                                                        @if ($dataApproval->punch_id != null || $dataApproval->punch_id != '-')
                                                            {{ ucwords($dataApproval->punch->merk) }}
                                                        @else
                                                            {{ ucwords($dataApproval->dies->merk) }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Bulan Tahun Pembuatan --}}
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div class="col-4">Bulan & Tahun Pembuatan</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col">:</div>
                                                    <div class="col-11">
                                                        @if ($dataApproval->punch_id != null || $dataApproval->punch_id != '-')
                                                            {{ $dataApproval->punch->bulan_pembuatan.' '.$dataApproval->punch->tahun_pembuatan }}
                                                        @else
                                                            {{ $dataApproval->dies->bulan_pembuatan.' '.$dataApproval->dies->tahun_pembuatan }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Pengukuran Terakhir --}}
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div class="col-4">Pengukuran Terakhir</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col">:</div>
                                                    <div class="col-11">
                                                        @if ($dataApproval->punch_id != null || $dataApproval->punch_id != '-')
                                                            {{ ucwords($dataApproval->punch->masa_pengukuran) }}
                                                        @else
                                                            {{ ucwords($dataApproval->dies->masa_pengukuran) }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Tanggal Pengukuran --}}
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div class="col-4">Tanggal Pengukuran</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col">:</div>
                                                    <div class="col-11">
                                                        @if ($dataApproval->punch_id != null || $dataApproval->punch_id != '-')
                                                            {{ ucwords($dataApproval->punch->updated_at) }}
                                                        @else
                                                            {{ ucwords($dataApproval->dies->updated_at) }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Catatan --}}
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div class="col-12">Catatan :</div>
                                            <div class="col-8">
                                                <textarea class="form-control my-3" rows="3" readonly>{{ $dataApproval->req_note }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <h4>Persetujuan</h4>
                                <div class="separator border-2 my-3"></div>
                                <div class="row border-start">
                                    {{-- Disetujui oleh --}}
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div class="col-4">Ditinjau oleh</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col">:</div>
                                                    <div class="col-11">
                                                        {{ $dataApproval->by }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Ditinjau pada --}}
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div class="col-4">Ditinjau pada</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col">:</div>
                                                    <div class="col-11">
                                                        {{ $dataApproval->at }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Status --}}
                                    <div class="col-12 my-3">
                                        <div class="row">
                                            <div class="col-4">Status</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col">:</div>
                                                    <div class="col-11">
                                                        @if ($dataApproval->is_waiting == '1')
                                                            <span class="badge badge-light-warning">Waiting</span>
                                                        @elseif ($dataApproval->is_approved == '1' && $dataApproval->is_rejected == '0' && $dataApproval->is_waiting == '0' && $dataApproval->is_revisi == '0')
                                                            <span class="badge badge-light-success">Approved</span>
                                                        @elseif ($dataApproval->is_approved == '0' && $dataApproval->is_rejected == '1' && $dataApproval->is_waiting == '0' && $dataApproval->is_revisi == '0')
                                                            <span class="badge badge-light-danger">Rejected</span>
                                                        @elseif ($dataApproval->is_approved == '0' && $dataApproval->is_rejected == '0' && $dataApproval->is_waiting == '0' && $dataApproval->is_revisi == '1')
                                                            <span class="badge badge-light-info">Revisi</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Alert --}}
                                    <div class="alert alert-info" role="alert">
                                        <h7 class="alert-heading">Catatan revisi sebelumnya:</h7>
                                            <p> <i>"{{ $dataApproval->approved_note }}"</i> </p>
                                        </p>
                                    </div>
                                    @if ($dataApproval->is_approved == '0' && $dataApproval->is_rejected == '0' && $dataApproval->is_waiting == '0' && $dataApproval->is_revisi == '1')
                                        {{-- Catatan --}}
                                        <div class="col-12 my-3">
                                            <div class="row" id="catatanTextarea">
                                                <div class="col-12"><b>Catatan :</b></div>
                                                <div class="col-12">
                                                    <textarea id="catatanTextarea" class="form-control my-3" rows="3" readonly>{{ $dataApproval->approved_note ?? ''}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="separator border-4 my-3"></div>
                            <div class="col-12">
                                <h4>Lampiran</h4>
                                <div class="separator border-2 my-3"></div>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attachmentModal" data-file="{{ asset('storage/'.$dataApproval->attach_1) }}">
                                            View Attach 1
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attachmentModal" data-file="{{ asset('storage/'.$dataApproval->attach_2) }}">
                                            View Attach 2
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attachmentModal" data-file="{{ asset('storage/'.$dataApproval->attach_3) }}">
                                            View Attach 3
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attachmentModal" data-file="{{ asset('storage/'.$dataApproval->attach_4) }}">
                                            View Attach 4
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attachmentModal" data-file="{{ asset('storage/'.$dataApproval->attach_5) }}">
                                            View Attach 5
                                        </button>
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

<!-- Modal -->
<div class="modal fade" id="attachmentModal" tabindex="-1" aria-labelledby="attachmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attachmentModalLabel">Attachment View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="attachmentFrame" src="" class="img-fluid" frameborder="0" style="width: 100%; height: 500px;"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    // Listen for the modal show event
    var attachmentModal = document.getElementById('attachmentModal');
    attachmentModal.addEventListener('show.bs.modal', function (event) {
        // Get the button that triggered the modal
        var button = event.relatedTarget;
        // Extract info from data-* attributes
        var file = button.getAttribute('data-file'); 
        // Update the modal's content
        var attachmentFrame = document.getElementById('attachmentFrame');
        attachmentFrame.src = file; // Set the iframe source to the file URL

        // Adjust images in the iframe after it loads
        attachmentFrame.onload = function () {
            var iframeDocument = attachmentFrame.contentDocument || attachmentFrame.contentWindow.document;
            var images = iframeDocument.getElementsByTagName('img');
            for (var i = 0; i < images.length; i++) {
                images[i].style.maxWidth = '100%';
                images[i].style.height = 'auto';
            }
        };
    });

    // Handle radio button change event
    document.querySelectorAll('input[name="method"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            var catatanTextarea = document.getElementById('catatanTextarea');
            if (this.value === 'revisi') {
                catatanTextarea.style.display = 'block'; // Show textarea
            } else {
                catatanTextarea.style.display = 'none'; // Hide textarea
                catatanTextarea.value = ''; // Clear the textarea
            }
        });
    });

    // Handle submit button click event
    document.getElementById('submitButton').addEventListener('click', function () {
        var selectedMethod = document.querySelector('input[name="method"]:checked');
        
        if (selectedMethod) {
            // Check if the selected radio button is "Approve"
            if (selectedMethod.value === 'approve') { // Assuming '1' is the value for Approve
                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to approve this data.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, approve it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proceed with the approval process
                        Swal.fire({
                            icon: 'success',
                            title: "Data Successfull Approved!",
                            html: "redirect in 3 seconds.",
                            allowOutsideClick: false, // Tidak bisa ditutup dengan klik luar
                            allowEscapeKey: false, // Tidak bisa ditutup dengan klik esc
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                            willClose: () => {
                            }
                        });
                    }
                });
            } else if(selectedMethod.value === 'reject') {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to Reject this data.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Reject it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proceed with the approval process
                        Swal.fire({
                            icon: 'success',
                            title: "Data Successfull Rejected!",
                            html: "redirect in 3 seconds.",
                            allowOutsideClick: false, // Tidak bisa ditutup dengan klik luar
                            allowEscapeKey: false, // Tidak bisa ditutup dengan klik esc
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                            willClose: () => {
                            }
                        });
                    }
                });
            }else if(selectedMethod.value === 'revisi'){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to Turning Back this data.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Submit it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proceed with the approval process
                        Swal.fire({
                            icon: 'success',
                            title: "Data Successfull Submited!",
                            html: "redirect in 3 seconds.",
                            allowOutsideClick: false, // Tidak bisa ditutup dengan klik luar
                            allowEscapeKey: false, // Tidak bisa ditutup dengan klik esc
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                            willClose: () => {
                            }
                        });
                    }
                });
            }
        } else {
            Swal.fire({
                icon: 'error',
                text: 'Please select an option before submitting.'
            })
        }
    });
</script>
<!--end::Content-->
@endsection
