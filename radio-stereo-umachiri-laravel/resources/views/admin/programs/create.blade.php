@extends('layouts.admin')

@section('title', 'Añadir Nuevo Programa')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Añadir Nuevo Programa</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Título del Programa</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="host">Conductor</label>
                    <input type="text" name="host" id="host" class="form-control" value="{{ old('host') }}" required>
                </div>
                <div class="form-group">
                    <label>Días de la Semana</label>
                    <div>
                        @foreach($days as $day)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="days_of_week[]" id="day_{{ $day }}" value="{{ $day }}">
                                <label class="form-check-label" for="day_{{ $day }}">{{ $day }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="start_time">Hora de Inicio</label>
                        <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end_time">Hora de Fin</label>
                        <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('end_time') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Imagen del Programa</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Guardar Programa</button>
            </form>
        </div>
    </div>
</div>
@endsection
