@php
$get_data_ayah = \App\Models\M_candidate_fam::where('id_m_candidate', $old->id_m_candidate)->where('id_m_fam_rel', 1)->first();
$get_data_ibu = \App\Models\M_candidate_fam::where('id_m_candidate', $old->id_m_candidate)->where('id_m_fam_rel', 2)->first();
@endphp
<tr>
    <td colspan="6"><strong>IV. Data Orang Tua</strong></td>
  </tr>
  <tr>
    <td>{{__('step_biodata.label.nama_ayah')}}</td>
    <td>:</td>
    <td>{{($get_data_ayah) ? $get_data_ayah->nm_m_candidate_fam : ''}}</td>
    <td>{{__('step_biodata.label.nama_ibu')}}</td>
    <td>:</td>
    <td>{{($get_data_ibu) ? $get_data_ibu->nm_m_candidate_fam : ''}}</td>
  </tr>
  <tr>
    <td>{{__('step_biodata.label.umur_ayah')}}</td>
    <td>:</td>
    <td>{{($get_data_ayah) ? $get_data_ayah->age_m_candidate_fam : ''}}</td>
    <td>{{__('step_biodata.label.umur_ibu')}}</td>
    <td>:</td>
    <td>{{($get_data_ibu) ? $get_data_ibu->age_m_candidate_fam : ''}}</td>
  </tr>
  <tr>
    <td>{{__('step_biodata.label.pekerjaan_ayah')}}</td>
    <td>:</td>
    <td>{{($get_data_ayah) ? $get_data_ayah->job_m_candidate_fam : ''}}</td>
    <td>{{__('step_biodata.label.pekerjaan_ibu')}}</td>
    <td>:</td>
    <td>{{($get_data_ibu) ? $get_data_ibu->job_m_candidate_fam : ''}}</td>
  </tr>
  <tr>
    <td>{{__('step_biodata.label.alamat_ayah')}}</td>
    <td>:</td>
    <td>{{($get_data_ayah) ? $get_data_ayah->address_m_candidate_fam : ''}}</td>
    <td>{{__('step_biodata.label.alamat_ibu')}}</td>
    <td>:</td>
    <td>{{($get_data_ibu) ? $get_data_ibu->address_m_candidate_fam : ''}}</td>
  </tr>
  <tr>
    <td>{{__('step_biodata.label.telp_ayah')}}</td>
    <td>:</td>
    <td>{{($get_data_ayah) ? $get_data_ayah->telp_m_candidate_fam : ''}}</td>
    <td>{{__('step_biodata.label.telp_ibu')}}</td>
    <td>:</td>
    <td>{{($get_data_ibu) ? $get_data_ibu->telp_m_candidate_fam : ''}}</td>
  </tr>
