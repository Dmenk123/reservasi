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
            M_user_group::class,
            M_user_bo::class,
            M_menu::class,
            M_hak_akses::class,
        ]);
    }
}
