<!-- Banner -->
<div class="banner-section bg-info py-5 text-white text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Contacto</h1>
        <p class="lead">Estamos aquí para ayudarte</p>
    </div>
</div>

<!-- Sección principal -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h3 class="mb-4">Información de Contacto</h3>
                        
                        <div class="mb-3">
                            <i class="bi bi-geo-alt fs-1 text-info"></i>
                            <h5>Dirección</h5>
                            <p>Av. Principal 123, Lima, Perú</p>
                        </div>
                        
                        <div class="mb-3">
                            <i class="bi bi-envelope fs-1 text-info"></i>
                            <h5>Email</h5>
                            <p>info@<?php echo SITE_NAME; ?>.com</p>
                        </div>
                        
                        <div class="mb-3">
                            <i class="bi bi-telephone fs-1 text-info"></i>
                            <h5>Teléfono</h5>
                            <p>+51 123 456 789</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h3 class="mb-0">
                            <i class="bi bi-send"></i> Envíanos un mensaje
                        </h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/contact">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nombre Completo</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Asunto</label>
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Mensaje</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-info text-white btn-lg">
                                <i class="bi bi-send-fill"></i> Enviar Mensaje
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>