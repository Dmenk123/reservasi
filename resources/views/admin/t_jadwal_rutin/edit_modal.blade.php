<form method="post" id="form">

    <div class="row">

        <input type="hidden" id="id_t_jadwal_rutin" value="{{$old->id_t_jadwal_rutin}}" class="form-control" name="id_t_jadwal_rutin">

        {{-- <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                    <label class="col-form-label" for="jam_mulai">Jam Mulai</label>
                </div>
                <div class="col-sm-12">
                    <input type="text" id="jam_mulai" class="form-control timepickers" name="jam_mulai" value="{{\Carbon\Carbon::parse($old->jam_mulai)->format('H:i')}}">
                </div>
            </div>
        </div> --}}

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                <label class="col-form-label" for="hari">Hari</label>
                </div>
                <div class="col-sm-12">
                    <select class="select2 form-select" id="hari" name="hari">
                        @foreach ($arr_hari as $key => $val)
                            <option value="{{$key}}" @if($key == $old->urut_t_jadwal_rutin) selected @endif>{{$val}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                <label class="col-form-label" for="status">Status</label>
                </div>
                <div class="col-sm-12">
                    <select class="select2 form-select" id="status" name="status">
                        <option value="1" @if($old->status == '1') selected @endif>Aktif</option>
                        <option value="" @if($old->status == null) selected @endif>Nonaktif</option>
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
