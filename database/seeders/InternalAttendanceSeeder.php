<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SINTAS\Attendance;
use App\Models\User;
use Carbon\Carbon;

class InternalAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing attendance data
        Attendance::truncate();

        // Get all karyawan users
        $users = User::where('role', 'karyawan')->get();

        if ($users->isEmpty()) {
            $this->command->warn('No karyawan users found. Please seed users first.');
            return;
        }

        // Generate attendance data for the last 30 days
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now()->subDay(); // Exclude today

        $attendanceRecords = [];

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            // Skip weekends
            if ($date->isWeekend()) {
                continue;
            }

            foreach ($users as $user) {
                // 95% attendance rate
                if (rand(1, 100) <= 95) {
                    // Check-in time (08:00 - 09:30)
                    $checkInHour = rand(8, 9);
                    $checkInMinute = $checkInHour == 9 ? rand(0, 30) : rand(0, 59);
                    $checkIn = $date->copy()->setTime($checkInHour, $checkInMinute, rand(0, 59));
                    
                    // Determine status based on check-in time
                    $standardTime = $date->copy()->setTime(9, 0, 0);
                    $status = $checkIn->gt($standardTime) ? 'late' : 'present';
                    
                    // Check-out time (17:00 - 18:30)
                    $checkOutHour = rand(17, 18);
                    $checkOutMinute = $checkOutHour == 18 ? rand(0, 30) : rand(0, 59);
                    $checkOut = $date->copy()->setTime($checkOutHour, $checkOutMinute, rand(0, 59));
                    
                    $attendanceRecords[] = [
                        'user_id' => $user->id,
                        'date' => $date->format('Y-m-d'),
                        'check_in' => $checkIn,
                        'check_out' => $checkOut,
                        'status' => $status,
                        'notes' => null,
                        'location' => 'Office',
                        'ip_address' => '192.168.1.' . rand(1, 254),
                        'created_at' => $checkIn,
                        'updated_at' => $checkOut,
                    ];
                } else {
                    // 5% chance of absence/leave
                    $absenceTypes = ['absent', 'leave', 'sick', 'permission'];
                    $absenceType = $absenceTypes[array_rand($absenceTypes)];
                    
                    $attendanceRecords[] = [
                        'user_id' => $user->id,
                        'date' => $date->format('Y-m-d'),
                        'check_in' => null,
                        'check_out' => null,
                        'status' => $absenceType,
                        'notes' => $this->getAbsenceNote($absenceType),
                        'location' => null,
                        'ip_address' => null,
                        'created_at' => $date->copy()->setTime(8, 0, 0),
                        'updated_at' => $date->copy()->setTime(8, 0, 0),
                    ];
                }
            }
        }

        // Insert in chunks to avoid memory issues
        $chunks = array_chunk($attendanceRecords, 100);
        foreach ($chunks as $chunk) {
            Attendance::insert($chunk);
        }

        $this->command->info('✅ Internal Attendance seeder completed!');
        $this->command->info('📊 Total records created: ' . count($attendanceRecords));
        $this->command->info('👥 Users: ' . $users->count());
        $this->command->info('📅 Date range: ' . $startDate->format('Y-m-d') . ' to ' . $endDate->format('Y-m-d'));
    }

    /**
     * Get absence note based on type.
     */
    private function getAbsenceNote($type)
    {
        $notes = [
            'absent' => null,
            'leave' => 'Cuti tahunan',
            'sick' => 'Sakit',
            'permission' => 'Izin keperluan keluarga',
        ];

        return $notes[$type] ?? null;
    }
}
