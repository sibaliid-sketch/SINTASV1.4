# 🚀 SIBALI.ID SYSTEM - QUICK START GUIDE
## Testing & Deployment Instructions

---

## 📌 Pre-Deployment Checklist

Before deploying to production, ensure:

```
☐ Database migrations are current (php artisan migrate)
☐ Environment variables are configured (.env file)
☐ Storage directory is writable (storage/ permissions)
☐ Cache is cleared (php artisan cache:clear)
☐ Routes are cached (php artisan route:cache)
☐ Views are cached (php artisan view:cache)
☐ All tests pass (php artisan test)
```

---

## 🧪 Quick Testing Workflow

### Test 1: Verify System Components

**Step 1:** Check Laravel is running
```bash
php artisan serve
# Should start at http://localhost:8000
```

**Step 2:** Verify all routes are registered
```bash
php artisan route:list | findstr "sitra"
# Should show all SITRA routes
```

**Step 3:** Test console commands
```bash
php artisan list | findstr "simy:"
php artisan list | findstr "sitra:"
php artisan list | findstr "sintas:"
# Should show all 4 custom commands
```

---

### Test 2: Student Registration & SIMY Activation

**Workflow:**
1. Open website: `http://localhost:8000/`
2. Student registers through registration form
3. Go to SINTAS admin: `/admin/registrations`
4. Find registration and click "Verify Payment"
5. Click "Approve Registration"

**Expected Outcome:**
- ✅ Registration status → 'verified'
- ✅ SIMY access activated automatically
- ✅ StudentProgress record created
- ✅ Parent receives notification

**Verify with:**
```bash
# Check if StudentProgress was created
php artisan tinker
>>> App\Models\StudentProgress::where('student_id', 1)->first();

# Should return a StudentProgress record
```

---

### Test 3: Parent Access to SITRA

**Workflow:**
1. Parent logs in: `/login`
2. Navigate to `/sitra`
3. Should see dashboard with all children
4. Click on child → view academic info

**Expected Outcome:**
- ✅ Dashboard shows all registered children
- ✅ Academic page shows progress from SIMY
- ✅ Attendance shows synced data
- ✅ Payments shows verified status

**Verify:**
```bash
# Test in browser console
fetch('/sitra')
  .then(r => r.text())
  .then(html => console.log('SITRA Dashboard loads OK'))
  .catch(e => console.error('SITRA Error:', e))
```

---

### Test 4: SIMY → SITRA Progress Sync

**Workflow:**
1. Student logs into SIMY: `/simy/dashboard`
2. Student completes an assignment
3. System auto-updates StudentProgress
4. Parent goes to SITRA dashboard
5. Parent should see updated progress

**Expected Outcome:**
- ✅ Progress percentage increases in SITRA
- ✅ Parent receives notification
- ✅ Dashboard shows real-time update
- ✅ Academic page reflects changes

**Verify with Command:**
```bash
# Manually trigger sync (for testing)
php artisan simy:update-progress

# Should output:
# "Updating student progress for all students..."
# "Student ID: 1 - Progress: 65%"
# "Student progress update completed!"
```

---

### Test 5: SINTAS → SIMY Attendance Sync

**Workflow:**
1. Staff marks attendance in SINTAS: `/admin/attendance`
2. Create attendance record for a student
3. Run sync command
4. Student checks SIMY for attendance

**Expected Outcome:**
- ✅ Attendance record synced to SIMY
- ✅ Student sees updated attendance in SIMY
- ✅ Attendance rate updated in SITRA
- ✅ Parent can view attendance in SITRA

**Verify with Command:**
```bash
# Sync today's attendance
php artisan sintas:sync-attendance

# Or sync specific date
php artisan sintas:sync-attendance --date=2026-01-22

# Should output:
# "Syncing attendance for 22-01-2026"
# "Found X attendance records"
# "Processed: Student Name - Present/Absent"
```

---

### Test 6: Parent Messaging

**Workflow:**
1. Parent logs into SITRA
2. Navigate to `/sitra/child/{childId}/messages`
3. Click "Send Message"
4. Type message to teacher
5. Click Send

**Expected Outcome:**
- ✅ Message saved to database
- ✅ Message appears in SIMY forum
- ✅ Teacher receives notification
- ✅ Message history is maintained

**Verify:**
```bash
# Check ChatMessage table
php artisan tinker
>>> App\Models\ChatMessage::where('sender_type', 'parent')->latest()->first();

# Should show message with timestamp and sender_type = 'parent'
```

---

### Test 7: Payment Verification

**Workflow:**
1. Parent submits payment proof in SITRA
2. Staff verifies in SINTAS admin
3. Parent checks SITRA payment status
4. Staff runs payment sync (if manual)

**Expected Outcome:**
- ✅ Payment status updated to 'verified'
- ✅ SITRA shows payment confirmed
- ✅ Receipt available for download
- ✅ Parent receives confirmation email

**Verify:**
```bash
# Check payment verification
php artisan tinker
>>> App\Models\PaymentProof::find(1);

# Should show status = 'verified'
```

---

## 🛠️ Console Command Testing

### Test All 4 Commands

**1. Generate Student Report (SIMY)**
```bash
php artisan simy:generate-report 1
# Output: Comprehensive report for student ID 1
# Includes: Progress, Achievements, Certificates
```

**2. Update Student Progress (SIMY)**
```bash
php artisan simy:update-progress
# Output: Updates all students' progress percentages
# Recalculates based on materials, assignments, quizzes
```

**3. Sync Attendance (SINTAS)**
```bash
php artisan sintas:sync-attendance --date=2026-01-22
# Output: Syncs attendance from SINTAS to system
# Default: Today's date if --date not specified
```

**4. Send Payment Reminders (SITRA)**
```bash
php artisan sitra:payment-reminders --days=7
# Output: Sends reminders for unpaid registrations due within 7 days
# Default: 7 days if --days not specified
```

---

## 📊 Database Verification

### Check Data Consistency

```bash
php artisan tinker
```

**In Tinker, run:**

```php
# 1. Check StudentProgress exists
App\Models\StudentProgress::count()
// Should return > 0 for tested students

# 2. Check Attendance sync worked
App\Models\Attendance::latest()->first()
// Should show recent records

# 3. Check ChatMessages exist
App\Models\ChatMessage::where('sender_type', 'parent')->count()
// Should return > 0 if messages sent

# 4. Check Notifications
App\Models\Notification::latest()->first()
// Should show recent notifications

# 5. Check PaymentProof status
App\Models\PaymentProof::where('status', 'verified')->count()
// Should show verified payments
```

---

## 🔍 Troubleshooting

### Issue: Routes not found (404)

**Solution:**
```bash
# Clear route cache
php artisan route:cache

# Or verify routes
php artisan route:list | grep "sitra"
```

### Issue: Commands not found

**Solution:**
```bash
# Clear command cache
php artisan package:discover

# Verify commands
php artisan list | grep "simy:"
php artisan list | grep "sitra:"
```

### Issue: Database errors

**Solution:**
```bash
# Check migrations
php artisan migrate:status

# If needed, run fresh migrations
php artisan migrate:fresh --seed
```

### Issue: Permission errors

**Solution:**
```bash
# Fix storage permissions (Windows PowerShell)
icacls storage /grant Everyone:F /T

# Or fix on Linux
chmod -R 755 storage/
```

### Issue: Service class not found

**Solution:**
```bash
# Clear all caches
php artisan optimize:clear

# Regenerate autoloader
composer dump-autoload

# Restart PHP service
```

---

## 🚀 Production Deployment

### Step 1: Pre-Deployment Verification

```bash
# Run all quality checks
php -l app/Http/Controllers/SitraController.php
php -l app/Services/SystemIntegrationService.php
php -l app/Console/Commands/*.php

# All should return "No syntax errors detected"
```

### Step 2: Clear All Caches

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### Step 3: Run Migrations

```bash
php artisan migrate
```

### Step 4: Seed (if needed)

```bash
php artisan db:seed --class=ProductionSeeder
```

### Step 5: Start Services

```bash
# Start Laravel
php artisan serve --host=0.0.0.0 --port=8000

# Or use production server (Nginx/Apache)
# Configure DocumentRoot to point to /public
```

### Step 6: Verify Deployment

```bash
# Test main route
curl http://localhost:8000/

# Test SITRA
curl http://localhost:8000/sitra

# Test API
curl http://localhost:8000/api/health
```

---

## 📅 Schedule Console Commands

### In Production (using Supervisor/Cron)

**Edit `app/Console/Kernel.php`:**

```php
protected function schedule(Schedule $schedule)
{
    // Daily progress updates
    $schedule->command('simy:update-progress')
             ->daily()
             ->at('02:00');
    
    // Daily payment reminders
    $schedule->command('sitra:payment-reminders --days=7')
             ->daily()
             ->at('09:00');
    
    // Hourly attendance sync
    $schedule->command('sintas:sync-attendance')
             ->hourly();
}
```

**Then run in background:**

```bash
# Using Laravel scheduler
php artisan schedule:work

# Or with Supervisor/crontab
* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
```

---

## 📈 Monitoring

### Check System Health

```bash
# View application logs
tail -f storage/logs/laravel.log

# Check running jobs
php artisan queue:failed

# Monitor database
php artisan db:monitor
```

### Performance Monitoring

```bash
# Check route performance
php artisan route:cache && php artisan optimize

# Monitor query performance
# Set LOG_SLOW_QUERIES in .env
LOG_SLOW_QUERIES=true
SLOW_QUERY_THRESHOLD=100
```

---

## 📝 Integration Test Checklist

- [ ] SIMY registration → verification → activation flow
- [ ] Student can access SIMY after registration
- [ ] Parent can see child in SITRA
- [ ] Progress syncs from SIMY to SITRA real-time
- [ ] Attendance syncs from SINTAS to SIMY
- [ ] Parent can send messages to teacher
- [ ] Teacher receives parent messages
- [ ] Payment verification updates SITRA
- [ ] Certificates display in SITRA
- [ ] Console commands execute without errors
- [ ] All routes return correct responses
- [ ] All views render without errors
- [ ] Responsive design on mobile
- [ ] Error handling works properly
- [ ] Database transactions are consistent

---

## 🎯 Success Criteria

System is ready for production when:

✅ All syntax checks pass  
✅ All routes are accessible  
✅ All commands execute successfully  
✅ All integration flows work  
✅ All views render correctly  
✅ All database transactions succeed  
✅ All notifications send properly  
✅ Performance is acceptable (< 500ms response time)  
✅ Security validations are enforced  
✅ Error handling is comprehensive  

---

## 📞 Support Resources

- **Main Documentation:** `SYSTEM_INTEGRATION.md`
- **Summary Report:** `FINAL_INTEGRATION_SUMMARY.md`
- **Verification Report:** `FINAL_VERIFICATION_REPORT.md`
- **Laravel Docs:** https://laravel.com/docs/10.x
- **Eloquent Docs:** https://laravel.com/docs/10.x/eloquent
- **Blade Docs:** https://laravel.com/docs/10.x/blade

---

**Last Updated:** 2026-01-22  
**Version:** 1.0  
**Status:** Production Ready ✅
