<div id="pendidikan-non-formal" class="content dstepper-block" role="tabpanel" aria-labelledby="pendidikan-non-formal-trigger">

    <h3>{{__('step_pendidikan_non_formal.title')}}</h3>
    <table id="table_pendidikan" class="table table-sm dt-responsive nowrap table-hover table-bordered table-striped">
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
                        $html_edu .= '<td>'.$i.'</td>';
                        $html_edu .= '<td>'.$tab->nm_m_candidate_edu_non.'</td>';
                        $html_edu .= '<td>'.$tab->year_m_candidate_edu_non.'</td>';
                        $html_edu .= '<td>'.$tab->lama_m_candidate_edu_non.'</td>';
                        $html_edu .= '<td>'.$tab->penyelenggara_m_candidate_edu_non.'</td>';
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




</div>
{{-- <div id="address-step-vertical" class="content dstepper-block" role="tabpanel" aria-labelledby="address-step-vertical-trigger">

</div>
<div id="social-links-vertical" class="content active dstepper-block" role="tabpanel" aria-labelledby="social-links-vertical-trigger">

</div> --}}
