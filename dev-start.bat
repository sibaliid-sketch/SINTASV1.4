@echo off
REM Script untuk menjalankan PHP Server & Vite Dev Server bersamaan
REM Double-click script ini untuk start development

setlocal enabledelayedexpansion
cd /d "%~dp0"

title SIBALI.ID - Development Environment
color 0A

echo.
echo ╔════════════════════════════════════════════════════════════════╗
echo ║        SIBALI.ID Development Environment                       ║
echo ║                  Starting Services...                          ║
echo ╚════════════════════════════════════════════════════════════════╝
echo.

REM Check if npm is installed
npm --version >nul 2>&1
if %errorlevel% neq 0 (
    color 0C
    echo [ERROR] NPM tidak ditemukan!
    echo Pastikan Node.js sudah diinstall
    pause
    exit /b 1
)

REM Check if php is installed
php --version >nul 2>&1
if %errorlevel% neq 0 (
    color 0C
    echo [ERROR] PHP tidak ditemukan!
    echo Pastikan PHP sudah diinstall di Laragon
    pause
    exit /b 1
)

echo [✓] PHP: Terdeteksi
echo [✓] NPM: Terdeteksi
echo.
echo Memulai services...
echo.

REM Start Vite Dev Server in new window
echo [1/2] Starting Vite Dev Server...
start cmd /k "npm run dev"
timeout /t 2 /nobreak

REM Start PHP Development Server
echo [2/2] Starting PHP Development Server...
echo.
echo ╔════════════════════════════════════════════════════════════════╗
echo ║                    SERVICES RUNNING                            ║
echo ╠════════════════════════════════════════════════════════════════╣
echo ║                                                                ║
echo ║  🌐 Application URL:  http://localhost:8000                   ║
echo ║  🌐 Vite Dev URL:     http://localhost:5173                   ║
echo ║                                                                ║
echo ║  📚 Access Test Accounts:                                      ║
echo ║     Superadmin: superadmin@sintasv1.test / password123         ║
echo ║     Admin Ops:  admin.ops@sintasv1.test / password123          ║
echo ║     User:    test@sintasv1.test / password123                 ║
echo ║     Manager: manager@sintasv1.test / password123              ║
echo ║     Eng&Ret: engagement.retention@sintasv1.test / password123 ║
echo ║                                                                ║
echo ║  💡 PENTING:                                                   ║
echo ║     - Biarkan Vite Dev Server tetap running                    ║
echo ║     - CSS dan JavaScript akan auto-refresh                     ║
echo ║     - Jika ada perubahan file, browser otomatis refresh        ║
echo ║                                                                ║
echo ║  ❌ Untuk berhenti: Tutup kedua window terminal ini            ║
echo ║                                                                ║
echo ╚════════════════════════════════════════════════════════════════╝
echo.

php artisan serve

pause
