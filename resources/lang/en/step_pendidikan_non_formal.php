<?php
return [
    'title' => 'Informal Education History',
    'description' => 'Informal Education History',
    'label' => [
        // 'nama' => 'Institution Category (Accounting, IT, Marketing, etc)',
        'nama' => 'Type Of Education / Training (Accounting, IT, Marketing, etc)',
        'tahun' => 'Year',
        // 'lama' => 'Duration (Year / Month / Days)',
        'lama' => 'Duration (Year)',
        'lama_bulan' => 'Duration (Month)',
        'alamat' => 'Address',
        'penyelenggara' => 'Organizer',
    ],
    'table' => [
        'no' => 'No.',
        'nama' => 'Institution Category',
        'tahun' => 'Year',
        'lama' => 'Duration',
        'alamat' => 'Address',
        'penyelenggara' => 'Organizer',
    ],
    'button' => [
        'next' => 'Next',
        'prev' => 'Previous',
        'tambah_pendidikan' => 'Add Data',
    ],
    'validation' => [
        'nama_required' => 'This field is required',
        'tahun_required' => 'This field is required ',
        'lama_required' => 'This field is required',
        'alamat_required' => 'This field is required ',
        'penyelenggara_required' => 'This field is required ',
    ],
];
