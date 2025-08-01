// ===== RADIO PLAYER JAVASCRIPT =====

class RadioPlayer {
    constructor() {
        this.audio = document.getElementById('radioStream');
        this.playBtn = document.getElementById('playBtn');
        this.volumeSlider = document.getElementById('volumeSlider');
        this.isPlaying = false;
        this.currentVolume = 0.5;
        
        this.init();
    }
    
    init() {
        // Set initial volume
        this.audio.volume = this.currentVolume;
        this.volumeSlider.value = this.currentVolume * 100;
        
        // Event listeners
        this.playBtn.addEventListener('click', () => this.togglePlay());
        this.volumeSlider.addEventListener('input', (e) => this.setVolume(e.target.value));
        
        // Audio event listeners
        this.audio.addEventListener('play', () => this.onPlay());
        this.audio.addEventListener('pause', () => this.onPause());
        this.audio.addEventListener('error', (e) => this.onError(e));
        this.audio.addEventListener('loadstart', () => this.onLoadStart());
        this.audio.addEventListener('canplay', () => this.onCanPlay());
        
        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => this.handleKeyboard(e));
        
        // Auto-resume on page focus (if was playing)
        document.addEventListener('visibilitychange', () => this.handleVisibilityChange());
        
        // Initialize player state
        this.updatePlayButton();
    }
    
    togglePlay() {
        if (this.isPlaying) {
            this.pause();
        } else {
            this.play();
        }
    }
    
    play() {
        // Set stream URL (replace with actual stream URL)
        if (!this.audio.src || this.audio.src === 'stream-url-here') {
            // Example stream URLs - replace with actual stream
            const streamUrls = [
                'https://stream.example.com/radio.mp3',
                'https://icecast.example.com/radio.ogg',
                'https://streaming.example.com/radio.aac'
            ];
            
            // For demo purposes, we'll use a placeholder
            // In production, use the actual stream URL
            this.audio.src = streamUrls[0] || 'https://stream.example.com/radio.mp3';
        }
        
        this.audio.play().catch(error => {
            console.error('Error playing audio:', error);
            this.showPlayerNotification('Error al reproducir la radio. Intenta de nuevo.', 'error');
        });
    }
    
    pause() {
        this.audio.pause();
    }
    
    setVolume(value) {
        const volume = value / 100;
        this.currentVolume = volume;
        this.audio.volume = volume;
        
        // Update volume icon
        this.updateVolumeIcon(volume);
        
        // Save volume preference
        localStorage.setItem('radioVolume', volume);
    }
    
    updateVolumeIcon(volume) {
        const volumeIcon = document.querySelector('.volume-control i');
        if (volumeIcon) {
            if (volume === 0) {
                volumeIcon.className = 'fas fa-volume-mute';
            } else if (volume < 0.5) {
                volumeIcon.className = 'fas fa-volume-down';
            } else {
                volumeIcon.className = 'fas fa-volume-up';
            }
        }
    }
    
    onPlay() {
        this.isPlaying = true;
        this.updatePlayButton();
        this.showPlayerNotification('Radio Stereo Umachiri - EN VIVO', 'success');
        
        // Add playing animation
        this.playBtn.classList.add('playing');
        
        // Update live indicator
        const liveIndicator = document.querySelector('.live-indicator');
        if (liveIndicator) {
            liveIndicator.style.opacity = '1';
        }
    }
    
    onPause() {
        this.isPlaying = false;
        this.updatePlayButton();
        
        // Remove playing animation
        this.playBtn.classList.remove('playing');
        
        // Update live indicator
        const liveIndicator = document.querySelector('.live-indicator');
        if (liveIndicator) {
            liveIndicator.style.opacity = '0.5';
        }
    }
    
    onError(error) {
        console.error('Audio error:', error);
        this.showPlayerNotification('Error en la transmisión. Verificando conexión...', 'error');
        
        // Try to reconnect after a delay
        setTimeout(() => {
            if (this.isPlaying) {
                this.play();
            }
        }, 5000);
    }
    
    onLoadStart() {
        this.showPlayerNotification('Conectando a Radio Stereo Umachiri...', 'info');
    }
    
    onCanPlay() {
        this.showPlayerNotification('Radio Stereo Umachiri - Conectado', 'success');
    }
    
    updatePlayButton() {
        const icon = this.playBtn.querySelector('i');
        if (this.isPlaying) {
            icon.className = 'fas fa-pause';
            this.playBtn.setAttribute('aria-label', 'Pausar radio');
        } else {
            icon.className = 'fas fa-play';
            this.playBtn.setAttribute('aria-label', 'Reproducir radio');
        }
    }
    
    handleKeyboard(event) {
        // Spacebar to play/pause
        if (event.code === 'Space' && event.target.tagName !== 'INPUT' && event.target.tagName !== 'TEXTAREA') {
            event.preventDefault();
            this.togglePlay();
        }
        
        // Arrow keys for volume
        if (event.code === 'ArrowUp' && event.ctrlKey) {
            event.preventDefault();
            this.adjustVolume(0.1);
        }
        
        if (event.code === 'ArrowDown' && event.ctrlKey) {
            event.preventDefault();
            this.adjustVolume(-0.1);
        }
        
        // M key to mute/unmute
        if (event.code === 'KeyM') {
            event.preventDefault();
            this.toggleMute();
        }
    }
    
    adjustVolume(delta) {
        const newVolume = Math.max(0, Math.min(1, this.currentVolume + delta));
        this.volumeSlider.value = newVolume * 100;
        this.setVolume(newVolume * 100);
    }
    
    toggleMute() {
        if (this.currentVolume > 0) {
            this.lastVolume = this.currentVolume;
            this.setVolume(0);
        } else {
            this.setVolume((this.lastVolume || 0.5) * 100);
        }
    }
    
    handleVisibilityChange() {
        if (document.hidden && this.isPlaying) {
            // Page is hidden, pause audio
            this.audio.pause();
        } else if (!document.hidden && this.isPlaying) {
            // Page is visible again, resume audio
            this.audio.play().catch(error => {
                console.error('Error resuming audio:', error);
            });
        }
    }
    
    showPlayerNotification(message, type = 'info') {
        // Create player notification
        const notification = document.createElement('div');
        notification.className = `player-notification player-notification-${type}`;
        notification.innerHTML = `
            <div class="player-notification-content">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i>
                <span>${message}</span>
            </div>
        `;
        
        // Add styles
        notification.style.cssText = `
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            background: ${type === 'success' ? '#4CAF50' : type === 'error' ? '#f44336' : '#2196F3'};
            color: white;
            padding: 0.8rem 1.2rem;
            border-radius: 8px;
            font-size: 0.9rem;
            white-space: nowrap;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        `;
        
        // Add to player container
        const playerContainer = document.querySelector('.live-player');
        if (playerContainer) {
            playerContainer.style.position = 'relative';
            playerContainer.appendChild(notification);
            
            // Show notification
            setTimeout(() => {
                notification.style.opacity = '1';
            }, 100);
            
            // Hide notification after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 300);
            }, 3000);
        }
    }
    
    // Get player statistics
    getStats() {
        return {
            isPlaying: this.isPlaying,
            volume: this.currentVolume,
            currentTime: this.audio.currentTime,
            duration: this.audio.duration,
            readyState: this.audio.readyState
        };
    }
    
    // Set stream URL
    setStreamUrl(url) {
        this.audio.src = url;
        console.log('Stream URL updated:', url);
    }
    
    // Get current stream info
    getStreamInfo() {
        return {
            station: 'Radio Stereo Umachiri',
            frequency: '98.5 FM',
            location: 'Umachiri, Melgar, Puno',
            slogan: 'Llegando a tu corazón y más allá de tu imaginación'
        };
    }
}

// ===== PLAYER INITIALIZATION =====
document.addEventListener('DOMContentLoaded', function() {
    // Initialize radio player
    const radioPlayer = new RadioPlayer();
    
    // Make player globally accessible
    window.radioPlayer = radioPlayer;
    
    // Add player controls to window for external access
    window.playerControls = {
        play: () => radioPlayer.play(),
        pause: () => radioPlayer.pause(),
        toggle: () => radioPlayer.togglePlay(),
        setVolume: (volume) => radioPlayer.setVolume(volume),
        getStats: () => radioPlayer.getStats(),
        getStreamInfo: () => radioPlayer.getStreamInfo()
    };
    
    // Load saved volume preference
    const savedVolume = localStorage.getItem('radioVolume');
    if (savedVolume !== null) {
        radioPlayer.setVolume(parseFloat(savedVolume) * 100);
    }
    
    // Add player status indicator
    const playerStatus = document.createElement('div');
    playerStatus.className = 'player-status';
    playerStatus.innerHTML = `
        <div class="status-indicator">
            <span class="status-dot"></span>
            <span class="status-text">Listo</span>
        </div>
    `;
    
    // Add styles for status indicator
    playerStatus.style.cssText = `
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.8rem;
        color: rgba(255,255,255,0.8);
    `;
    
    const statusDot = playerStatus.querySelector('.status-dot');
    statusDot.style.cssText = `
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #4CAF50;
        margin-right: 5px;
        animation: pulse 2s infinite;
    `;
    
    // Add to player container
    const playerContainer = document.querySelector('.live-player');
    if (playerContainer) {
        playerContainer.appendChild(playerStatus);
    }
    
    // Update status based on player state
    const updateStatus = () => {
        const statusText = playerStatus.querySelector('.status-text');
        const stats = radioPlayer.getStats();
        
        if (stats.isPlaying) {
            statusText.textContent = 'Reproduciendo';
            statusDot.style.background = '#4CAF50';
        } else if (stats.readyState >= 2) {
            statusText.textContent = 'Listo';
            statusDot.style.background = '#2196F3';
        } else {
            statusText.textContent = 'Conectando...';
            statusDot.style.background = '#FF9800';
        }
    };
    
    // Update status periodically
    setInterval(updateStatus, 1000);
    
    console.log('Radio Player initialized successfully!');
});

// ===== PLAYER UTILITIES =====

// Format time in MM:SS
function formatTime(seconds) {
    if (isNaN(seconds)) return '00:00';
    const mins = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
}

// Format file size
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Check if browser supports audio formats
function checkAudioSupport() {
    const audio = document.createElement('audio');
    const formats = {
        mp3: audio.canPlayType('audio/mpeg'),
        ogg: audio.canPlayType('audio/ogg'),
        aac: audio.canPlayType('audio/aac'),
        wav: audio.canPlayType('audio/wav')
    };
    
    return formats;
}

// Get recommended stream format
function getRecommendedFormat() {
    const support = checkAudioSupport();
    
    if (support.mp3 !== '') return 'mp3';
    if (support.aac !== '') return 'aac';
    if (support.ogg !== '') return 'ogg';
    if (support.wav !== '') return 'wav';
    
    return 'mp3'; // Default fallback
}

// ===== PLAYER ANALYTICS =====
function trackPlayerEvent(action, details = {}) {
    const eventData = {
        action: action,
        timestamp: new Date().toISOString(),
        userAgent: navigator.userAgent,
        ...details
    };
    
    // Send to analytics (if available)
    if (typeof gtag !== 'undefined') {
        gtag('event', 'player_action', {
            'event_category': 'radio_player',
            'event_label': action,
            'custom_parameters': eventData
        });
    }
    
    // Console log for debugging
    console.log('Player Event:', eventData);
}

// Track player interactions
document.addEventListener('DOMContentLoaded', function() {
    const playBtn = document.getElementById('playBtn');
    const volumeSlider = document.getElementById('volumeSlider');
    
    if (playBtn) {
        playBtn.addEventListener('click', () => {
            trackPlayerEvent('play_toggle', {
                isPlaying: window.radioPlayer ? window.radioPlayer.isPlaying : false
            });
        });
    }
    
    if (volumeSlider) {
        volumeSlider.addEventListener('input', (e) => {
            trackPlayerEvent('volume_change', {
                volume: e.target.value / 100
            });
        });
    }
}); 