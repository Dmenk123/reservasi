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
                          <input type="hidden" id="id_m_user_bo" value="{{$old->id_m_user_bo}}" class="form-control" name="id_m_user_bo">

                                <div class="row">
                                  <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="nm_user_bo">Nama User</label>
                                        </div>
                                        <div class="col-sm-9">
                                        <input type="text" value="{{$old->nm_user_bo}}" id="nm_user_bo" class="form-control" name="nm_user_bo">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="username">Username</label>
                                        </div>
                                        <div class="col-sm-9">
                                        <input type="text" value="{{$old->username}}" id="username" class="form-control" name="username">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="password">Password</label>
                                        </div>
                                        <div class="col-sm-9">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="(unchanged)">
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
                                                <option value="1" {{($old->aktif=='1') ? 'selected' : null}}>Yes</option>
                                                <option value="0" {{($old->aktif!='1') ? 'selected' : null}}>No</option>
                                              </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="id_m_user_group_bo">User Group</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="form-select" id="id_m_user_group_bo" name="id_m_user_group_bo">
                                              @foreach($m_user_group as $rol)
                                                <option {{($old->id_m_user_group_bo == $rol->id_m_user_group_bo) ? 'selected' : null}} value="{{$rol->id_m_user_group_bo}}">{{$rol->nm_user_group_bo}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-9 offset-sm-2">
                                <a href="{{route('admin.m_user_bo.index')}}" class="btn btn-secondary waves-effect">Back</a>
                                <button id="submitform" type="submit" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
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
            url:"{{ route("admin.m_user_bo.update") }}",
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
                            title: "Sukses",
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
                    $("#submitform span").text('Simpan');
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
