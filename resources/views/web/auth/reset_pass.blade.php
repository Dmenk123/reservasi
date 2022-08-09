@extends('web.layout.index')

@section('content')

<div class="row">

    <div class="col-xl-8 col-md-8 col-8 offset-md-2">
        <div class="card card-statistics">
        <div class="card-body statistics-body">
            <div class="row">
                <i data-feather="unlock" class="text-orange"></i>
                <h4 class="mb-2 mt-1 text-center">{{__('auth.reset_pass.title')}}</h4>
                <p>
                    {{__('auth.reset_pass.message')}}
                </p>
                <form method="post" id="formlogin">

                    <div class="row">

                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-4">
                                <label class="col-form-label" for="new_pass">{{__('auth.reset_pass.label_pass1')}}</label>
                                </div>
                                <div class="col-sm-8">
                                <input type="hidden" id="email_m_user_fo" value="{{$email_m_user_fo}}" class="form-control square" name="email_m_user_fo">
                                <input type="password" id="new_pass" class="form-control square" name="new_pass">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-1 row">
                                <div class="col-sm-4">
                                <label class="col-form-label" for="renew_pass">{{__('auth.reset_pass.label_pass2')}}</label>
                                </div>
                                <div class="col-sm-8">
                                <input type="password" id="renew_pass" class="form-control square" name="renew_pass">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 offset-sm-4">
                            <button type="submit" id="btnlogin" class="btn btn-secondary square me-1 waves-effect waves-float waves-light"><span>{{__('auth.reset_pass.btn_submit')}}</span></button>
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
                url:"{{ route("web.auth.reset_pass_post") }}",
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
                            $("#btnlogin span").text('{{__('auth.reset_pass.btn_submit')}}');
                            $("form").each(function() { this.reset() });
                            swal.fire({
                                title: "Success",
                                text: data.message,
                                icon: "success"
                            }).then(function() {
                                location.href = data.redirect;
                            });
                        }else{
                            displayErrorSwal(data.message);
                            $("#btnlogin").removeAttr('disabled');
                            $("#btnlogin span").text('{{__('auth.reset_pass.btn_submit')}}');
                        }

                    }else{
                        displayWarningSwal();
                        $("#btnlogin").removeAttr('disabled');
                        $("#btnlogin span").text('{{__('auth.reset_pass.btn_submit')}}');
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
