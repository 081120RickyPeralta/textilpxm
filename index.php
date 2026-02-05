<?php
/**
 * index.php - Redirección desde la raíz del proyecto
 * Redirige a public/ (o public/admin, etc.) usando ruta relativa para evitar
 * que SCRIPT_NAME sea ruta de disco (ej. C:/xampp/htdocs/...) y rompa la URL.
 */
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestUri = strtok($requestUri, '?');
$requestUri = trim($requestUri, '/');

// Quitar el segmento "textilpxm" si está al inicio (ruta base del proyecto en la URL)
$parts = explode('/', $requestUri);
if ($parts[0] === 'textilpxm') {
    array_shift($parts);
}
$path = implode('/', $parts);
if ($path === '' || $path === 'index.php') {
    $path = '';
} else {
    $path = '/' . $path;
}

header('Location: public' . $path);
exit;
