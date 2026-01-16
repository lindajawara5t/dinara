# PANDUAN MENGGUNAKAN HERO SLIDESHOW

## Apa yang Sudah Dibuat?

Hero background statis di halaman utama sudah diganti dengan **sistem slideshow dinamis** yang bisa dikelola dari admin panel.

## Langkah-Langkah Setup

### 1. Import Database Table

Jalankan salah satu cara berikut:

**Cara A - Menggunakan Batch File (Mudah):**
```
Klik 2x file: import_hero_slideshow.bat
```

**Cara B - Manual via phpMyAdmin:**
1. Buka phpMyAdmin
2. Pilih database `dinara_travel` (atau nama database Anda)
3. Klik tab "SQL"
4. Copy-paste isi file `create_hero_slideshow_table.sql`
5. Klik "Go"

### 2. Upload Gambar Slideshow

1. Buka halaman admin: `http://localhost/dinara/admin`
2. Login sebagai admin
3. Klik menu **"Gambar & Logo"** atau **"Hero Slideshow"**
4. Klik tab **"Hero Slideshow"**
5. Upload gambar slideshow Anda:
   - Klik area upload atau drag gambar
   - Isi judul (opsional)
   - Isi deskripsi (opsional)
   - Klik "Upload Slideshow"

### 3. Kelola Slideshow

Dari halaman admin slideshow, Anda bisa:

- ✅ **Upload** gambar baru
- ✏️ **Edit** judul dan deskripsi
- 👁️ **Toggle** aktif/nonaktif slide
- 🗑️ **Hapus** slide yang tidak diperlukan
- ↕️ **Drag & Drop** untuk mengubah urutan slide

## Rekomendasi Gambar

- **Ukuran:** 1920x600px (landscape)
- **Format:** JPG, PNG, WebP
- **Ukuran File:** Max 2MB per gambar
- **Jumlah:** 3-5 slide untuk performa optimal

## Fitur Slideshow

- ✨ **Auto-play** - Slide berganti otomatis setiap 5 detik
- ⏸️ **Manual control** - Tombol prev/next untuk navigasi manual
- 🔘 **Dot indicators** - Klik dot untuk langsung ke slide tertentu
- 📱 **Responsive** - Tampil baik di mobile & desktop
- 🎨 **Smooth transition** - Animasi fade yang halus

## Troubleshooting

### Slideshow tidak muncul?
1. Pastikan tabel `hero_slideshow` sudah dibuat
2. Pastikan minimal ada 1 slide yang aktif
3. Periksa Console Browser (F12) untuk error JavaScript

### Gambar tidak muncul?
1. Periksa path gambar di database
2. Pastikan folder `uploads/hero/` exist dan writable
3. Periksa permission folder (chmod 755)

### Slide tidak berganti otomatis?
1. Buka Console Browser (F12)
2. Cek apakah ada error JavaScript
3. Pastikan minimal ada 2 slide aktif

## File yang Dimodifikasi

1. ✅ `app/Controllers/Kalkulator.php` - Menambah load data slideshow
2. ✅ `app/Views/landing_page_story.php` - Render slideshow dari database
3. ✅ `app/Models/HeroSlideshowModel.php` - Model untuk slideshow (sudah ada)
4. ✅ `app/Controllers/Admin.php` - CRUD slideshow (sudah ada)
5. ✅ `app/Views/admin_slideshow_management.php` - UI admin (sudah ada)
6. ✅ `app/Config/Routes.php` - Routes slideshow (sudah ada)

## Contoh Data Sample

Jika ingin menguji tanpa upload gambar, gunakan URL gambar eksternal:

```sql
INSERT INTO `hero_slideshow` (`title`, `description`, `image_url`, `sort_order`, `is_active`) VALUES
('Karimunjawa Paradise', 'Jelajahi kepulauan tropis Indonesia', 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1920', 0, 1),
('Beach & Island', 'Snorkeling di air jernih', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1920', 1, 1);
```

## Support

Jika ada masalah, periksa:
- PHP error log: `writable/logs/`
- Browser console: F12 > Console
- Database: pastikan data di tabel `hero_slideshow`

---

✨ **Selamat! Hero slideshow Anda sudah siap!**
