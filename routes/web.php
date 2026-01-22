<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\SINTAS\AdminChatController;
use App\Http\Controllers\SINTAS\SintasController;
use App\Http\Controllers\SIMY\DashboardController as SimyDashboardController;
use App\Http\Controllers\SIMY\SimyController;
use App\Http\Controllers\SITRA\SitraController;
use App\Http\Controllers\SIMY\MaterialController;
use App\Http\Controllers\SIMY\AssignmentController;
use App\Http\Controllers\SIMY\SubmissionController;
use App\Http\Controllers\SIMY\QuizController;
use App\Http\Controllers\SIMY\QuizAttemptController;
use App\Http\Controllers\SIMY\ProgressController;
use App\Http\Controllers\SIMY\CertificateController;
use App\Http\Controllers\SIMY\MessageController;
use App\Http\Controllers\SIMY\NoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome.welcomeguest.welcome-guest');
});

Route::get('/welcome-guest', function () {
    return view('welcome.welcomeguest.welcome-guest');
});

Route::get('/about', function () {
    return view('welcome.welcomeguest.about');
});

Route::get('/services', function () {
    return view('welcome.welcomeguest.services');
});

Route::get('/contact', function () {
    return view('welcome.welcomeguest.contact');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/sibalion-karyawan-kami', function () {
    return view('welcome.welcomeguest.sibalion-karyawan-kami');
});

Route::get('/kurikulum-sibali-id', function () {
    return view('welcome.welcomeguest.kurikulum-sibali-id');
});

Route::get('/event', function () {
    return view('welcome.welcomeguest.event');
});

Route::get('/investing-for-investor', function () {
    return view('welcome.welcomeguest.investing-for-investor');
});

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Google OAuth Routes
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Debug routes (only in dev)
Route::middleware('auth')->group(function () {
    Route::get('/debug/session', [DebugController::class, 'sessionDebug'])->name('debug.session');
    Route::post('/debug/set-session', [DebugController::class, 'setSession'])->name('debug.set-session');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/simy', [SimyController::class, 'index'])->name('simy');

Route::get('/sitra', [SitraController::class, 'index'])->middleware('auth')->name('sitra');
Route::get('/sitra/welcome', [SitraController::class, 'welcome'])->name('sitra.welcome');

Route::get('/sintas', [SintasController::class, 'index'])->name('sintas');
Route::get('/sintas/welcome', [SintasController::class, 'welcome'])->middleware('auth')->name('sintas.welcome');

Route::get('/overview', [SintasController::class, 'overview'])->name('overview');

// Department Routes
Route::prefix('departments')->name('departments.')->middleware('auth')->group(function () {
    Route::get('/operations', [SintasController::class, 'operations'])->name('operations');
    Route::get('/operations/overview', [SintasController::class, 'overviewOperations'])->name('overview.operations');
    Route::get('/sales-marketing', [SintasController::class, 'salesMarketing'])->name('sales-marketing');
    Route::get('/sales-marketing/overview', [SintasController::class, 'overviewSalesMarketing'])->name('overview.sales-marketing');
    Route::get('/finance', [SintasController::class, 'finance'])->name('finance');
    Route::get('/finance/overview', [SintasController::class, 'overviewFinance'])->name('overview.finance');
    Route::get('/product-rnd', [SintasController::class, 'productRnd'])->name('product-rnd');
    Route::get('/product-rnd/overview', [SintasController::class, 'overviewProductRnd'])->name('overview.product-rnd');
    Route::get('/it', [SintasController::class, 'it'])->name('it');
    Route::get('/it/overview', [SintasController::class, 'overviewIt'])->name('overview.it');
    Route::get('/operations/chat-console', [SintasController::class, 'operationsChatConsole'])->name('operations.chat-console');
    Route::get('/{department}/chat/messages/{user}', [SintasController::class, 'getChatMessages'])->name('chat.messages');
    Route::get('/academic', [SintasController::class, 'academic'])->name('academic');
    Route::get('/academic/overview', [SintasController::class, 'overviewAcademic'])->name('overview.academic');
    Route::get('/academic/services', [SintasController::class, 'academicServices'])->name('academic.services');
    Route::get('/academic/programs', [SintasController::class, 'academicPrograms'])->name('academic.programs');
    Route::get('/academic/schedules', [SintasController::class, 'academicSchedules'])->name('academic.schedules');
    Route::get('/engagement-retention', [SintasController::class, 'engagementRetention'])->name('engagement-retention');
    Route::get('/engagement-retention/overview', [SintasController::class, 'overviewEngagementRetention'])->name('overview.engagement-retention');
    Route::get('/hr', [SintasController::class, 'hr'])->name('hr');
    Route::get('/hr/overview', [SintasController::class, 'overviewHr'])->name('overview.hr');
    Route::get('/pr', [SintasController::class, 'pr'])->name('pr');
    Route::get('/pr/overview', [SintasController::class, 'overviewPr'])->name('overview.pr');

    // General pages for each department
    Route::get('/operations/general', [SintasController::class, 'general'])->name('operations.general');
    Route::get('/it/general', [SintasController::class, 'general'])->name('it.general');
    Route::get('/academic/general', [SintasController::class, 'general'])->name('academic.general');
    Route::get('/sales-marketing/general', [SintasController::class, 'general'])->name('sales-marketing.general');
    Route::get('/finance/general', [SintasController::class, 'general'])->name('finance.general');
    Route::get('/product-rnd/general', [SintasController::class, 'general'])->name('product-rnd.general');
    Route::get('/hr/general', [SintasController::class, 'general'])->name('hr.general');
    Route::get('/pr/general', [SintasController::class, 'general'])->name('pr.general');
    Route::get('/engagement-retention/general', [SintasController::class, 'general'])->name('engagement-retention.general');

    // HRIS pages for all departments
    Route::get('/operations/hris', [SintasController::class, 'hris'])->name('operations.hris');
    Route::get('/it/hris', [SintasController::class, 'hris'])->name('it.hris');
    Route::get('/academic/hris', [SintasController::class, 'hris'])->name('academic.hris');
    Route::get('/sales-marketing/hris', [SintasController::class, 'hris'])->name('sales-marketing.hris');
    Route::get('/finance/hris', [SintasController::class, 'hris'])->name('finance.hris');
    Route::get('/product-rnd/hris', [SintasController::class, 'hris'])->name('product-rnd.hris');
    Route::get('/hr/hris', [SintasController::class, 'hris'])->name('hr.hris');
    Route::get('/pr/hris', [SintasController::class, 'hris'])->name('pr.hris');
    Route::get('/engagement-retention/hris', [SintasController::class, 'hris'])->name('engagement-retention.hris');

    // Beranda pages for each department
    Route::get('/operations/beranda', [SintasController::class, 'beranda'])->name('operations.beranda');
    Route::get('/it/beranda', [SintasController::class, 'beranda'])->name('it.beranda');
    Route::get('/academic/beranda', [SintasController::class, 'beranda'])->name('academic.beranda');
    Route::get('/sales-marketing/beranda', [SintasController::class, 'beranda'])->name('sales-marketing.beranda');
    Route::get('/finance/beranda', [SintasController::class, 'beranda'])->name('finance.beranda');
    Route::get('/product-rnd/beranda', [SintasController::class, 'beranda'])->name('product-rnd.beranda');
    Route::get('/hr/beranda', [SintasController::class, 'beranda'])->name('hr.beranda');
    Route::get('/pr/beranda', [SintasController::class, 'beranda'])->name('pr.beranda');
    Route::get('/engagement-retention/beranda', [SintasController::class, 'beranda'])->name('engagement-retention.beranda');

    // Tools pages for departments that have tools
    Route::get('/operations/tools', [SintasController::class, 'tools'])->name('operations.tools');
    Route::get('/it/tools', [SintasController::class, 'tools'])->name('it.tools');
    Route::get('/academic/tools', [SintasController::class, 'tools'])->name('academic.tools');
    Route::get('/finance/tools', [SintasController::class, 'tools'])->name('finance.tools');
    Route::get('/sales-marketing/tools', [SintasController::class, 'tools'])->name('sales-marketing.tools');
    Route::get('/product-rnd/tools', [SintasController::class, 'tools'])->name('product-rnd.tools');
    Route::get('/hr/tools', [SintasController::class, 'tools'])->name('hr.tools');
    Route::get('/pr/tools', [SintasController::class, 'tools'])->name('pr.tools');
    Route::get('/engagement-retention/tools', [SintasController::class, 'tools'])->name('engagement-retention.tools');

    // Additional pages for all departments
    Route::get('/operations/ticket', [SintasController::class, 'ticket'])->name('operations.ticket');
    Route::get('/it/ticket', [SintasController::class, 'ticket'])->name('it.ticket');
    Route::get('/academic/ticket', [SintasController::class, 'ticket'])->name('academic.ticket');
    Route::get('/sales-marketing/ticket', [SintasController::class, 'ticket'])->name('sales-marketing.ticket');
    Route::get('/finance/ticket', [SintasController::class, 'ticket'])->name('finance.ticket');
    Route::get('/product-rnd/ticket', [SintasController::class, 'ticket'])->name('product-rnd.ticket');
    Route::get('/hr/ticket', [SintasController::class, 'ticket'])->name('hr.ticket');
    Route::get('/pr/ticket', [SintasController::class, 'ticket'])->name('pr.ticket');
    Route::get('/engagement-retention/ticket', [SintasController::class, 'ticket'])->name('engagement-retention.ticket');

    Route::get('/operations/message', [SintasController::class, 'message'])->name('operations.message');
    Route::get('/it/message', [SintasController::class, 'message'])->name('it.message');
    Route::get('/academic/message', [SintasController::class, 'message'])->name('academic.message');
    Route::get('/sales-marketing/message', [SintasController::class, 'message'])->name('sales-marketing.message');
    Route::get('/finance/message', [SintasController::class, 'message'])->name('finance.message');
    Route::get('/product-rnd/message', [SintasController::class, 'message'])->name('product-rnd.message');
    Route::get('/hr/message', [SintasController::class, 'message'])->name('hr.message');
    Route::get('/pr/message', [SintasController::class, 'message'])->name('pr.message');
    Route::get('/engagement-retention/message', [SintasController::class, 'message'])->name('engagement-retention.message');

    Route::get('/operations/notification', [SintasController::class, 'notification'])->name('operations.notification');
    Route::get('/it/notification', [SintasController::class, 'notification'])->name('it.notification');
    Route::get('/academic/notification', [SintasController::class, 'notification'])->name('academic.notification');
    Route::get('/sales-marketing/notification', [SintasController::class, 'notification'])->name('sales-marketing.notification');
    Route::get('/finance/notification', [SintasController::class, 'notification'])->name('finance.notification');
    Route::get('/product-rnd/notification', [SintasController::class, 'notification'])->name('product-rnd.notification');
    Route::get('/hr/notification', [SintasController::class, 'notification'])->name('hr.notification');
    Route::get('/pr/notification', [SintasController::class, 'notification'])->name('pr.notification');
    Route::get('/engagement-retention/notification', [SintasController::class, 'notification'])->name('engagement-retention.notification');

    Route::get('/operations/setting', [SintasController::class, 'setting'])->name('operations.setting');
    Route::get('/it/setting', [SintasController::class, 'setting'])->name('it.setting');
    Route::get('/academic/setting', [SintasController::class, 'setting'])->name('academic.setting');
    Route::get('/sales-marketing/setting', [SintasController::class, 'setting'])->name('sales-marketing.setting');
    Route::get('/finance/setting', [SintasController::class, 'setting'])->name('finance.setting');
    Route::get('/product-rnd/setting', [SintasController::class, 'setting'])->name('product-rnd.setting');
    Route::get('/hr/setting', [SintasController::class, 'setting'])->name('hr.setting');
    Route::get('/pr/setting', [SintasController::class, 'setting'])->name('pr.setting');
    Route::get('/engagement-retention/setting', [SintasController::class, 'setting'])->name('engagement-retention.setting');
});

// IT Chat Console outside the departments group
Route::get('/departments/it/chat-console', [SintasController::class, 'itChatConsole'])->name('it.chat-console');

// Registration Routes (Pendaftaran Layanan & Program) - NEW 11-STEP FLOW
use App\Http\Controllers\RegistrationControllerNew;

Route::prefix('register')->name('registration.')->group(function () {
    // Section 1: Registration Type & Selection (Steps 1-6)
    Route::get('/step1', [RegistrationControllerNew::class, 'step1Show'])->name('step1');
    Route::post('/step1', [RegistrationControllerNew::class, 'step1Submit']);
    Route::get('/step2', [RegistrationControllerNew::class, 'step2Show'])->name('step2');
    Route::post('/step2', [RegistrationControllerNew::class, 'step2Submit']);
    Route::get('/step3', [RegistrationControllerNew::class, 'step3Show'])->name('step3');
    Route::post('/step3', [RegistrationControllerNew::class, 'step3Submit']);
    Route::get('/step4', [RegistrationControllerNew::class, 'step4Show'])->name('step4');
    Route::post('/step4', [RegistrationControllerNew::class, 'step4Submit']);
    Route::get('/step5', [RegistrationControllerNew::class, 'step5Show'])->name('step5');
    Route::post('/step5', [RegistrationControllerNew::class, 'step5Submit']);
    Route::get('/step6', [RegistrationControllerNew::class, 'step6Show'])->name('step6');
    Route::post('/step6', [RegistrationControllerNew::class, 'step6Submit']);

    // Section 2: Personal Data & Agreements (Steps 7-8)
    Route::get('/step7', [RegistrationControllerNew::class, 'step7Show'])->name('step7');
    Route::post('/step7', [RegistrationControllerNew::class, 'step7Submit']);
    Route::get('/step8', [RegistrationControllerNew::class, 'step8Show'])->name('step8');
    Route::post('/step8', [RegistrationControllerNew::class, 'step8Submit']);

    // Section 3: Order Summary (Step 9)
    Route::get('/step9', [RegistrationControllerNew::class, 'step9Show'])->name('step9');
    Route::post('/step9', [RegistrationControllerNew::class, 'step9Submit']);

    // Section 4: Payment & Confirmation (Steps 10-11)
    Route::get('/step10/{registration}', [RegistrationControllerNew::class, 'step10Show'])->name('step10');
    Route::post('/step10/{registration}', [RegistrationControllerNew::class, 'step10Submit']);
    Route::get('/step11/{registration}', [RegistrationControllerNew::class, 'step11Show'])->name('step11');
    Route::post('/step11/{registration}/verify-otp', [RegistrationControllerNew::class, 'verifyOtp'])->name('verify-otp');

    // API Endpoints for dynamic data
    Route::get('/api/services', [RegistrationControllerNew::class, 'getFilteredServices'])->name('api.services');
    Route::get('/api/programs', [RegistrationControllerNew::class, 'getFilteredPrograms'])->name('api.programs');
    Route::get('/api/schedules/{program}', [RegistrationControllerNew::class, 'getAvailableSchedules'])->name('api.schedules');
    Route::post('/api/validate-promo', [RegistrationControllerNew::class, 'validatePromo'])->name('api.validate-promo');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::post('/profile/preferences', [ProfileController::class, 'updatePreferences'])->name('profile.preferences.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Chat Console
    Route::get('/admin/chat/{department}', [AdminChatController::class, 'index'])->name('admin.chat');
    Route::post('/admin/chat/{department}/send', [AdminChatController::class, 'sendMessage'])->name('admin.chat.send');

    // User Chat
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/messages', [ChatController::class, 'getMessages'])->name('chat.messages');

    // Google OAuth Disconnect
    Route::post('/google/disconnect', [SocialAuthController::class, 'disconnectGoogle'])->name('google.disconnect');

    // Attendance System (Internal)
    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::get('/', [\App\Http\Controllers\SINTAS\AttendanceController::class, 'index'])->name('index');
        Route::post('/check-in', [\App\Http\Controllers\SINTAS\AttendanceController::class, 'checkIn'])->name('check-in');
        Route::post('/check-out', [\App\Http\Controllers\SINTAS\AttendanceController::class, 'checkOut'])->name('check-out');
        Route::get('/history', [\App\Http\Controllers\SINTAS\AttendanceController::class, 'history'])->name('history');

        // Admin routes
        Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [\App\Http\Controllers\SINTAS\AttendanceController::class, 'adminIndex'])->name('index');
            Route::get('/export', [\App\Http\Controllers\SINTAS\AttendanceController::class, 'export'])->name('export');
        });
    });

    // SIMY - Student Learning Management System
    Route::prefix('simy')->name('simy.')->group(function () {
        Route::get('/beranda', [SimyController::class, 'beranda'])->name('beranda');
        Route::get('/ticket', [SimyController::class, 'ticket'])->name('ticket');
        Route::get('/message', [SimyController::class, 'message'])->name('message');
        Route::get('/notification', [SimyController::class, 'notification'])->name('notification');
        Route::get('/setting', [SimyController::class, 'setting'])->name('setting');
        Route::get('/dashboard', [SimyDashboardController::class, 'index'])->name('dashboard');
        
        // Materials
        Route::resource('materials', MaterialController::class)->only('index', 'show');
        
        // Assignments
        Route::resource('assignments', AssignmentController::class)->only('index', 'show');
        Route::post('assignments/{assignment}/submit', [SubmissionController::class, 'store'])->name('submissions.store');
        
        // Quizzes
        Route::resource('quizzes', QuizController::class)->only('index', 'show');
        Route::get('quizzes/{quiz}/attempt', [QuizAttemptController::class, 'create'])->name('quizzes.create-attempt');
        Route::post('quizzes/{quiz}/attempt/{attempt}', [QuizAttemptController::class, 'store'])->name('quizzes.store-attempt');
        
        // Progress
        Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');
        
        // Certificates
        Route::resource('certificates', CertificateController::class)->only('index', 'show');
        
        // Notes
        Route::resource('notes', NoteController::class)->only('store', 'destroy');
        
        // Forum & Messages
        Route::get('/forum', [MessageController::class, 'index'])->name('forum.index');
        Route::post('/forum/message', [MessageController::class, 'store'])->name('messages.store');
        Route::post('/messages/{message}/react', [MessageController::class, 'addReaction'])->name('messages.react');
    });

    // SITRA - Customer Portal (Parents/Guardians)
    Route::prefix('sitra')->name('sitra.')->group(function () {
        Route::get('/beranda', [SitraController::class, 'beranda'])->name('beranda');
        Route::get('/ticket', [SitraController::class, 'ticket'])->name('ticket');
        Route::get('/message', [SitraController::class, 'message'])->name('message');
        Route::get('/notification', [SitraController::class, 'notification'])->name('notification');
        Route::get('/setting', [SitraController::class, 'setting'])->name('setting');
        Route::get('/dashboard', [SitraController::class, 'index'])->name('dashboard');
        Route::get('/settings', [SitraController::class, 'settings'])->name('settings');
        Route::patch('/preferences', [SitraController::class, 'updatePreferences'])->name('preferences.update');
        
        // Child-specific routes
        Route::prefix('child/{childId}')->name('child.')->group(function () {
            Route::get('/academic', [SitraController::class, 'childAcademic'])->name('academic');
            Route::get('/attendance', [SitraController::class, 'childAttendance'])->name('attendance');
            Route::get('/payments', [SitraController::class, 'payments'])->name('payments');
            Route::get('/certificates', [SitraController::class, 'certificates'])->name('certificates');
            Route::get('/schedule', [SitraController::class, 'schedule'])->name('schedule');
            Route::get('/reports', [SitraController::class, 'reports'])->name('reports');
            Route::get('/reports/download/{reportType?}', [SitraController::class, 'downloadReport'])->name('reports.download');
            
            // Messaging
            Route::get('/messages', [SitraController::class, 'messages'])->name('messages');
            Route::get('/conversation/{conversationId}', [SitraController::class, 'conversation'])->name('conversation');
            Route::post('/message/send', [SitraController::class, 'sendMessage'])->name('message.send');
        });
    });

    // Admin Tools - Services & Programs Management
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        // Academic Dashboard Console
        Route::get('/academic/console', [\App\Http\Controllers\Admin\AcademicDashboardController::class, 'index'])->name('academic.console');
        Route::get('/academic/data', [\App\Http\Controllers\Admin\AcademicDashboardController::class, 'getData'])->name('academic.data');

        // Services Management
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
        Route::patch('services/{service}/toggle', [\App\Http\Controllers\Admin\ServiceController::class, 'toggle'])->name('services.toggle');

        // Programs Management
        Route::resource('programs', \App\Http\Controllers\Admin\ProgramController::class);
        Route::patch('programs/{program}/toggle', [\App\Http\Controllers\Admin\ProgramController::class, 'toggle'])->name('programs.toggle');
        Route::get('programs/service/{service}', [\App\Http\Controllers\Admin\ProgramController::class, 'getByService'])->name('programs.by-service');

        // Schedules Management
        Route::resource('schedules', \App\Http\Controllers\Admin\ScheduleController::class);
        Route::patch('schedules/{schedule}/toggle', [\App\Http\Controllers\Admin\ScheduleController::class, 'toggle'])->name('schedules.toggle');
        Route::get('schedules/program/{program}', [\App\Http\Controllers\Admin\ScheduleController::class, 'getByProgram'])->name('schedules.by-program');
        Route::get('schedules/calendar', [\App\Http\Controllers\Admin\ScheduleController::class, 'calendar'])->name('schedules.calendar');
    });
});

require __DIR__.'/auth.php';
