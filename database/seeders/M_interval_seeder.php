<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class M_interval_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_interval')->insert([
            [
                'id_m_interval' => 1,
                'durasi_m_interval' => 1,
            ],
            [
                'id_m_interval' => 2,
                'durasi_m_interval' => 2,
            ],
            [
                'id_m_interval' => 3,
                'durasi_m_interval' => 3,
            ],
            [
                'id_m_interval' => 4,
                'durasi_m_interval' => 4,
            ],
            [
                'id_m_interval' => 5,
                'durasi_m_interval' => 5,
            ],
            [
                'id_m_interval' => 6,
                'durasi_m_interval' => 6,
            ],
            [
                'id_m_interval' => 7,
                'durasi' => 7,
            ],
        ]);
    }
}
