@extends('admin.layout.index')

@section('content')

<!-- Advanced Search -->
<section id="advanced-search-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{$page_title}} [Menu : {{$old->m_menu->nm_menu ?? '-'}}]</h4>
                </div>

                <hr class="my-0" />
                <div class="card-body">

                    <form method="post" id="form">

                        <div class="row">

                            <div class="col-12">
                                <div class="mb-1 row">

                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-2">
                                            <label class="col-form-label" for="form_type">Form Type</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="select2 form-select" id="form_type" name="form_type">
                                                    <option value="">Please choose one</option>
                                                    @foreach($component as $k => $v)
                                                        <option value="{{$v->id_m_component}}">{{$v->nm_m_component}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12" id="dynamic-field"></div>

                                    <div class="col-12" id="form-">
                                        <div class="mb-1 row">
                                            <div class="col-sm-2">
                                                <label class="col-form-label" for="content_m_message">Inline Style</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="style_field" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-9 offset-sm-2">
                                        <a href="{{route('admin.t_content.index')}}" class="btn btn-secondary waves-effect">Back</a>
                                        <button type="submit" id="submitform" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    @if ($old_det->isNotEmpty())
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Data Content Details</h4>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="card-datatable table-responsive">
                        <table id="datatable" class="table-striped table-hover table table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Component</th>
                              <th>Value Component</th>
                              <th>Image</th>
                              <th>Created at</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($old_det as $key => $row)
                                <tr>
                                    <td width="2%">{{$row->sort_t_content_det}}</td>
                                    <td width="9%">{{$row->m_component->nm_m_component}}</td>
                                    <td>{!!$row->value_m_component!!}</td>
                                    <td width="8%">
                                        @if ($row->path_t_content_det)
                                            <img class="img-fluid mt-3 mb-2" src="{{asset('storage/'.$row->path_t_content_det)}}" height="100" width="150" alt="User avatar">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td width="9%">{{\Carbon\Carbon::parse($row->created_at)->format('d-m-Y')}}</td>
                                    <td width="10%">
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-float waves-light hide" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                            actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
                                                <a class="dropdown-item setting" onClick="setOrder('{{$row->id_t_content_det}}')">set order</a>
                                                <a class="dropdown-item setting" onClick="editContent('{{$row->id_t_content_det}}')">edit content</a>
                                                <a class="dropdown-item delete" onClick="deleteDetails('{{$row->id_t_content_det}}')" href="#">delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
<!--/ Advanced Search -->
@include('admin.layout.modal_edit')
@include('admin.layout.modal_global', ['title' =>'Set Content / Caption'])
@endsection

@section('js')
<script>

var activeMCE = false;

$(document).ready( function () {
    initTinymce();
    $('#datatable').DataTable();
    $("#form").submit(function(){
        $(".text-danger").remove();
        event.preventDefault();
        var data = new FormData($('#form')[0]);
        data.append('id_t_content', "{{request()->get('id_t_content')}}");

        if(activeMCE) {
            let mce = tinyMCE.activeEditor.getContent();
            data.append('content_field', mce);
        }


        $("#submitform").attr('disabled', true);
        $("#submitform span").text(loading_text);

        $.ajax({
            url:"{{ route("admin.t_content.save_set_content") }}",
            method:"POST",
            enctype: 'multipart/form-data',
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

    $('#datatable').on('click', '.user-group', function(){
        $('#modal_global').modal('show');
        var id_t_content = $(this).data("id_t_content");

        $('#modal_global .modal-body').html('');
        $.ajax({
            url:"{{ route('admin.t_content.user_group_modal') }}",
            method:"post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data:{id_t_content:id_t_content},
            success:function(data)
            {
                $('#modal_global .modal-body').html(data);
            },
            error: function(data){
                displayErrorSwal();
            }
        });
    });
});

$('#form_type').change(function (e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
        url: "{{ route("admin.t_content.dynamic_field") }}",
        data: {
            typeform : $(this).val()
        },
        dataType: "json",
        success: function (response) {
            $("#dynamic-field").html(response.html);
            $("input[name='style_field']").val(response.style);
            if(response.reinit == true) {
                initTinymce();
                activeMCE = true;
            }else{
                activeMCE = false;
            }
        }
    });


});

const initTinymce = () => {
    tinymce.init({
        selector: 'textarea',
        toolbar: 'false',
    });
}

const setOrder = (id_t_content_det) => {
    $('#modal_edit').modal('show');
    $('#modal_edit .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.t_content.edit_modal_order') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_content_det:id_t_content_det},
        success:function(data)
        {
            $('#modal_edit .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });

}

const editContent = (id_t_content_det) => {
    $('#modal_global').modal('show');
    $('#modal_global .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.t_content.edit_modal_content') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_content_det:id_t_content_det},
        success:function(data)
        {
            $('#modal_global .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });

}

const deleteDetails = (id_t_content_det) => {

    swal.fire({
        title: "Confirmation",
        text: 'Are you sure deleting content data ?',
        icon: "warning",
        showCancelButton: !0,
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        reverseButtons: !0
    }).then(function (e) {
        if(e.value){
            $.ajax({
                url:"{{ route('admin.t_content.delete_content_det') }}",
                method:"post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{id_t_content_det:id_t_content_det},
                success:function(data)
                {
                    if(data.status == true){
                        swal.fire({
                            title: "Deleted!",
                            text: 'Success deleting data content',
                            icon: "success"
                        }).then(function() {
                            location.href = data.redirect;
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
    });
}

</script>
@endsection
