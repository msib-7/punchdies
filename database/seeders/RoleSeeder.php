<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Engineering',
            'Supervisor Engineering',
            'Operator',
            'Supervisor Produksi',
            'Manager Produksi',
            'Guest'
        ];

        foreach ($roles as $role) {
            Roles::create(['role_name' => $role]);
        }
    }
}
