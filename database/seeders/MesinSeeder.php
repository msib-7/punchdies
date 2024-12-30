<?php

namespace Database\Seeders;

use App\Models\Mesin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MesinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('username', 'admin')->first();
        $title = ['Mesin 1', 'Mesin 2', 'Mesin 3'];
        $description = ['Description for Mesin 1', 'Description for Mesin 2', 'Description for Mesin 3'];

        for ($i = 0; $i < count($title); $i++) {
            Mesin::create([
                'user_id' => $user->id,
                'title' => $title[$i],
                'description' => $description[$i],
            ]);
        }
    }
}
