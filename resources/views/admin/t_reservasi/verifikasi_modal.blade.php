<div class="col-12">
    <h1 class="text-center mb-1" id="createAppTitle">Form Verifikasi</h1>
    <p class="text-center mb-2">Silahkan Verifikasi Pembayaran</p>

    <div class="bs-stepper vertical wizard-modern create-app-wizard">
        <div class="bs-stepper-header" role="tablist">
            <div class="step" data-target="#konten-bukti-pembayaran" role="tab" id="konten-bukti-pembayaran-trigger">
                <button type="button" class="step-trigger py-75">
                    <span class="bs-stepper-box">
                        <i data-feather="book" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Bukti</span>
                        <span class="bs-stepper-subtitle">Bukti Pembayaran</span>
                    </span>
                </button>
            </div>
            <div class="step" data-target="#konten-detail-transaksi" role="tab" id="konten-detail-transaksi-trigger">
                <button type="button" class="step-trigger py-75">
                    <span class="bs-stepper-box">
                        <i data-feather="package" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Rincian</span>
                        <span class="bs-stepper-subtitle">Rincian Reservasi</span>
                    </span>
                </button>
            </div>
        </div>

        <!-- content -->
        <div class="bs-stepper-content shadow-none">
            <div id="konten-bukti-pembayaran" class="content" role="tabpanel" aria-labelledby="konten-bukti-pembayaran-trigger">
                <div class="card card-transaction">
                    <div class="card-body">
                        <h5 class="pt-1">Bukti Pembayaran</h5>
                        @if ($old && $old->t_reservasi_det)
                            {{-- @if (in_array($old->t_file_upload->mimetype, ['jpg', 'jpeg', 'png', 'svg'])) --}}
                                <img src="{{asset('storage/'.$old->t_reservasi_det[0]->medium)}}" height="400" width="100%" alt="Bukti Pembayaran" />
                            {{-- @elseif (in_array($old->t_file_upload->mimetype, ['pdf']))
                                <embed type="application/pdf" src="{{asset('storage/'.$old->t_reservasi_det[0]->medium)}}" width="100%" height="400"></embed>
                            @endif --}}

                            <div class="d-flex justify-content-between mt-2" style="justify-content: end !important;">
                                {{-- <button class="btn btn-outline-secondary btn-prev hidden" disabled>
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button> --}}
                                <button class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none">Next</span>
                                    <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        @else
                            <div class="d-flex justify-content-between mt-2">
                                <h1>Belum Terdapat data upload !!!</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div id="konten-detail-transaksi" class="content" role="tabpanel" aria-labelledby="konten-detail-transaksi-trigger">
                <div class="card card-transaction">
                    <div class="card-body">
                        <form id="verifyForm" class="row gy-1 gx-2">
                            <input id="id_t_reservasi" name="id_t_reservasi" class="form-control" type="hidden" value="{{$old->id_t_reservasi}}"/>

                            <div class="transaction-item">
                                <div class="d-flex flex-row">
                                    <div class="transaction-info">
                                        <h6 class="transaction-title">Email</h6>
                                    </div>
                                </div>
                                <div class="fw-bolder text-bold">{{$old->email_reservasi ?? '-'}}</div>
                            </div>

                            <div class="transaction-item">
                                <div class="d-flex flex-row">
                                    <div class="transaction-info">
                                        <h6 class="transaction-title">Kode Reservasi</h6>
                                    </div>
                                </div>
                                <div class="fw-bolder text-bold">{{$old->kode_t_reservasi ?? '-'}}</div>
                            </div>

                            <div class="transaction-item">
                                <div class="d-flex flex-row">
                                    <div class="transaction-info">
                                        <h6 class="transaction-title">Telp</h6>
                                    </div>
                                </div>
                                <div class="fw-bolder text-bold">{{$old->telp_t_reservasi ?? '-'}}</div>
                            </div>

                            <div class="transaction-item">
                                <div class="d-flex flex-row">
                                    <div class="transaction-info">
                                        <h6 class="transaction-title">Proses</h6>
                                    </div>
                                </div>
                                <div class="fw-bolder text-bold">{{$old->m_proses->nm_m_proses ?? '-'}}</div>
                            </div>

                            <div class="transaction-item">
                                <div class="d-flex flex-row">
                                    <div class="transaction-info">
                                        <h6 class="transaction-title">Hari / Tanggal</h6>
                                    </div>
                                </div>
                                <div class="fw-bolder text-bold">{{$old->hari_t_reservasi.' / '.\Carbon\Carbon::parse($old->tanggal_t_reservasi)->format('d-m-Y') ?? '-'}}</div>
                            </div>

                            <div class="transaction-item">
                                <div class="d-flex flex-row">
                                    <div class="transaction-info">
                                        <h6 class="transaction-title">Jam</h6>
                                    </div>
                                </div>
                                <div class="fw-bolder text-bold">{{$old->jam_t_reservasi ?? '-'}}</div>
                            </div>

                            <div class="transaction-item">
                                <div class="d-flex flex-row">
                                    <div class="transaction-info">
                                        <h6 class="transaction-title">Jenis</h6>
                                    </div>
                                </div>
                                <div class="fw-bolder text-bold">{{$old->jenis_t_reservasi ?? '-'}}</div>
                            </div>

                            <div class="transaction-item">
                                <div class="d-flex flex-row">
                                    <div class="transaction-info">
                                        <h6 class="transaction-title">Metode</h6>
                                    </div>
                                </div>
                                <div class="fw-bolder text-bold">{{$old->metode_pembayaran_t_reservasi ?? '-'}}</div>
                            </div>

                            <div class="transaction-item">
                                <div class="d-flex flex-row">
                                    <div class="transaction-info">
                                        <h6 class="transaction-title">Kode</h6>
                                    </div>
                                </div>
                                <div class="fw-bolder text-bold">{{$old->kode_payment_t_reservasi ?? '-'}}</div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <div class="form-check form-switch form-check-primary me-25">
                                        <input type="checkbox" class="form-check-input" name="verifikasi_transaksi" id="verifikasi_transaksi" />
                                        <label class="form-check-label" for="verifikasi_transaksi">
                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                        </label>
                                    </div>
                                    <label class="form-check-label fw-bolder" for="verifikasi_transaksi">
                                        Verifikasi Transaksi ini ?
                                    </label>
                                </div>
                            </div>
                        </form>

                        <div class="d-flex justify-content-between mt-5 pt-1">
                            <button class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-success btn-next" type="submit" id="submitform">
                                <span class="align-middle d-sm-inline-block d-none">Submit</span>
                                <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var modernVerticalWizard = document.querySelector('.create-app-wizard');
        var createAppModal = document.getElementById('createAppModal');

        if (typeof modernVerticalWizard !== undefined && modernVerticalWizard !== null) {
            var modernVerticalStepper = new Stepper(modernVerticalWizard, {
            linear: false
            });

            $(modernVerticalWizard)
            .find('.btn-next')
            .on('click', function () {
                modernVerticalStepper.next();
            });
            $(modernVerticalWizard)
            .find('.btn-prev')
            .on('click', function () {
                modernVerticalStepper.previous();
            });

            $(modernVerticalWizard)
            .find('.btn-submit')
            .on('click', function () {
                alert('Submitted..!!');
            });

            // reset wizard on modal hide
            // createAppModal.addEventListener('hide.bs.modal', function (event) {
            //     modernVerticalStepper.to(1);
            // });
        }

        $("#submitform").click(function(){
            swal.fire({
                title: "Confirmation",
                text: `Yakin verifikasi data ini ?`,
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                reverseButtons: !0
            }).then((result) => {
                if (result.isConfirmed) {
                    $(".text-danger").remove();
                    event.preventDefault();
                    var data = new FormData($('#verifyForm')[0]);
                    $("#submitform").attr('disabled', true);
                    $("#submitform span").text(loading_text);

                    $.ajax({
                        url:"{{ route("admin.t_reservasi.verifikasi") }}",
                        method:"POST",
                        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
                        data: data,
                        processData: false,
                        contentType: false,
                        success:function(data)
                        {
                            if($.isEmptyObject(data.error)){

                                if(data.status == true){
                                    $("#submitform").removeAttr('disabled');
                                    $("#submitform span").text('Submit');
                                    $("form").each(function() { this.reset() });
                                    swal.fire({
                                        title: "Success",
                                        text: data.message,
                                        icon: "success"
                                    }).then(function() {
                                        location.href = data.redirect;
                                    });
                                }else{
                                    displayErrorSwal(data.message);
                                }

                            }else{
                                displayWarningSwal();
                                $("#submitform").removeAttr('disabled');
                                $("#submitform span").text('Submit');
                                $.each(data.error, function(key, value) {
                                    var element = $("#" + key);
                                    element.closest("div.form-control")
                                    .removeClass("text-danger")
                                    .addClass(value.length > 0 ? "text-danger" : "")
                                    .find("#error_" + key).remove();
                                    element.after("<div id=error_"+ key + " class=text-danger>" + value + "</div>");
                                });
                            }
                        },
                        error: function(data){
                            displayErrorSwal(data.message);
                        }
                    });
                }
                else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });



        });
    });
</script>

{{-- <script src="{{asset('js/module_js')}}/modal-create-app.js"></script> --}}
