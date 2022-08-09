@extends('web.layout.index')

@section('content')

<div class="row">

    <div class="col-xl-8 col-md-8 col-8 offset-md-2">
        <div class="card card-statistics">
        <div class="card-body statistics-body">
            <div class="row">
                <i data-feather="unlock" class="text-orange"></i>
                <h4 class="mb-2 mt-1 text-center">{{__('auth.login.title_forgot')}}</h4>
                <p>
                    {{__('auth.login.message_forgot')}}
                </p>
                <form method="post" id="formlogin">

                    <div class="row">

                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-4">
                                <label class="col-form-label" for="email_m_user_fo">{{__('auth.login.email')}}</label>
                                </div>
                                <div class="col-sm-8">
                                <input type="text" id="email_m_user_fo" class="form-control square" name="email_m_user_fo">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 offset-sm-4">
                            <button type="submit" id="btnlogin" class="btn btn-secondary square me-1 waves-effect waves-float waves-light"><span>{{__('auth.login.btn_confirm_email')}}</span></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>
</div>


@endsection




@section('js')
<script>
    $(document).ready( function () {


        $("#formlogin").submit(function(){
            $(".text-danger").remove();
            event.preventDefault();
            var data = new FormData($('#formlogin')[0]);
            $("#btnlogin").attr('disabled', true);
            $("#btnlogin span").text(loading_text);

            $.ajax({
                url:"{{ route("web.auth.forgot_post") }}",
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
                            $("#btnlogin span").text('{{__('auth.login.btn_confirm_email')}}');
                            $("form").each(function() { this.reset() });
                            location.href = data.redirect;
                        }else{
                            displayErrorSwal(data.message);
                            $("#btnlogin").removeAttr('disabled');
                            $("#btnlogin span").text('{{__('auth.login.btn_confirm_email')}}');
                        }

                    }else{
                        displayWarningSwal();
                        $("#btnlogin").removeAttr('disabled');
                        $("#btnlogin span").text('{{__('auth.login.btn_confirm_email')}}');
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
