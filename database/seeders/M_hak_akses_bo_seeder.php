<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class M_hak_akses_bo_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_hak_akses_bo')->insert([
            [
                'id_m_hak_akses_bo' => 1,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 1,
            ],
            [
                'id_m_hak_akses_bo' => 2,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 2,
            ],
            [
                'id_m_hak_akses_bo' => 3,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 3,
            ],
            [
                'id_m_hak_akses_bo' => 4,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 4,
            ],
            [
                'id_m_hak_akses_bo' => 5,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 5,
            ],
            [
                'id_m_hak_akses_bo' => 6,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 6,
            ],
            [
                'id_m_hak_akses_bo' => 7,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 7,
            ],
            [
                'id_m_hak_akses_bo' => 8,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 8,
            ],
            [
                'id_m_hak_akses_bo' => 9,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 9,
            ],
            [
                'id_m_hak_akses_bo' => 10,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 10,
            ],
            [
                'id_m_hak_akses_bo' => 11,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 11,
            ],
            [
                'id_m_hak_akses_bo' => 12,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 12,
            ],
            [
                'id_m_hak_akses_bo' => 13,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 13,
            ],
            [
                'id_m_hak_akses_bo' => 14,
                'id_m_user_group_bo' => 1,
                'id_m_menu_bo' => 14,
            ],
        ]);
    }
}
