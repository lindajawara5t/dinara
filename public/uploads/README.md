# 📁 Struktur Folder Upload - Dinara Travel

Sistem upload gambar yang terorganisir dengan auto-delete file lama.

## 📂 Struktur Folder

```
public/uploads/
├── logo_image (Logo website)
├── hero_image (Hero background)
├── karimunjawa/ (3 foto Karimunjawa)
│   ├── km_photo_1.jpg
│   ├── km_photo_2.jpg
│   └── km_photo_3.jpg
├── promo/ (3 kartu promo)
│   ├── promo_1_image.jpg
│   ├── promo_2_image.jpg
│   └── promo_3_image.jpg
├── flyer/ (5 flyer promosi)
│   ├── flyer_1.jpg
│   ├── flyer_2.jpg
│   ├── flyer_3.jpg
│   ├── flyer_4.jpg
│   └── flyer_5.jpg
└── gallery/ (8 foto gallery)
    ├── gallery_1.jpg
    ├── gallery_2.jpg
    ├── ...
    └── gallery_8.jpg
```

## ✨ Fitur Auto-Delete

Ketika Anda upload gambar baru:
1. **File lama otomatis dihapus** dari server
2. **File baru disimpan** dengan nama random
3. **Database diupdate** dengan nama file baru
4. **Tidak ada file menumpuk** di folder

## 🎯 Cara Menggunakan

### 1. Akses Admin Settings
Buka: http://localhost/settings/unified

### 2. Pilih Tab
- **General** - Identitas website
- **Gambar & Logo** - Logo dan hero background
- **Tentang Karimunjawa** - 3 foto Karimunjawa
- **Info Penting** - Info kapal, waktu, biaya
- **Promo & Flyer** - Promo cards, flyer, gallery
- **Estimasi** - Deskripsi estimasi biaya

### 3. Upload Gambar
- Klik area preview gambar
- Pilih file dari komputer (max 2MB)
- Lihat preview langsung
- Klik tombol "Simpan"

### 4. File Lama Terhapus Otomatis
Saat Anda upload gambar baru ke slot yang sama:
- File lama dihapus dari `uploads/xxx/`
- File baru disimpan dengan nama random
- Database diupdate
- Website langsung menampilkan gambar baru

## 📋 Rekomendasi Ukuran Gambar

| Jenis | Ukuran Rekomendasi | Format |
|-------|-------------------|--------|
| Logo | 200x200px | PNG (transparan) |
| Hero Background | 1920x600px | JPG |
| Karimunjawa Photos | 800x600px | JPG |
| Promo Cards | 600x400px | JPG |
| Flyer | 800x1200px | JPG/PNG |
| Gallery | 600x600px | JPG |

## 🔒 Keamanan

- ✅ File upload dibatasi hanya gambar (JPG, PNG, WebP)
- ✅ Ukuran file max 2MB (bisa disesuaikan)
- ✅ Nama file di-random untuk keamanan
- ✅ Folder upload dilindungi .htaccess

## 🛠️ Troubleshooting

### Gambar tidak muncul di website?
1. Pastikan file terupload di folder yang benar
2. Cek permission folder (755)
3. Refresh browser dengan Ctrl+F5

### Upload gagal?
1. Cek ukuran file (max 2MB)
2. Cek format file (hanya JPG, PNG, WebP)
3. Pastikan folder writable (chmod 755)

### File lama tidak terhapus?
1. Cek permission folder uploads/
2. Pastikan setting_key di database sama persis dengan nama field

## 📊 Database

Semua path gambar disimpan di tabel `site_settings`:

```sql
setting_key          | setting_value
---------------------|-------------------
logo_image           | logo_abc123.png
hero_image           | hero_def456.jpg
km_photo_1           | km1_ghi789.jpg
km_photo_2           | km2_jkl012.jpg
km_photo_3           | km3_mno345.jpg
promo_1_image        | promo1_pqr678.jpg
flyer_1              | flyer1_stu901.jpg
gallery_1            | gal1_vwx234.jpg
```

Nilai hanya nama file, bukan full URL!

## 🎉 Kelebihan Sistem Ini

1. **Terorganisir** - Setiap jenis gambar punya folder sendiri
2. **Tidak Menumpuk** - File lama auto-delete saat upload baru
3. **Mudah Backup** - Tinggal zip folder uploads/
4. **Mudah Migrasi** - Copy folder + export database
5. **Hemat Storage** - Tidak ada file unused
6. **User Friendly** - Admin tinggal klik dan upload

---

**Dibuat:** 12 Januari 2026  
**Version:** 2.0 (Modern Upload System)
