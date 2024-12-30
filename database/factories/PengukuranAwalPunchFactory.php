<?php

namespace Database\Factories;

use App\Models\PengukuranAwalPunch;
use App\Models\Punch;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengukuranAwalPunch>
 */
class PengukuranAwalPunchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PengukuranAwalPunch::class;

    public function definition()
    {
        $punchs  = Punch::all();

        foreach($punchs as $item){
            return [
                'id' => (string) Str::uuid(),
                'punch_id' => $item->punch_id, // Select a random existing punch_id
                'user_id' => Str::uuid(), // Assuming you want to generate a random user_id
                'head_outer_diameter' => $this->faker->randomFloat(2, 31.58, 31.59),
                'neck_diameter' => $this->faker->randomFloat(2, 22.04, 22.06),
                'barrel' => $this->faker->randomFloat(2, 25.33, 25.34),
                'overall_length' => $this->faker->randomFloat(2, 133.59, 133.64),
                'tip_diameter_1' => $this->faker->randomFloat(2, 18.94, 18.95),
                'tip_diameter_2' => $this->faker->randomFloat(2, 8.95, 8.96),
                'cup_depth' => $this->faker->randomFloat(2, 1.81, 1.86),
                'working_length' => $this->faker->randomFloat(2, 131.77, 131.80),
                'status' => abs(131.80 - 131.77) < 0.05 ? 'OK' : 'NOT OK',
                'masa_pengukuran' => $this->faker->randomElement(['pengukuran awal']),
                'note' => '-',
                'is_draft' => '1',
                'is_delete_pp' => '0',
                'is_edit' => '0',
                'is_approved' => '0',
                'is_rejected' => '0',
            ];
        }
    }
}
