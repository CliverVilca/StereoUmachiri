@extends('layouts.app')

@section('title', 'Noticias - Stereo Umachiri')
@section('description', 'Últimas noticias de Melgar, Puno y el mundo. Mantente informado con Stereo Umachiri.')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="mb-4">Últimas Noticias</h1>
            
            @forelse($noticias as $noticia)
            <article class="card mb-4 shadow-sm">
                @if($noticia->image)
                <img src="{{ asset('storage/' . $noticia->image) }}" class="card-img-top" alt="{{ $noticia->title }}" style="height: 300px; object-fit: cover;">
                @endif
                
                <div class="card-body">
                    <span class="badge bg-primary mb-2">{{ $noticia->type }}</span>
                    <h2 class="card-title h4">{{ $noticia->title }}</h2>
                    
                    <div class="d-flex align-items-center text-muted mb-3">
                        <small><i class="fas fa-user me-1"></i> {{ $noticia->author }}</small>
                        <small class="ms-3"><i class="fas fa-calendar me-1"></i> {{ $noticia->published_at->format('d/m/Y H:i') }}</small>
                    </div>
                    
                    <p class="card-text">{{ Str::limit(strip_tags($noticia->content), 200) }}</p>
                    
                    <a href="{{ route('noticias.show', $noticia->id) }}" class="btn btn-primary">
                        Leer más <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </article>
            @empty
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                No hay noticias publicadas en este momento.
            </div>
            @endforelse

            {{ $noticias->links() }}
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Categorías</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-primary">Local</span>
                        <span class="badge bg-success">Internacional</span>
                        <span class="badge bg-warning">Deportes</span>
                        <span class="badge bg-info">Cultura</span>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h5 class="card-title">Noticias Destacadas</h5>
                    @foreach($noticias->take(3) as $destacada)
                    <div class="mb-3">
                        <h6 class="mb-1">{{ $destacada->title }}</h6>
                        <small class="text-muted">{{ $destacada->published_at->format('d/m/Y') }}</small>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection