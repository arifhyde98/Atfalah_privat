<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'tagline',
        'description',
        'learning_goal',
        'target_audience',
        'status',
    ];

    public function curriculumItems()
    {
        return $this->hasMany(CurriculumItem::class, 'program_id')->orderBy('sequence', 'asc');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'program_id');
    }

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'program_id');
    }

    public function materials()
    {
        return $this->hasMany(Material::class, 'program_id');
    }
}