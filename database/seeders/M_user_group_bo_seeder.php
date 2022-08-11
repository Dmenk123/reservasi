<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class M_user_group_bo_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_user_group_bo')->insert([
                [
                    'id_m_user_group_bo' => 1,
                    'nm_user_group_bo' => 'developer',
                    'aktif' => '1',
                    'keterangan' => null,
                ],
                [
                    'id_m_user_group_bo' => 2,
                    'nm_user_group_bo' => 'admin',
                    'aktif' => '1',
                    'keterangan' => null,
                ],
            ]);
    }
}
