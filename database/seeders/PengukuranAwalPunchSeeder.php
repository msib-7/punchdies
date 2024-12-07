<?php

namespace Database\Seeders;

use App\Models\PengukuranAwalPunch;
use App\Models\Punch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class PengukuranAwalPunchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get all existing punch_ids
        $punches = Punch::all();

        foreach ($punches as $punch) {
            // Create 38 dummy PengukuranAwalPunch records for each punch_id
            PengukuranAwalPunch::factory()->count(38)->create([
                'punch_id' => $punch->punch_id, // Set the punch_id for each record
                'user_id' => Str::uuid(), // You can replace this with a valid user_id if needed
            ]);
        }
    }
}
