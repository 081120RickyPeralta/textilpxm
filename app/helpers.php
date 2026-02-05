<?php
/**
 * Funciones Helper
 * Funciones auxiliares para uso en vistas y controladores
 */

/**
 * Cargar contenido: primero desde BD (site_content), luego fallback a content_data.php
 * @param string $filename Clave del contenido: navbar, footer, meta, home
 * @return array|false Array con los datos o false si no existe
 */
function loadContent($filename) {
    static $fromDb = null;
    if ($fromDb === null) {
        try {
            $model = new SiteContent();
            $fromDb = $model->getNested();
        } catch (Throwable $e) {
            $fromDb = [];
        }
    }
    if (!empty($fromDb[$filename])) {
        return $fromDb[$filename];
    }
    $filePath = APP_PATH . '/content_data.php';
    if (!file_exists($filePath)) {
        return false;
    }
    $contentData = require $filePath;
    return isset($contentData[$filename]) ? $contentData[$filename] : false;
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

/**
 * URL completa para la imagen de un producto.
 * Si imagen_url es ruta local (ej. productos/1.jpg), devuelve ASSETS_URL/images/...
 * Si es URL externa (http...), la devuelve tal cual.
 * @param string $imagen_url Valor de producto['imagen_url']
 * @param string $default URL por defecto si está vacío
 * @return string
 */
function productImageUrl($imagen_url, $default = '') {
    $imagen_url = trim($imagen_url ?? '');
    if ($imagen_url === '') {
        return $default !== '' ? $default : (ASSETS_URL . '/images/productos/placeholder.svg');
    }
    if (preg_match('#^https?://#i', $imagen_url)) {
        return $imagen_url;
    }
    return ASSETS_URL . '/images/' . $imagen_url;
}
