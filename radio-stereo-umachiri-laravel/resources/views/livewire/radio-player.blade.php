<div class="live-player">
    <div class="player-container">
        <div class="player-info">
            <div class="live-indicator">
                <span class="live-dot"></span>
                <span>EN VIVO</span>
            </div>
            <h3>Radio Stereo Umachiri</h3>
            <p>98.5 FM - Melgar, Puno</p>
        </div>
        <div class="player-controls">
            <button class="play-btn" wire:click="togglePlay" wire:loading.attr="disabled">
                <i class="fas {{ $isPlaying ? 'fa-pause' : 'fa-play' }}"></i>
                <div wire:loading class="spinner"></div>
            </button>
            <div class="volume-control">
                <i class="fas fa-volume-up"></i>
                <input type="range" wire:model.live="volume" wire:change="setVolume($event.target.value)" min="0" max="100" value="{{ $volume }}">
            </div>
        </div>
    </div>
    <audio id="radioStream" preload="none">
        <source src="{{ $streamUrl }}" type="audio/mpeg">
        Tu navegador no soporta el elemento de audio.
    </audio>
</div> 