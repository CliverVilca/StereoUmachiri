<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'Radio Stereo Umachiri, la voz de la comunidad. Noticias, música y cultura desde Melgar, Puno.')">
    <meta name="keywords" content="radio, stereo, umachiri, puno, melgar, noticias, musica, en vivo">
    <meta name="author" content="Stereo Umachiri">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Stereo Umachiri - La Voz de la Comunidad')</title>

    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modern-styles.css') }}" rel="stylesheet">
    @stack('styles')
    @livewireStyles

    <!-- PWA Manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    
    <!-- Meta tags for PWA -->
    <meta name="theme-color" content="#dc2626">
<meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Stereo Umachiri">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Stereo Umachiri')">
    <meta property="og:description" content="@yield('description', 'Radio Stereo Umachiri, la voz de la comunidad.')">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/logo.png'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Stereo Umachiri')">
    <meta property="twitter:description" content="@yield('description', 'Radio Stereo Umachiri, la voz de la comunidad.')">
    <meta property="twitter:image" content="@yield('og_image', asset('assets/images/logo.png'))">
</head>
<body>
    <!-- Modern Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-lg">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Stereo Umachiri" height="40" class="me-2 rounded-circle">
                <span class="d-none d-sm-inline">Stereo Umachiri</span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }} d-flex align-items-center" href="{{ url('/') }}">
                            <i class="fas fa-home me-1"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('noticias*') ? 'active' : '' }} d-flex align-items-center" href="{{ route('noticias.index') }}">
                            <i class="fas fa-newspaper me-1"></i> Noticias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('deportes*') ? 'active' : '' }} d-flex align-items-center" href="{{ route('sports.index') }}">
                            <i class="fas fa-running me-1"></i> Deportes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('programacion*') ? 'active' : '' }} d-flex align-items-center" href="{{ route('programs.index') }}">
                            <i class="fas fa-microphone me-1"></i> Programación
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('eventos*') ? 'active' : '' }} d-flex align-items-center" href="{{ route('events.index') }}">
                            <i class="fas fa-calendar me-1"></i> Eventos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('galeria*') ? 'active' : '' }} d-flex align-items-center" href="{{ route('galleries.index') }}">
                            <i class="fas fa-images me-1"></i> Galería
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }} d-flex align-items-center" href="{{ route('contact.index') }}">
                            <i class="fas fa-envelope me-1"></i> Contacto
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(Auth::user()->is_admin)
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-cog me-2"></i> Administrar
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modern Radio Player -->
    <div class="radio-player-container">
        @livewire('radio-player')
    </div>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Modern Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-brand">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-radio me-2"></i> Stereo Umachiri
                        </h5>
                        <p class="mb-4">La voz de la comunidad, transmitiendo las mejores noticias, música y programas en vivo las 24 horas del día.</p>
                        <div class="social-links">
                            <a href="https://web.facebook.com/StereoUmachiri/?_rdc=1&_rdr#" class="btn btn-outline-light btn-sm me-2">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-outline-light btn-sm me-2">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-outline-light btn-sm me-2">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="btn btn-outline-light btn-sm">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2">
                    <h6 class="fw-bold mb-3">Enlaces</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ url('/') }}" class="footer-link">Inicio</a></li>
                        <li class="mb-2"><a href="{{ route('noticias.index') }}" class="footer-link">Noticias</a></li>
                        <li class="mb-2"><a href="{{ route('sports.index') }}" class="footer-link">Deportes</a></li>
                        <li class="mb-2"><a href="{{ route('programs.index') }}" class="footer-link">Programas</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2">
                    <h6 class="fw-bold mb-3">Servicios</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('events.index') }}" class="footer-link">Eventos</a></li>
                        <li class="mb-2"><a href="{{ route('galleries.index') }}" class="footer-link">Galería</a></li>
                        <li class="mb-2"><a href="{{ route('contact.index') }}" class="footer-link">Contacto</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Podcasts</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4">
                    <h6 class="fw-bold mb-3">Contacto</h6>
                    <div class="contact-info">
                        <p class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Av. Principal #123, Melgar - Puno
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            +51 (01) 234-5678
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            info@stereoumachiri.com
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-clock me-2"></i>
                            24/7 en vivo
                        </p>
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; {{ date('Y') }} Stereo Umachiri. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Diseñado con <i class="fas fa-heart text-danger"></i> para la comunidad</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Modern JavaScript -->
    <script>
        // Service Worker Registration
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js').then(function(registration) {
                    console.log('ServiceWorker registration successful');
                }).catch(function(err) {
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }

        // Smooth scroll for anchor links
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

        // Add loading states
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });

        // Add modern interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add fade-in animation to elements
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                    }
                });
            }, observerOptions);

            // Observe all cards and sections
            document.querySelectorAll('.card, section').forEach(el => {
                observer.observe(el);
            });
        });
    </script>

    @livewireScripts
    @stack('scripts')
</body>
</html>
