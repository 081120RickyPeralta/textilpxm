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
    /* Solo estilos que no se pueden reemplazar con Bootstrap - Colores personalizados */
    body.ordenar-page {
        font-family: 'Inter', sans-serif !important;
    }
    
    /* Ocultar elementos del home si existen */
    body.ordenar-page .hero,
    body.ordenar-page .order-section,
    body.ordenar-page .about-section {
        display: none !important;
    }
    
    .product-preview-image {
        width: 100%;
        max-width: 400px;
        height: 400px;
        object-fit: cover;
    }
</style>

<div class="mt-5 pt-5" style="min-height: 70vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Encabezado -->
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <p class="small text-uppercase text-success mb-2">Haz tu Pedido</p>
                        <h2 class="display-4 fw-normal mb-3">Solicita tu Producto</h2>
                        <p class="text-muted mx-auto" style="max-width: 600px;">
                            Completa el formulario y nos pondremos en contacto contigo para confirmar tu pedido. Realizamos envíos a todo México y al extranjero.
                        </p>
                    </div>
                </div>
                
                <div class="row g-4 align-items-stretch">
                    <!-- Vista previa del producto (si hay uno seleccionado) -->
                    <?php if ($selectedProduct): ?>
                        <div class="col-lg-4 d-flex">
                            <div class="card shadow-sm p-4 bg-light h-100 w-100">
                                <img src="<?php echo htmlspecialchars($selectedProduct['imagen_url'] ?: 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800'); ?>" 
                                     alt="<?php echo htmlspecialchars($selectedProduct['nombre']); ?>" 
                                     class="product-preview-image rounded shadow mb-3"
                                     onerror="this.src='https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800'">
                                <div class="small text-uppercase text-muted mb-2"><?php echo htmlspecialchars($selectedProduct['categoria']); ?></div>
                                <h3 class="h3 mb-2"><?php echo htmlspecialchars($selectedProduct['nombre']); ?></h3>
                                <p class="h4 fw-semibold text-success mb-3">$<?php echo number_format($selectedProduct['precio'], 2); ?> MXN</p>
                                <?php if (!empty($selectedProduct['descripcion'])): ?>
                                    <p class="text-muted small mb-0">
                                        <?php echo htmlspecialchars(mb_substr($selectedProduct['descripcion'], 0, 100)); ?>
                                        <?php if (mb_strlen($selectedProduct['descripcion']) > 100): ?>...<?php endif; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Formulario -->
                    <div class="<?php echo $selectedProduct ? 'col-lg-8' : 'col-lg-12'; ?> d-flex">
                        <div class="card shadow-sm p-4 p-lg-5 bg-light h-100 w-100">
                            <form id="orderForm" onsubmit="return enviarWhatsApp(event)">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nombre Completo *</label>
                                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Ej: Juan Pérez" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Correo Electrónico *</label>
                                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Ej: ejemplo@gmail.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Teléfono *</label>
                                        <input type="tel" class="form-control" id="inputPhone" name="phone" placeholder="Ej: 954 123 4567" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Selecciona un Producto *</label>
                                        <select class="form-select" name="product" id="productSelect" required>
                                            <option value="" <?php echo !$selectedProductId ? 'selected disabled' : ''; ?>>Elige un producto...</option>
                                            <?php if (!empty($allProducts)): ?>
                                                <?php foreach ($allProducts as $prod): ?>
                                                    <option value="<?php echo $prod['id']; ?>" 
                                                            data-nombre="<?php echo htmlspecialchars($prod['nombre']); ?>"
                                                            data-precio="<?php echo number_format($prod['precio'], 2); ?>"
                                                            <?php echo ($selectedProductId && $prod['id'] == $selectedProductId) ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($prod['nombre']); ?> - $<?php echo number_format($prod['precio'], 2); ?> MXN
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <option value="otro" data-nombre="Producto Personalizado" data-precio="Por definir">Otro / Personalizado</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Talla</label>
                                        <select class="form-select" id="inputSize" name="size">
                                            <option value="" selected disabled>Selecciona una talla</option>
                                            <?php if ($selectedProduct && !empty($selectedProduct['tallas_disponibles'])): 
                                                $tallas = explode(',', $selectedProduct['tallas_disponibles']);
                                                foreach ($tallas as $talla): 
                                                    $talla = trim($talla);
                                                    if (!empty($talla)):
                                            ?>
                                                <option value="<?php echo htmlspecialchars($talla); ?>"><?php echo htmlspecialchars($talla); ?></option>
                                            <?php 
                                                    endif;
                                                endforeach;
                                            else:
                                            ?>
                                                <option value="XS">XS - Extra Chica</option>
                                                <option value="S">S - Chica</option>
                                                <option value="M">M - Mediana</option>
                                                <option value="L">L - Grande</option>
                                                <option value="XL">XL - Extra Grande</option>
                                                <option value="Talla Única">Talla Única</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Estado / Ciudad</label>
                                        <input type="text" class="form-control" id="inputCity" name="city" placeholder="Ej: CDMX, Guadalajara">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Notas Adicionales</label>
                                        <textarea class="form-control" id="inputMessage" name="message" rows="3" placeholder="Comentarios, instrucciones especiales, etc."></textarea>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="d-flex flex-column flex-sm-row gap-2">
                                            <button type="submit" class="btn btn-success flex-sm-fill">
                                                <i class="bi bi-whatsapp me-2"></i>Solicitar Pedido
                                            </button>
                                            <a href="<?php echo $selectedProduct ? BASE_URL . '/producto/' . $selectedProduct['id'] : BASE_URL; ?>" class="btn btn-outline-secondary flex-sm-fill">
                                                <i class="bi bi-arrow-left me-2"></i>Volver
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Información adicional -->
                <div class="row m-5">
                    <div class="col-12">
                        <div class="text-center text-muted">
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
    // Número de WhatsApp del administrador (sin el +)
    const WHATSAPP_ADMIN = '529541364103';
    
    // Función para enviar pedido por WhatsApp
    function enviarWhatsApp(event) {
        event.preventDefault();
        
        // Obtener valores del formulario
        const nombre = document.getElementById('inputName').value.trim();
        const email = document.getElementById('inputEmail').value.trim();
        const telefono = document.getElementById('inputPhone').value.trim();
        const ciudad = document.getElementById('inputCity').value.trim();
        const mensaje = document.getElementById('inputMessage').value.trim();
        const tallaSelect = document.getElementById('inputSize');
        const talla = tallaSelect.options[tallaSelect.selectedIndex]?.value || 'No especificada';
        
        // Obtener producto seleccionado
        const productSelect = document.getElementById('productSelect');
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const productoNombre = selectedOption?.dataset.nombre || 'No especificado';
        const productoPrecio = selectedOption?.dataset.precio || 'Por definir';
        
        // Validar campos requeridos
        if (!nombre || !email || !telefono || !productSelect.value) {
            alert('Por favor completa todos los campos requeridos');
            return false;
        }
        
        // Construir mensaje de WhatsApp
        let whatsappMessage = `🛒 *NUEVO PEDIDO - OAXACA TEXTILES*\n\n`;
        whatsappMessage += `━━━━━━━━━━━━━━━━━━━━\n`;
        whatsappMessage += `📦 *PRODUCTO*\n`;
        whatsappMessage += `• Artículo: ${productoNombre}\n`;
        whatsappMessage += `• Precio: $${productoPrecio} MXN\n`;
        whatsappMessage += `• Talla: ${talla}\n`;
        whatsappMessage += `━━━━━━━━━━━━━━━━━━━━\n`;
        whatsappMessage += `👤 *DATOS DEL CLIENTE*\n`;
        whatsappMessage += `• Nombre: ${nombre}\n`;
        whatsappMessage += `• Teléfono: ${telefono}\n`;
        whatsappMessage += `• Email: ${email}\n`;
        if (ciudad) {
            whatsappMessage += `• Ciudad: ${ciudad}\n`;
        }
        if (mensaje) {
            whatsappMessage += `━━━━━━━━━━━━━━━━━━━━\n`;
            whatsappMessage += `💬 *MENSAJE*\n`;
            whatsappMessage += `${mensaje}\n`;
        }
        whatsappMessage += `━━━━━━━━━━━━━━━━━━━━\n`;
        whatsappMessage += `📅 Fecha: ${new Date().toLocaleDateString('es-MX')}\n`;
        whatsappMessage += `🌐 Enviado desde: oaxacatextiles.mx`;
        
        // Codificar mensaje para URL
        const encodedMessage = encodeURIComponent(whatsappMessage);
        
        // Crear URL de WhatsApp
        const whatsappUrl = `https://wa.me/${WHATSAPP_ADMIN}?text=${encodedMessage}`;
        
        // Abrir WhatsApp en nueva ventana
        window.open(whatsappUrl, '_blank');
        
        return false;
    }
    
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
