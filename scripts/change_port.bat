@echo off
REM Reset Apache ke port default 80
REM This script restores Apache to the default port configuration

REM Stop Apache
C:\xampp\apache\bin\httpd.exe -k stop 2>nul
timeout /t 2 /nobreak

REM Backup original
copy C:\xampp\apache\conf\httpd.conf C:\xampp\apache\conf\httpd.conf.bak

REM Set back to port 80 (standard HTTP port)
powershell -Command "(Get-Content 'C:\xampp\apache\conf\httpd.conf') -replace '^Listen (8080|8081)$','Listen 80' | Set-Content 'C:\xampp\apache\conf\httpd.conf'"

REM Start Apache
C:\xampp\apache\bin\httpd.exe -k start

echo Done! Apache now listening on port 80 (default)
pause
