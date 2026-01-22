<?php

namespace App\Models\SIMY;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_id',
        'title',
        'description',
        'content',
        'type', // video, pdf, slideshow, interactive, document
        'media_url',
        'thumbnail_url',
        'duration', // in minutes for video
        'order',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function program()
    {
        return $this->belongsTo(\App\Models\General\Program::class);
    }

    public function notes()
    {
        return $this->hasMany(StudentNote::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
