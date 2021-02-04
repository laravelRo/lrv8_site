<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '+4089 542 327',
            'address' => 'Romania, str Larval nr 35 bl d45',
            'role' => 'admin'

        ]);

        User::factory(100)->create();
    }
}
