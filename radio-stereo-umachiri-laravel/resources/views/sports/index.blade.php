@extends('layouts.app')

@section('title', 'Deportes - Stereo Umachiri')
@section('description', 'Toda la actualidad deportiva local, nacional e internacional. Noticias, resultados y análisis.')

@section('content')
<div class="sports-container py-5">
    <!-- Hero Section -->
    <section class="sports-hero mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-4 fw-bold mb-3 text-white">Deportes</h1>
                    <p class="lead mb-4 text-white">Toda la actualidad del mundo deportivo en un solo lugar</p>
                    
                    <!-- Categorías deportivas -->
                    <div class="sports-categories mb-4">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="#" class="sport-category active">Todos</a>
                            <a href="#" class="sport-category">Fútbol</a>
                            <a href="#" class="sport-category">Vóley</a>
                            <a href="#" class="sport-category">Básquet</a>
                            <a href="#" class="sport-category">Atletismo</a>
                            <a href="#" class="sport-category">Natación</a>
                            <a href="#" class="sport-category">Otros</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Resultados destacados -->
    <section class="featured-results mb-5">
        <div class="container">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-trophy me-2"></i> Resultados Destacados
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="result-card text-center p-3 rounded">
                                <div class="teams mb-3">
                                    <div class="team">
                                        <img src="https://via.placeholder.com/50x50.png?text=EQ1" alt="Equipo 1" class="team-logo">
                                        <span class="team-name">Equipo Local</span>
                                    </div>
                                    <div class="score">3 - 2</div>
                                    <div class="team">
                                        <img src="https://via.placeholder.com/50x50.png?text=EQ2" alt="Equipo 2" class="team-logo">
                                        <span class="team-name">Equipo Visitante</span>
                                    </div>
                                </div>
                                <div class="match-info">
                                    <span class="sport-name">Fútbol</span>
                                    <span class="match-date">Ayer, 15:00</span>
                                </div>
                            </div>
                        </div>
                        <!-- Repetir para otros resultados -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Noticias de deportes -->
    <section class="sports-news">
        <div class="container">
            <div class="section-header mb-4">
                <h2 class="section-title">
                    <i class="fas fa-newspaper me-2"></i> Últimas Noticias
                </h2>
                <a href="#" class="view-all">Ver todas <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
            
            <div class="row g-4">
                @forelse($sports as $item)
                <div class="col-md-6 col-lg-4">
                    <article class="sport-card h-100">
                        <a href="{{ route('sports.show', $item->id) }}" class="sport-image-link">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="sport-image" alt="{{ $item->title }}">
                            @else
                                <img src="https://via.placeholder.com/600x400.png?text=Stereo+Umachiri" class="sport-image" alt="Imagen por defecto">
                            @endif
                            <div class="sport-badge">
                                {{ $item->category ?? 'Deportes' }}
                            </div>
                        </a>
                        <div class="sport-body">
                            <div class="sport-meta mb-2">
                                <span class="sport-date">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $item->published_at->format('d/m/Y') }}
                                </span>
                                <span class="sport-author">
                                    <i class="fas fa-user me-1"></i> {{ $item->author }}
                                </span>
                            </div>
                            <h3 class="sport-title">
                                <a href="{{ route('sports.show', $item->id) }}">{{ $item->title }}</a>
                            </h3>
                            <p class="sport-excerpt">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                            <div class="sport-footer">
                                <a href="{{ route('sports.show', $item->id) }}" class="read-more">
                                    Leer más <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                                <div class="sport-actions">
                                    <span class="views">
                                        <i class="far fa-eye me-1"></i> {{ rand(100, 999) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state text-center py-5">
                        <div class="empty-icon mb-4">
                            <i class="fas fa-futbol fa-4x text-muted"></i>
                        </div>
                        <h3 class="empty-title">No hay noticias deportivas disponibles</h3>
                        <p class="empty-text">Actualmente no hay noticias para mostrar. Por favor, vuelve más tarde.</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Paginación -->
            @if($sports->count() > 0)
            <div class="pagination-wrapper mt-5">
                <nav aria-label="Page navigation">
                    {{ $sports->onEachSide(1)->links() }}
                </nav>
            </div>
            @endif
        </div>
    </section>

    <!-- Próximos Eventos -->
    <section class="upcoming-events mt-5">
        <div class="container">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt me-2"></i> Próximos Eventos
                    </h5>
                </div>
                <div class="card-body">
                    <div class="event-list">
                        <div class="event-item">
                            <div class="event-date">
                                <span class="day">15</span>
                                <span class="month">Jun</span>
                            </div>
                            <div class="event-info">
                                <h6 class="event-title">Torneo Local de Fútbol</h6>
                                <div class="event-meta">
                                    <span class="event-time"><i class="far fa-clock me-1"></i> 14:00 - 18:00</span>
                                    <span class="event-location"><i class="fas fa-map-marker-alt me-1"></i> Estadio Municipal</span>
                                </div>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Más info</a>
                        </div>
                        <!-- Repetir para otros eventos -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
    /* Variables globales definidas en global.css */
    /* Variables específicas para deportes */
    :root {
        --sports-color: #2ecc71;
    }

    /* Estructura principal */
    .sports-container {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-color);
    }

    /* Hero Section */
    .sports-hero {
        padding: 4rem 0;
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                    url('https://images.unsplash.com/photo-1543351611-58f69d7c1781?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        border-radius: 0 0 20px 20px;
        margin-bottom: 3rem;
    }

    /* Categorías deportivas */
    .sport-category {
        display: inline-block;
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        margin: 0.2rem;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .sport-category:hover, .sport-category.active {
        background-color: var(--sports-color);
        color: white;
        transform: translateY(-2px);
        border-color: var(--sports-color);
    }

    /* Resultados destacados */
    .result-card {
        background-color: var(--light-gray);
        transition: all 0.3s ease;
    }

    .result-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .team {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0.5rem 0;
    }

    .team-logo {
        width: 50px;
        height: 50px;
        object-fit: contain;
        margin-bottom: 0.5rem;
    }

    .score {
        font-size: 1.5rem;
        font-weight: bold;
        margin: 0.5rem 0;
        color: var(--sports-color);
    }

    .match-info {
        font-size: 0.9rem;
        color: var(--text-light);
    }

    /* Noticias deportivas */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid var(--sports-color);
        padding-bottom: 0.5rem;
    }

    .section-title {
        font-weight: 700;
        color: var(--secondary-color);
    }

    .view-all {
        color: var(--sports-color);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .view-all:hover {
        color: var(--accent-color);
        text-decoration: underline;
    }

    .sport-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        background: white;
    }

    .sport-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .sport-image-link {
        display: block;
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .sport-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .sport-card:hover .sport-image {
        transform: scale(1.05);
    }

    .sport-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.3rem 0.8rem;
        border-radius: 50px;
        color: white;
        background-color: var(--sports-color);
    }

    .sport-body {
        padding: 1.5rem;
    }

    .sport-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.85rem;
        color: var(--text-light);
    }

    .sport-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 1rem 0;
        line-height: 1.4;
    }

    .sport-title a {
        color: var(--secondary-color);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .sport-title a:hover {
        color: var(--sports-color);
    }

    .sport-excerpt {
        color: var(--text-light);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .sport-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .read-more {
        color: var(--sports-color);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .read-more:hover {
        color: var(--accent-color);
        transform: translateX(5px);
    }

    .sport-actions {
        display: flex;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--text-light);
    }

    /* Próximos Eventos */
    .event-item {
        display: flex;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #eee;
    }

    .event-date {
        text-align: center;
        min-width: 60px;
        margin-right: 1rem;
        background-color: var(--light-gray);
        border-radius: 8px;
        padding: 0.5rem;
    }

    .event-date .day {
        display: block;
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--sports-color);
    }

    .event-date .month {
        display: block;
        font-size: 0.8rem;
        text-transform: uppercase;
    }

    .event-info {
        flex-grow: 1;
    }

    .event-title {
        font-weight: 600;
        margin-bottom: 0.3rem;
    }

    .event-meta {
        font-size: 0.85rem;
        color: var(--text-light);
    }

    /* Empty State */
    .empty-state {
        padding: 3rem 0;
    }

    .empty-icon {
        color: #ddd;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-light);
        margin-bottom: 1rem;
    }

    .empty-text {
        color: var(--text-light);
        max-width: 500px;
        margin: 0 auto 1.5rem;
    }

    /* Paginación */
    .pagination-wrapper {
        margin-top: 3rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sports-hero {
            padding: 2rem 0;
        }
        
        .section-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .view-all {
            margin-top: 0.5rem;
        }
        
        .event-item {
            flex-wrap: wrap;
        }
        
        .event-date {
            margin-bottom: 0.5rem;
        }
    }

    @media (max-width: 576px) {
        .sport-meta {
            flex-direction: column;
            gap: 0.3rem;
        }
        
        .sport-footer {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Efecto de carga suave para las tarjetas
    document.addEventListener('DOMContentLoaded', function() {
        const sportCards = document.querySelectorAll('.sport-card');
        
        sportCards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endpush