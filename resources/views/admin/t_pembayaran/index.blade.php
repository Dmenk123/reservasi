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
                <br>
                <div class="card-body">
                    <form method="get" id="form">
                        <div class="row">
                            <div class="col-6">
                                @php
                                    if(\Request::filled('branch')) {
                                        $employee = \App\Models\M_employee::select('id_m_employee', 'nm_m_employee')->where('id_m_branch', \Request::get('branch'))->orderBy('nm_m_employee')->get();
                                    }
                                @endphp
                                @include('admin.forms.select2_year', [
                                    'name'  => 'tahun',
                                    'label' => 'tahun',
                                    'label_width' => 3,
                                    'required' => 'required',
                                    'value' => \Carbon\Carbon::now()->format('Y'),
                                ])
                            </div>

                            <div class="col-6">
                                @include('admin.forms.select2_month', [
                                    'name'  => 'bulan',
                                    'label' => 'Bulan',
                                    'label_width' => 3,
                                    'required' => 'required',
                                    'value' => \Carbon\Carbon::now()->format('m'),
                                ])
                            </div>
                        </div>
                        <div class="col-md-12 mt-1" style="text-align: center;">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button class="btn btn-primary square" name="filter_report" id="filter_report" type="submit"><i data-feather="search"></i> Filter</button>
                                {{-- <div class="ndelik" style="display: none;">
                                    <button id="download_excel" class="btn btn-success square" ><i data-feather="printer"></i> <span id="span_excel">Download Excel</span></button>
                                </div> --}}
                            </div>

                        </div>
                    </form>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="card-datatable table-responsive">
                        <table id="datatable" class="table-striped table-hover table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Reservasi</th>
                                <th>Jenis</th>
                                <th>Durasi Cicilan</th>
                                <th>Cicilan Ke</th>
                                <th>Nilai</th>
                                <th>Balance</th>
                                <th>Total Bayar</th>
                                <th>Tgl Pelunasan</th>
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

    {{-- @include('admin.layout.modal_edit') --}}
    @include('admin.layout.modal_global', ['title' => 'Transaksi Pembayaran'])
    @include('admin.layout.modal_preview')
    {{-- @include('admin.layout.modal_add') --}}
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

    let month = "{{\Carbon\Carbon::now()->format('m')}}";
    let year = "{{\Carbon\Carbon::now()->format('Y')}}";

    generateDataTabel(month, year);

    $('#filter_report').click(function(e){
        e.preventDefault();
        var month = $('#month').val();
        var year = $('#year').val();

        if(month == '' || year == ''){
            displayWarningSwal('You have to choose month & year !');
        }else{
            // $('div.ndelik').slideDown();
            generateDataTabel(month, year);
        }
    })
});

const generateDataTabel = (month = null, year = null) => {
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
            url: '{{ route('admin.t_pembayaran.datatable') }}',
            method: 'post',
            data: {
                month:month,
                year:year,
            }
        },
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'kode_t_reservasi', name: 'kode_t_reservasi'},
            {data: 'jenis_t_pembayaran', name: 'jenis_t_pembayaran'},
            {data: 'durasi_cicilan_t_pembayaran', name: 'durasi_cicilan_t_pembayaran'},
            {data: 'cicilan_ke_t_pembayaran', name: 'cicilan_ke_t_pembayaran'},
            {data: 'nilai_t_pembayaran', name: 'nilai_t_pembayaran'},
            {data: 'balance_t_pembayaran', name: 'balance_t_pembayaran'},
            {data: 'nominal_total_t_pembayaran', name: 'nominal_total_t_pembayaran'},
            {data: 'tgl_pelunasan_t_pembayaran', name: 'tgl_pelunasan_t_pembayaran'},
            {data: 'action', name: 'action', orderable: false, searchable: false}

            // {data: 'updated_at.date', name: 'updated_at'}
        ]
    });
}

//EDIT IN MODAL [BEGIN]
$('#datatable').on('click', '.detail', function(){
    $('#modal_preview').modal('show');
    var id_t_reservasi = $(this).data("id_t_reservasi");
    // console.log(id_t_content);
    $('#modal_preview .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.t_reservasi.detail_modal') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_reservasi:id_t_reservasi},
        success:function(data)
        {
            $('#modal_preview .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
});

$('#datatable').on('click', '.verifikasi', function(){
    $('#modal_global').modal('show');
    var id_t_reservasi = $(this).data("id_t_reservasi");
    // console.log(id_t_content);
    $('#modal_global .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.t_reservasi.verifikasi_modal') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_reservasi:id_t_reservasi},
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
