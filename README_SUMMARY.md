# 📚 SIBALI.ID - PT. Siap Belajar Indonesia

[![Laravel](https://img.shields.io/badge/Laravel-10.10-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC.svg)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-5.0-646cff.svg)](https://vitejs.dev)

Platform edukasi digital terintegrasi dengan tiga sistem utama: **SIMY** (Learning Management), **SITRA** (Customer Portal), dan **SINTAS** (Internal System).

## 🎯 Tentang Proyek

**SIBALI.ID** adalah ekosistem pembelajaran digital terpadu untuk manajemen program pembelajaran & kursus Bahasa Inggris, dengan integrasi siswa, orang tua, dan pengajar, serta sistem pemesanan & pembayaran online.

**Fungsi Utama Website:**
- Portal informasi layanan & program
- Gateway login ke sistem SIMY/SITRA/SINTAS
- Platform pemesanan layanan & program
- Manajemen registrasi & pembayaran

## ✨ Fitur Utama

### 👥 Multi-Role System
| Role | Sistem | Akses |
|------|--------|-------|
| **Siswa <18** | SIMY | Pembelajaran terbimbing + monitor orang tua |
| **Siswa >18** | SIMY | Pembelajaran penuh + pembayaran mandiri |
| **Orang Tua** | SITRA | Monitoring anak + komunikasi guru |
| **Guru** | SINTAS | Manajemen kelas & siswa |
| **Admin** | SINTAS | Manajemen sistem & operasional |

### 📚 Sistem Registrasi & Pemesanan
✅ **Pendaftaran Multi-Step (10 langkah):**
- Pilih program berdasarkan jenjang pendidikan (TK/SD/SMP/SMA/Mahasiswa)
- Pilih jadwal pembelajaran yang tersedia
- Isi data siswa & orang tua dengan validasi otomatis umur
- Review pesanan & apply kode promo
- Upload bukti transfer & verifikasi Finance
- Generate invoice otomatis (INV/MM/YY/XXXX)

✅ **Audit & Tracking:**
- Status tracking real-time (Draft → Pending → Verified → Active)
- Audit log lengkap setiap perubahan
- Promo validation otomatis (kuota & tanggal berlaku)

### 🎨 User Experience
- **Design**: Elegan, minimalis, futuristik dengan Tailwind CSS
- **Responsive**: Mobile-first, desktop-optimized
- **Dark Mode**: Support mode gelap penuh
- **Form Validation**: Real-time error messages

## 🛠️ Stack Teknologi

### Backend
- Laravel 10.10 - Web Framework
- PHP 8.1+ - Server Language
- MySQL 8.0+ - Database
- Breeze - Auth Scaffolding
- Sanctum - API Tokens

### Frontend
- Vite 5.0 - Build Tool (HMR)
- Tailwind CSS 3.x - Utility CSS
- Alpine.js - Lightweight JS
- Heroicons - SVG Icons

### DevOps & Tools
- Composer - PHP Package Manager
- NPM/Node.js - JS Package Manager
- Artisan - Laravel CLI
- PHPUnit - Testing Framework
- Git - Version Control

## 🚀 Instalasi & Setup

### Prerequisites
- PHP 8.1+, Composer, Node.js 16+, NPM, MySQL 8.0+, Git, Laragon/XAMPP

### Step-by-Step Installation
1. **Clone Repository**: `git clone <repository-url> SINTASV1.4`
2. **Install Dependencies**: `composer install && npm install`
3. **Environment**: `cp .env.example .env && php artisan key:generate`
4. **Database**: Edit .env, then `php artisan migrate && php artisan db:seed`
5. **Build Assets**: `npm run build`

## ⚡ Quick Start

### Running Development (REQUIRED for CSS/JS)
**Terminal 1 - PHP Server**: `php artisan serve`
**Terminal 2 - Vite Dev Server**: `npm run dev` (KEEP RUNNING!)

**Access Points:**
- `http://localhost:8000` - Main Application
- `http://localhost:5173` - Vite Dev Server

### Test Accounts
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@sintasv1.test | password123 |
| User | test@sintasv1.test | password123 |
| Manager | manager@sintasv1.test | password123 |

## 🧪 Testing

### Test Scenarios
- ✅ Authentication (login/register/logout)
- ✅ Public Pages (home/about/services/contact)
- ✅ Registration System (10-step flow)
- ✅ Responsive Design (mobile/tablet/desktop)
- ✅ Dark mode functionality

### Running Tests
```bash
php artisan test                    # All tests
php artisan test --testsuite=Feature  # Feature tests
php artisan test --testsuite=Unit     # Unit tests
```

## 📝 Registrasi & Pemesanan Layanan

### Database Schema (6 Tables)
- `programs` - Data program pembelajaran
- `schedules` - Jadwal kelas & availability
- `promos` - Kode promo & discount
- `registrations` - Pendaftaran & tracking
- `payment_proofs` - Bukti pembayaran siswa
- `audit_logs` - Log audit lengkap

### Alur Registrasi (10 Steps)
1. Intro → Overview program
2. Pilih Pendaftar → Siswa / Orang Tua
3. Pilih Pendidikan → TK/SD/SMP/SMA/Umum
4. Pilih Program → Sesuai level
5. Pilih Jadwal → Hari/jam tersedia
6. Data Siswa & Orang Tua → Form lengkap
7. Review Pesanan → Total biaya
8. Kode Promo → Apply discount
9. Upload Bukti → Payment proof
10. Konfirmasi → Invoice generated

### Status Flow
Draft → Pending Payment → Awaiting Verification → Active → Onboarding Complete

### Auto-Generated IDs
| ID | Format | Example |
|---|---|---|
| Invoice | INV/MM/YY/XXXX | INV/01/26/4821 |
| Order | ORDXXXXXXXXXX | ORD1029384756 |
| Student | STXXXX | ST4821 |

### Pembayaran & Refund Policy
- **Payment**: Upload bukti transfer (JPG/PNG/PDF, max 5MB), deadline 2 hari sebelum kelas
- **Refunds**: 95% sebelum kelas, 45% sampai pertemuan ke-2, 0% setelahnya

## 📊 Status Pengembangan

### ✅ Completed (100%)
- Database migrations & schema
- All Models & relationships
- ID Generator Service
- Registration Controller (10-step flow)
- Routes setup
- Test data seeder
- Auth system
- Responsive UI with dark mode
- Audit logging

### 🔄 In Progress (50%)
- Blade views (Step 2-10) - UI completed, testing ongoing
- Admin dashboard
- Finance verification
- Email notifications
- WhatsApp integration

### 📋 Planned (0%)
- Auto account creation (SIMY/SITRA)
- Advanced reporting
- Real-time chat
- Mobile app
- API documentation

## 📂 Project Structure

```
SINTASV1.4/
├── app/Http/Controllers/RegistrationController.php
├── app/Models/ (Program, Schedule, Registration, etc.)
├── app/Services/ (IdGeneratorService, AuditLoggerService)
├── database/migrations/ & seeders/
├── resources/views/registration/ (10 step views)
├── routes/web.php
├── package.json, vite.config.js, tailwind.config.js
└── README.md
```

## 🔗 Dokumentasi

- `TESTING_GUIDE.md` - Panduan testing lengkap
- `REGISTRATION_SYSTEM_DOCS.md` - Detail sistem registrasi
- `REGISTRATION_PAGES_DOCS.md` - Dokumentasi UI/UX
- `.env.example` - Template environment variables

## 🌟 Key Validations

✅ Age validation (< 18 tahun wajib data orang tua)  
✅ Program selection (hanya sesuai level pendidikan)  
✅ Promo validation (kuota & tanggal berlaku)  
✅ Schedule management (tidak double-booking)  
✅ Audit logging (semua perubahan tercatat)  
✅ File security (JPG/PNG/PDF, max 5MB)

## 📞 Support

**PT. Siap Belajar Indonesia**
- 🌐 Website: sibali.id
- 📧 Email: info@sibali.id
- 📍 Address: Jakarta, Indonesia

## 📄 License

MIT License

## 🙏 Credits

- **Laravel** - PHP Web Framework
- **Tailwind CSS** - Utility-first CSS
- **Vite** - Next Gen Build Tool
- **Alpine.js** - JavaScript Framework
- **Heroicons** - SVG Icons

**Version**: 1.0.0  
**Status**: Active Development  
**Last Updated**: 19 January 2026
