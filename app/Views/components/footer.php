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
