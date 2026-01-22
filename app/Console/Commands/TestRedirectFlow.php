<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class TestRedirectFlow extends Command
{
    protected $signature = 'test:redirect-flow';
    protected $description = 'Test the redirect flow after login';

    public function handle()
    {
        $this->info('=== Testing Redirect Flow ===');
        $this->newLine();

        // Test 1: Check if employee user exists
        $employee = User::where('email', 'employee@sintasv1.test')->first();
        
        if ($employee) {
            $this->info('✓ Found Employee User');
            $this->line("  Email: {$employee->email}");
            $this->line("  Role: {$employee->role}");
            $this->line("  Department: {$employee->department}");
            $this->newLine();

            // Simulate redirect URL calculation
            $redirectUrl = match ($employee->role) {
                'student_under_18', 'student_over_18' => '/simy',
                'guardian' => '/sitra',
                'superadmin' => '/sintas',
                'admin' => '/departments/operations',
                'admin_operational' => '/departments/operations',
                'karyawan', 'employee' => '/departments/' . ($employee->department ?? 'operations'),
                default => '/sintas',
            };

            $this->info('Expected Redirect URL: ' . $redirectUrl);
            $this->newLine();

            $this->info('Flow:');
            $this->line('1. User logs in with: ' . $employee->email);
            $this->line('2. AuthenticatedSessionController.store() triggered');
            $this->line('3. Stores redirect URL in session (for backward compatibility)');
            $this->line('4. Redirects to: /sintas/welcome');
            $this->line('5. Welcome page calculates redirect URL based on user role/department: ' . $redirectUrl);
            $this->line('6. Welcome page displays countdown (3 seconds)');
            $this->line('7. After countdown OR button click, redirects to: ' . $redirectUrl);
        } else {
            $this->error('✗ Employee user not found!');
            $this->line('Please run: php artisan db:seed');
        }

        $this->newLine();
        $this->info('=== Test Complete ===');
    }
}
