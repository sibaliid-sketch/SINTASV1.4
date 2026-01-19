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
        User::factory()->create([
            'name' => 'Student Test',
            'email' => 'student@sintasv1.test',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ]);

        // Guardian user
        User::factory()->create([
            'name' => 'Guardian Test',
            'email' => 'guardian@sintasv1.test',
            'password' => Hash::make('password123'),
            'role' => 'guardian',
        ]);

        // Karyawan users with different departments, positions, levels
        User::factory()->create([
            'name' => 'Executive Admin',
            'email' => 'executive@sintasv1.test',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'department' => 'operations',
            'position' => 'Executive',
            'level' => 'Senior',
        ]);

        User::factory()->create([
            'name' => 'Manager Operations',
            'email' => 'manager.ops@sintasv1.test',
            'password' => Hash::make('password123'),
            'role' => 'karyawan',
            'department' => 'operations',
            'position' => 'Manager',
            'level' => 'Senior',
        ]);

        User::factory()->create([
            'name' => 'Supervisor Sales',
            'email' => 'supervisor.sales@sintasv1.test',
            'password' => Hash::make('password123'),
            'role' => 'karyawan',
            'department' => 'sales-marketing',
            'position' => 'Supervisor',
            'level' => 'Mid',
        ]);

        User::factory()->create([
            'name' => 'Staff Finance',
            'email' => 'staff.finance@sintasv1.test',
            'password' => Hash::make('password123'),
            'role' => 'karyawan',
            'department' => 'finance',
            'position' => 'Staff',
            'level' => 'Junior',
        ]);

        User::factory()->create([
            'name' => 'IT Specialist',
            'email' => 'it.staff@sintasv1.test',
            'password' => Hash::make('password123'),
            'role' => 'karyawan',
            'department' => 'it',
            'position' => 'Staff',
            'level' => 'Senior',
        ]);

        User::factory()->create([
            'name' => 'Academic Coordinator',
            'email' => 'academic.coord@sintasv1.test',
            'password' => Hash::make('password123'),
            'role' => 'karyawan',
            'department' => 'academic',
            'position' => 'Manager',
            'level' => 'Senior',
        ]);
    }
}
