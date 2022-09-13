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

                            <div class="col-6">
                                @include('admin.forms.select2_database', [
                                    'name'  => 'proses',
                                    'label' => 'Proses',
                                    'label_width' => 3,
                                    'required' => 'required',
                                    'collection' => $proses,
                                    'option_value' => 'id_m_proses',
                                    'option_text' => 'nm_m_proses',
                                    'value' => '',
                                ])
                            </div>

                            <div class="col-6">
                                @include('admin.forms.select2', [
                                    'name'  => 'metode_bayar',
                                    'label' => 'Metode Bayar',
                                    'label_width' => 3,
                                    'input_width' => 8,
                                    'required' => 'required',
                                    'collection' => [
                                        [
                                            'option_value' => 'UPLOAD',
                                            'option_text' => 'UPLOAD'
                                        ],
                                        [
                                            'option_value' => 'PAYMENT_GATEWAY',
                                            'option_text' => 'PAYMENT GATEWAY'
                                        ]
                                    ],
                                    'value' => '',
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Kode</th>
                                <th>Telp</th>
                                <th>Proses</th>
                                <th>Hari / Tgl</th>
                                <th>Jam</th>
                                <th>Jenis</th>
                                <th>Metode</th>
                                <th>Kode Payment</th>
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
    @include('admin.layout.modal_global', ['title' => 'Verifikasi Transaksi', 'size' => 'xl'])
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
    let proses = null;
    let metode_bayar = null;

    generateDataTabel(month, year, proses, metode_bayar);

    $('#filter_report').click(function(e){
        e.preventDefault();
        var month = $('#month').val();
        var year = $('#year').val();
        var proses = $('#proses').val();
        var metode_bayar = $('#metode_bayar').val();

        if(month == '' || year == ''){
            displayWarningSwal('You have to choose month & year !');
        }else{
            // $('div.ndelik').slideDown();
            generateDataTabel(month, year, proses, metode_bayar);
        }
    })

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

    $('#datatable').on('click', '.detail_pembayaran', function(){
        $('#modal_preview').modal('show');
        var id_t_reservasi = $(this).data("id_t_reservasi");
        // console.log(id_t_content);
        $('#modal_preview .modal-body').html('');
        $.ajax({
            url:"{{ route('admin.t_reservasi.detail_pembayaran_modal') }}",
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

    $('#datatable').on('click', '.reject', function(){
        var id_t_reservasi = $(this).data("id_t_reservasi");
        swal.fire({
            title: "Confirmation",
            text: 'Yakin Reject Transaksi ini ?',
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "OK",
            cancelButtonText: "Cancel",
            reverseButtons: !0
        }).then(function (e) {

            if(e.value){
                $.ajax({
                    url:"{{ route('admin.t_reservasi.transaksi_reject') }}",
                    method:"post",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data:{id_t_reservasi:id_t_reservasi},
                    success:function(data)
                    {
                        if(data.status == true){
                            swal.fire({
                                title: "Pemberitahuan",
                                text: 'Transaksi telah di REJECT !!!',
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
        responsive:true,
        ajax: {
            url: '{{ route('admin.t_reservasi.datatable') }}',
            method: 'post',
            data: {
                month:month,
                year:year,
                proses:proses,
                metode_bayar:metode_bayar,
            }
        },
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nm_t_reservasi', name: 'nm_t_reservasi'},
            {data: 'email_t_reservasi', name: 'email_t_reservasi'},
            {data: 'kode_t_reservasi', name: 'kode_t_reservasi'},
            {data: 'telp_t_reservasi', name: 'telp_t_reservasi'},
            {data: 'nm_m_proses', name: 'nm_m_proses'},
            {data: 'tgl_t_reservasi', name: 'tgl_t_reservasi'},
            {data: 'jam_t_reservasi', name: 'jam_t_reservasi'},
            {data: 'jenis_t_reservasi', name: 'jenis_t_reservasi'},
            {data: 'metode_pembayaran_t_reservasi', name: 'metode_pembayaran_t_reservasi'},
            {data: 'kode_payment_t_reservasi', name: 'kode_payment_t_reservasi'},
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
</script>
@endsection
