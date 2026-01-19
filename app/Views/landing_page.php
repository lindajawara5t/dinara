<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $settings['hero_title'] ?? 'Dinara Travel' ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f2f4f6; overflow-x: hidden; }
        
        /* FULL WIDTH HEADER OVERRIDES */
        header, .navbar {
            width: 100% !important;
            max-width: 100% !important;
        }
        
        /* Container fluid overrides untuk full width dengan padding */
        .navbar .container-fluid, header .container-fluid {
            max-width: 100% !important;
            width: 100% !important;
            padding-left: 25px;
            padding-right: 25px;
        }
        
        /* Override semua container di header dan navbar */
        .navbar .container, header .container {
            max-width: 100% !important;
            width: 100% !important;
            padding-left: 50px !important;
            padding-right: 50px !important;
        }
        
        /* NAVBAR */
        .navbar { 
            background: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.08); 
            height: 80px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            z-index: 1000 !important;
            position: relative;
        }
        .navbar-brand img { max-height: 40px; width: auto; object-fit: contain; }
        .navbar-brand { font-weight: 700; color: #0d6efd; font-size: 1.3rem; display: flex; align-items: center; gap: 10px; }

        /* LIVE INDICATOR */
        .navbar-live-info {
            background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 30px;
            padding: 5px 15px; font-size: 0.75rem; color: #333; display: flex; align-items: center; max-width: 400px;
        }
        .pulse-dot { width: 8px; height: 8px; background-color: #00ff88; border-radius: 50%; margin-right: 10px; flex-shrink: 0; box-shadow: 0 0 8px #00ff88; animation: pulse 2s infinite; }
        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.4; } 100% { opacity: 1; } }

        /* HERO SECTION WITH SLIDESHOW */
        .hero-section-with-slideshow {
            position: relative;
            overflow: visible;
            min-height: 600px;
            padding-top: 80px;
            padding-bottom: 120px;
            color: white;
            text-align: center;
            width: 100vw;
            margin-left: calc(-50vw + 50%);
            z-index: 10;
        }

        .slideshow-background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 1;
            display: block;
            pointer-events: none;
        }

        .slide-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .slide-bg.active {
            opacity: 1;
        }

        .slide-bg-image {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .slide-bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.3) 0%, rgba(0, 100, 255, 0.25) 40%, rgba(0, 31, 63, 0.4) 100%);
            pointer-events: none;
        }

        .hero-section-with-slideshow .container-fluid {
            position: relative;
            z-index: 100;
            width: 100%;
            max-width: 100% !important;
            padding-left: 50px !important;
            padding-right: 50px !important;
        }

        /* SEARCH CARD (CONTAINER UTAMA) */
        .search-card {
            background: #ffffff; border-radius: 15px; box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            padding: 30px; margin-top: 30px; position: relative; z-index: 20;
        }

        /* MAP STYLING */
        #map { 
            height: 550px; width: 100%; border-radius: 15px; 
            box-shadow: inset 0 0 20px rgba(0,0,0,0.05); border: 1px solid #dee2e6;
        }
        
        /* TIMELINE STORY STYLING */
        .timeline { border-left: 3px solid #e9ecef; margin-left: 10px; padding-left: 25px; position: relative; margin-top: 10px; }
        .timeline-item { margin-bottom: 30px; position: relative; opacity: 0.4; transition: 0.4s; filter: grayscale(1); pointer-events: none; }
        .timeline-item.active { opacity: 1; transform: translateX(5px); filter: grayscale(0); pointer-events: all; }
        
        .timeline-dot { 
            width: 18px; height: 18px; background: #fff; border: 4px solid #adb5bd; 
            border-radius: 50%; position: absolute; left: -35px; top: 3px; transition: 0.3s;
            z-index: 2;
        }
        .timeline-item.active .timeline-dot { border-color: #0d6efd; background: #0d6efd; box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.2); }

        .timeline h6 { font-weight: 700; color: #333; margin-bottom: 4px; font-size: 1rem; white-space: nowrap; }
        .timeline p { font-size: 0.8rem; color: #888; margin-bottom: 12px; white-space: nowrap; }
        
        /* FORM SECTION STYLES */
        .form-section-label {
            font-size: 0.75rem; font-weight: 700; color: #0d6efd; 
            text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;
        }
        
        .input-group-story {
            display: flex; gap: 8px; align-items: center;
        }
        
        .input-icon {
            width: 44px; height: 44px; background: linear-gradient(135deg, #f0f7ff, #e8f0ff);
            border: 2px solid #cce5ff; border-radius: 10px; display: flex;
            align-items: center; justify-content: center; color: #0d6efd;
            font-size: 1.2rem; flex-shrink: 0; transition: 0.3s;
        }
        .form-control-story:focus + .input-icon,
        .input-group-story:has(.form-control-story:focus) .input-icon {
            background: linear-gradient(135deg, #e8f0ff, #d6e4ff);
            border-color: #0d6efd;
        }

        /* INPUT STYLES */
        .form-control-story {
            background: #f8fbff; border: 2px solid #cce5ff; border-radius: 10px;
            font-size: 0.9rem; font-weight: 500; color: #0d6efd; padding: 11px 14px;
            height: 44px; transition: 0.3s ease;
        }
        .form-control-story:focus { 
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1); 
            border-color: #0d6efd; background: #fff; 
        }
        .form-control-story::placeholder { color: #adb5bd; font-weight: 400; }
        
        /* FORM SELECT STYLES */
        .form-select-story {
            background: #f8fbff; border: 2px solid #cce5ff; border-radius: 10px;
            font-size: 0.9rem; font-weight: 500; color: #0d6efd; padding: 11px 14px;
            height: 44px; transition: 0.3s ease;
        }
        .form-select-story:focus { 
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1); 
            border-color: #0d6efd; background: #fff; 
        }

        /* POPUP MAP STYLES */
        .custom-popup .leaflet-popup-content-wrapper { border-radius: 12px; padding: 0; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.2); }
        .custom-popup .leaflet-popup-content { margin: 0; width: 260px !important; }
        .popup-header { background: #0d6efd; color: white; padding: 12px 15px; font-weight: 600; font-size: 0.9rem; display: flex; justify-content: space-between; align-items: center; }
        .popup-body { padding: 10px; max-height: 250px; overflow-y: auto; background: #fff; }
        
        .btn-pilih { 
            width: 100%; text-align: left; margin-bottom: 6px; border-radius: 8px; 
            padding: 8px 12px; transition: 0.2s; border: 1px solid #e9ecef; background: #fff;
            display: flex; justify-content: space-between; align-items: center;
        }
        .btn-pilih:hover { background: #f0f7ff; border-color: #0d6efd; transform: translateX(3px); }
        .btn-pilih .info-harga { font-weight: bold; color: #0d6efd; font-size: 0.85rem; }
        .btn-pilih .info-nama { font-size: 0.85rem; color: #444; font-weight: 500; }

        /* ANIMATION ICON */
        .custom-icon { font-size: 1.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); transition: transform 0.2s; }
        .custom-icon:hover { transform: scale(1.2) translateY(-5px); }

        .btn-hitung-final {
            background: linear-gradient(45deg, #0d6efd, #0099ff); border: none;
            color: white; font-weight: 700; padding: 16px 24px; border-radius: 10px;
            width: 100%; margin-top: 20px; box-shadow: 0 5px 15px rgba(13,110,253,0.3);
            transition: 0.3s; font-size: 1rem; letter-spacing: 0.5px; 
            display: flex; align-items: center; justify-content: center; gap: 8px;
            min-height: 52px; white-space: nowrap;
        }
        .btn-hitung-final:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(13,110,253,0.4); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <?php if(!empty($settings['logo_image'])): ?>
                    <img src="<?= base_url('uploads/' . $settings['logo_image']) ?>" alt="Logo">
                <?php else: ?>
                    <i class="bi bi-exclude fs-4"></i>
                <?php endif; ?>
                <span class="d-none d-md-block">Dinara Travel</span>
            </a>
            <div class="mx-auto d-none d-lg-block">
                <div class="navbar-live-info">
                    <div class="pulse-dot"></div>
                    <marquee scrollamount="5" width="300px" style="vertical-align: middle;">
                        INFO TERKINI: <?= $settings['announcement'] ?? 'Ombak Laut Tenang • Cuaca Cerah • Penyeberangan Lancar' ?>
                    </marquee>
                </div>
            </div>
            <div class="ms-auto">
                <a href="<?= base_url('admin') ?>" class="btn btn-outline-dark rounded-pill px-3 py-1 btn-sm fw-bold border-2" style="font-size: 0.75rem;">Login Mitra</a>
            </div>
        </div>
    </nav>

    <header class="hero-section-with-slideshow">
        <!-- HERO SLIDESHOW CONTAINER -->
        <?php
        $slideshows = model('HeroSlideshowModel')->getActiveSlideshows();
        ?>
        <?php if (!empty($slideshows)): ?>
        <div class="slideshow-background-container" id="slideshow-bg-container">
            <?php foreach ($slideshows as $index => $slide): ?>
            <div class="slide-bg <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>">
                <div class="slide-bg-image" style="background-image: url('<?= $slide['image_url'] ?>')"></div>
                <div class="slide-bg-overlay"></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <div class="container-fluid">
            <h1 class="fw-bold text-white mb-3" style="font-size: 2.8rem; letter-spacing: -1.5px; text-shadow: 0 8px 20px rgba(0,0,0,0.4), 0 2px 5px rgba(0,0,0,0.2); font-weight: 900; word-spacing: 3px; line-height: 1.2;">
                <?= $settings['hero_title'] ?? 'Smart Journey Planner' ?>
            </h1>
            <p class="text-white mb-0" style="font-size: 1.2rem; font-weight: 300; letter-spacing: 0.8px; opacity: 0.9; line-height: 1.7; max-width: 600px; margin-left: auto; margin-right: auto;">
                <?= $settings['hero_subtitle'] ?? 'Rencanakan perjalanan Karimunjawa dari pintu rumahmu' ?>
            </p>
        </div>
    </header>

    <div class="container-fluid mb-5 px-5">
        <div class="search-card">
            <div class="row g-4">
                
                <div class="col-lg-7 order-2 order-lg-1">
                    <div id="map"></div>
                    <div class="mt-2 d-flex justify-content-between text-muted" style="font-size: 0.75rem;">
                        <span><i class="bi bi-info-circle"></i> Klik Ikon di peta untuk memilih transportasi</span>
                        <span>Map Data &copy; OpenStreetMap</span>
                    </div>
                </div>

                <div class="col-lg-5 order-1 order-lg-2">
                    <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-journal-text me-2"></i>Rencana Perjalanan Anda</h5>
                    
                    <form action="/kalkulator/hitung" method="post" id="formHitung">
                        <div class="timeline">
                            
                            <div class="timeline-item active" id="step-1">
                                <div class="timeline-dot"></div>
                                <h6><i class="bi bi-geo-alt-fill me-2"></i>Mulai dari mana?</h6>
                                <p>Pilih titik lokasi rumahmu di Peta</p>
                                <div class="input-group-story">
                                    <div class="input-icon"><i class="bi bi-house-fill"></i></div>
                                    <input type="text" id="input_kota" name="kota_asal" class="form-control form-control-story flex-grow-1" readonly placeholder="Klik Peta..." required>
                                </div>
                                <input type="hidden" id="input_harga_darat" name="harga_transport" value="0">
                            </div>

                            <div class="timeline-item" id="step-2">
                                <div class="timeline-dot"></div>
                                <h6><i class="bi bi-water me-2"></i>Penyeberangan Kapal</h6>
                                <p>Pilih kapal di Pelabuhan Jepara</p>
                                <div class="input-group-story">
                                    <div class="input-icon"><i class="bi bi-ship"></i></div>
                                    <input type="text" id="input_kapal" class="form-control form-control-story flex-grow-1" readonly placeholder="Menunggu..." required>
                                </div>
                            </div>

                            <div class="timeline-item" id="step-3">
                                <div class="timeline-dot"></div>
                                <h6><i class="bi bi-car-front-fill me-2"></i>Transportasi Pulau</h6>
                                <p>Kendaraan untuk jalan-jalan</p>
                                <div class="input-group-story">
                                    <div class="input-icon"><i class="bi bi-scooter"></i></div>
                                    <input type="text" id="input_lokal" class="form-control form-control-story flex-grow-1" readonly placeholder="Menunggu...">
                                </div>
                            </div>

                            <div class="timeline-item" id="step-4">
                                <div class="timeline-dot"></div>
                                <h6><i class="bi bi-calendar-check-fill me-2"></i>Detail Liburan</h6>
                                <p>Lengkapi data terakhir ini</p>
                                
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <span class="form-section-label">Tanggal Keberangkatan</span>
                                        <input type="date" name="tanggal" class="form-control form-control-story w-100" required>
                                    </div>
                                    <div class="col-6">
                                        <span class="form-section-label">Durasi Liburan</span>
                                        <select name="durasi" class="form-select form-select-story w-100">
                                            <option value="2">2 Hari 1 Malam</option>
                                            <option value="3" selected>3 Hari 2 Malam</option>
                                            <option value="4">4 Hari 3 Malam</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <span class="form-section-label">Jumlah Peserta</span>
                                        <div class="input-group-story">
                                            <div class="input-icon"><i class="bi bi-people-fill"></i></div>
                                            <input type="number" name="jumlah_orang" value="2" min="1" class="form-control form-control-story flex-grow-1" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <span class="form-section-label">Total Budget (Rp)</span>
                                        <div class="input-group-story">
                                            <div class="input-icon"><i class="bi bi-cash-coin"></i></div>
                                            <input type="number" name="budget_total" class="form-control form-control-story flex-grow-1" placeholder="Contoh: 5000000" required>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn-hitung-final">
                                    <i class="bi bi-calculator-fill me-2"></i> HITUNG SEKARANG
                                </button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <!-- HERO SLIDESHOW SCRIPT -->
    <script>
        console.log('=== HERO SLIDESHOW SCRIPT LOADED ===');
        
        function initHeroSlideshow() {
            console.log('🎬 Hero Slideshow Initialization Started');
            
            // Debug: Check if container exists
            const container = document.getElementById('slideshow-bg-container');
            console.log('📦 Container found:', !!container);
            if (container) {
                console.log('Container computed style:', {
                    position: getComputedStyle(container).position,
                    zIndex: getComputedStyle(container).zIndex,
                    display: getComputedStyle(container).display,
                    width: container.offsetWidth,
                    height: container.offsetHeight
                });
            }
            
            let currentSlideBg = 0;
            const slideBgs = document.querySelectorAll('.slide-bg');
            let slideBgInterval = null;
            
            console.log('📊 Total .slide-bg elements found:', slideBgs.length);

            if (slideBgs.length === 0) {
                console.error('❌ NO .slide-bg ELEMENTS FOUND! Slideshow cannot work.');
                // Debug: Check alternative selectors
                console.log('Checking for .slide-bg-image:', document.querySelectorAll('.slide-bg-image').length);
                console.log('Checking for slideshow container:', document.querySelectorAll('[class*="slideshow"]').length);
                return;
            }

            // Debug: Show slide details
            slideBgs.forEach((slide, idx) => {
                console.log(`Slide ${idx}:`, {
                    classes: slide.className,
                    backgroundImage: getComputedStyle(slide.querySelector('.slide-bg-image') || slide).backgroundImage,
                    opacity: getComputedStyle(slide).opacity
                });
            });

            function showSlideBg(n) {
                if (n >= slideBgs.length) currentSlideBg = 0;
                if (n < 0) currentSlideBg = slideBgs.length - 1;
                
                slideBgs.forEach(slide => slide.classList.remove('active'));
                if (slideBgs[currentSlideBg]) {
                    slideBgs[currentSlideBg].classList.add('active');
                    console.log('✅ Showing slide:', currentSlideBg + 1, 'of', slideBgs.length);
                }
            }

            function autoPlayBg() {
                currentSlideBg++;
                showSlideBg(currentSlideBg);
            }

            function resetAutoPlayBg() {
                if (slideBgInterval) clearInterval(slideBgInterval);
                if (slideBgs.length > 1) {
                    slideBgInterval = setInterval(autoPlayBg, 5000);
                    console.log('⏱️ Auto-play interval set: 5000ms');
                }
            }

            console.log('✅ Slideshow Starting...');
            showSlideBg(currentSlideBg);
            if (slideBgs.length > 1) {
                resetAutoPlayBg();
                console.log('▶️ AUTO-PLAY IS ACTIVE');
            }
            console.log('🎉 Slideshow initialization complete!');
        }

        // Init ketika document ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initHeroSlideshow);
            console.log('⏳ Document loading - waiting for DOMContentLoaded');
        } else {
            console.log('✓ Document already loaded - initializing immediately');
            initHeroSlideshow();
        }
    </script>
    
    <script>
        // --- 1. PREPARE DATA (From Controller) ---
        // Kita gunakan Null Coalescing (??) agar JS tidak error jika data kosong
        const dataKota = <?= $json_kota_asal ?? '{}' ?>;
        const dataKapal = <?= $json_kapal ?? '[]' ?>;
        const dataLokal = <?= $json_lokal ?? '[]' ?>;
        
        const jeparaLoc = <?= $coord_jepara ?? '{"lat":-6.5950,"lng":110.6690}' ?>;
        const karimunLoc = <?= $coord_karimun ?? '{"lat":-5.8465,"lng":110.4371}' ?>;
        
        console.log('Data loaded:', {dataKota, dataKapal, dataLokal, jeparaLoc, karimunLoc});

        // --- 2. INIT MAP ---
        // Batasan map hanya ke Indonesia
        const indonesiaBounds = L.latLngBounds(
            [-10.5, 95],   // Southwest corner (Tenggara)
            [6.5, 141]     // Northeast corner (Barat Laut)
        );
        
        const map = L.map('map', {
            zoomControl: false,
            maxBounds: indonesiaBounds,
            maxBoundsViscosity: 1.0, // Prevent panning outside bounds
            minZoom: 5,  // Minimum zoom level untuk melihat seluruh Indonesia
            maxZoom: 18
        }).setView([-7.0, 110.4], 8);
        
        L.control.zoom({position: 'topright'}).addTo(map);

        // Pakai Tile Layer yang bersih (CartoDB Voyager)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap &copy; CARTO',
            maxZoom: 19
        }).addTo(map);

        // --- 3. ICONS ---
        const iconHome = L.divIcon({className: 'custom-icon', html: '🏠', iconSize: [30, 30]});
        const iconPort = L.divIcon({className: 'custom-icon', html: '⚓', iconSize: [30, 30]});
        const iconIsland = L.divIcon({className: 'custom-icon', html: '🏝️', iconSize: [40, 40]});
        
        // Icon kapal - emoji besar dengan shadow
        const iconShip = L.divIcon({
            html: `<div style="font-size: 50px; filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.5)); transform: scaleX(-1);">🚢</div>`,
            iconSize: [50, 50],
            iconAnchor: [25, 25],
            className: 'ship-icon'
        });

        // Variabel Garis Route & Routing Control
        let routeLine = null;
        let markers = {};
        
        // Fungsi untuk menentukan apakah rute adalah jalur laut
        function isSeaRoute(from, to) {
            // Jepara ke Karimun adalah rute laut
            const jeparaCoords = [jeparaLoc.lat, jeparaLoc.lng];
            const karimunCoords = [karimunLoc.lat, karimunLoc.lng];
            
            const dist1 = Math.hypot(from[0] - karimunCoords[0], from[1] - karimunCoords[1]);
            const dist2 = Math.hypot(to[0] - karimunCoords[0], to[1] - karimunCoords[1]);
            
            return (dist1 < 0.5 && dist2 < 0.5) || (from[0] < -5 && to[0] < -5);
        }
        
        // Fungsi untuk generate rute dengan curve smooth
        function generateRoute(from, to, isSea = false) {
            const points = [from];
            const steps = isSea ? 20 : 15;
            const amplitude = isSea ? 0.4 : 0.15; // Lebih bergelombang di laut
            
            for(let i = 1; i < steps; i++) {
                const t = i / steps;
                const lat = from[0] + (to[0] - from[0]) * t;
                const lng = from[1] + (to[1] - from[1]) * t;
                
                if(isSea) {
                    // Gelombang untuk laut
                    const offsetLng = Math.sin(t * Math.PI * 4) * amplitude;
                    points.push([lat, lng + offsetLng]);
                } else {
                    // Kurva smooth untuk darat
                    const offsetLng = Math.sin(t * Math.PI * 2) * amplitude;
                    points.push([lat, lng + offsetLng]);
                }
            }
            points.push(to);
            return points;
        }

        // --- 4. RENDER TITIK AWAL (KOTA ASAL) ---
        Object.keys(dataKota).forEach(kota => {
            const info = dataKota[kota];
            
            const m = L.marker([info.coords.lat, info.coords.lng], {icon: iconHome}).addTo(map);
            
            // Build Popup Content
            let html = `<div class='popup-header'><span>Start: ${kota}</span> <i class="bi bi-bus-front"></i></div>
                        <div class='popup-body'>`;
            
            if(info.opsi && info.opsi.length > 0){
                html += `<p class="small text-muted mb-2">Pilih Transportasi ke Jepara:</p>`;
                info.opsi.forEach(t => {
                    // Format Rupiah
                    let hargaFmt = new Intl.NumberFormat('id-ID').format(t.price_publish);
                    html += `<button class="btn-pilih" onclick="pilihKota('${kota}', ${info.coords.lat}, ${info.coords.lng}, ${t.price_publish}, '${t.name}')">
                                <span class="info-nama">${t.name}</span>
                                <span class="info-harga">Rp ${hargaFmt}</span>
                             </button>`;
                });
            } else {
                html += `<button class="btn-pilih" onclick="pilihKota('${kota}', ${info.coords.lat}, ${info.coords.lng}, 0, 'Kendaraan Pribadi')">
                            <span class="info-nama">Kendaraan Pribadi</span>
                            <span class="info-harga">Rp 0</span>
                         </button>`;
            }
            html += `</div>`;
            m.bindPopup(html, {className: 'custom-popup'});
            markers[kota] = m;
        });

        // --- 5. LOGIKA INTERAKSI ---

        // STEP 1: USER KLIK KOTA
        window.pilihKota = function(namaKota, lat, lng, harga, namaTransport) {
            console.log('pilihKota called:', namaKota);
            
            // Isi Input
            document.getElementById('input_kota').value = namaKota + " (" + namaTransport + ")";
            document.getElementById('input_harga_darat').value = harga;
            
            // UI Transition
            document.getElementById('step-1').classList.remove('active');
            document.getElementById('step-1').classList.add('done');
            document.getElementById('step-2').classList.add('active');

            // Map Animation
            map.closePopup();
            
            if(routeLine) map.removeLayer(routeLine);
            
            // Generate rute DARAT (tidak perlu OSRM, pakai polyline smooth saja)
            const routePoints = generateRoute([lat, lng], [jeparaLoc.lat, jeparaLoc.lng], false);
            
            // Gambar garis rute darat
            routeLine = L.polyline(routePoints, {
                color: '#0d6efd', 
                weight: 4, 
                opacity: 0.8,
                dashArray: '5, 5',
                lineCap: 'round',
                lineJoin: 'round'
            }).addTo(map);
            console.log('Land route drawn');

            // Munculkan Marker Jepara & FlyTo
            setTimeout(() => {
                const jeparaMarker = L.marker([jeparaLoc.lat, jeparaLoc.lng], {icon: iconPort}).addTo(map);
                jeparaMarker.bindPopup(buatPopupKapal(), {className: 'custom-popup'}).openPopup();
                map.flyTo([jeparaLoc.lat, jeparaLoc.lng], 10, {duration: 1.5});
            }, 500);
        }

        // Generate Popup Kapal
        function buatPopupKapal() {
            let html = `<div class='popup-header'><span>Pelabuhan Kartini</span> <i class="bi bi-water"></i></div>
                        <div class='popup-body'><p class="small text-muted mb-2">Pilih Kapal ke Karimun:</p>`;
            
            if(dataKapal.length > 0){
                dataKapal.forEach(k => {
                    let hargaFmt = new Intl.NumberFormat('id-ID').format(k.price_publish);
                    html += `<button class="btn-pilih" onclick="pilihKapal('${k.name}')">
                                <span class="info-nama">${k.name}</span>
                                <span class="info-harga">Rp ${hargaFmt}</span>
                             </button>`;
                });
            } else {
                html += `<button class="btn-pilih" onclick="pilihKapal('Ferry Siginjai')">Ferry Siginjai (Default)</button>`;
            }
            html += `</div>`;
            return html;
        }

        // STEP 2: USER KLIK KAPAL
        window.pilihKapal = function(namaKapal) {
            console.log('pilihKapal called with:', namaKapal);
            document.getElementById('input_kapal').value = namaKapal;

            // UI Transition
            document.getElementById('step-2').classList.remove('active');
            document.getElementById('step-3').classList.add('active');

            map.closePopup();

            // Rute LAUT dari Jepara ke Karimun dengan garis bergelombang & icon kapal
            const seaRoutePoints = generateSeaRoute([jeparaLoc.lat, jeparaLoc.lng], [karimunLoc.lat, karimunLoc.lng]);
            console.log('Sea route points generated:', seaRoutePoints.length, seaRoutePoints);
            
            // Hapus routing darat jika ada
            if(routingControl) {
                map.removeControl(routingControl);
                routingControl = null;
            }
            if(routeLine) map.removeLayer(routeLine);
            
            // Gambar garis rute laut (warna berbeda & tebal)
            routeLine = L.polyline(seaRoutePoints, {
                color: '#00a8e8', weight: 5, opacity: 0.8, dashArray: '5, 10', lineCap: 'round'
            }).addTo(map);
            console.log('Sea route line drawn');
            
            // Tambah animasi kapal berlayar di tengah rute
            addShipAnimation(seaRoutePoints);

            // Munculkan Marker Karimun & FlyTo
            setTimeout(() => {
                console.log('Adding Karimun markers and attractions');
                const karimunMarker = L.marker([karimunLoc.lat, karimunLoc.lng], {icon: iconIsland}).addTo(map);
                karimunMarker.bindPopup(buatPopupLokal(), {className: 'custom-popup'}).openPopup();
                
                // Zoom in ke Karimunjawa agar terlihat jelas
                map.flyTo([karimunLoc.lat, karimunLoc.lng], 13, {duration: 2});
                
                // Tambahkan area visual untuk Karimunjawa (circle besar agar terlihat)
                const karimunArea = L.circle([karimunLoc.lat, karimunLoc.lng], {
                    radius: 18000, // 18km radius
                    color: '#0099ff',
                    weight: 4,
                    opacity: 0.6,
                    fill: true,
                    fillColor: '#0099ff',
                    fillOpacity: 0.15,
                    dashArray: '8, 5'
                }).addTo(map);
                console.log('Karimun area circle added');
                
                // Label besar Karimunjawa di atas pulau
                const labelIcon = L.divIcon({
                    html: `<div style="background: linear-gradient(135deg, #fff 0%, #f0f8ff 100%); padding: 8px 15px; border-radius: 25px; border: 3px solid #0099ff; font-weight: bold; color: #0066cc; font-size: 13px; text-align: center; white-space: nowrap; box-shadow: 0 4px 12px rgba(0,100,200,0.3);">🏝️ KEPULAUAN<br/>KARIMUNJAWA</div>`,
                    iconSize: [150, 60],
                    iconAnchor: [75, 30],
                    className: 'karimun-label'
                });
                L.marker([karimunLoc.lat - 0.12, karimunLoc.lng + 0.02], {icon: labelIcon}).addTo(map);
                console.log('Karimun label added');
                
                // Tambahkan beberapa lokasi wisata di Karimunjawa dengan marker lebih besar
                const wisataLocations = [
                    {name: '⛱️ Pantai Pasir Putih', coords: [karimunLoc.lat + 0.04, karimunLoc.lng + 0.03]},
                    {name: '🏞️ Pulau Menjangan', coords: [karimunLoc.lat - 0.03, karimunLoc.lng + 0.06]},
                    {name: '🐠 Terumbu Karang', coords: [karimunLoc.lat + 0.02, karimunLoc.lng - 0.05]},
                    {name: '🌊 Pantai Tanjung Gelam', coords: [karimunLoc.lat - 0.06, karimunLoc.lng - 0.03]}
                ];
                
                wisataLocations.forEach(wisata => {
                    const wisataIcon = L.divIcon({
                        html: `<div style="font-size: 24px; filter: drop-shadow(1px 1px 3px rgba(0,0,0,0.5)); background: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border: 2px solid #ff6b35;">${wisata.name.charAt(0)}</div>`,
                        iconSize: [40, 40],
                        iconAnchor: [20, 20],
                        className: 'wisata-marker'
                    });
                    L.marker(wisata.coords, {icon: wisataIcon}).addTo(map).bindPopup(`<b>${wisata.name}</b>`, {className: 'custom-popup'});
                });
                console.log('Wisata attractions added');
            }, 800);
        }
        
        // Fungsi untuk menghasilkan rute laut bergelombang
        function generateSeaRoute(from, to) {
            return generateRoute(from, to, true);
        }
        
        // Fungsi untuk menambahkan animasi kapal
        function addShipAnimation(points) {
            if(points.length < 2) return;
            
            // Buat marker kapal di titik awal
            const shipMarker = L.marker(points[0], {icon: iconShip}).addTo(map);
            shipMarker.bindPopup('🚢 Kapal Berlayar', {className: 'custom-popup'});
            
            // Animasi kapal bergerak mengikuti rute dengan smooth
            let currentIndex = 0;
            const totalDuration = points.length * 200; // Total waktu animasi (ms)
            const startTime = Date.now();
            
            const animateShip = () => {
                const elapsed = Date.now() - startTime;
                const progress = elapsed / totalDuration;
                
                if(progress >= 1) {
                    // Selesai, posisikan di akhir
                    shipMarker.setLatLng(points[points.length - 1]);
                    return;
                }
                
                // Hitung index based on progress
                const index = Math.floor(progress * (points.length - 1));
                const nextIndex = Math.min(index + 1, points.length - 1);
                
                // Interpolasi smooth antara dua titik
                const segmentProgress = (progress * (points.length - 1)) - index;
                const current = points[index];
                const next = points[nextIndex];
                
                const interpolatedLat = current[0] + (next[0] - current[0]) * segmentProgress;
                const interpolatedLng = current[1] + (next[1] - current[1]) * segmentProgress;
                
                shipMarker.setLatLng([interpolatedLat, interpolatedLng]);
                
                // Hitung rotasi kapal mengikuti arah rute
                const bearing = calculateBearing(current, next);
                const shipElement = document.querySelector('.ship-icon svg');
                if(shipElement && shipElement.parentElement) {
                    shipElement.parentElement.style.transform = `rotate(${bearing}deg)`;
                }
                
                requestAnimationFrame(animateShip);
            };
            
            requestAnimationFrame(animateShip);
        }
        
        // Fungsi untuk menghitung arah bearing antara dua titik
        function calculateBearing(from, to) {
            const lat1 = from[0] * Math.PI / 180;
            const lat2 = to[0] * Math.PI / 180;
            const dLon = (to[1] - from[1]) * Math.PI / 180;
            
            const y = Math.sin(dLon) * Math.cos(lat2);
            const x = Math.cos(lat1) * Math.sin(lat2) - Math.sin(lat1) * Math.cos(lat2) * Math.cos(dLon);
            
            const bearing = Math.atan2(y, x) * 180 / Math.PI;
            return (bearing + 360) % 360;
        }

        // Generate Popup Lokal
        function buatPopupLokal() {
            let html = `<div class='popup-header'><span>Welcome to Karimunjawa!</span> <i class="bi bi-scooter"></i></div>
                        <div class='popup-body'><p class="small text-muted mb-2">Sewa Kendaraan?</p>`;
            
            dataLokal.forEach(l => {
                let hargaFmt = new Intl.NumberFormat('id-ID').format(l.price_publish);
                html += `<button class="btn-pilih" onclick="pilihLokal('${l.name}')">
                            <span class="info-nama">${l.name}</span>
                            <span class="info-harga">Rp ${hargaFmt}</span>
                         </button>`;
            });
            html += `<button class="btn-pilih text-muted" onclick="pilihLokal('Jalan Kaki / Tidak Sewa')"><small>Tidak Sewa</small></button>`;
            html += `</div>`;
            return html;
        }

        // STEP 3: USER KLIK LOKAL
        window.pilihLokal = function(nama) {
            document.getElementById('input_lokal').value = nama;
            
            // UI Transition
            document.getElementById('step-3').classList.remove('active');
            document.getElementById('step-4').classList.add('active'); // Buka form detail budget
            
            map.closePopup();
            map.flyTo([karimunLoc.lat, karimunLoc.lng], 13); // Zoom in pulau
        }

    </script>
    
    <div style="height: 100px;"></div> 
    <footer class="text-center py-4 border-top bg-white fixed-bottom" style="z-index: -1;">
        <small class="text-muted" style="font-size: 0.7rem;">&copy; 2027 Dinara Travel System v2.0</small>
    </footer>
    
    <script>
        // Force scroll to top on page load
        if (history.scrollRestoration) {
            history.scrollRestoration = 'manual';
        }
        window.addEventListener('load', function() {
            window.scrollTo(0, 0);
            document.documentElement.scrollTop = 0;
            document.body.scrollTop = 0;
        });
        window.addEventListener('beforeunload', function() {
            window.scrollTo(0, 0);
        });
    </script>
</body>
</html>