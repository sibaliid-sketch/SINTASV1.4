<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengingat Pembayaran - Sibali.id</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f8fafc; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        .header { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; padding: 40px 30px; text-align: center; }
        .content { padding: 40px 30px; color: #374151; line-height: 1.6; }
        .footer { background-color: #f9fafb; padding: 30px; text-align: center; color: #6b7280; font-size: 14px; }
        .urgent-box { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; padding: 25px; border-radius: 12px; text-align: center; margin: 20px 0; }
        .countdown { font-size: 24px; font-weight: bold; margin: 10px 0; }
        .payment-info { background-color: #fef2f2; border: 2px solid #ef4444; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .info-box { background-color: #f3f4f6; border-left: 4px solid #ef4444; padding: 20px; margin: 20px 0; }
        .pay-button { display: inline-block; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; margin: 20px 0; font-size: 16px; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 style="margin: 0; font-size: 28px;">Pengingat Pembayaran</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Deadline pembayaran akan segera berakhir</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Halo <strong>{{ $registration->student_name }}</strong>,</p>

            <p>Kami ingin mengingatkan bahwa deadline pembayaran untuk pendaftaran program Anda akan segera berakhir.</p>

            <!-- Urgent Payment Notice -->
            <div class="urgent-box">
                <h2 style="margin: 0 0 10px 0; font-size: 20px;">⚠️ PEMBAYARAN MENDESAK</h2>
                <p style="margin: 5px 0;">Sisa waktu pembayaran:</p>
                <div class="countdown">{{ $days_remaining }} hari {{ $hours_remaining }} jam</div>
                <p style="margin: 10px 0 0 0; font-size: 14px;">
                    Deadline: {{ $registration->payment_deadline->format('d M Y H:i') }} WIB
                </p>
            </div>

            <!-- Registration Details -->
            <div class="info-box">
                <h3 style="margin-top: 0; color: #1f2937;">Detail Pendaftaran</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Order ID:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ $registration->order_id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Program:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ $registration->program->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Jumlah Tagihan:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Rp {{ number_format($registration->total_price, 0, ',', '.') }}</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Status Pembayaran:</strong></td>
                        <td style="padding: 8px 0;"><span style="color: #ef4444; font-weight: bold;">Belum Dibayar</span></td>
                    </tr>
                </table>
            </div>

            <!-- Payment Information -->
            <div class="payment-info">
                <h3 style="margin-top: 0; color: #dc2626;">Informasi Pembayaran</h3>
                <div style="background-color: white; padding: 15px; border-radius: 6px; margin: 15px 0;">
                    <p style="margin: 5px 0;"><strong>Bank:</strong> BCA</p>
                    <p style="margin: 5px 0;"><strong>Nomor Rekening:</strong> 1234567890</p>
                    <p style="margin: 5px 0;"><strong>Atas Nama:</strong> PT. Siap Belajar Indonesia</p>
                    <p style="margin: 5px 0;"><strong>Jumlah Transfer:</strong> Rp {{ number_format($registration->total_price, 0, ',', '.') }}</p>
                </div>
                <p style="color: #dc2626; margin: 15px 0 0 0; font-weight: bold;">
                    Pastikan jumlah transfer sesuai dengan nominal di atas
                </p>
            </div>

            <!-- Payment Instructions -->
            <div class="info-box">
                <h3 style="margin-top: 0; color: #1f2937;">Cara Pembayaran:</h3>
                <ol style="margin: 10px 0; padding-left: 20px;">
                    <li>Lakukan transfer ke rekening yang tertera di atas</li>
                    <li>Simpan bukti transfer (screenshot atau foto)</li>
                    <li>Login ke akun Anda di website Sibali.id</li>
                    <li>Upload bukti transfer di menu pembayaran</li>
                    <li>Tim kami akan memverifikasi dalam 1-2 hari kerja</li>
                </ol>
            </div>

            <!-- Consequences of Late Payment -->
            <div style="background-color: #fef2f2; border: 1px solid #fecaca; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h3 style="margin-top: 0; color: #dc2626;">Konsekuensi Keterlambatan Pembayaran:</h3>
                <ul style="margin: 10px 0; padding-left: 20px; color: #dc2626;">
                    <li>Pendaftaran akan dibatalkan otomatis</li>
                    <li>Jadwal kelas akan dibebaskan untuk peserta lain</li>
                    <li>Biaya pendaftaran tidak dapat dikembalikan</li>
                    <li>Perlu melakukan pendaftaran ulang jika masih berminat</li>
                </ul>
            </div>

            <!-- Payment Link -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('registration.step10', $registration->id) }}" class="pay-button">
                    🚀 Lakukan Pembayaran Sekarang
                </a>
            </div>

            <!-- Contact Information -->
            <p>Jika Anda sudah melakukan pembayaran atau mengalami kesulitan, segera hubungi tim support kami:</p>
            <ul style="list-style: none; padding: 0;">
                <li>📧 Email: support@sibali.id</li>
                <li>📱 WhatsApp: +62 812-3456-7890</li>
                <li>🕒 Jam Operasional: Senin-Jumat, 08:00-17:00 WIB</li>
            </ul>

            <p>Terima kasih atas perhatiannya. Kami menunggu konfirmasi pembayaran Anda.</p>

            <p>Salam,<br>
            <strong>Tim Sibali.id</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 PT. Siap Belajar Indonesia (Sibali.id). All rights reserved.</p>
            <p style="margin: 5px 0;">
                <a href="#" style="color: #ef4444; text-decoration: none;">Kebijakan Privasi</a> |
                <a href="#" style="color: #ef4444; text-decoration: none;">Syarat & Ketentuan</a>
            </p>
            <p style="margin: 10px 0 0 0; font-size: 12px; color: #9ca3af;">
                Email ini dikirim secara otomatis sebagai pengingat pembayaran.
            </p>
        </div>
    </div>
</body>
</html>
