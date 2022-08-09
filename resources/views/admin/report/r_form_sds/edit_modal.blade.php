<form method="post" id="form">

    <div class="row">

        <input type="hidden" id="id_m_mcu_category" value="{{ $old->id_m_mcu_category }}" class="form-control"
            name="id_m_mcu_category">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-2">
                    <label class="col-form-label" for="nm_m_mcu_category">Name</label>
                </div>
                <div class="col-sm-10">
                    <input value="{{ $old->nm_m_mcu_category }}" type="text" id="nm_m_mcu_category"
                        class="form-control" name="nm_m_mcu_category">
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-2">
                    <label class="col-form-label" for="active_m_mcu_category">Active</label>
                </div>
                <div class="col-sm-3">
                    <select class="form-select" id="active_m_mcu_category" name="active_m_mcu_category">
                        <option {{ $old->active_m_mcu_category == 'ACTIVE' ? 'selected' : null }}
                            value="ACTIVE">ACTIVE</option>
                        <option {{ $old->active_m_mcu_category == 'NON ACTIVE' ? 'selected' : null }}
                            value="NON ACTIVE">NON ACTIVE</option>
                    </select>
                </div>
            </div>
        </div>



        <div class="col-sm-9 offset-sm-2">
            <a href="#" class="btn btn-secondary waves-effect close_modal">Back</a>
            <button id="submitform" type="submit"
                class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
        </div>
    </div>
</form>
<script>
    $(document).ready( function () {
        $("#form").submit(function(){
        $(".text-danger").remove();
        event.preventDefault();
        var data = new FormData($('#form')[0]);
        $("#submitform").attr('disabled', true);
        $("#submitform span").text(loading_text);

        $.ajax({
            url:"{{ route("admin.m_mcu_category.update",['menu' => request()->get('menu')]) }}",
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
