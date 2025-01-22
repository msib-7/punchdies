<?php

namespace Database\Seeders;

use App\Models\KodeProduk;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KodeProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('username', 'admin')->first();
        $title = ['TCRV3'];
        $description = ['Description for Kode Produk 1'];

        for ($i = 0; $i < count($title); $i++) {
            KodeProduk::create([
                'user_id' => $user->id,
                'title' => $title[$i],
                'waktu_rutin' => 12,
                'description' => $description[$i],
            ]);
        }
    }
}
