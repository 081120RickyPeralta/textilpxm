-- Script SQL para crear la base de datos de TextilPXM

-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS textilpxm_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Seleccionar la base de datos
USE textilpxm_db;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(50) DEFAULT 'usuario',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar un usuario administrador por defecto (contraseña: admin123)
INSERT INTO users (nombre, email, password, rol) 
VALUES (
    'Administrador',
    'admin@textilpxm.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'admin'
) ON DUPLICATE KEY UPDATE email=email;

-- Tablas adicionales que puedes agregar en el futuro:
-- Productos: CREATE TABLE products (...);
-- Clientes: CREATE TABLE customers (...);
-- Ventas: CREATE TABLE sales (...);
-- Inventario: CREATE TABLE inventory (...);