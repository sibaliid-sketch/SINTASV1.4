<?php

namespace App\Models\SIMY;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentSubmission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'assignment_id',
        'student_id',
        'submission_text',
        'submission_file_url',
        'submitted_at',
        'score',
        'feedback',
        'graded_at',
        'graded_by',
        'is_late',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'graded_at' => 'datetime',
        'is_late' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }

    public function gradedBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'graded_by');
    }

    // Methods
    public function isGraded()
    {
        return $this->score !== null;
    }

    public function getPercentage()
    {
        if (!$this->isGraded() || $this->assignment->max_score == 0) {
            return 0;
        }
        return ($this->score / $this->assignment->max_score) * 100;
    }
}
