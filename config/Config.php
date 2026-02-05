<?php
/**
 * Configuración Principal del Sitio
 * Definiciones globales del proyecto
 */

// Definir constantes del sistema
define('PROJECT_NAME', 'TextilPXM');
define('PROJECT_VERSION', '1.0.0');

// Configuración de rutas
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('DATA_PATH', ROOT_PATH . '/data');

// Configuración de URLs - Detección automática
// Obtener el protocolo (http o https)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

// Obtener el host
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';

// Obtener la ruta del script actual (index.php)
$scriptPath = dirname($_SERVER['SCRIPT_NAME']);

// Construir BASE_URL automáticamente
$baseUrl = $protocol . '://' . $host . $scriptPath;

// Eliminar la barra final si existe
$baseUrl = rtrim($baseUrl, '/');

define('BASE_URL', $baseUrl);
define('ASSETS_URL', BASE_URL);

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'textilpxm_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configuración del sitio
define('SITE_NAME', 'TextilPXM');
define('SITE_DESCRIPTION', 'Sistema de gestión textil');
define('SITE_EMAIL', 'info@textilpxm.com');

// Configuración de la sesión
define('SESSION_NAME', 'TEXTILPXM_SESSION');
define('SESSION_LIFETIME', 86400); // 24 horas

// Cookie "Recordarme" para administradores (solo /admin)
define('REMEMBER_ME_COOKIE', 'TEXTILPXM_ADMIN_REMEMBER');
define('REMEMBER_ME_SECRET', 'textilpxm_remember_secret_' . PROJECT_NAME);
define('REMEMBER_ME_DAYS', 14);

// Configuración de errores (descomentar en desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Zona horaria
date_default_timezone_set('America/Lima');

// Iniciar sesión
session_name(SESSION_NAME);
session_start();

// Incluir helpers
require_once APP_PATH . '/helpers.php';

// Autoload de clases
spl_autoload_register(function($class) {
    $paths = [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
        APP_PATH . '/views/',
        APP_PATH . '/', // Para Router y otras clases en la raíz de app
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Restaurar sesión de admin desde cookie "recordarme"
if (empty($_SESSION['user_id']) && !empty($_COOKIE[REMEMBER_ME_COOKIE])) {
    restoreAdminSessionFromCookie();
}