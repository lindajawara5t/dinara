<?php
// Get slideshow data
$slideshowModel = new \App\Models\HeroSlideshowModel();
$slideshows = $slideshowModel->getActiveSlideshows();
?>

<?php if (!empty($slideshows)): ?>
<!-- Hero Background Slideshow -->
<div class="slideshow-background-container" id="slideshow-bg-container">
    <?php foreach ($slideshows as $index => $slide): ?>
        <div class="slide-bg <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>" data-id="<?= $slide['id'] ?>">
            <div class="slide-bg-image" style="background-image: url('<?= base_url($slide['image_url']) ?>')"></div>
            <div class="slide-bg-overlay"></div>
        </div>
    <?php endforeach; ?>
</div>

<script>
(function() {
    let currentSlideBg = 0;
    const slideBgs = document.querySelectorAll('.slide-bg');
    let slideBgInterval;

    function showSlideBg(n) {
        if (n >= slideBgs.length) currentSlideBg = 0;
        if (n < 0) currentSlideBg = slideBgs.length - 1;
        
        slideBgs.forEach(slide => slide.classList.remove('active'));
        if (slideBgs[currentSlideBg]) {
            slideBgs[currentSlideBg].classList.add('active');
        }
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

    // Initialize
    if (slideBgs.length > 0) {
        showSlideBg(currentSlideBg);
        if (slideBgs.length > 1) {
            slideBgInterval = setInterval(autoPlayBg, 5000);
        }

        // Pause on hover
        const heroContainer = document.querySelector('.hero-section-with-slideshow');
        if (heroContainer) {
            heroContainer.addEventListener('mouseenter', () => clearInterval(slideBgInterval));
            heroContainer.addEventListener('mouseleave', () => resetAutoPlayBg());
        }
    }
})();
</script>
<?php endif; ?>
