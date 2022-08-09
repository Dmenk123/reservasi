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
              <form class="form-horizontal" id="form" method="post">
                <div class="card-body">

                  <div class="form-group row mb-5">
                    <label for="id_m_user_group" class="col-sm-2 col-form-label">Group Name</label>
                    <div class="col-sm-10">
                      <input type="hidden"  class="form-control" value="{{$old->id_m_user_group}}" name="id_m_user_group" id="id_m_user_group">
                      <input type="text"  class="form-control" readonly="" name="nm_user_group" value="{{$old->nm_user_group}}" id="nm_user_group">
                    </div>
                  </div>

                  <div class="row d-flex flex-row">
                  @foreach($id_m_module as $mod)
                      <div data-id_m_module="{{$mod->id_m_module}}" data-id_m_user_group="{{$old->id_m_user_group}}" class="col col-md-4 open_modal_manage_permission">
                          <div class="card" style="cursor: pointer;">
                              <div class="card-body bg-light-success">
                                  <strong>{{$mod->nm_m_module}}</strong>
                              </div>
                          </div>
                      </div>
                  @endforeach
                  </div>

{{--

                  <table style="width: auto;" class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>PAGES</th>
                        <th>ACTIVATE / DEACTIVATE</th>
                      </tr>
                    </thead>

                    <tbody>
                      @php
                      $x = 1;
                      @endphp
                      @foreach($menu as $m)

                      @php
                      $cek_by_role = \App\Models\M_hak_akses::where('id_m_user_group', request()->get('id_m_user_group'))->where('id_m_menu', $m->id_m_menu)->first();
                      $is_check = ($cek_by_role) ? 'checked' : '';
                      @endphp
                      <tr>
                        <td>{{$x++}}</td>
                        <td><strong>{{$m->nm_menu}}</strong></td>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" {{$is_check}} value="{{$m->id_m_menu}}" name="cek_{{$m->id_m_menu}}" id="cek_{{$m->id_m_menu}}">
                              </div>
                        </td>
                      </tr>
                          @php
                          $getsub = \App\Models\M_menu::where('id_parent', $m->id_m_menu)->get();
                          foreach($getsub as $sub){
                          @endphp

                          @php
                          $cek_by_role = \App\Models\M_hak_akses::where('id_m_user_group', request()->get('id_m_user_group'))->where('id_m_menu', $sub->id_m_menu)->first();
                          $is_check = ($cek_by_role) ? 'checked' : '';
                          @endphp
                          <tr>
                            <td></td>
                            <td> &bull; &nbsp; {{$sub->nm_menu}}</td>
                            <td>
                                <div class="form-check">
                                  <input type="checkbox" class="form-check-input" {{$is_check}} value="{{$sub->id_m_menu}}" name="cek_{{$sub->id_m_menu}}" id="cek_{{$sub->id_m_menu}}">
                                </div>
                            </td>
                          </tr>
                          @php
                          }
                          @endphp
                      @endforeach
                    </tbody>
                  </table> --}}

                </div>
                <!-- /.card-body -->
                <div class="col-sm-9 px-2">
                  {{-- <button type="submit" id="submitform" class="btn btn-success me-1 waves-effect waves-float waves-light"><span>Submit</span></button> --}}
                  <a href="{{route('admin.m_user_group.index')}}" class="btn btn-secondary waves-effect">Back</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- Modal Hak Akses Per Module -->
    <div
    class="modal fade"
    id="modal_manage_permission"
    tabindex="-1"
    aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Manage Permission</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
        </div> --}}
      </div>
    </div>
  </div>

@endsection

@section('js')
<script>
  // edit_hakakses
  $('.open_modal_manage_permission').click(function(){
    var id_m_module = $(this).data('id_m_module');
    var id_m_user_group = $(this).data('id_m_user_group');
    $('#modal_manage_permission').modal('show');
    $.ajax({
        url:"{{ route("admin.m_user_group.manage") }}",
        method:"get",
        data: {
            id_m_module:id_m_module,
            id_m_user_group:id_m_user_group
        },
        dataType: 'html',
        success:function(data)
        {
            $('#modal_manage_permission .modal-body').html(data);
        },
        error: function(data){
          displayErrorSwal();
        }
    });
  })



  $('#modal_manage_permission').on('submit', '#form_akses', function(){
      $(".text-danger").remove();
          event.preventDefault();
          var data = new FormData($('#form_akses')[0]);

          $.ajax({
              url:"{{ route("admin.m_user_group.manage_post") }}",
              method:"POST",
              headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
              data: data,
              processData: false,
              contentType: false,
              success:function(data)
              {
                  if(data.status == true){
                    $("#submitform").removeAttr('disabled');
                    $("#submitform span").text('Submit');
                    $("form").each(function() { this.reset() });
                    swal.fire({
                        title: "Success",
                        text: "Permission Updated",
                        icon: "success"
                    }).then(function() {
                        location.href = data.redirect;
                    });
                  }else{
                      displayErrorSwal(data.message);
                  }
              },
              error: function(data){
                  displayErrorSwal();
                  $("#submitform").removeAttr('disabled');
                  $("#submitform span").text('Upload');
              }
          });
      })


{{--
    // $(document).ready( function () {
    //     $("#form").submit(function(){
    //     $(".text-danger").remove();
    //     event.preventDefault();
    //     var data = new FormData($('#form')[0]);
    //     $("#submitform").attr('disabled', true);
    //     $("#submitform span").text(loading_text);

    //     $.ajax({
    //         url:"{{ route("admin.m_user_group.hakakses_update") }}",
    //         method:"POST",
    //         headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
    //         data: data,
    //         processData: false,
    //         contentType: false,
    //         success:function(data)
    //         {
    //             if($.isEmptyObject(data.error)){

    //                 if(data.status == true){
    //                     $("#submitform").removeAttr('disabled');
    //                     $("#submitform span").text('Submit');
    //                     $("form").each(function() { this.reset() });
    //                     swal.fire({
    //                         title: "Success",
    //                         text: "Permission Updated",
    //                         icon: "success"
    //                     }).then(function() {
    //                         location.href = data.redirect;
    //                     });
    //                 }else{
    //                   displayErrorSwal(data.message);
    //                 }

    //             }else{
    //                 displayWarningSwal();
    //                 $("#submitform").removeAttr('disabled');
    //                 $("#submitform span").text('Submit');
    //                 $.each(data.error, function(key, value) {
    //                     var element = $("#" + key);
    //                     element.closest("div.form-control")
    //                     .removeClass("text-danger")
    //                     .addClass(value.length > 0 ? "text-danger" : "")
    //                     .find("#error_" + key).remove();
    //                     element.after("<div id=error_"+ key + " class=text-danger>" + value + "</div>");
    //                 });
    //             }
    //         },
    //         error: function(data){
    //             displayErrorSwal(data.message);
    //         }
    //     });
    // });
    // });
  --}}

</script>
@endsection
