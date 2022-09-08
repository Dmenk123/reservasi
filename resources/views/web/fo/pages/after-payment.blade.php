@extends('web.layout.app')

			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
@section('content')

<!-- ======================= Content ======================== -->
<style>
@import 'https://fonts.googleapis.com/css?family=Roboto:400,700';
@import 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css';

.clearfix::before, .clearfix::after {
    display: table!important;
    content: "";
}
 .clearfix::after {
	 clear: both!important;
}
.card {
    border: 1px solid #e5e5e5;
    border-radius: 3px;
    box-shadow: 0 7px 8px rgb(0 0 0 / 15%);
    display: inline-block;
    font-family: "Roboto", sans-serif;
    /* margin: 20px; */
    position: relative;
    vertical-align: top;
    width: 100%;
}
.card::after {
    background: url(https://s3.amazonaws.com/uploads.hipchat.com/11887/1259435/Fs6cXOPe83o7Rd0/agsquare_%402X.png);
    bottom: 0;
    content: "";
    left: 0;
    opacity: 0.4;
    position: absolute;
    right: 0;
    top: 0;
    z-index: -1;
}
 .main-content {
	 padding: 15px 15px 0;
}
 .status-label {
	 border-radius: 2px;
	 color: #f5f5f5;
	 display: inline-block;
	 font-size: 12px;
	 padding: 5px 10px;
	 margin-bottom: 15px;
	 text-transform: uppercase;
}
 .positive .status-label, .positive .sub-note {
	 background: #50c97f;
}
 .neutral .status-label, .neutral .sub-note {
	 background: #e9ae36;
}
 .negative .status-label, .negative .sub-note {
	 background: #e7504e;
}
 .card-title {
	 font-weight: 700;
	 padding: 5px 0;
}

[class*=ion-]:before {
    font-size: 18px;
    left: -30px;
    margin-top: -9px;
    position: absolute;
    top: 50%;
}

 .info-listing {
	 font-size: 15px;
	 margin: 0 0 0 30px;
}
 .info-listing dt, .info-listing dd {
	 border-bottom: 1px solid #e5e5e5;
	 display: inline-block;
	 float: left;
	 padding: 15px 0;
	 position: relative;
	 width: 50%;
}
 .info-listing dt:last-of-type, .info-listing dd:last-of-type {
	 border-bottom: none;
}
 .info-listing dt {
	 color: #777;
}
 .info-listing dd {
	 color: #b5bec5;
	 margin: 0;
	 text-align: right;
}
 .sub-note {
	 color: #f5f5f5;
	 font-size: 14px;
	 line-height: 135%;
	 padding: 15px;
}
</style>
<section class="space gray">
    <br>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                {{-- <div class="sec_title position-relative text-center mb-5">
                    <h6 class="text-muted mb-0"></h6>
                    <h2 class="ft-bold tulisan-custom">&nbsp;</h2>
                </div> --}}
            </div>
        </div>

        <div class="row" >
            <div class="icon-box" style="transition: none;transform: none; width: 100%">
                <div class="row" style="justify-content: center;">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-sm-8 ">
                                <h4 style="color:#28b661 !important;"><img src="{{ asset('assets/fo/img/checklist.png') }}" width="70"> Terimakasih, Pembayaran anda akan kami proses</h4>
                                <table width="100%" style="line-height: 30px">
                                    <tbody>
                                        <tr>
                                            <td>Nama</td>
                                            <td><strong>{{ $reservasi->nm_t_reservasi }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><strong>{{ $reservasi->email_reservasi }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Telepon</td>
                                            <td><strong>{{ $reservasi->telp_t_reservasi }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>status</td>
                                            <td>
                                                <div class="">
                                                    <span class="medium theme-cl theme-bg-light px-2 py-1 rounded">{{ $keterangan_status ?? '' }}</span>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <br>
                                <br>
                                <div class="position-relative text-left">
                                    <a href="{{ url('/') }}" class="btn btn-md theme-bg-light rounded theme-cl hover-theme">Beranda<i class="lni lni-arrow-right-circle ml-2"></i></a>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card positive">
                                    <div class="main-content">
                                      <div class="status-label">Pembayaran</div>
                                      <div class="card-title">Rincian</div>

                                      <dl class="info-listing clearfix">
                                        <dt class="ion-ios-pricetag" style="margin: 0px!important">{{ $reservasi->jenis_t_reservasi == 'cash' ? 'Paket Lunas' : 'Paket Ngecup'  }}</dt>
                                        <dd>{{number_format($harga->nominal_m_harga,0,',','.')}}</dd>
                                        {{-- <dt class="ion-ios-pricetag" style="margin: 0px!important">Status</dt>
                                        <dd>Stable</dd> --}}
                                      </dl>
                                    </div>

                                    <div class="sub-note">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-light-success theme-cl p-2 small d-flex align-items-center justify-content-center">
                                              <i class="fas fa-check"></i>
                                            </div>
                                            <h6 class="mb-0 ml-3">Sudah Dibayar</h6>
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
</section>

@endsection
@section('custom_js')

@endsection


