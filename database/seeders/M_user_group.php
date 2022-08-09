<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class M_user_group extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_user_group')->insert([
                [
                    'id_m_user_group' => 1,
                    'nm_user_group' => 'developer',
                    'aktif' => '1',
                    'keterangan' => null,
                ],
                [
                    'id_m_user_group' => 2,
                    'nm_user_group' => 'admin',
                    'aktif' => '1',
                    'keterangan' => null,
                ],
            ]);
    }
}
