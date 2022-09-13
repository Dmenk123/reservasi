@extends('admin.layout.index')

@section('content')

<!-- Advanced Search -->
<section id="advanced-search-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{$page_title}}</h4>

                </div>

                <hr class="my-0" />
                <div class="card-body">

                    <form method="post" id="form">

                        <div class="row">

                            <div class="col-12">
                                <div class="mb-1 row">


                                    {{-- <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-2">
                                                <label class="col-form-label" for="nm_m_message">Name</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nm_m_message" id="nm_m_message">
                                            </div>
                                        </div>
                                    </div> --}}

                                    @php
                                        $arr_opt = [
                                            'text' => 'Text',
                                            'image' => 'Image',
                                            'video' => 'Video',
                                            'list' => 'List',
                                            'quote' => 'Quote',
                                            'codeblock' => 'Codeblock'
                                        ];
                                    @endphp

                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-2">
                                            <label class="col-form-label" for="id_m_entity">Form Type</label>
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="select2 form-select" id="id_m_entity" name="id_m_entity">
                                                    <option value="">Please choose one</option>
                                                    @foreach($arr_opt as $k => $v)
                                                        <option value="{{$k}}">{{$v}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-2">
                                                <label class="col-form-label" for="content_m_message">Content</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <textarea type="text" id="content_m_message" class="form-control"
                                                    name="content_m_message"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-9 offset-sm-2">
                                        <a href="{{route('admin.t_content.index')}}"
                                            class="btn btn-secondary waves-effect">Back</a>
                                        <button type="submit" id="submitform"
                                            class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
                                    </div>
                                </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Advanced Search -->

@endsection

@section('js')
<script>
tinymce.init({
    selector: 'textarea',
    toolbar: 'false',
});

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
@endsection
