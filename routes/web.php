<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;

Route::view('/', 'index');

Route::middleware('auth') -> group(function(){
    Route::view('profile', 'profile')->name('profile');// ->middleware(['auth'])

    Route::view('dashboard', 'admin.dashboard')->name('dashboard');// ->middleware(['auth', 'verified'])

    Route::get('auth/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');// ->middleware('auth');
    
    # Admin Management
    Route::get('admin-mgmt', [AdminController::class, 'index'])->name('admin.mgmt');
    Route::get('admin-mgmt/create', [AdminController::class, 'createAdmin'])->name('admin.mgmt.create');
    Route::post('admin-mgmt/store', [AdminController::class, 'storeAdmin'])->name('admin.mgmt.store');
    Route::get('admin-mgmt/user/{id}', [AdminController::class, 'showAdminProfile'])->name('admin.mgmt.show');
    Route::put('admin-mgmt/update/{id}', [AdminController::class, 'updateAdmin'])->name('admin.mgmt.update');
    Route::delete('admin-mgmt/delete/{id}', [AdminController::class, 'deleteAdmin'])->name('admin.mgmt.delete');
    Route::get('admin-mgmt/form_password/{id}', [AdminController::class, 'formAdminPassword'])->name('admin.mgmt.form_password');
    Route::put('admin-mgmt/change_password/{id}', [AdminController::class, 'changeAdminPassword'])->name('admin.mgmt.change_password');

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
