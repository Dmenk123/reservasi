@extends('admin.layout.index')

@section('content')

              <!-- Advanced Search -->
              <section id="advanced-search-datatable">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header border-bottom">
                        <h4 class="card-title">{{$page_title}}</h4>
                      </div>

                      <hr class="my-0" />
                      <div class="card-datatable p-1">

                        {{-- <div class="row">

                            <div class="col-md-4 mt-1">
                                <label for="">Execution type</label>
                                <select  class="form-control select2" name="tipe_t_qrcode" id="tipe_t_qrcode">
                                    <option value="">All</option>
                                    <option value="walkin">Walk-In</option>
                                    <option value="onsite">On-Site</option>
                                </select>
                            </div>


                        </div> --}}


                        {{-- <div class="row">


                            <div class="col-md-4 mt-1" id="div_complete_status">
                                <label for="">Complete Status</label>
                                <select  class="form-control select2" name="complete_status" id="complete_status">
                                    <option value="">All</option>
                                    <option value="LENGKAP">Complete</option>
                                    <option value="BELUM LENGKAP">Incomplete</option>
                                    <option value="BELUM CHECKOUT">Not Checked Out</option>
                                </select>
                            </div>



                        </div> --}}

                        <div class="row">


                            <div class="col-md-4 mt-1" id="div_id_m_branch_company_basetown">
                                <label for="">Basetown Location</label>
                                <select  class="form-control select2" name="id_m_branch_company_basetown" id="id_m_branch_company_basetown">
                                    <option value="">All</option>
                                    @foreach($id_m_branch_company as $item_m_branch_company)
                                                <option value="{{$item_m_branch_company->nm_m_branch_company}}">{{$item_m_branch_company->nm_m_branch_company}}</option>
                                                @endforeach
                                </select>
                            </div>



                        </div>


                        <div class="row">





                                <div class="col-md-4" data-bs-toggle="tooltip" id="div_id_m_branch" data-bs-placement="top" title data-bs-original-title="Show data based on selected branch">
                                    <label for="">Choose Branch :</label>
                                    <select  class="form-control select2" name="id_m_branch" id="id_m_branch">
                                        <option value="">All Branch</option>
                                        @foreach($id_m_branch as $item_m_branch)
                                                <option value="{{$item_m_branch->id_m_branch}}">{{$item_m_branch->nm_m_branch}}</option>
                                                @endforeach
                                    </select>
                                </div>


                                <div class="col-md-4" data-bs-toggle="tooltip" id="div_id_m_company" data-bs-placement="top" title data-bs-original-title="Show data based on selected company">
                                    <label for="">Choose Company :</label>
                                    <select  class="form-control select2" name="id_m_company" id="id_m_company">
                                        <option value="">All Companies</option>
                                        @foreach ($m_company as $item)
                                            <option value="{{$item->id_m_company}}">{{$item->nm_m_company}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Show based on selected company branch" id="div_id_m_branch_company">
                                    <label for="">Choose Branch of Company :</label>
                                    <select  class="form-control select2" name="id_m_branch_company" id="id_m_branch_company">
                                        <option value="">All Branches</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Start From</label>
                                    <input type="text" data-bs-toggle="tooltip" data-bs-placement="bottom" title data-bs-original-title="Choose start period of check in" placeholder="start date" id="start1" name="start1" class="form-control datepicker">
                                </div>
                                <div class="col-md-2">
                                    <label for="">End at</label>
                                    <input type="text" data-bs-toggle="tooltip" data-bs-placement="bottom" title data-bs-original-title="Choose end period of check in" placeholder="end date" id="start2" name="start2" class="form-control datepicker">
                                </div>
                                {{-- <div class="col-md-4 mt-1">
                                    <label for="">Execution type</label>
                                    <select  class="form-control select2" name="tipe_t_qrcode" id="tipe_t_qrcode">
                                        <option value="">All</option>
                                        <option value="walkin">Walk-In</option>
                                        <option value="onsite">On-Site</option>
                                    </select>
                                </div> --}}
                                <div class="col-md-12 mt-1">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button class="btn btn-primary btn-sm square" name="filter_report" id="filter_report" type="submit"><i data-feather="search"></i> Filter Report</button>
                                        {{-- <a id="open_modal_pdf" href="javascript:void(0)" class="btn btn-sm btn-danger square" ><i data-feather="printer"></i> Print PDF</a> --}}
                                        <a id="export_xls" href="javascript:void(0)" class="btn btn-sm btn-success square" ><i data-feather="download"></i> Download .XLS</a>
                                        <a href="{{route('admin.report.daily.index')}}" class="btn btn-sm btn-secondary square" id="reset"><i data-feather="refresh-cw"></i> Reset</a>
                                        <a href="{{route('admin.report.index')}}" class="btn btn-sm bg-light-danger square" id="reset"><i data-feather="skip-back"></i> Main Menu</a>
                                    </div>

                                </div>

                            </div>
                          <table id="datatable" class="datatable table-sm mt-2 table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Booking Location</th>
                                        <th>Company Name</th>
                                        <th>Base Town Location</th>
                                        <th>Position</th>
                                        <th>Emp. ID (NIP)</th>
                                        <th>Employee Name</th>





                                        {{-- <th>CI Location</th> --}}

                                        <th>Booking Date</th>
                                        <th>Booking Number</th>
                                        {{-- <th>Reg No</th>
                                        <th>Type</th> --}}
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

@endsection


@section('js')
<script>
var table;
var start1;
var start2;
var id_m_company;
var id_m_branch_company;
var tipe_t_qrcode;
var id_m_branch;
var complete_status;
var id_m_branch_company_basetown;

$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

table = $('#datatable').DataTable({
    processing: true,
    serverside: true,
    pageLength: 20,
    ajax: {
        url: '{{ route('admin.report.reservation_prediction.datatable') }}',
        method: 'post',
        data: function(q){
            q.start1 = start1,
            q.start2 = start2,
            q.id_m_company = id_m_company,
            q.id_m_branch_company = id_m_branch_company,
            q.tipe_t_qrcode = tipe_t_qrcode,
            q.id_m_branch = id_m_branch,
            q.complete_status = complete_status,
            q.id_m_branch_company_basetown = id_m_branch_company_basetown


        }
    },
});

$('#filter_report').click(function(){
    start1 = $('#start1').val();
    start2 = $('#start2').val();
    id_m_company = $('#id_m_company').val();
    id_m_branch_company = $('#id_m_branch_company').val();
    tipe_t_qrcode = $('#tipe_t_qrcode').val();
    id_m_branch = $('#id_m_branch').val();
    complete_status = $('#complete_status').val();
    id_m_branch_company_basetown = $('#id_m_branch_company_basetown').val();
    table.ajax.reload();
})


$(document).ready( function () {
    $('#open_modal_pdf').click(function(){
        $('#modal_pdf .modal-body').html('');
        $('#modal_pdf').modal('show');
        id_m_profession = $('#id_m_profession').val();
        id_m_entity = $('#id_m_entity').val();
        $.ajax({
            url:'{!!route('admin.report.reservation_prediction.iframe')!!}',
            method:'get',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data:{
                id_m_profession:id_m_profession,
                id_m_entity:id_m_entity,
                id_m_branch:id_m_branch
            },
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
$('#id_m_company').change(function(){
    id_m_company = $('#id_m_company').val();
    $('#id_m_branch_company').html('');
    $.ajax({
        url:'{!!route('admin.report.daily.load_branch_by_company')!!}',
        method:'post',
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
            id_m_company:id_m_company,
        },
        success:function(data)
        {
            $('#id_m_branch_company').html(data.html);
        },
        error: function(data){
            displayErrorSwal(data.message);
        }
    })
})

$('#export_xls').click(function(){
    $.ajax({
        url:'{!!route('admin.report.reservation_prediction.download_xls')!!}',
        method:'post',
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data:{
            id_m_company:id_m_company,
            id_m_branch_company:id_m_branch_company,
            tipe_t_qrcode:tipe_t_qrcode,
            start1:start1,
            start2:start2,
            id_m_branch:id_m_branch,
            complete_status:complete_status,
            id_m_branch_company_basetown:id_m_branch_company_basetown
        },
        success:function(data)
        {
            var url = data.redirect;
            window.open(url, '_blank');
        },
        error: function(data){
            displayErrorSwal(data.message);
        }
    })
})

$('#div_id_m_company').slideUp();
$('#div_id_m_branch_company').slideUp();
$('#div_id_m_branch').slideUp();

function pilih_tipe_t_qrcode(){

if( $('#tipe_t_qrcode').val() =='walkin'){
                $('#div_id_m_branch').slideDown();
                $('#div_id_m_company').slideUp();
                $('#div_id_m_branch_company').slideUp();
                $('#div_id_m_branch_pelaksana').slideUp();


                $("#id_m_company").val('').removeAttr('required');
                $("#id_m_branch_company").val('').removeAttr('required');
                $("#id_m_branch_pelaksana").val('').removeAttr('required');
        }
        else if( $('#tipe_t_qrcode').val() =='onsite'){

            $('#div_id_m_branch').slideUp();
            $('#div_id_m_company').slideDown();
            $('#div_id_m_branch_company').slideDown();
            $('#div_id_m_branch_pelaksana').slideDown();

            $("#id_m_branch").val('').removeAttr('required');

        }else {

            $('#div_id_m_company').slideUp();
            $('#div_id_m_branch_company').slideUp();
            $('#div_id_m_branch').slideUp();
        }

}

pilih_tipe_t_qrcode();

$('#tipe_t_qrcode').change(function(){

    pilih_tipe_t_qrcode();

})

</script>
@endsection
