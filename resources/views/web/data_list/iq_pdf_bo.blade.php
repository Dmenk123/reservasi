@php
$old = \App\Models\M_candidate::whereHas('t_applicant', function($query){
    $query->where('id_t_applicant', request()->get('id_t_applicant'));
    $query->where('id_t_emp_request_rct', request()->get('id_t_emp_request_rct'));
})->firstOrFail();

$id_m_marital_status = \App\Models\M_marital_status::where('active_m_marital_status', 'ACTIVE')->get();
$id_m_sex = \App\Models\M_sex::get();
$id_m_religion = \App\Models\M_religion::where('active_m_religion', 'ACTIVE')->get();
$id_m_education_level = \App\Models\M_education_level::where('active_m_education_level', 'ACTIVE')->get();
$id_m_provinsi = \App\Models\M_provinsi::orderBy('nm_m_provinsi')->get();

@endphp




<script type="application/javascript">

    function resizeIFrameToFitContent( iFrame ) {

        iFrame.width  = iFrame.contentWindow.document.body.scrollWidth;
        iFrame.height = iFrame.contentWindow.document.body.scrollHeight;
    }

    window.addEventListener('DOMContentLoaded', function(e) {

        var iFrame = document.getElementById( 'iFrame1' );
        resizeIFrameToFitContent( iFrame );

        // or, to resize all iframes:
        var iframes = document.querySelectorAll("iframe");
        for( var i = 0; i < iframes.length; i++) {
            resizeIFrameToFitContent( iframes[i] );
        }
    } );

    </script>

    <iframe width="100%" height="1200" src="{{route('admin.t_psychology_evaluation.render_pdf_iq_bo', [
        'id_t_applicant' => request()->get('id_t_applicant'),
        'id_t_emp_request_rct' => request()->get('id_t_emp_request_rct'),
        'id_m_test_pack' => request()->get('id_m_test_pack'),
        'id_t_test' => request()->get('id_t_test'),
    ])}}" id="iFrame1"></iframe>

