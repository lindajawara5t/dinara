<?php
// Get slideshow data
$slideshowModel = new \App\Models\HeroSlideshowModel();
$slideshows = $slideshowModel->getActiveSlideshows();
?>

<style>
/* HERO SLIDESHOW BACKGROUND STYLES */
.hero-section-with-slideshow {
    position: relative;
    overflow: hidden;
    min-height: 600px;
    padding-top: 120px;
    padding-bottom: 200px;
    color: white;
    text-align: center;
    width: 100vw;
    margin-left: calc(-50vw + 50%);
}

.slideshow-background-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
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

.slide-bg::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 30%, rgba(0, 200, 255, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(13, 110, 253, 0.12) 0%, transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(0, 150, 255, 0.08) 0%, transparent 60%);
    z-index: 1;
    pointer-events: none;
}

.hero-section-with-slideshow .container-fluid {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 100% !important;
    padding-left: 50px !important;
    padding-right: 50px !important;
}

@media (max-width: 768px) {
    .hero-section-with-slideshow {
        padding-top: 100px;
        padding-bottom: 150px;
        min-height: 400px;
    }
}
</style>

<?php if (!empty($slideshows)): ?>
<!-- Hero Background Slideshow (Hidden - only for background) -->
<div class="slideshow-background-container">
    <?php foreach ($slideshows as $index => $slide): ?>
        <div class="slide-bg <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>">
            <div class="slide-bg-image" style="background-image: url('<?= base_url($slide['image_url']) ?>')"></div>
            <div class="slide-bg-overlay"></div>
        </div>
    <?php endforeach; ?>
</div>

<script>
let currentSlideBg = 0;
const slideBgs = document.querySelectorAll('.slide-bg');
let slideBgInterval;

function showSlideBg(n) {
    if (n >= slideBgs.length) currentSlideBg = 0;
    if (n < 0) currentSlideBg = slideBgs.length - 1;
    
    slideBgs.forEach(slide => slide.classList.remove('active'));
    slideBgs[currentSlideBg].classList.add('active');
}

function autoPlayBg() {
    currentSlideBg++;
    showSlideBg(currentSlideBg);
}

function resetAutoPlayBg() {
    clearInterval(slideBgInterval);
    if (slideBgs.length > 1) {
        slideBgInterval = setInterval(autoPlayBg, 5000);
    }
}

// Initialize slideshow background
showSlideBg(currentSlideBg);
if (slideBgs.length > 1) {
    slideBgInterval = setInterval(autoPlayBg, 5000);
}

// Pause on hover
const heroBgContainer = document.querySelector('.slideshow-background-container');
if (heroBgContainer && heroBgContainer.parentElement) {
    heroBgContainer.parentElement.addEventListener('mouseenter', () => clearInterval(slideBgInterval));
    heroBgContainer.parentElement.addEventListener('mouseleave', () => resetAutoPlayBg());
}
</script>
<?php endif; ?>
