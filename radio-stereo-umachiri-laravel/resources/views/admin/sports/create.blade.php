@extends('layouts.admin')

@section('title', 'Crear Noticia de Deportes')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Crear Noticia de Deportes</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.sports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                    <label for="content">Contenido</label>
                    <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="author">Autor</label>
                    <input type="text" name="author" id="author" class="form-control" value="{{ old('author') }}" required>
                </div>
                <div class="form-group">
                    <label for="published_at">Fecha de Publicación</label>
                    <input type="date" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') }}" required>
                </div>
                <div class="form-group">
                    <label for="image">Imagen</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Crear Noticia</button>
            </form>
        </div>
    </div>
</div>
@endsection
