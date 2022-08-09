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

                                <input type="hidden" id="id_m_branch" value="{{$old->id_m_branch}}" class="form-control" name="id_m_branch">


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="id_m_entity">Entity Name</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="id_m_entity" name="id_m_entity">
                                                <option value="">Please choose one</option>
                                                @foreach($id_m_entity as $ent)
                                                <option {{($old->id_m_entity == $ent->id_m_entity) ? 'selected' : null}} value="{{$ent->id_m_entity}}">{{$ent->nm_m_entity}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="id_m_business_field">Business Field</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="id_m_business_field" name="id_m_business_field">

                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="id_m_branch_status">Branch Status</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="id_m_branch_status" name="id_m_branch_status">
                                                <option value="">Please choose one</option>
                                                @foreach($id_m_branch_status as $ent)
                                                <option {{($old->id_m_branch_status == $ent->id_m_branch_status) ? 'selected' : null}} value="{{$ent->id_m_branch_status}}">{{$ent->nm_m_branch_status}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="countries">Country</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="form-select" id="countries" name="countries">
                                                @foreach($countries as $coun)
                                                <option {{($old->country_id == $coun->id) ? 'selected' : null}} value="{{$coun->id}}">{{$coun->name}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="countries">State / Province</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="id_m_provinsi" name="id_m_provinsi">
                                                @foreach($id_m_provinsi as $item_id_m_provinsi)
                                                <option value="{{$item_id_m_provinsi->id_m_provinsi}}">{{$item_id_m_provinsi->nm_m_provinsi}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="id_m_kota">City / Regency</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="id_m_kota" name="id_m_kota">

                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="id_m_kecamatan">Sub District</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="id_m_kecamatan" name="id_m_kecamatan">

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="id_m_kelurahan">Village</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="id_m_kelurahan" name="id_m_kelurahan">

                                            </select>
                                        </div>
                                    </div>
                                </div>



                                {{-- <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="states">State / Province</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="states" name="states">

                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="cities">City / Regency</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="cities" name="cities">

                                            </select>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="nm_m_branch">Branch Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                        <input type="text" value="{{$old->nm_m_branch}}" id="nm_m_branch" class="form-control" name="nm_m_branch">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="address_m_branch">Branch Address</label>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="text" value="{{$old->address_m_branch}}" id="address_m_branch" class="form-control" name="address_m_branch">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="date_start_m_branch">Established Date</label>
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="text" value="{{($old->date_start_m_branch) ? \Carbon\Carbon::createFromFormat('Y-m-d', $old->date_start_m_branch)->format('d-m-Y') : null}}" id="date_start_m_branch" class="form-control datepicker" name="date_start_m_branch">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="telp_m_branch">Phone Number</label>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="text" value="{{$old->telp_m_branch}}" id="telp_m_branch" class="form-control" name="telp_m_branch">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="fax_m_branch">Fax Number</label>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="text" value="{{$old->fax_m_branch}}" id="fax_m_branch" class="form-control" name="fax_m_branch">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="no_lic_m_branch">License Number</label>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="text" value="{{$old->no_lic_m_branch}}" id="no_lic_m_branch" class="form-control" name="no_lic_m_branch">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="date_lic_m_branch">License Date</label>
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="text" value="{{($old->date_lic_m_branch) ? \Carbon\Carbon::createFromFormat('Y-m-d', $old->date_lic_m_branch)->format('d-m-Y') : null}}" id="date_lic_m_branch" class="form-control datepicker" name="date_lic_m_branch">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="email_m_branch">Email</label>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="text" value="{{$old->email_m_branch}}" id="email_m_branch" class="form-control" name="email_m_branch">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="code_m_branch">Branch Code</label>
                                        </div>
                                        <div class="col-sm-3">
                                        <input type="text"  value="{{$old->code_m_branch}}"id="code_m_branch" class="form-control" name="code_m_branch">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-2">
                                        <label class="col-form-label" for="active_m_branch">Active</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select class="form-select" id="active_m_branch" name="active_m_branch">
                                                <option {{($old->active_m_branch == 'ACTIVE') ? 'selected' : null}} value="ACTIVE">ACTIVE</option>
                                                <option {{($old->active_m_branch == 'NON ACTIVE') ? 'selected' : null}} value="NON ACTIVE">NON ACTIVE</option>
                                              </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-sm-9 offset-sm-2">
                                <button id="submitform" type="submit" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>
                                <a href="{{route('admin.m_branch.index')}}" class="btn btn-secondary waves-effect">Back</a>
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
            url:"{{ route("admin.m_branch.update") }}",
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



    /**
    onchange countries
    */
    $('#countries').change(function() {
        $('#states').html('');
        $('#cities').html('');
        countries = $(this).val();
        $.ajax({
            type: "POST",
            url: "{{route('load_states')}}",
            data: {countries: countries},
            headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
        }).done(function (res) {
            $('#states').html(res);
        });
    })

    /**
    onchange states
    */
    $('#states').change(function() {
        states = $(this).val();
        countries = $('#countries').val();
        $('#city').html('');
        $.ajax({
            type: "POST",
            url: "{{route('load_cities')}}",
            data: {states: states, countries: countries},
            headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
        }).done(function (res) {
            $('#cities').html(res);
        });
    })



    $('#id_m_provinsi').change(function() {
    id_m_provinsi = $(this).val();
    countries = $('#countries').val();
    $('#id_m_kota').html('');
    $.ajax({
        type: "POST",
        url: "{{route('load_kota')}}",
        data: {id_m_provinsi: id_m_provinsi, countries: countries},
        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
    }).done(function (res) {
        $('#id_m_kota').html(res);
    });
})


$('#id_m_kota').change(function() {
    id_m_kota = $(this).val();
    countries = $('#countries').val();
    $('#id_m_kecamatan').html('');
    $.ajax({
        type: "POST",
        url: "{{route('load_kecamatan')}}",
        data: {id_m_kota: id_m_kota, countries: countries},
        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
    }).done(function (res) {
        $('#id_m_kecamatan').html(res);
    });
})


$('#id_m_kecamatan').change(function() {
    id_m_kecamatan = $(this).val();
    countries = $('#countries').val();
    $('#id_m_kelurahan').html('');
    $.ajax({
        type: "POST",
        url: "{{route('load_kelurahan')}}",
        data: {id_m_kecamatan: id_m_kecamatan, countries: countries},
        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
    }).done(function (res) {
        $('#id_m_kelurahan').html(res);
    });
})

$('#id_m_entity').change(function() {
    id_m_entity = $(this).val();
   // countries = $('#countries').val();
    $('#id_m_business_field').html('');
    $.ajax({
        type: "POST",
        url: "{{route('load_business_field')}}",
        data: {id_m_entity: id_m_entity},
        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
    }).done(function (res) {
        $('#id_m_business_field').html(res);
    });
})



    /**
    onload handle edit data
    */
    var id_m_branch = '{{request()->get("id_m_branch")}}';
    $('#countries').html('');

    $.ajax({
        type: "POST",
        url: "{{route('admin.m_branch.handle_edit_m_branch')}}",
        data: {
            id_m_branch: id_m_branch
        },
        headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
    }).done(function (res) {
        $('#countries').html(res.html_country);
        //$('#states').html(res.html_state);
        //$('#cities').html(res.html_city);
        $('#id_m_provinsi').html(res.html_provinsi);
        $('#id_m_kota').html(res.html_kota);
        $('#id_m_kecamatan').html(res.html_kecamatan);
        $('#id_m_kelurahan').html(res.html_kelurahan);
        $('#id_m_business_field').html(res.html_business_field);
    });

</script>
@endsection
