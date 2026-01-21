<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrak Belajar - Sibali.id</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f8fafc; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        .header { background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%); color: white; padding: 40px 30px; text-align: center; }
        .content { padding: 40px 30px; color: #374151; line-height: 1.6; }
        .footer { background-color: #f9fafb; padding: 30px; text-align: center; color: #6b7280; font-size: 14px; }
        .contract-box { background-color: #faf5ff; border: 2px solid #7c3aed; padding: 25px; border-radius: 12px; margin: 20px 0; }
        .download-button { display: inline-block; background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%); color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; margin: 20px 0; }
        .info-box { background-color: #f3f4f6; border-left: 4px solid #7c3aed; padding: 20px; margin: 20px 0; }
        .warning { background-color: #fef3c7; border: 1px solid #f59e0b; padding: 20px; border-radius: 8px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 style="margin: 0; font-size: 28px;">Kontrak Belajar</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Perjanjian pembelajaran resmi</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Halo <strong>{{ $registration->student_name }}</strong>,</p>

            <p>Berikut adalah Kontrak Belajar resmi yang telah Anda setujui saat melakukan pendaftaran program pembelajaran di Sibali.id.</p>

            <!-- Contract Details -->
            <div class="contract-box">
                <h2 style="margin-top: 0; color: #5b21b6; text-align: center;">KONTRAK BELAJAR</h2>
                <div style="border-top: 2px solid #7c3aed; margin: 20px 0;"></div>

                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Nomor Kontrak:</strong></td>
                        <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">{{ $registration->contract_id ?? 'KTR/STU/' . date('m/y') . '/' . $registration->student_id }}</td>
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

                <h3 style="margin: 20px 0 10px 0; color: #5b21b6;">Pihak yang Terlibat</h3>

                <div style="background-color: white; padding: 15px; border-radius: 6px; margin: 15px 0;">
                    <h4 style="margin: 0 0 10px 0; color: #1f2937;">Pihak Pertama (Penyedia Layanan):</h4>
                    <p style="margin: 5px 0;"><strong>PT. Siap Belajar Indonesia (Sibali.id)</strong></p>
                    <p style="margin: 5px 0;">Jl. Contoh No. 123, Jakarta</p>
                    <p style="margin: 5px 0;">Email: info@sibali.id</p>
                </div>

                <div style="background-color: white; padding: 15px; border-radius: 6px; margin: 15px 0;">
                    <h4 style="margin: 0 0 10px 0; color: #1f2937;">Pihak Kedua (Peserta):</h4>
                    <p style="margin: 5px 0;"><strong>{{ $registration->student_name }}</strong></p>
                    <p style="margin: 5px 0;">{{ $registration->student_identity_number ? 'NIK: ' . $registration->student_identity_number : '' }}</p>
                    <p style="margin: 5px 0;">{{ $registration->student_email ?: 'Email: ' . $registration->student_email }}</p>
                    @if(!$registration->is_self_register)
                        <p style="margin: 5px 0;"><strong>Orang Tua/Wali: {{ $registration->parent_name }}</strong></p>
                    @endif
                </div>

                <div style="border-top: 1px solid #e5e7eb; margin: 20px 0;"></div>

                <h3 style="margin: 20px 0 10px 0; color: #5b21b6;">Program yang Disepakati</h3>
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
                        <td style="padding: 8px 0;"><strong>Biaya:</strong></td>
                        <td style="padding: 8px 0;"><strong>Rp {{ number_format($registration->total_price, 0, ',', '.') }}</strong></td>
                    </tr>
                </table>

                <div style="border-top: 1px solid #e5e7eb; margin: 20px 0;"></div>

                <h3 style="margin: 20px 0 10px 0; color: #5b21b6;">Ketentuan Utama</h3>
                <div style="background-color: white; padding: 15px; border-radius: 6px;">
                    <ol style="margin: 0; padding-left: 20px;">
                        <li>Peserta berkomitmen mengikuti seluruh program pembelajaran</li>
                        <li>Pembayaran telah dilakukan sesuai kesepakatan</li>
                        <li>Peserta wajib menjaga kerahasiaan materi pembelajaran</li>
                        <li>Penyedia layanan akan memberikan sertifikat setelah penyelesaian program</li>
                        <li>Perselisihan akan diselesaikan melalui musyawarah</li>
                    </ol>
                </div>
            </div>

            <!-- Download Link -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ DocumentGenerationService::getContractUrl($registration) }}" class="download-button">
                    📄 Download Kontrak PDF
                </a>
            </div>

            <!-- Important Notes -->
            <div class="warning">
                <h3 style="margin-top: 0; color: #92400e;">⚠️ Kontrak ini Bersifat Mengikat</h3>
                <ul style="margin: 10px 0; padding-left: 20px; color: #92400e;">
                    <li>Kontrak ini sah dan mengikat secara hukum</li>
                    <li>Simpan kontrak ini sebagai bukti perjanjian</li>
                    <li>Pelanggaran ketentuan dapat mengakibatkan sanksi</li>
                    <li>Kontrak ini berlaku selama masa program berlangsung</li>
                </ul>
            </div>

            <!-- Full Terms -->
            <div class="info-box">
                <h3 style="margin-top: 0; color: #1f2937;">Ketentuan Lengkap:</h3>
                <p style="margin: 10px 0;">Untuk melihat ketentuan lengkap, silakan download kontrak PDF di atas. Kontrak lengkap berisi:</p>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Hak dan kewajiban kedua belah pihak</li>
                    <li>Ketentuan pembatalan dan pengembalian dana</li>
                    <li>Kebijakan privasi dan penggunaan data</li>
                    <li>Force majeure dan kondisi khusus</li>
                    <li>Tanda tangan digital dan validasi</li>
                </ul>
            </div>

            <!-- Contact Information -->
            <p>Jika Anda memiliki pertanyaan tentang kontrak ini, silakan hubungi:</p>
            <ul style="list-style: none; padding: 0;">
                <li>📧 Email: legal@sibali.id</li>
                <li>📱 WhatsApp: +62 812-3456-7890</li>
            </ul>

            <p>Kontrak ini dibuat secara elektronik dan sah tanpa tanda tangan basah.</p>

            <p>Salam,<br>
            <strong>Tim Legal Sibali.id</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 PT. Siap Belajar Indonesia (Sibali.id). All rights reserved.</p>
            <p style="margin: 5px 0;">
                <a href="#" style="color: #7c3aed; text-decoration: none;">Kebijakan Privasi</a> |
                <a href="#" style="color: #7c3aed; text-decoration: none;">Syarat & Ketentuan</a>
            </p>
            <p style="margin: 10px 0 0 0; font-size: 12px; color: #9ca3af;">
                Email ini dikirim secara otomatis. Mohon tidak membalas email ini.
            </p>
        </div>
    </div>
</body>
</html>
