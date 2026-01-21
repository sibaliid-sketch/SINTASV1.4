<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Diterima - Sibali.id</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f8fafc; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        .header { background: linear-gradient(135deg, #059669 0%, #047857 100%); color: white; padding: 40px 30px; text-align: center; }
        .content { padding: 40px 30px; color: #374151; line-height: 1.6; }
        .footer { background-color: #f9fafb; padding: 30px; text-align: center; color: #6b7280; font-size: 14px; }
        .success-icon { font-size: 48px; margin-bottom: 10px; }
        .success-message { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 25px; border-radius: 12px; text-align: center; margin: 20px 0; }
        .info-box { background-color: #f3f4f6; border-left: 4px solid #10b981; padding: 20px; margin: 20px 0; }
        .next-steps { background-color: #ecfdf5; border: 1px solid #10b981; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .portal-button { display: inline-block; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="success-icon">✅</div>
            <h1 style="margin: 0; font-size: 28px;">Pembayaran Diterima!</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Pembayaran Anda telah berhasil diverifikasi</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Halo <strong>{{ $registration->student_name }}</strong>,</p>

            <p>Selamat! Pembayaran untuk pendaftaran program Anda telah berhasil diverifikasi oleh tim kami.</p>

            <!-- Success Message -->
            <div class="success-message">
                <h2 style="margin: 0 0 10px 0; font-size: 24px;">🎉 Pembayaran Berhasil</h2>
                <p style="margin: 5px 0; font-size: 18px;">Order ID: {{ $registration->order_id }}</p>
                <p style="margin: 5px 0;">Jumlah: Rp {{ number_format($registration->total_price, 0, ',', '.') }}</p>
                <p style="margin: 10px 0 0 0; font-size: 14px;">Diverifikasi pada: {{ $verification_date->format('d M Y H:i') }} WIB</p>
            </div>

            <!-- Registration Details -->
            <div class="info-box">
                <h3 style="margin-top: 0; color: #1f2937;">Detail Pendaftaran Anda</h3>
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
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Student ID:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ $registration->student_id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Status:</strong></td>
                        <td style="padding: 8px 0;"><span style="color: #10b981; font-weight: bold;">Pembayaran Diterima</span></td>
                    </tr>
                </table>
            </div>

            <!-- Next Steps -->
            <div class="next-steps">
                <h3 style="margin-top: 0; color: #047857;">Langkah Selanjutnya:</h3>
                <ol style="margin: 10px 0; padding-left: 20px; color: #047857;">
                    <li><strong>OTP Verifikasi:</strong> Periksa email Anda untuk kode OTP aktivasi akun</li>
                    <li><strong>Aktivasi Akun:</strong> Masukkan kode OTP untuk mengaktifkan akun SIMY/SITRA</li>
                    <li><strong>Kredensial Login:</strong> Email terpisah akan dikirim dengan username dan password</li>
                    <li><strong>Mulai Belajar:</strong> Akses materi pembelajaran dan mulai perjalanan Anda</li>
                </ol>
            </div>

            <!-- What You Get -->
            <p><strong>Dengan pembayaran yang telah diverifikasi, Anda berhak mendapatkan:</strong></p>
            <ul style="list-style: none; padding: 0;">
                <li>✅ Akses penuh ke platform SIMY (Learning Management System)</li>
                <li>✅ Materi pembelajaran sesuai program yang dipilih</li>
                <li>✅ Jadwal kelas yang telah dipesan</li>
                <li>✅ Sertifikat setelah menyelesaikan program</li>
                <li>✅ Support teknis selama masa belajar</li>
                @if(!$registration->is_self_register || $registration->student_age < 18)
                    <li>✅ Akses SITRA untuk monitoring orang tua</li>
                @endif
            </ul>

            <!-- Portal Access -->
            <div style="text-align: center; margin: 30px 0;">
                <p style="margin-bottom: 15px; color: #6b7280;">
                    Setelah menerima email kredensial, Anda dapat login ke:
                </p>
                <a href="{{ route('simy') }}" class="portal-button">Akses SIMY</a>
                @if(!$registration->is_self_register || $registration->student_age < 18)
                    <br><br>
                    <a href="{{ route('sitra') }}" class="portal-button">Akses SITRA</a>
                @endif
            </div>

            <!-- Documents -->
            <div class="info-box">
                <h3 style="margin-top: 0; color: #1f2937;">Dokumen Penting</h3>
                <p style="margin: 10px 0;">Download dokumen berikut untuk arsip Anda:</p>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li><strong>Invoice:</strong> Bukti pembayaran resmi</li>
                    <li><strong>Kontrak Belajar:</strong> Perjanjian pembelajaran</li>
                    <li><strong>Kuitansi:</strong> Tanda terima pembayaran</li>
                </ul>
                <p style="margin: 15px 0 0 0; font-size: 14px; color: #6b7280;">
                    Dokumen dapat diunduh dari halaman konfirmasi pendaftaran atau dashboard akun Anda.
                </p>
            </div>

            <!-- Contact Information -->
            <p>Jika Anda memiliki pertanyaan tentang status pembayaran atau pendaftaran, hubungi tim support kami:</p>
            <ul style="list-style: none; padding: 0;">
                <li>📧 Email: support@sibali.id</li>
                <li>📱 WhatsApp: +62 812-3456-7890</li>
                <li>🕒 Jam Operasional: Senin-Jumat, 08:00-17:00 WIB</li>
            </ul>

            <p>Selamat bergabung dengan komunitas Sibali.id! Kami siap membantu Anda mencapai tujuan pembelajaran.</p>

            <p>Salam,<br>
            <strong>Tim Sibali.id</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 PT. Siap Belajar Indonesia (Sibali.id). All rights reserved.</p>
            <p style="margin: 5px 0;">
                <a href="#" style="color: #10b981; text-decoration: none;">Kebijakan Privasi</a> |
                <a href="#" style="color: #10b981; text-decoration: none;">Syarat & Ketentuan</a>
            </p>
            <p style="margin: 10px 0 0 0; font-size: 12px; color: #9ca3af;">
                Email ini dikirim secara otomatis setelah verifikasi pembayaran berhasil.
            </p>
        </div>
    </div>
</body>
</html>
