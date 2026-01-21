<x-mail::message>
# Pemberitahuan Keterlambatan Check-In

Halo **{{ $user->name }}**,

Kami ingin memberitahu bahwa Anda melakukan check-in terlambat hari ini.

**Detail Absensi:**
- **Tanggal:** {{ $attendance->date->format('d M Y') }}
- **Waktu Check-In:** {{ $attendance->check_in->format('H:i:s') }}
- **Status:** Terlambat
- **Lokasi:** {{ $attendance->location }}

Jam kerja standar dimulai pukul 09:00 WIB. Mohon untuk lebih disiplin dalam waktu kedatangan.

Jika ada alasan khusus, silakan hubungi HR atau atasan Anda.

Terima kasih atas perhatiannya.

Salam,
**Tim HR SINTAS**
</x-mail::message>
