<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Employee Routes
Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
// Edit + Update
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employee.update');
// Delete
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

// Attendance
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
Route::get('/attendance/history', [AttendanceController::class, 'history'])->name('attendance.history');
// Edit + Update
Route::get('/attendance/{id}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
Route::put('/attendance/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
// Delete
Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');

// Promotion
    Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
    Route::get('promotions/{employee}/create', [PromotionController::class, 'create'])->name('promotions.create');
    Route::post('promotions/{employee}', [PromotionController::class, 'store'])->name('promotions.store');
    Route::get('promotions/{employee}/history', [PromotionController::class, 'history'])->name('promotions.history');


// Salary
Route::get('/salary', function () {
    return "Salary Page";
})->name('salary');
