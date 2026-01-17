<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $settings['hero_title'] ?? 'Dinara Travel' ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <style>
        body { font-family: 'Google Sans', sans-serif; background: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 50%, #f1f3f5 100%); min-height: 100vh; padding-bottom: 140px; }
        .container-wide { width: 100%; max-width: 96%; margin: 0 auto; padding: 0 15px; }

        /* HEADER */
        .navbar-top { background: linear-gradient(90deg, #0088cc 0%, #0066aa 50%, #004d99 100%); padding: 12px 0; box-shadow: 0 4px 15px rgba(0,68,130,0.25); position: sticky; top: 0; z-index: 999; }
        .navbar-top .navbar-brand { display: flex; align-items: center; gap: 12px; font-weight: 700; color: #fff !important; font-size: 1.3rem; text-decoration: none; }
        .navbar-top .navbar-brand img { height: 50px; width: auto; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2)); }
        .navbar-top .navbar-brand span { color: #fff; text-shadow: 0 2px 4px rgba(0,0,0,0.2); }
        
        .weather-widget { display: flex; align-items: center; gap: 12px; background: rgba(255,255,255,0.15); padding: 6px 15px; border-radius: 25px; color: #fff; font-size: 0.85rem; font-weight: 600; max-width: 400px; overflow: hidden; }
        .weather-icon { font-size: 1.3rem; flex-shrink: 0; }
        .running-text { flex: 1; overflow: hidden; }
        .running-text-content { white-space: nowrap; animation: scroll-text 20s linear infinite; display: inline-block; }
        @keyframes scroll-text { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }
        
        /* Welcome Header Text */
        .welcome-header { 
            background: linear-gradient(135deg, rgba(255,215,0,0.9) 0%, rgba(255,193,7,0.9) 100%); 
            padding: 8px 20px; 
            border-radius: 25px; 
            color: #1a1a2e; 
            font-weight: 700; 
            font-size: 0.9rem;
            box-shadow: 0 4px 15px rgba(255,193,7,0.3);
            animation: pulse-welcome 2s ease-in-out infinite;
        }
        @keyframes pulse-welcome {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }
        
        /* HERO SECTION - TIKET.COM STYLE */
        .hero-section { 
            position: relative; 
            background: linear-gradient(135deg, #0088cc 0%, #0055aa 100%); 
            background-size: cover; 
            background-position: center; 
            min-height: 480px; 
            color: white; 
            padding: 80px 0 180px 0; 
            border-radius: 0; 
            display: flex; 
            flex-direction: column;
            align-items: center; 
            justify-content: flex-start; 
            text-align: center; 
            margin-bottom: 0; 
            width: 100%; 
        }
        .hero-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.25) 100%); }
        .hero-content { position: relative; z-index: 2; width: 100%; padding: 0 20px; margin-bottom: 40px; }
        .hero-title { font-size: 2.8rem; font-weight: 700; text-shadow: 0 2px 8px rgba(0,0,0,0.3); margin-bottom: 10px; }
        .hero-subtitle { font-size: 1.1rem; font-weight: 500; opacity: 0.95; }
        
        /* SEARCH FORM INSIDE HERO - TIKET.COM STYLE */
        .hero-search-form {
            position: absolute;
            bottom: -80px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 1100px;
            z-index: 100;
        }
        .hero-spacer {
            height: 100px;
        }
        .search-card-tiket {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 20px;
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.12);
            padding: 25px 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.6);
        }
        .search-card-tiket .input-box {
            background: rgba(245, 247, 250, 0.7);
            border: 1px solid rgba(200, 210, 230, 0.4);
            border-radius: 12px;
            padding: 10px 14px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            backdrop-filter: blur(10px);
        }
        .search-card-tiket .input-box:hover {
            border-color: rgba(13, 110, 253, 0.4);
            background: rgba(240, 247, 255, 0.8);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15);
        }
        .search-card-tiket .input-box:focus-within {
            border-color: rgba(13, 110, 253, 0.6);
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
            background: rgba(255, 255, 255, 0.9);
        }
        .search-card-tiket .input-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }
        .search-card-tiket .input-value {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1a1a2e;
        }
        .search-card-tiket .form-control, 
        .search-card-tiket .form-select {
            border: none;
            background: transparent;
            padding: 0;
            font-size: 0.95rem;
            font-weight: 700;
            color: #1a1a2e;
            height: auto;
        }
        .search-card-tiket .form-control:focus, 
        .search-card-tiket .form-select:focus {
            box-shadow: none;
            outline: none;
        }
        .btn-search-tiket {
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.9) 0%, rgba(0, 153, 255, 0.9) 100%);
            border: 1px solid rgba(13, 110, 253, 0.3);
            color: white;
            font-weight: 700;
            font-size: 1rem;
            padding: 15px 30px;
            border-radius: 12px;
            height: 60px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 24px rgba(13, 110, 253, 0.35);
            backdrop-filter: blur(10px);
        }
        .btn-search-tiket:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(13, 110, 253, 0.45);
            background: linear-gradient(135deg, rgba(0, 153, 255, 0.95) 0%, rgba(13, 110, 253, 0.95) 100%);
        }
        
        /* NAVIGATION TABS - TIKET.COM STYLE - SEPARATE CONTAINER */
        .nav-tabs-tiket {
            display: flex;
            gap: 6px;
            margin-bottom: 0;
            padding: 12px 18px;
            border-bottom: none;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            z-index: 101;
            transform: translateY(21px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .nav-tabs-tiket::-webkit-scrollbar { display: none; }
        .nav-tab-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 7px 12px;
            border-radius: 50px;
            background: rgba(240, 245, 250, 0.6);
            color: #4a5568;
            font-weight: 600;
            font-size: 0.75rem;
            white-space: nowrap;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            border: 1.5px solid rgba(200, 210, 230, 0.4);
            backdrop-filter: blur(10px);
        }
        .nav-tab-item i {
            font-size: 0.8rem;
        }
        .nav-tab-item:hover {
            background: rgba(227, 242, 253, 0.8);
            color: #0d6efd;
            border-color: rgba(13, 110, 253, 0.3);
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15);
        }
        .nav-tab-item.active {
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.9) 0%, rgba(0, 153, 255, 0.9) 100%);
            color: white;
            box-shadow: 0 8px 24px rgba(13, 110, 253, 0.4);
            border-color: rgba(13, 110, 253, 0.5);
            backdrop-filter: blur(20px);
        }
        .nav-tab-item.active:hover {
            background: linear-gradient(135deg, rgba(0, 153, 255, 0.95) 0%, rgba(13, 110, 253, 0.95) 100%);
            color: white;
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-4px);
        }
        .nav-tab-badge {
            background: #ff5252;
            color: white;
            font-size: 0.65rem;
            padding: 2px 6px;
            border-radius: 10px;
            font-weight: 700;
            margin-left: 4px;
        }
        
        /* PROMO SECTION STYLES */
        .promo-section {
            padding: 15px 0 50px 0;
        }
        .promo-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
        }
        .promo-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        .promo-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .promo-card-body {
            padding: 20px;
        }
        .promo-badge {
            display: inline-block;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .promo-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #1a1a2e;
            margin-bottom: 8px;
        }
        .promo-desc {
            color: #6c757d;
            font-size: 0.85rem;
            line-height: 1.6;
        }
        .promo-price {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-top: 15px;
        }
        .promo-price-old {
            text-decoration: line-through;
            color: #adb5bd;
            font-size: 0.85rem;
        }
        .promo-price-new {
            font-size: 1.3rem;
            font-weight: 800;
            color: #0d6efd;
        }
        .promo-cta {
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 700;
            width: 100%;
            margin-top: 15px;
            transition: all 0.3s ease;
        }
        .promo-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13,110,253,0.4);
        }
        
        /* QUICK ACTION BUTTONS - MINIMAL 2027 STYLE */
        .quick-action-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        @media (max-width: 768px) {
            .quick-action-grid {
                gap: 16px;
            }
        }
        .quick-action-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            background: transparent;
            border: none;
        }
        .quick-action-card:hover {
            transform: translateY(-4px);
        }
        .quick-action-card:hover .quick-action-icon i {
            transform: scale(1.15);
        }
        .quick-action-icon {
            margin-bottom: 6px;
            transition: all 0.3s ease;
        }
        .quick-action-icon i {
            font-size: 1.6rem;
            transition: all 0.3s ease;
        }
        .quick-action-icon.calculator i { color: #667eea; }
        .quick-action-icon.whatsapp i { color: #25D366; }
        .quick-action-icon.hotel i { color: #f5576c; }
        .quick-action-icon.destination i { color: #4facfe; }
        .quick-action-card:hover .quick-action-icon.calculator i { color: #764ba2; }
        .quick-action-card:hover .quick-action-icon.whatsapp i { color: #128C7E; }
        .quick-action-card:hover .quick-action-icon.hotel i { color: #f093fb; }
        .quick-action-card:hover .quick-action-icon.destination i { color: #00f2fe; }
        .quick-action-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #64748b;
            text-align: center;
            transition: all 0.3s ease;
        }
        .quick-action-card:hover .quick-action-label {
            color: #1e293b;
        }
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
        
        /* KARIMUNJAWA INFO SECTION */
        .karimunjawa-info-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 25px rgba(0,0,0,0.08);
        }
        .badge-info-km {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            color: #0369a1;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .km-photo-grid {
            display: flex;
            gap: 12px;
            height: 250px;
        }
        .km-photo-main {
            flex: 2;
            border-radius: 16px;
            object-fit: cover;
            width: 60%;
            height: 100%;
        }
        .km-photo-stack {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .km-photo-stack img {
            flex: 1;
            border-radius: 12px;
            object-fit: cover;
            width: 100%;
        }
        
        /* READ MORE BUTTON STYLING */
        .about-karimunjawa-container {
            position: relative;
        }
        .about-text-preview,
        .about-text-full {
            line-height: 1.6;
            margin: 0;
            transition: max-height 0.3s ease, opacity 0.3s ease;
        }
        .btn-read-more {
            color: #0369a1;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 4px 0 !important;
        }
        .btn-read-more:hover {
            color: #0284c7;
            transform: translateX(4px);
        }
        .btn-read-more i {
            transition: transform 0.3s ease;
        }
        .btn-read-more.expanded i {
            transform: rotate(180deg);
        }
        
        /* INFO CARDS */
        .info-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            display: flex;
            gap: 15px;
            height: 100%;
            transition: all 0.3s ease;
        }
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        }
        .info-card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .info-card-icon i {
            font-size: 1.4rem;
            color: white;
        }
        .info-card-content h6 {
            font-weight: 700;
            margin-bottom: 5px;
            color: #1a1a2e;
        }
        .info-card-content p {
            color: #6c757d;
            line-height: 1.5;
        }
        
        /* FLYER PROMO SLIDER */
        .flyer-slider-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
        }
        .flyer-scroll {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding-bottom: 10px;
            scrollbar-width: thin;
        }
        .flyer-scroll::-webkit-scrollbar {
            height: 6px;
        }
        .flyer-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        .flyer-item {
            flex: 0 0 280px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .flyer-item:hover {
            transform: scale(1.03);
        }
        .flyer-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        
        /* GALLERY SECTION */
        .gallery-section {
            margin-bottom: 30px;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }
        .gallery-item {
            aspect-ratio: 1;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        .gallery-item::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .gallery-item:hover::after {
            opacity: 1;
        }
        
        .promo-hero-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 40px;
            color: white;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }
        .promo-hero-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        .promo-hero-banner h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }
        .promo-hero-banner p {
            font-size: 1.1rem;
            opacity: 0.95;
            position: relative;
            z-index: 2;
        }
        .promo-features {
            display: flex;
            gap: 30px;
            margin-top: 25px;
            position: relative;
            z-index: 2;
        }
        .promo-feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .promo-feature-item i {
            font-size: 1.5rem;
        }
        .section-hidden { display: none; }
        .section-visible { display: block; }

        /* SEARCH WIDGET */
        .search-widget { 
            background: rgba(255,255,255,0.95); 
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 16px; 
            padding: 12px 16px; 
            position: relative; 
            z-index: 20; 
            width: auto;
            max-width: 1300px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin: 0 auto;
        }
        
        .search-widget .row {
            gap: 6px !important;
            margin: 0;
        }
        
        .search-widget .col-lg-2 {
            flex: 0 0 auto;
            width: 26%;
        }
        
        .search-widget .col-lg-1 {
            flex: 0 0 auto;
            width: 6%;
            min-width: 60px;
        }
        
        .search-widget .col-lg-2:last-child {
            flex: 0 0 auto;
            width: 12%;
            min-width: 110px;
        }
        
        .search-widget [class*='col-'] {
            padding: 0 2px;
        }
        
        /* FORM */
        input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        .form-label-custom { font-weight: 700; color: #333; font-size: 0.6rem; margin-bottom: 2px; text-transform: uppercase; letter-spacing: 0.2px; line-height: 1; }
        .input-group { background: #f8f9fa; border: 1px solid #ddd; border-radius: 6px; height: 34px; }
        .input-group-text { background: transparent; border: none; color: #666; font-size: 0.7rem; padding: 0 4px; }
        .form-control, .form-select { background: transparent !important; border: none; color: #333 !important; font-weight: 500; height: 32px; font-size: 0.7rem; box-shadow: none !important; padding: 3px 4px; }
        .select2-container--bootstrap-5 .select2-selection { background: #f8f9fa !important; border: 1px solid #ddd !important; color: #333 !important; height: 34px; padding-top: 1px; border-radius: 6px; font-size: 0.7rem; }
        .select2-dropdown { background: #fff !important; border: 1px solid #ddd; color: #333; }
        .select2-search__field { background: #f8f9fa !important; color: #333 !important; border: none !important; font-size: 0.7rem; }
        
        .btn-magic { background: linear-gradient(135deg, #0088cc, #005f8d); border: none; color: #fff; font-weight: 700; width: 100%; padding: 8px 12px; height: 40px; border-radius: 6px; transition: 0.3s; font-size: 0.85rem; display: flex; align-items: center; justify-content: center; gap: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .btn-magic:hover { transform: translateY(-2px); box-shadow: 0 8px 15px rgba(0,136,204,0.4); }

        /* ============================================ */
        /* CSS UNTUK VIBE ELEGAN 2025 */
        /* ============================================ */

        /* CUSTOM TIGHT SPACING - PRESISI 5MM ANTAR KOLOM */
        .container-tight {
            padding-left: 20px;
            padding-right: 20px;
        }

        .row-tight {
            gap: 0px !important;
            display: flex;
            flex-wrap: nowrap;
        }

        .col-tight-left, .col-tight-right {
            flex: 1 1 48%;
            padding-left: 2px;
            padding-right: 2px;
        }

        /* Hilangkan margin pada card agar rapat */
        .card-tight {
            margin-bottom: 1px !important;
        }

        /* Label dengan letter spacing agar terlihat premium */
        .ls-1 {
            letter-spacing: 1px;
            font-size: 0.75rem;
        }

        /* Mengubah style Input Group standar Bootstrap */
        .input-group-2025 {
            border: 1px solid #e0e0e0;
            border-radius: 50rem !important;
            padding: 0.2rem 0.3rem;
            background: white;
            transition: all 0.3s ease;
        }

        /* Efek saat input diklik */
        .input-group-2025:focus-within {
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        }

        /* Menghilangkan border bawaan form-control dan input-group-text */
        .input-group-2025 .form-control,
        .input-group-2025 .input-group-text,
        .input-group-2025 .form-select {
            border: none;
            background: transparent;
        }

        .input-group-2025 .input-group-text {
            padding-right: 5px;
        }

        /* Input Duration dibuat sedikit berbeda agar terlihat 'fixed' */
        .input-group-2025.bg-light-subtle {
            background-color: #f8f9fa;
            border-color: transparent;
        }

        /* Tombol Gradien Modern */
        .btn-gradient-2025 {
            background: linear-gradient(45deg, #005bea, #00c6fb);
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: calc(3.5rem + 2px);
            transition: all 0.3s ease;
        }

        .btn-gradient-2025:hover {
            background: linear-gradient(45deg, #00c6fb, #005bea);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 198, 251, 0.4) !important;
            color: white;
        }

        /* ============================================ */
        /* HOTEL CARD 2027 - MODERN ELEGANT SQUARE DESIGN - COMPACT */
        /* ============================================ */
        .hotel-card-2027 {
            background: #ffffff;
            border: 1.5px solid transparent;
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            cursor: pointer;
            position: relative;
            aspect-ratio: 1 / 1;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .hotel-img-wrapper {
            width: 100%;
            height: 72%;
            overflow: hidden;
            position: relative;
            background: #f5f5f5;
        }

        .hotel-img-wrapper::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0);
            backdrop-filter: blur(0px);
            z-index: 4;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .hotel-radio:checked + .hotel-card-2027 .hotel-img-wrapper::after {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(5px);
        }

        .checkmark-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
            opacity: 0;
            transform: translate(-50%, -50%) scale(0);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.4);
        }

        .checkmark-overlay i {
            color: white;
            font-size: 1.5rem;
            font-weight: 900;
        }

        .hotel-radio:checked + .hotel-card-2027 .checkmark-overlay {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }

        .gallery-icon-overlay {
            position: absolute;
            bottom: 4px;
            right: 4px;
            width: 24px;
            height: 24px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
            z-index: 3;
            transition: all 0.25s ease;
        }

        .gallery-icon-overlay i {
            color: #0d6efd;
            font-size: 0.75rem;
        }

        .hotel-card-2027:hover .gallery-icon-overlay {
            transform: scale(1.15);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
        }

        .hotel-img-2027 {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .hotel-card-2027:hover .hotel-img-2027 {
            transform: scale(1.12);
        }

        .price-badge-2027 {
            position: absolute;
            top: 6px;
            right: 6px;
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            padding: 3px 8px;
            border-radius: 12px;
            font-weight: 700;
            color: #ffffff;
            font-size: 0.6rem;
            box-shadow: 0 3px 10px rgba(13, 110, 253, 0.3);
            z-index: 2;
            letter-spacing: 0px;
            white-space: nowrap;
        }

        .select-indicator {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid #e8e8e8;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            background: #f9f9f9;
            flex-shrink: 0;
        }

        .select-indicator i {
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            color: white;
            font-size: 0.65rem;
        }

        .hotel-radio:checked + .hotel-card-2027 {
            border-color: #0d6efd;
            box-shadow: 0 10px 28px rgba(13, 110, 253, 0.2);
            transform: translateY(-4px);
        }

        .hotel-radio:checked + .hotel-card-2027 .select-indicator {
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            border-color: #0d6efd;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.35);
        }

        .hotel-radio:checked + .hotel-card-2027 .select-indicator i {
            opacity: 1;
            transform: scale(1);
        }

        .hotel-info-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 6px 3px 5px 3px;
            background: #ffffff;
        }

        .hotel-card-2027 h6 {
            margin: 0;
            font-size: 0.68rem;
            font-weight: 700;
            color: #1a1a1a;
            letter-spacing: -0.2px;
            line-height: 1.2;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-align: center;
        }


        /* ============================================ */
        /* HOTEL CAROUSEL */
        /* ============================================ */
        .hotel-carousel-container {
            position: relative;
            overflow: hidden;
        }

        .hotel-carousel {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .hotel-slide {
            min-width: 100%;
            display: none;
            animation: slideIn 0.5s ease-out;
        }

        .hotel-slide.active {
            display: block;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hotel-carousel-nav {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .carousel-counter {
            font-weight: 700;
            color: #666;
            font-size: 0.85rem;
        }

        .hotel-carousel-nav .btn {
            transition: all 0.3s;
            min-width: 100px;
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .hotel-carousel-nav .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.2);
        }
        }

        /* INFO ICON STYLING - ELEGANT */
        .info-icon {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 28px !important;
            height: 28px !important;
            min-width: 28px !important;
            border-radius: 50% !important;
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%) !important;
            color: white !important;
            font-weight: 900 !important;
            font-size: 1.15rem !important;
            cursor: pointer !important;
            transition: all 0.25s ease !important;
            box-shadow: 0 3px 10px rgba(13, 110, 253, 0.4) !important;
            flex-shrink: 0 !important;
            user-select: none !important;
            line-height: 1 !important;
            padding: 0 !important;
            border: none !important;
            margin-left: 4px !important;
        }

        /* FASILITAS CAROUSEL */
        .fasilitas-carousel-container {
            position: relative;
            overflow: hidden;
        }

        .fasilitas-carousel {
            display: flex;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .fasilitas-slides-wrapper {
            display: flex;
            width: 100%;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            gap: 8px;
        }
        .fasilitas-slide {
            min-width: 100%;
            display: flex;
            gap: 8px;
        }
        .fasilitas-card {
            flex: 1 1 0;
            min-width: 120px;
            max-width: 160px;
            background: #f9fafb;
            border: 1.5px solid #e8eef7;
            border-radius: 10px;
            padding: 8px 6px 6px 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.78rem;
            box-shadow: 0 2px 8px rgba(13,110,253,0.04);
        }
        .fasilitas-card.selected {
            border-color: #198754;
            background: rgba(25,135,84,0.07);
        }
        .fasilitas-card .form-check-input {
            width: 15px;
            height: 15px;
            margin-bottom: 2px;
        }
        .fasilitas-card .form-check-label {
            font-size: 0.78rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
            text-align: center;
        }
        .fasilitas-card .fasilitas-price {
            font-size: 0.72rem;
            color: #059669;
            font-weight: 700;
            margin-top: 2px;
        }
        @media (max-width: 900px) {
            .fasilitas-card { min-width: 100px; max-width: 120px; font-size: 0.7rem; }
        }
        @media (max-width: 600px) {
            .fasilitas-card { min-width: 90px; max-width: 100px; font-size: 0.65rem; }
        }

        .fasilitas-carousel-nav {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 8px;
        }

        .fasilitas-carousel-nav .btn {
            border-color: #d0d0d0 !important;
            color: #0d6efd !important;
            transition: all 0.2s ease;
        }

        .fasilitas-carousel-nav .btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .fasilitas-carousel-nav .btn:not(:disabled):hover {
            background: #0d6efd !important;
            color: white !important;
            border-color: #0d6efd !important;
        }

        .info-icon:hover {
            transform: scale(1.35) !important;
            box-shadow: 0 6px 16px rgba(13, 110, 253, 0.6) !important;
            background: linear-gradient(135deg, #0099ff 0%, #0066ff 100%) !important;
        }

        .info-icon:active {
            transform: scale(1.15);
        }

        .info-icon.active {
            background: linear-gradient(135deg, #0080dd 0%, #0066cc 100%);
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.6), inset 0 -2px 4px rgba(0, 0, 0, 0.15);
            animation: pulse-info 0.5s ease-out;
        }

        @keyframes pulse-info {
            0% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.7); }
            70% { box-shadow: 0 0 0 8px rgba(13, 110, 253, 0); }
            100% { box-shadow: 0 8px 20px rgba(13, 110, 253, 0.6), inset 0 -2px 4px rgba(0, 0, 0, 0.15); }
        }

        /* INFO POPOVER STYLING */
        .popover {
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.98);
        }

        .popover-header {
            background: linear-gradient(135deg, #0d6efd, #0099ff);
            color: white;
            border: none;
            border-radius: 12px 12px 0 0;
            padding: 12px 16px;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .popover-body {
            padding: 14px 16px;
            color: #555;
            font-size: 0.9rem;
            line-height: 1.6;
            border-radius: 0 0 12px 12px;
        }

        /* Tombol Galeri Overlay */
        .btn-gallery-overlay {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 50px;
            padding: 6px 12px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 5;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-gallery-overlay:hover {
            background: rgba(255, 255, 255, 0.95);
            color: #000;
            transform: scale(1.05);
        }

        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        /* MAP & ICONS */
        #map { height: 255px; width: 100%; border-radius: 15px; border: 1px solid #ddd; z-index: 1; }
        .ship-icon-div { font-size: 30px; color: #0dcaf0; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); animation: rock-boat 2s infinite ease-in-out; }
        @keyframes rock-boat { 0% { transform: rotate(-5deg); } 50% { transform: rotate(5deg) translateY(-3px); } 100% { transform: rotate(-5deg); } }

        /* CARDS */
        .sticky-column { 
            position: static; 
            z-index: 90;
            padding-right: 0;
        }
        .sticky-column::-webkit-scrollbar {
            width: 5px;
        }
        .sticky-column::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .sticky-column::-webkit-scrollbar-thumb {
            background: #d0d0d0;
            border-radius: 10px;
        }
        .sticky-column::-webkit-scrollbar-thumb:hover {
            background: #888;
        }
        
        /* Scrollbar untuk container estimasi dan wisata */
        .card::-webkit-scrollbar, .wisata-2027-card::-webkit-scrollbar {
            width: 4px;
        }
        .card::-webkit-scrollbar-track, .wisata-2027-card::-webkit-scrollbar-track {
            background: #f8f9fa;
            border-radius: 10px;
        }
        .card::-webkit-scrollbar-thumb, .wisata-2027-card::-webkit-scrollbar-thumb {
            background: #d0d0d0;
            border-radius: 10px;
        }
        .card::-webkit-scrollbar-thumb:hover, .wisata-2027-card::-webkit-scrollbar-thumb:hover {
            background: #0d6efd;
        }
        
        .hotel-card { border: 1px solid #eee; border-radius: 10px; overflow: hidden; transition: 0.3s; cursor: pointer; background: #fff; }
        .hotel-card.selected { border: 2px solid #198754; background: #f0fff4; }
        .budget-box-elegant { background: linear-gradient(135deg, #1e3c72, #2a5298); border-radius: 15px; padding: 10px; color: white; }
        .form-control-budget { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: #FFD700 !important; font-size: 0.9rem; font-weight: 800; text-align: right; }
        
        /* FLOATING TOTAL WIDGET - ELEGANT 2027 */
        .floating-total-widget {
            position: fixed;
            bottom: 14px;
            right: 14px;
            z-index: 1040;
            display: none;
        }
        .floating-total-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 14px;
            padding: 8px 12px 10px 12px;
            box-shadow: 0 4px 18px rgba(102, 126, 234, 0.18), 0 1px 4px rgba(0,0,0,0.08);
            min-width: 140px;
            max-width: 220px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            border: 1px solid rgba(255,255,255,0.12);
        }
        .floating-total-card:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.22), 0 2px 8px rgba(0,0,0,0.10);
        }
        .floating-total-header {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 4px;
        }
        .floating-total-icon {
            width: 26px;
            height: 26px;
            background: rgba(255,255,255,0.18);
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .floating-total-icon i {
            font-size: 0.95rem;
            color: white;
        }
        .floating-total-label {
            font-size: 0.62rem;
            color: rgba(255,255,255,0.8);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }
        .floating-total-amount {
            font-size: 1.08rem;
            font-weight: 800;
            color: white;
            text-shadow: 0 1px 2px rgba(0,0,0,0.13);
            line-height: 1.1;
        }
        .floating-total-pax {
            font-size: 0.62rem;
            color: rgba(255,255,255,0.7);
            margin-top: 2px;
        }
        .floating-total-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            background: white;
            color: #764ba2;
            border: none;
            border-radius: 8px;
            padding: 7px 10px;
            font-size: 0.72rem;
            font-weight: 700;
            margin-top: 8px;
            width: 100%;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.10);
        }
        .floating-total-btn:hover {
            background: #f0f0f0;
            transform: scale(1.03);
        }
        .floating-total-btn i {
            font-size: 0.92rem;
        }
        /* Pulse animation for total updates */
        @keyframes pulse-total {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .floating-total-card.pulse {
            animation: pulse-total 0.3s ease;
        }
        /* Mobile responsive */
        @media (max-width: 768px) {
            .floating-total-widget {
                bottom: 8px;
                right: 8px;
                left: 8px;
            }
            .floating-total-card {
                min-width: auto;
                width: 100%;
                padding: 7px 8px 8px 8px;
            }
        }
        
        /* Modal z-index fix - ensure modals appear above sticky elements */
        .modal-backdrop { z-index: 1050 !important; }
        .modal { z-index: 1055 !important; }
        #modalJadwalKapal { z-index: 1060 !important; }
        #modalJadwalKapal .modal-dialog { z-index: 1061 !important; }
        #modalJadwalKapal .modal-content { 
            z-index: 1062 !important; 
            background-color: #ffffff !important;
            position: relative !important;
        }
        
        /* ITINERARY TIMELINE */
        .itinerary-section { margin-top: 50px; padding: 40px 0; background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(111, 66, 193, 0.05) 100%); }
        .itinerary-title { font-size: 2rem; font-weight: 900; margin-bottom: 30px; color: #2c3e50; text-align: center; }
        .itinerary-timeline { position: relative; padding: 20px 0; }
        .itinerary-day { margin-bottom: 40px; }
        .itinerary-day-header { background: linear-gradient(135deg, #0d6efd, #6f42c1); color: white; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; font-weight: 700; }
        .itinerary-item { display: flex; gap: 20px; margin-bottom: 15px; padding: 15px; background: white; border-left: 4px solid #0d6efd; border-radius: 5px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .itinerary-icon { font-size: 2rem; flex-shrink: 0; width: 50px; text-align: center; }
        .itinerary-content { flex-grow: 1; }
        .itinerary-time { font-size: 0.85rem; color: #666; font-weight: 600; margin-bottom: 5px; }
        .itinerary-activity { font-weight: 700; color: #2c3e50; margin-bottom: 5px; }
        .itinerary-description { font-size: 0.9rem; color: #555; line-height: 1.5; }
        .itinerary-location { font-size: 0.85rem; color: #0d6efd; margin-top: 8px; }
        
        .leaflet-routing-container { display: none !important; }
        
        /* ========== ANNOUNCEMENT BANNER ========== */
        .announcement-banner {
            background: linear-gradient(135deg, #e3f2fd 0%, #f0f7ff 50%, #e0f2fe 100%);
            padding: 16px 0;
            border-top: 1px solid rgba(13, 110, 253, 0.2);
            border-bottom: 1px solid rgba(13, 110, 253, 0.2);
            margin-bottom: 30px;
        }

        .announcement-content {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 0 15px;
        }

        .announcement-icon {
            font-size: 1.4rem;
            color: #0d6efd;
            flex-shrink: 0;
        }

        .announcement-text {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .announcement-title {
            color: #1a1a2e;
            font-size: 0.9rem;
            font-weight: 500;
            line-height: 1.4;
        }

        .announcement-link {
            color: #0d6efd;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.3s ease;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .announcement-link:hover {
            color: white;
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            text-decoration: none;
        }

        /* ========== PROFESSIONAL FOOTER ========== */
        /* ============================================ */
        /* MODERN LUXURY FOOTER 2027 STYLING */
        /* ============================================ */

        .modern-luxury-footer {
            background: linear-gradient(180deg, #0f172a 0%, #1a1f3a 30%, #16213e 70%, #0f3460 100%);
            color: #d0d5dd;
            position: relative;
            overflow: hidden;
        }

        .modern-luxury-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(13, 110, 253, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(100, 200, 255, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .footer-top-section {
            position: relative;
            z-index: 2;
            padding: 60px 0 40px 0;
        }

        .footer-content-grid {
            display: grid;
            grid-template-columns: 1fr 2.5fr;
            gap: 60px;
            align-items: start;
        }

        /* -------- LEFT COLUMN: BRAND -------- */
        .footer-brand-column {
            position: relative;
        }

        .brand-showcase {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .brand-logo-wrapper {
            position: relative;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.15) 0%, rgba(100, 200, 255, 0.08) 100%);
            border: 1px solid rgba(13, 110, 253, 0.3);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            overflow: hidden;
        }

        .brand-logo {
            max-width: 50px;
            max-height: 50px;
            object-fit: contain;
            filter: brightness(1.1);
        }

        .brand-info h3 {
            font-size: 1.4rem;
            font-weight: 700;
            color: white;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .brand-tagline {
            font-size: 0.8rem;
            color: #0d6efd;
            margin: 4px 0 0 0;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .brand-description {
            font-size: 0.95rem;
            line-height: 1.7;
            color: #a0a8b8;
            margin-bottom: 32px;
        }

        /* SOCIAL MEDIA SECTION */
        .social-media-section {
            margin-top: 32px;
        }

        .social-heading {
            font-size: 0.85rem;
            font-weight: 600;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
        }

        .social-icons-modern {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .social-icon-modern {
            position: relative;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            text-decoration: none;
            color: white;
            font-size: 1.2rem;
            background: rgba(255, 255, 255, 0.08);
            border: 1.5px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .social-icon-modern::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.5), rgba(100, 200, 255, 0.5));
            opacity: 0;
            transition: opacity 0.4s ease;
            border-radius: 10px;
            z-index: -1;
        }

        .social-icon-modern:hover::before {
            opacity: 1;
        }

        .social-icon-modern:hover {
            color: white;
            border-color: rgba(100, 200, 255, 0.5);
            transform: translateY(-6px) scale(1.05);
            box-shadow: 0 12px 30px rgba(13, 110, 253, 0.3);
        }

        .social-tooltip {
            position: absolute;
            bottom: -28px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .social-icon-modern:hover .social-tooltip {
            opacity: 1;
        }

        /* -------- RIGHT COLUMNS: INFO -------- */
        .footer-info-columns {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }

        .footer-info-column {
            position: relative;
        }

        .column-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid rgba(13, 110, 253, 0.3);
        }

        .column-header i {
            font-size: 1.3rem;
            color: #0d6efd;
        }

        .column-header h4 {
            font-size: 1.05rem;
            font-weight: 700;
            color: white;
            margin: 0;
            letter-spacing: -0.3px;
        }

        /* CONTACT ITEMS */
        .contact-items {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            background: rgba(13, 110, 253, 0.1);
            border-color: rgba(13, 110, 253, 0.3);
        }

        .contact-item i {
            font-size: 1.1rem;
            color: #0d6efd;
            min-width: 20px;
            margin-top: 2px;
        }

        .contact-detail {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .contact-label {
            font-size: 0.75rem;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 600;
        }

        .contact-value {
            font-size: 0.95rem;
            color: #d0d5dd;
            line-height: 1.5;
        }

        .contact-value a {
            color: #0d6efd;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-value a:hover {
            color: #0099ff;
        }

        /* FOOTER LINKS */
        .footer-link-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .footer-link-list li a {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #a0a8b8;
            text-decoration: none;
            font-size: 0.95rem;
            padding: 8px 0;
            border-left: 3px solid transparent;
            padding-left: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .footer-link-list li a i {
            font-size: 0.85rem;
            color: #0d6efd;
            transition: color 0.3s ease;
        }

        .footer-link-list li a:hover {
            color: white;
            border-left-color: #0d6efd;
            padding-left: 16px;
        }

        .footer-link-list li a:hover i {
            color: #0099ff;
        }

        /* -------- FOOTER DIVIDER -------- */
        .footer-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            position: relative;
            z-index: 2;
        }

        /* -------- FOOTER BOTTOM -------- */
        .footer-bottom-section {
            position: relative;
            z-index: 2;
            padding: 30px 0;
        }

        .footer-bottom-content {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 30px;
            align-items: center;
            font-size: 0.85rem;
        }

        .footer-copyright p {
            color: #7a8091;
            margin: 0;
            line-height: 1.6;
        }

        .footer-copyright p strong {
            color: white;
        }

        .footer-developer-credits p {
            color: #7a8091;
            margin: 0;
        }

        .footer-developer-credits a {
            color: #0d6efd;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-developer-credits a:hover {
            color: #0099ff;
            text-decoration: underline;
        }

        /* -------- BACK TO TOP BUTTON -------- */
        .back-to-top-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            color: white;
            border-radius: 12px;
            text-decoration: none;
            opacity: 0;
            pointer-events: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
            z-index: 1000;
        }

        .back-to-top-btn.visible {
            opacity: 1;
            pointer-events: auto;
        }

        .back-to-top-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(13, 110, 253, 0.4);
        }

        .back-to-top-btn i {
            font-size: 1.3rem;
        }

        /* ============================================ */
        /* SUPPORT WIDGET BANNER POPUP 2027 */
        /* ============================================ */

        /* ============================================ */
        /* SUPPORT WIDGET BANNER POPUP - MODERN 2027 */
        /* ============================================ */

        .support-banner-popup {
            position: fixed;
            bottom: 100px;
            right: 30px;
            z-index: 1000;
            animation: slideUpBanner 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideUpBanner {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .support-banner-card {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.95) 0%, rgba(5, 150, 105, 0.95) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 20px;
            width: 340px;
            box-shadow: 0 20px 50px rgba(16, 185, 129, 0.3);
            position: relative;
        }

        .support-banner-close-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 18px;
        }

        .support-banner-close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .support-banner-top {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .support-banner-emoji {
            font-size: 32px;
            display: flex;
            align-items: center;
        }

        .support-banner-title {
            color: white;
            font-size: 16px;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .support-banner-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
            margin: 0 0 14px 0;
            line-height: 1.5;
        }

        .support-banner-cta-wrapper {
            display: flex;
            gap: 8px;
        }

        .support-banner-cta {
            flex: 1;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .support-banner-cta:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        .support-banner-popup.hide {
            display: none;
        }

        /* ============================================ */
        /* SUPPORT WIDGET LIVE CHAT - MODERN 2027 */
        /* ============================================ */

        .support-widget-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 999;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .support-widget-toggle {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 28px;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .support-widget-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4);
        }

        .support-widget-toggle.pulsing {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            }
            50% {
                box-shadow: 0 8px 45px rgba(16, 185, 129, 0.6);
            }
        }

        .support-widget-panel {
            position: absolute;
            bottom: 80px;
            right: 0;
            width: 360px;
            max-height: 550px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.98) 100%);
            border-radius: 16px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            display: none;
            flex-direction: column;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: scale(0.9) translateY(20px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .support-widget-panel.active {
            display: flex;
            opacity: 1;
            visibility: visible;
            transform: scale(1) translateY(0);
        }

        .support-widget-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 16px;
            border-bottom: none;
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-emoji {
            font-size: 32px;
            display: flex;
            align-items: center;
        }

        .header-text h3 {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
            color: white;
            letter-spacing: -0.3px;
        }

        .header-text p {
            font-size: 12px;
            opacity: 0.9;
            margin: 3px 0 0 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            display: inline-block;
            animation: statusPulse 2s infinite;
        }

        @keyframes statusPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        .header-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
            margin-top: 12px;
        }

        .support-widget-content {
            flex: 1;
            padding: 16px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .welcome-message {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(6, 182, 212, 0.08) 100%);
            border-left: 3px solid #10b981;
            border-radius: 10px;
            padding: 12px;
            font-size: 13px;
            color: #1f2937;
            line-height: 1.6;
            display: flex;
            gap: 10px;
        }

        .welcome-message i {
            color: #10b981;
            font-size: 16px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .agents-section {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .agents-label {
            font-size: 12px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .agents-grid {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .agent-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .agent-card:hover {
            border-color: #10b981;
            background: #f0fdf4;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
            transform: translateX(4px);
        }

        .agent-avatar-circle {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }

        .agent-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .agent-name {
            font-weight: 600;
            font-size: 13px;
            color: #1f2937;
        }

        .agent-status {
            font-size: 12px;
            color: #10b981;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            background: #10b981;
            border-radius: 50%;
        }

        .support-widget-footer {
            padding: 12px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(6, 182, 212, 0.05) 100%);
            border-top: 1px solid #e5e7eb;
        }

        .footer-cta-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .footer-cta-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
        }

        /* Mobile Responsive */
        @media (max-width: 480px) {
            .support-widget-container {
                bottom: 20px;
                right: 20px;
            }

            .support-widget-toggle {
                width: 55px;
                height: 55px;
                font-size: 24px;
            }

            .support-widget-panel {
                width: calc(100vw - 40px);
                max-width: 360px;
                max-height: 500px;
            }

            .support-banner-popup {
                bottom: 90px;
                right: 20px;
            }

            .support-banner-card {
                width: calc(100vw - 40px);
                max-width: 320px;
            }
        }


        /* -------- RESPONSIVE DESIGN -------- */
        @media (max-width: 1024px) {
            .footer-content-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .footer-info-columns {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-bottom-content {
                grid-template-columns: 1fr;
                gap: 20px;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .footer-top-section {
                padding: 40px 0 30px 0;
            }

            .footer-info-columns {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .brand-showcase {
                gap: 12px;
            }

            .brand-logo-wrapper {
                width: 50px;
                height: 50px;
            }

            .brand-logo {
                max-width: 40px;
                max-height: 40px;
            }

            .brand-info h3 {
                font-size: 1.2rem;
            }

            .social-icons-modern {
                gap: 8px;
            }

            .social-icon-modern {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .back-to-top-btn {
                bottom: 20px;
                right: 20px;
                width: 44px;
                height: 44px;
            }
        }

        @media (max-width: 480px) {
            .footer-content-grid {
                gap: 30px;
            }

            .footer-copyright p {
                font-size: 0.8rem;
            }

            .footer-developer-credits p {
                font-size: 0.75rem;
            }

            .contact-item {
                padding: 10px;
            }

            .footer-link-list li a {
                font-size: 0.9rem;
                padding: 6px 0;
            }
        }
        }

        .footer-developer a:hover {
            color: #0099ff;
            text-decoration: underline;
        }

        .footer-logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .footer-logo img {
            height: 40px;
            width: auto;
            filter: brightness(0) invert(1);
        }

        /* =========================================
           TAMPILAN KHUSUS HP (MOBILE RESPONSIVE)
           ========================================= */
        @media (max-width: 768px) {
            /* 1. Container lebih mepet pinggir biar luas */
            .container-wide {
                max-width: 100%;
                padding-left: 10px;
                padding-right: 10px;
            }

            /* 2. Hero Section (Header Panel) lebih kecil */
            .hero-section {
                min-height: 280px; /* Lebih besar untuk mobile agar form muat */
                margin-bottom: 0;
                padding: 40px 0 60px 0;
            }
            .hero-title {
                font-size: 1.5rem; /* Font lebih kecil */
                margin-bottom: 3px;
            }
            .hero-subtitle {
                font-size: 0.85rem;
            }
            
            /* Hero Search Form Mobile */
            .hero-search-form {
                position: relative;
                bottom: auto;
                left: auto;
                transform: none;
                width: 95%;
                margin: 20px auto 0;
                padding: 0 10px;
            }
            .search-card-tiket {
                padding: 15px;
                border-radius: 16px;
            }
            .search-card-tiket .input-box {
                height: 50px;
                padding: 8px 12px;
            }
            .btn-search-tiket {
                height: 50px;
                font-size: 0.85rem;
                padding: 10px 15px;
            }
            .nav-tabs-tiket {
                padding: 8px 10px;
                gap: 4px;
                transform: none;
            }
            .nav-tab-item {
                padding: 5px 8px;
                font-size: 0.65rem;
            }
            .nav-tab-item span {
                display: none; /* Sembunyikan teks, tampilkan icon saja */
            }
            .nav-tab-item i {
                font-size: 1rem;
            }
            .hero-spacer {
                height: 20px; /* Spacer lebih kecil di mobile karena form tidak overlap */
            }

            /* 3. Search Widget (Kotak Pencarian) */
            .search-widget {
                padding: 20px 15px; /* Padding lebih tipis */
                margin-top: -50px; /* Naikkan sedikit */
            }
            
            /* Inputan numpuk ke bawah dengan jarak */
            .search-widget .col-lg-3, 
            .search-widget .col-md-6 {
                margin-bottom: 15px; 
            }

            /* 4. Maps & Konten */
            #map {
                height: 200px; /* Peta jangan terlalu tinggi di HP */
            }

            /* 5. Sidebar Kanan (Rincian & Budget) */
            /* Di HP, sidebar turun ke bawah. Kita matikan sticky-nya */
            .sticky-column {
                position: static; 
                margin-top: 30px;
            }

            /* 6. Floating Total Widget Tablet */
            .floating-total-widget {
                bottom: 16px;
                right: 16px;
            }
            .floating-total-card {
                min-width: 200px;
                padding: 14px 16px;
            }
            .floating-total-amount {
                font-size: 1.3rem;
            }
            
            /* 7. Navbar Logo Mobile */
            .navbar-brand img {
                height: 35px; /* Logo lebih kecil di HP */
            }
            .navbar-brand span { font-size: 0.95rem; }
            .weather-widget { font-size: 0.7rem; padding: 5px 10px; max-width: 200px; }
            .weather-icon { font-size: 1rem; }
            .running-text-content { animation: scroll-text 15s linear infinite; }
        }

        /* ============================================================
           SEARCH WIDGET COLUMNS
           ============================================================ */
        .search-widget [class*='col-'] {
            padding: 0 2px;
        }
        
        .search-widget .col-sm-6 {
            flex: 0 0 50%;
                width: 50%;
            }
            
            .search-widget .col-sm-12 {
                flex: 0 0 100%;
                width: 100%;
                margin-top: 4px;
            }

            /* 4. UKURAN INPUT DIKECILKAN (SUPAYA MUAT) */
            .form-label-custom { font-size: 0.55rem; margin-bottom: 1px; }
            
            .input-group, 
            .form-control, 
            .form-select,
            .select2-container--bootstrap-5 .select2-selection {
                height: 34px !important; /* Tinggi input dipendekkan */
                font-size: 0.7rem !important; /* Huruf input kecil */
            }
            .input-group-text { padding: 0 5px; font-size: 0.75rem; }
            .select2-container--bootstrap-5 .select2-selection { padding-top: 2px; }

            /* 5. PETA KECIL */
            #map {
                height: 220px;
                margin-bottom: 10px;
            }

            /* 6. LIST HOTEL & WISATA: TETAP 2 KOLOM (KECIL-KECIL) */
            .hotel-card { margin-bottom: 5px; }
            .hotel-card img { height: 70px !important; } /* Gambar kecil */
            .hotel-card .fw-bold { font-size: 0.75rem; }
            .hotel-card .text-primary { font-size: 0.7rem; }

            /* 7. JARAK ANTAR CARD */
            .card { margin-bottom: 10px; }
            .card-body { padding: 10px; }
            h5.fw-bold { font-size: 1rem; margin-bottom: 10px !important; }

            /* 8. SIDEBAR RINCIAN (TURUN KE BAWAH TAPI RAPAT) */
            .sticky-column { position: static; margin-top: 10px; }
            .budget-box-elegant { padding: 10px; }
            .form-control-budget { height: 40px !important; font-size: 1.2rem; }

            /* 9. FLOATING TOTAL WIDGET MOBILE */
            .floating-total-widget {
                bottom: 12px;
                right: 12px;
                left: 12px;
            }
            .floating-total-card {
                min-width: auto;
                width: 100%;
                padding: 12px 16px;
            }
            .floating-total-amount {
                font-size: 1.2rem;
            }
            .floating-total-btn {
                padding: 8px 12px;
                font-size: 0.75rem;
            }
            
            /* Navbar Logo Kecil */
            .navbar-brand img { height: 35px; }
            .navbar-brand span { font-size: 0.9rem; }
            .navbar-top { padding: 10px 0; }
            .weather-widget { font-size: 0.65rem; padding: 4px 8px; }
            .weather-icon { font-size: 1rem; }
            .weather-temp { font-size: 0.8rem; }
            .weather-location { display: none; }
        }

        /* ============================================================
           MAC STYLE MODAL GALLERY ANIMATION
           ============================================================ */
        .gallery-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(2px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            opacity: 0;
            animation: fadeIn 0.3s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; backdrop-filter: blur(0px); }
            to { opacity: 1; backdrop-filter: blur(2px); }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.85) translateY(20px);
                opacity: 0;
            }
            to {
                transform: scale(1) translateY(0);
                opacity: 1;
            }
        }

        .gallery-modal-box {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 650px;
            width: 90%;
            overflow: hidden;
            animation: scaleIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        .gallery-modal-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .gallery-modal-header h5 {
            margin: 0;
            font-weight: 700;
            color: #333;
        }

        .gallery-modal-close {
            background: #f0f0f0;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.2s;
        }

        .gallery-modal-close:hover {
            background: #e0e0e0;
            transform: rotate(90deg);
        }

        .gallery-carousel-container {
            position: relative;
            overflow: hidden;
            background: #f5f5f5;
        }

        .gallery-image-wrapper {
            width: 100%;
            padding-bottom: 75%; /* 4:3 aspect ratio */
            position: relative;
            background: #f0f0f0;
        }

        .gallery-image-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            animation: imageSlideIn 0.4s ease-out;
        }

        @keyframes imageSlideIn {
            from {
                opacity: 0;
                transform: scale(1.05);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .gallery-nav-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            transition: all 0.2s;
            z-index: 10;
        }

        .gallery-nav-button:hover {
            background: rgba(0, 0, 0, 0.8);
            transform: translateY(-50%) scale(1.1);
        }

        .gallery-nav-button.prev {
            left: 12px;
        }

        .gallery-nav-button.next {
            right: 12px;
        }

        .gallery-thumbnails {
            display: flex;
            gap: 8px;
            padding: 12px;
            background: white;
            overflow-x: auto;
        }

        .gallery-thumbnail {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .gallery-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.2s;
        }

        .gallery-thumbnail:hover img {
            transform: scale(1.1);
        }

        .gallery-thumbnail.active {
            border-color: #0088cc;
            box-shadow: 0 4px 12px rgba(0, 136, 204, 0.3);
        }

        .gallery-counter {
            padding: 12px 20px;
            background: white;
            text-align: center;
            border-top: 1px solid #eee;
            font-size: 0.9rem;
            color: #666;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <!-- NAVBAR BARU - TRAVELOKA STYLE -->
    <nav class="navbar-top">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
            <!-- Logo & Nama Travel -->
            <div class="navbar-brand">
                <?php if (!empty($settings['logo_image'])): ?>
                    <img src="<?= base_url('uploads/' . $settings['logo_image']) ?>" alt="Logo">
                <?php else: ?>
                    <i class="bi bi-send-fill" style="font-size: 2rem;"></i>
                <?php endif; ?>
                <span><?= $settings['app_name'] ?? 'Dinara Travel' ?></span>
            </div>
            
            <!-- Welcome Text - Only on Home Page -->
            <div class="welcome-header" id="welcome-header">
                <span><i class="bi bi-stars me-1"></i><?= $settings['welcome_text'] ?? 'Selamat Datang di Dinara Travel!' ?></span>
            </div>
            
            <!-- Running Text Pengumuman/Cuaca dari Settings -->
            <div class="weather-widget">
                <i class="bi bi-megaphone weather-icon"></i>
                <div class="running-text">
                    <span class="running-text-content"><?= $settings['announcement'] ?? lang('Landing.announcement_default') ?></span>
                </div>
            </div>

            <!-- LANGUAGE SELECTOR -->
            <div style="display: flex; gap: 8px;">
                <a href="?lang=id" class="btn btn-sm <?= ($current_lang ?? 'id') == 'id' ? 'btn-warning' : 'btn-outline-warning' ?>" style="padding: 5px 12px; font-weight: 600;">🇮🇩 ID</a>
                <a href="?lang=en" class="btn btn-sm <?= ($current_lang ?? 'id') == 'en' ? 'btn-info' : 'btn-outline-info' ?>" style="padding: 5px 12px; font-weight: 600;">🇬🇧 EN</a>
            </div>
        </div>
    </nav>

    <!-- PROMO HEADER PANEL - TIKET.COM STYLE -->
    <div class="hero-section p-0" style="position:relative;overflow:visible;min-height:480px;">
        <div id="heroSlider" class="position-absolute w-100 h-100" style="top:0;left:0;">
            <?php
            // Gunakan data slideshow dari database (hero_slideshow table)
            $hero_slides = [];
            
            if (!empty($hero_slideshows)) {
                // Jika ada slideshow dari database, gunakan itu
                foreach ($hero_slideshows as $slide) {
                    // Tentukan button action
                    $buttonAction = '';
                    $buttonUrl = $slide['button_url'] ?? '';
                    if (!empty($buttonUrl)) {
                        // Cek apakah JavaScript atau URL
                        if (stripos($buttonUrl, 'javascript:') === 0 || stripos($buttonUrl, 'showSection') !== false) {
                            $buttonAction = str_replace('javascript:', '', $buttonUrl);
                        } else {
                            // Jika URL, buka di tab baru
                            $buttonAction = "window.open('" . $buttonUrl . "', '_blank')";
                        }
                    } else {
                        $buttonAction = "showSection('promo')";
                    }
                    
                    // Simpan button URL asli untuk clickable image (data-button-url)
                    $buttonUrlForClick = $buttonUrl;
                    if (stripos($buttonUrl, 'javascript:') === 0) {
                        $buttonUrlForClick = str_replace('javascript:', '', $buttonUrl);
                    }
                    
                    $hero_slides[] = [
                        'image' => base_url($slide['image_url']),
                        'title' => $slide['title'] ?: 'Hai kamu, mau ke mana?',
                        'subtitle' => $slide['description'] ?: 'Dinara Travel - Satu aplikasi untuk kebutuhan liburanmu.',
                        'button' => [
                            'label' => $slide['button_label'] ?? 'Lihat Promo',
                            'class' => $slide['button_class'] ?? 'btn-warning',
                            'onclick' => $buttonAction,
                            'url' => $buttonUrlForClick  // <-- ADD THIS for clickable image
                        ],
                        'duration' => (int)($slide['duration'] ?? 5000)
                    ];
                }
            }
            
            // Fallback jika tidak ada slideshow dari database
            if (empty($hero_slides)) {
                $hero_slides = [
                    [
                        'image' => !empty($settings['hero_image']) ? base_url('uploads/' . $settings['hero_image']) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1200',
                        'title' => $settings['hero_title'] ?? 'Hai kamu, mau ke mana?',
                        'subtitle' => $settings['hero_subtitle'] ?? 'Dinara Travel - Satu aplikasi untuk kebutuhan liburanmu.',
                        'button' => [ 'label' => 'Ambil Promo', 'class' => 'btn-warning', 'onclick' => "showSection('promo')" ],
                        'duration' => 4000
                    ]
                ];
            }
            ?>
            <?php foreach($hero_slides as $i => $slide): ?>
            <div class="hero-slide w-100 h-100 position-absolute top-0 start-0" 
                 data-slide="<?= $i ?>" 
                 data-duration="<?= $slide['duration'] ?>"
                 data-button-url="<?= esc($slide['button']['url'] ?? '') ?>"
                 style="background-image:url('<?= $slide['image'] ?>');background-size:cover;background-position:center;z-index:<?= 10-$i ?>;opacity:<?= $i==0?'1':'0' ?>;transition:opacity 0.7s;cursor:pointer;"
                 onclick="openSlideLink(this)">
                <div class="hero-overlay"></div>
                <div class="hero-content" style="width: 100%; max-width: 100%;">
                    <h1 class="hero-title"><?= $slide['title'] ?></h1>
                    <p class="hero-subtitle"><?= $slide['subtitle'] ?></p>
                    <?php if (!empty($slide['button']['label'])): ?>
                    <button class="btn <?= $slide['button']['class'] ?> px-4 py-2 mt-3 fw-bold shadow" style="font-size:1.1rem;" onclick="event.stopPropagation(); <?= $slide['button']['onclick'] ?>">
                        <?= $slide['button']['label'] ?>
                    </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (count($hero_slides) > 1): ?>
            <button id="heroPrev" class="btn btn-light position-absolute top-50 start-0 translate-middle-y ms-2" style="z-index:20;opacity:0.7;" onclick="slideHero(-1)"><i class="bi bi-chevron-left"></i></button>
            <button id="heroNext" class="btn btn-light position-absolute top-50 end-0 translate-middle-y me-2" style="z-index:20;opacity:0.7;" onclick="slideHero(1)"><i class="bi bi-chevron-right"></i></button>
            <div class="position-absolute bottom-0 start-50 translate-middle-x mb-3" style="z-index:21;">
                <?php foreach($hero_slides as $i => $slide): ?>
                <span class="hero-dot mx-1" data-dot="<?= $i ?>" style="display:inline-block;width:12px;height:12px;border-radius:50%;background:#fff;opacity:<?= $i==0?'1':'0.5' ?>;cursor:pointer;border:2px solid #eee;" onclick="goToSlide(<?= $i ?>)"></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        
        <script>
        // 🎬 HERO SLIDESHOW SCRIPT - COMPLETE AUTO-PLAY IMPLEMENTATION
        console.log('🎬 Hero Slideshow Script Loaded');
        
        let heroIndex = 0;
        let heroTimeout = null;
        
        const heroSlides = document.querySelectorAll('.hero-slide');
        const heroDots = document.querySelectorAll('.hero-dot');
        
        console.log('📊 Found hero slides:', heroSlides.length);
        console.log('📊 Found hero dots:', heroDots.length);
        
        // Set heroDurations dari PHP setelah slides dirender
        let heroDurations = [];
        <?php if (!empty($hero_slides)): ?>
        heroDurations = [
            <?php foreach($hero_slides as $slide): ?>
                <?= (int)($slide['duration'] ?? 5000) ?>,
            <?php endforeach; ?>
        ];
        <?php endif; ?>
        
        // Generate durations array dari slide element data (backup)
        heroSlides.forEach((slide, idx) => {
            const duration = parseInt(slide.dataset.duration) || 5000;
            console.log(`⏱️ Slide ${idx}: ${duration}ms`);
        });
        
        if (heroDurations.length === 0) {
            heroDurations = [5000];
            console.warn('⚠️ No slides data found, using default 5000ms');
        }
        
        console.log(`✅ Hero Durations: ${JSON.stringify(heroDurations)}`);

        function showHeroSlide(idx) {
            heroSlides.forEach((slide, i) => {
                slide.style.opacity = (i === idx) ? '1' : '0';
                slide.style.zIndex = (i === idx) ? 10 : 5;
            });
            heroDots.forEach((dot, i) => {
                dot.style.opacity = (i === idx) ? '1' : '0.5';
            });
            console.log(`✅ Hero Slide ${idx + 1} of ${heroSlides.length} shown`);
        }

        function slideHero(dir = 1) {
            heroIndex = (heroIndex + dir + heroSlides.length) % heroSlides.length;
            showHeroSlide(heroIndex);
            resetHeroTimeout();
            console.log(`➡️ Hero slide changed to ${heroIndex + 1}`);
        }
        
        function goToSlide(idx) {
            heroIndex = idx;
            showHeroSlide(heroIndex);
            resetHeroTimeout();
            console.log(`🎯 Jump to hero slide ${heroIndex + 1}`);
        }

        function resetHeroTimeout() {
            if (heroTimeout) clearTimeout(heroTimeout);
            const duration = heroDurations[heroIndex] || 5000;
            heroTimeout = setTimeout(() => {
                slideHero(1);
            }, duration);
            console.log(`⏳ Next hero auto-play in ${duration}ms`);
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🎬 DOMContentLoaded - Initializing hero slideshow');
            console.log(`Hero slides ready: ${heroSlides.length}`);
            
            if (heroSlides.length > 0) {
                showHeroSlide(heroIndex);
                resetHeroTimeout();
                console.log('✅ Hero slideshow initialized successfully!');
                console.log(`▶️ Auto-play STARTED - First slide duration: ${heroDurations[0]}ms`);
            } else {
                console.error('❌ No hero slides found!');
            }
        });
        
        // Immediate init if DOM already loaded
        if (document.readyState !== 'loading' && heroSlides.length > 0) {
            console.log('✓ Document already loaded - triggering hero init immediately');
            showHeroSlide(heroIndex);
            resetHeroTimeout();
            console.log('✅ Hero immediate init successful');
        }
        </script>
        
        <!-- SEARCH FORM INSIDE HERO -->
        <div class="hero-search-form">
            <div style="display: flex; justify-content: center; margin-bottom: 20px;">
                <!-- NAVIGATION TABS TIKET.COM STYLE - MOVED UP -->
                <div class="nav-tabs-tiket">
                    <div class="nav-tab-item active" onclick="showSection('promo')" id="tab-home">
                        <i class="bi bi-house-heart-fill"></i>
                        <span>Home</span>
                    </div>
                    <a href="<?= base_url('hotel') ?>" class="nav-tab-item">
                        <i class="bi bi-building"></i>
                        <span>Hotel</span>
                    </a>
                    <a href="https://www.susiair.com/" target="_blank" class="nav-tab-item">
                        <i class="bi bi-airplane"></i>
                        <span>Pesawat</span>
                    </a>
                    <a href="<?= base_url('destinasi') ?>" target="_blank" class="nav-tab-item">
                        <i class="bi bi-geo-alt"></i>
                        <span>Destinasi</span>
                    </a>
                    <a href="<?= !empty($settings['jadwal_kapal_url']) ? esc($settings['jadwal_kapal_url']) : '#' ?>" target="_blank" class="nav-tab-item" style="cursor: pointer;">
                        <i class="bi bi-water"></i>
                        <span>Jadwal Kapal</span>
                    </a>
                    <div class="nav-tab-item" onclick="showSection('estimasi')" id="tab-estimasi">
                        <i class="bi bi-calculator"></i>
                        <span>Estimasi</span>
                    </div>
                    <a href="<?= !empty($settings['footer_whatsapp']) ? esc($settings['footer_whatsapp']) : 'https://wa.me/6281234567890' ?>" target="_blank" class="nav-tab-item">
                        <i class="bi bi-whatsapp"></i>
                        <span>Konsultasi</span>
                    </a>
                </div>
            </div>
            
            <div class="search-card-tiket">
                <form action="/kalkulator/hitung" method="post">
                    <div class="row g-3 align-items-end">
                        
                        <!-- TITIK KEBERANGKATAN -->
                        <div class="col-12 col-lg-3">
                            <div class="input-box">
                                <span class="input-label"><i class="bi bi-geo-alt-fill text-primary me-1"></i><?= lang('Landing.departure_point') ?></span>
                                <select id="kota_asal" name="kota_asal" class="form-select" required>
                                    <option value="" disabled selected><?= lang('Landing.select_location') ?></option>
                                </select>
                            </div>
                            <input type="hidden" id="input_harga_darat" name="harga_transport" value="0">
                        </div>
                        
                        <!-- TANGGAL -->
                        <div class="col-6 col-lg-2">
                            <div class="input-box">
                                <span class="input-label"><i class="bi bi-calendar-event text-primary me-1"></i><?= lang('Landing.travel_date') ?></span>
                                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                            </div>
                        </div>
                        
                        <!-- DURASI -->
                        <div class="col-6 col-lg-2">
                            <div class="input-box">
                                <span class="input-label"><i class="bi bi-clock text-primary me-1"></i><?= lang('Landing.duration') ?></span>
                                <select id="durasi" name="durasi" class="form-select" onchange="if(state.selectedKotaKey) reCalculate()">
                                    <option value="2">2 Hari 1 Malam</option>
                                    <option value="3" selected>3 Hari 2 Malam</option>
                                    <option value="4">4 Hari 3 Malam</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- JUMLAH ORANG -->
                        <div class="col-6 col-lg-2">
                            <div class="input-box">
                                <span class="input-label"><i class="bi bi-people text-primary me-1"></i><?= lang('Landing.guests') ?></span>
                                <input type="number" id="jml_orang" name="jumlah_orang" class="form-control" value="1" min="1" max="20" onchange="if(state.selectedKotaKey) reCalculate()">
                            </div>
                        </div>
                        
                        <!-- TOMBOL CARI -->
                        <div class="col-6 col-lg-3">
                            <button type="button" class="btn btn-search-tiket w-100" onclick="showSection('estimasi'); startSimulation();">
                                <?= ($current_lang ?? 'id') == 'en' ? 'View Estimate' : 'Lihat Estimasi' ?> <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                            </button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SPACER untuk form yang overlap -->
    <div class="hero-spacer"></div>

    <!-- ==================== PROMO SECTION (DEFAULT VISIBLE) ==================== -->
    <div id="section-promo" class="promo-section">
        <div class="container">
            <!-- TENTANG KARIMUNJAWA SECTION -->
            <div class="karimunjawa-info-section mb-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="fw-bold mb-3"><i class="bi bi-geo-alt text-primary me-2"></i>Tentang Karimunjawa</h3>
                        
                        <!-- ABOUT TEXT WITH READ MORE -->
                        <div class="about-karimunjawa-container">
                            <p class="text-muted about-text-preview" id="kmAboutPreview">
                                <?php 
                                    $fullText = $settings['about_karimunjawa'] ?? 'Karimunjawa adalah kepulauan yang terdiri dari 27 pulau di Laut Jawa, sekitar 80 km barat laut Jepara. Dikenal sebagai "surga tersembunyi", Karimunjawa menawarkan keindahan alam bawah laut yang luar biasa, pantai berpasir putih, dan hutan mangrove yang asri. Tempat sempurna untuk snorkeling, diving, island hopping, dan menikmati sunset terbaik di Indonesia.';
                                    $words = explode(' ', $fullText);
                                    $preview = implode(' ', array_slice($words, 0, 35)); // Show first 35 words
                                    echo $preview . '...';
                                ?>
                            </p>
                            
                            <a href="<?= base_url('travel/karimunjawa') ?>" target="_blank" class="btn btn-link btn-read-more p-0 mt-2">
                                <i class="bi bi-chevron-right me-1"></i>Baca Selengkapnya
                            </a>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-2 mt-3">
                            <span class="badge-info-km"><i class="bi bi-water me-1"></i>27 Pulau</span>
                            <span class="badge-info-km"><i class="bi bi-geo me-1"></i>Taman Nasional</span>
                            <span class="badge-info-km"><i class="bi bi-sun me-1"></i>Snorkeling</span>
                            <span class="badge-info-km"><i class="bi bi-heart me-1"></i>Diving</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="km-photo-grid">
                            <img src="<?= !empty($settings['km_photo_1']) ? base_url('uploads/karimunjawa/' . $settings['km_photo_1']) : 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=400' ?>" 
                                 alt="Karimunjawa 1" 
                                 class="km-photo-main"
                                 onerror="this.src='https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=400';">
                            <div class="km-photo-stack">
                                <img src="<?= !empty($settings['km_photo_2']) ? base_url('uploads/karimunjawa/' . $settings['km_photo_2']) : 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=300' ?>" 
                                     alt="Karimunjawa 2"
                                     onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=300';">
                                <img src="<?= !empty($settings['km_photo_3']) ? base_url('uploads/karimunjawa/' . $settings['km_photo_3']) : 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=300' ?>" 
                                     alt="Karimunjawa 3"
                                     onerror="this.src='https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=300';">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- INFORMASI PENTING -->
            <div class="info-cards-section mb-4">
                <h4 class="fw-bold mb-3"><i class="bi bi-info-circle text-info me-2"></i>Informasi Penting</h4>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="info-card">
                            <div class="info-card-icon" style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
                                <i class="bi bi-ship"></i>
                            </div>
                            <div class="info-card-content">
                                <h6>Akses Kapal</h6>
                                <p class="small mb-0"><?= $settings['info_kapal'] ?? 'Kapal Express Bahari dari Jepara (2 jam) atau KMC Kartini dari Semarang (5 jam). Jadwal tergantung cuaca.' ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card">
                            <div class="info-card-icon" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="info-card-content">
                                <h6>Waktu Terbaik</h6>
                                <p class="small mb-0"><?= $settings['info_waktu'] ?? 'Musim kunjungan terbaik April-Oktober (musim kemarau). Hindari Desember-Februari karena gelombang tinggi.' ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card">
                            <div class="info-card-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <div class="info-card-content">
                                <h6>Biaya Masuk</h6>
                                <p class="small mb-0"><?= $settings['info_biaya'] ?? 'Tiket masuk Taman Nasional: Rp 175.000/orang (weekday), Rp 200.000/orang (weekend). Sudah termasuk asuransi.' ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- PROMO CARDS -->
            <h4 class="fw-bold mb-3"><i class="bi bi-fire text-danger me-2"></i>Promo Spesial</h4>
            <div class="row g-4">
                <!-- PROMO 1 -->
                <div class="col-md-4">
                    <div class="promo-card">
                        <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600" alt="Paket Snorkeling">
                        <div class="promo-card-body">
                            <span class="promo-badge"><i class="bi bi-percent me-1"></i>DISKON 20%</span>
                            <h5 class="promo-title">Paket Snorkeling 4 Pulau</h5>
                            <p class="promo-desc">Jelajahi keindahan bawah laut Karimunjawa dengan mengunjungi 4 pulau terindah.</p>
                            <div class="promo-price">
                                <span class="promo-price-old">Rp 450.000</span>
                                <span class="promo-price-new">Rp 360.000</span>
                            </div>
                            <button class="btn promo-cta" onclick="showSection('estimasi')">
                                <i class="bi bi-bag-check me-2"></i>Pesan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- PROMO 2 -->
                <div class="col-md-4">
                    <div class="promo-card">
                        <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=600" alt="Paket Honeymoon">
                        <div class="promo-card-body">
                            <span class="promo-badge" style="background: linear-gradient(135deg, #ec4899 0%, #f43f5e 100%);"><i class="bi bi-heart-fill me-1"></i>HONEYMOON</span>
                            <h5 class="promo-title">Paket Honeymoon 3D2N</h5>
                            <p class="promo-desc">Nikmati momen romantis bersama pasangan di resort tepi pantai.</p>
                            <div class="promo-price">
                                <span class="promo-price-old">Rp 3.500.000</span>
                                <span class="promo-price-new">Rp 2.800.000</span>
                            </div>
                            <button class="btn promo-cta" onclick="showSection('estimasi')">
                                <i class="bi bi-bag-check me-2"></i>Pesan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- PROMO 3 -->
                <div class="col-md-4">
                    <div class="promo-card">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600" alt="Paket Backpacker">
                        <div class="promo-card-body">
                            <span class="promo-badge" style="background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);"><i class="bi bi-backpack me-1"></i>BUDGET</span>
                            <h5 class="promo-title">Paket Backpacker 2D1N</h5>
                            <p class="promo-desc">Liburan hemat dengan pengalaman maksimal bersama teman-teman.</p>
                            <div class="promo-price">
                                <span class="promo-price-old">Rp 800.000</span>
                                <span class="promo-price-new">Rp 650.000</span>
                            </div>
                            <button class="btn promo-cta" onclick="showSection('estimasi')">
                                <i class="bi bi-bag-check me-2"></i>Pesan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- BLOG POSTS SECTION - 2027 LUXURY DESIGN -->
            <div class="blog-section mt-5 mb-5" style="margin-top: 60px !important;">
                <div class="blog-header-wrapper mb-5">
                    <div class="blog-header-content">
                        <div class="blog-header-badge">📰 Artikel Eksklusif</div>
                        <h2 class="blog-header-title">Berita & Panduan Wisata</h2>
                        <p class="blog-header-subtitle">Temukan tips, cerita, dan informasi menarik seputar keindahan Karimunjawa</p>
                    </div>
                    <div class="blog-header-action">
                        <a href="/blog" class="btn-blog-all">
                            <span>Lihat Semua Artikel</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                
                <div class="blog-grid">
                    <?php 
                    // Get latest 3 blog posts
                    $blogModel = new \App\Models\BlogModel();
                    $posts = $blogModel->getPublished(3);
                    
                    if (!empty($posts)):
                        foreach ($posts as $index => $post):
                    ?>
                    <div class="blog-post-card">
                        <div class="blog-post-wrapper">
                            <!-- Image Section -->
                            <div class="blog-post-image">
                                <div class="blog-image-container">
                                    <img src="<?= !empty($post['featured_image']) ? base_url('uploads/blog/' . $post['featured_image']) : 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600' ?>" 
                                         alt="<?= esc($post['title']) ?>"
                                         onerror="this.src='https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600';">
                                    <div class="blog-image-overlay"></div>
                                </div>
                                <div class="blog-badges">
                                    <span class="blog-category-badge">
                                        <i class="bi bi-tag-fill"></i> <?= ucfirst($post['category']) ?>
                                    </span>
                                    <span class="blog-views-badge">
                                        <i class="bi bi-eye"></i> <?= $post['views'] ?>
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Content Section -->
                            <div class="blog-post-content">
                                <div class="blog-post-meta">
                                    <span class="blog-date-badge">
                                        <i class="bi bi-calendar-event"></i> <?= date('d', strtotime($post['created_at'])) ?> <?= date('M Y', strtotime($post['created_at'])) ?>
                                    </span>
                                    <span class="blog-read-time">~ 5 menit</span>
                                </div>
                                
                                <h3 class="blog-post-title"><?= esc($post['title']) ?></h3>
                                
                                <p class="blog-post-excerpt">
                                    <?= esc(substr($post['excerpt'], 0, 220)) ?>...
                                </p>
                                
                                <div class="blog-post-footer">
                                    <a href="/blog/<?= $post['slug'] ?>" class="btn-read-more">
                                        Baca Selengkapnya
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        endforeach;
                    else:
                    ?>
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada blog posts</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <style>
                /* ==================== BLOG SECTION 2027 DESIGN ==================== */
                .blog-section {
                    animation: fadeIn 0.6s ease-out;
                }

                .blog-header-wrapper {
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-start;
                    gap: 40px;
                    flex-wrap: wrap;
                }

                .blog-header-content {
                    flex: 1;
                    min-width: 300px;
                }

                .blog-header-badge {
                    display: inline-block;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                    font-size: 0.95rem;
                    font-weight: 600;
                    margin-bottom: 12px;
                }

                .blog-header-title {
                    font-size: 2.5rem;
                    font-weight: 800;
                    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                    margin-bottom: 16px;
                    line-height: 1.2;
                }

                .blog-header-subtitle {
                    font-size: 1.1rem;
                    color: #64748b;
                    line-height: 1.6;
                }

                .blog-header-action {
                    display: flex;
                    align-items: center;
                    justify-content: flex-end;
                }

                .btn-blog-all {
                    display: inline-flex;
                    align-items: center;
                    gap: 10px;
                    padding: 14px 28px;
                    background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
                    color: white;
                    text-decoration: none;
                    border-radius: 50px;
                    font-weight: 600;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    box-shadow: 0 8px 24px rgba(14, 165, 233, 0.3);
                }

                .btn-blog-all:hover {
                    transform: translateY(-4px);
                    box-shadow: 0 12px 32px rgba(14, 165, 233, 0.4);
                }

                .btn-blog-all i {
                    transition: transform 0.3s ease;
                }

                .btn-blog-all:hover i {
                    transform: translateX(4px);
                }

                /* Blog Grid */
                .blog-grid {
                    display: grid;
                    grid-template-columns: 1fr;
                    gap: 32px;
                }

                /* Blog Post Card */
                .blog-post-card {
                    opacity: 0;
                    animation: slideInUp 0.6s ease-out forwards;
                }

                .blog-post-card:nth-child(1) { animation-delay: 0.1s; }
                .blog-post-card:nth-child(2) { animation-delay: 0.2s; }
                .blog-post-card:nth-child(3) { animation-delay: 0.3s; }

                @keyframes slideInUp {
                    from {
                        opacity: 0;
                        transform: translateY(30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .blog-post-wrapper {
                    display: grid;
                    grid-template-columns: 180px 1fr;
                    gap: 0;
                    background: rgba(255, 255, 255, 0.95);
                    backdrop-filter: blur(20px);
                    border: 1px solid rgba(255, 255, 255, 0.3);
                    border-radius: 18px;
                    overflow: hidden;
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
                    min-height: 200px;
                }

                .blog-post-card:hover .blog-post-wrapper {
                    transform: translateY(-8px);
                    box-shadow: 0 20px 48px rgba(14, 165, 233, 0.15);
                    border-color: rgba(14, 165, 233, 0.3);
                }

                /* Image Section */
                .blog-post-image {
                    position: relative;
                    overflow: hidden;
                    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                }

                .blog-image-container {
                    position: relative;
                    width: 100%;
                    height: 100%;
                    overflow: hidden;
                }

                .blog-image-container img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .blog-image-overlay {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(135deg, rgba(14, 165, 233, 0) 0%, rgba(14, 165, 233, 0.1) 100%);
                    opacity: 0;
                    transition: opacity 0.4s ease;
                }

                .blog-post-card:hover .blog-image-container img {
                    transform: scale(1.1);
                }

                .blog-post-card:hover .blog-image-overlay {
                    opacity: 1;
                }

                /* Badges */
                .blog-badges {
                    position: absolute;
                    bottom: 12px;
                    left: 12px;
                    display: flex;
                    flex-direction: column;
                    gap: 8px;
                }

                .blog-category-badge,
                .blog-views-badge {
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    padding: 6px 12px;
                    background: rgba(255, 255, 255, 0.95);
                    backdrop-filter: blur(10px);
                    color: #0ea5e9;
                    border-radius: 20px;
                    font-size: 0.8rem;
                    font-weight: 600;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                    transition: all 0.3s ease;
                }

                .blog-post-card:hover .blog-category-badge {
                    background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
                    color: white;
                }

                /* Content Section */
                .blog-post-content {
                    padding: 20px 22px;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }

                .blog-post-meta {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    margin-bottom: 12px;
                    flex-wrap: wrap;
                }

                .blog-date-badge {
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    padding: 6px 12px;
                    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                    color: white;
                    border-radius: 8px;
                    font-size: 0.8rem;
                    font-weight: 600;
                }

                .blog-read-time {
                    color: #94a3b8;
                    font-size: 0.85rem;
                    font-weight: 500;
                }

                .blog-post-title {
                    font-size: 1.25rem;
                    font-weight: 800;
                    color: #1e293b;
                    margin-bottom: 10px;
                    line-height: 1.3;
                    transition: color 0.3s ease;
                }

                .blog-post-card:hover .blog-post-title {
                    background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                }

                .blog-post-excerpt {
                    font-size: 0.85rem;
                    color: #64748b;
                    line-height: 1.5;
                    margin-bottom: 12px;
                    flex: 1;
                }

                .blog-post-footer {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                }

                .btn-read-more {
                    display: inline-flex;
                    align-items: center;
                    gap: 5px;
                    padding: 8px 16px;
                    background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
                    color: white;
                    text-decoration: none;
                    border-radius: 50px;
                    font-weight: 600;
                    font-size: 0.85rem;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    box-shadow: 0 4px 16px rgba(14, 165, 233, 0.3);
                }

                .btn-read-more:hover {
                    transform: translateX(4px);
                    box-shadow: 0 8px 24px rgba(14, 165, 233, 0.4);
                    color: white;
                }

                .btn-read-more i {
                    transition: transform 0.3s ease;
                }

                .btn-read-more:hover i {
                    transform: translateX(4px);
                }

                /* Responsive Design */
                @media (max-width: 768px) {
                    .blog-header-wrapper {
                        flex-direction: column;
                        gap: 20px;
                    }

                    .blog-header-title {
                        font-size: 1.8rem;
                    }

                    .blog-header-action {
                        justify-content: flex-start;
                        width: 100%;
                    }

                    .blog-post-wrapper {
                        grid-template-columns: 1fr;
                        min-height: auto;
                    }

                    .blog-post-image {
                        min-height: 200px;
                    }

                    .blog-post-content {
                        padding: 24px;
                    }

                    .blog-post-title {
                        font-size: 1.3rem;
                    }

                    .blog-post-excerpt {
                        font-size: 0.95rem;
                    }
                }
            </style>
            
            <!-- FLYER PROMO SLIDER -->
            <div class="flyer-slider-section mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold mb-0"><i class="bi bi-images text-primary me-2"></i>Flyer Promo</h4>
                    <a href="#" class="text-primary fw-bold small">Lihat Semua <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="flyer-scroll">
                    <div class="flyer-item" data-flyer="promo">
                        <img src="<?= !empty($settings['flyer_1']) ? base_url('uploads/flyer/' . $settings['flyer_1']) : 'https://images.unsplash.com/photo-1682687982501-1e58ab814714?w=400' ?>" 
                             alt="Promo Flyer 1"
                             onerror="this.src='https://images.unsplash.com/photo-1682687982501-1e58ab814714?w=400';">
                        <button class="btn btn-warning w-100 mt-2 flyer-action-btn" onclick="ambilPromo()">
                            <i class="bi bi-gift"></i> Ambil Promo
                        </button>
                    </div>
                    <div class="flyer-item" data-flyer="jadwal">
                        <img src="<?= !empty($settings['flyer_2']) ? base_url('uploads/flyer/' . $settings['flyer_2']) : 'https://images.unsplash.com/photo-1583212292454-1fe6229603b7?w=400' ?>" 
                             alt="Promo Flyer 2"
                             onerror="this.src='https://images.unsplash.com/photo-1583212292454-1fe6229603b7?w=400';">
                        <button class="btn btn-primary w-100 mt-2 flyer-action-btn" onclick="lihatJadwalKapal()">
                            <i class="bi bi-calendar-event"></i> Lihat Jadwal Kapal
                        </button>
                    </div>
                    <div class="flyer-item" data-flyer="paket">
                        <img src="<?= !empty($settings['flyer_3']) ? base_url('uploads/flyer/' . $settings['flyer_3']) : 'https://images.unsplash.com/photo-1544551763-77ef2d0cfc6c?w=400' ?>" 
                             alt="Promo Flyer 3"
                             onerror="this.src='https://images.unsplash.com/photo-1544551763-77ef2d0cfc6c?w=400';">
                        <button class="btn btn-success w-100 mt-2 flyer-action-btn" onclick="showSection('estimasi')">
                            <i class="bi bi-calculator"></i> Lihat Paket Estimasi
                        </button>
                    </div>
                    <div class="flyer-item" data-flyer="info">
                        <img src="<?= !empty($settings['flyer_4']) ? base_url('uploads/flyer/' . $settings['flyer_4']) : 'https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?w=400' ?>" 
                             alt="Promo Flyer 4"
                             onerror="this.src='https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?w=400';">
                        <button class="btn btn-info w-100 mt-2 flyer-action-btn" onclick="window.open('https://karimunjawa.id', '_blank')">
                            <i class="bi bi-info-circle"></i> Info Wisata
                        </button>
                    </div>
                    <div class="flyer-item" data-flyer="custom">
                        <img src="<?= !empty($settings['flyer_5']) ? base_url('uploads/flyer/' . $settings['flyer_5']) : 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400' ?>" 
                             alt="Promo Flyer 5"
                             onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400';">
                        <button class="btn btn-dark w-100 mt-2 flyer-action-btn" onclick="window.open('https://wa.me/6281234567890', '_blank')">
                            <i class="bi bi-whatsapp"></i> Konsultasi Custom Trip
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- GALLERY KARIMUNJAWA -->
            <div class="gallery-section mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold mb-0"><i class="bi bi-camera text-success me-2"></i>Galeri Karimunjawa</h4>
                    <a href="#" class="text-success fw-bold small">Lihat Semua <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="<?= !empty($settings['gallery_1']) ? base_url('uploads/gallery/' . $settings['gallery_1']) : 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=300' ?>" alt="Gallery 1" onerror="this.src='https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=300';">
                    </div>
                    <div class="gallery-item">
                        <img src="<?= !empty($settings['gallery_2']) ? base_url('uploads/gallery/' . $settings['gallery_2']) : 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=300' ?>" alt="Gallery 2" onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=300';">
                    </div>
                    <div class="gallery-item">
                        <img src="<?= !empty($settings['gallery_3']) ? base_url('uploads/gallery/' . $settings['gallery_3']) : 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=300' ?>" alt="Gallery 3" onerror="this.src='https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=300';">
                    </div>
                    <div class="gallery-item">
                        <img src="<?= !empty($settings['gallery_4']) ? base_url('uploads/gallery/' . $settings['gallery_4']) : 'https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?w=300' ?>" alt="Gallery 4" onerror="this.src='https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?w=300';">
                    </div>
                    <div class="gallery-item">
                        <img src="<?= !empty($settings['gallery_5']) ? base_url('uploads/gallery/' . $settings['gallery_5']) : 'https://images.unsplash.com/photo-1519046904884-53103b34b206?w=300' ?>" alt="Gallery 5" onerror="this.src='https://images.unsplash.com/photo-1519046904884-53103b34b206?w=300';">
                    </div>
                    <div class="gallery-item">
                        <img src="<?= !empty($settings['gallery_6']) ? base_url('uploads/gallery/' . $settings['gallery_6']) : 'https://images.unsplash.com/photo-1544551763-77ef2d0cfc6c?w=300' ?>" alt="Gallery 6" onerror="this.src='https://images.unsplash.com/photo-1544551763-77ef2d0cfc6c?w=300';">
                    </div>
                    <div class="gallery-item">
                        <img src="<?= !empty($settings['gallery_7']) ? base_url('uploads/gallery/' . $settings['gallery_7']) : 'https://images.unsplash.com/photo-1682687982501-1e58ab814714?w=300' ?>" alt="Gallery 7" onerror="this.src='https://images.unsplash.com/photo-1682687982501-1e58ab814714?w=300';">
                    </div>
                    <div class="gallery-item">
                        <img src="<?= !empty($settings['gallery_8']) ? base_url('uploads/gallery/' . $settings['gallery_8']) : 'https://images.unsplash.com/photo-1583212292454-1fe6229603b7?w=300' ?>" alt="Gallery 8" onerror="this.src='https://images.unsplash.com/photo-1583212292454-1fe6229603b7?w=300';">
                    </div>
                </div>
            </div>
            
            <!-- WHY CHOOSE US -->
            <div class="mt-5 p-4 rounded-4" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
                <h4 class="fw-bold mb-4 text-center"><i class="bi bi-award text-warning me-2"></i>Kenapa Pilih Dinara Travel?</h4>
                <div class="row g-4">
                    <div class="col-md-3 text-center">
                        <div class="p-3">
                            <i class="bi bi-geo-alt-fill text-primary" style="font-size: 2.5rem;"></i>
                            <h6 class="fw-bold mt-3">Lokal Expert</h6>
                            <p class="small text-muted mb-0">Kami warga lokal Karimunjawa yang paham seluk-beluknya</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="p-3">
                            <i class="bi bi-currency-dollar text-success" style="font-size: 2.5rem;"></i>
                            <h6 class="fw-bold mt-3">Harga Transparan</h6>
                            <p class="small text-muted mb-0">Tidak ada biaya tersembunyi, semua jelas di depan</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="p-3">
                            <i class="bi bi-people-fill text-info" style="font-size: 2.5rem;"></i>
                            <h6 class="fw-bold mt-3">1000+ Happy Travelers</h6>
                            <p class="small text-muted mb-0">Ribuan wisatawan puas dengan layanan kami</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="p-3">
                            <i class="bi bi-patch-check-fill text-danger" style="font-size: 2.5rem;"></i>
                            <h6 class="fw-bold mt-3">Garansi Kepuasan</h6>
                            <p class="small text-muted mb-0">Jika tidak puas, kami siap tanggung jawab</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CTA BOTTOM -->
            <div class="text-center mt-5">
                <button class="btn btn-lg fw-bold px-5 py-3" onclick="showSection('estimasi')" style="background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%); color: white; border-radius: 15px; font-size: 1.1rem;">
                    <i class="bi bi-calculator me-2"></i>Mulai Hitung Estimasi Liburanmu
                </button>
                <p class="text-muted mt-3">atau hubungi kami di <a href="https://wa.me/6281234567890" class="fw-bold text-success"><i class="bi bi-whatsapp"></i> WhatsApp</a></p>
            </div>
        </div>
    </div>
    
    <!-- ==================== ESTIMASI SECTION (HIDDEN BY DEFAULT) ==================== -->
    <div id="section-estimasi" class="section-hidden">

    <div style="display: flex; gap: 8px; padding: 0 15px; margin: 20px auto 0; max-width: 100%; align-items: flex-start;">
        <!-- MAPS & HOTEL & BUDGET COLUMN (KIRI) -->
        <div style="flex: 0 0 calc(50% - 4px); max-width: calc(50% - 4px); display: flex; flex-direction: column; gap: 4px;">
            <!-- MAPS SECTION -->
            <div class="card border-0 shadow-sm rounded-4" style="background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(248,249,250,0.95) 100%); padding: 8px;">
                <div style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); border-bottom: 1.5px solid #e8eef7; padding: 6px 8px; margin: -8px -8px 6px -8px; border-radius: 12px 12px 0 0;">
                    <h6 class="fw-bold mb-0" style="font-size: 0.85rem; color: #0d6efd; letter-spacing: 0.2px;"><i class="bi bi-map-fill"></i> Rute Perjalanan</h6>
                </div>
                <div id="map" style="border-radius: 10px; height: 300px;"></div>
            </div>

            <!-- HOTEL SECTION -->
            <div class="card border-0 shadow-sm rounded-4" id="section-hotel" style="background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(248,249,250,0.95) 100%); padding: 8px; height: 410px;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold mb-0 text-secondary" style="font-size: 0.75rem;"><i class="bi bi-building"></i> <?= lang('Landing.choose_accommodation') ?></h6>
                    <div class="hotel-nav-buttons d-flex gap-1">
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-circle" id="hotel-prev" onclick="slideHotel(-1)" style="width: 22px; height: 22px; padding: 0; font-size: 0.6rem;" disabled>‹</button>
                        <span class="hotel-counter small fw-bold text-secondary align-self-center" style="min-width: 30px; text-align: center; font-size: 0.65rem;">1/1</span>
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-circle" id="hotel-next" onclick="slideHotel(1)" style="width: 22px; height: 22px; padding: 0; font-size: 0.6rem;">›</button>
                    </div>
                </div>
                <div class="alert alert-light border-0 small text-muted mb-2" style="padding: 0.25rem 0.4rem; font-size: 0.65rem;"><i class="bi bi-info-circle"></i> <?= lang('Landing.cheapest_selected') ?></div>
                <div class="hotel-carousel-wrapper" style="overflow: hidden; height: 330px;">
                    <div class="row g-1" id="hotel-list-container"></div>
                </div>
            </div>

            <!-- BUDGET BOX - FULL WIDTH DI KIRI -->
            <div class="budget-box-elegant" style="padding: 15px; border-radius: 12px;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="text-white fw-bold mb-0" style="font-size: 0.85rem;"><i class="bi bi-wallet2"></i> BUDGET ANDA</label>
                    <button type="button" class="btn btn-warning btn-sm fw-bold" onclick="showDapatApaAja()" style="font-size: 0.7rem; border-radius: 6px; padding: 4px 10px;">
                        <i class="bi bi-list-check"></i> Dapat Apa Aja?
                    </button>
                </div>
                <div class="input-group bg-white rounded-3 overflow-hidden" style="height: 45px;">
                    <span class="input-group-text bg-white border-0 fw-bold text-primary" style="font-size: 1rem;">Rp</span>
                    <input type="number" id="budget_user" class="form-control border-0 fw-bold text-primary" placeholder="Masukkan budget..." onkeyup="checkBudget()" style="font-size: 1.1rem;">
                </div>
                
                <!-- HASIL PERHITUNGAN BUDGET -->
                <div id="budget-feedback" class="mt-3 d-none">
                    <!-- Status Bar -->
                    <div id="budget-status" class="text-center py-2 rounded-3 mb-2" style="font-size: 0.8rem;"></div>
                    
                    <!-- Detail Breakdown -->
                    <div class="bg-white bg-opacity-10 rounded-3 p-2" style="font-size: 0.75rem;">
                        <div class="d-flex justify-content-between text-white mb-1">
                            <span>Total Paket Termurah:</span>
                            <span id="budget-total-estimasi" class="fw-bold">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between text-white border-top border-white border-opacity-25 pt-1">
                            <span class="fw-bold">Sisa Uang:</span>
                            <span id="sisa-uang" class="fw-bold" style="font-size: 0.9rem;">Rp 0</span>
                        </div>
                    </div>
                    
                    <!-- REKOMENDASI UPGRADE -->
                    <div id="upgrade-recommendations" class="mt-2 d-none">
                        <label class="small text-warning fw-bold mb-1" style="font-size: 0.7rem;"><i class="bi bi-arrow-up-circle-fill"></i> SISA BUDGET BISA UNTUK:</label>
                        <div id="upgrade-list" class="bg-white bg-opacity-10 rounded-3 p-2" style="font-size: 0.7rem;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ESTIMASI COLUMN (KANAN) -->
        <div style="flex: 0 0 calc(50% - 4px); max-width: calc(50% - 4px); display: flex; flex-direction: column; gap: 4px;">
                <div style="display: flex; flex-direction: column; gap: 4px;">
                    <div class="card shadow-sm border-0 rounded-4" style="font-size: 0.8rem; position: relative; padding: 8px; height: 340px; overflow-y: auto;">
                        <div style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); border-bottom: 2px solid #e8eef7; padding: 6px 8px; margin: -8px -8px 8px -8px; border-radius: 12px 12px 0 0;">
                            <h5 class="fw-bold mb-0" style="font-size: 0.95rem; color: #0d6efd; letter-spacing: 0.3px;"><i class="bi bi-calculator-fill"></i> Rincian Biaya <span id="duration-label" style="font-size: 0.75rem; color: #666; font-weight: 500;">(3D 2M)</span></h5>
                            <small style="font-size: 0.65rem; color: #198754;"><i class="bi bi-hand-index-thumb"></i> Upgrade apapun tinggal klik!</small>
                        </div>
                        
                        <!-- 1. TIKET KAPAL PP -->
                        <div style="margin-bottom: 6px; border-bottom: 1px solid #f0f0f0; padding-bottom: 4px;">
                            <div class="d-flex justify-content-between align-items-center" style="font-size: 0.75rem;">
                                <div class="d-flex gap-1 align-items-center">
                                    <span class="badge bg-primary me-1" style="font-size: 0.6rem;">1</span>
                                    <i class="bi bi-ship text-info"></i>
                                    <span id="label_kapal">Tiket Kapal PP (Termurah)</span>
                                    <span class="info-icon" data-info-key="transport_sea" role="button" tabindex="0" style="display:inline-flex;width:14px;height:14px;border-radius:50%;background:linear-gradient(135deg,#0d6efd 0%,#0099ff 100%);color:white;font-weight:900;font-size:0.6rem;align-items:center;justify-content:center;cursor:pointer;margin-left:2px;box-shadow:0 1px 4px rgba(13,110,253,0.3);">i</span>
                                </div>
                                <span class="fw-bold text-dark" id="val_kapal_pp">Rp 0</span>
                            </div>
                        </div>

                        <!-- 2. PENGINAPAN -->
                        <div style="margin-bottom: 6px; border-bottom: 1px solid #f0f0f0; padding-bottom: 4px;">
                            <div class="d-flex justify-content-between align-items-center" style="font-size: 0.75rem;">
                                <div class="d-flex gap-1 align-items-center">
                                    <span class="badge bg-primary me-1" style="font-size: 0.6rem;">2</span>
                                    <i class="bi bi-building text-success"></i>
                                    <span id="label_hotel">Hotel Termurah</span>
                                    <span class="info-icon" data-info-key="hotel" role="button" tabindex="0" style="display:inline-flex;width:14px;height:14px;border-radius:50%;background:linear-gradient(135deg,#0d6efd 0%,#0099ff 100%);color:white;font-weight:900;font-size:0.6rem;align-items:center;justify-content:center;cursor:pointer;margin-left:2px;box-shadow:0 1px 4px rgba(13,110,253,0.3);">i</span>
                                </div>
                                <span class="fw-bold text-dark" id="val_hotel">Rp 0</span>
                            </div>
                        </div>

                        <!-- 3. SEWA MOTOR/MOBIL -->
                        <div style="margin-bottom: 6px; border-bottom: 1px solid #f0f0f0; padding-bottom: 4px;">
                            <div class="d-flex justify-content-between align-items-center" style="font-size: 0.75rem;">
                                <div class="d-flex gap-1 align-items-center">
                                    <span class="badge bg-primary me-1" style="font-size: 0.6rem;">3</span>
                                    <i class="bi bi-scooter text-warning"></i>
                                    <span id="label_lokal">Motor (Termurah)</span>
                                    <span class="info-icon" data-info-key="transport" role="button" tabindex="0" style="display:inline-flex;width:14px;height:14px;border-radius:50%;background:linear-gradient(135deg,#0d6efd 0%,#0099ff 100%);color:white;font-weight:900;font-size:0.6rem;align-items:center;justify-content:center;cursor:pointer;margin-left:2px;box-shadow:0 1px 4px rgba(13,110,253,0.3);">i</span>
                                </div>
                                <span class="fw-bold text-dark" id="val_lokal">Rp 0</span>
                            </div>
                        </div>

                        <!-- 4. TOUR DARAT + GUIDE -->
                        <div style="margin-bottom: 6px; border-bottom: 1px solid #f0f0f0; padding-bottom: 4px;">
                            <div class="d-flex justify-content-between align-items-center" style="font-size: 0.75rem;">
                                <div class="d-flex gap-1 align-items-center">
                                    <span class="badge bg-primary me-1" style="font-size: 0.6rem;">4</span>
                                    <i class="bi bi-tree text-success"></i>
                                    <span>Tour Darat + Guide</span>
                                    <span class="info-icon" data-info-key="guide" role="button" tabindex="0" style="display:inline-flex;width:14px;height:14px;border-radius:50%;background:linear-gradient(135deg,#0d6efd 0%,#0099ff 100%);color:white;font-weight:900;font-size:0.6rem;align-items:center;justify-content:center;cursor:pointer;margin-left:2px;box-shadow:0 1px 4px rgba(13,110,253,0.3);">i</span>
                                </div>
                                <span class="fw-bold text-dark" id="val_darat_guide">Rp 0</span>
                            </div>
                        </div>

                        <!-- 5. TOUR LAUT / WISATA LAUT -->
                        <div style="margin-bottom: 6px; border-bottom: 1px solid #f0f0f0; padding-bottom: 4px;">
                            <div class="d-flex justify-content-between align-items-center" style="font-size: 0.75rem;">
                                <div class="d-flex gap-1 align-items-center">
                                    <span class="badge bg-primary me-1" style="font-size: 0.6rem;">5</span>
                                    <i class="bi bi-water text-info"></i>
                                    <span>Wisata Laut</span>
                                    <span class="info-icon" data-info-key="activity" role="button" tabindex="0" style="display:inline-flex;width:14px;height:14px;border-radius:50%;background:linear-gradient(135deg,#0d6efd 0%,#0099ff 100%);color:white;font-weight:900;font-size:0.6rem;align-items:center;justify-content:center;cursor:pointer;margin-left:2px;box-shadow:0 1px 4px rgba(13,110,253,0.3);">i</span>
                                </div>
                                <span class="fw-bold text-dark" id="val_wisata_laut">Rp 0</span>
                            </div>
                        </div>

                        <!-- 6. MAKAN -->
                        <div style="margin-bottom: 6px; border-bottom: 1px solid #f0f0f0; padding-bottom: 4px;">
                            <div class="d-flex justify-content-between align-items-center" style="font-size: 0.75rem;">
                                <div class="d-flex gap-1 align-items-center">
                                    <span class="badge bg-primary me-1" style="font-size: 0.6rem;">6</span>
                                    <i class="bi bi-egg-fried text-warning"></i>
                                    <span>Makan 3x/hari</span>
                                    <span class="info-icon" data-info-key="food" role="button" tabindex="0" style="display:inline-flex;width:14px;height:14px;border-radius:50%;background:linear-gradient(135deg,#0d6efd 0%,#0099ff 100%);color:white;font-weight:900;font-size:0.6rem;align-items:center;justify-content:center;cursor:pointer;margin-left:2px;box-shadow:0 1px 4px rgba(13,110,253,0.3);">i</span>
                                </div>
                                <span class="fw-bold text-dark" id="val_makan">Rp 0</span>
                            </div>
                        </div>

                        <!-- TRANSPORT DARAT (jika bukan dari Jepara) -->
                        <div id="section-transport-darat" style="margin-bottom: 6px; border-bottom: 1px solid #f0f0f0; padding-bottom: 4px; display: none;">
                            <div class="d-flex justify-content-between align-items-center" style="font-size: 0.75rem;">
                                <div class="d-flex gap-1 align-items-center">
                                    <span class="badge bg-secondary me-1" style="font-size: 0.6rem;">+</span>
                                    <i class="bi bi-car-front text-secondary"></i>
                                    <span id="label_darat">Transport Darat PP</span>
                                    <span class="info-icon" data-info-key="transport_land" role="button" tabindex="0" style="display:inline-flex;width:14px;height:14px;border-radius:50%;background:linear-gradient(135deg,#0d6efd 0%,#0099ff 100%);color:white;font-weight:900;font-size:0.6rem;align-items:center;justify-content:center;cursor:pointer;margin-left:2px;box-shadow:0 1px 4px rgba(13,110,253,0.3);">i</span>
                                </div>
                                <span class="fw-bold text-dark" id="val_darat">Rp 0</span>
                            </div>
                        </div>

                        <!-- TOTAL -->
                        <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top border-2" style="gap: 6px;">
                            <span class="fw-bold text-dark" style="font-size: 0.95rem;"><i class="bi bi-receipt"></i> TOTAL</span>
                            <h5 class="fw-bold text-primary mb-0" id="val_grand_total" style="font-size: 1.2rem;">Rp 0</h5>
                        </div>
                        
                        <div class="text-center mt-1">
                            <small class="text-muted" style="font-size: 0.7rem;">Harga per orang: <span id="price-per-person" class="fw-bold text-primary">Rp 0</span></small>
                        </div>
                    </div>
                </div>
                
                <!-- WISATA SECTION - WHITE THEME (Matching Estimasi) -->
                <div style="margin-top: 4px;">
                <style>
                    .wisata-2027-container {
                        width: 100%;
                        padding: 0;
                    }
                    .wisata-2027-card {
                        background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(248,249,250,0.95) 100%);
                        border-radius: 16px;
                        height: 410px;
                        overflow-y: auto;
                        padding: 8px;
                        position: relative;
                        overflow: hidden;
                        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
                    }
                    .wisata-section-header {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        margin-bottom: 8px;
                        padding: 6px 4px;
                        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
                        border-bottom: 1.5px solid #e8eef7;
                        margin: -8px -8px 8px -8px;
                        padding: 6px 8px;
                        border-radius: 12px 12px 0 0;
                    }
                    .wisata-section-header.darat-header {
                        margin: 8px -8px 8px -8px;
                        border-radius: 0;
                        border-top: 1.5px solid #e8eef7;
                    }
                    .wisata-section-title {
                        display: flex;
                        align-items: center;
                        gap: 6px;
                        color: #0d6efd;
                        font-size: 0.75rem;
                        font-weight: 700;
                        letter-spacing: 0.3px;
                    }
                    .wisata-section-title i {
                        font-size: 0.85rem;
                        color: #0dcaf0;
                    }
                    .wisata-section-title.darat i {
                        color: #198754;
                    }
                    .wisata-badge {
                        font-size: 0.5rem;
                        padding: 2px 6px;
                        border-radius: 8px;
                        background: rgba(13,110,253,0.1);
                        color: #0d6efd;
                        border: 1px solid rgba(13,110,253,0.2);
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                        font-weight: 600;
                    }
                    .wisata-badge.darat {
                        background: rgba(25,135,84,0.1);
                        color: #198754;
                        border: 1px solid rgba(25,135,84,0.2);
                    }
                    .wisata-items-grid {
                        display: grid;
                        grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
                        gap: 6px;
                        padding: 0 4px;
                    }
                    .wisata-item-2027 {
                        background: #fff;
                        border: 1.5px solid #e8eef7;
                        border-radius: 10px;
                        padding: 8px;
                        cursor: pointer;
                        transition: all 0.2s ease;
                        position: relative;
                    }
                    .wisata-item-2027:hover {
                        border-color: #0d6efd;
                        transform: translateY(-1px);
                        box-shadow: 0 4px 12px rgba(13,110,253,0.15);
                    }
                    .wisata-item-2027.selected {
                        border-color: #198754;
                        background: linear-gradient(135deg, rgba(25,135,84,0.05) 0%, rgba(255,255,255,1) 100%);
                        box-shadow: 0 2px 8px rgba(25,135,84,0.2);
                    }
                    .wisata-item-2027.selected::after {
                        content: '✓';
                        position: absolute;
                        top: 4px;
                        right: 4px;
                        width: 14px;
                        height: 14px;
                        background: #198754;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 0.5rem;
                        color: white;
                        font-weight: bold;
                    }
                    .wisata-item-name {
                        color: #333;
                        font-size: 0.6rem;
                        font-weight: 600;
                        margin-bottom: 3px;
                        line-height: 1.2;
                        display: -webkit-box;
                        -webkit-line-clamp: 2;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                    }
                    .wisata-item-price {
                        color: #0d6efd;
                        font-size: 0.55rem;
                        font-weight: 700;
                    }
                    .wisata-empty-msg {
                        text-align: center;
                        padding: 15px;
                        color: #999;
                        font-size: 0.7rem;
                        font-style: italic;
                    }
                    @media (max-width: 576px) {
                        .wisata-items-grid {
                            grid-template-columns: repeat(2, 1fr);
                        }
                    }
                </style>
                
                <div class="wisata-2027-container">
                    <div class="wisata-2027-card" id="section-wisata">
                        <!-- WISATA LAUT -->
                        <div class="wisata-section-header">
                            <div class="wisata-section-title">
                                <i class="bi bi-tsunami"></i>
                                <span>WISATA LAUT</span>
                            </div>
                            <span class="wisata-badge">Pilih Aktivitas</span>
                        </div>
                        <div class="wisata-items-grid" id="container-tour-laut">
                            <div class="wisata-empty-msg">Pilih lokasi untuk melihat wisata</div>
                        </div>
                        
                        <!-- WISATA DARAT -->
                        <div class="wisata-section-header darat-header">
                            <div class="wisata-section-title darat">
                                <i class="bi bi-tree-fill"></i>
                                <span>WISATA DARAT</span>
                            </div>
                            <span class="wisata-badge darat">Min 3 Spot</span>
                        </div>
                        <div class="wisata-items-grid" id="container-tour-darat">
                            <div class="wisata-empty-msg">Pilih lokasi untuk melihat wisata</div>
                        </div>
                    </div>
                </div>
                </div>
                
                <!-- FASILITAS TAMBAHAN - COMPACT STYLE -->
                <div class="budget-box-elegant" style="padding: 10px; border-radius: 12px; margin-top: 4px;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="text-white fw-bold mb-0" style="font-size: 0.75rem;"><i class="bi bi-stars-fill"></i> FASILITAS TAMBAHAN</label>
                        <div class="d-flex gap-1">
                            <button type="button" class="btn btn-sm btn-outline-light rounded-circle" id="fasilitas-prev" style="width: 20px; height: 20px; padding: 0; font-size: 0.55rem;" onclick="slideFasilitasNav(-1)">‹</button>
                            <span class="fas-counter small fw-bold text-white align-self-center" style="min-width: 28px; text-align: center; font-size: 0.6rem;">1/1</span>
                            <button type="button" class="btn btn-sm btn-outline-light rounded-circle" id="fasilitas-next" style="width: 20px; height: 20px; padding: 0; font-size: 0.55rem;" onclick="slideFasilitasNav(1)">›</button>
                        </div>
                    </div>
                    <div class="fasilitas-carousel-container bg-white rounded-3 p-2" style="overflow: hidden;">
                        <div id="fasilitas-container" class="fasilitas-slides-wrapper" style="display: flex; transition: transform 0.3s ease;"></div>
                    </div>
                </div>
            </div>
        </div>

    <!-- MODAL DAPAT APA AJA -->
    <div class="modal fade" id="modalDapatApaAja" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                <div class="modal-header border-0" style="background: linear-gradient(135deg, #0d6efd, #6f42c1); border-radius: 16px 16px 0 0;">
                    <h5 class="modal-title text-white fw-bold"><i class="bi bi-gift"></i> Paket Anda Termasuk:</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modal-dapat-content" style="max-height: 60vh; overflow-y: auto;">
                    <!-- Content akan di-generate via JS -->
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-primary fw-bold px-4" data-bs-dismiss="modal">Mengerti!</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL JADWAL KAPAL -->
    <div class="modal fade" id="modalJadwalKapal" tabindex="-1" aria-labelledby="modalJadwalKapalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; background: #fff !important; opacity: 1 !important; visibility: visible !important;">
                <div class="modal-header border-0" style="background: linear-gradient(135deg, #06b6d4, #0891b2); border-radius: 16px 16px 0 0; color: white;">
                    <h5 class="modal-title fw-bold" id="modalJadwalKapalLabel"><i class="bi bi-calendar-event me-2"></i>Jadwal Keberangkatan Kapal ke Karimunjawa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto; padding: 20px; background: #fff;">
                    <div id="jadwal-kapal-list" class="row g-3">
                        <!-- Jadwal kapal akan di-load dari database -->
                        <div class="col-12 text-center">
                            <div class="spinner-border text-info" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 text-muted">Memuat jadwal kapal...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0" style="background: #fff;">
                    <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Tutup</button>
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success fw-bold">
                        <i class="bi bi-whatsapp me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-wide" style="margin-top: 50px; margin-bottom: 80px;">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <!-- Header dengan Gradient -->
            <div style="background: linear-gradient(135deg, #0d6efd, #6f42c1); color: white; padding: 40px 30px; text-align: center; display: flex; align-items: center; justify-content: space-between;">
                <div style="flex: 1;">
                    <h3 class="fw-bold mb-2" id="itinerary-title-header">📅 Itinerary Perjalanan 3 Hari 2 Malam</h3>
                    <p class="mb-0 small" style="opacity: 0.95;">Lihat rencana perjalanan lengkap Anda dari awal hingga akhir dengan detail aktivitas setiap hari</p>
                </div>
                <a href="<?= base_url('itinerary') ?>" id="btn-lihat-itinerary" class="btn btn-light btn-lg fw-bold rounded-pill" style="white-space: nowrap; margin-left: 20px;">
                    <i class="bi bi-eye"></i> Lihat Itinerary
                </a>
            </div>
        </div>
    </div>

    <div class="container-wide mb-5 pb-5">
        <hr class="my-5 border-secondary opacity-25">
        <h3 class="fw-bold text-dark mb-4"><i class="bi bi-fire text-danger"></i> <?= lang('Landing.promo_latest') ?></h3>
        <div class="row g-4">
            <?php if(!empty($promos)): foreach($promos as $p): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <?php if(!empty($p['image'])): ?>
                    <img src="<?= base_url('uploads/content/'.$p['image']) ?>" class="card-img-top" style="height:150px; object-fit:cover;">
                    <?php else: ?>
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:150px;">
                        <i class="bi bi-image text-muted" style="font-size:2rem;"></i>
                    </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h6 class="fw-bold"><?= esc($p['title'] ?? 'Promo') ?></h6>
                        <p class="small text-muted"><?= esc($p['description'] ?? '') ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center"><?= lang('Landing.no_promo') ?></div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    </div><!-- END OF ESTIMASI SECTION -->
    
    <!-- FLOATING TOTAL WIDGET -->
    <div class="floating-total-widget" id="floatingTotalWidget">
        <div class="floating-total-card" id="floatingTotalCard">
            <div class="floating-total-header">
                <div class="floating-total-icon">
                    <i class="bi bi-receipt"></i>
                </div>
                <div>
                    <div class="floating-total-label">Total Estimasi</div>
                </div>
            </div>
            <div class="floating-total-amount" id="floatingTotalAmount">Rp 0</div>
            <div class="floating-total-pax" id="floatingTotalPax">Harga per 1 orang</div>
            <div class="floating-total-info" style="font-size:0.68rem;color:#fffbe7;margin:6px 0 2px 0;line-height:1.3;font-weight:500;">
                <span style="color:#ffe082;">Ini total estimasi termurah</span> liburan ke Karimunjawa 3H2M.<br>
                Kamu bisa <b>upgrade</b> dengan klik pilihan yang ada. Buat liburanmu makin seru dan sesuai keinginan!
            </div>
            <button class="floating-total-btn" onclick="window.open('<?= !empty($settings['footer_whatsapp']) ? esc($settings['footer_whatsapp']) : 'https://wa.me/6281234567890' ?>', '_blank')">
                <i class="bi bi-whatsapp"></i>
                <?= lang('Landing.contact_admin') ?>
            </button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-moving-marker/1.0.0/moving-marker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
    // 1. DATA DARI CONTROLLER
    const dbKota      = <?= $json_kota_asal ?? '{}' ?>;
    const dbKapal     = <?= $json_kapal ?? '[]' ?>; 
    const dbLokal     = <?= $json_lokal ?? '[]' ?>;
    const dbHotels    = <?= $json_hotels ?? '[]' ?>;
    const dbTourLaut  = <?= $json_tour_laut ?? '[]' ?>;  // Data Laut
    const dbTourDarat = <?= $json_tour_darat ?? '[]' ?>; // Data Darat
    const itinerary2d = <?= $json_itinerary_2d ?? '[]' ?>;
    const itinerary3d = <?= $json_itinerary_3d ?? '[]' ?>;
    const itinerary4d = <?= $json_itinerary_4d ?? '[]' ?>;
    const dbFas       = <?= $json_fasilitas ?? '[]' ?>; 
    const dbGuide     = <?= $json_guide ?? '[]' ?>;
    const estimasiSettings = <?= $json_estimasi_settings ?? '{}' ?>;
    
    // ==================== SECTION SWITCHING FUNCTION ====================
    // ==================== OPEN SLIDE LINK (IMAGE CLICK) ====================
    function openSlideLink(slideElement) {
        const buttonUrl = slideElement.getAttribute('data-button-url');
        
        if (!buttonUrl) {
            console.log('No link configured for this slide');
            return;
        }
        
        console.log('🔗 Opening slide link:', buttonUrl);
        
        // Check if it's a JavaScript function call
        if (buttonUrl.startsWith('javascript:') || buttonUrl.startsWith('showSection(')) {
            // Execute JavaScript function
            try {
                eval(buttonUrl.replace('javascript:', ''));
                console.log('✅ Executed JavaScript:', buttonUrl);
            } catch (e) {
                console.error('❌ Error executing JavaScript:', e.message);
            }
        } else if (buttonUrl.startsWith('http://') || buttonUrl.startsWith('https://')) {
            // Open external URL in new tab
            window.open(buttonUrl, '_blank');
            console.log('✅ Opened external link in new tab:', buttonUrl);
        } else if (buttonUrl.startsWith('/')) {
            // Navigate to internal page
            window.location.href = buttonUrl;
            console.log('✅ Navigating to:', buttonUrl);
        } else {
            console.warn('⚠️ Unknown link format:', buttonUrl);
        }
    }
    
    // ==================== SHOW SECTION ====================
    function showSection(section) {
        const promoSection = document.getElementById('section-promo');
        const estimasiSection = document.getElementById('section-estimasi');
        const tabHome = document.getElementById('tab-home');
        const tabEstimasi = document.getElementById('tab-estimasi');
        const floatingWidget = document.getElementById('floatingTotalWidget');
        const welcomeHeader = document.getElementById('welcome-header');
        
        if (section === 'promo') {
            promoSection.classList.remove('section-hidden');
            promoSection.classList.add('section-visible');
            estimasiSection.classList.remove('section-visible');
            estimasiSection.classList.add('section-hidden');
            tabHome.classList.add('active');
            tabEstimasi.classList.remove('active');
            if(floatingWidget) floatingWidget.style.display = 'none';
            if(welcomeHeader) welcomeHeader.style.display = 'block';
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else if (section === 'estimasi') {
            promoSection.classList.remove('section-visible');
            promoSection.classList.add('section-hidden');
            estimasiSection.classList.remove('section-hidden');
            estimasiSection.classList.add('section-visible');
            tabHome.classList.remove('active');
            tabEstimasi.classList.add('active');
            if(floatingWidget) floatingWidget.style.display = 'block';
            if(welcomeHeader) welcomeHeader.style.display = 'none';
            
            // Re-initialize map after showing and reset to Indonesia view
            setTimeout(() => {
                if(typeof map !== 'undefined') {
                    map.invalidateSize();
                    // Reset map to Indonesia view for user to zoom and find their location
                    map.setView([-2.5, 118.0], 5);
                }
            }, 150);
            
            // Scroll to estimation section (below navbar)
            setTimeout(() => {
                const navbarHeight = document.querySelector('.navbar-top')?.offsetHeight || 80;
                const estimasiTop = estimasiSection.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 20;
                window.scrollTo({ top: estimasiTop, behavior: 'smooth' });
            }, 100);
        }
    }
    
    // ==================== UPDATE FLOATING TOTAL ====================
    function updateFloatingTotal(total, orang) {
        const floatingAmount = document.getElementById('floatingTotalAmount');
        const floatingPax = document.getElementById('floatingTotalPax');
        const floatingCard = document.getElementById('floatingTotalCard');
        
        if (floatingAmount) {
            const formattedTotal = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(total);
            floatingAmount.textContent = formattedTotal;
        }
        
        if (floatingPax) {
            floatingPax.textContent = `Harga per ${orang} orang`;
        }
        
        // Add pulse animation
        if (floatingCard) {
            floatingCard.classList.remove('pulse');
            void floatingCard.offsetWidth; // Trigger reflow
            floatingCard.classList.add('pulse');
        }
    }
    
    // DEBUG
    console.log('Data loaded:');
    console.log('dbTourLaut count:', dbTourLaut.length);
    console.log('dbTourDarat count:', dbTourDarat.length);
    console.log('dbHotels count:', dbHotels.length);
    
    const HARGA_MAKAN = 25000;
    const BASE_UPLOADS_URL = '<?= base_url("uploads/") ?>';
    const jeparaLoc   = <?= $coord_jepara ?? '{"lat":-6.5950,"lng":110.6690}' ?>;
    const karimunLoc  = <?= $coord_karimun ?? '{"lat":-5.8465,"lng":110.4371}' ?>;

    let state = {
        budget: 0, orang: 1, durasi: 3, selectedKotaKey: null,
        biaya: { darat:0, laut:0, lokal:0, hotel:0, guide:0 }, // Harga Satuan
        selectedTourLaut: [], 
        selectedTourDarat: [],
        selectedFacilities: [], 
        totalEstimasi: 0
    };

    // MAP INIT - Start with Indonesia view so users can zoom and find their location
    const map = L.map('map', { 
        zoomControl: true, 
        minZoom: 4, 
        maxZoom: 15, 
        maxBounds: [[-11.5, 92.0], [6.0, 141.5]],
        scrollWheelZoom: true
    }).setView([-2.5, 118.0], 5);
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://carto.com/">CARTO</a>'
    }).addTo(map);
    
    // Add zoom control to top-right
    L.control.zoom({ position: 'topright' }).addTo(map);
    
    let routeControl = null, polylineSea = null, shipMarker = null;

    $(document).ready(function() {
        $('#kota_asal').select2({ theme: 'bootstrap-5', placeholder: 'Pilih Kota...', allowClear: true });
        $('#kota_asal').on('select2:select', function (e) { manualSelectCity(e.params.data.id); });

        Object.keys(dbKota).forEach(kota => {
            const m = L.marker([dbKota[kota].coords.lat, dbKota[kota].coords.lng]).addTo(map);
            m.on('click', function() { $('#kota_asal').val(kota).trigger('change'); manualSelectCity(kota); });
            $('#kota_asal').append(new Option(kota, kota, false, false));
        });
        
        // Render Awal
        renderHotels(); 
        renderDestinations(); 
        renderFacilities();
        autoSelectDefaults(); // Pilih destinasi default jika data ada
        updateItineraryButton(); // Update itinerary button link default (3 hari)
        
        // AUTO-SELECT JEPARA sebagai default
        const jeparaKey = Object.keys(dbKota).find(k => k.toLowerCase().includes('jepara'));
        if (jeparaKey) {
            $('#kota_asal').val(jeparaKey).trigger('change');
            manualSelectCity(jeparaKey);
        } else {
            reCalculate(); // Fallback jika Jepara tidak ada
        }
    });

    function manualSelectCity(kotaKey) {
        state.selectedKotaKey = kotaKey;
        
        // Update label transportasi darat dengan nama kota yang dipilih (PP)
        document.getElementById('label_darat').innerText = kotaKey + ' ↔ Jepara (PP)';
        
        if(routeControl) map.removeControl(routeControl);
        if(polylineSea) map.removeLayer(polylineSea);
        if(shipMarker) map.removeLayer(shipMarker);

        drawSeaRouteOnly();
        if (!kotaKey.toLowerCase().includes('jepara')) {
            let waypoints = [L.latLng(dbKota[kotaKey].coords.lat, dbKota[kotaKey].coords.lng)];
            if(kotaKey.toLowerCase().includes('solo')) waypoints.push(L.latLng(-7.2575, 110.4262));
            waypoints.push(L.latLng(jeparaLoc.lat, jeparaLoc.lng));
            routeControl = L.Routing.control({ waypoints: waypoints, router: L.Routing.osrmv1({serviceUrl: 'https://router.project-osrm.org/route/v1'}), lineOptions: {styles: [{color: '#0d6efd', opacity: 0.7, weight: 5}]}, createMarker: function() { return null; }, show: false, addWaypoints: false, fitSelectedRoutes: true }).addTo(map);
        }
        
        autoRecommend(kotaKey); // Hitung harga
    }

    function drawSeaRouteOnly() {
        const curvePoints = [[jeparaLoc.lat, jeparaLoc.lng], [-6.45, 110.60], [-6.30, 110.52], [-6.15, 110.45], [karimunLoc.lat, karimunLoc.lng]];
        polylineSea = L.polyline(curvePoints, {color: '#0dcaf0', dashArray: '10,10', weight: 4, opacity: 0.8}).addTo(map);
        map.fitBounds(polylineSea.getBounds(), {padding:[50,50]});
    }

    // --- LOGIKA REKOMENDASI OTOMATIS ---
    function autoRecommend(kotaKey) {
        state.orang  = parseInt(document.getElementById('jml_orang').value) || 1;
        
        // 1. Set Transport Darat
        if (kotaKey && kotaKey.toLowerCase().includes('jepara')) {
            state.biaya.darat = 0; 
        } else if (kotaKey && dbKota[kotaKey].opsi.length > 0) {
            // Ambil termurah
            state.biaya.darat = parseInt(dbKota[kotaKey].opsi.sort((a,b)=>a.price_publish-b.price_publish)[0].price_publish);
        }

        // 2. Set Transport Laut (Termurah)
        if(dbKapal.length > 0) state.biaya.laut = parseInt(dbKapal.sort((a,b)=>a.price_publish-b.price_publish)[0].price_publish);

        // 3. Set Lokal Rental (Termurah) + Update Label
        if(dbLokal.length > 0) {
            let sortedLokal = [...dbLokal].sort((a,b)=>a.price_publish-b.price_publish);
            state.biaya.lokal = parseInt(sortedLokal[0].price_publish);
            document.getElementById('label_lokal').innerText = sortedLokal[0].name + ' (Termurah)';
        }

        // 4. Set Hotel (Jika belum ada yg dipilih)
        if(state.biaya.hotel === 0 && dbHotels.length > 0) {
            let sorted = dbHotels.sort((a,b)=>a.price_publish-b.price_publish);
            selectHotel(null, sorted[0].name, sorted[0].id, sorted[0].price_publish);
        }

        // 5. Set Guide
        if(dbGuide.length > 0) state.biaya.guide = parseInt(dbGuide.sort((a,b)=>a.price_publish-b.price_publish)[0].price_publish);

        // 6. Tampilkan section wisata laut & darat
        showWisataSection();

        reCalculate();
    }

    function showWisataSection() {
        // Tampilkan section wisata hanya jika sudah pilih titik jemput (kota)
        if(state.selectedKotaKey) {
            // Semua field sudah visible, tidak perlu hide/show individual
            let sectionWisata = document.getElementById('section-wisata');
            if (sectionWisata) sectionWisata.style.display = 'block';
        } else {
            let sectionWisata = document.getElementById('section-wisata');
            if (sectionWisata) sectionWisata.style.display = 'none';
        }
    }

    // --- HITUNG ULANG TOTAL (DIPERBAIKI) ---
    function calculateCurrentTotal() {
        // Hitung total estimasi tanpa hotel (untuk mengetahui sisa budget)
        state.orang  = parseInt(document.getElementById('jml_orang').value) || 1;
        state.durasi = parseInt(document.getElementById('durasi').value) || 3;
        
        let durasiMalam = Math.max(1, state.durasi - 1);
        let hariWisata  = 1;
        let jmlKamar    = Math.ceil(state.orang / 2);
        let jmlMobil    = state.durasi;
        let jmlMakan    = state.durasi * 3;

        let totDarat = state.biaya.darat * state.orang * 2;
        let totLaut  = state.biaya.laut * state.orang * 2;
        
        let totTourLaut = 0;
        state.selectedTourLaut.forEach(i => { totTourLaut += parseInt(dbTourLaut[i].price_publish) * state.orang; });
        
        let totTourDarat = 0;
        state.selectedTourDarat.forEach(i => { totTourDarat += parseInt(dbTourDarat[i].price_publish) * state.orang; });

        let jmlGuide = Math.ceil(state.orang / 8);
        let totGuide = state.biaya.guide * jmlGuide * hariWisata;

        let totLokal = state.biaya.lokal * jmlMobil;
        let totMakan = HARGA_MAKAN * jmlMakan * state.orang;

        let totFas = 0;
        state.selectedFacilities.forEach(i => { totFas += parseInt(dbFas[i].price_publish); });

        // Return total TANPA hotel (untuk kalkulasi sisa budget)
        return totDarat + totLaut + totLokal + totTourLaut + totTourDarat + totGuide + totMakan + totFas;
    }

    function reCalculate() {
        state.orang  = parseInt(document.getElementById('jml_orang').value) || 1;
        state.durasi = parseInt(document.getElementById('durasi').value) || 3;
        
        // Update duration label (3 days = 3D 2M format)
        const daysLabel = state.durasi + 'D ' + (state.durasi - 1) + 'M';
        document.getElementById('duration-label').innerText = '(' + daysLabel + ')';
        
        // Variabel Pengali
        let durasiMalam = Math.max(1, state.durasi - 1);  // Malam di hotel (3 days = 2 nights)
        let hariWisata  = 1;                               // Guide: selalu 1 hari untuk wisata darat
        // Hotel: Kalkulasi Ruangan
        // - 1-2 pax = 1 kamar, 3-4 pax = 2 kamar, dst (1 kamar untuk 2 orang)
        let jmlKamar    = Math.ceil(state.orang / 2);
        let jmlMobil    = state.durasi;                    // Rental motor: jumlah hari penuh (3 days = 3 hari rental)
        let jmlMakan    = state.durasi * 3;                // Konsumsi: 3x makan per hari (3 days = 9x makan)

        // A. HITUNG PER ITEM (TOTAL)
        // 1. Tiket Kapal PP (Pergi + Pulang)
        let totKapalPP = state.biaya.laut * state.orang * 2; // PP = 2x perjalanan
        // Transport Darat (PP) - hanya jika bukan dari Jepara
        let totDarat = state.biaya.darat * state.orang * 2;
        
        // 2. Penginapan
        let totHotel = state.biaya.hotel * jmlKamar * durasiMalam;
        
        // 3. Sewa Motor/Mobil
        let totLokal = state.biaya.lokal * jmlMobil;
        
        // 4. Tour Darat + Guide
        let totTourDarat = 0;
        state.selectedTourDarat.forEach(i => { totTourDarat += parseInt(dbTourDarat[i].price_publish) * state.orang; });
        let jmlGuide = Math.ceil(state.orang / 8);
        let totGuide = state.biaya.guide * jmlGuide * hariWisata;
        let totDaratGuide = totTourDarat + totGuide;
        
        // 5. Tour Laut / Wisata Laut
        let totTourLaut = 0;
        state.selectedTourLaut.forEach(i => { totTourLaut += parseInt(dbTourLaut[i].price_publish) * state.orang; });
        
        // 6. Makan
        let totMakan = HARGA_MAKAN * jmlMakan * state.orang;

        // Fasilitas Lain
        let totFas = 0;
        state.selectedFacilities.forEach(i => { totFas += parseInt(dbFas[i].price_publish); });

        // B. TOTAL ESTIMASI
        state.totalEstimasi = totKapalPP + totDarat + totHotel + totLokal + totDaratGuide + totTourLaut + totMakan + totFas;

        // C. UPDATE TAMPILAN SESUAI URUTAN BARU
        // 1. Tiket Kapal PP
        document.getElementById('val_kapal_pp').innerText = "Rp " + fmt(totKapalPP);
        // 2. Penginapan
        document.getElementById('val_hotel').innerText = "Rp " + fmt(totHotel);
        // 3. Sewa Motor/Mobil
        document.getElementById('val_lokal').innerText = "Rp " + fmt(totLokal);
        // 4. Tour Darat + Guide
        document.getElementById('val_darat_guide').innerText = "Rp " + fmt(totDaratGuide);
        // 5. Wisata Laut
        document.getElementById('val_wisata_laut').innerText = "Rp " + fmt(totTourLaut);
        // 6. Makan
        document.getElementById('val_makan').innerText = "Rp " + fmt(totMakan);
        // Transport Darat (opsional)
        document.getElementById('val_darat').innerText = "Rp " + fmt(totDarat);
        
        // Show/hide transport darat section based on origin
        let sectionDarat = document.getElementById('section-transport-darat');
        if (sectionDarat) {
            sectionDarat.style.display = (state.selectedKotaKey && state.selectedKotaKey !== 'jepara') ? 'block' : 'none';
        }
        
        document.getElementById('val_grand_total').innerText = "Rp " + fmt(state.totalEstimasi);
        
        // Update price per person
        let pricePerPerson = document.getElementById('price-per-person');
        if (pricePerPerson) {
            pricePerPerson.innerText = "Rp " + fmt(Math.ceil(state.totalEstimasi / state.orang));
        }
        
        // Update floating total widget
        updateFloatingTotal(state.totalEstimasi, state.orang);
        
        checkBudget();
    }

    // --- CAROUSEL FUNCTIONS ---
    let hotelCurrentPage = 0;
    let hotelTotalPages = 1;
    
    function slideHotel(direction) {
        const container = document.getElementById('hotel-list-container');
        const totalSlides = parseInt(container.getAttribute('data-slides') || '1');
        let currentSlide = parseInt(container.getAttribute('data-current-slide') || '0');
        
        currentSlide += direction;
        if (currentSlide < 0) currentSlide = 0;
        if (currentSlide >= totalSlides) currentSlide = totalSlides - 1;
        
        showHotelSlide(currentSlide);
        updateHotelNav(currentSlide, totalSlides);
    }
    
    function updateHotelNav(current, total) {
        const prevBtn = document.getElementById('hotel-prev');
        const nextBtn = document.getElementById('hotel-next');
        const counter = document.querySelector('.hotel-counter');
        
        if (prevBtn) prevBtn.disabled = (current <= 0);
        if (nextBtn) nextBtn.disabled = (current >= total - 1);
        if (counter) counter.textContent = `${current + 1}/${total}`;
    }
    
    function nextHotelSlide() {
        const container = document.getElementById('hotel-list-container');
        const currentSlide = parseInt(container.getAttribute('data-current-slide'));
        const totalSlides = parseInt(container.getAttribute('data-slides'));
        const nextSlide = (currentSlide + 1) % totalSlides;
        showHotelSlide(nextSlide);
    }

    function prevHotelSlide() {
        const container = document.getElementById('hotel-list-container');
        const currentSlide = parseInt(container.getAttribute('data-current-slide'));
        const totalSlides = parseInt(container.getAttribute('data-slides'));
        const prevSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showHotelSlide(prevSlide);
    }

    function showHotelSlide(slideIdx) {
        const container = document.getElementById('hotel-list-container');
        const slides = container.querySelectorAll('.hotel-slide');
        
        slides.forEach((slide, idx) => {
            slide.classList.remove('active');
            if(idx === slideIdx) slide.classList.add('active');
        });
        
        document.getElementById('current-slide').innerText = slideIdx + 1;
        container.setAttribute('data-current-slide', slideIdx);
    }

    // --- HOTEL GALLERY ---
    function openHotelGallery(hotelId, hotelName, event) {
        event.stopPropagation();
        const hotel = dbHotels.find(h => h.id == hotelId);
        if (!hotel) return;

        currentGalleryHotelId = hotelId;
        currentGalleryImages = [];
        currentGalleryIndex = 0;

        if (hotel.gallery && hotel.gallery.length > 0) {
            hotel.gallery.forEach(g => {
                if (g.image_url) {
                    let imgPath = g.image_url.startsWith('http') ? g.image_url : BASE_UPLOADS_URL + g.image_url;
                    currentGalleryImages.push(imgPath);
                }
            });
        }

        if (hotel.image_url && currentGalleryImages.length === 0) {
            let imgPath = hotel.image_url.startsWith('http') ? hotel.image_url : BASE_UPLOADS_URL + hotel.image_url;
            currentGalleryImages.push(imgPath);
        }

        if (currentGalleryImages.length === 0) {
            currentGalleryImages.push('https://via.placeholder.com/400x300?text=No+Image');
        }

        renderGalleryModal(hotelName);
        const overlay = document.getElementById('gallery-modal-overlay');
        overlay.style.display = 'flex';
    }

    // --- RENDER FUNGSI ---
    function selectHotel(el, name, id, price) {
        state.biaya.hotel = parseInt(price);
        document.getElementById('label_hotel').innerText = name;
        document.querySelectorAll('.hotel-card-2027').forEach(c => c.style.borderColor = 'transparent');
        // Logic visual checked dihandle CSS
        reCalculate();
    }

    function selectLokal(el) {
        const idx = parseInt(el.value);
        if(idx >= 0 && idx < dbLokal.length) {
            state.biaya.lokal = parseInt(dbLokal[idx].price_publish);
            document.getElementById('label_lokal').innerText = dbLokal[idx].name;
        } else {
            state.biaya.lokal = 0;
            document.getElementById('label_lokal').innerText = 'Belum dipilih';
        }
        reCalculate();
    }

    function renderDestinations() {
        const cLaut = document.getElementById('container-tour-laut');
        const cDarat = document.getElementById('container-tour-darat');
        
        // Laut - Style 2027
        cLaut.innerHTML = '';
        if(dbTourLaut.length === 0) {
            cLaut.innerHTML = '<div class="text-center" style="color: rgba(255,255,255,0.5); font-size: 0.7rem; padding: 20px;">Data wisata laut kosong</div>';
        } else {
            dbTourLaut.forEach((d, i) => {
                let isSel = state.selectedTourLaut.includes(i);
                let selClass = isSel ? 'selected' : '';
                cLaut.innerHTML += `
                    <div class="wisata-item-2027 ${selClass}" onclick="toggleTourLaut(${i})">
                        <div class="wisata-item-name">${d.name}</div>
                        <div class="wisata-item-price">Rp ${fmt(d.price_publish * state.orang)}</div>
                    </div>`;
            });
        }

        // Darat - Style 2027
        cDarat.innerHTML = '';
        if(dbTourDarat.length === 0) {
            cDarat.innerHTML = '<div class="text-center" style="color: rgba(255,255,255,0.5); font-size: 0.7rem; padding: 20px;">Data wisata darat kosong</div>';
        } else {
            dbTourDarat.forEach((d, i) => {
                let isSel = state.selectedTourDarat.includes(i);
                let selClass = isSel ? 'selected' : '';
                cDarat.innerHTML += `
                    <div class="wisata-item-2027 ${selClass}" onclick="toggleTourDarat(${i})">
                        <div class="wisata-item-name">${d.name}</div>
                        <div class="wisata-item-price">Rp ${fmt(d.price_publish * state.orang)}</div>
                    </div>`;
            });
        }
    }

    function toggleTourLaut(i) {
        if(state.selectedTourLaut.includes(i)) state.selectedTourLaut = state.selectedTourLaut.filter(x=>x!==i);
        else state.selectedTourLaut.push(i); // Tidak ada limit untuk wisata laut
        renderDestinations(); reCalculate();
    }

    function toggleTourDarat(i) {
        if(state.selectedTourDarat.includes(i)) state.selectedTourDarat = state.selectedTourDarat.filter(x=>x!==i);
        else state.selectedTourDarat.push(i);
        renderDestinations(); reCalculate();
    }

    function renderFacilities() {
        const c = document.getElementById('fasilitas-container');
        c.innerHTML = '';
        
        if(dbFas.length === 0) {
            c.innerHTML = '<div class="small text-muted" style="grid-column: 1/-1;">Data fasilitas tambahan kosong.</div>';
            return;
        }
        
        // Carousel logic: 3 items per slide (1 baris)
        const itemsPerSlide = 3;
        const totalSlides = Math.ceil(dbFas.length / itemsPerSlide);
        let slideHTML = '';
        for(let slide = 0; slide < totalSlides; slide++) {
            let slideContent = '<div class="fasilitas-slide">';
            for(let i = slide * itemsPerSlide; i < (slide + 1) * itemsPerSlide && i < dbFas.length; i++) {
                const f = dbFas[i];
                let isSel = state.selectedFacilities.includes(i);
                let checked = isSel ? 'checked' : '';
                slideContent += `<div class="fasilitas-card${isSel ? ' selected' : ''}" onclick="toggleFacility(${i})">
                    <input class="form-check-input" type="checkbox" id="fas_${i}" ${checked} style="cursor:pointer;">
                    <label class="form-check-label" for="fas_${i}">${f.name}</label>
                    <div class="fasilitas-price">Rp ${fmt(f.price_publish)}</div>
                </div>`;
            }
            slideContent += '</div>';
            slideHTML += slideContent;
        }
        c.innerHTML = slideHTML;
        c.style.display = 'flex';
        c.style.transition = 'transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        window.fasilitasCurrentSlide = 0;
        window.fasisliasSlides = totalSlides;
        updateFasilitasCounter();
        updateFasilitasNav();
    }

    function slideFasilitasNav(direction) {
        const c = document.getElementById('fasilitas-container');
        const slides = c.querySelectorAll('.fasilitas-slide');
        
        if(direction === 1) {
            if(window.fasilitasCurrentSlide < slides.length - 1) window.fasilitasCurrentSlide++;
        } else {
            if(window.fasilitasCurrentSlide > 0) window.fasilitasCurrentSlide--;
        }
        
        c.style.transform = `translateX(-${window.fasilitasCurrentSlide * 100}%)`;
        updateFasilitasCounter();
        updateFasilitasNav();
    }

    function updateFasilitasCounter() {
        const counter = document.querySelector('.fas-counter');
        if(counter) {
            const total = window.fasisliasSlides || 1;
            const current = (window.fasilitasCurrentSlide || 0) + 1;
            counter.textContent = `${current}/${total}`;
        }
    }

    function updateFasilitasNav() {
        const prevBtn = document.getElementById('fasilitas-prev');
        const nextBtn = document.getElementById('fasilitas-next');
        const totalSlides = window.fasisliasSlides || 1;
        const currentSlide = window.fasilitasCurrentSlide || 0;
        
        if(prevBtn) prevBtn.disabled = currentSlide === 0;
        if(nextBtn) nextBtn.disabled = currentSlide === totalSlides - 1;
    }

    function toggleFacility(i) {
        if(state.selectedFacilities.includes(i)) {
            state.selectedFacilities = state.selectedFacilities.filter(x=>x!==i);
        } else {
            state.selectedFacilities.push(i);
        }
        renderFacilities();
        reCalculate();
    }

    function renderHotels() {
        const c = document.getElementById('hotel-list-container');
        c.innerHTML = '';
        if(dbHotels.length === 0) {
            c.innerHTML = '<div class="col-12 small text-muted">Data hotel kosong.</div>';
            return;
        }
        
        // Calculate visible rows (4 per row, showing 2 rows = 8 items per slide)
        const itemsPerSlide = 8;
        const slides = [];
        for(let i = 0; i < dbHotels.length; i += itemsPerSlide) {
            slides.push(dbHotels.slice(i, i + itemsPerSlide));
        }
        
        // Create carousel HTML
        let carouselHTML = `<div class="hotel-carousel-container">
            <div class="hotel-carousel" id="hotel-carousel">`;
        
        slides.forEach((slide, slideIdx) => {
            carouselHTML += `<div class="hotel-slide ${slideIdx === 0 ? 'active' : ''}">
                <div class="row g-1 justify-content-center">`;
            
            slide.forEach(h => {
                let pricePerNight = parseInt(h.price_publish);
                let remainingBudget = state.budget ? (state.budget - calculateCurrentTotal()) : 0;
                let imgSrc = h.image_url ? (h.image_url.startsWith('http')?h.image_url:BASE_UPLOADS_URL+h.image_url) : 'https://via.placeholder.com/300';
                let isSel = (h.name === document.getElementById('label_hotel').innerText);
                
                carouselHTML += `<div class="col-6 col-sm-4 col-lg-3">
                    <input type="radio" name="hotel_id" id="hotel_${h.id}" class="d-none hotel-radio" ${isSel?'checked':''} onclick="selectHotel(this, '${h.name}', ${h.id}, ${h.price_publish})">
                    <label for="hotel_${h.id}" class="hotel-card-2027 position-relative d-flex flex-column">
                        <div class="hotel-img-wrapper">
                            <div class="price-badge-2027">Rp ${fmt(pricePerNight)}</div>
                            <div class="checkmark-overlay"><i class="bi bi-check-lg"></i></div>
                            <div class="gallery-icon-overlay" onclick="event.stopPropagation(); openHotelGallery(${h.id}, '${h.name}', event)" style="cursor: pointer;"><i class="bi bi-images"></i></div>
                            <img src="${imgSrc}" class="hotel-img-2027" style="cursor: pointer;" onclick="event.stopPropagation(); openHotelGallery(${h.id}, '${h.name}', event)">
                        </div>
                        <div class="hotel-info-section">
                            <h6>${h.name}</h6>
                        </div>
                    </label>
                </div>`;
            });
            
            carouselHTML += `</div></div>`;
        });
        
        carouselHTML += `</div></div>`;
        
        c.innerHTML = carouselHTML;
        
        // Store slide count for carousel navigation
        c.setAttribute('data-slides', slides.length);
        c.setAttribute('data-current-slide', '0');
        
        // Update navigation buttons
        updateHotelNav(0, slides.length);
    }

    function autoSelectDefaults() {
        // Otomatis pilih 1 wisata laut termurah (open trip paling murah)
        let sortedLaut = [...dbTourLaut].sort((a,b)=>a.price_publish-b.price_publish);
        if(sortedLaut.length > 0) state.selectedTourLaut = [dbTourLaut.indexOf(sortedLaut[0])];
        
        // Otomatis pilih 3 wisata darat termurah (minimal 3 spot)
        let sortedDarat = [...dbTourDarat].sort((a,b)=>a.price_publish-b.price_publish);
        state.selectedTourDarat = [];
        for(let i = 0; i < Math.min(3, sortedDarat.length); i++) {
            state.selectedTourDarat.push(dbTourDarat.indexOf(sortedDarat[i]));
        }
        
        renderDestinations();
    }

    function fmt(n) { return new Intl.NumberFormat('id-ID').format(n); }
    
    // === BUDGET CHECK & RECOMMENDATIONS ===
    function checkBudget() {
        const budgetInput = document.getElementById('budget_user');
        const budget = parseInt(budgetInput.value) || 0;
        const feedbackDiv = document.getElementById('budget-feedback');
        const statusDiv = document.getElementById('budget-status');
        const upgradeDiv = document.getElementById('upgrade-recommendations');
        const upgradeList = document.getElementById('upgrade-list');
        
        if (budget <= 0) {
            feedbackDiv.classList.add('d-none');
            return;
        }
        
        feedbackDiv.classList.remove('d-none');
        
        const totalEstimasi = state.totalEstimasi;
        const sisa = budget - totalEstimasi;
        
        document.getElementById('budget-total-estimasi').innerText = 'Rp ' + fmt(totalEstimasi);
        document.getElementById('sisa-uang').innerText = 'Rp ' + fmt(Math.abs(sisa));
        
        // Status berdasarkan sisa
        if (sisa >= 0) {
            document.getElementById('sisa-uang').style.color = '#00ff88';
            statusDiv.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i> Budget CUKUP!';
            statusDiv.style.background = 'rgba(0, 255, 136, 0.2)';
            statusDiv.style.color = '#00ff88';
            
            // Jika ada sisa, tampilkan rekomendasi upgrade
            if (sisa >= 50000) {
                showUpgradeRecommendations(sisa);
            } else {
                upgradeDiv.classList.add('d-none');
            }
        } else {
            document.getElementById('sisa-uang').style.color = '#ff6b6b';
            document.getElementById('sisa-uang').innerText = '-Rp ' + fmt(Math.abs(sisa));
            statusDiv.innerHTML = '<i class="bi bi-exclamation-triangle-fill"></i> Budget KURANG ' + fmt(Math.abs(sisa));
            statusDiv.style.background = 'rgba(255, 107, 107, 0.2)';
            statusDiv.style.color = '#ff6b6b';
            upgradeDiv.classList.add('d-none');
        }
    }
    
    function showUpgradeRecommendations(sisaBudget) {
        const upgradeDiv = document.getElementById('upgrade-recommendations');
        const upgradeList = document.getElementById('upgrade-list');
        
        let recommendations = [];
        
        // 1. Cek upgrade hotel
        const currentHotelPrice = state.biaya.hotel;
        const betterHotels = dbHotels.filter(h => {
            const price = parseInt(h.price_publish);
            const diff = price - currentHotelPrice;
            return diff > 0 && diff <= sisaBudget;
        }).sort((a,b) => a.price_publish - b.price_publish).slice(0, 2);
        
        betterHotels.forEach(h => {
            const diff = parseInt(h.price_publish) - currentHotelPrice;
            recommendations.push({
                type: 'hotel',
                icon: 'bi-building',
                text: `Upgrade ke ${h.name}`,
                price: '+Rp ' + fmt(diff * Math.max(1, state.durasi - 1) * Math.ceil(state.orang / 2))
            });
        });
        
        // 2. Cek tambahan wisata laut
        dbTourLaut.forEach((w, idx) => {
            if (!state.selectedTourLaut.includes(idx)) {
                const price = parseInt(w.price_publish) * state.orang;
                if (price <= sisaBudget) {
                    recommendations.push({
                        type: 'wisata_laut',
                        icon: 'bi-water',
                        text: `Tambah: ${w.name}`,
                        price: '+Rp ' + fmt(price)
                    });
                }
            }
        });
        
        // 3. Cek fasilitas tambahan
        dbFas.forEach((f, idx) => {
            if (!state.selectedFacilities.includes(idx)) {
                const price = parseInt(f.price_publish);
                if (price <= sisaBudget) {
                    recommendations.push({
                        type: 'fasilitas',
                        icon: 'bi-stars',
                        text: `Tambah: ${f.name}`,
                        price: '+Rp ' + fmt(price)
                    });
                }
            }
        });
        
        // Tampilkan max 4 rekomendasi
        if (recommendations.length > 0) {
            upgradeDiv.classList.remove('d-none');
            upgradeList.innerHTML = recommendations.slice(0, 4).map(r => `
                <div class="d-flex justify-content-between align-items-center text-white py-1" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <span><i class="bi ${r.icon} me-1"></i> ${r.text}</span>
                    <span class="text-warning fw-bold">${r.price}</span>
                </div>
            `).join('');
        } else {
            upgradeDiv.classList.add('d-none');
        }
    }
    
    // === MODAL DAPAT APA AJA ===
    function showDapatApaAja() {
        const content = document.getElementById('modal-dapat-content');
        const durasi = state.durasi;
        const orang = state.orang;
        const durasiMalam = Math.max(1, durasi - 1);
        
        // Ambil nama hotel yang dipilih
        const hotelName = document.getElementById('label_hotel').innerText;
        
        // Ambil wisata yang dipilih
        const wisataLautNames = state.selectedTourLaut.map(i => dbTourLaut[i]?.name || '-');
        const wisataDaratNames = state.selectedTourDarat.map(i => dbTourDarat[i]?.name || '-');
        const fasilitasNames = state.selectedFacilities.map(i => dbFas[i]?.name || '-');
        
        // Ambil transport lokal
        const lokalName = document.getElementById('label_lokal').innerText || 'Belum dipilih';
        
        let html = `
            <div class="p-2">
                <h6 class="fw-bold text-primary mb-3"><i class="bi bi-calendar-check"></i> Durasi: ${durasi} Hari ${durasiMalam} Malam</h6>
                <h6 class="fw-bold text-primary mb-3"><i class="bi bi-people"></i> Jumlah Peserta: ${orang} Orang</h6>
                
                <hr>
                
                <!-- URUTAN SESUAI PERMINTAAN -->
                
                <!-- 1. TIKET KAPAL PERGI -->
                <div class="mb-3">
                    <h6 class="fw-bold text-dark"><span class="badge bg-primary me-1">1</span> <i class="bi bi-ship text-info"></i> Tiket Kapal PERGI</h6>
                    <ul class="list-unstyled ms-3 small">
                        <li><i class="bi bi-check-circle-fill text-success"></i> Jepara → Karimunjawa (1x)</li>
                    </ul>
                </div>
                
                <!-- 2. PENGINAPAN -->
                <div class="mb-3">
                    <h6 class="fw-bold text-dark"><span class="badge bg-primary me-1">2</span> <i class="bi bi-building text-success"></i> Penginapan</h6>
                    <ul class="list-unstyled ms-3 small">
                        <li><i class="bi bi-check-circle-fill text-success"></i> ${hotelName} (${durasiMalam} malam)</li>
                    </ul>
                </div>
                
                <!-- 3. SEWA MOTOR/MOBIL -->
                <div class="mb-3">
                    <h6 class="fw-bold text-dark"><span class="badge bg-primary me-1">3</span> <i class="bi bi-scooter text-warning"></i> Sewa Motor/Mobil</h6>
                    <ul class="list-unstyled ms-3 small">
                        <li><i class="bi bi-check-circle-fill text-success"></i> ${lokalName} (${durasi} hari)</li>
                    </ul>
                </div>
                
                <!-- 4. TOUR DARAT + GUIDE -->
                <div class="mb-3">
                    <h6 class="fw-bold text-dark"><span class="badge bg-primary me-1">4</span> <i class="bi bi-tree text-success"></i> Tour Darat + Guide</h6>
                    <ul class="list-unstyled ms-3 small">
                        ${wisataDaratNames.length > 0 ? wisataDaratNames.map(n => `<li><i class="bi bi-check-circle-fill text-success"></i> ${n}</li>`).join('') : '<li class="text-muted">Belum ada yang dipilih</li>'}
                        <li><i class="bi bi-check-circle-fill text-success"></i> Pemandu Wisata Lokal (${Math.ceil(orang/8)} guide)</li>
                    </ul>
                </div>
                
                <!-- 5. TOUR LAUT / WISATA LAUT -->
                <div class="mb-3">
                    <h6 class="fw-bold text-dark"><span class="badge bg-primary me-1">5</span> <i class="bi bi-water text-info"></i> Tour Laut</h6>
                    <ul class="list-unstyled ms-3 small">
                        ${wisataLautNames.length > 0 ? wisataLautNames.map(n => `<li><i class="bi bi-check-circle-fill text-success"></i> ${n}</li>`).join('') : '<li class="text-muted">Belum ada yang dipilih</li>'}
                    </ul>
                </div>
                
                <!-- 6. MAKAN -->
                <div class="mb-3">
                    <h6 class="fw-bold text-dark"><span class="badge bg-primary me-1">6</span> <i class="bi bi-egg-fried text-warning"></i> Makan</h6>
                    <ul class="list-unstyled ms-3 small">
                        <li><i class="bi bi-check-circle-fill text-success"></i> Makan 3x sehari (${durasi * 3}x makan total)</li>
                    </ul>
                </div>
                
                <!-- 7. TIKET KAPAL PULANG -->
                <div class="mb-3">
                    <h6 class="fw-bold text-dark"><span class="badge bg-primary me-1">7</span> <i class="bi bi-ship text-info"></i> Tiket Kapal PULANG</h6>
                    <ul class="list-unstyled ms-3 small">
                        <li><i class="bi bi-check-circle-fill text-success"></i> Karimunjawa → Jepara (1x)</li>
                    </ul>
                </div>
                
                <!-- TRANSPORT DARAT (OPSIONAL) -->
                ${state.selectedKotaKey && state.selectedKotaKey !== 'jepara' ? `
                <div class="mb-3">
                    <h6 class="fw-bold text-dark"><span class="badge bg-secondary me-1">+</span> <i class="bi bi-car-front text-secondary"></i> Transport Darat</h6>
                    <ul class="list-unstyled ms-3 small">
                        <li><i class="bi bi-check-circle-fill text-success"></i> ${state.selectedKotaKey || 'Kota Asal'} ↔ Jepara PP</li>
                    </ul>
                </div>
                ` : ''}
                
                ${fasilitasNames.length > 0 ? `
                <div class="mb-3">
                    <h6 class="fw-bold text-dark"><i class="bi bi-stars text-primary"></i> Fasilitas Tambahan</h6>
                    <ul class="list-unstyled ms-3 small">
                        ${fasilitasNames.map(n => `<li><i class="bi bi-check-circle-fill text-success"></i> ${n}</li>`).join('')}
                    </ul>
                </div>
                ` : ''}
                
                <hr>
                
                <div class="bg-primary bg-opacity-10 p-3 rounded-3 text-center">
                    <span class="small text-muted">TOTAL ESTIMASI</span>
                    <h4 class="fw-bold text-primary mb-0">Rp ${fmt(state.totalEstimasi)}</h4>
                    <small class="text-muted">(Rp ${fmt(Math.ceil(state.totalEstimasi / orang))} / orang)</small>
                </div>
            </div>
        `;
        
        content.innerHTML = html;
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('modalDapatApaAja'));
        modal.show();
    }

    // Update Itinerary Button Link dan Title sesuai durasi
    function updateItineraryButton() {
        const durasi = state.durasi;
        const titles = { 2: '2 Hari 1 Malam', 3: '3 Hari 2 Malam', 4: '4 Hari 3 Malam' };
        
        const titleText = '📅 Itinerary Perjalanan ' + (titles[durasi] || durasi + ' Hari');
        document.getElementById('itinerary-title-header').innerText = titleText;
        
        // Update button link
        const btnLihatItinerary = document.getElementById('btn-lihat-itinerary');
        if (btnLihatItinerary) {
            btnLihatItinerary.href = '<?= base_url('itinerary') ?>/' + durasi;
        }
    }
    
    function esc(str) {
        if (!str) return '';
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
    }

    // Event Listener
    document.getElementById('jml_orang').addEventListener('change', function() { renderHotels(); renderDestinations(); reCalculate(); });
    document.getElementById('durasi').addEventListener('change', function() { renderHotels(); reCalculate(); updateItineraryButton(); });
    
    // --- HOTEL GALLERY MODAL ---
    let currentGalleryHotelId = null;
    let currentGalleryImages = [];
    let currentGalleryIndex = 0;

    function openHotelGallery(hotelId, hotelName, event) {
        event.stopPropagation();
        const hotel = dbHotels.find(h => h.id == hotelId);
        if (!hotel) return;

        currentGalleryHotelId = hotelId;
        currentGalleryImages = [];
        currentGalleryIndex = 0;

        if (hotel.gallery && hotel.gallery.length > 0) {
            hotel.gallery.forEach(g => {
                if (g.image_url) {
                    let imgPath = g.image_url.startsWith('http') ? g.image_url : BASE_UPLOADS_URL + g.image_url;
                    currentGalleryImages.push(imgPath);
                }
            });
        }

        if (hotel.image_url && currentGalleryImages.length === 0) {
            let imgPath = hotel.image_url.startsWith('http') ? hotel.image_url : BASE_UPLOADS_URL + hotel.image_url;
            currentGalleryImages.push(imgPath);
        }

        if (currentGalleryImages.length === 0) {
            currentGalleryImages.push('https://via.placeholder.com/400x300?text=No+Image');
        }

        renderGalleryModal(hotelName);
        const overlay = document.getElementById('gallery-modal-overlay');
        overlay.style.display = 'flex';
    }

    function renderGalleryModal(hotelName) {
        let html = `
            <div class="gallery-modal-overlay" id="gallery-modal-overlay" onclick="closeHotelGallery()">
                <div class="gallery-modal-box" onclick="event.stopPropagation()">
                    <div class="gallery-modal-header">
                        <h5>${hotelName}</h5>
                        <button class="gallery-modal-close" onclick="closeHotelGallery()">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    
                    <div class="gallery-carousel-container">
                        <div class="gallery-image-wrapper">
                            <img src="${currentGalleryImages[0]}" id="gallery-main-image" alt="Gallery">
                        </div>
                        ${currentGalleryImages.length > 1 ? `
                            <button class="gallery-nav-button prev" onclick="prevGalleryImage()">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="gallery-nav-button next" onclick="nextGalleryImage()">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        ` : ''}
                    </div>

                    ${currentGalleryImages.length > 1 ? `
                        <div class="gallery-thumbnails" id="gallery-thumbnails">
                            ${currentGalleryImages.map((img, idx) => `
                                <div class="gallery-thumbnail ${idx === 0 ? 'active' : ''}" onclick="selectGalleryImage(${idx})">
                                    <img src="${img}" alt="Thumbnail">
                                </div>
                            `).join('')}
                        </div>
                    ` : ''}

                    <div class="gallery-counter">
                        <span id="gallery-counter">${currentGalleryIndex + 1} dari ${currentGalleryImages.length}</span>
                    </div>
                </div>
            </div>
        `;

        const oldModal = document.getElementById('gallery-modal-overlay');
        if (oldModal) oldModal.remove();

        document.body.insertAdjacentHTML('beforeend', html);
    }

    function selectGalleryImage(index) {
        currentGalleryIndex = index;
        updateGalleryDisplay();
    }

    function prevGalleryImage() {
        currentGalleryIndex = (currentGalleryIndex - 1 + currentGalleryImages.length) % currentGalleryImages.length;
        updateGalleryDisplay();
    }

    function nextGalleryImage() {
        currentGalleryIndex = (currentGalleryIndex + 1) % currentGalleryImages.length;
        updateGalleryDisplay();
    }

    function updateGalleryDisplay() {
        const mainImg = document.getElementById('gallery-main-image');
        if (mainImg) mainImg.src = currentGalleryImages[currentGalleryIndex];

        const thumbnails = document.querySelectorAll('.gallery-thumbnail');
        thumbnails.forEach((thumb, idx) => {
            if (idx === currentGalleryIndex) {
                thumb.classList.add('active');
            } else {
                thumb.classList.remove('active');
            }
        });

        const counter = document.getElementById('gallery-counter');
        if (counter) counter.textContent = (currentGalleryIndex + 1) + ' dari ' + currentGalleryImages.length;
    }

    function closeHotelGallery() {
        const overlay = document.getElementById('gallery-modal-overlay');
        if (overlay) {
            overlay.style.animation = 'fadeOut 0.3s ease-in forwards';
            setTimeout(() => overlay.remove(), 300);
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (document.getElementById('gallery-modal-overlay')) {
            if (e.key === 'ArrowLeft') prevGalleryImage();
            if (e.key === 'ArrowRight') nextGalleryImage();
            if (e.key === 'Escape') closeHotelGallery();
        }
    });

    // Add fadeOut animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeOut {
            from { opacity: 1; backdrop-filter: blur(2px); }
            to { opacity: 0; backdrop-filter: blur(0px); }
        }
    `;
    document.head.appendChild(style);

    // ===== BACK TO TOP BUTTON =====
    const backToTopBtn = document.getElementById('backToTopBtn');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTopBtn?.classList.add('visible');
        } else {
            backToTopBtn?.classList.remove('visible');
        }
    });

    backToTopBtn?.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // ===== SUPPORT WIDGET LIVE CHAT (lihat support_widget.php) =====
    
    // --- SERVICE INFO (dari admin settings) ---
    const serviceInfo = {};
    
    // Build serviceInfo dari estimasiSettings
    if (estimasiSettings && Object.keys(estimasiSettings).length > 0) {
        Object.keys(estimasiSettings).forEach(key => {
            serviceInfo[key] = {
                title: estimasiSettings[key].title || 'Info',
                description: estimasiSettings[key].description || 'Belum ada deskripsi'
            };
        });
    } else {
        // Fallback default jika settings tidak ada
        Object.assign(serviceInfo, {
            transport_land: { title: 'Transportasi Darat', description: 'Biaya transportasi darat dari kota asal ke Jepara (PP)' },
            transport_sea: { title: 'Transportasi Laut', description: 'Biaya tiket kapal/perahu dari Jepara ke Karimunjawa (PP)' },
            hotel: { title: 'Penginapan', description: 'Harga per kamar per malam (sharing room untuk 2 orang)' },
            activity: { title: 'Aktivitas Laut', description: 'Paket snorkeling, diving, dan aktivitas water sports lainnya' },
            dest_laut: { title: 'Wisata Darat', description: 'Tiket masuk destinasi wisata lokal dan tempat bersejarah' },
            guide: { title: 'Pemandu Wisata', description: 'Biaya untuk guide/pemandu lokal (1 guide untuk setiap 8 orang wisatawan)' },
            transport: { title: 'Sewa Kendaraan', description: 'Biaya sewa motor atau mobil selama berada di pulau Karimun per harinya' },
            food: { title: 'Konsumsi', description: 'Biaya makanan dan minuman (3x makan per hari)' }
        });
    }

    // Simpan popover instance globally untuk tracking
    let currentPopover = null;
    let popoverTimeout = null;
    
    function initServiceInfoPopovers() {
        const icons = document.querySelectorAll('.info-icon[data-info-key]');
        console.log('Found info icons:', icons.length);
        console.log('Bootstrap available:', typeof bootstrap !== 'undefined');
        
        if (icons.length === 0) {
            console.warn('No info icons found!');
            return;
        }
        
        icons.forEach(el => {
            const key = el.getAttribute('data-info-key');
            console.log('Setting up popover for:', key);
            
            el.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('Info icon clicked:', key);
                showInfoPopover(this, key);
            });
            
            el.addEventListener('mouseenter', function(e) {
                clearTimeout(popoverTimeout);
                console.log('Info icon hovered:', key);
                showInfoPopover(this, key);
            });
            
            el.addEventListener('mouseleave', function(e) {
                popoverTimeout = setTimeout(() => {
                    hideInfoPopover();
                }, 500);
            });
        });
        
        // Close popover saat klik di area lain
        document.addEventListener('click', function(e) {
            const infoIcon = e.target.closest('.info-icon');
            if (!infoIcon && currentPopover) {
                hideInfoPopover();
            }
        });
        
        console.log('Info icon popovers initialized successfully');
    }
    
    function showInfoPopover(element, key) {
        if (!serviceInfo[key]) {
            console.warn('Service info not found for key:', key);
            return;
        }
        
        const info = serviceInfo[key];
        console.log('Showing popover for:', key, info);
        
        // Destroy existing popover
        if (currentPopover) {
            try {
                const popoverInstance = bootstrap.Popover.getInstance(currentPopover.element);
                if (popoverInstance) {
                    popoverInstance.dispose();
                }
                currentPopover.element.classList.remove('active');
            } catch(e) {
                console.error('Error disposing previous popover:', e);
            }
            currentPopover = null;
        }
        
        // Create new popover
        try {
            // Ensure element is in DOM
            if (!document.contains(element)) {
                console.error('Element not in DOM');
                return;
            }
            
            // Make sure bootstrap is available
            if (typeof bootstrap === 'undefined' || !bootstrap.Popover) {
                console.error('Bootstrap Popover not available');
                return;
            }
            
            const popover = new bootstrap.Popover(element, {
                title: info.title || 'Info',
                content: info.description || 'No description available',
                html: false,
                trigger: 'manual',
                placement: 'top',
                container: 'body',
                delay: { show: 0, hide: 0 }
            });
            
            popover.show();
            console.log('Popover shown successfully for:', key);
            
            // Add class active ke icon
            element.classList.add('active');
            
            // Store current popover
            currentPopover = { popover: popover, element: element };
        } catch(e) {
            console.error('Error creating/showing popover:', e);
        }
    }
    
    function hideInfoPopover() {
        if (currentPopover) {
            try {
                currentPopover.popover.dispose();
                currentPopover.element.classList.remove('active');
            } catch(e) {}
            currentPopover = null;
        }
    }
    
    // SHOW JADWAL KAPAL MODAL
    // LOAD JADWAL KAPAL - Moved to inline function in showJadwalKapalModal
    function renderJadwalKapalCards() {
        const listContainer = document.getElementById('jadwal-kapal-list');
        if (!listContainer) return;
        
        // Show loading state
        listContainer.innerHTML = `
            <div class="col-12 text-center py-4">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Memuat jadwal kapal...</p>
            </div>
        `;
        
        // Fetch data dari server
        const url = '<?= base_url('admin/get_jadwal_kapal_json') ?>';
        console.log('Fetching jadwal kapal dari:', url);
        
        fetch(url)
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data);
                if (!data || data.length === 0) {
                    listContainer.innerHTML = `
                        <div class="col-12 text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">Belum ada jadwal kapal. Hubungi kami untuk informasi terbaru.</p>
                        </div>
                    `;
                    return;
                }
                
                // Render jadwal kapal cards
                let html = '';
                data.forEach(jadwal => {
                    const harga = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(jadwal.harga_tiket);
                    
                    html += `
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm hover-shadow" style="border-left: 4px solid #06b6d4; transition: all 0.3s ease;">
                                <div class="card-body">
                                    <h6 class="fw-bold text-info mb-1"><i class="bi bi-ship me-2"></i>${jadwal.nama_kapal}</h6>
                                    <p class="small text-muted mb-2">${jadwal.pelabuhan_asal}</p>
                                    
                                    <div class="mb-3">
                                        <div class="row g-2 small">
                                            <div class="col-6">
                                                <span class="badge bg-light text-dark">
                                                    <i class="bi bi-clock"></i> ${jadwal.jam_berangkat}
                                                </span>
                                            </div>
                                            <div class="col-6">
                                                <span class="badge bg-light text-dark">
                                                    <i class="bi bi-hourglass-split"></i> ${jadwal.waktu_tempuh}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h5 class="text-info fw-bold mb-2">${harga}</h5>
                                    <span class="badge bg-info text-white">${jadwal.tipe_kapal}</span>
                                    
                                    ${jadwal.keterangan ? `<p class="small text-muted mt-2 mb-0"><i class="bi bi-info-circle"></i> ${jadwal.keterangan}</p>` : ''}
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                listContainer.innerHTML = html;
            })
            .catch(error => {
                console.error('Error loading jadwal kapal:', error);
                listContainer.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-exclamation-triangle" style="font-size: 3rem; color: #dc3545;"></i>
                        <p class="text-danger mt-3">Gagal memuat jadwal kapal. Silakan coba lagi.</p>
                    </div>
                `;
            });
    }
    
    function showJadwalKapalModal() {
        console.log('showJadwalKapalModal() called');
        
        // Load jadwal kapal cards
        renderJadwalKapalCards();
        
        // Use jQuery to show modal (more reliable)
        $('#modalJadwalKapal').modal('show');
        console.log('Modal show triggered via jQuery');
    }
    
    // LOAD JADWAL KAPAL - Initialize event listener once
    function loadJadwalKapal() {
        const modal = document.getElementById('modalJadwalKapal');
        if (!modal) {
            console.log('loadJadwalKapal: Modal not found');
            return;
        }
        console.log('loadJadwalKapal: Modal initialized');
    }
    
    // FIX IMAGE URLs - Convert /uploads/ to /dinara/uploads/
    function fixImageUrls() {
        const baseUrl = '<?= base_url() ?>';
        if (!baseUrl.includes('/dinara/')) {
            document.querySelectorAll('img[src]').forEach(img => {
                if (img.src.includes('/uploads/') && !img.src.includes('/dinara/uploads/')) {
                    img.src = img.src.replace('/uploads/', '/dinara/uploads/');
                }
            });
        }
    }
    
    // STARTUP
    // Initialize popovers with slight delay to ensure DOM is ready
    setTimeout(() => {
        console.log('Initializing info popovers...');
        initServiceInfoPopovers();
        loadJadwalKapal();
        fixImageUrls();
    }, 100);
    </script>

    <!-- Support Widget (dari include) -->
    <?php include(APPPATH . 'Views/components/support_widget.php'); ?>

    <!-- MODERN LUXURY FOOTER 2027 -->
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
                        <p class="brand-description"><?= esc($settings['footer_description'] ?? 'Kami adalah agen perjalanan terpercaya yang menyediakan paket wisata ke Karimunjawa dengan harga terjangkau dan pelayanan profesional. Buat liburan Anda tak terlupakan bersama kami!') ?></p>
                        
                        <!-- SOCIAL MEDIA ICONS -->
                        <div class="social-media-section">
                            <p class="social-heading">Ikuti Kami</p>
                            <div class="social-icons-modern">
                                <?php if(!empty($settings['footer_facebook'])): ?>
                                <a href="<?= esc($settings['footer_facebook']) ?>" target="_blank" rel="noopener noreferrer" class="social-icon-modern facebook" title="Facebook">
                                    <i class="bi bi-facebook"></i>
                                    <span class="social-tooltip">Facebook</span>
                                </a>
                                <?php endif; ?>
                                <?php if(!empty($settings['footer_instagram'])): ?>
                                <a href="<?= esc($settings['footer_instagram']) ?>" target="_blank" rel="noopener noreferrer" class="social-icon-modern instagram" title="Instagram">
                                    <i class="bi bi-instagram"></i>
                                    <span class="social-tooltip">Instagram</span>
                                </a>
                                <?php endif; ?>
                                <?php if(!empty($settings['footer_tiktok'])): ?>
                                <a href="<?= esc($settings['footer_tiktok']) ?>" target="_blank" rel="noopener noreferrer" class="social-icon-modern tiktok" title="TikTok">
                                    <i class="bi bi-tiktok"></i>
                                    <span class="social-tooltip">TikTok</span>
                                </a>
                                <?php endif; ?>
                                <?php if(!empty($settings['footer_youtube'])): ?>
                                <a href="<?= esc($settings['footer_youtube']) ?>" target="_blank" rel="noopener noreferrer" class="social-icon-modern youtube" title="YouTube">
                                    <i class="bi bi-youtube"></i>
                                    <span class="social-tooltip">YouTube</span>
                                </a>
                                <?php endif; ?>
                                <?php if(!empty($settings['footer_whatsapp'])): ?>
                                <a href="<?= esc($settings['footer_whatsapp']) ?>" target="_blank" rel="noopener noreferrer" class="social-icon-modern whatsapp" title="WhatsApp">
                                    <i class="bi bi-whatsapp"></i>
                                    <span class="social-tooltip">WhatsApp</span>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- CENTER-RIGHT COLUMNS: INFO & LINKS -->
                    <div class="footer-info-columns">
                        <!-- CONTACT INFO COLUMN -->
                        <div class="footer-info-column">
                            <div class="column-header">
                                <i class="bi bi-telephone"></i>
                                <h4>Hubungi Kami</h4>
                            </div>
                            <div class="contact-items">
                                <?php if(!empty($settings['footer_address'])): ?>
                                <div class="contact-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <div class="contact-detail">
                                        <span class="contact-label">Lokasi</span>
                                        <span class="contact-value"><?= esc($settings['footer_address']) ?></span>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($settings['footer_phone'])): ?>
                                <div class="contact-item">
                                    <i class="bi bi-telephone"></i>
                                    <div class="contact-detail">
                                        <span class="contact-label">Telepon</span>
                                        <a href="tel:<?= str_replace(' ', '', $settings['footer_phone']) ?>" class="contact-value"><?= esc($settings['footer_phone']) ?></a>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($settings['footer_email'])): ?>
                                <div class="contact-item">
                                    <i class="bi bi-envelope"></i>
                                    <div class="contact-detail">
                                        <span class="contact-label">Email</span>
                                        <a href="mailto:<?= esc($settings['footer_email']) ?>" class="contact-value"><?= esc($settings['footer_email']) ?></a>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($settings['footer_contact_person'])): ?>
                                <div class="contact-item">
                                    <i class="bi bi-person"></i>
                                    <div class="contact-detail">
                                        <span class="contact-label">Contact Person</span>
                                        <span class="contact-value"><?= esc($settings['footer_contact_person']) ?></span>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- QUICK LINKS COLUMN -->
                        <div class="footer-info-column">
                            <div class="column-header">
                                <i class="bi bi-link-45deg"></i>
                                <h4>Navigasi</h4>
                            </div>
                            <ul class="footer-link-list">
                                <li><a href="<?= base_url('/') ?>"><i class="bi bi-house-fill"></i> Beranda</a></li>
                                <li><a href="<?= base_url('hotel') ?>"><i class="bi bi-building"></i> Hotel</a></li>
                                <li><a href="<?= base_url('destinasi') ?>"><i class="bi bi-geo-alt-fill"></i> Destinasi</a></li>
                                <li><a href="<?= base_url('/blog') ?>"><i class="bi bi-newspaper"></i> Blog</a></li>
                                <li><a href="#"><i class="bi bi-question-circle"></i> FAQ</a></li>
                                <?php if(!empty($settings['footer_link1'])): ?>
                                <li><a href="<?= esc($settings['footer_link1']) ?>"><i class="bi bi-star"></i> Link Lainnya</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <!-- SERVICES COLUMN -->
                        <div class="footer-info-column">
                            <div class="column-header">
                                <i class="bi bi-star"></i>
                                <h4>Layanan</h4>
                            </div>
                            <ul class="footer-link-list">
                                <li><a href="#"><i class="bi bi-airplane-fill"></i> Paket Wisata</a></li>
                                <li><a href="<?= base_url('hotel') ?>"><i class="bi bi-house-heart"></i> Booking Hotel</a></li>
                                <li><a href="https://www.susiair.com/" target="_blank"><i class="bi bi-ticket"></i> Tiket Pesawat</a></li>
                                <li><a href="<?= !empty($settings['footer_whatsapp']) ? $settings['footer_whatsapp'] : 'https://wa.me/6281234567890' ?>" target="_blank"><i class="bi bi-chat-dots"></i> Konsultasi</a></li>
                                <li><a href="#"><i class="bi bi-shield-check"></i> Jaminan Terbaik</a></li>
                                <li><a href="#"><i class="bi bi-credit-card"></i> Pembayaran Fleksibel</a></li>
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
                        <p>Dikembangkan oleh <a href="<?= esc($settings['footer_developer_link'] ?? 'https://github.com') ?>" target="_blank"><?= esc($settings['footer_developer_name'] ?? 'Developer Team') ?></a> | <?= esc($settings['footer_developer_tagline'] ?? 'Didukung oleh teknologi terkini') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- BACK TO TOP BUTTON -->
        <a href="#" class="back-to-top-btn" id="backToTopBtn" title="Kembali ke Atas">
            <i class="bi bi-chevron-up"></i>
        </a>
    </footer>

</body>
</html>
