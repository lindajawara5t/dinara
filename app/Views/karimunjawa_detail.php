<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Wisata Karimunjawa - <?= $settings['app_name'] ?? 'Dinara Travel' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #f0f4ff 100%);
            min-height: 100vh;
        }
        
        /* HEADER */
        .km-detail-header {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            color: white;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }
        
        .km-detail-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            transform: translate(50%, -50%);
        }
        
        .km-detail-header-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .km-detail-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
        }
        
        .km-detail-header p {
            font-size: 1.1rem;
            opacity: 0.95;
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .back-button:hover {
            background: rgba(255,255,255,0.3);
            color: white;
            transform: translateX(-4px);
        }
        
        /* CONTENT */
        .km-detail-content {
            max-width: 1000px;
            margin: -30px auto 0;
            position: relative;
            z-index: 3;
            padding: 0 20px 40px;
        }
        
        .km-section {
            background: white;
            border-radius: 16px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border-left: 5px solid #0ea5e9;
        }
        
        .km-section h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .km-section h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #0284c7;
            margin-top: 25px;
            margin-bottom: 15px;
        }
        
        .km-section p {
            color: #4b5563;
            line-height: 1.8;
            margin-bottom: 15px;
        }
        
        .km-section ul,
        .km-section ol {
            color: #4b5563;
            margin-bottom: 20px;
            padding-left: 25px;
        }
        
        .km-section li {
            margin-bottom: 12px;
            line-height: 1.6;
        }
        
        .highlight-box {
            background: linear-gradient(135deg, #e0f2fe 0%, #cffafe 100%);
            border-left: 4px solid #0284c7;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        
        .highlight-box strong {
            color: #0284c7;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        
        .info-card {
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #bae6fd;
        }
        
        .info-card i {
            font-size: 2rem;
            color: #0284c7;
            margin-bottom: 10px;
        }
        
        .info-card h4 {
            color: #0284c7;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .info-card p {
            font-size: 0.95rem;
            margin: 0;
        }
        
        /* FOOTER */
        .modern-luxury-footer {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #e2e8f0;
            margin-top: 60px;
        }
        
        .footer-top-section {
            padding: 50px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .container-wide {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer-content-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 40px;
        }
        
        .brand-showcase {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            align-items: flex-start;
        }
        
        .brand-logo-wrapper {
            flex-shrink: 0;
        }
        
        .brand-logo {
            max-width: 60px;
            height: auto;
        }
        
        .brand-info h3 {
            margin: 0;
            color: white;
            font-weight: 700;
        }
        
        .brand-tagline {
            margin: 5px 0 0;
            color: #94a3b8;
            font-size: 0.9rem;
        }
        
        .brand-description {
            color: #cbd5e1;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .social-icons-modern {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .social-icon-modern {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.1);
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .social-icon-modern:hover {
            background: #0ea5e9;
            transform: translateY(-3px);
        }
        
        .footer-info-columns {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
        }
        
        .footer-info-column h4 {
            color: white;
            margin-bottom: 15px;
        }
        
        .footer-info-column a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-info-column a:hover {
            color: #0ea5e9;
        }
        
        .footer-link-list {
            list-style: none;
            padding: 0;
        }
        
        .footer-link-list li {
            margin-bottom: 10px;
        }
        
        .footer-divider {
            height: 1px;
            background: rgba(255,255,255,0.1);
        }
        
        .footer-bottom-section {
            padding: 30px 20px;
        }
        
        .footer-bottom-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            text-align: center;
        }
        
        .footer-copyright p {
            margin: 0;
            color: #94a3b8;
            font-size: 0.9rem;
        }
        
        .footer-developer-credits p {
            margin: 0;
            color: #64748b;
            font-size: 0.85rem;
        }
        
        .footer-developer-credits a {
            color: #0ea5e9;
            text-decoration: none;
        }
        
        .back-to-top-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        }
        
        .back-to-top-btn.show {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(14,165,233,0.4);
        }
        
        @media (max-width: 768px) {
            /* HEADER MOBILE */
            .km-detail-header {
                padding: 20px 15px;
            }
            
            .km-detail-header h1 {
                font-size: 1.4rem;
                margin-bottom: 8px;
            }
            
            .km-detail-header p {
                font-size: 0.85rem;
                opacity: 0.9;
            }
            
            .back-button {
                padding: 8px 12px;
                font-size: 0.9rem;
                margin-bottom: 15px;
            }
            
            /* CONTENT MOBILE */
            .km-detail-content {
                padding: 0 12px 30px;
                margin: -20px auto 0;
            }
            
            .km-section {
                padding: 18px;
                margin-bottom: 20px;
                border-radius: 12px;
                border-left: 3px solid #0ea5e9;
            }
            
            .km-section h2 {
                font-size: 1.3rem;
                margin-bottom: 15px;
            }
            
            .km-section h3 {
                font-size: 1rem;
                margin-top: 15px;
                margin-bottom: 10px;
            }
            
            .km-section p {
                font-size: 0.9rem;
                line-height: 1.5;
                margin-bottom: 12px;
            }
            
            .km-section ul,
            .km-section ol {
                padding-left: 20px;
                font-size: 0.9rem;
                margin-bottom: 15px;
            }
            
            .km-section li {
                margin-bottom: 8px;
                line-height: 1.5;
            }
            
            .highlight-box {
                padding: 15px;
                margin: 15px 0;
                border-radius: 8px;
                font-size: 0.9rem;
            }
            
            /* INFO GRID MOBILE */
            .info-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 12px;
            }
            
            .info-card {
                padding: 15px;
                border-radius: 10px;
            }
            
            .info-card i {
                font-size: 1.5rem;
                margin-bottom: 8px;
            }
            
            .info-card h4 {
                font-size: 0.85rem;
                margin-bottom: 6px;
            }
            
            .info-card p {
                font-size: 0.8rem;
            }
            
            /* FOOTER MOBILE */
            .footer-top-section {
                padding: 30px 15px;
            }
            
            .footer-content-grid {
                grid-template-columns: 1fr;
                gap: 25px;
            }
            
            .brand-showcase {
                gap: 10px;
            }
            
            .brand-logo {
                max-width: 45px;
            }
            
            .brand-info h3 {
                font-size: 1rem;
            }
            
            .brand-tagline {
                font-size: 0.8rem;
            }
            
            .brand-description {
                font-size: 0.85rem;
                line-height: 1.5;
            }
            
            .social-heading {
                font-size: 0.9rem;
            }
            
            .social-icon-modern {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
            
            .footer-info-columns {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .footer-info-column h4 {
                font-size: 0.95rem;
                margin-bottom: 10px;
            }
            
            .footer-link-list li {
                margin-bottom: 8px;
            }
            
            .footer-link-list a {
                font-size: 0.9rem;
            }
            
            .footer-bottom-content {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .footer-copyright p {
                font-size: 0.8rem;
            }
            
            .footer-developer-credits p {
                font-size: 0.75rem;
            }
            
            /* BACK TO TOP MOBILE */
            .back-to-top-btn {
                bottom: 20px;
                right: 15px;
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="km-detail-header">
        <div class="km-detail-header-content">
            <a href="<?= base_url('/') ?>" class="back-button">
                <i class="bi bi-chevron-left"></i>Kembali ke Beranda
            </a>
            <h1><i class="bi bi-geo-alt-fill"></i>Panduan Lengkap Karimunjawa</h1>
            <p>Surga Tersembunyi di Laut Jawa - Informasi Terlengkap untuk Liburan Sempurna Anda</p>
        </div>
    </div>
    
    <!-- CONTENT -->
    <div class="km-detail-content">
        <!-- SECTION 1: TENTANG KARIMUNJAWA -->
        <div class="km-section">
            <h2><i class="bi bi-info-circle-fill" style="color: #0ea5e9;"></i>Tentang Karimunjawa</h2>
            <p><?= $settings['about_karimunjawa'] ?? 'Karimunjawa adalah kepulauan yang terdiri dari 27 pulau di Laut Jawa, sekitar 80 km barat laut Jepara. Dikenal sebagai "surga tersembunyi", Karimunjawa menawarkan keindahan alam bawah laut yang luar biasa, pantai berpasir putih, dan hutan mangrove yang asri. Tempat sempurna untuk snorkeling, diving, island hopping, dan menikmati sunset terbaik di Indonesia.' ?></p>
            
            <h3>Mengapa Harus Liburan ke Karimunjawa?</h3>
            <ul>
                <li><strong>Keindahan Bawah Laut:</strong> Spot snorkeling dan diving dengan terumbu karang yang masih sangat sehat dan ikan tropis yang beragam.</li>
                <li><strong>Pantai Perawan:</strong> Pulau-pulau tak berpenghuni dengan pasir putih yang sangat halus seperti tepung.</li>
                <li><strong>Kuliner Laut Segar:</strong> Menikmati ikan bakar bumbu khas Karimunjawa di pinggir pantai dengan pemandangan menakjubkan.</li>
                <li><strong>Suasana Tenang:</strong> Jauh dari hiruk pikuk kota, cocok untuk healing atau honeymoon impian Anda.</li>
                <li><strong>Konservasi Alam:</strong> Merupakan Taman Nasional yang melindungi ekosistem terumbu karang dan biota laut langka.</li>
            </ul>
        </div>
        
        <!-- SECTION 2: CARA MENUJU KE KARIMUNJAWA -->
        <div class="km-section">
            <h2><i class="bi bi-airplane-fill" style="color: #0ea5e9;"></i>Cara Menuju ke Karimunjawa</h2>
            
            <h3>1. Via Kapal Laut (Paling Populer)</h3>
            <p>Titik keberangkatan utama adalah dari Pelabuhan Kartini, Jepara atau Pelabuhan Tanjung Emas, Semarang.</p>
            
            <div class="info-grid">
                <div class="info-card">
                    <i class="bi bi-speedboat"></i>
                    <h4>Dari Jepara</h4>
                    <p><strong>Kapal Cepat Express Bahari:</strong> 2-2,5 jam, nyaman & berAC</p>
                </div>
                <div class="info-card">
                    <i class="bi bi-ship"></i>
                    <h4>Kapal Feri</h4>
                    <p><strong>Kapal Feri Siginjai:</strong> 4-5 jam, bisa bawa kendaraan</p>
                </div>
                <div class="info-card">
                    <i class="bi bi-compass"></i>
                    <h4>Dari Semarang</h4>
                    <p><strong>Kapal PELNI:</strong> Jadwal tidak setiap hari</p>
                </div>
            </div>
            
            <h3>2. Via Pesawat Terbang</h3>
            <p>Anda bisa terbang dari Bandara Ahmad Yani (Semarang) atau Bandara Juanda (Surabaya) menuju Bandara Dewadaru (Karimunjawa) menggunakan pesawat perintis. Opsi ini lebih cepat namun jadwalnya terbatas dan bergantung pada cuaca.</p>
        </div>
        
        <!-- SECTION 3: DESTINASI WISATA HITS -->
        <div class="km-section">
            <h2><i class="bi bi-map-fill" style="color: #0ea5e9;"></i>5 Destinasi Wisata Paling Hits di Karimunjawa</h2>
            
            <h3>1. Menjangan Besar (Penangkaran Hiu)</h3>
            <p>Ingin menguji adrenalin? Di sini Anda bisa berenang dan berfoto langsung bersama kumpulan hiu sirip hitam dan hiu sirip putih. Hiu di sini sudah terbiasa dengan manusia, namun tetap ikuti arahan pemandu.</p>
            
            <h3>2. Pulau Cemara Besar & Cemara Kecil</h3>
            <p>Dua pulau ini sering menjadi lokasi sandar untuk makan siang. Bayangkan menyantap ikan bakar bumbu khas Karimunjawa di atas pasir putih, dikelilingi gradasi air laut berwarna toska. Air di sini sangat dangkal dan tenang, cocok untuk bermain air.</p>
            
            <h3>3. Spot Snorkeling Menjangan Kecil</h3>
            <p>Ini adalah surga bagi pecinta snorkeling. Terumbu karangnya berwarna-warni dan ikannya sangat agresif menyerbu roti yang Anda bawa. Visibilitas air di sini luar biasa jernih, hingga 20 meter visibility.</p>
            
            <h3>4. Pantai Tanjung Gelam</h3>
            <p>Spot terbaik untuk menutup hari. Tanjung Gelam terkenal dengan pohon kelapa miring yang ikonik dan pemandangan sunset yang magis. Jangan lupa abadikan momen siluet Anda di sini.</p>
            
            <h3>5. Bukit Love (Karimunjawa Viewpoint)</h3>
            <p>Jika bosan dengan laut, naiklah ke Bukit Love. Dari sini, Anda bisa melihat hamparan laut Karimunjawa dari ketinggian. Ada juga spot foto sarang burung dan tulisan "LOVE" serta "KARIMUNJAWA" yang sangat instagramable.</p>
        </div>
        
        <!-- SECTION 4: WAKTU TERBAIK -->
        <div class="km-section">
            <h2><i class="bi bi-calendar-event" style="color: #0ea5e9;"></i>Kapan Waktu Terbaik ke Karimunjawa?</h2>
            
            <div class="highlight-box">
                <strong>⭐ Waktu Terbaik: April hingga November (Musim Kemarau)</strong><br>
                Pada bulan-bulan ini, ombak cenderung tenang dan langit cerah, sehingga aksesibilitas kapal lebih terjamin.
            </div>
            
            <h3>Waktu yang Dihindari</h3>
            <p><strong>Desember, Januari, dan Februari</strong> - Ini adalah puncak Musim Baratan di mana ombak bisa sangat tinggi, dan seringkali penyeberangan kapal dibatalkan. Cuaca juga tidak menentu.</p>
            
            <h3>Rekomendasi Bulan Terbaik:</h3>
            <ul>
                <li><strong>Juni - Agustus:</strong> Musim puncak dengan cuaca paling stabil (tapi banyak turis)</li>
                <li><strong>April - Mei:</strong> Menjelang musim panas, cuaca mulai bagus (rekomendasi terbaik!)</li>
                <li><strong>September - Oktober:</strong> Cuaca masih bagus, mulai sepi dari turis</li>
            </ul>
        </div>
        
        <!-- SECTION 5: TIPS PENTING -->
        <div class="km-section">
            <h2><i class="bi bi-lightbulb-fill" style="color: #0ea5e9;"></i>Tips Penting untuk Liburan Anda</h2>
            
            <h3>Persiapan Sebelum Berangkat</h3>
            <ul>
                <li>Bawa sunscreen SPF 50+ dan lip balm dengan UV protection</li>
                <li>Siapkan pakaian renang dan handuk yang cepat kering</li>
                <li>Bawa alas kaki yang nyaman untuk hiking dan berjalan di pantai</li>
                <li>Siapkan kamera waterproof atau underwater case untuk ponsel</li>
                <li>Periksa jadwal kapal dan pesan tiket dengan advance</li>
            </ul>
            
            <h3>Tips di Karimunjawa</h3>
            <ul>
                <li>Selalu dengarkan arahan pemandu lokal untuk keselamatan</li>
                <li>Jangan berdiri di atas terumbu karang (rusak dan membahayakan)</li>
                <li>Gunakan sunscreen ramah lingkungan yang tidak merusak terumbu karang</li>
                <li>Bawa tas plastik untuk sampah (kurangi jejak karbon)</li>
                <li>Nikmati setiap momen tanpa terburu-buru - Karimunjawa adalah tentang ketenangan</li>
                <li>Coba makanan lokal dan dukung ekonomi lokal</li>
            </ul>
        </div>
        
        <!-- SECTION 6: PAKET WISATA -->
        <div class="km-section">
            <h2><i class="bi bi-box-seam" style="color: #0ea5e9;"></i>Paket Wisata Kami</h2>
            <p>Kami menyediakan berbagai paket wisata ke Karimunjawa yang dapat disesuaikan dengan kebutuhan dan budget Anda. Dari paket solo traveler hingga rombongan keluarga besar, kami siap membantu mewujudkan liburan impian Anda.</p>
            
            <div class="highlight-box">
                <strong>📞 Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik!</strong><br>
                Telepon: <?= esc($settings['footer_phone'] ?? '(0274) 555-XXXX') ?><br>
                WhatsApp: <a href="<?= esc($settings['footer_whatsapp'] ?? '#') ?>" target="_blank" style="color: #0284c7;">Hubungi WhatsApp</a>
            </div>
            
            <a href="<?= base_url('/') ?>" class="btn btn-primary btn-lg mt-3">
                <i class="bi bi-airplane-fill me-2"></i>Lihat Paket Wisata
            </a>
        </div>
    </div>
    
    <!-- FOOTER (SAMA SEPERTI HOME) -->
    <footer class="modern-luxury-footer">
        <div class="footer-top-section">
            <div class="container-wide">
                <div class="footer-content-grid">
                    <!-- LEFT COLUMN: BRANDING -->
                    <div class="footer-brand-column">
                        <div class="brand-showcase">
                            <div class="brand-logo-wrapper">
                                <img class="brand-logo" src="<?= base_url('uploads/' . (!empty($settings['footer_logo']) ? $settings['footer_logo'] : ($settings['logo'] ?? 'logo-dinara.png'))) ?>" alt="<?= $settings['app_name'] ?? 'Dinara Travel' ?>" onerror="this.style.display='none'">
                            </div>
                            <div class="brand-info">
                                <h3 class="brand-name"><?= $settings['app_name'] ?? 'Dinara Travel' ?></h3>
                                <p class="brand-tagline">Petualangan Menuju Keindahan Karimunjawa</p>
                            </div>
                        </div>
                        <p class="brand-description"><?= esc($settings['footer_description'] ?? 'Kami adalah agen perjalanan terpercaya yang menyediakan paket wisata ke Karimunjawa dengan harga terjangkau dan pelayanan profesional.') ?></p>
                        
                        <!-- SOCIAL MEDIA ICONS -->
                        <div class="social-media-section">
                            <p class="social-heading" style="color: #94a3b8; margin-bottom: 12px; font-weight: 600;">Ikuti Kami</p>
                            <div class="social-icons-modern">
                                <?php if(!empty($settings['footer_facebook'])): ?>
                                <a href="<?= esc($settings['footer_facebook']) ?>" target="_blank" rel="noopener noreferrer" class="social-icon-modern facebook" title="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <?php endif; ?>
                                <?php if(!empty($settings['footer_instagram'])): ?>
                                <a href="<?= esc($settings['footer_instagram']) ?>" target="_blank" rel="noopener noreferrer" class="social-icon-modern instagram" title="Instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <?php endif; ?>
                                <?php if(!empty($settings['footer_tiktok'])): ?>
                                <a href="<?= esc($settings['footer_tiktok']) ?>" target="_blank" rel="noopener noreferrer" class="social-icon-modern tiktok" title="TikTok">
                                    <i class="bi bi-tiktok"></i>
                                </a>
                                <?php endif; ?>
                                <?php if(!empty($settings['footer_youtube'])): ?>
                                <a href="<?= esc($settings['footer_youtube']) ?>" target="_blank" rel="noopener noreferrer" class="social-icon-modern youtube" title="YouTube">
                                    <i class="bi bi-youtube"></i>
                                </a>
                                <?php endif; ?>
                                <?php if(!empty($settings['footer_whatsapp'])): ?>
                                <a href="<?= esc($settings['footer_whatsapp']) ?>" target="_blank" rel="noopener noreferrer" class="social-icon-modern whatsapp" title="WhatsApp">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- CENTER-RIGHT COLUMNS: INFO & LINKS -->
                    <div class="footer-info-columns">
                        <!-- CONTACT INFO COLUMN -->
                        <div class="footer-info-column">
                            <div class="column-header" style="margin-bottom: 15px;">
                                <i class="bi bi-telephone" style="color: #0ea5e9; margin-right: 8px;"></i>
                                <h4 style="margin: 0;">Hubungi Kami</h4>
                            </div>
                            <div class="contact-items">
                                <?php if(!empty($settings['footer_address'])): ?>
                                <div style="margin-bottom: 12px;">
                                    <i class="bi bi-geo-alt" style="color: #0ea5e9;"></i>
                                    <span style="color: #cbd5e1; font-size: 0.9rem;"><?= esc($settings['footer_address']) ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($settings['footer_phone'])): ?>
                                <div style="margin-bottom: 12px;">
                                    <i class="bi bi-telephone" style="color: #0ea5e9;"></i>
                                    <a href="tel:<?= str_replace(' ', '', $settings['footer_phone']) ?>" style="color: #cbd5e1; text-decoration: none;"><?= esc($settings['footer_phone']) ?></a>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($settings['footer_email'])): ?>
                                <div style="margin-bottom: 12px;">
                                    <i class="bi bi-envelope" style="color: #0ea5e9;"></i>
                                    <a href="mailto:<?= esc($settings['footer_email']) ?>" style="color: #cbd5e1; text-decoration: none;"><?= esc($settings['footer_email']) ?></a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- QUICK LINKS COLUMN -->
                        <div class="footer-info-column">
                            <div class="column-header" style="margin-bottom: 15px;">
                                <i class="bi bi-link-45deg" style="color: #0ea5e9; margin-right: 8px;"></i>
                                <h4 style="margin: 0;">Navigasi</h4>
                            </div>
                            <ul class="footer-link-list">
                                <li><a href="<?= base_url('/') ?>"><i class="bi bi-house-fill"></i> Beranda</a></li>
                                <li><a href="<?= base_url('hotel') ?>"><i class="bi bi-building"></i> Hotel</a></li>
                                <li><a href="<?= base_url('destinasi') ?>"><i class="bi bi-geo-alt-fill"></i> Destinasi</a></li>
                                <li><a href="<?= base_url('/blog') ?>"><i class="bi bi-newspaper"></i> Blog</a></li>
                                <li><a href="#"><i class="bi bi-question-circle"></i> FAQ</a></li>
                            </ul>
                        </div>

                        <!-- SERVICES COLUMN -->
                        <div class="footer-info-column">
                            <div class="column-header" style="margin-bottom: 15px;">
                                <i class="bi bi-star" style="color: #0ea5e9; margin-right: 8px;"></i>
                                <h4 style="margin: 0;">Layanan</h4>
                            </div>
                            <ul class="footer-link-list">
                                <li><a href="#"><i class="bi bi-airplane-fill"></i> Paket Wisata</a></li>
                                <li><a href="<?= base_url('hotel') ?>"><i class="bi bi-house-heart"></i> Booking Hotel</a></li>
                                <li><a href="#"><i class="bi bi-ticket"></i> Tiket Pesawat</a></li>
                                <li><a href="<?= !empty($settings['footer_whatsapp']) ? $settings['footer_whatsapp'] : '#' ?>" target="_blank"><i class="bi bi-chat-dots"></i> Konsultasi</a></li>
                                <li><a href="#"><i class="bi bi-shield-check"></i> Jaminan Terbaik</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER DIVIDER -->
        <div class="footer-divider"></div>

        <!-- FOOTER BOTTOM -->
        <div class="footer-bottom-section">
            <div class="container-wide">
                <div class="footer-bottom-content">
                    <div class="footer-copyright">
                        <p>&copy; <strong><?= $settings['footer_copyright_year'] ?? date('Y') ?></strong> <strong><?= $settings['app_name'] ?? 'Dinara Travel' ?></strong>. Semua hak dilindungi. Agen Perjalanan Terpercaya ke Karimunjawa.</p>
                    </div>
                    <div class="footer-developer-credits">
                        <p>Dikembangkan oleh <a href="<?= esc($settings['footer_developer_link'] ?? 'https://github.com') ?>" target="_blank"><?= esc($settings['footer_developer_name'] ?? 'Developer Team') ?></a></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- BACK TO TOP BUTTON -->
        <a href="#" class="back-to-top-btn" id="backToTopBtn" title="Kembali ke Atas">
            <i class="bi bi-chevron-up"></i>
        </a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Back to top button
        window.addEventListener('scroll', () => {
            const btn = document.getElementById('backToTopBtn');
            if (window.pageYOffset > 300) {
                btn.classList.add('show');
            } else {
                btn.classList.remove('show');
            }
        });

        document.getElementById('backToTopBtn').addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>
