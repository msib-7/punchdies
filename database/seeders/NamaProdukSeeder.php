<?php

namespace Database\Seeders;

use App\Models\NamaProduk;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NamaProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('username', 'admin')->first();
        $title = ['TCRV3'];
        $description = ['Description for Nama Produk 1'];

        for ($i = 0; $i < count($title); $i++) {
            NamaProduk::create([
                'user_id' => $user->id,
                'title' => $title[$i],
                'description' => $description[$i],
            ]);
        }
    }
}
