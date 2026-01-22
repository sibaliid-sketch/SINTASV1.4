<?php

namespace App\Models\General;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'parent_id',
        'department',
        'position',
        'level',
        'google_id',
        'google_token',
        'google_refresh_token',
        'avatar',
        'bio',
        'date_of_birth',
        'phone',
        'address',
        'city',
        'country',
        'language',
        'notification_settings',
        'linkedin_url',
        'twitter_url',
        'github_url',
        'website_url',
        'two_factor_enabled',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'login_count',
        'last_login_at',
        'login_devices',
        'profile_visible',
        'show_email',
        'show_activity',
        'referral_code',
        'referred_by',
        'achievements',
        'points',
        'bookmarks',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
        'two_factor_confirmed_at' => 'datetime',
        'last_login_at' => 'datetime',
        'notification_settings' => 'array',
        'two_factor_recovery_codes' => 'array',
        'login_devices' => 'array',
        'achievements' => 'array',
        'bookmarks' => 'array',
        'two_factor_enabled' => 'boolean',
        'profile_visible' => 'boolean',
        'show_email' => 'boolean',
        'show_activity' => 'boolean',
    ];

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(\App\Models\Welcomeguest\Article::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'student_id');
    }

    public function payments()
    {
        return $this->hasManyThrough(PaymentProof::class, Registration::class, 'student_id', 'registration_id', 'id', 'id');
    }

    public function grades()
    {
        return $this->hasMany(\App\Models\SIMY\AssessmentResult::class, 'student_id');
    }

    public function assignments()
    {
        return $this->hasManyThrough(\App\Models\SIMY\Assignment::class, Registration::class, 'student_id', 'program_id', 'id', 'program_id');
    }

    public function schedules()
    {
        return $this->hasManyThrough(Schedule::class, Registration::class, 'student_id', 'program_id', 'id', 'program_id');
    }

    public function programs()
    {
        return $this->hasManyThrough(Program::class, Registration::class, 'student_id', 'id', 'id', 'program_id');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset('storage/avatars/' . $this->avatar) : null;
    }

    public function getInitialsAttribute()
    {
        $parts = explode(' ', $this->name);
        return strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
    }

    public function getProfileCompletionAttribute()
    {
        $fields = ['avatar', 'bio', 'phone', 'address', 'city', 'country', 'date_of_birth'];
        $completed = 0;

        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $completed++;
            }
        }

        return round(($completed / count($fields)) * 100);
    }

    public function hasAchievement($achievement)
    {
        return in_array($achievement, $this->achievements ?? []);
    }

    public function addAchievement($achievement)
    {
        $achievements = $this->achievements ?? [];
        if (!in_array($achievement, $achievements)) {
            $achievements[] = $achievement;
            $this->update(['achievements' => $achievements]);
        }
    }

    public function addPoints($points)
    {
        $this->increment('points', $points);
    }
}
