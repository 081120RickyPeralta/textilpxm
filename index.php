<?php
/**
 * index.php - Redirección desde la raíz del proyecto
 * Redirige a /public/#inicio
 */

// Obtener el protocolo (http o https)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

// Obtener el host
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';

// Obtener la ruta base del proyecto
$scriptPath = dirname($_SERVER['SCRIPT_NAME']);

// Construir la URL base
$baseUrl = $protocol . '://' . $host . $scriptPath;

// Eliminar la barra final si existe
$baseUrl = rtrim($baseUrl, '/');

// Redirigir a /public/#inicio
header("Location: " . $baseUrl . "/public");
exit;
