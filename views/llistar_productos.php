<!-- Vista de listado de productos -->
<div class="container py-4">
    
    <?php if (isset($tituloPagina)): ?>
        <div class="mb-4">
            <h2><?php echo htmlspecialchars($tituloPagina); ?></h2>
        </div>
    <?php endif; ?>
    
    <?php if (isset($terminoBusqueda) && !empty($terminoBusqueda) && empty($productos)): ?>
        <div class="alert alert-info">
            No se encontraron resultados para "<?php echo htmlspecialchars($terminoBusqueda); ?>". 
        </div>
    <?php endif; ?>
    
    <div class="row product-cards">
    <?php if (!empty($productos)): ?>
        <?php foreach ($productos as $producto) : ?>
            <div class="col-md-3 mb-4">
                <div class="product-card">
                    <a href="/PaginaWeb_BU/index.php?action=detalle-producto&id=<?php echo intval($producto['id_producto']); ?>" class="product-link">
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
                                €<?php echo number_format(floatval($producto['precio']), 2) ?>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="alert alert-info">
                No hay productos disponibles.
            </div>
        </div>
    <?php endif; ?>
    </div>
</div>