@extends('layouts.admin')

@section('title', 'Crear Noticia')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Nueva Noticia</h1>
    
    <form action="{{ route('admin.noticias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">Información de la Noticia</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Título *</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="content" class="form-label">Contenido *</label>
                            <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="author" class="form-label">Autor *</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" required>
                            @error('author')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">Detalles</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="published_at" class="form-label">Fecha de Publicación *</label>
                            <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ old('published_at') }}" required>
                            @error('published_at')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="type" class="form-label">Tipo *</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Seleccionar tipo</option>
                                <option value="local" {{ old('type') == 'local' ? 'selected' : '' }}>Local</option>
                                <option value="internacional" {{ old('type') == 'internacional' ? 'selected' : '' }}>Internacional</option>
                            </select>
                            @error('type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Estado *</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">Seleccionar estado</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Borrador</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publicado</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header">Imagen</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen de la Noticia</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <small class="form-text text-muted">Formatos: jpeg, png, jpg, gif. Máx: 2MB</small>
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div id="image-preview" class="mt-2" style="display: none;">
                            <img id="preview" src="#" alt="Vista previa" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mb-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Crear Noticia
            </button>
            <a href="{{ route('admin.noticias.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
        </div>
    </form>
</div>

@section('scripts')
<script>
// Vista previa de la imagen
document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('preview');
    const imagePreview = document.getElementById('image-preview');
    
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            imagePreview.style.display = 'block';
        }
        
        reader.readAsDataURL(this.files[0]);
    }
});

// Inicializar editor de texto (opcional)
// Si tienes un editor como CKEditor o TinyMCE, inicialízalo aquí
</script>
@endsection

@endsection