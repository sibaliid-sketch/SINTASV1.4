<?php

namespace App\Models\SIMY;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_id',
        'schedule_id',
        'teacher_id',
        'title',
        'description',
        'instructions',
        'due_date',
        'max_score',
        'attachment_url',
        'allow_late_submission',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'allow_late_submission' => 'boolean',
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

    public function schedule()
    {
        return $this->belongsTo(\App\Models\General\Schedule::class);
    }

    public function teacher()
    {
        return $this->belongsTo(\App\Models\User::class, 'teacher_id');
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    // Methods
    public function isOverdue()
    {
        return now()->isAfter($this->due_date);
    }

    public function daysUntilDue()
    {
        return $this->due_date->diffInDays(now());
    }
}
