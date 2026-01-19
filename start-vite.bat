@echo off
REM Script untuk menjalankan Vite Dev Server dengan auto-restart
REM Letakkan script ini di root project folder dan double-click untuk menjalankan

setlocal enabledelayedexpansion

title SIBALI.ID - Vite Dev Server (Auto-Restart)
color 0A

echo.
echo ╔════════════════════════════════════════════════════════════════╗
echo ║            SIBALI.ID - Vite Dev Server                         ║
echo ║          Hot Module Replacement (HMR) Active                   ║
echo ╚════════════════════════════════════════════════════════════════╝
echo.
echo Status: Berjalan dan memonitor...
echo Tekan CTRL+C untuk menghentikan
echo.

:loop
npm run dev
echo.
echo.
echo [%date% %time%] Vite server berhenti, restart dalam 3 detik...
timeout /t 3 /nobreak
goto loop

pause
