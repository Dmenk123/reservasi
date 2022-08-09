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

    .select2-container {
        width: 100% !important;
    }

    .select2-search--dropdown .select2-search__field {
        width: 98%;
    }
</style>
<h3 class="text-success text-center">Survey Diagnosis Stress</h3>
<h6 class="text-center">Kerahasiaan anda dijamin</h6>

<form method="post" id="form">

    <div class="row">
        <div class="col-md-12 hal1" style="">
            @include('web.layout.form_sds')
        </div>
    </div>
    {{-- </div> --}}
    <div class="d-flex justify-content-around p-3">
        {{-- <div class="d-flex" style="display: none">
            <button id="btn_prev" name="btn_prev" class="btn btn-warning btn-md"><span>Back</span></button>
        </div> --}}
        <div class="d-flex rightbtn" style="">
            <button type="submit" id="btn_submit" name="btn_submit"
                class="btn btn-danger btn-md"><span>Submit</span></button>
        </div>
    </div>
</form>
@include('web.layout.policy')

@endsection


@section('js')
<script>
    function submit(){
        event.preventDefault();
        var data = new FormData($('#form')[0]);
        $("#btn_submit").attr('disabled', true);
        $("#btn_submit span").text(loading_text);
        $("[id^=error_]").remove();
        $.ajax({
            url:"{{route('web.submit_form_sds')}}",
            method:"POST",
            headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
            data: data,
            processData: false,
            contentType: false,
            success:function(data)
            {
                if($.isEmptyObject(data.error)){
                    if(data.status == true){
                        $("#btn_submit").removeAttr('disabled');
                        $("#btn_submit span").text('Submit');
                        swal.fire({
                            title: "Success",
                            text: data.message,
                            icon: "success"
                        }).then(function() {
                            $("form").each(function() { this.reset() });
                            location.href = data.redirect;
                        });
                    }else{
                        displayErrorSwal(data.message);
                        $("#btn_submit").removeAttr('disabled');
                        $("#btn_submit span").text('Submit');
                    }
                }else{
                    displayWarningSwal();
                    $("#btn_submit").removeAttr('disabled');
                    $("#btn_submit span").text('Submit');
                    $.each(data.error, function(key, value) {
                            let classes="\"text-danger text-center\""
                            var element = $("#" + key);
                            element.closest("div.col-md-12")
                            .find("#error_" + key).remove();
                            element.closest("div.col-md-12")
                            .before("<div id=error_"+ key + " class="+classes+">" + value + "</div>");
                            $("#"+key).blur();
                    });

                    let elem=null;
                    $.each(data.error,function(key,val){
                        // console.log(key);
                        if(val!=""){
                            elem=key;
                            return false;
                        }
                    });
                    console.log(elem);
                    $(document).ready(function(){
                        document.getElementById(elem).focus();
                    });
                }
            },
            error: function(data){
                displayErrorSwal(data.message);
            }
        });
    }
    //submit logic start
    $(document).ready( function () {
        $("#form").submit(submit);
    });
    //submit logic end

</script>
@endsection
