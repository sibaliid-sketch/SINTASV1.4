<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kredensial Akun - Sibali.id</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f8fafc; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        .header { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 40px 30px; text-align: center; }
        .content { padding: 40px 30px; color: #374151; line-height: 1.6; }
        .footer { background-color: #f9fafb; padding: 30px; text-align: center; color: #6b7280; font-size: 14px; }
        .credentials-box { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 25px; border-radius: 12px; margin: 20px 0; text-align: center; }
        .credential-item { background-color: rgba(255, 255, 255, 0.1); padding: 15px; border-radius: 8px; margin: 10px 0; }
        .warning { background-color: #fef3c7; border: 1px solid #f59e0b; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .info-box { background-color: #f3f4f6; border-left: 4px solid #10b981; padding: 20px; margin: 20px 0; }
        .portal-link { display: inline-block; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 style="margin: 0; font-size: 28px;">Akun Anda Telah Aktif!</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Kredensial login untuk mengakses platform</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Halo <strong>{{ $registration->student_name }}</strong>,</p>

            <p>Selamat! Akun Anda telah berhasil diaktifkan. Berikut adalah kredensial login untuk mengakses platform pembelajaran Sibali.id:</p>

            <!-- Credentials Box -->
            <div class="credentials-box">
                <h2 style="margin-top: 0; font-size: 24px;">Kredensial Login</h2>

                @if(isset($simy_credentials))
                <div class="credential-item">
                    <h3 style="margin: 0 0 10px 0; font-size: 18px;">🖥️ SIMY (Learning Management System)</h3>
                    <p style="margin: 5px 0;"><strong>Username:</strong> {{ $simy_credentials['username'] }}</p>
                    <p style="margin: 5px 0;"><strong>Password:</strong> {{ $simy_credentials['password'] }}</p>
                    <p style="margin: 5px 0;"><strong>Portal:</strong> <a href="{{ route('simy') }}" style="color: #ffffff; text-decoration: underline;">simy.sibali.id</a></p>
                </div>
                @endif

                @if(isset($sitra_credentials))
                <div class="credential-item">
                    <h3 style="margin: 0 0 10px 0; font-size: 18px;">👨‍👩‍👧‍👦 SITRA (Parent Monitoring)</h3>
                    <p style="margin: 5px 0;"><strong>Username:</strong> {{ $sitra_credentials['username'] }}</p>
                    <p style="margin: 5px 0;"><strong>Password:</strong> {{ $sitra_credentials['password'] }}</p>
                    <p style="margin: 5px 0;"><strong>Portal:</strong> <a href="{{ route('sitra') }}" style="color: #ffffff; text-decoration: underline;">sitra.sibali.id</a></p>
                </div>
                @endif
            </div>

            <!-- Important Information -->
            <div class="warning">
                <h3 style="margin-top: 0; color: #92400e;">🔐 Informasi Penting:</h3>
                <ul style="margin: 10px 0; padding-left: 20px; color: #92400e;">
                    <li><strong>Ganti password</strong> segera setelah login pertama kali</li>
                    <li><strong>Jaga kerahasiaan</strong> kredensial login Anda</li>
                    <li><strong>Jangan bagikan</strong> password dengan siapapun</li>
                    <li><strong>Logout</strong> setelah selesai menggunakan platform</li>
                    <li>Password ini hanya berlaku untuk akun Anda</li>
                </ul>
            </div>

            <!-- Account Information -->
            <div class="info-box">
                <h3 style="margin-top: 0; color: #1f2937;">Detail Akun Anda</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Student ID:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ $registration->student_id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Program:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ $registration->program->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Jadwal:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">
                            {{ $registration->schedule->day_of_week }}, {{ $registration->schedule->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0;"><strong>Status:</strong></td>
                        <td style="padding: 8px 0;"><span style="color: #10b981; font-weight: bold;">Aktif</span></td>
                    </tr>
                </table>
            </div>

            <!-- What You Can Do -->
            <p><strong>Dengan akun ini, Anda dapat:</strong></p>
            <ul style="list-style: none; padding: 0;">
                <li>✅ Mengakses materi pembelajaran di SIMY</li>
                <li>✅ Melihat jadwal dan progress belajar</li>
                <li>✅ Mengikuti ujian dan kuis online</li>
                @if(isset($sitra_credentials))
                    <li>✅ Memantau aktivitas belajar anak (SITRA)</li>
                    <li>✅ Melihat laporan progress dan nilai</li>
                    <li>✅ Berkomunikasi dengan pengajar</li>
                @endif
                @if($registration->is_self_register && $registration->student_age >= 18)
                    <li>✅ Mengelola pembayaran dan tagihan</li>
                @endif
            </ul>

            <!-- Login Button -->
            <div style="text-align: center; margin: 30px 0;">
                @if(isset($simy_credentials))
                    <a href="{{ route('simy') }}" class="portal-link">Masuk ke SIMY</a>
                @endif
                @if(isset($sitra_credentials))
                    <br><br>
                    <a href="{{ route('sitra') }}" class="portal-link">Masuk ke SITRA</a>
                @endif
            </div>

            <!-- Support Information -->
            <p>Jika Anda mengalami kesulitan login atau memiliki pertanyaan, hubungi tim support kami:</p>
            <ul style="list-style: none; padding: 0;">
                <li>📧 Email: support@sibali.id</li>
                <li>📱 WhatsApp: +62 812-3456-7890</li>
                <li>🕒 Jam Operasional: Senin-Jumat, 08:00-17:00 WIB</li>
            </ul>

            <p>Selamat belajar dan sukses selalu!</p>

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
                Email ini dikirim secara otomatis. Mohon tidak membalas email ini.
            </p>
        </div>
    </div>
</body>
</html>
