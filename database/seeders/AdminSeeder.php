<?php

namespace Database\Seeders;

use App\Models\Lines;
use App\Models\Permissions;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Route;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menentukan role Administrator
        $adminRole = Roles::firstOrCreate([
            'role_name' => 'Administrator',
        ]);

        $Line = Lines::latest()->first();

        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'nama' => 'Administrator',
            'role_id' => $adminRole->id,
            'line_id' => $Line->id,
        ]);

        $routes = Route::getRoutes()->getRoutesByName();

        foreach ($routes as $routeName => $route) {
            // Simpan routeName dan URL ke tabel permissions
            Permissions::create([
                'url' => $routeName, // Menggunakan nama rute sebagai identifikasi
                'role_id' => $adminRole->id // Set default jobLvl, ini dapat diubah sesuai kebutuhan Anda
            ]);
        }
    }
}
