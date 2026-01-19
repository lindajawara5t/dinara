# 📋 Panduan Menu Settings - Dinara Admin

> **Update Terakhir:** 18 Januari 2026  
> **Status:** ✅ FINAL - Menu duplicate dihapus, semua settings terpusat

---

## 🎯 Menu Settings yang Benar

### 1. **Settings Website** (Unified)
**URL:** `http://localhost:8080/dinara/public/index.php/settings/unified`

**Fitur:**
- Header section (logo, tagline, background)
- Footer section (alamat, kontak, copyright)
- Upload gambar untuk logo dan background

**Cara Akses:**
- Dari Dashboard → Sidebar → **Settings Website**

---

### 2. **Settings Estimasi** 
**URL:** `http://localhost:8080/dinara/public/index.php/settings/estimasi-info`

**Fitur:**
- Edit deskripsi untuk **9 sections estimasi**:
  1. 🪟 **Deskripsi Box Total** (floating_box) - *INI YANG BARU!*
  2. 🚐 Transportasi Darat
  3. 🚢 Transportasi Laut
  4. 🏨 Penginapan
  5. 🌊 Wisata Laut
  6. 👨‍🏫 Guide Lokal
  7. 🛵 Transport Lokal
  8. 🍽️ Konsumsi
  9. ✨ Fasilitas Tambahan

**Cara Akses:**
- Dari Dashboard → Sidebar → **Settings Estimasi**

---

## ❌ Menu yang DIHAPUS (Duplicate)

### ~~Settings Estimasi di Dashboard~~
**Status:** DIHAPUS ✅  
**Alasan:** Redundant dengan menu Settings Estimasi di sidebar

**Yang Dihapus:**
- Section di dalam admin_dashboard.php
- Hardcoded array `$estimasiDefaults` yang tidak include floating_box
- Form yang save ke site_settings table (sekarang pakai site_content)

---

## 🗄️ Database Schema

### Table: `site_content`
Untuk Settings Estimasi

| Field | Type | Description |
|-------|------|-------------|
| id | INT | Primary Key |
| page_name | VARCHAR | Selalu 'estimasi' |
| section_name | VARCHAR | Kunci section (floating_box, transport_land, dll) |
| content_key | VARCHAR | 'title' atau 'description' |
| content_value | TEXT | Konten yang ditampilkan |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

**Contoh Data:**
```sql
| section_name  | content_key | content_value                                    |
|---------------|-------------|--------------------------------------------------|
| floating_box  | title       | Deskripsi Box Total                              |
| floating_box  | description | Ini total estimasi termurah liburan ke...        |
```

---

## 🔄 Update Flow

### Edit Deskripsi Floating Box:
1. Admin buka: `/settings/estimasi-info`
2. Lihat card **Deskripsi Box Total** dengan icon 🪟
3. Edit textarea → Klik Simpan
4. Data tersimpan di table `site_content`
5. Landing page auto load dari database

### Frontend Integration:
File: `app/Views/landing_page_story.php`

```javascript
// Floating box description loaded from PHP
const floatingBoxDescription = "<?= $floating_box_description ?? '' ?>";
const descElement = document.getElementById('floatingTotalDescription');
if (descElement && floatingBoxDescription) {
    descElement.innerHTML = floatingBoxDescription;
}
```

---

## 🎨 Styling Changes

### Popup Info (Mobile & Desktop):
```css
.popover {
    max-width: 380px !important;
    min-width: 300px;
}
```

### Floating Total Card:
```css
.floating-total-card {
    min-width: 240px;
    max-width: 280px;
}
```

### Book Now Button:
```css
.btn-book-now {
    white-space: nowrap;
    padding: 9px 12px;
    font-size: 0.75rem;
}
```

---

## ✅ Checklist Completion

- [x] Popup estimasi lebih lebar (300-380px)
- [x] Floating box lebih lebar (240-280px)
- [x] Button BOOK NOW tidak wrap text
- [x] Deskripsi floating box editable dari admin
- [x] Database table site_content dibuat
- [x] 9 sections termasuk floating_box tersimpan
- [x] Menu duplicate di dashboard dihapus
- [x] Link Settings Estimasi ditambahkan di sidebar
- [x] Port 8080 configuration fixed
- [x] Base URL double path bug fixed

---

## 🚀 Tested & Working

**Base URL:** `http://localhost:8080/dinara/public/index.php/`

**Working Routes:**
- ✅ `/admin/dashboard` - Dashboard utama
- ✅ `/admin/bookings` - Manajemen booking
- ✅ `/settings/unified` - Settings website
- ✅ `/settings/estimasi-info` - Settings estimasi (9 cards)

**Sidebar Navigation:**
- ✅ Dashboard
- ✅ Database Wisata
- ✅ Manajemen Booking
- ✅ Catatan Tamu (Legacy)
- ✅ Settings Website
- ✅ **Settings Estimasi** ← BARU!
- ✅ Lihat Website

---

## 📝 Notes untuk Developer

1. **Jangan tambahkan menu estimasi lagi di dashboard** - sudah ada di sidebar
2. **Gunakan table site_content** untuk semua konten dinamis
3. **Table site_settings** untuk settings statis (logo, footer, dll)
4. **Selalu test di port 8080** - bukan 8081 atau 80
5. **Cache:** Gunakan `php spark cache:clear` jika ada masalah

---

**Created by:** GitHub Copilot  
**For:** Dinara Travel Admin Panel  
**Version:** 2.0 - Single Menu Final
