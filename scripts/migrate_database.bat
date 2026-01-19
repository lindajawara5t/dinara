@echo off
title Migrasi Database: dinara -> db_smart_travel
color 0E

echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║  MIGRASI DATA: dinara -^> db_smart_travel                   ║
echo ╚════════════════════════════════════════════════════════════╝
echo.
echo [!] PERINGATAN:
echo     Script ini akan memindahkan semua data estimasi
echo     dari database 'dinara' ke 'db_smart_travel'
echo.
echo [1] Cek data di database dinara...
echo ────────────────────────────────────────────────────────────
C:\xampp\mysql\bin\mysql.exe -u root -e "SELECT COUNT(*) as total FROM dinara.site_content WHERE page_name = 'estimasi';"
echo.

set /p confirm="Lanjutkan migrasi? (Y/N): "
if /i not "%confirm%"=="Y" (
    echo Migrasi dibatalkan.
    pause
    exit
)

echo.
echo [2] Memindahkan data ke db_smart_travel...
echo ────────────────────────────────────────────────────────────
C:\xampp\mysql\bin\mysql.exe -u root db_smart_travel < migrate_to_smart_travel.sql

if %ERRORLEVEL% EQU 0 (
    echo.
    echo [✓] Migrasi berhasil!
    echo.
    echo [3] Verifikasi data di db_smart_travel...
    echo ────────────────────────────────────────────────────────────
    C:\xampp\mysql\bin\mysql.exe -u root -e "SELECT section_name, content_key, LEFT(content_value, 50) as content FROM db_smart_travel.site_content WHERE page_name = 'estimasi' ORDER BY section_name, content_key;"
    
    echo.
    echo [4] Hapus database dinara? (Y/N)
    set /p delete="Pilihan: "
    if /i "%delete%"=="Y" (
        C:\xampp\mysql\bin\mysql.exe -u root -e "DROP DATABASE IF EXISTS dinara;"
        echo [✓] Database dinara berhasil dihapus!
    ) else (
        echo [i] Database dinara tidak dihapus (tetap ada).
    )
) else (
    echo.
    echo [✗] Migrasi gagal!
)

echo.
echo ════════════════════════════════════════════════════════════
echo  SELESAI!
echo ════════════════════════════════════════════════════════════
echo.
pause
