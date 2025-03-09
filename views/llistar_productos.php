<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    <!-- /**
        * Vista para mostrar la lista de productos
        * 
        * Esta vista muestra una lista de productos con sus detalles:
        * - ID del producto
        * - Nombre del producto
        * - Imagen del producto
        * - URL de la imagen
        * 
        * @var array $productos Array de productos con toda su información
        */ -->
    <?php foreach ($productos as $producto) : ?>
        <div class="col">
            <div class="card h-100 producto-card shadow-sm">
                <!-- Card -->
                <a href="/PaginaWeb_BU/resource_detalle_producto.php?id=<?php echo $producto['id_producto']; ?>" 
                   class="text-decoration-none">
                    <?php if (!empty($producto['url_imagen'])) : ?>
                        <img class="card-img-top producto-imagen" 
                             src="/PaginaWeb_BU/public/<?php echo htmlspecialchars($producto['url_imagen']) ?>" 
                             alt="<?php echo htmlspecialchars($producto['nombre_producto']) ?>">
                    <?php else : ?>
                        <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center producto-imagen">
                            <i class="fas fa-image fa-3x"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h5 class="card-title text-dark"><?php echo htmlspecialchars($producto['nombre_producto']) ?></h5>
                        <p class="card-text">
                            <span class="badge bg-primary">€<?php echo number_format($producto['precio'], 2) ?></span>
                            <?php if ($producto['stock'] > 0) : ?>
                                <span class="badge bg-success">En Stock: <?php echo $producto['stock'] ?></span>
                            <?php else : ?>
                                <span class="badge bg-danger">Agotado</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </a>
                <div class="card-footer bg-white border-top-0">
                    <button class="btn btn-primary w-100">
                        <i class="fas fa-shopping-cart me-2"></i>Añadir al carrito
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>