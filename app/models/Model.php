<?php
/**
 * Clase Base para los Modelos
 * Proporciona funcionalidad común para todos los modelos
 */

class Model {
    protected $db;

    /**
     * Constructor: Inicializa la conexión a la base de datos
     */
    public function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->db = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch(PDOException $exception) {
            die("Error de conexión a la base de datos: " . $exception->getMessage());
        }
    }

    /**
     * Ejecutar una consulta preparada
     */
    protected function query($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch(PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }

    /**
     * Obtener un solo registro
     */
    protected function fetchOne($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }

    /**
     * Obtener múltiples registros
     */
    protected function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }

    /**
     * Obtener el último ID insertado
     */
    protected function lastInsertId() {
        return $this->db->lastInsertId();
    }

    /**
     * Obtener el número de filas afectadas
     */
    protected function rowCount($stmt) {
        return $stmt->rowCount();
    }

    /**
     * Preparar sentencia SQL
     */
    protected function prepare($sql) {
        return $this->db->prepare($sql);
    }
}