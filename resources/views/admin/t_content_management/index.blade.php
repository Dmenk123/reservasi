@extends('admin.layout.index')

@section('content')


              <!-- Advanced Search -->
              <section id="advanced-search-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header border-bottom-primary">
                        <h4 class="card-title">{{$page_title}}</h4>

                        {{-- <a href="{{route('admin.t_content.add')}}" class="btn btn-success float-right add"><i data-feather="plus"></i> Add New</a> --}}
                        <a href="javascript:void(0)" class="btn btn-success float-right add"><i data-feather="plus"></i> Add New</a>

                      </div>

                      <hr class="my-0" />
                      <div class="card-datatable">
                        <table id="datatable" class="table-striped table-hover table table-bordered">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>App Name</th>
                              <th>Menu</th>
                              <th>Title</th>
                              <th>Subtitle</th>
                              <th>User Group</th>
                              <th>Created at</th>
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

              @include('admin.layout.modal_edit')
              @include('admin.layout.modal_global', ['title' =>'Set User Role Data'])
              @include('admin.layout.modal_add')
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
            url: '{{ route('admin.t_content.datatable') }}',
            method: 'post'
        },
    });
});

$('.add').click(function(){
    $('#modal_add').modal('show');
    $('#modal_add .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.t_content.add_modal') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success:function(data)
        {
            $('#modal_add .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
})


$('#datatable').on('click', '.delete', function(){
    var id_t_content = $(this).data("id_t_content");
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
                url:"{{ route('admin.t_content.delete') }}",
                method:"post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{id_t_content:id_t_content},
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


//EDIT IN MODAL [BEGIN]
$('#datatable').on('click', '.edit', function(){
    $('#modal_edit').modal('show');
    var id_t_content = $(this).data("id_t_content");
    console.log(id_t_content);
    $('#modal_edit .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.t_content.edit_modal') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_content:id_t_content},
        success:function(data)
        {
            $('#modal_edit .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
});

$('#datatable').on('click', '.user-group', function(){
    $('#modal_global').modal('show');
    var id_t_content = $(this).data("id_t_content");

    $('#modal_global .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.t_content.user_group_modal') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_content:id_t_content},
        success:function(data)
        {
            $('#modal_global .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
});

$('#modal_edit').on('click', '.close_modal', function(){
  $('#modal_edit .modal-body').html('');
  $('#modal_edit').modal('hide');
});

$('#modal_add').on('click', '.close_modal', function(){
  $('#modal_add .modal-body').html('');
  $('#modal_add').modal('hide');
});

$('#modal_global').on('click', '.close_modal', function(){
  $('#modal_global .modal-body').html('');
  $('#modal_global').modal('hide');
});
</script>
@endsection
