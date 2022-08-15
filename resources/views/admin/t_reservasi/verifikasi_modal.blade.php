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
                <h5 class="pt-1">Bukti Pembayaran</h5>
                @if ($old && $old->t_file_upload)
                    {{-- <img class="img-fluid rounded mt-3 mb-2" src="{{asset('storage/'.$emp->m_employee_doc[0]->upload_m_employee_doc)}}" height="200" width="200" alt="User avatar" style="border: 3px solid #da0606e8;padding: 5px;"> --}}
                    @if (in_array($old->t_file_upload->mimetype, ['jpg', 'jpeg', 'png', 'svg']))
                        <img src="{{asset('storage/'.$old->t_file_upload->path_t_file_upload)}}" height="400" width="100%" alt="Bukti Pembayaran" />
                    @endif
                @else
                    {{-- <img class="img-fluid rounded mt-3 mb-2" src="{{asset('storage/files/photos/user_default.png')}}" height="200" width="200" alt="User avatar" style="border: 3px solid #da0606e8;padding: 5px;"> --}}
                @endif

                {{-- <ul class="list-group list-group-flush">
                    <li class="list-group-item border-0 px-0">
                        <label for="createAppCrm" class="d-flex cursor-pointer">
                            <span class="avatar avatar-tag bg-light-info me-1">
                                <i data-feather="briefcase" class="font-medium-5"></i>
                            </span>
                            <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                <span class="me-1">
                                    <span class="h5 d-block fw-bolder">CRM Application</span>
                                    <span>Scales with Any Business</span>
                                </span>
                                <span>
                                    <input class="form-check-input" id="createAppCrm" type="radio" name="categoryRadio" />
                                </span>
                            </span>
                        </label>
                    </li>
                    <li class="list-group-item border-0 px-0">
                        <label for="createAppEcommerce" class="d-flex cursor-pointer">
                            <span class="avatar avatar-tag bg-light-success me-1">
                                <i data-feather="shopping-cart" class="font-medium-5"></i>
                            </span>
                            <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                <span class="me-1">
                                    <span class="h5 d-block fw-bolder">Ecommerce Platforms</span>
                                    <span>Grow Your Business With App</span>
                                </span>
                                <span>
                                    <input class="form-check-input" id="createAppEcommerce" type="radio" name="categoryRadio" checked />
                                </span>
                            </span>
                        </label>
                    </li>
                    <li class="list-group-item border-0 px-0">
                        <label for="createAppOnlineLearning" class="d-flex cursor-pointer">
                            <span class="avatar avatar-tag bg-light-danger me-1">
                                <i data-feather="award" class="font-medium-5"></i>
                            </span>
                            <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                <span class="me-1">
                                    <span class="h5 d-block fw-bolder">Online Learning platform</span>
                                    <span>Start learning today</span>
                                </span>
                                <span>
                                    <input class="form-check-input" id="createAppOnlineLearning" type="radio" name="categoryRadio" />
                                </span>
                            </span>
                        </label>
                    </li>
                </ul> --}}
                <div class="d-flex justify-content-between mt-2">
                    <button class="btn btn-outline-secondary btn-prev" disabled>
                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                    </button>
                </div>
            </div>

            <div id="konten-detail-transaksi" class="content" role="tabpanel" aria-labelledby="konten-detail-transaksi-trigger">
                <h5 class="mb-1">Category</h5>

                <!-- form -->
                <form id="createAppBillingForm" class="row gy-1 gx-2" onsubmit="return false">
                    <div class="col-12">
                        <label class="form-label" for="cardNumberBilling">Card Number</label>
                        <div class="input-group input-group-merge">
                            <input id="cardNumberBilling" name="cardNumberBillingModal" class="form-control create-app-card-mask" type="text" value="5637817212901451" placeholder="1356 3215 6548 7898" aria-describedby="cardNumberBillingModal1" />
                            <span class="input-group-text cursor-pointer p-25" id="cardNumberBillingModal1">
                                <span class="credit-app-card-type"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="nameOnCardBilling">Name On Card</label>
                        <input type="text" id="nameOnCardBilling" class="form-control" placeholder="John Doe" />
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label" for="expDateBilling">Exp. Date</label>
                        <input type="text" id="expDateBilling" class="form-control create-app-expiry-date-mask" placeholder="MM/YY" />
                    </div>

                    <div class="col-6 col-md-3">
                        <label class="form-label" for="cvvBilling">CVV</label>
                        <input type="text" id="cvvBilling" class="form-control create-app-cvv-code-mask" maxlength="3" placeholder="654" />
                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <div class="form-check form-switch form-check-primary me-25">
                                <input type="checkbox" class="form-check-input" id="saveCardBilling" checked />
                                <label class="form-check-label" for="saveCardBilling">
                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                </label>
                            </div>
                            <label class="form-check-label fw-bolder" for="saveCardBilling">
                                Save Card for future billing?
                            </label>
                        </div>
                    </div>
                </form>

                <div class="d-flex justify-content-between mt-5 pt-1">
                    <button class="btn btn-primary btn-prev">
                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                    </button>
                </div>
            </div>

            {{-- <div id="create-app-submit" class="content text-center" role="tabpanel" aria-labelledby="create-app-submit-trigger">
                <h3>Submit 🥳</h3>
                <p>Submit your app to kickstart your project.</p>
                <img src="../../../app-assets/images/illustration/pricing-Illustration.svg" height="218" alt="illustration" />
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-primary btn-prev">
                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-success btn-submit">
                        <span class="align-middle d-sm-inline-block d-none">Submit</span>
                        <i data-feather="check" class="align-middle ms-sm-25 ms-0"></i>
                    </button>
                </div>
            </div> --}}
        </div>
    </div>
</div>


<script src="{{asset('js/module_js')}}/modal-create-app.js"></script>
