<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Schedule;
use App\Services\IdGeneratorService;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        // Update existing programs with new service_type
        $programUpdates = [
            1 => ['service_type' => 'SIMY'], // ECLAIR English Program - SD
            2 => ['service_type' => 'SITRA'], // English Champion - SMP
            3 => ['service_type' => 'SITRA'], // English Regular - SMA
            4 => ['service_type' => 'SINTAS'], // Private English - Umum
            5 => ['service_type' => 'SIMY'], // Rumah Belajar Program - TK
        ];

        foreach ($programUpdates as $id => $data) {
            Program::where('id', $id)->update($data);
        }
    }
}
