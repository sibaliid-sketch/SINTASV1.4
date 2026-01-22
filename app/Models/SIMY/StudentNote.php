<?php

namespace App\Models\SIMY;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentNote extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'material_id',
        'program_id',
        'title',
        'content',
        'is_archived',
    ];

    protected $casts = [
        'is_archived' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function program()
    {
        return $this->belongsTo(\App\Models\General\Program::class);
    }
}
