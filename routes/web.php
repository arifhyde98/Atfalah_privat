<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

// ==========================================
// 1. PUBLIC WEBSITE ROUTES
// ==========================================
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/programs', [PublicController::class, 'programs'])->name('programs');
Route::get('/programs/{slug}', [PublicController::class, 'programDetail'])->name('programs.detail');
Route::get('/learning-method', [PublicController::class, 'learningMethod'])->name('learning.method');
Route::get('/teachers', [PublicController::class, 'teachers'])->name('teachers');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/assessment', [PublicController::class, 'assessment'])->name('assessment');

// ==========================================
// 2. AUTHENTICATION ROUTES
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// 3. ADMIN PORTAL ROUTES
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Students Management
    Route::get('/students', [AdminController::class, 'students'])->name('students.index');
    Route::get('/students/create', [AdminController::class, 'createStudent'])->name('students.create');
    Route::post('/students', [AdminController::class, 'storeStudent'])->name('students.store');
    Route::get('/students/{id}/edit', [AdminController::class, 'editStudent'])->name('students.edit');
    Route::put('/students/{id}', [AdminController::class, 'updateStudent'])->name('students.update');

    // Teachers Management
    Route::get('/teachers', [AdminController::class, 'teachers'])->name('teachers.index');
    Route::get('/teachers/create', [AdminController::class, 'createTeacher'])->name('teachers.create');
    Route::post('/teachers', [AdminController::class, 'storeTeacher'])->name('teachers.store');
    Route::get('/teachers/{id}/edit', [AdminController::class, 'editTeacher'])->name('teachers.edit');
    Route::put('/teachers/{id}', [AdminController::class, 'updateTeacher'])->name('teachers.update');

    // Programs & Curriculums
    Route::get('/programs', [AdminController::class, 'programs'])->name('programs.index');
    Route::get('/programs/create', [AdminController::class, 'createProgram'])->name('programs.create');
    Route::post('/programs', [AdminController::class, 'storeProgram'])->name('programs.store');
    Route::get('/programs/{id}/edit', [AdminController::class, 'editProgram'])->name('programs.edit');
    Route::put('/programs/{id}', [AdminController::class, 'updateProgram'])->name('programs.update');
    Route::post('/programs/{id}/curriculums', [AdminController::class, 'storeCurriculum'])->name('programs.curriculum.store');
    Route::delete('/curriculums/{id}', [AdminController::class, 'deleteCurriculum'])->name('curriculum.delete');

    // Enrollments
    Route::get('/enrollments', [AdminController::class, 'enrollments'])->name('enrollments.index');
    Route::post('/enrollments', [AdminController::class, 'storeEnrollment'])->name('enrollments.store');
    Route::patch('/enrollments/{id}/status', [AdminController::class, 'updateEnrollmentStatus'])->name('enrollments.updateStatus');

    // Classes
    Route::get('/classes', [AdminController::class, 'classes'])->name('classes.index');
    Route::post('/classes', [AdminController::class, 'storeClass'])->name('classes.store');
    Route::post('/classes/{id}/assign-student', [AdminController::class, 'assignStudentToClass'])->name('classes.assignStudent');

    // Schedules
    Route::get('/schedules', [AdminController::class, 'schedules'])->name('schedules.index');
    Route::post('/schedules', [AdminController::class, 'storeSchedule'])->name('schedules.store');

    // Payments
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments.index');
    Route::post('/payments', [AdminController::class, 'storePayment'])->name('payments.store');
    Route::patch('/payments/{id}/status', [AdminController::class, 'updatePaymentStatus'])->name('payments.updateStatus');

    // CMS Landing Page Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings.index');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
});

// ==========================================
// 4. TEACHER PORTAL ROUTES
// ==========================================
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
    Route::get('/classes', [TeacherController::class, 'classes'])->name('classes');
    Route::get('/schedules', [TeacherController::class, 'schedules'])->name('schedules');
    Route::get('/attendance/{scheduleId}', [TeacherController::class, 'attendanceForm'])->name('attendance');
    Route::post('/attendance/{scheduleId}', [TeacherController::class, 'saveAttendance'])->name('attendance.save');
    Route::get('/assessments', [TeacherController::class, 'assessments'])->name('assessments');
    Route::post('/assessments', [TeacherController::class, 'storeAssessment'])->name('assessments.store');
    Route::get('/feedback', [TeacherController::class, 'feedback'])->name('feedback');
    Route::post('/feedback', [TeacherController::class, 'storeFeedback'])->name('feedback.store');
});

// ==========================================
// 5. STUDENT PORTAL ROUTES
// ==========================================
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/programs', [StudentController::class, 'myPrograms'])->name('programs');
    Route::get('/schedule', [StudentController::class, 'mySchedule'])->name('schedule');
    Route::get('/materials', [StudentController::class, 'materials'])->name('materials');
    Route::get('/attendances', [StudentController::class, 'attendances'])->name('attendances');
    Route::get('/progress', [StudentController::class, 'progress'])->name('progress');
    Route::get('/payments', [StudentController::class, 'payments'])->name('payments');
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
});
