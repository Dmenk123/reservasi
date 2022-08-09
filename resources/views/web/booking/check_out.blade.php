@extends('web.layout.index')

@section('content')
<style>
    [type="checkbox"][readonly="readonly"]::before {
        background: rgba(255,255,255,.5);
        content: '';
        display: block;
        height: 100%;
        width: 100%;
    }
</style>
<h3 style="color: red;" class="text-center">Check Out Page</h3>

<div class="alert alert-info">
    <h4 class="text-center">{{($old->id_m_branch_company) ? $old->m_branch_company->m_company->nm_m_company.' - '.$old->m_branch_company->nm_m_branch_company : ''}}</h4> 
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
                    <input type="hidden" id="id_t_qrcode_hidden" name="id_t_qrcode_hidden" value="{{request()->get('id_t_qrcode')}}" />
                    <input type="hidden" id="id_m_employee_hidden" name="id_m_employee_hidden" value="{{request()->get('id_m_employee')}}" />
                    {{-- <input type="hidden" id="nip_m_employee_hidden" name="nip_m_employee_hidden" value="{{request()->get('nip_m_employee')}}" /> --}}
                    <input type="text" placeholder="example : 80423333" value="{{request()->get('nip_m_employee')}}" autofocus maxlength="16" style="text-align: center;" id="nip_m_employee" class="form-control form-control-lg square" autocomplete="off" name="nip_m_employee">
                </div>
                <div class="col-md-2 my-2"></div>
            </div>
        </div>


        <div class="col-md-12 text-center mb-3 mt-3">
            {{-- <button type="submit" id="btnlogin" class="btn btn-warning btn-lg"><span>Check ID (1)</span></button> --}}
            <button type="submit" id="btnlogin2" class="btn btn-warning btn-lg"><span>Check ID</span></button>
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
        <h4 class="modal-title" id="myModalLabel1">Check Out Confirmation</h4>
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
                                <input type="hidden" readonly value="{{request()->get('id_t_qrcode')}}" id="id_t_qrcode" class="form-control form-control square" name="id_t_qrcode">
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
                                <input type="text" readonly id="dob_m_employee_modal" class="form-control form-control square" name="dob_m_employee_modal">
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

                <div class="row mb-1">
                    <div class="col-12">
                        <div class="col-lg-12 col-md-12">
                            <p><strong>Apakah Pemeriksaan Kesehatan Anda sudah lengkap ? (pilih salah satu)</strong><br>
                            <em>Have you completed your Medical Check Up ? (please choose one)</em>
                            </p>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <!-- button group radio -->
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                              <input type="radio" class="btn-check" value="LENGKAP" name="is_lengkap" id="btnradio1" autocomplete="off" />
                              <label class="btn btn-outline-success" for="btnradio1">Sudah Lengkap</label>
              
                              <input type="radio" class="btn-check" value="BELUM LENGKAP" name="is_lengkap" id="btnradio2" autocomplete="off" />
                              <label class="btn btn-outline-success" for="btnradio2">Belum Lengkap</label>
                            </div>
                          </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <br>
                        <p><strong>Pilih setidaknya 1 (satu) jenis pemeriksaan yang telah dilakukan untuk melanjutkan Check Out</strong>
                            <br>
                            Choose at least 1 (one) Medical Check to continue</p>
                        @foreach ($group_mcu as $item)
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="group_{{$item->id_m_group_mcu}}">
                                            <input class="form-check-input s pemeriksaan" type="checkbox" value="{{$item->id_m_group_mcu}}" id="group_{{$item->id_m_group_mcu}}" name="m_group_mcu[]" > {{$item->nm_m_group_mcu}}
                                        </label>
                                    </div> 
                                </div>
                            </div>
                        @endforeach
                        <br>
                    </div>
                </div>

                
                
                <div class="alert alert-warning">
                    <div class="alert-body">
                        <strong>Apakah Anda yakin akan melakukan CHECK OUT sekarang ?</strong><br><em>Are you sure you want to check-out ?</em>
                    </div>
                </div>

                <div class="col-md-12 text-center mb-3 mt-3">
                    <button type="button" id="btncheckin_modal" class="btn btn-danger btn-lg me-2"><span>Check Out Now</span></button>
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
    var push_group_mcu;
    var tombol_lengkap;
    $(document).ready( function () {
        {{-- OPSI 1 : USE FORM --}}
        $("#btnlogin").click(function(){
            $(".text-danger").remove();
            event.preventDefault();
            var data = new FormData($('#formlogin')[0]);
            $("#btnlogin").attr('disabled', true);
            $("#btnlogin span").text(loading_text);

            $.ajax({
                url:"{{ route("web.auth.authenticate_out") }}",
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
        $("#btnlogin2").click(function(){
            $(".text-danger").remove();
            event.preventDefault();
            var data = new FormData($('#formlogin')[0]);
            $("#btnlogin2").attr('disabled', true);
            $("#btnlogin2 span").text(loading_text);

            $.ajax({
                url:"{{ route("web.auth.authenticate_out") }}",
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

                    $.ajax({
                        url:"{{ route('web.auth.checkin') }}",
                        method:"post",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data:{
                            nip_m_employee:nip_m_employeex,
                            id_t_qrcode:id_t_qrcode,
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
            event.preventDefault();
            var data = new FormData($('#form_checkin_modal')[0]);
            $('#loading_modal').show();

            
            $.ajax({
                url:"{{ route('web.auth.checkout') }}",
                method:"post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:data,
                processData: false,
                contentType: false,
                success:function(data)
                {
                    $('#loading_modal').hide();
                    if(data.status == true){
                        $('#form_checkin_modal').slideUp();
                        $('#form_checkin_success_modal').slideDown();
                        $('#form_checkin_success_modal .alert-body').html(data.html);
                    }else{
                        displayWarningSwal(data.message);
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

        
    });




    @if(request()->filled('id_m_employee'))
    checkout_bypass();

    function checkout_bypass(){
        var data = new FormData($('#formlogin')[0]);
        $.ajax({
            url:"{{ route('web.auth.authenticate_out') }}",
            method:"post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data:data,
            processData: false,
            contentType: false,
            success:function(data)
            {
                if(data.status == true){
                    $("#modal_checkin").modal('show');
                    $("#btnlogin2").removeAttr('disabled');
                    $("#btnlogin2 span").text('Check ID (2)');
                    $("form").each(function() { this.reset() });
                    $('#form_checkin_modal').show();
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
            },
            error: function(data){
                $('#loading_modal').hide();
                displayErrorSwal(data.message);
            }
        });
    }
    @endif


    // CHECK ALL PEMERIKSAAN KETIKA DI KLIK TOMBOL SUDAH LENGKAP
    $('#btnradio1').click(function(){
        tombol_lengkap = 'ya';
        $('.pemeriksaan').not(this).prop('checked', this.checked); // MODE FLEKSIBEL
        // $('.pemeriksaan').not(this).prop('checked', this.checked).attr('readonly','readonly'); //MODE SAKLEK
    })

    // UNCHECK ALL PEMERIKSAAN KETIKA DI KLIK TOMBOL BELUM LENGKAP
    $('#btnradio2').click(function(){
        tombol_lengkap = 'tidak';
        $('.pemeriksaan').not(this).prop('checked', false).removeAttr('readonly');
    })


    // SILAHKAN KOMEN BLOK CODE INI JIKA INGIN FLEKSIBEL [START]
    // $('.pemeriksaan').click(function(){
    //     if(tombol_lengkap == 'ya'){
    //         return false;
    //     }else if(tombol_lengkap == 'tidak'){
    //         return true;
    //     }
    // });
    // SILAHKAN KOMEN BLOK CODE INI JIKA INGIN FLEKSIBEL [END]

    

</script>
@endsection
