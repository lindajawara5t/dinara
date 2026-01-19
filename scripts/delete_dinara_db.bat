@echo off
title Hapus Database Dinara
color 0C

echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║  HAPUS DATABASE DINARA                                     ║
echo ╚════════════════════════════════════════════════════════════╝
echo.
echo [!] PERINGATAN:
echo     Script ini akan MENGHAPUS database 'dinara'
echo     Database utama: db_smart_travel (tetap ada)
echo.

set /p confirm="Yakin ingin menghapus database 'dinara'? (Y/N): "
if /i not "%confirm%"=="Y" (
    echo.
    echo [i] Penghapusan dibatalkan.
    pause
    exit
)

echo.
echo [1] Menghapus database dinara...
C:\xampp\mysql\bin\mysql.exe -u root -e "DROP DATABASE IF EXISTS dinara;"

if %ERRORLEVEL% EQU 0 (
    echo [✓] Database 'dinara' berhasil dihapus!
    echo.
    echo [2] Verifikasi - Daftar database yang tersisa:
    C:\xampp\mysql\bin\mysql.exe -u root -e "SHOW DATABASES;"
) else (
    echo [✗] Gagal menghapus database!
)

echo.
pause
