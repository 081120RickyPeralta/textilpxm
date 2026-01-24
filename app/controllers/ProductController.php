<?php
/**
 * Controlador de Productos
 * Gestiona el CRUD de productos (requiere autenticación)
 */

class ProductController extends Controller {
    private $productModel;

    public function __construct() {
        parent::__construct();
        $this->requireAuth(); // Requiere autenticación
        $this->productModel = new Product();
    }

    /**
     * Listar todos los productos (panel de administración)
     */
    public function index() {
        $products = $this->productModel->getAll();
        
        $flash = $this->getFlashMessage();
        $data = [
            'page_title' => 'Gestión de Productos',
            'products' => $products,
            'flash_message' => $flash['message'] ?? null,
            'flash_type' => $flash['type'] ?? null
        ];

        $this->render('products/index', $data);
    }

    /**
     * Mostrar formulario de creación
     */
    public function create() {
        try {
            $categories = $this->productModel->getCategories();
            $flash = $this->getFlashMessage();
            $data = [
                'page_title' => 'Nuevo Producto',
                'categories' => $categories ?: [],
                'product' => null,
                'flash_message' => $flash['message'] ?? null,
                'flash_type' => $flash['type'] ?? null
            ];

            $this->render('products/form', $data);
        } catch (Exception $e) {
            $this->redirectWithMessage('/products', 'Error al cargar el formulario: ' . $e->getMessage(), 'danger');
        }
    }

    /**
     * Guardar nuevo producto
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/products');
            return;
        }

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'categoria' => trim($_POST['categoria'] ?? ''),
            'precio' => floatval($_POST['precio'] ?? 0),
            'stock' => intval($_POST['stock'] ?? 0),
            'imagen_url' => trim($_POST['imagen_url'] ?? ''),
            'activo' => isset($_POST['activo']) ? 1 : 0
        ];

        // Validación básica
        if (empty($data['nombre'])) {
            $this->redirectWithMessage('/products/create', 'El nombre del producto es requerido', 'danger');
            return;
        }

        if (empty($data['categoria'])) {
            $this->redirectWithMessage('/products/create', 'La categoría es requerida', 'danger');
            return;
        }

        if ($data['precio'] <= 0) {
            $this->redirectWithMessage('/products/create', 'El precio debe ser mayor a 0', 'danger');
            return;
        }

        try {
            $id = $this->productModel->create($data);
            if ($id) {
                $this->redirectWithMessage('/products', 'Producto creado exitosamente', 'success');
            } else {
                $this->redirectWithMessage('/products/create', 'Error al crear el producto. Intenta nuevamente', 'danger');
            }
        } catch (Exception $e) {
            $this->redirectWithMessage('/products/create', 'Error: ' . $e->getMessage(), 'danger');
        }
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit($id) {
        try {
            if (empty($id)) {
                $this->redirectWithMessage('/products', 'ID de producto no válido', 'danger');
                return;
            }

            $product = $this->productModel->getById($id);
            
            if (!$product) {
                $this->redirectWithMessage('/products', 'Producto no encontrado', 'danger');
                return;
            }

            $categories = $this->productModel->getCategories();
            $flash = $this->getFlashMessage();
            $data = [
                'page_title' => 'Editar Producto',
                'product' => $product,
                'categories' => $categories ?: [],
                'flash_message' => $flash['message'] ?? null,
                'flash_type' => $flash['type'] ?? null
            ];

            $this->render('products/form', $data);
        } catch (Exception $e) {
            $this->redirectWithMessage('/products', 'Error al cargar el producto: ' . $e->getMessage(), 'danger');
        }
    }

    /**
     * Actualizar producto
     */
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/products');
            return;
        }

        if (empty($id)) {
            $this->redirectWithMessage('/products', 'ID de producto no válido', 'danger');
            return;
        }

        $data = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'categoria' => trim($_POST['categoria'] ?? ''),
            'precio' => floatval($_POST['precio'] ?? 0),
            'stock' => intval($_POST['stock'] ?? 0),
            'imagen_url' => trim($_POST['imagen_url'] ?? ''),
            'activo' => isset($_POST['activo']) ? 1 : 0,
            'portada' => isset($_POST['portada']) ? 1 : 0,
            'tallas_disponibles' => trim($_POST['tallas_disponibles'] ?? '')
        ];

        // Validación básica
        if (empty($data['nombre'])) {
            $this->redirectWithMessage('/products/edit/' . $id, 'El nombre del producto es requerido', 'danger');
            return;
        }

        if (empty($data['categoria'])) {
            $this->redirectWithMessage('/products/edit/' . $id, 'La categoría es requerida', 'danger');
            return;
        }

        if ($data['precio'] <= 0) {
            $this->redirectWithMessage('/products/edit/' . $id, 'El precio debe ser mayor a 0', 'danger');
            return;
        }

        try {
            $result = $this->productModel->update($id, $data);
            if ($result) {
                $this->redirectWithMessage('/products', 'Producto actualizado exitosamente', 'success');
            } else {
                $this->redirectWithMessage('/products/edit/' . $id, 'No se pudo actualizar el producto. Verifica que el producto exista', 'danger');
            }
        } catch (Exception $e) {
            $this->redirectWithMessage('/products/edit/' . $id, 'Error: ' . $e->getMessage(), 'danger');
        }
    }

    /**
     * Eliminar producto (soft delete)
     */
    public function delete($id) {
        try {
            if (empty($id)) {
                $this->redirectWithMessage('/products', 'ID de producto no válido', 'danger');
                return;
            }

            // Verificar que el producto existe
            $product = $this->productModel->getById($id);
            if (!$product) {
                $this->redirectWithMessage('/products', 'Producto no encontrado', 'danger');
                return;
            }

            $result = $this->productModel->delete($id);
            if ($result) {
                $this->redirectWithMessage('/products', 'Producto eliminado exitosamente', 'success');
            } else {
                $this->redirectWithMessage('/products', 'No se pudo eliminar el producto', 'danger');
            }
        } catch (Exception $e) {
            $this->redirectWithMessage('/products', 'Error: ' . $e->getMessage(), 'danger');
        }
    }
}
