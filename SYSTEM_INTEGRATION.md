# SISTEM INTEGRASI SIBALI.ID - SIMY, SITRA, SINTAS
## Integration & Data Flow Documentation

---

## 📋 Ringkasan Integrasi

Sistem SIBALI.ID terdiri dari 3 subsistem terintegrasi yang berbagi database terpusat:
- **SIMY** - Student Learning Management System
- **SITRA** - Customer Portal (Parents/Guardians)
- **SINTAS** - Internal Administration System

---

## 🔗 Data Integration Points

### 1. SIMY → SITRA Integration
**Aliran:** Student progress di SIMY ditampilkan ke parent di SITRA

#### Mekanisme:
- Ketika siswa menyelesaikan materi/assignment/quiz di SIMY
- System otomatis update `student_progress` table
- `SystemIntegrationService::syncSimyProgressToSitra()` menciptakan notifikasi untuk parent
- Parent melihat real-time progress update di SITRA dashboard

#### Routes & Controllers:
```
SIMY:
- GET /simy/dashboard (show student progress)
- GET /simy/progress (detailed progress view)
- GET /simy/materials (materials management)
- GET /simy/assignments (assignments list)

SITRA:
- GET /sitra/dashboard (parent dashboard with all children)
- GET /sitra/child/{childId}/academic (child's academic data)
- GET /sitra/child/{childId}/progress (synced from SIMY)
```

---

### 2. SIMY → SINTAS Integration
**Aliran:** Enrollment data dan performance metrics

#### Mekanisme:
- Ketika registration diapprove di SINTAS
- `SystemIntegrationService::activateSimyAccessOnRegistration()` auto-activate SIMY access
- Student mendapat akses materials, assignments, quizzes
- SINTAS dapat track student performance melalui dashboard

#### Routes & Controllers:
```
SINTAS:
- POST /admin/register/approve (activate SIMY access)
- GET /admin/students/{student}/performance (view SIMY progress)
- GET /admin/academic/console (monitor all programs)
```

---

### 3. SITRA → SIMY Integration
**Aliran:** Parent communication forwarded ke student

#### Mekanisme:
- Parent kirim pesan ke teacher melalui SITRA
- Message disimpan di `chat_messages` table dengan `sender_type: 'parent'`
- Student melihat parent's message di SIMY forum/messages
- Creates transparent communication between student, parent, teacher

#### Routes:
```
SITRA:
- POST /sitra/child/{childId}/message/send

SIMY:
- GET /simy/forum (shows all messages including from parents)
```

---

### 4. SINTAS → SIMY Integration
**Aliran:** Attendance sync dan schedule coordination

#### Mekanisme:
- Staff mark attendance di SINTAS pada platform internal
- `SystemIntegrationService::syncSintasAttendanceToSimy()` update class attendance
- Student melihat attendance record di SIMY class info
- Automatic tracking untuk kehadiran di setiap kelas

#### Console Command:
```bash
php artisan sintas:sync-attendance --date=2026-01-22
```

---

### 5. SINTAS → SITRA Integration
**Aliran:** Payment verification dan invoice updates

#### Mekanisme:
- Admin verify payment di SINTAS
- System update `registrations.status` ke 'verified'
- Parent melihat payment status updated di SITRA
- Automatic invoice generation dan receipt download

#### Sistem:
- Payment verification workflow di SINTAS
- Real-time sync ke SITRA payments view
- Notification ke parent when payment verified

---

### 6. SITRA → SINTAS Integration  
**Aliran:** Parent inquiry dan support tickets

#### Mekanisme:
- Parent send message/inquiry via SITRA
- Message logged dengan timestamp dan category
- Admin di SINTAS dapat view dan respond via IT support console
- Parent mendapat notification of response

---

## 📊 Synchronization & Notifications

### Real-time Event System
```php
Events triggered:
- StudentProgressUpdated (SIMY) → Notify parent via SITRA
- AchievementEarned (SIMY) → Broadcast to parent via SITRA
- CertificateIssued (SIMY) → Notify parent and SINTAS admin
- AttendanceRecorded (SINTAS) → Update SIMY class record
- PaymentVerified (SINTAS) → Update SITRA payment status
- MessageReceived (SIMY/SITRA) → Cross-system notification
```

### Notification Types
| Event | From | To | Type |
|-------|------|-----|------|
| Progress Update | SIMY | SITRA | Email, Push |
| Achievement | SIMY | SITRA | Email, Push, Push Notif |
| Certificate | SIMY | SITRA | Email, Download Link |
| Attendance | SINTAS | SIMY | Automatic Sync |
| Payment Status | SINTAS | SITRA | Email, SMS, Push |
| Teacher Message | SIMY | SITRA | Push, Email |
| Support Reply | SINTAS | SITRA | Push, Email |

---

## 🔐 Access Control & Authorization

### Role-based Access:

**Student (SIMY)**
- View own progress, materials, assignments
- Cannot access other students' data
- View parent messages in messages section

**Parent/Guardian (SITRA)**
- View all assigned children data
- Cannot view other children
- Can message teacher (forwarded to SIMY)

**Staff/Admin (SINTAS)**
- View all programs, students, registrations
- Can view aggregated performance metrics
- Can verify payments
- Access all department dashboards

**Superadmin (SINTAS)**
- Full system access
- Can view all three systems data
- Generate reports
- System configuration

---

## 🛠️ Service Classes

### SystemIntegrationService
Located: `app/Services/SystemIntegrationService.php`

**Methods:**
```php
// SIMY → SITRA
syncSimyProgressToSitra($studentId)
notifyParentOfAchievement($studentId, $achievementId)
notifyParentOfCompletion($studentId, $certificateId)

// SIMY ↔ SITRA Messages
syncTeacherMessageToParent($messageId)

// SINTAS → SIMY
activateSimyAccessOnRegistration($registrationId)
syncSintasAttendanceToSimy($userId, $attendanceId)

// Cross-system data retrieval
getStudentComprehensiveData($studentId)
getStaffPerformanceMetrics($staffId)
```

---

## 📟 Console Commands

### SIMY Commands
```bash
# Generate report untuk satu siswa
php artisan simy:generate-report {student_id}

# Update progress untuk semua siswa
php artisan simy:update-progress
```

### SITRA Commands
```bash
# Send payment reminders ke parent
php artisan sitra:payment-reminders --days=7
```

### SINTAS Commands
```bash
# Sync attendance dari sistem internal
php artisan sintas:sync-attendance --date=2026-01-22
```

---

## 🔄 Data Flow Diagrams

### Registration → Access Activation
```
Website Registration
    ↓
SINTAS: Create Registration
    ↓
Payment Verification
    ↓
SINTAS: Approve Registration
    ↓
SystemIntegrationService::activateSimyAccessOnRegistration()
    ↓
SIMY: Create StudentProgress record
    ↓
SIMY: Auto-enroll student to program
    ↓
Student gets SIMY access
Parent gets SITRA notification
```

### Daily Progress Sync
```
SIMY: Student completes assignment
    ↓
Assignment marked as submitted
    ↓
Automatic progress calculation
    ↓
student_progress table updated
    ↓
Event: StudentProgressUpdated fired
    ↓
SystemIntegrationService::syncSimyProgressToSitra()
    ↓
Notification created in notifications table
    ↓
SITRA: Parent sees updated progress dashboard
    ↓
Email/Push sent to parent
```

---

## 🚀 Integration Testing

### Test Student Workflow
1. Register student via website
2. Verify registration in SINTAS admin
3. Approve & verify payment in SINTAS
4. Check SIMY access activated
5. Student access SIMY, complete materials
6. Check SITRA dashboard updates in real-time
7. Verify parent receives notifications

### Test Staff Workflow
1. Staff login to SINTAS
2. View programs, registrations
3. Verify payment in SINTAS
4. View SIMY analytics in dashboard
5. Check attendance sync
6. Respond to parent inquiries

### Test Parent Workflow
1. Parent login to SITRA
2. View all children enrolled
3. Check academic progress (synced from SIMY)
4. View payment history (synced from SINTAS)
5. Send message to teacher
6. Check notifications for updates

---

## ⚙️ Configuration

### Database Relationships
```
User (1) → Many StudentProgress
User (1) → Many Attendance  
User (1) → Many ChatMessage
Program (1) → Many StudentProgress
Registration (1) → Many PaymentProof
StudentProgress (1) → Many StudentAchievement
StudentProgress (1) → Many StudentCertificate
```

### Notification Channels
- Email (Laravel Mail)
- Database (Notification model)
- Push (optional service)
- SMS (optional Twilio/vendor)

---

## 📝 API Endpoints for Integration

### SIMY Public API (for external sync)
```
GET /api/simy/student/{id}/progress
GET /api/simy/student/{id}/achievements
GET /api/simy/program/{id}/analytics
```

### SITRA Internal API
```
GET /api/sitra/child/{id}/academic-summary
GET /api/sitra/child/{id}/payment-status
POST /api/sitra/notification/{id}/mark-read
```

### SINTAS Internal API
```
GET /api/sintas/registrations/{id}/status
POST /api/sintas/payment/{id}/verify
GET /api/sintas/analytics/student-performance
```

---

## 🔍 Monitoring & Debugging

### Check Integration Status
```php
// In tinker or test
$service = app(SystemIntegrationService::class);
$data = $service->getStudentComprehensiveData(1);
// Returns full student data across all systems
```

### View Sync Logs
```
Check notifications table for all triggered notifications
Check audit_logs for all system actions
Monitor jobs queue for failed syncs
```

---

## 📚 Additional Resources

- [SIMY Documentation](SIMY_PROJECT_COMPLETION_REPORT.md)
- [SINTAS Routes Configuration](routes/web.php)
- [System Models](app/Models/)
- [Service Layer](app/Services/)
- [Console Commands](app/Console/Commands/)

---

Generated: 2026-01-22
Last Updated: 2026-01-22
