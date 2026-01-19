# PANDUAN SERVER DINARA TRAVEL

## 🚀 CARA START SERVER

### Opsi 1: Klik File Batch (Paling Mudah)
1. Buka folder: `c:\xampp\htdocs\dinara\`
2. Double-click file: **`start_server.bat`**
3. Jendela Command Prompt akan terbuka
4. Server akan running otomatis
5. **JANGAN TUTUP** jendela Command Prompt

### Opsi 2: Manual via PowerShell/CMD
```cmd
cd c:\xampp\htdocs\dinara\public
C:\xampp\php\php.exe -S 0.0.0.0:8081
```

---

## 🌐 URL AKSES

**Dari Komputer Ini:**
- http://127.0.0.1:8081/index.php
- http://localhost:8081/index.php

**Dari HP/Device Lain (WiFi sama):**
- http://192.168.1.6:8081/index.php

**Admin Panel:**
- http://127.0.0.1:8081/admin
- http://192.168.1.6:8081/admin

---

## ⛔ CARA STOP SERVER

### Opsi 1: Klik File Batch
Double-click: **`stop_server.bat`**

### Opsi 2: Manual
Tekan **CTRL + C** di jendela Command Prompt yang menjalankan server

---

## ⚠️ PENTING - AGAR SERVER TIDAK CRASH!

### 1. **JANGAN Edit File PHP Saat Server Running**
   - Stop server dulu dengan `stop_server.bat`
   - Edit file PHP
   - Start server lagi dengan `start_server.bat`

### 2. **JANGAN Tutup Jendela Command Prompt**
   - Minimize saja, jangan di-close
   - Jika ditutup, server akan berhenti

### 3. **Jika Server Crash/Error:**
   ```
   1. Jalankan: stop_server.bat
   2. Tunggu 3 detik
   3. Jalankan: start_server.bat
   ```

### 4. **Cek Apakah Server Running:**
   - Buka Task Manager (CTRL + SHIFT + ESC)
   - Cari proses: **php.exe**
   - Jika ada, server sedang running

---

## 🔧 TROUBLESHOOTING

### Server Tidak Bisa Diakses
**Solusi:**
1. Stop server: `stop_server.bat`
2. Start ulang: `start_server.bat`
3. Cek firewall Windows tidak memblokir port 8081

### Error "Port 8081 already in use"
**Solusi:**
1. Jalankan `stop_server.bat` untuk kill proses lama
2. Start ulang dengan `start_server.bat`

### Website Error 404 / Tidak Load
**Solusi:**
1. Pastikan akses dengan `/index.php` di akhir URL
2. Hard refresh browser: **CTRL + SHIFT + R**
3. Clear cache atau gunakan mode incognito

### Akses dari HP Tidak Bisa
**Solusi:**
1. Pastikan HP dan komputer di WiFi yang sama
2. Cek IP komputer masih `192.168.1.6`:
   ```cmd
   ipconfig
   ```
3. Jika IP berubah, ganti di URL

---

## 📝 CATATAN PENGEMBANGAN

Jika ingin edit website:
1. **STOP SERVER** terlebih dahulu
2. Edit file PHP yang diinginkan
3. **START SERVER** kembali
4. Hard refresh browser untuk melihat perubahan

File penting yang sering diedit:
- `app/Views/landing_page_story.php` - Halaman utama
- `app/Views/admin_settings_unified.php` - Admin panel
- `app/Controllers/Kalkulator.php` - Logic kalkulator
- `public/uploads/` - Folder gambar

---

## 🎯 SHORTCUT

**Start Server:**
- Windows: `Win + R` → ketik `c:\xampp\htdocs\dinara\start_server.bat` → Enter

**Stop Server:**
- Windows: `Win + R` → ketik `c:\xampp\htdocs\dinara\stop_server.bat` → Enter

---

## 💾 BACKUP

Disarankan backup folder ini secara berkala:
- `c:\xampp\htdocs\dinara\`
- Database: `DB_SMART_TRAVEL` via phpMyAdmin

---

**Terakhir diupdate:** 18 Januari 2026
**Port Server:** 8081
**IP Address:** 192.168.1.6
