@echo off
echo ============================================
echo IMPORT HERO SLIDESHOW TABLE
echo ============================================
echo.
echo Script ini akan membuat tabel hero_slideshow di database Anda.
echo.

set /p DB_NAME="Masukkan nama database (default: dinara_travel): "
if "%DB_NAME%"=="" set DB_NAME=dinara_travel

set /p DB_USER="Masukkan username MySQL (default: root): "
if "%DB_USER%"=="" set DB_USER=root

set /p DB_PASS="Masukkan password MySQL (tekan Enter jika kosong): "

echo.
echo Mengimpor tabel hero_slideshow...
echo.

if "%DB_PASS%"=="" (
    mysql -u %DB_USER% %DB_NAME% < create_hero_slideshow_table.sql
) else (
    mysql -u %DB_USER% -p%DB_PASS% %DB_NAME% < create_hero_slideshow_table.sql
)

if %ERRORLEVEL% EQU 0 (
    echo.
    echo [SUCCESS] Tabel hero_slideshow berhasil dibuat!
    echo.
    echo Langkah selanjutnya:
    echo 1. Buka halaman admin: http://localhost/dinara/admin
    echo 2. Pilih menu "Gambar & Logo"
    echo 3. Klik tab "Hero Slideshow"
    echo 4. Upload gambar slideshow Anda
    echo.
) else (
    echo.
    echo [ERROR] Gagal membuat tabel! Periksa koneksi database Anda.
    echo.
)

pause
