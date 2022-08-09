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
                            <input type="hidden" name="id_m_mcu_category" id="id_m_mcu_category" value="{{$id_m_mcu_category}}">
                            <div class="row">

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                            <label class="col-form-label" for="id_m_group_mcu">Test</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="form-select" id="id_m_group_mcu"
                                                name="id_m_group_mcu">
                                                <option>Please choose one.</option>
                                                @foreach ($m_group_mcu as $item)
                                                    <option value="{{$item->id_m_group_mcu}}">{{$item->nm_m_group_mcu}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-9 offset-sm-2">
                                    <a href="{{ route('admin.m_mcu_category.index_det',['menu'=>request()->get('menu'),'id_m_mcu_category'=>$id_m_mcu_category]) }}"
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
        $(document).ready(function() {
            $("#form").submit(function() {
                $(".text-danger").remove();
                event.preventDefault();
                var data = new FormData($('#form')[0]);
                $("#submitform").attr('disabled', true);
                $("#submitform span").text(loading_text);

                $.ajax({
                    url: "{{ route('admin.m_mcu_category.save_det',['menu'=>request()->get('menu')]) }}",
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
