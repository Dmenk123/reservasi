<h3 class="mt-3">{{__('step_biodata.label.judul_saudara')}}</h3>

<table id="table_saudara" class="table table-sm dt-responsive nowrap table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th>{{__('step_biodata.table.no')}}</th>
            <th>{{__('step_biodata.table.nama')}}</th>
            <th>{{__('step_biodata.table.umur')}}</th>
            <th>{{__('step_biodata.table.pendidikan')}}</th>
            <th>{{__('step_biodata.table.pekerjaan')}}</th>
            <th>{{__('step_biodata.table.alamat')}}</th>
        </tr>
    </thead>
    <tbody>
        @php
            $table = \App\Models\M_candidate_fam::where('id_m_candidate', $old->id_m_candidate)->where('id_m_fam_rel', 5)->orderByDesc('updated_at')->get();
            $html = '';
            if($table->count() > 0){
                $i = 1;
                foreach($table as $tab)
                {
                    $html .= '<tr>';
                    $html .= '<td>'.$i.'</td>';
                    $html .= '<td>'.$tab->nm_m_candidate_fam.'</td>';
                    $html .= '<td>'.$tab->age_m_candidate_fam.'</td>';
                    $html .= '<td>'.($tab->last_edu_m_candidate_fam ? \App\Models\M_education_level::where('id_m_education_level', $tab->last_edu_m_candidate_fam)->first()->nm_m_education_level : null).'</td>';
                    $html .= '<td>'.$tab->job_m_candidate_fam.'</td>';
                    $html .= '<td>'.$tab->address_m_candidate_fam.'</td>';
                    $html .= '</tr>';
                    $i++;
                }
            }else{
                $html .= '<tr>';
                $html .= '<td colspan="6">No Data</td>';
                $html .= '</tr>';
            }
            echo $html;
        @endphp
    </tbody>
</table>

