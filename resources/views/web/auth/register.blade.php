@extends('web.layout.index')

@section('content')

<div class="row">
    <div class="col-xl-10 col-md-10 col-10">
        <div class="card card-statistics">
        <div class="card-body statistics-body">
            <div class="row">
                <i data-feather="user" class="text-orange"></i>
                <h4 class="mb-2 mt-1 text-center">{{__('auth.register.title_register')}}</h4>

                @if(session('status'))

                <div class="alert bg-light-success p-2">{{session('message')}}</div>

                @endif

                <form method="post" id="formregister">

                    <div class="row">

                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-4">
                                <label class="col-form-label" for="email_m_user_fo">{{__('auth.register.email')}}</label>
                                </div>
                                <div class="col-sm-8">
                                <input type="text" id="email_m_user_fo" class="form-control square" name="email_m_user_fo">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-4">
                                <label class="col-form-label" for="nik_m_user_fo">{{__('auth.register.nik')}}</label>
                                </div>
                                <div class="col-sm-8">
                                <input type="text" maxlength="16" id="nik_m_user_fo" class="form-control square" name="nik_m_user_fo">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-4">
                                <label class="col-form-label" for="hp_m_user_fo">{{__('auth.register.hp')}}</label>
                                </div>
                                <div class="col-sm-8">
                                <input type="text" id="hp_m_user_fo" class="form-control square" name="hp_m_user_fo">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-4">
                                <label class="col-form-label" for="password">{{__('auth.register.password')}}</label>
                                </div>
                                <div class="col-sm-8">
                                <input type="password" id="password" class="form-control square" name="password">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-4">
                                <label class="col-form-label" for="password">{{__('auth.register.repassword')}}</label>
                                </div>
                                <div class="col-sm-8">
                                <input type="password" id="repassword" class="form-control square" name="repassword">
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 offset-sm-4 mb-2">
                            <label for="agree"><input type="checkbox" value="agree" id="agree" name="agree" /> &nbsp;{!!__('auth.register.text_agreement')!!}</label>
                        </div>

                        <div class="col-sm-12 offset-sm-4">
                            <button type="submit" id="btnregister" class="btn btn-secondary square me-1 waves-effect waves-float waves-light"><span>{{__('auth.register.btn_register')}}</span></button>
                        </div>
                        
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>


</div>


<div class="modal fade text-start show" id="modal_agreement" tabindex="-1"  role="dialog">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">{{ __('auth.register.popup_agreement_title') }}</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! __('auth.register.popup_agreement_desc') !!}
            <br>
            <br>
            <a class="btn btn-danger square" id="btn_agree" href="javascript:void(0)">{{ __('auth.register.popup_agreement_button') }}</a>
        </div>
    </div>
    </div>
</div>

@endsection




@section('js')
<script>

    $('#btnregister').addClass('disabled');

    $('.open_modal_agreement').click(function(){
        $('#modal_agreement').modal('show');
    })

    $('#agree').click(function(){
        if($(this).is(':checked')){
            $('#btnregister').removeClass('disabled');
        } else {
            $('#btnregister').addClass('disabled');
        }
    });

    $('#btn_agree').click(function(){
        $('#agree').prop('checked', true);
        $('#btnregister').removeClass('disabled');
        $('#modal_agreement').modal('hide');
    });

    $(document).ready( function () {
        $("#formregister").submit(function(){
            $(".text-danger").remove();
            event.preventDefault();
            var data = new FormData($('#formregister')[0]);
            $("#btnregister").attr('disabled', true);
            $("#btnregister span").text(loading_text);

            $.ajax({
                url:"{{ route("web.auth.register_post") }}",
                method:"POST",
                headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
                data: data,
                processData: false,
                contentType: false,
                success:function(data)
                {
                    if($.isEmptyObject(data.error)){

                        if(data.status == true){
                            $("#btnregister").removeAttr('disabled');
                            $("#btnregister span").text('{{__('auth.register.btn_register')}}');
                            $("form").each(function() { this.reset() });
                            location.href = data.redirect;
                        }else{
                            displayErrorSwal(data.message);
                            $("#btnregister").removeAttr('disabled');
                            $("#btnregister span").text('{{__('auth.register.btn_register')}}');
                        }

                    }else{
                        displayWarningSwal();
                        $("#btnregister").removeAttr('disabled');
                        $("#btnregister span").text('{{__('auth.register.btn_register')}}');
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
        });



        $("#formlogin").submit(function(){
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
                            $("#btnlogin span").text('{{__('auth.login.btn_login')}}');
                            $("form").each(function() { this.reset() });
                            location.href = data.redirect;
                        }else{
                            displayErrorSwal(data.message);
                            $("#btnlogin").removeAttr('disabled');
                            $("#btnlogin span").text('{{__('auth.login.btn_login')}}');
                        }

                    }else{
                        displayWarningSwal();
                        $("#btnlogin").removeAttr('disabled');
                        $("#btnlogin span").text('{{__('auth.login.btn_login')}}');
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
        });
    });

</script>
@endsection
