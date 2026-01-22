<?php

namespace App\Models\SIMY;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentProgress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'student_progresses';

    protected $fillable = [
        'student_id',
        'program_id',
        'registration_id',
        'total_materials',
        'completed_materials',
        'total_assignments',
        'completed_assignments',
        'total_quizzes',
        'completed_quizzes',
        'average_quiz_score',
        'average_assignment_score',
        'overall_progress_percentage',
        'status', // on_track, ahead, behind, completed
        'last_activity_at',
    ];

    protected $casts = [
        'last_activity_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }

    public function program()
    {
        return $this->belongsTo(\App\Models\General\Program::class);
    }

    public function registration()
    {
        return $this->belongsTo(\App\Models\General\Registration::class);
    }

    // Methods
    public function calculateProgress()
    {
        $total = ($this->total_materials + $this->total_assignments + $this->total_quizzes);
        if ($total == 0) {
            return 0;
        }
        $completed = ($this->completed_materials + $this->completed_assignments + $this->completed_quizzes);
        return ($completed / $total) * 100;
    }

    public function updateStatus()
    {
        $progress = $this->overall_progress_percentage;
        if ($progress >= 100) {
            $this->status = 'completed';
        } elseif ($progress >= 70) {
            $this->status = 'ahead';
        } elseif ($progress >= 30) {
            $this->status = 'on_track';
        } else {
            $this->status = 'behind';
        }
        return $this;
    }
}
