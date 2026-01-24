<?php
// Vista de formulario para crear/editar productos
$isEdit = isset($product) && $product !== null;
$product = $product ?? [];
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-<?php echo $isEdit ? 'warning' : 'primary'; ?> text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="bi bi-<?php echo $isEdit ? 'pencil-square' : 'plus-circle'; ?> me-2"></i>
                            <?php echo $isEdit ? 'Editar Producto' : 'Agregar Nuevo Producto'; ?>
                        </h4>
                        <a href="<?php echo BASE_URL; ?>/products" class="btn btn-light btn-sm">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (isset($flash_message)): ?>
                        <div class="alert alert-<?php echo $flash_type ?? 'danger'; ?> alert-dismissible fade show">
                            <?php echo htmlspecialchars($flash_message); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="<?php echo BASE_URL; ?>/products/<?php echo $isEdit ? 'update/' . $product['id'] : 'store'; ?>">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label fw-bold">
                                        <i class="bi bi-tag me-2"></i>Nombre del Producto *
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg" 
                                           id="nombre" 
                                           name="nombre" 
                                           value="<?php echo htmlspecialchars($product['nombre'] ?? ''); ?>" 
                                           required
                                           placeholder="Ej: Huipil de Gala">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="categoria" class="form-label fw-bold">
                                        <i class="bi bi-folder me-2"></i>Categoría *
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg" 
                                           id="categoria" 
                                           name="categoria" 
                                           list="categorias-list"
                                           value="<?php echo htmlspecialchars($product['categoria'] ?? ''); ?>" 
                                           required
                                           placeholder="Ej: Huipiles">
                                    <datalist id="categorias-list">
                                        <?php 
                                        $categoriasExistentes = ['Huipiles', 'Blusas', 'Rebozos', 'Camisas', 'Calzado', 'Accesorios'];
                                        $categoriasBD = [];
                                        if (isset($categories) && is_array($categories)) {
                                            foreach ($categories as $cat) {
                                                if (isset($cat['categoria'])) {
                                                    $categoriasBD[] = $cat['categoria'];
                                                }
                                            }
                                        }
                                        $categorias = array_unique(array_merge($categoriasExistentes, $categoriasBD));
                                        sort($categorias);
                                        foreach ($categorias as $cat):
                                        ?>
                                            <option value="<?php echo htmlspecialchars($cat); ?>">
                                        <?php endforeach; ?>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="precio" class="form-label fw-bold">
                                        <i class="bi bi-currency-dollar me-2"></i>Precio (MXN) *
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text">$</span>
                                        <input type="number" 
                                               class="form-control" 
                                               id="precio" 
                                               name="precio" 
                                               step="0.01" 
                                               min="0" 
                                               value="<?php echo htmlspecialchars($product['precio'] ?? ''); ?>" 
                                               required
                                               placeholder="0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="stock" class="form-label fw-bold">
                                        <i class="bi bi-box-seam me-2"></i>Stock Disponible *
                                    </label>
                                    <input type="number" 
                                           class="form-control form-control-lg" 
                                           id="stock" 
                                           name="stock" 
                                           min="0" 
                                           value="<?php echo htmlspecialchars($product['stock'] ?? '0'); ?>" 
                                           required
                                           placeholder="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold d-block">
                                        <i class="bi bi-toggle-on me-2"></i>Estado
                                    </label>
                                    <div class="form-check form-switch form-switch-lg mt-2">
                                        <input type="checkbox" 
                                               class="form-check-input" 
                                               id="activo" 
                                               name="activo" 
                                               value="1" 
                                               <?php echo (!isset($product['activo']) || $product['activo']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="activo">
                                            <span id="estado-texto"><?php echo (!isset($product['activo']) || $product['activo']) ? 'Activo' : 'Inactivo'; ?></span>
                                        </label>
                                    </div>
                                    <small class="text-muted">Los productos inactivos no aparecen en el catálogo público</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold d-block">
                                        <i class="bi bi-star me-2"></i>Mostrar en Portada
                                    </label>
                                    <div class="form-check form-switch form-switch-lg mt-2">
                                        <input type="checkbox" 
                                               class="form-check-input" 
                                               id="portada" 
                                               name="portada" 
                                               value="1" 
                                               <?php echo (isset($product['portada']) && $product['portada']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="portada">
                                            <span id="portada-texto"><?php echo (isset($product['portada']) && $product['portada']) ? 'Sí' : 'No'; ?></span>
                                        </label>
                                    </div>
                                    <small class="text-muted">Los productos marcados aparecerán en la página principal</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tallas_disponibles" class="form-label fw-bold">
                                        <i class="bi bi-rulers me-2"></i>Tallas Disponibles
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="tallas_disponibles" 
                                           name="tallas_disponibles" 
                                           value="<?php echo htmlspecialchars($product['tallas_disponibles'] ?? ''); ?>" 
                                           placeholder="Ej: XS, S, M, L, XL">
                                    <small class="form-text text-muted">
                                        Separa las tallas con comas (ej: XS, S, M, L, XL)
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="imagen_url" class="form-label fw-bold">
                                <i class="bi bi-image me-2"></i>URL de la Imagen
                            </label>
                            <input type="url" 
                                   class="form-control" 
                                   id="imagen_url" 
                                   name="imagen_url" 
                                   value="<?php echo htmlspecialchars($product['imagen_url'] ?? ''); ?>" 
                                   placeholder="https://ejemplo.com/imagen.jpg">
                            <small class="form-text text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Ingresa la URL completa de la imagen del producto
                            </small>
                            <?php if (!empty($product['imagen_url'])): ?>
                                <div class="mt-2">
                                    <img src="<?php echo htmlspecialchars($product['imagen_url']); ?>" 
                                         alt="Vista previa" 
                                         class="img-thumbnail" 
                                         style="max-width: 200px; max-height: 200px;"
                                         onerror="this.style.display='none'">
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold">
                                <i class="bi bi-card-text me-2"></i>Descripción del Producto
                            </label>
                            <textarea class="form-control" 
                                      id="descripcion" 
                                      name="descripcion" 
                                      rows="6" 
                                      placeholder="Describe las características, materiales, técnicas de elaboración, etc. del producto..."><?php echo htmlspecialchars($product['descripcion'] ?? ''); ?></textarea>
                            <small class="form-text text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Una buena descripción ayuda a los clientes a conocer mejor el producto
                            </small>
                        </div>
                        
                        <hr class="my-4">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <a href="<?php echo BASE_URL; ?>/products" class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-arrow-left me-2"></i>Cancelar y Volver
                            </a>
                            <button type="submit" class="btn btn-<?php echo $isEdit ? 'warning' : 'primary'; ?> btn-lg px-5">
                                <i class="bi bi-<?php echo $isEdit ? 'check-circle' : 'save'; ?>-fill me-2"></i>
                                <?php echo $isEdit ? 'Actualizar Producto' : 'Guardar Producto'; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Actualizar texto del estado cuando cambia el switch
    document.getElementById('activo')?.addEventListener('change', function() {
        const texto = document.getElementById('estado-texto');
        if (texto) {
            texto.textContent = this.checked ? 'Activo' : 'Inactivo';
        }
    });
    
    // Actualizar texto de portada cuando cambia el switch
    document.getElementById('portada')?.addEventListener('change', function() {
        const texto = document.getElementById('portada-texto');
        if (texto) {
            texto.textContent = this.checked ? 'Sí' : 'No';
        }
    });
</script>
