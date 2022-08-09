<h3 class="mt-3">{{__('step_biodata.label.judul_ortu')}}</h3>
@php
$get_data_ayah = \App\Models\M_candidate_fam::where('id_m_candidate', $old->id_m_candidate)->where('id_m_fam_rel', 1)->first();
$get_data_ibu = \App\Models\M_candidate_fam::where('id_m_candidate', $old->id_m_candidate)->where('id_m_fam_rel', 2)->first();
@endphp
<div class="row">

    <label class="form-label"><strong>{{__('step_biodata.label.ayah')}}</strong></label>

    <div class="mb-1 col-md-6">
        <label class="form-label" for="nm_ayah_m_candidate_fam">{{__('step_biodata.label.nama_ayah')}}</label>
        <input type="text" readonly value="{{($get_data_ayah) ? $get_data_ayah->nm_m_candidate_fam : ''}}" autocomplete="off" name="nm_ayah_m_candidate_fam" id="nm_ayah_m_candidate_fam" class="form-control square">
    </div>

    <div class="mb-1 col-md-6">
        <label class="form-label" for="umur_ayah_m_candidate_fam">{{__('step_biodata.label.umur_ayah')}}</label>
        <input type="text" readonly value="{{($get_data_ayah) ? $get_data_ayah->age_m_candidate_fam : ''}}" autocomplete="off" name="umur_ayah_m_candidate_fam" id="umur_ayah_m_candidate_fam" class="form-control square">
    </div>

    <div class="mb-1 col-md-6">
        <label class="form-label" for="pekerjaan_ayah_m_candidate_fam">{{__('step_biodata.label.pekerjaan_ayah')}}</label>
        <input type="text" readonly value="{{($get_data_ayah) ? $get_data_ayah->job_m_candidate_fam : ''}}" autocomplete="off" name="pekerjaan_ayah_m_candidate_fam" id="pekerjaan_ayah_m_candidate_fam" class="form-control square">
    </div>

    <div class="mb-1 col-md-6">
        <label class="form-label" for="alamat_ayah_m_candidate_fam">{{__('step_biodata.label.alamat_ayah')}}</label>
        <input type="text" readonly  value="{{($get_data_ayah) ? $get_data_ayah->address_m_candidate_fam : ''}}" autocomplete="off" name="alamat_ayah_m_candidate_fam" id="alamat_ayah_m_candidate_fam" class="form-control square">
    </div>

    <div class="mb-1 col-md-6">
        <label class="form-label" for="telp_ayah_m_candidate_fam">{{__('step_biodata.label.telp_ayah')}}</label>
        <input type="text" readonly  value="{{($get_data_ayah) ? $get_data_ayah->telp_m_candidate_fam : ''}}" autocomplete="off" name="telp_ayah_m_candidate_fam" id="telp_ayah_m_candidate_fam" class="form-control square">
    </div>

</div>

<div class="row">

    <label class="form-label"><strong>{{__('step_biodata.label.ibu')}}</strong></label>

    <div class="mb-1 col-md-6">
        <label class="form-label" for="nm_ibu_m_candidate_fam">{{__('step_biodata.label.nama_ibu')}}</label>
        <input type="text" readonly value="{{($get_data_ibu) ? $get_data_ibu->nm_m_candidate_fam : ''}}" autocomplete="off" name="nm_ibu_m_candidate_fam" id="nm_ibu_m_candidate_fam" class="form-control square">
    </div>

    <div class="mb-1 col-md-6">
        <label class="form-label" for="umur_ibu_m_candidate_fam">{{__('step_biodata.label.umur_ibu')}}</label>
        <input type="text" readonly value="{{($get_data_ibu) ? $get_data_ibu->age_m_candidate_fam : ''}}" autocomplete="off" name="umur_ibu_m_candidate_fam" id="umur_ibu_m_candidate_fam" class="form-control square">
    </div>

    <div class="mb-1 col-md-6">
        <label class="form-label" for="pekerjaan_ibu_m_candidate_fam">{{__('step_biodata.label.pekerjaan_ibu')}}</label>
        <input type="text" readonly value="{{($get_data_ibu) ? $get_data_ibu->job_m_candidate_fam : ''}}" autocomplete="off" name="pekerjaan_ibu_m_candidate_fam" id="pekerjaan_ibu_m_candidate_fam" class="form-control square">
    </div>

    <div class="mb-1 col-md-6">
        <label class="form-label" for="alamat_ibu_m_candidate_fam">{{__('step_biodata.label.alamat_ibu')}}</label>
        <input type="text" readonly value="{{($get_data_ibu) ? $get_data_ibu->address_m_candidate_fam : ''}}" autocomplete="off" name="alamat_ibu_m_candidate_fam" id="alamat_ibu_m_candidate_fam" class="form-control square">
    </div>

    <div class="mb-1 col-md-6">
        <label class="form-label" for="telp_ibu_m_candidate_fam">{{__('step_biodata.label.telp_ibu')}}</label>
        <input type="text" readonly value="{{($get_data_ibu) ? $get_data_ibu->telp_m_candidate_fam : ''}}" autocomplete="off" name="telp_ibu_m_candidate_fam" id="telp_ibu_m_candidate_fam" class="form-control square">
    </div>

</div>
