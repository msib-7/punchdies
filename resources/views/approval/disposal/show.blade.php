@extends('layout.metronic')
@section('main-content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
            <div class="card">
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
                                                        @if ($dataApproval->punch_id != null)
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
                                                        @if ($dataApproval->punch_id != null)
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
                                                        @if ($dataApproval->punch_id != null)
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
                                                        @if ($dataApproval->punch_id != null)
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
                                                        @if ($dataApproval->punch_id != null)
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
                                                        {{ auth()->user()->nama }}
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
                                                        {{ now() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($dataApproval->is_approved == '1' || $dataApproval->is_rejected == '1' || $dataApproval->is_revisi == '1')
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
                                    @else
                                        <form id="formApprovalDisposal" method="post" enctype="multipart/form-data">
                                            @csrf
                                            {{-- Status --}}
                                            <div class="col-12 my-3">
                                                <!--begin::Heading-->
                                                <div class="mb-3">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-5 fw-semibold">
                                                        <span class="required">Status</span>
                                                    </label>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Heading-->

                                                <!--begin::Radio group-->
                                                <div class="btn-group w-100 w-lg-50" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                                    <!--begin::Radio-->
                                                    <label class="btn btn-outline btn-color-muted btn-active-success {{ $dataApproval->is_approved == '1' ? 'active' : '' }}" data-kt-button="true">
                                                        <!--begin::Input-->
                                                        <input class="btn-check" type="radio" name="status" value="approve" {{ $dataApproval->is_approved == '1' ? 'checked' : '' }}/>
                                                        <!--end::Input-->
                                                        Approve
                                                    </label>
                                                    <!--end::Radio-->

                                                    <!--begin::Radio-->
                                                    <label class="btn btn-outline btn-color-muted btn-active-danger {{ $dataApproval->is_rejected == '1' ? 'active' : '' }}" data-kt-button="true">
                                                        <!--begin::Input-->
                                                        <input class="btn-check" type="radio" name="status" value="reject" {{ $dataApproval->is_rejected == '1' ? 'checked' : '' }}/>
                                                        <!--end::Input-->
                                                        Reject
                                                    </label>
                                                    <!--end::Radio-->

                                                    <!--begin::Radio-->
                                                    <label class="btn btn-outline btn-color-muted btn-active-warning {{ $dataApproval->is_revisi == '1' ? 'active' : '' }}" data-kt-button="true">
                                                        <!--begin::Input-->
                                                        <input class="btn-check" type="radio" name="status" value="revisi" {{ $dataApproval->is_revisi == '1' ? 'checked' : '' }}/>
                                                        <!--end::Input-->
                                                        Revisi
                                                    </label>
                                                    <!--end::Radio-->
                                                </div>
                                                <!--end::Radio group-->
                                            </div>

                                            @if ($dataApproval->approved_note != null && $dataApproval->approved_note != '' && $dataApproval->approved_note != '-')
                                                {{-- Alert --}}
                                                <div class="alert alert-info" role="alert">
                                                    <h7 class="alert-heading">Catatan revisi sebelumnya:</h7>
                                                        <p> <i>"{{ $dataApproval->approved_note }}"</i> </p>
                                                    </p>
                                                </div>
                                            @endif
                                            {{-- Catatan --}}
                                            <div class="col-12 my-3">
                                                <div class="row" id="catatanTextarea" style="display: {{ $dataApproval->is_approved == '1' || $dataApproval->is_rejected == '1' || $dataApproval->is_revisi == '1' ? 'block' : 'none' }};">
                                                    <div class="col-12"><b>Catatan :</b></div>
                                                    <div class="col-12">
                                                        <textarea id="catatanTextarea" name="note" class="form-control my-3" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Button --}}
                                            <div class="col-12 my-3" id="submitButtonContainer" style="display: {{ $dataApproval->is_approved == '1' || $dataApproval->is_rejected == '1' || $dataApproval->is_revisi == '1' ? 'none' : 'block' }};">
                                                <button id="submitButton" type="button" class="btn btn-primary w-100 btn-sm" onclick="checkUser('{{$dataApproval->id}}')">Submit</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="separator border-4 my-3"></div>
                            <div class="col-12">
                                <h4>Lampiran</h4>
                                <div class="separator border-2 my-3"></div>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attachmentModal" data-file="{{ asset('assets/img/disposals/'.$dataApproval->attach_1) }}">
                                            View Attach 1
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attachmentModal" data-file="{{ asset('assets/img/disposals/'.$dataApproval->attach_2) }}">
                                            View Attach 2
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attachmentModal" data-file="{{ asset('assets/img/disposals/'.$dataApproval->attach_3) }}">
                                            View Attach 3
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attachmentModal" data-file="{{ asset('assets/img/disposals/'.$dataApproval->attach_4) }}">
                                            View Attach 4
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attachmentModal" data-file="{{ asset('assets/img/disposals/'.$dataApproval->attach_5) }}">
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
    document.querySelectorAll('input[name="status"]').forEach(function (radio) {
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

    function checkUser(id) 
    {
        var action = document.querySelector('input[name="status"]:checked');
        

        Swal.fire({
            title: '<i class="ki-duotone ki-lock-2 fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>',
            text: 'hai {{ auth()->user()->nama }}! enter your credential to confirm approval!',
            input: "password",
            inputPlaceholder: "...",
            inputAttributes: {
                autocapitalize: "off",
                autocorrect: "off"
            },
            showCancelButton: true,
            confirmButtonText: "Confirm",
            showLoaderOnConfirm: true,
            preConfirm: async (password) => {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Return a promise that resolves or rejects based on the AJAX response
                return $.ajax({
                    type: 'POST',
                    url: '{{url("approval/check-password")}}',
                    data: {
                        password: password,
                        action: action.value,
                        id: id,
                        _token: csrfToken // Include the CSRF token
                    }
                }).then((data) => {
                    // Assuming the server returns a success response when the password is correct
                    if (data.success) {
                        return data; // Resolve the promise to indicate success
                    } else {
                        Swal.showValidationMessage('Incorrect password!'); // Show validation message
                        throw new Error('Incorrect password!'); // Reject the promise
                    }
                }).catch((xhr) => {
                    // Handle error
                    Swal.showValidationMessage(`Request failed: ${xhr.responseText}`);
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Credential Error',
                        html: `There was an error with your credentials. <br> Please try again. <br> ${xhr.responseText}`
                    })
                    throw new Error(xhr.responseText); // Reject the promise to stop loading
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                const note = document.querySelector('textarea[name="note"]').value;
                const url = result.value.action === 'approve' ? '{{ route("pnd.approval.dis.approve", ":id") }}' : result.value.action === 'reject' ? '{{ route("pnd.approval.dis.reject", ":id") }}' : '{{ route("pnd.approval.dis.revisi", ":id") }}';
                $.ajax({
                    type: 'GET',
                    url: url.replace(':id', id),
                    data: { pass: result.value.pass, id: id, note: note, },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'processing...',
                            text: 'Please wait while we process your request.',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) { // Added parentheses and a parameter
                        if(response.success == false){
                            Swal.fire({
                                icon: 'error',
                                title: 'Something went wrong',
                                text: response.message
                            });
                        }else{
                            let timerInterval;
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfull',
                                text: response.message + response.by,
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                willOpen: () => {
                                    Swal.showLoading();
                                },
                                willClose: () => {
                                    clearInterval(timerInterval);
                                    window.location.href = '{{ route("pnd.approval.dis.index") }}';
                                }
                            });
                        }
                    },
                    error: function() { // Added parentheses and parameters
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!', // Fixed typo "when" to "went"
                        });
                    },
                });
            }
        });
    }
</script>
<!--end::Content-->
@endsection
