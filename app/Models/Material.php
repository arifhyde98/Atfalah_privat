<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_id',
        'curriculum_item_id',
        'title',
        'description',
        'type',
        'file_path',
        'external_url',
        'status',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function curriculumItem()
    {
        return $this->belongsTo(CurriculumItem::class, 'curriculum_item_id');
    }
}