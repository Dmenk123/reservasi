{{-- tinyMCE include --}}
<script src="{{asset('assets/js/tinymce')}}/tinymce.min.js"></script>

<form method="post" id="form">

    <div class="row">

        <input type="hidden" id="id_t_content" value="{{$old->id_t_content}}" class="form-control" name="id_t_content">
        <input type="hidden" id="id_m_app" value="{{$old->id_m_app}}" class="form-control" name="id_m_app">


            <div class="col-12 row">
                <div class="mb-1 row">
                    @foreach ($role as $item)
                        <div class="form-check col-6 form-control" style="margin-left:40px;margin-top:auto;margin-bottom:auto;border:0;width:320px;">
                            <input type="checkbox" class="checkbox form-check-input index" value="{{ $item->id_m_user_group }}" id="id_m_user_group_{{$item->id_m_user_group}}" name="id_m_user_group[]"  @if (in_array($item->id_m_user_group, $arr_user_group->toArray())) checked @endif>
                            <label class="form-check-label" for="id_m_user_group_{{$item->id_m_user_group}}">{{$item->nm_user_group}}</label>
                        </div>
                    @endforeach
                </div>
            </div>


        <div class="col-sm-9">
            <a href="#" class="btn btn-secondary waves-effect close_modal">Back</a>
            <button id="submitform" type="submit"
                class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
        </div>
    </div>
</form>

<script>
    // tinymce.init({
    //         selector: 'textarea',
    //         toolbar: 'false',
    //     });
    $(document).ready( function () {
        $("#form").submit(function(){
        $(".text-danger").remove();
        event.preventDefault();
        var data = new FormData($('#form')[0]);
        $("#submitform").attr('disabled', true);
        $("#submitform span").text(loading_text);

        $.ajax({
            url:"{{ route("admin.t_content.update_user_group") }}",
            method:"POST",
            headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
            data: data,
            processData: false,
            contentType: false,
            success:function(data)
            {
                if($.isEmptyObject(data.error)){

                    if(data.status == true){
                        $("#submitform").removeAttr('disabled');
                        $("#submitform span").text('Submit');
                        $("form").each(function() {
                            // this.reset()
                            });
                        swal.fire({
                            title: "Success",
                            text: data.message,
                            icon: "success"
                        }).then(function() {
                            // location.href = data.redirect;
                            table.ajax.reload();
                            $('#modal_global').modal('hide');
                        });
                    }else{
                        displayErrorSwal(data.message);
                    }

                }else{
                    displayWarningSwal();
                    $("#submitform").removeAttr('disabled');
                    $("#submitform span").text('Submit');
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
