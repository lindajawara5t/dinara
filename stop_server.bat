@echo off
echo ====================================
echo   Stopping Dinara Travel Server
echo ====================================

taskkill /F /IM php.exe >nul 2>&1
if %errorlevel% equ 0 (
    echo Server berhasil dihentikan!
) else (
    echo Tidak ada server yang berjalan.
)

timeout /t 3
