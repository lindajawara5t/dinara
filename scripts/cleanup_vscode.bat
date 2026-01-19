@echo off
title Cleanup VS Code & Speed Up
color 0E

echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║  CLEANUP VS CODE - FIX LEMOT                               ║
echo ╚════════════════════════════════════════════════════════════╝
echo.

echo [1/5] Membersihkan writable/debugbar...
if exist "..\writable\debugbar\*" (
    del /q /f "..\writable\debugbar\*.json" 2>nul
    echo ✓ Debugbar cleared
) else (
    echo - No debugbar files
)

echo.
echo [2/5] Membersihkan writable/cache...
if exist "..\writable\cache\*" (
    del /q /f "..\writable\cache\*" 2>nul
    echo ✓ Cache cleared
) else (
    echo - No cache files
)

echo.
echo [3/5] Membersihkan writable/logs...
if exist "..\writable\logs\log-*.log" (
    del /q /f "..\writable\logs\log-*.log" 2>nul
    echo ✓ Logs cleared
) else (
    echo - No log files
)

echo.
echo [4/5] Membersihkan writable/session...
if exist "..\writable\session\ci_session*" (
    del /q /f "..\writable\session\ci_session*" 2>nul
    echo ✓ Sessions cleared
) else (
    echo - No session files
)

echo.
echo [5/5] Membersihkan Git cache...
cd ..
git gc --auto
echo ✓ Git optimized

echo.
echo ════════════════════════════════════════════════════════════
echo  ✓ CLEANUP SELESAI!
echo ════════════════════════════════════════════════════════════
echo.
echo Rekomendasi:
echo 1. Close VS Code
echo 2. Run: code --disable-extensions
echo 3. Atau hapus extension yang tidak perlu
echo.
pause
