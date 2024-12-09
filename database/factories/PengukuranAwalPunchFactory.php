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
                'head_outer_diameter' => $this->faker->randomFloat(2, 0, 100),
                'neck_diameter' => $this->faker->randomFloat(2, 0, 100),
                'barrel' => $this->faker->randomFloat(2, 0, 100),
                'overall_length' => $this->faker->randomFloat(2, 0, 100),
                'tip_diameter_1' => $this->faker->randomFloat(2, 0, 100),
                'tip_diameter_2' => $this->faker->randomFloat(2, 0, 100),
                'cup_depth' => $this->faker->randomFloat(2, 0, 100),
                'working_length' => $this->faker->randomFloat(2, 0, 100),
                'status' => 'OK',
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
