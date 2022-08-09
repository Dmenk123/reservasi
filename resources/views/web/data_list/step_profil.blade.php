{{-- <section class="vertical-wizard">
    <div class="bs-stepper vertical vertical-wizard-example">
      <div class="bs-stepper-header">
        <div class="step crossed" data-target="#account-details-vertical" role="tab" id="account-details-vertical-trigger">
          <button type="button" class="step-trigger" aria-selected="false">
            <span class="bs-stepper-box">1</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Account Details</span>
              <span class="bs-stepper-subtitle">Setup Account Details</span>
            </span>
          </button>
        </div>
        <div class="step crossed" data-target="#personal-info-vertical" role="tab" id="personal-info-vertical-trigger">
          <button type="button" class="step-trigger" aria-selected="false">
            <span class="bs-stepper-box">2</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Personal Info</span>
              <span class="bs-stepper-subtitle">Add Personal Info</span>
            </span>
          </button>
        </div>
        <div class="step crossed" data-target="#address-step-vertical" role="tab" id="address-step-vertical-trigger">
          <button type="button" class="step-trigger" aria-selected="false">
            <span class="bs-stepper-box">3</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Address</span>
              <span class="bs-stepper-subtitle">Add Address</span>
            </span>
          </button>
        </div>
        <div class="step active" data-target="#social-links-vertical" role="tab" id="social-links-vertical-trigger">
          <button type="button" class="step-trigger" aria-selected="true">
            <span class="bs-stepper-box">4</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Social Links</span>
              <span class="bs-stepper-subtitle">Add Social Links</span>
            </span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content"> --}}
        <div id="account-details-vertical" class="content dstepper-block" role="tabpanel" aria-labelledby="account-details-vertical-trigger">
            <div class="row">
                <div class="mb-1 col-md-12">
                    <label class="form-label" for="email_m_user_fo">{{__('step_profile_setup.label.email')}}</label>
                    <input type="text" readonly value="{{$old ? $old->email_m_candidate : session()->get('fo_logged_in.email_m_user_fo')}}" autocomplete="off" name="email_m_user_fo" id="email_m_user_fo" class="form-control square" placeholder="john.doe@email.com" aria-label="john.doe">
                </div>
            </div>
            <div class="row">
                <div class="mb-1 col-md-12">
                    <label class="form-label" for="nm_m_user_fo">{{__('step_profile_setup.label.nama')}}</label>
                    <input type="text" readonly value="{{$old ? $old->nm_m_candidate : session()->get('fo_logged_in.nm_m_user_fo')}}" autocomplete="off" name="nm_m_user_fo" id="nm_m_user_fo" class="form-control square">
                </div>
            </div>
            <div class="row">
                <div class="mb-1 col-md-12">
                    <label class="form-label" for="nik_m_user_fo">{{__('step_profile_setup.label.nik')}}</label>
                    <input type="text" readonly maxlength="16" value="{{$old ? $old->nik_m_candidate : session()->get('fo_logged_in.nik_m_user_fo')}}" autocomplete="off" name="nik_m_user_fo" id="nik_m_user_fo" class="form-control square">
                </div>
            </div>
            <div class="row">
                <div class="mb-1 col-md-12">
                    <label class="form-label" for="hp_m_user_fo">{{__('step_profile_setup.label.hp')}}</label>
                    <input type="text" readonly value="{{$old ? $old->hp_m_candidate : session()->get('fo_logged_in.hp_m_user_fo')}}" autocomplete="off" name="hp_m_user_fo" id="hp_m_user_fo" class="form-control square">
                </div>
            </div>
        </div>

      {{-- </div>
    </div>
  </section> --}}
