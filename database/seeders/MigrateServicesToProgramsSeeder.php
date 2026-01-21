<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MigrateServicesToProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = \DB::table('services')->get();

        foreach ($services as $service) {
            \DB::table('programs')->insert([
                'type' => 'service',
                'service_id' => null,
                'name' => $service->name,
                'code' => $service->code,
                'description' => $service->description,
                'education_level' => 'Umum', // services have education_levels array
                'education_levels' => $service->education_levels,
                'class_mode' => $service->class_mode,
                'service_type' => $service->name,
                'media' => 'offline', // default
                'class_location' => null,
                'sessions_count' => 0,
                'hpp' => 0,
                'duration' => 0,
                'price' => 0,
                'unit' => '1 Bulan',
                'min_education_level' => null,
                'max_education_level' => null,
                'curriculum' => null,
                'max_students' => 10,
                'for_parent_register' => $service->for_parent_register,
                'for_self_register' => $service->for_self_register,
                'min_age' => $service->min_age,
                'max_age' => $service->max_age,
                'features' => $service->features,
                'is_active' => $service->is_active,
                'created_at' => $service->created_at,
                'updated_at' => $service->updated_at,
            ]);
        }
    }
}
