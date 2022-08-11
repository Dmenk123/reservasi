<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            M_user_group_bo_seeder::class,
            M_user_bo_seeder::class,
            M_menu_bo_seeder::class,
            M_hak_akses_bo_seeder::class,
        ]);
    }
}
