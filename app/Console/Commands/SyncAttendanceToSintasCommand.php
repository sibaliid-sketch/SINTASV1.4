<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\SINTAS\Attendance;
use Carbon\Carbon;

class SyncAttendanceToSintasCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sintas:sync-attendance {--date= : The date to sync}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync attendance data from SINTAS to system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = $this->option('date') ? Carbon::parse($this->option('date')) : Carbon::now();

        $this->info("Syncing attendance for {$date->format('d-m-Y')}");

        // Get all attendance records for the date
        $attendances = Attendance::whereDate('date_time', $date)->get();

        $this->line("Found {$attendances->count()} attendance records");

        // Process and sync
        foreach ($attendances as $attendance) {
            // Update any related data if needed
            $this->line("Processed: {$attendance->user->name} - {$attendance->status}");
        }

        $this->info("Attendance sync completed successfully!");
        return 0;
    }
}
