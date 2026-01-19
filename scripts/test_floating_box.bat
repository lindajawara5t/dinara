@echo off
echo ========================================
echo TEST FLOATING BOX - VERIFIKASI
echo ========================================
echo.

echo [1] Cek Database:
echo ----------------------------------------
C:\xampp\mysql\bin\mysql.exe -u root dinara -e "SELECT id, section_name, content_key, content_value FROM site_content WHERE page_name = 'estimasi' AND section_name = 'floating_box';"

echo.
echo [2] Cek Controller Output (landing page):
echo ----------------------------------------
echo Membuka browser untuk test...
start http://localhost/dinara/

echo.
echo ========================================
echo CARA TEST:
echo ========================================
echo 1. Buka halaman yang muncul di browser
echo 2. Scroll ke kanan bawah, lihat Floating Box
echo 3. Cek apakah teks sesuai dengan database
echo.
echo Teks yang HARUS muncul:
echo "TESTING PERUBAHAN BARU - HARUSNYA LANGSUNG MUNCUL"
echo.
echo Jika tidak muncul, tekan Ctrl+Shift+R di browser
echo untuk hard refresh.
echo.
pause
