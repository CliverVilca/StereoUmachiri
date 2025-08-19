@extends('layouts.admin')

@section('content')
    <h1>Podcasts for {{ $program->title }}</h1>
    <a href="{{ route('admin.programs.podcasts.create', $program) }}" class="btn btn-primary">Añadir Podcast</a>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($program->podcasts as $podcast)
                <tr>
                    <td>{{ $podcast->title }}</td>
                    <td>
                        <a href="{{ route('admin.programs.podcasts.edit', [$program, $podcast]) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.programs.podcasts.destroy', [$program, $podcast]) }}" method="POST" style="display:inline-block;">
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
