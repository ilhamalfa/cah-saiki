<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
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
        User::create([
            'name' => 'Liam Niskala',
            'username' => 'liam.niskala',
            'email' => 'kuro.nekogami22@gmail.com',
            'password' => bcrypt('password')
        ]);
        // \App\Models\User::factory(10)->create();
        Menu::factory(10)->create();

        User::factory(3)->create();
    }
}
