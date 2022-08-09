<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class M_user_bo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_user_bo')->insert([
            [
                'id_m_user_bo' => 1,
                'nm_user' => 'Developer',
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'id_m_user_group' => 1,
                'aktif' => '1',
            ],


        ]);
    }
}
