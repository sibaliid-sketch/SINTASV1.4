<?php

namespace App\Services;

use App\Models\Registration;
use Illuminate\Support\Facades\Mail;

class RegistrationEmailService
{
    /**
     * Send registration confirmation email
     */
    public static function sendRegistrationConfirmation(Registration $registration): void
    {
        $email = $registration->is_self_register 
            ? $registration->student_email 
            : $registration->parent_email;

        $name = $registration->is_self_register 
            ? $registration->student_name 
            : $registration->parent_name;

        Mail::send('emails.registration-confirmation', [
            'registration' => $registration,
            'name' => $name,
        ], function ($message) use ($email, $name) {
            $message->to($email, $name)
                    ->subject('Konfirmasi Pendaftaran - Sibali.id');
        });
    }

    /**
     * Send invoice email
     */
    public static function sendInvoice(Registration $registration): void
    {
        $email = $registration->is_self_register 
            ? $registration->student_email 
            : $registration->parent_email;

        $name = $registration->is_self_register 
            ? $registration->student_name 
            : $registration->parent_name;

        $invoiceUrl = DocumentGenerationService::getInvoiceUrl($registration);

        Mail::send('emails.invoice', [
            'registration' => $registration,
            'name' => $name,
            'invoiceUrl' => $invoiceUrl,
        ], function ($message) use ($email, $name) {
            $message->to($email, $name)
                    ->subject('Invoice Pembayaran - Sibali.id');
        });
    }

    /**
     * Send contract email
     */
    public static function sendContract(Registration $registration): void
    {
        $email = $registration->is_self_register 
            ? $registration->student_email 
            : $registration->parent_email;

        $name = $registration->is_self_register 
            ? $registration->student_name 
            : $registration->parent_name;

        $contractUrl = DocumentGenerationService::getContractUrl($registration);

        Mail::send('emails.contract', [
            'registration' => $registration,
            'name' => $name,
            'contractUrl' => $contractUrl,
        ], function ($message) use ($email, $name) {
            $message->to($email, $name)
                    ->subject('Kontrak Belajar - Sibali.id');
        });
    }

    /**
     * Send account credentials email
     */
    public static function sendAccountCredentials(string $email, string $name, string $username, string $password, string $portal): void
    {
        Mail::send('emails.account-credentials', [
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'portal' => $portal,
        ], function ($message) use ($email, $name, $portal) {
            $message->to($email, $name)
                    ->subject("Akun {$portal} Anda - Sibali.id");
        });
    }

    /**
     * Send payment reminder email
     */
    public static function sendPaymentReminder(Registration $registration, int $daysRemaining): void
    {
        $email = $registration->is_self_register 
            ? $registration->student_email 
            : $registration->parent_email;

        $name = $registration->is_self_register 
            ? $registration->student_name 
            : $registration->parent_name;

        Mail::send('emails.payment-reminder', [
            'registration' => $registration,
            'name' => $name,
            'daysRemaining' => $daysRemaining,
        ], function ($message) use ($email, $name) {
            $message->to($email, $name)
                    ->subject('Pengingat Pembayaran - Sibali.id');
        });
    }

    /**
     * Send payment verification email
     */
    public static function sendPaymentVerified(Registration $registration): void
    {
        $email = $registration->is_self_register 
            ? $registration->student_email 
            : $registration->parent_email;

        $name = $registration->is_self_register 
            ? $registration->student_name 
            : $registration->parent_name;

        $receiptUrl = DocumentGenerationService::getReceiptUrl($registration);

        Mail::send('emails.payment-verified', [
            'registration' => $registration,
            'name' => $name,
            'receiptUrl' => $receiptUrl,
        ], function ($message) use ($email, $name) {
            $message->to($email, $name)
                    ->subject('Pembayaran Terverifikasi - Sibali.id');
        });
    }

    /**
     * Send all registration emails
     */
    public static function sendAllRegistrationEmails(Registration $registration): void
    {
        self::sendRegistrationConfirmation($registration);
        self::sendInvoice($registration);
        self::sendContract($registration);
    }
}
