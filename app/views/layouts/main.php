<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $page_title ?? 'Oaxaca Textiles | Ropa Típica de Puerto Escondido'; ?></title>
    <meta name="description" content="Descubre la belleza de la ropa típica oaxaqueña. Prendas artesanales hechas a mano en Puerto Escondido, Oaxaca.">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo ASSETS_URL; ?>/css/style.css" rel="stylesheet">
    <style>
        /* Estilos base globales - solo colores CSS variables */
        :root {
            --color-background: #f5f3ef;
            --color-foreground: #3d3529;
            --color-primary: #4a6741;
            --color-primary-light: #5a7a50;
            --color-accent: #c4935a;
            --color-muted: #8a8070;
            --color-border: #e0dcd4;
            --color-card: #fdfcfa;
        }
        
        /* Reset para evitar que estilos del home afecten otras páginas */
        body:not(.home-page) .hero,
        body:not(.home-page) .order-section,
        body:not(.home-page) .about-section {
            display: none !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: rgba(253, 252, 250, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid #e0dcd4; padding: 1rem 0;">
        <div class="container">
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>" style="font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; font-weight: 600; color: #3d3529 !important; letter-spacing: 0.05em;">
                OAXACA TEXTILES
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border: 2px solid #3d3529; padding: 0.5rem 0.75rem;">
                <i class="bi bi-list" style="font-size: 1.5rem; color: #3d3529;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>#inicio" style="color: #3d3529 !important; font-size: 0.875rem; letter-spacing: 0.03em;">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>#coleccion" style="color: #3d3529 !important; font-size: 0.875rem; letter-spacing: 0.03em;">Colección</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>#nosotros" style="color: #3d3529 !important; font-size: 0.875rem; letter-spacing: 0.03em;">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>#contacto" style="color: #3d3529 !important; font-size: 0.875rem; letter-spacing: 0.03em;">Contacto</a>
                    </li>
                </ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?php echo BASE_URL; ?>/products" class="btn btn-primary" style="background-color: #4a6741; border-color: #4a6741; font-size: 0.875rem; letter-spacing: 0.03em; padding: 0.5rem 1.25rem;">
                        <i class="bi bi-box-seam me-1"></i>Gestión
                    </a>
                    <div class="ms-2">
                        <span class="navbar-text me-2" style="color: #3d3529;">
                            <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Usuario'); ?>
                        </span>
                        <a class="btn btn-sm btn-outline-secondary" href="<?php echo BASE_URL; ?>/logout">
                            <i class="bi bi-box-arrow-right"></i> Salir
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php if (isset($flash_message) && !empty($flash_message)): ?>
    <div class="alert alert-<?php echo $flash_type ?? 'success'; ?> alert-dismissible fade show" style="margin-top: 76px; margin-bottom: 0;">
        <?php echo htmlspecialchars($flash_message); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main>
        <?php echo $content; ?>
    </main>

    <!-- Footer -->
    <footer id="contacto" style="background-color: #3d3529; color: #fff; padding: 4rem 0 2rem;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <p style="font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; font-weight: 600; color: #fff; margin-bottom: 1rem;">OAXACA TEXTILES</p>
                    <p style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);">
                        Prendas artesanales de las comunidades indígenas de Oaxaca. 
                        Tejiendo tradición desde Puerto Escondido.
                    </p>
                    <div class="mt-3">
                        <a href="#" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 50%; color: rgba(255, 255, 255, 0.7); transition: all 0.3s ease; margin-right: 0.5rem; text-decoration: none;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 50%; color: rgba(255, 255, 255, 0.7); transition: all 0.3s ease; margin-right: 0.5rem; text-decoration: none;">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 50%; color: rgba(255, 255, 255, 0.7); transition: all 0.3s ease; margin-right: 0.5rem; text-decoration: none;">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 style="font-size: 1rem; font-weight: 600; margin-bottom: 1.25rem; letter-spacing: 0.05em;">Navegación</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>#inicio" class="text-decoration-none" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);">Inicio</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>#coleccion" class="text-decoration-none" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);">Colección</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>#nosotros" class="text-decoration-none" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);">Nosotros</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>#ordenar" class="text-decoration-none" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);">Ordenar</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5 style="font-size: 1rem; font-weight: 600; margin-bottom: 1.25rem; letter-spacing: 0.05em;">Contacto</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);"><i class="bi bi-geo-alt me-2"></i>Calle Benito Juárez 123</li>
                        <li class="mb-2" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);">Puerto Escondido, Oaxaca</li>
                        <li class="mb-2" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);"><i class="bi bi-telephone me-2"></i>+52 954 582 1234</li>
                        <li class="mb-2" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);"><i class="bi bi-envelope me-2"></i>hola@oaxacatextiles.mx</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5 style="font-size: 1rem; font-weight: 600; margin-bottom: 1.25rem; letter-spacing: 0.05em;">Horario</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);">Lunes a Sábado</li>
                        <li class="mb-2" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);">10:00 AM - 7:00 PM</li>
                        <li class="mb-2 mt-3" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);">Domingo</li>
                        <li class="mb-2" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);">11:00 AM - 4:00 PM</li>
                    </ul>
                </div>
            </div>
            
            <div style="border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 2rem; margin-top: 3rem;" class="text-center">
                <p class="mb-0" style="font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);">&copy; <?php echo date('Y'); ?> Oaxaca Textiles. Todos los derechos reservados.</p>
                <p class="mt-1" style="font-size: 0.75rem; color: rgba(255, 255, 255, 0.7);">Hecho con amor en Puerto Escondido, Oaxaca</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo ASSETS_URL; ?>/js/main.js"></script>
</body>
</html>