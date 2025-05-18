<div class="container py-4">
    <h2 class="mb-4">Ofertas Especiales</h2>
    
    <div class="row product-cards">
        <?php foreach ($productos as $producto) : ?>
            <div class="col-md-3 mb-4">
                <div class="product-card">
                    <a href="/PaginaWeb_BU/index.php?action=detalle-producto&id=<?php echo $producto['id_producto']; ?>" class="product-link">
                        <div class="product-image">
                            <?php if (!empty($producto['url_imagen'])) : ?>
                                <img src="/PaginaWeb_BU/public/<?php echo htmlspecialchars($producto['url_imagen']) ?>" 
                                    alt="<?php echo htmlspecialchars($producto['nombre_producto']) ?>">
                            <?php else : ?>
                                <div class="no-image">
                                    <i class="fas fa-image fa-3x"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="product-info">
                            <div class="brand-name">
                                <?php echo isset($producto['nombre_marca']) ? htmlspecialchars($producto['nombre_marca']) : ''; ?>
                            </div>
                            <div class="product-name">
                                <?php echo htmlspecialchars($producto['nombre_producto']); ?>
                            </div>
                            <div class="product-price">
                                €<?php echo number_format($producto['precio'], 2) ?>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
