<!DOCTYPE html>
<html lang="<?= $current_lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itinerary Perjalanan - Dinara Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0a1428 0%, #1a2f5e 50%, #2d1b4e 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background elements */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(118, 75, 162, 0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .header-top {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%);
            color: white;
            padding: 50px 0;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 1;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .back-button {
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 16px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-5px);
            color: white;
        }

        .header-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #ffffff 0%, #e0e7ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 300;
            letter-spacing: 0.5px;
        }

        .main-content {
            padding: 60px 40px;
            position: relative;
            z-index: 1;
        }

        .container-wide {
            max-width: 1600px;
            margin: 0 auto;
        }

        .content-wrapper {
            display: grid;
            grid-template-columns: 500px 1fr;
            gap: 30px;
            align-items: start;
        }

        .itinerary-main {
            min-width: 0;
        }

        .sidebar-promo {
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .promo-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
            border: 2px solid transparent;
        }

        .promo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(102, 126, 234, 0.2);
            border-color: #667eea;
        }

        .promo-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            border-radius: 15px;
            margin: -25px -25px 15px -25px;
            text-align: center;
            font-weight: 800;
            font-size: 1.1rem;
        }

        .promo-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #1a2f5e;
            margin-bottom: 8px;
        }

        .promo-price {
            font-size: 1.3rem;
            font-weight: 900;
            color: #667eea;
            margin-bottom: 10px;
        }

        .promo-description {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .promo-features {
            font-size: 0.85rem;
            color: #555;
            list-style: none;
            margin-bottom: 15px;
        }

        .promo-features li {
            padding: 5px 0;
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .promo-features li:before {
            content: '✓';
            color: #667eea;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .promo-button {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .promo-button:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .duration-tabs {
            background: rgba(255, 255, 255, 0.08);
            padding: 30px;
            border-radius: 25px;
            margin-bottom: 50px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .duration-btn {
            padding: 12px 32px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.05);
            color: white;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            font-size: 1rem;
            backdrop-filter: blur(10px);
        }

        .duration-btn:hover {
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
        }

        .duration-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
            transform: translateY(-3px);
        }

        .timeline-container {
            position: relative;
        }

        .day-section {
            margin-bottom: 40px;
            animation: slideInUp 0.6s ease-out;
        }

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

        .day-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 12px 12px 0 0;
            font-size: 1.2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.2);
        }

        .day-number {
            background: rgba(255, 255, 255, 0.2);
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 800;
            backdrop-filter: blur(10px);
        }

        .timeline-items {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 0 0 12px 12px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .timeline-item {
            position: relative;
            padding: 15px 15px 15px 60px;
            border-left: 3px solid #e0e7ff;
            margin-bottom: 20px;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            border-radius: 10px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-item:hover {
            padding-left: 75px;
            background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 100%);
            border-left-color: #667eea;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.15);
        }

        .timeline-icon {
            position: absolute;
            left: -15px;
            top: 15px;
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: 3px solid white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            box-shadow: 0 3px 10px rgba(102, 126, 234, 0.3);
        }

        .time-badge {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 6px;
            letter-spacing: 0;
        }

        .activity-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1a2f5e;
            margin-bottom: 5px;
            letter-spacing: 0;
        }

        .activity-description {
            color: #666;
            font-size: 0.8rem;
            margin-bottom: 8px;
            line-height: 1.4;
            font-weight: 400;
        }

        .activity-location {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #764ba2;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 0;
        }

        .activity-image-placeholder {
            width: 100%;
            height: 120px;
            background: linear-gradient(135deg, #e0e7ff 0%, #f0f4ff 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            font-size: 1.8rem;
            color: #667eea;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px dashed #667eea;
        }

        .activity-image-placeholder:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: white;
            transform: scale(1.02);
        }

        .empty-state {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            padding: 80px 40px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 25px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .empty-state-text {
            color: #666;
            font-size: 1.2rem;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        @media (max-width: 1024px) {
            .content-wrapper {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .sidebar-promo {
                position: relative;
                top: 0;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .activity-image-placeholder {
                height: 100px;
                font-size: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .header-title {
                font-size: 2rem;
            }

            .header-content {
                padding: 0 20px;
            }

            .main-content {
                padding: 40px 20px;
            }

            .day-header {
                font-size: 1.1rem;
                padding: 12px 15px;
            }

            .day-number {
                width: 38px;
                height: 38px;
                font-size: 1rem;
            }

            .timeline-items {
                padding: 15px;
            }

            .timeline-item {
                padding: 12px 12px 12px 50px;
            }

            .timeline-icon {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
                left: -12px;
                top: 12px;
            }

            .duration-tabs {
                flex-direction: column;
                padding: 20px;
            }

            .duration-btn {
                width: 100%;
            }

            .activity-image-placeholder {
                height: 180px;
                font-size: 2rem;
            }

            .sidebar-promo {
                grid-template-columns: 1fr;
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* FOOTER STYLES */
        .modern-luxury-footer {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #e2e8f0;
            padding: 60px 0 0 0;
            position: relative;
            overflow: hidden;
            margin-top: 60px;
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
    <!-- HEADER -->
    <div class="header-top">
        <div class="header-content">
            <a href="<?= base_url() ?>" class="back-button">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <div class="header-title">
                📅 Itinerary Perjalanan
            </div>
            <div class="header-subtitle">
                Jelajahi setiap momen perjalanan Anda dengan detail aktivitas yang lengkap dan inspiratif
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-wide">
            <!-- DURATION TABS -->
            <div class="duration-tabs">
                <button class="duration-btn active" onclick="switchDuration(3)">
                    <i class="bi bi-calendar-event"></i> 3 Hari 2 Malam
                </button>
                <button class="duration-btn" onclick="switchDuration(2)">
                    <i class="bi bi-calendar-event"></i> 2 Hari 1 Malam
                </button>
                <button class="duration-btn" onclick="switchDuration(4)">
                    <i class="bi bi-calendar-event"></i> 4 Hari 3 Malam
                </button>
            </div>

            <!-- CONTENT WRAPPER - 2 COLUMN LAYOUT -->
            <div class="content-wrapper">
                <!-- TIMELINE MAIN -->
                <div class="itinerary-main">
                    <!-- TIMELINE CONTENT -->
                    <div id="timeline-content" class="timeline-container fade-in">
                        <!-- Content akan diisi oleh JavaScript -->
                    </div>
                </div>

                <!-- SIDEBAR PROMO -->
                <div class="sidebar-promo">
                    <!-- Promo cards akan ditampilkan di sini -->
                    <div class="promo-card">
                        <div class="promo-header">🏝️ Paket Karimunjawa</div>
                        <div class="promo-title">Snorkeling Paradise</div>
                        <div class="promo-price">Rp 1.5M+</div>
                        <div class="promo-description">Eksplorasi keindahan bawah laut Karimunjawa dengan pemandu berpengalaman.</div>
                        <ul class="promo-features">
                            <li>Snorkeling di 3 spot</li>
                            <li>Equipment lengkap</li>
                            <li>Makan siang gratis</li>
                        </ul>
                        <button class="promo-button">Info Selengkapnya</button>
                    </div>

                    <div class="promo-card">
                        <div class="promo-header">🏖️ Luxury Retreat</div>
                        <div class="promo-title">Island Escape</div>
                        <div class="promo-price">Rp 2.5M+</div>
                        <div class="promo-description">Nikmati pengalaman mewah di pulau-pulau eksotis Karimunjawa.</div>
                        <ul class="promo-features">
                            <li>Akomodasi bintang</li>
                            <li>Private island tour</li>
                            <li>Sunset cruise</li>
                        </ul>
                        <button class="promo-button">Info Selengkapnya</button>
                    </div>

                    <div class="promo-card">
                        <div class="promo-header">🎣 Fishing Tour</div>
                        <div class="promo-title">Petualangan Menangkap</div>
                        <div class="promo-price">Rp 1.2M+</div>
                        <div class="promo-description">Pengalaman memancing yang tak terlupakan di perairan Karimunjawa.</div>
                        <ul class="promo-features">
                            <li>Rod & reel rental</li>
                            <li>Local guide expert</li>
                            <li>Fish preparation</li>
                        </ul>
                        <button class="promo-button">Info Selengkapnya</button>
                    </div>

                    <div class="promo-card">
                        <div class="promo-header">🚁 Aerial Tour</div>
                        <div class="promo-title">Sky View Adventure</div>
                        <div class="promo-price">Rp 3M+</div>
                        <div class="promo-description">Lihat keindahan Karimunjawa dari perspektif udara yang menakjubkan.</div>
                        <ul class="promo-features">
                            <li>Drone photography</li>
                            <li>4K video</li>
                            <li>Digital album</li>
                        </ul>
                        <button class="promo-button">Info Selengkapnya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data dari controller
        const itineraryData = <?= $json_itinerary ?>;
        const titles = <?= json_encode($titles) ?>;
        const currentDuration = <?= (int)$durasi ?>;

        // Initialize dengan durasi saat ini
        let selectedDuration = currentDuration;

        // Render itinerary saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            renderItinerary(selectedDuration);
            updateActiveButton(selectedDuration);
        });

        function switchDuration(durasi) {
            selectedDuration = durasi;
            updateActiveButton(durasi);
            
            // Fetch data untuk durasi baru
            fetch('<?= base_url('itinerary') ?>/' + durasi)
                .then(response => response.text())
                .then(html => {
                    // Parse HTML dan ambil timeline content
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const timelineContent = doc.getElementById('timeline-content').innerHTML;
                    document.getElementById('timeline-content').innerHTML = timelineContent;
                })
                .catch(error => {
                    console.log('Using local data for duration:', durasi);
                    renderItinerary(durasi);
                });
        }

        function updateActiveButton(durasi) {
            document.querySelectorAll('.duration-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // More reliable way to set active
            document.querySelectorAll('.duration-btn').forEach(btn => {
                const textContent = btn.textContent;
                if (durasi === 2 && textContent.includes('2 Hari')) {
                    btn.classList.add('active');
                } else if (durasi === 3 && textContent.includes('3 Hari')) {
                    btn.classList.add('active');
                } else if (durasi === 4 && textContent.includes('4 Hari')) {
                    btn.classList.add('active');
                }
            });
        }

        function renderItinerary(durasi) {
            const filtered = itineraryData.filter(item => parseInt(item.duration_day) === durasi);
            
            if (filtered.length === 0) {
                document.getElementById('timeline-content').innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">📭</div>
                        <div class="empty-state-text">
                            Belum ada itinerary untuk durasi ${durasi} hari. <br>
                            Silahkan hubungi kami untuk informasi lebih lanjut.
                        </div>
                    </div>
                `;
                return;
            }

            // Group by day
            const grouped = {};
            filtered.forEach(item => {
                const day = parseInt(item.day_number);
                if (!grouped[day]) grouped[day] = [];
                grouped[day].push(item);
            });

            let html = '';
            const days = Object.keys(grouped).sort((a, b) => a - b);

            days.forEach((dayNum, index) => {
                const activities = grouped[dayNum];
                html += `
                    <div class="day-section" style="animation-delay: ${index * 0.15}s;">
                        <div class="day-header">
                            <div class="day-number">Hari ${dayNum}</div>
                            <div>Perjalanan Hari Ke-${dayNum}</div>
                        </div>
                        <div class="timeline-items">
                `;

                activities.forEach((activity, actIndex) => {
                    const icon = activity.icon || '📍';
                    const timeDisplay = `${activity.time_start}${activity.time_end ? ' - ' + activity.time_end : ''}`;
                    
                    html += `
                        <div class="timeline-item">
                            <div class="timeline-icon">${icon}</div>
                            <div class="time-badge">⏰ ${timeDisplay}</div>
                            <div class="activity-title">${activity.title}</div>
                            ${activity.description ? `<div class="activity-description">${activity.description}</div>` : ''}
                            ${activity.location ? `<div class="activity-location">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>${activity.location}</span>
                            </div>` : ''}
                            <div class="activity-image-placeholder" title="Klik untuk upload foto">
                                <i class="bi bi-image"></i>
                            </div>
                        </div>
                    `;
                });

                html += `
                        </div>
                    </div>
                `;
            });

            document.getElementById('timeline-content').innerHTML = html;
            document.getElementById('timeline-content').classList.add('fade-in');
        }
    </script>

    <!-- Footer Component -->
    <?php include(APPPATH . 'Views/components/footer.php'); ?>
    
    <!-- Support Widget -->
    <?php include(APPPATH . 'Views/components/support_widget.php'); ?>
</body>
</html>
