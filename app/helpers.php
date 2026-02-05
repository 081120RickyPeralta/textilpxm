<?php
/**
 * Funciones Helper
 * Funciones auxiliares para uso en vistas y controladores
 */

/**
 * Cargar contenido desde código PHP (app/content_data.php)
 * @param string $filename Clave del contenido: navbar, footer, meta, home, categorias, ordenar
 * @return array|false Array con los datos o false si no existe
 */
function loadContent($filename) {
    static $contentData = null;
    if ($contentData === null) {
        $filePath = APP_PATH . '/content_data.php';
        if (!file_exists($filePath)) {
            return false;
        }
        $contentData = require $filePath;
    }
    return isset($contentData[$filename]) ? $contentData[$filename] : false;
}

/**
 * Restaurar sesión de administrador desde cookie "recordarme"
 * Solo restaura si el token es válido y el usuario tiene rol admin
 */
function restoreAdminSessionFromCookie() {
    if (!defined('REMEMBER_ME_COOKIE') || !defined('REMEMBER_ME_SECRET')) {
        return;
    }
    $cookie = $_COOKIE[REMEMBER_ME_COOKIE] ?? '';
    if ($cookie === '') {
        return;
    }
    $parts = explode('|', $cookie);
    if (count($parts) !== 3) {
        setcookie(REMEMBER_ME_COOKIE, '', time() - 3600, '/');
        return;
    }
    list($userId, $expiry, $mac) = $parts;
    if ($expiry < time()) {
        setcookie(REMEMBER_ME_COOKIE, '', time() - 3600, '/');
        return;
    }
    $expected = hash_hmac('sha256', $userId . '|' . $expiry, REMEMBER_ME_SECRET);
    if (!hash_equals($expected, $mac)) {
        setcookie(REMEMBER_ME_COOKIE, '', time() - 3600, '/');
        return;
    }
    $user = (new User())->getById($userId);
    if (!$user || ($user['rol'] ?? '') !== 'admin') {
        setcookie(REMEMBER_ME_COOKIE, '', time() - 3600, '/');
        return;
    }
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['nombre'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_rol'] = $user['rol'];
}

/**
 * Obtener un valor anidado de un array usando notación de punto
 * @param array $data Array de datos
 * @param string $key Clave en notación de punto (ej: "menu.inicio")
 * @param mixed $default Valor por defecto si no se encuentra
 * @return mixed
 */
function getContent($data, $key, $default = '') {
    if ($data === false) {
        return $default;
    }
    
    $keys = explode('.', $key);
    $value = $data;
    
    foreach ($keys as $k) {
        if (!isset($value[$k])) {
            return $default;
        }
        $value = $value[$k];
    }
    
    return $value;
}
