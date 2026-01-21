<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembayaran - Sibali.id</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f8fafc; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        .header { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; padding: 40px 30px; text-align: center; }
        .content { padding: 40px 30px; color: #374151; line-height: 1.6; }
        .footer { background-color: #f9fafb; padding: 30px; text-align: center; color: #6b7280; font-size: 14px; }
        .invoice-box { background-color: #f8fafc; border: 2px solid #3b82f6; padding: 25px; border-radius: 12px; margin: 20px 0; }
        .download-button { display: inline-block; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; margin: 20px 0; }
        .info-box { background-color: #f3f4f6; border-left: 4px solid #3b82f6; padding: 20px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 style="margin: 0; font-size: 28px;">Invoice Pembayaran</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Detail pembayaran pendaftaran program</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Halo <strong>{{ $registration->student_name }}</strong>,</p>

            <p>Berikut adalah invoice resmi untuk pembayaran pendaftaran program pembelajaran di Sibali.id.</p>

            <!-- Invoice Details -->
            <div class="invoice-box">
                <h2 style="margin-top: 0; color: #1d4ed8; text-align: center;">INVOICE</h2>
                <div style="border-top: 2px solid #3b82f6; margin: 20px 0;"></div>

                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Nomor Invoice:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ $registration->invoice_id ?? 'INV/' . date('m/y') . '/' . $registration->id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Tanggal:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ now()->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Order ID:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ $registration->order_id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Student ID:</strong></td>
                        <td style="padding: 8px 0;">{{ $registration->student_id }}</td>
                    </tr>
                </table>

                <div style="border-top: 1px solid #e5e7eb; margin: 20px 0;"></div>

                <h3 style="margin: 20px 0 10px 0; color: #1d4ed8;">Detail Pembayaran</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Program:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ $registration->program->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Layanan:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ $registration->service->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Harga Dasar:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">Rp {{ number_format($registration->base_price, 0, ',', '.') }}</td>
                    </tr>
                    @if($registration->discount_amount > 0)
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Diskon:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; color: #059669;">- Rp {{ number_format($registration->discount_amount, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    @if($registration->tax_amount > 0)
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>PPN:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">Rp {{ number_format($registration->tax_amount, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    <tr style="background-color: #f3f4f6;">
                        <td style="padding: 12px 0; border-bottom: 2px solid #3b82f6;"><strong>Total Pembayaran:</strong></td>
                        <td style="padding: 12px 0; border-bottom: 2px solid #3b82f6;"><strong>Rp {{ number_format($registration->total_price, 0, ',', '.') }}</strong></td>
                    </tr>
                </table>

                <div style="border-top: 1px solid #e5e7eb; margin: 20px 0;"></div>

                <div style="background-color: #eff6ff; padding: 15px; border-radius: 6px;">
                    <h4 style="margin: 0 0 10px 0; color: #1d4ed8;">Informasi Pembayaran</h4>
                    <p style="margin: 5px 0;"><strong>Bank:</strong> BCA</p>
                    <p style="margin: 5px 0;"><strong>Rekening:</strong> 1234567890</p>
                    <p style="margin: 5px 0;"><strong>Atas Nama:</strong> PT. Siap Belajar Indonesia</p>
                    <p style="margin: 5px 0;"><strong>Status:</strong>
                        <span style="color: {{ $registration->payment_status === 'paid' ? '#059669' : '#dc2626' }}; font-weight: bold;">
                            {{ $registration->payment_status === 'paid' ? 'Lunas' : 'Belum Dibayar' }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Download Link -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ DocumentGenerationService::getInvoiceUrl($registration) }}" class="download-button">
                    📄 Download Invoice PDF
                </a>
            </div>

            <!-- Important Notes -->
            <div class="info-box">
                <h3 style="margin-top: 0; color: #1f2937;">Catatan Penting:</h3>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Invoice ini merupakan bukti resmi pembelian layanan pendidikan</li>
                    <li>Simpan invoice ini untuk keperluan administrasi dan pajak</li>
                    <li>Pembayaran harus dilakukan sesuai nominal yang tertera</li>
                    <li>Invoice ini sah tanpa tanda tangan basah</li>
                </ul>
            </div>

            <!-- Contact Information -->
            <p>Jika Anda memiliki pertanyaan tentang invoice ini, silakan hubungi:</p>
            <ul style="list-style: none; padding: 0;">
                <li>📧 Email: finance@sibali.id</li>
                <li>📱 WhatsApp: +62 812-3456-7890</li>
            </ul>

            <p>Terima kasih atas kepercayaan Anda menggunakan layanan Sibali.id.</p>

            <p>Salam,<br>
            <strong>Tim Finance Sibali.id</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 PT. Siap Belajar Indonesia (Sibali.id). All rights reserved.</p>
            <p style="margin: 5px 0;">
                <a href="#" style="color: #3b82f6; text-decoration: none;">Kebijakan Privasi</a> |
                <a href="#" style="color: #3b82f6; text-decoration: none;">Syarat & Ketentuan</a>
            </p>
            <p style="margin: 10px 0 0 0; font-size: 12px; color: #9ca3af;">
                Email ini dikirim secara otomatis. Mohon tidak membalas email ini.
            </p>
        </div>
    </div>
</body>
</html>
