<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi - {{ $registration->order_id }}</title>
    <style>
        body { font-family: 'Times New Roman', serif; margin: 0; padding: 20px; font-size: 12px; line-height: 1.4; }
        .receipt-container { max-width: 600px; margin: 0 auto; border: 2px solid #000; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 15px; margin-bottom: 20px; }
        .receipt-title { font-size: 18px; font-weight: bold; margin: 10px 0; }
        .receipt-number { font-size: 14px; margin: 5px 0; }
        .amount-box { text-align: center; border: 2px solid #000; padding: 15px; margin: 20px 0; font-size: 16px; font-weight: bold; }
        .amount-text { font-size: 12px; margin-bottom: 10px; }
        .amount-value { font-size: 18px; color: #000; }
        .details { margin: 20px 0; }
        .detail-row { margin: 8px 0; }
        .detail-label { font-weight: bold; display: inline-block; width: 120px; }
        .signature-section { margin-top: 40px; text-align: center; }
        .signature-line { border-bottom: 1px solid #000; width: 200px; margin: 40px auto 10px auto; display: inline-block; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; border-top: 1px solid #000; padding-top: 15px; }
        .received-by { margin-top: 20px; text-align: left; }
    </style>
</head>
<body>
    <div class="receipt-container">
        <!-- Header -->
        <div class="header">
            <div style="font-size: 16px; font-weight: bold;">PT. Siap Belajar Indonesia</div>
            <div>Sibali.id</div>
            <div>Jl. Contoh No. 123, Jakarta</div>
        </div>

        <!-- Receipt Title -->
        <div class="receipt-title">KUITANSI PEMBAYARAN</div>
        <div class="receipt-number">
            No: {{ $registration->receipt_id ?? 'KUI/' . date('m/y') . '/' . $registration->id }}
        </div>

        <!-- Amount Box -->
        <div class="amount-box">
            <div class="amount-text">Telah Terima Dari</div>
            <div style="font-size: 14px; margin: 10px 0;">{{ $registration->student_name }}</div>
            <div class="amount-text">Uang Sejumlah</div>
            <div class="amount-value">Rp {{ number_format($registration->total_price, 0, ',', '.') }}</div>
            <div class="amount-text" style="margin-top: 10px;">Terbilang:</div>
            <div style="font-size: 12px; font-style: italic; margin-top: 5px;">
                {{ \App\Services\IdGeneratorService::numberToWords($registration->total_price) }} Rupiah
            </div>
        </div>

        <!-- Payment Details -->
        <div class="details">
            <div class="detail-row">
                <span class="detail-label">Untuk Pembayaran:</span>
                Program {{ $registration->program->name }}
            </div>
            <div class="detail-row">
                <span class="detail-label">Order ID:</span>
                {{ $registration->order_id }}
            </div>
            <div class="detail-row">
                <span class="detail-label">Student ID:</span>
                {{ $registration->student_id }}
            </div>
            <div class="detail-row">
                <span class="detail-label">Layanan:</span>
                {{ $registration->service->name }}
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal Bayar:</span>
                {{ $registration->payment_verified_at ? $registration->payment_verified_at->format('d M Y') : now()->format('d M Y') }}
            </div>
            <div class="detail-row">
                <span class="detail-label">Metode Bayar:</span>
                Transfer Bank BCA
            </div>
        </div>

        <!-- Received By Section -->
        <div class="received-by">
            <table style="width: 100%; margin-top: 20px;">
                <tr>
                    <td style="width: 50%; text-align: center; vertical-align: top;">
                        <div>Diterima oleh,</div>
                        <div class="signature-line"></div>
                        <div style="margin-top: 5px;">Admin Keuangan</div>
                        <div style="margin-top: 5px; font-size: 10px;">
                            Tanggal: {{ $registration->payment_verified_at ? $registration->payment_verified_at->format('d M Y') : now()->format('d M Y') }}
                        </div>
                    </td>
                    <td style="width: 50%; text-align: center; vertical-align: top;">
                        <div>Pembayar,</div>
                        <div class="signature-line"></div>
                        <div style="margin-top: 5px;">{{ $registration->student_name }}</div>
                        <div style="margin-top: 5px; font-size: 10px;">
                            Tanggal: {{ $registration->payment_verified_at ? $registration->payment_verified_at->format('d M Y') : now()->format('d M Y') }}
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Kuitansi ini merupakan bukti pembayaran yang sah</p>
            <p>&copy; 2024 PT. Siap Belajar Indonesia. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
