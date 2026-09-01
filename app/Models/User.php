<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function studentProfile()
    {
        return $this->hasOne(StudentProfile::class, 'user_id');
    }

    public function teacherProfile()
    {
        return $this->hasOne(TeacherProfile::class, 'user_id');
    }

    // Student relationships
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    public function classStudents()
    {
        return $this->hasMany(ClassStudent::class, 'student_id');
    }

    public function studentClasses()
    {
        return $this->belongsToMany(ClassModel::class, 'class_students', 'student_id', 'class_id')
                    ->withPivot(['id', 'enrollment_id', 'status'])
                    ->withTimestamps();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'student_id');
    }

    public function progressRecords()
    {
        return $this->hasMany(ProgressRecord::class, 'student_id');
    }

    public function studentFeedbacks()
    {
        return $this->hasMany(TeacherFeedback::class, 'student_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id');
    }

    // Teacher relationships
    public function teacherClasses()
    {
        return $this->hasMany(ClassModel::class, 'teacher_id');
    }

    public function teacherSchedules()
    {
        return $this->hasMany(Schedule::class, 'teacher_id');
    }

    public function teacherAssessmentsGiven()
    {
        return $this->hasMany(Assessment::class, 'teacher_id');
    }

    public function teacherFeedbacksGiven()
    {
        return $this->hasMany(TeacherFeedback::class, 'teacher_id');
    }
}