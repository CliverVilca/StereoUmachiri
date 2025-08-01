@extends('layouts.app')
@section('content')
    <!-- Hero Section -->
    <!-- Noticias Section -->
    
    <section id="inicio" class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h2 class="hero-title">Llegando a tu corazón y más allá de tu imaginación</h2>
                <p class="hero-subtitle">Radio Stereo Umachiri - 98.5 FM</p>
                <p class="hero-description">Emisora peruana que transmite desde el distrito de Umachiri, provincia Melgar, Puno</p>
                
                <!-- Live Player -->
                <livewire:radio-player />
            </div>
            <div class="hero-image">
                <img src="{{ asset('assets/images/radio-studio.jpg') }}" alt="Estudio de Radio Stereo Umachiri">
            </div>
        </div>
    </section>
    <section id="noticias" class="news-section py-5" style="background: #f8f9fa;">
        <div class="container">
            <div class="section-header mb-4 text-center">
                <h2 style="color: #667eea;">Últimas Noticias</h2>
                <p style="color: #333;">Actualidad y novedades de la radio</p>
            </div>
            <style>
            .news-img-hover {
                position: relative;
                height: 260px;
            }
            .news-img-hover .card-img-top {
                height: 260px;
                object-fit: cover;
                border-top-left-radius: 18px;
                border-top-right-radius: 18px;
                width: 100%;
                display: block;
                box-shadow: 0 4px 16px rgba(102,126,234,0.10);
            }
            .news-img-hover .news-overlay {
                position: absolute;
                top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(40,40,60,0.45);
                opacity: 0;
                transition: opacity 0.2s;
                border-top-left-radius: 14px;
                border-top-right-radius: 14px;
                z-index: 10;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .news-img-hover:hover .news-overlay {
                opacity: 1;
            }
            .news-overlay .btn {
                min-width: 120px;
                margin-bottom: 6px;
            }
            </style>
            <style>
            @media (min-width: 992px) {
                .news-row-flex {
                    display: flex !important;
                    flex-direction: row;
                    flex-wrap: nowrap;
                    justify-content: center;
                    gap: 32px;
                }
                .news-row-flex > div {
                    flex: 1 1 0;
                    max-width: 370px;
                }
            }
            </style>
            <div class="row g-4 justify-content-center news-row-flex" style="max-width:1200px;margin:auto;">
                @if(isset($localNews) && $localNews->count())
                    @foreach($localNews as $news)
                        <div class="col-12 col-md-4 d-flex" style="min-width:350px;">
                            <div class="card h-100 w-100 shadow-lg border-0" style="border-radius:18px; background:#f8fafc; min-width:280px; max-width:400px; margin:auto;">
                                @if($news->image)
                                    <div class="position-relative news-img-hover" style="height:180px;">
                                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="card-img-top" style="height:180px; object-fit:cover; border-top-left-radius:14px; border-top-right-radius:14px; width:100%;">
                                        <div class="news-overlay d-flex flex-column justify-content-center align-items-center">
                                            <button type="button" class="btn btn-light btn-sm mb-2" id="zoomBtn{{ $news->id }}"><i class="fas fa-search-plus"></i> Ver imagen</button>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#newsModal{{ $news->id }}"><i class="fas fa-file-alt"></i> Ver noticia</button>
                                        </div>
                                    </div>
                                    <div id="fullImgViewer{{ $news->id }}" class="full-img-viewer" style="display:none;">
                                        <button class="full-img-close" id="closeFullImg{{ $news->id }}" title="Cerrar imagen">&times;</button>
                                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
                                    </div>
                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var btn = document.getElementById('zoomBtn{{ $news->id }}');
                                        var viewer = document.getElementById('fullImgViewer{{ $news->id }}');
                                        var closeBtn = document.getElementById('closeFullImg{{ $news->id }}');
                                        if (btn && viewer && closeBtn) {
                                            btn.addEventListener('click', function() {
                                                viewer.style.display = 'flex';
                                                document.body.style.overflow = 'hidden';
                                            });
                                            closeBtn.addEventListener('click', function() {
                                                viewer.style.display = 'none';
                                                document.body.style.overflow = '';
                                            });
                                            viewer.addEventListener('click', function(e) {
                                                if (e.target === viewer) {
                                                    viewer.style.display = 'none';
                                                    document.body.style.overflow = '';
                                                }
                                            });
                                        }
                                    });
                                    </script>
                                @endif
                                <div class="card-body px-4 pt-4 pb-3 d-flex flex-column justify-content-between">
                                    <div style="display:flex; align-items:center; justify-content:space-between;">
                                    <h5 class="card-title mb-2" style="font-weight:700; color:#222; font-size:1.18rem; line-height:1.25; white-space:normal; margin-bottom:0;">{{ $news->title }}</h5>
                                        <span class="badge d-flex align-items-center gap-2"
                                            style="font-size:0.55rem; padding:7px 16px; border-radius:16px; font-weight:600; background:linear-gradient(90deg,#ffb347 0%,#ffcc33 100%); color:#222;">
                                            <i class="fas fa-map-marker-alt"></i>
                                            Local
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2" style="font-size:0.55rem; color:#667eea; gap:7px;">
                                        <span><i class="fas fa-user"></i> {{ $news->author }}</span>
                                        <span>|</span>
                                        <span><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($news->published_at)->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Modales para noticias locales -->
                    @foreach($localNews as $news)
                        <div class="modal fade" id="newsModal{{ $news->id }}" tabindex="-1" aria-labelledby="newsModalLabel{{ $news->id }}" aria-hidden="true">
                          <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="newsModalLabel{{ $news->id }}">{{ $news->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                              </div>
                              <div class="modal-body">
                                @if($news->image)
                                  <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="img-fluid mb-3" style="border-radius:12px;max-height:320px;object-fit:cover;">
                                @endif
                                <div class="mb-2" style="font-size:0.95rem;color:#667eea;">
                                  <span><i class="fas fa-user"></i> {{ $news->author }}</span>
                                  <span class="mx-2">|</span>
                                  <span><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($news->published_at)->format('d/m/Y') }}</span>
                                </div>
                                <div style="font-size:1rem;color:#222;white-space:pre-line;">
                                  {!! nl2br(e($news->body)) !!}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                @else
                    <p>No hay noticias disponibles.</p>
                @endif
            </div>

            <!-- Fila de noticias internacionales -->
            <div class="row g-4 justify-content-center news-row-flex" style="max-width:1200px;margin:auto; margin-top:32px;">
                @if(isset($internationalNews) && $internationalNews->count())
                    @foreach($internationalNews as $news)
                        <div class="col-12 col-md-4 d-flex" style="min-width:350px;">
                            <div class="card h-100 w-100 shadow-lg border-0" style="border-radius:18px; background:#f8fafc; min-width:280px; max-width:400px; margin:auto;">
                                @if($news->image)
                                    <div class="position-relative news-img-hover" style="height:180px;">
                                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="card-img-top" style="height:180px; object-fit:cover; border-top-left-radius:14px; border-top-right-radius:14px; width:100%;">
                                        <div class="news-overlay d-flex flex-column justify-content-center align-items-center">
                                            <button type="button" class="btn btn-light btn-sm mb-2" id="zoomBtn{{ $news->id }}"><i class="fas fa-search-plus"></i> Ver imagen</button>
                                            <a href="{{ route('noticias.detalle', $news->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-file-alt"></i> Ver noticia</a>
                                        </div>
                                    </div>
                                    <div id="fullImgViewer{{ $news->id }}" class="full-img-viewer" style="display:none;">
                                        <button class="full-img-close" id="closeFullImg{{ $news->id }}" title="Cerrar imagen">&times;</button>
                                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
                                    </div>
                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var btn = document.getElementById('zoomBtn{{ $news->id }}');
                                        var viewer = document.getElementById('fullImgViewer{{ $news->id }}');
                                        var closeBtn = document.getElementById('closeFullImg{{ $news->id }}');
                                        if (btn && viewer && closeBtn) {
                                            btn.addEventListener('click', function() {
                                                viewer.style.display = 'flex';
                                                document.body.style.overflow = 'hidden';
                                            });
                                            closeBtn.addEventListener('click', function() {
                                                viewer.style.display = 'none';
                                                document.body.style.overflow = '';
                                            });
                                            viewer.addEventListener('click', function(e) {
                                                if (e.target === viewer) {
                                                    viewer.style.display = 'none';
                                                    document.body.style.overflow = '';
                                                }
                                            });
                                        }
                                    });
                                    </script>
                                @endif
                                <div class="card-body px-4 pt-4 pb-3 d-flex flex-column justify-content-between">
                                    <div style="display:flex; align-items:center; justify-content:space-between;">
                                    <h5 class="card-title mb-2" style="font-weight:700; color:#222; font-size:1.18rem; line-height:1.25; white-space:normal; margin-bottom:0;">{{ $news->title }}</h5>
                                        <span class="badge d-flex align-items-center gap-2"
                                            style="font-size:0.55rem; padding:7px 16px; border-radius:16px; font-weight:600; background:linear-gradient(90deg,#00c6ff 0%,#0072ff 100%); color:#fff;">
                                            <i class="fas fa-globe"></i>
                                            Internacional
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2" style="font-size:0.55rem; color:#667eea; gap:7px;">
                                        <span><i class="fas fa-user"></i> {{ $news->author }}</span>
                                        <span>|</span>
                                        <span><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($news->published_at)->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Modales para noticias internacionales -->
                    @foreach($internationalNews as $news)
                        <div class="modal fade" id="newsModal{{ $news->id }}" tabindex="-1" aria-labelledby="newsModalLabel{{ $news->id }}" aria-hidden="true">
                          <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="newsModalLabel{{ $news->id }}">{{ $news->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                              </div>
                              <div class="modal-body">
                                @if($news->image)
                                  <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="img-fluid mb-3" style="border-radius:12px;max-height:320px;object-fit:cover;">
                                @endif
                                <div class="mb-2" style="font-size:0.95rem;color:#667eea;">
                                  <span><i class="fas fa-user"></i> {{ $news->author }}</span>
                                  <span class="mx-2">|</span>
                                  <span><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($news->published_at)->format('d/m/Y') }}</span>
                                </div>
                                <div style="font-size:1rem;color:#222;white-space:pre-line;">
                                  {!! nl2br(e($news->body)) !!}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                @else
                    <p>No hay noticias internacionales disponibles.</p>
                @endif
            </div>
            <!-- Modal de noticia: ahora cada tarjeta tiene su propio modal generado dinámicamente -->
            </div>
        </div>
    </section>
    <!-- About Section -->
    <section id="nosotros" class="about">
        <div class="container">
            <div class="section-header">
                <h2>Nosotros</h2>
                <p>Conoce más sobre Radio Stereo Umachiri</p>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <h3>Nuestra Historia</h3>
                    <p>Radio Stereo Umachiri nació con la misión de llevar entretenimiento, información y cultura a la comunidad de Umachiri y sus alrededores. Desde nuestros inicios, hemos estado comprometidos con la excelencia en la transmisión y la calidad de nuestro contenido.</p>
                    
                    <h3>Nuestra Misión</h3>
                    <p>Proporcionar un servicio de radio de alta calidad que conecte, informe y entretenga a nuestra audiencia, promoviendo los valores culturales de nuestra región y manteniendo un vínculo cercano con nuestra comunidad.</p>
                    
                    <div class="about-stats">
                        <div class="stat">
                            <h4>98.5</h4>
                            <p>FM</p>
                        </div>
                        <div class="stat">
                            <h4>24/7</h4>
                            <p>Transmisión</p>
                        </div>
                        <div class="stat">
                            <h4>100%</h4>
                            <p>Comunidad</p>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <img src="{{ asset('assets/images/about-radio.jpg') }}" alt="Equipo de Radio Stereo Umachiri">
                </div>
            </div>
        </div>
    </section>

    <!-- Programming Section -->
    <section id="programacion" class="programming">
        <div class="container">
            <div class="section-header">
                <h2>Programación</h2>
                <p>Nuestros programas destacados</p>
            </div>
            <div class="programming-grid">
                <div class="program-card">
                    <div class="program-time">06:00 - 09:00</div>
                    <h3>Despertar Umachiri</h3>
                    <p>Comienza tu día con las mejores noticias, música y el clima local.</p>
                    <div class="program-host">
                        <i class="fas fa-user"></i>
                        <span>Conductor: Juan Pérez</span>
                    </div>
                </div>
                
                <div class="program-card">
                    <div class="program-time">09:00 - 12:00</div>
                    <h3>Música del Recuerdo</h3>
                    <p>Los mejores éxitos de todos los tiempos para acompañar tu mañana.</p>
                    <div class="program-host">
                        <i class="fas fa-user"></i>
                        <span>Conductor: María López</span>
                    </div>
                </div>
                
                <div class="program-card">
                    <div class="program-time">12:00 - 15:00</div>
                    <h3>Noticias al Mediodía</h3>
                    <p>Información actualizada de Umachiri, Melgar y el mundo.</p>
                    <div class="program-host">
                        <i class="fas fa-user"></i>
                        <span>Conductor: Carlos Ruiz</span>
                    </div>
                </div>
                
                <div class="program-card">
                    <div class="program-time">15:00 - 18:00</div>
                    <h3>Ritmos Modernos</h3>
                    <p>La música más actual y los éxitos del momento.</p>
                    <div class="program-host">
                        <i class="fas fa-user"></i>
                        <span>Conductor: Ana García</span>
                    </div>
                </div>
                
                <div class="program-card">
                    <div class="program-time">18:00 - 21:00</div>
                    <h3>Noche de Estrellas</h3>
                    <p>Música romántica y baladas para acompañar tu noche.</p>
                    <div class="program-host">
                        <i class="fas fa-user"></i>
                        <span>Conductor: Roberto Silva</span>
                    </div>
                </div>
                
                <div class="program-card">
                    <div class="program-time">21:00 - 00:00</div>
                    <h3>Radio Nocturna</h3>
                    <p>Conversaciones, música suave y compañía para la noche.</p>
                    <div class="program-host">
                        <i class="fas fa-user"></i>
                        <span>Conductor: Laura Torres</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="galeria" class="gallery">
        <div class="container">
            <div class="section-header">
                <h2>Galería</h2>
                <p>Momentos especiales de Radio Stereo Umachiri</p>
            </div>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="{{ asset('assets/images/gallery/studio-1.jpg') }}" alt="Estudio de Radio" loading="lazy">
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/images/gallery/event-1.jpg') }}" alt="Evento Comunitario" loading="lazy">
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/images/gallery/team-1.jpg') }}" alt="Equipo de Radio" loading="lazy">
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/images/gallery/equipment-1.jpg') }}" alt="Equipos de Transmisión" loading="lazy">
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/images/gallery/community-1.jpg') }}" alt="Comunidad" loading="lazy">
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/images/gallery/antenna-1.jpg') }}" alt="Antena de Transmisión" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contacto" class="contact">
        <div class="container">
            <div class="section-header">
                <h2>Contacto</h2>
                <p>Ponte en contacto con nosotros</p>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>Dirección</h4>
                            <p>Umachiri, Distrito de Umachiri<br>Provincia de Melgar, Puno, Perú</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h4>Teléfono</h4>
                            <p>+51 951 391 524</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email</h4>
                            <p>radioumachiri@hotmail.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h4>Horario</h4>
                            <p>Transmisión 24/7<br>Oficina: Lunes a Viernes 8:00 - 18:00</p>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form-container">
                    <livewire:contact-form />
                </div>
            </div>
        </div>
    </section>
@endsection