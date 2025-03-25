<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\SuccessVoteController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\VoterLoginController;

# Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('landing.page');

# Login Index
Route::get('/login-user', function () {return view('login-user');})->name('login.user');

# Admin and Operators
Route::middleware('auth') -> group(function(){

    # Admin Home
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('dashboard-update', [HomeController::class, 'dashboardUpdate'])->name('dashboard.update');

    # Toggle On / Off Election
    Route::get('/election/start', [VotingController::class, 'startElectionSession'])->name('election.start');
    Route::get('/election/stop', [VotingController::class, 'stopElectionSession'])->name('election.stop');

    # Logout Session
    Route::post('auth/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    # Profile
    Route::get('admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::get('admin/profile/user/{uuid}', [ProfileController::class, 'showAdminProfile'])->name('admin.profile.show');    
    Route::put('admin/profile/update/{uuid}', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');

    # Admin Management
    Route::get('admin-mgmt', [AdminController::class, 'index'])->name('admin.mgmt');
    Route::get('admin-mgmt/create', [AdminController::class, 'createAdmin'])->name('admin.mgmt.create');
    Route::post('admin-mgmt/store', [AdminController::class, 'storeAdmin'])->name('admin.mgmt.store');
    Route::get('admin-mgmt/user/{uuid}', [AdminController::class, 'showAdminProfile'])->name('admin.mgmt.show');
    Route::put('admin-mgmt/update/{uuid}', [AdminController::class, 'updateAdmin'])->name('admin.mgmt.update');
    Route::delete('admin-mgmt/delete/{uuid}', [AdminController::class, 'deleteAdmin'])->name('admin.mgmt.delete');
    Route::get('admin-mgmt/form_password/{uuid}', [AdminController::class, 'formAdminPassword'])->name('admin.mgmt.form_password');
    Route::put('admin-mgmt/change_password/{uuid}', [AdminController::class, 'changeAdminPassword'])->name('admin.mgmt.change_password');

    # Candidates
    Route::get('candidate', [CandidateController::class, 'index'])->name('candidate');
    Route::get('candidate/create', [CandidateController::class, 'createCandidate'])->name('candidate.create');
    Route::post('candidate/store', [CandidateController::class, 'storeCandidate'])->name('candidate.store');
    Route::get('candidate/show/{id}', [CandidateController::class, 'showCandidate'])->name('candidate.show');
    Route::put('candidate/update/{id}', [CandidateController::class, 'updateCandidate'])->name('candidate.update');
    Route::delete('candidate/delete/{id}', [CandidateController::class, 'deleteCandidate'])->name('candidate.delete');
    Route::get('candidate/preview/{id}', [CandidateController::class, 'previewCandidate'])->name('candidate.preview');

    # Voters
    Route::get('voter', [VoterController::class, 'index'])->name('voter');
    Route::get('voter/create', [VoterController::class, 'createVoter'])->name('voter.create');
    Route::post('voter/store', [VoterController::class, 'storeVoter'])->name('voter.store');
    Route::get('voter/show/{uuid}', [VoterController::class, 'showVoter'])->name('voter.show');
    Route::put('voter/update/{uuid}', [VoterController::class, 'updateVoter'])->name('voter.update');
    Route::delete('voter/delete/{uuid}', [VoterController::class, 'deleteVoter'])->name('voter.delete');
    Route::delete('voter/truncate', [VoterController::class, 'truncateVoter'])->name('voter.truncate');
    Route::get('voter/validation', [VoterController::class, 'validationVoter'])->name('voter.validation');
    Route::get('voter/import', [VoterController::class, 'showImportVoter'])->name('voter.show.import');
    Route::post('voter/import/onload', [VoterController::class, 'importVoter'])->name('voter.import');
    Route::get('voter/export', [VoterController::class, 'exportVoter'])->name('voter.export');

    # Positions
    Route::get('position', [PositionController::class, 'index'])->name('position');
    Route::get('position/create', [PositionController::class, 'createPosition'])->name('position.create');
    Route::post('position/store', [PositionController::class, 'storePosition'])->name('position.store');
    Route::get('position/show/{id}', [PositionController::class, 'showPosition'])->name('position.show');
    Route::put('position/update/{id}', [PositionController::class, 'updatePosition'])->name('position.update');
    Route::delete('position/delete/{id}', [PositionController::class, 'deletePosition'])->name('position.delete');

    # Logs
    Route::get('logs', [LogController::class, 'index'])->name('logs');

});

# Admin Authentication
Route::middleware('guest') -> group(function (){
    Route::get('auth/admin', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('auth/admin', [AdminLoginController::class, 'login_action'])->name('admin.login_action');
    Route::get('auth/admin/register', [AdminLoginController::class, 'registerFirstAdmin'])->name('register.admin');
    Route::post('auth/admin/register', [AdminLoginController::class, 'storeFirstAdmin'])->name('register.admin.store');

});

# -----------------------------------------------------------------------------------------------

# Voter Authentication
Route::middleware('guest')->group(function(){
    Route::get('auth/voter', [VoterLoginController::class, 'index'])->name('voter.login');
    Route::post('auth/voter', [VoterLoginController::class, 'login_action'])->name('voter.login_action');
    Route::post('auth/voter/logout', [VoterLoginController::class, 'logout'])->name('voter.logout');
});

Route::get('voter/vote/success', [SuccessVoteController::class, 'index'])->name('vote.success');

Route::middleware(['auth:voters']) -> group(function(){
    Route::get('voter/dashboard', [VotingController::class, 'index'])->name('voter.dashboard');
    Route::post('voter/dashboard/vote', [VotingController::class, 'vote'])->name('voter.voting');
    Route::get('voter/candidate/preview/{id}', [VotingController::class, 'previewCandidate'])->name('voter.candidate.preview');
});

require __DIR__.'/auth.php';
