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
    Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
    Route::get('promotions/{employee}/create', [PromotionController::class, 'create'])->name('promotions.create');
    Route::post('promotions/{employee}', [PromotionController::class, 'store'])->name('promotions.store');
    Route::get('promotions/{employee}/history', [PromotionController::class, 'history'])->name('promotions.history');

    // Salary
    Route::get('salaries', [SalaryController::class, 'index'])->name('salaries.index');
    Route::get('salaries/{employee}/create', [SalaryController::class, 'create'])->name('salaries.create');
    Route::post('salaries/{employee}', [SalaryController::class, 'store'])->name('salaries.store');
    Route::get('salaries/{employee}/edit', [SalaryController::class, 'edit'])->name('salaries.edit');
    Route::put('salaries/{employee}', [SalaryController::class, 'update'])->name('salaries.update');
    Route::delete('salaries/{employee}', [SalaryController::class, 'destroy'])->name('salaries.destroy');
    Route::get('salaries/{employee}/history', [SalaryController::class, 'history'])->name('salaries.history');
    Route::delete('salary-histories/{history}', [SalaryController::class, 'destroyHistory'])->name('salary-histories.destroy');
});
