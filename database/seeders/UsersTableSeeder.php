<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'User1',
            'email' => 'user1@email.com',
            'user_name' => 'user_1',
            'email_verified_at' => now(),
            'birth_day' => '1991-02-05',
            'phone' => '01020330547',
            'remember_token' => Str::random(10),
            'password' => bcrypt('password'),
        ]);
    }
}
