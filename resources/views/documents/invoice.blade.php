<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $registration->order_id }}</title>
    <style>
        body { font-family: 'Times New Roman', serif; margin: 0; padding: 20px; font-size: 12px; line-height: 1.4; }
        .invoice-container { max-width: 800px; margin: 0 auto; border: 1px solid #000; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 20px; margin-bottom: 20px; }
        .company-info { float: left; width: 50%; }
        .invoice-info { float: right; width: 50%; text-align: right; }
        .clear { clear: both; }
        .bill-to { margin: 20px 0; }
        .invoice-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .invoice-table th, .invoice-table td { border: 1px solid #000; padding: 8px; text-align: left; }
        .invoice-table th { background-color: #f0f0f0; font-weight: bold; }
        .total-row { font-weight: bold; background-color: #f0f0f0; }
        .footer { margin-top: 40px; border-top: 1px solid #000; padding-top: 20px; text-align: center; font-size: 10px; }
        .signature-section { margin-top: 40px; display: table; width: 100%; }
        .signature-box { display: table-cell; width: 50%; text-align: center; vertical-align: top; }
        .signature-line { border-bottom: 1px solid #000; width: 200px; margin: 40px auto 10px auto; }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="header">
            <h1 style="margin: 0; font-size: 24px;">INVOICE</h1>
            <p style="margin: 5px 0;">PT. Siap Belajar Indonesia (Sibali.id)</p>
        </div>

        <!-- Company and Invoice Info -->
        <div class="company-info">
            <strong>PT. Siap Belajar Indonesia</strong><br>
            Jl. Contoh No. 123<br>
            Jakarta, Indonesia<br>
            Email: info@sibali.id<br>
            Telp: +62 21 12345678
        </div>

        <div class="invoice-info">
            <strong>Nomor Invoice:</strong> {{ $registration->invoice_id ?? 'INV/' . date('m/y') . '/' . $registration->id }}<br>
            <strong>Tanggal:</strong> {{ now()->format('d M Y') }}<br>
            <strong>Order ID:</strong> {{ $registration->order_id }}<br>
            <strong>Student ID:</strong> {{ $registration->student_id }}
        </div>

        <div class="clear"></div>

        <!-- Bill To -->
        <div class="bill-to">
            <strong>Tagihan Kepada:</strong><br>
            {{ $registration->student_name }}<br>
            @if($registration->student_identity_number)
                NIK: {{ $registration->student_identity_number }}<br>
            @endif
            {{ $registration->student_address }}<br>
            @if($registration->student_phone)
                Telp: {{ $registration->student_phone }}<br>
            @endif
            @if($registration->student_email)
                Email: {{ $registration->student_email }}
            @endif
        </div>

        <!-- Invoice Table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="50%">Deskripsi</th>
                    <th width="15%">Qty</th>
                    <th width="15%">Harga</th>
                    <th width="15%">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>Program: {{ $registration->program->name }}</strong><br>
                        Layanan: {{ $registration->service->name }}<br>
                        Mode: {{ ucfirst($registration->class_mode) }}<br>
                        Jadwal: {{ $registration->schedule->day_of_week }}, {{ $registration->schedule->start_time }} - {{ $registration->schedule->end_time }}
                    </td>
                    <td>1</td>
                    <td>Rp {{ number_format($registration->base_price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($registration->base_price, 0, ',', '.') }}</td>
                </tr>
                @if($registration->discount_amount > 0)
                <tr>
                    <td></td>
                    <td>Diskon Promo</td>
                    <td>1</td>
                    <td>- Rp {{ number_format($registration->discount_amount, 0, ',', '.') }}</td>
                    <td>- Rp {{ number_format($registration->discount_amount, 0, ',', '.') }}</td>
                </tr>
                @endif
                @if($registration->tax_amount > 0)
                <tr>
                    <td></td>
                    <td>PPN 11%</td>
                    <td>1</td>
                    <td>Rp {{ number_format($registration->tax_amount, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($registration->tax_amount, 0, ',', '.') }}</td>
                </tr>
                @endif
                <tr class="total-row">
                    <td colspan="4" style="text-align: right;"><strong>TOTAL PEMBAYARAN</strong></td>
                    <td><strong>Rp {{ number_format($registration->total_price, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Payment Information -->
        <div style="margin: 20px 0; padding: 15px; background-color: #f9f9f9; border: 1px solid #ddd;">
            <strong>Informasi Pembayaran:</strong><br>
            Bank: BCA<br>
            Nomor Rekening: 1234567890<br>
            Atas Nama: PT. Siap Belajar Indonesia<br>
            <br>
            <strong>Status Pembayaran:</strong>
            <span style="color: {{ $registration->payment_status === 'paid' ? 'green' : 'red' }}; font-weight: bold;">
                {{ $registration->payment_status === 'paid' ? 'LUNAS' : 'BELUM DIBAYAR' }}
            </span>
            @if($registration->payment_status === 'paid')
                <br><strong>Tanggal Pembayaran:</strong> {{ $registration->payment_verified_at ? $registration->payment_verified_at->format('d M Y H:i') : 'N/A' }}
            @endif
        </div>

        <!-- Terms -->
        <div style="margin: 20px 0; font-size: 11px;">
            <strong>Ketentuan:</strong>
            <ol style="margin: 10px 0; padding-left: 20px;">
                <li>Invoice ini merupakan bukti pembelian resmi</li>
                <li>Pembayaran harus dilakukan sesuai nominal yang tertera</li>
                <li>Biaya pendaftaran tidak dapat dikembalikan</li>
                <li>Invoice ini sah tanpa tanda tangan basah</li>
            </ol>
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-box">
                <p>Dibuat oleh,</p>
                <div class="signature-line"></div>
                <p><strong>Admin Sibali.id</strong></p>
                <p>Tanggal: {{ now()->format('d M Y') }}</p>
            </div>
            <div class="signature-box">
                <p>Penerima,</p>
                <div class="signature-line"></div>
                <p><strong>{{ $registration->student_name }}</strong></p>
                <p>Tanggal: {{ now()->format('d M Y') }}</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih telah memilih layanan pendidikan Sibali.id</p>
            <p>&copy; 2024 PT. Siap Belajar Indonesia. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
