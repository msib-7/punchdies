<?php

namespace Database\Factories;

use App\Models\Lines;
use App\Models\Punch;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Punch>
 */
class PunchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Punch::class;

    public function definition()
    {
        // Generate a punch_id using your custom logic
        $punch_id = $this->generatePunchId();

        return [
            'id' => (string) Str::uuid(),
            'punch_id' => $punch_id,
            'merk' => $this->faker->word,
            'bulan_pembuatan' => $this->faker->month,
            'tahun_pembuatan' => $this->faker->year,
            'nama_mesin_cetak' => $this->faker->word,
            'nama_produk' => $this->faker->word,
            'kode_produk' => $this->faker->word,
            'line_id' => Lines::all()->random()->id, // Assuming you want to create a new line for each punch
            'jenis' => $this->faker->randomElement(['punch-atas','punch-bawah']),
            'masa_pengukuran' => 'pengukuran awal', // Randomly select between the two values,
            'is_draft' => '1',
            'is_waiting' => '0',
            'is_delete_punch' => '0',
            'is_edit' => '0',
            'is_approved' => '0',
            'is_rejected' => '0',
        ];
    }

    private function generatePunchId()
    {
        // Your custom logic to generate punch_id
        $autonum = Punch::where('punch_id', 'like', 'PID' . date('ymd') . '%')->orderBy('punch_id', 'desc')->first();
        if (!$autonum) {
            return str_shuffle("PID" . date("ymd")) . "0001";
        } else {
            $punch_id = $autonum->punch_id;
            $noUrut = (int) substr($punch_id, 9, 4);
            $noUrut++;
            return str_shuffle("PID" . date("ymd")) . sprintf("%04s", $noUrut);
        }
    }
}
