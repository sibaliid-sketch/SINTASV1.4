<?php

namespace App\Models\SIMY;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssessmentResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'assessment_id',
        'student_id',
        'score',
        'feedback',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }

    public function program()
    {
        return $this->hasOneThrough(\App\Models\General\Program::class, Assessment::class, 'id', 'id', 'assessment_id', 'program_id');
    }

    // Methods
    public function getPercentage()
    {
        if ($this->assessment->max_score == 0) {
            return 0;
        }
        return ($this->score / $this->assessment->max_score) * 100;
    }

    public function isPassed()
    {
        return $this->score >= $this->assessment->pass_score;
    }
}
