<?php

namespace App\Http\Controllers\SITRA;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use App\Models\General\Registration;
use App\Models\General\PaymentProof;
use App\Models\SINTAS\Attendance;
use App\Models\SIMY\StudentProgress;
use App\Models\SIMY\StudentAchievement;
use App\Models\General\ChatMessage;
use App\Models\SIMY\StudentCertificate;
use App\Models\SIMY\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * SitraController - Customer Portal Controller (Parent/Guardian)
 * Mengelola monitoring anak, pembayaran, komunikasi, dan laporan akademik
 * untuk orang tua/wali siswa
 */
class SitraController extends Controller
{
    /**
     * Display the SITRA welcome page
     */
    public function welcome()
    {
        return view('SITRA.welcome');
    }

    /**
     * Display the Beranda (Home) page for SITRA.
     */
    public function beranda()
    {
        return view('SITRA.beranda');
    }

    /**
     * Display SITRA dashboard with children summary
     * Shows comprehensive monitoring information for parents/guardians
     */
    public function index()
    {
        $guardian = Auth::user();

        // Validate guardian role
        if ($guardian->role !== 'guardian') {
            return redirect()->route('dashboard')->withError('Invalid guardian access');
        }

        try {
            // Get all children linked to this guardian
            $children = User::where('parent_id', $guardian->id)
                ->whereIn('role', ['student', 'student_under_18'])
                ->with(['programs', 'registrations', 'payments'])
                ->orderBy('name', 'asc')
                ->get();

            if ($children->isEmpty()) {
                return view('SITRA.no-children');
            }

            // Get summary data for each child with caching
            $childrenData = $children->map(function ($child) {
                $latestProgress = StudentProgress::where('student_id', $child->id)
                    ->with('program')
                    ->latest('updated_at')
                    ->first();

                $latestGrades = $child->grades ?? collect();
                if (method_exists($child, 'grades')) {
                    $latestGrades = $child->grades()
                        ->with('program')
                        ->latest('created_at')
                        ->limit(5)
                        ->get();
                }

                $pendingAssignments = 0;
                if (method_exists($child, 'assignments')) {
                    $pendingAssignments = $child->assignments()
                        ->where('due_date', '>', now())
                        ->doesntHave('submissions')
                        ->count();
                }

                $nextClasses = collect();
                if (method_exists($child, 'schedules')) {
                    $nextClasses = $child->schedules()
                        ->where('start_date', '<=', now()->toDateString())
                        ->where(function ($query) {
                            $query->whereNull('end_date')
                                  ->orWhere('end_date', '>=', now()->toDateString());
                        })
                        ->latest('start_date')
                        ->limit(3)
                        ->get();
                }

                // Get certificates count
                $certificates = StudentCertificate::where('student_id', $child->id)->count();

                return [
                    'user' => $child,
                    'progress' => $latestProgress,
                    'grades' => $latestGrades,
                    'pending_assignments' => $pendingAssignments,
                    'next_classes' => $nextClasses,
                    'certificates' => $certificates,
                    'attendance_rate' => $this->calculateAttendanceRate($child->id) ?? 0,
                ];
            });

            return view('SITRA.dashboard', compact('children', 'childrenData'));
            
        } catch (\Exception $e) {
            Log::error('SITRA Dashboard Error: ' . $e->getMessage());
            return redirect()->route('sitra.welcome')->withError('Error loading dashboard. Please try again.');
        }
    }

    /**
     * Display child's detailed academic information
     * Shows grades, progress, and achievements for monitored child
     */
    public function childAcademic($childId)
    {
        $guardian = Auth::user();

        // Validate role
        if ($guardian->role !== 'guardian') {
            return redirect()->route('dashboard')->withError('Invalid guardian access');
        }

        try {
            $child = User::findOrFail($childId);

            // Verify guardian is parent of this child
            if ($child->parent_id !== $guardian->id) {
                return redirect()->route('sitra.dashboard')->withError('Unauthorized access to child data');
            }

            // Cache academic data for 5 minutes to reduce database load
            $cacheKey = 'sitra_child_academic_' . $childId;
            $academicData = Cache::remember($cacheKey, 300, function () use ($childId) {
                return [
                    'programs' => User::findOrFail($childId)->programs()
                        ->with('schedules')
                        ->orderBy('name', 'asc')
                        ->get(),
                    'progressData' => StudentProgress::where('student_id', $childId)
                        ->with('program')
                        ->orderBy('percentage', 'desc')
                        ->get(),
                    'achievements' => StudentAchievement::where('student_id', $childId)
                        ->with('program')
                        ->latest('earned_at')
                        ->get(),
                    'recentGrades' => User::findOrFail($childId)->grades()
                        ->with(['program', 'subject'])
                        ->latest('created_at')
                        ->limit(20)
                        ->get(),
                ];
            });

            $programs = $academicData['programs'];
            $progressData = $academicData['progressData'];
            $achievements = $academicData['achievements'];
            $recentGrades = $academicData['recentGrades'];

            return view('SITRA.child-academic', compact('child', 'programs', 'progressData', 'achievements', 'recentGrades'));
            
        } catch (ModelNotFoundException $e) {
            return redirect()->route('sitra.dashboard')->withError('Child not found');
        } catch (\Exception $e) {
            Log::error('SITRA Child Academic Error: ' . $e->getMessage());
            return redirect()->route('sitra.dashboard')->withError('Error loading child academic data');
        }
    }

    /**
     * Display child's attendance records with analytics
     */
    public function childAttendance($childId)
    {
        $guardian = Auth::user();

        // Validate role
        if ($guardian->role !== 'guardian') {
            return redirect()->route('dashboard')->withError('Invalid guardian access');
        }

        try {
            $child = User::findOrFail($childId);

            // Verify guardian is parent of this child
            if ($child->parent_id !== $guardian->id) {
                return redirect()->route('sitra.dashboard')->withError('Unauthorized access to attendance data');
            }

            // Cache attendance stats for 10 minutes
            $cacheKey = 'sitra_attendance_' . $childId;
            $attendanceData = Cache::remember($cacheKey, 600, function () use ($childId) {
                $stats = [
                    'total_present' => Attendance::where('user_id', $childId)
                        ->where('status', 'present')->count(),
                    'total_absent' => Attendance::where('user_id', $childId)
                        ->where('status', 'absent')->count(),
                    'total_late' => Attendance::where('user_id', $childId)
                        ->where('status', 'late')->count(),
                    'total_sessions' => Attendance::where('user_id', $childId)->count(),
                ];

                $attendanceRate = $stats['total_sessions'] > 0
                    ? round(($stats['total_present'] / $stats['total_sessions']) * 100, 2)
                    : 0;

                return [
                    'stats' => $stats,
                    'rate' => $attendanceRate,
                    'records' => Attendance::where('user_id', $childId)
                        ->latest('date_time')
                        ->limit(30)
                        ->get(),
                ];
            });

            $attendanceStats = $attendanceData['stats'];
            $attendanceRate = $attendanceData['rate'];
            $attendances = $attendanceData['records'];

            return view('SITRA.child-attendance', compact('child', 'attendances', 'attendanceStats', 'attendanceRate'));
            
        } catch (ModelNotFoundException $e) {
            return redirect()->route('sitra.dashboard')->withError('Child not found');
        } catch (\Exception $e) {
            Log::error('SITRA Child Attendance Error: ' . $e->getMessage());
            return redirect()->route('sitra.dashboard')->withError('Error loading attendance data');
        }
    }

    /**
     * Display payment and billing information for child
     * Shows registrations, payment history, and account summary
     */
    public function payments($childId)
    {
        $guardian = Auth::user();

        // Validate role
        if ($guardian->role !== 'parent') {
            return redirect()->route('dashboard')->withError('Invalid parent access');
        }

        try {
            $child = User::findOrFail($childId);

            // Verify guardian is parent of this child
            if ($child->parent_id !== $guardian->id) {
                return redirect()->route('sitra.dashboard')->withError('Unauthorized access to payment data');
            }

            // Cache payment data for 15 minutes
            $cacheKey = 'sitra_payments_' . $childId;
            $paymentData = Cache::remember($cacheKey, 900, function () use ($childId) {
                return [
                    'registrations' => Registration::where('student_id', $childId)
                        ->with(['program', 'payments' => function ($query) {
                            $query->latest('created_at');
                        }])
                        ->latest('created_at')
                        ->get(),
                    'history' => PaymentProof::where('student_id', $childId)
                        ->with('registration')
                        ->latest('created_at')
                        ->limit(20)
                        ->get(),
                    'totalPaid' => PaymentProof::where('student_id', $childId)
                        ->where('status', 'verified')
                        ->sum('amount'),
                    'totalPending' => PaymentProof::where('student_id', $childId)
                        ->where('status', 'pending')
                        ->sum('amount'),
                    'totalOverdue' => Registration::where('student_id', $childId)
                        ->where('status', 'active')
                        ->sum('remaining_amount'),
                ];
            });

            $registrations = $paymentData['registrations'];
            $paymentHistory = $paymentData['history'];
            $totalPaid = $paymentData['totalPaid'];
            $totalPending = $paymentData['totalPending'];
            $totalOverdue = $paymentData['totalOverdue'];

            return view('SITRA.payments', compact('child', 'registrations', 'paymentHistory', 'totalPaid', 'totalPending', 'totalOverdue'));
            
        } catch (ModelNotFoundException $e) {
            return redirect()->route('sitra.dashboard')->withError('Child not found');
        } catch (\Exception $e) {
            Log::error('SITRA Payments Error: ' . $e->getMessage());
            return redirect()->route('sitra.dashboard')->withError('Error loading payment information');
        }
    }

    /**
     * Display child's certificates and achievements
     */
    public function certificates($childId)
    {
        $guardian = Auth::user();

        // Validate role
        if ($guardian->role !== 'parent') {
            return redirect()->route('dashboard')->withError('Invalid parent access');
        }

        try {
            $child = User::findOrFail($childId);

            // Verify guardian is parent of this child
            if ($child->parent_id !== $guardian->id) {
                return redirect()->route('sitra.dashboard')->withError('Unauthorized access to certificates');
            }

            // Cache certificates for 1 hour
            $cacheKey = 'sitra_certificates_' . $childId;
            $certificates = Cache::remember($cacheKey, 3600, function () use ($childId) {
                return StudentCertificate::where('student_id', $childId)
                    ->with('program')
                    ->latest('issued_at')
                    ->get();
            });

            return view('SITRA.certificates', compact('child', 'certificates'));
            
        } catch (ModelNotFoundException $e) {
            return redirect()->route('sitra.dashboard')->withError('Child not found');
        } catch (\Exception $e) {
            Log::error('SITRA Certificates Error: ' . $e->getMessage());
            return redirect()->route('sitra.dashboard')->withError('Error loading certificates');
        }
    }

    /**
     * Display communication and messages with teachers
     */
    public function messages($childId)
    {
        $guardian = Auth::user();

        // Validate role
        if ($guardian->role !== 'parent') {
            return redirect()->route('dashboard')->withError('Invalid parent access');
        }

        try {
            $child = User::findOrFail($childId);

            // Verify guardian is parent of this child
            if ($child->parent_id !== $guardian->id) {
                return redirect()->route('sitra.dashboard')->withError('Unauthorized access to messages');
            }

            // Cache messages for 5 minutes
            $cacheKey = 'sitra_messages_' . $childId;
            $messageData = Cache::remember($cacheKey, 300, function () use ($childId) {
                return [
                    'conversations' => ChatMessage::where('student_id', $childId)
                        ->with(['sender', 'receiver'])
                        ->distinct('conversation_id')
                        ->latest('created_at')
                        ->limit(15)
                        ->get(),
                    'unreadCount' => ChatMessage::where('student_id', $childId)
                        ->where('is_read', false)
                        ->count(),
                ];
            });

            $conversations = $messageData['conversations'];
            $unreadMessages = $messageData['unreadCount'];

            return view('SITRA.messages', compact('child', 'conversations', 'unreadMessages'));
            
        } catch (ModelNotFoundException $e) {
            return redirect()->route('sitra.dashboard')->withError('Child not found');
        } catch (\Exception $e) {
            Log::error('SITRA Messages Error: ' . $e->getMessage());
            return redirect()->route('sitra.dashboard')->withError('Error loading messages');
        }
    }

    /**
     * Display detailed conversation with teacher
     */
    public function conversation($childId, $conversationId)
    {
        $guardian = Auth::user();
        $child = User::findOrFail($childId);

        if ($child->parent_id !== $guardian->id && $guardian->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        $messages = ChatMessage::where('student_id', $childId)
            ->where('conversation_id', $conversationId)
            ->with(['sender', 'receiver'])
            ->latest('created_at')
            ->paginate(20);

        return view('SITRA.conversation', compact('child', 'messages', 'conversationId'));
    }

    /**
     * Send message to teacher
     */
    public function sendMessage(Request $request, $childId)
    {
        $guardian = Auth::user();
        $child = User::findOrFail($childId);

        if ($child->parent_id !== $guardian->id && $guardian->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'conversation_id' => 'required|string',
            'recipient_id' => 'required|exists:users,id',
        ]);

        $chatMessage = ChatMessage::create([
            'student_id' => $childId,
            'sender_id' => $guardian->id,
            'sender_type' => 'parent',
            'receiver_id' => $validated['recipient_id'],
            'message' => $validated['message'],
            'conversation_id' => $validated['conversation_id'],
            'is_read' => false,
        ]);

        return response()->json(['success' => true, 'message' => $chatMessage], 201);
    }

    /**
     * Display child's schedule and calendar
     */
    public function schedule($childId)
    {
        $guardian = Auth::user();
        $child = User::findOrFail($childId);

        if ($child->parent_id !== $guardian->id && $guardian->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        $upcomingClasses = $child->schedules()
            ->where('start_date', '<=', now()->toDateString())
            ->where(function ($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>=', now()->toDateString());
            })
            ->with('program')
            ->latest('start_date')
            ->paginate(15);

        $allSchedules = $child->schedules()
            ->with('program')
            ->latest('start_date')
            ->get();

        return view('SITRA.schedule', compact('child', 'upcomingClasses', 'allSchedules'));
    }

    /**
     * Display academic reports
     */
    public function reports($childId)
    {
        $guardian = Auth::user();
        $child = User::findOrFail($childId);

        if ($child->parent_id !== $guardian->id && $guardian->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        $progressData = StudentProgress::where('student_id', $childId)
            ->with('program')
            ->latest('updated_at')
            ->get();

        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthlyStats[$month->format('Y-m')] = [
                'month' => $month->format('F Y'),
                'assignments_completed' => $this->getMonthlyAssignments($childId, $month),
                'average_grade' => $this->getMonthlyAverageGrade($childId, $month),
                'attendance_rate' => $this->getMonthlyAttendanceRate($childId, $month),
            ];
        }

        return view('SITRA.reports', compact('child', 'progressData', 'monthlyStats'));
    }

    /**
     * Display settings and preferences
     */
    public function settings()
    {
        $guardian = Auth::user();
        $preferences = $guardian->preferences ?? [];

        return view('SITRA.settings', compact('guardian', 'preferences'));
    }

    /**
     * Update notification preferences
     */
    public function updatePreferences(Request $request)
    {
        $guardian = Auth::user();

        $validated = $request->validate([
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
            'push_notifications' => 'boolean',
            'report_frequency' => 'in:daily,weekly,monthly',
            'language' => 'in:id,en',
        ]);

        $guardian->update(['preferences' => $validated]);

        return redirect()->back()->with('success', 'Preferences updated successfully');
    }

    /**
     * Download child's report as PDF
     */
    public function downloadReport($childId, $reportType = 'academic')
    {
        $guardian = Auth::user();
        $child = User::findOrFail($childId);

        if ($child->parent_id !== $guardian->id && $guardian->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        // Generate PDF based on report type
        // Implementation depends on PDF library (e.g., barryvdh/laravel-dompdf)
        
        return response()->download("reports/{$childId}_{$reportType}.pdf");
    }

    /**
     * Calculate attendance rate for a child
     */
    private function calculateAttendanceRate($childId)
    {
        $totalAttendances = Attendance::where('user_id', $childId)->count();
        if ($totalAttendances === 0) {
            return 0;
        }

        $presentCount = Attendance::where('user_id', $childId)
            ->where('status', 'present')
            ->count();

        return round(($presentCount / $totalAttendances) * 100, 2);
    }

    /**
     * Get monthly assignments completed
     */
    private function getMonthlyAssignments($childId, $month)
    {
        return AssignmentSubmission::whereHas('assignment', function ($query) use ($childId) {
            $query->where('program_id', function ($subQuery) use ($childId) {
                $subQuery->select('program_id')
                    ->from('registrations')
                    ->where('student_id', $childId);
            });
        })
            ->where('student_id', $childId)
            ->whereBetween('created_at', [$month->startOfMonth(), $month->endOfMonth()])
            ->count();
    }

    /**
     * Get monthly average grade
     */
    private function getMonthlyAverageGrade($childId, $month)
    {
        $grades = DB::table('grades')
            ->where('student_id', $childId)
            ->whereBetween('created_at', [$month->startOfMonth(), $month->endOfMonth()])
            ->pluck('grade')
            ->toArray();

        return count($grades) > 0 ? round(array_sum($grades) / count($grades), 2) : 0;
    }

    /**
     * Get monthly attendance rate
     */
    private function getMonthlyAttendanceRate($childId, $month)
    {
        $total = Attendance::where('user_id', $childId)
            ->whereBetween('date_time', [$month->startOfMonth(), $month->endOfMonth()])
            ->count();

        if ($total === 0) {
            return 0;
        }

        $present = Attendance::where('user_id', $childId)
            ->where('status', 'present')
            ->whereBetween('date_time', [$month->startOfMonth(), $month->endOfMonth()])
            ->count();

        return round(($present / $total) * 100, 2);
    }

    /**
     * Display the Ticket page for SITRA.
     */
    public function ticket()
    {
        return view('SITRA.ticket');
    }

    /**
     * Display the Message page for SITRA.
     */
    public function message()
    {
        return view('SITRA.message');
    }

    /**
     * Display the Notification page for SITRA.
     */
    public function notification()
    {
        return view('SITRA.notification');
    }

    /**
     * Display the Setting page for SITRA.
     */
    public function setting()
    {
        return view('SITRA.setting');
    }
}
