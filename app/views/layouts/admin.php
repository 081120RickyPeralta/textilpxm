<?php
$admin_page_title = $page_title ?? 'Admin';
$admin_user_name = $_SESSION['user_name'] ?? '';
$admin_is_logged = !empty($_SESSION['user_id']) && ($_SESSION['user_rol'] ?? '') === 'admin';
$metaContent = loadContent('meta');
$admin_site_name = getContent($metaContent, 'site.name', 'TextilPXM');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?php echo htmlspecialchars($admin_page_title); ?> · <?php echo htmlspecialchars($admin_site_name); ?> Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <link href="<?php echo ASSETS_URL; ?>/css/admin.css" rel="stylesheet">
</head>
<body class="bg-light min-vh-100">
    <?php if ($admin_is_logged): ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
        <div class="container">
            <a href="<?php echo BASE_URL; ?>/admin" class="navbar-brand fw-bold"><?php echo htmlspecialchars($admin_site_name); ?> Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Abrir menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>"><i class="bi bi-house-door me-1"></i>Página principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/admin"><i class="bi bi-box-seam me-1"></i>Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/admin/crear"><i class="bi bi-plus-lg me-1"></i>Nuevo producto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>/admin/contenido"><i class="bi bi-pencil-square me-1"></i>Contenido del sitio</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-white-50 small"><?php echo htmlspecialchars($admin_user_name); ?></span>
                    <a href="<?php echo BASE_URL; ?>/admin/logout" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right me-1"></i>Cerrar sesión</a>
                </div>
            </div>
        </div>
    </nav>
    <?php endif; ?>

    <main class="container py-4">
        <?php echo $content; ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
