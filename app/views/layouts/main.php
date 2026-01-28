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
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top bg-light border-bottom py-3">
        <div class="container">
            <a class="navbar-brand fs-4 fw-semibold text-dark" href="<?php echo BASE_URL; ?>">
                OAXACA TEXTILES
            </a>
            <button class="navbar-toggler border-2 px-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-4 text-dark"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark small" href="<?php echo BASE_URL; ?>#inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark small" href="<?php echo BASE_URL; ?>#coleccion">Colección</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark small" href="<?php echo BASE_URL; ?>#nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark small" href="<?php echo BASE_URL; ?>/ordenar">Ordenar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark small" href="<?php echo BASE_URL; ?>#contacto">Contacto</a>
                    </li>
                </ul>
                <form class="d-flex me-3 mb-2 mb-lg-0" role="search" action="<?php echo BASE_URL; ?>/categorias" method="GET" onsubmit="var q = this.q.value.trim(); if (!q) { this.q.value = ''; return false; } this.q.value = q;">
                    <input class="form-control form-control-sm" type="search" name="q" placeholder="Buscar..." aria-label="Buscar producto" value="<?php echo isset($_GET['q']) ? htmlspecialchars(trim($_GET['q'])) : ''; ?>" style="min-width: 150px;">
                    <button class="btn btn-outline-success btn-sm" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?php echo BASE_URL; ?>/products" class="btn btn-success small px-3 py-2">
                        <i class="bi bi-box-seam me-1"></i>Gestión
                    </a>
                    <div class="ms-2">
                        <span class="navbar-text me-2 text-dark">
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

    <!-- Main Content -->
    <main>
        <?php echo $content; ?>
    </main>

    <!-- Footer -->
    <footer id="contacto" class="bg-dark text-white pt-5 pb-2">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <p class="h4 fw-semibold mb-3">OAXACA TEXTILES</p>
                    <p class="small text-white-50">
                        Prendas artesanales de las comunidades indígenas de Oaxaca. 
                        Tejiendo tradición desde Puerto Escondido.
                    </p>
                    <div class="mt-3">
                        <a href="#" class="d-inline-flex align-items-center justify-content-center rounded-circle border border-white border-opacity-25 text-white-50 text-decoration-none me-2" style="width: 40px; height: 40px;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="d-inline-flex align-items-center justify-content-center rounded-circle border border-white border-opacity-25 text-white-50 text-decoration-none me-2" style="width: 40px; height: 40px;">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="d-inline-flex align-items-center justify-content-center rounded-circle border border-white border-opacity-25 text-white-50 text-decoration-none me-2" style="width: 40px; height: 40px;">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="h6 fw-semibold mb-4">Navegación</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>#inicio" class="text-decoration-none small text-white-50">Inicio</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>#coleccion" class="text-decoration-none small text-white-50">Colección</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>#nosotros" class="text-decoration-none small text-white-50">Nosotros</a></li>
                        <li class="mb-2"><a href="<?php echo BASE_URL; ?>#ordenar" class="text-decoration-none small text-white-50">Ordenar</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5 class="h6 fw-semibold mb-4">Contacto</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 small text-white-50"><i class="bi bi-geo-alt me-2"></i>Calle Benito Juárez 123</li>
                        <li class="mb-2 small text-white-50">Puerto Escondido, Oaxaca</li>
                        <li class="mb-2 small text-white-50"><i class="bi bi-telephone me-2"></i>+52 954 582 1234</li>
                        <li class="mb-2 small text-white-50"><i class="bi bi-envelope me-2"></i>hola@oaxacatextiles.mx</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5 class="h6 fw-semibold mb-4">Horario</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 small text-white-50">Lunes a Sábado</li>
                        <li class="mb-2 small text-white-50">10:00 AM - 7:00 PM</li>
                        <li class="mb-2 mt-3 small text-white-50">Domingo</li>
                        <li class="mb-2 small text-white-50">11:00 AM - 4:00 PM</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-top border-white border-opacity-10 pt-4 mt-5 text-center">
                <p class="mb-0 small text-white-50">&copy; <?php echo date('Y'); ?> Oaxaca Textiles. Todos los derechos reservados.</p>
                <p class="mt-1 small text-white-50">Hecho con amor en Puerto Escondido, Oaxaca</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo ASSETS_URL; ?>/js/main.js"></script>
</body>
</html>