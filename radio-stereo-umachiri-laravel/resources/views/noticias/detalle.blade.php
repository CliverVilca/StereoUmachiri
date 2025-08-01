@extends('layouts.app')
@section('content')
<section class="news-detail-section" style="background:linear-gradient(120deg,#e0e7ff 0%,#f8fafc 100%); min-height:100vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">
                <article class="news-detail-card shadow-lg border px-0" style="border-radius:22px; background:#fff; border:1.5px solid #e0e7ff;">
                    <div class="p-4 pb-0 text-center">
                        <h1 class="mb-3" style="background:linear-gradient(90deg,#667eea 0%,#764ba2 100%); color:#fff; font-weight:900; font-size:2.35rem; line-height:1.1; letter-spacing:-1px; border-radius:12px; padding:16px 0 12px 0; box-shadow:0 2px 12px rgba(102,126,234,0.10); border-bottom:4px solid #ffb347; text-shadow:0 2px 8px rgba(102,126,234,0.10); margin-top:110px;">{{ $news->title }}</h1>
                        <div class="d-flex justify-content-center align-items-center gap-3 mb-3" style="font-size:1.08rem; color:#667eea;">
                            <span><i class="fas fa-user"></i> {{ $news->author }}</span>
                            <span><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($news->published_at)->format('d/m/Y') }}</span>
                            <span class="badge d-flex align-items-center gap-2"
                                style="font-size:1rem; padding:7px 18px; border-radius:16px; font-weight:600; {{ $news->type == 'local' ? 'background:linear-gradient(90deg,#ffb347 0%,#ffcc33 100%); color:#222;' : 'background:linear-gradient(90deg,#00c6ff 0%,#0072ff 100%); color:#fff;' }}; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                                @if($news->type == 'local')
                                    <i class="fas fa-map-marker-alt"></i>
                                @else
                                    <i class="fas fa-globe"></i>
                                @endif
                                {{ $news->type == 'local' ? 'Local' : 'Internacional' }}
                            </span>
                        </div>
                    </div>
                    <div class="px-4 pb-4">
                        @php
                            $paragraphs = preg_split('/\r?\n\r?\n/', trim($news->content));
                        @endphp
                        <div class="row align-items-start g-4">
                            @if($news->image)
                                <div class="col-md-5 d-flex justify-content-center mb-3 mb-md-0">
                                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" style="max-width:340px; max-height:340px; width:100%; object-fit:contain; border-radius:16px; box-shadow:0 4px 18px rgba(102,126,234,0.13); border:3px solid #e0e7ff;">
                                </div>
                            @endif
                            <div class="col-md-7">
                                <div style="font-size:1.19rem; color:#222; line-height:1.85; text-align:justify; margin-bottom:22px;">
                                    @foreach($paragraphs as $paragraph)
                                        <p style="margin-bottom:1.2em; word-break:break-word; background:#f8f9fa; border-radius:7px; padding:10px 18px; box-shadow:0 1px 6px rgba(102,126,234,0.07);">{{ $paragraph }}</p>
                                    @endforeach
                                </div>
                        <!-- Eliminado bloque duplicado de compartir para evitar repetición visual -->
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-3 mb-3 align-items-center" style="background:#f8f9fa; border-radius:10px; padding:12px 18px; box-shadow:0 1px 8px rgba(102,126,234,0.07);">
                            <span style="font-weight:700; color:#667eea; font-size:1.08rem; margin-right:12px;"><i class="fas fa-share-alt"></i> Compartir</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm d-flex align-items-center gap-2" style="background:#1877f2; color:#fff; font-weight:600; border-radius:8px;">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm d-flex align-items-center gap-2" style="background:#1da1f2; color:#fff; font-weight:600; border-radius:8px;">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm d-flex align-items-center gap-2" style="background:#25d366; color:#fff; font-weight:600; border-radius:8px;">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm d-flex align-items-center gap-2" style="background:#0077b5; color:#fff; font-weight:600; border-radius:8px;">
                                <i class="fab fa-linkedin"></i> LinkedIn
                            </a>
                        </div>
                    </div>
                </article>
                @if(isset($relatedNews) && $relatedNews->count())
                    <div class="mt-5">
                        <h2 style="color:#222; font-weight:900; font-size:2rem; margin-bottom:18px;">Publicaciones Relacionadas</h2>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @foreach($relatedNews as $related)
                                <div class="col d-flex">
                                    <a href="{{ route('noticias.detalle', $related->id) }}" class="card h-100 shadow-sm border-0 text-decoration-none w-100" style="border-radius:12px; background:#f8fafc;">
                                        @if($related->image)
                                            <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" class="card-img-top" style="height:160px; object-fit:cover; border-top-left-radius:12px; border-top-right-radius:12px;">
                                        @endif
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-2" style="font-weight:700; color:#222; font-size:1.08rem; line-height:1.2;">{{ $related->title }}</h6>
                                            <div style="font-size:0.97rem; color:#667eea;">
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
