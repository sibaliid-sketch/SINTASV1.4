<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SintasController extends Controller
{
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
                case 'engagement':
                case 'retention':
                    return redirect()->route('departments.engagement-retention');
            }
        }

        // Fallback to main dashboard with metrics
        $metrics = $this->getMetricsForUser($user);
        return view('sintas', compact('metrics'));
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
        return view('sintas.operations');
    }

    /**
     * Display the Sales & Marketing department page.
     */
    public function salesMarketing()
    {
        return view('sintas.sales-marketing');
    }

    /**
     * Display the Finance department page.
     */
    public function finance()
    {
        return view('sintas.finance');
    }

    /**
     * Display the Product R&D department page.
     */
    public function productRnd()
    {
        return view('sintas.product-rnd');
    }

    /**
     * Display the IT department page.
     */
    public function it()
    {
        return view('sintas.it');
    }

    /**
     * Display the Academic department page.
     */
    public function academic()
    {
        return view('sintas.academic');
    }

    /**
     * Display the Engagement & Retention department page.
     */
    public function engagementRetention()
    {
        return view('sintas.engagement-retention');
    }

    /**
     * Display the Overview page with metrics.
     */
    public function overview()
    {
        $user = auth()->user();
        $metrics = $this->getMetricsForUser($user);

        return view('overview', compact('metrics'));
    }

    /**
     * Display the Operations Overview page.
     */
    public function overviewOperations()
    {
        $metrics = $this->getMetricsForDepartment('operations');
        return view('overview-operations', compact('metrics'));
    }

    /**
     * Display the Sales & Marketing Overview page.
     */
    public function overviewSalesMarketing()
    {
        $metrics = $this->getMetricsForDepartment('sales-marketing');
        return view('overview-sales-marketing', compact('metrics'));
    }

    /**
     * Display the Finance Overview page.
     */
    public function overviewFinance()
    {
        $metrics = $this->getMetricsForDepartment('finance');
        return view('overview-finance', compact('metrics'));
    }

    /**
     * Display the Product R&D Overview page.
     */
    public function overviewProductRnd()
    {
        $metrics = $this->getMetricsForDepartment('product-rnd');
        return view('overview-product-rnd', compact('metrics'));
    }

    /**
     * Display the IT Overview page.
     */
    public function overviewIt()
    {
        $metrics = $this->getMetricsForDepartment('it');
        return view('overview-it', compact('metrics'));
    }

    /**
     * Display the Academic Overview page.
     */
    public function overviewAcademic()
    {
        $metrics = $this->getMetricsForDepartment('academic');
        return view('overview-academic', compact('metrics'));
    }

    /**
     * Display the Engagement & Retention Overview page.
     */
    public function overviewEngagementRetention()
    {
        $metrics = $this->getMetricsForDepartment('engagement-retention');
        return view('overview-engagement-retention', compact('metrics'));
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
