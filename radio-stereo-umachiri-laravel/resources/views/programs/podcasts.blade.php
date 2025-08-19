@extends('layouts.app')

@section('title', 'Podcasts de ' . $program->title)

@section('content')
<div class="container main-content">
    <header class="mb-5 text-center">
        <h1 class="display-4 fw-bold">Podcasts de {{ $program->title }}</h1>
        <p class="lead">{{ $program->description }}</p>
    </header>

    <div class="row">
        <div class="col-md-12">
            @forelse($podcasts as $podcast)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $podcast->title }}</h5>
                        <p class="card-text">{{ $podcast->description }}</p>
                        <audio controls class="w-100">
                            <source src="{{ asset('storage/' . $podcast->audio_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div>
            @empty
                <p>No hay podcasts disponibles para este programa.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
