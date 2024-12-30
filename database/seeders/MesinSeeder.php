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
        $title = ['JCMCO'];
        $description = ['Description for Mesin 1'];

        for ($i = 0; $i < count($title); $i++) {
            Mesin::create([
                'user_id' => $user->id,
                'title' => $title[$i],
                'description' => $description[$i],
            ]);
        }
    }
}
