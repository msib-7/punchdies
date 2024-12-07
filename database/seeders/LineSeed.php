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
        $Line = [1,2,3,4,5,6,6,7,8,9];

        foreach ($Line as $no) {
            Lines::factory()->create([
                'nama_line' => 'LINE '.$no
            ]);
        }

        Lines::factory()->create([
            'nama_line' => 'All Line'
        ]);
    }
}
