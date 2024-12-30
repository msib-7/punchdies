<?php

namespace Database\Seeders;

use App\Models\KodeProduk;
use App\Models\NamaProduk;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('username', 'admin')->first();
        $namaProduk = ['Nama Produk 1', 'Nama Produk 2', 'Nama Produk 3'];
        $descriptionNamaProduk = ['Description for Nama Produk 1', 'Description for Nama Produk 2', 'Description for Nama Produk 3'];
        for ($i = 0; $i < count($namaProduk); $i++) {
            NamaProduk::create([
                'user_id' => $user->id,
                'title' => $namaProduk[$i],
                'description' => $descriptionNamaProduk[$i],
            ]);
        }

        $kodeProduk = ['Kode Produk 1', 'Kode Produk 2', 'Kode Produk 3'];
        $descriptionKodeProduk = ['Description for Kode Produk 1', 'Description for Kode Produk 2', 'Description for Kode Produk 3'];
        for ($i = 0; $i < count($kodeProduk); $i++) {
            KodeProduk::create([
                'user_id' => $user->id,
                'title' => $kodeProduk[$i],
                'description' => $descriptionKodeProduk[$i],
            ]);
        }
    }
}
