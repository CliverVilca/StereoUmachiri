@extends('layouts.admin')

@section('content')
    <h1>Editar DJ</h1>
    <form action="{{ route('admin.djs.update', $dj) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $dj->name }}" required>
        </div>
        <div class="form-group">
            <label for="bio">Biografía</label>
            <textarea name="bio" class="form-control" required>{{ $dj->bio }}</textarea>
        </div>
        <div class="form-group">
            <label for="photo">Foto (opcional)</label>
            <input type="file" name="photo" class="form-control">
            <img src="{{ asset('storage/' . $dj->photo_path) }}" alt="{{ $dj->name }}" width="100" class="mt-2">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
