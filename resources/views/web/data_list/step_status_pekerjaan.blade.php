<div id="status-pekerjaan" class="content dstepper-block" role="tabpanel" aria-labelledby="status-pekerjaan-trigger">
    <div class="content-header">
        <h3 class="mb-0">{{__('step_status_pekerjaan.title')}}</h3>
        <small class="text-muted">{{__('step_status_pekerjaan.description')}}</small>
    </div>
    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="wanted_job_m_candidate">{{__('step_status_pekerjaan.label.job_keinginan')}}</label>
            <input type="text" readonly value="{{$old->wanted_job_m_candidate}}" name="wanted_job_m_candidate" id="wanted_job_m_candidate" class="square form-control" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="wanted_position_m_candidate">{{__('step_status_pekerjaan.label.jabatan_keinginan')}}</label>
            <input type="text" readonly value="{{$old->wanted_position_m_candidate}}" name="wanted_position_m_candidate" id="wanted_position_m_candidate" class="square form-control" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-12 mt-2">
            <label class="form-label" for="">{{__('step_status_pekerjaan.label.pekerjaan_lain')}}</label>
            <input type="text" readonly value="{{($old->other_job_m_candidate=='YES') ? __('step_status_pekerjaan.label.yes') : __('step_status_pekerjaan.label.no')}}" name="other_job_m_candidate" id="other_job_m_candidate" class="square form-control" />
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="note_other_job_m_candidate">{{__('step_status_pekerjaan.label.alasan')}} {{__('step_status_pekerjaan.label.pekerjaan_lain')}}</label>
            <input type="text" readonly value="{{$old->note_other_job_m_candidate}}" name="note_other_job_m_candidate" id="note_other_job_m_candidate" class="square form-control" />
        </div>
    </div>


    <div class="row">
        <div class="mb-1 col-md-12 mt-2">
            <label class="form-label" for="">{{__('step_status_pekerjaan.label.luar_kota')}}</label>
            <input type="text" readonly value="{{($old->outoftown_m_candidate=='YES') ? __('step_status_pekerjaan.label.yes') : __('step_status_pekerjaan.label.no')}}" name="outoftown_m_candidate" id="outoftown_m_candidate" class="square form-control" />
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="note_outoftown_m_candidate">{{__('step_status_pekerjaan.label.alasan')}} {{__('step_status_pekerjaan.label.luar_kota')}}</label>
            <input type="text" readonly value="{{$old->note_outoftown_m_candidate}}" name="note_outoftown_m_candidate" id="note_outoftown_m_candidate" class="square form-control" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-12 mt-2">
            <label class="form-label" for="">{{__('step_status_pekerjaan.label.shift')}}</label>
            <input type="text" readonly value="{{($old->work_shift_m_candidate=='YES') ? __('step_status_pekerjaan.label.yes') : __('step_status_pekerjaan.label.no')}}" name="work_shift_m_candidate" id="work_shift_m_candidate" class="square form-control" />
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="note_work_shift_m_candidate">{{__('step_status_pekerjaan.label.alasan')}} {{__('step_status_pekerjaan.label.shift')}}</label>
            <input type="text" readonly value="{{$old->note_work_shift_m_candidate}}" name="note_work_shift_m_candidate" id="note_work_shift_m_candidate" class="square form-control" />
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="salary_req_m_candidate">{{__('step_status_pekerjaan.label.gaji')}}</label>
            <input type="text" readonly value="{{$old->salary_req_m_candidate}}" name="salary_req_m_candidate" id="salary_req_m_candidate" class="square form-control numeral-mask" />
        </div>
    </div>
</div>
