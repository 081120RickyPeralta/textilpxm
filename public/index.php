<?php
/**
 * index.php - Punto de entrada principal de la aplicación
 * Todas las solicitudes pasan por este archivo
 */

// Cargar configuración
require_once __DIR__ . '/../config/Config.php';

// Cargar el Router
require_once APP_PATH . '/router.php';

// Iniciar el Router
$router = new Router();