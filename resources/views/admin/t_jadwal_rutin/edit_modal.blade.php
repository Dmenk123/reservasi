<form method="post" id="form">

    <div class="row">

        <input type="hidden" id="id_t_jadwal_rutin" value="{{$old->id_t_jadwal_rutin}}" class="form-control" name="id_t_content">

        {{-- <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                    <label class="col-form-label" for="nm_m_message">Title</label>
                </div>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="title_t_content" id="title_t_content" value="{{$old->title_t_content ?? ''}}">
                </div>
            </div>
        </div> --}}

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                <label class="col-form-label" for="id_m_app">Hari</label>
                </div>
                <div class="col-sm-12">
                    <select class="select2 form-select" id="id_m_app" name="id_m_app">
                        <option value="">Please choose one</option>
                        @foreach($arr_hari as $k => $v)
                            <option value="{{$v}}" @if($v == $old->hari) selected @endif>{{$v}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                <label class="col-form-label" for="id_m_entity">Menu</label>
                </div>
                <div class="col-sm-12">
                    <select class="select2 form-select" id="id_m_menu" name="id_m_menu">
                        @foreach($menu_data as $k => $v)
                            <option value="{{$v->id_m_menu}}" @if($v->id_m_menu == $old->id_m_menu) selected @endif>{{$v->nm_menu}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div> --}}

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                    <label class="col-form-label" for="jam_mulai">Jam Mulai</label>
                </div>
                <div class="col-sm-12">
                    <input type="text" id="jam_mulai" class="form-control timepickers" name="jam_mulai" value="{{\Carbon\Carbon::parse($old->jam_mulai)->format('H:i')}}">
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                    <label class="col-form-label" for="jam_akhir">Jam Mulai</label>
                </div>
                <div class="col-sm-12">
                    <input type="text" id="jam_akhir" class="form-control timepickers" name="jam_akhir" value="{{\Carbon\Carbon::parse($old->jam_mulai)->format('H:i')}}">
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                <label class="col-form-label" for="id_m_entity">Interval</label>
                </div>
                <div class="col-sm-12">
                    <select class="select2 form-select" id="id_m_interval" name="id_m_interval">
                        @foreach($interval as $k => $v)
                            <option value="{{$v->id_m_interval}}" @if($v->id_m_interval == $old->id_m_interval) selected @endif>{{$v->durasi_m_interval}}</option>
                        @endforeach
                    </select>
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
        $(".timepickers").flatpickr(
            {
                enableTime: true,
                time_24hr: true,
                noCalendar: true,
                dateFormat: "H:i",
            }
        );
        $("#form").submit(function(){
            $(".text-danger").remove();
            event.preventDefault();
            var data = new FormData($('#form')[0]);
            $("#submitform").attr('disabled', true);
            $("#submitform span").text(loading_text);

            $.ajax({
                url:"{{ route("admin.t_jadwal_rutin.update") }}",
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
</script>
