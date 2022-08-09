@extends('admin.layout.index')




@section('content')
<!-- Advanced Search -->
<section id="advanced-search-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{ $page_title }}</h4>
                    <a href="{{route('admin.report.form_rk.download_xls',['menu'=>request()->get('menu')])}}"
                        class="btn btn-success float-right download-xls">Download Excel (.xlsx)</a>
                </div>

                <hr class="my-0" />
                <div class="card-datatable">
                    <table id="datatable" class="table-striped table-hover table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Reg No.</th>
                                <th>Name</th>
                                <th>Filled Date</th>
                                <th>Actions</th>
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
@endsection

@section('js')
<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverside: true,
                pageLength: 20,
                ajax: {
                    url: '{{ route('admin.report.form_rk.datatable',['menu'=>request()->get('menu')]) }}',
                    method: 'POST'
                }
            });
        });
//EDIT IN MODAL [BEGIN]
$('#datatable').on('click', '.view_ans', function(){
    console.log('hi');
    $('#modal_edit').modal('show');
    $('#myModalLabel1').html('');
    var id_t_riwayat_kesehatan = $(this).data("id_t_riwayat_kesehatan");
    // console.log(id_m_mcu_category);
    $('#modal_edit .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.report.form_rk.view_ans',['menu' => request()->get('menu')]) }}",
        method:"POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_riwayat_kesehatan:id_t_riwayat_kesehatan},
        success:function(data)
        {
            $('#modal_edit .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
})

$('#datatable').on('click', '.view_info', function(){
    console.log('hi');
    $('#modal_edit').modal('show');
    $('#myModalLabel1').html('');
    var id_t_riwayat_kesehatan = $(this).data("id_t_riwayat_kesehatan");
    // console.log(id_m_mcu_category);
    $('#modal_edit .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.report.form_rk.view_info',['menu' => request()->get('menu')]) }}",
        method:"POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_riwayat_kesehatan:id_t_riwayat_kesehatan},
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
//EDIT IN MODAL [END]


// $('.card-header').on('click', '.download-xls', function(){
//     $.ajax({
//         url:"{{ route('admin.report.form_rk.download_xls',['menu' => request()->get('menu')]) }}",
//         method:"POST",
//         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//         // data:{id_t_sds:id_t_sds},
//         success:function(data)
//         {

//         },
//         error: function(data){
//             displayErrorSwal();
//         }
//     });
// })
</script>
@endsection
