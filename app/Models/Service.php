<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'class_mode',
        'education_levels',
        'for_parent_register',
        'for_self_register',
        'min_age',
        'max_age',
        'features',
        'is_active',
    ];

    protected $casts = [
        'education_levels' => 'array',
        'for_parent_register' => 'boolean',
        'for_self_register' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Scope to filter services by registrar type
     */
    public function scopeForRegistrarType($query, bool $isSelfRegister)
    {
        if ($isSelfRegister) {
            return $query->where('for_self_register', true);
        }
        return $query->where('for_parent_register', true);
    }

    /**
     * Scope to filter services by class mode
     */
    public function scopeByClassMode($query, string $classMode)
    {
        return $query->where(function ($q) use ($classMode) {
            $q->where('class_mode', $classMode)
              ->orWhere('class_mode', 'both');
        });
    }

    /**
     * Scope to filter services by education level
     */
    public function scopeByEducationLevel($query, string $educationLevel)
    {
        return $query->whereJsonContains('education_levels', $educationLevel);
    }

    /**
     * Scope to filter active services
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Check if service is available for given criteria
     */
    public function isAvailableFor(bool $isSelfRegister, string $classMode, string $educationLevel): bool
    {
        if (!$this->is_active) {
            return false;
        }

        // Check registrar type
        if ($isSelfRegister && !$this->for_self_register) {
            return false;
        }
        if (!$isSelfRegister && !$this->for_parent_register) {
            return false;
        }

        // Check class mode
        if ($this->class_mode !== 'both' && $this->class_mode !== $classMode) {
            return false;
        }

        // Check education level
        if ($this->education_levels && !in_array($educationLevel, $this->education_levels)) {
            return false;
        }

        return true;
    }
}
