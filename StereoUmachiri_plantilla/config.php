<?php
/**
 * Radio Stereo Umachiri - Configuration File
 * 
 * Este archivo contiene la configuración principal del sistema web
 * para Radio Stereo Umachiri.
 */

// ===== CONFIGURACIÓN GENERAL =====

// Información de la emisora
define('RADIO_NAME', 'Radio Stereo Umachiri');
define('RADIO_FREQUENCY', '98.5 FM');
define('RADIO_LOCATION', 'Umachiri, Melgar, Puno, Perú');
define('RADIO_PHONE', '+51 951 391 524');
define('RADIO_EMAIL', 'info@radiostereoumachiri.com');
define('RADIO_SLOGAN', 'Llegando a tu corazón y más allá de tu imaginación');

// URLs del stream de radio
define('STREAM_URL_PRIMARY', 'https://stream.example.com/radio.mp3');
define('STREAM_URL_BACKUP', 'https://backup-stream.example.com/radio.ogg');

// Configuración del sitio
define('SITE_URL', 'https://radiostereoumachiri.com');
define('SITE_TITLE', 'Radio Stereo Umachiri - 98.5 FM - Melgar, Puno');
define('SITE_DESCRIPTION', 'Radio Stereo Umachiri en vivo por Internet. Emisora peruana que transmite desde el distrito de Umachiri, provincia Melgar, Puno.');
define('SITE_KEYWORDS', 'radio, umachiri, puno, melgar, 98.5 fm, peru, en vivo');

// Redes sociales
define('FACEBOOK_URL', 'https://www.facebook.com/StereoUmachiri/');
define('INSTAGRAM_URL', 'https://instagram.com/radiostereoumachiri');
define('YOUTUBE_URL', 'https://youtube.com/@radiostereoumachiri');
define('TWITTER_URL', 'https://twitter.com/RadioUmachiri');

// ===== CONFIGURACIÓN DE BASE DE DATOS (OPCIONAL) =====

// Si planeas usar una base de datos para el blog o noticias
define('DB_HOST', 'localhost');
define('DB_NAME', 'radio_umachiri');
define('DB_USER', 'radio_user');
define('DB_PASS', 'tu_password_seguro');
define('DB_CHARSET', 'utf8mb4');

// ===== CONFIGURACIÓN DE EMAIL =====

// Para el formulario de contacto
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'tu_email@gmail.com');
define('SMTP_PASS', 'tu_password_app');
define('SMTP_SECURE', 'tls');

// Email de destino para contactos
define('CONTACT_EMAIL', 'contacto@radiostereoumachiri.com');

// ===== CONFIGURACIÓN DE ANALYTICS =====

// Google Analytics (opcional)
define('GA_TRACKING_ID', 'G-XXXXXXXXXX');

// ===== CONFIGURACIÓN DE SEGURIDAD =====

// Clave secreta para tokens CSRF
define('CSRF_SECRET', 'tu_clave_secreta_muy_larga_y_compleja');

// Configuración de sesiones
define('SESSION_LIFETIME', 3600); // 1 hora
define('SESSION_NAME', 'radio_umachiri_session');

// ===== FUNCIONES DE UTILIDAD =====

/**
 * Obtiene la configuración de la emisora
 */
function getRadioConfig() {
    return [
        'name' => RADIO_NAME,
        'frequency' => RADIO_FREQUENCY,
        'location' => RADIO_LOCATION,
        'phone' => RADIO_PHONE,
        'email' => RADIO_EMAIL,
        'slogan' => RADIO_SLOGAN
    ];
}

/**
 * Obtiene las URLs de stream
 */
function getStreamUrls() {
    return [
        'primary' => STREAM_URL_PRIMARY,
        'backup' => STREAM_URL_BACKUP
    ];
}

/**
 * Obtiene las redes sociales
 */
function getSocialMedia() {
    return [
        'facebook' => FACEBOOK_URL,
        'instagram' => INSTAGRAM_URL,
        'youtube' => YOUTUBE_URL,
        'twitter' => TWITTER_URL
    ];
}

/**
 * Valida una dirección de email
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Sanitiza datos de entrada
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Genera un token CSRF
 */
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Valida un token CSRF
 */
function validateCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Envía un email de contacto
 */
function sendContactEmail($name, $email, $subject, $message) {
    $to = CONTACT_EMAIL;
    $subject = "Nuevo mensaje de contacto - $subject";
    
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    $body = "
    <html>
    <head>
        <title>Nuevo mensaje de contacto</title>
    </head>
    <body>
        <h2>Nuevo mensaje de contacto</h2>
        <p><strong>Nombre:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Asunto:</strong> $subject</p>
        <p><strong>Mensaje:</strong></p>
        <p>" . nl2br($message) . "</p>
        <hr>
        <p><small>Enviado desde el formulario de contacto de Radio Stereo Umachiri</small></p>
    </body>
    </html>
    ";
    
    return mail($to, $subject, $body, $headers);
}

/**
 * Registra un evento de analytics
 */
function trackEvent($category, $action, $label = '') {
    // Aquí puedes implementar el tracking de eventos
    // Por ejemplo, enviar a Google Analytics
    $event = [
        'category' => $category,
        'action' => $action,
        'label' => $label,
        'timestamp' => date('Y-m-d H:i:s'),
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
    ];
    
    // Log del evento (opcional)
    error_log("Event: " . json_encode($event));
    
    return $event;
}

/**
 * Obtiene la información del cliente
 */
function getClientInfo() {
    return [
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
        'referer' => $_SERVER['HTTP_REFERER'] ?? '',
        'language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'unknown'
    ];
}

/**
 * Verifica si el sitio está en modo mantenimiento
 */
function isMaintenanceMode() {
    return file_exists(__DIR__ . '/maintenance.flag');
}

/**
 * Activa el modo mantenimiento
 */
function enableMaintenanceMode() {
    file_put_contents(__DIR__ . '/maintenance.flag', date('Y-m-d H:i:s'));
}

/**
 * Desactiva el modo mantenimiento
 */
function disableMaintenanceMode() {
    if (file_exists(__DIR__ . '/maintenance.flag')) {
        unlink(__DIR__ . '/maintenance.flag');
    }
}

// ===== CONFIGURACIÓN DE SESIÓN =====

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_set_cookie_params(SESSION_LIFETIME);
    session_start();
}

// ===== CONFIGURACIÓN DE ZONA HORARIA =====

// Configurar zona horaria para Perú
date_default_timezone_set('America/Lima');

// ===== CONFIGURACIÓN DE ERRORES =====

// En producción, ocultar errores
if (!defined('DEBUG_MODE') || !DEBUG_MODE) {
    error_reporting(0);
    ini_set('display_errors', 0);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// ===== HEADERS DE SEGURIDAD =====

// Headers de seguridad adicionales
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// ===== VERIFICACIÓN DE MANTENIMIENTO =====

// Si está en modo mantenimiento y no es admin, mostrar página de mantenimiento
if (isMaintenanceMode() && !isset($_GET['admin'])) {
    http_response_code(503);
    include __DIR__ . '/maintenance.html';
    exit;
}

?> 