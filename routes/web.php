<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SimyController;
use App\Http\Controllers\SitraController;
use App\Http\Controllers\SintasController;
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
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/simy', [SimyController::class, 'index'])->middleware(['auth', 'verified'])->name('simy');

Route::get('/sitra', [SitraController::class, 'index'])->middleware(['auth', 'verified'])->name('sitra');

Route::get('/sintas', [SintasController::class, 'index'])->middleware(['auth', 'verified'])->name('sintas');

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
    Route::get('/academic', [SintasController::class, 'academic'])->name('academic');
    Route::get('/academic/overview', [SintasController::class, 'overviewAcademic'])->name('overview.academic');
    Route::get('/engagement-retention', [SintasController::class, 'engagementRetention'])->name('engagement-retention');
    Route::get('/engagement-retention/overview', [SintasController::class, 'overviewEngagementRetention'])->name('overview.engagement-retention');
});

// Registration Routes (Pendaftaran Layanan & Program)
Route::prefix('register')->name('registration.')->group(function () {
    Route::get('/', [RegistrationController::class, 'index'])->name('intro');
    Route::get('/step1', [RegistrationController::class, 'step1Show'])->name('step1');
    Route::post('/step1', [RegistrationController::class, 'step1Submit'])->name('step1-submit');
    Route::get('/step2', [RegistrationController::class, 'step2Show'])->name('step2');
    Route::post('/step2', [RegistrationController::class, 'step2Submit'])->name('step2-submit');
    Route::get('/step3', [RegistrationController::class, 'step3Show'])->name('step3');
    Route::post('/step3', [RegistrationController::class, 'step3Submit'])->name('step3-submit');
    Route::get('/step4', [RegistrationController::class, 'step4Show'])->name('step4');
    Route::post('/step4', [RegistrationController::class, 'step4Submit'])->name('step4-submit');
    Route::get('/step5', [RegistrationController::class, 'step5Show'])->name('step5');
    Route::post('/step5', [RegistrationController::class, 'step5Submit'])->name('step5-submit');
    Route::get('/step6', [RegistrationController::class, 'step6Show'])->name('step6');
    Route::post('/step6', [RegistrationController::class, 'step6Submit'])->name('step6-submit');
    Route::get('/step7', [RegistrationController::class, 'step7Show'])->name('step7');
    Route::post('/step7', [RegistrationController::class, 'step7Submit'])->name('step7-submit');
    Route::get('/step8/{registration}', [RegistrationController::class, 'step8Show'])->name('step8');
    Route::post('/step8/{registration}', [RegistrationController::class, 'step8Submit'])->name('step8-submit');
    Route::get('/step9/{registration}', [RegistrationController::class, 'step9Show'])->name('step9');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
