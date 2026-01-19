@echo off
echo ====================================
echo   Starting Dinara Travel Server
echo ====================================
echo.
echo Server akan berjalan di:
echo - Localhost: http://127.0.0.1:8081/index.php
echo - Network:   http://192.168.1.6:8081/index.php
echo.
echo Tekan CTRL+C untuk stop server
echo ====================================
echo.

cd /d "c:\xampp\htdocs\dinara\public"
C:\xampp\php\php.exe -S 0.0.0.0:8081

pause
