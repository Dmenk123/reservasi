
                        <form method="post" id="form">


                            <div class="row">

                                <input type="hidden" id="id_m_group_mcu" value="{{$old->id_m_group_mcu}}" class="form-control" name="id_m_group_mcu">
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="nm_m_group_mcu">Group Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                        <input type="text" value="{{$old->nm_m_group_mcu}}" id="nm_m_group_mcu" class="form-control" name="nm_m_group_mcu">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="active_m_group_mcu">Active</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select class="form-select" id="active_m_group_mcu" name="active_m_group_mcu">
                                                <option {{($old->active_m_group_mcu=='ACTIVE') ? 'selected' : ''}} value="ACTIVE">ACTIVE</option>
                                                <option {{($old->active_m_group_mcu=='NON ACTIVE') ? 'selected' : ''}} value="NON ACTIVE">NON ACTIVE</option>
                                              </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-9 offset-sm-3">
                                <button id="submitform" type="submit" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
                                <a href="javascript:void(0)" class="btn btn-secondary waves-effect close_modal">Back</a>
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
            url:"{{ route("admin.m_group_mcu.update") }}",
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
