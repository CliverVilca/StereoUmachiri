@extends('layouts.admin')

@section('title', 'Editar Noticia de Deportes')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Editar Noticia de Deportes</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.sports.update', $sport->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $sport->title) }}" required>
                </div>
                <div class="form-group">
                    <label for="content">Contenido</label>
                    <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content', $sport->content) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="author">Autor</label>
                    <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $sport->author) }}" required>
                </div>
                <div class="form-group">
                    <label for="published_at">Fecha de Publicación</label>
                    <input type="date" name="published_at" id="published_at" class="form-control" value="{{ old('published_at', $sport->published_at->format('Y-m-d')) }}" required>
                </div>
                <div class="form-group">
                    <label for="image">Imagen</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if($sport->image)
                        <img src="{{ asset('storage/' . $sport->image) }}" alt="Imagen actual" class="img-thumbnail mt-2" width="200">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Noticia</button>
            </form>
        </div>
    </div>
</div>
@endsection
