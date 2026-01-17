<?php
// Test file: Direct check landing page slideshow render

// Load CodeIgniter
require_once 'app/Config/Database.php';

$model = new \App\Models\HeroSlideshowModel();
$slides = $model->getActiveSlideshows();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Slideshow Render Test</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .section { background: white; padding: 20px; margin: 15px 0; border-radius: 8px; }
        h2 { color: #333; border-bottom: 2px solid #667eea; padding-bottom: 10px; }
        .success { color: #2e7d32; }
        .error { color: #c62828; }
        .hero-slide { width: 100%; height: 300px; opacity: 0; transition: opacity 0.7s; position: absolute; top: 0; left: 0; }
        .hero-slide.active { opacity: 1; }
        .hero-slider { position: relative; width: 100%; height: 300px; background: #e0e0e0; border-radius: 8px; overflow: hidden; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎬 Slideshow Render Test</h1>
        
        <div class="section">
            <h2>Database Check</h2>
            <?php if (empty($slides)): ?>
                <p class="error">❌ No slides found in database!</p>
            <?php else: ?>
                <p class="success">✅ Found <?= count($slides); ?> active slides</p>
                <ul>
                <?php foreach($slides as $slide): ?>
                    <li><?= $slide['title'] ?> (ID: <?= $slide['id'] ?>, Duration: <?= $slide['duration'] ?? 'default' ?>ms)</li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        
        <div class="section">
            <h2>HTML Render Test</h2>
            
            <p>Rendering slideshow struktur seperti di landing_page_story.php:</p>
            
            <div class="hero-slider" id="heroSlider">
                <?php if (!empty($slides)): ?>
                    <?php foreach($slides as $idx => $slide): ?>
                    <div class="hero-slide <?= $idx === 0 ? 'active' : '' ?>" 
                         data-slide="<?= $idx ?>" 
                         data-duration="<?= $slide['duration'] ?? 5000 ?>"
                         style="background-image: url('<?= $slide['image_url'] ?>'); 
                                background-size: cover; 
                                background-position: center;
                                z-index: <?= 10 - $idx ?>;">
                        <div style="position: absolute; width: 100%; height: 100%; background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.25) 100%);"></div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div style="margin-top: 20px;">
                <button class="btn btn-warning" onclick="testSlideHero(-1)">← Prev</button>
                <button class="btn btn-warning" onclick="testSlideHero(1)">Next →</button>
                <span id="status" style="margin-left: 20px; font-weight: bold;"></span>
            </div>
        </div>
        
        <div class="section">
            <h2>Console Debug Output</h2>
            <pre id="debugOutput" style="background: #f0f0f0; padding: 15px; border-radius: 6px; max-height: 400px; overflow-y: auto;"></pre>
        </div>
    </div>

    <script>
        const debugOutput = document.getElementById('debugOutput');
        const statusEl = document.getElementById('status');
        
        // Capture console
        const origLog = console.log;
        console.log = function(...args) {
            const msg = args.map(a => typeof a === 'object' ? JSON.stringify(a) : a).join(' ');
            const div = document.createElement('div');
            div.textContent = '[LOG] ' + msg;
            debugOutput.appendChild(div);
            debugOutput.scrollTop = debugOutput.scrollHeight;
            origLog.apply(console, args);
        };
        
        // HERO SLIDER LOGIC (exact copy from landing_page_story.php)
        console.log('🎬 Hero Slider Script Starting...');
        
        let heroIndex = 0;
        let heroTimeout = null;
        
        const heroSlides = document.querySelectorAll('.hero-slide');
        const heroDots = document.querySelectorAll('.hero-dot');
        
        console.log('📊 Found slides:', heroSlides.length);
        console.log('📊 Found dots:', heroDots.length);
        
        // Generate durations array dari slide element data
        let heroDurations = [];
        heroSlides.forEach((slide, idx) => {
            const duration = parseInt(slide.dataset.duration) || 5000;
            heroDurations.push(duration);
            console.log(`⏱️ Slide ${idx}: ${duration}ms`);
        });
        
        if (heroDurations.length === 0) {
            heroDurations = [5000];
            console.warn('⚠️ No slides data found, using default 5000ms');
        }

        function showHeroSlide(idx) {
            heroSlides.forEach((slide, i) => {
                slide.style.opacity = (i === idx) ? '1' : '0';
                slide.style.zIndex = (i === idx) ? 10 : 5;
            });
            heroDots.forEach((dot, i) => {
                dot.style.opacity = (i === idx) ? '1' : '0.5';
            });
            statusEl.textContent = `Slide ${idx + 1} of ${heroSlides.length}`;
            console.log(`✅ Slide ${idx + 1} of ${heroSlides.length} shown`);
        }

        function testSlideHero(dir = 1) {
            heroIndex = (heroIndex + dir + heroSlides.length) % heroSlides.length;
            showHeroSlide(heroIndex);
            resetHeroTimeout();
            console.log(`➡️ Slide changed to ${heroIndex + 1}`);
        }

        function resetHeroTimeout() {
            if (heroTimeout) clearTimeout(heroTimeout);
            const duration = heroDurations[heroIndex] || 4000;
            heroTimeout = setTimeout(() => {
                testSlideHero(1);
            }, duration);
            console.log(`⏳ Next auto-play in ${duration}ms`);
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🎬 DOMContentLoaded - Initializing hero slideshow');
            console.log(`Slides ready: ${heroSlides.length}`);
            console.log(`Durations: ${JSON.stringify(heroDurations)}`);
            
            if (heroSlides.length > 0) {
                showHeroSlide(heroIndex);
                resetHeroTimeout();
                console.log('✅ Hero slideshow initialized successfully!');
                console.log(`▶️ Auto-play STARTED - First slide duration: ${heroDurations[0]}ms`);
            } else {
                console.error('❌ No hero slides found!');
            }
        });
        
        // Immediate init if ready
        if (document.readyState !== 'loading') {
            console.log('✓ Document already loaded - triggering init immediately');
            if (heroSlides.length > 0) {
                showHeroSlide(heroIndex);
                resetHeroTimeout();
                console.log('✅ Immediate init successful');
            }
        }
    </script>
</body>
</html>