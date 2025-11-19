<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\SuccessVoteController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\VoterLoginController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Accessible by anyone)
|--------------------------------------------------------------------------
*/

# Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('landing.page');

# Login Index Page
Route::get('/login-user', function () {
    return view('login-user');
})->name('login.user');

# Route untuk halaman search code (public - bisa diakses siapa saja)
Route::get('/search-code', [VoterController::class, 'showSearchPage'])->name('voter.search');

# API route untuk search functionality (public API)
Route::get('/api/search-voter', [VoterController::class, 'searchVoterByUserID'])->name('api.voter.search');

/*
|--------------------------------------------------------------------------
| ADMIN AUTHENTICATION ROUTES (Only for guests - not logged in)
|--------------------------------------------------------------------------
*/

Route::middleware('guest:web')->group(function () {
    # Admin Login
    Route::get('auth/admin', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('auth/admin', [AdminLoginController::class, 'login_action'])->name('admin.login_action');
    
    # Admin Registration (First Admin Only)
    Route::get('auth/admin/register', [AdminLoginController::class, 'registerFirstAdmin'])->name('register.admin');
    Route::post('auth/admin/register', [AdminLoginController::class, 'storeFirstAdmin'])->name('register.admin.store');
    
    # Password Reset Routes
    Route::get('/forgot-password', [ResetPasswordController::class, 'index'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendPasswordResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| VOTER AUTHENTICATION ROUTES (Only for voter guests)
|--------------------------------------------------------------------------
*/

Route::middleware('voter.guest')->group(function() {
    Route::get('auth/voter', [VoterLoginController::class, 'index'])->name('voter.login');
    Route::post('auth/voter', [VoterLoginController::class, 'login_action'])->name('voter.login_action');
});

/*
|--------------------------------------------------------------------------
| VOTER PROTECTED ROUTES (Only for authenticated voters)
|--------------------------------------------------------------------------
*/

# Success page bisa diakses tanpa auth (setelah logout)
Route::get('voter/vote/success', [SuccessVoteController::class, 'index'])->name('vote.success');

# ❌ HAPUS 'voter.access' - hanya gunakan 'auth:voters' dan 'voter.validate'
Route::middleware(['auth:voters', 'voter.validate'])->group(function() {
    Route::get('voter/dashboard', [VotingController::class, 'index'])->name('voter.dashboard');
    Route::post('voter/dashboard/vote', [VotingController::class, 'vote'])->name('voter.voting');
    Route::get('voter/candidate/preview/{id}', [VotingController::class, 'previewCandidate'])->name('voter.candidate.preview');
    
    Route::post('auth/voter/logout', [VoterLoginController::class, 'logout'])->name('voter.logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED ROUTES (Only for authenticated admins)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:web', 'no.voter'])->group(function() {
    
    # Dashboard
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('dashboard-update', [HomeController::class, 'dashboardUpdate'])->name('dashboard.update');
    Route::get('dashboard/export', [HomeController::class, 'exportData'])->name('dashboard.export');
    
    # Election Control
    Route::get('/election/start', [VotingController::class, 'startElectionSession'])->name('election.start');
    Route::get('/election/stop', [VotingController::class, 'stopElectionSession'])->name('election.stop');
    
    # Admin Logout
    Route::post('auth/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    
    # Admin Profile
    Route::get('admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::get('admin/profile/user/{uuid}', [ProfileController::class, 'showAdminProfile'])->name('admin.profile.show');    
    Route::put('admin/profile/update/{uuid}', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
    
    # Admin Management
    Route::prefix('admin-mgmt')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('admin.mgmt');
        Route::get('/create', [AdminController::class, 'createAdmin'])->name('admin.mgmt.create');
        Route::post('/store', [AdminController::class, 'storeAdmin'])->name('admin.mgmt.store');
        Route::get('/user/{uuid}', [AdminController::class, 'showAdminProfile'])->name('admin.mgmt.show');
        Route::put('/update/{uuid}', [AdminController::class, 'updateAdmin'])->name('admin.mgmt.update');
        Route::delete('/delete/{uuid}', [AdminController::class, 'deleteAdmin'])->name('admin.mgmt.delete');
        Route::get('/form_password/{uuid}', [AdminController::class, 'formAdminPassword'])->name('admin.mgmt.form_password');
        Route::put('/change_password/{uuid}', [AdminController::class, 'changeAdminPassword'])->name('admin.mgmt.change_password');
    });
    
    # Candidates Management
    Route::prefix('candidate')->group(function() {
        Route::get('/', [CandidateController::class, 'index'])->name('candidate');
        Route::get('/create', [CandidateController::class, 'createCandidate'])->name('candidate.create');
        Route::post('/store', [CandidateController::class, 'storeCandidate'])->name('candidate.store');
        Route::get('/show/{id}', [CandidateController::class, 'showCandidate'])->name('candidate.show');
        Route::put('/update/{id}', [CandidateController::class, 'updateCandidate'])->name('candidate.update');
        Route::delete('/delete/{id}', [CandidateController::class, 'deleteCandidate'])->name('candidate.delete');
        Route::get('/preview/{id}', [CandidateController::class, 'previewCandidate'])->name('candidate.preview');
    });
    
    # Voters Management
    Route::prefix('voter')->group(function() {
        Route::get('/', [VoterController::class, 'index'])->name('voter');
        Route::get('/create', [VoterController::class, 'createVoter'])->name('voter.create');
        Route::post('/store', [VoterController::class, 'storeVoter'])->name('voter.store');
        Route::get('/show/{uuid}', [VoterController::class, 'showVoter'])->name('voter.show');
        Route::put('/update/{uuid}', [VoterController::class, 'updateVoter'])->name('voter.update');
        Route::delete('/delete/{uuid}', [VoterController::class, 'deleteVoter'])->name('voter.delete');
        Route::delete('/truncate', [VoterController::class, 'truncateVoter'])->name('voter.truncate');
        Route::get('/validation', [VoterController::class, 'validationVoter'])->name('voter.validation');
        Route::get('/import', [VoterController::class, 'showImportVoter'])->name('voter.show.import');
        Route::post('/import/onload', [VoterController::class, 'importVoter'])->name('voter.import');
        Route::get('/export', [VoterController::class, 'exportVoter'])->name('voter.export');
        Route::get('/export-pdf', [VoterController::class, 'exportVoterPDF'])->name('voter.export.pdf');
    });
    
    # Position Management
    Route::prefix('position')->group(function() {
        Route::get('/', [PositionController::class, 'index'])->name('position');
        Route::get('/show/{id}', [PositionController::class, 'showPosition'])->name('position.show');
        Route::put('/update/{id}', [PositionController::class, 'updatePosition'])->name('position.update');
        Route::delete('/delete/{id}', [PositionController::class, 'deletePosition'])->name('position.delete');
    });
    
    # Activity Logs
    Route::get('logs', [LogController::class, 'index'])->name('logs');
});

require __DIR__.'/auth.php';
