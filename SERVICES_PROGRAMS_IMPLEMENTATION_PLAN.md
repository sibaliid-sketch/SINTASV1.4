# Services & Programs Management System - Implementation Plan

## Overview
This document outlines the comprehensive plan to implement a Services & Programs management system based on the provided data structure.

## Data Structure Analysis

### Current Structure
The existing system has:
- **Services Table**: name, code, description, class_mode, education_levels, etc.
- **Programs Table**: service_id, name, description, education_level, class_mode, service_type, duration_weeks, price

### Required Structure (Based on Provided Data)
The new system needs:

| Field | Description | Example Values |
|-------|-------------|----------------|
| Media | Delivery mode | Online, Offline |
| Tingkat Pendidikan | Education level | TK/Sederajat, SD/Sederajat, SMP/Sederajat, SMA/Sederajat, Mahasiswa, Umum |
| Layanan | Service type | Privat, Regular, Rumah Belajar, Teman Belajar |
| Program | Program name | Calistung, Bahasa Inggris, Matematika, IPA Terpadu, etc. |
| Kelas | Class location | Rumah siswa, Kelas Sibali, Rumah siswa (≥2) |
| Jumlah Pertemuan | Number of sessions | 8, 12, 48, 60 |
| HPP | Cost price | 280000, 420000, etc. |
| Harga Kelas | Selling price | 550000, 350000, etc. |
| Satuan | Unit | 1 Bulan, 1 Pertemuan, 3 Bulan, 4 Bulan, 5 Bulan |
| Min. Tingkat Pendidikan | Minimum education level | PAUD/KB, TK B, Kelas 3 SD, etc. |
| Maks. Tingkat Pendidikan | Maximum education level | TK B, Kelas 6 SD, Kelas 9 SMP, etc. |
| Desc | Description | Program description text |

## Database Schema Changes

### 1. Update Programs Table
Add new fields to programs table:
```php
- media (enum: 'online', 'offline')
- class_location (string: 'Rumah siswa', 'Kelas Sibali', 'Rumah siswa (≥2)')
- sessions_count (integer: number of sessions)
- hpp (decimal: cost price)
- unit (string: '1 Bulan', '1 Pertemuan', etc.)
- min_education_level (string: minimum education level)
- max_education_level (string: maximum education level)
- Update price field to be selling price
```

### 2. Service-Program Relationship
- Service represents: Privat, Regular, Rumah Belajar, Teman Belajar
- Program represents: Calistung, Bahasa Inggris, Matematika, etc.
- Each program belongs to a service
- Each program has specific education level, media, and class location

## Implementation Phases

### Phase 1: Database Migration (Priority: HIGH)
**Files to Create/Modify:**
1. `database/migrations/2026_01_23_000000_update_programs_table_with_new_fields.php`
   - Add: media, class_location, sessions_count, hpp, unit, min_education_level, max_education_level
   - Modify: Ensure price field is for selling price

**Tasks:**
- [x] Plan migration structure
- [ ] Create migration file
- [ ] Test migration up/down
- [ ] Run migration

### Phase 2: Model Updates (Priority: HIGH)
**Files to Modify:**
1. `app/Models/Program.php`
   - Add new fillable fields
   - Add casts for decimal fields
   - Add accessors for formatted prices
   - Add scopes for filtering

2. `app/Models/Service.php`
   - Verify relationship with programs
   - Add helper methods if needed

**Tasks:**
- [ ] Update Program model
- [ ] Update Service model
- [ ] Add validation rules
- [ ] Test model relationships

### Phase 3: Seeders (Priority: HIGH)
**Files to Create/Modify:**
1. `database/seeders/ServiceSeeder.php`
   - Update with 4 main services: Privat, Regular, Rumah Belajar, Teman Belajar

2. `database/seeders/ProgramDataSeeder.php`
   - Add all 70+ programs from provided data
   - Ensure proper service relationships
   - Include all new fields

**Tasks:**
- [ ] Update ServiceSeeder
- [ ] Create comprehensive ProgramDataSeeder
- [ ] Test seeding process
- [ ] Verify data integrity

### Phase 4: Controllers (Priority: HIGH)
**Files to Create:**
1. `app/Http/Controllers/Admin/ServiceController.php`
   - index, create, store, edit, update, destroy
   - API endpoints for filtering

2. `app/Http/Controllers/Admin/ProgramController.php`
   - index, create, store, edit, update, destroy
   - API endpoints for filtering
   - Bulk import functionality

3. `app/Http/Controllers/Admin/AcademicDashboardController.php`
   - console view
   - statistics and overview

4. `app/Http/Controllers/Admin/ScheduleController.php`
   - CRUD for schedules
   - Calendar view

**Tasks:**
- [ ] Create ServiceController
- [ ] Create ProgramController
- [ ] Create AcademicDashboardController
- [ ] Create ScheduleController
- [ ] Add validation and authorization

### Phase 5: Views - Admin Tools (Priority: HIGH)
**Files to Create:**

**Services Management:**
1. `resources/views/admin/tools/services/index.blade.php`
   - List all services with search/filter
   - Actions: Create, Edit, Delete

2. `resources/views/admin/tools/services/create.blade.php`
   - Form to create new service

3. `resources/views/admin/tools/services/edit.blade.php`
   - Form to edit existing service

**Programs Management:**
4. `resources/views/admin/tools/programs/index.blade.php`
   - List all programs with advanced filtering
   - Filter by: service, education level, media, class location
   - Actions: Create, Edit, Delete, Bulk Import

5. `resources/views/admin/tools/programs/create.blade.php`
   - Form to create new program with all fields

6. `resources/views/admin/tools/programs/edit.blade.php`
   - Form to edit existing program

**Tasks:**
- [ ] Create services views
- [ ] Create programs views
- [ ] Add DataTables for listing
- [ ] Implement search and filtering
- [ ] Add export functionality

### Phase 6: Views - Academic Dashboard (Priority: MEDIUM)
**Files to Create:**
1. `resources/views/admin/academic/console.blade.php`
   - Overview statistics
   - Quick links to tools
   - Recent activities

2. `resources/views/admin/schedules/index.blade.php`
   - Schedule management
   - Calendar view
   - Filter by program, date range

**Tasks:**
- [ ] Create academic console
- [ ] Create schedule management views
- [ ] Add calendar component
- [ ] Implement schedule CRUD

### Phase 7: Navigation Updates (Priority: MEDIUM)
**Files to Modify:**
1. `resources/views/layouts/navigation.blade.php`
   - Add "Tools" dropdown in admin navigation
   - Add "Academic Console" link

2. `resources/views/dashboard.blade.php`
   - Add link to Academic Console for admin users
   - Add link to Tools section

**Tasks:**
- [ ] Update navigation with Tools section
- [ ] Add Academic Console link
- [ ] Update dashboard cards

### Phase 8: Routes (Priority: HIGH)
**Files to Modify:**
1. `routes/web.php`
   - Add routes for Services CRUD
   - Add routes for Programs CRUD
   - Add routes for Schedules CRUD
   - Add route for Academic Console

**Route Structure:**
```php
// Admin Tools - Services & Programs
Route::middleware(['auth', 'admin'])->prefix('admin/tools')->name('admin.tools.')->group(function () {
    // Services
    Route::resource('services', ServiceController::class);
    
    // Programs
    Route::resource('programs', ProgramController::class);
    Route::post('programs/bulk-import', [ProgramController::class, 'bulkImport'])->name('programs.bulk-import');
});

// Academic Dashboard
Route::middleware(['auth', 'admin'])->prefix('admin/academic')->name('admin.academic.')->group(function () {
    Route::get('/console', [AcademicDashboardController::class, 'console'])->name('console');
});

// Schedules
Route::middleware(['auth', 'admin'])->prefix('admin/schedules')->name('admin.schedules.')->group(function () {
    Route::resource('/', ScheduleController::class);
});
```

**Tasks:**
- [ ] Add service routes
- [ ] Add program routes
- [ ] Add schedule routes
- [ ] Add academic console route
- [ ] Add middleware protection

### Phase 9: Registration Form Integration (Priority: MEDIUM)
**Files to Modify:**
1. `app/Http/Controllers/RegistrationControllerNew.php`
   - Update filtering logic to use new fields
   - Ensure compatibility with new data structure

2. `resources/views/registration/step5-program-selection.blade.php`
   - Display new program information
   - Show HPP, sessions count, unit, etc.

3. `resources/views/registration/step6-schedule-selection.blade.php`
   - Update to work with new schedule structure

**Tasks:**
- [ ] Update registration controller
- [ ] Update program selection view
- [ ] Update schedule selection view
- [ ] Test registration flow

### Phase 10: API Endpoints (Priority: MEDIUM)
**Files to Create/Modify:**
1. Add API endpoints for dynamic data loading
   - GET /api/admin/services - List services
   - GET /api/admin/programs - List programs with filters
   - GET /api/admin/programs/{id} - Get program details
   - POST /api/admin/programs/validate - Validate program data

**Tasks:**
- [ ] Create API endpoints
- [ ] Add JSON responses
- [ ] Implement filtering
- [ ] Add pagination

### Phase 11: Testing & Validation (Priority: HIGH)
**Tasks:**
- [ ] Test all CRUD operations
- [ ] Verify data integrity
- [ ] Test filtering and search
- [ ] Test registration integration
- [ ] Validate permissions
- [ ] Test on different browsers
- [ ] Performance testing

## Key Features to Implement

### 1. Services Management
- Create, Read, Update, Delete services
- Activate/Deactivate services
- View programs under each service

### 2. Programs Management
- Create, Read, Update, Delete programs
- Advanced filtering (by service, education level, media, etc.)
- Bulk import from CSV/Excel
- Export to CSV/Excel
- Duplicate program feature
- Activate/Deactivate programs

### 3. Schedule Management
- Create schedules for programs
- Calendar view
- Filter by program, date, instructor
- Manage capacity and availability

### 4. Academic Console
- Dashboard with statistics
- Quick access to tools
- Recent activities log
- Reports and analytics

## Data Validation Rules

### Program Validation
```php
'service_id' => 'required|exists:services,id',
'name' => 'required|string|max:255',
'description' => 'required|string',
'education_level' => 'required|string',
'media' => 'required|in:online,offline',
'class_location' => 'required|string',
'sessions_count' => 'required|integer|min:1',
'hpp' => 'required|numeric|min:0',
'price' => 'required|numeric|min:0|gte:hpp',
'unit' => 'required|string',
'min_education_level' => 'nullable|string',
'max_education_level' => 'nullable|string',
'is_active' => 'boolean',
```

## Success Criteria
- [ ] All 70+ programs from provided data are seeded correctly
- [ ] CRUD operations work for Services and Programs
- [ ] Academic console is accessible and functional
- [ ] Schedule management is operational
- [ ] Registration form integrates seamlessly
- [ ] Data filtering works correctly
- [ ] All validations are in place
- [ ] User permissions are enforced
- [ ] System is tested and stable

## Timeline Estimate
- Phase 1-3 (Database & Models): 2-3 hours
- Phase 4-5 (Controllers & Views): 4-5 hours
- Phase 6-8 (Dashboard & Routes): 2-3 hours
- Phase 9-10 (Integration & API): 2-3 hours
- Phase 11 (Testing): 2-3 hours

**Total Estimated Time: 12-17 hours**

## Next Steps
1. Get user confirmation on the plan
2. Start with Phase 1: Database Migration
3. Proceed sequentially through phases
4. Test after each phase
5. Document changes and updates
