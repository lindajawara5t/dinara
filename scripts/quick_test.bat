@echo off
title Quick Test - Edit & Verify
color 0B

echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║  QUICK TEST - EDIT FLOATING BOX                            ║
echo ╚════════════════════════════════════════════════════════════╝
echo.

echo [STEP 1] Membuka Admin Dashboard...
start http://localhost/dinara/admin
timeout /t 2 >nul

echo.
echo [STEP 2] Instruksi:
echo ────────────────────────────────────────────────────────────
echo 1. Login ke admin dashboard
echo 2. Klik menu "Settings" -> "Settings Estimasi"
echo 3. Cari section "Deskripsi Box Total"
echo 4. Edit deskripsi, contoh:
echo    "Liburan hemat ke Karimunjawa! Paket mulai 500rb-an"
echo 5. Klik tombol "Update"
echo.
pause

echo.
echo [STEP 3] Cek database setelah update...
echo ────────────────────────────────────────────────────────────
C:\xampp\mysql\bin\mysql.exe -u root -e "SELECT content_value, updated_at FROM db_smart_travel.site_content WHERE page_name = 'estimasi' AND section_name = 'floating_box' AND content_key = 'description';"

echo.
echo [STEP 4] Membuka halaman utama untuk verifikasi...
start http://localhost/dinara/
timeout /t 2 >nul

echo.
echo ────────────────────────────────────────────────────────────
echo  Verifikasi di Browser:
echo ────────────────────────────────────────────────────────────
echo  1. Tekan Ctrl+Shift+R untuk hard refresh
echo  2. Scroll ke kanan bawah
echo  3. Lihat Floating Box "Total Estimasi"
echo  4. Deskripsi yang Anda edit HARUS sudah muncul!
echo ────────────────────────────────────────────────────────────
echo.
pause
