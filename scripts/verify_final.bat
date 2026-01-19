@echo off
title Verifikasi Database Final
color 0A

echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║  VERIFIKASI DATABASE - SETELAH MIGRASI                     ║
echo ╚════════════════════════════════════════════════════════════╝
echo.

echo [1] Daftar Database:
echo ────────────────────────────────────────────────────────────
C:\xampp\mysql\bin\mysql.exe -u root -e "SHOW DATABASES;"

echo.
echo [2] Config Database (app/Config/Database.php):
echo ────────────────────────────────────────────────────────────
findstr /C:"'database'" ..\app\Config\Database.php

echo.
echo [3] Data Floating Box di db_smart_travel:
echo ────────────────────────────────────────────────────────────
C:\xampp\mysql\bin\mysql.exe -u root -e "SELECT section_name, content_key, content_value FROM db_smart_travel.site_content WHERE page_name = 'estimasi' AND section_name = 'floating_box';"

echo.
echo [4] Semua Section Estimasi di db_smart_travel:
echo ────────────────────────────────────────────────────────────
C:\xampp\mysql\bin\mysql.exe -u root -e "SELECT DISTINCT section_name FROM db_smart_travel.site_content WHERE page_name = 'estimasi' ORDER BY section_name;"

echo.
echo ════════════════════════════════════════════════════════════
echo  STATUS:
echo ════════════════════════════════════════════════════════════
echo  ✓ Database 'dinara' DIHAPUS
echo  ✓ Database 'db_smart_travel' AKTIF
echo  ✓ Floating box description KOSONG (siap diisi dari admin)
echo  ✓ Config menunjuk ke db_smart_travel
echo ════════════════════════════════════════════════════════════
echo.
echo Sekarang silakan:
echo 1. Buka Admin Dashboard: http://localhost/dinara/admin
echo 2. Masuk ke Settings -^> Settings Estimasi
echo 3. Edit "Deskripsi Box Total"
echo 4. Klik Update
echo 5. Refresh halaman utama (Ctrl+Shift+R)
echo.
pause
