<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Sibali.id</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f8fafc; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        .header { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 40px 30px; text-align: center; }
        .content { padding: 40px 30px; color: #374151; line-height: 1.6; }
        .footer { background-color: #f9fafb; padding: 30px; text-align: center; color: #6b7280; font-size: 14px; }
        .otp-code { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 20px; border-radius: 12px; text-align: center; font-size: 32px; font-weight: bold; letter-spacing: 8px; margin: 30px 0; font-family: 'Courier New', monospace; }
        .warning { background-color: #fef3c7; border: 1px solid #f59e0b; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .info-box { background-color: #f3f4f6; border-left: 4px solid #f59e0b; padding: 20px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 style="margin: 0; font-size: 28px;">Verifikasi Akun</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Kode OTP untuk aktivasi akun Anda</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Halo <strong>{{ $registration->student_name }}</strong>,</p>

            <p>Terima kasih telah mendaftar di <strong>Sibali.id</strong>. Untuk mengaktifkan akun Anda, gunakan kode OTP berikut:</p>

            <!-- OTP Code -->
            <div class="otp-code">
                {{ $otp }}
            </div>

            <!-- Instructions -->
            <div class="info-box">
                <h3 style="margin-top: 0; color: #1f2937;">Cara Menggunakan Kode OTP:</h3>
                <ol style="margin: 10px 0; padding-left: 20px;">
                    <li>Kembali ke halaman konfirmasi pendaftaran</li>
                    <li>Masukkan kode OTP di kolom yang tersedia</li>
                    <li>Klik tombol "Verifikasi" untuk mengaktifkan akun</li>
                </ol>
            </div>

            <!-- Warning -->
            <div class="warning">
                <h3 style="margin-top: 0; color: #92400e;">⚠️ Peringatan Penting:</h3>
                <ul style="margin: 10px 0; padding-left: 20px; color: #92400e;">
                    <li>Kode OTP ini bersifat rahasia dan hanya berlaku untuk akun Anda</li>
                    <li>Kode OTP akan kadaluarsa dalam 30 menit</li>
                    <li>Jangan bagikan kode ini dengan siapapun</li>
                    <li>Setelah verifikasi, akun SIMY/SITRA Anda akan langsung aktif</li>
                </ul>
            </div>

            <!-- Account Information -->
            <div class="info-box">
                <h3 style="margin-top: 0; color: #1f2937;">Informasi Akun</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Order ID:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ $registration->order_id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Student ID:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ $registration->student_id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Program:</strong></td>
                        <td style="padding: 8px 0;">{{ $registration->program->name }}</td>
                    </tr>
                </table>
            </div>

            <!-- What Happens Next -->
            <p><strong>Setelah verifikasi OTP berhasil:</strong></p>
            <ul style="list-style: none; padding: 0;">
                <li>✅ Akun SIMY (Learning Management System) akan aktif</li>
                @if($registration->is_self_register && $registration->student_age >= 18)
                    <li>✅ Fitur manajemen pembayaran akan tersedia di SIMY</li>
                @else
                    <li>✅ Akun SITRA (Parent Monitoring) akan dibuat untuk orang tua</li>
                @endif
                <li>✅ Email kredensial login akan dikirim secara terpisah</li>
                <li>✅ Anda dapat langsung mengakses materi pembelajaran</li>
            </ul>

            <p>Jika Anda tidak meminta kode OTP ini, abaikan email ini.</p>

            <p>Salam,<br>
            <strong>Tim Sibali.id</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 PT. Siap Belajar Indonesia (Sibali.id). All rights reserved.</p>
            <p style="margin: 5px 0;">
                <a href="#" style="color: #f59e0b; text-decoration: none;">Kebijakan Privasi</a> |
                <a href="#" style="color: #f59e0b; text-decoration: none;">Syarat & Ketentuan</a>
            </p>
            <p style="margin: 10px 0 0 0; font-size: 12px; color: #9ca3af;">
                Email ini dikirim secara otomatis. Mohon tidak membalas email ini.
            </p>
        </div>
    </div>
</body>
</html>
