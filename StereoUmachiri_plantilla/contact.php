<?php
/**
 * Radio Stereo Umachiri - Contact Form Handler
 * 
 * Este archivo procesa los envíos del formulario de contacto
 */

// Incluir configuración
require_once 'config.php';

// Verificar si es una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Verificar token CSRF
if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Token de seguridad inválido']);
    exit;
}

// Obtener y sanitizar datos del formulario
$name = sanitizeInput($_POST['name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$subject = sanitizeInput($_POST['subject'] ?? '');
$message = sanitizeInput($_POST['message'] ?? '');

// Validar campos requeridos
$errors = [];

if (empty($name)) {
    $errors[] = 'El nombre es requerido';
}

if (empty($email)) {
    $errors[] = 'El email es requerido';
} elseif (!validateEmail($email)) {
    $errors[] = 'El email no es válido';
}

if (empty($subject)) {
    $errors[] = 'El asunto es requerido';
}

if (empty($message)) {
    $errors[] = 'El mensaje es requerido';
}

// Si hay errores, devolver respuesta de error
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Por favor, corrige los siguientes errores:',
        'details' => $errors
    ]);
    exit;
}

// Verificar límites de longitud
if (strlen($name) > 100) {
    $errors[] = 'El nombre es demasiado largo';
}

if (strlen($email) > 255) {
    $errors[] = 'El email es demasiado largo';
}

if (strlen($subject) > 200) {
    $errors[] = 'El asunto es demasiado largo';
}

if (strlen($message) > 2000) {
    $errors[] = 'El mensaje es demasiado largo';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Los datos exceden los límites permitidos:',
        'details' => $errors
    ]);
    exit;
}

// Verificar spam básico
$spamIndicators = [
    'http://', 'https://', 'www.', '.com', '.org', '.net',
    'CLICK HERE', 'FREE', 'MONEY', 'WIN', 'PRIZE'
];

$messageLower = strtolower($message);
$spamScore = 0;

foreach ($spamIndicators as $indicator) {
    if (strpos($messageLower, strtolower($indicator)) !== false) {
        $spamScore++;
    }
}

// Si hay muchos indicadores de spam, rechazar
if ($spamScore > 3) {
    http_response_code(400);
    echo json_encode(['error' => 'El mensaje parece ser spam']);
    exit;
}

// Verificar límite de envíos por IP
$clientIP = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$contactLogFile = __DIR__ . '/logs/contact_log.txt';

// Crear directorio de logs si no existe
if (!is_dir(__DIR__ . '/logs')) {
    mkdir(__DIR__ . '/logs', 0755, true);
}

// Verificar envíos recientes desde la misma IP
$recentContacts = 0;
if (file_exists($contactLogFile)) {
    $logContent = file_get_contents($contactLogFile);
    $lines = explode("\n", $logContent);
    
    foreach ($lines as $line) {
        if (empty(trim($line))) continue;
        
        $logData = json_decode($line, true);
        if ($logData && $logData['ip'] === $clientIP) {
            $contactTime = strtotime($logData['timestamp']);
            if (time() - $contactTime < 3600) { // 1 hora
                $recentContacts++;
            }
        }
    }
}

// Limitar a 3 envíos por hora por IP
if ($recentContacts >= 3) {
    http_response_code(429);
    echo json_encode(['error' => 'Has enviado demasiados mensajes. Intenta de nuevo en una hora.']);
    exit;
}

// Intentar enviar el email
try {
    $emailSent = sendContactEmail($name, $email, $subject, $message);
    
    if ($emailSent) {
        // Registrar el contacto exitoso
        $contactData = [
            'timestamp' => date('Y-m-d H:i:s'),
            'ip' => $clientIP,
            'name' => $name,
            'email' => $email,
            'subject' => $subject
        ];
        
        file_put_contents($contactLogFile, json_encode($contactData) . "\n", FILE_APPEND | LOCK_EX);
        
        // Registrar evento de analytics
        trackEvent('contact', 'form_submit', 'success');
        
        // Enviar respuesta de éxito
        echo json_encode([
            'success' => true,
            'message' => '¡Mensaje enviado con éxito! Te contactaremos pronto.'
        ]);
        
    } else {
        throw new Exception('Error al enviar el email');
    }
    
} catch (Exception $e) {
    // Log del error
    error_log("Contact form error: " . $e->getMessage());
    
    // Registrar evento de analytics
    trackEvent('contact', 'form_submit', 'error');
    
    // Enviar respuesta de error
    http_response_code(500);
    echo json_encode([
        'error' => 'Error al enviar el mensaje. Por favor, intenta de nuevo más tarde.'
    ]);
}

// Función para enviar email usando SMTP (alternativa a mail())
function sendEmailSMTP($to, $subject, $body, $from, $fromName) {
    // Esta función requiere PHPMailer o similar
    // Por ahora usamos la función mail() básica
    
    $headers = "From: $fromName <$from>\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "X-Mailer: Radio Stereo Umachiri Contact Form\r\n";
    
    return mail($to, $subject, $body, $headers);
}

// Función para verificar si el email se envió correctamente
function verifyEmailSent($to, $subject) {
    // En un entorno real, podrías verificar el estado del envío
    // Por ahora, asumimos que se envió correctamente
    return true;
}

// Función para generar respuesta personalizada
function generateAutoReply($name) {
    return "
    <html>
    <head>
        <title>Gracias por contactarnos</title>
    </head>
    <body>
        <h2>¡Hola $name!</h2>
        <p>Gracias por contactar con Radio Stereo Umachiri.</p>
        <p>Hemos recibido tu mensaje y te responderemos lo antes posible.</p>
        <p>Mientras tanto, puedes:</p>
        <ul>
            <li>Escuchar nuestra radio en vivo en nuestro sitio web</li>
            <li>Seguirnos en nuestras redes sociales</li>
            <li>Conocer nuestra programación</li>
        </ul>
        <p>¡Saludos desde Umachiri, Melgar, Puno!</p>
        <p><strong>Radio Stereo Umachiri</strong><br>
        98.5 FM - Llegando a tu corazón y más allá de tu imaginación</p>
    </body>
    </html>
    ";
}

?> 