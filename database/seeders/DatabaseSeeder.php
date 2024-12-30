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
        $this->call([
            LineSeed::class,
            AdminSeeder::class,
            RoleSeed::class,
            PermissionSeed::class,
            UserSeeder::class,
            PunchSeeder::class,
            PengukuranAwalPunchSeeder::class,
            MesinSeeder::class,
            ProdukSeeder::class,
        ]);
    }
}
