<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Roles;
use App\Models\Lines; // Import the Lines model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define users with their respective roles
        $users = [
            ['nama' => 'Engineering',            'username' => 'Engineering1',  'email' => 'engineering@example.com',               'password' => Hash::make('password')],
            ['nama' => 'Operator',               'username' => 'Operator1',     'email' => 'operator@example.com',                  'password' => Hash::make('password')],
            ['nama' => 'Supervisor Engineering', 'username' => 'SpvEng1',       'email' => 'supervisor_engineering@example.com',    'password' => Hash::make('password')],
            ['nama' => 'Supervisor Produksi',    'username' => 'SpvProd1',      'email' => 'supervisor_produksi@example.com',       'password' => Hash::make('password')],
            ['nama' => 'Manager Produksi',       'username' => 'ManProd1',      'email' => 'manager_produksi@example.com',          'password' => Hash::make('password')],
            ['nama' => 'Guest',                  'username' => 'Guest1',        'email' => 'guest@example.com',                     'password' => Hash::make('password')],
        ];

        // Get role IDs from the Roles table
        $roleIds = Roles::pluck('id', 'role_name')->toArray();

        // Get line UUIDs from the Lines table
        $lineIds = Lines::pluck('id', 'nama_line')->toArray();

        foreach ($users as $user) {
            User::create([
                'nama' => $user['nama'],
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role_id' => $roleIds[$user['nama']],
                'line_id' => $lineIds['All Line'], // Set the line ID to the 'All Line' line
            ]);
        }
    }
}