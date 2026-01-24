<?php
/**
 * Controlador Home
 * Gestiona la página principal del sitio
 */

class HomeController extends Controller {
    private $userModel;
    private $page_title = 'Inicio';

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
    }

    /**
     * Página principal - Vista Home
     */
    public function index() {
        // Obtener estadísticas básicas
        $stats = [
            'users_count' => $this->userModel->countAll() ?? 0
        ];

        $data = [
            'page_title' => $this->page_title,
            'stats' => $stats
        ];

        // Obtener mensaje flash si existe
        $flash = $this->getFlashMessage();
        if ($flash) {
            $data['flash_message'] = $flash['message'];
            $data['flash_type'] = $flash['type'];
        }

        $this->render('home/index', $data);
    }

    /**
     * Página de inicio de sesión
     */
    public function login() {
        // Si ya está autenticado, redirigir al home
        if ($this->isAuthenticated()) {
            $this->redirect('/');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $this->redirectWithMessage('/', 'Por favor completa todos los campos', 'danger');
                return;
            }

            // Aquí implementarías la lógica de autenticación
            // Por ahora, simulamos un login exitoso
            $_SESSION['user_id'] = 1; // Simular usuario autenticado
            $this->redirectWithMessage('/', '¡Bienvenido! Has iniciado sesión correctamente', 'success');
            return;
        }

        $this->render('login', ['page_title' => 'Iniciar Sesión']);
    }

    /**
     * Página de registro
     */
    public function register() {
        // Si ya está autenticado, redirigir al home
        if ($this->isAuthenticated()) {
            $this->redirect('/');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? ''
            ];

            // Validar datos
            if (empty($data['nombre']) || empty($data['email']) || empty($data['password'])) {
                $this->redirectWithMessage('/register', 'Por favor completa todos los campos', 'danger');
                return;
            }

            // Verificar si el email ya existe
            $existingUser = $this->userModel->getByEmail($data['email']);
            if ($existingUser) {
                $this->redirectWithMessage('/register', 'El email ya está registrado', 'danger');
                return;
            }

            // Crear usuario
            try {
                $userId = $this->userModel->create($data);
                if ($userId) {
                    $this->redirectWithMessage('/login', '¡Cuenta creada exitosamente! Ahora puedes iniciar sesión', 'success');
                    return;
                }
            } catch (Exception $e) {
                $this->redirectWithMessage('/register', 'Error al crear la cuenta. Por favor intenta nuevamente', 'danger');
                return;
            }
        }

        $this->render('register', ['page_title' => 'Crear Cuenta']);
    }

    /**
     * Cerrar sesión
     */
    public function logout() {
        session_unset();
        session_destroy();
        $this->redirectWithMessage('/', 'Has cerrado sesión correctamente', 'success');
    }

    /**
     * Página "Sobre Nosotros"
     */
    public function about() {
        $this->render('about', ['page_title' => 'Sobre Nosotros']);
    }

    /**
     * Página de Contacto
     */
    public function contact() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';

            if (empty($name) || empty($email) || empty($message)) {
                $this->redirectWithMessage('/contact', 'Por favor completa todos los campos', 'danger');
                return;
            }

            // Aquí enviarías el email
            $this->redirectWithMessage('/contact', '¡Mensaje enviado correctamente! Te responderemos pronto', 'success');
            return;
        }

        $this->render('contact', ['page_title' => 'Contacto']);
    }
}