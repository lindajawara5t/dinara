<?php
// Get slideshow data
$slideshows = model('HeroSlideshowModel')->getActiveSlideshows();
?>

<?php if (!empty($slideshows)): ?>
<!-- Hero Background Slideshow -->
<div class="slideshow-background-container" id="slideshow-bg-container">
    <?php foreach ($slideshows as $index => $slide): ?>
        <div class="slide-bg <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>" data-id="<?= $slide['id'] ?>" style="background-image: url('<?= $slide['image_url'] ?>');">
            <div class="slide-bg-overlay"></div>
        </div>
    <?php endforeach; ?>
</div>

<script>
(function() {
    console.log('🎬 Hero Slideshow Initialized');
    
    let currentSlideBg = 0;
    const slideBgs = document.querySelectorAll('.slide-bg');
    let slideBgInterval = null;
    
    console.log('📊 Total Slides Found:', slideBgs.length);

    function showSlideBg(n) {
        // Validate index
        if (n >= slideBgs.length) currentSlideBg = 0;
        if (n < 0) currentSlideBg = slideBgs.length - 1;
        
        // Remove active from all
        slideBgs.forEach(slide => {
            slide.classList.remove('active');
        });
        
        // Add active to current
        if (slideBgs[currentSlideBg]) {
            slideBgs[currentSlideBg].classList.add('active');
            console.log('🖼️ Showing Slide:', currentSlideBg + 1, 'of', slideBgs.length);
        }
    }

    function autoPlayBg() {
        currentSlideBg++;
        showSlideBg(currentSlideBg);
    }

    function resetAutoPlayBg() {
        if (slideBgInterval) {
            clearInterval(slideBgInterval);
        }
        if (slideBgs.length > 1) {
            slideBgInterval = setInterval(autoPlayBg, 5000);
            console.log('⏱️ Auto-play resumed');
        }
    }

    function nextSlideBg() {
        currentSlideBg++;
        showSlideBg(currentSlideBg);
        resetAutoPlayBg();
    }

    function prevSlideBg() {
        currentSlideBg--;
        showSlideBg(currentSlideBg);
        resetAutoPlayBg();
    }

    // Initialize
    if (slideBgs.length > 0) {
        console.log('✅ Slideshow Starting with', slideBgs.length, 'slides');
        showSlideBg(currentSlideBg);
        
        if (slideBgs.length > 1) {
            slideBgInterval = setInterval(autoPlayBg, 5000);
            console.log('⏱️ Auto-play interval set (5 seconds)');
            
            // Pause on hover
            const heroContainer = document.querySelector('.hero-section-with-slideshow');
            if (heroContainer) {
                heroContainer.addEventListener('mouseenter', () => {
                    if (slideBgInterval) {
                        clearInterval(slideBgInterval);
                        console.log('⏸️ Auto-play paused');
                    }
                });
                
                heroContainer.addEventListener('mouseleave', () => {
                    resetAutoPlayBg();
                });
            }
        }
        
        // Expose to window for debugging
        window.slideshowControl = {
            next: nextSlideBg,
            prev: prevSlideBg,
            current: () => currentSlideBg + 1
        };
        
        console.log('✅ Slideshow ready! Use window.slideshowControl.next(), .prev() to control');
    } else {
        console.warn('⚠️ No slides found! Check HeroSlideshowModel');
    }
})();
</script>
<?php else: ?>
<!-- No active slideshows -->
<div class="slideshow-background-container" id="slideshow-bg-container" style="background-color: #e0e0e0; display: flex; align-items: center; justify-content: center;">
    <div style="text-align: center; color: #999;">
        <p>📸 Slideshow belum dikonfigurasi</p>
        <small><a href="<?= base_url('admin') ?>" style="color: #0066cc;">Buka Admin Panel untuk menambah slide</a></small>
    </div>
</div>
<?php endif; ?>
