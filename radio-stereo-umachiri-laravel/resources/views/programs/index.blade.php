@extends('layouts.app')

@section('title', 'Programación - Stereo Umachiri')
@section('description', 'Descubre nuestra programación semanal con todos tus programas favoritos y horarios.')

@section('content')
<div class="schedule-container py-5">
    <!-- Hero Section -->
    <section class="schedule-hero mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-4 fw-bold mb-3 text-white">Programación</h1>
                    <p class="lead mb-4 text-white">Conoce todos nuestros programas y horarios semanales</p>
                    
                    <!-- Filtros por día -->
                    <div class="day-filters mb-4">
                        <div class="btn-group" role="group">
                            @foreach($days as $day)
                            <a href="#day-{{ strtolower($day) }}" class="btn btn-outline-light">
                                {{ substr($day, 0, 3) }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programación por días -->
    <section class="weekly-schedule">
        <div class="container">
            @foreach($days as $day)
            <div class="day-schedule mb-5" id="day-{{ strtolower($day) }}">
                <div class="day-header mb-4">
                    <h2 class="day-title">
                        <i class="far fa-calendar-alt me-2"></i> {{ $day }}
                    </h2>
                </div>
                
                @if(isset($programs[$day]) && $programs[$day]->count() > 0)
                <div class="programs-list">
                    @foreach($programs[$day]->sortBy('start_time') as $program)
                    <div class="program-card">
                        <div class="program-image">
                            @if($program->image)
                            <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->title }}" class="img-fluid">
                            @else
                            <div class="image-placeholder">
                                <i class="fas fa-broadcast-tower"></i>
                            </div>
                            @endif
                        </div>
                        <div class="program-details">
                            <div class="program-time">
                                <span class="start-time">{{ \Carbon\Carbon::parse($program->start_time)->format('H:i') }}</span>
                                <span class="time-separator">-</span>
                                <span class="end-time">{{ \Carbon\Carbon::parse($program->end_time)->format('H:i') }}</span>
                            </div>
                            <h3 class="program-title">{{ $program->title }}</h3>
                            <p class="program-host">
                                <i class="fas fa-microphone me-2"></i> {{ $program->host }}
                            </p>
                            <p class="program-description">{{ Str::limit($program->description, 150) }}</p>
                            <div class="program-actions">
                                <a href="{{ route('programs.podcasts', $program) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-headphones me-1"></i> Ver Grabaciones
                                </a>
                                <button class="btn btn-outline-secondary btn-sm program-reminder">
                                    <i class="far fa-bell me-1"></i> Recordar
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-day text-center py-4">
                    <i class="far fa-calendar-times fa-3x text-muted mb-3"></i>
                    <p class="mb-0">No hay programas programados para este día</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </section>

    <!-- Programas destacados -->
    <section class="featured-programs py-5 bg-light">
        <div class="container">
            <div class="section-header mb-4">
                <h2 class="section-title">
                    <i class="fas fa-star me-2"></i> Programas Destacados
                </h2>
            </div>
            
            <div class="row g-4">
                @foreach($featuredPrograms as $program)
                <div class="col-md-6 col-lg-4">
                    <div class="featured-program-card">
                        <div class="featured-program-image">
                            @if($program->image)
                            <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->title }}" class="img-fluid">
                            @else
                            <div class="image-placeholder">
                                <i class="fas fa-broadcast-tower"></i>
                            </div>
                            @endif
                        </div>
                        <div class="featured-program-body">
                            <h3 class="featured-program-title">{{ $program->title }}</h3>
                            <p class="featured-program-schedule">
                                <i class="far fa-clock me-1"></i> 
                                {{ $program->day }} {{ \Carbon\Carbon::parse($program->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($program->end_time)->format('H:i') }}
                            </p>
                            <a href="{{ route('programs.podcasts', $program) }}" class="btn btn-sm btn-outline-primary">
                                Ver contenido <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<link href="{{ asset('css/programs.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script>
    // Efecto de carga suave para los programas
    document.addEventListener('DOMContentLoaded', function() {
        const programCards = document.querySelectorAll('.program-card, .featured-program-card');
        
        programCards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Función para recordatorios
        document.querySelectorAll('.program-reminder').forEach(button => {
            button.addEventListener('click', function() {
                const programTitle = this.closest('.program-card').querySelector('.program-title').textContent;
                const programTime = this.closest('.program-card').querySelector('.program-time').textContent;
                
                if (confirm(`¿Deseas recibir un recordatorio para "${programTitle}" a las ${programTime}?`)) {
                    this.innerHTML = '<i class="fas fa-check me-1"></i> Recordado';
                    this.classList.remove('btn-outline-secondary');
                    this.classList.add('btn-success');
                }
            });
        });
    });
</script>
@endpush
