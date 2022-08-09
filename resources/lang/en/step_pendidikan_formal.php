<?php
return [
    'title' => 'Formal Educations',
    'description' => 'Educations Details',
    'label' => [
        'nama_sekolah' => 'School Name, Institution, or Other Formal Education Name',
        'tahun_masuk' => 'Start Year',
        'tahun_lulus' => 'Graduation Year',
        'alamat' => 'Address',
        'strata' => 'Educational Level',
        'jurusan' => 'Faculty or Vocational (Optional)',
        'set_jenjang' => 'You must determine one of the levels below as the highest (last) level of education',
    ],
    'table' => [
        'no' => 'No.',
        'nama_sekolah' => 'Name',
        'tahun_masuk' => 'Start Year',
        'tahun_lulus' => 'Graduation Year',
        'strata' => 'Edu. Level',
        'jurusan' => 'Faculty',
        'tertinggi' => 'Set as Highest Level',
    ],
    'button' => [
        'next' => 'Next',
        'prev' => 'Previous',
        'tambah_pendidikan' => 'Add Data',
    ],
    'validation' => [
        'nama_sekolah_required' => 'This field is required',
        'tahun_masuk_required' => 'This field is required',
        'tahun_lulus_required' => 'This field is required',
        'alamat_required' => 'This field is required',
        'strata_required' => 'This field is required',
        'jurusan_required' => 'Please choose faculty (if any)',
        'numeric' => 'Numeric only',
    ],
];
