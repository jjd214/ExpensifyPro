<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Approver\ApproverController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Employee\PolicyController as EmployeePolicyController;
use App\Http\Controllers\Approver\ApprovalController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Models\Approval;
use App\Models\Expense;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('category', CategoryController::class);
        Route::resource('policy', PolicyController::class);
    });
});

Route::prefix('employee')->name('employee.')->group(function () {
    Route::middleware(['auth', 'verified', 'role:employee'])->group(function () {
        Route::get('/dashboard', [EmployeeController::class, 'index'])->name('dashboard');
        Route::resource('expense', ExpenseController::class);

        Route::get('/policy', [EmployeePolicyController::class, 'index'])->name('policy.index');
        Route::get('/policy/{id}', [EmployeePolicyController::class, 'show'])->name('policy.show');
    });
});

Route::prefix('approver')->name('approver.')->group(function () {
    Route::middleware(['auth', 'verified', 'role:approver'])->group(function () {
        Route::get('/dashboard', [ApproverController::class, 'index'])->name('dashboard');

        Route::resource('approval', ApprovalController::class);
    });
});

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');

//     Route::resource('category', CategoryController::class);
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
