<form method="post" id="form">


    <div class="row">

        <div class="col-12" id="div_id_m_project">
            <div class="mb-1 row">
                <div class="col-sm-5">
                <label class="col-form-label" for="id_m_project">Project</label>
                </div>
                <div class="col-sm-7">
                    <select class="select2 form-select" id="id_m_project" name="id_m_project">
                        {{-- <option value="">Please choose one</option> --}}
                        @foreach($m_project as $item_m_project)
                        <option value="{{$item_m_project->id_m_project}}">{{$item_m_project->nm_m_project}}</option>
                        @endforeach
                      </select>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-5">
                <label class="col-form-label" for="file_excel">Choose File Excel to Import (.xls)</label>
                </div>
                <div class="col-sm-7">
                <input type="file"  id="file_excel" class="form-control" name="file_excel">
                </div>
            </div>
        </div>





        <div class="col-sm-12">
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
                url:"{{ route("admin.m_employee.execute_import") }}",
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
