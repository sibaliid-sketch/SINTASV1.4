<?php

namespace App\Models;

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
        'program_id',
        'schedule_id',
        'promo_id',
        'student_name',
        'student_dob',
        'student_phone',
        'student_email',
        'student_gender',
        'student_address',
        'education_level',
        'class_level',
        'is_self_register',
        'parent_name',
        'parent_phone',
        'parent_email',
        'parent_relationship',
        'parent_address',
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
        return $this->belongsTo(Promo::class);
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
}
