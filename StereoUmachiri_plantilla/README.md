# Radio Stereo Umachiri - Sistema Web Profesional

## 📻 Descripción

Sistema web profesional para Radio Stereo Umachiri - 98.5 FM, ubicada en Umachiri, Melgar, Puno, Perú. El sitio web incluye un reproductor de radio en vivo, información de la emisora, programación, galería de fotos y formulario de contacto.

## ✨ Características

### 🎵 Reproductor de Radio en Vivo
- Controles de reproducción/pausa
- Control de volumen
- Indicador de estado en vivo
- Notificaciones de estado
- Atajos de teclado (Espacio para play/pause, M para mute)

### 📱 Diseño Responsivo
- Optimizado para móviles, tablets y desktop
- Navegación adaptativa
- Menú hamburguesa para dispositivos móviles
- Soporte para modo oscuro

### 🎨 Diseño Moderno
- Gradientes y efectos visuales atractivos
- Animaciones suaves
- Iconografía Font Awesome
- Tipografía Google Fonts (Poppins)

### 📊 Secciones Principales
- **Inicio**: Hero section con reproductor
- **Nosotros**: Información de la emisora
- **Programación**: Horarios y programas
- **Galería**: Fotos de la radio
- **Contacto**: Formulario e información de contacto

## 🚀 Instalación

### Requisitos
- Servidor web (Apache, Nginx, etc.)
- Navegador web moderno
- Conexión a internet para recursos externos

### Pasos de Instalación

1. **Clonar o descargar el proyecto**
   ```bash
   git clone [url-del-repositorio]
   cd StereoUmachiri
   ```

2. **Configurar el servidor web**
   - Colocar los archivos en el directorio web del servidor
   - Asegurar que el servidor soporte archivos estáticos

3. **Configurar la URL del stream de radio**
   - Editar `assets/js/player.js`
   - Reemplazar `'https://stream.example.com/radio.mp3'` con la URL real del stream

4. **Personalizar contenido**
   - Editar `index.html` para actualizar información
   - Reemplazar imágenes en `assets/images/`
   - Actualizar información de contacto

## 📁 Estructura del Proyecto

```
StereoUmachiri/
├── index.html                 # Página principal
├── assets/
│   ├── css/
│   │   ├── style.css         # Estilos principales
│   │   └── responsive.css    # Estilos responsivos
│   ├── js/
│   │   ├── main.js          # JavaScript principal
│   │   └── player.js        # Reproductor de radio
│   └── images/
│       ├── logo.png         # Logo de la radio
│       ├── favicon.ico      # Favicon
│       ├── radio-studio.jpg # Imagen del estudio
│       └── gallery/         # Imágenes de la galería
└── README.md                # Este archivo
```

## ⚙️ Configuración

### Configurar Stream de Radio

1. **Obtener URL del stream**
   - Contactar al proveedor de streaming
   - Obtener URL del stream (formato MP3, AAC, OGG)

2. **Actualizar en player.js**
   ```javascript
   // En assets/js/player.js, línea ~50
   const streamUrls = [
       'https://tu-stream-url.com/radio.mp3',  // Reemplazar con URL real
       'https://backup-stream-url.com/radio.ogg'
   ];
   ```

### Personalizar Información

1. **Datos de la emisora** (en `index.html`)
   - Nombre de la radio
   - Frecuencia
   - Ubicación
   - Teléfono
   - Email

2. **Programación** (en `index.html`)
   - Horarios de programas
   - Nombres de conductores
   - Descripción de programas

3. **Redes sociales** (en `index.html`)
   - Enlaces a Facebook, Instagram, YouTube, Twitter

### Agregar Imágenes

1. **Logo**: Reemplazar `assets/images/logo.png`
2. **Favicon**: Reemplazar `assets/images/favicon.ico`
3. **Imagen del estudio**: Reemplazar `assets/images/radio-studio.jpg`
4. **Galería**: Agregar imágenes en `assets/images/gallery/`

## 🎨 Personalización

### Colores del Tema

Los colores principales están definidos en `assets/css/style.css`:

```css
/* Colores principales */
--primary-color: #667eea;
--secondary-color: #764ba2;
--accent-color: #ffd700;
--text-color: #333;
--background-color: #f8f9fa;
```

### Tipografía

El sitio usa Google Fonts - Poppins:
```html
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
```

### Iconos

Se usa Font Awesome 6.4.0:
```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
```

## 📱 Funcionalidades

### Reproductor de Radio

- **Controles**: Play/Pause, volumen
- **Atajos de teclado**:
  - `Espacio`: Play/Pause
  - `Ctrl + ↑/↓`: Subir/bajar volumen
  - `M`: Mute/Unmute
- **Estado**: Indicador visual de conexión
- **Notificaciones**: Estado de conexión y errores

### Navegación

- **Menú fijo**: Siempre visible en la parte superior
- **Scroll suave**: Navegación entre secciones
- **Responsivo**: Menú hamburguesa en móviles

### Formulario de Contacto

- **Validación**: Campos requeridos y formato de email
- **Notificaciones**: Feedback visual al usuario
- **Envío**: Simulado (configurar backend real)

### Galería

- **Lightbox**: Visualización ampliada de imágenes
- **Hover effects**: Efectos al pasar el mouse
- **Responsivo**: Adaptación a diferentes tamaños

## 🔧 Mantenimiento

### Actualizar Contenido

1. **Programación**: Editar sección en `index.html`
2. **Galería**: Agregar imágenes en `assets/images/gallery/`
3. **Información de contacto**: Actualizar en `index.html`

### Monitoreo

- **Analytics**: El sitio incluye tracking básico
- **Errores**: Revisar consola del navegador
- **Performance**: Optimización de imágenes y recursos

## 🌐 SEO y Optimización

### Meta Tags

```html
<meta name="description" content="Radio Stereo Umachiri en vivo por Internet. Emisora peruana que transmite desde el distrito de Umachiri, provincia Melgar, Puno.">
<meta name="keywords" content="radio, umachiri, puno, melgar, 98.5 fm, peru, en vivo">
```

### Performance

- **Lazy loading**: Imágenes cargan bajo demanda
- **Minificación**: CSS y JS optimizados
- **CDN**: Font Awesome y Google Fonts desde CDN

### Accesibilidad

- **ARIA labels**: Etiquetas para lectores de pantalla
- **Focus indicators**: Indicadores de foco visibles
- **Keyboard navigation**: Navegación completa por teclado

## 📞 Soporte

### Información de Contacto

- **Radio**: +51 951 391 524
- **Email**: info@radiostereoumachiri.com
- **Ubicación**: Umachiri, Melgar, Puno, Perú
- **Frecuencia**: 98.5 FM

### Redes Sociales

- **Facebook**: [facebook.com/StereoUmachiri](https://www.facebook.com/StereoUmachiri/)
- **Instagram**: [@radiostereoumachiri](https://instagram.com/radiostereoumachiri)
- **YouTube**: [Radio Stereo Umachiri](https://youtube.com/@radiostereoumachiri)
- **Twitter**: [@RadioUmachiri](https://twitter.com/RadioUmachiri)

## 📄 Licencia

Este proyecto está desarrollado para Radio Stereo Umachiri. Todos los derechos reservados.

## 🤝 Contribuciones

Para contribuir al proyecto:

1. Fork el repositorio
2. Crear una rama para tu feature
3. Commit tus cambios
4. Push a la rama
5. Crear un Pull Request

## 📝 Changelog

### v1.0.0 (2024-01-08)
- ✅ Sitio web inicial
- ✅ Reproductor de radio funcional
- ✅ Diseño responsivo
- ✅ Formulario de contacto
- ✅ Galería de fotos
- ✅ SEO optimizado

---

**Desarrollado con ❤️ para Radio Stereo Umachiri**

*"Llegando a tu corazón y más allá de tu imaginación"* 