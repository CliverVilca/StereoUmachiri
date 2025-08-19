@extends('layouts.admin')

@section('content')
    <h1>Locutores (DJs)</h1>
    <a href="{{ route('admin.djs.create') }}" class="btn btn-primary">Añadir DJ</a>
    <table class="table">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($djs as $dj)
                <tr>
                    <td><img src="{{ asset('storage/' . $dj->photo_path) }}" alt="{{ $dj->name }}" width="100"></td>
                    <td>{{ $dj->name }}</td>
                    <td>
                        <a href="{{ route('admin.djs.edit', $dj) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.djs.destroy', $dj) }}" method="POST" style="display:inline-block;">
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
