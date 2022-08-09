<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="6"><strong>I. {{__('step_biodata.title')}}</strong></td>
    </tr>
    <tr>
      <td>{{__('step_biodata.label.nama_lengkap')}}</td>
      <td>:</td>
      <td>{{$old->nm_m_candidate}}</td>
      <td>{{__('step_biodata.label.nik')}}</td>
      <td>:</td>
      <td>{{$old->nik_m_candidate}}</td>
    </tr>
    <tr>
      <td>{{__('step_biodata.label.tempat_lahir')}}, {{__('step_biodata.label.tanggal_lahir')}}</td>
      <td>:</td>
      <td>{{$old->pob_m_candidate}}, {{($old->dob_m_candidate) ? \Carbon\Carbon::createFromFormat('Y-m-d',$old->dob_m_candidate)->format('d-m-Y') : null}}</td>
      <td>{{__('step_biodata.label.agama')}}</td>
      <td>:</td>
      <td>
      @php
          if($old->id_m_religion != ''){
              $get_s = \App\Models\M_religion::where('id_m_religion', $old->id_m_religion)->firstOrFail();
          }
      @endphp
      {{($old) ? $get_s->nm_m_religion : ''}}	</td>
    </tr>
    <tr>
      <td>{{__('step_biodata.label.alamat')}}</td>
      <td>:</td>
      <td>{{$old->address_m_candidate}}</td>
      <td>{{__('step_biodata.label.wa_aktif')}}</td>
      <td>:</td>
      <td>{{$old->active_wa_m_candidate}}</td>
    </tr>
    <tr>
      <td>Age / usia </td>
      <td>:</td>
      <td>&nbsp;</td>
      <td>{{__('step_biodata.label.cita_cita')}}</td>
      <td>:</td>
      <td>{{$old->cita_m_candidate}}</td>
    </tr>
    <tr>
      <td>{{__('step_biodata.label.hp')}}</td>
      <td>:</td>
      <td>{{$old->hp_m_candidate}}</td>
      <td>{{__('step_biodata.label.hobi')}}</td>
      <td>:</td>
      <td>{{$old->hobby_m_candidate}}</td>
    </tr>
    <tr>
      <td>{{__('step_biodata.label.status_pernikahan')}}</td>
      <td>:</td>
      <td>
      @php
          if($old->id_m_marital_status != ''){
              $get_marital = \App\Models\M_marital_status::where('id_m_marital_status', $old->id_m_marital_status)->firstOrFail();
          }
      @endphp
      {{($old) ? $get_marital->nm_m_marital_status : ''}}	</td>
      <td>{{__('step_biodata.label.olahraga')}}</td>
      <td>:</td>
      <td>{{$old->sport_m_candidate}}</td>
    </tr>
    <tr>
      <td>{{__('step_biodata.label.jenis_kelamin')}}</td>
      <td>:</td>
      <td>
      @php
          if($old->id_m_sex != ''){
              $get_s = \App\Models\M_sex::where('id_m_sex', $old->id_m_sex)->firstOrFail();
          }
      @endphp
      {{($old) ? $get_s->nm_m_sex : ''}}	</td>
      <td>{{__('step_biodata.label.tb')}} / {{__('step_biodata.label.bb')}}</td>
      <td>:</td>
      <td>{{$old->tb_m_candidate}} cm / {{$old->bb_m_candidate}} kg</td>
    </tr>
    <tr>
      <td>{{__('step_biodata.label.gol_darah')}}</td>
      <td>:</td>
      <td>{{($old) ? $old->gol_darah_m_candidate : ''}}</td>
      <td>{{__('step_biodata.label.sim')}}</td>
      <td>:</td>
      <td>
        {{-- {{($old) ? $old->drive_lic_type_m_candidate : ''}} --}}
        {{($old and $old->drive_lic_type_m_candidate) ? $old->drive_lic_type_m_candidate : ''}}
        {{($old and $old->drive_lic_type_m_candidate_2) ? ', '.$old->drive_lic_type_m_candidate_2 : ''}}
        {{($old and $old->drive_lic_type_m_candidate_3) ? ', '.$old->drive_lic_type_m_candidate_3 : ''}}
      </td>
    </tr>
    <tr>
      <td>Last Education / Pendidikan Terakhir </td>
      <td>:</td>
      <td>&nbsp;</td>
      <td>{{__('step_biodata.label.akun_ig')}}</td>
      <td>:</td>
      <td>{{$old->ig_account_m_candidate}}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>{{__('step_biodata.label.akun_fb')}}</td>
      <td>:</td>
      <td>{{$old->fb_account_m_candidate}}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>{{__('step_profile_setup.label.email')}}</td>
      <td>:</td>
      <td>{{$old->email_m_candidate}}</td>
    </tr>


