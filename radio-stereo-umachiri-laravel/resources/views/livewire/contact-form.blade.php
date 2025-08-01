<div class="contact-form">
    @if($success)
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ $success ? '¡Mensaje enviado correctamente! Nos pondremos en contacto contigo pronto.' : '' }}</span>
        </div>
    @endif

    @if($error)
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $error }}</span>
        </div>
    @endif

    <form wire:submit="submit">
        <div class="form-group">
            <label for="name">Nombre *</label>
            <input type="text" id="name" wire:model="name" placeholder="Tu nombre completo">
            @error('name') <span class="error-message">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" wire:model="email" placeholder="tu@email.com">
            @error('email') <span class="error-message">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="subject">Asunto *</label>
            <input type="text" id="subject" wire:model="subject" placeholder="Asunto del mensaje">
            @error('subject') <span class="error-message">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="message">Mensaje *</label>
            <textarea id="message" wire:model="message" rows="5" placeholder="Escribe tu mensaje aquí..."></textarea>
            @error('message') <span class="error-message">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="submit-btn" wire:loading.attr="disabled">
            <span wire:loading.remove>Enviar Mensaje</span>
            <span wire:loading>Enviando...</span>
            <div wire:loading class="spinner"></div>
        </button>
    </form>
</div> 