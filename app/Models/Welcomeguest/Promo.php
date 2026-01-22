<?php

namespace App\Models\Welcomeguest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_code',
        'description',
        'discount_type',
        'discount_value',
        'max_usage',
        'used_count',
        'start_date',
        'end_date',
        'created_by',
        'is_active',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function isValid(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->max_usage !== null && $this->used_count >= $this->max_usage) {
            return false;
        }

        $today = now()->toDateString();
        return $today >= $this->start_date->toDateString() && $today <= $this->end_date->toDateString();
    }

    public function calculateDiscount(float $basePrice): float
    {
        if ($this->discount_type === 'percentage') {
            return ($basePrice * $this->discount_value) / 100;
        }

        return (float) $this->discount_value;
    }
}
