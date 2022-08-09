<div class="step {{(\Route::currentRouteName() == 'admin.m_employee.profile_user.index') ? 'active' : null}}" data-target="#step-profil" role="tab" id="step-profil-trigger">
    <button type="button" class="step-trigger" aria-selected="true">
      <span class="bs-stepper-box">1</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_profile_setup.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_profile_setup.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'admin.m_employee.biodata.index') ? 'active' : null}}" data-target="#step-biodata" role="tab" id="step-biodata-trigger">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">2</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_biodata.title_pegawai')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_biodata.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'admin.m_employee.pendidikan_formal.index') ? 'active' : null}}" data-target="#step-pendidikan" role="tab" id="step-pendidikan-trigger">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">3</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_pendidikan_formal.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_pendidikan_formal.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'admin.m_employee.pendidikan_non_formal.index') ? 'active' : null}}" data-target="#step-pendidikan-nonformal" role="tab" id="step-pendidikan-nonformal-trigger">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">4</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_pendidikan_non_formal.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_pendidikan_non_formal.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'admin.m_employee.penghargaan.index') ? 'active' : null}}" data-target="#step-penghargaan" role="tab" id="step-penghargaan-trigger">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">5</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_penghargaan.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_penghargaan.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'admin.m_employee.pengalaman_kerja.index') ? 'active' : null}}" data-target="#step-pengalaman" role="tab" id="step-pengalaman-trigger">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">6</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_pengalaman_kerja.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_pengalaman_kerja.description')}}</span>
      </span>
    </button>
  </div>
  <div class="step {{(\Route::currentRouteName() == 'admin.m_employee.pengalaman_organisasi.index') ? 'active' : null}}" data-target="#step-organisasi" role="tab" id="step-organisasi-trigger">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">7</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_pengalaman_organisasi.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_pengalaman_organisasi.description')}}</span>
      </span>
    </button>
  </div>
  {{-- <div class="step {{(\Route::currentRouteName() == 'admin.m_employee.employee_status.index') ? 'active' : null}}"  role="tab">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">8</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_status_pekerjaan.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_status_pekerjaan.description')}}</span>
      </span>
    </button>
  </div> --}}
  {{-- <div class="step {{(\Route::currentRouteName() == 'web.other_notes.index') ? 'active' : null}}"  role="tab">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">9</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_other_notes.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_other_notes.description')}}</span>
      </span>
    </button>
  </div> --}}
  <div class="step {{(\Route::currentRouteName() == 'admin.m_employee.upload.index') ? 'active' : null}}" data-target="#step-upload" role="tab" id="step-upload-trigger">
    <button type="button" class="step-trigger" aria-selected="false">
      <span class="bs-stepper-box">8</span>
      <span class="bs-stepper-label">
        <span class="bs-stepper-title">{{__('step_upload.title')}}</span>
        <span class="bs-stepper-subtitle">{{__('step_upload.description')}}</span>
      </span>
    </button>
  </div>
