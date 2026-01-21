<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OtpService
{
    /**
     * Generate OTP code
     */
    public static function generate(string $email): string
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store OTP in cache for 10 minutes
        Cache::put("otp_{$email}", $otp, now()->addMinutes(10));
        
        return $otp;
    }

    /**
     * Verify OTP code
     */
    public static function verify(string $email, string $otp): bool
    {
        $cachedOtp = Cache::get("otp_{$email}");
        
        if (!$cachedOtp) {
            return false;
        }

        if ($cachedOtp !== $otp) {
            return false;
        }

        // Remove OTP from cache after successful verification
        Cache::forget("otp_{$email}");
        
        return true;
    }

    /**
     * Send OTP via email
     */
    public static function sendOtp(string $email, string $name, string $otp): void
    {
        Mail::send('emails.otp-verification', [
            'name' => $name,
            'otp' => $otp,
        ], function ($message) use ($email, $name) {
            $message->to($email, $name)
                    ->subject('Kode Verifikasi OTP - Sibali.id');
        });
    }

    /**
     * Generate and send OTP
     */
    public static function generateAndSend(string $email, string $name): string
    {
        $otp = self::generate($email);
        self::sendOtp($email, $name, $otp);
        
        return $otp;
    }

    /**
     * Check if OTP exists for email
     */
    public static function exists(string $email): bool
    {
        return Cache::has("otp_{$email}");
    }

    /**
     * Get remaining time for OTP
     */
    public static function getRemainingTime(string $email): ?int
    {
        if (!self::exists($email)) {
            return null;
        }

        $expiresAt = Cache::get("otp_{$email}_expires");
        if (!$expiresAt) {
            return null;
        }

        return max(0, $expiresAt - time());
    }

    /**
     * Resend OTP
     */
    public static function resend(string $email, string $name): string
    {
        // Remove old OTP
        Cache::forget("otp_{$email}");
        
        // Generate and send new OTP
        return self::generateAndSend($email, $name);
    }
}
