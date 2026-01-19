# 🎯 PANDUAN AKSES WEBSITE DINARA - PORT 8080

## ✅ URL YANG BENAR (Copy-Paste langsung ke browser):

### 🏠 HOMEPAGE & USER PAGES
```
http://localhost:8080/dinara/public/index.php
```

### 👨‍💼 ADMIN DASHBOARD
```
http://localhost:8080/dinara/public/index.php/admin/dashboard
```

### ⚙️ SETTINGS PAGES

**Settings Estimasi (Edit Popup & Floating Box):**
```
http://localhost:8080/dinara/public/index.php/settings/estimasi-info
```

**Settings Homepage:**
```
http://localhost:8080/dinara/public/index.php/settings/homepage
```

**Settings Unified:**
```
http://localhost:8080/dinara/public/index.php/settings/unified
```

### 📊 ADMIN DATA MANAGEMENT
```
http://localhost:8080/dinara/public/index.php/admin
```

### 💰 FINANCE & BOOKING
```
http://localhost:8080/dinara/public/index.php/admin/finance
http://localhost:8080/dinara/public/index.php/admin/booking
```

---

## 🎯 BASE URL CONFIGURATION (SUDAH DIPERBAIKI):

File: `.env`
```
app.baseURL = 'http://localhost:8080/dinara/public/'
```

File: `app/Config/App.php`
```php
public string $baseURL = 'http://localhost:8080/dinara/public/';
// Constructor sudah diperbaiki untuk tidak double path
```

File: `public/.htaccess`
```
RewriteBase /dinara/public/
```

---

## ⚠️ MASALAH YANG SUDAH DIPERBAIKI:

✅ **Double path fixed** - Link tidak lagi menghasilkan `/dinara/public/dinara/public/`  
✅ **Port konsisten** - Semua menggunakan port 8080  
✅ **Base URL konsisten** - Semua konfigurasi sudah sync  
✅ **Cache cleared** - Tidak ada cache lama yang conflict

---

## 📝 CARA EDIT DESKRIPSI FLOATING BOX:

1. Buka: `http://localhost:8081/dinara/public/settings/estimasi-info`
2. Cari card **"Deskripsi Box Total"**
3. Edit textarea
4. Klik tombol **Simpan**
5. Refresh halaman web untuk lihat perubahan

---

## ⚠️ TROUBLESHOOTING:

**Jika masih error 404:**
1. Restart Apache di XAMPP Control Panel
2. Clear browser cache (Ctrl+Shift+Del)
3. Gunakan format dengan index.php di URL

**Jika link di admin dashboard error:**
- Semua link internal sudah otomatis menggunakan `base_url()`
- Base URL sudah di-set ke: `http://localhost:8081/dinara/public/`

---

## 🎯 BASE URL CONFIGURATION:

File: `.env`
```
app.baseURL = 'http://localhost:8081/dinara/public/'
```

File: `app/Config/App.php`
```php
public string $baseURL = 'http://localhost:8081/dinara/public/';
```

File: `public/.htaccess`
```
RewriteBase /dinara/public/
```

---

## ✅ VERIFIKASI KONFIGURASI:

Jalankan di terminal:
```powershell
cd c:\xampp\htdocs\dinara
Invoke-WebRequest -Uri "http://localhost:8081/dinara/public/" -UseBasicParsing | Select-Object StatusCode
```

Harusnya return: **StatusCode = 200**

---

**Dibuat:** 18 Januari 2026  
**Port:** 8081  
**Path:** /dinara/public/
