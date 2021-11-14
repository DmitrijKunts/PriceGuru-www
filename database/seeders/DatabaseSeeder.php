<?php

namespace Database\Seeders;

use App\Models\Release;
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

        Release::create([
            'version' => '1',
            'description' => 'First release',
            'created_at' => now(),
            'file_inst' => 'file_inst/PGInstall-1.exe',
            'file_arc' => 'file_arc/PGArc-1.zip',
        ]);

        $this->call([
            LicDownloadHistorySeeder::class,
        ]);
    }
}
