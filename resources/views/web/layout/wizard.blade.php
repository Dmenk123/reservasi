<div class="step {{(\Route::currentRouteName() == 'web.profile_user.index') ? 'active' : null}}" data-target="#account-details-vertical" role="tab" id="account-details-vertical-trigger">
    <button type="button" class="step-trigger" aria-selected="true">
      <span class="bs-stepper-box">1</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_profile_setup.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_profile_setup.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'web.biodata.index') ? 'active' : null}}"  role="tab" id="div_biodata">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">2</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_biodata.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_biodata.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'web.pendidikan_formal.index') ? 'active' : null}}"  role="tab" id="div_riwayat_pendidikan">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">3</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_pendidikan_formal.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_pendidikan_formal.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'web.pendidikan_non_formal.index') ? 'active' : null}}"  role="tab">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">4</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_pendidikan_non_formal.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_pendidikan_non_formal.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'web.penghargaan.index') ? 'active' : null}}"  role="tab">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">5</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_penghargaan.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_penghargaan.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'web.pengalaman_kerja.index') ? 'active' : null}}"  role="tab">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">6</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_pengalaman_kerja.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_pengalaman_kerja.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'web.pengalaman_organisasi.index') ? 'active' : null}}"  role="tab">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">7</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_pengalaman_organisasi.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_pengalaman_organisasi.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'web.employee_status.index') ? 'active' : null}}"  role="tab">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">8</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_status_pekerjaan.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_status_pekerjaan.description')}}</span>
      </span>
    </button>
  </div>
  {{-- <div class="step {{(\Route::currentRouteName() == 'web.other_notes.index') ? 'active' : null}}"  role="tab">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">9</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_other_notes.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_other_notes.description')}}</span>
      </span>
    </button>
  </div> --}}

  @if(request()->filled('token'))
  <div class="step {{(\Route::currentRouteName() == 'web.upload.index') ? 'active' : null}}"  role="tab">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">9</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_upload.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_upload.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'web.before_submit.index') ? 'active' : null}}"  role="tab">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">10</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_before_submit.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_before_submit.description')}}</span>
      </span>
    </button>
  </div>
  @endif
