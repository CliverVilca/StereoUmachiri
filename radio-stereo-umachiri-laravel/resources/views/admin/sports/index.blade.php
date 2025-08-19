@extends('layouts.admin')

@section('title', 'Noticias de Deportes')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Noticias de Deportes</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.sports.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Crear Noticia</a>
    </div>

    <div class="row">
        @forelse($sports as $sport)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    @if($sport->image)
                        <img src="{{ asset('storage/' . $sport->image) }}" class="card-img-top" alt="{{ $sport->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $sport->title }}</h5>
                        <p class="card-text">{{ Str::limit($sport->content, 100) }}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Publicado el {{ $sport->published_at->format('d/m/Y') }}</small>
                        <div class="mt-2">
                            <a href="{{ route('admin.sports.show', $sport->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Ver</a>
                            <a href="{{ route('admin.sports.edit', $sport->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Editar</a>
                            <form action="{{ route('admin.sports.destroy', $sport->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta noticia?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <p>No hay noticias de deportes para mostrar.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $sports->links() }}
    </div>
</div>
@endsection
