<div id="biodata" class="content dstepper-block" role="tabpanel" aria-labelledby="biodata-trigger">
    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="nm_m_candidate">{{__('step_biodata.label.nama_lengkap')}}</label>
            <input type="text" readonly value="{{$old->nm_m_candidate}}" autocomplete="off" name="nm_m_candidate" id="nm_m_candidate" class="form-control square">
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-8">
            <label class="form-label" for="pob_m_candidate">{{__('step_biodata.label.tempat_lahir')}}</label>
            <input type="text" readonly value="{{$old->pob_m_candidate}}" autocomplete="off" name="pob_m_candidate" id="pob_m_candidate" class="form-control square">
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="dob_m_candidate">{{__('step_biodata.label.tanggal_lahir')}}</label>
            <input type="text" readonly value="{{($old->dob_m_candidate) ? \Carbon\Carbon::createFromFormat('Y-m-d',$old->dob_m_candidate)->format('d-m-Y') : null}}" autocomplete="off" name="dob_m_candidate" id="dob_m_candidate" class="form-control square">
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="address_m_candidate">{{__('step_biodata.label.alamat')}}</label>
            <input type="text" readonly value="{{$old->address_m_candidate}}" autocomplete="off" name="address_m_candidate" id="address_m_candidate" class="form-control square">
        </div>
    </div>


    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="id_m_provinsi">{{__('step_biodata.label.provinsi')}}</label>
            @php
                if($old->id_m_kelurahan != ''){
                    $get_address = \App\Models\M_kelurahan::where('id_m_kelurahan', $old->id_m_kelurahan)
                                    ->with('m_kecamatan', function($query){
                                        $query->with('m_kota', function($query){
                                            $query->with('m_provinsi');
                                        });
                                    })->firstOrFail();
                }
            @endphp
            <input type="text" readonly value="{{($old) ? $get_address->m_kecamatan->m_kota->m_provinsi->nm_m_provinsi : ''}}" autocomplete="off" name="id_m_provinsi" id="id_m_provinsi" class="form-control square">
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="id_m_kota">{{__('step_biodata.label.kota')}}</label>
            <input type="text" readonly value="{{($old) ? $get_address->m_kecamatan->m_kota->nm_m_kota : ''}}" autocomplete="off" name="id_m_kota" id="id_m_kota" class="form-control square">
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="id_m_kecamatan">{{__('step_biodata.label.kecamatan')}}</label>
            <input type="text" readonly value="{{($old) ? $get_address->m_kecamatan->nm_m_kecamatan : ''}}" autocomplete="off" name="id_m_kecamatan" id="id_m_kecamatan" class="form-control square">
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="id_m_kelurahan">{{__('step_biodata.label.kelurahan')}}</label>
            <input type="text" readonly value="{{($old) ? $get_address->nm_m_kelurahan : ''}}" autocomplete="off" name="id_m_kelurahan" id="id_m_kelurahan" class="form-control square">
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="telp_m_candidate">{{__('step_biodata.label.telp_rumah')}}</label>
            <input type="text" readonly value="{{$old->telp_m_candidate}}" autocomplete="off" name="telp_m_candidate" id="telp_m_candidate" class="form-control square">
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="hp_m_candidate">{{__('step_biodata.label.hp')}}</label>
            <input type="text" readonly value="{{$old->hp_m_candidate}}" autocomplete="off" name="hp_m_candidate" id="hp_m_candidate" class="form-control square">
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="id_m_marital_status">{{__('step_biodata.label.status_pernikahan')}}</label>
            @php
                if($old->id_m_marital_status != ''){
                    $get_marital = \App\Models\M_marital_status::where('id_m_marital_status', $old->id_m_marital_status)->firstOrFail();
                }
            @endphp
            <input type="text" readonly value="{{($old) ? $get_marital->nm_m_marital_status : ''}}" autocomplete="off" name="id_m_marital_status" id="id_m_marital_status" class="form-control square">
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="id_m_sex">{{__('step_biodata.label.jenis_kelamin')}}</label>
            @php
                if($old->id_m_sex != ''){
                    $get_s = \App\Models\M_sex::where('id_m_sex', $old->id_m_sex)->firstOrFail();
                }
            @endphp
            <input type="text" readonly value="{{($old) ? $get_s->nm_m_sex : ''}}" autocomplete="off" name="id_m_sex" id="id_m_sex" class="form-control square">
        </div>
    </div>


    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="ig_account_m_candidate">{{__('step_biodata.label.akun_ig')}}</label>
            <input type="text" readonly value="{{$old->ig_account_m_candidate}}" autocomplete="off" name="ig_account_m_candidate" id="ig_account_m_candidate" class="form-control square">
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="fb_account_m_candidate">{{__('step_biodata.label.akun_fb')}}</label>
            <input type="text" readonly value="{{$old->fb_account_m_candidate}}" autocomplete="off" name="fb_account_m_candidate" id="fb_account_m_candidate" class="form-control square">
        </div>
    </div>


    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="nik_m_candidate">{{__('step_biodata.label.nik')}}</label>
            <input type="text" readonly maxlength="16" value="{{$old->nik_m_candidate}}" autocomplete="off" name="nik_m_candidate" id="nik_m_candidate" class="form-control square">
        </div>
    </div>


    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="id_m_religion">{{__('step_biodata.label.agama')}}</label>
            @php
                if($old->id_m_religion != ''){
                    $get_s = \App\Models\M_religion::where('id_m_religion', $old->id_m_religion)->firstOrFail();
                }
            @endphp

            <input type="text" readonly value="{{($old) ? $get_s->nm_m_religion : ''}}" autocomplete="off" name="id_m_religion" id="id_m_religion" class="form-control square">
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="active_telp_m_candidate">{{__('step_biodata.label.telp_aktif')}}</label>
            <input type="text" readonly value="{{$old->active_telp_m_candidate}}" autocomplete="off" name="active_telp_m_candidate" id="active_telp_m_candidate" class="form-control square">
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="active_wa_m_candidate">{{__('step_biodata.label.wa_aktif')}}</label>
            <input type="text" readonly value="{{$old->active_wa_m_candidate}}" autocomplete="off" name="active_wa_m_candidate" id="active_wa_m_candidate" class="form-control square">
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="cita_m_candidate">{{__('step_biodata.label.cita_cita')}}</label>
            <textarea readonly name="cita_m_candidate" id="cita_m_candidate" class="form-control square">{{$old->cita_m_candidate}}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="hobby_m_candidate">{{__('step_biodata.label.hobi')}}</label>
            <textarea readonly name="hobby_m_candidate" id="hobby_m_candidate" class="form-control square">{{$old->hobby_m_candidate}}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-12">
            <label class="form-label" for="sport_m_candidate">{{__('step_biodata.label.olahraga')}}</label>
            <textarea readonly name="sport_m_candidate" id="sport_m_candidate" class="form-control square">{{$old->sport_m_candidate}}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-4">
            <label class="form-label" for="tb_m_candidate">{{__('step_biodata.label.tb')}}</label>
            <input type="text" readonly value="{{$old->tb_m_candidate}}" autocomplete="off" name="tb_m_candidate" id="tb_m_candidate" class="form-control square">
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="bb_m_candidate">{{__('step_biodata.label.bb')}}</label>
            <input type="text" readonly value="{{$old->bb_m_candidate}}" autocomplete="off" name="bb_m_candidate" id="bb_m_candidate" class="form-control square">
        </div>
        <div class="mb-1 col-md-4">
            <label class="form-label" for="gol_darah_m_candidate">{{__('step_biodata.label.gol_darah')}}</label>

            <input type="text" readonly value="{{($old) ? $old->gol_darah_m_candidate : ''}}" autocomplete="off" name="gol_darah_m_candidate" id="gol_darah_m_candidate" class="form-control square">
        </div>
    </div>

    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="drive_lic_type_m_candidate">{{__('step_biodata.label.sim')}}</label>
            
            <input type="text" readonly value="{{($old and $old->drive_lic_type_m_candidate) ? $old->drive_lic_type_m_candidate : ''}}{{($old and $old->drive_lic_type_m_candidate_2) ? ', '.$old->drive_lic_type_m_candidate_2 : ''}}{{($old and $old->drive_lic_type_m_candidate_3) ? ', '.$old->drive_lic_type_m_candidate_3 : ''}}" autocomplete="off" name="drive_lic_type_m_candidate" id="drive_lic_type_m_candidate" class="form-control square">
            {{-- <input type="text" readonly value="{{($old) ? $old->drive_lic_type_m_candidate : ''}}" autocomplete="off" name="drive_lic_type_m_candidate" id="drive_lic_type_m_candidate" class="form-control square"> --}}
        </div>
    </div>

    @include('web.data_list.biodata_keluarga')
    @if($old->is_married == 'YES')
    <hr>
    @include('web.data_list.biodata_anak')
    @endif
    <hr>
    @include('web.data_list.biodata_ortu')
    <hr>
    @include('web.data_list.biodata_saudara')

</div>
