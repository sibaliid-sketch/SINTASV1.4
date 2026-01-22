<?php

namespace App\Models\SINTAS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'check_in',
        'check_out',
        'status',
        'notes',
        'location',
        'ip_address',
    ];

    protected $casts = [
        'date' => 'date',
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];

    /**
     * Get the user that owns the attendance.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Get working hours duration.
     */
    public function getWorkingHoursAttribute()
    {
        if ($this->check_in && $this->check_out) {
            return $this->check_in->diffInHours($this->check_out);
        }
        return 0;
    }

    /**
     * Check if late.
     */
    public function getIsLateAttribute()
    {
        if ($this->check_in) {
            $standardTime = $this->check_in->copy()->setTime(9, 0, 0);
            return $this->check_in->gt($standardTime);
        }
        return false;
    }
}
