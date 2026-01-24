<?php
/**
 * Vista de detalles del producto
 * Muestra información completa de un producto individual
 */

// Verificar que el producto existe
if (empty($product) || !isset($product['id'])) {
    // Si no hay producto, redirigir al home
    header('Location: ' . BASE_URL);
    exit;
}

// Debug temporal - remover en producción
// echo "<!-- DEBUG: Product ID=" . $product['id'] . " -->";
// echo "<!-- DEBUG: Product Name=" . htmlspecialchars($product['nombre']) . " -->";
?>

<style>
    /* Estilos específicos para la página de detalle de producto - Aislados completamente */
    body.product-detail-page {
        background-color: #f5f3ef !important;
        font-family: 'Inter', sans-serif !important;
    }
    
    /* Ocultar elementos del home si existen */
    body.product-detail-page .hero,
    body.product-detail-page .order-section,
    body.product-detail-page .about-section {
        display: none !important;
    }
    
    .product-detail-section {
        margin-top: 100px;
        padding: 3rem 0;
        min-height: 70vh;
        background-color: #f5f3ef;
    }
    
    .product-detail-image {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        background-color: #fdfcfa;
    }
    
    .product-detail-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
    }
    
    .product-detail-title {
        font-size: 2.5rem;
        font-weight: 400;
        margin-bottom: 1rem;
        color: #3d3529;
        font-family: 'Cormorant Garamond', serif;
    }
    
    .product-detail-price {
        font-size: 2rem;
        font-weight: 600;
        color: #4a6741;
        margin-bottom: 1.5rem;
    }
    
    .product-detail-info {
        margin-bottom: 2rem;
    }
    
    .product-detail-info p {
        color: #8a8070;
        line-height: 1.8;
        margin-bottom: 1rem;
    }
    
    .tallas-section {
        margin: 2rem 0;
    }
    
    .talla-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        margin: 0.25rem;
        background: #fdfcfa;
        border: 2px solid #e0dcd4;
        border-radius: 6px;
        color: #3d3529;
        font-weight: 500;
    }
    
    .stock-info {
        padding: 1rem;
        background: #fdfcfa;
        border-radius: 8px;
        border-left: 4px solid #4a6741;
        margin: 1.5rem 0;
    }
    
    .stock-info.agotado {
        border-left-color: #dc3545;
    }
    
    .related-products {
        margin-top: 4rem;
        padding-top: 3rem;
        border-top: 1px solid #e0dcd4;
    }
    
    .product-card {
        background: #fdfcfa;
        border: 1px solid #e0dcd4;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .product-img {
        width: 100%;
        height: 320px;
        object-fit: cover;
    }
    
    .product-body {
        padding: 1.25rem;
    }
    
    .product-category {
        font-size: 0.7rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #8a8070;
    }
    
    .product-title {
        font-size: 1.25rem;
        margin: 0.25rem 0 0.5rem;
        font-family: 'Cormorant Garamond', serif;
        color: #3d3529;
    }
    
    .product-price {
        font-weight: 600;
        color: #4a6741;
    }
    
    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 400;
        margin-bottom: 1rem;
        color: #3d3529;
    }
</style>

<script>
    // Marcar el body inmediatamente para aplicar estilos específicos de producto
    // Esto debe ejecutarse ANTES de que se carguen los estilos del home
    (function() {
        // Remover clase de home si existe
        if (document.body) {
            document.body.classList.remove('home-page');
            document.body.classList.remove('categorias-page');
            document.body.classList.add('product-detail-page');
        } else {
            // Si el body aún no existe, esperar a que se cree
            var observer = new MutationObserver(function(mutations) {
                if (document.body) {
                    document.body.classList.remove('home-page');
                    document.body.classList.remove('categorias-page');
                    document.body.classList.add('product-detail-page');
                    observer.disconnect();
                }
            });
            observer.observe(document.documentElement, { childList: true });
            
            // Fallback con DOMContentLoaded
            document.addEventListener('DOMContentLoaded', function() {
                if (document.body) {
                    document.body.classList.remove('home-page');
                    document.body.classList.remove('categorias-page');
                    document.body.classList.add('product-detail-page');
                }
            });
        }
    })();
</script>

<div class="product-detail-section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb" style="background-color: transparent; padding: 0;">
                    <ol class="breadcrumb" style="margin-bottom: 0;">
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>" style="color: var(--color-primary, #4a6741); text-decoration: none;">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/categorias" style="color: var(--color-primary, #4a6741); text-decoration: none;">Categorías</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>/categorias?cat=<?php echo urlencode($product['categoria']); ?>" style="color: var(--color-primary, #4a6741); text-decoration: none;"><?php echo htmlspecialchars($product['categoria']); ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product['nombre']); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        
        <div class="row g-5 mb-5">
            <!-- Imagen del producto -->
            <div class="col-lg-6">
                <div class="product-detail-image-container">
                    <img src="<?php echo htmlspecialchars($product['imagen_url'] ?: 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800'); ?>" 
                         alt="<?php echo htmlspecialchars($product['nombre']); ?>" 
                         class="product-detail-image"
                         onerror="this.src='https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800'">
                </div>
            </div>
            
            <!-- Información del producto -->
            <div class="col-lg-6">
                <span class="product-category"><?php echo htmlspecialchars($product['categoria']); ?></span>
                <h1 class="product-detail-title"><?php echo htmlspecialchars($product['nombre']); ?></h1>
                <p class="product-detail-price">$<?php echo number_format($product['precio'], 2); ?> MXN</p>
                
                <div class="product-detail-info">
                    <?php if (!empty($product['descripcion'])): ?>
                        <p><?php echo nl2br(htmlspecialchars($product['descripcion'])); ?></p>
                    <?php endif; ?>
                </div>
                
                <!-- Tallas disponibles -->
                <?php if (!empty($product['tallas_disponibles'])): ?>
                    <div class="tallas-section">
                        <h5 style="margin-bottom: 1rem; color: #3d3529;">Tallas Disponibles:</h5>
                        <?php 
                        $tallas = explode(',', $product['tallas_disponibles']);
                        foreach ($tallas as $talla): 
                            $talla = trim($talla);
                            if (!empty($talla)):
                        ?>
                            <span class="talla-badge"><?php echo htmlspecialchars($talla); ?></span>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                <?php endif; ?>
                
                <!-- Stock -->
                <div class="stock-info <?php echo ($product['stock'] <= 0) ? 'agotado' : ''; ?>">
                    <h5 style="margin-bottom: 0.5rem;">
                        <?php if ($product['stock'] > 0): ?>
                            <i class="bi bi-check-circle text-success"></i> Disponible
                        <?php else: ?>
                            <i class="bi bi-x-circle text-danger"></i> Agotado
                        <?php endif; ?>
                    </h5>
                    <p class="mb-0">
                        <?php if ($product['stock'] > 0): ?>
                            Stock disponible: <strong><?php echo $product['stock']; ?></strong> unidades
                        <?php else: ?>
                            Este producto está temporalmente agotado
                        <?php endif; ?>
                    </p>
                </div>
                
                <!-- Botón de pedido -->
                <div class="mt-4">
                    <a href="<?php echo BASE_URL; ?>/ordenar?producto=<?php echo $product['id']; ?>" class="btn btn-primary btn-lg" style="background-color: #4a6741; border-color: #4a6741; padding: 0.875rem 2rem;">
                        <i class="bi bi-cart-plus me-2"></i>Solicitar este Producto
                    </a>
                    <a href="<?php echo BASE_URL; ?>/categorias?cat=<?php echo urlencode($product['categoria']); ?>" class="btn btn-outline-secondary btn-lg ms-2">
                        <i class="bi bi-arrow-left me-2"></i>Ir a <?php echo htmlspecialchars($product['categoria']); ?>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Productos relacionados -->
        <?php if (!empty($relatedProducts)): ?>
            <div class="related-products">
                <h3 class="section-title mb-4">Productos Relacionados</h3>
                <div class="row g-4">
                    <?php foreach ($relatedProducts as $related): ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="product-card" onclick="window.location.href='<?php echo BASE_URL; ?>/producto/<?php echo $related['id']; ?>'">
                                <img src="<?php echo htmlspecialchars($related['imagen_url'] ?: 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800'); ?>" 
                                     alt="<?php echo htmlspecialchars($related['nombre']); ?>" 
                                     class="product-img"
                                     onerror="this.src='https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800'">
                                <div class="product-body">
                                    <span class="product-category"><?php echo htmlspecialchars($related['categoria']); ?></span>
                                    <h3 class="product-title"><?php echo htmlspecialchars($related['nombre']); ?></h3>
                                    <p class="product-price">$<?php echo number_format($related['precio'], 2); ?> MXN</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    // Marcar el body para aplicar estilos específicos
    document.addEventListener('DOMContentLoaded', function() {
        document.body.classList.add('product-detail-page');
    });
</script>
