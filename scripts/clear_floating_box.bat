@echo off
echo ========================================
echo HAPUS ISI FLOATING BOX DESCRIPTION
echo ========================================
echo.
echo Script ini akan menghapus isi deskripsi floating box
echo dan mengosongkannya.
echo.
pause

cd /d "%~dp0"
set MYSQL_PATH=C:\xampp\mysql\bin\mysql.exe
set DB_NAME=dinara

echo.
echo Menjalankan SQL...
"%MYSQL_PATH%" -u root %DB_NAME% < clear_floating_description.sql

if %ERRORLEVEL% EQU 0 (
    echo.
    echo [SUKSES] Isi floating box berhasil dihapus!
    echo.
    echo Silakan refresh halaman website Anda.
) else (
    echo.
    echo [ERROR] Terjadi kesalahan!
)

echo.
pause
