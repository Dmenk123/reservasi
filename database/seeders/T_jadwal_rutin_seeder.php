<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class T_jadwal_rutin_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_jadwal_rutin')->insert([
            [
                'id_t_jadwal_rutin' => 1,
                'urut_t_jadwal_rutin' => 1,
                'status' => 1,
                'hari' => 'senin',
            ],
            [
                'id_t_jadwal_rutin' => 2,
                'urut_t_jadwal_rutin' => 2,
                'status' => 1,
                'hari' => 'selasa',
            ],
            [
                'id_t_jadwal_rutin' => 3,
                'urut_t_jadwal_rutin' => 3,
                'status' => 1,
                'hari' => 'rabu',
            ],
            [
                'id_t_jadwal_rutin' => 4,
                'urut_t_jadwal_rutin' => 4,
                'status' => 1,
                'hari' => 'kamis',
            ],
            [
                'id_t_jadwal_rutin' => 5,
                'urut_t_jadwal_rutin' => 5,
                'status' => 1,
                'hari' => 'jumat',
            ],
            [
                'id_t_jadwal_rutin' => 6,
                'urut_t_jadwal_rutin' => 6,
                'status' => 1,
                'hari' => 'sabtu',
            ],
            [
                'id_t_jadwal_rutin' => 7,
                'urut_t_jadwal_rutin' => 7,
                'status' => 1,
                'hari' => 'minggu',
            ],
        ]);
    }
}
