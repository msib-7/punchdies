<?php

namespace Database\Seeders;

use App\Models\Lines;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'nama' => 'Administrator',
            'role_id' => '1',
            'line_id' => '1'
        ]);

        $this->call([
            LineSeed::class
        ]);
    }
}
