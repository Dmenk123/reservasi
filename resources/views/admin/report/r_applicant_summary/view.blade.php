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
                            <div class="row">
                                {{-- <div class="col-md-3">
                                    <input value="{{request()->filled('date_start') ? request()->get('date_start') : null}}" class="form-control datepicker" placeholder="Date Start Period" name="date_start" id="date_start" />
                                </div>
                                <div class="col-md-3">
                                    <input value="{{request()->filled('date_end') ? request()->get('date_end') : null}}" class="form-control datepicker" placeholder="Date End Period" name="date_end" id="date_end" />
                                </div> --}}
                                <div class="col-md-3">
                                    <select class="form-control select2" name="id_m_profession" id="id_m_profession">
                                        <option value="">All Positions</option>
                                        @foreach ($m_profession as $item)
                                            <option value="{{$item->id_m_profession}}">{{$item->nm_m_profession}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control select2" name="id_m_entity" id="id_m_entity">
                                        <option value="">All Entities</option>
                                        @foreach ($m_entity as $item)
                                            <option value="{{$item->id_m_entity}}">{{$item->nm_m_entity}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control select2" name="id_m_branch" id="id_m_branch">
                                        <option value="">All Branches</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-1">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button class="btn btn-primary btn-sm square" name="filter_report" id="filter_report" type="submit"><i data-feather="search"></i> Filter Report</button>
                                        <a id="open_modal_pdf" href="javascript:void(0)" class="btn btn-sm btn-danger square" ><i data-feather="printer"></i> Print PDF</a>
                                        <a href="{{route('admin.report.applicant_summary.report_applicant_summary')}}" class="btn btn-sm btn-secondary square" id="reset"><i data-feather="refresh-cw"></i> Reset</a>
                                        <a href="{{route('admin.report.index')}}" class="btn btn-sm bg-light-danger square" id="reset"><i data-feather="skip-back"></i> Main Menu</a>
                                    </div>
                                    
                                </div>
                            </div>
                          <table id="datatable" class="datatable table-sm mt-2 table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Entity</th>
                                        <th>Branch</th>
                                        <th>Position</th>
                                        <th>Min Requirement</th>
                                        <th>Start & End Date</th>
                                        <th>Total Applicant</th>
                                        <th>Modified at</th>
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
var id_m_profession;
var id_m_entity;
var id_m_branch;

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
        url: '{{ route('admin.report.applicant_summary.datatable') }}',
        method: 'post',
        data: function(q){
            q.id_m_profession = id_m_profession,
            q.id_m_entity = id_m_entity,
            q.id_m_branch = id_m_branch
        }
    },
});

$('#filter_report').click(function(){
    id_m_profession = $('#id_m_profession').val();
    id_m_entity = $('#id_m_entity').val();
    id_m_branch = $('#id_m_branch').val();
    table.ajax.reload();
})


$(document).ready( function () {
    $('#open_modal_pdf').click(function(){
        $('#modal_pdf .modal-body').html('');
        $('#modal_pdf').modal('show');
        id_m_profession = $('#id_m_profession').val();
        id_m_entity = $('#id_m_entity').val();
        $.ajax({
            url:'{!!route('admin.report.applicant_summary.iframe_report_applicant_summary')!!}',
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


    $('#id_m_entity').change(function(){
        id_m_entity = $('#id_m_entity').val();
        $('#id_m_branch').html('');
        $.ajax({
            url:'{!!route('admin.report.applicant_summary.load_branch_by_entity')!!}',
            method:'post',
            dataType:'json',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data:{
                id_m_entity:id_m_entity,
            },
            success:function(data)
            {
                $('#id_m_branch').html(data.html);
            },
            error: function(data){
                displayErrorSwal(data.message);
            }
        })
    })
});

</script>
@endsection
