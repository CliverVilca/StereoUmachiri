@extends('layouts.admin')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1><i class="fas fa-newspaper"></i> Gestión de Noticias</h1>
        <a href="{{ route('admin.noticias.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Noticia
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($noticias as $item)
                        <tr>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" 
                                         alt="{{ $item->title }}" 
                                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                    <div style="width: 50px; height: 50px; background: #f3f4f6; 
                                                display: flex; align-items: center; justify-content: center;
                                                border-radius: 5px;">
                                        <i class="fas fa-image" style="color: #9ca3af;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->author }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->published_at)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge badge-{{ $item->type == 'local' ? 'primary' : 'info' }}">
                                    {{ $item->type == 'local' ? 'Local' : 'Internacional' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.noticias.edit', $item->id) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.noticias.destroy', $item->id) }}" 
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('¿Estás seguro?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <i class="fas fa-info-circle"></i> No hay noticias registradas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $noticias->links() }}
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.admin-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.admin-header h1 {
    color: var(--primary-color);
    margin: 0;
}

.table-responsive {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.table th {
    background: var(--primary-color);
    color: white;
    font-weight: 600;
    border: none;
}

.table td {
    vertical-align: middle;
    border-color: #e5e7eb;
}

.btn-group {
    display: flex;
    gap: 5px;
}

.badge {
    font-size: 0.8rem;
    padding: 5px 10px;
}

.alert {
    border-radius: 8px;
    border: none;
}
</style>
@endpush
