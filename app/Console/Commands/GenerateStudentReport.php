<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\StudentProgress;
use App\Models\StudentAchievement;
use App\Models\StudentCertificate;

class GenerateStudentReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simy:generate-report {student_id : The ID of the student}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate comprehensive report for a SIMY student';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $studentId = $this->argument('student_id');
        $student = User::find($studentId);

        if (!$student) {
            $this->error("Student with ID {$studentId} not found");
            return 1;
        }

        $this->info("Generating report for student: {$student->name}");

        // Get student progress
        $progress = StudentProgress::where('student_id', $studentId)->get();
        $this->line("Total programs: {$progress->count()}");

        // Get achievements
        $achievements = StudentAchievement::where('student_id', $studentId)->count();
        $this->line("Total achievements: {$achievements}");

        // Get certificates
        $certificates = StudentCertificate::where('student_id', $studentId)->count();
        $this->line("Total certificates: {$certificates}");

        $this->info("Report generated successfully!");
        return 0;
    }
}
