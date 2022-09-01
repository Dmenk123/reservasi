<form method="post" id="form">

    <div class="row">

        <input type="hidden" id="id_t_jadwal_rutin" value="{{$old->id_t_jadwal_rutin}}" class="form-control" name="id_t_jadwal_rutin">

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                <label class="col-form-label" for="hari">Hari</label>
                </div>
                <div class="col-sm-12">
                    <input type="text" id="hari" class="form-control" name="hari" value="{{$old->hari}}" readonly>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                <label class="col-form-label" for="hari">Sesi</label>
                </div>
                <div class="col-sm-12">
                    <input type="number" id="sesi" class="form-control" name="sesi" value="">
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-8">
                    <label class="col-form-label" for="jam_mulai">Pukul</label>
                </div>
                <div class="col-sm-12">
                    <input type="text" id="pukul" class="form-control timepickers" name="pukul" value="">
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="mb-1" style="text-align: center;">
                {{-- <a href="#" class="btn btn-secondary waves-effect close_modal">Back</a> --}}
                <button id="submitform" type="submit" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Add</span></button>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-1 row">
                <table id="tbl-detail" class="table-striped table-hover table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Sesi</th>
                            <th>Pukul</th>
                            <th style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-detail">
                        @if ($old && $old->t_jadwal_rutin_det)
                            @foreach ($old->t_jadwal_rutin_det as $item)
                            <tr>
                                <td>{{$item->sesi}}</td>
                                <td>{{$item->pukul}}</td>
                                <td>
                                    <button class="btn btn-outline-danger text-nowrap px-1" type="button" onclick="deleteDetail({{$item->id_t_jadwal_rutin_det}})">
                                        {{-- <i data-feather="x" class="me-25"></i> --}}
                                        <span>Delete</span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
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
                url:"{{ route("admin.t_jadwal_rutin.add_detail") }}",
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
                                load_html_table(data.id);
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

    function deleteDetail(id_det) {
        swal.fire({
            title: "Confirmation",
            text: confirm_delete_text,
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "OK",
            cancelButtonText: "Cancel",
            reverseButtons: !0
        }).then(function (e) {

            if(e.value){
                $.ajax({
                    url:"{{ route('admin.t_jadwal_rutin.delete_detail') }}",
                    method:"post",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data:{id_t_jadwal_rutin_det:id_det},
                    success:function(data)
                    {
                        if(data.status == true){
                            swal.fire({
                                title: "Deleted!",
                                text: data_deleted,
                                icon: "success"
                            }).then(function() {
                                load_html_table(data.id);
                            });
                        }else{
                            displayErrorSwal(data.message);
                        }
                    },
                    error: function(data){
                        displayErrorSwal(data.message);
                    }
                });
            }

            })
    };

    function load_html_table(id_jadwal) {
        $.ajax({
            url:"{{ route('admin.t_jadwal_rutin.load_html_table') }}",
            method:"post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data:{id_jadwal:id_jadwal},
            success:function(data)
            {
                if(data.status == true){
                    $('#tbody-detail').html(data.html);
                }else{
                    displayErrorSwal(data.message);
                }
            },
            error: function(data){
                displayErrorSwal(data.message);
            }
        });
    }
</script>
