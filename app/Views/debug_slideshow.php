<!DOCTYPE html>
<html>
<head>
    <title>Slideshow Test</title>
    <style>
        * { margin: 0; padding: 0; }
        body { font-family: Arial; background: #f0f0f0; }
        
        .hero {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
            background: #333;
        }
        
        .slides-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        
        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        
        .slide.active {
            opacity: 1;
        }
        
        .slide-image {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }
        
        .slide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.3) 0%, rgba(0, 100, 255, 0.25) 40%, rgba(0, 31, 63, 0.4) 100%);
        }
        
        .content {
            position: relative;
            z-index: 10;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        h1 { font-size: 2.5rem; margin-bottom: 20px; }
        p { font-size: 1.2rem; }
        
        .info {
            background: white;
            padding: 20px;
            margin: 20px;
            border-radius: 8px;
            border-left: 4px solid #0d6efd;
        }
        
        .info h2 { margin-bottom: 15px; color: #0d6efd; }
        .info ul { margin-left: 20px; line-height: 1.8; }
        
        .status {
            background: #f0f0f0;
            padding: 15px;
            margin: 20px;
            border-radius: 5px;
            font-family: monospace;
        }
        
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1 style="padding: 20px;">🎨 Slideshow Test Page</h1>
    
    <div class="hero">
        <div class="slides-container" id="slides-container"></div>
        <div class="content">
            <div>
                <h1>Slideshow Test</h1>
                <p id="counter">Loading...</p>
            </div>
        </div>
    </div>
    
    <div class="info">
        <h2>ℹ️ Test Information</h2>
        <ul>
            <li>Fetching slides from: <code><?= base_url('debug/slideshow') ?></code></li>
            <li>Slides should rotate every 5 seconds</li>
            <li>Check browser DevTools (F12) for errors</li>
        </ul>
    </div>
    
    <div class="status" id="status">Initializing...</div>
    
    <script>
        async function initSlideshow() {
            const status = document.getElementById('status');
            const counter = document.getElementById('counter');
            
            try {
                // Fetch slides data
                const resp = await fetch('<?= base_url('debug/slideshow') ?>');
                const data = await resp.json();
                
                status.innerHTML = `<span class="success">✓ Loaded ${data.total} slides</span>`;
                
                if (data.total === 0) {
                    status.innerHTML += '<br><span class="error">✗ No slides found in database!</span>';
                    counter.innerText = 'No slides available';
                    return;
                }
                
                // Create slide elements
                const container = document.getElementById('slides-container');
                data.slides.forEach((slide, idx) => {
                    const slideEl = document.createElement('div');
                    slideEl.className = `slide ${idx === 0 ? 'active' : ''}`;
                    slideEl.innerHTML = `
                        <div class="slide-image" style="background-image: url('<?= base_url('') ?>${slide.image_url}')"></div>
                        <div class="slide-overlay"></div>
                    `;
                    container.appendChild(slideEl);
                });
                
                status.innerHTML += '<br>✓ Slides rendered<br>';
                counter.innerText = `Showing ${data.total} slides`;
                
                // Auto-rotate
                let idx = 0;
                const slides = container.querySelectorAll('.slide');
                
                setInterval(() => {
                    slides.forEach(s => s.classList.remove('active'));
                    idx = (idx + 1) % slides.length;
                    slides[idx].classList.add('active');
                    status.innerHTML = `<span class="success">✓ Showing slide ${idx + 1}/${slides.length}</span>`;
                }, 5000);
                
            } catch (err) {
                status.innerHTML = `<span class="error">✗ Error: ${err.message}</span>`;
                counter.innerText = `Error: ${err.message}`;
                console.error(err);
            }
        }
        
        initSlideshow();
    </script>
</body>
</html>
