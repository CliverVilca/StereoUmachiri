@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="admin-card">
    <h1 class="dashboard-header">📊 Dashboard</h1>
    <p class="dashboard-subheader">Panel de control de Radio Stereo Umachiri</p>
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
    <h3 class="dashboard-header">🎙️ Programa Actual</h3>
    <div class="current-program-card">
        <h4>{{ $stats['current_show'] }}</h4>
        <p><strong>Conductor:</strong> {{ $stats['current_host'] }}</p>
        <p><strong>Estado:</strong> <span class="live-badge">EN VIVO</span></p>
    </div>
</div>

<!-- Acciones Rápidas -->
<div class="admin-card">
    <h3 class="dashboard-header">⚡ Acciones Rápidas</h3>
    <div class="quick-actions">
        <a href="{{ route('admin.programs.index') }}" class="quick-action-btn btn-programs">
            📻 Gestionar Programas
        </a>
        <a href="{{ route('admin.news.index') }}" class="quick-action-btn btn-news">
            📰 Gestionar Noticias
        </a>
        <a href="{{ route('admin.comments.index') }}" class="quick-action-btn btn-comments">
            💬 Gestionar Comentarios
        </a>
        <a href="{{ route('admin.messages') }}" class="quick-action-btn btn-messages">
            📝 Ver Mensajes
        </a>
        <a href="{{ route('admin.analytics') }}" class="quick-action-btn btn-analytics">
            📈 Ver Analytics
        </a>
        <a href="{{ route('home') }}" class="quick-action-btn btn-website">
            🏠 Ver Sitio Web
        </a>
    </div>
</div>

<!-- Últimas Actividades -->
<div class="admin-card">
    <h3 class="dashboard-header">🕒 Últimas Actividades</h3>
    <div class="latest-activities">
        <div class="activity-item">
            <span class="activity-item-icon" style="background: #28a745;">✓</span>
            <span class="activity-item-text">Nuevo mensaje de contacto recibido</span>
            <span class="activity-item-time">Hace 5 min</span>
        </div>
        <div class="activity-item">
            <span class="activity-item-icon" style="background: var(--accent-color);">📻</span>
            <span class="activity-item-text">Programa "Música del Recuerdo" iniciado</span>
            <span class="activity-item-time">Hace 15 min</span>
        </div>
        <div class="activity-item">
            <span class="activity-item-icon" style="background: #ffc107;">👥</span>
            <span class="activity-item-text">Pico de oyentes alcanzado: 250</span>
            <span class="activity-item-time">Hace 30 min</span>
        </div>
    </div>
</div>
>>>>>>> 01b2b2f (Refactor dashboard styles)
@endsection
