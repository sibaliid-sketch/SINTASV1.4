<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SintasController extends Controller
{
    /**
     * Display the SINTAS welcome page.
     */
    public function welcome()
    {
        return view('welcome.welcomesintas.welcome-sintas');
    }

    /**
     * Display the SINTAS dashboard.
     */
    public function index()
    {
        $user = auth()->user();

        // Redirect to department page based on user's department
        if ($user->department) {
            switch ($user->department) {
                case 'operations':
                    return redirect()->route('departments.operations');
                case 'sales-marketing':
                    return redirect()->route('departments.sales-marketing');
                case 'finance':
                    return redirect()->route('departments.finance');
                case 'product-rnd':
                    return redirect()->route('departments.product-rnd');
                case 'it':
                    return redirect()->route('departments.it');
                case 'academic':
                    return redirect()->route('departments.academic');
                case 'pr':
                    return redirect()->route('departments.pr');
                case 'engagement':
                case 'retention':
                    return redirect()->route('departments.engagement-retention');
            }
        }

        // Fallback to main dashboard with metrics
        $metrics = $this->getMetricsForUser($user);
        return view('SINTAS/Superadmin/dashboard', compact('metrics'));
    }

    /**
     * Get metrics based on user's department, position, and level.
     */
    private function getMetricsForUser($user)
    {
        // Sample metrics based on position and level
        $baseMetrics = [
            'tasks_completed' => 0,
            'tasks_pending' => 0,
            'tasks_overdue' => 0,
            'performance_score' => 0,
            'department_specific' => [],
        ];

        if ($user->position && $user->level) {
            // Adjust metrics based on position and level
            switch ($user->position) {
                case 'Executive':
                case 'Superadmin':
                    $baseMetrics['tasks_completed'] = 100;
                    $baseMetrics['tasks_pending'] = 0;
                    $baseMetrics['tasks_overdue'] = 0;
                    $baseMetrics['performance_score'] = 100;
                    break;
                case 'Manager':
                    $baseMetrics['tasks_completed'] = 45;
                    $baseMetrics['tasks_pending'] = 5;
                    $baseMetrics['tasks_overdue'] = 1;
                    $baseMetrics['performance_score'] = 92;
                    break;
                case 'Supervisor':
                    $baseMetrics['tasks_completed'] = 38;
                    $baseMetrics['tasks_pending'] = 8;
                    $baseMetrics['tasks_overdue'] = 2;
                    $baseMetrics['performance_score'] = 87;
                    break;
                case 'Staff':
                    $baseMetrics['tasks_completed'] = 25;
                    $baseMetrics['tasks_pending'] = 12;
                    $baseMetrics['tasks_overdue'] = 3;
                    $baseMetrics['performance_score'] = 78;
                    break;
                default:
                    $baseMetrics['tasks_completed'] = 20;
                    $baseMetrics['tasks_pending'] = 10;
                    $baseMetrics['tasks_overdue'] = 2;
                    $baseMetrics['performance_score'] = 75;
            }

            // Adjust based on level
            if ($user->level === 'Senior') {
                $baseMetrics['performance_score'] += 5;
                $baseMetrics['tasks_completed'] += 10;
            } elseif ($user->level === 'Junior') {
                $baseMetrics['performance_score'] -= 5;
                $baseMetrics['tasks_pending'] += 5;
            }
        }

        // Department-specific metrics
        if ($user->department) {
            switch ($user->department) {
                case 'operations':
                    $baseMetrics['department_specific'] = [
                        'processes_optimized' => 12,
                        'efficiency_gain' => '15%',
                    ];
                    break;
                case 'pr':
                    $baseMetrics['tasks_completed'] = 85;
                    $baseMetrics['tasks_pending'] = 10;
                    $baseMetrics['tasks_overdue'] = 2;
                    $baseMetrics['performance_score'] = 89;
                    $baseMetrics['team_members'] = 6;
                    $baseMetrics['department_specific'] = [
                        'media_coverage' => 45,
                        'press_releases' => 12,
                        'brand_mentions' => '150%',
                    ];
                    break;
                case 'sales-marketing':
                    $baseMetrics['department_specific'] = [
                        'leads_generated' => 150,
                        'conversion_rate' => '22%',
                    ];
                    break;
                case 'finance':
                    $baseMetrics['department_specific'] = [
                        'reports_generated' => 8,
                        'budget_variance' => '3.2%',
                    ];
                    break;
                case 'product-rnd':
                    $baseMetrics['department_specific'] = [
                        'prototypes_developed' => 5,
                        'innovations_implemented' => 3,
                    ];
                    break;
                case 'it':
                    $baseMetrics['department_specific'] = [
                        'systems_maintained' => 15,
                        'uptime_percentage' => '99.8%',
                    ];
                    break;
                case 'academic':
                    $baseMetrics['department_specific'] = [
                        'courses_updated' => 7,
                        'student_satisfaction' => '4.5/5',
                    ];
                    break;
            }
        }

        return $baseMetrics;
    }

    /**
     * Display the Operations department page.
     */
    public function operations()
    {
        $user = auth()->user();

        // Allow superadmin (all access) or admin_operational (only operational dashboard)
        // Also allow karyawan in operations department with Manager or Executive position
        $hasAccess = $user->role === 'superadmin' ||
                    $user->role === 'admin_operational' ||
                    ($user->role === 'karyawan' &&
                     $user->department === 'operations' &&
                     in_array($user->position, ['Manager', 'Executive']));

        if (!$hasAccess) {
            abort(403, 'Unauthorized access');
        }

        return view('SINTAS/operations/dashboard-operations');
    }

    /**
     * Display the Sales & Marketing department page.
     */
    public function salesMarketing()
    {
        return view('SINTAS/sales-marketing/dashboard-sales_marketin');
    }

    /**
     * Display the Finance department page.
     */
    public function finance()
    {
        return view('SINTAS/finance/dashboard-finance');
    }

    /**
     * Display the Product R&D department page.
     */
    public function productRnd()
    {
        return view('SINTAS/product-rnd/dashboard-product_rnd');
    }

    /**
     * Display the IT department page.
     */
    public function it()
    {
        return view('SINTAS/it/dashboard-it');
    }

    /**
     * Display the IT Chat Console page.
     */
    public function itChatConsole()
    {
        // Get active chats for IT department (only user messages, not admin)
        $activeChats = \App\Models\ChatMessage::where('department', 'it')
            ->where('sender_type', 'user')
            ->where('created_at', '>=', now()->subHours(24))
            ->with('sender')
            ->get()
            ->groupBy('sender_id')
            ->map(function ($messages, $senderId) {
                $lastMessage = $messages->last();
                return [
                    'user' => $lastMessage->sender,
                    'last_message' => $lastMessage,
                    'unread_count' => $messages->where('is_read', false)->count()
                ];
            })
            ->values();

        return view('SINTAS.it.it-chat-console', compact('activeChats'));
    }

    /**
     * Get chat messages for a specific user in a department.
     */
    public function getChatMessages($department, $userId)
    {
        $user = auth()->user();

        // Check access
        if ($user->role !== 'superadmin' && $user->department !== $department) {
            abort(403, 'Unauthorized access');
        }

        // Get messages between the user and any admin in this department
        $messages = \App\Models\ChatMessage::where('department', $department)
            ->where(function ($query) use ($userId) {
                $query->where(function ($q) use ($userId) {
                    $q->where('sender_id', $userId)->where('sender_type', 'user');
                })->orWhere(function ($q) use ($userId) {
                    $q->where('receiver_id', $userId)->where('sender_type', 'admin');
                });
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        $chatUser = \App\Models\User::find($userId);

        return response()->json([
            'messages' => $messages->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'message' => $msg->message,
                    'sender_type' => $msg->sender_type,
                    'sender_name' => $msg->sender ? $msg->sender->name : 'Admin',
                    'created_at' => $msg->created_at->format('H:i'),
                    'is_mine' => $msg->sender_id == auth()->id(),
                ];
            }),
            'user' => $chatUser ? [
                'id' => $chatUser->id,
                'name' => $chatUser->name,
                'department' => $chatUser->department,
            ] : null,
        ]);
    }

    /**
     * Display the Academic department page.
     */
    public function academic()
    {
        return view('SINTAS/academic/dashboard-academic');
    }

    /**
     * Display the Academic Services page.
     */
    public function academicServices()
    {
        $services = \App\Models\Service::paginate(15);
        return view('SINTAS.academic.academic-services.index', compact('services'));
    }

    /**
     * Display the Academic Programs page.
     */
    public function academicPrograms()
    {
        $programs = \App\Models\Program::with('service')->paginate(15);
        $services = \App\Models\Service::all();
        return view('SINTAS.academic.academic-programs.index', compact('programs', 'services'));
    }

    /**
     * Display the Academic Schedules page.
     */
    public function academicSchedules()
    {
        $schedules = \App\Models\Schedule::with('program.service')->paginate(15);
        $programs = \App\Models\Program::with('service')->get();
        return view('SINTAS.academic.academic-schedules.index', compact('schedules', 'programs'));
    }

    /**
     * Display the Engagement & Retention department page.
     */
    public function engagementRetention()
    {
        return view('SINTAS/engagement-retention/dashboard-engagement_retention');
    }

    /**
     * Display the PR department page.
     */
    public function pr()
    {
        $attendances = \App\Models\Attendance::latest('date_time')->take(50)->get();
        return view('SINTAS/pr/dashboar-pr', compact('attendances'));
    }

    /**
     * Display the PR Overview page with pagination.
     */
    public function overviewPr()
    {
        $metrics = $this->getMetricsForDepartment('pr');
        $attendances = \App\Models\Attendance::latest('date_time')->paginate(50);
        return view('SINTAS/pr/overview-pr', compact('metrics', 'attendances'));
    }

    /**
     * Display the Overview page with metrics.
     */
    public function overview()
    {
        $user = auth()->user();
        $metrics = $this->getMetricsForUser($user);

        return view('SINTAS/Superadmin/overview', compact('metrics'));
    }

    /**
     * Display the Operations Overview page.
     */
    public function overviewOperations()
    {
        $metrics = $this->getMetricsForDepartment('operations');
        return view('SINTAS/operations/overview-operations', compact('metrics'));
    }

    /**
     * Display the Sales & Marketing Overview page.
     */
    public function overviewSalesMarketing()
    {
        $metrics = $this->getMetricsForDepartment('sales-marketing');
        return view('SINTAS/sales-marketing/overview-sales_marketing', compact('metrics'));
    }

    /**
     * Display the Finance Overview page.
     */
    public function overviewFinance()
    {
        $metrics = $this->getMetricsForDepartment('finance');
        return view('SINTAS/finance/overview-finance', compact('metrics'));
    }

    /**
     * Display the Product R&D Overview page.
     */
    public function overviewProductRnd()
    {
        $metrics = $this->getMetricsForDepartment('product-rnd');
        return view('SINTAS/product-rnd/overview-product_nd', compact('metrics'));
    }

    /**
     * Display the IT Overview page.
     */
    public function overviewIt()
    {
        $metrics = $this->getMetricsForDepartment('it');
        return view('SINTAS/it/overview-it', compact('metrics'));
    }

    /**
     * Display the Academic Overview page.
     */
    public function overviewAcademic()
    {
        $metrics = $this->getMetricsForDepartment('academic');
        return view('SINTAS/academic/overview-academic', compact('metrics'));
    }

    /**
     * Display the Engagement & Retention Overview page.
     */
    public function overviewEngagementRetention()
    {
        $metrics = $this->getMetricsForDepartment('engagement-retention');
        return view('SINTAS/engagement-retention/overview-engagement_retention', compact('metrics'));
    }

    /**
     * Display the enhanced attendance page with filters.
     */
    public function attendanceIndex(Request $request)
    {
        $query = \App\Models\Attendance::query();

        // Apply filters
        if ($request->filled('start_date')) {
            $query->whereDate('date_time', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('date_time', '<=', $request->end_date);
        }

        if ($request->filled('pin')) {
            $query->where('pin', 'like', '%' . $request->pin . '%');
        }

        if ($request->filled('device_id')) {
            $query->where('device_id', $request->device_id);
        }

        // Get unique device IDs for filter dropdown
        $devices = \App\Models\Attendance::select('device_id')
            ->distinct()
            ->orderBy('device_id')
            ->pluck('device_id');

        // Paginate results with query string preservation
        $attendances = $query->latest('date_time')->paginate(50)->appends($request->query());

        return view('SINTAS/Superadmin/superadmin-attendance/main', compact('attendances', 'devices'));
    }

    /**
     * Display the General page for a department with tabs.
     */
    public function general()
    {
        $routeName = request()->route()->getName();
        $parts = explode('.', $routeName);
        $department = $parts[1]; // e.g., 'operations' from 'departments.operations.general'

        $user = auth()->user();

        // Check access based on department
        $hasAccess = $user->role === 'superadmin' ||
                    ($user->role === 'karyawan' && $user->department === $department) ||
                    ($user->role === 'admin_operational' && $department === 'operations');

        if (!$hasAccess) {
            abort(403, 'Unauthorized access');
        }

        $metrics = $this->getMetricsForDepartment($department);
        return view('SINTAS.' . $department . '.general', compact('department', 'metrics'));
    }

    /**
     * Display the Tools page for a department with tabs.
     */
    public function tools()
    {
        $routeName = request()->route()->getName();
        $parts = explode('.', $routeName);
        $department = $parts[1]; // e.g., 'operations' from 'departments.operations.tools'

        $user = auth()->user();

        // Check access based on department
        $hasAccess = $user->role === 'superadmin' ||
                    ($user->role === 'karyawan' && $user->department === $department) ||
                    ($user->role === 'admin_operational' && $department === 'operations');

        if (!$hasAccess) {
            abort(403, 'Unauthorized access');
        }

        $metrics = $this->getMetricsForDepartment($department);
        return view('SINTAS.' . $department . '.tools', compact('department', 'metrics'));
    }

    /**
     * Get aggregated metrics for a department.
     */
    private function getMetricsForDepartment($department)
    {
        // Sample aggregated metrics for the department
        $baseMetrics = [
            'tasks_completed' => 0,
            'tasks_pending' => 0,
            'tasks_overdue' => 0,
            'performance_score' => 0,
            'department_specific' => [],
            'team_members' => 0,
        ];

        // Department-specific aggregated metrics
        switch ($department) {
            case 'operations':
                $baseMetrics['tasks_completed'] = 120;
                $baseMetrics['tasks_pending'] = 15;
                $baseMetrics['tasks_overdue'] = 3;
                $baseMetrics['performance_score'] = 88;
                $baseMetrics['team_members'] = 8;
                $baseMetrics['department_specific'] = [
                    'processes_optimized' => 25,
                    'efficiency_gain' => '18%',
                ];
                break;
            case 'pr':
                $baseMetrics['tasks_completed'] = 85;
                $baseMetrics['tasks_pending'] = 10;
                $baseMetrics['tasks_overdue'] = 2;
                $baseMetrics['performance_score'] = 89;
                $baseMetrics['team_members'] = 6;
                $baseMetrics['department_specific'] = [
                    'media_coverage' => 45,
                    'press_releases' => 12,
                    'brand_mentions' => '150%',
                ];
                break;
            case 'sales-marketing':
                $baseMetrics['tasks_completed'] = 95;
                $baseMetrics['tasks_pending'] = 20;
                $baseMetrics['tasks_overdue'] = 5;
                $baseMetrics['performance_score'] = 85;
                $baseMetrics['team_members'] = 6;
                $baseMetrics['department_specific'] = [
                    'leads_generated' => 450,
                    'conversion_rate' => '25%',
                ];
                break;
            case 'finance':
                $baseMetrics['tasks_completed'] = 80;
                $baseMetrics['tasks_pending'] = 10;
                $baseMetrics['tasks_overdue'] = 2;
                $baseMetrics['performance_score'] = 92;
                $baseMetrics['team_members'] = 4;
                $baseMetrics['department_specific'] = [
                    'reports_generated' => 20,
                    'budget_variance' => '2.1%',
                ];
                break;
            case 'product-rnd':
                $baseMetrics['tasks_completed'] = 60;
                $baseMetrics['tasks_pending'] = 12;
                $baseMetrics['tasks_overdue'] = 4;
                $baseMetrics['performance_score'] = 83;
                $baseMetrics['team_members'] = 5;
                $baseMetrics['department_specific'] = [
                    'prototypes_developed' => 12,
                    'innovations_implemented' => 7,
                ];
                break;
            case 'it':
                $baseMetrics['tasks_completed'] = 110;
                $baseMetrics['tasks_pending'] = 8;
                $baseMetrics['tasks_overdue'] = 1;
                $baseMetrics['performance_score'] = 95;
                $baseMetrics['team_members'] = 7;
                $baseMetrics['department_specific'] = [
                    'systems_maintained' => 35,
                    'uptime_percentage' => '99.9%',
                ];
                break;
            case 'academic':
                $baseMetrics['tasks_completed'] = 75;
                $baseMetrics['tasks_pending'] = 18;
                $baseMetrics['tasks_overdue'] = 6;
                $baseMetrics['performance_score'] = 80;
                $baseMetrics['team_members'] = 9;
                $baseMetrics['department_specific'] = [
                    'courses_updated' => 15,
                    'student_satisfaction' => '4.6/5',
                ];
                break;
            case 'engagement-retention':
                $baseMetrics['tasks_completed'] = 175;
                $baseMetrics['tasks_pending'] = 24;
                $baseMetrics['tasks_overdue'] = 6;
                $baseMetrics['performance_score'] = 86;
                $baseMetrics['team_members'] = 11;
                $baseMetrics['department_specific'] = [
                    'engagement_rate' => '78%',
                    'interaction_increase' => '25%',
                    'retention_rate' => '92%',
                    'churn_reduction' => '15%',
                ];
                break;
        }

        return $baseMetrics;
    }
}
