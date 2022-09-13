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
                        <div class="col-md-6">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button class="btn btn-primary square" name="filter_report" id="filter_report" type="submit"><i data-feather="search"></i> Filter Report</button>
                                @if (\Request::filled('tahun') && \Request::filled('bulan'))
                                    <a id="open_modal_pdf" href="javascript:void(0)" class="btn btn-danger square" ><i data-feather="printer"></i> Print PDF</a>
                                @endif
                                <a href="{{route('admin.lap_pendapatan.show_report')}}" class="btn btn-secondary square" id="reset"><i data-feather="refresh-cw"></i> Reset</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section id="advanced-search-datatable">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    {!! $html_report ?? '' !!}
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    </section>

    <div class="modal fade text-start show" id="modal_pdf" tabindex="-1"  role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Print Report as PDF</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <!--/ Advanced Search -->

    {{-- @include('admin.layout.modal_edit') --}}
    {{-- @include('admin.layout.modal_global', ['title' => 'Bukti Pembayaran']) --}}
    {{-- @include('admin.layout.modal_preview') --}}
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
    $('#filter_report').click(function(e){
        e.preventDefault();
        var bulan = $('#bulan').val();
        var tahun = $('#tahun').val();

        if(bulan == '' || tahun == ''){
            displayWarningSwal('You have to choose bulan & tahun !');
        }else{
            location.href = '{{route('admin.lap_pendapatan.show_report')}}?bulan='+bulan+'&tahun='+tahun;
        }
    });

    table = $('.datatable').DataTable();

    $('#open_modal_pdf').click(function(){
        $('#modal_pdf .modal-body').html('');
        $('#modal_pdf').modal('show');
        $.ajax({
            url:'{!!route('admin.lap_pendapatan.iframe_lap_pendapatan', ['bulan' => request()->get('bulan'),'tahun' => request()->get('tahun')])!!}',
            method:'get',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            // data:
            success:function(data)
            {
                $('#modal_pdf .modal-body').html(data);
            },
            error: function(data){
                displayErrorSwal(data.message);
            }
        })
        //
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

const viewBuktiPembayaran = (id_t_pembayaran_det) => {
    $('#modal_global').modal('show');
    // var id_t_reservasi = $(this).data("id_t_reservasi");
    // console.log(id_t_content);
    $('#modal_global .modal-body').html('');
    $.ajax({
        url:"{{ route('admin.t_pembayaran.bukti_pembayaran_modal') }}",
        method:"post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{id_t_pembayaran_det:id_t_pembayaran_det},
        success:function(data)
        {
            $('#modal_global .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
}


$('#modal_edit').on('click', '.close_modal', function(){
  $('#modal_edit .modal-body').html('');
  $('#modal_edit').modal('hide');
});

$('#modal_preview').on('click', '.close_modal', function(){
  $('#modal_preview .modal-body').html('');
  $('#modal_preview').modal('hide');
});

$('#modal_global').on('click', '.close_modal', function(){
  $('#modal_global .modal-body').html('');
  $('#modal_global').modal('hide');
});
</script>
@endsection
