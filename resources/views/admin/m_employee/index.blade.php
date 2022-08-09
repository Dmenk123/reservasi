@extends('admin.layout.index')

@section('content')


              <!-- Advanced Search -->
              <section id="advanced-search-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header border-bottom">
                        <h4 class="card-title">{{$page_title}}</h4>

                        <a href="javascript:void(0)" class="btn btn-danger ms-auto update_from_excell"><i data-feather="plus"></i> Update Data From Excel</a>
                        <a style="margin-left: 10px;" href="javascript:void(0)" class="btn btn-success ml-auto add"><i data-feather="plus"></i> Import From Excel</a>


                        {{-- <a href="javascript:void(0)" class="btn btn-success float-right add_employee"><i data-feather="plus"></i>Add Employee</a> --}}

                      </div>

                      <hr class="my-0" />
                      <div class="card-datatable">
                        <table id="datatable" class="table-striped table-hover table-sm table table-bordered">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>NIP / Emp ID</th>
                              <th>Name</th>
                              <th>Business Unit</th>
                              <th>Location</th>
                              <th>City</th>
                              <th>DoB</th>
                              <th>Created at</th>
                              <th>MCU Package</th>
                              <th>Project</th>
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

              @include('admin.layout.modal_add')
              @include('admin.layout.modal_edit')
              @include('admin.layout.modal_preview')
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
            url: '{{ route('admin.m_employee.datatable') }}',
            method: 'post'
        },
    });
});


$('#datatable').on('click', '.delete', function(){
    var id_m_employee = $(this).data("id_m_employee");
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
                url:"{{ route('admin.m_employee.delete') }}",
                method:"post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{id_m_employee:id_m_employee},
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


//ADD IN MODAL [BEGIN]
$('.add').click(function(){
    $('#modal_add').modal('show');
    $('#modal_add .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.m_employee.add_modal') }}",
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


//ADD IN MODAL [BEGIN]
$('.update_from_excell').click(function(){
    $('#modal_add').modal('show');
    $('#modal_add .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.m_employee.update_from_excell') }}",
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



//ADD IN MODAL [BEGIN]
$('.add_employee').click(function(){
    $('#modal_add').modal('show');
    $('#modal_add .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.m_employee.add_modal_employee') }}",
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

//EDIT IN MODAL [BEGIN]
$('#datatable').on('click', '.edit', function(){
    $('#modal_edit').modal('show');
    var id_m_employee = $(this).data("id_m_employee");
    $('#modal_edit .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.m_employee.edit_modal') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_m_employee:id_m_employee},
        success:function(data)
        {
            $('#modal_edit .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
})


//preview IN MODAL [BEGIN]
$('#datatable').on('click', '.preview', function(){
    $('#modal_preview').modal('show');
    var id_m_employee = $(this).data("id_m_employee");
    $('#modal_preview .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.m_employee.preview_modal') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_m_employee:id_m_employee},
        success:function(data)
        {
            $('#modal_preview .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
})

$('#modal_add').on('click', '.close_modal', function(){
  $('#modal_add .modal-body').html('');
  $('#modal_add').modal('hide');
})

$('#modal_edit').on('click', '.close_modal', function(){
  $('#modal_edit .modal-body').html('');
  $('#modal_edit').modal('hide');
})
//EDIT IN MODAL [END]
</script>
@endsection
