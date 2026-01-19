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
}
