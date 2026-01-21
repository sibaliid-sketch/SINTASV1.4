# Registration System Rebuild Plan

## Information Gathered

### Current Database Structure
- **Registration Model**: Has all necessary fields including:
  - `is_self_register` (boolean) - who's registering
  - `education_level` (TK, SD, SMP, SMA, Mahasiswa, Umum)
  - `class_level` (nullable) - for class/semester
  - `service_type` (Regular-in Class, Private, Rumah Belajar, Mitra Belajar)
  - Student data fields (name, identity, DOB, phone, email, job, gender, address, age)
  - Parent data fields (name, identity, phone, email, relationship, address)
  - Payment fields (base_price, discount_amount, tax_amount, total_price, payment_status, payment_deadline)
  - Document IDs (order_id, student_id, invoice_id, receipt_id, contract_id)

- **Program Model**: Has education_level and service_type for filtering
- **Schedule Model**: Has availability tracking and date ranges
- **Promo Model**: Has validation and discount calculation methods

### Missing Database Fields
Need to add to registrations table:
- `class_mode` (online/offline) - for filtering programs
- Better address structure (province, regency, district, village fields already in controller but not in migration)

### Existing Services
- `IdGeneratorService`: Generates order_id, student_id, invoice_id
- `AccountCreationService`: Creates SIMY/SITRA/SINTAS accounts (needs update for new logic)
- `AuditLoggerService`: Logs all actions
- `NotificationService`: Notifies admins
- `PaymentVerificationService`: Handles payment verification

### UI Framework
- Laravel Blade with Tailwind CSS
- Custom fonts: Candara, Perpetua, Garamond
- Gradient-based design system

## Detailed Implementation Plan

### Phase 1: Database Updates

#### 1.1 Create Migration for Additional Fields
**File**: `database/migrations/2026_01_22_000000_add_class_mode_to_registrations_table.php`
- Add `class_mode` enum field (online, offline)
- Add structured address fields if not already present

#### 1.2 Update Program Model
**File**: `app/Models/Program.php`
- Add `class_mode` to fillable
- Add scope methods for filtering by registrar type, class mode, education level

#### 1.3 Update Schedule Model
**File**: `app/Models/Schedule.php`
- Ensure proper relationship with programs
- Add methods to check availability

### Phase 2: Controller Rebuild

#### 2.1 Update RegistrationController
**File**: `app/Http/Controllers/RegistrationController.php`

**Section 1 Methods**:
- `step1Show()` - Display who's registering (parent/self)
- `step1Submit()` - Store registrar type
- `step2Show()` - Display class mode selection (online/offline)
- `step2Submit()` - Store class mode
- `step3Show()` - Display education level & class/semester
- `step3Submit()` - Store education data with validation logic
- `step4Show()` - Display filtered programs & services
- `step4Submit()` - Store program selection
- `step5Show()` - Display available schedules
- `step5Submit()` - Store schedule selection

**Section 2 Methods**:
- `step6Show()` - Display personal data forms (conditional based on registrar type)
  - If parent: Show parent form + child form
  - If self: Show student form only
  - Age validation: If self-register and under 18, require parent data
- `step6Submit()` - Validate and store personal data
- `step7Show()` - Display promo code input and agreements
- `step7Submit()` - Validate promo, check agreements

**Section 3 Methods**:
- `step8Show()` - Display order summary (invoice-style)
- `step8Submit()` - Confirm order and create registration

**Section 4 Methods**:
- `step9Show()` - Display payment portal
  - Show bank transfer details
  - If "pay now": Show payment proof form
  - If "pay later": Show deadline warning (2 days before class)
- `step9Submit()` - Process payment proof or set deadline
- `step10Show()` - Final confirmation page
  - Download invoice button
  - Download contract button
  - Account creation notification
  - OTP sent notification

### Phase 3: Service Updates

#### 3.1 Update AccountCreationService
**File**: `app/Services/AccountCreationService.php`

New logic:
- **Parent registers child**:
  - Create SIMY account for student (LMS access)
  - Create SITRA account for parent (payment & activity monitoring)
  
- **Student registers self (18+)**:
  - Create SIMY account (LMS access)
  - Add payment management features to SIMY account
  
- **Student registers self (under 18)**:
  - Require parent data
  - Create SIMY account for student
  - Create SITRA account for parent

#### 3.2 Create OTP Service
**File**: `app/Services/OtpService.php`
- Generate OTP codes
- Send OTP via email
- Verify OTP codes
- Activate accounts after verification

#### 3.3 Create Document Generation Service
**File**: `app/Services/DocumentGenerationService.php`
- Generate invoice PDF
- Generate contract PDF
- Generate receipt PDF (if paid)

#### 3.4 Create Email Notification Service
**File**: `app/Services/RegistrationEmailService.php`
- Send registration confirmation email
- Send invoice email
- Send contract email
- Send OTP email
- Send account credentials email

### Phase 4: View Files Creation

#### 4.1 Section 1 Views (Registration Type & Program Selection)
- `resources/views/registration/step1-registrar-type.blade.php` - Who's registering?
- `resources/views/registration/step2-class-mode.blade.php` - Online/Offline?
- `resources/views/registration/step3-education-level.blade.php` - Education level & class
- `resources/views/registration/step4-program-selection.blade.php` - Programs & services
- `resources/views/registration/step5-schedule-selection.blade.php` - Available schedules

#### 4.2 Section 2 Views (Personal Data)
- `resources/views/registration/step6-personal-data.blade.php` - Personal data forms
  - Include parent form component
  - Include student form component
  - Conditional rendering based on registrar type
- `resources/views/registration/step7-promo-agreements.blade.php` - Promo & agreements

#### 4.3 Section 3 Views (Order Summary)
- `resources/views/registration/step8-order-summary.blade.php` - Invoice-style summary

#### 4.4 Section 4 Views (Payment & Confirmation)
- `resources/views/registration/step9-payment-portal.blade.php` - Payment instructions & proof upload
- `resources/views/registration/step10-final-confirmation.blade.php` - Success page with downloads

#### 4.5 Component Views
- `resources/views/registration/components/progress-bar.blade.php` - Step indicator
- `resources/views/registration/components/parent-form.blade.php` - Parent data form
- `resources/views/registration/components/student-form.blade.php` - Student data form
- `resources/views/registration/components/address-form.blade.php` - Address input with dropdowns

### Phase 5: Routes Update

#### 5.1 Update Registration Routes
**File**: `routes/web.php`

Update to 10-step flow:
```php
Route::prefix('register')->name('registration.')->group(function () {
    // Section 1: Registration Type & Program Selection
    Route::get('/step1', [RegistrationController::class, 'step1Show'])->name('step1');
    Route::post('/step1', [RegistrationController::class, 'step1Submit']);
    Route::get('/step2', [RegistrationController::class, 'step2Show'])->name('step2');
    Route::post('/step2', [RegistrationController::class, 'step2Submit']);
    Route::get('/step3', [RegistrationController::class, 'step3Show'])->name('step3');
    Route::post('/step3', [RegistrationController::class, 'step3Submit']);
    Route::get('/step4', [RegistrationController::class, 'step4Show'])->name('step4');
    Route::post('/step4', [RegistrationController::class, 'step4Submit']);
    Route::get('/step5', [RegistrationController::class, 'step5Show'])->name('step5');
    Route::post('/step5', [RegistrationController::class, 'step5Submit']);
    
    // Section 2: Personal Data
    Route::get('/step6', [RegistrationController::class, 'step6Show'])->name('step6');
    Route::post('/step6', [RegistrationController::class, 'step6Submit']);
    Route::get('/step7', [RegistrationController::class, 'step7Show'])->name('step7');
    Route::post('/step7', [RegistrationController::class, 'step7Submit']);
    
    // Section 3: Order Summary
    Route::get('/step8', [RegistrationController::class, 'step8Show'])->name('step8');
    Route::post('/step8', [RegistrationController::class, 'step8Submit']);
    
    // Section 4: Payment & Confirmation
    Route::get('/step9/{registration}', [RegistrationController::class, 'step9Show'])->name('step9');
    Route::post('/step9/{registration}', [RegistrationController::class, 'step9Submit']);
    Route::get('/step10/{registration}', [RegistrationController::class, 'step10Show'])->name('step10');
    
    // API endpoints for dynamic data
    Route::get('/api/programs', [RegistrationController::class, 'getFilteredPrograms'])->name('api.programs');
    Route::get('/api/schedules/{program}', [RegistrationController::class, 'getAvailableSchedules'])->name('api.schedules');
    Route::post('/api/validate-promo', [RegistrationController::class, 'validatePromo'])->name('api.validate-promo');
});
```

### Phase 6: Validation & Business Logic

#### 6.1 Age Validation Logic
- If `is_self_register = true` AND age < 18:
  - Require parent data fields
  - Show warning message
  - Cannot proceed without parent data

#### 6.2 Education Level Logic
- If `is_self_register = false` (parent registers):
  - Show options: TK, SD, SMP, SMA
  - Label: "Kelas" (1-12)
  
- If `is_self_register = true` (self registers):
  - Show options: Mahasiswa, Umum
  - If Mahasiswa: Label "Semester" (1-8+)
  - If Umum: Class level not required

#### 6.3 Program Filtering Logic
Filter programs by:
1. `is_self_register` (parent vs self)
2. `class_mode` (online vs offline)
3. `education_level` (TK-SMA vs Mahasiswa vs Umum)
4. `service_type` (Regular, Private, etc.)

#### 6.4 Payment Deadline Logic
- If "pay later": deadline = 2 days before class start_date
- If "pay now": immediate verification required
- Send reminder emails at: 7 days, 3 days, 1 day before deadline

### Phase 7: Dashboard Integration

#### 7.1 Operations Dashboard
- New registrations list
- Registration status tracking
- Student data management

#### 7.2 Finance Dashboard
- Payment verification queue
- Payment status tracking
- Invoice management
- Receipt generation

#### 7.3 Engagement & Retention Dashboard
- New student onboarding tracking
- Parent communication logs
- Student activity monitoring

#### 7.4 IT Dashboard
- Account creation logs
- OTP verification tracking
- System integration status

### Phase 8: Email Templates

#### 8.1 Create Email Views
- `resources/views/emails/registration-confirmation.blade.php`
- `resources/views/emails/invoice.blade.php`
- `resources/views/emails/contract.blade.php`
- `resources/views/emails/otp-verification.blade.php`
- `resources/views/emails/account-credentials.blade.php`
- `resources/views/emails/payment-reminder.blade.php`

### Phase 9: Testing & Validation

#### 9.1 Test Scenarios
1. Parent registers child (TK-SMA) - Online class
2. Parent registers child (TK-SMA) - Offline class
3. Student registers self (18+, Mahasiswa) - Online
4. Student registers self (18+, Mahasiswa) - Offline
5. Student registers self (18+, Umum) - Online
6. Student registers self (under 18) - Should require parent data
7. Payment now flow
8. Payment later flow
9. Promo code validation
10. Schedule availability checking

## Implementation Order

1. ✅ Create migration for class_mode field
2. ✅ Update models with new fields and relationships
3. ✅ Create new service classes (OTP, Document, Email)
4. ✅ Rebuild RegistrationController with 10-step flow
5. ✅ Create all view files with proper UI
6. ✅ Update routes
7. ✅ Update AccountCreationService logic
8. ✅ Create email templates
9. ✅ Test all scenarios
10. ✅ Deploy and monitor

## Notes

- All registration data goes to 4 dashboards: Operations, Finance, Engagement & Retention, IT
- OTP must be verified before account activation
- Invoice and contract must be downloadable
- System must prevent submission if validation fails
- Payment deadline strictly enforced (2 days before class start)
- Automatic account creation after payment verification
