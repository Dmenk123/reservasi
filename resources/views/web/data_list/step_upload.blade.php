<div id="upload" class="content dstepper-block" role="tabpanel" aria-labelledby="upload-trigger">
    <div class="content-header">
        <h3 class="mb-0">{{__('step_upload.title')}}</h3>
        <small class="text-muted">{{__('step_upload.description')}}</small>
    </div>
    <table id="table_upload" class="table table-sm dt-responsive nowrap table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>{{__('step_upload.table.nama')}}</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @php
                $list = DB::table('t_syarat_doc_rct')
                ->where('t_syarat_doc_rct.id_t_emp_request_rct', request()->get('id_t_emp_request_rct'))
                ->leftJoin('m_doc_type', function($join){
                    $join->on('m_doc_type.id_m_doc_type', '=', 't_syarat_doc_rct.id_m_doc_type');
                })->get();
                $html = '';
                $i = 1;
                if($list->count() > 0){
                    foreach($list as $lis)
                    {
                        $is_upload = DB::table('t_doc_applicant')->where('id_m_candidate', $old->id_m_candidate)->where('id_t_syarat_doc_rct', $lis->id_t_syarat_doc_rct)->first();
                        $html .= '<tr>';
                        $html .= '<td>'.$i.'</td>';
                        $html .= '<td>'.strtoupper($lis->naration_m_doc_type).'</td>';

                        if($is_upload){
                            $get_file = \App\Models\M_candidate_doc::where('id_m_candidate_doc', $is_upload->id_m_candidate_doc)->first();
                            $html .= '<td><a href="'.asset('storage').'/'.$get_file->upload_m_candidate_doc.'" target="_blank" class="btn btn-sm btn-warning">preview</a></td>';
                        }else{
                            $html .= '<td><a class="btn btn-sm btn-warning disabled">Not yet</a></td>';
                        }
                        $html .= '</tr>';
                        $i++;
                    }
                }else{
                    $html .= '<tr>';
                    $html .= '<td colspan="3">No Requirements yet</td>';
                    $html .= '</tr>';
                }

                echo $html;
            @endphp
        </tbody>
    </table>
</div>
