<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HrSeeder extends Seeder
{
    /**
     * Run the database seeds for HR testing.
     */
    public function run(): void
    {
        // HR Department users for testing

        // Superadmin
        User::updateOrCreate(
            ['email' => 'superadmin@sintasv1.test'],
            [
                'name' => 'Superadmin Executive',
                'password' => Hash::make('password123'),
                'role' => 'superadmin',
                'department' => 'operations',
                'position' => 'Executive',
                'level' => 'Senior',
            ]
        );

        // Admin Operational
        User::updateOrCreate(
            ['email' => 'admin.ops@sintasv1.test'],
            [
                'name' => 'Admin Operational',
                'password' => Hash::make('password123'),
                'role' => 'admin_operational',
                'department' => 'operations',
                'position' => 'Staff',
                'level' => 'Mid',
            ]
        );

        // Operations Manager
        User::updateOrCreate(
            ['email' => 'manager@sintasv1.test'],
            [
                'name' => 'Manager Operations',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'operations',
                'position' => 'Manager',
                'level' => 'Senior',
            ]
        );

        // Sales & Marketing Supervisor
        User::updateOrCreate(
            ['email' => 'sales.supervisor@sintasv1.test'],
            [
                'name' => 'Sales & Marketing Supervisor',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'sales-marketing',
                'position' => 'Supervisor',
                'level' => 'Mid',
            ]
        );

        // Finance Staff
        User::updateOrCreate(
            ['email' => 'finance.staff@sintasv1.test'],
            [
                'name' => 'Finance Staff',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'finance',
                'position' => 'Staff',
                'level' => 'Junior',
            ]
        );

        // IT Staff
        User::updateOrCreate(
            ['email' => 'it.staff@sintasv1.test'],
            [
                'name' => 'IT Specialist',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'it',
                'position' => 'Staff',
                'level' => 'Senior',
            ]
        );

        // Academic Manager
        User::updateOrCreate(
            ['email' => 'academic.manager@sintasv1.test'],
            [
                'name' => 'Academic Manager',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'academic',
                'position' => 'Manager',
                'level' => 'Senior',
            ]
        );

        // PR Manager
        User::updateOrCreate(
            ['email' => 'pr.manager@sintasv1.test'],
            [
                'name' => 'PR Manager',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'pr',
                'position' => 'Manager',
                'level' => 'Senior',
            ]
        );

        // PR Staff
        User::updateOrCreate(
            ['email' => 'pr.staff@sintasv1.test'],
            [
                'name' => 'PR Staff',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'pr',
                'position' => 'Staff',
                'level' => 'Mid',
            ]
        );

        // Engagement & Retention Manager
        User::updateOrCreate(
            ['email' => 'engagement.retention@sintasv1.test'],
            [
                'name' => 'Engagement & Retention Manager',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'engagement-retention',
                'position' => 'Manager',
                'level' => 'Senior',
            ]
        );

        // Product R&D Staff
        User::updateOrCreate(
            ['email' => 'product.rnd@sintasv1.test'],
            [
                'name' => 'Product R&D Staff',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'product-rnd',
                'position' => 'Staff',
                'level' => 'Mid',
            ]
        );

        // Test user
        User::updateOrCreate(
            ['email' => 'test@sintasv1.test'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'operations',
                'position' => 'Staff',
                'level' => 'Junior',
            ]
        );
    }
}
