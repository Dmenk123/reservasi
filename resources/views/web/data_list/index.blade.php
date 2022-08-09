@extends('web.layout.index')
@section('content')

<h4 class="mb-2">{{__('data_list.judul')}}</h4>

@forelse($data_job as $job)
<div class="col-xl-12 col-md-12 col-12 ">
    <div class="card card-custom">
      <div class="card-body custom-body">



            <p>{{__('data_list.label.nama')}} : {{$job->nm_m_candidate}} - {{$job->is_qualified}}</p>
            <p>{{__('data_list.label.profesi')}} : {{$job->nm_m_profession}}</p>
            <p>{{__('data_list.label.cabang')}} : {{$job->nm_m_branch}}</p>
            @php
                \Carbon\Carbon::setLocale(request()->segment(1));
            @endphp
            <p>Status : <strong><span class="text-success">@if ($job->is_qualified=='YES'){{__('data_list.label.status_yes')}} @elseif  ($job->is_qualified=='NO'){{__('data_list.label.status_no')}} @else  {{__('data_list.label.status')}} @endif</span></strong></p>
            <p>{{__('data_list.label.dibuat')}} : {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $job->updated_at)->isoFormat('dddd, D MMMM Y')}}</p>
            <a class="btn btn-danger square" href="{{route('web.detail_applicant', ['id_t_applicant' => $job->id_t_applicant, 'id_t_emp_request_rct' => $job->id_t_emp_request_rct])}}">{{__('data_list.selengkapnya')}}</a>&nbsp;
            <a class="btn btn-outline-secondary square btn-prev waves-effect open_modal_pdf" data-id_t_applicant="{{$job->id_t_applicant}}" data-id_t_emp_request_rct="{{$job->id_t_emp_request_rct}}"><i data-feather="download"></i>&nbsp;&nbsp;{{__('data_list.pdf')}}</a>

    </div>
  </div>
</div>

{{ $data_job->links() }}

@empty
<div class="col-xl-12 col-md-12 col-12">
    <div class="card card-statistics">
      <div class="card-body statistics-body">
        <div class="row">

            <p>Anda belum pernah mengajukan lamaran pekerjaan. Silahkan melihat lowongan kerja untuk mendapatkan informasi peluang kerja.</p>

        </div>
    </div>
  </div>
</div>
@endforelse


<!-- Modal -->
<div class="modal fade" id="modal_pdf" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">{{__('data_list.pdf')}}</h5>
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

$('.open_modal_pdf').click(function(){
    $('#modal_pdf').modal('show');
    var id_t_emp_request_rct = $(this).data('id_t_emp_request_rct');
    var id_t_applicant = $(this).data('id_t_applicant');
    $.ajax({
        url     :"{{ route("web.pdf_detail_applicant") }}",
        method  :"get",
        dataType:"html",
        headers : { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
        data    : {
            id_t_emp_request_rct : id_t_emp_request_rct,
            id_t_applicant : id_t_applicant,
        },
        success :function(data)
        {
            $('#modal_pdf .modal-body').html(data);
        },
        error: function(data){
            displayErrorSwal();
        }
    });
})
</script>

@endsection
