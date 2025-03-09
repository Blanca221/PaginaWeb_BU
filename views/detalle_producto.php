<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/PaginaWeb_BU/resource_productos.php" class="text-decoration-none">Productos</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none"><?php echo htmlspecialchars($producto['categoria_nombre']); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($producto['nombre_producto']); ?></li>
        </ol>
    </nav>

    <div class="row">
        <!-- Galería de imágenes -->
        <div class="col-md-7 mb-4">
            <div class="product-gallery">
                <?php if (!empty($producto['imagenes'])): ?>
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($producto['imagenes'] as $index => $imagen): ?>
                                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                    <img src="/PaginaWeb_BU/public/<?php echo htmlspecialchars($imagen['url_imagen']); ?>" 
                                         class="d-block w-100 rounded" 
                                         alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if (count($producto['imagenes']) > 1): ?>
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Siguiente</span>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center p-5 bg-light rounded">
                        <i class="fas fa-image fa-4x text-secondary"></i>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Información del producto -->
        <div class="col-md-5">
            <div class="product-info">
                <h1 class="h2 mb-2"><?php echo htmlspecialchars($producto['nombre_producto']); ?></h1>
                <div class="brand mb-3">
                    <span class="text-muted"><?php echo htmlspecialchars($producto['nombre_marca']); ?></span>
                </div>
                
                <div class="price mb-4">
                    <span class="h3">€<?php echo number_format($producto['precio'], 2); ?></span>
                </div>

                <?php if ($producto['stock'] > 0): ?>
                    <div class="mb-4">
                        <label class="form-label">Talla</label>
                        <select class="form-select mb-3">
                            <option value=""><?php echo htmlspecialchars($producto['talla']); ?></option>
                        </select>

                        <label class="form-label">Cantidad</label>
                        <select class="form-select mb-4">
                            <?php for ($i = 1; $i <= min(5, $producto['stock']); $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>

                        <button class="btn btn-dark w-100 mb-3">
                            <i class="fas fa-shopping-cart me-2"></i>Añadir al carrito
                        </button>
                        <button class="btn btn-outline-dark w-100">
                            <i class="fas fa-heart me-2"></i>Añadir a favoritos
                        </button>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        Producto agotado
                    </div>
                <?php endif; ?>

                <div class="product-details mt-5">
                    <h3 class="h5 mb-4">Detalles del producto</h3>
                    <p><?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></p>
                    
                    <div class="specs mt-4">
                        <div class="row g-3">
                            <div class="col-6">
                                <small class="text-muted d-block">Color</small>
                                <span><?php echo htmlspecialchars($producto['color']); ?></span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Categoría</small>
                                <span><?php echo htmlspecialchars($producto['categoria_nombre']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.product-gallery img {
    max-height: 500px;
    object-fit: contain;
    background: #f8f9fa;
}

.carousel-control-prev,
.carousel-control-next {
    background: rgba(0,0,0,0.2);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
}

.btn {
    padding: 0.8rem 1.5rem;
}

.form-select {
    padding: 0.8rem 1rem;
}
</style> 