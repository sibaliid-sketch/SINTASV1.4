<?php

namespace App\Models\SIMY;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'material_id',
        'program_id',
        'title',
        'description',
        'type', // formative, summative, diagnostic
        'max_score',
        'pass_score',
        'assessment_date',
        'is_published',
    ];

    protected $casts = [
        'assessment_date' => 'datetime',
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function program()
    {
        return $this->belongsTo(\App\Models\General\Program::class);
    }

    public function results()
    {
        return $this->hasMany(AssessmentResult::class);
    }
}
