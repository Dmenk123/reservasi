@extends('web.layout.index')

@section('content')
<style>
    .select2-selection__rendered {
    line-height: 40px !important;
}
.select2-container .select2-selection--single {
    height: 40px !important;
    width: 100% !important;
    margin-top: 10px;
}
.select2-selection__arrow {
    height: 40px !important;
    width: 100% !important;
    margin-top: 10px;
}
.select2-container{
 width: 100%!important;
 }
 .select2-search--dropdown .select2-search__field {
 width: 98%;
 }
</style>
<h3 class="text-success text-center">Medical Check Up Booking</h3>





<form method="post" id="formlogin">

    <div class="row">
        <div class="col-md-12">
            <div class="mb-1 row text-center">
                <label class="col-form-label" for="nip_m_employee">
                    <strong>Masukkan Nomor Induk Pegawai Anda. Dan tambahkan huruf "P" jika anda suami/istri dari pegawai</strong>
                    <br>
                    <em>Please Enter Your Employee ID. And add the letter "P" if you are the husband/wife of the employee</em>
                </label>
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <input type="hidden" id="id_t_qrcode_hidden" name="id_t_qrcode_hidden" value="{{request()->get('id_t_qrcode')}}" />
                    <input type="hidden" id="id_m_employee_hidden" name="id_m_employee_hidden" value="{{request()->get('id_m_employee')}}" />
                    {{-- <input type="hidden" id="nip_m_employee_hidden" name="nip_m_employee_hidden" value="{{request()->get('nip_m_employee')}}" /> --}}
                    <input type="text" placeholder="example : 80423333 or 80423333P" value="{{request()->get('nip_m_employee')}}" autofocus maxlength="16" style="text-align: center;" id="nip_m_employee" class="form-control form-control-lg square" autocomplete="off" name="nip_m_employee">
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

        <div class="col-md-12 text-centerr" style="text-align: center;">
            <p class="text-danger"><small>

                    <label class="form-check-label" for="centang">
                        *Booking hanya berlaku untuk 1 orang / booking is only valid for 1 person
                    </label>
                           </small></p>
        </div>
        <div class="col-md-12 text-center mb-1" style="text-align: center;">
            <p><small>
                <div class="form-check">
                    <label class="form-check-label" for="centang">
                        <input class="form-check-input" type="checkbox" name="centang" value="1" id="centang">
                        Dengan melakukan booking, saya menyatakan telah membaca dan menyetujui <a id="btn_modal_policy" href="javascript:void(0)">ketentuan dan persyaratan</a> yang berlaku
                    </label>
                </div>
            </small></p>
        </div>
        <div class="col-md-12 text-center mb-1 mt-1">
            <button type="submit" id="check_id" class="btn btn-warning btn-lg"><span>Book Now</span></button>
        </div>
    </div>


  <hr>

    <div class="row">


        <div class="col-md-12 text-center mb-1 mt-1">
            <a href="{{route('web.form_sds')}}" class="btn btn-secondary waves-effect">SDS Form</a>
    <a href="{{route('web.form_riwayat_kes')}}" class="btn btn-secondary waves-effect">Form Riwayat Kesehatan</a>

        </div>


    </div>



</form>














<div class="modal fade text-start show" id="modal_booking" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Booking Confirmation</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" id="form_mcu">

                    <input type="hidden" class="form-control" name="id_m_employee" id="id_m_employee" />
                    <input type="hidden" class="form-control" name="nip_m_employee_hidden" id="nip_m_employee_hidden" />

                    <div class="row">

                        {{-- <div class="col-md-12">
                            <div class="mb-1 row">
                                <label class="col-form-label" for="">
                                    <strong>Silahkan menentukan jadwal Pemeriksaan Kesehatan yang tersedia</strong><br>
                                    <em>Please determine the availability of medical check up services by selecting the date and branch of pramita</em>
                                </label>
                            </div>
                        </div> --}}
                        <div class="col-md-6">

                            <div class="row">
                                <label class="col-form-label" for="nip_m_employee_modal">
                                    <strong>Nomor Induk Pegawai</strong>
                                    <br>
                                    <em>Employee ID</em>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" readonly id="nip_m_employee_modal" class="form-control form-control square" name="nip_m_employee_modal">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-form-label" for="nm_m_employee_modal">
                                    <strong>Nama</strong>
                                    <br>
                                    <em>Name</em>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" readonly id="nm_m_employee_modal" class="form-control form-control square" name="nm_m_employee_modal">
                                </div>
                            </div>


                            {{-- <div class="row">
                                <label class="col-form-label" for="dob_m_employee_modal">
                                    <strong>Tanggal Lahir</strong>
                                    <br>
                                    <em>Date of Birth</em>
                                </label>
                                <div class="col-12">
                                    {{-- <input type="text" readonly id="dob_m_employee_modal" class="form-control form-control square" name="dob_m_employee_modal">
                                    <input type="text" readonly id="dob_m_employee_modal" class="form-control datepicker" name="dob_m_employee_modal">
                                </div>
                            </div> --}}

                        </div>

                        <div class="col-md-6">

                            {{-- <div class="row">
                                <label class="col-form-label" for="nm_m_employee_modal">
                                    <strong>Nama</strong>
                                    <br>
                                    <em>Name</em>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" readonly id="nm_m_employee_modal" class="form-control form-control square" name="nm_m_employee_modal">
                                </div>
                            </div> --}}

                            <div class="row">
                                <label class="col-form-label" for="dob_m_employee_modal">
                                    <strong>Tanggal Lahir</strong>
                                    <br>
                                    <em>Date of Birth</em>
                                </label>
                                <div class="col-12">
                                    {{-- <input type="text" readonly id="dob_m_employee_modal" class="form-control form-control square" name="dob_m_employee_modal"> --}}
                                    <input type="text" readonly id="dob_m_employee_modal" class="form-control datepicker" name="dob_m_employee_modal">
                                </div>
                            </div>


                            <div class="row">
                                <label class="col-form-label" for="email_m_employee">
                                    <strong>Email</strong>
                                    <br>
                                    <em>Email</em>
                                </label>
                                <div class="col-md-12">
                                    <input type="hidden" readonly id="address_m_employee_modal" class="form-control form-control square" name="address_m_employee_modal">

                                    <input type="text"  id="email_m_employee" class="form-control form-control square" name="email_m_employee">
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6 mt-2">
                            <div class="row">
                                <strong>Pilih Lokasi Pemeriksaan</strong><br>
                                <em>Please choose MCU Location</em>

                                <br>

                                <select style="width: 100%;" name="id_m_branch" id="id_m_branch" class="select2 form-control">
                                    <option value="">Silahkan Pilih Cabang</option>
                                    @foreach ($branch as $item)
                                        <option value="{{$item->id_m_branch}}">{{$item->nm_m_branch}}</option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="row mt-2">
                                <label class="col-form-label" for="hp">
                                <strong>Masukkan Nomor Whatsapp</strong><br>
                                <em>Please input your whatsapp phone number</em>

                                <br>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="hp" id="hp" />
                                </div>
                            </div>

                        </div>


                        <div class="col-md-6 mt-2">
                            <div class="row mb-1">
                                <strong>Pilih Tanggal Pemeriksaan</strong><br>
                                <em>Choose MCU Date</em>
                                <br>
                                <div class="col-md-12" style="margin-top: 7px;">
                                    <input type="text" class="form-control" name="arrival_date" id="arrival_date" />
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col">
                                <div id="keterangan_tersedia" class="alert alert-success" style="display: none;"></div>
                                <div id="keterangan_tidak_tersedia" class="alert alert-danger" style="display: none;"></div>
                                <div id="tidak_ada_tanggal" class="alert alert-danger" style="display: none;"></div>
                                <div id="keterangan_sudah_booking" class="alert alert-info" style="display: none;"></div>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="mb-1 row">
                                <label class="col-form-label" for="">
                                    <button type="button" name="tombol_booking" id="tombol_booking" class="btn btn-warning disabled"><span>Booking Sekarang</span></button>
                                </label>
                            </div>
                        </div>




                        <br>










                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('web.layout.policy')

@endsection


@section('js')
<script>
$('#centang').prop('checked', false);
$("#check_id").attr('disabled', true);
$("#check_id").click(function(){
   // $("formlogin").each(function() { this.reset() });
//    $("#keterangan_sudah_booking").remove();
    $(".text-danger").remove();
    event.preventDefault();
    var data = new FormData($('#formlogin')[0]);
    $("#check_id").attr('disabled', true);
    $("#check_id span").text(loading_text);

    $.ajax({
        url:"{{ route("web.auth.authenticate_booking") }}",
        method:"POST",
        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
        data: data,
        processData: false,
        contentType: false,
        success:function(data)
        {
            if($.isEmptyObject(data.error)){
                if(data.status == true){
                    $("#modal_booking").modal('show');
                    $("#check_id").removeAttr('disabled');
                    $("#check_id span").text('Book Now');
                    // $("form").each(function() { this.reset() });
                    $('#keterangan_tersedia').html('');
                    $('#keterangan_tersedia').hide();
                    $('#keterangan_tidak_tersedia').html('');
                    $('#keterangan_tidak_tersedia').hide();
                    $('#tidak_ada_tanggal').html('');
                    $('#tidak_ada_tanggal').hide();
                    $('#keterangan_sudah_booking').html('');
                    $('#keterangan_sudah_booking').hide();
                    $('#form_checkin_modal').show();
                    $('#form_checkin_success_modal').hide();
                    $("#id_m_branch").val(null).trigger('change');
                    // $("#id_m_branch").select2("destroy");
                    $("#arrival_date").val('');
                    // $("#email_m_employee").val('');
                    // $("#dob_m_employee_modal").val('');
                    $('#modal_booking #form_mcu #nip_m_employee_modal').val(data.data[0]);
                    $('#modal_booking #form_mcu #nip_m_employee_hidden').val(data.data[0]);
                    $('#modal_booking #form_mcu #nm_m_employee_modal').val(data.data[1]);
                    $('#modal_booking #form_mcu #dob_m_employee_modal').val(data.data[2]);
                    $('#modal_booking #form_mcu #address_m_employee_modal').val(data.data[3]);
                    $('#modal_booking #form_mcu #id_m_employee').val(data.data[4]);
                    $('#modal_booking #form_mcu #hp').val(data.data[5]);
                    $('#modal_booking #form_mcu #email_m_employee').val(data.data[6]);
                }else{
                    displayWarningSwal(data.message);
                    $("#check_id").removeAttr('disabled');
                    $("#check_id span").text('Book Now');
                }

            }else{
                displayWarningSwal();
                $("#check_id").removeAttr('disabled');
                $("#check_id span").text('Book Now');
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
            $("#check_id").removeAttr('disabled');
            $("#check_id span").text('Book Now');
        }
    });
});







$("#arrival_date").attr('readonly', true);
//$('#keterangan_sudah_booking').html('');


// ACTION ONCHANGE BRANCH
$("#id_m_branch").change(function(){
    var id_m_branch = $(this).val();
    var nip_m_employee_hidden = $('#nip_m_employee_hidden').val();
    $('#tombol_booking').addClass('disabled');
    $('#arrival_date').val('');
    $('#keterangan_tidak_tersedia').html('');
    $('#keterangan_tidak_tersedia').hide();
    $('#keterangan_tersedia').html('');
    $('#keterangan_tersedia').hide();
    $('#keterangan_sudah_booking').html('');
    $('#keterangan_sudah_booking').hide();

    if(id_m_branch){
        $.ajax({
            url:"{{ route('web.check_availability') }}",
            method:"post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data:{
                id_m_branch: id_m_branch, //sek teko kenee
                nip_m_employee_hidden: nip_m_employee_hidden
            },
            success:function(data)
            {
                if(data.status ==true){
                    $("#arrival_date").slideDown();
                    $("#tidak_ada_tanggal").slideUp().html('');
                    var today;
                    today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
                    // console.log(data.disable_hari_libur);
                    let datestemp=data.disable_hari_libur.split(",");//Iki digae ngilangi koma, maklum lalian
                    datestemp=datestemp.slice(0,datestemp.length-1);// iki gae ngilangi index array seng terakhir, kewoood
                    //console.log(datestemp);
                    $('#arrival_date').datepicker(
                        {
                            format: "dd-mm-yyyy",
                            endDate: "0d",
                            clearBtn: true,
                            todayBtn: true,
                            todayHighlight: true,
                            forceParse: false,
                            disableDaysOfWeek: [0, 7],
                            disableDates: datestemp,
                            minDate: data.date_start_mcu,
                            maxDate: data.date_finish_mcu,
                            // minDate: "16-05-2022",
                            // maxDate: "20-05-2022",
                            //minDate: today,
                            // minDate: datestart,
                            // maxDate: datefinishmcu,

                            // onChange: function(selectedDates, dateStr, instance) {
                            change: function (e) {
                                var dateStr = $('#arrival_date').val();
                                var id_m_branch_after_changed = $('#id_m_branch').val();
                                var nip_m_employee_hidden_after_changed = $('#nip_m_employee_hidden').val();
                                $.ajax({
                                    url:"{{ route('web.check_quota') }}",
                                    method:"post",
                                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                    data:{
                                        id_m_branch: id_m_branch_after_changed, // Ganti id_m_branch ketika onchane yang kedua
                                        // nip_m_employee_hidden: nip_m_employee_hidden,
                                        nip_m_employee_hidden: nip_m_employee_hidden_after_changed,
                                        arrival_date: dateStr
                                    },
                                    success:function(data)
                                    {
                                        $('#loading_modal').hide();
                                        if(data.status ==true){
                                            if(data.status_tombol_booking == true){
                                                $('#tombol_booking').removeClass('disabled');
                                                $('#keterangan_tersedia').slideDown();
                                                $('#keterangan_tersedia').html('');
                                                $('#keterangan_tersedia').html(data.html);

                                                if (data.html_booking!=''){
                                                $('#keterangan_sudah_booking').slideDown();
                                                $('#keterangan_sudah_booking').html(data.html_booking);
                                                }

                                                $('#keterangan_tidak_tersedia').slideUp();
                                                $('#keterangan_tidak_tersedia').html('');
                                            }else{
                                                $('#tombol_booking').addClass('disabled');
                                                $('#keterangan_tidak_tersedia').slideDown();
                                                $('#keterangan_tidak_tersedia').html(data.html);
                                                $('#keterangan_tersedia').slideUp();
                                                $('#keterangan_tersedia').html('');
                                                $('#keterangan_sudah_booking').slideUp();
                                                $('#keterangan_sudah_booking').html('');
                                            }
                                        }else{
                                            $('#tombol_booking').addClass('disabled');
                                            $('#keterangan_tidak_tersedia').slideDown();
                                            $('#keterangan_tidak_tersedia').html(data.message);
                                            $('#keterangan_tersedia').slideUp();
                                            $('#keterangan_tersedia').html('');
                                            $('#keterangan_sudah_booking').slideUp();
                                            $('#keterangan_sudah_booking').html('');
                                        }
                                    },
                                    error: function(data){
                                        $('#loading_modal').hide();
                                        displayErrorSwal(data.message);
                                        $('#keterangan_tidak_tersedia').slideDown();
                                        $('#keterangan_tidak_tersedia').html(data.message);
                                        $('#keterangan_tersedia').slideUp();
                                        $('#keterangan_tersedia').html('');
                                        $('#keterangan_sudah_booking').slideUp();
                                        $('#keterangan_sudah_booking').html('');
                                    }
                                });
                            }
                        }
                    );
                }else{
                    $("#arrival_date").datepicker().destroy();
                    $("#arrival_date").val('').addClass('form-control').attr('readonly', true);
                    $("#tidak_ada_tanggal").slideDown().html('Mohon maaf, belum ada jadwal MCU pada lokasi tersebut');
                }
            },
            error: function(data){
                $('#loading_modal').hide();
                displayErrorSwal(data.message);
            }
        });

      //  console.log(data.disable_hari_libur);
    }
})



$('#tombol_booking').click(function(){
    $('#tombol_booking').addClass('disabled');
    $('#tombol_booking span').text('Mohon tunggu ...');
    $(".text-danger").remove();
    event.preventDefault();
    swal.fire({
        title: "Confirmation",
        html: 'Apakah Anda yakin melakukan reservasi pada tanggal tersebut ?<br>Are you sure you make a reservation on that date ?',
        icon: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        reverseButtons: !0
    }).then(function (e) {

        if(e.value){
            var id_m_employee = $("#id_m_employee").val();
            var id_m_branch = $("#id_m_branch").val();
            var nip_m_employee_hidden = $("#nip_m_employee_hidden").val();
            var arrival_date = $("#arrival_date").val();
            var hp = $("#hp").val();
            var dob_m_employee = $("#dob_m_employee_modal").val();
            var email_m_employee = $("#email_m_employee").val();

            $.ajax({
                url:"{{ route('web.submit_booking') }}",
                method:"post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{
                    id_m_employee:id_m_employee,
                    id_m_branch:id_m_branch,
                    arrival_date:arrival_date,
                    hp:hp,
                    nip_m_employee_hidden:nip_m_employee_hidden,
                    dob_m_employee:dob_m_employee,
                    email_m_employee:email_m_employee
                },
                success:function(data)
                {
                    if($.isEmptyObject(data.error)){
                        if(data.status == true){
                            // $("formlogin").each(function() { this.reset() }); Untuk mereset form
                            //$("formlogin").each(function() { this.reset() });
                            swal.fire({
                                title: "Success",
                                html: data.message,
                                icon: "success"
                            }).then(function() {
                                $('#centang').prop('checked', false);
                                location.reload();
                            });
                        }else{
                            $("#tombol_booking").removeClass('disabled');
                            $("#tombol_booking span").text('Booking Sekarang');
                            displayErrorSwal(data.message);
                        }
                    }else{
                        displayWarningSwal();
                        $("#tombol_booking").removeClass('disabled');
                        $("#tombol_booking span").text('Booking Sekarang');
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
                    $("#tombol_booking").removeClass('disabled');
                    $("#tombol_booking span").text('Booking Sekarang');
                }
            });
        }else{
            $("#tombol_booking").removeClass('disabled');
            $("#tombol_booking span").text('Booking Sekarang');
        }

    })
})


$( document ).ready(function() {
    $('#btn_modal_policy').click(function(){
        $('#modal_policy').modal('show');
    })
    $('#sayasetuju').click(function(){
        $('#centang').prop('checked', true);
        $('#check_id').removeAttr('disabled');
    })

    $('#centang').change(function () {
        if($(this).is(":checked")){
            $('#check_id').removeAttr('disabled');
        }else if($(this).is(":not(:checked)")){
            $('#check_id').attr('disabled', true);
        }
    });
});



</script>
@endsection
