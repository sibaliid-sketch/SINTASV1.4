<?php

namespace App\Models\SIMY;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentAchievement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'program_id',
        'badge_type', // completion, perfect_score, milestone, streak
        'title',
        'description',
        'icon_url',
        'earned_at',
    ];

    protected $casts = [
        'earned_at' => 'datetime',
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
}
