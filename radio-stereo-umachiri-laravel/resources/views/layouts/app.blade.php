<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radio Stereo Umachiri - 98.5 FM - Melgar, Puno</title>
    <meta name="description" content="Radio Stereo Umachiri en vivo por Internet. Emisora peruana que transmite desde el distrito de Umachiri, provincia Melgar, Puno.">
    <meta name="keywords" content="radio, umachiri, puno, melgar, 98.5 fm, peru, en vivo">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/umachiri.ico') }}">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#1e3a8a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Radio Umachiri">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Radio Stereo Umachiri" class="logo">
                    <div class="logo-text">
                        <h1>Radio Stereo Umachiri</h1>
                        <span>98.5 FM - Melgar, Puno</span>
                    </div>
                </div>
                <div class="nav-menu" id="nav-menu">
                    <ul class="nav-list">
                        <li><a href="#inicio" class="nav-link">Inicio</a></li>
                        <li><a href="#programacion" class="nav-link">Programación</a></li>
                        <li><a href="#nosotros" class="nav-link">Nosotros</a></li>
                        <li><a href="#galeria" class="nav-link">Galería</a></li>
                        <li><a href="#contacto" class="nav-link">Contacto</a></li>
                    </ul>
                </div>
                <div class="nav-toggle" id="nav-toggle">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Radio Stereo Umachiri</h3>
                    <p>98.5 FM - Melgar, Puno</p>
                    <p>Llegando a tu corazón y más allá de tu imaginación</p>
                </div>
                <div class="footer-section">
                    <h4>Enlaces Rápidos</h4>
                    <ul>
                        <li><a href="#inicio">Inicio</a></li>
                        <li><a href="#programacion">Programación</a></li>
                        <li><a href="#nosotros">Nosotros</a></li>
                        <li><a href="#galeria">Galería</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contacto</h4>
                    <p><i class="fas fa-phone"></i> +51 951 391 524</p>
                    <p><i class="fas fa-envelope"></i> radioumachiri@hotmail.com</p>
                    <p><i class="fas fa-map-marker-alt"></i> Umachiri, Melgar, Puno</p>
                </div>
                <div class="footer-section">
                    <h4>Síguenos</h4>
                    <div class="social-links">
                        <a href="https://www.facebook.com/StereoUmachiri/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Radio Stereo Umachiri. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @livewireScripts
    
    <script>
        // PWA Service Worker Registration
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('SW registered: ', registration);
                    })
                    .catch(registrationError => {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }
        
        // Mobile menu toggle
        const navToggle = document.getElementById('nav-toggle');
        const navMenu = document.getElementById('nav-menu');
        
        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            navToggle.classList.toggle('active');
        });
        
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Scroll to top button
        const scrollToTopBtn = document.getElementById('scrollToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.style.display = 'block';
            } else {
                scrollToTopBtn.style.display = 'none';
            }
        });
        
        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Lazy loading for images
        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    </script>
</body>
</html> 