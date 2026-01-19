<?php

namespace App\Services;

use App\Models\PaymentProof;
use App\Models\Registration;
use App\Services\AuditLoggerService;

class PaymentVerificationService
{
    /**
     * Verify payment proof and update registration status
     */
    public static function verifyPayment(PaymentProof $paymentProof, bool $approved = true, ?string $notes = null)
    {
        if ($approved) {
            // Update payment proof status
            $paymentProof->update([
                'status' => 'approved',
                'verified_at' => now(),
                'verification_notes' => $notes,
            ]);

            // Update registration status
            $registration = $paymentProof->registration;
            $registration->update([
                'status' => 'active',
                'payment_status' => 'paid',
                'payment_verified_at' => now(),
            ]);

            // Create accounts
            $accounts = AccountCreationService::createAccountsForRegistration($registration);

            // Log audit
            AuditLoggerService::log('payment_verified', 'Registration', $registration->id, [], 'Pembayaran diverifikasi dan akun dibuat');

            // Send onboarding emails
            self::sendOnboardingEmails($registration, $accounts);

            // Notify admins
            NotificationService::notifyAdmins(
                'payment_verified',
                'Pembayaran Diverifikasi',
                "Pembayaran untuk pendaftaran {$registration->order_id} telah diverifikasi. Akun telah dibuat.",
                [
                    'registration_id' => $registration->id,
                    'accounts_created' => count($accounts),
                ]
            );

            return [
                'success' => true,
                'message' => 'Pembayaran berhasil diverifikasi',
                'accounts' => $accounts,
            ];
        } else {
            // Reject payment proof
            $paymentProof->update([
                'status' => 'rejected',
                'verified_at' => now(),
                'verification_notes' => $notes,
            ]);

            // Update registration status
            $registration = $paymentProof->registration;
            $registration->update([
                'status' => 'payment_rejected',
                'payment_status' => 'rejected',
            ]);

            // Log audit
            AuditLoggerService::log('payment_rejected', 'Registration', $registration->id, [], 'Pembayaran ditolak: ' . $notes);

            // Notify admins
            NotificationService::notifyAdmins(
                'payment_rejected',
                'Pembayaran Ditolak',
                "Pembayaran untuk pendaftaran {$registration->order_id} ditolak.",
                [
                    'registration_id' => $registration->id,
                    'reason' => $notes,
                ]
            );

            return [
                'success' => true,
                'message' => 'Pembayaran ditolak',
            ];
        }
    }

    /**
     * Send onboarding emails to created accounts
     */
    private static function sendOnboardingEmails(Registration $registration, array $accounts)
    {
        foreach ($accounts as $account) {
            // TODO: Implement email sending
            // Mail::to($account->email)->send(new OnboardingEmail($account, $registration));

            // For now, just log
            AuditLoggerService::log('onboarding_email_sent', 'User', $account->id, [], 'Email onboarding dikirim');
        }
    }

    /**
     * Generate receipt for verified payment
     */
    public static function generateReceipt(Registration $registration)
    {
        // TODO: Implement receipt generation
        // This could generate PDF receipt and store it

        $receiptData = [
            'receipt_id' => 'RCP-' . $registration->order_id,
            'registration' => $registration,
            'generated_at' => now(),
        ];

        // Store receipt or send to user
        AuditLoggerService::log('receipt_generated', 'Registration', $registration->id, [], 'Kuitansi dibuat');

        return $receiptData;
    }
}
