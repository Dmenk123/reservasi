@php
$get_data_couple = \App\Models\M_candidate_fam::where('id_m_candidate', $old->id_m_candidate)->whereIn('id_m_fam_rel', [3,4])->first();
@endphp

                    <h3 class="mt-3">{{__('step_biodata.label.judul_pasutri')}}</h3>
                        <div class="row">
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="is_married">{{__('step_biodata.label.is_married')}}</label>
                                <input type="text" readonly value="{{($old) ? ($old->is_married=='YES' ? __('step_biodata.label.yes') : __('step_biodata.label.belum')) : ''}}" autocomplete="off" name="is_married" id="is_married" class="form-control square">
                            </div>
                        </div>

                        @if($get_data_couple)
                        <div id="show_for_married_only">
                            <div class="row">
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="id_m_fam_rel">{{__('step_biodata.label.hub_pasutri')}}</label>

                                    <input type="text" readonly value="{{ ($get_data_couple) ? ($get_data_couple->id_m_fam_rel == 3 ? __('step_biodata.option.suami') : __('step_biodata.option.istri') ) : '' }}" autocomplete="off" name="id_m_fam_rel" id="id_m_fam_rel" class="form-control square">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="nm_m_candidate_fam_keluarga">{{__('step_biodata.label.nama_pasutri')}}</label>
                                    <input type="text" readonly value="{{($get_data_couple) ? $get_data_couple->nm_m_candidate_fam : null}}" autocomplete="off" name="nm_m_candidate_fam_keluarga" id="nm_m_candidate_fam_keluarga" class="form-control square">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="address_m_candidate_fam_keluarga">{{__('step_biodata.label.alamat_pasutri')}}</label>
                                    <input type="text" readonly value="{{($get_data_couple) ? $get_data_couple->address_m_candidate_fam : null}}" autocomplete="off" name="address_m_candidate_fam_keluarga" id="address_m_candidate_fam_keluarga" class="form-control square">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="pob_m_candidate_fam_keluarga">{{__('step_biodata.label.tempat_lahir_pasutri')}}</label>
                                    <input type="text" readonly value="{{($get_data_couple) ? $get_data_couple->pob_m_candidate_fam : null}}" autocomplete="off" name="pob_m_candidate_fam_keluarga" id="pob_m_candidate_fam_keluarga" class="form-control square">
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="dob_m_candidate_fam_keluarga">{{__('step_biodata.label.tanggal_lahir_pasutri')}}</label>
                                    <input type="text" readonly value="{{($get_data_couple) ? \Carbon\Carbon::createFromFormat('Y-m-d',$get_data_couple->dob_m_candidate_fam)->format('d-m-Y') : null}}" autocomplete="off" name="dob_m_candidate_fam_keluarga" id="dob_m_candidate_fam_keluarga" class="form-control square">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="religion_m_candidate_fam_keluarga">{{__('step_biodata.label.agama_pasutri')}}</label>
                                    @php
                                        if($get_data_couple->id_m_religion != ''){
                                            $get_s = \App\Models\M_religion::where('id_m_religion', $get_data_couple->id_m_religion)->firstOrFail();
                                        }
                                    @endphp
                                    <input type="text" readonly value="{{($get_data_couple) ? $get_s->nm_m_religion : ''}}" autocomplete="off" name="id_m_religion" id="id_m_religion" class="form-control square">
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="telp_m_candidate_fam_keluarga">{{__('step_biodata.label.telp_pasutri')}}</label>
                                    <input type="text" readonly value="{{($get_data_couple) ? $get_data_couple->telp_m_candidate_fam : null}}" autocomplete="off" name="telp_m_candidate_fam_keluarga" id="telp_m_candidate_fam_keluarga" class="form-control square">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="job_m_candidate_fam_keluarga">{{__('step_biodata.label.pekerjaan_pasutri')}}</label>
                                    <input type="text" readonly value="{{($get_data_couple) ? $get_data_couple->job_m_candidate_fam : null}}" autocomplete="off" name="job_m_candidate_fam_keluarga" id="job_m_candidate_fam_keluarga" class="form-control square">
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="last_edu_m_candidate_fam_keluarga">{{__('step_biodata.label.pendidikan_pasutri')}}</label>
                                    @php
                                        if($get_data_couple->last_edu_m_candidate_fam != ''){
                                            $get_s = \App\Models\M_education_level::where('id_m_education_level', $get_data_couple->last_edu_m_candidate_fam)->firstOrFail();
                                        }
                                    @endphp
                                    <input type="text" readonly value="{{($get_data_couple) ? $get_s->nm_m_education_level : ''}}" autocomplete="off" name="last_edu_m_candidate_fam_keluarga" id="last_edu_m_candidate_fam_keluarga" class="form-control square">
                                </div>
                            </div>

                            {{-- <div class="mb-1 col-md-6">
                                <label class="form-label" for="dob_m_candidate_fam_keluarga">{{__('step_biodata.label.tanggal_lahir_pasutri')}}</label>
                                <input type="text" value="{{($get_data_couple) ? \Carbon\Carbon::createFromFormat('Y-m-d',$get_data_couple->dob_m_candidate_fam)->format('d-m-Y') : null}}" autocomplete="off" name="dob_m_candidate_fam_keluarga" id="dob_m_candidate_fam_keluarga" class="form-control square datepicker">
                            </div> --}}


                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="date_wedding_m_candidate_fam_keluarga">{{__('step_biodata.label.tanggal_menikah_pasutri')}}</label>
                                    @if($get_data_couple)
                                    <input type="text" readonly value="{{($get_data_couple->date_wedding_m_candidate_fam) ? \Carbon\Carbon::createFromFormat('Y-m-d',$get_data_couple->date_wedding_m_candidate_fam)->format('d-m-Y') : null}}" autocomplete="off" name="date_wedding_m_candidate_fam_keluarga" id="date_wedding_m_candidate_fam_keluarga" class="form-control square">
                                    @else
                                    <input type="text" readonly value="" autocomplete="off" name="date_wedding_m_candidate_fam_keluarga" id="date_wedding_m_candidate_fam_keluarga" class="form-control square datepicker">
                                    @endif
                                </div>
                            </div>

                        </div>
                        @endif
