
@extends('layouts.admin')

@section('content')
<div class="admin-card" style="max-width:600px; margin:auto;">
    <h1 style="color:var(--primary-color); margin-bottom:20px;"><i class="fas fa-edit"></i> Editar Noticia</h1>
    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data" style="background:#f8fafc; padding:25px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.07);">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label" style="font-weight:bold;"><i class="fas fa-heading"></i> Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $news->title) }}" required style="border-radius:8px;">
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label" style="font-weight:bold;"><i class="fas fa-align-left"></i> Contenido</label>
            <textarea name="content" id="content" class="form-control" rows="5" required style="border-radius:8px;">{{ old('content', $news->content) }}</textarea>
            @error('content') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="author" class="form-label" style="font-weight:bold;"><i class="fas fa-user"></i> Autor</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $news->author) }}" required style="border-radius:8px;">
            @error('author') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="type" class="form-label" style="font-weight:bold;"><i class="fas fa-globe"></i> Tipo de noticia</label>
            <select name="type" id="type" class="form-control" style="border-radius:8px;">
                <option value="local" {{ old('type', $news->type) == 'local' ? 'selected' : '' }}>Local</option>
                <option value="internacional" {{ old('type', $news->type) == 'internacional' ? 'selected' : '' }}>Internacional</option>
            </select>
            @error('type') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="published_at" class="form-label" style="font-weight:bold;"><i class="fas fa-calendar"></i> Fecha de publicación</label>
            <input type="date" name="published_at" id="published_at" class="form-control" value="{{ old('published_at', $news->published_at) }}" required style="border-radius:8px;">
            @error('published_at') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label" style="font-weight:bold;"><i class="fas fa-image"></i> Imagen (opcional)</label>
            <input type="file" name="image" id="image" class="form-control" style="border-radius:8px;">
            @if($news->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="Imagen actual" style="width:120px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.07);">
                </div>
            @endif
            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div style="display:flex; gap:10px; margin-top:20px;">
            <button type="submit" class="btn btn-success" style="font-weight:bold; font-size:1rem; padding:10px 20px; border-radius:8px;">
                <i class="fas fa-save"></i> Actualizar
            </button>
            <a href="{{ route('news.index') }}" class="btn btn-secondary" style="font-weight:bold; font-size:1rem; padding:10px 20px; border-radius:8px;">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
