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
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Livewire Styles -->
    @livewireStyles
    
    <!-- Admin Styles -->
    <style>
        .admin-sidebar {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            min-height: 100vh;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }
        
        .admin-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
            background: var(--bg-light);
        }
        
        .admin-nav-item {
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .admin-nav-item:hover,
        .admin-nav-item.active {
            background: rgba(255, 255, 255, 0.1);
            border-left-color: var(--secondary-color);
        }
        
        .admin-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .admin-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-color);
        }
        
        .stat-label {
            color: var(--text-light);
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <div style="padding: 20px; text-align: center;">
            <h3 style="color: white; margin: 0;">🎵 Radio Umachiri</h3>
            <p style="color: rgba(255,255,255,0.8); margin: 5px 0 0 0; font-size: 0.9rem;">Panel de Administración</p>
        </div>
        
        <nav style="margin-top: 30px;">
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                📊 Dashboard
            </a>
            <a href="{{ route('admin.programs') }}" class="admin-nav-item {{ request()->routeIs('admin.programs') ? 'active' : '' }}">
                📻 Programas
            </a>
            <a href="{{ route('admin.messages') }}" class="admin-nav-item {{ request()->routeIs('admin.messages') ? 'active' : '' }}">
                📝 Mensajes
            </a>
            <a href="{{ route('admin.analytics') }}" class="admin-nav-item {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
                📈 Analytics
            </a>
            <a href="{{ route('home') }}" class="admin-nav-item" style="margin-top: 30px; border-top: 1px solid rgba(255,255,255,0.2);">
                🏠 Ver Sitio Web
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
    <script>
        // Funcionalidades del admin
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-refresh de estadísticas cada 30 segundos
            setInterval(function() {
                if (window.location.pathname === '/admin') {
                    location.reload();
                }
            }, 30000);
        });
    </script>
</body>
</html> 