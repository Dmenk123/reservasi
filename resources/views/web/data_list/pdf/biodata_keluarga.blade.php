@php
$get_data_couple = \App\Models\M_candidate_fam::where('id_m_candidate', $old->id_m_candidate)->whereIn('id_m_fam_rel', [3,4])->first();
@endphp
 <tr>
      <td colspan="6"><strong>II. Data Keluarga</strong></td>
    </tr>
    <tr>
      <td>Nama Suami / Istri</td>
      <td>:</td>
      <td>{{($get_data_couple) ? $get_data_couple->nm_m_candidate_fam : null}}</td>
      <td>{{__('step_biodata.label.tempat_lahir_pasutri')}}, {{__('step_biodata.label.tanggal_lahir_pasutri')}}</td>
      <td>:</td>
      <td>{{($get_data_couple) ? $get_data_couple->pob_m_candidate_fam : null}}, {{($get_data_couple) ? \Carbon\Carbon::createFromFormat('Y-m-d',$get_data_couple->dob_m_candidate_fam)->format('d-m-Y') : null}}</td>
    </tr>
    <tr>
      <td>{{__('step_biodata.label.alamat_pasutri')}}</td>
      <td>:</td>
      <td>{{($get_data_couple) ? $get_data_couple->address_m_candidate_fam : null}}</td>
      <td>{{__('step_biodata.label.agama_pasutri')}}</td>
      <td>:</td>
      @php
        if($get_data_couple->id_m_religion != ''){
            $get_s = \App\Models\M_religion::where('id_m_religion', $get_data_couple->id_m_religion)->firstOrFail();
        }else{
            $get_s = null;
        }
      @endphp
      <td>{{($get_data_couple and $get_s) ? $get_s->nm_m_religion : ''}}</td>
    </tr>
    <tr>
        <td>{{__('step_biodata.label.telp_pasutri')}}</td>
        <td>:</td>
        <td>{{($get_data_couple) ? $get_data_couple->telp_m_candidate_fam : null}}</td>
        <td>{{__('step_biodata.label.pekerjaan_pasutri')}}</td>
        <td>:</td>
        <td>{{($get_data_couple) ? $get_data_couple->job_m_candidate_fam : null}}</td>
    </tr>
    <tr>
        <td>{{__('step_biodata.label.pendidikan_pasutri')}}</td>
        <td>:</td>
        <td>
            @php
                if($get_data_couple->last_edu_m_candidate_fam != ''){
                    $get_s = \App\Models\M_education_level::where('id_m_education_level', $get_data_couple->last_edu_m_candidate_fam)->firstOrFail();
                }
            @endphp
            {{($get_data_couple) ? $get_s->nm_m_education_level : ''}}
        </td>
        <td>{{__('step_biodata.label.tanggal_menikah_pasutri')}}</td>
        <td>:</td>
        <td>
            @if($get_data_couple)
            {{($get_data_couple->date_wedding_m_candidate_fam) ? \Carbon\Carbon::createFromFormat('Y-m-d',$get_data_couple->date_wedding_m_candidate_fam)->format('d-m-Y') : null}}
            @endif
        </td>
    </tr>

