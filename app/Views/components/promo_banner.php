<?php
/**
 * Promo Banner Component
 * Menampilkan banner promo di bawah form input
 */
$promo_text = $settings['promo_banner_text'] ?? 'Yuk, cek ada promo apa aja yang bisa kamu pakai biar biar pesan tiket pesawat jadi lebih hemat.';
$promo_link = $settings['promo_banner_link'] ?? '#';
$promo_cta = $settings['promo_banner_cta'] ?? 'Cek promonya sekarang!';
$promo_icon = $settings['promo_banner_icon'] ?? 'bi-megaphone-fill';
?>

<style>
    .promo-banner-container {
        margin: 20px 0;
    }

    .promo-banner {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
        animation: slideInDown 0.5s ease-out;
    }

    .promo-banner-icon {
        font-size: 28px;
        color: white;
        flex-shrink: 0;
        animation: bounce 2s infinite;
    }

    .promo-banner-content {
        flex: 1;
    }

    .promo-banner-text {
        color: white;
        font-size: 14px;
        margin: 0;
        font-weight: 500;
        line-height: 1.5;
    }

    .promo-banner-link {
        color: #fbbf24;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .promo-banner-link:hover {
        color: white;
        text-decoration: underline;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    @media (max-width: 768px) {
        .promo-banner {
            padding: 12px 16px;
            gap: 12px;
        }

        .promo-banner-icon {
            font-size: 24px;
        }

        .promo-banner-text {
            font-size: 13px;
        }

        .promo-banner-link {
            font-size: 13px;
        }
    }
</style>

<div class="promo-banner-container">
    <div class="promo-banner">
        <div class="promo-banner-icon">
            <i class="bi <?= esc($promo_icon) ?>"></i>
        </div>
        <div class="promo-banner-content">
            <p class="promo-banner-text">
                <?= esc($promo_text) ?>
                <a href="<?= esc($promo_link) ?>" class="promo-banner-link" target="_blank" rel="noopener noreferrer">
                    <?= esc($promo_cta) ?>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </p>
        </div>
    </div>
</div>
