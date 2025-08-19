@extends('layouts.app')

@section('title', 'Próximos Eventos - Stereo Umachiri')
@section('description', 'Descubre los próximos eventos de Stereo Umachiri con todos los detalles y horarios')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <section class="events-hero mb-5">
        <div class="hero-content text-center">
            <h1 class="display-4 fw-bold text-white mb-3">Próximos Eventos</h1>
            <p class="lead text-white mb-4">No te pierdas nuestras próximas actividades y programas especiales</p>
            @auth
            <a href="{{ route('events.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus-circle mr-2"></i> Crear Nuevo Evento
            </a>
            @endauth
        </div>
    </section>

    <!-- Filtros -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" id="eventSearch" placeholder="Buscar eventos...">
            </div>
        </div>
        <div class="col-md-6">
            <select class="form-select" id="eventFilter">
                <option value="all">Todos los eventos</option>
                <option value="today">Hoy</option>
                <option value="week">Esta semana</option>
                <option value="month">Este mes</option>
            </select>
        </div>
    </div>

    @if($events->isEmpty())
    <div class="empty-events text-center py-5">
        <div class="empty-icon mb-4">
            <i class="fas fa-calendar-times fa-4x text-muted"></i>
        </div>
        <h3 class="mb-3">No hay eventos próximos</h3>
        <p class="text-muted mb-4">Actualmente no tenemos eventos programados, pero vuelve pronto</p>
        @auth
        <a href="{{ route('events.create') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-plus-circle mr-2"></i> Crear Primer Evento
        </a>
        @endauth
    </div>
    @else
    <div class="row events-grid">
        @foreach ($events as $event)
        <div class="col-xl-4 col-lg-6 mb-4 event-card" 
             data-title="{{ strtolower($event->title) }}"
             data-date="{{ $event->start_time->format('Y-m-d') }}">
            <div class="card h-100 shadow-sm border-0">
                <div class="event-image-container">
                    @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" 
                         class="card-img-top event-image" 
                         alt="{{ $event->title }}"
                         loading="lazy">
                    @else
                    <div class="image-placeholder">
                        <i class="fas fa-calendar-alt fa-4x"></i>
                    </div>
                    @endif
                    
                    <div class="event-badges">
                        @if($event->start_time->isToday())
                        <span class="badge bg-danger">
                            <i class="fas fa-bolt me-1"></i> HOY
                        </span>
                        @elseif($event->start_time->isFuture() && $event->start_time->diffInDays(now()) <= 7)
                        <span class="badge bg-warning text-dark">
                            <i class="fas fa-exclamation me-1"></i> PRÓXIMO
                        </span>
                        @endif
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h3 class="card-title fw-bold mb-0">{{ $event->title }}</h3>
                        <span class="badge bg-primary">
                            {{ $event->start_time->format('M d') }}
                        </span>
                    </div>
                    
                    <div class="event-meta mb-3">
                        <p class="mb-1 text-muted">
                            <i class="far fa-clock me-2"></i>
                            {{ $event->start_time->format('h:i A') }} - {{ $event->end_time->format('h:i A') }}
                        </p>
                        @if($event->location)
                        <p class="mb-0 text-muted">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            {{ $event->location }}
                        </p>
                        @endif
                    </div>
                    
                    <p class="card-text">{{ Str::limit($event->description, 150) }}</p>
                </div>
                
                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-info-circle me-1"></i> Detalles
                    </a>
                    
                    <div class="event-actions">
                        @auth
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                    type="button" 
                                    id="eventActions{{ $event->id }}" 
                                    data-bs-toggle="dropdown">
                                <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('events.edit', $event->id) }}">
                                    <i class="fas fa-edit me-2"></i> Editar
                                </a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" 
                                            onclick="return confirm('¿Estás seguro de eliminar este evento?')">
                                        <i class="fas fa-trash me-2"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center mt-5">
        {{ $events->links() }}
    </div>
    @endif
</div>
@endsection

@section('styles')
<style>
    /* Hero Section */
    .events-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                    url('https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        padding: 5rem 0;
        border-radius: 10px;
        margin-bottom: 2rem;
    }

    .hero-content {
        max-width: 800px;
        margin: 0 auto;
    }

    /* Event Cards */
    .event-card {
        transition: all 0.3s ease;
    }

    .event-image-container {
        position: relative;
        height: 200px;
        overflow: hidden;
        background-color: var(--bg-light);
    }

    .event-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .event-card:hover .event-image {
        transform: scale(1.05);
    }

    .image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
    }

    .event-badges {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .event-meta {
        background-color: var(--bg-light);
        padding: 0.75rem;
        border-radius: 8px;
    }

    /* Empty State */
    .empty-events {
        background-color: white;
        padding: 3rem;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .empty-icon {
        color: var(--text-light);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .events-hero {
            padding: 3rem 0;
        }
    }

    @media (max-width: 768px) {
        .events-hero {
            padding: 2rem 0;
            border-radius: 0;
            margin-left: -1rem;
            margin-right: -1rem;
        }
        
        .event-image-container {
            height: 160px;
        }
    }

    @media (max-width: 576px) {
        .hero-content h1 {
            font-size: 2.2rem;
        }
        
        .card-footer {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .event-actions {
            width: 100%;
        }
        
        .dropdown-menu {
            position: static !important;
            transform: none !important;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filtrado y búsqueda
        const searchInput = document.getElementById('eventSearch');
        const filterSelect = document.getElementById('eventFilter');
        const eventCards = document.querySelectorAll('.event-card');
        
        function filterEvents() {
            const searchTerm = searchInput.value.toLowerCase();
            const filterValue = filterSelect.value;
            const today = new Date().toISOString().split('T')[0];
            
            eventCards.forEach(card => {
                const title = card.getAttribute('data-title');
                const date = card.getAttribute('data-date');
                let matchesSearch = title.includes(searchTerm);
                let matchesFilter = true;
                
                // Aplicar filtros de fecha
                if (filterValue === 'today') {
                    matchesFilter = date === today;
                } else if (filterValue === 'week') {
                    const eventDate = new Date(date);
                    const todayObj = new Date();
                    const nextWeek = new Date(todayObj);
                    nextWeek.setDate(todayObj.getDate() + 7);
                    matchesFilter = eventDate >= todayObj && eventDate <= nextWeek;
                } else if (filterValue === 'month') {
                    const eventDate = new Date(date);
                    const todayObj = new Date();
                    matchesFilter = eventDate.getMonth() === todayObj.getMonth() && 
                                  eventDate.getFullYear() === todayObj.getFullYear();
                }
                
                if (matchesSearch && matchesFilter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        searchInput.addEventListener('input', filterEvents);
        filterSelect.addEventListener('change', filterEvents);
        
        // Animación de carga
        const eventGrid = document.querySelector('.events-grid');
        if (eventGrid) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.event-card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = `all 0.3s ease ${index * 0.1}s`;
                observer.observe(card);
            });
        }
    });
</script>
@endsection
