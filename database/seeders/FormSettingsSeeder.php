<?php

namespace Database\Seeders;

use App\Models\FormDiesAwalSetting;
use App\Models\FormPunchAwalSetting;
use App\Models\FormPunchRutinSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_value = 6;

        // Create the default settings for FormDiesAwalSetting
        FormDiesAwalSetting::factory()->create([
            'outer_diameter' => $default_value,
            'inner_diameter_1' => $default_value,
            'inner_diameter_2' => $default_value,
            'ketinggian_dies' => $default_value,
        ]);

        // Create the default settings for FormPunchAwalSetting with jenis 'atas'
        FormPunchAwalSetting::factory()->create([
            'jenis' => 'atas',
            'head_outer_diameter' => $default_value,
            'neck_diameter' => $default_value,
            'barrel' => $default_value,
            'overall_length' => $default_value,
            'tip_diameter_1' => $default_value,
            'tip_diameter_2' => $default_value,
            'cup_depth' => $default_value,
            'working_length' => $default_value,
        ]);

        // Create the default settings for FormPunchAwalSetting with jenis 'bawah'
        FormPunchAwalSetting::factory()->create([
            'jenis' => 'bawah',
            'head_outer_diameter' => $default_value,
            'neck_diameter' => $default_value,
            'barrel' => $default_value,
            'overall_length' => $default_value,
            'tip_diameter_1' => $default_value,
            'tip_diameter_2' => $default_value,
            'cup_depth' => $default_value,
            'working_length' => $default_value,
        ]);

        // Create the default settings for FormPunchRutinSetting with jenis 'atas'
        FormPunchRutinSetting::factory()->create([
            'jenis' => 'atas',
            'overall_length' => $default_value,
            'working_length' => $default_value,
            'cup_depth' => $default_value,
        ]);

        // Create the default settings for FormPunchRutinSetting with jenis 'bawah'
        FormPunchRutinSetting::factory()->create([
            'jenis' => 'bawah',
            'overall_length' => $default_value,
            'working_length' => $default_value,
            'cup_depth' => $default_value,
        ]);
    }
}
