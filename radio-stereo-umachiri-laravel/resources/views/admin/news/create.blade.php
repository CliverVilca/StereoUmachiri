@extends('layouts.admin')

@section('content')
<div class="admin-card" style="max-width:600px; margin:auto; background-color:#ffffff; padding:30px; border-radius:12px; box-shadow:0 4px 15px rgba(0, 0, 0, 0.1);">
    <h1 style="color: var(--primary-color); margin-bottom: 25px; font-size: 1.8rem; font-weight: 600; text-align:center;">
        <i class="fas fa-plus"></i> Crear Noticia
    </h1>
    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" style="background:#f8fafc; padding:25px; border-radius:12px;">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label" style="font-weight:bold; color: #333; font-size:1.1rem;"><i class="fas fa-heading"></i> Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required style="border-radius:8px; border: 1px solid #ddd; padding: 12px; font-size: 1rem;">
            @error('title') <div class="text-danger" style="font-size:0.9rem;">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label" style="font-weight:bold; color: #333; font-size:1.1rem;"><i class="fas fa-align-left"></i> Contenido</label>
            <textarea name="content" id="content" class="form-control" rows="5" required style="border-radius:8px; border: 1px solid #ddd; padding: 12px; font-size: 1rem;">{{ old('content') }}</textarea>
            @error('content') <div class="text-danger" style="font-size:0.9rem;">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="author" class="form-label" style="font-weight:bold; color: #333; font-size:1.1rem;"><i class="fas fa-user"></i> Autor</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ old('author') }}" required style="border-radius:8px; border: 1px solid #ddd; padding: 12px; font-size: 1rem;">
            @error('author') <div class="text-danger" style="font-size:0.9rem;">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="type" class="form-label" style="font-weight:bold; color: #333; font-size:1.1rem;"><i class="fas fa-globe"></i> Tipo de noticia</label>
            <select name="type" id="type" class="form-control" style="border-radius:8px; border: 1px solid #ddd; padding: 12px; font-size: 1rem;">
                <option value="local" {{ old('type') == 'local' ? 'selected' : '' }}>Local</option>
                <option value="internacional" {{ old('type') == 'internacional' ? 'selected' : '' }}>Internacional</option>
            </select>
            @error('type') <div class="text-danger" style="font-size:0.9rem;">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="published_at" class="form-label" style="font-weight:bold; color: #333; font-size:1.1rem;"><i class="fas fa-calendar"></i> Fecha de publicación</label>
            <input type="date" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') }}" required style="border-radius:8px; border: 1px solid #ddd; padding: 12px; font-size: 1rem;">
            @error('published_at') <div class="text-danger" style="font-size:0.9rem;">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label" style="font-weight:bold; color: #333; font-size:1.1rem;"><i class="fas fa-image"></i> Imagen (opcional)</label>
            <input type="file" name="image" id="image" class="form-control" style="border-radius:8px; border: 1px solid #ddd; padding: 12px; font-size: 1rem;">
            @error('image') <div class="text-danger" style="font-size:0.9rem;">{{ $message }}</div> @enderror
        </div>

        <div style="display:flex; gap:15px; margin-top:20px; justify-content:center;">
            <button type="submit" class="btn btn-success" style="font-weight:bold; font-size:1rem; padding:12px 25px; border-radius:8px; background-color:#28a745; border:none; color:white; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: background-color 0.3s;">
                <i class="fas fa-save"></i> Guardar
            </button>
            <a href="{{ route('news.index') }}" class="btn btn-secondary" style="font-weight:bold; font-size:1rem; padding:12px 25px; border-radius:8px; background-color:#6c757d; border:none; color:white; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: background-color 0.3s;">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
