@echo off
echo ============================================
echo UPDATE HERO SLIDESHOW TABLE
echo ============================================
echo.
echo Script ini akan menambahkan kolom baru:
echo - duration (durasi slide)
echo - button_label (label tombol)
echo - button_url (link tombol)
echo - button_class (style tombol)
echo.

set /p DB_NAME="Masukkan nama database (default: dinara_travel): "
if "%DB_NAME%"=="" set DB_NAME=dinara_travel

set /p DB_USER="Masukkan username MySQL (default: root): "
if "%DB_USER%"=="" set DB_USER=root

set /p DB_PASS="Masukkan password MySQL (tekan Enter jika kosong): "

echo.
echo Updating tabel hero_slideshow...
echo.

if "%DB_PASS%"=="" (
    mysql -u %DB_USER% %DB_NAME% < update_hero_slideshow_table.sql
) else (
    mysql -u %DB_USER% -p%DB_PASS% %DB_NAME% < update_hero_slideshow_table.sql
)

if %ERRORLEVEL% EQU 0 (
    echo.
    echo [SUCCESS] Tabel hero_slideshow berhasil diupdate!
    echo.
    echo Fitur baru tersedia:
    echo - Setting durasi per slide (auto slideshow)
    echo - Tambah tombol CTA dengan link custom
    echo - Pilihan style tombol (warna)
    echo.
    echo Silakan edit slideshow di admin panel!
    echo.
) else (
    echo.
    echo [ERROR] Gagal update tabel! 
    echo.
    echo Kemungkinan:
    echo - Tabel belum ada (jalankan import_hero_slideshow.bat dulu)
    echo - Kolom sudah ada sebelumnya
    echo.
)

pause
