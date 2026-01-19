@echo off
title Restart VS Code - Optimized
color 0B

echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║  RESTART VS CODE - OPTIMIZED MODE                          ║
echo ╚════════════════════════════════════════════════════════════╝
echo.

echo [INFO] VS Code akan direstart dengan optimasi performa
echo.
echo Optimasi yang diterapkan:
echo  ✓ Exclude writable/debugbar, logs, cache, session
echo  ✓ Exclude system folder dari indexing
echo  ✓ Disable Git auto-refresh dan decorations
echo  ✓ Disable minimap, codeLens, occurrencesHighlight
echo  ✓ Reduce hover delay dan suggestions
echo.

set /p close="Close VS Code sekarang? (Y/N): "
if /i not "%close%"=="Y" (
    echo.
    echo [i] Restart dibatalkan.
    echo     Silakan close VS Code manual lalu run script ini lagi.
    pause
    exit
)

echo.
echo [1/3] Menutup VS Code...
taskkill /F /IM Code.exe 2>nul
timeout /t 2 >nul

echo [2/3] Membersihkan cache...
if exist "%APPDATA%\Code\Cache\*" (
    del /q /f "%APPDATA%\Code\Cache\*" 2>nul
)
if exist "%APPDATA%\Code\CachedData\*" (
    rd /s /q "%APPDATA%\Code\CachedData" 2>nul
)

echo [3/3] Membuka VS Code dengan optimasi...
cd ..
start "" "code" .

echo.
echo ════════════════════════════════════════════════════════════
echo  ✓ VS CODE RESTARTED!
echo ════════════════════════════════════════════════════════════
echo.
echo Tips tambahan jika masih lemot:
echo 1. Disable extension yang tidak perlu:
echo    - Extensions → Click gear → Disable
echo.
echo 2. Atau buka dengan mode safe (no extensions):
echo    - code --disable-extensions .
echo.
echo 3. Check task manager untuk process yang berat
echo.
pause
