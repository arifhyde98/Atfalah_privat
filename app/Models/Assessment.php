<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'enrollment_id',
        'type',
        'assessment_date',
        'score',
        'level',
        'notes',
        'recommendation',
    ];

    protected $casts = [
        'assessment_date' => 'date',
        'score' => 'float',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id');
    }

    public function items()
    {
        return $this->hasMany(AssessmentItem::class, 'assessment_id');
    }

    public function progressRecords()
    {
        return $this->hasMany(ProgressRecord::class, 'assessment_id');
    }
}