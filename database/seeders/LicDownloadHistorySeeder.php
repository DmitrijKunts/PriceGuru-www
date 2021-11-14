<?php

namespace Database\Seeders;

use App\Models\LicDownloadHistory;
use Illuminate\Database\Seeder;

class LicDownloadHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LicDownloadHistory::factory()->count(5)->create();
    }
}
