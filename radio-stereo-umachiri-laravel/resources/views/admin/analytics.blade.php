@extends('layouts.admin')

@section('title', 'Analytics')

@section('content')
<div class="admin-card">
    <h1 style="margin: 0 0 20px 0; color: var(--primary-color);">📈 Analytics</h1>
    <p style="color: var(--text-light); margin-bottom: 30px;">Estadísticas y métricas del sitio web</p>
</div>

<!-- Métricas Principales -->
<div class="admin-stats">
    <div class="stat-card">
        <div class="stat-number">{{ number_format($analytics['page_views']) }}</div>
        <div class="stat-label">👁️ Vistas de Página</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ number_format($analytics['unique_visitors']) }}</div>
        <div class="stat-label">👤 Visitantes Únicos</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $analytics['avg_session_duration'] }}</div>
        <div class="stat-label">⏱️ Duración Promedio</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $analytics['bounce_rate'] }}</div>
        <div class="stat-label">📉 Tasa de Rebote</div>
    </div>
</div>

<!-- Gráfico de Páginas Más Visitadas -->
<div class="admin-card">
    <h3 style="margin: 0 0 15px 0; color: var(--primary-color);">📊 Páginas Más Visitadas</h3>
    <div style="background: var(--bg-light); padding: 15px; border-radius: 8px;">
        @foreach($analytics['top_pages'] as $page => $views)
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid var(--border-color);">
            <span style="font-weight: 500;">{{ $page }}</span>
            <div style="display: flex; align-items: center;">
                <div style="width: 100px; height: 8px; background: var(--border-color); border-radius: 4px; margin-right: 10px;">
                    <div style="width: {{ ($views / max($analytics['top_pages'])) * 100 }}%; height: 100%; background: var(--primary-color); border-radius: 4px;"></div>
                </div>
                <span style="font-weight: bold; color: var(--primary-color);">{{ number_format($views) }}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection 