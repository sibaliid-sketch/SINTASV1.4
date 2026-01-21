# 📋 Sistem Absensi Internal - Dokumentasi

## 📌 Overview

Sistem absensi internal berbasis web untuk karyawan SINTAS. Sistem ini menggantikan integrasi Fingerspot API yang tidak tersedia karena perangkat tidak berlangganan API SDK.

## ✨ Fitur Utama

### Untuk Karyawan:
- ✅ Check-in dan Check-out harian
- 📊 Dashboard absensi dengan statistik bulanan
- 📜 Riwayat absensi dengan filter
- ⏰ Deteksi keterlambatan otomatis
- 📍 Pencatatan lokasi dan IP address

### Untuk Admin:
- 👥 Monitoring absensi semua karyawan
- 🔍 Filter berdasarkan tanggal, departemen, dan status
- 📊 Statistik real-time (hadir, terlambat, tidak hadir, izin)
- 📥 Export data (akan datang)

## 🗂️ Struktur Database

### Tabel: `attendances`

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| user_id | bigint | Foreign key ke users table |
| date | date | Tanggal absensi |
| check_in | datetime | Waktu check-in |
| check_out | datetime | Waktu check-out |
| status | enum | Status: present, late, absent, leave, sick, permission |
| notes | text | Catatan tambahan |
| location | string | Lokasi check-in |
| ip_address | string | IP address saat check-in |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |

**Constraint:** Unique constraint pada `user_id` dan `date` (satu record per user per hari)

## 🚀 Cara Penggunaan

### Untuk Karyawan:

#### 1. Akses Halaman Absensi
```
URL: /attendance
```

#### 2. Check-in
- Klik tombol "Check In Sekarang"
- Sistem akan mencatat waktu dan menentukan status (tepat waktu/terlambat)
- Jam standar: 09:00 WIB

#### 3. Check-out
- Klik tombol "Check Out Sekarang"
- Tambahkan catatan jika diperlukan
- Sistem akan menghitung durasi kerja

#### 4. Lihat Riwayat
```
URL: /attendance/history
```
- Filter berdasarkan bulan dan status
- Lihat detail setiap absensi

### Untuk Admin:

#### 1. Akses Panel Admin
```
URL: /attendance/admin
```

#### 2. Filter Data
- Pilih tanggal
- Pilih departemen
- Pilih status
- Klik "Filter"

#### 3. Export Data (Coming Soon)
- Klik tombol "Export"
- Download dalam format Excel/CSV

## 📝 Routes

### Karyawan Routes:
```php
GET  /attendance              - Dashboard absensi
POST /attendance/check-in     - Check-in
POST /attendance/check-out    - Check-out
GET  /attendance/history      - Riwayat absensi
```

### Admin Routes:
```php
GET  /attendance/admin        - Panel admin
GET  /attendance/admin/export - Export data
```

## 🎯 Business Rules

### Check-in:
- Hanya bisa check-in sekali per hari
- Jam standar: 09:00 WIB
- Terlambat jika check-in > 09:00 WIB
- Mencatat lokasi dan IP address

### Check-out:
- Harus check-in terlebih dahulu
- Hanya bisa check-out sekali per hari
- Bisa menambahkan catatan

### Status:
- **present**: Hadir tepat waktu (check-in ≤ 09:00)
- **late**: Terlambat (check-in > 09:00)
- **absent**: Tidak hadir (tidak ada check-in)
- **leave**: Cuti
- **sick**: Sakit
- **permission**: Izin

## 🔧 Konfigurasi

### Jam Kerja Standar
Edit di `app/Models/Attendance.php`:
```php
public function getIsLateAttribute()
{
    if ($this->check_in) {
        $standardTime = $this->check_in->copy()->setTime(9, 0, 0); // 09:00
        return $this->check_in->gt($standardTime);
    }
    return false;
}
```

### Durasi Kerja
Otomatis dihitung dari selisih check-in dan check-out:
```php
public function getWorkingHoursAttribute()
{
    if ($this->check_in && $this->check_out) {
        return $this->check_in->diffInHours($this->check_out);
    }
    return 0;
}
```

## 📊 Seeding Data

### Generate Sample Data:
```bash
php artisan db:seed --class=InternalAttendanceSeeder
```

Seeder akan generate:
- Data 30 hari terakhir
- Tingkat kehadiran 95%
- Random check-in/check-out time
- Berbagai status (hadir, terlambat, izin, dll)

## 🔐 Security

### Middleware:
- Semua route dilindungi dengan `auth` middleware
- Admin route memerlukan role admin (akan ditambahkan)

### Validation:
- User hanya bisa check-in/out untuk dirinya sendiri
- Tidak bisa check-in/out untuk tanggal lain
- Unique constraint mencegah duplicate entry

## 🎨 UI/UX Features

### Dashboard Karyawan:
- Real-time clock
- Status check-in/out hari ini
- Statistik bulanan
- Riwayat 10 terakhir

### Dashboard Admin:
- Summary cards (hadir, terlambat, absent, izin)
- Filter multi-parameter
- Pagination
- User avatar display

## 🚧 Roadmap

### Phase 1 (Current):
- ✅ Basic check-in/out
- ✅ Dashboard karyawan
- ✅ Dashboard admin
- ✅ Filter dan search

### Phase 2 (Coming Soon):
- 📥 Export to Excel/CSV
- 📧 Email notification untuk keterlambatan
- 📱 Mobile responsive optimization
- 🔔 Reminder check-in/out

### Phase 3 (Future):
- 📍 GPS location tracking
- 📸 Photo capture saat check-in
- 📊 Advanced analytics
- 🤖 AI-based anomaly detection

## 🐛 Troubleshooting

### Issue: Tidak bisa check-in
**Solution:**
- Pastikan belum check-in hari ini
- Clear browser cache
- Logout dan login kembali

### Issue: Durasi kerja tidak muncul
**Solution:**
- Pastikan sudah check-out
- Refresh halaman
- Periksa data di database

### Issue: Status tidak sesuai
**Solution:**
- Periksa jam check-in
- Jam standar adalah 09:00 WIB
- Status otomatis berdasarkan waktu check-in

## 📞 Support

Untuk bantuan lebih lanjut, hubungi:
- IT Department
- Email: it@sintas.com
- Internal Chat: #it-support

## 📄 License

Internal use only - SINTAS Company
