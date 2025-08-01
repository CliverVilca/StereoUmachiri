@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="admin-card">
    <h1 style="margin: 0 0 20px 0; color: var(--primary-color);">📊 Dashboard</h1>
    <p style="color: var(--text-light); margin-bottom: 30px;">Panel de control de Radio Stereo Umachiri</p>
</div>

<!-- Estadísticas -->
<div class="admin-stats">
    <div class="stat-card">
        <div class="stat-number">{{ $stats['total_listeners'] }}</div>
        <div class="stat-label">👥 Oyentes Totales</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-number">{{ $stats['messages_today'] }}</div>
        <div class="stat-label">📝 Mensajes Hoy</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-number">{{ $stats['social_engagement'] }}</div>
        <div class="stat-label">📱 Engagement Social</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-number">98.5</div>
        <div class="stat-label">📻 Frecuencia FM</div>
    </div>
</div>

<!-- Información Actual -->
<div class="admin-card">
    <h3 style="margin: 0 0 15px 0; color: var(--primary-color);">🎙️ Programa Actual</h3>
    <div style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); color: white; padding: 20px; border-radius: 10px;">
        <h4 style="margin: 0 0 10px 0;">{{ $stats['current_show'] }}</h4>
        <p style="margin: 0 0 5px 0;"><strong>Conductor:</strong> {{ $stats['current_host'] }}</p>
        <p style="margin: 0;"><strong>Estado:</strong> <span style="background: var(--success-color); padding: 2px 8px; border-radius: 15px; font-size: 0.8rem;">EN VIVO</span></p>
    </div>
</div>

<!-- Acciones Rápidas -->
<div class="admin-card">
    <h3 style="margin: 0 0 15px 0; color: var(--primary-color);">⚡ Acciones Rápidas</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
        <a href="{{ route('admin.programs') }}" style="background: var(--primary-color); color: white; padding: 15px; text-decoration: none; border-radius: 8px; text-align: center; transition: all 0.3s ease;">
            📻 Gestionar Programas
        </a>
        <a href="{{ route('news.index') }}" style="background: var(--accent-color); color: white; padding: 15px; text-decoration: none; border-radius: 8px; text-align: center; transition: all 0.3s ease;">
            📰 Gestionar Noticias
        </a>
        <a href="{{ route('admin.comments.index') }}" style="background: var(--success-color); color: white; padding: 15px; text-decoration: none; border-radius: 8px; text-align: center; transition: all 0.3s ease;">
            💬 Gestionar Comentarios
        </a>
        <a href="{{ route('admin.messages') }}" style="background: var(--warning-color); color: white; padding: 15px; text-decoration: none; border-radius: 8px; text-align: center; transition: all 0.3s ease;">
            📝 Ver Mensajes
        </a>
        <a href="{{ route('admin.analytics') }}" style="background: var(--secondary-color); color: white; padding: 15px; text-decoration: none; border-radius: 8px; text-align: center; transition: all 0.3s ease;">
            📈 Ver Analytics
        </a>
        <a href="{{ route('home') }}" style="background: var(--primary-color); color: white; padding: 15px; text-decoration: none; border-radius: 8px; text-align: center; transition: all 0.3s ease;">
            🏠 Ver Sitio Web
        </a>
    </div>
</div>

<!-- Últimas Actividades -->
<div class="admin-card">
    <h3 style="margin: 0 0 15px 0; color: var(--primary-color);">🕒 Últimas Actividades</h3>
    <div style="background: var(--bg-light); padding: 15px; border-radius: 8px;">
        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <span style="background: var(--success-color); color: white; padding: 2px 8px; border-radius: 50%; font-size: 0.8rem; margin-right: 10px;">✓</span>
            <span>Nuevo mensaje de contacto recibido</span>
            <span style="margin-left: auto; color: var(--text-light); font-size: 0.9rem;">Hace 5 min</span>
        </div>
        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <span style="background: var(--accent-color); color: white; padding: 2px 8px; border-radius: 50%; font-size: 0.8rem; margin-right: 10px;">📻</span>
            <span>Programa "Música del Recuerdo" iniciado</span>
            <span style="margin-left: auto; color: var(--text-light); font-size: 0.9rem;">Hace 15 min</span>
        </div>
        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <span style="background: var(--warning-color); color: white; padding: 2px 8px; border-radius: 50%; font-size: 0.8rem; margin-right: 10px;">👥</span>
            <span>Pico de oyentes alcanzado: 250</span>
            <span style="margin-left: auto; color: var(--text-light); font-size: 0.9rem;">Hace 30 min</span>
        </div>
    </div>
</div>
@endsection 