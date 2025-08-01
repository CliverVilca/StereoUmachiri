<x-app-layout>
    <!-- Hero Section -->
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
</x-app-layout> 