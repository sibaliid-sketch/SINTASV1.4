<?php

namespace App\Models\SIMY;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentCertificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'program_id',
        'registration_id',
        'certificate_number',
        'issue_date',
        'expiry_date',
        'certificate_url',
        'verification_code',
        'is_verified',
    ];

    protected $casts = [
        'issue_date' => 'datetime',
        'expiry_date' => 'datetime',
        'is_verified' => 'boolean',
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
    public function isExpired()
    {
        if ($this->expiry_date === null) {
            return false;
        }
        return now()->isAfter($this->expiry_date);
    }

    public function isValid()
    {
        return $this->is_verified && !$this->isExpired();
    }
}
