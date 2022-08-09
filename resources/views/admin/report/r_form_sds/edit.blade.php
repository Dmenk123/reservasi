@extends('admin.layout.index')

@section('content')

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">{{ $page_title }}</h4>
                    </div>

                    <hr class="my-0" />
                    <div class="card-body">

                        <form method="post" id="form">

                            <div class="row">

                                <input type="hidden" id="id_m_workflow_category" value="{{ $old->id_m_workflow_category }}"
                                    class="form-control" name="id_m_workflow_category">
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                            <label class="col-form-label" for="nm_m_workflow_category">Workflow Category Name</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <input value="{{ $old->nm_m_workflow_category }}" type="text" id="nm_m_workflow_category"
                                                class="form-control" name="nm_m_workflow_category">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                            <label class="col-form-label" for="active_m_workflow_category">Active</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select class="form-select" id="active_m_workflow_category"
                                                name="active_m_workflow_category">
                                                <option {{ $old->active_m_workflow_category == 'ACTIVE' ? 'selected' : null }}
                                                    value="ACTIVE">ACTIVE</option>
                                                <option
                                                    {{ $old->active_m_workflow_category == 'NON ACTIVE' ? 'selected' : null }}
                                                    value="NON ACTIVE">NON ACTIVE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-sm-9 offset-sm-2">
                                    <button id="submitform" type="submit"
                                        class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
                                    <a href="{{ route('admin.m_workflow_category.index') }}"
                                        class="btn btn-secondary waves-effect">Back</a>
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
        $(document).ready(function() {
            $("#form").submit(function() {
                $(".text-danger").remove();
                event.preventDefault();
                var data = new FormData($('#form')[0]);
                $("#submitform").attr('disabled', true);
                $("#submitform span").text(loading_text);

                $.ajax({
                    url: "{{ route('admin.m_workflow_category.update') }}",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
                    },
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {

                            if (data.status == true) {
                                $("#submitform").removeAttr('disabled');
                                $("#submitform span").text('Submit');
                                $("form").each(function() {
                                    this.reset()
                                });
                                swal.fire({
                                    title: "Success",
                                    text: data.message,
                                    icon: "success"
                                }).then(function() {
                                    location.href = data.redirect;
                                });
                            } else {
                                displayErrorSwal(data.message);
                            }

                        } else {
                            displayWarningSwal();
                            $("#submitform").removeAttr('disabled');
                            $("#submitform span").text('Submit');
                            $.each(data.error, function(key, value) {
                                var element = $("#" + key);
                                element.closest("div.form-control")
                                    .removeClass("text-danger")
                                    .addClass(value.length > 0 ? "text-danger" : "")
                                    .find("#error_" + key).remove();
                                element.after("<div id=error_" + key +
                                    " class=text-danger>" + value + "</div>");
                            });
                        }
                    },
                    error: function(data) {
                        displayErrorSwal(data.message);
                    }
                });
            });
        });
    </script>
@endsection
