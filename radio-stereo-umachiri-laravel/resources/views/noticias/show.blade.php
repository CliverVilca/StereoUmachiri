@extends('layouts.app')

@section('content')
<section class="news-detail-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Tarjeta principal de la noticia -->
                <article class="card news-article shadow-lg mb-5 border-0">
                    @if($news->image)
                    <div class="news-image-container">
                        <img src="{{ asset('storage/' . $news->image) }}" class="card-img-top" alt="{{ $news->title }}">
                    </div>
                    @endif
                    
                    <div class="card-body px-4 py-4">
                        <!-- Encabezado con título y metadatos -->
                        <div class="article-header mb-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h1 class="article-title">{{ $news->title }}</h1>
                                <span class="badge article-type-badge {{ $news->type == 'local' ? 'local' : 'international' }}">
                                    {{ ucfirst($news->type) }}
                                </span>
                            </div>
                            
                            <div class="article-meta d-flex align-items-center gap-4">
                                <span class="author">
                                    <i class="fas fa-user me-2"></i>{{ $news->author }}
                                </span>
                                <span class="date">
                                    <i class="fas fa-calendar-alt me-2"></i>{{ \Carbon\Carbon::parse($news->published_at)->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Contenido de la noticia -->
                        <div class="article-content mb-5">
                            {!! nl2br(e($news->content)) !!}
                        </div>
                        
                        <!-- Botones para compartir -->
                        <div class="share-buttons mb-4">
                            <h6 class="share-title mb-3">Compartir esta noticia:</h6>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-facebook">
                                    <i class="fab fa-facebook-f me-2"></i>Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($news->title) }}&url={{ urlencode(request()->fullUrl()) }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-twitter">
                                    <i class="fab fa-twitter me-2"></i>Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->fullUrl()) }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-whatsapp">
                                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                                </a>
                            </div>
                        </div>
                        
                        <!-- Botón para volver -->
                        <div class="text-center">
                            <a href="{{ url('/') }}#noticias" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Volver a noticias
                            </a>
                        </div>
                    </div>
                </article>
                
                <!-- Noticias relacionadas -->
                @if($relatedNews->count())
                <div class="related-news card shadow-sm border-0 mb-5">
                    <div class="card-body px-4 py-4">
                        <h4 class="section-title mb-4">Noticias relacionadas</h4>
                        <div class="row g-4">
                            @foreach($relatedNews as $related)
                            <div class="col-md-6">
                                <a href="{{ route('news.show', $related->id) }}" class="related-news-item text-decoration-none">
                                    <div class="card h-100 border-0 shadow-sm">
                                        @if($related->image)
                                        <div class="related-news-image">
                                            <img src="{{ asset('storage/' . $related->image) }}" class="card-img-top" alt="{{ $related->title }}">
                                        </div>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="related-news-title">{{ $related->title }}</h5>
                                            <div class="related-news-meta">
                                                <span class="date">
                                                    <i class="fas fa-calendar-alt me-2"></i>{{ \Carbon\Carbon::parse($related->published_at)->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Sección de comentarios -->
                <div class="comments-section card shadow-sm border-0">
                    <div class="card-body px-4 py-4">
                        <h4 class="section-title mb-4">Deja tu comentario</h4>
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="news_id" value="{{ $news->id }}">
                            <div class="mb-3">
                                <textarea name="content" id="content" class="form-control" rows="4" 
                                          placeholder="Escribe tu comentario aquí..." required maxlength="500">{{ old('content') }}</textarea>
                                @error('content') 
                                <div class="text-danger mt-2">{{ $message }}</div> 
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Enviar comentario
                            </button>
                            <small class="text-muted d-block mt-2">
                                Tu comentario será visible tras aprobación del administrador.
                            </small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Estilos generales */
    .news-detail-section {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* Estilos para la tarjeta de noticia principal */
    .news-article {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .news-image-container {
        height: 400px;
        overflow: hidden;
    }
    
    .news-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .news-image-container:hover img {
        transform: scale(1.03);
    }
    
    .article-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        line-height: 1.3;
    }
    
    .article-type-badge {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
    }
    
    .article-type-badge.local {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    
    .article-type-badge.international {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    
    .article-meta {
        color: #7f8c8d;
        font-size: 0.95rem;
    }
    
    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #34495e;
    }
    
    .article-content p {
        margin-bottom: 1.5rem;
    }
    
    /* Estilos para botones de compartir */
    .share-title {
        color: #7f8c8d;
        font-weight: 600;
    }
    
    .btn-facebook {
        background-color: #3b5998;
        color: white;
    }
    
    .btn-twitter {
        background-color: #1da1f2;
        color: white;
    }
    
    .btn-whatsapp {
        background-color: #25d366;
        color: white;
    }
    
    /* Estilos para noticias relacionadas */
    .section-title {
        color: #2c3e50;
        font-weight: 700;
        position: relative;
        padding-bottom: 0.5rem;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #3498db, #9b59b6);
        border-radius: 3px;
    }
    
    .related-news-item {
        transition: all 0.3s ease;
    }
    
    .related-news-item:hover {
        transform: translateY(-5px);
    }
    
    .related-news-image {
        height: 180px;
        overflow: hidden;
    }
    
    .related-news-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .related-news-item:hover .related-news-image img {
        transform: scale(1.05);
    }
    
    .related-news-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    
    .related-news-meta {
        font-size: 0.85rem;
        color: #7f8c8d;
    }
    
    /* Estilos para la sección de comentarios */
    .comments-section {
        border-radius: 12px;
    }
    
    .comments-section textarea {
        resize: none;
        border-radius: 8px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }
    
    .comments-section textarea:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .article-title {
            font-size: 1.6rem;
        }
        
        .news-image-container {
            height: 250px;
        }
        
        .related-news-image {
            height: 150px;
        }
    }
</style>
@endsection