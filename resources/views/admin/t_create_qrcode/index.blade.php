@extends('admin.layout.index')

@section('content')

              <!-- Advanced Search -->
              <section id="advanced-search-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header border-bottom-primary">
                        <h4 class="card-title">{{$page_title}}</h4>

                        <a href="javascript:void(0)" class="btn btn-success float-right add"><i data-feather="plus"></i> Add New</a>
                      </div>

                      <hr class="my-0" />
                      <div class="card-datatable">
                        <table id="datatable" class="table-striped table-hover table table-bordered">
                          <thead>
                            <tr>
                              <th>No</th>
                              {{-- <th>Branch</th>
                              <th>Company Name</th> --}}

                              <th>Location</th>
                              <th>MCU Period</th>
                              <th>PIC Participant</th>
                              <th>Modified at</th>
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



              <div class="modal fade text-start show" id="modal_check_in" tabindex="-1"  role="dialog">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Check In Scan QR</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        </div>
                    </div>
                  </div>
              </div>
              <div class="modal fade text-start show" id="modal_check_out" tabindex="-1"  role="dialog">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Check Out Scan QR</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        </div>
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
            url: '{{ route('admin.t_create_qrcode.datatable') }}',
            method: 'post'
        },
    });
});


$('#datatable').on('click', '.delete', function(){
    var id_t_qrcode = $(this).data("id_t_qrcode");
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
                url:"{{ route('admin.t_create_qrcode.delete') }}",
                method:"post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{id_t_qrcode:id_t_qrcode},
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
        url:"{{ route('admin.t_create_qrcode.add_modal') }}",
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
    var id_t_qrcode = $(this).data("id_t_qrcode");
    $('#modal_edit .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.t_create_qrcode.edit_modal') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_qrcode:id_t_qrcode},
        success:function(data)
        {
            $('#modal_edit .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
})

$('#modal_edit').on('click', '.close_modal', function(){
  $('#modal_edit .modal-body').html('');
  $('#modal_edit').modal('hide');
})
$('#modal_add').on('click', '.close_modal', function(){
  $('#modal_add .modal-body').html('');
  $('#modal_add').modal('hide');
})
//EDIT IN MODAL [END]



$('#datatable').on('click', '.check_in_modal', function(){
  $('#modal_check_in').modal('show');
    var id_t_qrcode = $(this).data("id_t_qrcode");
    var tipe_t_qrcode = $(this).data("tipe_t_qrcode");
    $('#modal_check_in .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.t_create_qrcode.iframe_qr_in') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_qrcode:id_t_qrcode,tipe_t_qrcode:tipe_t_qrcode},
        success:function(data)
        {
            $('#modal_check_in .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
})

$('#datatable').on('click', '.check_out_modal', function(){
  $('#modal_check_out').modal('show');
    var id_t_qrcode = $(this).data("id_t_qrcode");
    var tipe_t_qrcode = $(this).data("tipe_t_qrcode");
    $('#modal_check_out .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.t_create_qrcode.iframe_qr_out') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_qrcode:id_t_qrcode,tipe_t_qrcode:tipe_t_qrcode},
        success:function(data)
        {
            $('#modal_check_out .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
})
</script>
@endsection
