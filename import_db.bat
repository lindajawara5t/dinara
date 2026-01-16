@echo off
cd C:\xampp\mysql\bin
timeout /t 2 /nobreak
mysql -u root < "C:\xampp\htdocs\dinara\database_schema.sql"
echo Database import complete!
pause
