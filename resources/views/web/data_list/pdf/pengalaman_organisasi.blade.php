
<tr>
    <td colspan="6"><strong>X. Pengalaman Organisasi</strong></td>
  </tr>
  <tr>
    <td colspan="6">
        <table id="table_pengalaman_organisasi" border="1" width="100%" cellpadding="0" cellspacing="0" class="table table-sm dt-responsive nowrap table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{__('step_pengalaman_organisasi.table.no')}}</th>
                    <th>{{__('step_pengalaman_organisasi.table.nama_organisasi')}}</th>
                    <th>{{__('step_pengalaman_organisasi.table.tahun')}}</th>
                    <th>{{__('step_pengalaman_organisasi.table.jabatan')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $table = \App\Models\M_candidate_organisasi_exp::where('id_m_candidate', $old->id_m_candidate)->orderBy('updated_at')->get();
                    $html = '';
                    if($table->count() > 0){
                        $i = 1;
                        foreach($table as $tab)
                        {
                            $html .= '<tr>';
                            $html .= '<td align="center">'.$i.'</td>';
                            $html .= '<td align="center">'.$tab->nm_m_candidate_organisasi_exp.'</td>';
                            $html .= '<td align="center">'.$tab->year_m_candidate_organisasi_exp.'</td>';
                            $html .= '<td align="center">'.$tab->position_m_candidate_organisasi_exp.'</td>';
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
