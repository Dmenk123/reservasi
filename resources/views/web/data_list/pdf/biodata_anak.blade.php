<tr>
    <td colspan="6"><strong>III. Data Anak</strong></td>
  </tr>
  <tr>
    <td colspan="6">
        <table id="table_anak" width="100%" border="1" cellspacing="0" cellpadding="0" class="table table-sm dt-responsive nowrap table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{__('step_biodata.table.no')}}</th>
                    <th>{{__('step_biodata.table.nama')}}</th>
                    <th>{{__('step_biodata.table.pendidikan')}}</th>
                    <th>{{__('step_biodata.table.tgl_lahir')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $table = \App\Models\M_candidate_fam::where('id_m_candidate', $old->id_m_candidate)->where('id_m_fam_rel', 6)->orderByDesc('updated_at')->get();
                    $html = '';
                    if($table->count() > 0){
                        $i = 1;
                        foreach($table as $tab)
                        {
                            $html .= '<tr>';
                            $html .= '<td align="center">'.$i.'</td>';
                            $html .= '<td align="center">'.$tab->nm_m_candidate_fam.'</td>';
                            $html .= '<td align="center">'.($tab->last_edu_m_candidate_fam ? \App\Models\M_education_level::where('id_m_education_level', $tab->last_edu_m_candidate_fam)->first()->nm_m_education_level : null).'</td>';
                            $html .= '<td align="center">'.$tab->pob_m_candidate_fam.', '.\Carbon\Carbon::createFromFormat('Y-m-d',$tab->dob_m_candidate_fam)->format('d F Y').'</td>';
                            $html .= '</tr>';
                            $i++;
                        }
                    }else{
                        $html .= '<tr>';
                        $html .= '<td colspan="4">No Data</td>';
                        $html .= '</tr>';
                    }
                    echo $html;
                @endphp
            </tbody>
        </table>
    </td>
  </tr>


