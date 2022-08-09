<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class M_hak_akses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_hak_akses')->insert([
            [
                'id_m_hak_akses' => 1,
                'id_m_user_group' => 1,
                'id_m_menu' => 1,
            ],
            [
                'id_m_hak_akses' => 2,
                'id_m_user_group' => 1,
                'id_m_menu' => 2,
            ],
            [
                'id_m_hak_akses' => 3,
                'id_m_user_group' => 1,
                'id_m_menu' => 3,
            ],
            [
                'id_m_hak_akses' => 4,
                'id_m_user_group' => 1,
                'id_m_menu' => 4,
            ],
            [
                'id_m_hak_akses' => 5,
                'id_m_user_group' => 1,
                'id_m_menu' => 5,
            ],
            [
                'id_m_hak_akses' => 6,
                'id_m_user_group' => 1,
                'id_m_menu' => 6,
            ],
            [
                'id_m_hak_akses' => 7,
                'id_m_user_group' => 1,
                'id_m_menu' => 7,
            ],
            [
                'id_m_hak_akses' => 8,
                'id_m_user_group' => 1,
                'id_m_menu' => 8,
            ],
            [
                'id_m_hak_akses' => 9,
                'id_m_user_group' => 1,
                'id_m_menu' => 9,
            ],
            [
                'id_m_hak_akses' => 10,
                'id_m_user_group' => 1,
                'id_m_menu' => 10,
            ],
            [
                'id_m_hak_akses' => 11,
                'id_m_user_group' => 1,
                'id_m_menu' => 11,
            ],
            [
                'id_m_hak_akses' => 12,
                'id_m_user_group' => 1,
                'id_m_menu' => 12,
            ],
            [
                'id_m_hak_akses' => 13,
                'id_m_user_group' => 1,
                'id_m_menu' => 13,
            ],
            [
                'id_m_hak_akses' => 14,
                'id_m_user_group' => 1,
                'id_m_menu' => 14,
            ],
        ]);
    }
}
