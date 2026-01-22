<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SINTAS\Attendance;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing attendance data
        Attendance::truncate();

        // PR Department Employee PINs
        $prEmployees = [
            '10001' => 'John Doe',
            '10002' => 'Jane Smith',
            '10003' => 'Michael Johnson',
            '10004' => 'Sarah Williams',
            '10005' => 'David Brown',
            '10006' => 'Emily Davis',
        ];

        // Device ID (PR Department)
        $deviceId = config('services.fingerspot.cloud_id', 'C263045107231D23');

        // Generate attendance data for the last 30 days
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        $attendanceRecords = [];

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            // Skip weekends
            if ($date->isWeekend()) {
                continue;
            }

            foreach ($prEmployees as $pin => $name) {
                // 90% attendance rate (some employees might be absent)
                if (rand(1, 100) <= 90) {
                    // Morning check-in (08:00 - 09:00)
                    $checkInTime = $date->copy()
                        ->setHour(8)
                        ->setMinute(rand(0, 59))
                        ->setSecond(rand(0, 59));

                    $attendanceRecords[] = [
                        'pin' => $pin,
                        'device_id' => $deviceId,
                        'date_time' => $checkInTime,
                        'raw_payload' => json_encode([
                            'PIN' => $pin,
                            'Name' => $name,
                            'Date Time' => $checkInTime->format('Y-m-d H:i:s'),
                            'Device ID' => $deviceId,
                            'Status' => 'Check In',
                            'Verification' => 'Fingerprint',
                        ]),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    // Lunch break out (12:00 - 13:00)
                    if (rand(1, 100) <= 80) {
                        $lunchOutTime = $date->copy()
                            ->setHour(12)
                            ->setMinute(rand(0, 59))
                            ->setSecond(rand(0, 59));

                        $attendanceRecords[] = [
                            'pin' => $pin,
                            'device_id' => $deviceId,
                            'date_time' => $lunchOutTime,
                            'raw_payload' => json_encode([
                                'PIN' => $pin,
                                'Name' => $name,
                                'Date Time' => $lunchOutTime->format('Y-m-d H:i:s'),
                                'Device ID' => $deviceId,
                                'Status' => 'Break Out',
                                'Verification' => 'Fingerprint',
                            ]),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];

                        // Lunch break in (13:00 - 14:00)
                        $lunchInTime = $date->copy()
                            ->setHour(13)
                            ->setMinute(rand(0, 59))
                            ->setSecond(rand(0, 59));

                        $attendanceRecords[] = [
                            'pin' => $pin,
                            'device_id' => $deviceId,
                            'date_time' => $lunchInTime,
                            'raw_payload' => json_encode([
                                'PIN' => $pin,
                                'Name' => $name,
                                'Date Time' => $lunchInTime->format('Y-m-d H:i:s'),
                                'Device ID' => $deviceId,
                                'Status' => 'Break In',
                                'Verification' => 'Fingerprint',
                            ]),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }

                    // Evening check-out (17:00 - 18:00)
                    $checkOutTime = $date->copy()
                        ->setHour(17)
                        ->setMinute(rand(0, 59))
                        ->setSecond(rand(0, 59));

                    $attendanceRecords[] = [
                        'pin' => $pin,
                        'device_id' => $deviceId,
                        'date_time' => $checkOutTime,
                        'raw_payload' => json_encode([
                            'PIN' => $pin,
                            'Name' => $name,
                            'Date Time' => $checkOutTime->format('Y-m-d H:i:s'),
                            'Device ID' => $deviceId,
                            'Status' => 'Check Out',
                            'Verification' => 'Fingerprint',
                        ]),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        // Insert in chunks to avoid memory issues
        $chunks = array_chunk($attendanceRecords, 100);
        foreach ($chunks as $chunk) {
            Attendance::insert($chunk);
        }

        $this->command->info('✅ Attendance seeder completed!');
        $this->command->info('📊 Total records created: ' . count($attendanceRecords));
        $this->command->info('👥 Employees: ' . count($prEmployees));
        $this->command->info('📅 Date range: ' . $startDate->format('Y-m-d') . ' to ' . $endDate->format('Y-m-d'));
    }
}
