
<tr>
    <td colspan="6"><strong>VI. Data Pendidikan - Formal</strong></td>
  </tr>
  <tr>
    <td colspan="6">
        <table id="table_pendidikan" border="1" width="100%" cellpadding="0" cellspacing="0" class="table table-sm dt-responsive nowrap table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{__('step_pendidikan_formal.table.no')}}</th>
                    <th>{{__('step_pendidikan_formal.table.nama_sekolah')}}</th>
                    <th>{{__('step_pendidikan_formal.table.tahun_masuk')}}</th>
                    <th>{{__('step_pendidikan_formal.table.tahun_lulus')}}</th>
                    <th>{{__('step_pendidikan_formal.table.strata')}}</th>
                    <th>{{__('step_pendidikan_formal.table.tertinggi')}}</th>
                    <th>{{__('step_pendidikan_formal.table.jurusan')}}</th>
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
                            $html_edu .= '<td align="center">'.$i.'</td>';
                            $html_edu .= '<td align="center">'.$tab->nm_school_m_candidate_edu.'</td>';
                            $html_edu .= '<td align="center">'.$tab->start_year_m_candidate_edu.'</td>';
                            $html_edu .= '<td align="center">'.$tab->graduate_year_m_candidate_edu.'</td>';
                            $html_edu .= '<td align="center">'.($tab->id_m_education_level ? \App\Models\M_education_level::where('id_m_education_level', $tab->id_m_education_level)->first()->nm_m_education_level : null).'</td>';
                            $html_edu .= '<td align="center">'.(($tab->last_m_candidate_edu == 'YES') ? 'YES' : null).'</td>';
                            $html_edu .= '<td align="center">'.($tab->id_m_education_type ? \App\Models\M_education_type::where('id_m_education_type', $tab->id_m_education_type)->first()->nm_m_education_type : null).'</td>';
                            $html_edu .= '</tr>';
                            $i++;
                        }
                    }else{
                        $html_edu .= '<tr>';
                        $html_edu .= '<td colspan="7">No Data</td>';
                        $html_edu .= '</tr>';
                    }
                    echo $html_edu;
                @endphp
            </tbody>
        </table>
    </td>
  </tr>
