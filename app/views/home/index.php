<?php
// Vista principal - Adaptada del HTML original
?>

<style>
    /* Estilos específicos para la página home */
    body.home-page {
        font-family: 'Inter', sans-serif;
        background-color: #f5f3ef;
        color: #3d3529;
        line-height: 1.6;
    }
    
    body.home-page h1, 
    body.home-page h2, 
    body.home-page h3, 
    body.home-page h4, 
    body.home-page h5, 
    body.home-page h6 {
        font-family: 'Cormorant Garamond', serif;
        font-weight: 500;
    }
    
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
    
    /* Hero - Solo para home */
    body.home-page .hero {
        position: relative;
        min-height: 70vh;
        display: flex;
        align-items: center;
        overflow: hidden;
        margin-top: 76px;
    }
    
    body.home-page .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -2;
    }
    
    body.home-page .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, rgba(61, 53, 41, 0.85), rgba(61, 53, 41, 0.4));
        z-index: -1;
    }
    
    body.home-page .hero-content {
        color: #fff;
        max-width: 600px;
    }
    
    body.home-page .hero-subtitle {
        font-size: 0.875rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        margin-bottom: 1rem;
        color: var(--color-accent);
    }
    
    body.home-page .hero-title {
        font-size: 3.5rem;
        font-weight: 300;
        line-height: 1.1;
        margin-bottom: 1.5rem;
    }
    
    body.home-page .hero-description {
        font-size: 1.125rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        line-height: 1.7;
    }
    
    body.home-page .btn-hero {
        background-color: var(--color-accent);
        border-color: var(--color-accent);
        color: #fff;
        padding: 0.75rem 2rem;
        font-size: 0.875rem;
        letter-spacing: 0.05em;
        text-decoration: none;
        display: inline-block;
    }
    
    body.home-page .btn-hero:hover {
        background-color: #b8874e;
        border-color: #b8874e;
        color: #fff;
    }
    
    /* Section Styles - Solo para home */
    body.home-page .section {
        padding: 6rem 0;
    }
    
    body.home-page .section-subtitle {
        font-size: 0.75rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--color-primary);
        margin-bottom: 0.5rem;
    }
    
    body.home-page .section-title {
        font-size: 2.5rem;
        font-weight: 400;
        margin-bottom: 1rem;
    }
    
    body.home-page .section-description {
        color: var(--color-muted);
        max-width: 500px;
    }
    
    /* Products - Solo para home */
    body.home-page .product-card {
        background: var(--color-card);
        border: 1px solid var(--color-border);
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    body.home-page .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    body.home-page .product-img {
        width: 100%;
        height: 320px;
        object-fit: cover;
    }
    
    body.home-page .product-body {
        padding: 1.25rem;
    }
    
    body.home-page .product-category {
        font-size: 0.7rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--color-muted);
    }
    
    body.home-page .product-title {
        font-size: 1.25rem;
        margin: 0.25rem 0 0.5rem;
    }
    
    body.home-page .product-price {
        font-weight: 600;
        color: var(--color-primary);
    }
    
    /* About - Solo para home */
    body.home-page .about-section {
        background-color: var(--color-card);
    }
    
    body.home-page .about-img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    body.home-page .stat-number {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.5rem;
        font-weight: 600;
        color: var(--color-primary);
    }
    
    body.home-page .stat-label {
        font-size: 0.875rem;
        color: var(--color-muted);
    }
    
    /* Order Form - Solo para home */
    body.home-page .order-section {
        background: linear-gradient(135deg, var(--color-primary) 0%, #3a5234 100%);
        color: #fff;
    }
    
    body.home-page .order-form {
        background: var(--color-card);
        border-radius: 12px;
        padding: 2.5rem;
        color: var(--color-foreground);
    }
    
    body.home-page .form-label {
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    
    body.home-page .form-control, 
    body.home-page .form-select {
        border: 1px solid var(--color-border);
        background-color: var(--color-background);
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
    }
    
    body.home-page .form-control:focus, 
    body.home-page .form-select:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(74, 103, 65, 0.1);
    }
    
    body.home-page .btn-submit {
        background-color: var(--color-primary);
        border-color: var(--color-primary);
        padding: 0.875rem 2rem;
        font-size: 0.875rem;
        letter-spacing: 0.03em;
        width: 100%;
    }
    
    body.home-page .btn-submit:hover {
        background-color: var(--color-primary-light);
        border-color: var(--color-primary-light);
    }
    
    /* Responsive - Solo para home */
    @media (max-width: 768px) {
        body.home-page .hero-title {
            font-size: 2.5rem;
        }
        
        body.home-page .section {
            padding: 4rem 0;
        }
        
        body.home-page .section-title {
            font-size: 2rem;
        }
        
        body.home-page .order-form {
            padding: 1.5rem;
        }
    }
</style>

<!-- Hero -->
<section id="inicio" class="hero">
    <img src="https://images.unsplash.com/photo-1584908181003-9129cbb45bcd?q=80&w=2070" alt="Playa de Puerto Escondido, Oaxaca" class="hero-bg">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <p class="hero-subtitle">Puerto Escondido, Oaxaca</p>
            <h1 class="hero-title">Tradición Textil Oaxaqueña</h1>
            <p class="hero-description">
                Descubre prendas únicas tejidas a mano por artesanas de las comunidades indígenas de Oaxaca. 
                Cada pieza cuenta una historia de tradición, color y amor por nuestras raíces.
            </p>
            <a href="#coleccion" class="btn btn-hero">Explorar Colección</a>
        </div>
    </div>
</section>

<!-- Collection -->
<section id="coleccion" class="section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <p class="section-subtitle">Nuestra Colección</p>
                <h2 class="section-title">Prendas Artesanales</h2>
                <p class="section-description">
                    Cada pieza es elaborada con técnicas ancestrales transmitidas de generación en generación.
                </p>
            </div>
            <div class="col-lg-6 text-lg-end">
                <a href="<?php echo BASE_URL; ?>/categorias" class="btn btn-primary" style="background-color: var(--color-primary); border-color: var(--color-primary); padding: 0.75rem 2rem;">
                    <i class="bi bi-grid me-2"></i>Ver Todas las Categorías
                </a>
            </div>
        </div>
        
        <?php if (!empty($products)): ?>
            <div class="row g-4">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="product-card" style="cursor: pointer;" onclick="window.location.href='<?php echo BASE_URL; ?>/producto/<?php echo $product['id']; ?>'">
                            <img src="<?php echo htmlspecialchars($product['imagen_url'] ?: 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800'); ?>" 
                                 alt="<?php echo htmlspecialchars($product['nombre']); ?>" 
                                 class="product-img"
                                 onerror="this.src='https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800'">
                            <div class="product-body">
                                <span class="product-category"><?php echo htmlspecialchars($product['categoria']); ?></span>
                                <h3 class="product-title"><?php echo htmlspecialchars($product['nombre']); ?></h3>
                                <p class="product-price">$<?php echo number_format($product['precio'], 2); ?> MXN</p>
                                <?php if ($product['stock'] > 0): ?>
                                    <small class="text-muted">Stock: <?php echo $product['stock']; ?></small>
                                <?php else: ?>
                                    <small class="text-danger">Agotado</small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <p class="mb-0">No hay productos disponibles en este momento.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- About -->
<section id="nosotros" class="section about-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=800" alt="Artesanas Oaxaqueñas" class="about-img">
            </div>
            <div class="col-lg-6">
                <p class="section-subtitle">Nuestra Historia</p>
                <h2 class="section-title">Raíces que Visten</h2>
                <p class="mb-4" style="color: var(--color-muted);">
                    Desde el corazón de Puerto Escondido, trabajamos directamente con artesanas de comunidades 
                    zapotecas y mixtecas, preservando técnicas milenarias de tejido en telar de cintura y 
                    bordado a mano.
                </p>
                <p class="mb-4" style="color: var(--color-muted);">
                    Cada prenda que ofrecemos representa semanas de trabajo dedicado, usando tintes naturales 
                    extraídos de la grana cochinilla, el añil y otras plantas de la región.
                </p>
                
                <div class="row mt-5">
                    <div class="col-4 text-center">
                        <p class="stat-number">15+</p>
                        <p class="stat-label">Años de experiencia</p>
                    </div>
                    <div class="col-4 text-center">
                        <p class="stat-number">50+</p>
                        <p class="stat-label">Artesanas colaboradoras</p>
                    </div>
                    <div class="col-4 text-center">
                        <p class="stat-number">8</p>
                        <p class="stat-label">Comunidades</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Order Form -->
<section id="ordenar" class="section order-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row align-items-center g-5">
                    <div class="col-lg-5">
                        <p class="section-subtitle" style="color: var(--color-accent);">Haz tu Pedido</p>
                        <h2 class="section-title" style="color: #fff;">Llévate un Pedazo de Oaxaca</h2>
                        <p style="color: rgba(255,255,255,0.8);">
                            Completa el formulario y nos pondremos en contacto contigo para confirmar tu pedido. 
                            Realizamos envíos a todo México y al extranjero.
                        </p>
                        <div class="mt-4">
                            <p style="color: rgba(255,255,255,0.7);"><i class="bi bi-check-circle me-2"></i> Envío seguro a todo México</p>
                            <p style="color: rgba(255,255,255,0.7);"><i class="bi bi-check-circle me-2"></i> Pago contra entrega disponible</p>
                            <p style="color: rgba(255,255,255,0.7);"><i class="bi bi-check-circle me-2"></i> Garantía de autenticidad</p>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form class="order-form" id="homeOrderForm" onsubmit="return enviarWhatsAppHome(event)">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre Completo *</label>
                                    <input type="text" class="form-control" id="homeInputName" name="name" placeholder="Tu nombre" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Correo Electrónico *</label>
                                    <input type="email" class="form-control" id="homeInputEmail" name="email" placeholder="correo@ejemplo.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Teléfono / WhatsApp *</label>
                                    <input type="tel" class="form-control" id="homeInputPhone" name="phone" placeholder="+52 954 123 4567" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Prenda de Interés *</label>
                                    <select class="form-select" id="homeProductSelect" name="product" required>
                                        <option value="" selected disabled>Selecciona una opción</option>
                                        <?php if (!empty($allProducts)): ?>
                                            <?php foreach ($allProducts as $prod): ?>
                                                <option value="<?php echo $prod['id']; ?>"
                                                        data-nombre="<?php echo htmlspecialchars($prod['nombre']); ?>"
                                                        data-precio="<?php echo number_format($prod['precio'], 2); ?>">
                                                    <?php echo htmlspecialchars($prod['nombre']); ?> - $<?php echo number_format($prod['precio'], 2); ?> MXN
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <option value="otro" data-nombre="Producto Personalizado" data-precio="Por definir">Otro / Personalizado</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Talla</label>
                                    <select class="form-select" id="homeInputSize" name="size">
                                        <option value="" selected disabled>Selecciona tu talla</option>
                                        <option value="XS">XS - Extra Chica</option>
                                        <option value="S">S - Chica</option>
                                        <option value="M">M - Mediana</option>
                                        <option value="L">L - Grande</option>
                                        <option value="XL">XL - Extra Grande</option>
                                        <option value="Talla Única">Talla Única</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Estado / Ciudad</label>
                                    <input type="text" class="form-control" id="homeInputCity" name="city" placeholder="Ej: CDMX, Guadalajara">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Mensaje o Especificaciones</label>
                                    <textarea class="form-control" id="homeInputMessage" name="message" rows="3" placeholder="Cuéntanos si tienes alguna solicitud especial, colores preferidos, etc."></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary btn-submit">
                                        <i class="bi bi-whatsapp me-2"></i>Solicitar Pedido
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <script>
        // Número de WhatsApp del administrador (sin el +)
        const WHATSAPP_ADMIN = '529541364103';
        
        // Marcar el body para aplicar estilos específicos del home
        (function() {
            if (document.body) {
                document.body.classList.add('home-page');
            } else {
                document.addEventListener('DOMContentLoaded', function() {
                    document.body.classList.add('home-page');
                });
            }
        })();
        
        // Función para enviar pedido por WhatsApp desde el home
        function enviarWhatsAppHome(event) {
            event.preventDefault();
            
            // Obtener valores del formulario
            const nombre = document.getElementById('homeInputName').value.trim();
            const email = document.getElementById('homeInputEmail').value.trim();
            const telefono = document.getElementById('homeInputPhone').value.trim();
            const ciudad = document.getElementById('homeInputCity').value.trim();
            const mensaje = document.getElementById('homeInputMessage').value.trim();
            const tallaSelect = document.getElementById('homeInputSize');
            const talla = tallaSelect.options[tallaSelect.selectedIndex]?.value || 'No especificada';
            
            // Obtener producto seleccionado
            const productSelect = document.getElementById('homeProductSelect');
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
        
        // Smooth scroll for anchor links
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
