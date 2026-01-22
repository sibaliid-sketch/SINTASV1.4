<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class TestAdminOpsRedirect extends Command
{
    protected $signature = 'test:admin-ops-redirect';
    protected $description = 'Test the redirect flow for admin.ops user';

    public function handle()
    {
        $this->info('=== Testing Admin.Ops Redirect Flow ===');
        $this->newLine();

        // Test admin.ops user
        $user = User::where('email', 'admin.ops@sintasv1.test')->first();
        
        if ($user) {
            $this->info('✓ Found Admin.Ops User');
            $this->line("  Email: {$user->email}");
            $this->line("  Role: {$user->role}");
            $this->line("  Department: {$user->department}");
            $this->newLine();

            // Simulate redirect URL calculation
            $redirectUrl = match ($user->role) {
                'student_under_18', 'student_over_18' => '/simy',
                'guardian' => '/sitra',
                'superadmin' => '/sintas/superadmin/dashboard',
                'admin' => '/departments/operations/dashboard',
                'admin_operational' => '/departments/operations/dashboard',
                'karyawan', 'employee' => '/departments/' . ($user->department ?? 'operations') . '/dashboard',
                default => '/sintas',
            };

            $this->info('Expected Redirect URL: ' . $redirectUrl);
            $this->newLine();

            $this->info('Session Flow:');
            $this->line('1. Login with admin.ops@sintasv1.test');
            $this->line('2. AuthenticatedSessionController calculates: ' . $redirectUrl);
            $this->line('3. Stores session: intended_redirect => "' . $redirectUrl . '"');
            $this->line('4. Redirects to: /sintas/welcome');
            $this->line('5. Welcome page should read from session and show countdown');
            $this->line('6. After countdown or button click, redirect to: ' . $redirectUrl);
        } else {
            $this->error('✗ Admin.ops user not found!');
            $this->line('Available users:');
            User::select(['email', 'role', 'department'])->limit(5)->get()->each(function($u) {
                $this->line("  • {$u->email} (role: {$u->role}, dept: {$u->department})");
            });
        }

        $this->newLine();
        $this->info('=== Test Complete ===');
    }
}
