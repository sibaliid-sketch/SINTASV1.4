<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassAnnouncement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_id',
        'schedule_id',
        'teacher_id',
        'title',
        'content',
        'announcement_type', // general, urgent, update, reminder
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function readBy()
    {
        return $this->belongsToMany(User::class, 'announcement_reads', 'announcement_id', 'user_id')
            ->withTimestamps();
    }
}
