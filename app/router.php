<?php
/**
 * Router
 * Sistema de enrutamiento para mapear URLs a controladores y métodos
 */

class Router {
    private $controllerName = 'HomeController';
    private $methodName = 'index';
    private $params = [];

    /**
     * Constructor
     */
    public function __construct() {
        // Obtener la URL de la petición
        $url = $this->getUrl();

        // Procesar la URI
        if (!empty($url)) {
            $url = $this->processUrl($url);
            
            // Establecer el controlador (se convierte a formato PascalCase con primera letra mayúscula)
            if (!empty($url[0])) {
                $this->controllerName = ucfirst($url[0]) . 'Controller';
                unset($url[0]);
            }
            
            // Establecer el método
            if (!empty($url[1])) {
                $this->methodName = $url[1];
                unset($url[1]);
            }
            
            // Obtener parámetros
            $this->params = $url ? array_values($url) : [];
        }

        // Verificar si el controlador existe
        $controllerFile = APP_PATH . '/controllers/' . $this->controllerName . '.php';
        
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
        } else {
            // Si no existe el controlador, usar HomeController
            $this->controllerName = 'HomeController';
            require_once APP_PATH . '/controllers/' . $this->controllerName . '.php';
        }

        // Instanciar el controlador
        $controller = new $this->controllerName();

        // Verificar si el método existe
        if (method_exists($controller, $this->methodName)) {
            // Llamar al controlador con los parámetros
            call_user_func_array([$controller, $this->methodName], $this->params);
        } else {
            // Si el método no existe, usar el método index
            $controller->index();
        }
    }

    /**
     * Obtener y procesar la URL
     */
    private function getUrl() {
        $url = '';
        
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = $_SERVER['REQUEST_URI'];
            
            // Eliminar directorios base para obtener solo la ruta relevante
            $url = str_replace('/textilpxm/public', '', $url);
            
            // Eliminar query parameters
            $url = strtok($url, '?');
            
            // Eliminar barras diagonales finales
            $url = rtrim($url, '/');
            
            // Si está vacío, usar '/' para el home
            $url = $url === '' ? '/' : $url;
        }

        return $url;
    }

    /**
     * Procesar y dividir la URL en partes
     */
    private function processUrl($url) {
        if ($url === '/') {
            return [];
        }
        return explode('/', filter_var($url, FILTER_SANITIZE_URL));
    }
}