<?php

namespace Database\Seeders;

use App\Models\Punch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PunchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Punch::factory()->count(15)->create();
    }
}
