<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class M_harga_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_harga')->insert([
            [
                'id_m_harga' => 1,
                'nominal_m_harga' => 500000,
                'status_m_harga' => null,
            ],
            [
                'id_m_harga' => 2,
                'nominal_m_harga' => 2000000,
                'status_m_harga' => '1',
            ]
        ]);
    }
}
