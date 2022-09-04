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
                        <div class="row">
                            <div class="col-sm-7 ">
                                <div class="card positive">
                                    <div class="main-content">
                                      <div class="status-label">Tagihan</div>
                                      <div class="card-title">Rincian</div>
                                  
                                      <dl class="info-listing clearfix">
                                        <dt class="ion-ios-pricetag" style="margin: 0px!important">{{ $reservasi->jenis_t_reservasi == 'cash' ? 'Paket Lunas' : 'Paket Ngecup'  }}</dt>
                                        <dd>3.000.000</dd>
                                        {{-- <dt class="ion-ios-pricetag" style="margin: 0px!important">Status</dt>
                                        <dd>Stable</dd> --}}
                                      </dl>
                                    </div>
                                    
                                    <div class="sub-note">
                                       status : Belum Dibayar
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <table width="50%" style="font-size: 12px">
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
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      

                        
                        <hr class="style10">
                        <div class="form-pmb-manual">
                            <form class="_apply_form_form" id="payment-manual">
                        
                                <div class="form-group">
                                    <input type="hidden" name="kode_verifikasi" value="{{ $kode_verifikasi ?? ''}}">
                                    <label class="text-dark mb-1 ft-medium medium">Nama Rekening Bank</label>
                                    <input type="text" class="form-control" placeholder="Nama Bank Rekening" name="bank">
                                    <span id="bank_error" class="text-error"></span>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label class="text-dark mb-1 ft-medium medium">Nominal Transfer:</label>
                                    <input type="number" class="form-control" placeholder="x.xxx.xxx" name="nominal">
                                    <span id="nominal_error" class="text-error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="text-dark mb-1 ft-medium medium">Upload Bukti:<font>.png, .jpg, .jpeg</font></label>
                                    
                                    <div class="custom-file">
                                        <div class="holder" style="display: none">
                                            <img id="imgPreview" class="img-preview" src="#" alt="pic" width="100"/>
                                        </div>
                                        <input type="file" class="custom-file-input" id="customFile" name="foto">
                                        
                                        <label class="custom-file-label" for="customFile">Pilih file</label>
                                        <span id="foto_error" class="text-error"></span>
                                    </div>
                                </div>
                                
                                <div class="form-group row" style="justify-content: center">
                                    <button type="button" class="btn btn-md rounded theme-bg text-light ft-medium fs-sm" onclick="save()">Submit</button>
                                </div>
                                
                            </form>
                        </div>
                        <div class="form-pmb-gateway" style="display: none;">
                            <form class="_apply_form_form" id="payment-gateway" method="post" action="snapfinish" >
                        
                                <div class="form-group">
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <label class="text-dark mb-1 ft-medium medium">&nbsp;</label>
                                    <input type="hidden" class="form-control" name="result_type" id="result-type" value="">
                                    <input type="hidden" class="form-control" name="result_data" id="result-data" value="">
                                </div>
                            </form>
                            
                            <button id="pay-button" class="btn btn-md theme-bg-light rounded theme-cl hover-theme">Bayar</button>
                        </div>
                       

                       
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
        var div_from =  '{{ $reservasi->jenis_t_reservasi }}';
        if (div_from != 'cash') {
            $('.form-pmb-gateway').show();
            $('.form-pmb-manual').hide();
        } else {
            $('.form-pmb-gateway').hide();
            $('.form-pmb-manual').show();
        }
        $('#customFile').change(function(){
            const file = this.files[0];
            console.log(file);
            if (file){
                let reader = new FileReader();
                reader.onload = function(event){
                    console.log(event.target.result);
                    $('.holder').show();
                    $('#imgPreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

    });

    function save()
    {
        Swal.fire({
            title: 'Apakah yakin?',
            text: 'ingin menyimpan data',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya",
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.querySelector('form');
                let formData = new FormData(form);

                const token = "{{ csrf_token() }}";

                $.ajax({
                    url: "{{ route('booking.save-pembayaran') }}",
                    type: "post",
                    headers: {
                        "X-CSRF-TOKEN": token
                    },
                    data: formData,
                    contentType: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status) {
                            Swal.fire ('Berhasil!', response.message, 'success')
                            var url = '{{route("booking.after-payment", ":id")}}';
                            url = url.replace(':id', response.kode_verifikasi);
                            // console.log(url);
                            window.location.href = url;
                            // tabelData.ajax.reload();
                        }else{
                            // console.log(response)
                            var error = response.error
                            $.each(error, function (key, val) {
                                console.log(key)
                                $("#" + key + "_error").text(val);
                            });
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    }
                });
            }
        })
    }

    $('#pay-button').click(function (event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        $.ajax({
          
          // url: './snaptoken',
          url : '{{route("booking.snaptoken")}}',
          cache: false,

          success: function(data) {
            //location = data;

            console.log('token = '+data);
            
            var resultType = document.getElementById('result-type');
            var resultData = document.getElementById('result-data');

            function changeResult(type,data){
              $("#result-type").val(type);
              $("#result-data").val(JSON.stringify(data));
              //resultType.innerHTML = type;
              //resultData.innerHTML = JSON.stringify(data);
            }

            snap.pay(data, {
              
              onSuccess: function(result){
                changeResult('success', result);
                console.log(result.status_message);
                console.log(result);
                $("#payment-form").submit();
              },
              onPending: function(result){
                changeResult('pending', result);
                console.log(result.status_message);
                $("#payment-form").submit();
              },
              onError: function(result){
                changeResult('error', result);
                console.log(result.status_message);
                $("#payment-form").submit();
              }
            });
          }
        });
    });
   

   
</script>
@endsection

			
		