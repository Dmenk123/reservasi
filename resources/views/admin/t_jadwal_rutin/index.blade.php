@extends('admin.layout.index')

@section('content')
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom-primary">
                    <h4 class="card-title">{{$page_title}}</h4>
                    {{-- <a href="javascript:void(0)" class="btn btn-success float-right add"><i data-feather="plus"></i> Add New</a> --}}
                </div>
                {{-- <br> --}}
                {{-- <hr class="my-0" /> --}}
                <div class="card-body">
                    <div class="card-datatable table-responsive">
                        <table id="datatable" class="table-striped table-hover table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Status</th>
                                <th>Sesi</th>
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
    </div>
    </section>
    <!--/ Advanced Search -->

    @include('admin.layout.modal_global', ['title' => 'Verifikasi Transaksi'])
    @include('admin.layout.modal_add')
    @include('admin.layout.modal_edit')
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
    generateDataTabel();
});

const generateDataTabel = (month = null, year = null, proses = null, metode_bayar = null) => {
    let columns = [];

    if ( $.fn.DataTable.isDataTable('#datatable') ) {
        $('#datatable').DataTable().clear().destroy();
    }

    table = $('#datatable').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        pageLength: 20,
        // responsive:true,
        ajax: {
            url: '{{ route('admin.t_jadwal_rutin.datatable') }}',
            method: 'post',
        },
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'hari', name: 'hari'},
            {data: 'status', name: 'status'},
            {data: 'sesi', name: 'sesi'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
}

//EDIT IN MODAL [BEGIN]
$('#datatable').on('click', '.edit', function(){
    $('#modal_edit').modal('show');
    var id_t_jadwal_rutin = $(this).data("id_t_jadwal_rutin");
    // console.log(id_t_content);
    $('#modal_edit .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.t_jadwal_rutin.edit_modal') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_jadwal_rutin:id_t_jadwal_rutin},
        success:function(data)
        {
            $('#modal_edit .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
});

$('#datatable').on('click', '.setDetail', function(){
    $('#modal_global').modal('show');
    var id_t_jadwal_rutin = $(this).data("id_t_jadwal_rutin");
    // console.log(id_t_content);
    $('#modal_global .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.t_jadwal_rutin.set_detail_modal') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_jadwal_rutin:id_t_jadwal_rutin},
        success:function(data)
        {
            $('#modal_global .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
});

// $('.add').click(function(){
//     $('#modal_add').modal('show');
//     $('#modal_add .modal-body').html('');
//     $.ajax({
//         url:"{{ route('admin.t_content.add_modal') }}",
//         method:"post",
//         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//         success:function(data)
//         {
//             $('#modal_add .modal-body').html(data);
//         },
//         error: function(data){
//             displayErrorSwal();
//         }
//     });
// })


// $('#datatable').on('click', '.delete', function(){
//     var id_t_content = $(this).data("id_t_content");
//     swal.fire({
//         title: "Confirmation",
//         text: confirm_delete_text,
//         icon: "warning",
//         showCancelButton: !0,
//         confirmButtonText: "OK",
//         cancelButtonText: "Cancel",
//         reverseButtons: !0
//     }).then(function (e) {

//         if(e.value){
//             $.ajax({
//                 url:"{{ route('admin.t_content.delete') }}",
//                 method:"post",
//                 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//                 data:{id_t_content:id_t_content},
//                 success:function(data)
//                 {
//                     if(data.status == true){
//                         swal.fire({
//                             title: "Deleted!",
//                             text: data_deleted,
//                             icon: "success"
//                         }).then(function() {
//                             table.ajax.reload();
//                         });
//                     }else{
//                         displayErrorSwal(data.message);
//                     }
//                 },
//                 error: function(data){
//                     displayErrorSwal(data.message);
//                 }
//             });
//         }

//         })
// });




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
