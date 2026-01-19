@echo off
chcp 65001 >nul
cls
echo.
echo ========================================
echo   Dinara Travel - CodeIgniter 4 Server
echo ========================================
echo.
echo Starting server on http://localhost/dinara/
echo.
C:\xampp\php\php.exe spark serve --port 8000
pause
