@extends('admin.layout.index')

@section('content')


              <!-- Advanced Search -->
              <section id="advanced-search-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header border-bottom">
                        <h4 class="card-title">{{$page_title}}</h4>

                        <a href="{{route('admin.m_user_group.add')}}" class="btn btn-success float-right"><i data-feather="plus"></i> Add New</a>
                      </div>

                      <hr class="my-0" />
                      <div class="card-datatable">
                        <table id="datatable" class="table-striped table-hover table table-bordered">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Application</th>
                              <th>User Group</th>
                              <th>Created at</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!--/ Advanced Search -->


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
$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

var table;

$(document).ready( function () {
    table = $('#datatable').DataTable({
        processing: true,
        serverside: true,
        pageLength: 20,
        ajax: {
            url: '{{ route('admin.m_user_group.datatable') }}',
            method: 'post'
        },
        columns: [
            { "width": "5%" },
            { "width": "30%" },
            { "width": "25%" },
            { "width": "15%" },
            { "width": "10%" },
            { "width": "15%" },
        ]
    });
});


$('#datatable').on('click', '.delete', function(){
    var id_m_user_group = $(this).data("id_m_user_group");
    swal.fire({
        title: "Confirmation",
        text: confirm_delete_text,
        icon: "warning",
        showCancelButton: !0,
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        reverseButtons: !0
    }).then(function (e) {

        if(e.value){
            $.ajax({
                url:"{{ route('admin.m_user_group.delete') }}",
                method:"post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{id_m_user_group:id_m_user_group},
                success:function(data)
                {
                    if(data.status == true){
                        swal.fire({
                            title: "Deleted!",
                            text: data_deleted,
                            icon: "success"
                        }).then(function() {
                            table.ajax.reload();
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

        })
});



$('#datatable').on('click', '.edit_hakakses', function(){
    var id_m_user_group_bo = $(this).data('id_m_user_group_bo');
    $('#modal_manage_permission').modal('show');
    $.ajax({
        url:"{{ route("admin.m_user_group_bo.manage") }}",
        method:"get",
        data: {
            id_m_user_group_bo:id_m_user_group_bo
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
              url:"{{ route("admin.m_user_group_bo.manage_post") }}",
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
</script>
@endsection
