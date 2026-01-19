<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'model_type',
        'model_id',
        'user_id',
        'user_name',
        'changes',
        'notes',
        'ip_address',
    ];

    protected $casts = [
        'changes' => 'json',
    ];
}
