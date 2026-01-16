<?php
// Get slideshow data
$slideshowModel = new \App\Models\HeroSlideshowModel();
$slideshows = $slideshowModel->getActiveSlideshows();
?>

<style>
/* HERO SLIDESHOW STYLES */
.hero-slideshow-container {
    position: relative;
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    padding-top: 120px;
    padding-bottom: 200px;
    color: white;
    text-align: center;
    overflow: hidden;
    min-height: 600px;
}

.slideshow-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.8s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
}

.slide.active {
    opacity: 1;
    position: relative;
}

.slide-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    z-index: 0;
}

.slide-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.3) 0%, rgba(0, 100, 255, 0.25) 40%, rgba(0, 31, 63, 0.4) 100%);
    z-index: 1;
    pointer-events: none;
}

.slide-content {
    position: relative;
    z-index: 2;
    width: 100%;
    padding: 50px;
    text-align: center;
    animation: slideInContent 0.8s ease-in-out;
}

@keyframes slideInContent {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.slide-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.slide-description {
    font-size: 1.2rem;
    margin-bottom: 20px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

/* SLIDESHOW INDICATORS */
.slideshow-indicators {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 12px;
    z-index: 10;
    flex-wrap: wrap;
    justify-content: center;
}

.indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.indicator.active {
    background: rgba(255, 255, 255, 0.9);
    width: 30px;
    border-radius: 6px;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

.indicator:hover {
    background: rgba(255, 255, 255, 0.7);
    transform: scale(1.1);
}

/* SLIDESHOW NAVIGATION ARROWS */
.slideshow-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
}

.slideshow-nav:hover {
    background: rgba(255, 255, 255, 0.4);
    transform: translateY(-50%) scale(1.1);
}

.slideshow-nav.prev {
    left: 30px;
}

.slideshow-nav.next {
    right: 30px;
}

@media (max-width: 768px) {
    .hero-slideshow-container {
        padding-top: 100px;
        padding-bottom: 150px;
        min-height: 400px;
    }

    .slide-title {
        font-size: 1.8rem;
    }

    .slide-description {
        font-size: 1rem;
    }

    .slideshow-nav {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
    }

    .slideshow-nav.prev {
        left: 10px;
    }

    .slideshow-nav.next {
        right: 10px;
    }

    .indicator {
        width: 10px;
        height: 10px;
    }

    .indicator.active {
        width: 24px;
    }
}
</style>

<?php if (!empty($slideshows)): ?>
<section class="hero-slideshow-container">
    <div class="slideshow-wrapper">
        <?php foreach ($slideshows as $index => $slide): ?>
            <div class="slide <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>">
                <div class="slide-background" style="background-image: url('<?= base_url($slide['image_url']) ?>')"></div>
                <div class="slide-overlay"></div>
                <?php if ($slide['title'] || $slide['description']): ?>
                    <div class="slide-content">
                        <?php if ($slide['title']): ?>
                            <h1 class="slide-title"><?= $slide['title'] ?></h1>
                        <?php endif; ?>
                        <?php if ($slide['description']): ?>
                            <p class="slide-description"><?= $slide['description'] ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (count($slideshows) > 1): ?>
        <!-- Navigation Arrows -->
        <button class="slideshow-nav prev" onclick="prevSlide()" title="Slide Sebelumnya">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button class="slideshow-nav next" onclick="nextSlide()" title="Slide Berikutnya">
            <i class="bi bi-chevron-right"></i>
        </button>

        <!-- Indicators -->
        <div class="slideshow-indicators">
            <?php foreach ($slideshows as $index => $slide): ?>
                <span class="indicator <?= $index === 0 ? 'active' : '' ?>" 
                      onclick="goToSlide(<?= $index ?>)" 
                      title="Slide <?= $index + 1 ?>"></span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const indicators = document.querySelectorAll('.indicator');
let slideInterval;

function showSlide(n) {
    // Normalize index
    if (n >= slides.length) currentSlide = 0;
    if (n < 0) currentSlide = slides.length - 1;
    
    // Hide all slides
    slides.forEach(slide => slide.classList.remove('active'));
    indicators.forEach(ind => ind.classList.remove('active'));
    
    // Show current slide
    slides[currentSlide].classList.add('active');
    if (indicators[currentSlide]) {
        indicators[currentSlide].classList.add('active');
    }
}

function nextSlide() {
    currentSlide++;
    showSlide(currentSlide);
    resetAutoPlay();
}

function prevSlide() {
    currentSlide--;
    showSlide(currentSlide);
    resetAutoPlay();
}

function goToSlide(n) {
    currentSlide = n;
    showSlide(currentSlide);
    resetAutoPlay();
}

function autoPlay() {
    currentSlide++;
    showSlide(currentSlide);
}

function resetAutoPlay() {
    clearInterval(slideInterval);
    if (slides.length > 1) {
        slideInterval = setInterval(autoPlay, 5000); // Change slide every 5 seconds
    }
}

// Initialize slideshow
showSlide(currentSlide);
if (slides.length > 1) {
    slideInterval = setInterval(autoPlay, 5000);
}

// Pause autoplay on hover
const slideshowContainer = document.querySelector('.slideshow-wrapper');
if (slideshowContainer) {
    slideshowContainer.addEventListener('mouseenter', () => clearInterval(slideInterval));
    slideshowContainer.addEventListener('mouseleave', () => resetAutoPlay());
}
</script>
<?php else: ?>
<!-- Fallback ke hero section statis jika tidak ada slideshow -->
<section class="hero-section" style="background: 
    linear-gradient(135deg, rgba(13, 110, 253, 0.3) 0%, rgba(0, 100, 255, 0.25) 40%, rgba(0, 31, 63, 0.4) 100%),
    url('<?= base_url('uploads/' . ($settings['hero_image'] ?? '')) ?>');
background-size: cover; background-position: right center;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 style="font-size: 3.5rem; font-weight: 700; line-height: 1.2; margin-bottom: 20px;">
                    <?= $settings['hero_title'] ?? 'Selamat Datang di Dinara Travel' ?>
                </h1>
                <p style="font-size: 1.2rem; margin-bottom: 30px; opacity: 0.95;">
                    <?= $settings['hero_subtitle'] ?? 'Jelajahi keindahan Karimunjawa bersama kami' ?>
                </p>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
