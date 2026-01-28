<?php
/**
 * Funciones Helper
 * Funciones auxiliares para uso en vistas y controladores
 */

/**
 * Cargar contenido desde un archivo JSON
 * @param string $filename Nombre del archivo JSON (sin extensión)
 * @return array|false Array con los datos o false si hay error
 */
function loadContent($filename) {
    $filePath = DATA_PATH . '/' . $filename . '.json';
    
    if (!file_exists($filePath)) {
        return false;
    }
    
    $content = file_get_contents($filePath);
    $data = json_decode($content, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        return false;
    }
    
    return $data;
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
