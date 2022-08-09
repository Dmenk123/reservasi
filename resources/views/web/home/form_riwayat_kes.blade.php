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
<h3 class="text-center" style="color:blue;">FORM RIWAYAT KESEHATAN</h3>

<form method="get" id="form">

    <div class="row">
        <div class="col-md-12 hal1">
            @include('web.layout.form_rk_1')
        </div>
        <div class="col-md-12 hal2" style="display: none;">
            @include('web.layout.form_rk_2')
        </div>
        <div class="col-md-12 hal3" style="display: none;">
            @include('web.layout.form_rk_3')
        </div>
        <div class="col-md-12 hal4" style="display: none;">
            @include('web.layout.form_rk_4')
        </div>
        <div class="col-md-12 hal5" style="display: none;">
            @include('web.layout.form_rk_5')
        </div>
        <div class="col-md-12 hal6" style="display: none">
            @include('web.layout.form_rk_6')
        </div>
    </div>
    {{-- </div> --}}
    <div class="d-flex justify-content-around p-3">
        <div class="d-flex" style="display: none">
            <button type="button" id="btn_prev" name="btn_prev" class="btn btn-warning btn-md"><span>Back</span></button>
        </div>
        <div class="d-flex rightbtn" style="">
            <button type="button" id="btn_next" name="btn_next" class="btn btn-success btn-md"><span>Next</span></button>
        </div>
    </div>
</form>
@include('web.layout.policy')

@endsection


@section('js')
<script>

    //form logic start
    window.onpageshow = function(event) {
		if (event.persisted) {
			window.location.reload();
		}
	};
    $('#btn_prev').hide();

    let nextbtn='<button type="button" id="btn_next" name="btn_next" class="btn btn-success btn-md"><span>Next</span></button>';
    let submittext='<span>Submit</span>';
    let nexttext='<span>Next</span>';
    let total_hal=6;
    var hal=1;
    let submit=false;
    $('#btn_prev').on("click",function(){
        submit=false;
        if(hal>1){
            let selector='.hal'+hal;
            let selector_prev='.hal'+(hal-1);
            $(selector).hide();
            $(selector_prev).show();
            hal--;
            if(hal==1){
                $('#btn_prev').hide();
            }
            $('html, body').animate({ scrollTop: 0 }, 'fast');
            if($("#btn_next").attr("type")=="submit"){
                $(document).ready(function(){
                    $("#btn_next").attr("type","button");
                    $('#btn_next').removeClass("btn-danger");
                    $('#btn_next').addClass("btn-success");
                    $('#btn_next').html(nexttext);
                });
            }
        }
    });

    $('.rightbtn').on("click","button",function(){
        let radiobtnno="#radio_"+(hal-1)+"_no";
        let radiobtnyes="#radio_"+(hal-1)+"_yes";
        if(hal<total_hal){
            let selector='.hal'+hal;
            let selector_next='.hal'+(hal+1);
            event.preventDefault();
            var data = new FormData($('#form')[0]);
            data.append('hal',hal);
            if (hal>1 && hal<total_hal)
            {
                if($(radiobtnyes).is(":checked"))
                {
                    $.ajax({
                        url:"{{route('web.check_form_rk')}}",
                        method:"POST",
                        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
                        data: data,
                        processData: false,
                        contentType: false,
                        async:false,
                        success:function(data)
                        {
                            $("#btn_next").attr('disabled');
                            if($.isEmptyObject(data.error))
                            {
                                if(data.status == true){
                                    $("#btn_next").removeAttr('disabled');
                                    $("[id^=error_]").remove();
                                    $(selector).hide();
                                    $(selector_next).show();
                                    $('#btn_prev').show();
                                    hal++;
                                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                                }else{
                                    $("#btn_next").removeAttr('disabled');
                                    displayErrorSwal(data.message);
                                }
                            }else{
                                displayWarningSwal();
                                $("#btn_next").removeAttr('disabled');
                                $("#btn_submit span").text('Submit');
                                $("[id^=error_]").remove();
                                $.each(data.error, function(key, value) {
                                    let classes="\"text-danger text-center\""
                                    var element = $("#" + key);
                                    // element.closest("div.col-md-12")
                                    // .find("#error_" + key).remove();
                                    // element.closest("div.col-md-12")
                                    // .before("<div id=error_"+ key + " class="+classes+">" + value + "</div>");
                                    element.closest("div")
                                    .find("#error_" + key).remove();
                                    element.closest("div")
                                    .before("<div id=error_"+ key + " class="+classes+">" + value + "</div>");
                                });
                            }
                        },
                        error: function(data){
                            $("#btn_next").removeAttr('disabled');
                            displayErrorSwal(data.message);
                        }
                    });
                }
                else if($(radiobtnno).is(":checked"))
                {
                    $(selector).hide();
                    $(selector_next).show();
                    $('#btn_prev').show();
                    hal++;
                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                }
                else
                {
                    alert("Please choose one!");
                }
            }
            else{
                $.ajax({
                    url:"{{route('web.check_form_rk')}}",
                    method:"POST",
                    headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
                    data: data,
                    processData: false,
                    contentType: false,
                    success:function(data)
                    {
                        $("[id^=error_]").remove();
                        $("#btn_next").attr('disabled');
                        if($.isEmptyObject(data.error))
                        {
                            if(data.status == true){
                                $("#btn_next").removeAttr('disabled');
                                $(selector).hide();
                                $(selector_next).show();
                                $('#btn_prev').show();
                                hal++;
                                $('html, body').animate({ scrollTop: 0 }, 'fast');
                            }else{
                                $("#btn_next").removeAttr('disabled');
                                displayErrorSwal(data.message);
                            }
                        }else{
                            displayWarningSwal();
                            // $("[id^=error_]").remove();
                            $("#btn_next").removeAttr('disabled');
                            $("#btn_submit span").text('Submit');
                            $.each(data.error, function(key, value) {
                                    let classes="\"text-danger text-center\""
                                    var element = $("#" + key);
                                    element.closest("div.col-md-12")
                                    .find("#error_" + key).remove();
                                    element.closest("div.col-md-12")
                                    .before("<div id=error_"+ key + " class=" +classes+">" + value + "</div>");
                            });
                        }
                    },
                    error: function(data){
                        $("#btn_next").removeAttr('disabled');
                        displayErrorSwal(data.message);
                    }
                });
            }
        }
        if(hal==total_hal){
            if(submit==false){
                $(document).ready(function(){
                    $("#btn_next").attr("type","submit");
                    $('#btn_next').removeClass("btn-success");
                    $('#btn_next').addClass("btn-danger");
                    $('#btn_next').html(submittext);
                    submit=true;
                });
            }
            else if(submit==true){
                event.preventDefault();
                var data = new FormData($('#form')[0]);
                data.append('hal',hal);
                if($(radiobtnyes).is(":checked")){
                    data.append('yes_check',1);
                }
                else if($(radiobtnno).is(":checked")){
                    data.append('yes_check',0);
                }
                else{
                    data.append('yes_check',3);
                }
                $.ajax({
                    url:"{{route('web.check_form_rk')}}",
                    method:"POST",
                    headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
                    data: data,
                    processData: false,
                    contentType: false,
                    success:function(data)
                    {
                        $("#btn_next").attr('disabled');
                        if($.isEmptyObject(data.error))
                        {
                            if(data.status == true){
                                $("#btn_next").removeAttr('disabled');
                                $("[id^=error_]").remove();
                                $("form").each(function() { this.reset() });
                                swal.fire({
                                    title: "Success",
                                    text: data.message,
                                    icon: "success"
                                }).then(function() {
                                    location.href = data.redirect;
                                });
                            }else{
                                $("#btn_next").removeAttr('disabled');
                                displayErrorSwal(data.message);
                            }
                        }else{
                            displayWarningSwal();
                            $("#btn_next").removeAttr('disabled');
                            $("#btn_submit span").text('Submit');
                            $("[id^=error_]").remove();
                            $.each(data.error, function(key, value) {
                                let classes="\"text-danger text-center\""
                                var element = $("#" + key);
                                element.closest("div.col-md-12")
                                .find("#error_" + key).remove();
                                element.closest("div.col-md-12")
                                .before("<div id=error_"+ key + " class="+classes+">" + value + "</div>");
                            });
                        }
                    },
                    error: function(data){
                        $("#btn_next").removeAttr('disabled');
                        displayErrorSwal(data.message);
                    }
                });
            }

        }
    });


    // $('[id^=radio_'+hal+'_yes]').click(function(){
    //     $('[id^=yes_'+hal+']').show();
    // });

    //form logic end
    //submit logic start
    $(document).ready( function () {

        for (let i = 1; i <= total_hal-1; i++) {
            $("#radio_"+i+"_yes").click(function(){
                $("#yes_"+i).show();
            });
            $("#radio_"+i+"_no").click(function(){
                $("#yes_"+i).hide();
            });
        }
    });
    //submit logic end

</script>
@endsection
