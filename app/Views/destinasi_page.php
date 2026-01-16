<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Wisata Karimunjawa - Dinara Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #f8fafc; }
        
        /* HERO SECTION */
        .hero-destinasi {
            background: linear-gradient(135deg, #0f766e 0%, #064e3b 100%);
            background-size: cover;
            background-position: center;
            min-height: 300px;
            color: white;
            padding: 60px 0;
            position: relative;
        }
        .hero-destinasi::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(15,118,110,0.85) 0%, rgba(6,78,59,0.9) 100%);
        }
        .hero-destinasi .container { position: relative; z-index: 2; }
        .hero-destinasi h1 { font-size: 2.5rem; font-weight: 800; margin-bottom: 10px; }
        .hero-destinasi p { font-size: 1.1rem; opacity: 0.9; }
        
        /* BREADCRUMB */
        .breadcrumb-nav {
            background: white;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .breadcrumb-nav a { color: #0f766e; text-decoration: none; }
        .breadcrumb-nav a:hover { text-decoration: underline; }
        
        /* PROMO BANNER */
        .promo-banner {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            border-radius: 16px;
            padding: 25px 30px;
            color: white;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }
        .promo-banner h3 { font-weight: 800; margin-bottom: 5px; }
        .promo-banner p { opacity: 0.95; margin: 0; }
        .promo-banner .btn {
            background: white;
            color: #ff6b35;
            font-weight: 700;
            padding: 12px 25px;
            border-radius: 10px;
        }
        .promo-banner .btn:hover {
            background: #fff8f5;
            transform: translateY(-2px);
        }
        
        /* SECTION TITLE */
        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
        }
        .section-title i { font-size: 1.8rem; color: #0f766e; }
        .section-title h2 { font-size: 1.5rem; font-weight: 800; color: #1a1a2e; margin: 0; }
        .section-title .badge {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        /* DESTINASI CARD */
        .destinasi-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        .destinasi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }
        .destinasi-img-wrapper {
            position: relative;
            height: 180px;
            overflow: hidden;
        }
        .destinasi-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .destinasi-card:hover .destinasi-img-wrapper img {
            transform: scale(1.1);
        }
        .destinasi-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            color: white;
        }
        .destinasi-badge.darat { background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%); }
        .destinasi-badge.laut { background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%); }
        .destinasi-content { padding: 20px; }
        .destinasi-name { font-size: 1.1rem; font-weight: 700; color: #1a1a2e; margin-bottom: 8px; }
        .destinasi-desc {
            color: #6c757d;
            font-size: 0.85rem;
            line-height: 1.6;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .destinasi-price {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 15px;
            border-top: 1px solid #e8eef7;
        }
        .price-label { font-size: 0.75rem; color: #6c757d; }
        .price-value { font-size: 1.15rem; font-weight: 800; color: #0f766e; }
        .price-person { font-size: 0.8rem; font-weight: 500; color: #6c757d; }
        .btn-explore {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
            border: none;
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        .btn-explore:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(15,118,110,0.4);
            color: white;
        }
        
        /* ACTIVITY TAGS */
        .activity-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 12px; }
        .activity-tag {
            background: #f0fdf9;
            color: #0f766e;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .activity-tag.laut { background: #f0f9ff; color: #0284c7; }
        
        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-state i { font-size: 4rem; color: #dee2e6; margin-bottom: 20px; }
        .empty-state h3 { font-weight: 700; color: #6c757d; }
        
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
        .back-btn:hover { opacity: 1; color: white; }
        
        /* TAB NAV */
        .destinasi-tabs { display: flex; gap: 10px; margin-bottom: 30px; flex-wrap: wrap; }
        .tab-btn {
            padding: 12px 24px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            background: white;
            color: #4a5568;
        }
        .tab-btn:hover { background: #f0fdf9; color: #0f766e; }
        .tab-btn.active {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(15,118,110,0.35);
        }
        .tab-btn i { margin-right: 8px; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }

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
        
        .brand-showcase {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .footer-brand-name {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #10b981, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }
        
        .footer-brand-description {
            font-size: 14px;
            line-height: 1.6;
            color: #cbd5e1;
            max-width: 200px;
        }
        
        .social-icons {
            display: flex;
            gap: 12px;
        }
        
        .social-icon {
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
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .social-icon:hover {
            background: rgba(16, 185, 129, 0.2);
            border-color: rgba(16, 185, 129, 0.4);
            transform: translateY(-4px);
            color: #06b6d4;
        }
        
        .footer-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .footer-column-title {
            font-size: 14px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        
        .footer-column-title::after {
            content: '';
            display: block;
            width: 30px;
            height: 2px;
            background: linear-gradient(90deg, #10b981, transparent);
            margin-top: 8px;
        }
        
        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .footer-link {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .footer-link:hover {
            color: #10b981;
            transform: translateX(4px);
        }
        
        .footer-contact-item {
            color: #cbd5e1;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 15px;
        }
        
        .footer-contact-item i {
            color: #10b981;
            margin-top: 2px;
        }
        
        .footer-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.2), transparent);
            margin: 30px 0;
        }
        
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .footer-copyright {
            color: #94a3b8;
            font-size: 14px;
        }
        
        .footer-credit {
            color: #64748b;
            font-size: 12px;
        }
        
        .footer-credit a {
            color: #10b981;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .footer-credit a:hover {
            color: #06b6d4;
        }
        
        .back-to-top-footer {
            width: 44px;
            height: 44px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #10b981;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
        }
        
        .back-to-top-footer:hover {
            background: rgba(16, 185, 129, 0.2);
            border-color: rgba(16, 185, 129, 0.4);
            transform: translateY(-4px);
            color: #06b6d4;
        }
        
        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
            
            .footer-brand-description {
                max-width: 100%;
            }
        }

        /* SUPPORT WIDGET STYLES */
        .support-banner-popup {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            animation: slideDownBanner 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .support-banner-content {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 12px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 12px 35px rgba(16, 185, 129, 0.25);
            color: white;
            font-size: 14px;
            font-weight: 500;
            gap: 12px;
        }
        
        .support-banner-text {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .support-banner-close {
            width: 28px;
            height: 28px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .support-banner-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }
        
        .support-banner-popup.hide {
            display: none;
        }
        
        @keyframes slideDownBanner {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
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
            background: white;
            border-radius: 12px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            width: 320px;
            max-height: 500px;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: scale(0.9) translateY(20px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .support-widget-panel.active {
            opacity: 1;
            visibility: visible;
            transform: scale(1) translateY(0);
        }
        
        .support-widget-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 16px;
            font-weight: 700;
            font-size: 16px;
        }
        
        .support-widget-content {
            padding: 16px;
            max-height: 380px;
            overflow-y: auto;
        }
        
        .support-agents-title {
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }
        
        .support-agent {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        
        .support-agent:hover {
            background-color: #f0fdf4;
        }
        
        .support-agent-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10b981, #06b6d4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            flex-shrink: 0;
        }
        
        .support-agent-info {
            flex: 1;
        }
        
        .support-agent-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
            margin-bottom: 2px;
        }
        
        .support-agent-status {
            font-size: 12px;
            color: #10b981;
        }
        
        .support-widget-cta {
            padding: 12px;
            background: #f0fdf4;
            border-top: 1px solid #e2e8f0;
            text-align: center;
        }
        
        .support-widget-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .support-widget-cta-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
        }
        
        @media (max-width: 480px) {
            .support-widget-container {
                bottom: 20px;
                right: 20px;
            }
            
            .support-widget-panel {
                width: 280px;
            }
            
            .support-banner-popup {
                top: 10px;
                right: 10px;
            }
            
            .support-banner-content {
                padding: 10px 14px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <!-- HERO SECTION -->
    <section class="hero-destinasi" style="<?php if(!empty($settings['hero_image'])): ?>background-image: url('<?= base_url('uploads/' . $settings['hero_image']) ?>');<?php endif; ?>">
        <div class="container">
            <a href="<?= base_url('/') ?>" class="back-btn mb-3">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
            <h1><i class="bi bi-geo-alt me-2"></i>Destinasi Wisata</h1>
            <p>Jelajahi keindahan wisata darat dan laut Karimunjawa</p>
        </div>
    </section>
    
    <!-- BREADCRUMB -->
    <div class="breadcrumb-nav">
        <div class="container">
            <a href="<?= base_url('/') ?>">Beranda</a>
            <span class="mx-2 text-muted">/</span>
            <span class="text-muted">Destinasi Wisata</span>
        </div>
    </div>
    
    <!-- MAIN CONTENT -->
    <section class="py-5">
        <div class="container">
            
            <!-- PROMO BANNER -->
            <div class="promo-banner">
                <div>
                    <h3><i class="bi bi-stars me-2"></i>Promo Paket Wisata!</h3>
                    <p>Pilih destinasi favoritmu, kami siap mendampingi perjalananmu ke Karimunjawa</p>
                </div>
                <a href="<?= base_url('/') ?>" class="btn">
                    <i class="bi bi-calculator me-2"></i>Hitung Estimasi
                </a>
            </div>
            
            <!-- TAB NAVIGATION -->
            <div class="destinasi-tabs">
                <button class="tab-btn active" data-tab="semua">
                    <i class="bi bi-grid-3x3-gap"></i>Semua
                    <span class="badge bg-light text-dark ms-2"><?= count($wisata_darat) + count($wisata_laut) ?></span>
                </button>
                <button class="tab-btn" data-tab="darat">
                    <i class="bi bi-tree"></i>Wisata Darat
                    <span class="badge bg-light text-dark ms-2"><?= count($wisata_darat) ?></span>
                </button>
                <button class="tab-btn" data-tab="laut">
                    <i class="bi bi-water"></i>Wisata Laut
                    <span class="badge bg-light text-dark ms-2"><?= count($wisata_laut) ?></span>
                </button>
            </div>
            
            <!-- TAB: SEMUA -->
            <div class="tab-content active" id="tab-semua">
                <?php if(!empty($wisata_darat) || !empty($wisata_laut)): ?>
                
                <!-- WISATA DARAT -->
                <?php if(!empty($wisata_darat)): ?>
                <div class="section-title">
                    <i class="bi bi-tree-fill"></i>
                    <h2>Wisata Darat</h2>
                    <span class="badge"><?= count($wisata_darat) ?> destinasi</span>
                </div>
                <div class="row g-4 mb-5">
                    <?php foreach($wisata_darat as $wisata): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="destinasi-card">
                            <div class="destinasi-img-wrapper">
                                <?php 
                                $imgSrc = 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600';
                                if(!empty($wisata['image_url'])) {
                                    $imgSrc = base_url('uploads/' . $wisata['image_url']);
                                }
                                ?>
                                <img src="<?= $imgSrc ?>" alt="<?= esc($wisata['name'] ?? 'Destinasi') ?>">
                                <span class="destinasi-badge darat"><i class="bi bi-tree me-1"></i>Darat</span>
                            </div>
                            <div class="destinasi-content">
                                <h5 class="destinasi-name"><?= esc($wisata['name'] ?? 'Destinasi') ?></h5>
                                <div class="activity-tags">
                                    <span class="activity-tag"><i class="bi bi-camera me-1"></i>Foto</span>
                                    <span class="activity-tag"><i class="bi bi-binoculars me-1"></i>Explore</span>
                                </div>
                                <p class="destinasi-desc"><?= !empty($wisata['description']) ? esc($wisata['description']) : 'Nikmati keindahan wisata darat Karimunjawa dengan pemandangan yang menakjubkan.' ?></p>
                                <div class="destinasi-price">
                                    <div>
                                        <span class="price-label">Estimasi biaya</span>
                                        <div>
                                            <span class="price-value">Rp <?= number_format($wisata['price_publish'] ?? 0, 0, ',', '.') ?></span>
                                            <span class="price-person">/orang</span>
                                        </div>
                                    </div>
                                    <a href="<?= base_url('/') ?>" class="btn btn-explore">
                                        <i class="bi bi-compass me-1"></i>Jelajahi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                
                <!-- WISATA LAUT -->
                <?php if(!empty($wisata_laut)): ?>
                <div class="section-title">
                    <i class="bi bi-water"></i>
                    <h2>Wisata Laut</h2>
                    <span class="badge" style="background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);"><?= count($wisata_laut) ?> destinasi</span>
                </div>
                <div class="row g-4">
                    <?php foreach($wisata_laut as $wisata): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="destinasi-card">
                            <div class="destinasi-img-wrapper">
                                <?php 
                                $imgSrc = 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600';
                                if(!empty($wisata['image_url'])) {
                                    $imgSrc = base_url('uploads/' . $wisata['image_url']);
                                }
                                ?>
                                <img src="<?= $imgSrc ?>" alt="<?= esc($wisata['name'] ?? 'Destinasi') ?>">
                                <span class="destinasi-badge laut"><i class="bi bi-water me-1"></i>Laut</span>
                            </div>
                            <div class="destinasi-content">
                                <h5 class="destinasi-name"><?= esc($wisata['name'] ?? 'Destinasi') ?></h5>
                                <div class="activity-tags">
                                    <span class="activity-tag laut"><i class="bi bi-mask me-1"></i>Snorkeling</span>
                                    <span class="activity-tag laut"><i class="bi bi-camera me-1"></i>Diving</span>
                                </div>
                                <p class="destinasi-desc"><?= !empty($wisata['description']) ? esc($wisata['description']) : 'Nikmati keindahan bawah laut Karimunjawa dengan terumbu karang dan ikan warna-warni.' ?></p>
                                <div class="destinasi-price">
                                    <div>
                                        <span class="price-label">Estimasi biaya</span>
                                        <div>
                                            <span class="price-value">Rp <?= number_format($wisata['price_publish'] ?? 0, 0, ',', '.') ?></span>
                                            <span class="price-person">/orang</span>
                                        </div>
                                    </div>
                                    <a href="<?= base_url('/') ?>" class="btn btn-explore" style="background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);">
                                        <i class="bi bi-compass me-1"></i>Jelajahi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                
                <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-geo-alt"></i>
                    <h3>Belum ada data destinasi</h3>
                    <p class="text-muted">Data destinasi wisata akan segera ditambahkan</p>
                    <a href="<?= base_url('/') ?>" class="btn btn-primary mt-3">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
                    </a>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- TAB: WISATA DARAT -->
            <div class="tab-content" id="tab-darat">
                <?php if(!empty($wisata_darat)): ?>
                <div class="row g-4">
                    <?php foreach($wisata_darat as $wisata): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="destinasi-card">
                            <div class="destinasi-img-wrapper">
                                <?php 
                                $imgSrc = 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600';
                                if(!empty($wisata['image_url'])) {
                                    $imgSrc = base_url('uploads/' . $wisata['image_url']);
                                }
                                ?>
                                <img src="<?= $imgSrc ?>" alt="<?= esc($wisata['name'] ?? 'Destinasi') ?>">
                                <span class="destinasi-badge darat"><i class="bi bi-tree me-1"></i>Darat</span>
                            </div>
                            <div class="destinasi-content">
                                <h5 class="destinasi-name"><?= esc($wisata['name'] ?? 'Destinasi') ?></h5>
                                <div class="activity-tags">
                                    <span class="activity-tag"><i class="bi bi-camera me-1"></i>Foto</span>
                                    <span class="activity-tag"><i class="bi bi-binoculars me-1"></i>Explore</span>
                                </div>
                                <p class="destinasi-desc"><?= !empty($wisata['description']) ? esc($wisata['description']) : 'Nikmati keindahan wisata darat Karimunjawa.' ?></p>
                                <div class="destinasi-price">
                                    <div>
                                        <span class="price-label">Estimasi biaya</span>
                                        <div>
                                            <span class="price-value">Rp <?= number_format($wisata['price_publish'] ?? 0, 0, ',', '.') ?></span>
                                            <span class="price-person">/orang</span>
                                        </div>
                                    </div>
                                    <a href="<?= base_url('/') ?>" class="btn btn-explore">
                                        <i class="bi bi-compass me-1"></i>Jelajahi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-tree"></i>
                    <h3>Belum ada wisata darat</h3>
                    <p class="text-muted">Data wisata darat akan segera ditambahkan</p>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- TAB: WISATA LAUT -->
            <div class="tab-content" id="tab-laut">
                <?php if(!empty($wisata_laut)): ?>
                <div class="row g-4">
                    <?php foreach($wisata_laut as $wisata): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="destinasi-card">
                            <div class="destinasi-img-wrapper">
                                <?php 
                                $imgSrc = 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=600';
                                if(!empty($wisata['image_url'])) {
                                    $imgSrc = base_url('uploads/' . $wisata['image_url']);
                                }
                                ?>
                                <img src="<?= $imgSrc ?>" alt="<?= esc($wisata['name'] ?? 'Destinasi') ?>">
                                <span class="destinasi-badge laut"><i class="bi bi-water me-1"></i>Laut</span>
                            </div>
                            <div class="destinasi-content">
                                <h5 class="destinasi-name"><?= esc($wisata['name'] ?? 'Destinasi') ?></h5>
                                <div class="activity-tags">
                                    <span class="activity-tag laut"><i class="bi bi-mask me-1"></i>Snorkeling</span>
                                    <span class="activity-tag laut"><i class="bi bi-camera me-1"></i>Diving</span>
                                </div>
                                <p class="destinasi-desc"><?= !empty($wisata['description']) ? esc($wisata['description']) : 'Nikmati keindahan bawah laut Karimunjawa.' ?></p>
                                <div class="destinasi-price">
                                    <div>
                                        <span class="price-label">Estimasi biaya</span>
                                        <div>
                                            <span class="price-value">Rp <?= number_format($wisata['price_publish'] ?? 0, 0, ',', '.') ?></span>
                                            <span class="price-person">/orang</span>
                                        </div>
                                    </div>
                                    <a href="<?= base_url('/') ?>" class="btn btn-explore" style="background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);">
                                        <i class="bi bi-compass me-1"></i>Jelajahi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-water"></i>
                    <h3>Belum ada wisata laut</h3>
                    <p class="text-muted">Data wisata laut akan segera ditambahkan</p>
                </div>
                <?php endif; ?>
            </div>
            
        </div>
    </section>
    
    <!-- Footer Component -->
    <?php include(APPPATH . 'Views/components/footer.php'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tab switching
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                const tabId = 'tab-' + this.dataset.tab;
                document.getElementById(tabId).classList.add('active');
            });
        });
    </script>
    
    <!-- Support Widget -->
    <?php include(APPPATH . 'Views/components/support_widget.php'); ?>
</body>
</html>
