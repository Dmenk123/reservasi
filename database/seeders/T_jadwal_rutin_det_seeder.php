<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class T_jadwal_rutin_det_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_jadwal_rutin_det')->insert([
            [
                'id_t_jadwal_rutin_det' => 1,
                'id_t_jadwal_rutin' => 1,
                'sesi' => 1,
                'pukul' => '07:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 2,
                'id_t_jadwal_rutin' => 1,
                'sesi' => 2,
                'pukul' => '10:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 3,
                'id_t_jadwal_rutin' => 1,
                'sesi' => 3,
                'pukul' => '12:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 4,
                'id_t_jadwal_rutin' => 1,
                'sesi' => 4,
                'pukul' => '15:00:00',
            ],
            ///////////////////////////////////
            [
                'id_t_jadwal_rutin_det' => 5,
                'id_t_jadwal_rutin' => 2,
                'sesi' => 1,
                'pukul' => '07:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 6,
                'id_t_jadwal_rutin' => 2,
                'sesi' => 2,
                'pukul' => '10:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 7,
                'id_t_jadwal_rutin' => 2,
                'sesi' => 3,
                'pukul' => '12:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 8,
                'id_t_jadwal_rutin' => 2,
                'sesi' => 4,
                'pukul' => '15:00:00',
            ],
            ///////////////////////////////////
            [
                'id_t_jadwal_rutin_det' => 9,
                'id_t_jadwal_rutin' => 3,
                'sesi' => 1,
                'pukul' => '07:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 10,
                'id_t_jadwal_rutin' => 3,
                'sesi' => 2,
                'pukul' => '10:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 11,
                'id_t_jadwal_rutin' => 3,
                'sesi' => 3,
                'pukul' => '12:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 12,
                'id_t_jadwal_rutin' => 3,
                'sesi' => 4,
                'pukul' => '15:00:00',
            ],
            /////////////////////////////
            [
                'id_t_jadwal_rutin_det' => 13,
                'id_t_jadwal_rutin' => 4,
                'sesi' => 1,
                'pukul' => '07:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 14,
                'id_t_jadwal_rutin' => 4,
                'sesi' => 2,
                'pukul' => '10:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 15,
                'id_t_jadwal_rutin' => 4,
                'sesi' => 3,
                'pukul' => '12:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 16,
                'id_t_jadwal_rutin' => 4,
                'sesi' => 4,
                'pukul' => '15:00:00',
            ],
            /////////////////////////////
            [
                'id_t_jadwal_rutin_det' => 17,
                'id_t_jadwal_rutin' => 5,
                'sesi' => 1,
                'pukul' => '07:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 18,
                'id_t_jadwal_rutin' => 5,
                'sesi' => 2,
                'pukul' => '10:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 19,
                'id_t_jadwal_rutin' => 5,
                'sesi' => 3,
                'pukul' => '12:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 20,
                'id_t_jadwal_rutin' => 5,
                'sesi' => 4,
                'pukul' => '15:00:00',
            ],
            /////////////////////////////
            [
                'id_t_jadwal_rutin_det' => 21,
                'id_t_jadwal_rutin' => 6,
                'sesi' => 1,
                'pukul' => '07:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 22,
                'id_t_jadwal_rutin' => 6,
                'sesi' => 2,
                'pukul' => '10:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 23,
                'id_t_jadwal_rutin' => 6,
                'sesi' => 3,
                'pukul' => '12:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 24,
                'id_t_jadwal_rutin' => 6,
                'sesi' => 4,
                'pukul' => '15:00:00',
            ],
            /////////////////////////////
            [
                'id_t_jadwal_rutin_det' => 25,
                'id_t_jadwal_rutin' => 7,
                'sesi' => 1,
                'pukul' => '07:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 26,
                'id_t_jadwal_rutin' => 7,
                'sesi' => 2,
                'pukul' => '10:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 27,
                'id_t_jadwal_rutin' => 7,
                'sesi' => 3,
                'pukul' => '12:00:00',
            ],
            [
                'id_t_jadwal_rutin_det' => 28,
                'id_t_jadwal_rutin' => 7,
                'sesi' => 4,
                'pukul' => '15:00:00',
            ],
        ]);
    }
}
