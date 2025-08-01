
@extends('layouts.admin')

@section('content')
<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="margin: 0; color: var(--primary-color);"><i class="fas fa-newspaper"></i> Noticias</h1>
        <a href="{{ route('news.create') }}" class="btn btn-success" style="font-weight: bold; font-size: 1rem; padding: 10px 20px; border-radius: 8px;">
            <i class="fas fa-plus"></i> Crear Noticia
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success" style="font-size:1rem;">{{ session('success') }}</div>
    @endif
    <div class="row" style="display: flex; flex-wrap: wrap; gap: 28px;">
        @forelse($news as $item)
            <div class="col-md-4" style="flex: 1 1 320px; max-width: 370px;">
                <div class="admin-card" style="background: #fff; border: 1px solid #e5e7eb; box-shadow: 0 4px 16px rgba(30,58,138,0.08); transition:box-shadow 0.2s; border-radius:14px; min-height:260px; display:flex; flex-direction:column; justify-content:space-between; position:relative;">
                    <div style="display: flex; align-items: flex-start; gap: 16px;">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Imagen" style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px; box-shadow:0 2px 8px rgba(59,130,246,0.10);">
                        @else
                            <span style="width:80px; height:80px; background:#e5e7eb; display:flex; align-items:center; justify-content:center; border-radius:10px; color:#888; font-size:2.2rem;">
                                <i class="fas fa-image"></i>
                            </span>
                        @endif
                        <div style="flex:1;">
                            <h4 style="margin:0; color:var(--primary-color); font-size:1.13rem; font-weight:700; line-height:1.2; white-space:normal;">{{ $item->title }}</h4>
                            <span style="font-size:0.97rem; color:#667eea; font-weight:500;"><i class="fas fa-user"></i> {{ $item->author }}</span><br>
                            <span style="font-size:0.93rem; color:#888;"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($item->published_at)->format('d/m/Y') }}</span>
                            <span style="display:inline-block; margin-top:6px; font-size:0.92rem; font-weight:600; padding:4px 14px; border-radius:14px; background:linear-gradient(90deg,#ffb347 0%,#ffcc33 100%); color:#222;">
                                <i class="fas fa-map-marker-alt"></i> {{ $item->type == 'local' ? 'Local' : 'Internacional' }}
                            </span>
                        </div>
                    </div>
                    <div style="margin-top:12px; color:#444; font-size:1.02rem; min-height:48px;">
                        {{ \Illuminate\Support\Str::limit($item->content, 90, '...') }}
                    </div>
                    <div style="margin-top:18px; display:flex; gap:10px; align-items:center; justify-content:flex-end;">
                        <a href="{{ route('news.edit', $item->id) }}" class="btn btn-warning btn-sm" style="font-weight:bold; border-radius:7px;">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta noticia?')" style="font-weight:bold; border-radius:7px;">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                    <div style="position:absolute; top:12px; right:12px;">
                        <a href="{{ route('news.show', $item->id) }}" class="btn btn-outline-primary btn-sm" style="border-radius:7px; font-weight:500;">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div style="width:100%; text-align:center; color:#888; font-size:1.2rem; margin-top:40px;">
                <i class="fas fa-info-circle"></i> No hay noticias registradas.
            </div>
        @endforelse
    </div>
    <div style="margin-top:30px;">
        {{ $news->links() }}
    </div>
</div>
@endsection
