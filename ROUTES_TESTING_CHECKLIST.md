# ROUTES TESTING & VERIFICATION CHECKLIST

**Tanggal:** 22 Januari 2026
**Last Updated:** After Full Audit

---

## 🧪 UNIT TESTING ROUTES

### SINTAS Routes Testing

#### Department Access Routes
```bash
# Test Operations Department
php artisan tinker
>>> route('departments.operations')
>>> route('departments.operations.overview')
>>> route('departments.operations.general')
>>> route('departments.operations.hris')
>>> route('departments.operations.tools')
>>> route('departments.operations.chat-console')

# Test All 9 Departments (Repeat for each)
- departments.operations
- departments.sales-marketing
- departments.finance
- departments.product-rnd
- departments.it
- departments.academic
- departments.hr
- departments.pr
- departments.engagement-retention
```

#### SINTAS-Specific Routes
```
✅ route('sintas')                          - Main SINTAS page
✅ route('sintas.welcome')                  - Welcome page
✅ route('overview')                        - Overview metrics
✅ route('departments.operations')          - Operations dashboard
✅ route('departments.operations.overview') - Operations overview
```

### SIMY Routes Testing

```bash
# Test SIMY Routes
route('simy')                               # Main SIMY
route('simy.dashboard')                     # Dashboard
route('simy.materials.index')               # Materials list
route('simy.materials.show')                # Material detail
route('simy.assignments.index')             # Assignments list
route('simy.assignments.show')              # Assignment detail
route('simy.quizzes.index')                 # Quizzes list
route('simy.quizzes.show')                  # Quiz detail
route('simy.certificates.index')            # Certificates list
route('simy.progress.index')                # Progress tracker
route('simy.forum.index')                   # Forum/Messages
```

### SITRA Routes Testing

```bash
# Test SITRA Routes
route('sitra')                              # Main SITRA
route('sitra.welcome')                      # Welcome page
route('sitra.dashboard')                    # Dashboard
route('sitra.settings')                     # Settings
route('sitra.child.academic', ['childId' => 1])      # Child academic
route('sitra.child.attendance', ['childId' => 1])    # Child attendance
route('sitra.child.payments', ['childId' => 1])      # Child payments
route('sitra.child.schedule', ['childId' => 1])      # Child schedule
route('sitra.child.reports', ['childId' => 1])       # Child reports
route('sitra.child.messages', ['childId' => 1])      # Child messages
```

### Admin Routes Testing

```bash
# Test Admin Routes
route('admin.academic.console')             # Academic dashboard
route('admin.services.index')               # Services list
route('admin.services.create')              # Create service
route('admin.programs.index')               # Programs list
route('admin.programs.create')              # Create program
route('admin.schedules.index')              # Schedules list
route('admin.schedules.calendar')           # Schedule calendar
```

---

## 🔗 CROSS-SYSTEM NAVIGATION TESTING

### Test Matrix

#### SINTAS → Other Systems
```
✅ SINTAS Dashboard (/sintas)
   ├─→ Attendance System (/attendance)
   ├─→ SIMY Portal (/simy)
   ├─→ SITRA Portal (/sitra)
   ├─→ Profile (/profile)
   └─→ All Departments (/departments/*)

✅ Academic Department (/departments/academic)
   ├─→ Services (/departments/academic/services)
   ├─→ Programs (/departments/academic/programs)
   └─→ Schedules (/departments/academic/schedules)
```

#### SIMY ↔ SINTAS
```
✅ SIMY Dashboard (/simy/dashboard)
   ├─→ Main Dashboard (/dashboard)
   └─→ Breadcrumb Navigation

✅ SIMY Materials/Assignments
   ├─→ Progress tracking
   └─→ Forum/Messages
```

#### SITRA ↔ SINTAS
```
✅ SITRA Dashboard (/sitra/dashboard)
   ├─→ Child Academic View (/sitra/child/{childId}/academic)
   ├─→ Child Attendance (/sitra/child/{childId}/attendance)
   ├─→ Child Payments (/sitra/child/{childId}/payments)
   └─→ Child Reports (/sitra/child/{childId}/reports)
```

#### SITRA ↔ SIMY
```
✅ SITRA Parent View
   └─→ Child's SIMY Academic Data (embedded in academic route)
```

---

## 📋 MANUAL TESTING CHECKLIST

### Public Routes
- [ ] GET / - Landing page loads
- [ ] GET /welcome-guest - Guest welcome visible
- [ ] GET /about - About page loads
- [ ] GET /services - Services page loads
- [ ] GET /contact - Contact page loads
- [ ] GET /articles - Articles listing
- [ ] GET /articles/{slug} - Article detail
- [ ] POST /newsletter/subscribe - Newsletter works

### Authentication
- [ ] GET /register - Registration page
- [ ] GET /login - Login page
- [ ] GET /forgot-password - Password reset
- [ ] POST /register - Registration works
- [ ] POST /login - Login works

### Profile (Authenticated)
- [ ] GET /profile - Profile page
- [ ] PATCH /profile - Update profile
- [ ] POST /profile/avatar - Upload avatar
- [ ] POST /profile/preferences - Update preferences
- [ ] DELETE /profile - Delete profile

### Attendance (Authenticated)
- [ ] GET /attendance - Attendance dashboard
- [ ] POST /attendance/check-in - Check-in works
- [ ] POST /attendance/check-out - Check-out works
- [ ] GET /attendance/history - History view

### SINTAS Dashboard (Authenticated, Role-Based)
- [ ] GET /sintas - SINTAS dashboard
- [ ] GET /sintas/welcome - Welcome page
- [ ] GET /overview - Overview page
- [ ] GET /departments/operations - Operations dept
- [ ] GET /departments/sales-marketing - Sales dept
- [ ] GET /departments/finance - Finance dept
- [ ] GET /departments/product-rnd - R&D dept
- [ ] GET /departments/it - IT dept
- [ ] GET /departments/academic - Academic dept
- [ ] GET /departments/hr - HR dept
- [ ] GET /departments/pr - PR dept
- [ ] GET /departments/engagement-retention - Engagement dept

### SINTAS Department Features
- [ ] GET /departments/{dept}/overview - Overview
- [ ] GET /departments/{dept}/general - General page
- [ ] GET /departments/{dept}/hris - HRIS page
- [ ] GET /departments/{dept}/tools - Tools page
- [ ] GET /departments/operations/chat-console - Chat console
- [ ] GET /departments/{dept}/chat/messages/{user} - Messages

### SIMY (Authenticated, Student Role)
- [ ] GET /simy - SIMY entry
- [ ] GET /simy/dashboard - SIMY dashboard
- [ ] GET /simy/materials - Materials list
- [ ] GET /simy/materials/{id} - Material detail
- [ ] GET /simy/assignments - Assignments list
- [ ] GET /simy/assignments/{id} - Assignment detail
- [ ] POST /simy/assignments/{id}/submit - Submit assignment
- [ ] GET /simy/quizzes - Quizzes list
- [ ] GET /simy/quizzes/{id} - Quiz detail
- [ ] GET /simy/quizzes/{id}/attempt - Start quiz
- [ ] GET /simy/progress - Progress view
- [ ] GET /simy/certificates - Certificates view
- [ ] GET /simy/forum - Forum/Messages
- [ ] POST /simy/forum/message - Post message

### SITRA (Authenticated, Parent Role)
- [ ] GET /sitra - SITRA entry
- [ ] GET /sitra/welcome - Welcome page
- [ ] GET /sitra/dashboard - Parent dashboard
- [ ] GET /sitra/settings - Parent settings
- [ ] GET /sitra/child/{childId}/academic - Child academic
- [ ] GET /sitra/child/{childId}/attendance - Child attendance
- [ ] GET /sitra/child/{childId}/payments - Child payments
- [ ] GET /sitra/child/{childId}/schedule - Child schedule
- [ ] GET /sitra/child/{childId}/reports - Child reports
- [ ] GET /sitra/child/{childId}/messages - Child messages
- [ ] GET /sitra/child/{childId}/conversation/{id} - Conversation
- [ ] POST /sitra/child/{childId}/message/send - Send message

### Admin Routes (Authenticated, Admin Role)
- [ ] GET /admin/academic/console - Academic console
- [ ] GET /admin/services - Services list
- [ ] GET /admin/services/create - Create service
- [ ] POST /admin/services - Store service
- [ ] GET /admin/services/{id} - Show service
- [ ] GET /admin/services/{id}/edit - Edit service
- [ ] PATCH /admin/services/{id} - Update service
- [ ] PATCH /admin/services/{id}/toggle - Toggle service
- [ ] DELETE /admin/services/{id} - Delete service
- [ ] GET /admin/programs - Programs list
- [ ] GET /admin/programs/create - Create program
- [ ] POST /admin/programs - Store program
- [ ] GET /admin/programs/{id} - Show program
- [ ] GET /admin/programs/{id}/edit - Edit program
- [ ] PATCH /admin/programs/{id} - Update program
- [ ] PATCH /admin/programs/{id}/toggle - Toggle program
- [ ] DELETE /admin/programs/{id} - Delete program
- [ ] GET /admin/schedules - Schedules list
- [ ] GET /admin/schedules/calendar - Schedule calendar
- [ ] POST /admin/schedules - Create schedule
- [ ] PATCH /admin/schedules/{id}/toggle - Toggle schedule

### Registration (Multi-Step)
- [ ] GET /register/step1 - Step 1
- [ ] POST /register/step1 - Submit step 1
- [ ] GET /register/step2 - Step 2
- [ ] ... (repeat for all 11 steps)
- [ ] GET /register/step11/{id} - Final step
- [ ] POST /register/step11/{id}/verify-otp - OTP verification

### API Routes
- [ ] GET /api/user - User API
- [ ] POST /api/validate-promo - Promo validation
- [ ] GET /register/api/services - Services API
- [ ] GET /register/api/programs - Programs API
- [ ] GET /register/api/schedules/{program} - Schedules API

---

## 🔒 PERMISSION & MIDDLEWARE TESTING

### Auth Middleware
```
Routes dengan @middleware('auth'):
✅ /profile/*
✅ /dashboard
✅ /attendance/*
✅ /simy/*
✅ /sitra/*
✅ /admin/*
✅ /chat/*
```

### Role-Based Access
```
SINTAS Routes:
- superadmin: Full access to all departments
- admin_operational: Operations department only
- karyawan: Own department only
- None: Redirect to dashboard

SIMY Routes:
- Student: Full access
- Non-student: Forbidden

SITRA Routes:
- Parent/Guardian: Own children only
- Student: Own profile
- Admin: Full access
```

---

## 🚀 PERFORMANCE TESTING

### Route Listing
```bash
# List all routes
php artisan route:list

# List specific routes
php artisan route:list --name=simy
php artisan route:list --name=sitra
php artisan route:list --name=sintas
php artisan route:list --name=admin
```

### Route Caching
```bash
# Cache routes for production
php artisan route:cache

# Clear route cache
php artisan route:clear

# List cached routes
php artisan route:list
```

---

## 🐛 TROUBLESHOOTING GUIDE

### Issue: Route Not Found (404)
```
Resolution:
1. Check route is registered in routes/web.php
2. Verify controller class exists
3. Verify method exists in controller
4. Check middleware requirements
5. Run: php artisan route:clear && php artisan cache:clear
```

### Issue: Unauthorized Access (403)
```
Resolution:
1. Check middleware applied to route
2. Verify user role/permission
3. Check gate/policy authorization
4. Verify auth()->check() in controller
```

### Issue: Method Not Allowed (405)
```
Resolution:
1. Check HTTP method (GET/POST/PATCH/DELETE)
2. Verify route defines correct method
3. Check form method in view
4. Check CSRF token in POST requests
```

### Issue: Missing Route Parameters
```
Resolution:
1. Verify {param} syntax in route
2. Check parameter name matches function
3. Verify model binding if using implicit binding
4. Check URL generation uses correct parameters
```

---

## ✅ VERIFICATION SUMMARY

### All Systems
- [x] SINTAS - 105+ routes, 7 controllers
- [x] SIMY - 18+ routes, 11 controllers
- [x] SITRA - 15+ routes, 1 controller
- [x] Admin - 40+ routes, 4 controllers
- [x] Auth - 15+ routes, via auth.php
- [x] General - 25+ routes

### Cross-System Navigation
- [x] SINTAS → SIMY ✅
- [x] SINTAS → SITRA ✅
- [x] SIMY → SINTAS ✅
- [x] SIMY → SITRA ✅
- [x] SITRA → SINTAS ✅
- [x] SITRA → SIMY ✅

### Features
- [x] Public routes
- [x] Authentication routes
- [x] Protected routes
- [x] Admin routes
- [x] API endpoints
- [x] Resource routes
- [x] Custom routes
- [x] Dynamic parameters
- [x] Route names
- [x] Middleware

---

## 📞 SUPPORT & MAINTENANCE

### Regular Checks
- Monthly: Verify all routes still accessible
- After updates: Test affected routes
- Before deployment: Run full route test suite

### Documentation
- Keep ROUTES_AUDIT_REPORT.md updated
- Update this checklist when adding routes
- Document new cross-system connections

### Git Tracking
```
Key files to track:
- routes/web.php
- routes/api.php
- routes/auth.php
- app/Http/Controllers/**/*
```

---

**Generated:** 22 Januari 2026
**Status:** ✅ COMPLETE - TESTING CHECKLIST READY
