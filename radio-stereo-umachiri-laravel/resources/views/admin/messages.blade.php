@extends('layouts.admin')

@section('title', 'Mensajes de Contacto')

@section('content')
<div class="admin-card">
    <h1 style="margin: 0 0 20px 0; color: var(--primary-color);">📝 Mensajes de Contacto</h1>
    <p style="color: var(--text-light); margin-bottom: 30px;">Revisa y responde los mensajes enviados desde el formulario de contacto.</p>
</div>

<div class="admin-card">
    <h3 style="margin: 0 0 15px 0; color: var(--primary-color);">Bandeja de Entrada</h3>
    <table style="width:100%; border-collapse: collapse;">
        <thead>
            <tr style="background: var(--bg-light);">
                <th style="padding: 10px; text-align: left;">#</th>
                <th style="padding: 10px; text-align: left;">Nombre</th>
                <th style="padding: 10px; text-align: left;">Email</th>
                <th style="padding: 10px; text-align: left;">Asunto</th>
                <th style="padding: 10px; text-align: left;">Mensaje</th>
                <th style="padding: 10px; text-align: left;">Estado</th>
                <th style="padding: 10px; text-align: left;">Fecha</th>
                <th style="padding: 10px; text-align: left;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $msg)
            <tr style="border-bottom: 1px solid var(--border-color);">
                <td style="padding: 10px;">{{ $msg->id }}</td>
                <td style="padding: 10px;">{{ $msg->name }}</td>
                <td style="padding: 10px;">{{ $msg->email }}</td>
                <td style="padding: 10px;">{{ $msg->subject }}</td>
                <td style="padding: 10px; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $msg->message }}</td>
                <td style="padding: 10px;">
                    @if($msg->status === 'new')
                        <span style="background: var(--accent-color); color: white; padding: 2px 8px; border-radius: 15px; font-size: 0.9rem;">Nuevo</span>
                    @elseif($msg->status === 'read')
                        <span style="background: var(--warning-color); color: white; padding: 2px 8px; border-radius: 15px; font-size: 0.9rem;">Leído</span>
                    @else
                        <span style="background: var(--success-color); color: white; padding: 2px 8px; border-radius: 15px; font-size: 0.9rem;">Respondido</span>
                    @endif
                </td>
                <td style="padding: 10px;">{{ \Carbon\Carbon::parse($msg->created_at)->format('d/m/Y H:i') }}</td>
                <td style="padding: 10px;">
                    <button onclick="viewMessage({{ $msg->id }})" style="background: var(--primary-color); color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; margin-right: 5px; font-size: 0.8rem;">
                        👁️ Ver
                    </button>
                    <button onclick="markAsRead({{ $msg->id }})" style="background: var(--warning-color); color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; margin-right: 5px; font-size: 0.8rem;">
                        ✓ Leído
                    </button>
                    <button onclick="replyMessage('{{ $msg->email }}')" style="background: var(--success-color); color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; font-size: 0.8rem;">
                        📧 Responder
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 20px;">
        {{ $messages->links() }}
    </div>
</div>

<!-- Modal para ver mensaje completo -->
<div id="messageModal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
    <div style="background-color: white; margin: 5% auto; padding: 20px; border-radius: 10px; width: 80%; max-width: 600px;">
        <span onclick="closeModal()" style="color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
        <h3 id="modalTitle">Detalles del Mensaje</h3>
        <div id="modalContent"></div>
    </div>
</div>

<script>
function viewMessage(id) {
    // Aquí podrías hacer una petición AJAX para obtener los detalles del mensaje
    // Por ahora simulamos con datos
    document.getElementById('modalTitle').textContent = 'Mensaje #' + id;
    document.getElementById('modalContent').innerHTML = `
        <p><strong>Nombre:</strong> Usuario Ejemplo</p>
        <p><strong>Email:</strong> usuario@ejemplo.com</p>
        <p><strong>Asunto:</strong> Consulta sobre programación</p>
        <p><strong>Mensaje:</strong></p>
        <div style="background: #f5f5f5; padding: 10px; border-radius: 5px; margin: 10px 0;">
            Hola, me gustaría saber más sobre la programación de la radio...
        </div>
        <p><strong>Fecha:</strong> ${new Date().toLocaleDateString()}</p>
    `;
    document.getElementById('messageModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('messageModal').style.display = 'none';
}

function markAsRead(id) {
    if (confirm('¿Marcar mensaje #' + id + ' como leído?')) {
        // Aquí harías una petición AJAX para actualizar el estado
        alert('Mensaje marcado como leído');
        location.reload();
    }
}

function replyMessage(email) {
    // Abrir cliente de email predeterminado
    window.open('mailto:' + email + '?subject=Respuesta desde Radio Stereo Umachiri', '_blank');
}

// Cerrar modal al hacer clic fuera
window.onclick = function(event) {
    var modal = document.getElementById('messageModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>
@endsection