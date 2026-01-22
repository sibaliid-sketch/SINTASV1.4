<?php

namespace App\Services;

use App\Models\General\Registration;
use Illuminate\Support\Facades\Storage;

class DocumentGenerationService
{
    /**
     * Generate invoice HTML (can be converted to PDF later)
     */
    public static function generateInvoice(Registration $registration): string
    {
        $html = view('documents.invoice', [
            'registration' => $registration,
        ])->render();

        $filename = "invoice_{$registration->invoice_id}.html";
        $path = "invoices/{$registration->order_id}/{$filename}";
        
        Storage::disk('public')->put($path, $html);
        
        return $path;
    }

    /**
     * Generate contract HTML (can be converted to PDF later)
     */
    public static function generateContract(Registration $registration): string
    {
        $html = view('documents.contract', [
            'registration' => $registration,
        ])->render();

        $filename = "contract_{$registration->contract_id}.html";
        $path = "contracts/{$registration->order_id}/{$filename}";
        
        Storage::disk('public')->put($path, $html);
        
        return $path;
    }

    /**
     * Generate receipt HTML (after payment verification)
     */
    public static function generateReceipt(Registration $registration): string
    {
        $html = view('documents.receipt', [
            'registration' => $registration,
        ])->render();

        $filename = "receipt_{$registration->receipt_id}.html";
        $path = "receipts/{$registration->order_id}/{$filename}";
        
        Storage::disk('public')->put($path, $html);
        
        return $path;
    }

    /**
     * Generate all documents for registration
     */
    public static function generateAllDocuments(Registration $registration): array
    {
        $documents = [];

        // Generate invoice
        $documents['invoice'] = self::generateInvoice($registration);

        // Generate contract
        $documents['contract'] = self::generateContract($registration);

        // Generate receipt if payment is verified
        if ($registration->payment_status === 'paid') {
            $documents['receipt'] = self::generateReceipt($registration);
        }

        return $documents;
    }

    /**
     * Get invoice download URL
     */
    public static function getInvoiceUrl(Registration $registration): string
    {
        $path = "invoices/{$registration->order_id}/invoice_{$registration->invoice_id}.html";
        return asset('storage/' . $path);
    }

    /**
     * Get contract download URL
     */
    public static function getContractUrl(Registration $registration): string
    {
        $path = "contracts/{$registration->order_id}/contract_{$registration->contract_id}.html";
        return asset('storage/' . $path);
    }

    /**
     * Get receipt download URL
     */
    public static function getReceiptUrl(Registration $registration): string
    {
        $path = "receipts/{$registration->order_id}/receipt_{$registration->receipt_id}.html";
        return asset('storage/' . $path);
    }

    /**
     * Check if invoice exists
     */
    public static function invoiceExists(Registration $registration): bool
    {
        return Storage::disk('public')->exists("invoices/{$registration->order_id}/invoice_{$registration->invoice_id}.html");
    }

    /**
     * Check if contract exists
     */
    public static function contractExists(Registration $registration): bool
    {
        return Storage::disk('public')->exists("contracts/{$registration->order_id}/contract_{$registration->contract_id}.html");
    }

    /**
     * Check if receipt exists
     */
    public static function receiptExists(Registration $registration): bool
    {
        return Storage::disk('public')->exists("receipts/{$registration->order_id}/receipt_{$registration->receipt_id}.html");
    }
}
