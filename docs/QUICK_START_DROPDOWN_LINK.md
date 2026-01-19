# 🔗 QUICK START - Dropdown Link Terusan Slideshow

## Perubahan Utama

### 1️⃣ File yang Dimodifikasi
```
app/Views/admin_slideshow_management.php
```

### 2️⃣ Fitur Baru
✅ **Dropdown Menu** - Pilihan preset link yang sering digunakan
✅ **Custom URL Field** - Untuk URL yang tidak ada di preset  
✅ **Auto-Clear** - Smart mechanism untuk mencegah konfusi
✅ **Console Logging** - Untuk debugging

---

## 🎯 Penggunaan

### Saat Upload Slide Baru

**Option A: Gunakan Dropdown**
```
1. Upload gambar
2. Di "Link Tombol" → Pilih dari dropdown (misalnya: "🏨 Hotel")
3. Custom URL field akan auto-kosong
4. Klik "Upload Slideshow"
```

**Option B: Gunakan Custom URL**
```
1. Upload gambar
2. Di "Link Tombol" → Biarkan dropdown kosong
3. Isi field custom: https://www.example.com
4. Klik "Upload Slideshow"
```

### Saat Edit Slide

```
1. Klik tombol "Edit" pada slide
2. Modal terbuka → URL sudah terisi (di dropdown atau custom field)
3. Ubah link jika perlu
4. Klik "Simpan"
```

---

## 🔗 Link Options

### Preset Dropdown (11 opsi):
```
🎉 Promo              → javascript:showSection('promo')
🧮 Hitung Kalkulasi   → /kalkulator
🗺️ Destinasi          → /destinasi
🏨 Hotel              → /hotel
✈️ Travel & Wisata    → /travel
🏝️ Karimunjawa        → /travel/karimunjawa
📰 Blog & Terbaru     → /blog
✈️ Tiket Pesawat      → https://www.susiair.com/
🚤 Estimasi Harga     → javascript:showSection('estimasi')
📞 Hubungi Kami       → javascript:showSection('kontakkami')
```

### Custom URL Format:
```
Internal page   → /path/to/page
External URL    → https://example.com
JavaScript      → javascript:functionName('param')
WhatsApp        → https://wa.me/628xxxxx
```

---

## 🧪 Quick Test

### Test 1: Upload dengan Dropdown
```
1. Upload slide → Pilih "🏨 Hotel" dari dropdown
2. Landing page → Klik slide → Seharusnya buka halaman Hotel
3. F12 Console → Lihat: "📤 Uploading... /hotel"
```

### Test 2: Upload dengan Custom
```
1. Upload slide → Isi custom field: https://wa.me/628xxxxx
2. Landing page → Klik slide → Seharusnya buka WhatsApp
3. F12 Console → Lihat: "📤 Uploading... https://wa.me/628xxxxx"
```

### Test 3: Edit Slide
```
1. Click Edit → URL sudah terisi (dropdown atau custom)
2. Ubah link → Klik Simpan
3. Landing page → Verifikasi link baru berfungsi
```

---

## 📊 Database

Tabel `hero_slideshow` menyimpan:
```sql
button_label  VARCHAR(100)   -- Teks tombol
button_url    VARCHAR(500)   ← URL/JavaScript yang dipilih
button_class  VARCHAR(50)    -- Warna tombol (btn-warning, btn-primary, dll)
```

---

## 🎮 JavaScript Functions

### `getButtonUrl(dropdownSelector, customSelector)`
Mengambil URL dari dropdown atau custom field.
**Priority**: Custom URL > Dropdown

### `uploadSlideshow()`
Upload slide baru dengan URL yang dipilih

### `editSlideshow(id)`
Buka modal edit dan load URL ke field yang sesuai

### `saveEditSlideshow()`
Simpan perubahan slide termasuk URL baru

---

## 🐛 Debugging dengan F12 Console

### Saat Upload:
```
📤 Uploading slideshow with button_url: /hotel
```

### Saat Update:
```
🔄 Updating slideshow with button_url: https://example.com
```

### Saat Click Slide (Landing Page):
```
🔗 Opening slide link: /hotel
✅ Executed JavaScript: showSection('promo')
✅ Opened external link in new tab: https://example.com
✅ Navigating to: /hotel
```

---

## ✅ Verifikasi

- [x] Dropdown dan custom field bekerja
- [x] Auto-clear mechanism berfungsi
- [x] URL tersimpan di database
- [x] URL ditampilkan saat edit
- [x] Link berfungsi di landing page
- [x] Console logging ada

---

## 📝 Testing Steps

Lihat file lengkap: `/public/test_dropdown_link.html`

Buka di browser:
```
http://localhost:8080/dinara/public/test_dropdown_link.html
```

---

## 📞 Dukungan

Jika ada masalah:
1. Buka F12 console → cek error/log
2. Lihat file dokumentasi lengkap: `DROPDOWN_LINK_FIX.md`
3. Refresh page dan clear cache jika perlu

---

**Status**: ✅ Siap Digunakan
**Last Update**: 2024-01-17
