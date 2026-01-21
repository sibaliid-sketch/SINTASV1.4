<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrak Belajar - {{ $registration->order_id }}</title>
    <style>
        body { font-family: 'Times New Roman', serif; margin: 0; padding: 20px; font-size: 12px; line-height: 1.4; }
        .contract-container { max-width: 800px; margin: 0 auto; border: 1px solid #000; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 20px; margin-bottom: 20px; }
        .contract-title { font-size: 18px; font-weight: bold; margin: 20px 0; }
        .section { margin: 20px 0; }
        .section-title { font-weight: bold; text-decoration: underline; margin-bottom: 10px; }
        .party-info { margin: 15px 0; padding: 10px; background-color: #f9f9f9; }
        .signature-section { margin-top: 40px; display: table; width: 100%; }
        .signature-box { display: table-cell; width: 50%; text-align: center; vertical-align: top; }
        .signature-line { border-bottom: 1px solid #000; width: 200px; margin: 40px auto 10px auto; }
        .numbered-list { margin: 10px 0; padding-left: 20px; }
        .footer { margin-top: 40px; border-top: 1px solid #000; padding-top: 20px; text-align: center; font-size: 10px; }
    </style>
</head>
<body>
    <div class="contract-container">
        <!-- Header -->
        <div class="header">
            <h1 style="margin: 0; font-size: 20px;">KONTRAK BELAJAR</h1>
            <p style="margin: 5px 0;">Nomor: {{ $registration->contract_id ?? 'KTR/STU/' . date('m/y') . '/' . $registration->student_id }}</p>
        </div>

        <!-- Preamble -->
        <div class="section">
            <p>Pada hari ini, {{ now()->format('l') }}, tanggal {{ now()->format('j') }} bulan {{ now()->format('F') }} tahun {{ now()->format('Y') }}, telah dibuat dan ditandatangani Perjanjian Kontrak Belajar antara:</p>
        </div>

        <!-- Party 1 -->
        <div class="party-info">
            <div class="section-title">PIHAK PERTAMA (PENYEDIA LAYANAN):</div>
            <strong>PT. Siap Belajar Indonesia (Sibali.id)</strong><br>
            Bertindak untuk dan atas nama PT. Siap Belajar Indonesia,<br>
            yang berkedudukan di Jl. Contoh No. 123, Jakarta, Indonesia,<br>
            dalam hal ini diwakili oleh Admin Sibali.id,<br>
            selanjutnya disebut sebagai <strong>"PIHAK PERTAMA"</strong>.
        </div>

        <!-- Party 2 -->
        <div class="party-info">
            <div class="section-title">PIHAK KEDUA (PESERTA DIDIK):</div>
            <strong>{{ $registration->student_name }}</strong><br>
            @if($registration->student_identity_number)
                NIK: {{ $registration->student_identity_number }}<br>
            @endif
            Alamat: {{ $registration->student_address }}<br>
            @if($registration->student_phone)
                No. Telepon: {{ $registration->student_phone }}<br>
            @endif
            @if($registration->student_email)
                Email: {{ $registration->student_email }}<br>
            @endif
            @if(!$registration->is_self_register)
                <br><strong>Diwakili oleh Orang Tua/Wali: {{ $registration->parent_name }}</strong><br>
                @if($registration->parent_identity_number)
                    NIK Orang Tua/Wali: {{ $registration->parent_identity_number }}<br>
                @endif
                Hubungan: {{ $registration->parent_relationship }}
            @endif
            <br>Selanjutnya disebut sebagai <strong>"PIHAK KEDUA"</strong>.
        </div>

        <!-- Agreement -->
        <div class="section">
            <p>Kedua belah pihak telah sepakat untuk mengadakan Perjanjian Kontrak Belajar dengan ketentuan sebagai berikut:</p>
        </div>

        <!-- Article 1 -->
        <div class="section">
            <div class="section-title">Pasal 1 - Objek Perjanjian</div>
            <p>PIHAK PERTAMA sepakat untuk memberikan layanan pendidikan berupa program pembelajaran, sedangkan PIHAK KEDUA sepakat untuk mengikuti program pembelajaran tersebut dengan rincian sebagai berikut:</p>

            <div style="margin: 15px 0; padding: 10px; background-color: #f9f9f9;">
                <strong>Program:</strong> {{ $registration->program->name }}<br>
                <strong>Layanan:</strong> {{ $registration->service->name }}<br>
                <strong>Mode Pembelajaran:</strong> {{ ucfirst($registration->class_mode) }}<br>
                <strong>Jadwal:</strong> {{ $registration->schedule->day_of_week }}, {{ $registration->schedule->start_time }} - {{ $registration->schedule->end_time }}<br>
                <strong>Durasi Program:</strong> {{ $registration->program->duration_weeks }} minggu<br>
                <strong>Biaya:</strong> Rp {{ number_format($registration->total_price, 0, ',', '.') }}
            </div>
        </div>

        <!-- Article 2 -->
        <div class="section">
            <div class="section-title">Pasal 2 - Hak dan Kewajiban PIHAK PERTAMA</div>
            <p>PIHAK PERTAMA berkewajiban untuk:</p>
            <ol class="numbered-list">
                <li>Memberikan layanan pembelajaran sesuai dengan kurikulum yang telah ditentukan</li>
                <li>Menyediakan materi pembelajaran dan platform SIMY/SITRA</li>
                <li>Memberikan pendampingan dan bantuan teknis selama program berlangsung</li>
                <li>Memberikan sertifikat setelah PIHAK KEDUA menyelesaikan program</li>
                <li>Menjaga kerahasiaan data pribadi PIHAK KEDUA</li>
                <li>Memberikan pengembalian dana sesuai ketentuan yang berlaku jika terjadi pembatalan</li>
            </ol>
        </div>

        <!-- Article 3 -->
        <div class="section">
            <div class="section-title">Pasal 3 - Hak dan Kewajiban PIHAK KEDUA</div>
            <p>PIHAK KEDUA berkewajiban untuk:</p>
            <ol class="numbered-list">
                <li>Mengikuti seluruh program pembelajaran sesuai jadwal yang telah ditentukan</li>
                <li>Membayar biaya pembelajaran sesuai dengan kesepakatan</li>
                <li>Menjaga kerahasiaan materi pembelajaran dan tidak menyebarkannya</li>
                <li>Memberikan feedback dan evaluasi untuk perbaikan layanan</li>
                <li>Mematuhi semua peraturan dan ketentuan yang berlaku</li>
                <li>Menggunakan platform pembelajaran dengan baik dan bertanggung jawab</li>
            </ol>
        </div>

        <!-- Article 4 -->
        <div class="section">
            <div class="section-title">Pasal 4 - Biaya dan Pembayaran</div>
            <p>PIHAK KEDUA sepakat untuk membayar biaya pembelajaran sebesar Rp {{ number_format($registration->total_price, 0, ',', '.') }} dengan rincian sebagai berikut:</p>

            <div style="margin: 15px 0; padding: 10px; background-color: #f9f9f9;">
                <strong>Harga Dasar:</strong> Rp {{ number_format($registration->base_price, 0, ',', '.') }}<br>
                @if($registration->discount_amount > 0)
                    <strong>Diskon:</strong> - Rp {{ number_format($registration->discount_amount, 0, ',', '.') }}<br>
                @endif
                @if($registration->tax_amount > 0)
                    <strong>PPN:</strong> Rp {{ number_format($registration->tax_amount, 0, ',', '.') }}<br>
                @endif
                <strong><u>Total Pembayaran:</u></strong> <strong>Rp {{ number_format($registration->total_price, 0, ',', '.') }}</strong>
            </div>

            <p>Pembayaran dilakukan melalui transfer ke rekening BCA 1234567890 a.n PT. Siap Belajar Indonesia.</p>
        </div>

        <!-- Article 5 -->
        <div class="section">
            <div class="section-title">Pasal 5 - Jangka Waktu</div>
            <p>Perjanjian ini berlaku sejak tanggal ditandatangani sampai dengan:</p>
            <ol class="numbered-list">
                <li>Penyelesaian program pembelajaran oleh PIHAK KEDUA, atau</li>
                <li>Berakhirnya masa aktif akun pembelajaran, atau</li>
                <li>Dibatalkannya perjanjian oleh salah satu pihak sesuai ketentuan yang berlaku</li>
            </ol>
        </div>

        <!-- Article 6 -->
        <div class="section">
            <div class="section-title">Pasal 6 - Pembatalan dan Pengembalian Dana</div>
            <p>Pembatalan dapat dilakukan dengan ketentuan sebagai berikut:</p>
            <ol class="numbered-list">
                <li>Pembatalan sebelum program dimulai: Pengembalian dana 100%</li>
                <li>Pembatalan selama 25% pertama program: Pengembalian dana 75%</li>
                <li>Pembatalan selama 50% pertama program: Pengembalian dana 50%</li>
                <li>Pembatalan setelah 50% program: Tidak ada pengembalian dana</li>
            </ol>
        </div>

        <!-- Article 7 -->
        <div class="section">
            <div class="section-title">Pasal 7 - Force Majeure</div>
            <p>Kedua belah pihak sepakat bahwa dalam hal terjadi keadaan kahar (force majeure) seperti bencana alam, pandemi, perang, atau kondisi lain di luar kendali kedua belah pihak, maka perjanjian ini dapat ditinjau kembali atau diakhiri dengan musyawarah.</p>
        </div>

        <!-- Article 8 -->
        <div class="section">
            <div class="section-title">Pasal 8 - Penyelesaian Perselisihan</div>
            <p>Apabila terjadi perselisihan dalam pelaksanaan perjanjian ini, kedua belah pihak sepakat untuk menyelesaikannya secara musyawarah. Apabila musyawarah tidak mencapai kesepakatan, maka perselisihan akan diselesaikan melalui pengadilan yang berwenang.</p>
        </div>

        <!-- Closing -->
        <div class="section">
            <p>Demikian perjanjian kontrak belajar ini dibuat dan ditandatangani oleh kedua belah pihak dalam keadaan sadar dan tanpa paksaan dari pihak manapun.</p>
        </div>

        <!-- Signatures -->
        <div class="signature-section">
            <div class="signature-box">
                <p><strong>PIHAK PERTAMA</strong></p>
                <p>PT. Siap Belajar Indonesia</p>
                <div class="signature-line"></div>
                <p>Admin Sibali.id</p>
                <p>Tanggal: {{ now()->format('d M Y') }}</p>
            </div>
            <div class="signature-box">
                <p><strong>PIHAK KEDUA</strong></p>
                <p>{{ $registration->student_name }}</p>
                <div class="signature-line"></div>
                @if(!$registration->is_self_register)
                    <p>Diwakili oleh: {{ $registration->parent_name }}</p>
                    <p>Sebagai: {{ $registration->parent_relationship }}</p>
                @endif
                <p>Tanggal: {{ now()->format('d M Y') }}</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Kontrak ini dibuat secara elektronik dan sah tanpa tanda tangan basah sesuai dengan Undang-Undang Nomor 11 Tahun 2008 tentang Informasi dan Transaksi Elektronik.</p>
            <p>&copy; 2024 PT. Siap Belajar Indonesia. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
