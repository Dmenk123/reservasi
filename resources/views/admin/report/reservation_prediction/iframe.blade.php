<iframe src="{{route('admin.report.applicant_summary.pdf_report_applicant_summary', ['id_m_entity' => request()->get('id_m_entity'),'id_m_branch' => request()->get('id_m_branch'),'id_m_profession' => request()->get('id_m_profession')])}}"
    height="700"
    width="100%">
</iframe>