<?php

namespace App\Models\SIMY;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizAttempt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'quiz_id',
        'student_id',
        'started_at',
        'completed_at',
        'score',
        'total_points',
        'percentage',
        'passed',
        'attempt_number',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'passed' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }

    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }

    // Methods
    public function isCompleted()
    {
        return $this->completed_at !== null;
    }

    public function getDuration()
    {
        if ($this->isCompleted()) {
            return $this->completed_at->diffInSeconds($this->started_at);
        }
        return now()->diffInSeconds($this->started_at);
    }
}
