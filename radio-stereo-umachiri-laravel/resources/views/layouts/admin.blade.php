<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración') - Radio Stereo Umachiri</title>
    <meta name="description" content="Panel de administración de Radio Stereo Umachiri">
    <meta name="keywords" content="radio, umachiri, administración, panel">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-broadcast-tower"></i> Radio Umachiri</h3>
            <p>Panel de Administración</p>
        </div>
        
        <nav class="admin-nav">
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="{{ route('admin.programs.index') }}" class="admin-nav-item {{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">
                <i class="fas fa-microphone-alt"></i> Programas
            </a>
            <a href="{{ route('admin.noticias.index') }}" class="admin-nav-item {{ request()->routeIs('admin.noticias.*') ? 'active' : '' }}">
                <i class="far fa-newspaper"></i> Noticias
            </a>
            <a href="{{ route('admin.sports.index') }}" class="admin-nav-item {{ request()->routeIs('admin.sports.*') ? 'active' : '' }}">
                <i class="fas fa-futbol"></i> Deportes
            </a>
            <a href="{{ route('admin.events.index') }}" class="admin-nav-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                <i class="far fa-calendar-alt"></i> Eventos
            </a>
            <a href="{{ route('admin.galleries.index') }}" class="admin-nav-item {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                <i class="far fa-images"></i> Galería
            </a>
            <a href="{{ route('admin.djs.index') }}" class="admin-nav-item {{ request()->routeIs('admin.djs.*') ? 'active' : '' }}">
                <i class="fas fa-user-friends"></i> Locutores
            </a>
            <a href="{{ route('admin.messages') }}" class="admin-nav-item {{ request()->routeIs('admin.messages') ? 'active' : '' }}">
                <i class="far fa-envelope"></i> Mensajes
            </a>
            <a href="{{ route('admin.analytics') }}" class="admin-nav-item {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> Analytics
            </a>
            <a href="{{ route('home') }}" class="admin-nav-item" style="margin-top: 30px; border-top: 1px solid rgba(255,255,255,0.2);">
                <i class="fas fa-home"></i> Ver Sitio Web
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        @yield('content')
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts
    
    <!-- Admin Scripts -->
    @stack('scripts')
</body>
</html>
