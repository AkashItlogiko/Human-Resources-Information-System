<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\AttendanceController;


require __DIR__.'/auth.php';

// Default Redirect → HR Dashboard
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Employee Routes
Route::middleware(['auth'])->group(function () {

    // Employee
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

    // Attendance
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/attendance/history', [AttendanceController::class, 'history'])->name('attendance.history');
    Route::get('/attendance/{id}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
    Route::put('/attendance/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
    Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');

    // Promotion
    Route::get('promotions', [PromotionController::class, 'index'])->name('promotions.index');
    Route::get('promotions/{employee}/create', [PromotionController::class, 'create'])->name('promotions.create');
    Route::post('promotions/{employee}', [PromotionController::class, 'store'])->name('promotions.store');
    Route::get('promotions/{employee}/history', [PromotionController::class, 'history'])->name('promotions.history');

    // keep promotion routes promotions/{employee}
    // create new routes to do same as promotions routes.
    Route::prefix('employees/{employee}/promotions')->group(function () {
    Route::get('/', [PromotionController::class, 'index'])->name('employees.promotions.index');
    Route::get('/create', [PromotionController::class, 'create'])->name('employees.promotions.create');
    Route::post('/', [PromotionController::class, 'store'])->name('employees.promotions.store');
    Route::get('/history', [PromotionController::class, 'history'])->name('employees.promotions.history');
});
    // Salary
    Route::get('salaries', [SalaryController::class, 'index'])->name('salaries.index');
    Route::get('salaries', [SalaryController::class, 'index'])->name('salaries.index');
    Route::post('salaries/disburse', [SalaryController::class, 'disburse'])->name('salaries.disburse');
    Route::get('salaries/{employee}/history', [SalaryController::class, 'history'])->name('salaries.history');


});
