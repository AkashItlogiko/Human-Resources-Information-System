<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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
Route::get('/attendance', function () {
    return "Attendance Page";
})->name('attendance');

// Salary
Route::get('/salary', function () {
    return "Salary Page";
})->name('salary');
