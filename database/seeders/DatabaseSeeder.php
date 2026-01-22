<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users for role-based routing testing

        // Student user
        User::updateOrCreate(
            ['email' => 'student@sintasv1.test'],
            [
                'name' => 'Student Test',
                'password' => Hash::make('password123'),
                'role' => 'student',
            ]
        );

        // Guardian user
        User::updateOrCreate(
            ['email' => 'guardian@sintasv1.test'],
            [
                'name' => 'Guardian Test',
                'password' => Hash::make('password123'),
                'role' => 'guardian',
            ]
        );

        // Superadmin user (Executive level - All access)
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

        // Admin user (System-wide admin)
        User::updateOrCreate(
            ['email' => 'admin@sintasv1.test'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'department' => 'operations',
                'position' => 'Administrator',
                'level' => 'Senior',
            ]
        );

        // Employee user (General department staff)
        User::updateOrCreate(
            ['email' => 'employee@sintasv1.test'],
            [
                'name' => 'Employee Test',
                'password' => Hash::make('password123'),
                'role' => 'employee',
                'department' => 'operations',
                'position' => 'Staff',
                'level' => 'Junior',
            ]
        );

        // Admin Operational user (Operational staff - Only operational dashboard)
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

        User::updateOrCreate(
            ['email' => 'manager.ops@sintasv1.test'],
            [
                'name' => 'Manager Operations',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'operations',
                'position' => 'Manager',
                'level' => 'Senior',
            ]
        );

        User::updateOrCreate(
            ['email' => 'supervisor.sales@sintasv1.test'],
            [
                'name' => 'Supervisor Sales',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'sales-marketing',
                'position' => 'Supervisor',
                'level' => 'Mid',
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff.finance@sintasv1.test'],
            [
                'name' => 'Staff Finance',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'finance',
                'position' => 'Staff',
                'level' => 'Junior',
            ]
        );

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

        User::updateOrCreate(
            ['email' => 'academic.coord@sintasv1.test'],
            [
                'name' => 'Academic Coordinator',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
                'department' => 'academic',
                'position' => 'Manager',
                'level' => 'Senior',
            ]
        );

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

        // PR Department users
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

        // Call other seeders
        $this->call([
            HrSeeder::class,
            ServiceSeeder::class,
            ProgramCsvSeeder::class,
            AttendanceSeeder::class,
        ]);
    }
}
