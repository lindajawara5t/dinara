<?php
// Admin Settings for Home Page Content
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Home Page - Dinara Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        
        /* SIDEBAR */
        .sidebar { min-height: 100vh; background: #2c3e50; color: white; padding-top: 20px; position: fixed; width: 250px; z-index: 1000; }
        .sidebar-brand { font-size: 1.3rem; font-weight: 800; text-align: center; margin-bottom: 40px; display: block; color: #ecf0f1; text-decoration: none; letter-spacing: 1px; }
        .nav-sidebar .nav-link { color: #bdc3c7; padding: 15px 25px; border-radius: 0; display: flex; align-items: center; transition: 0.3s; font-weight: 500; cursor: pointer; }
        .nav-sidebar .nav-link:hover, .nav-sidebar .nav-link.active { background: #34495e; color: #fff; border-left: 5px solid #3498db; padding-left: 20px; }
        .nav-sidebar .nav-link i { margin-right: 12px; font-size: 1.1rem; width: 25px; text-align: center; }
        
        /* MAIN CONTENT */
        .main-content { margin-left: 250px; padding: 30px; }
        
        .setting-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 20px;
        }
        .setting-card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 20px;
        }
        .setting-card-body {
            padding: 20px;
        }
        .preview-image {
            width: 100%;
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .form-label { font-weight: 600; color: #333; }
        .btn-save { background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%); border: none; }
        .btn-save:hover { background: linear-gradient(135deg, #0099ff 0%, #0d6efd 100%); }
        
        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <a href="#" class="sidebar-brand"><i class="bi bi-airplane-engines-fill text-warning"></i> DINARA ADMIN</a>
        
        <ul class="nav flex-column nav-sidebar">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin') ?>">
                    <i class="bi bi-database-fill-gear"></i> Database Wisata
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url('settings/homepage') ?>">
                    <i class="bi bi-house-gear-fill"></i> Settings Home Page
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('settings/estimasi-info') ?>">
                    <i class="bi bi-sliders"></i> Settings Estimasi
                </a>
            </li>

            <li class="nav-item mt-5 pt-5 border-top border-secondary">
                <a href="/" target="_blank" class="nav-link text-warning">
                    <i class="bi bi-globe"></i> Lihat Website
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="fw-bold text-dark"><i class="bi bi-house-gear-fill text-primary"></i> Settings Home Page</h2>
                    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary btn-sm rounded-pill">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
                <p class="text-muted small">Kelola semua konten yang tampil di halaman Home (Promo Section)</p>
            </div>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <!-- TAB NAVIGATION -->
        <ul class="nav nav-pills mb-4" id="settingsTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="general-tab" data-bs-toggle="pill" data-bs-target="#general" type="button">
                    <i class="bi bi-gear me-1"></i> General
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="hero-tab" data-bs-toggle="pill" data-bs-target="#hero" type="button">
                    <i class="bi bi-images me-1"></i> Hero Slider
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="karimunjawa-tab" data-bs-toggle="pill" data-bs-target="#karimunjawa" type="button">
                    <i class="bi bi-geo-alt me-1"></i> Tentang Karimunjawa
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="info-tab" data-bs-toggle="pill" data-bs-target="#info" type="button">
                    <i class="bi bi-info-circle me-1"></i> Informasi Penting
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="promo-tab" data-bs-toggle="pill" data-bs-target="#promo" type="button">
                    <i class="bi bi-tag me-1"></i> Promo Cards
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="flyer-tab" data-bs-toggle="pill" data-bs-target="#flyer" type="button">
                    <i class="bi bi-images me-1"></i> Flyer Promo
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="gallery-tab" data-bs-toggle="pill" data-bs-target="#gallery" type="button">
                    <i class="bi bi-camera me-1"></i> Gallery
                </button>
            </li>
        </ul>

        <!-- TAB CONTENT -->
        <div class="tab-content" id="settingsTabContent">
            <!-- GENERAL SETTINGS -->
            <div class="tab-pane fade show active" id="general" role="tabpanel">
                <form action="<?= base_url('settings/save-homepage') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="section" value="general">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="setting-card">
                                <div class="setting-card-header">
                                    <h6 class="mb-0"><i class="bi bi-card-heading me-2"></i>Header & Branding</h6>
                                </div>
                                <div class="setting-card-body">
                                    <div class="mb-3">
                                        <label class="form-label">App Name</label>
                                        <input type="text" class="form-control" name="app_name" value="<?= esc($settings['app_name'] ?? 'Dinara Travel') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Welcome Text (Header)</label>
                                        <input type="text" class="form-control" name="welcome_text" value="<?= esc($settings['welcome_text'] ?? 'Selamat Datang di Dinara Travel!') ?>">
                                        <small class="text-muted">Teks yang muncul di header saat Home page aktif</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Announcement (Running Text)</label>
                                        <input type="text" class="form-control" name="announcement" value="<?= esc($settings['announcement'] ?? 'Promo Lebaran! Diskon 20% untuk semua paket wisata.') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Logo</label>
                                        <?php if(!empty($settings['logo_image'])): ?>
                                        <img src="<?= base_url('uploads/' . $settings['logo_image']) ?>" class="preview-image d-block" style="max-height: 80px; width: auto;">
                                        <?php endif; ?>
                                        <input type="file" class="form-control" name="logo_image" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="setting-card">
                                <div class="setting-card-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                    <h6 class="mb-0"><i class="bi bi-whatsapp me-2"></i>Kontak WhatsApp</h6>
                                </div>
                                <div class="setting-card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor WhatsApp</label>
                                        <input type="text" class="form-control" name="whatsapp_number" value="<?= esc($settings['whatsapp_number'] ?? '6281234567890') ?>">
                                        <small class="text-muted">Format: 62812xxxxxxxx (tanpa + atau spasi)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-save btn-lg text-white mt-3">
                        <i class="bi bi-check-lg me-2"></i>Simpan Pengaturan General
                    </button>
                </form>
            </div>

            <!-- HERO SLIDER SETTINGS -->
            <div class="tab-pane fade" id="hero" role="tabpanel">
                <!-- PERINGATAN: SISTEM BARU -->
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading"><i class="bi bi-exclamation-triangle me-2"></i>Sistem Slideshow Baru Tersedia!</h5>
                    <p class="mb-2">Hero slideshow sekarang menggunakan <strong>sistem database</strong> yang lebih powerful dan mudah dikelola.</p>
                    <hr>
                    <p class="mb-2"><strong>Fitur baru:</strong></p>
                    <ul class="mb-3">
                        <li>Upload multiple gambar dengan mudah</li>
                        <li>Drag & drop untuk mengatur urutan</li>
                        <li>Toggle aktif/nonaktif per slide</li>
                        <li>Edit gambar tanpa hapus yang lama</li>
                    </ul>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('admin/settings') ?>#slideshow" class="btn btn-warning">
                            <i class="bi bi-images me-1"></i> Kelola Hero Slideshow Baru
                        </a>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="alert">Tetap Gunakan Sistem Lama</button>
                    </div>
                </div>
                
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i><strong>Catatan:</strong> Form di bawah ini adalah sistem lama dan akan segera dihapus. Disarankan menggunakan sistem baru di atas.
                </div>
                
                <form action="<?= base_url('settings/save-homepage') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="section" value="hero_slider">
                    <div class="setting-card">
                        <div class="setting-card-header">
                            <h6 class="mb-0"><i class="bi bi-images me-2"></i>Hero Slides (Slider) - <span class="badge bg-secondary">SISTEM LAMA</span></h6>
                        </div>
                        <div class="setting-card-body">
                            <div id="heroSlidesRepeater">
                                <?php 
                                $hero_slides = [];
                                if (!empty($settings['hero_slides'])) {
                                    $hero_slides = json_decode($settings['hero_slides'], true);
                                } elseif (!empty($settings['hero_title']) || !empty($settings['hero_image'])) {
                                    $hero_slides[] = [
                                        'title' => $settings['hero_title'] ?? '',
                                        'subtitle' => $settings['hero_subtitle'] ?? '',
                                        'image' => $settings['hero_image'] ?? '',
                                        'button_label' => 'Ambil Promo',
                                        'button_action' => '',
                                        'button_class' => 'btn-warning',
                                        'duration' => 4000
                                    ];
                                }
                                if (empty($hero_slides)) $hero_slides[] = ['title'=>'','subtitle'=>'','image'=>'','button_label'=>'','button_action'=>'','button_class'=>'btn-primary','duration'=>4000];
                                ?>
                                <?php foreach($hero_slides as $i => $slide): ?>
                                <div class="card mb-3 hero-slide-item" data-index="<?= $i ?>">
                                    <div class="card-body bg-light border rounded-3">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-4">
                                                <label class="form-label">Gambar Slide</label>
                                                <?php if(!empty($slide['image'])): ?>
                                                    <img src="<?= base_url('uploads/' . $slide['image']) ?>" class="preview-image mb-2">
                                                <?php endif; ?>
                                                <input type="file" class="form-control mb-2" name="hero_slides[<?= $i ?>][image_file]" accept="image/*">
                                                <input type="hidden" name="hero_slides[<?= $i ?>][image]" value="<?= esc($slide['image']) ?>">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="mb-2">
                                                    <label class="form-label">Judul Slide</label>
                                                    <input type="text" class="form-control" name="hero_slides[<?= $i ?>][title]" value="<?= esc($slide['title']) ?>">
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Subjudul Slide</label>
                                                    <input type="text" class="form-control" name="hero_slides[<?= $i ?>][subtitle]" value="<?= esc($slide['subtitle']) ?>">
                                                </div>
                                                <div class="mb-2 row g-2">
                                                    <div class="col-md-5">
                                                        <label class="form-label">Label Tombol</label>
                                                        <input type="text" class="form-control" name="hero_slides[<?= $i ?>][button_label]" value="<?= esc($slide['button_label'] ?? '') ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Class Tombol</label>
                                                        <select class="form-select" name="hero_slides[<?= $i ?>][button_class]">
                                                            <option value="btn-warning" <?= ($slide['button_class']??'')=='btn-warning'?'selected':'' ?>>Kuning</option>
                                                            <option value="btn-primary" <?= ($slide['button_class']??'')=='btn-primary'?'selected':'' ?>>Biru</option>
                                                            <option value="btn-success" <?= ($slide['button_class']??'')=='btn-success'?'selected':'' ?>>Hijau</option>
                                                            <option value="btn-info" <?= ($slide['button_class']??'')=='btn-info'?'selected':'' ?>>Info</option>
                                                            <option value="btn-dark" <?= ($slide['button_class']??'')=='btn-dark'?'selected':'' ?>>Hitam</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Durasi (ms)</label>
                                                        <input type="number" class="form-control" name="hero_slides[<?= $i ?>][duration]" value="<?= esc($slide['duration'] ?? 4000) ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Aksi Tombol (JS/URL)</label>
                                                    <input type="text" class="form-control" name="hero_slides[<?= $i ?>][button_action]" value="<?= esc($slide['button_action'] ?? '') ?>" placeholder="Contoh: showSection('estimasi') atau https://wa.me/628xxxx">
                                                </div>
                                                <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeHeroSlide(this)"><i class="bi bi-trash"></i> Hapus Slide</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm mb-2" onclick="addHeroSlide()"><i class="bi bi-plus-circle"></i> Tambah Slide</button>
                            <script>
                            function addHeroSlide() {
                                var idx = document.querySelectorAll('.hero-slide-item').length;
                                var html = `<div class=\"card mb-3 hero-slide-item\" data-index=\"${idx}\"><div class=\"card-body bg-light border rounded-3\"><div class=\"row g-2 align-items-end\"><div class=\"col-md-4\"><label class=\"form-label\">Gambar Slide</label><input type=\"file\" class=\"form-control mb-2\" name=\"hero_slides[${idx}][image_file]\" accept=\"image/*\"><input type=\"hidden\" name=\"hero_slides[${idx}][image]\" value=\"\"></div><div class=\"col-md-8\"><div class=\"mb-2\"><label class=\"form-label\">Judul Slide</label><input type=\"text\" class=\"form-control\" name=\"hero_slides[${idx}][title]\" value=\"\"></div><div class=\"mb-2\"><label class=\"form-label\">Subjudul Slide</label><input type=\"text\" class=\"form-control\" name=\"hero_slides[${idx}][subtitle]\" value=\"\"></div><div class=\"mb-2 row g-2\"><div class=\"col-md-5\"><label class=\"form-label\">Label Tombol</label><input type=\"text\" class=\"form-control\" name=\"hero_slides[${idx}][button_label]\" value=\"\"></div><div class=\"col-md-4\"><label class=\"form-label\">Class Tombol</label><select class=\"form-select\" name=\"hero_slides[${idx}][button_class]\"><option value=\"btn-warning\">Kuning</option><option value=\"btn-primary\">Biru</option><option value=\"btn-success\">Hijau</option><option value=\"btn-info\">Info</option><option value=\"btn-dark\">Hitam</option></select></div><div class=\"col-md-3\"><label class=\"form-label\">Durasi (ms)</label><input type=\"number\" class=\"form-control\" name=\"hero_slides[${idx}][duration]\" value=\"4000\"></div></div><div class=\"mb-2\"><label class=\"form-label\">Aksi Tombol (JS/URL)</label><input type=\"text\" class=\"form-control\" name=\"hero_slides[${idx}][button_action]\" value=\"\" placeholder=\"Contoh: showSection('estimasi') atau https://wa.me/628xxxx\"></div><button type=\"button\" class=\"btn btn-danger btn-sm mt-2\" onclick=\"removeHeroSlide(this)\"><i class=\"bi bi-trash\"></i> Hapus Slide</button></div></div></div></div>`;
                                document.getElementById('heroSlidesRepeater').insertAdjacentHTML('beforeend', html);
                            }
                            function removeHeroSlide(btn) {
                                var card = btn.closest('.hero-slide-item');
                                card.parentNode.removeChild(card);
                            }
                            </script>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-save btn-lg text-white mt-3">
                        <i class="bi bi-check-lg me-2"></i>Simpan Hero Slider
                    </button>
                </form>
            </div>

            <!-- TENTANG KARIMUNJAWA -->
            <div class="tab-pane fade" id="karimunjawa" role="tabpanel">
                <form action="<?= base_url('settings/save-homepage') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="section" value="karimunjawa">
                    
                    <div class="setting-card">
                        <div class="setting-card-header" style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
                            <h6 class="mb-0"><i class="bi bi-geo-alt me-2"></i>Tentang Karimunjawa</h6>
                        </div>
                        <div class="setting-card-body">
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Karimunjawa</label>
                                <textarea class="form-control" name="about_karimunjawa" rows="4"><?= esc($settings['about_karimunjawa'] ?? 'Karimunjawa adalah kepulauan yang terdiri dari 27 pulau di Laut Jawa, sekitar 80 km barat laut Jepara. Dikenal sebagai "surga tersembunyi", Karimunjawa menawarkan keindahan alam bawah laut yang luar biasa, pantai berpasir putih, dan hutan mangrove yang asri.') ?></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Foto Utama</label>
                                        <?php if(!empty($settings['km_photo_1'])): ?>
                                        <img src="<?= esc($settings['km_photo_1']) ?>" class="preview-image">
                                        <?php endif; ?>
                                        <input type="url" class="form-control" name="km_photo_1" value="<?= esc($settings['km_photo_1'] ?? '') ?>" placeholder="URL gambar atau upload">
                                        <input type="file" class="form-control mt-2" name="km_photo_1_file" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Foto Kedua</label>
                                        <?php if(!empty($settings['km_photo_2'])): ?>
                                        <img src="<?= esc($settings['km_photo_2']) ?>" class="preview-image">
                                        <?php endif; ?>
                                        <input type="url" class="form-control" name="km_photo_2" value="<?= esc($settings['km_photo_2'] ?? '') ?>" placeholder="URL gambar atau upload">
                                        <input type="file" class="form-control mt-2" name="km_photo_2_file" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Foto Ketiga</label>
                                        <?php if(!empty($settings['km_photo_3'])): ?>
                                        <img src="<?= esc($settings['km_photo_3']) ?>" class="preview-image">
                                        <?php endif; ?>
                                        <input type="url" class="form-control" name="km_photo_3" value="<?= esc($settings['km_photo_3'] ?? '') ?>" placeholder="URL gambar atau upload">
                                        <input type="file" class="form-control mt-2" name="km_photo_3_file" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-save btn-lg text-white">
                        <i class="bi bi-check-lg me-2"></i>Simpan Tentang Karimunjawa
                    </button>
                </form>
            </div>

            <!-- INFORMASI PENTING -->
            <div class="tab-pane fade" id="info" role="tabpanel">
                <form action="<?= base_url('settings/save-homepage') ?>" method="POST">
                    <input type="hidden" name="section" value="info">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="setting-card">
                                <div class="setting-card-header" style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
                                    <h6 class="mb-0"><i class="bi bi-ship me-2"></i>Akses Kapal</h6>
                                </div>
                                <div class="setting-card-body">
                                    <textarea class="form-control" name="info_kapal" rows="4"><?= esc($settings['info_kapal'] ?? 'Kapal Express Bahari dari Jepara (2 jam) atau KMC Kartini dari Semarang (5 jam). Jadwal tergantung cuaca.') ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="setting-card">
                                <div class="setting-card-header" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);">
                                    <h6 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Waktu Terbaik</h6>
                                </div>
                                <div class="setting-card-body">
                                    <textarea class="form-control" name="info_waktu" rows="4"><?= esc($settings['info_waktu'] ?? 'Musim kunjungan terbaik April-Oktober (musim kemarau). Hindari Desember-Februari karena gelombang tinggi.') ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="setting-card">
                                <div class="setting-card-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                                    <h6 class="mb-0"><i class="bi bi-cash-stack me-2"></i>Biaya Masuk</h6>
                                </div>
                                <div class="setting-card-body">
                                    <textarea class="form-control" name="info_biaya" rows="4"><?= esc($settings['info_biaya'] ?? 'Tiket masuk Taman Nasional: Rp 175.000/orang (weekday), Rp 200.000/orang (weekend). Sudah termasuk asuransi.') ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-save btn-lg text-white mt-3">
                        <i class="bi bi-check-lg me-2"></i>Simpan Informasi Penting
                    </button>
                </form>
            </div>

            <!-- PROMO CARDS -->
            <div class="tab-pane fade" id="promo" role="tabpanel">
                <form action="<?= base_url('settings/save-homepage') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="section" value="promo">
                    
                    <div class="row">
                        <?php for($i = 1; $i <= 3; $i++): ?>
                        <div class="col-md-4">
                            <div class="setting-card">
                                <div class="setting-card-header" style="background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);">
                                    <h6 class="mb-0"><i class="bi bi-tag me-2"></i>Promo Card <?= $i ?></h6>
                                </div>
                                <div class="setting-card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Gambar Promo</label>
                                        <input type="url" class="form-control" name="promo_<?= $i ?>_image" value="<?= esc($settings["promo_{$i}_image"] ?? '') ?>" placeholder="URL gambar">
                                        <input type="file" class="form-control mt-2" name="promo_<?= $i ?>_image_file" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Badge Text</label>
                                        <input type="text" class="form-control" name="promo_<?= $i ?>_badge" value="<?= esc($settings["promo_{$i}_badge"] ?? 'DISKON 20%') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Judul</label>
                                        <input type="text" class="form-control" name="promo_<?= $i ?>_title" value="<?= esc($settings["promo_{$i}_title"] ?? 'Paket Wisata') ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea class="form-control" name="promo_<?= $i ?>_desc" rows="2"><?= esc($settings["promo_{$i}_desc"] ?? '') ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label">Harga Asli</label>
                                            <input type="number" class="form-control" name="promo_<?= $i ?>_price_old" value="<?= esc($settings["promo_{$i}_price_old"] ?? '') ?>">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Harga Promo</label>
                                            <input type="number" class="form-control" name="promo_<?= $i ?>_price_new" value="<?= esc($settings["promo_{$i}_price_new"] ?? '') ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>
                    
                    <button type="submit" class="btn btn-save btn-lg text-white mt-3">
                        <i class="bi bi-check-lg me-2"></i>Simpan Promo Cards
                    </button>
                </form>
            </div>

            <!-- FLYER PROMO -->
            <div class="tab-pane fade" id="flyer" role="tabpanel">
                <form action="<?= base_url('settings/save-homepage') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="section" value="flyer">
                    
                    <div class="setting-card">
                        <div class="setting-card-header" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                            <h6 class="mb-0"><i class="bi bi-images me-2"></i>Flyer Promo (Slider)</h6>
                        </div>
                        <div class="setting-card-body">
                            <p class="text-muted mb-4">Upload flyer promo yang akan ditampilkan sebagai slider horizontal. Gunakan gambar dengan rasio landscape (1:1 atau 16:9).</p>
                            
                            <div class="row">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                <div class="col-md-4 mb-3">
                                    <div class="border rounded-3 p-3">
                                        <label class="form-label fw-bold">Flyer <?= $i ?></label>
                                        <?php if(!empty($settings["flyer_{$i}"])): ?>
                                        <img src="<?= esc($settings["flyer_{$i}"]) ?>" class="preview-image mb-2">
                                        <?php endif; ?>
                                        <input type="url" class="form-control mb-2" name="flyer_<?= $i ?>" value="<?= esc($settings["flyer_{$i}"] ?? '') ?>" placeholder="URL gambar">
                                        <input type="file" class="form-control" name="flyer_<?= $i ?>_file" accept="image/*">
                                    </div>
                                </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-save btn-lg text-white">
                        <i class="bi bi-check-lg me-2"></i>Simpan Flyer Promo
                    </button>
                </form>
            </div>

            <!-- GALLERY -->
            <div class="tab-pane fade" id="gallery" role="tabpanel">
                <form action="<?= base_url('settings/save-homepage') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="section" value="gallery">
                    
                    <div class="setting-card">
                        <div class="setting-card-header" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);">
                            <h6 class="mb-0"><i class="bi bi-camera me-2"></i>Gallery Karimunjawa (8 Foto)</h6>
                        </div>
                        <div class="setting-card-body">
                            <p class="text-muted mb-4">Upload foto-foto Karimunjawa untuk ditampilkan di gallery. Gunakan gambar dengan rasio 1:1 (square) untuk hasil terbaik.</p>
                            
                            <div class="row">
                                <?php for($i = 1; $i <= 8; $i++): ?>
                                <div class="col-md-3 mb-3">
                                    <div class="border rounded-3 p-3">
                                        <label class="form-label fw-bold small">Foto <?= $i ?></label>
                                        <?php if(!empty($settings["gallery_{$i}"])): ?>
                                        <img src="<?= esc($settings["gallery_{$i}"]) ?>" class="preview-image mb-2" style="aspect-ratio: 1; object-fit: cover;">
                                        <?php endif; ?>
                                        <input type="url" class="form-control form-control-sm mb-2" name="gallery_<?= $i ?>" value="<?= esc($settings["gallery_{$i}"] ?? '') ?>" placeholder="URL gambar">
                                        <input type="file" class="form-control form-control-sm" name="gallery_<?= $i ?>_file" accept="image/*">
                                    </div>
                                </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-save btn-lg text-white">
                        <i class="bi bi-check-lg me-2"></i>Simpan Gallery
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</body>
</html>
