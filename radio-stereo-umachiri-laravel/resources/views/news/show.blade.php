@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                @if($news->image)
                    <img src="{{ asset('storage/' . $news->image) }}" class="card-img-top" alt="{{ $news->title }}" style="height: 350px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <h2 class="card-title" style="color: #764ba2; margin-bottom:0;">{{ $news->title }}</h2>
                        <span class="badge {{ $news->type == 'local' ? 'bg-success' : 'bg-info' }}" style="font-size:1rem; padding:7px 16px; border-radius:16px;">{{ ucfirst($news->type) }}</span>
                    </div>
                    <p class="card-meta mb-2">
                        <small class="text-muted">Por {{ $news->author }} | {{ \Carbon\Carbon::parse($news->published_at)->format('d/m/Y') }}</small>
                    </p>
                    <div class="card-text" style="font-size: 1.1rem; color: #333;">
                        {!! nl2br(e($news->content)) !!}
                    </div>
                    <div class="mt-4 mb-3">
                        <span>Compartir en:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-primary mx-1"><i class="fab fa-facebook-f"></i> Facebook</a>
                        <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-success mx-1"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($news->title) }}&url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-info mx-1"><i class="fab fa-twitter"></i> X</a>
                    </div>
                    <a href="{{ url('/') }}#noticias" class="btn btn-outline-secondary">Volver a noticias</a>
                </div>
            </div>

            <!-- Noticias relacionadas -->
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h4 class="mb-3" style="color:#764ba2;">Noticias relacionadas</h4>

@extends('layouts.app')
@section('content')
<section class="news-detail-section" style="background:#f8f9fa; min-height:100vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-11">
                <article class="news-detail-card shadow-sm border-0" style="border-radius:18px; background:#fff;">
                    @if($news->image)
                        <div class="news-detail-img" style="width:100%; height:340px; overflow:hidden; border-top-left-radius:18px; border-top-right-radius:18px;">
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" style="width:100%; height:100%; object-fit:cover;">
                        </div>
                    @endif
                    <div class="p-4">
                        <h1 class="mb-3" style="color:#764ba2; font-weight:800; font-size:2.1rem; line-height:1.2;">{{ $news->title }}</h1>
                        <div class="mb-3 d-flex align-items-center gap-3" style="font-size:1.08rem; color:#667eea;">
                            <span><i class="fas fa-user"></i> {{ $news->author }}</span>
                            <span><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($news->published_at)->format('d/m/Y') }}</span>
                            <span class="badge d-flex align-items-center gap-2"
                                style="font-size:1rem; padding:7px 18px; border-radius:16px; font-weight:600; {{ $news->type == 'local' ? 'background:linear-gradient(90deg,#ffb347 0%,#ffcc33 100%); color:#222;' : 'background:linear-gradient(90deg,#00c6ff 0%,#0072ff 100%); color:#fff;' }}">
                                @if($news->type == 'local')
                                    <i class="fas fa-map-marker-alt"></i>
                                @else
                                    <i class="fas fa-globe"></i>
                                @endif
                                {{ $news->type == 'local' ? 'Local' : 'Internacional' }}
                            </span>
                        </div>
                        <div style="font-size:1.18rem; color:#222; line-height:1.7; text-align:justify; margin-bottom:28px;">
                            {{ $news->content }}
                        </div>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-outline-primary btn-sm"><i class="fab fa-facebook"></i> Compartir</a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-outline-info btn-sm"><i class="fab fa-twitter"></i> Tweet</a>
                        </div>
                    </div>
                </article>
                <!-- Noticias relacionadas -->
                @if($relatedNews->count())
                    <div class="mt-5">
                        <h4 style="color:#667eea; font-weight:700;">Noticias relacionadas</h4>
                        <div class="row g-3 mt-2">
                            @foreach($relatedNews as $related)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <a href="{{ route('news.show', $related->id) }}" class="card h-100 shadow-sm border-0 text-decoration-none" style="border-radius:12px; background:#f8fafc;">
                                        @if($related->image)
                                            <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" class="card-img-top" style="height:120px; object-fit:cover; border-top-left-radius:12px; border-top-right-radius:12px;">
                                        @endif
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-2" style="font-weight:600; color:#222; font-size:1rem; line-height:1.2;">{{ $related->title }}</h6>
                                            <div style="font-size:0.95rem; color:#667eea;">
                                                <span><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($related->published_at)->format('d/m/Y') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Comentario</label>
                            <textarea name="content" id="content" class="form-control" rows="3" required maxlength="500">{{ old('content') }}</textarea>
                            @error('content') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar comentario</button>
                    </form>
                    <small class="text-muted d-block mt-2">Tu comentario será visible tras aprobación del administrador.</small>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
