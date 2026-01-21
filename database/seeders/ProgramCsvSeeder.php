<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ProgramCsvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('seeders/data/programs.csv');
        
        if (!File::exists($csvFile)) {
            $this->command->error('CSV file not found: ' . $csvFile);
            return;
        }

        // Clear existing programs (disable foreign key checks temporarily)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Program::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('Reading programs from CSV...');
        
        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file); // Skip header row
        
        $count = 0;
        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($header, $row);
            
            // Get service by code
            $service = Service::where('code', $data['service_code'])->first();
            
            if (!$service) {
                $this->command->warn("Service not found for code: {$data['service_code']}");
                continue;
            }
            
            // Determine class_mode based on media
            $classMode = $data['media'];
            
            // Create program
            Program::create([
                'service_id' => $service->id,
                'name' => $data['name'],
                'description' => $data['description'],
                'education_level' => $data['education_level'],
                'class_mode' => $classMode,
                'service_type' => $service->name,
                'media' => $data['media'],
                'class_location' => $data['class_location'],
                'sessions_count' => (int) $data['sessions_count'],
                'hpp' => (float) $data['hpp'],
                'duration' => 4, // Default duration in weeks
                'price' => (float) $data['price'],
                'unit' => $data['unit'],
                'min_education_level' => $data['min_education_level'] ?: null,
                'max_education_level' => $data['max_education_level'] ?: null,
                'curriculum' => null,
                'max_students' => 10,
                'is_active' => true,
            ]);
            
            $count++;
        }
        
        fclose($file);
        
        $this->command->info("Successfully seeded {$count} programs!");
    }
}
