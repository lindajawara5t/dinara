@echo off
echo ========================================
echo CLEAR ALL CACHE - FORCE REFRESH
echo ========================================
echo.

REM Clear database sessions
echo [1/3] Clearing database sessions...
C:\xampp\mysql\bin\mysql.exe -u root dinara -e "DELETE FROM ci_sessions WHERE 1=1;"

REM Clear writable cache if exists
echo [2/3] Clearing writable cache...
if exist "..\writable\cache\*" (
    del /q /f "..\writable\cache\*" 2>nul
    echo Writable cache cleared
) else (
    echo No writable cache to clear
)

REM Clear debugbar if exists
echo [3/3] Clearing debugbar cache...
if exist "..\writable\debugbar\*" (
    del /q /f "..\writable\debugbar\*" 2>nul
    echo Debugbar cache cleared
) else (
    echo No debugbar cache to clear
)

echo.
echo ========================================
echo ✓ ALL CACHE CLEARED!
echo ========================================
echo.
echo Silakan refresh browser Anda (Ctrl+Shift+R)
echo.
pause
