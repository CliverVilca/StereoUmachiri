
@extends('layouts.admin')

@section('content')
<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="margin: 0; color: var(--primary-color);"><i class="fas fa-comments"></i> Comentarios</h1>
    </div>
    @if(session('success'))
        <div class="alert alert-success" style="font-size:1rem;">{{ session('success') }}</div>
    @endif
    <div class="row" style="display: flex; flex-wrap: wrap; gap: 20px;">
        @forelse($comments as $comment)
            <div class="col-md-4" style="flex: 1 1 320px; max-width: 350px;">
                <div class="admin-card" style="background: #f8fafc; border: 1px solid #e5e7eb; box-shadow: 0 2px 8px rgba(0,0,0,0.07);">
                    <div style="margin-bottom:10px;">
                        <span style="font-size:1rem; color:var(--primary-color); font-weight:bold;"><i class="fas fa-newspaper"></i> {{ $comment->news->title ?? 'Sin noticia' }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="background:#e5e7eb; border-radius:50%; width:40px; height:40px; display:flex; align-items:center; justify-content:center; color:#888; font-size:1.5rem;">
                            <i class="fas fa-user"></i>
                        </span>
                        <div>
                            <span style="font-weight:bold; color:#333;">{{ $comment->name }}</span><br>
                            <span style="font-size:0.95rem; color:#555;">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    <div style="margin-top:10px; color:#444; font-size:1rem;">
                        <i class="fas fa-comment"></i> {{ $comment->content }}
                    </div>
                    <div style="margin-top:10px;">
                        @if($comment->approved)
                            <span class="badge bg-success" style="font-size:0.95rem;">Aprobado</span>
                        @else
                            <span class="badge bg-warning text-dark" style="font-size:0.95rem;">Pendiente</span>
                        @endif
                    </div>
                    <div style="margin-top:10px;">
                        @if(!$comment->approved)
                            <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" style="font-weight:bold; margin-right:8px;">
                                    <i class="fas fa-check"></i> Aprobar
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este comentario?')" style="font-weight:bold;">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="width:100%; text-align:center; color:#888; font-size:1.2rem; margin-top:40px;">
                <i class="fas fa-info-circle"></i> No hay comentarios registrados.
            </div>
        @endforelse
    </div>
    <div style="margin-top:30px;">
        {{ $comments->links() }}
    </div>
</div>
@endsection
