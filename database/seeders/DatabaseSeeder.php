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
        //create custom users with seeders
        $this->call(UsersTableSeeder::class);

        //create random users with seeders
         \App\Models\User::factory(10)->create();
    }
}
