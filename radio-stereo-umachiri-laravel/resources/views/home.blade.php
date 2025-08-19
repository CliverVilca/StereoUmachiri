@extends('layouts.app')

@section('title', 'Inicio - Radio Stereo Umachiri')
@section('description', 'Bienvenidos a Radio Stereo Umachiri, la voz de la comunidad. Noticias, deportes, música y programas en vivo.')

@section('content')
<!-- Modern Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6">
                <div class="hero-content fade-in">
                    <h1 class="hero-title">
                        Bienvenidos a <span class="text-danger">Stereo Umachiri</span>
                    </h1>
                    <p class="hero-subtitle">
                        La voz de la comunidad, transmitiendo las mejores noticias, música y programas en vivo las 24 horas del día.
                    </p>
                    <div class="hero-buttons">
                        <a href="#news-section" class="btn btn-primary btn-lg me-3">
                            <i class="fas fa-newspaper me-2"></i> Ver Noticias
                        </a>
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-envelope me-2"></i> Contactar
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="{{ asset('assets/images/radio-studio.jpg') }}" alt="Estudio de Radio" class="img-fluid rounded-3 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern News Section -->
<section id="news-section" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center mb-5">
                    <h2 class="section-title">Últimas Noticias</h2>
                    <p class="section-subtitle">Mantente informado con las noticias más importantes de nuestra comunidad</p>
                </div>
            </div>
        </div>

        @if(isset($latestNews) && $latestNews->count() > 0)
            @php
                $mainNews = $latestNews->shift();
            @endphp
            
            <!-- Featured News -->
            <div class="row mb-5">
                <div class="col-lg-8">
                    <article class="featured-news card border-0 shadow-lg">
<a href="{{ route('noticias.show', $mainNews->id) }}" class="text-decoration-none">
                            @if($mainNews->image)
                                <div class="news-image-container">
                                    <img src="{{ asset('storage/' . $mainNews->image) }}" 
                                         alt="{{ $mainNews->title }}" 
                                         class="card-img-top rounded-top">
                                    <div class="news-badge">
                                        <span class="badge bg-danger">DESTACADO</span>
                                    </div>
                                </div>
                            @endif
                            <div class="card-body p-4">
                                <div class="news-meta mb-3">
                                    <span class="badge bg-primary me-2">{{ ucfirst($mainNews->type) }}</span>
                                    <small class="text-muted">
                                        <i class="far fa-clock me-1"></i> 
                                        {{ $mainNews->published_at->diffForHumans() }}
                                    </small>
                                </div>
                                <h3 class="card-title h4 mb-3">{{ $mainNews->title }}</h3>
                                <p class="card-text text-muted mb-3">
                                    {{ Str::limit(strip_tags($mainNews->content), 200) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-primary fw-bold">Leer más <i class="fas fa-arrow-right ms-1"></i></span>
                                </div>
                            </div>
                        </a>
                    </article>
                </div>
                
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="recent-news card border-0 shadow">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-newspaper me-2"></i> Noticias Recientes
                                </h5>
                            </div>
                            <div class="card-body">
                                @foreach($latestNews->take(4) as $news)
                                    <article class="news-item mb-3">
                                        <a href="{{ route('noticias.show', $news->id) }}" class="text-decoration-none">
                                            <div class="d-flex">
                                                @if($news->image)
                                                    <div class="news-thumb me-3">
                                                        <img src="{{ asset('storage/' . $news->image) }}" 
                                                             alt="{{ $news->title }}" 
                                                             class="rounded" width="80" height="60">
                                                    </div>
                                                @endif
                                                <div class="news-content">
                                                    <h6 class="mb-1">{{ $news->title }}</h6>
                                                    <small class="text-muted">
                                                        <i class="far fa-clock me-1"></i> 
                                                        {{ $news->published_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Newsletter -->
                        <div class="newsletter card border-0 shadow mt-4">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                                <h5 class="card-title">Boletín Informativo</h5>
                                <p class="card-text">Suscríbete para recibir las últimas noticias</p>
                                <form class="newsletter-form">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Tu email" required>
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- More News Grid -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="section-header text-center mb-4">
                        <h3 class="section-title">Más Noticias</h3>
                    </div>
                </div>
                
                @foreach($latestNews->slice(4) as $news)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <article class="news-card card border-0 shadow">
                            <a href="{{ route('noticias.show', $news->id) }}" class="text-decoration-none">
                                @if($news->image)
                                    <img src="{{ asset('storage/' . $news->image) }}" 
                                         alt="{{ $news->title }}" 
                                         class="card-img-top rounded-top">
                                @endif
                                <div class="card-body">
                                    <div class="news-meta mb-2">
                                        <span class="badge bg-secondary">{{ ucfirst($news->type) }}</span>
                                    </div>
                                    <h5 class="card-title">{{ $news->title }}</h5>
                                    <p class="card-text text-muted">
                                        {{ Str::limit(strip_tags($news->content), 100) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="far fa-clock me-1"></i> 
                                            {{ $news->published_at->diffForHumans() }}
                                        </small>
                                        <span class="text-primary fw-bold">Leer más</span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('noticias.index') }}" class="btn btn-outline-primary btn-lg">
                    Ver todas las noticias <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-5x text-muted mb-4"></i>
                <h3>No hay noticias disponibles</h3>
                <p class="text-muted">Vuelve pronto para ver las últimas noticias</p>
            </div>
        @endif
    </div>
</section>

<!-- Modern Features Section -->
<section class="features-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Nuestros Servicios</h2>
                <p class="section-subtitle">Todo lo que ofrecemos a nuestra comunidad</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="feature-card card border-0 shadow text-center">
                    <div class="card-body">
                        <i class="fas fa-radio fa-3x text-danger mb-3"></i>
                        <h5 class="card-title">Transmisión en Vivo</h5>
                        <p class="card-text">Escúchanos las 24 horas del día con la mejor música y programación</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="feature-card card border-0 shadow text-center">
                    <div class="card-body">
                        <i class="fas fa-newspaper fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Noticias Actualizadas</h5>
                        <p class="card-text">Mantente informado con las noticias más importantes de nuestra región</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="feature-card card border-0 shadow text-center">
                    <div class="card-body">
                        <i class="fas fa-microphone fa-3x text-success mb-3"></i>
                        <h5 class="card-title">Programas Diversos</h5>
                        <p class="card-text">Contenido variado para todos los gustos y edades</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern Contact CTA -->
<section class="cta-section py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">¿Tienes alguna consulta?</h3>
                <p class="mb-0">Estamos aquí para ayudarte. Contáctanos y te responderemos lo antes posible.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact.index') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-envelope me-2"></i> Contactar
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    /* Modern Styles for Home Page */
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        min-height: 70vh;
        display: flex;
        align-items: center;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1rem;
    }

    .section-subtitle {
        font-size: 1.125rem;
        color: #718096;
        margin-bottom: 3rem;
    }

    .featured-news {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .featured-news:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
    }

    .news-image-container {
        position: relative;
        overflow: hidden;
    }

    .news-image-container img {
        transition: transform 0.3s ease;
    }

    .featured-news:hover .news-image-container img {
        transform: scale(1.05);
    }

    .news-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
    }

    .news-item {
        transition: background-color 0.3s ease;
    }

    .news-item:hover {
        background-color: #f7fafc;
    }

    .feature-card {
        transition: transform 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
    }

    .cta-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.125rem;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 2rem;
        }
    }

    /* Animation Classes */
    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
