<form method="post" id="form_edit_order">

    <div class="row">

        <input type="hidden" id="id_t_content_det" value="{{$old->id_t_content_det}}" class="form-control" name="id_t_content_det">

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-2">
                    <label class="col-form-label" for="sort_t_content_det">Sort Content</label>
                </div>
                <div class="col-sm-15">
                    <input type="number" class="form-control" name="sort_t_content_det" id="sort_t_content_det"
                    value="{{$old->sort_t_content_det}}">
                </div>
            </div>
        </div>

        <div class="col-sm-9">
            <a href="#" class="btn btn-secondary waves-effect close_modal">Back</a>
            <button id="submitformeditorder" type="submit" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
        </div>
    </div>
</form>

<script>
    $(document).ready( function () {
        $("#form_edit_order").submit(function(){
            $(".text-danger").remove();
            event.preventDefault();
            var data = new FormData($('#form_edit_order')[0]);
            $("#submitformeditorder").attr('disabled', true);
            $("#submitformeditorder span").text(loading_text);

            $.ajax({
                url:"{{ route("admin.t_content.update_data_order") }}",
                method:"POST",
                headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
                data: data,
                processData: false,
                contentType: false,
                success:function(data)
                {
                    if($.isEmptyObject(data.error)){

                        if(data.status == true){
                            $("#submitformeditorder").removeAttr('disabled');
                            $("#submitformeditorder span").text('Submit');
                            $("form").each(function() {
                                // this.reset()
                                });
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
                        $("#submitformeditorder").removeAttr('disabled');
                        $("#submitformeditorder span").text('Submit');
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

        $('#modal_edit').on('click', '.close_modal', function(){
            $('#modal_edit .modal-body').html('');
            $('#modal_edit').modal('hide');
        });
    });
</script>
