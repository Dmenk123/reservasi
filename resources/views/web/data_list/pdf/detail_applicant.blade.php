@php
$old = \App\Models\M_candidate::whereHas('t_applicant', function($query){
    $query->where('id_t_applicant', request()->get('id_t_applicant'));
    $query->where('id_t_emp_request_rct', request()->get('id_t_emp_request_rct'));
})->firstOrFail();



$id_m_marital_status = \App\Models\M_marital_status::where('active_m_marital_status', 'ACTIVE')->get();
$id_m_sex = \App\Models\M_sex::get();
$id_m_religion = \App\Models\M_religion::where('active_m_religion', 'ACTIVE')->get();
$id_m_education_level = \App\Models\M_education_level::where('active_m_education_level', 'ACTIVE')->get();
$id_m_provinsi = \App\Models\M_provinsi::orderBy('nm_m_provinsi')->get();
@endphp

<style>
    table tr td, table tr th{
        vertical-align: top;
        font-size: 11px;
        font-family: Arial, Helvetica, sans-serif;
        padding: 3px 1px;
    }
</style>

<table align="center">
    <tr>
        <td style="height: 27px; font-size:16px; font-weight:bold; width:90%; border:2px solid #000;">
            FORMULIR DATA ISIAN CALON PEGAWAI
        </td>
    </tr>
</table>

@include('web.data_list.pdf.step_profil')
@include('web.data_list.pdf.biodata_keluarga')
@include('web.data_list.pdf.biodata_anak')
@include('web.data_list.pdf.biodata_ortu')
@include('web.data_list.pdf.biodata_saudara')
@include('web.data_list.pdf.pendidikan_formal')
@include('web.data_list.pdf.pendidikan_non_formal')
@include('web.data_list.pdf.penghargaan')
@include('web.data_list.pdf.pengalaman_kerja')
@include('web.data_list.pdf.pengalaman_organisasi')
@include('web.data_list.pdf.status_pekerjaan')
@include('web.data_list.pdf.catatan')
