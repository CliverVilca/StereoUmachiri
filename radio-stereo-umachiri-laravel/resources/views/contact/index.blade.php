@extends('layouts.app')

@section('title', 'Contacto - Stereo Umachiri')

@section('content')
<div class="container main-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <header class="mb-5 text-center">
                <h1 class="display-4 fw-bold">Contacto</h1>
                <p class="lead">¿Tienes alguna pregunta o comentario? ¡Nos encantaría saber de ti!</p>
            </header>
            @livewire('contact-form')
        </div>
    </div>
</div>
@endsection
