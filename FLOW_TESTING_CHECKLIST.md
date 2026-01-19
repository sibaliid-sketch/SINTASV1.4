# Registration Flow Testing Checklist

## 🔧 System Status
- ✅ Controller methods: 20 methods (index + 2 per step × 9 + step10Show)
- ✅ Routes: 18 routes (proper GET/POST pattern)
- ✅ Views: 10 Blade templates with updated form routes
- ✅ Database: Programs, Schedules seeded
- ✅ Services: IdGenerator, AuditLogger ready
- ✅ Cache: Cleared

## 📋 Test Steps

### Step 1: Welcome/Intro
- **URL**: `http://localhost:8000/register`
- **Method**: GET
- **Expected**: See welcome page with "Mulai Pendaftaran" button
- **Button Route**: Should route to `http://localhost:8000/register/step2` (GET)
- **Test**: Click "Mulai Pendaftaran" button

### Step 2: Registrar Type Selection
- **URL**: `http://localhost:8000/register/step2`
- **Method**: GET then POST
- **Expected**: 
  - Radio buttons for "Self Register" or "Parent Register"
  - Form action should POST to `/register/step2`
- **Test Data**: 
  - Select "Saya Mendaftarkan Anak Saya" (is_parent_register = yes)
  - Click "Lanjutkan"
- **Expected Result**: Redirects to Step 3 with data preserved

### Step 3: Education Level Selection
- **URL**: `http://localhost:8000/register/step3`
- **Method**: GET then POST
- **Expected**:
  - Should see previously selected "parent register" hidden input
  - Radio buttons for TK, SD, SMP, SMA, Mahasiswa, Umum
- **Test Data**:
  - Select "SMA"
  - Optionally fill "Kelas / Semester" field
  - Click "Lanjutkan"
- **Expected Result**: Redirects to Step 4 with data preserved

### Step 4: Program Selection
- **URL**: `http://localhost:8000/register/step4`
- **Method**: GET then POST
- **Expected**:
  - Should see hidden inputs: is_parent_register, education_level, class_level
  - Should display programs filtered by education_level (SMA)
  - At least 1-2 programs visible
- **Test Data**:
  - Select first available program
  - Click "Lanjutkan"
- **Expected Result**: Redirects to Step 5

### Step 5: Schedule Selection
- **URL**: `http://localhost:8000/register/step5`
- **Method**: GET then POST
- **Expected**:
  - Show program details
  - List available schedules for selected program
  - Multiple schedule options with day/time
- **Test Data**:
  - Select first available schedule
  - Click "Lanjutkan"
- **Expected Result**: Redirects to Step 6

### Step 6: Student Data Entry
- **URL**: `http://localhost:8000/register/step6`
- **Method**: GET then POST
- **Expected**:
  - Form with fields: student name, birthdate, identity number, gender, address, phone, email
  - Conditional parent fields visible (since we selected parent register)
- **Test Data**:
  - Student Name: "Budi Santoso"
  - Birthdate: "2008-06-15"
  - Identity Number: "3201234567890123"
  - Gender: "male"
  - Address: "Jl. Merdeka No. 123, Jakarta"
  - Phone: "081234567890"
  - Email: "budi@example.com"
  - Parent Name: "Siti Nurhaliza"
  - Parent ID: "3201234567890124"
  - Parent Phone: "081234567891"
  - Parent Email: "siti@example.com"
  - Parent Relationship: "Ibu"
- **Expected Result**: Redirects to Step 7

### Step 7: Review & Terms
- **URL**: `http://localhost:8000/register/step7`
- **Method**: GET then POST
- **Expected**:
  - Display summary: program name, schedule, student name, age (calculated)
  - Agreement checkbox required
- **Test Data**:
  - Check "Saya setuju dengan syarat dan ketentuan"
  - Click "Lanjutkan"
- **Expected Result**: Redirects to Step 8

### Step 8: Promo Code & Create Registration
- **URL**: `http://localhost:8000/register/step8`
- **Method**: GET then POST
- **Expected**:
  - Optional promo code input field
  - Submit button creates registration in database
- **Test Data**:
  - Leave promo code empty (or enter valid promo if exists)
  - Click "Proses Pembayaran"
- **Expected Result**:
  - Registration record created in database with all fields
  - Order ID, Student ID, Invoice ID generated
  - Redirects to Step 9 with registration ID in URL

### Step 9: Payment Proof Upload
- **URL**: `http://localhost:8000/register/step9/{registration_id}`
- **Method**: GET then POST
- **Expected**:
  - Invoice summary shown
  - Payment proof upload form (file, bank name, sender name, amount, date)
- **Test Data**:
  - Bank Name: "BCA"
  - Sender Name: "Budi Santoso"
  - Amount: "1500000"
  - Transfer Date: "2026-01-19T14:30"
  - Upload test image/PDF
  - Click "Submit Bukti Pembayaran"
- **Expected Result**:
  - PaymentProof record created
  - Registration status changed to "awaiting_verification"
  - Redirects to Step 10

### Step 10: Confirmation
- **URL**: `http://localhost:8000/register/step10/{registration_id}`
- **Method**: GET
- **Expected**:
  - Success message
  - Registration details summary
  - Order ID, Student ID, Invoice ID displayed
  - Download/print option
- **Test Result**: Flow complete!

## 🗄️ Database Verification

After completing the flow, verify in database:

```sql
-- Check Registration created
SELECT * FROM registrations WHERE order_id LIKE 'ORD%' ORDER BY created_at DESC LIMIT 1;

-- Check PaymentProof created
SELECT * FROM payment_proofs WHERE registration_id = (SELECT id FROM registrations ORDER BY created_at DESC LIMIT 1);

-- Check AuditLog entries
SELECT * FROM audit_logs WHERE model = 'Registration' ORDER BY created_at DESC LIMIT 10;
```

## ⚠️ Common Issues & Fixes

| Issue | Solution |
|-------|----------|
| "Education level not matching" | Ensure Step 3 posts education_level correctly |
| "Program ID not found" | Verify programs exist in database for selected education level |
| "Student data missing" | Check Step 6 form fields all filled before submit |
| "Registration not created" | Check if all required fields in Registration model have values |
| "Redirect loops" | Clear cache with `php artisan cache:clear` |

## 🎯 Success Criteria

- ✅ All 10 steps accessible via correct URLs
- ✅ Data persists through multi-step flow (session preserved)
- ✅ Forms submit to correct routes (POST /step{N}-submit)
- ✅ Registration created in database after Step 8
- ✅ PaymentProof created after Step 9
- ✅ AuditLog entries created for all actions
- ✅ Back buttons navigate correctly
- ✅ Error validation works (empty required fields show errors)

## 📝 Notes

- Session data is preserved using `->with()` and `->withInput()` in redirects
- `request()` helper checks both request input and old flash data
- All hidden form fields carry forward previous step data
- Database transaction ensures data consistency
- AuditLogger automatically tracks all major actions

---

**Last Updated**: 2026-01-19
**Status**: Ready for Testing
