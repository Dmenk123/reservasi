<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class M_menu_bo_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_menu_bo')->insert([
            [
                'id_m_menu_bo' => 1,
                'nm_menu_bo' => 'Master Data',
                'aktif' => '1',
                'icon' => 'database',
                'route' => null,
                'id_parent' => null,
                'order_m_menu_bo' => 1,
            ],
            [
                'id_m_menu_bo' => 2,
                'nm_menu_bo' => 'User',
                'aktif' => '1',
                'icon' => 'circle',
                'route' => 'admin.m_user_bo.index',
                'id_parent' => 1,
                'order_m_menu_bo' => 98,
            ],
            [
                'id_m_menu_bo' => 3,
                'nm_menu_bo' => 'Admin Menu',
                'aktif' => '1',
                'icon' => 'circle',
                'route' => 'admin.m_menu_bo.index',
                'id_parent' => 1,
                'order_m_menu_bo' => 100,
            ],
            [
                'id_m_menu_bo' => 4,
                'nm_menu_bo' => 'User Group',
                'aktif' => '1',
                'icon' => 'circle',
                'route' => 'admin.m_user_group_bo.index',
                'id_parent' => 1,
                'order_m_menu_bo' => 99,
            ],
        ]);
    }
}
