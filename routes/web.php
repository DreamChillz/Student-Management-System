<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('students', StudentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('enrollments', EnrollmentController::class);
    Route::post('/enrollments/bulk-save/{studentId}', [EnrollmentController::class, 'bulkSave'])->name('enrollments.bulkSave');
    Route::get('/enrollments/{student_id}/assign-grade', [EnrollmentController::class, 'showAssignGrade'])->name('enrollments.assignGrade');
    Route::post('/enrollments/{student_id}/assign-grade', [EnrollmentController::class, 'updateMarks'])->name('enrollments.updateMarks');

    Route::get('reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/reports/export-students', [ReportController::class, 'exportStudents'])->name('export.students');
    Route::get('/reports/export-courses', [ReportController::class, 'exportCourses'])->name('export.courses');
});
