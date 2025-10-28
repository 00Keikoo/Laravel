<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PositionController;

Route::get('/', function () {
    return redirect()->route('employees.index');
});

Route::resource('employees', EmployeeController::class);

Route::resource('attendance', AttendanceController::class);

Route::resource('departments', DepartmentController::class);

Route::resource('salaries', SalaryController::class);

Route::resource('positions', PositionController::class);

Route::get('/report', [ReportController::class, 'index'])->name('report.index');
