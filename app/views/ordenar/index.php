<?php
/**
 * Vista de formulario de pedido
 * Muestra formulario con producto pre-seleccionado y su imagen
 */

// Validar que las variables existen
$selectedProduct = $selectedProduct ?? null;
$selectedProductId = $selectedProductId ?? null;
$allProducts = $allProducts ?? [];
?>

<script>
    // Marcar el body inmediatamente para aplicar estilos específicos
    (function() {
        if (document.body) {
            document.body.classList.remove('home-page');
            document.body.classList.remove('categorias-page');
            document.body.classList.remove('product-detail-page');
            document.body.classList.add('ordenar-page');
        } else {
            var observer = new MutationObserver(function(mutations) {
                if (document.body) {
                    document.body.classList.remove('home-page');
                    document.body.classList.remove('categorias-page');
                    document.body.classList.remove('product-detail-page');
                    document.body.classList.add('ordenar-page');
                    observer.disconnect();
                }
            });
            observer.observe(document.documentElement, { childList: true });
            
            document.addEventListener('DOMContentLoaded', function() {
                if (document.body) {
                    document.body.classList.remove('home-page');
                    document.body.classList.remove('categorias-page');
                    document.body.classList.remove('product-detail-page');
                    document.body.classList.add('ordenar-page');
                }
            });
        }
    })();
</script>

<style>
    /* Estilos específicos para la página de ordenar */
    body.ordenar-page {
        background-color: #f5f3ef !important;
        font-family: 'Inter', sans-serif !important;
    }
    
    /* Ocultar elementos del home si existen */
    body.ordenar-page .hero,
    body.ordenar-page .order-section,
    body.ordenar-page .about-section {
        display: none !important;
    }
    
    .ordenar-section {
        margin-top: 100px;
        padding: 3rem 0;
        min-height: 70vh;
        background-color: #f5f3ef;
    }
    
    .product-preview {
        background: #fdfcfa;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }
    
    .product-preview-image {
        width: 100%;
        max-width: 400px;
        height: 400px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }
    
    .product-preview-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.75rem;
        color: #3d3529;
        margin-bottom: 0.5rem;
    }
    
    .product-preview-price {
        font-size: 1.5rem;
        font-weight: 600;
        color: #4a6741;
        margin-bottom: 1rem;
    }
    
    .product-preview-category {
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #8a8070;
        margin-bottom: 0.5rem;
    }
    
    .order-form-container {
        background: #fdfcfa;
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }
    
    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        font-weight: 400;
        margin-bottom: 1rem;
        color: #3d3529;
    }
    
    .section-subtitle {
        font-size: 0.875rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: #4a6741;
        margin-bottom: 0.5rem;
    }
    
    .form-label {
        font-weight: 500;
        color: #3d3529;
        margin-bottom: 0.5rem;
    }
    
    .form-control,
    .form-select {
        border: 1px solid #e0dcd4;
        border-radius: 6px;
        padding: 0.75rem;
        background-color: #fff;
        color: #3d3529;
    }
    
    .form-control:focus,
    .form-select:focus {
        border-color: #4a6741;
        box-shadow: 0 0 0 0.2rem rgba(74, 103, 65, 0.25);
        outline: none;
    }
    
    .btn-submit {
        background-color: #4a6741;
        border-color: #4a6741;
        padding: 0.875rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-submit:hover {
        background-color: #5a7a50;
        border-color: #5a7a50;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(74, 103, 65, 0.3);
    }
</style>

<div class="ordenar-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Encabezado -->
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <p class="section-subtitle">Haz tu Pedido</p>
                        <h2 class="section-title">Solicita tu Producto</h2>
                        <p style="color: #8a8070; max-width: 600px; margin: 0 auto;">
                            Completa el formulario y nos pondremos en contacto contigo para confirmar tu pedido. 
                            Realizamos envíos a todo México y al extranjero.
                        </p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <!-- Vista previa del producto (si hay uno seleccionado) -->
                    <?php if ($selectedProduct): ?>
                        <div class="col-lg-4">
                            <div class="product-preview">
                                <img src="<?php echo htmlspecialchars($selectedProduct['imagen_url'] ?: 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800'); ?>" 
                                     alt="<?php echo htmlspecialchars($selectedProduct['nombre']); ?>" 
                                     class="product-preview-image"
                                     onerror="this.src='https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800'">
                                <div class="product-preview-category"><?php echo htmlspecialchars($selectedProduct['categoria']); ?></div>
                                <h3 class="product-preview-title"><?php echo htmlspecialchars($selectedProduct['nombre']); ?></h3>
                                <p class="product-preview-price">$<?php echo number_format($selectedProduct['precio'], 2); ?> MXN</p>
                                <?php if (!empty($selectedProduct['descripcion'])): ?>
                                    <p style="color: #8a8070; font-size: 0.9rem; margin-bottom: 0;">
                                        <?php echo htmlspecialchars(mb_substr($selectedProduct['descripcion'], 0, 100)); ?>
                                        <?php if (mb_strlen($selectedProduct['descripcion']) > 100): ?>...<?php endif; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Formulario -->
                    <div class="<?php echo $selectedProduct ? 'col-lg-8' : 'col-lg-12'; ?>">
                        <div class="order-form-container">
                            <form id="orderForm" method="POST" action="<?php echo BASE_URL; ?>/contact">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nombre Completo *</label>
                                        <input type="text" class="form-control" name="name" placeholder="Tu nombre" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Correo Electrónico *</label>
                                        <input type="email" class="form-control" name="email" placeholder="correo@ejemplo.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Teléfono / WhatsApp *</label>
                                        <input type="tel" class="form-control" name="phone" placeholder="+52 954 123 4567" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Prenda de Interés *</label>
                                        <select class="form-select" name="product" id="productSelect" required>
                                            <option value="" <?php echo !$selectedProductId ? 'selected disabled' : ''; ?>>Selecciona una opción</option>
                                            <?php if (!empty($allProducts)): ?>
                                                <?php foreach ($allProducts as $prod): ?>
                                                    <option value="<?php echo $prod['id']; ?>" 
                                                            <?php echo ($selectedProductId && $prod['id'] == $selectedProductId) ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($prod['nombre']); ?> - $<?php echo number_format($prod['precio'], 2); ?> MXN
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <option value="otro">Otro / Personalizado</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Talla</label>
                                        <select class="form-select" name="size">
                                            <option value="" selected disabled>Selecciona tu talla</option>
                                            <?php if ($selectedProduct && !empty($selectedProduct['tallas_disponibles'])): 
                                                $tallas = explode(',', $selectedProduct['tallas_disponibles']);
                                                foreach ($tallas as $talla): 
                                                    $talla = trim($talla);
                                                    if (!empty($talla)):
                                            ?>
                                                <option value="<?php echo strtolower($talla); ?>"><?php echo htmlspecialchars($talla); ?></option>
                                            <?php 
                                                    endif;
                                                endforeach;
                                            else:
                                            ?>
                                                <option value="xs">XS - Extra Chica</option>
                                                <option value="s">S - Chica</option>
                                                <option value="m">M - Mediana</option>
                                                <option value="l">L - Grande</option>
                                                <option value="xl">XL - Extra Grande</option>
                                                <option value="unica">Talla Única</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Estado / Ciudad</label>
                                        <input type="text" class="form-control" name="city" placeholder="Ej: CDMX, Guadalajara">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Mensaje o Especificaciones</label>
                                        <textarea class="form-control" name="message" rows="3" placeholder="Cuéntanos si tienes alguna solicitud especial, colores preferidos, etc."></textarea>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary btn-submit">
                                            <i class="bi bi-send me-2"></i>Enviar Pedido
                                        </button>
                                        <a href="<?php echo $selectedProduct ? BASE_URL . '/producto/' . $selectedProduct['id'] : BASE_URL; ?>" class="btn btn-outline-secondary ms-2">
                                            <i class="bi bi-arrow-left me-2"></i>Volver
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Información adicional -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="text-center" style="color: #8a8070;">
                            <p class="mb-2"><i class="bi bi-check-circle me-2"></i> Envío seguro a todo México</p>
                            <p class="mb-2"><i class="bi bi-check-circle me-2"></i> Pago contra entrega disponible</p>
                            <p class="mb-0"><i class="bi bi-check-circle me-2"></i> Garantía de autenticidad</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Actualizar la vista previa cuando cambie el select
    document.addEventListener('DOMContentLoaded', function() {
        const productSelect = document.getElementById('productSelect');
        if (productSelect) {
            productSelect.addEventListener('change', function() {
                const productId = this.value;
                if (productId && productId !== 'otro' && productId !== '') {
                    // Redirigir a la misma página con el nuevo producto seleccionado
                    window.location.href = '<?php echo BASE_URL; ?>/ordenar?producto=' + productId;
                }
            });
        }
    });
</script>
