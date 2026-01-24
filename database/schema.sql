-- Script SQL completo para crear la base de datos de TextilPXM
-- Este script elimina y recrea todo desde cero

-- Eliminar la base de datos si existe (CUIDADO: Esto borrará todos los datos)
DROP DATABASE IF EXISTS textilpxm_db;

-- Crear la base de datos
CREATE DATABASE textilpxm_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Seleccionar la base de datos
USE textilpxm_db;

-- Tabla de usuarios
CREATE TABLE users (
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
    '$2y$10$RFvz.hTVHPtBWtEJNvHVouKZqyKVG0a8q9nMrapPVqi6xvlL5AR.q',
    'admin'
);

-- Tabla de productos
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    descripcion TEXT,
    categoria VARCHAR(100) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0,
    imagen_url VARCHAR(500),
    activo TINYINT(1) DEFAULT 1,
    portada TINYINT(1) DEFAULT 0,
    tallas_disponibles VARCHAR(200) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_categoria (categoria),
    INDEX idx_activo (activo),
    INDEX idx_portada (portada)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar productos de ejemplo (6 categorías con 6 productos cada una)
-- Algunos productos tienen portada=1 para aparecer en el home
INSERT INTO products (nombre, descripcion, categoria, precio, stock, imagen_url, portada, tallas_disponibles) VALUES

('Huipil de Gala', 'Huipil tradicional oaxaqueño elaborado con técnicas ancestrales de tejido en telar de cintura. Bordado a mano con hilos de seda.', 'Huipiles', 2850.00, 5, 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800', 1, 'XS, S, M, L, XL'),
('Huipil de Fiesta', 'Huipil ceremonial con bordados elaborados en hilo de oro. Ideal para ocasiones especiales y celebraciones tradicionales.', 'Huipiles', 3200.00, 3, 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=800', 1, 'S, M, L'),
('Huipil de Diario', 'Huipil cómodo para uso diario, tejido en algodón suave con diseños geométricos tradicionales.', 'Huipiles', 1850.00, 8, 'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?q=80&w=800', 1, 'XS, S, M, L, XL'),
('Huipil de Tehuana', 'Huipil estilo Tehuana con flores bordadas a mano. Representa la elegancia de la cultura zapoteca.', 'Huipiles', 3500.00, 4, 'https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=800', 0, 'M, L, XL'),
('Huipil Infantil', 'Huipil pequeño para niñas, con colores vibrantes y diseños alegres que preservan la tradición desde temprana edad.', 'Huipiles', 1200.00, 10, 'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?q=80&w=800', 1, 'Talla Única'),
('Huipil de Lana', 'Huipil tejido en lana natural, perfecto para climas fríos. Mantiene el calor con estilo tradicional.', 'Huipiles', 2400.00, 6, 'https://images.unsplash.com/photo-1601925260009-5a5c8c5b5b5b?q=80&w=800', 0, 'S, M, L'),


('Blusa Flor de Maguey', 'Blusa bordada a mano con motivos florales inspirados en el maguey. Tela de algodón 100% natural teñida con tintes naturales.', 'Blusas', 1450.00, 8, 'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?q=80&w=800', 1, 'XS, S, M, L'),
('Blusa de Encaje', 'Blusa elegante con detalles de encaje artesanal. Combina tradición con modernidad.', 'Blusas', 1650.00, 7, 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?q=80&w=800', 1, 'S, M, L, XL'),
('Blusa Bordada de Flores', 'Blusa con bordados florales multicolores. Cada flor es única y tejida con dedicación.', 'Blusas', 1550.00, 9, 'https://images.unsplash.com/photo-1594633313593-e789644cdddc?q=80&w=800', 1, 'XS, S, M, L, XL'),
('Blusa de Manta Blanca', 'Blusa sencilla de manta blanca con bordados discretos. Versátil y cómoda para cualquier ocasión.', 'Blusas', 950.00, 12, 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?q=80&w=800', 0, 'S, M, L'),
('Blusa de Rayas', 'Blusa tradicional con rayas coloridas. Diseño clásico que nunca pasa de moda.', 'Blusas', 1350.00, 10, 'https://images.unsplash.com/photo-1594633313593-e789644cdddc?q=80&w=800', 0, 'XS, S, M, L'),
('Blusa de Gala', 'Blusa elegante para ocasiones especiales, con bordados elaborados y detalles finos.', 'Blusas', 2200.00, 5, 'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?q=80&w=800', 0, 'M, L, XL'),


('Rebozo de Seda', 'Rebozo artesanal de seda con flecos tejidos a mano. Diseño único con colores vibrantes de la región.', 'Rebozos', 3200.00, 3, 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?q=80&w=800', 1, 'Talla Única'),
('Rebozo de Algodón', 'Rebozo suave de algodón, perfecto para el día a día. Ligero y cómodo.', 'Rebozos', 1800.00, 8, 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=800', 1, 'Talla Única'),
('Rebozo de Lana', 'Rebozo abrigador de lana natural. Ideal para las noches frescas de Oaxaca.', 'Rebozos', 2500.00, 6, 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?q=80&w=800', 0, 'Talla Única'),
('Rebozo de Fiesta', 'Rebozo elegante con bordados dorados. Perfecto para celebraciones y eventos especiales.', 'Rebozos', 3800.00, 2, 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=800', 0, 'Talla Única'),
('Rebozo de Colores', 'Rebozo multicolor con diseño tradicional. Cada color representa un elemento de la naturaleza.', 'Rebozos', 2100.00, 7, 'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?q=80&w=800', 0, 'Talla Única'),
('Rebozo Clásico', 'Rebozo tradicional con rayas y flecos. Diseño atemporal que nunca pasa de moda.', 'Rebozos', 1950.00, 9, 'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?q=80&w=800', 0, 'Talla Única'),


('Camisa de Manta', 'Camisa tradicional de manta con bordados discretos. Cómoda y fresca, ideal para el clima cálido.', 'Camisas', 950.00, 12, 'https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=800', 1, 'S, M, L, XL'),
('Camisa Bordada', 'Camisa con bordados elaborados en el cuello y puños. Elegancia tradicional en cada detalle.', 'Camisas', 1250.00, 10, 'https://images.unsplash.com/photo-1601925260009-5a5c8c5b5b5b?q=80&w=800', 0, 'M, L, XL'),
('Camisa de Lino', 'Camisa fresca de lino natural. Perfecta para el clima cálido de Oaxaca.', 'Camisas', 1100.00, 11, 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=800', 0, 'S, M, L'),
('Camisa de Algodón', 'Camisa cómoda de algodón 100% natural. Diseño simple y elegante.', 'Camisas', 1050.00, 13, 'https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=800', 0, 'XS, S, M, L, XL'),
('Camisa de Gala', 'Camisa elegante para ocasiones especiales, con bordados finos y detalles artesanales.', 'Camisas', 1650.00, 6, 'https://images.unsplash.com/photo-1618354691373-d851c5c3a990?q=80&w=800', 0, 'M, L'),
('Camisa de Rayas', 'Camisa casual con rayas tradicionales. Estilo clásico y versátil.', 'Camisas', 980.00, 14, 'https://images.unsplash.com/photo-1601925260368-ae2f83cf8b7f?q=80&w=800', 0, 'S, M, L, XL'),


('Huaraches Artesanales', 'Huaraches hechos a mano con cuero genuino. Suela de llanta reciclada, cómodos y duraderos.', 'Calzado', 780.00, 15, 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=800', 1, '22, 23, 24, 25, 26, 27'),
('Huaraches de Cuero', 'Huaraches de cuero suave con diseño tradicional. Máxima comodidad y durabilidad.', 'Calzado', 950.00, 12, 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=800', 0, '23, 24, 25, 26, 27'),
('Huaraches de Colores', 'Huaraches con correas de colores vibrantes. Estilo único y llamativo.', 'Calzado', 850.00, 13, 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=800', 0, '22, 23, 24, 25, 26'),
('Huaraches Clásicos', 'Huaraches tradicionales con diseño atemporal. Perfectos para cualquier ocasión.', 'Calzado', 720.00, 16, 'https://images.unsplash.com/photo-1460353581641-37baddab0fa2?q=80&w=800', 0, '23, 24, 25, 26, 27, 28'),
('Huaraches de Fiesta', 'Huaraches elegantes con detalles decorativos. Ideales para celebraciones.', 'Calzado', 1100.00, 8, 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=800', 0, '24, 25, 26'),
('Huaraches Infantiles', 'Huaraches pequeños para niños, cómodos y resistentes. Preservan la tradición desde la infancia.', 'Calzado', 650.00, 18, 'https://images.unsplash.com/photo-1543163521-1bf539c55dd2?q=80&w=800', 0, '18, 19, 20, 21, 22'),


('Bolsa Tejida a Mano', 'Bolsa tejida a mano con fibras naturales. Diseño tradicional con capacidad amplia y resistente.', 'Accesorios', 650.00, 20, 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=800', 1, 'Talla Única'),
('Cinturón Bordado', 'Cinturón artesanal con bordados tradicionales. Complementa perfectamente cualquier atuendo.', 'Accesorios', 450.00, 25, 'https://images.unsplash.com/photo-1624222247344-550fb60583fd?q=80&w=800', 0, 'S, M, L'),
('Pulsera de Hilo', 'Pulsera tejida a mano con hilos de colores. Cada una es única y representa la artesanía oaxaqueña.', 'Accesorios', 180.00, 30, 'https://images.unsplash.com/photo-1611652022419-a9419f74343d?q=80&w=800', 0, 'Talla Única'),
('Sombrero de Palma', 'Sombrero tradicional de palma tejida. Protege del sol con estilo auténtico.', 'Accesorios', 550.00, 15, 'https://images.unsplash.com/photo-1534215754734-18e55d13e361?q=80&w=800', 0, 'Talla Única'),
('Collar de Semillas', 'Collar artesanal hecho con semillas naturales. Diseño único y ecológico.', 'Accesorios', 320.00, 22, 'https://images.unsplash.com/photo-1611591437281-460bfbe1220a?q=80&w=800', 0, 'Talla Única'),
('Monedero Bordado', 'Monedero pequeño con bordados tradicionales. Funcional y hermoso.', 'Accesorios', 380.00, 18, 'https://images.unsplash.com/photo-1624222247344-550fb60583fd?q=80&w=800', 0, 'Talla Única');
