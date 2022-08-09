@extends('web.layout.index')

@section('content')


<h3 class="text-success text-center">Booking Page</h3>

<div class="alert alert-info">
    {{-- <h4 class="text-center">{{($old->id_m_branch_company) ? $old->m_branch_company->m_company->nm_m_company.' - '.$old->m_branch_company->nm_m_branch_company : ''}}</h4>  --}}

    <h4 class="text-center">PT. HM SAMPOERNA</h4>
</div>

<form method="post" id="formlogin">

    <div class="row">


        <div class="col-md-12">
            <div class="mb-1 row text-center">
                <label class="col-form-label" for="nip_m_employee">
                    <strong>Masukkan Nomor Induk Pegawai Anda</strong>
                    <br>
                    <em>Please Enter Your Employee ID</em>
                </label>
                <div class="col-md-2 my-2"></div>
                <div class="col-md-8 my-2">
                    <input type="text" placeholder="example : 80423333" autofocus maxlength="16" style="text-align: center;" id="nip_m_employee" class="form-control form-control-lg square" autocomplete="off" name="nip_m_employee">
                </div>
                <div class="col-md-2 my-2"></div>
            </div>
        </div>


        <div class="col-md-12 text-center mb-3 mt-3">
            {{-- <button type="submit" id="btnlogin" class="btn btn-warning btn-lg"><span>Check ID (1)</span></button> --}}
            <button type="submit" id="btnlogin2" class="btn btn-warning btn-lg"><span>Check ID (2)</span></button>
        </div>

    </div>
</form>





<div id="form_checkin" style="display: none;">

    <div id="loading" style="display: none;" class="text-center">
        <img src="{{asset('assets/images/loading.gif')}}" alt="" /> Please wait ...
    </div>

    <div class="row">
        <div class="col-md-6">

            <div class="mb-1 row">
                <label class="col-form-label" for="nip_m_employeex">
                    <strong>Nomor Induk Pegawai</strong>
                    <br>
                    <em>Employee ID</em>
                </label>
                <div class="col-md-12 my-1">
                    <input type="text" readonly id="nip_m_employeex" class="form-control form-control square" name="nip_m_employeex">
                </div>
            </div>

            <div class="mb-1 row">
                <label class="col-form-label" for="dob_m_employeex">
                    <strong>Tanggal Lahir</strong>
                    <br>
                    <em>Date of Birth</em>
                </label>
                <div class="col-md-12 my-1">
                    <input type="text" readonly id="dob_m_employeex" class="form-control form-control square" name="dob_m_employeex">
                </div>
            </div>



        </div>

        <div class="col-md-6">

            <div class="mb-1 row">
                <label class="col-form-label" for="nm_m_employeex">
                    <strong>Nama</strong>
                    <br>
                    <em>Name</em>
                </label>
                <div class="col-md-12 my-1">
                    <input type="text" readonly id="nm_m_employeex" class="form-control form-control square" name="nm_m_employeex">
                </div>
            </div>

            <div class="mb-1 row">
                <label class="col-form-label" for="address_m_employeex">
                    <strong>Alamat</strong>
                    <br>
                    <em>Address</em>
                </label>
                <div class="col-md-12 my-1">
                    <input type="text" readonly id="address_m_employeex" class="form-control form-control square" name="address_m_employeex">
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="mb-1 row">
                <label class="col-form-label" for="no_reg">
                    <strong>Masukkan No. Registrasi (Opsional)</strong>
                    <br>
                    <em>Registration Number (Optional)</em>
                </label>
                <div class="col-md-12 my-1">
                    <input type="text" id="no_reg" class="form-control form-control square" name="no_reg">
                </div>
            </div>
        </div>

    </div>


    <div class="col-md-12 text-center mb-5 mt-3">
        <button type="submit" id="btncheckin" class="btn btn-warning btn-lg me-2"><span>CHECK IN</span></button>
        <button type="button" id="btncancel" class="btn btn-secondary btn-lg"><span>CANCEL</span></button>
    </div>


</div>



<div id="form_checkin_success" style="display: none">
    <div class="alert alert-success">
        <div class="alert-body">

        </div>
        <div class="alert-footer mt-1">
            <button type="button" id="done" class="btn btn-success btn-lg"><span>Done</span></button>
        </div>
    </div>
</div>

<div class="modal fade text-start show" id="modal_checkin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Booking Confirmation</h4>
        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
            <div id="loading_modal" style="display: none;" class="text-center">
                <img src="{{asset('assets/images/loading.gif')}}" alt="" /> Please wait ...
            </div>
            <form id="form_checkin_modal" method="POST">

                <div class="row">
                    <div class="col-md-6">

                        <div class="mb-1 row">
                            <label class="col-form-label" for="nip_m_employee_modal">
                                <strong>Nomor Induk Pegawai</strong>
                                <br>
                                <em>Employee ID</em>
                            </label>
                            <div class="col-md-12 my-1">
                                <input type="text" readonly id="nip_m_employee_modal" class="form-control form-control square" name="nip_m_employee_modal">
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <label class="col-form-label" for="dob_m_employee_modal">
                                <strong>Tanggal Lahir</strong>
                                <br>
                                <em>Date of Birth</em>
                            </label>
                            <div class="col-md-12 my-1">
                                <input type="text" readonly id="dob_m_employee_modal" class="form-control" name="dob_m_employee_modal">
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-1 row">
                            <label class="col-form-label" for="nm_m_employee_modal">
                                <strong>Nama</strong>
                                <br>
                                <em>Name</em>
                            </label>
                            <div class="col-md-12 my-1">
                                <input type="text" readonly id="nm_m_employee_modal" class="form-control form-control square" name="nm_m_employee_modal">
                            </div>
                        </div>


                        <div class="mb-1 row">
                            <label class="col-form-label" for="address_m_employee_modal">
                                <strong>Alamat</strong>
                                <br>
                                <em>Address</em>
                            </label>
                            <div class="col-md-12 my-1">
                                <input type="text" readonly id="address_m_employee_modal" class="form-control form-control square" name="address_m_employee_modal">
                            </div>
                        </div>

                    </div>



                </div>



                <div class="row">
                    <div class="col-md-6">

                        <div class="mb-1 row">
                            <label class="col-form-label" for="nip_m_employee_modal">
                                <strong>Pilih Tanggal Pemeriksaan</strong>
                                <br>
                                <em>Choose MCU date</em>
                            </label>
                            <div class="col-md-12 my-1">
                                <input type="text" placeholder="start date" id="date_start_mcu" name="date_start_mcu" class="form-control datepicker">
                            </div>
                        </div>

                        {{-- <div class="mb-1 row">
                            <label class="col-form-label" for="dob_m_employee_modal">
                                <strong>Tanggal Lahir</strong>
                                <br>
                                <em>Date of Birth</em>
                            </label>
                            <div class="col-md-12 my-1">
                                <input type="text" readonly id="dob_m_employee_modal" class="form-control form-control square" name="dob_m_employee_modal">
                            </div>
                        </div> --}}

                    </div>

                    <div class="col-6">

                        <div class="mb-1 row">
                            <label class="col-form-label" for="nm_m_employee_modal">
                                <strong>Pilih Lokasi Pemeriksaan</strong>
                                <br>
                                <em>Pleasse choose MCU location</em>
                            </label>
                            <div class="col-12 my-1">
                                <select class="select2 form-select" id="id_m_branch" name="id_m_branch">
                                    <option value="" >Please Choose MCU Location 1</option>
                                    @foreach($m_branch as $item_m_branch)
                                    <option value="{{$item_m_branch->id_m_branch}}" >{{$item_m_branch->nm_m_branch}}</option>
                                    @endforeach
                                  </select>



                            </div>
                        </div>




                        {{-- <div class="mb-1 row">
                            <label class="col-form-label" for="address_m_employee_modal">
                                <strong>Alamat</strong>
                                <br>
                                <em>Address</em>
                            </label>
                            <div class="col-md-12 my-1">
                                <input type="text" readonly id="address_m_employee_modal" class="form-control form-control square" name="address_m_employee_modal">
                            </div>
                        </div> --}}

                    </div>



                </div>

                {{-- <div class="alert alert-warning">
                    <div class="alert-body">
                        <strong>Apakah Anda yakin akan melakukan CHECK IN sekarang ?</strong><br><em>Are you sure you want to check-in ?</em>
                    </div>
                </div> --}}

                <div class="alert alert-warning">
                    <div class="alert-body">
                        <strong>Tanggal Pemesanan : hari, 03 November 2021 </strong><br><em>Booking Date : Day Name, 03 November 2021</em>
                        <strong>Lokasi MCU : Pramita - Ngagel</strong><br><em>Mcu Location: Pramita - Ngagel</em> <br>
                        <strong>Kuota : 100 Peserta</strong><br><em>Quota: 100 Participant</em> <br>
                        <strong>Kuota Terisi : 80 Peserta</strong><br><em>Quota Filled: 80 Participant</em> <br>
                        <strong>Sisa Kuota : 20 Peserta</strong><br><em>Remaing Quota: 20 Participant</em> <br>

                    </div>
                </div>


                {{-- <div class="alert alert-warning">
                    <div class="alert-body">
                        <strong>Maaf kuota pada hari, tanggal xx-xx-xx lokasi: nm_m_branch sudah penuh / Tidak tersedia, mohon untuk memilih tanggal / lokasi MCU yang lain</strong><br><em>Are you sure you want to check-in ?</em>
                    </div>
                </div> --}}

                <div class="col-md-12 text-center mb-3 mt-3">
                    <button type="button" id="btncheckin_modal" class="btn btn-success btn-lg me-2"><span>Booking</span></button>
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary btn-lg"><span>Cancel</span></button>
                </div>
            </form>

            <div id="form_checkin_success_modal" style="display: none">
                <div class="alert alert-success">
                    <div class="alert-body">

                    </div>
                    <div class="alert-footer mt-1">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-success btn-lg"><span>Done</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection




@section('js')
<script>
    $(document).ready( function () {
        {{-- OPSI 1 : USE FORM --}}
        $("#btnlogin").click(function(){
            $(".text-danger").remove();
            event.preventDefault();
            var data = new FormData($('#formlogin')[0]);
            $("#btnlogin").attr('disabled', true);
            $("#btnlogin span").text(loading_text);

            $.ajax({
                url:"{{ route("web.auth.authenticate") }}",
                method:"POST",
                headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
                data: data,
                processData: false,
                contentType: false,
                success:function(data)
                {
                    if($.isEmptyObject(data.error)){
                        if(data.status == true){
                            $("#btnlogin").removeAttr('disabled');
                            $("#btnlogin span").text('Check ID (1)');
                            $("form").each(function() { this.reset() });
                            // location.href = data.redirect;
                            $('#form_checkin').slideDown();
                            $('#form_checkin #nip_m_employeex').val(data.data[0]);
                            $('#form_checkin #nm_m_employeex').val(data.data[1]);
                            $('#form_checkin #dob_m_employeex').val(data.data[2]);
                            $('#form_checkin #address_m_employeex').val(data.data[3]);

                            $('#formlogin').slideUp();

                        }else{
                            displayWarningSwal(data.message);
                            $("#btnlogin").removeAttr('disabled');
                            $("#btnlogin span").text('Check ID (1)');
                        }

                    }else{
                        displayWarningSwal();
                        $("#btnlogin").removeAttr('disabled');
                        $("#btnlogin span").text('Check ID (1)');
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
                    $("#btnlogin").removeAttr('disabled');
                    $("#btnlogin span").text('Check ID (1)');
                }
            });
        });


        {{-- OPSI 2 : USE MODAL --}}
        // $("#btnlogin2").click(function(){
        //     $(".text-danger").remove();
        //     event.preventDefault();
        //     var data = new FormData($('#formlogin')[0]);
        //     $("#btnlogin2").attr('disabled', true);
        //     $("#btnlogin2 span").text(loading_text);

        //     $.ajax({
        //         url:"{{ route("web.auth.authenticate") }}",
        //         method:"POST",
        //         headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
        //         data: data,
        //         processData: false,
        //         contentType: false,
        //         success:function(data)
        //         {
        //             if($.isEmptyObject(data.error)){
        //                 if(data.status == true){
        //                     $("#modal_checkin").modal('show');
        //                     $("#btnlogin2").removeAttr('disabled');
        //                     $("#btnlogin2 span").text('Check ID (2)');
        //                     $("form").each(function() { this.reset() });
        //                     $('#form_checkin_modal').show();
        //                     $('#no_reg').val('');
        //                     $('#form_checkin_success_modal').hide();
        //                     $('#modal_checkin #form_checkin_modal #nip_m_employee_modal').val(data.data[0]);
        //                     $('#modal_checkin #form_checkin_modal #nm_m_employee_modal').val(data.data[1]);
        //                     $('#modal_checkin #form_checkin_modal #dob_m_employee_modal').val(data.data[2]);
        //                     $('#modal_checkin #form_checkin_modal #address_m_employee_modal').val(data.data[3]);
        //                 }else{
        //                     displayWarningSwal(data.message);
        //                     $("#btnlogin2").removeAttr('disabled');
        //                     $("#btnlogin2 span").text('Check ID (2)');
        //                 }

        //             }else{
        //                 displayWarningSwal();
        //                 $("#btnlogin2").removeAttr('disabled');
        //                 $("#btnlogin2 span").text('Check ID (2)');
        //                 $.each(data.error, function(key, value) {
        //                     var element = $("#" + key);
        //                     element.closest("div.form-control")
        //                     .removeClass("text-danger")
        //                     .addClass(value.length > 0 ? "text-danger" : "")
        //                     .find("#error_" + key).remove();
        //                     element.after("<div id=error_"+ key + " class=text-danger>" + value + "</div>");
        //                 });
        //             }
        //         },
        //         error: function(data){
        //             displayErrorSwal(data.message);
        //             $("#btnlogin2").removeAttr('disabled');
        //             $("#btnlogin2 span").text('Check ID (2)');
        //         }
        //     });
        // });

        {{-- OPSI 2 : USE MODAL --}}
        $("#btnlogin2").click(function(){
            $(".text-danger").remove();
            event.preventDefault();
            var data = new FormData($('#formlogin')[0]);
            $("#btnlogin2").attr('disabled', true);
            $("#btnlogin2 span").text(loading_text);

            $.ajax({
                url:"{{ route("web.auth.authenticate") }}",
                method:"POST",
                headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
                data: data,
                processData: false,
                contentType: false,
                success:function(data)
                {
                    if($.isEmptyObject(data.error)){
                        if(data.status == true){
                            $("#modal_checkin").modal('show');
                            $("#btnlogin2").removeAttr('disabled');
                            $("#btnlogin2 span").text('Check ID (2)');
                            $("form").each(function() { this.reset() });
                            $('#form_checkin_modal').show();
                            $('#no_reg').val('');
                            $('#form_checkin_success_modal').hide();
                            $('#modal_checkin #form_checkin_modal #nip_m_employee_modal').val(data.data[0]);
                            $('#modal_checkin #form_checkin_modal #nm_m_employee_modal').val(data.data[1]);
                            $('#modal_checkin #form_checkin_modal #dob_m_employee_modal').val(data.data[2]);
                            $('#modal_checkin #form_checkin_modal #address_m_employee_modal').val(data.data[3]);
                        }else{
                            displayWarningSwal(data.message);
                            $("#btnlogin2").removeAttr('disabled');
                            $("#btnlogin2 span").text('Check ID (2)');
                        }

                    }else{
                        displayWarningSwal();
                        $("#btnlogin2").removeAttr('disabled');
                        $("#btnlogin2 span").text('Check ID (2)');
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
                    $("#btnlogin2").removeAttr('disabled');
                    $("#btnlogin2 span").text('Check ID (2)');
                }
            });
        });





        $('#btncheckin').click(function(){
            var nip_m_employeex = $('#nip_m_employeex').val();
            var no_reg = $('#no_reg').val();
            var id_t_qrcode = '{{request()->get('id_t_qrcode')}}';
            swal.fire({
                title: "Confirmation",
                html: 'Apakah Anda yakin akan melakukan CHECK IN sekarang ?<br>Are you sure you want to check-in ?',
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                reverseButtons: !0
            }).then(function (e) {

                if(e.value){
                    $('#loading').show();
                    $('#no_reg').val('');
                    $('#no_reg_modal').val('');

                    $.ajax({
                        url:"{{ route('web.auth.checkin') }}",
                        method:"post",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data:{
                            nip_m_employee:nip_m_employeex,
                            id_t_qrcode:id_t_qrcode,
                            no_reg:no_reg
                        },
                        success:function(data)
                        {
                            if(data.status == true){
                                    $('#loading').hide();
                                    $('#form_checkin').slideUp();
                                    $('#form_checkin_success').slideDown();
                                    $('#form_checkin_success .alert-body').html(data.html);
                                // });
                            }else{
                                $('#loading').hide();
                                displayErrorSwal(data.message);
                            }
                        },
                        error: function(data){
                            $('#loading').hide();
                            displayErrorSwal(data.message);
                        }
                    });
                }

                })
        })


        $('#btncheckin_modal').click(function(){
            var nip_m_employeex = $('#nip_m_employee_modal').val();
            var no_reg = $('#no_reg_modal').val();
            var id_t_qrcode = '{{request()->get('id_t_qrcode')}}';
            $('#loading_modal').show();

            $.ajax({
                url:"{{ route('web.auth.checkin') }}",
                method:"post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{
                    nip_m_employee:nip_m_employeex,
                    id_t_qrcode:id_t_qrcode,
                    no_reg:no_reg
                },
                success:function(data)
                {
                    $('#loading_modal').hide();
                    $('#no_reg').val('');
                    $('#no_reg_modal').val('');
                    if(data.status == true){
                        $('#form_checkin_modal').slideUp();
                        $('#form_checkin_success_modal').slideDown();
                        $('#form_checkin_success_modal .alert-body').html(data.html);
                    }else{
                        displayErrorSwal(data.message);
                    }
                },
                error: function(data){
                    $('#loading_modal').hide();
                    displayErrorSwal(data.message);
                }
            });
        })

        $('#btncancel').click(function(){
            $('#formlogin').slideDown();
            $('#form_checkin').slideUp();
        })

        $('#done').click(function(){
            $('#formlogin').slideDown();
            $('#form_checkin_success').slideUp();
        })


        $('.datepicker').each(function() {
            $(this).datepicker({
                format: "dd-mm-yyyy",
                endDate: "0d",
                clearBtn: true,
                todayBtn: true,
                todayHighlight: true,
                forceParse: false
            });
        });
        
    });



</script>
@endsection
