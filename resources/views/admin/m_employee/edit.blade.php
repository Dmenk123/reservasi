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

                                <input type="hidden" id="id_m_entity" value="{{$old->id_m_entity}}" class="form-control" name="id_m_entity">
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="nm_m_entity">Entity Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                        <input type="text" value="{{$old->nm_m_entity}}" id="nm_m_entity" class="form-control" name="nm_m_entity">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="active_m_entity">Active</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select class="form-select" id="active_m_entity" name="active_m_entity">
                                                <option {{($old->active_m_entity=='ACTIVE') ? 'selected' : ''}} value="ACTIVE">ACTIVE</option>
                                                <option {{($old->active_m_entity=='NON ACTIVE') ? 'selected' : ''}} value="NON ACTIVE">NON ACTIVE</option>
                                              </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="id_m_business_field">Business Field</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="form-select" id="id_m_business_field" name="id_m_business_field">
                                                <option value="">Please choose</option>
                                                @foreach($id_m_business_field as $row)
                                                <option {{($old->id_m_business_field == $row->id_m_business_field) ? 'selected' : null}} value="{{$row->id_m_business_field}}">{{$row->nm_m_business_field}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="id_m_business_status">Business Status</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="form-select" id="id_m_business_status" name="id_m_business_status">
                                                <option value="">Please choose</option>
                                                @foreach($id_m_business_status as $row)
                                                <option {{($old->id_m_business_status == $row->id_m_business_status) ? 'selected' : null}} value="{{$row->id_m_business_status}}">{{$row->nm_m_business_status}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="address_m_entity">Address</label>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="text"  value="{{$old->address_m_entity}}" id="address_m_entity" class="form-control" name="address_m_entity">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="position_m_entity">Position</label>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="text" value="{{$old->position_m_entity}}" id="position_m_entity" class="form-control" name="position_m_entity">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="date_m_entity">Established Date</label>
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="text" value="{{($old->date_m_entity) ? \Carbon\Carbon::createFromFormat('Y-m-d', $old->date_m_entity)->format('d-m-Y') : null}}" id="date_m_entity" class="form-control datepicker" name="date_m_entity">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="no_siup_m_entity">SIUP Identity</label>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="text" value="{{$old->no_siup_m_entity}}" id="no_siup_m_entity" class="form-control" name="no_siup_m_entity">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="no_npwp_m_entity">NPWP Identity</label>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="text" value="{{$old->no_npwp_m_entity}}" id="no_npwp_m_entity" class="form-control" name="no_npwp_m_entity">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="no_certificate_m_entity">No. Certificate</label>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="text" value="{{$old->no_certificate_m_entity}}" id="no_certificate_m_entity" class="form-control" name="no_certificate_m_entity">
                                        </div>
                                    </div>
                                </div>



                                <div class="col-sm-9 offset-sm-2">
                                <button id="submitform" type="submit" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
                                <a href="{{route('admin.m_entity.index')}}" class="btn btn-secondary waves-effect">Back</a>
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
            url:"{{ route("admin.m_entity.update") }}",
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
