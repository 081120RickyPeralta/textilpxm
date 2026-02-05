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
        $imageUrl = productImageUrl($product['imagen_url'] ?? '');
        
        $productUrl = BASE_URL . '/producto/' . (int)$product['id'];
        ?>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100" style="cursor: pointer;" onclick="window.location.href='<?php echo $productUrl; ?>'">
<img src="<?php echo htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8'); ?>"
                     alt="<?php echo htmlspecialchars($product['nombre'], ENT_QUOTES, 'UTF-8'); ?>"
                     class="card-img-top"
                     style="height: 320px; object-fit: cover;"
                     loading="lazy">
                <div class="card-body">
                    <span class="small text-uppercase text-muted d-block mb-2"><?php echo htmlspecialchars($product['categoria'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <h3 class="h5 mb-2"><?php echo htmlspecialchars($product['nombre'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="fw-semibold text-success mb-2">$<?php echo number_format((float)$product['precio'], 2, '.', ','); ?> MXN</p>
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
    /* Solo estilos que no se pueden reemplazar con Bootstrap - Colores personalizados */
    body.categorias-page {
        font-family: 'Inter', sans-serif !important;
    }
    
    /* Ocultar elementos del home si existen */
    body.categorias-page .hero,
    body.categorias-page .order-section,
    body.categorias-page .about-section {
        display: none !important;
    }
    
    /* Tabs personalizados con colores específicos del diseño */
    .category-tab:hover {
        color: #4a6741 !important;
        border-bottom-color: #4a6741 !important;
        background: rgba(74, 103, 65, 0.05) !important;
    }
    
    .category-tab.active {
        color: #4a6741 !important;
        border-bottom-color: #4a6741 !important;
    }
</style>

<!-- Vista de Categorías - Contenido Único -->
<div id="categorias-page-content" class="mt-5 pt-5" style="min-height: 60vh;">
    <div class="container">
        <!-- Encabezado -->
        <div class="row mb-2">
            <div class="col-12 text-center">
                <?php if (!empty($searchTerm)): ?>
                    <p class="small text-uppercase text-success mb-2">Resultados de Búsqueda</p>
                    <?php if (isset($totalProducts)): ?>
                        <div class="d-flex justify-content-center">
                            <strong class="text-muted">
                                <?php echo (int)$totalProducts; ?> <?php echo ($totalProducts == 1) ? 'producto encontrado' : 'productos encontrados'; ?>
                            </strong>
                        </div>
                    <?php endif; ?>
                    <a href="<?php echo BASE_URL; ?>/categorias" class="btn btn-outline-secondary btn-sm mt-2 mb-2">
                        <i class="bi bi-arrow-left me-2"></i>Ver todas las categorías
                    </a>
                <?php else: ?>
                    <p class="small text-uppercase text-success mb-2">Nuestra Colección Completa</p>
                    <h2 class="display-4 fw-normal mb-3">Explora por Categorías</h2>
                    <?php if (isset($totalProducts)): ?>
                        <p class="text-muted"><?php echo (int)$totalProducts; ?> <?php echo ($totalProducts == 1) ? 'producto disponible' : 'productos disponibles'; ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        
        <?php if ($hasCategories && !empty($categoryNames) && empty($searchTerm)): ?>
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-5 pb-0 border-bottom border-2">
                    <button type="button" 
                            class="category-tab btn btn-link text-decoration-none px-4 py-3 border-bottom border-3 <?php echo empty($selectedCategory) ? 'active fw-semibold' : 'border-transparent'; ?>" 
                            data-category="all"
                            aria-label="Ver todas las categorías">
                        Todas
                    </button>
                <?php foreach ($categoryNames as $categoryName): 
                    $categoryId = preg_replace('/[^a-zA-Z0-9]/', '-', strtolower($categoryName));
                ?>
                    <button type="button" 
                            class="category-tab btn btn-link text-decoration-none px-4 py-3 text-capitalize border-bottom border-3 <?php echo ($selectedCategory === $categoryName) ? 'active fw-semibold' : 'border-transparent'; ?>" 
                            data-category="<?php echo htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8'); ?>"
                            data-category-id="category-<?php echo $categoryId; ?>"
                            aria-label="Ver productos de <?php echo htmlspecialchars($categoryName); ?>">
                        <?php echo htmlspecialchars($categoryName); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php elseif (!empty($searchTerm) && !$hasCategories): ?>
            <div class="alert alert-info text-center">
                <p class="mb-0">
                    No se encontraron productos que coincidan con "<?php echo htmlspecialchars($searchTerm); ?>".
                </p>
            </div>
        <?php elseif (empty($searchTerm) && !$hasCategories): ?>
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
            <?php if (!empty($searchTerm)): ?>
                <!-- Resultados de búsqueda: mostrar todos los productos en una sola lista -->
                <div class="row g-4 mb-5">
                    <?php foreach ($productsByCategory as $categoria => $productosCategoria): ?>
                        <?php foreach ($productosCategoria as $product): ?>
                            <?php renderProductCard($product); ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <!-- Vista "Todas las categorías" normal -->
                <div id="category-all" 
                     class="category-content mb-5 <?php echo empty($selectedCategory) ? 'd-block' : 'd-none'; ?>">
                    <?php foreach ($productsByCategory as $categoria => $productosCategoria): ?>
                        <?php 
                        // Asegurar que $categoria sea un string válido
                        $categoriaNombre = is_string($categoria) ? trim($categoria) : '';
                        if (empty($categoriaNombre)) continue;
                        ?>
                        <div class="pb-4">
                            <h3 class="display-5 fw-normal mb-4 pb-2 border-bottom border-success border-2">
                                <?php echo htmlspecialchars($categoriaNombre); ?>
                            </h3>
                            <div class="row g-4">
                                <?php foreach ($productosCategoria as $product): ?>
                                    <?php renderProductCard($product); ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <!-- Vistas individuales por categoría (solo cuando no hay búsqueda) -->
            <?php if (empty($searchTerm)): ?>
                <?php foreach ($productsByCategory as $categoria => $productosCategoria): 
                    $categoryId = preg_replace('/[^a-zA-Z0-9]/', '-', strtolower($categoria));
                ?>
                    <div id="category-<?php echo $categoryId; ?>" 
                         class="category-content <?php echo ($selectedCategory === $categoria) ? 'd-block' : 'd-none'; ?>"
                         data-category-name="<?php echo htmlspecialchars($categoria, ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="row g-4 mb-5">
                            <?php foreach ($productosCategoria as $product): ?>
                                <?php renderProductCard($product); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php elseif (empty($searchTerm) && !$hasCategories): ?>
            <!-- Solo mostrar este mensaje si no hay búsqueda activa -->
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
        // Ocultar todos los contenidos usando clases de Bootstrap
        const allContents = document.querySelectorAll('.category-content');
        allContents.forEach(content => {
            content.classList.remove('d-block');
            content.classList.add('d-none');
        });
        
        // Desactivar todos los tabs
        const allTabs = document.querySelectorAll('.category-tab');
        allTabs.forEach(tab => {
            tab.classList.remove('active', 'fw-semibold');
            tab.classList.add('border-transparent');
        });
        
        // Determinar el ID del contenido a mostrar
        let contentId;
        if (category === 'all') {
            contentId = 'category-all';
        } else {
            const safeCategory = category.toLowerCase().replace(/[^a-zA-Z0-9]/g, '-');
            contentId = 'category-' + safeCategory;
        }
        
        // Mostrar el contenido seleccionado usando clases de Bootstrap
        const content = document.getElementById(contentId);
        if (content) {
            content.classList.remove('d-none');
            content.classList.add('d-block');
        }
        
        // Activar el tab correspondiente
        if (element) {
            element.classList.add('active', 'fw-semibold');
            element.classList.remove('border-transparent');
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
        // Ocultar todos los contenidos primero usando clases de Bootstrap
        document.querySelectorAll('.category-content').forEach(content => {
            content.classList.remove('d-block');
            content.classList.add('d-none');
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
