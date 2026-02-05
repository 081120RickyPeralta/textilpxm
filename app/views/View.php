<?php
/**
 * Clase View
 * Gestiona la carga y renderizado de vistas
 */

class View {
    /**
     * Renderizar una vista con layout
     * @param string $view Ruta de la vista (ej: home/index)
     * @param array $data Datos para la vista
     * @param string|null $layout Nombre del layout (main, admin) o null para sin layout
     */
    public function render($view, $data = [], $layout = 'main') {
        // Extraer datos a variables individuales
        extract($data);

        // Iniciar buffer de salida
        ob_start();

        // Incluir la vista específica
        $viewFile = APP_PATH . '/views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
            $content = ob_get_clean();

            if ($layout === null) {
                echo $content;
                return;
            }

            // Incluir el layout
            $layoutFile = APP_PATH . '/views/layouts/' . $layout . '.php';
            if (file_exists($layoutFile)) {
                require_once $layoutFile;
            } else {
                echo $content;
            }
        } else {
            echo "Vista no encontrada: " . $view;
        }
    }

    /**
     * Renderizar solo el contenido sin layout (para AJAX)
     */
    public function renderPartial($view, $data = []) {
        extract($data);
        $viewFile = APP_PATH . '/views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            echo "Vista no encontrada: " . $view;
        }
    }
}