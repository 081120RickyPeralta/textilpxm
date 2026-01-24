<?php
/**
 * Modelo de Producto
 * Gestiona las operaciones de productos en la base de datos
 */

class Product extends Model {
    private $table = 'products';

    /**
     * Obtener todos los productos
     */
    public function getAll($activo = null) {
        if ($activo !== null) {
            $sql = "SELECT * FROM " . $this->table . " WHERE activo = ? ORDER BY created_at DESC";
            return $this->fetchAll($sql, [$activo]);
        }
        $sql = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        return $this->fetchAll($sql);
    }

    /**
     * Obtener productos activos (para catálogo público)
     */
    public function getActive() {
        $sql = "SELECT * FROM " . $this->table . " WHERE activo = 1 ORDER BY categoria, nombre";
        return $this->fetchAll($sql);
    }

    /**
     * Obtener productos de portada (para home)
     */
    public function getPortada() {
        $sql = "SELECT * FROM " . $this->table . " WHERE activo = 1 AND portada = 1 ORDER BY categoria, nombre";
        return $this->fetchAll($sql);
    }

    /**
     * Obtener un producto por ID
     */
    public function getById($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = ?";
        return $this->fetchOne($sql, [$id]);
    }

    /**
     * Obtener productos por categoría
     */
    public function getByCategory($categoria, $activo = 1) {
        $sql = "SELECT * FROM " . $this->table . " WHERE categoria = ? AND activo = ? ORDER BY nombre";
        return $this->fetchAll($sql, [$categoria, $activo]);
    }

    /**
     * Obtener todas las categorías únicas
     * @return array Array de nombres de categorías
     */
    public function getCategories() {
        try {
            $sql = "SELECT DISTINCT categoria FROM " . $this->table . " WHERE activo = 1 ORDER BY categoria";
            $result = $this->fetchAll($sql);
            
            // Extraer solo los nombres de las categorías
            $categories = [];
            foreach ($result as $row) {
                if (isset($row['categoria']) && !empty($row['categoria'])) {
                    $categories[] = $row['categoria'];
                }
            }
            
            return $categories;
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Agrupar productos por categoría
     * @param array $products Array de productos
     * @return array Array asociativo [categoria => [productos]]
     */
    public function groupByCategory($products) {
        $grouped = [];
        
        foreach ($products as $product) {
            if (!isset($product['categoria']) || empty($product['categoria'])) {
                continue;
            }
            
            $categoria = $product['categoria'];
            if (!isset($grouped[$categoria])) {
                $grouped[$categoria] = [];
            }
            
            $grouped[$categoria][] = $product;
        }
        
        return $grouped;
    }

    /**
     * Crear un nuevo producto
     */
    public function create($data) {
        $sql = "INSERT INTO " . $this->table . " (nombre, descripcion, categoria, precio, stock, imagen_url, activo, portada, tallas_disponibles) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->query($sql, [
            $data['nombre'],
            $data['descripcion'] ?? '',
            $data['categoria'],
            $data['precio'],
            $data['stock'] ?? 0,
            $data['imagen_url'] ?? '',
            $data['activo'] ?? 1,
            $data['portada'] ?? 0,
            $data['tallas_disponibles'] ?? ''
        ]);

        return $this->lastInsertId();
    }

    /**
     * Actualizar un producto
     */
    public function update($id, $data) {
        $sql = "UPDATE " . $this->table . " SET 
                nombre = ?, 
                descripcion = ?, 
                categoria = ?, 
                precio = ?, 
                stock = ?, 
                imagen_url = ?, 
                activo = ?,
                portada = ?,
                tallas_disponibles = ?
                WHERE id = ?";
        
        $stmt = $this->query($sql, [
            $data['nombre'],
            $data['descripcion'] ?? '',
            $data['categoria'],
            $data['precio'],
            $data['stock'] ?? 0,
            $data['imagen_url'] ?? '',
            $data['activo'] ?? 1,
            $data['portada'] ?? 0,
            $data['tallas_disponibles'] ?? '',
            $id
        ]);

        return $this->rowCount($stmt);
    }

    /**
     * Eliminar un producto (soft delete)
     */
    public function delete($id) {
        $sql = "UPDATE " . $this->table . " SET activo = 0 WHERE id = ?";
        $stmt = $this->query($sql, [$id]);
        return $this->rowCount($stmt);
    }

    /**
     * Eliminar un producto permanentemente
     */
    public function deletePermanent($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->query($sql, [$id]);
        return $this->rowCount($stmt);
    }

    /**
     * Actualizar stock
     */
    public function updateStock($id, $stock) {
        $sql = "UPDATE " . $this->table . " SET stock = ? WHERE id = ?";
        $stmt = $this->query($sql, [$stock, $id]);
        return $this->rowCount($stmt);
    }

    /**
     * Contar productos totales
     */
    public function countAll($activo = null) {
        if ($activo !== null) {
            $sql = "SELECT COUNT(*) as total FROM " . $this->table . " WHERE activo = ?";
            $result = $this->fetchOne($sql, [$activo]);
        } else {
            $sql = "SELECT COUNT(*) as total FROM " . $this->table;
            $result = $this->fetchOne($sql);
        }
        return $result['total'] ?? 0;
    }
}
