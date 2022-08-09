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
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="nm_menu">Menu Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                        <input type="text" id="nm_menu" class="form-control" name="nm_menu">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="route">Route Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                        <input type="text" id="route" class="form-control" name="route">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="aktif">Active</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select class="form-select" id="aktif" name="aktif">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                              </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="id_parent">Parent Menu</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select class="form-select" id="id_parent" name="id_parent">
                                                <option value="">No Parent</option>
                                                @foreach($id_parent as $parent)
                                                <option value="{{$parent->id_m_menu}}">{{$parent->nm_menu}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="icon">Icon</label>
                                        </div>
                                        <div class="col-sm-4">
                                        <input type="text" id="icon" class="form-control" name="icon">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="order_m_menu">Menu Order (urut ascending)</label>
                                        </div>
                                        <div class="col-sm-4">
                                        <input type="text" id="order_m_menu"  class="form-control" name="order_m_menu">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-9 offset-sm-2">
                                <button type="submit" id="submitform" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
                                <a href="{{route('admin.m_menu.index')}}" class="btn btn-secondary waves-effect">Back</a>
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
    $(document).ready( function () {
        $("#form").submit(function(){
        $(".text-danger").remove();
        event.preventDefault();
        var data = new FormData($('#form')[0]);
        $("#submitform").attr('disabled', true);
        $("#submitform span").text(loading_text);

        $.ajax({
            url:"{{ route("admin.m_menu.save") }}",
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
