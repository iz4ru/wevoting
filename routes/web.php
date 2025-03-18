<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\Auth\AdminLoginController;

Route::view('/', 'index');

Route::middleware('auth') -> group(function(){

    # Admin Home
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');

    # Logout Session
    Route::post('auth/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    # Profile
    Route::get('admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::get('admin/profile/user/{uuid}', [ProfileController::class, 'showAdminProfile'])->name('admin.profile.show');    
    Route::put('admin/profile/update/{uuid}', [ProfileController::class, 'updateAdmin'])->name('admin.profile.update');

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

    # Voters
    Route::get('voter', [VoterController::class, 'index'])->name('voter');

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

// Route::middleware([RoleMiddleware::class . ':admin'])->group(function() {
// });

Route::middleware('guest') -> group(function (){
    Route::get('auth/admin', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('auth/admin', [AdminLoginController::class, 'login_action'])->name('admin.login_action');
    Route::get('auth/admin/register', [AdminLoginController::class, 'registerFirstAdmin'])->name('register.admin');
    Route::post('auth/admin/register', [AdminLoginController::class, 'storeFirstAdmin'])->name('register.admin.store');

});


// Route::get('/admin/login', function () {
    //     return view('admin.auth.login');
    // })->name('admin.login');
    
    
Route::get('/login-user', function () {
    return view('login-user');
})->name('login.user');

Route::get('/users/login', function () {
    return view('users.auth.login');
})->name('users.login');

require __DIR__.'/auth.php';
