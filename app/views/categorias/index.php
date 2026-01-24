<?php
/**
 * Vista de categorías con sistema de tabs
 * Muestra productos agrupados por categorías con navegación por tabs
 */

/**
 * Helper function para renderizar una tarjeta de producto
 */
if (!function_exists('renderProductCard')) {
    function renderProductCard($product) {
        $imageUrl = !empty($product['imagen_url']) 
            ? htmlspecialchars($product['imagen_url'], ENT_QUOTES, 'UTF-8')
            : 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800';
        
        $productUrl = BASE_URL . '/producto/' . (int)$product['id'];
        ?>
        <div class="col-md-6 col-lg-4">
            <div class="product-card" onclick="window.location.href='<?php echo $productUrl; ?>'">
                <img src="<?php echo $imageUrl; ?>" 
                     alt="<?php echo htmlspecialchars($product['nombre'], ENT_QUOTES, 'UTF-8'); ?>" 
                     class="product-img"
                     loading="lazy"
                     onerror="this.src='https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800'">
                <div class="product-body">
                    <span class="product-category"><?php echo htmlspecialchars($product['categoria'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <h3 class="product-title"><?php echo htmlspecialchars($product['nombre'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="product-price">$<?php echo number_format((float)$product['precio'], 2, '.', ','); ?> MXN</p>
                    <?php if (isset($product['stock']) && $product['stock'] > 0): ?>
                        <small class="text-muted">Stock: <?php echo (int)$product['stock']; ?></small>
                    <?php else: ?>
                        <small class="text-danger">Agotado</small>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
}

// Validar que las variables existen
if (!isset($categoryNames)) {
    $categoryNames = [];
}
if (!isset($productsByCategory)) {
    $productsByCategory = [];
}

// Verificar que tenemos datos
$hasCategories = !empty($categoryNames) && !empty($productsByCategory);
$selectedCategory = $selectedCategory ?? null;

// Debug temporal - verificar datos
$debugInfo = [
    'categoryNames_count' => count($categoryNames),
    'categoryNames' => $categoryNames,
    'productsByCategory_count' => count($productsByCategory),
    'productsByCategory_keys' => array_keys($productsByCategory),
    'hasCategories' => $hasCategories,
    'selectedCategory' => $selectedCategory
];
?>

<script>
    // Marcar el body inmediatamente para aplicar estilos específicos de categorías
    // Esto debe ejecutarse ANTES de que se carguen los estilos del home
    (function() {
        // Remover clase de home si existe
        if (document.body) {
            document.body.classList.remove('home-page');
            document.body.classList.add('categorias-page');
        } else {
            // Si el body aún no existe, esperar a que se cree
            var observer = new MutationObserver(function(mutations) {
                if (document.body) {
                    document.body.classList.remove('home-page');
                    document.body.classList.add('categorias-page');
                    observer.disconnect();
                }
            });
            observer.observe(document.documentElement, { childList: true });
            
            // Fallback con DOMContentLoaded
            document.addEventListener('DOMContentLoaded', function() {
                if (document.body) {
                    document.body.classList.remove('home-page');
                    document.body.classList.add('categorias-page');
                }
            });
        }
    })();
</script>

<style>
    /* Estilos específicos para la página de categorías - Aislados completamente */
    body.categorias-page {
        background-color: #f5f3ef !important;
        font-family: 'Inter', sans-serif !important;
    }
    
    /* Ocultar elementos del home si existen */
    body.categorias-page .hero,
    body.categorias-page .order-section,
    body.categorias-page .about-section {
        display: none !important;
    }
    
    /* Contenedor principal de categorías */
    .categorias-page-content {
        background-color: #f5f3ef;
        min-height: 60vh;
    }
    
    /* Asegurar que los tabs sean visibles */
    .category-tabs {
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .category-tabs {
        border-bottom: 2px solid #e0dcd4;
        margin-bottom: 3rem;
        padding-bottom: 0;
        display: flex !important;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        background: transparent;
    }
    
    .category-tab {
        padding: 1rem 2rem !important;
        background: transparent !important;
        border: none !important;
        border-bottom: 3px solid transparent;
        color: #8a8070 !important;
        font-size: 1rem !important;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block !important;
        margin: 0 0.25rem;
        font-weight: 400;
        text-transform: capitalize;
    }
    
    .category-tab:hover {
        color: #4a6741 !important;
        border-bottom-color: #4a6741 !important;
        background: rgba(74, 103, 65, 0.05) !important;
    }
    
    .category-tab.active {
        color: #4a6741 !important;
        border-bottom-color: #4a6741 !important;
        font-weight: 600 !important;
    }
    
    .category-content {
        display: none !important;
    }
    
    .category-content.active {
        display: block !important;
    }
    
    .category-section {
        margin-bottom: 4rem;
        padding-bottom: 3rem;
        border-bottom: 1px solid #e0dcd4;
    }
    
    .category-section:last-child {
        border-bottom: none;
    }
    
    .product-card {
        background: #fdfcfa;
        border: 1px solid #e0dcd4;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        height: 100%;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .product-img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        background: #f5f3ef;
    }
    
    .product-body {
        padding: 1.25rem;
    }
    
    .product-category {
        font-size: 0.7rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #8a8070;
        display: block;
        margin-bottom: 0.5rem;
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
        font-size: 1.1rem;
    }
    
    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 400;
        margin-bottom: 1rem;
        color: #3d3529;
    }
</style>

<!-- Vista de Categorías - Contenido Único -->
<div id="categorias-page-content" class="categorias-page-content" style="margin-top: 100px; padding: 3rem 0; min-height: 60vh;">
    <div class="container">
        <!-- Encabezado -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <p class="section-subtitle" style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; color: #4a6741; margin-bottom: 0.5rem;">
                    Nuestra Colección Completa
                </p>
                <h2 class="section-title" style="font-size: 2.5rem; font-weight: 400; margin-bottom: 1rem;">
                    Explora por Categorías
                </h2>
                <?php if (isset($totalProducts) && $totalProducts > 0): ?>
                    <p class="text-muted"><?php echo $totalProducts; ?> productos disponibles</p>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Tabs de categorías -->
        <?php 
        // Debug temporal - mostrar información de debug
        if (isset($_GET['debug']) && $_GET['debug'] === '1'): ?>
            <div class="alert alert-info">
                <pre><?php print_r($debugInfo); ?></pre>
            </div>
        <?php endif; ?>
        
        <?php if ($hasCategories && !empty($categoryNames)): ?>
            <div class="category-tabs" style="display: flex !important; visibility: visible !important; opacity: 1 !important;">
                <button type="button" 
                        class="category-tab <?php echo empty($selectedCategory) ? 'active' : ''; ?>" 
                        data-category="all"
                        aria-label="Ver todas las categorías"
                        style="display: inline-block !important; visibility: visible !important;">
                    Todas
                </button>
                <?php foreach ($categoryNames as $categoryName): 
                    $categoryId = preg_replace('/[^a-zA-Z0-9]/', '-', strtolower($categoryName));
                ?>
                    <button type="button" 
                            class="category-tab <?php echo ($selectedCategory === $categoryName) ? 'active' : ''; ?>" 
                            data-category="<?php echo htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8'); ?>"
                            data-category-id="category-<?php echo $categoryId; ?>"
                            aria-label="Ver productos de <?php echo htmlspecialchars($categoryName); ?>"
                            style="display: inline-block !important; visibility: visible !important;">
                        <?php echo htmlspecialchars($categoryName); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                <p class="mb-0">
                    No se encontraron categorías. 
                    <?php if (empty($categoryNames)): ?>
                        <br><small>categoryNames está vacío</small>
                    <?php endif; ?>
                    <?php if (empty($productsByCategory)): ?>
                        <br><small>productsByCategory está vacío</small>
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
        
        <!-- Contenido de categorías -->
        <?php if ($hasCategories): ?>
            <!-- Vista "Todas las categorías" -->
            <div id="category-all" 
                 class="category-content <?php echo empty($selectedCategory) ? 'active' : ''; ?>"
                 style="<?php echo empty($selectedCategory) ? 'display: block !important;' : 'display: none !important;'; ?>">
                <?php foreach ($productsByCategory as $categoria => $productosCategoria): ?>
                    <div class="category-section mb-5">
                        <h3 class="section-title mb-4" style="font-size: 2rem; border-bottom: 2px solid #4a6741; padding-bottom: 0.5rem;">
                            <?php echo htmlspecialchars($categoria); ?>
                        </h3>
                        <div class="row g-4">
                            <?php foreach ($productosCategoria as $product): ?>
                                <?php renderProductCard($product); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Vistas individuales por categoría -->
            <?php foreach ($productsByCategory as $categoria => $productosCategoria): 
                $categoryId = preg_replace('/[^a-zA-Z0-9]/', '-', strtolower($categoria));
            ?>
                <div id="category-<?php echo $categoryId; ?>" 
                     class="category-content"
                     style="<?php echo ($selectedCategory === $categoria) ? 'display: block !important;' : 'display: none !important;'; ?>"
                     data-category-name="<?php echo htmlspecialchars($categoria, ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="row g-4">
                        <?php foreach ($productosCategoria as $product): ?>
                            <?php renderProductCard($product); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info text-center">
                <p class="mb-0">No hay productos disponibles en este momento.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    /**
     * Función para mostrar una categoría específica
     */
    function showCategory(category, element) {
        // Ocultar todos los contenidos
        const allContents = document.querySelectorAll('.category-content');
        allContents.forEach(content => {
            content.classList.remove('active');
            content.style.display = 'none';
        });
        
        // Desactivar todos los tabs
        const allTabs = document.querySelectorAll('.category-tab');
        allTabs.forEach(tab => {
            tab.classList.remove('active');
        });
        
        // Determinar el ID del contenido a mostrar
        let contentId;
        if (category === 'all') {
            contentId = 'category-all';
        } else {
            const safeCategory = category.toLowerCase().replace(/[^a-zA-Z0-9]/g, '-');
            contentId = 'category-' + safeCategory;
        }
        
        // Mostrar el contenido seleccionado
        const content = document.getElementById(contentId);
        if (content) {
            content.classList.add('active');
            content.style.display = 'block';
        }
        
        // Activar el tab correspondiente
        if (element) {
            element.classList.add('active');
        }
        
        // Actualizar URL sin recargar
        const url = new URL(window.location);
        if (category === 'all') {
            url.searchParams.delete('cat');
        } else {
            url.searchParams.set('cat', encodeURIComponent(category));
        }
        window.history.pushState({}, '', url);
        
        // Scroll suave al inicio
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    
    /**
     * Inicializar eventos de los tabs
     */
    function initTabs() {
        const tabs = document.querySelectorAll('.category-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const category = this.getAttribute('data-category');
                showCategory(category, this);
            });
        });
    }
    
    /**
     * Cargar categoría desde URL al cargar la página
     */
    function loadCategoryFromURL() {
        // Ocultar todos los contenidos primero
        document.querySelectorAll('.category-content').forEach(content => {
            content.style.display = 'none';
        });
        
        const urlParams = new URLSearchParams(window.location.search);
        const cat = urlParams.get('cat');
        
        if (cat) {
            const tab = document.querySelector(`.category-tab[data-category="${cat}"]`);
            if (tab) {
                showCategory(cat, tab);
                return;
            }
        }
        
        // Si no hay categoría en la URL, mostrar "Todas" por defecto
        const allTab = document.querySelector('.category-tab[data-category="all"]');
        if (allTab) {
            showCategory('all', allTab);
        }
    }
    
    // Inicializar cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', function() {
        initTabs();
        loadCategoryFromURL();
    });
})();
</script>
