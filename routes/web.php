<?php

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/employees', function () {
    return "All Employees Page";
})->name('employees');

Route::get('/attendance', function () {
    return "Attendance Page";
})->name('attendance');

Route::get('/salary', function () {
    return "Salary Page";
})->name('salary');

