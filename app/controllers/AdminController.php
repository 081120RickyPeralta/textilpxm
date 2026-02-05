<?php
/**
 * Controlador de Administración
 * Login solo para rol admin. CRUD de productos. Sin enlace desde la página principal.
 * Acceso solo por URL: /admin, /admin/login, etc.
 */

class AdminController extends Controller {
    private $userModel;
    private $productModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
        $this->productModel = new Product();
    }

    /**
     * Comprobar que el usuario está logueado y es admin
     */
    private function requireAdmin() {
        if (empty($_SESSION['user_id']) || ($_SESSION['user_rol'] ?? '') !== 'admin') {
            $uri = $_SERVER['REQUEST_URI'] ?? '';
            $uri = strtok($uri, '?');
            $basePath = dirname($_SERVER['SCRIPT_NAME'] ?? '');
            if ($basePath !== '/' && $basePath !== '\\' && $basePath !== '.') {
                $uri = (strpos($uri, $basePath) === 0) ? substr($uri, strlen($basePath)) : '/admin';
            }
            $_SESSION['admin_redirect'] = $uri !== '' ? $uri : '/admin';
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }
    }

    /**
     * Login solo para administradores
     */
    public function login() {
        if (($this->isAuthenticated()) && ($_SESSION['user_rol'] ?? '') === 'admin') {
            $this->redirect(BASE_URL . '/admin');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $remember = isset($_POST['remember']);

            if ($email === '' || $password === '') {
                $this->render('admin/login', ['error' => 'Completa email y contraseña.', 'page_title' => 'Admin Login'], 'admin');
                return;
            }

            $user = $this->userModel->login($email, $password);
            if (!$user) {
                $this->render('admin/login', ['error' => 'Credenciales incorrectas.', 'page_title' => 'Admin Login'], 'admin');
                return;
            }
            if (($user['rol'] ?? '') !== 'admin') {
                $this->render('admin/login', ['error' => 'Acceso denegado. Solo administradores.', 'page_title' => 'Admin Login'], 'admin');
                return;
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_rol'] = $user['rol'];

            if ($remember && defined('REMEMBER_ME_COOKIE') && defined('REMEMBER_ME_SECRET') && defined('REMEMBER_ME_DAYS')) {
                $expiry = time() + (REMEMBER_ME_DAYS * 86400);
                $mac = hash_hmac('sha256', $user['id'] . '|' . $expiry, REMEMBER_ME_SECRET);
                $value = $user['id'] . '|' . $expiry . '|' . $mac;
                setcookie(REMEMBER_ME_COOKIE, $value, $expiry, '/', '', false, true);
            }

            $path = $_SESSION['admin_redirect'] ?? '/admin';
            unset($_SESSION['admin_redirect']);
            header('Location: ' . BASE_URL . $path);
            exit;
        }

        $this->render('admin/login', ['page_title' => 'Admin Login'], 'admin');
    }

    /**
     * Cerrar sesión y eliminar cookie recordarme
     */
    public function logout() {
        if (defined('REMEMBER_ME_COOKIE')) {
            setcookie(REMEMBER_ME_COOKIE, '', time() - 3600, '/', '', false, true);
        }
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . '/admin/login');
        exit;
    }

    /**
     * Listado de productos (CRUD)
     */
    public function index() {
        $this->requireAdmin();
        $products = $this->productModel->getAll();
        $flash = $this->getFlashMessage();
        $data = [
            'page_title' => 'Productos',
            'products' => $products ?: [],
            'flash_message' => $flash['message'] ?? null,
            'flash_type' => $flash['type'] ?? null,
        ];
        $this->render('admin/products/index', $data, 'admin');
    }

    /**
     * Formulario nuevo producto
     */
    public function crear() {
        $this->requireAdmin();
        $categories = $this->productModel->getCategoriesAll();
        $flash = $this->getFlashMessage();
        $data = [
            'page_title' => 'Nuevo producto',
            'product' => null,
            'categories' => $categories ?: [],
            'flash_message' => $flash['message'] ?? null,
            'flash_type' => $flash['type'] ?? null,
        ];
        $this->render('admin/products/form', $data, 'admin');
    }

    /**
     * Guardar nuevo producto
     */
    public function guardar() {
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . '/admin');
            return;
        }

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'categoria' => trim($_POST['categoria'] ?? ''),
            'precio' => (float) (str_replace(',', '.', $_POST['precio'] ?? 0)),
            'stock' => (int) ($_POST['stock'] ?? 0),
            'imagen_url' => trim($_POST['imagen_url'] ?? ''),
            'activo' => isset($_POST['activo']) ? 1 : 0,
            'portada' => isset($_POST['portada']) ? 1 : 0,
            'tallas_disponibles' => trim($_POST['tallas_disponibles'] ?? ''),
        ];

        if ($data['nombre'] === '') {
            $this->redirectWithMessage('/admin/crear', 'El nombre es obligatorio', 'danger');
            return;
        }
        if ($data['categoria'] === '') {
            $this->redirectWithMessage('/admin/crear', 'La categoría es obligatoria', 'danger');
            return;
        }
        if ($data['precio'] <= 0) {
            $this->redirectWithMessage('/admin/crear', 'El precio debe ser mayor que 0', 'danger');
            return;
        }

        try {
            $id = $this->productModel->create($data);
            if ($id) {
                $this->redirectWithMessage('/admin', 'Producto creado correctamente', 'success');
            } else {
                $this->redirectWithMessage('/admin/crear', 'Error al crear el producto', 'danger');
            }
        } catch (Exception $e) {
            $this->redirectWithMessage('/admin/crear', 'Error: ' . $e->getMessage(), 'danger');
        }
    }

    /**
     * Formulario editar producto
     */
    public function editar($id) {
        $this->requireAdmin();
        $id = (int) $id;
        if ($id <= 0) {
            $this->redirectWithMessage('/admin', 'ID no válido', 'danger');
            return;
        }
        $product = $this->productModel->getById($id);
        if (!$product) {
            $this->redirectWithMessage('/admin', 'Producto no encontrado', 'danger');
            return;
        }
        $categories = $this->productModel->getCategoriesAll();
        $flash = $this->getFlashMessage();
        $data = [
            'page_title' => 'Editar producto',
            'product' => $product,
            'categories' => $categories ?: [],
            'flash_message' => $flash['message'] ?? null,
            'flash_type' => $flash['type'] ?? null,
        ];
        $this->render('admin/products/form', $data, 'admin');
    }

    /**
     * Actualizar producto
     */
    public function actualizar($id) {
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(BASE_URL . '/admin');
            return;
        }
        $id = (int) $id;
        if ($id <= 0) {
            $this->redirectWithMessage('/admin', 'ID no válido', 'danger');
            return;
        }

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'categoria' => trim($_POST['categoria'] ?? ''),
            'precio' => (float) (str_replace(',', '.', $_POST['precio'] ?? 0)),
            'stock' => (int) ($_POST['stock'] ?? 0),
            'imagen_url' => trim($_POST['imagen_url'] ?? ''),
            'activo' => isset($_POST['activo']) ? 1 : 0,
            'portada' => isset($_POST['portada']) ? 1 : 0,
            'tallas_disponibles' => trim($_POST['tallas_disponibles'] ?? ''),
        ];

        if ($data['nombre'] === '') {
            $this->redirectWithMessage('/admin/editar/' . $id, 'El nombre es obligatorio', 'danger');
            return;
        }
        if ($data['categoria'] === '') {
            $this->redirectWithMessage('/admin/editar/' . $id, 'La categoría es obligatoria', 'danger');
            return;
        }
        if ($data['precio'] <= 0) {
            $this->redirectWithMessage('/admin/editar/' . $id, 'El precio debe ser mayor que 0', 'danger');
            return;
        }

        try {
            $result = $this->productModel->update($id, $data);
            if ($result) {
                $this->redirectWithMessage('/admin', 'Producto actualizado correctamente', 'success');
            } else {
                $this->redirectWithMessage('/admin/editar/' . $id, 'No se pudo actualizar', 'danger');
            }
        } catch (Exception $e) {
            $this->redirectWithMessage('/admin/editar/' . $id, 'Error: ' . $e->getMessage(), 'danger');
        }
    }

    /**
     * Eliminar producto (soft delete)
     */
    public function eliminar($id) {
        $this->requireAdmin();
        $id = (int) $id;
        if ($id <= 0) {
            $this->redirectWithMessage('/admin', 'ID no válido', 'danger');
            return;
        }
        $product = $this->productModel->getById($id);
        if (!$product) {
            $this->redirectWithMessage('/admin', 'Producto no encontrado', 'danger');
            return;
        }
        try {
            $this->productModel->delete($id);
            $this->redirectWithMessage('/admin', 'Producto eliminado correctamente', 'success');
        } catch (Exception $e) {
            $this->redirectWithMessage('/admin', 'Error: ' . $e->getMessage(), 'danger');
        }
    }
}
