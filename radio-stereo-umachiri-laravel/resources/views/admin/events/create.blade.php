@extends('layouts.admin')

@section('content')
    <h1>Crear Evento</h1>
    <form action="{{ route('admin.events.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="start_time">Inicio</label>
            <input type="datetime-local" name="start_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_time">Fin</label>
            <input type="datetime-local" name="end_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="location">Ubicación</label>
            <input type="text" name="location" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
