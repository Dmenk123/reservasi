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
                    <h2 class="ft-bold tulisan-custom">UPLOAD BUKTI PEMBAYARAN</h2>
                </div>
            </div>
        </div>
        
        <div class="row" >
            <div class="icon-box" style="transition: none;transform: none; width: 100%">
                <div class="row" style="justify-content: center;">
                    <div class="col-xl-6 " style="border-right: 2px solid #314d97;">
                        <form class="_apply_form_form">
                        
                            <div class="form-group">
                                <label class="text-dark mb-1 ft-medium medium">Nama Rekening Bank</label>
                                <input type="text" class="form-control" placeholder="Nama Bank Rekening" name="bank">
                                <span id="bank_error" class="text-error"></span>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="text-dark mb-1 ft-medium medium">Nominal Transfer:</label>
                                <input type="number" class="form-control" placeholder="x.xxx.xxx" name="telp">
                                <span id="telp_error" class="text-error"></span>
                            </div>
                            
                            <div class="form-group">
                                <label class="text-dark mb-1 ft-medium medium">Upload Bukti:<font>.png, .jpg, .jpeg</font></label>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="customFile">
                                  <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                            </div>
                            
                            <div class="form-group row" style="justify-content: center">
                                <button type="button" class="btn btn-md rounded theme-bg text-light ft-medium fs-sm" onclick="save()">Submit</button>
                            </div>
                            
                        </form>
                    </div>
                    
                    <div class="col-xl-6 ">
                        <h3>Ketentuan Transfer</h3>
                        <br>
                        <h6><span class="number-rounded">1</span>Lakukan transfer ke rekening BCA atas nama JOE TASLIM</h6>
                        <hr class="style11">
                        <h6><span class="number-rounded">2</span>Upload bukti transfer ke form yg tersedia</h6>
                        <hr class="style11">
                        <h6><span class="number-rounded">3</span>Isikan nominal transfer dan nama rekening bank anda </h6>
                        <hr class="style11">
                        <h6><span class="number-rounded">4</span>Tunggu hingga pesanan anda dikonfirmasi oleh admin</h6>
                        <hr class="style11">
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

			
		