<?php

namespace App\Livewire;

use Livewire\Component;

class RadioPlayer extends Component
{
    public $isPlaying = false;
    public $volume = 50;
    public $streamUrl = 'https://stream-url-here'; // Cambiar por la URL real del stream
    public $currentSong = '';
    public $currentArtist = '';
    public $currentShow = '';
    public $listenerCount = 0;
    public $isFavorite = false;
    public $showPlaylist = false;

    public function togglePlay()
    {
        $this->isPlaying = !$this->isPlaying;
        
        if ($this->isPlaying) {
            $this->dispatch('radio-play');
            $this->updateListenerCount();
        } else {
            $this->dispatch('radio-pause');
        }
    }

    public function setVolume($value)
    {
        $this->volume = $value;
        $this->dispatch('radio-volume-change', volume: $value);
    }

    public function toggleFavorite()
    {
        $this->isFavorite = !$this->isFavorite;
        // Aquí podrías guardar en base de datos
    }

    public function shareOnSocial()
    {
        // Compartir en redes sociales
        $this->dispatch('share-radio');
    }

    public function updateListenerCount()
    {
        // Simular actualización de oyentes
        $this->listenerCount = rand(50, 200);
    }

    public function togglePlaylist()
    {
        $this->showPlaylist = !$this->showPlaylist;
    }

    public function render()
    {
        return view('livewire.radio-player');
    }
} 