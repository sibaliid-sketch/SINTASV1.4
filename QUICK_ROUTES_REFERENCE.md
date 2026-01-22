# 🚀 QUICK REFERENCE - ROUTES GUIDE

**Tanggal:** 22 Januari 2026
**Purpose:** Quick lookup untuk semua routes sistem

---

## 🎯 ENTRY POINTS PER SISTEM

### SINTAS (Sistem Terintegrasi Organisasi)
```
Public Entry:      /sintas
Public Welcome:    /sintas/welcome
Authenticated:     /sintas → redirects ke department
Quick Jump:        /overview
```

### SIMY (Student Learning Management)
```
Public Entry:      /simy
Authenticated:     /simy/dashboard
Quick Access:      /simy/materials, /simy/assignments, /simy/quizzes
```

### SITRA (Customer Portal - Parent)
```
Public Entry:      /sitra
Public Welcome:    /sitra/welcome
Authenticated:     /sitra/dashboard
Child Portal:      /sitra/child/{childId}/*
```

### Admin Panel
```
Academic:          /admin/academic/console
Services:          /admin/services
Programs:          /admin/programs
Schedules:         /admin/schedules
```

---

## 📍 DEPARTMENT ROUTES (SINTAS)

### Quick Access Links
```
Operations:        /departments/operations
Sales Marketing:   /departments/sales-marketing
Finance:           /departments/finance
Product R&D:       /departments/product-rnd
IT:                /departments/it
Academic:          /departments/academic
HR:                /departments/hr
PR:                /departments/pr
Engagement:        /departments/engagement-retention
```

### Per Department Sub-Routes
```
{dept} = one of the 9 departments above

/{dept}/overview   → Department overview with metrics
/{dept}/general    → General information page
/{dept}/hris       → HR Information System
/{dept}/tools      → Department tools and features
```

### Special Routes
```
Operations Chat:        /departments/operations/chat-console
IT Chat:               /departments/it/chat-console
Academic Services:     /departments/academic/services
Academic Programs:     /departments/academic/programs
Academic Schedules:    /departments/academic/schedules
```

---

## 📚 SIMY ROUTES (STUDENT)

### Main Features
```
Dashboard:         /simy/dashboard
Materials:         /simy/materials
                   /simy/materials/{id}
Assignments:       /simy/assignments
                   /simy/assignments/{id}
Submit Work:       /simy/assignments/{id}/submit (POST)
Quizzes:           /simy/quizzes
                   /simy/quizzes/{id}
Start Quiz:        /simy/quizzes/{id}/attempt (GET)
Submit Answers:    /simy/quizzes/{id}/attempt/{attempt} (POST)
Progress:          /simy/progress
Certificates:      /simy/certificates
                   /simy/certificates/{id}
Forum:             /simy/forum
Post Message:      /simy/forum/message (POST)
React to Message:  /simy/messages/{id}/react (POST)
Personal Notes:    /simy/notes (POST/DELETE)
```

---

## 👨‍👩‍👧 SITRA ROUTES (PARENT/GUARDIAN)

### Parent Dashboard
```
Dashboard:         /sitra/dashboard
Settings:          /sitra/settings
Update Prefs:      /sitra/preferences (PATCH)
```

### Per Child Routes
Base: `/sitra/child/{childId}/`

```
Academic Info:     /academic
Attendance:        /attendance
Payments:          /payments
Certificates:      /certificates
Class Schedule:    /schedule
Academic Reports:  /reports
Download Report:   /reports/download/{type}
Messages:          /messages
View Conversation: /conversation/{conversationId}
Send Message:      /message/send (POST)
```

---

## 🔧 ADMIN ROUTES

### Academic Management
```
Console:     /admin/academic/console
Data API:    /admin/academic/data
```

### Services CRUD
```
List:        GET /admin/services
Create:      GET /admin/services/create
Store:       POST /admin/services
View:        GET /admin/services/{id}
Edit:        GET /admin/services/{id}/edit
Update:      PUT /admin/services/{id}
Delete:      DELETE /admin/services/{id}
Toggle:      PATCH /admin/services/{id}/toggle
```

### Programs CRUD
```
List:           GET /admin/programs
Create:         GET /admin/programs/create
Store:          POST /admin/programs
View:           GET /admin/programs/{id}
Edit:           GET /admin/programs/{id}/edit
Update:         PUT /admin/programs/{id}
Delete:         DELETE /admin/programs/{id}
Toggle:         PATCH /admin/programs/{id}/toggle
By Service:     GET /admin/programs/service/{service}
```

### Schedules CRUD
```
List:           GET /admin/schedules
Create:         GET /admin/schedules/create
Store:          POST /admin/schedules
View:           GET /admin/schedules/{id}
Edit:           GET /admin/schedules/{id}/edit
Update:         PUT /admin/schedules/{id}
Delete:         DELETE /admin/schedules/{id}
Toggle:         PATCH /admin/schedules/{id}/toggle
By Program:     GET /admin/schedules/program/{program}
Calendar:       GET /admin/schedules/calendar
```

---

## 🔐 AUTHENTICATION & PROFILE

### Auth Routes
```
Login:                 /login (GET/POST)
Register:              /register (GET/POST)
Forgot Password:       /forgot-password (GET/POST)
Reset Password:        /reset-password/{token} (GET/POST)
Email Verification:    /email/verify (GET/POST)
```

### Profile Routes
```
View:                  GET /profile
Update:                PATCH /profile
Upload Avatar:         POST /profile/avatar
Update Preferences:    POST /profile/preferences
Delete Account:        DELETE /profile
```

### Social Auth
```
Redirect to Google:    GET /auth/google
Google Callback:       GET /auth/google/callback
Disconnect Google:     POST /google/disconnect
```

---

## 📝 REGISTRATION (11-STEP FLOW)

### Steps
```
Step 1:    GET/POST  /register/step1
Step 2:    GET/POST  /register/step2
Step 3:    GET/POST  /register/step3
Step 4:    GET/POST  /register/step4
Step 5:    GET/POST  /register/step5
Step 6:    GET/POST  /register/step6
Step 7:    GET/POST  /register/step7
Step 8:    GET/POST  /register/step8
Step 9:    GET/POST  /register/step9
Step 10:   GET/POST  /register/step10/{registration}
Step 11:   GET/POST  /register/step11/{registration}
Verify OTP: POST     /register/step11/{registration}/verify-otp
```

### API Endpoints
```
Get Services:      GET /register/api/services
Get Programs:      GET /register/api/programs
Get Schedules:     GET /register/api/schedules/{program}
Validate Promo:    POST /register/api/validate-promo
```

---

## 💬 MESSAGING & CHAT

### User Chat
```
Send Message:      POST /chat/send
Get Messages:      GET /chat/messages
```

### Admin Chat Console
```
Open Console:      GET /admin/chat/{department}
Send Message:      POST /admin/chat/{department}/send
```

### Department Chat
```
Get Messages:      GET /departments/{dept}/chat/messages/{user}
Chat Console:      GET /departments/{ops|it}/chat-console
```

---

## 🏠 GENERAL ROUTES

### Public Pages
```
Home:              GET /
Welcome Guest:     GET /welcome-guest
About:             GET /about
Services:          GET /services
Contact:           GET /contact
Events:            GET /event
Articles:          GET /articles
Article Detail:    GET /articles/{slug}
```

### Authenticated Pages
```
Dashboard:         GET /dashboard
Profile:           GET /profile
Attendance:        GET /attendance
```

### Newsletter
```
Subscribe:         POST /newsletter/subscribe
```

---

## 🔗 ROUTE NAMING CONVENTION

### Pattern
```
route('sintas')                    → /sintas
route('sintas.welcome')            → /sintas/welcome
route('departments.operations')    → /departments/operations
route('departments.operations.overview') → /departments/operations/overview
route('simy.dashboard')            → /simy/dashboard
route('sitra.dashboard')           → /sitra/dashboard
route('sitra.child.academic', ['childId' => 1]) → /sitra/child/1/academic
route('admin.services.index')      → /admin/services
route('admin.services.create')     → /admin/services/create
route('admin.services.store')      → /admin/services (POST)
```

### In Blade Templates
```php
{{ route('simy.dashboard') }}
{{ route('sitra.child.academic', ['childId' => $child->id]) }}
{{ route('admin.programs.edit', $program) }}
{{ route('register.step1') }}
```

---

## 📊 ROUTE STATISTICS QUICK LOOKUP

```
Total Routes:             250+
Public Routes:            40
Protected Routes:         190
Admin Routes:             20

By System:
SINTAS:                   105+
SIMY:                     18+
SITRA:                    15+
Admin:                    40+
General:                  25+
Auth:                     15+
API:                      20+
Chat:                     5+

By Method:
GET:                      140+
POST:                     50+
PATCH/PUT:                35+
DELETE:                   15+
```

---

## ✅ QUICK VERIFICATION CHECKLIST

### Daily Development
- [ ] Use named routes in views: `route('name')`
- [ ] Add middleware to protected routes
- [ ] Group related routes with prefix
- [ ] Use RESTful naming for CRUD operations
- [ ] Test route generation: `php artisan route:list`

### Before Deployment
- [ ] Run `php artisan route:clear`
- [ ] Verify all cross-system links work
- [ ] Test all department routes (9)
- [ ] Test child routes with parameter
- [ ] Check admin authorization

### Troubleshooting
```bash
# List all routes
php artisan route:list

# List specific routes
php artisan route:list --name=simy

# Clear route cache
php artisan route:clear

# Cache routes for production
php artisan route:cache
```

---

## 🎓 COMMON PATTERNS

### Accessing Routes with Parameters
```php
// Single parameter
route('articles.show', $article->slug)
→ /articles/my-article

// Multiple parameters
route('sitra.child.academic', ['childId' => 1])
→ /sitra/child/1/academic

// Model binding (auto-extracts ID)
route('admin.services.edit', $service)
→ /admin/services/5/edit

// Array parameters
route('admin.services.destroy', ['service' => $service->id])
→ /admin/services/5 (DELETE)
```

### Conditional Routes
```php
@if(auth()->check())
  <a href="{{ route('sitra.dashboard') }}">SITRA</a>
@else
  <a href="{{ route('login') }}">Login</a>
@endif
```

### API Calls
```javascript
// Get services
fetch('/register/api/services')
  .then(r => r.json())
  .then(data => console.log(data))

// Validate promo
fetch('/register/api/validate-promo', {
  method: 'POST',
  body: JSON.stringify({promo_code: 'SUMMER2026'})
})
```

---

## 📞 NEED MORE INFO?

See these comprehensive documents for details:
- **ROUTES_AUDIT_REPORT.md** - Detailed analysis
- **ROUTES_IMPLEMENTATION_GUIDE.md** - Implementation details
- **ROUTES_TESTING_CHECKLIST.md** - Testing guide
- **ROUTES_AUDIT_EXECUTIVE_SUMMARY.md** - Executive summary

---

**Last Updated:** 22 Januari 2026
**Status:** ✅ Ready for Reference
