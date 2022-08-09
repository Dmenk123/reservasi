<div id="pendidikan-formal" class="content dstepper-block" role="tabpanel" aria-labelledby="pendidikan-formal-trigger">

    <h3>{{__('step_pendidikan_formal.title')}}</h3>
    <table id="table_pendidikan" class="table table-sm dt-responsive nowrap table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>{{__('step_pendidikan_formal.table.no')}}</th>
                <th>{{__('step_pendidikan_formal.table.nama_sekolah')}}</th>
                <th>{{__('step_pendidikan_formal.table.tahun_masuk')}}</th>
                <th>{{__('step_pendidikan_formal.table.tahun_lulus')}}</th>
                <th>{{__('step_pendidikan_formal.table.strata')}}</th>
                <th>{{__('step_pendidikan_formal.table.tertinggi')}}</th>
            </tr>
        </thead>
        <tbody>
            @php
                $table_edu = \App\Models\M_candidate_edu::where('id_m_candidate', $old->id_m_candidate)->orderBy('updated_at')->get();
                $html_edu = '';
                if($table_edu->count() > 0){
                    $i = 1;
                    foreach($table_edu as $tab)
                    {
                        $html_edu .= '<tr>';
                        $html_edu .= '<td>'.$i.'</td>';
                        $html_edu .= '<td>'.$tab->nm_school_m_candidate_edu.'</td>';
                        $html_edu .= '<td>'.$tab->start_year_m_candidate_edu.'</td>';
                        $html_edu .= '<td>'.$tab->graduate_year_m_candidate_edu.'</td>';
                        $html_edu .= '<td>'.($tab->id_m_education_level ? \App\Models\M_education_level::where('id_m_education_level', $tab->id_m_education_level)->first()->nm_m_education_level : null).'</td>';
                        $html_edu .= '<td><input name="radio_jenjang" '.(($tab->last_m_candidate_edu == 'YES') ? 'checked' : null).' type="radio" class="form-check set_jenjang" data-id_m_candidate="'.$tab->id_m_candidate.'" data-id_m_candidate_edu="'.$tab->id_m_candidate_edu.'" /></td>';
                        $html_edu .= '</tr>';
                        $i++;
                    }
                }else{
                    $html_edu .= '<tr>';
                    $html_edu .= '<td colspan="6">No Data</td>';
                    $html_edu .= '</tr>';
                }
                echo $html_edu;
            @endphp
        </tbody>
    </table>




</div>
{{-- <div id="address-step-vertical" class="content dstepper-block" role="tabpanel" aria-labelledby="address-step-vertical-trigger">

</div>
<div id="social-links-vertical" class="content active dstepper-block" role="tabpanel" aria-labelledby="social-links-vertical-trigger">

</div> --}}
