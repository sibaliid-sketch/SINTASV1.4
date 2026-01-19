<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class IdGeneratorService
{
    /**
     * Generate Invoice ID: INV/01/26/4821
     */
    public static function generateInvoiceId(): string
    {
        $month = now()->format('m');
        $year = now()->format('y');
        $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        return "INV/{$month}/{$year}/{$randomNumber}";
    }

    /**
     * Generate Receipt ID: KUI/01/26/2309
     */
    public static function generateReceiptId(): string
    {
        $month = now()->format('m');
        $year = now()->format('y');
        $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        return "KUI/{$month}/{$year}/{$randomNumber}";
    }

    /**
     * Generate Order ID: ORD1029384756
     */
    public static function generateOrderId(): string
    {
        $randomNumber = str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);

        return "ORD{$randomNumber}";
    }

    /**
     * Generate Student ID: ST4821
     */
    public static function generateStudentId(): string
    {
        $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        return "ST{$randomNumber}";
    }

    /**
     * Generate Contract ID: KTR/STU/26.01/ST4821
     */
    public static function generateContractId(string $studentId): string
    {
        $year = now()->format('y');
        $month = now()->format('m');

        return "KTR/STU/{$year}.{$month}/{$studentId}";
    }

    /**
     * Generate Cancellation ID: CNCL54321
     */
    public static function generateCancellationId(): string
    {
        $randomNumber = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        return "CNCL{$randomNumber}";
    }

    /**
     * Generate Refund ID: RFND54321
     */
    public static function generateRefundId(): string
    {
        $randomNumber = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        return "RFND{$randomNumber}";
    }

    /**
     * Generate Onboarding ID: ONBRD54321
     */
    public static function generateOnboardingId(): string
    {
        $randomNumber = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        return "ONBRD{$randomNumber}";
    }

    /**
     * Generate Schedule ID: SCH54321
     */
    public static function generateScheduleId(): string
    {
        $randomNumber = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        return "SCH{$randomNumber}";
    }

    /**
     * Generate Room ID: RNG1234
     */
    public static function generateRoomId(): string
    {
        $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        return "RNG{$randomNumber}";
    }
}
