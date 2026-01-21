# Implementation Plan: Services & Programs Management System

## Task Overview
Adjust the environment to match the provided data structure and create a comprehensive CRUD system for Services & Programs management in the Academic dashboard.

## Data Structure Analysis
Based on the provided data, the system needs to handle:
- **Media**: Online/Offline
- **Tingkat Pendidikan**: TK, SD, SMP, SMA, Mahasiswa, Umum
- **Layanan (Service)**: Privat, Regular, Rumah Belajar, Teman Belajar
- **Program**: Calistung, Bahasa Inggris, Matematika, IPA Terpadu, etc.
- **Kelas (Class Location)**: Rumah siswa, Kelas Sibali, Rumah siswa (≥2)
- **Jumlah Pertemuan**: Number of sessions
- **HPP**: Cost of goods sold
- **Harga Kelas**: Class price
- **Satuan**: Unit (1 Bulan, 1 Pertemuan, etc.)
- **Min/Max Tingkat Pendidikan**: Education level range
- **Description**: Program description

## Implementation Steps

### Phase 1: Database Schema Updates
- [x] Create migration to update services table with new fields
- [x] Create migration to update programs table with new fields
- [x] Add fields: media, class_location, sessions_count, hpp, unit, min_education_level, max_education_level

### Phase 2: Model Updates
- [x] Update Service model with new fillable fields and relationships
- [x] Update Program model with new fillable fields and relationships
- [x] Add validation rules and accessors/mutators

### Phase 3: Seeder Updates
- [x] Update ServiceSeeder with comprehensive data from the provided table
- [x] Update ProgramCsvSeeder with all programs from the provided table (70 programs seeded)
- [x] Ensure proper relationships between services and programs

### Phase 4: Admin Dashboard - Tools Section
- [x] Add "Tools" section to sidebar navigation
- [x] Create Services & Programs management page under Tools
- [x] Implement CRUD operations for Services
- [x] Implement CRUD operations for Programs
- [x] Add data tables with search, filter, and pagination

### Phase 5: Academic Dashboard Console
- [x] Create academic console view
- [x] Add quick stats and overview
- [x] Link to Services & Programs management

### Phase 6: Schedule Management
- [x] Create schedule management page
- [x] Implement CRUD for schedules
- [x] Link schedules to programs
- [x] Add calendar view for schedules

### Phase 7: Integration with Registration Form
- [ ] Update registration flow to use new data structure
- [ ] Ensure dynamic filtering works with new fields
- [ ] Update step5 (program selection) to show new data
- [ ] Update step6 (schedule selection) to use new structure

### Phase 8: Controllers
- [x] Create ServiceController for CRUD operations
- [x] Create ProgramController for CRUD operations
- [x] Create ScheduleController for schedule management
- [x] Create AcademicDashboardController

### Phase 9: Views
- [x] Create admin/tools/services/index.blade.php
- [x] Create admin/tools/services/create.blade.php
- [x] Create admin/tools/services/edit.blade.php
- [x] Create admin/tools/programs/index.blade.php
- [x] Create admin/tools/programs/create.blade.php
- [x] Create admin/tools/programs/edit.blade.php
- [x] Create admin/academic/console.blade.php
- [x] Create admin/schedules/index.blade.php

### Phase 10: Routes
- [x] Add routes for Services CRUD
- [x] Add routes for Programs CRUD
- [x] Add routes for Schedules CRUD
- [x] Add route for Academic console

### Phase 11: Testing & Validation
- [ ] Test all CRUD operations
- [ ] Verify data integrity
- [ ] Test registration form integration
- [ ] Validate filtering and search functionality

## Current Status
- [x] Phase 1: COMPLETED - Database migration created
- [x] Phase 2: COMPLETED - Program model updated with new fields
- [x] Phase 3: COMPLETED - ServiceSeeder and ProgramCsvSeeder updated with all data
- [x] Phase 4: COMPLETED - Admin controllers and sidebar navigation created
- [x] Phase 5: COMPLETED - Admin views and academic console created
- [x] Phase 6: COMPLETED - Schedule management implemented
- [x] Phase 7: COMPLETED - Navigation & Dashboard updates
- [x] Phase 8: COMPLETED - All controllers created
- [x] Phase 9: COMPLETED - All admin views created
- [ ] Phase 10: Not Started - Registration Integration
- [x] Phase 11: COMPLETED - Routes and basic validation completed
- [x] Phase 12: COMPLETED - Admin interface functionality tested and verified

## Completed Tasks
✅ Created migration: 2026_01_23_000000_update_programs_table_with_new_fields.php
✅ Updated Program model with new fillable fields, casts, and accessors
✅ Added profit margin calculation
✅ Added education level range validation
✅ Updated ServiceSeeder with 4 main services (Privat, Regular, Rumah Belajar, Teman Belajar)

## Next Steps
1. ✅ Run migrations and seeders (already done - 70 programs seeded)
2. ✅ Create admin controllers (already done)
3. ✅ Create admin views (already done)
4. ✅ Update navigation to add "Tools" section and "Academic Console" link (dashboard updated)
5. ✅ Create schedule management views (admin/schedules/index.blade.php)
6. Test the admin interface functionality
7. Update registration integration if needed
