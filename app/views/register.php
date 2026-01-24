<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="text-center mb-0">
                        <i class="bi bi-person-plus"></i> Crear Cuenta
                    </h3>
                </div>
                <div class="card-body">
                    <?php if (isset($flash_message) && !empty($flash_message)): ?>
                        <div class="alert alert-<?php echo $flash_type ?? 'danger'; ?> alert-dismissible fade show">
                            <?php echo htmlspecialchars($flash_message); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="<?php echo BASE_URL; ?>/register">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>"
                                   required 
                                   autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   required 
                                   minlength="6">
                            <small class="form-text text-muted">Mínimo 6 caracteres</small>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-person-plus-fill me-2"></i> Crear Cuenta
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-0">
                        ¿Ya tienes cuenta? <a href="<?php echo BASE_URL; ?>/login">Inicia sesión aquí</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>