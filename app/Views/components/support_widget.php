<!-- SUPPORT WIDGET LIVE CHAT -->
<?php if(!empty($settings['support_enabled'])): ?>

<!-- SUPPORT WIDGET BANNER POPUP - MODERN 2027 -->
<div class="support-banner-popup" id="supportBannerPopup">
    <div class="support-banner-card">
        <button class="support-banner-close-btn" id="supportBannerClose" title="Tutup">
            <i class="bi bi-x-lg"></i>
        </button>
        
        <div class="support-banner-top">
            <span class="support-banner-emoji"><?= $settings['support_emoji'] ?? '✨' ?></span>
            <h4 class="support-banner-title"><?= esc($settings['support_title'] ?? 'Hubungi Tim Kami') ?></h4>
        </div>
        
        <p class="support-banner-subtitle">Tim support kami siap melayani Anda kapan saja</p>
        
        <div class="support-banner-cta-wrapper">
            <a href="<?= !empty($settings['support_whatsapp']) ? 'https://wa.me/' . $settings['support_whatsapp'] : '#' ?>" target="_blank" rel="noopener noreferrer" class="support-banner-cta">
                <i class="bi bi-chat-dots"></i>
                <span>Mulai Chat</span>
            </a>
        </div>
    </div>
</div>

<!-- SUPPORT WIDGET LIVE CHAT -->
<div class="support-widget-container">
    <div class="support-widget-toggle" id="supportWidgetToggle" title="Chat dengan kami">
        <i class="bi bi-chat-dots-fill"></i>
    </div>

    <div class="support-widget-panel" id="supportWidgetPanel">
        <div class="support-widget-header">
            <div class="header-content">
                <span class="header-emoji"><?= $settings['support_emoji'] ?? '✨' ?></span>
                <div class="header-text">
                    <h3><?= esc($settings['support_title'] ?? 'Tim Support Kami') ?></h3>
                    <p><span class="status-indicator"></span>Online sekarang</p>
                </div>
            </div>
            <div class="header-divider"></div>
        </div>

        <div class="support-widget-content">
            <div class="welcome-message">
                <i class="bi bi-lightbulb"></i>
                <p><?= esc($settings['support_default_message'] ?? 'Halo! Bagaimana kami bisa membantu Anda?') ?></p>
            </div>

            <div class="agents-section">
                <p class="agents-label">Tim Profesional Kami</p>
                <div id="supportAgentsList" class="agents-grid">
                    <!-- Agents loaded here -->
                </div>
            </div>
        </div>

        <div class="support-widget-footer">
            <a href="<?= !empty($settings['support_whatsapp']) ? 'https://wa.me/' . $settings['support_whatsapp'] : '#' ?>" target="_blank" rel="noopener noreferrer" class="footer-cta-btn">
                <i class="bi bi-whatsapp"></i>
                <span>Chat via WhatsApp</span>
            </a>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
    // ===== SUPPORT WIDGET INITIALIZATION =====
    document.addEventListener('DOMContentLoaded', function() {
        const supportToggle = document.getElementById('supportWidgetToggle');
        const supportPanel = document.getElementById('supportWidgetPanel');
        const supportAgentsList = document.getElementById('supportAgentsList');
        const supportBannerPopup = document.getElementById('supportBannerPopup');
        const supportBannerClose = document.getElementById('supportBannerClose');

        // Sample support agents data
        const supportAgents = [
            {
                name: 'Domestik Support',
                icon: 'bi-airplane-fill',
                status: 'Online',
                message: 'Paket wisata domestik'
            },
            {
                name: 'International Support',
                icon: 'bi-globe',
                status: 'Online',
                message: 'Paket internasional'
            }
        ];

        // Render agents
        if (supportAgentsList) {
            supportAgentsList.innerHTML = supportAgents.map(agent => {
                return `
                    <div class="agent-card">
                        <div class="agent-avatar-circle">
                            <i class="bi ${agent.icon}"></i>
                        </div>
                        <div class="agent-details">
                            <span class="agent-name">${agent.name}</span>
                            <span class="agent-status">
                                <span class="status-dot"></span>
                                ${agent.status}
                            </span>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Toggle widget panel
        if (supportToggle) {
            supportToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                supportPanel?.classList.toggle('active');
                supportToggle.classList.toggle('active');
            });
        }

        // Close panel when clicking outside
        document.addEventListener('click', (e) => {
            const isClickInsideWidget = e.target.closest('.support-widget-container');
            if (!isClickInsideWidget && supportPanel?.classList.contains('active')) {
                supportPanel?.classList.remove('active');
                supportToggle?.classList.remove('active');
            }
        });

        // Banner close button
        if (supportBannerClose) {
            supportBannerClose.addEventListener('click', () => {
                supportBannerPopup?.classList.add('hide');
            });
        }

        // Auto hide banner after 8 seconds
        setTimeout(() => {
            supportBannerPopup?.classList.add('hide');
        }, 8000);
    });
</script>
