
<tr>
    <td colspan="6"><strong>IX. Pengalaman Kerja</strong></td>
  </tr>
  <tr>
    <td colspan="6">
        <table id="table_pengalaman_kerja" border="1" width="100%" cellpadding="0" cellspacing="0" class="table table-sm dt-responsive nowrap table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{__('step_pengalaman_kerja.table.no')}}</th>
                    <th>{{__('step_pengalaman_kerja.table.nama_perusahaan')}}</th>
                    <th>{{__('step_pengalaman_kerja.table.tahun_masuk')}}</th>
                    <th>{{__('step_pengalaman_kerja.table.tahun_keluar')}}</th>
                    <th>{{__('step_pengalaman_kerja.table.gaji_pertama')}}</th>
                    <th>{{__('step_pengalaman_kerja.table.gaji_terakhir')}}</th>
                    <th>{{__('step_pengalaman_kerja.table.jabatan')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $table = \App\Models\M_candidate_work_exp::where('id_m_candidate', $old->id_m_candidate)->orderBy('updated_at')->get();
                    $html = '';
                    if($table->count() > 0){
                        $i = 1;
                        foreach($table as $tab)
                        {
                            $html .= '<tr>';
                            $html .= '<td align="center">'.$i.'</td>';
                            $html .= '<td align="center">'.$tab->company_m_candidate_work_exp.'</td>';
                            $html .= '<td align="center">'.$tab->year_in_m_candidate_work_exp.'</td>';
                            $html .= '<td align="center">'.$tab->year_out_m_candidate_work_exp.'</td>';
                            $html .= '<td align="center">'.$tab->position_m_candidate_work_exp.'</td>';
                            $html .= '<td align="center">'.$tab->salary1_m_candidate_work_exp.'</td>';
                            $html .= '<td align="center">'.$tab->salary2_m_candidate_work_exp.'</td>';
                            $html .= '</tr>';
                            $i++;
                        }
                    }else{
                        $html .= '<tr>';
                        $html .= '<td colspan="7">No Data</td>';
                        $html .= '</tr>';
                    }
                    echo $html;
                @endphp
            </tbody>
        </table>
    </td>
  </tr>
