<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StudentProgress;
use App\Models\StudentAchievement;

class UpdateStudentProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simy:update-progress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update student progress for all students in SIMY';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Updating student progress for all enrolled students");

        $progressRecords = StudentProgress::all();

        $updated = 0;
        foreach ($progressRecords as $progress) {
            // Recalculate overall progress
            $totalItems = $progress->total_materials + $progress->total_assignments + $progress->total_quizzes;
            $completedItems = $progress->completed_materials + $progress->completed_assignments + $progress->completed_quizzes;
            
            if ($totalItems > 0) {
                $newPercentage = round(($completedItems / $totalItems) * 100, 2);
                $progress->overall_progress_percentage = $newPercentage;

                // Determine status
                if ($newPercentage == 100) {
                    $progress->status = 'completed';
                } elseif ($newPercentage >= 50) {
                    $progress->status = 'on_track';
                } else {
                    $progress->status = 'behind';
                }

                $progress->save();
                $updated++;

                $this->line("Updated: {$progress->student->name} - {$progress->program->name} ({$newPercentage}%)");
            }
        }

        $this->info("Updated progress for {$updated} students");
        return 0;
    }
}
