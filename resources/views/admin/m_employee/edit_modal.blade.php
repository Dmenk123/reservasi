
                        {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css')}}/select2.min.css"> --}}

                        <form method="post" id="form">

                            <div class="row">

                                <input type="hidden" id="id_m_employee" value="{{$old->id_m_employee}}" class="form-control" name="id_m_employee">


{{--
                                <div class="col-12" id="div_id_m_project">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="id_m_project">Project</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="id_m_project" name="id_m_project">

                                                @foreach($m_project as $item_m_project)
                                                <option value="{{$item_m_project->id_m_project}}">{{$item_m_project->nm_m_project}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div> --}}
{{--
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="tipe_t_qrcode">Tipe Pelaksanaan</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="tipe_t_qrcode" name="tipe_t_qrcode">
                                                <option value="">Please choose one</option>

                                                <option value="walkin" {{($old->tipe_t_qrcode == 'walkin') ? 'selected' : null}}>Walk-In</option>
                                                <option value="onsite" {{($old->tipe_t_qrcode == 'onsite') ? 'selected' : null}}>On-Site</option>

                                              </select>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- @if ($old->tipe_t_qrcode=='walkin') --}}




{{--
                                <div class="col-12" id="div_id_m_branch">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="id_m_branch">Pramita Branch</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="id_m_branch" name="id_m_branch">
                                                <option value="">Please choose one</option>
                                                @foreach($id_m_branch as $item_m_branch)
                                                <option value="{{$item_m_branch->id_m_branch}}"{{($selected_id_m_branch==$item_m_branch->id_m_branch)?'selected':null}} >{{$item_m_branch->nm_m_branch}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- @endif

                                @if ($old->tipe_t_qrcode=='onside') --}}


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="date_start_m_branch">NIP</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->nip_m_employee}}" id="nip_m_employee" name="nip_m_employee" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                </div>



                                {{-- <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">NIPK</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->nipk_m_employee}}" id="nipk_m_employee" name="nipk_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div> --}}


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Employee Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->nm_m_employee}}" id="nm_m_employee" name="nm_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Group</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->group_m_employee}}" id="group_m_employee" name="group_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Cost Center</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->cost_center_m_employee}}" id="cost_center_m_employee" name="cost_center_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Position Desc</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->position_m_employee}}" id="position_m_employee" name="position_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Business Unit</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->business_unit_m_employee}}" id="business_unit_m_employee" name="business_unit_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Department</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->department_m_employee}}" id="department_m_employee" name="department_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">HMS ORG LVL 3 DESCR 3</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->level_3_m_employee}}" id="level_3_m_employee" name="level_3_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">HMS ORG LVL 4 DESCR</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->level_4_m_employee}}" id="level_4_m_employee" name="level_4_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">HMS ORG LVL 5 DESCR</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->level_5_m_employee}}" id="level_5_m_employee" name="level_5_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Basetown</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->basetown_m_employee}}" id="basetown_m_employee" name="basetown_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Gender</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->gender_m_employee}}" id="gender_m_employee" name="gender_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Age Classification</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->age_classification_m_employee}}" id="age_classification_m_employee" name="age_classification_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Basetown City</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->basetown_city_m_employee}}" id="basetown_city_m_employee" name="basetown_city_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Email</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->email_m_employee}}" id="email_m_employee" name="email_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Grade</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->grade_m_employee}}" id="grade_m_employee" name="grade_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Masa Kerja</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->masa_kerja_m_employee}}" id="masa_kerja_m_employee" name="masa_kerja_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">HMS ORG LVL 2 DESCR</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->level_2_m_employee}}" id="level_2_m_employee" name="level_2_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">HMS ORG LVL 6 DESCR</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->level_6_m_employee}}" id="level_6_m_employee" name="level_6_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Business Address 1</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->business_address_m_employee}}" id="business_address_m_employee" name="business_address_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Business Address 2</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->business_address_2_m_employee}}" id="business_address_2_m_employee" name="business_address_2_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Postal Code</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->postal_code_m_employee}}" id="postal_code_m_employee" name="postal_code_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Strc ID</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->strc_id_m_employee}}" id="strc_id_m_employee" name="strc_id_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">STRC REPORT TO NAME
                                        </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->strc_name_m_employee}}" name="strc_name_m_employee" name="strc_name_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">STRC REPORT TO POSITION
                                        </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->strc_position_m_employee}}" name="strc_position_m_employee" name="strc_position_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="pic_eo">Scope
                                        </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{$old->scope_m_employee}}" name="scope_m_employee" name="scope_m_employee" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12" id="div_id_m_mcu_category">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                        <label class="col-form-label" for="id_m_mcu_category">Paket MCU</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="select2 form-select" id="id_m_mcu_category" name="id_m_mcu_category">
                                                <option value="">Please choose one</option>
                                                @foreach($m_mcu_category as $item_m_mcu_category)
                                                <option value="{{$item_m_mcu_category->id_m_mcu_category}}"{{($old->id_m_mcu_category==$item_m_mcu_category->id_m_mcu_category)?'selected':null}} ><b>{{$item_m_mcu_category->nm_m_mcu_category}}</b> - {{$item_m_mcu_category->paket_m_mcu_category}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>










{{--
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
                                </div> --}}


                                <div class="col-sm-9 offset-sm-3">
                                    <a href="#" class="btn btn-secondary waves-effect close_modal">Back</a>
                                    <button id="submitform" type="submit" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button>

                                </div>
                            </div>
                        </form>


                        <script src="{{asset('assets/js')}}/select2.full.min.js"></script>
                        <script src="{{asset('assets/js')}}/form-select2.min.js"></script>



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
            url:"{{ route("admin.m_employee.update") }}",
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




// $('#id_m_entity').change(function() {
//     id_m_entity = $(this).val();
//    // countries = $('#countries').val();
//     $('#id_m_branch').html('');
//     $.ajax({
//         type: "POST",
//         url: "{{route('load_branch')}}",
//         data: {id_m_entity: id_m_entity},
//         headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
//     }).done(function (res) {
//         $('#id_m_branch').html(res);
//     });
// })


// function pilih_branch(){
//     $('#tipe_t_qrcode').val()
//     // id_m_company = $(this).val();
//     id_m_company = $('#id_m_company').val();
//     $('#id_m_branch_company').html('');
//     $.ajax({
//         type: "POST",
//         url: "{{route('load_branch_company')}}",
//         data: {id_m_company: id_m_company},
//         headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") }
//     }).done(function (res) {
//         $('#id_m_branch_company').html(res);
//     });

// }

// pilih_branch();

// $('#id_m_company').change(function(){

//     pilih_branch();

// })




// function pilih_tipe_t_qrcode(){

// 	if( $('#tipe_t_qrcode').val() =='walkin'){
//                     $('#div_id_m_branch').slideDown();
//                     $('#div_id_m_company').slideUp();
//                     $('#div_id_m_branch_company').slideUp();
//                     $('#div_id_m_branch_pelaksana').slideUp();


//                     $("#id_m_company").val('').removeAttr('required');
//                     $("#id_m_branch_company").val('').removeAttr('required');
//                     $("#id_m_branch_pelaksana").val('').removeAttr('required');
// 			}
// 			else if( $('#tipe_t_qrcode').val() =='onsite'){

// 				$('#div_id_m_branch').slideUp();
//                 $('#div_id_m_company').slideDown();
//                 $('#div_id_m_branch_company').slideDown();
//                 $('#div_id_m_branch_pelaksana').slideDown();

//                 $("#id_m_branch").val('').removeAttr('required');

// 			}

// 	}

// 	pilih_tipe_t_qrcode();

// 	$('#tipe_t_qrcode').change(function(){

//         pilih_tipe_t_qrcode();

// 	})



/*

*/

</script>
