@extends('layouts.admin')

@section('content')
<div class="admin-card" style="max-width:600px; margin:auto;">
    <h1 style="color:var(--primary-color); margin-bottom:20px;"><i class="fas fa-edit"></i> Editar Noticia</h1>
    <form action="{{ route('admin.noticias.update', $noticia->id) }}" method="POST" enctype="multipart/form-data" style="background:#f8fafc; padding:25px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.07);">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label" style="font-weight:bold;"><i class="fas fa-heading"></i> Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $noticia->title) }}" required style="border-radius:8px;">
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label" style="font-weight:bold;"><i class="fas fa-align-left"></i> Contenido</label>
            <textarea name="content" id="content" class="form-control" rows="5" required style="border-radius:8px;">{{ old('content', $noticia->content) }}</textarea>
            @error('content') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="author" class="form-label" style="font-weight:bold;"><i class="fas fa-user"></i> Autor</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $noticia->author) }}" required style="border-radius:8px;">
            @error('author') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="type" class="form-label" style="font-weight:bold;"><i class="fas fa-globe"></i> Tipo de noticia</label>
            <select name="type" id="type" class="form-control" style="border-radius:8px;">
                <option value="local" {{ old('type', $noticia->type) == 'local' ? 'selected' : '' }}>Local</option>
                <option value="internacional" {{ old('type', $noticia->type) == 'internacional' ? 'selected' : '' }}>Internacional</option>
            </select>
            @error('type') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label" style="font-weight:bold;"><i class="fas fa-globe"></i> Estado</label>
            <select name="status" id="status" class="form-control" style="border-radius:8px;" required>
                <option value="draft" {{ old('status', $noticia->status) == 'draft' ? 'selected' : '' }}>Borrador</option>
                <option value="published" {{ old('status', $noticia->status) == 'published' ? 'selected' : '' }}>Publicado</option>
            </select>
            @error('status') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="published_at" class="form-label" style="font-weight:bold;"><i class="fas fa-calendar"></i> Fecha de publicación</label>
            <input type="datetime-local" name="published_at" id="published_at" class="form-control" value="{{ old('published_at', $noticia->published_at ? $noticia->published_at->format('Y-m-d\TH:i') : '') }}" required style="border-radius:8px;">
            @error('published_at') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label" style="font-weight:bold;"><i class="fas fa-image"></i> Imagen (opcional)</label>
            <input type="file" name="image" id="image" class="form-control" style="border-radius:8px;">
            @if($noticia->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $noticia->image) }}" alt="Imagen actual" style="width:120px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.07);">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                        <label class="form-check-label" for="remove_image">Eliminar imagen actual</label>
                    </div>
                </div>
            @endif
            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div style="display:flex; gap:10px; margin-top:20px;">
            <button type="submit" class="btn btn-success" style="font-weight:bold; font-size:1rem; padding:10px 20px; border-radius:8px;">
                <i class="fas fa-save"></i> Actualizar
            </button>
            <a href="{{ route('admin.noticias.index') }}" class="btn btn-secondary" style="font-weight:bold; font-size:1rem; padding:10px 20px; border-radius:8px;">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
        </div>
    </form>
</div>

@section('scripts')
<script>
// Vista previa de la imagen
document.getElementById('image').addEventListener('change', function(e) {
    const previewContainer = document.getElementById('image-preview');
    if (!previewContainer) {
        const container = document.createElement('div');
        container.id = 'image-preview';
        container.className = 'mt-2';
        container.innerHTML = '<img id="preview" src="#" alt="Vista previa" style="width:120px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.07);">';
        this.parentNode.appendChild(container);
    }
    
    const preview = document.getElementById('preview');
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(this.files[0]);
    }
});
</script>
@endsection
