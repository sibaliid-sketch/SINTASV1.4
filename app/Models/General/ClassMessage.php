<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_id',
        'schedule_id',
        'sender_id',
        'message_text',
        'message_file_url',
        'message_type', // text, file, question, answer
        'parent_message_id',
        'is_pinned',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
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

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function parentMessage()
    {
        return $this->belongsTo(ClassMessage::class, 'parent_message_id');
    }

    public function replies()
    {
        return $this->hasMany(ClassMessage::class, 'parent_message_id');
    }

    public function reactions()
    {
        return $this->hasMany(MessageReaction::class);
    }
}
