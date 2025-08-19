@extends('layouts.app')

@section('content')
    <h1>{{ $noticia->titulo }}</h1>
    <p>{{ $noticia->contenido }}</p>
    <a href="{{ route('news.index') }}">Volver a Noticias</a>
@endsection
