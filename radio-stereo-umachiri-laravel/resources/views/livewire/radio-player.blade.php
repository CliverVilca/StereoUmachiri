<div class="live-player" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white;">
    <div class="player-container">
        <div class="player-info">
            <div class="live-indicator" @class(['local-mode' => $isLocalAudio])>
                <span class="live-dot"></span>
                <span class="mode-text">{{ $isLocalAudio ? 'ARCHIVO LOCAL' : 'EN VIVO' }}</span>
            </div>
            <h3>{{ $isLocalAudio ? 'Reproductor de Audio' : 'Radio Stereo Umachiri' }}</h3>
            <p>{{ $isLocalAudio ? $localAudioName : '98.5 FM - Melgar, Puno' }}</p>
        </div>
        <div class="now-playing">
            <div class="song-info">
                <span class="song-title">{{ $currentSong }}</span>
                <span class="song-artist">{{ $currentArtist }}</span>
                <span class="current-show">{{ $currentShow }}</span>
            </div>
        </div>
        <div class="player-controls">
            <button class="play-btn" wire:click="{{ $isLocalAudio ? 'playLocalAudio' : 'togglePlay' }}" wire:loading.attr="disabled">
                <i class="fas {{ $isPlaying ? 'fa-pause' : 'fa-play' }}"></i>
                <div wire:loading class="spinner"></div>
            </button>
            <div class="volume-control">
                <i class="fas {{ $volume > 0 ? 'fa-volume-up' : 'fa-volume-mute' }}"></i>
                <input type="range" wire:model.live="volume" wire:change="setVolume($event.target.value)" min="0" max="100" value="{{ $volume }}">
            </div>
            <div class="listeners" @class(['hidden' => $isLocalAudio])>
                <i class="fas fa-headphones"></i>
                <span>{{ $listenerCount }} oyentes</span>
            </div>
            <button class="retry-btn player-control-btn" wire:click="retryPlay" title="Reintentar reproducción" @class(['hidden' => $isLocalAudio])>
                <i class="fas fa-sync-alt"></i>
            </button>
            <button class="source-btn player-control-btn" id="changeSourceBtn" title="Cambiar fuente" @class(['hidden' => $isLocalAudio])>
                <i class="fas fa-exchange-alt"></i>
            </button>
            <label class="upload-btn player-control-btn" title="Cargar audio local">
                <i class="fas fa-upload"></i>
                <input type="file" wire:model.live="localAudio" accept="audio/*" class="hidden" />
            </label>
            <button class="switch-btn player-control-btn" wire:click="switchToStream" title="Volver a radio en vivo" @class(['hidden' => !$isLocalAudio])>
                <i class="fas fa-broadcast-tower"></i>
            </button>
        </div>
    </div>
    <audio id="radioStream" preload="auto" crossorigin="anonymous" @class(['hidden' => $isLocalAudio])>
        <source src="{{ $streamUrl }}" type="audio/mpeg">
        <source src="{{ $streamUrl }}.mp3" type="audio/mpeg">
        <source src="{{ $backupStreamUrl }}" type="audio/mpeg">
        <source src="{{ $fallbackStreamUrl }}" type="audio/mpeg">
        Tu navegador no soporta el elemento de audio.
    </audio>
    <audio id="localAudioPlayer" preload="auto" @class(['hidden' => !$isLocalAudio])>
        Tu navegador no soporta el elemento de audio.
    </audio>
    <div id="streamStatus" class="stream-status"></div>
</div>

@push('styles')
<style>
    /* Estilos para el indicador de modo */
    .live-player .live-indicator {
        display: flex;
        align-items: center;
        background-color: var(--primary-color);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
        margin-right: 15px;
    }
    
    /* Estilos para la información del reproductor */
    .live-player .player-info {
        display: flex;
        flex-direction: column;
    }
    
    .live-player .player-info h3 {
        font-size: 1.2rem;
        font-weight: bold;
        color: white;
        margin: 0;
    }
    
    .live-player .player-info p {
        font-size: 0.9rem;
        margin: 0;
        color: rgba(255, 255, 255, 0.8);
    }
    
    .live-player .local-mode {
        background-color: var(--accent-color);
    }
    
    .live-player .live-dot {
        width: 10px;
        height: 10px;
        background-color: white;
        border-radius: 50%;
        margin-right: 8px;
        animation: pulse 1.5s infinite;
    }
    
    .live-player .mode-text {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(255,255,255, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(255,255,255, 0); }
        100% { box-shadow: 0 0 0 0 rgba(255,255,255, 0); }
    }
    
    /* Estilo común para todos los botones de control */
    .live-player .player-control-btn {
        background-color: var(--secondary-color);
        color: white;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-left: 5px;
        transition: background-color 0.3s, transform 0.3s;
    }
    
    .live-player .player-control-btn:hover {
        background-color: var(--primary-color);
        transform: scale(1.05);
    }
    
    /* Estilos específicos para botones individuales */
    .live-player .play-btn {
        background: var(--secondary-color);
        color: white;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s, transform 0.3s;
    }
    
    .live-player .play-btn:hover {
        background: var(--primary-color);
        transform: scale(1.05);
    }
    
    .live-player .retry-btn {
        background-color: var(--secondary-color);
        font-size: 0.8rem;
    }
    
    .live-player .source-btn {
        background-color: var(--accent-color);
        font-size: 0.8rem;
    }
    
    .live-player .hidden {
        display: none;
    }
    
    .live-player input[type="file"].hidden {
        position: absolute;
        width: 0;
        height: 0;
        opacity: 0;
    }
    
    /* Animaciones para los botones */
    .live-player .retry-btn i, .live-player .source-btn i {
        transition: transform 0.3s ease;
    }
    
    .live-player .retry-btn:hover i {
        transform: rotate(180deg);
    }
    
    .live-player .source-btn:hover i {
        transform: scale(1.2);
    }
    
    /* Estilos para la información de la canción */
    .live-player .now-playing {
        flex: 1;
        margin: 0 20px;
    }
    
    .live-player .song-info {
        display: flex;
        flex-direction: column;
    }
    
    .live-player .song-title {
        font-weight: bold;
        font-size: 1rem;
        color: white;
    }
    
    .live-player .song-artist {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
    }
    
    .live-player .current-show {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.7);
        font-style: italic;
    }
    
    /* Estilos para el control de volumen */
    .live-player .volume-control {
        display: flex;
        align-items: center;
        margin-left: 20px;
    }
    
    .live-player .volume-control i {
        font-size: 1.2rem;
        margin-right: 10px;
        color: white;
    }
    
    .live-player .volume-control input[type="range"] {
        -webkit-appearance: none;
        width: 120px;
        height: 5px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 5px;
        outline: none;
        opacity: 0.7;
        transition: opacity .2s;
    }
    
    .live-player .volume-control input[type="range"]:hover {
        opacity: 1;
    }
    
    .live-player .volume-control input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 15px;
        height: 15px;
        background: white;
        cursor: pointer;
        border-radius: 50%;
    }
    
    .live-player .volume-control input[type="range"]::-moz-range-thumb {
        width: 15px;
        height: 15px;
        background: white;
        cursor: pointer;
        border-radius: 50%;
    }
    
    /* Estilos para el contador de oyentes */
    .live-player .listeners {
        display: flex;
        align-items: center;
        margin-left: 15px;
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.9);
    }
    
    .live-player .listeners i {
        margin-right: 5px;
        color: var(--accent-color);
    }
    
    /* Estilos para el estado del stream */
    .live-player .stream-status {
        text-align: center;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 10px;
        min-height: 20px;
        transition: all 0.3s ease;
    }
    
    .live-player .stream-status.error {
        color: #ff6b6b;
        font-weight: bold;
        background-color: rgba(255, 0, 0, 0.2);
        padding: 5px;
        border-radius: 4px;
    }
    
    /* Estilos para el spinner de carga */
    .live-player .spinner {
        border: 3px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: #fff;
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        const radioStream = document.getElementById('radioStream');
        const localAudioPlayer = document.getElementById('localAudioPlayer');
        const streamStatus = document.getElementById('streamStatus');
        let updateInterval;
        let currentSourceIndex = 0;
        const sources = radioStream.querySelectorAll('source');
        let retryCount = 0;
        const MAX_RETRIES = 3;
        let localAudioUrl = null;

        // Función para actualizar el estado visible para el usuario
        function updateStatus(message, isError = false) {
            if (streamStatus) {
                streamStatus.textContent = message;
                streamStatus.className = 'stream-status' + (isError ? ' error' : '');
                
                // Ocultar el mensaje después de 5 segundos si no es un error
                if (!isError) {
                    setTimeout(() => {
                        streamStatus.textContent = '';
                        streamStatus.className = 'stream-status';
                    }, 5000);
                }
            }
        }

        // Cargar el stream al inicio
        radioStream.load();
        
        // Configurar el volumen inicial
        radioStream.volume = @this.volume / 100;
        localAudioPlayer.volume = @this.volume / 100;
        
        // Manejar eventos del reproductor local
        localAudioPlayer.addEventListener('ended', function() {
            console.log('Audio local finalizado');
            updateStatus('Audio local finalizado');
            @this.$set('isPlaying', false);
        });
        
        localAudioPlayer.addEventListener('error', function(e) {
            console.error('Error en el reproductor local:', e);
            updateStatus('Error al reproducir el archivo local', true);
            @this.$set('isPlaying', false);
        });
        
        localAudioPlayer.addEventListener('playing', function() {
            console.log('Audio local reproduciendo');
            updateStatus('Reproduciendo audio local');
        });
        
        localAudioPlayer.addEventListener('waiting', function() {
            console.log('Audio local cargando...');
            updateStatus('Cargando audio local...');
        });

        // Función para intentar reproducir con la siguiente fuente
        function tryNextSource() {
            if (currentSourceIndex < sources.length - 1) {
                currentSourceIndex++;
                console.log('Intentando con fuente alternativa:', sources[currentSourceIndex].src);
                updateStatus('Cambiando a fuente alternativa: ' + (currentSourceIndex + 1) + '/' + sources.length);
                
                // Pausar cualquier reproducción actual
                try {
                    radioStream.pause();
                } catch (e) {
                    console.warn('Error al pausar el stream:', e);
                }
                
                // Limpiar cualquier error previo
                radioStream.error = null;
                
                // Cargar y reproducir después de un breve retraso
                setTimeout(() => {
                    radioStream.load();
                    playStream();
                }, 1000);
            } else if (retryCount < MAX_RETRIES) {
                // Reintentar desde la primera fuente después de un breve retraso
                retryCount++;
                currentSourceIndex = 0;
                updateStatus(`Reintentando reproducción (intento ${retryCount} de ${MAX_RETRIES})...`);
                
                // Pausar cualquier reproducción actual
                try {
                    radioStream.pause();
                } catch (e) {
                    console.warn('Error al pausar el stream:', e);
                }
                
                // Limpiar cualquier error previo
                radioStream.error = null;
                
                setTimeout(() => {
                    console.log(`Reintentando reproducción (intento ${retryCount} de ${MAX_RETRIES})`);
                    radioStream.load();
                    playStream();
                }, 3000);
            } else {
                console.error('Se agotaron todos los intentos de reproducción');
                updateStatus('No se pudo reproducir la radio. Verifique su conexión a internet o intente más tarde.', true);
                @this.$set('isPlaying', false);
            }
        }

        // Función para reproducir el stream
        function playStream() {
            updateStatus('Conectando con la radio...');
            
            // Forzar la carga del audio antes de intentar reproducir
            try {
                radioStream.load();
                
                // Pequeña pausa para asegurar que el navegador tenga tiempo de cargar el audio
                setTimeout(() => {
                    const playPromise = radioStream.play();
                    
                    if (playPromise !== undefined) {
                        playPromise.then(() => {
                            console.log('Reproducción iniciada correctamente');
                            updateStatus('¡Radio en vivo!');
                        }).catch(e => {
                            console.error('Error playing audio:', e);
                            updateStatus('Error al reproducir. Intentando otra fuente...', true);
                            tryNextSource();
                        });
                    }
                }, 500);
            } catch (error) {
                console.error('Error al cargar el audio:', error);
                updateStatus('Error al cargar el audio. Intentando otra fuente...', true);
                tryNextSource();
            }
        }

        Livewire.on('radio-play', () => {
            console.log('Intentando reproducir desde URL:', sources[currentSourceIndex].src);
            updateStatus('Iniciando reproducción...');
            
            // Resetear contadores
            currentSourceIndex = 0;
            retryCount = 0;
            
            // Recargar el stream antes de reproducir
            radioStream.load();
            
            // Intentar reproducir
            playStream();
            
            // Actualizar información cada 30 segundos cuando está reproduciendo
            clearInterval(updateInterval);
            updateInterval = setInterval(() => {
                @this.updateListenerCount();
            }, 30000);
            
            // Actualización inicial
            @this.updateListenerCount();
        });
        
        Livewire.on('radio-retry', () => {
            console.log('Reintentando reproducción manualmente');
            updateStatus('Reintentando reproducción...');
            
            // Detener cualquier reproducción actual
            radioStream.pause();
            
            // Resetear contadores
            currentSourceIndex = 0;
            retryCount = 0;
            
            // Probar con URLs alternativas
            const alternativeUrls = [
                'https://stream.zenolive.com/f3wvbbqszwzuv',
                'http://ec1.yesstreaming.net:3770/stream',
                'https://stream.radiojar.com/exrd1tp5mceuv',
                'https://stream.zeno.fm/f3wvbbqszwzuv',
                'https://stream.zeno.fm/f3wvbbqszwzuv.mp3',
                'https://stream.zeno.fm/f3wvbbqszwzuv.aac',
                'http://stream.zeno.fm/f3wvbbqszwzuv'
            ];
            
            // Reemplazar las fuentes actuales con las alternativas
            sources.forEach((source, index) => {
                if (index < alternativeUrls.length) {
                    source.src = alternativeUrls[index];
                }
            });
            
            // Recargar y reproducir
            radioStream.load();
            playStream();
            
            // Actualizar información
            @this.updateListenerCount();
        });

        Livewire.on('radio-pause', () => {
            radioStream.pause();
            clearInterval(updateInterval);
            updateStatus('Reproducción pausada');
        });

        Livewire.on('radio-volume-change', (event) => {
            radioStream.volume = event.volume / 100;
            localAudioPlayer.volume = event.volume / 100;
        });
        
        // Manejar errores de reproducción
        radioStream.addEventListener('error', (e) => {
            console.error('Error en la reproducción:', e);
            
            // Obtener información detallada del error
            let errorMessage = 'Error desconocido';
            if (radioStream.error) {
                const errorCodes = {
                    1: 'MEDIA_ERR_ABORTED - La reproducción fue abortada por el usuario',
                    2: 'MEDIA_ERR_NETWORK - Error de red al cargar el medio',
                    3: 'MEDIA_ERR_DECODE - Error al decodificar el medio',
                    4: 'MEDIA_ERR_SRC_NOT_SUPPORTED - El formato de audio no es soportado'
                };
                errorMessage = errorCodes[radioStream.error.code] || `Error código ${radioStream.error.code}`;
                console.error('Código de error:', errorMessage);
            }
            
            // Solo intentar la siguiente fuente si estamos reproduciendo
            if (@this.isPlaying) {
                updateStatus(`Error: ${errorMessage}. Intentando otra fuente...`, true);
                tryNextSource();
            }
        }, true); // Usar captura para asegurarse de que se detecten todos los errores
        
        // Detectar cuando el audio está listo para reproducir
        radioStream.addEventListener('canplay', () => {
            console.log('Stream listo para reproducir');
            updateStatus('Stream listo para reproducir');
        });
        
        // Detectar cuando el audio está cargando
        radioStream.addEventListener('waiting', () => {
            console.log('Cargando stream...');
            updateStatus('Cargando stream...');
        });
        
        // Detectar cuando el audio comienza a reproducirse
        radioStream.addEventListener('playing', () => {
            console.log('Stream reproduciendo correctamente');
            updateStatus('¡Radio en vivo!');
            // Resetear contadores cuando la reproducción es exitosa
            retryCount = 0;
        });
        
        // Detectar cuando el audio se detiene por un error
        radioStream.addEventListener('stalled', () => {
            console.log('La reproducción se ha detenido inesperadamente');
            updateStatus('La reproducción se ha detenido. Reconectando...', true);
            if (@this.isPlaying) {
                // Esperar un momento antes de reintentar
                setTimeout(() => {
                    radioStream.load();
                    playStream();
                }, 2000);
            }
        });
        
        // Detectar cuando hay problemas de buffering
        radioStream.addEventListener('suspend', () => {
            console.log('La descarga del audio se ha suspendido');
            // No mostrar mensaje al usuario para evitar confusión
        });
        
        // Detectar cuando se vacía el buffer
        radioStream.addEventListener('emptied', () => {
            console.log('El buffer de audio se ha vaciado');
            if (@this.isPlaying) {
                updateStatus('Reconectando con la radio...', true);
            }
        });
        
        // Detectar cuando no hay datos disponibles
        radioStream.addEventListener('abort', () => {
            console.log('La carga del audio ha sido abortada');
            if (@this.isPlaying) {
                updateStatus('La carga del audio ha sido interrumpida. Reintentando...', true);
                setTimeout(() => {
                    radioStream.load();
                    playStream();
                }, 2000);
            }
        });
        
        // Detectar cuando hay problemas de red
        window.addEventListener('offline', () => {
            updateStatus('Sin conexión a internet. La radio no puede reproducirse.', true);
            if (@this.isPlaying) {
                radioStream.pause();
                @this.$set('isPlaying', false);
            }
        });
        
        // Detectar cuando se recupera la conexión
        window.addEventListener('online', () => {
            updateStatus('Conexión a internet restaurada. Puede reproducir la radio nuevamente.');
        });
        
        // Manejar el botón de cambio de fuente
        document.getElementById('changeSourceBtn').addEventListener('click', function() {
            if (!@this.isPlaying) {
                updateStatus('Inicie la reproducción primero');
                return;
            }
            
            // Avanzar a la siguiente fuente
            if (currentSourceIndex < sources.length - 1) {
                currentSourceIndex++;
            } else {
                currentSourceIndex = 0;
            }
            
            updateStatus(`Cambiando a fuente ${currentSourceIndex + 1}/${sources.length}...`);
            console.log('Cambiando manualmente a fuente:', sources[currentSourceIndex].src);
            
            // Pausar, cargar y reproducir
            radioStream.pause();
            radioStream.load();
            setTimeout(() => playStream(), 500);
        });
        
        // Manejar la carga de archivos de audio locales
        Livewire.on('local-audio-uploaded', function() {
            console.log('Archivo de audio local cargado');
            updateStatus('Archivo de audio local cargado');
            
            // Pausar la transmisión en vivo si está activa
            radioStream.pause();
            
            // Limpiar cualquier URL de objeto anterior
            if (localAudioUrl) {
                URL.revokeObjectURL(localAudioUrl);
                localAudioUrl = null;
            }
            
            // Solicitar el archivo temporal al servidor
            @this.$wire.localAudio.getUploadedFileUrl().then(url => {
                localAudioUrl = url;
                localAudioPlayer.src = url;
                localAudioPlayer.load();
                console.log('Archivo local cargado:', url);
                updateStatus('Archivo local listo para reproducir');
            }).catch(error => {
                console.error('Error al cargar el archivo local:', error);
                updateStatus('Error al cargar el archivo local', true);
            });
        });
        
        // Reproducir audio local
        Livewire.on('play-local-audio', function() {
            if (localAudioUrl) {
                console.log('Reproduciendo audio local');
                updateStatus('Reproduciendo audio local');
                
                // Asegurarse de que el stream de radio esté pausado
                radioStream.pause();
                
                // Configurar el volumen
                localAudioPlayer.volume = @this.volume / 100;
                
                // Reproducir el audio local
                const playPromise = localAudioPlayer.play();
                
                if (playPromise !== undefined) {
                    playPromise.then(() => {
                        console.log('Reproducción de audio local iniciada correctamente');
                    }).catch(e => {
                        console.error('Error al reproducir audio local:', e);
                        updateStatus('Error al reproducir audio local', true);
                        @this.$set('isPlaying', false);
                    });
                }
            } else {
                console.error('No hay archivo de audio local cargado');
                updateStatus('No hay archivo de audio local cargado', true);
                @this.$set('isPlaying', false);
            }
        });
        
        // Volver a la transmisión en vivo
        Livewire.on('switch-to-stream', function() {
            console.log('Volviendo a la transmisión en vivo');
            updateStatus('Volviendo a la transmisión en vivo');
            
            // Pausar el audio local
            localAudioPlayer.pause();
            
            // Limpiar cualquier URL de objeto
            if (localAudioUrl) {
                URL.revokeObjectURL(localAudioUrl);
                localAudioUrl = null;
            }
            
            // Resetear el reproductor local
            localAudioPlayer.src = '';
            localAudioPlayer.load();
            
            // Resetear contadores para el stream
            currentSourceIndex = 0;
            retryCount = 0;
        });
        
        // Pausar audio local
        Livewire.on('pause-local-audio', function() {
            if (localAudioPlayer) {
                console.log('Pausando audio local');
                localAudioPlayer.pause();
                updateStatus('Audio local pausado');
            }
        });
    });
</script>
@endpush
