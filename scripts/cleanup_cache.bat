@echo off
REM ============================================
REM VS Code & Project Cleanup Script
REM Run this weekly to prevent slowdowns
REM ============================================

echo.
echo ╔════════════════════════════════════════╗
echo ║   VS CODE & PROJECT MAINTENANCE        ║
echo ╚════════════════════════════════════════╝
echo.

REM ===== CLEAR VS CODE CACHE =====
echo [1/4] Clearing VS Code cache...
if exist "%APPDATA%\Code\User\workspaceStorage" (
    rmdir /s /q "%APPDATA%\Code\User\workspaceStorage" >nul 2>&1
    echo ✓ Workspace storage cleared
)

if exist "%APPDATA%\Code\CachedExtensions" (
    rmdir /s /q "%APPDATA%\Code\CachedExtensions" >nul 2>&1
    echo ✓ Cached extensions cleared
)

REM ===== CLEAR PROJECT CACHE =====
echo.
echo [2/4] Clearing project cache...
if exist "writable\cache" (
    rmdir /s /q writable\cache >nul 2>&1
    mkdir writable\cache
    echo ✓ Project cache cleared
)

if exist "writable\debugbar" (
    rmdir /s /q writable\debugbar >nul 2>&1
    mkdir writable\debugbar
    echo ✓ Debugbar cache cleared
)

REM ===== CLEAR OLD LOGS =====
echo.
echo [3/4] Cleaning old logs...
if exist "writable\logs" (
    del /q writable\logs\log-*.log >nul 2>&1
    echo ✓ Old logs removed
)

REM ===== REPORT =====
echo.
echo [4/4] Maintenance complete!
echo.
echo Status:
echo ✓ VS Code global cache cleared
echo ✓ Project cache cleared
echo ✓ Old logs removed
echo ✓ Ready for fresh start
echo.
echo Recommendation:
echo 1. Close all VS Code windows
echo 2. Reopen this project
echo 3. Restart VS Code if still slow
echo.

pause
