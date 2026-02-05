<?php
// Cargar contenidos desde JSON
$navbarContent = loadContent('navbar');
$footerContent = loadContent('footer');
$metaContent = loadContent('meta');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $page_title ?? getContent($metaContent, 'site.default_title', 'Oaxaca Textiles'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars(getContent($metaContent, 'site.description', '')); ?>">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo ASSETS_URL; ?>/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top bg-light border-bottom py-3">
        <div class="container">
            <a class="navbar-brand fs-4 fw-semibold text-dark" href="<?php echo BASE_URL; ?>">
                <?php echo htmlspecialchars(getContent($navbarContent, 'brand', 'OAXACA TEXTILES')); ?>
            </a>
            <button class="navbar-toggler border-2 px-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-4 text-dark"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark small" href="<?php echo BASE_URL; ?>#inicio"><?php echo htmlspecialchars(getContent($navbarContent, 'menu.inicio', 'Inicio')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark small" href="<?php echo BASE_URL; ?>#coleccion"><?php echo htmlspecialchars(getContent($navbarContent, 'menu.coleccion', 'Colección')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark small" href="<?php echo BASE_URL; ?>#nosotros"><?php echo htmlspecialchars(getContent($navbarContent, 'menu.nosotros', 'Nosotros')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark small" href="<?php echo BASE_URL; ?>/ordenar"><?php echo htmlspecialchars(getContent($navbarContent, 'menu.ordenar', 'Ordenar')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark small" href="<?php echo BASE_URL; ?>#contacto"><?php echo htmlspecialchars(getContent($navbarContent, 'menu.contacto', 'Contacto')); ?></a>
                    </li>
                </ul>
                <form class="d-flex me-3 mb-2 mb-lg-0" role="search" action="<?php echo BASE_URL; ?>/categorias" method="GET" onsubmit="var q = this.q.value.trim(); if (!q) { this.q.value = ''; return false; } this.q.value = q;">
                    <input class="form-control form-control-sm" type="search" name="q" placeholder="<?php echo htmlspecialchars(getContent($navbarContent, 'search.placeholder', 'Buscar...')); ?>" aria-label="<?php echo htmlspecialchars(getContent($navbarContent, 'search.aria_label', 'Buscar producto')); ?>" value="<?php echo isset($_GET['q']) ? htmlspecialchars(trim($_GET['q'])) : ''; ?>" style="min-width: 150px;">
                    <button class="btn btn-outline-success btn-sm" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <?php if (!empty($_SESSION['user_id']) && ($_SESSION['user_rol'] ?? '') === 'admin'): ?>
                    <a href="<?php echo BASE_URL; ?>/admin" class="btn btn-outline-secondary btn-sm"><i class="bi bi-gear me-1"></i>Admin</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?php echo $content; ?>
    </main>

    <!-- Footer -->
    <footer id="contacto" class="bg-dark text-white pt-5 pb-2">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <p class="h4 fw-semibold mb-3"><?php echo htmlspecialchars(getContent($footerContent, 'brand', 'OAXACA TEXTILES')); ?></p>
                    <p class="small text-white-50">
                        <?php echo htmlspecialchars(getContent($footerContent, 'description', '')); ?>
                    </p>
                    <div class="mt-3">
                        <a href="<?php echo htmlspecialchars(getContent($footerContent, 'social.facebook', '#')); ?>" class="d-inline-flex align-items-center justify-content-center rounded-circle border border-white border-opacity-25 text-white-50 text-decoration-none me-2" style="width: 40px; height: 40px;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="<?php echo htmlspecialchars(getContent($footerContent, 'social.instagram', '#')); ?>" class="d-inline-flex align-items-center justify-content-center rounded-circle border border-white border-opacity-25 text-white-50 text-decoration-none me-2" style="width: 40px; height: 40px;">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="<?php echo htmlspecialchars(getContent($footerContent, 'social.whatsapp', '#')); ?>" class="d-inline-flex align-items-center justify-content-center rounded-circle border border-white border-opacity-25 text-white-50 text-decoration-none me-2" style="width: 40px; height: 40px;">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="h6 fw-semibold mb-4"><?php echo htmlspecialchars(getContent($footerContent, 'navigation.title', 'Navegación')); ?></h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>#inicio" class="text-decoration-none small text-white-50"><?php echo htmlspecialchars(getContent($footerContent, 'navigation.links.inicio', 'Inicio')); ?></a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>#coleccion" class="text-decoration-none small text-white-50"><?php echo htmlspecialchars(getContent($footerContent, 'navigation.links.coleccion', 'Colección')); ?></a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>#nosotros" class="text-decoration-none small text-white-50"><?php echo htmlspecialchars(getContent($footerContent, 'navigation.links.nosotros', 'Nosotros')); ?></a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>#ordenar" class="text-decoration-none small text-white-50"><?php echo htmlspecialchars(getContent($footerContent, 'navigation.links.ordenar', 'Ordenar')); ?></a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5 class="h6 fw-semibold mb-4"><?php echo htmlspecialchars(getContent($footerContent, 'contact.title', 'Contacto')); ?></h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 small text-white-50"><i class="bi bi-geo-alt me-2"></i><?php echo htmlspecialchars(getContent($footerContent, 'contact.address.street', '')); ?></li>
                        <li class="mb-2 small text-white-50"><?php echo htmlspecialchars(getContent($footerContent, 'contact.address.city', '')); ?></li>
                        <li class="mb-2 small text-white-50"><i class="bi bi-telephone me-2"></i><?php echo htmlspecialchars(getContent($footerContent, 'contact.phone', '')); ?></li>
                        <li class="mb-2 small text-white-50"><i class="bi bi-envelope me-2"></i><?php echo htmlspecialchars(getContent($footerContent, 'contact.email', '')); ?></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5 class="h6 fw-semibold mb-4"><?php echo htmlspecialchars(getContent($footerContent, 'schedule.title', 'Horario')); ?></h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 small text-white-50"><?php echo htmlspecialchars(getContent($footerContent, 'schedule.weekdays.days', '')); ?></li>
                        <li class="mb-2 small text-white-50"><?php echo htmlspecialchars(getContent($footerContent, 'schedule.weekdays.hours', '')); ?></li>
                        <li class="mb-2 mt-3 small text-white-50"><?php echo htmlspecialchars(getContent($footerContent, 'schedule.sunday.days', '')); ?></li>
                        <li class="mb-2 small text-white-50"><?php echo htmlspecialchars(getContent($footerContent, 'schedule.sunday.hours', '')); ?></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-top border-white border-opacity-10 pt-4 mt-5 text-center">
                <p class="mb-0 small text-white-50">&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars(getContent($footerContent, 'copyright.text', 'Oaxaca Textiles. Todos los derechos reservados.')); ?></p>
                <p class="mt-1 small text-white-50"><?php echo htmlspecialchars(getContent($footerContent, 'copyright.made_with', 'Hecho con amor en Puerto Escondido, Oaxaca')); ?></p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo ASSETS_URL; ?>/js/main.js"></script>
</body>
</html>