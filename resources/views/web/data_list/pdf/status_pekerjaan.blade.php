
<tr>
    <td colspan="6"><strong>X. Status Pekerjaan</strong></td>
  </tr>
  <tr>
    <td colspan="6">
        <table id="table_status_pekerjaan" border="1" width="100%" cellpadding="0" cellspacing="0" class="table table-sm dt-responsive nowrap table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{__('step_status_pekerjaan.table.uraian')}}</th>
                    <th>{{__('step_status_pekerjaan.table.keterangan')}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{__('step_status_pekerjaan.label.job_keinginan')}}</td>
                    <td>{{$old->wanted_job_m_candidate}}</td>
                </tr>
                <tr>
                    <td>{{__('step_status_pekerjaan.label.jabatan_keinginan')}}</td>
                    <td>{{$old->wanted_position_m_candidate}}</td>
                </tr>
                <tr>
                    <td>{{__('step_status_pekerjaan.label.pekerjaan_lain')}}</td>
                    <td>{{($old->other_job_m_candidate=='YES') ? __('step_status_pekerjaan.label.yes') : __('step_status_pekerjaan.label.no')}}</td>
                </tr>
                <tr>
                    <td>{{__('step_status_pekerjaan.label.luar_kota')}}</td>
                    <td>{{($old->outoftown_m_candidate=='YES') ? __('step_status_pekerjaan.label.yes') : __('step_status_pekerjaan.label.no')}}</td>
                </tr>
                <tr>
                    <td>{{__('step_status_pekerjaan.label.shift')}}</td>
                    <td>{{($old->work_shift_m_candidate=='YES') ? __('step_status_pekerjaan.label.yes') : __('step_status_pekerjaan.label.no')}}</td>
                </tr>
                <tr>
                    <td>{{__('step_status_pekerjaan.label.gaji')}}</td>
                    <td>{{number_format($old->salary_req_m_candidate,0,',','.')}}</td>
                </tr>
            </tbody>
        </table>
    </td>
  </tr>
