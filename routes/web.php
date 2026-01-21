<?php

use App\Http\Controllers\AdminChatController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SimyController;
use App\Http\Controllers\SitraController;
use App\Http\Controllers\SintasController;
use App\Http\Controllers\SocialAuthController;
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

Route::get('/articles', function () {
    return view('welcome.welcomeguest.articles');
})->name('articles.index');
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/simy', [SimyController::class, 'index'])->middleware(['auth', 'verified'])->name('simy');

Route::get('/sitra', [SitraController::class, 'index'])->middleware(['auth', 'verified'])->name('sitra');

Route::get('/sintas', [SintasController::class, 'index'])->middleware(['auth', 'verified'])->name('sintas');
Route::get('/sintas/welcome', [SintasController::class, 'welcome'])->middleware(['auth', 'verified'])->name('sintas.welcome');

Route::get('/overview', [SintasController::class, 'overview'])->middleware(['auth', 'verified'])->name('overview');

// Department Routes
Route::prefix('departments')->middleware(['auth', 'verified'])->name('departments.')->group(function () {
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
    Route::get('/it/chat-console', [SintasController::class, 'itChatConsole'])->name('it.chat-console');
    Route::get('/{department}/chat/messages/{user}', [SintasController::class, 'getChatMessages'])->name('chat.messages');
    Route::get('/academic', [SintasController::class, 'academic'])->name('academic');
    Route::get('/academic/overview', [SintasController::class, 'overviewAcademic'])->name('overview.academic');
    Route::get('/academic/services', [SintasController::class, 'academicServices'])->name('academic.services');
    Route::get('/academic/programs', [SintasController::class, 'academicPrograms'])->name('academic.programs');
    Route::get('/academic/schedules', [SintasController::class, 'academicSchedules'])->name('academic.schedules');
    Route::get('/engagement-retention', [SintasController::class, 'engagementRetention'])->name('engagement-retention');
    Route::get('/engagement-retention/overview', [SintasController::class, 'overviewEngagementRetention'])->name('overview.engagement-retention');
    Route::get('/pr', [SintasController::class, 'pr'])->name('pr');
    Route::get('/pr/overview', [SintasController::class, 'overviewPr'])->name('overview.pr');

    // General pages for each department
    Route::get('/operations/general', [SintasController::class, 'general'])->name('operations.general');
    Route::get('/it/general', [SintasController::class, 'general'])->name('it.general');
    Route::get('/academic/general', [SintasController::class, 'general'])->name('academic.general');
    Route::get('/sales-marketing/general', [SintasController::class, 'general'])->name('sales-marketing.general');
    Route::get('/finance/general', [SintasController::class, 'general'])->name('finance.general');
    Route::get('/product-rnd/general', [SintasController::class, 'general'])->name('product-rnd.general');
    Route::get('/pr/general', [SintasController::class, 'general'])->name('pr.general');
    Route::get('/engagement-retention/general', [SintasController::class, 'general'])->name('engagement-retention.general');

    // Tools pages for departments that have tools
    Route::get('/operations/tools', [SintasController::class, 'tools'])->name('operations.tools');
    Route::get('/it/tools', [SintasController::class, 'tools'])->name('it.tools');
    Route::get('/academic/tools', [SintasController::class, 'tools'])->name('academic.tools');
});

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
        Route::get('/', [\App\Http\Controllers\AttendanceController::class, 'index'])->name('index');
        Route::post('/check-in', [\App\Http\Controllers\AttendanceController::class, 'checkIn'])->name('check-in');
        Route::post('/check-out', [\App\Http\Controllers\AttendanceController::class, 'checkOut'])->name('check-out');
        Route::get('/history', [\App\Http\Controllers\AttendanceController::class, 'history'])->name('history');

        // Admin routes
        Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [\App\Http\Controllers\AttendanceController::class, 'adminIndex'])->name('index');
            Route::get('/export', [\App\Http\Controllers\AttendanceController::class, 'export'])->name('export');
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
