<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Website - Dinara Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.3);
            --shadow-soft: 0 8px 32px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 16px 48px rgba(0, 0, 0, 0.12);
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* SIDEBAR MODERN 2027 */
        .sidebar { 
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: var(--primary-gradient);
            padding: 30px 0;
            box-shadow: 4px 0 24px rgba(0,0,0,0.1);
            z-index: 1000;
            overflow-y: auto;
        }
        
        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.3); border-radius: 10px; }
        
        .sidebar-brand { 
            text-align: center;
            padding: 0 20px 40px;
            color: white;
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-decoration: none;
            display: block;
        }
        
        .sidebar-brand i { 
            font-size: 2.5rem;
            display: block;
            margin-bottom: 10px;
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .nav-sidebar { padding: 0 15px; }
        
        .nav-sidebar .nav-link {
            color: rgba(255,255,255,0.85);
            padding: 15px 20px;
            margin-bottom: 8px;
            border-radius: 16px;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .nav-sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: white;
            transform: translateX(-4px);
            transition: transform 0.3s ease;
        }
        
        .nav-sidebar .nav-link:hover {
            background: rgba(255,255,255,0.15);
            color: white;
            transform: translateX(5px);
        }
        
        .nav-sidebar .nav-link.active {
            background: rgba(255,255,255,0.25);
            color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .nav-sidebar .nav-link.active::before {
            transform: translateX(0);
        }
        
        .nav-sidebar .nav-link i { font-size: 1.2rem; }
        
        /* MAIN CONTENT */
        .main-content { 
            margin-left: 280px;
            padding: 40px;
            min-height: 100vh;
        }
        
        /* HEADER */
        .page-header {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 30px 40px;
            box-shadow: var(--shadow-soft);
            margin-bottom: 30px;
            border: 1px solid var(--glass-border);
        }
        
        .page-header h1 {
            font-size: 2rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 5px;
        }
        
        .page-header p {
            color: #6c757d;
            margin: 0;
            font-size: 0.95rem;
        }
        
        /* MODERN TABS */
        .modern-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .modern-tab {
            padding: 12px 24px;
            border-radius: 16px;
            background: white;
            border: 2px solid transparent;
            color: #6c757d;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .modern-tab:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.1);
            border-color: #667eea;
            color: #667eea;
        }
        
        .modern-tab.active {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
            transform: translateY(-2px);
        }
        
        /* GLASS CARD */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 30px;
            box-shadow: var(--shadow-soft);
            border: 1px solid var(--glass-border);
            transition: all 0.4s ease;
            height: 100%;
        }
        
        .glass-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-4px);
        }
        
        .glass-card-header {
            padding: 20px;
            margin: -30px -30px 25px -30px;
            border-radius: 24px 24px 0 0;
            background: var(--primary-gradient);
            color: white;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .glass-card-header i { font-size: 1.5rem; }
        .glass-card-header h6 { margin: 0; font-weight: 700; font-size: 1.05rem; }
        
        /* COMPACT CARD STYLE */
        .glass-card.compact {
            padding: 20px;
            margin-bottom: 0;
        }
        
        .glass-card.compact .image-preview-container {
            height: 160px;
            margin-bottom: 10px;
            border-radius: 12px;
        }
        
        .glass-card.compact small {
            font-size: 0.75rem;
        }
        
        /* FORM ELEMENTS */
        .form-label-modern {
            font-weight: 600;
            color: #495057;
            font-size: 0.85rem;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-control-modern,
        .form-select-modern {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: white;
        }
        
        .form-control-modern:focus,
        .form-select-modern:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
        }
        
        /* IMAGE PREVIEW */
        .image-preview-container {
            position: relative;
            width: 100%;
            height: 200px;
            border-radius: 16px;
            overflow: hidden;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border: 2px dashed #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 12px;
        }
        
        .image-preview-container:hover {
            border-color: #667eea;
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }
        
        .image-preview-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: white;
        }
        
        .image-preview-container img.error {
            display: none;
        }
        
        .image-preview-placeholder {
            text-align: center;
            color: #6c757d;
        }
        
        .image-preview-placeholder i {
            font-size: 3rem;
            margin-bottom: 10px;
            display: block;
            opacity: 0.5;
        }
        
        .image-upload-input {
            display: none;
        }
        
        /* BUTTON MODERN */
        .btn-modern {
            padding: 14px 32px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 0.95rem;
            border: none;
            background: var(--primary-gradient);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-modern.btn-sm {
            padding: 10px 20px;
            font-size: 0.85rem;
            border-radius: 12px;
        }
        
        .btn-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.5);
        }
        
        .btn-modern:active {
            transform: translateY(-1px);
        }
        
        .btn-success-modern {
            background: var(--success-gradient);
            box-shadow: 0 4px 16px rgba(79, 172, 254, 0.3);
        }
        
        .btn-success-modern:hover {
            box-shadow: 0 8px 24px rgba(79, 172, 254, 0.5);
        }
        
        /* ALERT MODERN */
        .alert-modern {
            border-radius: 16px;
            padding: 20px 24px;
            border: none;
            box-shadow: var(--shadow-soft);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 15px;
            animation: slideInDown 0.4s ease;
        }
        
        @keyframes slideInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .alert-success-modern {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
        }
        
        .alert-error-modern {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
        }
        
        /* TAB CONTENT */
        .tab-content-modern {
            display: none;
            animation: fadeIn 0.4s ease;
        }
        
        .tab-content-modern.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* GRID LAYOUT */
        .settings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }

        /* COMPACT GRID LAYOUT FOR FOOTER */
        .settings-grid-compact {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        /* COMPACT GLASS CARD */
        .glass-card-compact {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            padding: 14px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .glass-card-compact:hover {
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .glass-card-header-compact {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 12px;
            color: white;
            font-weight: 600;
        }

        .glass-card-header-compact i {
            font-size: 1rem;
        }

        .glass-card-header-compact h6 {
            margin: 0;
            font-size: 0.9rem;
        }

        /* COMPACT FORM GROUP */
        .form-group-compact {
            margin-bottom: 10px;
        }

        .form-group-compact:last-child {
            margin-bottom: 0;
        }

        .form-label-compact {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-label-compact i {
            font-size: 0.85rem;
        }

        .form-control-compact {
            display: block;
            width: 100%;
            padding: 6px 8px;
            font-size: 0.85rem;
            line-height: 1.4;
            color: #1a1a2e;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d0d5dd;
            border-radius: 6px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-control-compact:focus {
            color: #1a1a2e;
            background-color: #fff;
            border-color: #0d6efd;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .form-control-compact::placeholder {
            color: #999;
            font-size: 0.8rem;
        }

        textarea.form-control-compact {
            resize: vertical;
            min-height: 50px;
        }
        
        /* INFO BOX */
        .info-box {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            border-radius: 16px;
            padding: 20px;
            border-left: 4px solid #0284c7;
            font-size: 0.9rem;
            color: #075985;
        }
        
        .info-box i {
            margin-right: 8px;
            font-size: 1.2rem;
        }
        
        /* LOADING OVERLAY */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
        
        .loading-overlay.active {
            display: flex;
        }
        
        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .main-content { margin-left: 0; padding: 20px; }
            .settings-grid { grid-template-columns: 1fr; }
            .page-header { padding: 20px; }
        }
    </style>
</head>
<body>
    <!-- LOADING OVERLAY -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <a href="#" class="sidebar-brand">
            <i class="bi bi-airplane-engines-fill"></i>
            DINARA ADMIN
        </a>
        
        <ul class="nav flex-column nav-sidebar">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin') ?>">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin') ?>">
                    <i class="bi bi-database-fill-gear"></i> Database Wisata
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active">
                    <i class="bi bi-palette2"></i> Settings Website
                </a>
            </li>
            <li class="nav-item" style="margin-top: 50px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.2);">
                <a class="nav-link" href="/" target="_blank">
                    <i class="bi bi-globe"></i> Lihat Website
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('settings/debug') ?>" target="_blank">
                    <i class="bi bi-bug"></i> Debug Settings
                </a>
            </li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1><i class="bi bi-palette2 me-3"></i>Settings Website</h1>
            <p>Kelola semua pengaturan website Anda dalam satu tempat yang mudah dan elegan</p>
        </div>

        <!-- ALERTS -->
        <?php if(session()->getFlashdata('success')): ?>
        <div class="alert-modern alert-success-modern">
            <i class="bi bi-check-circle-fill" style="font-size: 1.5rem;"></i>
            <div>
                <strong>Berhasil!</strong><br>
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('error')): ?>
        <div class="alert-modern alert-error-modern">
            <i class="bi bi-exclamation-triangle-fill" style="font-size: 1.5rem;"></i>
            <div>
                <strong>Error!</strong><br>
                <?= session()->getFlashdata('error') ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- MODERN TABS -->
        <div class="modern-tabs">
            <button class="modern-tab active" onclick="switchTab('general')">
                <i class="bi bi-gear-fill"></i> General
            </button>
            <button class="modern-tab" onclick="switchTab('images')">
                <i class="bi bi-images"></i> Gambar & Logo
            </button>
            <button class="modern-tab" onclick="switchTab('karimunjawa')">
                <i class="bi bi-geo-alt-fill"></i> Tentang Karimunjawa
            </button>
            <button class="modern-tab" onclick="switchTab('info')">
                <i class="bi bi-info-circle-fill"></i> Info Penting
            </button>
            <button class="modern-tab" onclick="switchTab('promo')">
                <i class="bi bi-tag-fill"></i> Promo & Flyer
            </button>
            <button class="modern-tab" onclick="switchTab('blog')">
                <i class="bi bi-newspaper"></i> Blog
            </button>
            <button class="modern-tab" onclick="switchTab('estimasi')">
                <i class="bi bi-calculator-fill"></i> Estimasi
            </button>
            <button class="modern-tab" onclick="switchTab('footer')">
                <i class="bi bi-houses-fill"></i> Footer
            </button>
            <button class="modern-tab" onclick="switchTab('support')">
                <i class="bi bi-chat-dots-fill"></i> Support Widget
            </button>
            <button class="modern-tab" onclick="switchTab('jadwal_kapal')">
                <i class="bi bi-calendar-event-fill"></i> Jadwal Kapal
            </button>
        </div>

        <!-- TAB: GENERAL -->
        <div id="tab-general" class="tab-content-modern active">
            <form action="<?= base_url('settings/save-unified') ?>" method="POST" enctype="multipart/form-data" onsubmit="showLoading()">
                <input type="hidden" name="section" value="general">
                
                <div class="settings-grid">
                    <div class="glass-card">
                        <div class="glass-card-header">
                            <i class="bi bi-building"></i>
                            <h6>Identitas Website</h6>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-modern"><i class="bi bi-cursor-text"></i> Nama Aplikasi</label>
                            <input type="text" class="form-control-modern" name="app_name" value="<?= esc($settings['app_name'] ?? 'Dinara Travel') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-modern"><i class="bi bi-stars"></i> Welcome Text</label>
                            <input type="text" class="form-control-modern" name="welcome_text" value="<?= esc($settings['welcome_text'] ?? 'Selamat Datang di Dinara Travel!') ?>">
                            <small class="text-muted">Tampil di header saat Home page</small>
                        </div>
                    </div>

                    <div class="glass-card">
                        <div class="glass-card-header">
                            <i class="bi bi-megaphone"></i>
                            <h6>Hero Section</h6>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-modern"><i class="bi bi-type-h1"></i> Hero Title</label>
                            <input type="text" class="form-control-modern" name="hero_title" value="<?= esc($settings['hero_title'] ?? 'Hai kamu, mau ke mana?') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-modern"><i class="bi bi-type-h2"></i> Hero Subtitle</label>
                            <input type="text" class="form-control-modern" name="hero_subtitle" value="<?= esc($settings['hero_subtitle'] ?? 'Dinara Travel - Satu aplikasi untuk kebutuhan liburanmu') ?>">
                        </div>
                    </div>

                    <div class="glass-card">
                        <div class="glass-card-header">
                            <i class="bi bi-megaphone-fill"></i>
                            <h6>Announcement</h6>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-modern"><i class="bi bi-chat-quote"></i> Running Text</label>
                            <textarea class="form-control-modern" name="announcement" rows="3"><?= esc($settings['announcement'] ?? 'Promo Lebaran! Diskon 20% untuk semua paket wisata.') ?></textarea>
                            <small class="text-muted">Teks berjalan di header navbar</small>
                        </div>
                    </div>

                    <div class="glass-card">
                        <div class="glass-card-header" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="bi bi-whatsapp"></i>
                            <h6>Kontak WhatsApp</h6>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-modern"><i class="bi bi-phone"></i> Nomor WhatsApp</label>
                            <input type="text" class="form-control-modern" name="whatsapp_number" value="<?= esc($settings['whatsapp_number'] ?? '6281234567890') ?>" placeholder="62812xxxxxxxx">
                            <small class="text-muted">Format: 62812xxxxxxxx (tanpa + atau spasi)</small>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-modern">
                    <i class="bi bi-check-circle-fill"></i> Simpan Pengaturan General
                </button>
            </form>
        </div>

        <!-- TAB: IMAGES -->
        <div id="tab-images" class="tab-content-modern">
            <div class="info-box mb-4">
                <i class="bi bi-info-circle-fill"></i>
                <strong>Tips:</strong> Klik pada area preview untuk mengganti gambar. Format yang disupport: JPG, PNG, WebP (Max 2MB)
            </div>

            <form action="<?= base_url('settings/save-unified') ?>" method="POST" enctype="multipart/form-data" onsubmit="showLoading()">
                <input type="hidden" name="section" value="images">
                
                <div class="settings-grid">
                    <div class="glass-card">
                        <div class="glass-card-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                            <i class="bi bi-image"></i>
                            <h6>Logo Website</h6>
                        </div>
                        <div class="image-preview-container" onclick="document.getElementById('logo_image').click()">
                            <?php if(!empty($settings['logo_image'])): ?>
                                <img src="<?= base_url('uploads/' . $settings['logo_image']) ?>" alt="Logo" id="preview-logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            <?php else: ?>
                                <div class="image-preview-placeholder">
                                    <i class="bi bi-cloud-upload"></i>
                                    <div>Klik untuk upload logo</div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <input type="file" id="logo_image" name="logo_image" class="image-upload-input" accept="image/*" onchange="previewImage(this, 'preview-logo')">
                        <small class="text-muted">Rekomendasi: 200x200px, PNG transparan</small>
                    </div>

                    <div class="glass-card">
                        <div class="glass-card-header" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                            <i class="bi bi-image-fill"></i>
                            <h6>Hero Background</h6>
                        </div>
                        <div class="image-preview-container" onclick="document.getElementById('hero_image').click()">
                            <?php if(!empty($settings['hero_image'])): ?>
                                <img src="<?= base_url('uploads/' . $settings['hero_image']) ?>" alt="Hero" id="preview-hero" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            <?php else: ?>
                                <div class="image-preview-placeholder">
                                    <i class="bi bi-cloud-upload"></i>
                                    <div>Klik untuk upload background hero</div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <input type="file" id="hero_image" name="hero_image" class="image-upload-input" accept="image/*" onchange="previewImage(this, 'preview-hero')">
                        <small class="text-muted">Rekomendasi: 1920x600px, landscape</small>
                    </div>
                </div>

                <button type="submit" class="btn-modern">
                    <i class="bi bi-check-circle-fill"></i> Simpan Gambar
                </button>
            </form>
        </div>

        <!-- TAB: KARIMUNJAWA -->
        <div id="tab-karimunjawa" class="tab-content-modern">
            <form action="<?= base_url('settings/save-unified') ?>" method="POST" enctype="multipart/form-data" onsubmit="showLoading()">
                <input type="hidden" name="section" value="karimunjawa">
                
                <div class="glass-card mb-4">
                    <div class="glass-card-header" style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
                        <i class="bi bi-geo-alt"></i>
                        <h6>Tentang Karimunjawa</h6>
                    </div>
                    <div class="mb-0">
                        <label class="form-label-modern"><i class="bi bi-text-paragraph"></i> Deskripsi Singkat</label>
                        <textarea class="form-control-modern" name="about_karimunjawa" rows="5" placeholder="Jelaskan tentang Karimunjawa..." style="width: 100%;"><?= esc($settings['about_karimunjawa'] ?? 'Karimunjawa adalah kepulauan yang terdiri dari 27 pulau di Laut Jawa, sekitar 80 km barat laut Jepara. Dikenal sebagai "surga tersembunyi", Karimunjawa menawarkan keindahan alam bawah laut yang luar biasa, pantai berpasir putih, dan hutan mangrove yang asri.') ?></textarea>
                    </div>
                </div>

                <h6 class="fw-bold mt-4 mb-3"><i class="bi bi-images me-2" style="color: #22c55e;"></i>Foto Karimunjawa (3 Foto)</h6>
                
                <div class="row g-2 mb-3">
                    <?php for($i = 1; $i <= 3; $i++): ?>
                    <div class="col-md-4">
                        <div class="glass-card compact">
                            <div class="image-preview-container" style="height: 160px; margin-bottom: 12px; border-radius: 12px;" onclick="document.getElementById('km_photo_<?= $i ?>').click()">
                                <?php if(!empty($settings["km_photo_{$i}"])): ?>
                                    <img src="<?= base_url('uploads/karimunjawa/' . $settings["km_photo_{$i}"]) ?>" alt="Karimunjawa <?= $i ?>" id="preview-km-<?= $i ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                <?php else: ?>
                                    <div class="image-preview-placeholder" style="font-size: 20px;">
                                        <i class="bi bi-cloud-upload"></i>
                                        <div style="font-size: 11px; margin-top: 6px;">Klik upload</div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <input type="file" id="km_photo_<?= $i ?>" name="km_photo_<?= $i ?>" class="image-upload-input" accept="image/*" onchange="previewImage(this, 'preview-km-<?= $i ?>')">
                            <small class="text-muted text-center d-block" style="font-size: 0.75rem;">Foto <?= $i ?> (800x600)</small>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>

                <button type="submit" class="btn-modern btn-sm">
                    <i class="bi bi-check-circle-fill"></i> Simpan Karimunjawa
                </button>
            </form>
        </div>

        <!-- TAB: INFO PENTING -->
        <div id="tab-info" class="tab-content-modern">
            <form action="<?= base_url('settings/save-unified') ?>" method="POST" enctype="multipart/form-data" onsubmit="showLoading()">
                <input type="hidden" name="section" value="info">
                
                <div class="settings-grid" style="grid-template-columns: 1fr;">
                    <div class="glass-card">
                        <div class="glass-card-header" style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
                            <i class="bi bi-ship"></i>
                            <h6>Akses Kapal</h6>
                        </div>
                        <textarea class="form-control-modern" name="info_kapal" rows="4" style="width: 100%;"><?= esc($settings['info_kapal'] ?? 'Kapal Express Bahari dari Jepara (2 jam) atau KMC Kartini dari Semarang (5 jam). Jadwal tergantung cuaca.') ?></textarea>
                    </div>

                    <div class="glass-card">
                        <div class="glass-card-header" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);">
                            <i class="bi bi-calendar-check"></i>
                            <h6>Waktu Terbaik</h6>
                        </div>
                        <textarea class="form-control-modern" name="info_waktu" rows="4" style="width: 100%;"><?= esc($settings['info_waktu'] ?? 'Musim kunjungan terbaik April-Oktober (musim kemarau). Hindari Desember-Februari karena gelombang tinggi.') ?></textarea>
                    </div>

                    <div class="glass-card">
                        <div class="glass-card-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <i class="bi bi-cash-stack"></i>
                            <h6>Biaya Masuk</h6>
                        </div>
                        <textarea class="form-control-modern" name="info_biaya" rows="4" style="width: 100%;"><?= esc($settings['info_biaya'] ?? 'Tiket masuk Taman Nasional: Rp 175.000/orang (weekday), Rp 200.000/orang (weekend). Sudah termasuk asuransi.') ?></textarea>
                    </div>
                </div>

                <button type="submit" class="btn-modern">
                    <i class="bi bi-check-circle-fill"></i> Simpan Info Penting
                </button>
            </form>
        </div>

        <!-- TAB: PROMO & FLYER -->
        <div id="tab-promo" class="tab-content-modern">
            <form action="<?= base_url('settings/save-unified') ?>" method="POST" enctype="multipart/form-data" onsubmit="showLoading()">
                <input type="hidden" name="section" value="promo">
                
                <h5 class="mb-4 fw-bold"><i class="bi bi-tag-fill me-2"></i>Promo Cards (3 Slot)</h5>
                <div class="settings-grid mb-5">
                    <?php for($i = 1; $i <= 3; $i++): ?>
                    <div class="glass-card">
                        <div class="glass-card-header" style="background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);">
                            <i class="bi bi-tag"></i>
                            <h6>Promo <?= $i ?></h6>
                        </div>
                        <div class="mb-2">
                            <label class="form-label-modern">Gambar</label>
                            <div class="image-preview-container" style="height: 150px;" onclick="document.getElementById('promo_<?= $i ?>_image').click()">
                                <?php if(!empty($settings["promo_{$i}_image"])): ?>
                                    <img src="<?= base_url('uploads/promo/' . $settings["promo_{$i}_image"]) ?>" alt="Promo <?= $i ?>" id="preview-promo-<?= $i ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                <?php else: ?>
                                    <div class="image-preview-placeholder">
                                        <i class="bi bi-cloud-upload"></i>
                                        <div>Upload</div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <input type="file" id="promo_<?= $i ?>_image" name="promo_<?= $i ?>_image" class="image-upload-input" accept="image/*" onchange="previewImage(this, 'preview-promo-<?= $i ?>')">
                        </div>
                        <div class="mb-2">
                            <label class="form-label-modern">Badge</label>
                            <input type="text" class="form-control-modern" name="promo_<?= $i ?>_badge" value="<?= esc($settings["promo_{$i}_badge"] ?? 'DISKON 20%') ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label-modern">Judul</label>
                            <input type="text" class="form-control-modern" name="promo_<?= $i ?>_title" value="<?= esc($settings["promo_{$i}_title"] ?? '') ?>">
                        </div>
                        <div class="mb-2">
                            <label class="form-label-modern">Deskripsi</label>
                            <textarea class="form-control-modern" name="promo_<?= $i ?>_desc" rows="2"><?= esc($settings["promo_{$i}_desc"] ?? '') ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label-modern">Harga Asli</label>
                                <input type="number" class="form-control-modern" name="promo_<?= $i ?>_price_old" value="<?= esc($settings["promo_{$i}_price_old"] ?? '') ?>">
                            </div>
                            <div class="col-6">
                                <label class="form-label-modern">Harga Promo</label>
                                <input type="number" class="form-control-modern" name="promo_<?= $i ?>_price_new" value="<?= esc($settings["promo_{$i}_price_new"] ?? '') ?>">
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>

                <h5 class="mb-4 fw-bold"><i class="bi bi-images me-2"></i>Flyer Promo (5 Slot)</h5>
                <div class="settings-grid mb-4">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                    <div class="glass-card">
                        <div class="glass-card-header" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                            <i class="bi bi-image"></i>
                            <h6>Flyer <?= $i ?></h6>
                        </div>
                        <div class="image-preview-container" style="height: 250px;" onclick="document.getElementById('flyer_<?= $i ?>').click()">
                            <?php if(!empty($settings["flyer_{$i}"])): ?>
                                <img src="<?= base_url('uploads/flyer/' . $settings["flyer_{$i}"]) ?>" alt="Flyer <?= $i ?>" id="preview-flyer-<?= $i ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            <?php else: ?>
                                <div class="image-preview-placeholder">
                                    <i class="bi bi-cloud-upload"></i>
                                    <div>Klik upload flyer</div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <input type="file" id="flyer_<?= $i ?>" name="flyer_<?= $i ?>" class="image-upload-input" accept="image/*" onchange="previewImage(this, 'preview-flyer-<?= $i ?>')">
                    </div>
                    <?php endfor; ?>
                </div>

                <h5 class="mb-4 fw-bold"><i class="bi bi-camera me-2"></i>Gallery Karimunjawa (8 Foto)</h5>
                <div class="settings-grid mb-4">
                    <?php for($i = 1; $i <= 8; $i++): ?>
                    <div class="glass-card">
                        <div class="glass-card-header" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);">
                            <i class="bi bi-camera"></i>
                            <h6>Foto <?= $i ?></h6>
                        </div>
                        <div class="image-preview-container" onclick="document.getElementById('gallery_<?= $i ?>').click()">
                            <?php if(!empty($settings["gallery_{$i}"])): ?>
                                <img src="<?= base_url('uploads/gallery/' . $settings["gallery_{$i}"]) ?>" alt="Gallery <?= $i ?>" id="preview-gallery-<?= $i ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            <?php else: ?>
                                <div class="image-preview-placeholder">
                                    <i class="bi bi-cloud-upload"></i>
                                    <div>Upload foto</div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <input type="file" id="gallery_<?= $i ?>" name="gallery_<?= $i ?>" class="image-upload-input" accept="image/*" onchange="previewImage(this, 'preview-gallery-<?= $i ?>')">
                    </div>
                    <?php endfor; ?>
                </div>

                <button type="submit" class="btn-modern">
                    <i class="bi bi-check-circle-fill"></i> Simpan Promo & Gallery
                </button>
            </form>
        </div>

        <!-- TAB: BLOG -->
        <div id="tab-blog" class="tab-content-modern">
            <div class="info-box mb-4">
                <i class="bi bi-info-circle-fill"></i>
                <strong>Blog Management:</strong> Kelola berita dan tips wisata Karimunjawa yang ditampilkan di website
            </div>

            <div class="mb-4">
                <button type="button" class="btn-modern" onclick="showBlogForm()" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);">
                    <i class="bi bi-plus-circle-fill"></i> Tambah Blog Post
                </button>
            </div>

            <!-- Blog Form (Hidden) -->
            <div id="blogFormContainer" class="glass-card mb-4" style="display: none;">
                <div class="glass-card-header" style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
                    <i class="bi bi-pencil-square"></i>
                    <h6>Tambah/Edit Blog Post</h6>
                </div>
                <form id="blogForm" enctype="multipart/form-data">
                    <input type="hidden" id="blogId" name="blog_id">
                    
                    <div class="mb-3">
                        <label class="form-label-modern">Judul Blog</label>
                        <input type="text" id="blogTitle" class="form-control-modern" placeholder="Masukkan judul blog" required style="width: 100%;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label-modern">Slug (URL)</label>
                        <input type="text" id="blogSlug" class="form-control-modern" placeholder="slug-otomatis" readonly style="width: 100%;">
                        <small class="text-muted">Diisi otomatis dari judul</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-modern">Kategori</label>
                        <select id="blogCategory" class="form-control-modern" style="width: 100%;">
                            <option value="wisata">Wisata</option>
                            <option value="tips">Tips & Panduan</option>
                            <option value="berita">Berita</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-modern">Gambar Utama</label>
                        <div class="image-preview-container" style="height: 200px; margin-bottom: 12px;" onclick="document.getElementById('blogImage').click()">
                            <div id="blogImagePreview" class="image-preview-placeholder">
                                <i class="bi bi-cloud-upload"></i>
                                <div>Klik untuk upload</div>
                            </div>
                        </div>
                        <input type="file" id="blogImage" class="image-upload-input" accept="image/*" onchange="previewBlogImage(this)">
                    </div>

                    <div class="mb-3">
                        <label class="form-label-modern">Ringkasan (Excerpt)</label>
                        <textarea id="blogExcerpt" class="form-control-modern" rows="3" placeholder="Ringkasan singkat blog post" style="width: 100%;"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-modern">Konten Lengkap</label>
                        <textarea id="blogContent" class="form-control-modern" rows="6" placeholder="Konten lengkap blog post" style="width: 100%;"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-modern">Status</label>
                        <select id="blogStatus" class="form-control-modern" style="width: 100%;">
                            <option value="published">Publish</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="button" class="btn-modern" onclick="saveBlogPost()" style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
                            <i class="bi bi-check-circle-fill"></i> Simpan Blog Post
                        </button>
                        <button type="button" class="btn-modern" onclick="cancelBlogForm()" style="background: #64748b;">
                            <i class="bi bi-x-circle-fill"></i> Batal
                        </button>
                    </div>
                </form>
            </div>

            <!-- Blog Posts List -->
            <div class="glass-card">
                <div class="glass-card-header" style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
                    <i class="bi bi-newspaper"></i>
                    <h6>Daftar Blog Posts</h6>
                </div>
                <div id="blogPostsList">
                    <p class="text-muted text-center py-4">Memuat blog posts...</p>
                </div>
            </div>

            <style>
                #blogPostsList {
                    max-height: 600px;
                    overflow-y: auto;
                }

                .blog-post-item {
                    padding: 16px;
                    border-bottom: 1px solid #e9ecef;
                    transition: all 0.3s ease;
                }

                .blog-post-item:hover {
                    background: #f8f9fa;
                }

                .blog-post-item:last-child {
                    border-bottom: none;
                }

                .blog-post-title {
                    font-weight: 600;
                    color: #1e293b;
                    margin-bottom: 6px;
                }

                .blog-post-meta {
                    font-size: 0.85rem;
                    color: #64748b;
                    margin-bottom: 10px;
                }

                .blog-post-actions {
                    display: flex;
                    gap: 8px;
                }

                .blog-post-actions button {
                    padding: 4px 12px;
                    font-size: 0.85rem;
                    border-radius: 6px;
                    border: none;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }

                .btn-edit-blog {
                    background: #0ea5e9;
                    color: white;
                }

                .btn-edit-blog:hover {
                    background: #0284c7;
                }

                .btn-delete-blog {
                    background: #ef4444;
                    color: white;
                }

                .btn-delete-blog:hover {
                    background: #dc2626;
                }
            </style>
        </div>

        <!-- TAB: ESTIMASI -->
        <div id="tab-estimasi" class="tab-content-modern">
            <div class="info-box mb-4">
                <i class="bi bi-info-circle-fill"></i>
                <strong>Info:</strong> Deskripsi ini akan muncul sebagai tooltip di halaman estimasi biaya
            </div>

            <form action="<?= base_url('settings/save-unified') ?>" method="POST" enctype="multipart/form-data" onsubmit="showLoading()">
                <input type="hidden" name="section" value="estimasi">
                
                <div class="settings-grid">
                    <?php 
                    $estimasiItems = [
                        ['key' => 'transport_land', 'title' => 'Transportasi Darat', 'icon' => 'truck', 'color' => '#0ea5e9'],
                        ['key' => 'transport_sea', 'title' => 'Transportasi Laut', 'icon' => 'water', 'color' => '#06b6d4'],
                        ['key' => 'hotel', 'title' => 'Penginapan', 'icon' => 'building', 'color' => '#8b5cf6'],
                        ['key' => 'wisata_laut', 'title' => 'Wisata Laut', 'icon' => 'wave', 'color' => '#0284c7'],
                        ['key' => 'wisata_darat', 'title' => 'Wisata Darat', 'icon' => 'tree', 'color' => '#059669'],
                        ['key' => 'guide', 'title' => 'Guide Lokal', 'icon' => 'person-badge', 'color' => '#f59e0b'],
                        ['key' => 'transport', 'title' => 'Transport Lokal', 'icon' => 'scooter', 'color' => '#6366f1'],
                        ['key' => 'food', 'title' => 'Konsumsi', 'icon' => 'cup-hot', 'color' => '#ef4444'],
                    ];
                    
                    foreach($estimasiItems as $item): 
                    ?>
                    <div class="glass-card">
                        <div class="glass-card-header" style="background: <?= $item['color'] ?>;">
                            <i class="bi bi-<?= $item['icon'] ?>"></i>
                            <h6><?= $item['title'] ?></h6>
                        </div>
                        <textarea class="form-control-modern" name="est_<?= $item['key'] ?>" rows="3" placeholder="Deskripsi untuk <?= $item['title'] ?>"><?= esc($settings["est_{$item['key']}"] ?? '') ?></textarea>
                    </div>
                    <?php endforeach; ?>
                </div>

                <button type="submit" class="btn-modern">
                    <i class="bi bi-check-circle-fill"></i> Simpan Estimasi
                </button>
            </form>
        </div>

        <!-- TAB: FOOTER -->
        <div id="tab-footer" class="tab-content-modern">
            <div class="info-box mb-4">
                <i class="bi bi-info-circle-fill"></i>
                <strong>Info:</strong> Atur semua pengaturan footer website Anda di sini. Footer akan ditampilkan di semua halaman website.
            </div>

            <form action="<?= base_url('settings/save-unified') ?>" method="POST" enctype="multipart/form-data" onsubmit="showLoading()">
                <input type="hidden" name="section" value="footer">
                
                <div class="settings-grid-compact">
                    <!-- Logo Section -->
                    <div class="glass-card-compact">
                        <div class="glass-card-header-compact" style="background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);">
                            <i class="bi bi-image"></i>
                            <h6>Logo Footer</h6>
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-image"></i> Logo</label>
                            <div style="margin-bottom: 8px;">
                                <?php if(!empty($settings['footer_logo'])): ?>
                                <div style="padding: 8px; background: rgba(255,255,255,0.5); border-radius: 6px; margin-bottom: 8px;">
                                    <img src="<?= base_url('uploads/' . $settings['footer_logo']) ?>" alt="Footer Logo" style="max-width: 100%; max-height: 60px; object-fit: contain;">
                                </div>
                                <?php endif; ?>
                            </div>
                            <input type="file" class="form-control-compact" name="footer_logo" accept="image/*" id="footer-logo-input">
                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Format: JPG, PNG, GIF. Ukuran max: 1MB. Rekomendasi: 200x60px</small>
                        </div>
                    </div>

                    <!-- About Section -->
                    <div class="glass-card-compact">
                        <div class="glass-card-header-compact" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <i class="bi bi-info-circle"></i>
                            <h6>Tentang Perusahaan</h6>
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-cursor-text"></i> Deskripsi</label>
                            <textarea class="form-control-compact" name="footer_description" rows="2" placeholder="Deskripsi singkat perusahaan"><?= esc($settings['footer_description'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="glass-card-compact">
                        <div class="glass-card-header-compact" style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
                            <i class="bi bi-telephone"></i>
                            <h6>Kontak</h6>
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-geo-alt"></i> Alamat</label>
                            <textarea class="form-control-compact" name="footer_address" rows="2" placeholder="Alamat kantor"><?= esc($settings['footer_address'] ?? '') ?></textarea>
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-telephone-fill"></i> Telepon</label>
                            <input type="text" class="form-control-compact" name="footer_phone" value="<?= esc($settings['footer_phone'] ?? '') ?>" placeholder="+62...">
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-envelope"></i> Email</label>
                            <input type="email" class="form-control-compact" name="footer_email" value="<?= esc($settings['footer_email'] ?? '') ?>" placeholder="email@example.com">
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-person"></i> Contact Person</label>
                            <input type="text" class="form-control-compact" name="footer_contact_person" value="<?= esc($settings['footer_contact_person'] ?? '') ?>" placeholder="Nama">
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="glass-card-compact">
                        <div class="glass-card-header-compact" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                            <i class="bi bi-share"></i>
                            <h6>Media Sosial</h6>
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-facebook"></i> Facebook</label>
                            <input type="url" class="form-control-compact" name="footer_facebook" value="<?= esc($settings['footer_facebook'] ?? '') ?>" placeholder="https://facebook.com/...">
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-instagram"></i> Instagram</label>
                            <input type="url" class="form-control-compact" name="footer_instagram" value="<?= esc($settings['footer_instagram'] ?? '') ?>" placeholder="https://instagram.com/...">
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-tiktok"></i> TikTok</label>
                            <input type="url" class="form-control-compact" name="footer_tiktok" value="<?= esc($settings['footer_tiktok'] ?? '') ?>" placeholder="https://tiktok.com/@...">
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-youtube"></i> YouTube</label>
                            <input type="url" class="form-control-compact" name="footer_youtube" value="<?= esc($settings['footer_youtube'] ?? '') ?>" placeholder="https://youtube.com/@...">
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-whatsapp"></i> WhatsApp</label>
                            <input type="url" class="form-control-compact" name="footer_whatsapp" value="<?= esc($settings['footer_whatsapp'] ?? '') ?>" placeholder="https://wa.me/62...">
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="glass-card-compact">
                        <div class="glass-card-header-compact" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="bi bi-link-45deg"></i>
                            <h6>Links</h6>
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact">Link 1</label>
                            <input type="url" class="form-control-compact" name="footer_link1" value="<?= esc($settings['footer_link1'] ?? '') ?>" placeholder="https://example.com">
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact">Link 2</label>
                            <input type="url" class="form-control-compact" name="footer_link2" value="<?= esc($settings['footer_link2'] ?? '') ?>" placeholder="https://example.com">
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact">Link 3</label>
                            <input type="url" class="form-control-compact" name="footer_link3" value="<?= esc($settings['footer_link3'] ?? '') ?>" placeholder="https://example.com">
                        </div>
                    </div>

                    <!-- Link Jadwal Kapal -->
                    <div class="glass-card-compact">
                        <div class="glass-card-header-compact" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                            <i class="bi bi-water"></i>
                            <h6>Jadwal Kapal</h6>
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-link-45deg"></i> URL Jadwal Kapal</label>
                            <input type="url" class="form-control-compact" name="jadwal_kapal_url" value="<?= esc($settings['jadwal_kapal_url'] ?? '') ?>" placeholder="https://link-ke-jadwal-kapal.com">
                            <small class="text-muted">Link eksternal untuk melihat jadwal kapal (mis: Google Drive, website lain)</small>
                        </div>
                    </div>

                    <!-- Developer & Copyright -->
                    <div class="glass-card-compact">
                        <div class="glass-card-header-compact" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <i class="bi bi-code-square"></i>
                            <h6>Copyright</h6>
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-copyright"></i> Tahun</label>
                            <input type="text" class="form-control-compact" name="footer_copyright_year" value="<?= esc($settings['footer_copyright_year'] ?? date('Y')) ?>" placeholder="2024">
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-person-gear"></i> Developer</label>
                            <input type="text" class="form-control-compact" name="footer_developer_name" value="<?= esc($settings['footer_developer_name'] ?? '') ?>" placeholder="Developer">
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-link"></i> Dev Link</label>
                            <input type="url" class="form-control-compact" name="footer_developer_link" value="<?= esc($settings['footer_developer_link'] ?? '') ?>" placeholder="https://github.com">
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-sparkles"></i> Tagline</label>
                            <input type="text" class="form-control-compact" name="footer_developer_tagline" value="<?= esc($settings['footer_developer_tagline'] ?? '') ?>" placeholder="Tagline">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-modern">
                    <i class="bi bi-check-circle-fill"></i> Simpan
                </button>
            </form>
        </div>

        <!-- TAB: SUPPORT WIDGET -->
        <div id="tab-support" class="tab-content-modern">
            <div class="info-box mb-4">
                <i class="bi bi-info-circle-fill"></i>
                <strong>Info:</strong> Atur live chat support widget yang muncul di website Anda. Widget ini membantu customer menghubungi tim support.
            </div>

            <form action="<?= base_url('settings/save-unified') ?>" method="POST" enctype="multipart/form-data" onsubmit="showLoading()">
                <input type="hidden" name="section" value="support">
                
                <div class="settings-grid-compact">
                    <!-- Enable Widget -->
                    <div class="glass-card-compact">
                        <div class="glass-card-header-compact" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                            <i class="bi bi-toggles"></i>
                            <h6>Status Widget</h6>
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-check-circle"></i> Aktifkan Widget</label>
                            <div style="margin-top: 8px;">
                                <input type="checkbox" id="support_enabled" name="support_enabled" value="1" <?= !empty($settings['support_enabled']) ? 'checked' : '' ?> style="width: 18px; height: 18px; cursor: pointer;">
                                <label for="support_enabled" style="margin-left: 8px; cursor: pointer; font-size: 0.9rem;">Support widget aktif di website</label>
                            </div>
                        </div>
                    </div>

                    <!-- Banner Message -->
                    <div class="glass-card-compact">
                        <div class="glass-card-header-compact" style="background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);">
                            <i class="bi bi-megaphone"></i>
                            <h6>Pesan Banner</h6>
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-chat"></i> Judul</label>
                            <input type="text" class="form-control-compact" name="support_title" value="<?= esc($settings['support_title'] ?? 'Team Kami siap membantu Kamu kapan saja') ?>" placeholder="Judul banner">
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-emoji-smile"></i> Emoji</label>
                            <input type="text" class="form-control-compact" name="support_emoji" value="<?= esc($settings['support_emoji'] ?? '🔥') ?>" placeholder="🔥" maxlength="2" style="width: 60px;">
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-chat-dots"></i> Pesan Default</label>
                            <textarea class="form-control-compact" name="support_default_message" rows="2" placeholder="Pesan yang akan muncul"><?= esc($settings['support_default_message'] ?? 'Halo.. Apakah Kamu butuh bantuan?') ?></textarea>
                        </div>
                    </div>

                    <!-- WhatsApp Link -->
                    <div class="glass-card-compact">
                        <div class="glass-card-header-compact" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);">
                            <i class="bi bi-whatsapp"></i>
                            <h6>WhatsApp</h6>
                        </div>
                        <div class="form-group-compact">
                            <label class="form-label-compact"><i class="bi bi-telephone"></i> Nomor WhatsApp</label>
                            <input type="text" class="form-control-compact" name="support_whatsapp" value="<?= esc($settings['support_whatsapp'] ?? '') ?>" placeholder="6281234567890">
                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Format: 62 tanpa + atau 0</small>
                        </div>
                    </div>

                    <!-- Support Agents Section -->
                    <div class="glass-card-compact" style="grid-column: 1 / -1;">
                        <div class="glass-card-header-compact" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <i class="bi bi-people"></i>
                            <h6>Tim Support</h6>
                        </div>
                        <div id="support-agents-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 12px;">
                            <!-- Support agents will be loaded here -->
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-3" onclick="addSupportAgent()" style="margin-top: 12px; padding: 6px 12px; font-size: 0.85rem;">
                            <i class="bi bi-plus-circle"></i> Tambah Agent
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-modern">
                    <i class="bi bi-check-circle-fill"></i> Simpan
                </button>
            </form>
        </div>

        <!-- TAB: JADWAL KAPAL -->
        <div id="tab-jadwal_kapal" class="tab-content-modern">
            <div class="info-box mb-4">
                <i class="bi bi-info-circle-fill"></i>
                <strong>Info:</strong> Kelola jadwal keberangkatan kapal yang ditampilkan di website. Tambahkan, edit, atau hapus jadwal sesuai kebutuhan.
            </div>

            <!-- FORM INPUT JADWAL KAPAL -->
            <div class="glass-card mb-4">
                <div class="glass-card-header" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white;">
                    <h6><i class="bi bi-calendar-event me-2"></i>Tambah Jadwal Kapal Baru</h6>
                </div>
                <div class="glass-card-body">
                    <form action="<?= base_url('admin/simpan_jadwal_kapal') ?>" method="POST" id="formJadwalKapal">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Pelabuhan Asal</label>
                                <input type="text" class="form-control" name="pelabuhan_asal" placeholder="Contoh: Pelabuhan Jepara" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Kapal</label>
                                <input type="text" class="form-control" name="nama_kapal" placeholder="Contoh: Express Bahari" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jam Keberangkatan</label>
                                <input type="time" class="form-control" name="jam_berangkat" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Waktu Tempuh</label>
                                <input type="text" class="form-control" name="waktu_tempuh" placeholder="Contoh: 2-2,5 jam" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Harga Tiket (Rp)</label>
                                <input type="number" class="form-control" name="harga_tiket" placeholder="Contoh: 150000" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tipe Kapal</label>
                                <select class="form-control" name="tipe_kapal" required>
                                    <option value="">-- Pilih Tipe --</option>
                                    <option value="Express/Cepat">Express/Cepat (AC)</option>
                                    <option value="Ferry/Feri">Ferry/Feri (Standar)</option>
                                    <option value="PELNI">PELNI (Penyeberangan)</option>
                                    <option value="Pesawat Perintis">Pesawat Perintis</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Keterangan Tambahan</label>
                                <textarea class="form-control" name="keterangan" rows="2" placeholder="Contoh: AC, bisa bawa kendaraan, jadwal tetap, dll"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn-modern" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="bi bi-plus-lg me-2"></i>Tambah Jadwal Kapal
                        </button>
                    </form>
                </div>
            </div>

            <!-- DAFTAR JADWAL KAPAL -->
            <div class="glass-card">
                <div class="glass-card-header" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: white;">
                    <h6><i class="bi bi-list-ul me-2"></i>Jadwal Kapal yang Tersedia</h6>
                </div>
                <div class="glass-card-body">
                    <div class="table-responsive">
                        <table class="table table-hover border">
                            <thead class="table-light">
                                <tr>
                                    <th width="15%">Asal</th>
                                    <th width="15%">Nama Kapal</th>
                                    <th width="10%">Jam</th>
                                    <th width="12%">Waktu Tempuh</th>
                                    <th width="12%">Harga</th>
                                    <th width="15%">Tipe</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $db = \Config\Database::connect();
                                    if ($db->tableExists('jadwal_kapal')) {
                                        $jadwals = $db->table('jadwal_kapal')->orderBy('jam_berangkat', 'ASC')->get()->getResultArray();
                                        if (!empty($jadwals)) {
                                            foreach($jadwals as $jadwal):
                                ?>
                                <tr>
                                    <td><?= esc($jadwal['pelabuhan_asal']) ?></td>
                                    <td><?= esc($jadwal['nama_kapal']) ?></td>
                                    <td><?= esc($jadwal['jam_berangkat']) ?></td>
                                    <td><?= esc($jadwal['waktu_tempuh']) ?></td>
                                    <td><strong>Rp <?= number_format($jadwal['harga_tiket'], 0, ',', '.') ?></strong></td>
                                    <td><span class="badge bg-info"><?= esc($jadwal['tipe_kapal']) ?></span></td>
                                    <td>
                                        <a href="<?= base_url('admin/delete_jadwal_kapal/' . $jadwal['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                            endforeach;
                                        } else {
                                ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox"></i> Belum ada jadwal kapal. Silakan tambahkan di atas.
                                    </td>
                                </tr>
                                <?php 
                                        }
                                    } else {
                                ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox"></i> Belum ada data jadwal kapal.
                                    </td>
                                </tr>
                                <?php 
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <script>
        // Tab Switching
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content-modern').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Remove active from all buttons
            document.querySelectorAll('.modern-tab').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected tab
            document.getElementById('tab-' + tabName).classList.add('active');
            
            // Add active to clicked button
            event.target.closest('.modern-tab').classList.add('active');
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        
        // Image Preview
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File terlalu besar! Max 2MB');
                    return;
                }
                
                // Validate file type
                if (!file.type.match('image.*')) {
                    alert('File harus berupa gambar (JPG, PNG, WebP)');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewElement = document.getElementById(previewId);
                    if (previewElement) {
                        previewElement.src = e.target.result;
                        previewElement.style.display = 'block';
                        previewElement.style.maxWidth = '100%';
                        previewElement.style.maxHeight = '100%';
                        previewElement.style.objectFit = 'contain';
                    }
                };
                reader.readAsDataURL(file);
            }
        }
        
        // Loading Overlay
        function showLoading() {
            document.getElementById('loadingOverlay').classList.add('active');
        }
        
        // Auto hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert-modern');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.animation = 'slideOutUp 0.4s ease';
                    setTimeout(() => alert.remove(), 400);
                }, 5000);
            });
            
            // Load blog posts on page load
            loadBlogPosts();
            
            // Generate slug when title changes
            document.getElementById('blogTitle').addEventListener('input', function() {
                const slug = this.value.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                document.getElementById('blogSlug').value = slug;
            });
        });

        // ==================== BLOG FUNCTIONS ====================
        
        function showBlogForm() {
            document.getElementById('blogFormContainer').style.display = 'block';
            document.getElementById('blogForm').reset();
            document.getElementById('blogId').value = '';
            document.getElementById('blogImagePreview').innerHTML = '<i class="bi bi-cloud-upload"></i><div>Klik untuk upload</div>';
            document.querySelector('#blogFormContainer .glass-card-header h6').textContent = 'Tambah Blog Post Baru';
            window.scrollTo({ top: document.getElementById('blogFormContainer').offsetTop, behavior: 'smooth' });
        }

        function cancelBlogForm() {
            document.getElementById('blogFormContainer').style.display = 'none';
            document.getElementById('blogForm').reset();
        }

        function previewBlogImage(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                if (file.size > 2 * 1024 * 1024) {
                    alert('File terlalu besar! Max 2MB');
                    return;
                }
                
                if (!file.type.match('image.*')) {
                    alert('File harus berupa gambar (JPG, PNG, WebP)');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('blogImagePreview');
                    preview.innerHTML = '<img src="' + e.target.result + '" style="width: 100%; height: 100%; object-fit: cover;">';
                };
                reader.readAsDataURL(file);
            }
        }

        async function saveBlogPost() {
            const blogId = document.getElementById('blogId').value;
            const formData = new FormData();
            
            formData.append('title', document.getElementById('blogTitle').value);
            formData.append('slug', document.getElementById('blogSlug').value);
            formData.append('category', document.getElementById('blogCategory').value);
            formData.append('excerpt', document.getElementById('blogExcerpt').value);
            formData.append('content', document.getElementById('blogContent').value);
            formData.append('status', document.getElementById('blogStatus').value);
            
            const imageFile = document.getElementById('blogImage').files[0];
            if (imageFile) {
                formData.append('featured_image', imageFile);
            }

            try {
                let url = '/blog';
                let method = 'POST';
                
                if (blogId) {
                    url = `/blog/${blogId}`;
                    method = 'POST';
                }

                const response = await fetch(url, {
                    method: method,
                    body: formData
                });

                if (response.ok) {
                    alert('Blog post berhasil disimpan!');
                    cancelBlogForm();
                    loadBlogPosts();
                } else {
                    alert('Gagal menyimpan blog post');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            }
        }

        async function loadBlogPosts() {
            try {
                const response = await fetch('/blog/all');
                const posts = await response.json();
                
                const container = document.getElementById('blogPostsList');
                
                if (!posts || posts.length === 0) {
                    container.innerHTML = '<p class="text-muted text-center py-4">Belum ada blog posts</p>';
                    return;
                }

                let html = '';
                posts.forEach(post => {
                    const date = new Date(post.created_at).toLocaleDateString('id-ID', { 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    });
                    
                    html += `
                        <div class="blog-post-item">
                            <div class="blog-post-title">${escapeHtml(post.title)}</div>
                            <div class="blog-post-meta">
                                <span class="badge" style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); color: white;">
                                    ${post.category}
                                </span>
                                <span class="ms-2">📅 ${date}</span>
                                <span class="ms-2">👁️ ${post.views} views</span>
                                <span class="badge ${post.status === 'published' ? 'bg-success' : 'bg-warning'} ms-2">
                                    ${post.status === 'published' ? 'Published' : 'Draft'}
                                </span>
                            </div>
                            <div class="blog-post-actions">
                                <button class="btn-edit-blog" onclick="editBlogPost(${post.id})">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                                <button class="btn-delete-blog" onclick="deleteBlogPost(${post.id})">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    `;
                });
                
                container.innerHTML = html;
            } catch (error) {
                console.error('Error loading blog posts:', error);
                document.getElementById('blogPostsList').innerHTML = '<p class="text-danger text-center py-4">Gagal memuat blog posts</p>';
            }
        }

        async function editBlogPost(id) {
            try {
                const response = await fetch(`/blog/${id}`);
                const post = await response.json();
                
                document.getElementById('blogId').value = post.id;
                document.getElementById('blogTitle').value = post.title;
                document.getElementById('blogSlug').value = post.slug;
                document.getElementById('blogCategory').value = post.category;
                document.getElementById('blogExcerpt').value = post.excerpt || '';
                document.getElementById('blogContent').value = post.content || '';
                document.getElementById('blogStatus').value = post.status;
                
                if (post.featured_image) {
                    const preview = document.getElementById('blogImagePreview');
                    preview.innerHTML = `<img src="/uploads/blog/${post.featured_image}" style="width: 100%; height: 100%; object-fit: cover;">`;
                }
                
                document.querySelector('#blogFormContainer .glass-card-header h6').textContent = 'Edit Blog Post';
                document.getElementById('blogFormContainer').style.display = 'block';
                window.scrollTo({ top: document.getElementById('blogFormContainer').offsetTop, behavior: 'smooth' });
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal memuat data blog post');
            }
        }

        async function deleteBlogPost(id) {
            if (confirm('Yakin ingin menghapus blog post ini?')) {
                try {
                    const response = await fetch(`/blog/${id}`, { method: 'DELETE' });
                    
                    if (response.ok) {
                        alert('Blog post berhasil dihapus!');
                        loadBlogPosts();
                    } else {
                        alert('Gagal menghapus blog post');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan');
                }
            }
        }

        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        // Support Agent Functions
        let agentCount = 0;

        function addSupportAgent() {
            agentCount++;
            const agentId = 'agent_' + agentCount;
            const container = document.getElementById('support-agents-container');
            
            const agentHTML = `
                <div class="agent-card" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 10px; padding: 12px; position: relative;">
                    <button type="button" onclick="removeSupportAgent('${agentId}')" class="btn-close-agent" style="position: absolute; top: 8px; right: 8px; background: rgba(255,0,0,0.2); border: none; color: #dc2626; width: 24px; height: 24px; padding: 0; border-radius: 50%; cursor: pointer; font-size: 14px; line-height: 1;">×</button>
                    
                    <div class="form-group-compact" style="margin-bottom: 8px;">
                        <label class="form-label-compact"><i class="bi bi-person"></i> Nama</label>
                        <input type="text" class="form-control-compact agent-name" placeholder="Nama agent" style="font-size: 0.85rem; padding: 5px 8px;">
                    </div>
                    
                    <div class="form-group-compact" style="margin-bottom: 8px;">
                        <label class="form-label-compact"><i class="bi bi-image"></i> Avatar (URL)</label>
                        <input type="text" class="form-control-compact agent-avatar" placeholder="Link foto avatar" style="font-size: 0.85rem; padding: 5px 8px;">
                    </div>
                    
                    <div class="form-group-compact" style="margin-bottom: 8px;">
                        <label class="form-label-compact"><i class="bi bi-circle-fill"></i> Status</label>
                        <select class="form-control-compact agent-status" style="font-size: 0.85rem; padding: 5px 8px;">
                            <option value="Available">Available</option>
                            <option value="Busy">Busy</option>
                            <option value="Offline">Offline</option>
                        </select>
                    </div>
                    
                    <div class="form-group-compact">
                        <label class="form-label-compact"><i class="bi bi-chat"></i> Pesan</label>
                        <textarea class="form-control-compact agent-message" rows="2" placeholder="Pesan sapaan" style="font-size: 0.85rem; padding: 5px 8px;"></textarea>
                    </div>
                    
                    <!-- Hidden input untuk data -->
                    <input type="hidden" class="agent-data" name="support_agents[]">
                </div>
            `;
            
            container.innerHTML += agentHTML;
            updateAgentCount();
        }

        function removeSupportAgent(agentId) {
            document.querySelector(`[data-agent-id="${agentId}"]`)?.closest('.agent-card')?.remove();
            updateAgentCount();
        }

        function updateAgentCount() {
            const agents = [];
            document.querySelectorAll('.agent-card').forEach(card => {
                const name = card.querySelector('.agent-name').value;
                const avatar = card.querySelector('.agent-avatar').value;
                const status = card.querySelector('.agent-status').value;
                const message = card.querySelector('.agent-message').value;
                
                if (name) {
                    agents.push({
                        name: name,
                        avatar: avatar,
                        status: status,
                        message: message
                    });
                    
                    card.querySelector('.agent-data').value = JSON.stringify({name, avatar, status, message});
                }
            });
        }

        // Update agent data sebelum submit
        document.querySelector('form')?.addEventListener('submit', function() {
            updateAgentCount();
        });

        // Initialize agents if any
        document.addEventListener('DOMContentLoaded', function() {
            // Bisa load agent dari database nanti
        });
    </script>
</body>
</html>
