<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran - Sibali.id</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f8fafc; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 40px 30px; text-align: center; }
        .content { padding: 40px 30px; color: #374151; line-height: 1.6; }
        .footer { background-color: #f9fafb; padding: 30px; text-align: center; color: #6b7280; font-size: 14px; }
        .button { display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; margin: 20px 0; }
        .info-box { background-color: #f3f4f6; border-left: 4px solid #667eea; padding: 20px; margin: 20px 0; }
        .highlight { background-color: #fef3c7; padding: 15px; border-radius: 8px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 style="margin: 0; font-size: 28px;">Selamat Bergabung!</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Pendaftaran Anda telah berhasil diproses</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Halo <strong>{{ $registration->student_name }}</strong>,</p>

            <p>Selamat! Pendaftaran Anda untuk program pembelajaran di <strong>Sibali.id</strong> telah berhasil diproses. Berikut adalah detail pendaftaran Anda:</p>

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
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Layanan:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ $registration->service->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Mode:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ ucfirst($registration->class_mode) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Jadwal:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">
                            {{ $registration->schedule->day_of_week }}, {{ $registration->schedule->start_time }} - {{ $registration->schedule->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Total Pembayaran:</strong></td>
                        <td style="padding: 8px 0;"><strong>Rp {{ number_format($registration->total_price, 0, ',', '.') }}</strong></td>
                    </tr>
                </table>
            </div>

            <!-- Next Steps -->
            <div class="highlight">
                <h3 style="margin-top: 0; color: #92400e;">Langkah Selanjutnya:</h3>
                <ol style="margin: 10px 0; padding-left: 20px;">
                    <li><strong>Verifikasi Email:</strong> Periksa email Anda untuk kode OTP</li>
                    <li><strong>Pembayaran:</strong> Lakukan pembayaran sesuai instruksi</li>
                    <li><strong>Verifikasi:</strong> Tim kami akan memverifikasi pembayaran dalam 1-2 hari kerja</li>
                    <li><strong>Aktivasi Akun:</strong> Akun SIMY/SITRA akan diaktifkan setelah verifikasi</li>
                </ol>
            </div>

            <!-- Payment Information -->
            @if($registration->payment_status === 'unpaid')
                <div class="info-box">
                    <h3 style="margin-top: 0; color: #1f2937;">Informasi Pembayaran</h3>
                    <p><strong>Rekening Tujuan:</strong> BCA - 1234567890 a.n PT. Siap Belajar Indonesia</p>
                    <p><strong>Jumlah:</strong> Rp {{ number_format($registration->total_price, 0, ',', '.') }}</p>
                    <p><strong>Deadline:</strong> {{ $registration->payment_deadline->format('d M Y H:i') }} WIB</p>
                    <p style="color: #dc2626; margin-top: 10px;"><strong>Penting:</strong> Pembayaran harus dilakukan sebelum deadline untuk menghindari pembatalan otomatis.</p>
                </div>
            @endif

            <!-- Contact Information -->
            <p>Jika Anda memiliki pertanyaan, silakan hubungi tim support kami:</p>
            <ul style="list-style: none; padding: 0;">
                <li>📧 Email: support@sibali.id</li>
                <li>📱 WhatsApp: +62 812-3456-7890</li>
            </ul>

            <p>Terima kasih telah memilih Sibali.id sebagai partner pembelajaran Anda!</p>

            <p>Salam,<br>
            <strong>Tim Sibali.id</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 PT. Siap Belajar Indonesia (Sibali.id). All rights reserved.</p>
            <p style="margin: 5px 0;">
                <a href="#" style="color: #667eea; text-decoration: none;">Kebijakan Privasi</a> |
                <a href="#" style="color: #667eea; text-decoration: none;">Syarat & Ketentuan</a>
            </p>
        </div>
    </div>
</body>
</html>
