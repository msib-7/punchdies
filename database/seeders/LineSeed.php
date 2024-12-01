<?php

namespace Database\Seeders;

use App\Models\Lines;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lines::factory()->create([
            'nama_line' => 'LINE 9'
        ]);
    }
}
