@extends('layouts.admin')

@section('content')
    <h1>Galería</h1>
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">Añadir Imagen</a>
    <table class="table">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Título</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($galleries as $gallery)
                <tr>
                    <td><img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" width="100"></td>
                    <td>{{ $gallery->title }}</td>
                    <td>
                        <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" style="display:inline-block;">
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
