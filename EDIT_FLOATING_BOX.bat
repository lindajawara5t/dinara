@echo off
title Quick Access - Edit Floating Box Admin
color 0A

echo.
echo ╔═══════════════════════════════════════════════════════╗
echo ║     🎯 QUICK ACCESS - EDIT FLOATING BOX ADMIN        ║
echo ╚═══════════════════════════════════════════════════════╝
echo.
echo  ✅ Teks "BERHASIL UPDATE" sudah dihapus
echo  ✅ Auto-sync sudah aktif - Edit langsung sync!
echo.
echo ───────────────────────────────────────────────────────────
echo  1. Buka Admin Dashboard
echo  2. Buka Halaman Utama (Landing Page)
echo  3. Clear Cache Manual (jika perlu)
echo  4. Cek Database Floating Box
echo  5. Exit
echo ───────────────────────────────────────────────────────────
echo.
set /p choice="Pilih opsi (1-5): "

if "%choice%"=="1" (
    echo.
    echo 🌐 Membuka Admin Dashboard...
    start http://localhost/dinara/admin
    goto menu
)

if "%choice%"=="2" (
    echo.
    echo 🌐 Membuka Landing Page...
    start http://localhost/dinara/
    goto menu
)

if "%choice%"=="3" (
    echo.
    echo 🧹 Clearing cache...
    cd /d "%~dp0"
    C:\xampp\mysql\bin\mysql.exe -u root dinara -e "DELETE FROM ci_sessions;"
    echo ✓ Cache cleared!
    timeout /t 2 >nul
    goto menu
)

if "%choice%"=="4" (
    echo.
    echo 🔍 Checking database...
    cd /d "%~dp0"
    cd public
    C:\xampp\php\php.exe check_floating_box.php > floating_box_check.html
    start floating_box_check.html
    goto menu
)

if "%choice%"=="5" (
    exit
)

:menu
echo.
echo ───────────────────────────────────────────────────────────
echo  Kembali ke menu? (Y/N)
set /p back="Pilihan: "
if /i "%back%"=="Y" goto :eof
if /i "%back%"=="N" exit
goto menu
