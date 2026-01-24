<?php
/**
 * Modelo de Usuario
 * Gestiona las operaciones de usuarios en la base de datos
 */

class User extends Model {
    private $table = 'users';

    /**
     * Obtener todos los usuarios
     */
    public function getAll() {
        $sql = "SELECT id, nombre, email, rol, created_at FROM " . $this->table . " ORDER BY created_at DESC";
        return $this->fetchAll($sql);
    }

    /**
     * Obtener un usuario por ID
     */
    public function getById($id) {
        $sql = "SELECT id, nombre, email, rol, created_at FROM " . $this->table . " WHERE id = ?";
        return $this->fetchOne($sql, [$id]);
    }

    /**
     * Obtener un usuario por email
     */
    public function getByEmail($email) {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = ?";
        return $this->fetchOne($sql, [$email]);
    }

    /**
     * Crear un nuevo usuario
     */
    public function create($data) {
        $sql = "INSERT INTO " . $this->table . " (nombre, email, password, rol) VALUES (?, ?, ?, ?)";
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $stmt = $this->query($sql, [
            $data['nombre'],
            $data['email'],
            $hashedPassword,
            'usuario' // rol por defecto
        ]);

        return $this->lastInsertId();
    }

    /**
     * Actualizar un usuario
     */
    public function update($id, $data) {
        $sql = "UPDATE " . $this->table . " SET nombre = ?, email = ?, rol = ? WHERE id = ?";
        
        $stmt = $this->query($sql, [
            $data['nombre'],
            $data['email'],
            $data['rol'],
            $id
        ]);

        return $this->rowCount($stmt);
    }

    /**
     * Eliminar un usuario
     */
    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->query($sql, [$id]);
        return $this->rowCount($stmt);
    }

    /**
     * Verificar credenciales de login
     */
    public function login($email, $password) {
        $user = $this->getByEmail($email);
        
        if ($user && password_verify($password, $user['password'])) {
            // Remover password del array before return
            unset($user['password']);
            return $user;
        }
        
        return false;
    }

    /**
     * Contar usuarios totales
     */
    public function countAll() {
        $sql = "SELECT COUNT(*) as total FROM " . $this->table;
        $result = $this->fetchOne($sql);
        return $result['total'] ?? 0;
    }
}