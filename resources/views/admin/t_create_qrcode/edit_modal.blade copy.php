
                        <form method="post" id="form">

                            <div class="row">

                                <input type="hidden" id="id_t_qrcode" value="{{$old->id_t_qrcode}}" class="form-control" name="id_t_qrcode">


                                {{-- <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="id_m_entity">Entity Name</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="id_m_entity" name="id_m_entity">
                                                <option value="">Please choose one</option>
                                                @foreach($id_m_entity as $ent)
                                                <option {{($old->m_branch->id_m_entity == $ent->id_m_entity) ? 'selected' : null}} value="{{$ent->id_m_entity}}">{{$ent->nm_m_entity}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="id_m_branch">Branch</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="id_m_branch" name="id_m_branch">

                                            </select>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="tipe_t_qrcode">Tipe Pelaksanaan</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="tipe_t_qrcode" name="tipe_t_qrcode">
                                                <option value="">Please choose one</option>

                                                <option value="walkin" {{($old->tipe_t_qrcode == 'walkin') ? 'selected' : null}}>Walk-In</option>
                                                <option value="onside" >{{($old->tipe_t_qrcode == 'onside') ? 'selected' : null}}On-Side</option>

                                              </select>
                                        </div>
                                    </div>
                                </div>

                                @if ($old->tipe_t_qrcode=='walkin')

                                <div class="col-12" id="div_id_m_branch">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="id_m_branch">Pramita Branch</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="id_m_branch" name="id_m_branch">
                                                <option value="">Please choose one</option>
                                                @foreach($id_m_branch as $item_m_branch)
                                                <option value="{{$item_m_branch->id_m_branch}}"{{($old->id_m_branch == $item_m_branch->id_m_branch) ? 'selected' : null}} >{{$item_m_branch->nm_m_branch}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>

                                @endif

                                @if ($old->tipe_t_qrcode=='onside')

                                <div class="col-12" id="div_id_m_company">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="id_m_company" >Company Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="id_m_company" name="id_m_company">
                                                <option value="">Please choose one</option>
                                                @foreach($id_m_company as $ent)
                                                <option {{($old->m_branch_company->id_m_company == $ent->id_m_company) ? 'selected' : null}} value="{{$ent->id_m_company}}">{{$ent->nm_m_company}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12" id="div_id_m_branch_company">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="id_m_branch_company">Company Branch</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="select2 form-select" id="id_m_branch_company" name="id_m_branch_company">

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                @endif

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="date_start_m_branch">PIC Participant</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->pic_participant}}" id="pic_participant" name="pic_participant" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">PIC Event Organizer</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->pic_eo}}" id="pic_eo" name="pic_eo" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="date_start_mcu">Date Period</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <input placeholder="start date" type="text" value="{{($old->date_start_mcu) ? \Carbon\Carbon::createFromFormat('Y-m-d', $old->date_start_mcu)->format('d-m-Y') : ''}}" id="date_start_mcu" name="date_start_mcu" class="form-control datepicker">
                                        </div>
                                        <div class="col-sm-3">
                                            <input placeholder="finish date" type="text" value="{{($old->date_finish_mcu) ? \Carbon\Carbon::createFromFormat('Y-m-d', $old->date_finish_mcu)->format('d-m-Y') : ''}}" id="date_finish_mcu" name="date_finish_mcu" class="form-control datepicker">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-9 offset-sm-3">
                                    <button id="submitform" type="submit" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
                                    <a href="#" class="btn btn-secondary waves-effect close_modal">Back</a>
                                </div>
                            </div>
                        </form>



<script>

    $(".datepicker").flatpickr(
        {
            dateFormat: "d-m-Y",
        }
    );

    $(document).ready( function () {
        $("#form").submit(function(){
        $(".text-danger").remove();
        event.preventDefault();
        var data = new FormData($('#form')[0]);
        $("#submitform").attr('disabled', true);
        $("#submitform span").text(loading_text);

        $.ajax({
            url:"{{ route("admin.t_create_qrcode.update") }}",
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




$('#id_m_entity').change(function() {
    id_m_entity = $(this).val();
   // countries = $('#countries').val();
    $('#id_m_branch').html('');
    $.ajax({
        type: "POST",
        url: "{{route('load_branch')}}",
        data: {id_m_entity: id_m_entity},
        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
    }).done(function (res) {
        $('#id_m_branch').html(res);
    });
})


$('#id_m_company').change(function() {
    id_m_company = $(this).val();
    $('#id_m_branch_company').html('');
    $.ajax({
        type: "POST",
        url: "{{route('load_branch_company')}}",
        data: {id_m_company: id_m_company},
        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
    }).done(function (res) {
        $('#id_m_branch_company').html(res);
    });
})



    /**
    onload handle edit data
    */
    /*
    var id_m_entity = '{{$old->m_branch->id_m_entity}}';
    var id_m_branch = '{{$old->id_m_branch}}';
    var id_m_company = '{{$old->m_branch_company->id_m_company}}';
    var id_m_branch_company = '{{$old->id_m_branch_company}}';
    $('#countries').html('');

    $.ajax({
        type: "POST",
        url: "{{route('admin.t_create_qrcode.handle_edit_t_qrcode')}}",
        data: {
            id_m_entity: id_m_entity,
            id_m_branch: id_m_branch,
            id_m_company: id_m_company,
            id_m_branch_company: id_m_branch_company
        },
        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
    }).done(function (res) {
        $('#id_m_branch').html(res.html_branch);
        $('#id_m_branch_company').html(res.html_branch_company);
    });
*/
</script>
