<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class M_menu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_menu')->insert([
            [
                'id_m_menu' => 1,
                'nm_menu' => 'Master Data',
                'aktif' => '1',
                'icon' => 'database',
                'route' => null,
                'id_parent' => null,
            ],
            [
                'id_m_menu' => 2,
                'nm_menu' => 'User',
                'aktif' => '1',
                'icon' => 'circle',
                'route' => 'admin.m_user_bo.index',
                'id_parent' => 1,
            ],
            [
                'id_m_menu' => 3,
                'nm_menu' => 'Admin Menu',
                'aktif' => '1',
                'icon' => 'circle',
                'route' => 'admin.m_menu.index',
                'id_parent' => 1,
            ],
            [
                'id_m_menu' => 4,
                'nm_menu' => 'User Group',
                'aktif' => '1',
                'icon' => 'circle',
                'route' => 'admin.m_user_group.index',
                'id_parent' => 1,
            ],
        ]);
    }
}
