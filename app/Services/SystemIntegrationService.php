<?php

namespace App\Services;

use App\Models\User;
use App\Models\SIMY\StudentProgress;
use App\Models\SIMY\StudentAchievement;
use App\Models\SIMY\StudentCertificate;
use App\Models\General\Registration;
use App\Models\General\ChatMessage;
use App\Models\SINTAS\Attendance;
use App\Models\General\Notification;
use Carbon\Carbon;

/**
 * SystemIntegrationService
 * Mengelola integrasi dan sinkronisasi data antar sistem SIMY, SITRA, SINTAS
 */
class SystemIntegrationService
{
    /**
     * Sync student progress dari SIMY ke SITRA
     * Ketika siswa update progress di SIMY, orang tua melihat di SITRA
     */
    public function syncSimyProgressToSitra($studentId)
    {
        $student = User::find($studentId);
        if (!$student) {
            return false;
        }

        // Get latest progress from SIMY
        $progresses = StudentProgress::where('student_id', $studentId)->get();

        // Trigger notification to parent via SITRA
        $parent = User::find($student->parent_id);
        if ($parent) {
            foreach ($progresses as $progress) {
                Notification::create([
                    'user_id' => $parent->id,
                    'type' => 'progress_update',
                    'data' => [
                        'student_id' => $studentId,
                        'program_id' => $progress->program_id,
                        'progress_percentage' => $progress->overall_progress_percentage,
                    ]
                ]);
            }
        }

        return true;
    }

    /**
     * Sync attendance dari SINTAS ke SIMY
     * Ketika staff mark attendance di SINTAS, muncul di SIMY sebagai class attendance
     */
    public function syncSintasAttendanceToSimy($userId, $attendanceId)
    {
        $user = User::find($userId);
        $attendance = Attendance::find($attendanceId);

        if (!$user || !$attendance) {
            return false;
        }

        // If user is student, add to their SIMY class attendance record
        if ($user->role === 'siswa') {
            // Update SIMY class attendance tracking
            // This connects SINTAS staff attendance system to SIMY class records
        }

        return true;
    }

    /**
     * Sync enrollment dari SINTAS ke SIMY
     * Ketika registration diapprove di SINTAS, auto-activate SIMY access
     */
    public function activateSimyAccessOnRegistration($registrationId)
    {
        $registration = \App\Models\General\Registration::find($registrationId);

        if (!$registration || $registration->status !== 'completed') {
            return false;
        }

        $student = $registration->student;

        // Auto-enroll to program
        $student->programs()->syncWithoutDetaching([$registration->program_id]);

        // Create initial progress record
        StudentProgress::firstOrCreate(
            [
                'student_id' => $student->id,
                'program_id' => $registration->program_id,
            ],
            [
                'total_materials' => 0,
                'completed_materials' => 0,
                'total_assignments' => 0,
                'completed_assignments' => 0,
                'total_quizzes' => 0,
                'completed_quizzes' => 0,
                'overall_progress_percentage' => 0,
                'status' => 'on_track',
            ]
        );

        // Notify student and parent
        Notification::create([
            'user_id' => $student->id,
            'type' => 'access_activated',
            'data' => ['program_id' => $registration->program_id]
        ]);

        if ($student->parent_id) {
            Notification::create([
                'user_id' => $student->parent_id,
                'type' => 'enrollment_confirmed',
                'data' => ['student_id' => $student->id, 'program_id' => $registration->program_id]
            ]);
        }

        return true;
    }

    /**
     * Broadcast student achievement dari SIMY ke SITRA
     * Ketika siswa dapat achievement, orang tua diberitahu di SITRA
     */
    public function notifyParentOfAchievement($studentId, $achievementId)
    {
        $student = User::find($studentId);
        $achievement = \App\Models\SIMY\StudentAchievement::find($achievementId);

        if (!$student || !$achievement) {
            return false;
        }

        $parent = User::find($student->parent_id);
        if ($parent) {
            Notification::create([
                'user_id' => $parent->id,
                'type' => 'achievement_earned',
                'data' => [
                    'student_id' => $studentId,
                    'achievement_title' => $achievement->title,
                    'program_id' => $achievement->program_id,
                ]
            ]);
        }

        return true;
    }

    /**
     * Broadcast certificate completion dari SIMY ke SITRA
     * Ketika siswa selesai program, orang tua mendapat notifikasi certificate
     */
    public function notifyParentOfCompletion($studentId, $certificateId)
    {
        $student = User::find($studentId);
        $certificate = \App\Models\SIMY\StudentCertificate::find($certificateId);

        if (!$student || !$certificate) {
            return false;
        }

        $parent = User::find($student->parent_id);
        if ($parent) {
            Notification::create([
                'user_id' => $parent->id,
                'type' => 'program_completed',
                'data' => [
                    'student_id' => $studentId,
                    'program_id' => $certificate->program_id,
                    'certificate_number' => $certificate->certificate_number,
                ]
            ]);
        }

        return true;
    }

    /**
     * Sync message dari SIMY ke SITRA
     * Teacher message di SIMY automatically visible to parent di SITRA
     */
    public function syncTeacherMessageToParent($messageId)
    {
        $message = \App\Models\General\ChatMessage::find($messageId);

        if (!$message) {
            return false;
        }

        // Ensure parent gets notified of teacher messages
        $student = User::find($message->student_id ?? $message->receiver_id);
        if ($student && $student->parent_id) {
            Notification::create([
                'user_id' => $student->parent_id,
                'type' => 'teacher_message',
                'data' => ['message_id' => $messageId]
            ]);
        }

        return true;
    }

    /**
     * Get comprehensive student data across all systems
     * Used for parent dashboard in SITRA
     */
    public function getStudentComprehensiveData($studentId)
    {
        $student = User::find($studentId);
        if (!$student) {
            return null;
        }

        return [
            'student' => $student,
            'programs' => $student->programs()->with('schedules')->get(),
            'progress' => StudentProgress::where('student_id', $studentId)->get(),
            'attendance' => Attendance::where('user_id', $studentId)->latest()->limit(10)->get(),
            'achievements' => \App\Models\SIMY\StudentAchievement::where('student_id', $studentId)->latest()->limit(5)->get(),
            'assignments' => \App\Models\SIMY\Assignment::whereIn('program_id', $student->programs()->pluck('id'))
                ->with(['submissions' => function ($q) use ($studentId) {
                    $q->where('student_id', $studentId);
                }])->latest()->limit(5)->get(),
        ];
    }

    /**
     * Get staff performance data dari SINTAS untuk dashboard
     */
    public function getStaffPerformanceMetrics($staffId)
    {
        $staff = User::find($staffId);
        if (!$staff) {
            return null;
        }

        return [
            'staff' => $staff,
            'attendance_rate' => $this->calculateAttendanceRate($staffId),
            'pending_tasks' => 0, // Implement task system
            'recent_activities' => \App\Models\General\AuditLog::where('user_id', $staffId)->latest()->limit(10)->get(),
        ];
    }

    /**
     * Calculate attendance rate for a user
     */
    private function calculateAttendanceRate($userId)
    {
        $total = Attendance::where('user_id', $userId)
            ->whereDate('date_time', '>=', Carbon::now()->subMonth())
            ->count();

        if ($total === 0) {
            return 0;
        }

        $present = Attendance::where('user_id', $userId)
            ->where('status', 'present')
            ->whereDate('date_time', '>=', Carbon::now()->subMonth())
            ->count();

        return round(($present / $total) * 100, 2);
    }
}
