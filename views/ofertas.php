<div class="container py-5">
    <h1 class="mb-4">Ofertas Especiales</h1>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <?php foreach ($productos as $producto) : ?>
            <div class="col">
                <div class="card h-100 producto-card shadow-sm">
                    <!-- Card -->
                    <a href="/PaginaWeb_BU/index.php?action=detalle-producto&id=<?php echo $producto['id_producto']; ?>" 
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
                                <span class="badge bg-danger">Oferta: €<?php echo number_format($producto['precio'], 2) ?></span>
                                <?php if ($producto['stock'] > 0) : ?>
                                    <span class="badge bg-success">En Stock: <?php echo $producto['stock'] ?></span>
                                <?php else : ?>
                                    <span class="badge bg-secondary">Agotado</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </a>
                    <div class="card-footer bg-white border-top-0">
                        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $producto['stock'] > 0): ?>
                            <form action="index.php?action=carrito&accion=agregar" method="post">
                                <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                                <input type="hidden" name="cantidad" value="1">
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-shopping-cart me-2"></i>Añadir al carrito
                                </button>
                            </form>
                        <?php elseif($producto['stock'] <= 0): ?>
                            <button class="btn btn-secondary w-100" disabled>
                                <i class="fas fa-times me-2"></i>Agotado
                            </button>
                        <?php else: ?>
                            <a href="index.php?action=pagina-login" class="btn btn-danger w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión para comprar
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.producto-imagen {
    height: 200px;
    object-fit: cover;
}
</style>
