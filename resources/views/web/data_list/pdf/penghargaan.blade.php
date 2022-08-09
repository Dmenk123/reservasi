
<tr>
    <td colspan="6"><strong>VIII. Penghargaan</strong></td>
  </tr>
  <tr>
    <td colspan="6">
        <table id="table_penghargaan" border="1" width="100%" cellpadding="0" cellspacing="0" class="table table-sm dt-responsive nowrap table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{__('step_penghargaan.table.no')}}</th>
                    <th>{{__('step_penghargaan.table.nama')}}</th>
                    <th>{{__('step_penghargaan.table.tahun')}}</th>
                    <th>{{__('step_penghargaan.table.penyelenggara')}}</th>
                    <th>{{__('step_penghargaan.table.keterangan')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $table = \App\Models\M_candidate_award::where('id_m_candidate', $old->id_m_candidate)->orderBy('updated_at')->get();
                    $html = '';
                    if($table->count() > 0){
                        $i = 1;
                        foreach($table as $tab)
                        {
                            $html .= '<tr>';
                            $html .= '<td align="center">'.$i.'</td>';
                            $html .= '<td align="center">'.$tab->nm_m_candidate_award.'</td>';
                            $html .= '<td align="center">'.$tab->year_m_candidate_award.'</td>';
                            $html .= '<td align="center">'.$tab->by_m_candidate_award.'</td>';
                            $html .= '<td align="center">'.$tab->note_m_candidate_award.'</td>';
                            $html .= '</tr>';
                            $i++;
                        }
                    }else{
                        $html .= '<tr>';
                        $html .= '<td colspan="5">No Data</td>';
                        $html .= '</tr>';
                    }
                    echo $html;
                @endphp
            </tbody>
        </table>
    </td>
  </tr>
