{{-- tinyMCE include --}}
<script src="{{asset('assets/js/tinymce')}}/tinymce.min.js"></script>

<form method="post" id="form">

    <div class="row">

        {{-- <input type="hidden" id="id_m_message" value="{{$old->id_m_message}}" class="form-control" name="id_m_message"> --}}

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                <label class="col-form-label" for="id_m_app">Application Name</label>
                </div>
                <div class="col-sm-12">
                    <select class="select2 form-select" id="id_m_app" name="id_m_app">
                        <option value="">Please choose one</option>
                        @foreach($app_data as $k => $v)
                            <option value="{{$v->id_m_app}}">{{$v->nm_m_app}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                <label class="col-form-label" for="id_m_entity">User Group</label>
                </div>
                <div class="col-sm-12">
                    <select class="select2 form-select" id="id_m_user_group" name="id_m_user_group">
                        <option value="">Please choose one</option>
                    </select>
                </div>
            </div>
        </div> --}}

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                <label class="col-form-label" for="id_m_entity">Menu</label>
                </div>
                <div class="col-sm-12">
                    <select class="select2 form-select" id="id_m_menu" name="id_m_menu">
                        <option value="">Please choose one</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                    <label class="col-form-label" for="nm_m_message">Title</label>
                </div>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="title_t_content" id="title_t_content" value="">
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                    <label class="col-form-label" for="nm_m_message">Sub Title</label>
                </div>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="subtitle_t_content" id="subtitle_t_content" value="">
                </div>
            </div>
        </div>

        <div class="col-sm-9">
            <a href="#" class="btn btn-secondary waves-effect close_modal">Back</a>
            <button id="submitform" type="submit"
                class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
        </div>
    </div>
</form>

<script src="{{asset('assets/js')}}/select2.full.min.js"></script>
<script src="{{asset('assets/js')}}/form-select2.min.js"></script>
<script src="{{asset('assets/js')}}/flatpickr.min.js"></script>

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
                url:"{{ route("admin.t_content.save") }}",
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

    $('#id_m_app').change(function() {
        let id_m_app = $(this).val();
        $.ajax({
            type: "POST",
            url: "{{route('admin.t_content.load_menu')}}",
            data: {id_m_app: id_m_app},
            headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
        }).done(function (res) {
            // generateDataTabel(id_m_branch);
            $('#id_m_menu').html(res);
        });
    });

    // $('#id_m_user_group').change(function() {
    //     let id_m_app = $('#id_m_app').val();
    //     let id_m_user_group = $(this).val();
    //     $.ajax({
    //         type: "POST",
    //         url: "{{route('admin.t_content.load_menu')}}",
    //         data: {id_m_user_group: id_m_user_group, id_m_app:id_m_app},
    //         headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
    //     }).done(function (res) {
    //         // generateDataTabel(id_m_branch);
    //         $('#id_m_menu').html(res);
    //     });
    // });
</script>
