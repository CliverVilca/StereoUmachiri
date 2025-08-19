@extends('layouts.admin')

@section('content')
    <h1>Añadir DJ</h1>
    <form action="{{ route('admin.djs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="bio">Biografía</label>
            <textarea name="bio" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="photo">Foto</label>
            <input type="file" name="photo" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
