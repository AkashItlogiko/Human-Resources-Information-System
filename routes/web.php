<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Employee Routes
Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');

// Attendance
Route::get('/attendance', function () {
    return "Attendance Page";
})->name('attendance');

// Salary
Route::get('/salary', function () {
    return "Salary Page";
})->name('salary');
