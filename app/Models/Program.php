<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'service_id',
        'name',
        'code',
        'description',
        'education_level',
        'education_levels',
        'class_mode',
        'service_type',
        'media',
        'class_location',
        'sessions_count',
        'hpp',
        'duration',
        'price',
        'unit',
        'min_education_level',
        'max_education_level',
        'curriculum',
        'max_students',
        'for_parent_register',
        'for_self_register',
        'min_age',
        'max_age',
        'features',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'hpp' => 'decimal:2',
        'sessions_count' => 'integer',
        'duration' => 'integer',
        'is_active' => 'boolean',
        'for_parent_register' => 'boolean',
        'for_self_register' => 'boolean',
        'education_levels' => 'array',
    ];

    protected $appends = [
        'formatted_price',
        'formatted_hpp',
        'profit_margin',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Scope to filter programs by service
     */
    public function scopeByService($query, int $serviceId)
    {
        return $query->where('service_id', $serviceId);
    }

    /**
     * Scope to filter programs by class mode
     */
    public function scopeByClassMode($query, string $classMode)
    {
        return $query->where('class_mode', $classMode);
    }

    /**
     * Scope to filter programs by education level
     */
    public function scopeByEducationLevel($query, string $educationLevel)
    {
        return $query->where('education_level', $educationLevel);
    }

    /**
     * Scope to get active programs only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get programs filtered by registration criteria
     */
    public static function getFilteredPrograms(int $serviceId, string $classMode, string $educationLevel)
    {
        return self::active()
            ->byService($serviceId)
            ->byClassMode($classMode)
            ->byEducationLevel($educationLevel)
            ->with('schedules')
            ->get();
    }

    /**
     * Scope to filter programs by media
     */
    public function scopeByMedia($query, string $media)
    {
        return $query->where('media', $media);
    }

    /**
     * Scope to filter programs by class location
     */
    public function scopeByClassLocation($query, string $classLocation)
    {
        return $query->where('class_location', $classLocation);
    }

    /**
     * Get formatted price accessor
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get formatted HPP accessor
     */
    public function getFormattedHppAttribute(): string
    {
        return 'Rp ' . number_format($this->hpp, 0, ',', '.');
    }

    /**
     * Get profit margin accessor
     */
    public function getProfitMarginAttribute(): float
    {
        if ($this->hpp == 0) {
            return 0;
        }
        return (($this->price - $this->hpp) / $this->hpp) * 100;
    }

    /**
     * Get formatted profit margin
     */
    public function getFormattedProfitMarginAttribute(): string
    {
        return number_format($this->profit_margin, 2) . '%';
    }

    /**
     * Check if program is available for given education level range
     */
    public function isAvailableForEducationLevel(string $educationLevel): bool
    {
        // If no min/max specified, available for all
        if (!$this->min_education_level && !$this->max_education_level) {
            return true;
        }

        // Define education level hierarchy
        $levels = [
            'PAUD/KB', 'TK A', 'TK B',
            'Kelas 1 SD', 'Kelas 2 SD', 'Kelas 3 SD', 'Kelas 4 SD', 'Kelas 5 SD', 'Kelas 6 SD',
            'Kelas 7 SMP', 'Kelas 8 SMP', 'Kelas 9 SMP',
            'Kelas 10 SMA', 'Kelas 11 SMA', 'Kelas 12 SMA',
            'Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6', 'Semester 7', 'Semester 8', 'Semester Akhir', 'Lulus Profesi'
        ];

        $currentIndex = array_search($educationLevel, $levels);
        $minIndex = $this->min_education_level ? array_search($this->min_education_level, $levels) : 0;
        $maxIndex = $this->max_education_level ? array_search($this->max_education_level, $levels) : count($levels) - 1;

        if ($currentIndex === false) {
            return true; // If level not in hierarchy, allow it
        }

        return $currentIndex >= $minIndex && $currentIndex <= $maxIndex;
    }
}
