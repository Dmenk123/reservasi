<div id="pengalaman-kerja" class="content dstepper-block" role="tabpanel" aria-labelledby="pengalaman-kerja-trigger">

    <h3>{{__('step_pengalaman_kerja.title')}}</h3>
    <table id="table_pengalaman_kerja" class="table table-sm dt-responsive nowrap table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>{{__('step_pengalaman_kerja.table.no')}}</th>
                <th>{{__('step_pengalaman_kerja.table.nama_perusahaan')}}</th>
                <th>{{__('step_pengalaman_kerja.table.tahun_masuk')}}</th>
                <th>{{__('step_pengalaman_kerja.table.tahun_keluar')}}</th>
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
                        $html .= '<td>'.$i.'</td>';
                        $html .= '<td>'.$tab->company_m_candidate_work_exp.'</td>';
                        $html .= '<td>'.$tab->year_in_m_candidate_work_exp.'</td>';
                        $html .= '<td>'.$tab->year_out_m_candidate_work_exp.'</td>';
                        $html .= '<td>'.$tab->position_m_candidate_work_exp.'</td>';
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




</div>
