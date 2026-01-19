@echo off
echo Cek data di database dinara...
C:\xampp\mysql\bin\mysql.exe -u root -e "SELECT section_name, content_key, content_value FROM dinara.site_content WHERE page_name = 'estimasi' AND section_name = 'floating_box'"
echo.
echo Cek data di database db_smart_travel...
C:\xampp\mysql\bin\mysql.exe -u root -e "SELECT section_name, content_key, content_value FROM db_smart_travel.site_content WHERE page_name = 'estimasi' AND section_name = 'floating_box'"
pause
