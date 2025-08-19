@extends('layouts.admin')

@section('content')
    <h1>Añadir Podcast a {{ $program->title }}</h1>
    <form action="{{ route('admin.programs.podcasts.store', $program) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="audio">Archivo de Audio</label>
            <input type="file" name="audio" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
