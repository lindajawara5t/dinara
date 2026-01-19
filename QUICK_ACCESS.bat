@echo off
echo ========================================
echo   DINARA TRAVEL - QUICK ACCESS
echo ========================================
echo.
echo 1. Homepage
echo 2. Admin Dashboard
echo 3. Settings Estimasi (Edit Floating Box)
echo 4. Admin Data
echo 5. Exit
echo.
set /p choice="Pilih (1-5): "

if "%choice%"=="1" start http://localhost:8080/dinara/public/index.php
if "%choice%"=="2" start http://localhost:8080/dinara/public/index.php/admin/dashboard
if "%choice%"=="3" start http://localhost:8080/dinara/public/index.php/settings/estimasi-info
if "%choice%"=="4" start http://localhost:8080/dinara/public/index.php/admin
if "%choice%"=="5" exit

pause
