@extends('web.layout.app')

			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
@section('content')

<!-- ======================= Content ======================== -->
<section class="space gray">
    <br>
    <div class="container">
    
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center mb-5">
                    <h6 class="text-muted mb-0"></h6>
                    <h2 class="ft-bold tulisan-custom">KONFIRMASI RESERVASI</h2>
                </div>
            </div>
        </div>
        
        <div class="row" >
            <div class="icon-box" style="transition: none;transform: none; width: 100%">
                <div class="row" style="justify-content: center;">
                    <div class="col-xl-6 col-lg-3 col-md-4 col-sm-6 col-6 ">
                        <div class="cats-wrap text-center border-div">
                            <div class="cats-box d-block rounded bg-white px-2 py-4 ">
                                <img src="{{ asset('assets/fo/flaticon/cash-payment.png') }}" width="150">
                                <div class="cats-box-caption">
                                    <br>
                                    <h4 class="tulisan-custom">Kategori Pembayaran</h4>
                                    <span class="text-muted">{!! ( ($type == 'lunas') ? 'Lunas':'Angsuran').'<br>&nbsp;' !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-6 col-lg-3 col-md-4 col-sm-6 col-6 ">
                        <div class="cats-wrap text-center border-div">
                            <div class="cats-box d-block rounded bg-white px-2 py-4 ">
                                <img src="{{ asset('assets/fo/flaticon/calendar.svg') }}" width="150">
                                <div class="cats-box-caption">
                                    <br>
                                    <h4 class="tulisan-custom" >Jadwal</h4>
                                    <span class="text-muted blink">{!! 'Tanggal : <b>'. (\Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') ?? '').'</b><br>Pukul : <b>'.\Carbon\Carbon::parse($time)->format('H:i').'<b> WIB'  !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="jb-apply-form bg-white rounded py-3 px-4 box-static">
                        <h4 class="ft-medium fs-md mb-3">Lengkapi data diri Anda.</h4>
                        
                        <form class="_apply_form_form">
                        
                            <div class="form-group">
                                <label class="text-dark mb-1 ft-medium medium">Nama</label>
                                <input type="text" class="form-control" placeholder="Nama Lengkap">
                            </div>
                            
                            <div class="form-group">
                                <label class="text-dark mb-1 ft-medium medium">Email</label>
                                <input type="email" class="form-control" placeholder="emailanda@gmail.com">
                            </div>
                            
                            <div class="form-group">
                                <label class="text-dark mb-1 ft-medium medium">Telepon / wa:</label>
                                <input type="text" class="form-control" placeholder="081xxxxxxx">
                            </div>

                            <div class="form-group">
                                <label class="text-dark mb-1 ft-medium medium radio-custom-label">Metode Pembayaran:</label>
                                <input id="aa2" class="radio-custom form-control" name="pembayaran" type="text" value="Manual">
                                <input id="aa2" class="radio-custom form-control" name="pembayaran" type="radio" value="Payment Gateway">
                            </div>
                            
                            {{-- <div class="form-group">
                                <label class="text-dark mb-1 ft-medium medium">Upload Resume:<font>pdf, doc, docx</font></label>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="customFile">
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div> --}}
                            
                            {{-- <div class="form-group">
                                <div class="terms_con">
                                    <input id="aa3" class="checkbox-custom" name="Coffee" type="checkbox">
                                    <label for="aa3" class="checkbox-custom-label">Submit</label>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <div class="selector">
                                    <div class="selecotr-item">
                                        <input type="radio" id="radio1" name="selector" class="selector-item_radio" checked>
                                        <label for="radio1" class="selector-item_label">Manual</label>
                                    </div>
                                    <div class="selecotr-item">
                                        <input type="radio" id="radio2" name="selector" class="selector-item_radio">
                                        <label for="radio2" class="selector-item_label">Payment Gateway</label>
                                    </div>
                                   
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <button type="button" class="btn btn-md rounded theme-bg text-light ft-medium fs-sm full-width">Konfirmasi</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
          

    </div>
</section>

@endsection
@section('custom_js')
<script type="text/javascript">

    $(document).ready(function() {
       

    });

   
</script>
@endsection

			
		