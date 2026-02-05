-- Tabla para contenido del sitio (editable desde admin)
-- Clave única por campo; valor en texto. WhatsApp se guarda como URL completa.

CREATE TABLE IF NOT EXISTS site_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(120) NOT NULL UNIQUE,
    value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_key (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Valores por defecto (misma estructura que content_data.php)
INSERT INTO site_content (`key`, value) VALUES
('navbar_brand', 'PRENDAS PUERTO ESCONDIDO'),
('footer_brand', 'PRENDAS TÍPICAS OAXACA'),
('footer_description', 'Prendas artesanales de la costa chica de Oaxaca. Tejiendo tradición desde Puerto Escondido.'),
('footer_contact_title', 'Contacto'),
('footer_contact_street', 'Punta Zicatela'),
('footer_contact_city', 'Puerto Escondido, Oaxaca'),
('footer_contact_phone', '+52 954 181 78 23'),
('footer_contact_email', 'prendastipicasoaxaca@gmail.com'),
('footer_schedule_title', 'Horario'),
('footer_schedule_days', 'Fines de semana'),
('footer_schedule_hours', '10:00 AM - 7:00 PM'),
('footer_social_facebook', 'https://www.facebook.com/profile.php?id=61573404236218'),
('footer_social_instagram', 'https://www.instagram.com/prendastipicasoaxaca/'),
('footer_social_whatsapp', 'https://wa.me/529541817823?text=Hola,%20me%20interesa%20información%20sobre%20sus%20productos'),
('footer_copyright_text', 'Oaxaca Textiles. Todos los derechos reservados.'),
('footer_copyright_made_with', 'Hecho con amor en Puerto Escondido, Oaxaca'),
('meta_site_name', 'Oaxaca Textiles'),
('meta_site_default_title', 'Oaxaca Textiles | Ropa Típica de Puerto Escondido'),
('meta_site_description', 'Descubre la belleza de la ropa típica oaxaqueña. Prendas artesanales hechas a mano en Puerto Escondido, Oaxaca.'),
('meta_site_location', 'Puerto Escondido, Oaxaca'),
('home_hero_location', 'Puerto Escondido, Oaxaca'),
('home_hero_title', 'Tradición Textil Oaxaqueña'),
('home_hero_description', 'Descubre prendas únicas tejidas a mano por artesanas de la costa chica de Oaxaca. Cada pieza cuenta una historia de tradición, color y amor por nuestras raíces.'),
('home_collection_title', 'Prendas Artesanales'),
('home_collection_description', 'Cada pieza es elaborada con técnicas ancestrales transmitidas de generación en generación.'),
('home_collection_no_products', 'No hay productos disponibles en este momento.'),
('home_about_badge', 'Nuestra Historia'),
('home_about_title', 'Raíces que Visten'),
('home_about_description1', 'Desde el corazón de Puerto Escondido, trabajamos directamente con artesanas de la región, preservando técnicas milenarias de tejido en telar de cintura y bordado a mano.'),
('home_about_description2', 'Cada prenda que ofrecemos representa semanas de trabajo dedicado, usando tintes naturales extraídos de la grana cochinilla, el añil y otras plantas de la región.'),
('home_about_stats_years_value', '15+'),
('home_about_stats_years_label', 'Años de tradición'),
('home_about_stats_countrys_value', '10+'),
('home_about_stats_countrys_label', 'Paises exportados'),
('home_about_stats_products_value', '120+'),
('home_about_stats_products_label', 'Productos tejidos')
ON DUPLICATE KEY UPDATE value = VALUES(value);
