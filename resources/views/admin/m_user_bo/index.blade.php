@extends('admin.layout.index')

@section('content')

              <!-- Advanced Search -->
              <section id="advanced-search-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header border-bottom">
                        <h4 class="card-title">{{$page_title}}</h4>

                        <a href="{{route('admin.m_user_bo.add')}}" class="btn btn-success float-right"><i data-feather="plus"></i> Add New</a>
                      </div>

                      <hr class="my-0" />
                      <div class="card-datatable">
                        <table id="datatable" class="table-striped table-hover dt-advanced-search table table-bordered">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Username</th>
                              <th>Name</th>
                              <th>Branch</th>
                              <th>Group</th>
                              <th>Last Login</th>
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
            url: '{{ route('admin.m_user_bo.datatable') }}',
            method: 'post'
        },
        // columns: [
        //     // { "width": "5%" },
        //     // { "width": "15%" },
        //     // { "width": "25%" },
        //     // { "width": "15%" },
        //     // { "width": "10%" },
        //     // { "width": "30%" },
        // ]
    });
});


$('#datatable').on('click', '.delete', function(){
    var id_m_user_bo = $(this).data("id_m_user_bo");
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
                url:"{{ route('admin.m_user_bo.delete') }}",
                method:"post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{id_m_user_bo:id_m_user_bo},
                success:function(data)
                {
                    if(data.status == true){
                        swal.fire({
                            title: "Deleted!",
                            text: "Data deleted",
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
</script>
@endsection
