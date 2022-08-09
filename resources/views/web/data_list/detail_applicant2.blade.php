@extends('web.layout.'.((request()->get('layout')!='false')?'index':'blank'))

@if(request()->get('layout')!='false')
    @section('content')
@endif
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
    <section class="vertical-wizard">
        <div class="bs-stepper vertical vertical-wizard-example">
          <div class="bs-stepper-header">
            <div class="step crossed" data-target="#account-details-vertical" role="tab" id="account-details-vertical-trigger">
                <button type="button" class="step-trigger" aria-selected="false">
                    <span class="bs-stepper-box">1</span>
                    <span class="bs-stepper-label">
                      <span class="bs-stepper-title">{{__('step_profile_setup.title')}}</span>
                      <span class="bs-stepper-subtitle">{{__('step_profile_setup.description')}}</span>
                    </span>
                  </button>
            </div>
            <div class="step crossed" data-target="#biodata" role="tab" id="biodata-trigger">
              <button type="button" class="step-trigger" aria-selected="false">
                <span class="bs-stepper-box">2</span>
                <span class="bs-stepper-label">
                      <span class="bs-stepper-title">{{__('step_biodata.title')}}</span>
                      <span class="bs-stepper-subtitle">{{__('step_biodata.description')}}</span>
                    </span>
              </button>
            </div>
            <div class="step crossed" data-target="#pendidikan-formal" role="tab" id="pendidikan-formal-trigger">
              <button type="button" class="step-trigger" aria-selected="false">
                <span class="bs-stepper-box">3</span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title">{{__('step_pendidikan_formal.title')}}</span>
                    <span class="bs-stepper-subtitle">{{__('step_pendidikan_formal.description')}}</span>
                </span>
              </button>
            </div>
            <div class="step" data-target="#pendidikan-non-formal" role="tab" id="pendidikan-non-formal-trigger">
              <button type="button" class="step-trigger" aria-selected="true">
                <span class="bs-stepper-box">4</span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title">{{__('step_pendidikan_non_formal.title')}}</span>
                    <span class="bs-stepper-subtitle">{{__('step_pendidikan_non_formal.description')}}</span>
                </span>
              </button>
            </div>
            <div class="step" data-target="#penghargaan" role="tab" id="penghargaan-trigger">
              <button type="button" class="step-trigger" aria-selected="true">
                <span class="bs-stepper-box">5</span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title">{{__('step_penghargaan.title')}}</span>
                    <span class="bs-stepper-subtitle">{{__('step_penghargaan.description')}}</span>
                </span>
              </button>
            </div>
            <div class="step" data-target="#pengalaman-kerja" role="tab" id="pengalaman-kerja-trigger">
              <button type="button" class="step-trigger" aria-selected="true">
                <span class="bs-stepper-box">6</span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title">{{__('step_pengalaman_kerja.title')}}</span>
                    <span class="bs-stepper-subtitle">{{__('step_pengalaman_kerja.description')}}</span>
                </span>
              </button>
            </div>
            <div class="step" data-target="#pengalaman-organisasi" role="tab" id="pengalaman-organisasi-trigger">
              <button type="button" class="step-trigger" aria-selected="true">
                <span class="bs-stepper-box">7</span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title">{{__('step_pengalaman_organisasi.title')}}</span>
                    <span class="bs-stepper-subtitle">{{__('step_pengalaman_organisasi.description')}}</span>
                </span>
              </button>
            </div>
            <div class="step" data-target="#status-pekerjaan" role="tab" id="status-pekerjaan-trigger">
              <button type="button" class="step-trigger" aria-selected="true">
                <span class="bs-stepper-box">8</span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title">{{__('step_status_pekerjaan.title')}}</span>
                    <span class="bs-stepper-subtitle">{{__('step_status_pekerjaan.description')}}</span>
                </span>
              </button>
            </div>
            {{-- <div class="step" data-target="#catatan" role="tab" id="catatan-trigger">
              <button type="button" class="step-trigger" aria-selected="true">
                <span class="bs-stepper-box">9</span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title">{{__('step_other_notes.title')}}</span>
                    <span class="bs-stepper-subtitle">{{__('step_other_notes.description')}}</span>
                </span>
              </button>
            </div> --}}
            <div class="step" data-target="#upload" role="tab" id="upload-trigger">
              <button type="button" class="step-trigger" aria-selected="true">
                <span class="bs-stepper-box">9</span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title">{{__('step_upload.title')}}</span>
                    <span class="bs-stepper-subtitle">{{__('step_upload.description')}}</span>
                </span>
              </button>
            </div>
          </div>

          <div class="bs-stepper-content">

          <br>

        {{--include per step--}}

        @include('web.data_list.step_profil')
        @include('web.data_list.step_biodata')
        @include('web.data_list.step_pendidikan_formal')
        @include('web.data_list.step_pendidikan_non_formal')
        @include('web.data_list.step_penghargaan')
        @include('web.data_list.step_pengalaman_kerja')
        @include('web.data_list.step_pengalaman_organisasi')
        @include('web.data_list.step_status_pekerjaan')
        {{-- @include('web.data_list.step_catatan') --}}
        @include('web.data_list.step_upload')

        {{--include per step--}}

        </div>
    </div>
</section>





    @if(request()->get('layout')!='false')
    @endsection
    @endif


