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
                    <div class="col-xl-6 ">
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

                    <div class="col-xl-6 ">
                        <div class="cats-wrap text-center border-div">
                            <div class="cats-box d-block rounded bg-white px-2 py-4 ">
                                <img src="{{ asset('assets/fo/flaticon/calendar.svg') }}" width="150">
                                <div class="cats-box-caption">
                                    <br>
                                    <h4 class="tulisan-custom" >Jadwal</h4>
                                    <span class="text-muted blink">{!! 'Tanggal : <b>'. (\Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') ?? '').'</b><br>Pukul : <b>'.\Carbon\Carbon::parse($time)->format('H:i').' WIB</b>'  !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 no-padding">
                    <div class="jb-apply-form bg-white rounded box-static">
                        <h4 class="ft-medium fs-md mb-3">Lengkapi data diri Anda.</h4>

                        <form class="_apply_form_form">

                            <div class="form-group">
                                <input type="hidden" name="type" value="{{ $type }}" id="type">
                                <input type="hidden" name="date" value="{{ $date }}" id="date">
                                <input type="hidden" name="time" value="{{ $time }}" id="time">
                                <label class="text-dark mb-1 ft-medium medium">Nama</label>
                                <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama">
                                <span id="nama_error" class="text-error"></span>
                            </div>

                            <div class="form-group">
                                <label class="text-dark mb-1 ft-medium medium">Email</label>
                                <input type="email" class="form-control" placeholder="emailanda@gmail.com" name="email">
                                <span id="email_error" class="text-error"></span>
                            </div>

                            <div class="form-group">
                                <label class="text-dark mb-1 ft-medium medium">Telepon / wa:</label>
                                <input type="number" class="form-control" placeholder="081xxxxxxx" name="telp">
                                <span id="telp_error" class="text-error"></span>
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
                                <label class="text-dark mb-1 ft-medium medium radio-custom-label">Metode Pembayaran:</label>
                                <div class="selector">
                                    <div class="selecotr-item">
                                        <input type="radio" id="radio1" name="pembayaran" value="manual" class="selector-item_radio" checked>
                                        <label for="radio1" class="selector-item_label">Manual</label>
                                    </div>
                                    <div class="selecotr-item">
                                        <input type="radio" id="radio2" name="pembayaran" value="gateway" class="selector-item_radio">
                                        <label for="radio2" class="selector-item_label">Gateway</label>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row" style="justify-content: center">
                                <button type="button" class="btn btn-md rounded theme-bg text-light ft-medium fs-sm" onclick="save()">Konfirmasi</button>
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

    function save()
    {
        Swal.fire({
            title: 'Apakah yakin?',
            text: 'ingin menambah data',
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
                    url: "{{ route('booking.save-reservasi') }}",
                    type: "post",
                    headers: {
                        "X-CSRF-TOKEN": token
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status) {
                            Swal.fire ('Berhasil!', response.message, 'success')
                            var url = '{{route("booking.payment-manual", "code=:id")}}';
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


</script>
@endsection


