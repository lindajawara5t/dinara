<?php
// View blog posts - currently using API responses
// This is placeholder for full blog page view
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Berita Wisata Karimunjawa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .blog-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .blog-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .blog-header h1 {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
        }

        .blog-header p {
            font-size: 1.2rem;
            color: #64748b;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
        }

        .blog-card {
            border: 1px solid #e9ecef;
            border-radius: 16px;
            overflow: hidden;
            background: white;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .blog-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
            border-color: #0ea5e9;
        }

        .blog-image {
            position: relative;
            width: 100%;
            height: 220px;
            overflow: hidden;
            background: #f0f0f0;
        }

        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .blog-card:hover .blog-image img {
            transform: scale(1.05);
        }

        .blog-category {
            position: absolute;
            top: 12px;
            left: 12px;
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .blog-date {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.95);
            color: #495057;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .blog-body {
            padding: 24px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .blog-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: #1e293b;
            line-height: 1.4;
        }

        .blog-excerpt {
            font-size: 0.95rem;
            color: #64748b;
            margin-bottom: 16px;
            flex: 1;
            line-height: 1.6;
        }

        .blog-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid #e9ecef;
        }

        .blog-views {
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .blog-read-more {
            color: #0ea5e9;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .blog-read-more:hover {
            color: #0284c7;
            gap: 10px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }

        .loading {
            text-align: center;
            padding: 40px 20px;
        }

        .spinner-border {
            color: #0ea5e9;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .blog-card {
            animation: fadeIn 0.5s ease-out;
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
    <div class="blog-container">
        <div class="blog-header">
            <h1><i class="bi bi-newspaper me-3"></i>Berita & Tips Wisata</h1>
            <p>Temukan informasi menarik seputar Karimunjawa dan panduan liburanmu</p>
        </div>

        <div class="blog-grid" id="blogGrid">
            <div class="loading">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3">Memuat blog posts...</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        async function loadBlogPosts() {
            try {
                const response = await fetch('/blog?limit=12');
                const posts = await response.json();
                
                const container = document.getElementById('blogGrid');
                
                if (!posts || posts.length === 0) {
                    container.innerHTML = '<div class="empty-state"><p>Belum ada blog posts</p></div>';
                    return;
                }

                let html = '';
                posts.forEach(post => {
                    const date = new Date(post.created_at).toLocaleDateString('id-ID', { 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    });
                    
                    const imageUrl = post.featured_image 
                        ? `/uploads/blog/${post.featured_image}`
                        : 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400';
                    
                    html += `
                        <div class="blog-card">
                            <div class="blog-image">
                                <img src="${imageUrl}" 
                                     alt="${escapeHtml(post.title)}"
                                     onerror="this.src='https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400';">
                                <span class="blog-category">${post.category}</span>
                                <span class="blog-date">${date}</span>
                            </div>
                            <div class="blog-body">
                                <h5 class="blog-title">${escapeHtml(post.title)}</h5>
                                <p class="blog-excerpt">${escapeHtml(post.excerpt || post.content.substring(0, 100))}...</p>
                                <div class="blog-footer">
                                    <span class="blog-views"><i class="bi bi-eye"></i> ${post.views} views</span>
                                    <a href="/blog/${post.slug}" class="blog-read-more">
                                        Baca <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                container.innerHTML = html;
            } catch (error) {
                console.error('Error loading blog posts:', error);
                document.getElementById('blogGrid').innerHTML = '<div class="empty-state"><p>Gagal memuat blog posts</p></div>';
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

        // Load posts on page load
        document.addEventListener('DOMContentLoaded', loadBlogPosts);
    </script>

    <!-- Footer Component -->
    <?php include(APPPATH . 'Views/components/footer.php'); ?>
    
    <!-- Support Widget -->
    <?php include(APPPATH . 'Views/components/support_widget.php'); ?>
</body>
</html>
