@extends('layouts.admin')

@section('content')
    <h1>Editar Evento</h1>
    <form action="{{ route('admin.events.update', $event) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" class="form-control" required>{{ $event->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="start_time">Inicio</label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{ \Carbon\Carbon::parse($event->start_time)->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="form-group">
            <label for="end_time">Fin</label>
            <input type="datetime-local" name="end_time" class="form-control" value="{{ \Carbon\Carbon::parse($event->end_time)->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="form-group">
            <label for="location">Ubicación</label>
            <input type="text" name="location" class="form-control" value="{{ $event->location }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
