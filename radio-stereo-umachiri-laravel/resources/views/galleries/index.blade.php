@extends('layouts.app')

@section('title', 'Galería de Fotos - Stereo Umachiri')
@section('description', 'Explora nuestra colección de imágenes y momentos destacados')

@section('content')
<div class="container py-5">
    <!-- Encabezado con efecto parallax -->
    <div class="gallery-header parallax-header mb-5">
        <div class="header-content">
            <h1 class="display-4 text-white fw-bold">Galería de Fotos</h1>
            <p class="lead text-white">Capturamos los mejores momentos para ti</p>
        </div>
    </div>

    <!-- Controles de galería -->
    <div class="d-flex justify-content-between align-items-center mb-5">

        
        @auth
            <a href="{{ route('galleries.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>Subir Foto
            </a>
        @endauth
    </div>

    @if($galleries->isEmpty())
        <div class="empty-gallery text-center py-5">
            <div class="empty-icon mb-4">
                <i class="fas fa-camera-retro fa-4x text-muted"></i>
            </div>
            <h3 class="mb-3">La galería está vacía</h3>
            <p class="text-muted mb-4">No hay fotos para mostrar todavía</p>
            @auth
                <a href="{{ route('galleries.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-cloud-upload-alt mr-2"></i>Subir la primera foto
                </a>
            @endauth
        </div>
    @else
        <!-- Galería con masonry -->
        <div class="row gallery-grid" data-masonry='{"percentPosition": true}'>
            @foreach ($galleries as $gallery)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4 gallery-item" 
                     data-category="category-{{ $gallery->category_id }}">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden">
                        <div class="gallery-image-container">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                                 class="card-img-top gallery-image" 
                                 alt="{{ $gallery->title }}"
                                 loading="lazy">
                            <div class="image-overlay">
                                <button class="btn btn-sm btn-light view-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#galleryModal"
                                        data-title="{{ $gallery->title }}"
                                        data-description="{{ $gallery->description }}"
                                        data-image="{{ asset('storage/' . $gallery->image_path) }}"
                                        data-date="{{ $gallery->created_at->format('d M Y') }}"
                                        data-category="{{ $gallery->category->name }}">
                                    <i class="fas fa-expand"></i>
                                </button>
                                @auth
                                    <div class="action-buttons">
                                        <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-btn" 
                                                    onclick="return confirm('¿Estás seguro de eliminar esta imagen?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endauth
                            </div>
                            
                            @if($gallery->featured)
                            <div class="featured-badge">
                                <i class="fas fa-star"></i> Destacada
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $gallery->title }}</h5>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary">
                                    {{ $gallery->category->name }}
                                </span>
                                <small class="text-muted">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ $gallery->created_at->format('d M Y') }}
                                </small>
                            </div>
                            <p class="card-text text-muted">{{ Str::limit($gallery->description, 100) }}</p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-outline-primary share-btn" 
                                    data-url="{{ route('galleries.show', $gallery->id) }}"
                                    data-title="{{ $gallery->title }}">
                                <i class="fas fa-share-alt mr-1"></i> Compartir
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación con diseño mejorado -->
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="Page navigation">
                {{ $galleries->links('vendor.pagination.custom') }}
            </nav>
        </div>
    @endif
</div>

<!-- Modal para vista ampliada mejorado -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <div class="modal-meta">
                    <span class="badge bg-primary" id="modalCategory"></span>
                    <small class="text-muted ms-2" id="modalDate"></small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <img src="" id="modalImage" class="img-fluid rounded mb-3">
                    </div>
                    <div class="col-md-4">
                        <div class="modal-sidebar">
                            <h6>Descripción</h6>
                            <p class="text-muted" id="modalDescription"></p>
                            <hr>
                            <div class="share-section">
                                <h6>Compartir</h6>
                                <div class="share-buttons">
                                    <a href="#" class="btn btn-sm btn-outline-primary facebook-share">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-info twitter-share">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-danger whatsapp-share">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Cerrar
                </button>
                <div class="download-btn">
                    <a href="#" class="btn btn-primary" id="downloadLink">
                        <i class="fas fa-download mr-1"></i> Descargar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Encabezado con efecto parallax */
    .parallax-header {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                    url('https://images.unsplash.com/photo-1514525253161-7a46d19cd819?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    /* Encabezado con efecto parallax */
    .parallax-header {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                    url('https://images.unsplash.com/photo-1514525253161-7a46d19cd819?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .header-content {
        text-align: center;
        z-index: 2;
        padding: 2rem;
    }

    /* Controles de galería */
    .gallery-controls {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .filter-btn {
        border-radius: 20px;
        transition: all 0.3s ease;
    }

    .filter-btn.active {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    /* Estilos para la galería vacía */
    .empty-gallery {
        background-color: white;
        border-radius: 10px;
        padding: 4rem 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .empty-icon {
        color: var(--text-light);
    }

    /* Items de la galería */
    .gallery-grid {
        transition: all 0.3s ease;
    }

    .gallery-item {
        transition: all 0.3s ease;
        opacity: 1;
        transform: scale(1);
    }

    .gallery-item.hidden {
        display: none;
        opacity: 0;
        transform: scale(0.9);
    }

    /* Contenedor de imagen */
    .gallery-image-container {
        position: relative;
        overflow: hidden;
        height: 250px;
        background-color: var(--bg-light);
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    /* Overlay de imagen */
    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.3s ease;
        padding: 1rem;
    }

    .gallery-item:hover .image-overlay {
        opacity: 1;
    }

    .gallery-item:hover .gallery-image {
        transform: scale(1.1);
    }

    /* Botones de acción */
    .view-btn, .delete-btn, .share-btn {
        transition: all 0.3s ease;
    }

    .view-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .action-buttons {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        display: flex;
        gap: 0.5rem;
    }

    /* Badge destacado */
    .featured-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: var(--accent-color);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: bold;
        z-index: 2;
    }

    /* Modal mejorado */
    .modal-sidebar {
        background-color: var(--bg-light);
        padding: 1.5rem;
        border-radius: 8px;
        height: 100%;
    }

    .share-buttons {
        display: flex;
        gap: 0.5rem;
    }

    /* Efectos de tarjeta */
    .card {
        transition: all 0.3s ease;
        border-radius: 10px;
    }

    .card:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        transform: translateY(-5px);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .parallax-header {
            height: 250px;
        }
        
        .gallery-controls {
            margin-bottom: 1rem;
        }
    }

    @media (max-width: 768px) {
        .parallax-header {
            height: 200px;
            background-attachment: scroll;
        }
        
        .modal-body .row {
            flex-direction: column;
        }
        
        .modal-sidebar {
            margin-top: 1rem;
        }
    }

    @media (max-width: 576px) {
        .gallery-controls {
            flex-direction: column;
            width: 100%;
        }
        
        .filter-btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar masonry
        const grid = document.querySelector('.gallery-grid');
        if (grid) {
            const msnry = new Masonry(grid, {
                itemSelector: '.gallery-item',
                percentPosition: true,
                transitionDuration: '0.3s'
            });
            
            // Rediseñar cuando se cargan las imágenes
            imagesLoaded(grid).on('progress', function() {
                msnry.layout();
            });
        }

        // Filtrado de categorías
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
                // Actualizar botones activos
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Filtrar items
                const items = document.querySelectorAll('.gallery-item');
                items.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });
                
                // Reorganizar masonry después del filtrado
                setTimeout(() => {
                    msnry.layout();
                }, 300);
            });
        });

        // Modal de vista ampliada
        const galleryModal = document.getElementById('galleryModal');
        if (galleryModal) {
            galleryModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const title = button.getAttribute('data-title');
                const description = button.getAttribute('data-description');
                const imageSrc = button.getAttribute('data-image');
                const date = button.getAttribute('data-date');
                const category = button.getAttribute('data-category');
                const shareUrl = button.getAttribute('data-url');
                
                // Actualizar contenido del modal
                document.getElementById('modalTitle').textContent = title;
                document.getElementById('modalDescription').textContent = description;
                document.getElementById('modalImage').setAttribute('src', imageSrc);
                document.getElementById('modalDate').innerHTML = `<i class="far fa-calendar-alt mr-1"></i>${date}`;
                document.getElementById('modalCategory').textContent = category;
                
                // Configurar enlaces de compartir
                const encodedUrl = encodeURIComponent(shareUrl);
                const encodedTitle = encodeURIComponent(title);
                
                document.querySelector('.facebook-share').href = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
                document.querySelector('.twitter-share').href = `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedTitle}`;
                document.querySelector('.whatsapp-share').href = `https://wa.me/?text=${encodedTitle}%20${encodedUrl}`;
                
                // Configurar enlace de descarga
                document.getElementById('downloadLink').href = imageSrc;
                document.getElementById('downloadLink').download = title.toLowerCase().replace(/\s+/g, '-') + '.jpg';
            });
        }

        // Botones de compartir
        document.querySelectorAll('.share-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const url = this.getAttribute('data-url');
                const title = this.getAttribute('data-title');
                
                if (navigator.share) {
                    navigator.share({
                        title: title,
                        url: url
                    }).catch(err => {
                        console.log('Error al compartir:', err);
                    });
                } else {
                    // Fallback para navegadores que no soportan Web Share API
                    const shareWindow = window.open(
                        `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, 
                        'Compartir', 
                        'width=600,height=400'
                    );
                    
                    if (shareWindow) {
                        shareWindow.focus();
                    }
                }
            });
        });
    });
</script>
@endsection
