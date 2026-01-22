<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'student_id',
        'service_id',
        'program_id',
        'schedule_id',
        'promo_id',
        'student_name',
        'student_identity_number',
        'student_dob',
        'student_phone',
        'student_email',
        'student_job',
        'student_gender',
        'student_address',
        'student_province',
        'student_regency',
        'student_district',
        'student_village',
        'student_address_detail',
        'student_age',
        'education_level',
        'class_level',
        'class_mode',
        'service_type',
        'is_self_register',
        'parent_name',
        'parent_identity_number',
        'parent_phone',
        'parent_email',
        'parent_relationship',
        'parent_address',
        'parent_province',
        'parent_regency',
        'parent_district',
        'parent_village',
        'parent_address_detail',
        'status',
        'base_price',
        'discount_amount',
        'tax_amount',
        'total_price',
        'payment_method',
        'payment_status',
        'payment_deadline',
        'invoice_id',
        'receipt_id',
        'onboarding_id',
        'contract_id',
        'cancellation_id',
        'refund_id',
        'cancellation_type',
        'refund_percentage',
        'refund_amount',
        'cancellation_reason',
    ];

    protected $casts = [
        'student_dob' => 'date',
        'base_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_price' => 'decimal:2',
        'refund_amount' => 'decimal:2',
        'payment_deadline' => 'date',
        'is_self_register' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Welcomeguest\Service::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function promo(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Welcomeguest\Promo::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function paymentProofs(): HasMany
    {
        return $this->hasMany(PaymentProof::class);
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class, 'model_id')
            ->where('model_type', 'Registration');
    }

    /**
     * Get full student address
     */
    public function getFullStudentAddressAttribute(): string
    {
        $parts = array_filter([
            $this->student_address_detail,
            $this->student_village,
            $this->student_district,
            $this->student_regency,
            $this->student_province,
        ]);
        
        return implode(', ', $parts);
    }

    /**
     * Get full parent address
     */
    public function getFullParentAddressAttribute(): ?string
    {
        if (!$this->parent_province) {
            return null;
        }

        $parts = array_filter([
            $this->parent_address_detail,
            $this->parent_village,
            $this->parent_district,
            $this->parent_regency,
            $this->parent_province,
        ]);
        
        return implode(', ', $parts);
    }

    /**
     * Check if registration requires parent data
     */
    public function requiresParentData(): bool
    {
        // If parent is registering, always require parent data
        if (!$this->is_self_register) {
            return true;
        }

        // If self-registering and under 18, require parent data
        if ($this->student_age < 18) {
            return true;
        }

        return false;
    }

    /**
     * Check if payment is overdue
     */
    public function isPaymentOverdue(): bool
    {
        if ($this->payment_status === 'paid') {
            return false;
        }

        return $this->payment_deadline && now()->isAfter($this->payment_deadline);
    }
}
