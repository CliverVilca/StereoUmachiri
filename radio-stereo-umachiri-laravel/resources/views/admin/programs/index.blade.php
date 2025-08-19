@extends('layouts.admin')

@section('title', 'Gestión de Programación')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Gestión de Programación</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.programs.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Añadir Programa</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Día de la Semana</th>
                            <th>Programas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($days as $day)
                            <tr>
                                <td><strong>{{ $day }}</strong></td>
                                <td>
                                    @if(isset($programs[$day]) && $programs[$day]->count() > 0)
                                        @foreach($programs[$day]->sortBy('start_time') as $program)
                                            <div class="mb-2 p-2 border rounded">
                                                <strong>{{ $program->title }}</strong> ({{ \Carbon\Carbon::parse($program->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($program->end_time)->format('H:i') }})
                                                <p class="mb-1">{{ $program->host }}</p>
                                                <div class="mt-1">
                                                    <a href="{{ route('admin.programs.edit', $program->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('admin.programs.podcasts.index', $program->id) }}" class="btn btn-sm btn-info"><i class="fas fa-podcast"></i> Podcasts</a>
                                                    <form action="{{ route('admin.programs.destroy', $program->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este programa?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No hay programas para este día.</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
