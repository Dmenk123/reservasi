<form method="post" id="form_edit_content">

    <div class="row">

        <input type="hidden" id="id_t_content_det" value="{{$old->id_t_content_det}}" class="form-control" name="id_t_content_det">

        @php
        $res = '';
        switch ($old->id_m_component) {
            case \App\Models\M_component::ID_M_COMPONENT_IMAGE:
                $res .= '<div class="mb-1 row">
                            <div class="col-sm-12" style="text-align: center;">
                                <img src="'.asset('storage/'.$old->path_t_content_det).'" alt="'.$old->value_m_component.'" style="width:300px;height:300px;">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="content_m_message">Content (ignore if you don\'t change the picture)</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="file" id="file_upload" name="content_field" class="form-control" />
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="content_m_message">Caption Content</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" id="caption_field" name="caption_field" class="form-control" value="'.$old->value_m_component.'"/>
                            </div>
                        </div>';
                break;

            case \App\Models\M_component::ID_M_COMPONENT_TEXT:
                $res .= '<div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="content_m_message">Content</label>
                            </div>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" name="content_field">'.$old->value_m_component.'</textarea>
                            </div>
                        </div>';

                $reinit = true;
                break;

            default:
                $res .= '<div class="mb-1 row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="content_m_message">Content</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="content_field" value="'.$old->value_m_component.'">
                            </div>
                        </div>';

                break;
        }
        @endphp

        {!!$res!!}

        <div class="mb-1 row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <a href="#" class="btn btn-secondary waves-effect close_modal">Back</a>
                <button id="submitformeditcontent" type="submit" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
            </div>
        </div>

    </div>
</form>

<script>
    $(document).ready( function () {
        tinymce.init({
            selector: 'textarea',
            toolbar: 'false',
        });

        $("#form_edit_content").submit(function(){
            $(".text-danger").remove();
            event.preventDefault();
            var data = new FormData($('#form_edit_content')[0]);

            // let mce = tinyMCE.activeEditor.getContent();
            // data.append('content_field', mce);

            $("#submitformeditcontent").attr('disabled', true);
            $("#submitformeditcontent span").text(loading_text);

            $.ajax({
                url:"{{ route("admin.t_content.update_data_content") }}",
                method:"POST",
                headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
                data: data,
                processData: false,
                contentType: false,
                success:function(data)
                {
                    if($.isEmptyObject(data.error)){

                        if(data.status == true){
                            $("#submitformeditcontent").removeAttr('disabled');
                            $("#submitformeditcontent span").text('Submit');
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
                        $("#submitformeditcontent").removeAttr('disabled');
                        $("#submitformeditcontent span").text('Submit');
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
