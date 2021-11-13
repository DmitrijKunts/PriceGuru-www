<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'codeLocker',
            'email' => 'r206265@gmail.com',
            'password' => Hash::make('F34T3HkmqKJkuLe'),
        ]);

        User::factory()
            ->count(50)
            ->create();
    }
}
