@extends('layouts.app')

@section('title', $sport->title . ' - Stereo Umachiri')
@section('description', Str::limit(strip_tags($sport->content), 155))
@section('og_image', asset('storage/' . $sport->image))

@section('content')
<div class="container main-content">
    <div class="row">
        <div class="col-lg-8">
            <article>
                <header class="mb-4">
                    <h1 class="fw-bolder mb-1">{{ $sport->title }}</h1>
                    <div class="text-muted fst-italic mb-2">Publicado el {{ $sport->published_at->format('d/m/Y') }} por {{ $sport->author }}</div>
                </header>
                @if($sport->image)
                    <figure class="mb-4">
                        <img class="img-fluid rounded" src="{{ asset('storage/' . $sport->image) }}" alt="{{ $sport->title }}">
                    </figure>
                @endif
                <section class="mb-5">
                    <p class="fs-5 mb-4">{!! nl2br(e($sport->content)) !!}</p>
                </section>
            </article>
        </div>

        <!-- Side widgets -->
        <div class="col-lg-4">
            <!-- Related news widget -->
            <div class="card mb-4">
                <div class="card-header">Más Deportes</div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        @forelse($relatedSports as $related)
                            <li>
                                <a href="{{ route('sports.show', $related->id) }}">{{ $related->title }}</a>
                            </li>
                        @empty
                            <li>No hay noticias de deportes relacionadas.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
