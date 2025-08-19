@extends('layouts.admin')

@section('content')
    <h1>Eventos</h1>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Crear Evento</a>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->start_time }}</td>
                    <td>{{ $event->end_time }}</td>
                    <td>
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
