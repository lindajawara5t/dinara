<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel & Penginapan Karimunjawa - Dinara Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #f8fafc; }
        
        /* HERO SECTION */
        .hero-hotel {
            background: linear-gradient(135deg, #1e3a5f 0%, #0d2137 100%);
            background-size: cover;
            background-position: center;
            min-height: 300px;
            color: white;
            padding: 60px 0;
            position: relative;
        }
        .hero-hotel::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(30,58,95,0.85) 0%, rgba(13,33,55,0.9) 100%);
        }
        .hero-hotel .container { position: relative; z-index: 2; }
        .hero-hotel h1 { font-size: 2.5rem; font-weight: 800; margin-bottom: 10px; }
        .hero-hotel p { font-size: 1.1rem; opacity: 0.9; }
        
        /* BREADCRUMB */
        .breadcrumb-nav {
            background: white;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .breadcrumb-nav a { color: #0d6efd; text-decoration: none; }
        .breadcrumb-nav a:hover { text-decoration: underline; }
        
        /* HOTEL CARD */
        .hotel-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        .hotel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }
        .hotel-img-wrapper {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        .hotel-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .hotel-card:hover .hotel-img-wrapper img {
            transform: scale(1.1);
        }
        .hotel-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .hotel-content {
            padding: 20px;
        }
        .hotel-name {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 8px;
        }
        .hotel-location {
            color: #6c757d;
            font-size: 0.85rem;
            margin-bottom: 12px;
        }
        .hotel-location i { color: #0d6efd; }
        .hotel-amenities {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 15px;
        }
        .amenity-tag {
            background: #f0f5fa;
            color: #4a5568;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .hotel-price {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 15px;
            border-top: 1px solid #e8eef7;
        }
        .price-label {
            font-size: 0.75rem;
            color: #6c757d;
        }
        .price-value {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0d6efd;
        }
        .price-night {
            font-size: 0.8rem;
            font-weight: 500;
            color: #6c757d;
        }
        .btn-book {
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        .btn-book:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(13,110,253,0.4);
        }
        
        /* FILTER SECTION */
        .filter-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }
        .filter-title {
            font-weight: 700;
            font-size: 0.9rem;
            color: #1a1a2e;
            margin-bottom: 12px;
        }
        .filter-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .filter-chip {
            background: #f0f5fa;
            color: #4a5568;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        .filter-chip:hover, .filter-chip.active {
            background: #e3f2fd;
            color: #0d6efd;
            border-color: #bbdefb;
        }
        
        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-state i {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }
        .empty-state h3 {
            font-weight: 700;
            color: #6c757d;
        }
        
        /* BACK TO HOME */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            opacity: 0.9;
            transition: opacity 0.2s;
        }
        .back-btn:hover {
            opacity: 1;
            color: white;
        }

        /* FOOTER STYLES */
        .modern-luxury-footer {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #e2e8f0;
            padding: 60px 0 0 0;
            position: relative;
            overflow: hidden;
        }
        
        .modern-luxury-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.3), transparent);
        }

        .footer-top-section {
            padding: 40px 0;
        }

        .container-wide {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-content-grid {
            display: grid;
            grid-template-columns: 2fr 3fr;
            gap: 50px;
        }

        .footer-brand-column {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .brand-showcase {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand-logo-wrapper {
            flex-shrink: 0;
        }

        .brand-logo {
            max-width: 60px;
            height: auto;
        }

        .brand-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .brand-name {
            font-size: 24px;
            font-weight: 800;
            background: linear-gradient(135deg, #10b981, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
        }

        .brand-tagline {
            font-size: 13px;
            color: #94a3b8;
            margin: 0;
        }

        .brand-description {
            font-size: 14px;
            line-height: 1.6;
            color: #cbd5e1;
        }

        .social-media-section {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .social-heading {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            color: white;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .social-icons-modern {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .social-icon-modern {
            width: 40px;
            height: 40px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #10b981;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .social-icon-modern:hover {
            background: rgba(16, 185, 129, 0.2);
            border-color: rgba(16, 185, 129, 0.4);
            transform: translateY(-3px);
        }

        .social-icon-modern i {
            font-size: 18px;
        }

        .social-tooltip {
            position: absolute;
            bottom: -30px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        .social-icon-modern:hover .social-tooltip {
            opacity: 1;
        }

        .footer-info-columns {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 40px;
        }

        .footer-info-column {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .column-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .column-header i {
            color: #10b981;
            font-size: 20px;
        }

        .column-header h4 {
            font-size: 15px;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .contact-items {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .contact-item {
            display: flex;
            gap: 10px;
            font-size: 13px;
        }

        .contact-item i {
            color: #10b981;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .contact-detail {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .contact-label {
            font-size: 12px;
            color: #94a3b8;
            text-transform: uppercase;
        }

        .contact-value {
            color: #e2e8f0;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .contact-value:hover {
            color: #10b981;
        }

        .footer-link-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .footer-link-list li {
            margin: 0;
        }

        .footer-link-list a {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .footer-link-list a:hover {
            color: #10b981;
            transform: translateX(4px);
        }

        .footer-link-list i {
            font-size: 14px;
        }

        .footer-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.2), transparent);
            margin: 0;
        }

        .footer-bottom-section {
            padding: 20px 0;
        }

        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-copyright {
            flex: 1;
            min-width: 300px;
        }

        .footer-copyright p {
            font-size: 12px;
            color: #94a3b8;
            margin: 0;
        }

        .footer-developer-credits {
            text-align: right;
        }

        .footer-developer-credits p {
            font-size: 12px;
            color: #64748b;
            margin: 0;
        }

        .footer-developer-credits a {
            color: #10b981;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-developer-credits a:hover {
            color: #06b6d4;
        }

        .back-to-top-btn {
            position: fixed;
            bottom: 30px;
            right: 100px;
            width: 44px;
            height: 44px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #10b981;
            text-decoration: none;
            transition: all 0.3s ease;
            z-index: 50;
        }

        .back-to-top-btn:hover {
            background: rgba(16, 185, 129, 0.2);
            border-color: rgba(16, 185, 129, 0.4);
            transform: translateY(-4px);
            color: #06b6d4;
        }

        @media (max-width: 768px) {
            .footer-content-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .footer-info-columns {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .footer-bottom-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-developer-credits {
                text-align: center;
            }

            .brand-showcase {
                flex-direction: column;
                text-align: center;
            }

            .social-icons-modern {
                justify-content: center;
            }
        }

        /* SUPPORT WIDGET STYLES */
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

            .back-to-top-btn {
                bottom: 20px;
                right: 90px;
            }
        }
    </style>
</head>
<body>
    <!-- HERO SECTION -->
    <section class="hero-hotel" style="<?php if(!empty($settings['hero_image'])): ?>background-image: url('<?= base_url('uploads/' . $settings['hero_image']) ?>');<?php endif; ?>">
        <div class="container">
            <a href="<?= base_url('/') ?>" class="back-btn mb-3">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
            <h1><i class="bi bi-building me-2"></i>Hotel & Penginapan</h1>
            <p>Temukan penginapan terbaik di Karimunjawa untuk liburan impianmu</p>
        </div>
    </section>
    
    <!-- BREADCRUMB -->
    <div class="breadcrumb-nav">
        <div class="container">
            <a href="<?= base_url('/') ?>">Beranda</a>
            <span class="mx-2 text-muted">/</span>
            <span class="text-muted">Hotel & Penginapan</span>
        </div>
    </div>
    
    <!-- MAIN CONTENT -->
    <section class="py-5">
        <div class="container">
            
            <!-- FILTER SECTION -->
            <div class="filter-section">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-0"><i class="bi bi-funnel me-2 text-primary"></i>Ditemukan <strong><?= count($hotels) ?></strong> penginapan</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="filter-chips justify-content-md-end d-flex">
                            <span class="filter-chip active" data-filter="all">Semua</span>
                            <span class="filter-chip" data-filter="homestay">Homestay</span>
                            <span class="filter-chip" data-filter="resort">Resort</span>
                            <span class="filter-chip" data-filter="villa">Villa</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- HOTEL GRID -->
            <?php if(!empty($hotels)): ?>
            <div class="row g-4">
                <?php foreach($hotels as $hotel): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <div class="hotel-img-wrapper">
                            <?php 
                            $imgSrc = 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=600';
                            if(!empty($hotel['photos']) && !empty($hotel['photos'][0]['image_url'])) {
                                $imgSrc = base_url('uploads/' . $hotel['photos'][0]['image_url']);
                            } elseif(!empty($hotel['image_url'])) {
                                $imgSrc = base_url('uploads/' . $hotel['image_url']);
                            }
                            ?>
                            <img src="<?= $imgSrc ?>" alt="<?= esc($hotel['name'] ?? 'Hotel') ?>">
                            <span class="hotel-badge"><i class="bi bi-star-fill me-1"></i>Rekomendasi</span>
                        </div>
                        <div class="hotel-content">
                            <h5 class="hotel-name"><?= esc($hotel['name'] ?? 'Hotel') ?></h5>
                            <p class="hotel-location">
                                <i class="bi bi-geo-alt-fill me-1"></i>Karimunjawa, Jepara
                            </p>
                            <div class="hotel-amenities">
                                <span class="amenity-tag"><i class="bi bi-wifi me-1"></i>WiFi</span>
                                <span class="amenity-tag"><i class="bi bi-cup-hot me-1"></i>Sarapan</span>
                                <span class="amenity-tag"><i class="bi bi-snow me-1"></i>AC</span>
                            </div>
                            <div class="hotel-price">
                                <div>
                                    <span class="price-label">Mulai dari</span>
                                    <div>
                                        <span class="price-value">Rp <?= number_format($hotel['price_publish'] ?? $hotel['harga'] ?? 0, 0, ',', '.') ?></span>
                                        <span class="price-night">/malam</span>
                                    </div>
                                </div>
                                <a href="<?= base_url('/') ?>" class="btn btn-book">
                                    <i class="bi bi-calendar-check me-1"></i>Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-building"></i>
                <h3>Belum ada data hotel</h3>
                <p class="text-muted">Data penginapan akan segera ditambahkan</p>
                <a href="<?= base_url('/') ?>" class="btn btn-primary mt-3">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
                </a>
            </div>
            <?php endif; ?>
            
        </div>
    </section>
    
    <!-- Footer Component -->
    <?php include(APPPATH . 'Views/components/footer.php'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filter functionality
        document.querySelectorAll('.filter-chip').forEach(chip => {
            chip.addEventListener('click', function() {
                document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                // Add filter logic here if needed
            });
        });
    </script>
    
    <!-- Support Widget -->
    <?php include(APPPATH . 'Views/components/support_widget.php'); ?>
</body>
</html>
