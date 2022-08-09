
<tr>
    <td colspan="6"><strong>VII. Data Pendidikan - Informal</strong></td>
  </tr>
  <tr>
    <td colspan="6">
        <table id="table_pendidikan" border="1" width="100%" cellpadding="0" cellspacing="0" class="table table-sm dt-responsive nowrap table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{__('step_pendidikan_non_formal.table.no')}}</th>
                    <th>{{__('step_pendidikan_non_formal.table.nama')}}</th>
                    <th>{{__('step_pendidikan_non_formal.table.tahun')}}</th>
                    <th>{{__('step_pendidikan_non_formal.table.lama')}}</th>
                    <th>{{__('step_pendidikan_non_formal.table.penyelenggara')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $table_edu = \App\Models\M_candidate_edu_non::where('id_m_candidate', $old->id_m_candidate)->orderBy('updated_at')->get();
                    $html_edu = '';
                    if($table_edu->count() > 0){
                        $i = 1;
                        foreach($table_edu as $tab)
                        {
                            $html_edu .= '<tr>';
                            $html_edu .= '<td align="center">'.$i.'</td>';
                            $html_edu .= '<td align="center">'.$tab->nm_m_candidate_edu_non.'</td>';
                            $html_edu .= '<td align="center">'.$tab->year_m_candidate_edu_non.'</td>';
                            $html_edu .= '<td align="center">'.$tab->lama_m_candidate_edu_non.'</td>';
                            $html_edu .= '<td align="center">'.$tab->penyelenggara_m_candidate_edu_non.'</td>';
                            $html_edu .= '</tr>';
                            $i++;
                        }
                    }else{
                        $html_edu .= '<tr>';
                        $html_edu .= '<td colspan="5">No Data</td>';
                        $html_edu .= '</tr>';
                    }
                    echo $html_edu;
                @endphp
            </tbody>
        </table>
    </td>
  </tr>
