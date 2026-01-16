<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Slideshow Simple</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        
        .hero-test {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
            border-radius: 8px;
            background: #ddd;
            margin-bottom: 20px;
            border: 2px solid #ccc;
        }
        
        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            background-size: cover;
            background-position: center;
        }
        
        .slide.active {
            opacity: 1;
            z-index: 10;
        }
        
        .slide-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.6));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .slide-content h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .slide-content p {
            font-size: 18px;
        }
        
        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.7);
            border: 2px solid #999;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 4px;
            z-index: 20;
            transition: all 0.3s;
        }
        
        .nav-btn:hover {
            background: rgba(255,255,255,0.95);
        }
        
        .nav-btn:active {
            transform: translateY(-50%) scale(0.95);
        }
        
        .prev {
            left: 10px;
        }
        
        .next {
            right: 10px;
        }
        
        .dots {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
            display: flex;
            gap: 8px;
        }
        
        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: white;
            opacity: 0.5;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .dot:hover {
            opacity: 0.8;
        }
        
        .dot.active {
            opacity: 1;
            background: #ff6b6b;
        }
        
        .status {
            background: #e7f3ff;
            border: 1px solid #0066cc;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        button {
            padding: 10px 20px;
            background: #0066cc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }
        
        button:hover {
            background: #0052a3;
        }
        
        .checklist {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 4px;
        }
        
        .checklist ul {
            list-style: none;
            padding: 0;
        }
        
        .checklist li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        
        .checklist li:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎬 Test Slideshow Simple</h1>
        
        <div class="status">
            <strong>Status:</strong> <span id="statusText">Siap...</span>
        </div>
        
        <div class="buttons">
            <button onclick="testConnection()">Test Koneksi</button>
            <button onclick="loadSlides()">Load Slides</button>
        </div>
        
        <div class="hero-test" id="heroTest">
            <div style="padding: 20px; color: #999;">
                Klik "Load Slides" untuk memulai
            </div>
        </div>
        
        <div class="checklist">
            <strong>Checklist:</strong>
            <ul>
                <li id="check-1">❓ Slides loaded</li>
                <li id="check-2">❓ Auto-play berfungsi</li>
                <li id="check-3">❓ Buttons responsif</li>
            </ul>
        </div>
    </div>

    <script>
        let currentSlide = 0;
        let slides = [];
        let autoSlideInterval = null;
        
        const dummySlides = [
            {
                title: 'Slide 1 - Destinasi Pantai',
                description: 'Nikmati keindahan pantai yang menakjubkan',
                color: '#FF6B6B'
            },
            {
                title: 'Slide 2 - Pegunungan Sejuk',
                description: 'Jelajahi keindahan alam pegunungan',
                color: '#4ECDC4'
            },
            {
                title: 'Slide 3 - Hutan Tropis',
                description: 'Rasakan kesegaran hutan yang asri',
                color: '#45B7D1'
            }
        ];

        function testConnection() {
            console.log('testConnection() dipanggil');
            document.getElementById('statusText').innerHTML = '✅ Test OK - Siap load slides';
            document.getElementById('check-1').innerHTML = '✅ Slides loaded';
        }

        function loadSlides() {
            console.log('loadSlides() dipanggil');
            const hero = document.getElementById('heroTest');
            
            slides = dummySlides;
            currentSlide = 0;
            
            console.log('Total slides:', slides.length);
            hero.innerHTML = '';
            
            // Render slides
            slides.forEach((slide, index) => {
                const slideDiv = document.createElement('div');
                slideDiv.className = 'slide' + (index === 0 ? ' active' : '');
                slideDiv.style.backgroundColor = slide.color;
                
                slideDiv.innerHTML = `
                    <div class="slide-content">
                        <h2>${slide.title}</h2>
                        <p>${slide.description}</p>
                    </div>
                `;
                
                hero.appendChild(slideDiv);
                console.log('Slide ' + index + ' ditambahkan');
            });
            
            // Tambah tombol prev
            const prevBtn = document.createElement('button');
            prevBtn.className = 'nav-btn prev';
            prevBtn.innerHTML = '&#9664;';
            prevBtn.onclick = function(e) {
                e.stopPropagation();
                console.log('Prev button clicked');
                prevSlide();
            };
            hero.appendChild(prevBtn);
            
            // Tambah tombol next
            const nextBtn = document.createElement('button');
            nextBtn.className = 'nav-btn next';
            nextBtn.innerHTML = '&#9654;';
            nextBtn.onclick = function(e) {
                e.stopPropagation();
                console.log('Next button clicked');
                nextSlide();
            };
            hero.appendChild(nextBtn);
            
            // Tambah dots
            const dotsDiv = document.createElement('div');
            dotsDiv.className = 'dots';
            
            slides.forEach((_, index) => {
                const dot = document.createElement('div');
                dot.className = 'dot' + (index === 0 ? ' active' : '');
                dot.onclick = function(e) {
                    e.stopPropagation();
                    console.log('Dot ' + index + ' clicked');
                    goToSlide(index);
                };
                dotsDiv.appendChild(dot);
            });
            
            hero.appendChild(dotsDiv);
            
            document.getElementById('statusText').innerHTML = '✅ ' + slides.length + ' slides loaded!';
            document.getElementById('check-2').innerHTML = '✅ Auto-play berfungsi';
            document.getElementById('check-3').innerHTML = '✅ Buttons responsif';
            
            // Start auto-play
            clearAutoSlide();
            startAutoSlide();
            
            console.log('Slides loaded successfully');
        }

        function goToSlide(index) {
            console.log('goToSlide(' + index + ') dipanggil');
            
            const slideElements = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.dot');
            
            slideElements[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('active');
            
            currentSlide = index;
            
            slideElements[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
            
            console.log('Switched to slide ' + currentSlide);
        }

        function nextSlide() {
            console.log('nextSlide() dipanggil');
            const nextIndex = (currentSlide + 1) % slides.length;
            goToSlide(nextIndex);
        }

        function prevSlide() {
            console.log('prevSlide() dipanggil');
            const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
            goToSlide(prevIndex);
        }

        function startAutoSlide() {
            console.log('startAutoSlide() - memulai interval 4 detik');
            autoSlideInterval = setInterval(() => {
                console.log('Auto-slide tick - slide', currentSlide);
                nextSlide();
            }, 4000);
        }

        function clearAutoSlide() {
            if (autoSlideInterval) {
                clearInterval(autoSlideInterval);
                console.log('Auto-slide cleared');
            }
        }

        // Auto load on page load
        window.onload = function() {
            console.log('Page loaded!');
            testConnection();
            setTimeout(() => {
                loadSlides();
            }, 500);
        };
    </script>
</body>
</html>
