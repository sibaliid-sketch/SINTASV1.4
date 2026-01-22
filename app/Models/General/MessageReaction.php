<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageReaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'class_message_id',
        'user_id',
        'reaction_type', // like, love, wow, thinking, sad
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function message()
    {
        return $this->belongsTo(ClassMessage::class, 'class_message_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
