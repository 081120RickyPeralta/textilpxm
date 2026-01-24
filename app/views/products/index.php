<?php
// Vista de listado de productos (panel de administración)
?>

<style>
    .product-card-admin {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        transition: all 0.3s ease;
        height: 100%;
    }
    .product-card-admin:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .product-img-admin {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px 8px 0 0;
    }
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .btn-action {
        flex: 1;
        min-width: 120px;
    }
</style>

<div class="container my-5">
    <!-- Header con botón destacado -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h1 class="h2 mb-1">
                <i class="bi bi-box-seam me-2"></i>Gestión de Productos
            </h1>
            <p class="text-muted mb-0">Administra tu catálogo de productos</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?php echo BASE_URL; ?>/products/create" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle-fill me-2"></i>Agregar Producto
            </a>
        </div>
    </div>
    
    <?php if (isset($flash_message)): ?>
        <div class="alert alert-<?php echo $flash_type ?? 'success'; ?> alert-dismissible fade show">
            <i class="bi bi-<?php echo ($flash_type ?? 'success') === 'success' ? 'check-circle' : 'exclamation-triangle'; ?> me-2"></i>
            <?php echo htmlspecialchars($flash_message); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if (empty($products)): ?>
        <div class="card border-dashed text-center py-5">
            <div class="card-body">
                <i class="bi bi-inbox display-1 text-muted"></i>
                <h3 class="mt-3">No hay productos registrados</h3>
                <p class="text-muted">Comienza agregando tu primer producto al catálogo</p>
                <a href="<?php echo BASE_URL; ?>/products/create" class="btn btn-primary btn-lg mt-3">
                    <i class="bi bi-plus-circle-fill me-2"></i>Crear Primer Producto
                </a>
            </div>
        </div>
    <?php else: ?>
        <!-- Vista de tarjetas (Grid) -->
        <div class="row g-4 mb-4">
            <?php foreach ($products as $product): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card product-card-admin h-100">
                        <img src="<?php echo htmlspecialchars($product['imagen_url'] ?: 'https://via.placeholder.com/400x200?text=Sin+Imagen'); ?>" 
                             alt="<?php echo htmlspecialchars($product['nombre']); ?>" 
                             class="product-img-admin"
                             onerror="this.src='https://via.placeholder.com/400x200?text=Sin+Imagen'">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge bg-secondary"><?php echo htmlspecialchars($product['categoria']); ?></span>
                                <?php if ($product['activo']): ?>
                                    <span class="badge bg-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactivo</span>
                                <?php endif; ?>
                            </div>
                            
                            <h5 class="card-title"><?php echo htmlspecialchars($product['nombre']); ?></h5>
                            
                            <?php if (!empty($product['descripcion'])): ?>
                                <p class="card-text text-muted small" style="flex-grow: 1;">
                                    <?php echo htmlspecialchars(mb_substr($product['descripcion'], 0, 80)) . (mb_strlen($product['descripcion']) > 80 ? '...' : ''); ?>
                                </p>
                            <?php endif; ?>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="text-primary fs-4">$<?php echo number_format($product['precio'], 2); ?></strong>
                                        <small class="text-muted d-block">MXN</small>
                                    </div>
                                    <div class="text-end">
                                        <?php 
                                        $stock = intval($product['stock']);
                                        $stockClass = $stock > 10 ? 'text-success' : ($stock > 0 ? 'text-warning' : 'text-danger');
                                        $stockIcon = $stock > 10 ? 'check-circle' : ($stock > 0 ? 'exclamation-triangle' : 'x-circle');
                                        ?>
                                        <i class="bi bi-<?php echo $stockIcon; ?> <?php echo $stockClass; ?>"></i>
                                        <strong class="<?php echo $stockClass; ?>">Stock: <?php echo $stock; ?></strong>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Botones de acción grandes y claros -->
                            <div class="action-buttons mt-auto">
                                <a href="<?php echo BASE_URL; ?>/products/edit/<?php echo $product['id']; ?>" 
                                   class="btn btn-primary btn-action">
                                    <i class="bi bi-pencil-fill me-2"></i>Editar
                                </a>
                                <a href="<?php echo BASE_URL; ?>/products/delete/<?php echo $product['id']; ?>" 
                                   class="btn btn-danger btn-action"
                                   onclick="return confirm('¿Estás seguro de eliminar el producto: <?php echo htmlspecialchars(addslashes($product['nombre'])); ?>?');">
                                    <i class="bi bi-trash-fill me-2"></i>Eliminar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Resumen -->
        <div class="card bg-light">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h3 class="text-primary mb-0"><?php echo count($products); ?></h3>
                        <small class="text-muted">Total de Productos</small>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-success mb-0">
                            <?php echo count(array_filter($products, function($p) { return $p['activo']; })); ?>
                        </h3>
                        <small class="text-muted">Productos Activos</small>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-warning mb-0">
                            <?php 
                            $lowStock = array_filter($products, function($p) { 
                                return intval($p['stock']) > 0 && intval($p['stock']) <= 10; 
                            });
                            echo count($lowStock);
                            ?>
                        </h3>
                        <small class="text-muted">Stock Bajo</small>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
