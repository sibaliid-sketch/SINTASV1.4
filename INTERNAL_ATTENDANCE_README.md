# 🎯 Sistem Absensi Internal SINTAS

## 📌 Overview

Sistem absensi karyawan berbasis web yang terintegrasi dengan SINTAS (Sistem Internal). Sistem ini menggantikan integrasi Fingerspot API yang tidak tersedia.

## ✨ Fitur Lengkap

### 👤 Untuk Karyawan:
- ✅ **Check-in Harian** - Catat kehadiran dengan satu klik
- ✅ **Check-out Harian** - Catat waktu pulang dengan catatan opsional
- ✅ **Dashboard Interaktif** - Lihat status absensi hari ini
- ✅ **Statistik Bulanan** - Monitor kehadiran, keterlambatan, dan izin
- ✅ **Riwayat Lengkap** - Akses semua data absensi dengan filter
- ✅ **Deteksi Keterlambatan** - Otomatis menandai jika terlambat
- ✅ **Durasi Kerja** - Hitung jam kerja otomatis

### 👨‍💼 Untuk Admin:
- ✅ **Monitoring Real-time** - Pantau absensi semua karyawan
- ✅ **Filter Multi-parameter** - Filter by tanggal, departemen, status
- ✅ **Dashboard Analytics** - Statistik hadir, terlambat, absent, izin
- ✅ **User Management** - Lihat detail karyawan dengan avatar
- ✅ **Export Data** - Download laporan (coming soon)

## 🚀 Quick Start

### 1. Akses Sistem

**Karyawan:**
```
URL: http://localhost:8000/attendance
```

**Admin:**
```
URL: http://localhost:8000/attendance/admin
```

### 2. Login
Gunakan kredensial karyawan yang sudah terdaftar di sistem.

### 3. Check-in
1. Klik tombol **"Check In Sekarang"**
2. Sistem akan mencatat waktu dan lokasi
3. Status otomatis ditentukan (tepat waktu/terlambat)

### 4. Check-out
1. Klik tombol **"Check Out Sekarang"**
2. Tambahkan catatan jika diperlukan
3. Durasi kerja dihitung otomatis

## 📊 Status Absensi

| Status | Keterangan | Warna |
|--------|------------|-------|
| **Present** | Hadir tepat waktu (≤ 09:00) | 🟢 Hijau |
| **Late** | Terlambat (> 09:00) | 🟠 Orange |
| **Absent** | Tidak hadir | 🔴 Merah |
| **Leave** | Cuti | 🔵 Biru |
| **Sick** | Sakit | 🟣 Ungu |
| **Permission** | Izin | 🟡 Kuning |

## ⚙️ Konfigurasi

### Jam Kerja Standar
```
Check-in: 09:00 WIB
Terlambat: > 09:00 WIB
```

### Business Rules
- Satu karyawan hanya bisa check-in sekali per hari
- Check-out harus setelah check-in
- Durasi kerja dihitung dari selisih check-in dan check-out
- IP address dan lokasi dicatat untuk audit

## 🗂️ Struktur File

```
app/
├── Http/Controllers/
│   └── AttendanceController.php      # Main controller
├── Models/
│   └── Attendance.php                # Attendance model
database/
├── migrations/
│   └── 2026_01_21_120000_update_attendances_table_for_internal_system.php
└── seeders/
    └── InternalAttendanceSeeder.php  # Sample data generator
resources/
└── views/
    └── attendance/
        ├── index.blade.php           # Employee dashboard
        ├── history.blade.php         # Attendance history
        └── admin.blade.php           # Admin panel
routes/
└── web.php                           # Route definitions
docs/
├── INTERNAL_ATTENDANCE_SYSTEM.md     # Full documentation
└── MIGRATION_TO_INTERNAL_ATTENDANCE.md
```

## 🔧 Development

### Generate Sample Data
```bash
php artisan db:seed --class=InternalAttendanceSeeder
```

### Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Run Server
```bash
php artisan serve
```

## 📱 Screenshots

### Employee Dashboard
- Real-time clock
- Check-in/Check-out buttons
- Monthly statistics
- Recent attendance history

### Admin Panel
- Summary cards (Present, Late, Absent, Leave)
- Filterable attendance table
- Employee details with avatars
- Export functionality

## 🔐 Security Features

- ✅ Authentication required
- ✅ User can only manage own attendance
- ✅ IP address logging
- ✅ Location tracking
- ✅ Unique constraint (one record per user per day)
- ✅ Audit trail (created_at, updated_at)

## 📈 Statistics & Reports

### Employee View:
- Total hari kerja bulan ini
- Jumlah hari hadir
- Jumlah hari terlambat
- Jumlah hari tidak hadir
- Jumlah hari izin/cuti

### Admin View:
- Total karyawan hadir hari ini
- Total karyawan terlambat
- Total karyawan tidak hadir
- Total karyawan izin/cuti
- Filter by departemen

## 🎨 UI/UX Highlights

### Design System:
- Modern gradient backgrounds
- Glassmorphism effects
- Responsive layout
- Intuitive navigation
- Color-coded status badges
- Interactive hover effects

### User Experience:
- One-click check-in/out
- Real-time feedback
- Clear status indicators
- Easy-to-read statistics
- Mobile-friendly (responsive)

## 🚧 Roadmap

### Phase 1 (✅ Completed):
- Basic check-in/out functionality
- Employee dashboard
- Admin monitoring panel
- Filter and search
- Sample data seeder

### Phase 2 (🔄 In Progress):
- Export to Excel/CSV
- Email notifications
- Mobile app integration
- Advanced analytics

### Phase 3 (📋 Planned):
- GPS location verification
- Photo capture on check-in
- Biometric integration (optional)
- AI-based anomaly detection
- Payroll integration

## 🐛 Troubleshooting

### Cannot Check-in
**Possible causes:**
- Already checked in today
- Not logged in
- Browser cache issue

**Solutions:**
1. Refresh the page
2. Clear browser cache
3. Logout and login again

### Status Not Updating
**Solutions:**
1. Hard refresh (Ctrl + F5)
2. Check database connection
3. Verify migration ran successfully

### Admin Panel Not Accessible
**Solutions:**
1. Verify user role
2. Check route permissions
3. Clear route cache: `php artisan route:clear`

## 📞 Support

### Internal Support:
- **IT Department**: it@sintas.com
- **Internal Chat**: #it-support
- **Phone**: ext. 1234

### Documentation:
- Full docs: `docs/INTERNAL_ATTENDANCE_SYSTEM.md`
- Migration guide: `MIGRATION_TO_INTERNAL_ATTENDANCE.md`

## 📄 License

Internal use only - SINTAS Company  
© 2026 All rights reserved

## 🙏 Credits

**Development Team:**
- Backend: Laravel Framework
- Frontend: Tailwind CSS + Blade Templates
- Database: MySQL
- Icons: Heroicons

**Special Thanks:**
- SINTAS Development Team
- IT Department
- All Beta Testers

---

## 🎉 Getting Started Now!

1. **Login** to your account
2. **Navigate** to `/attendance`
3. **Click** "Check In Sekarang"
4. **Start** tracking your attendance!

**Happy Tracking! 📊✨**
