<div class="container my-5">
    <h1 class="mb-4">Mi Carrito</h1>
    
    <?php if (empty($productos_carrito)): ?>
        <div class="alert alert-info">
            <p>Tu carrito está vacío. <a href="index.php?action=pagina-productos" class="alert-link">Continuar comprando</a></p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos_carrito as $producto): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php if (!empty($producto['url_imagen'])): ?>
                                        <img src="/PaginaWeb_BU/public/<?php echo $producto['url_imagen']; ?>" alt="<?php echo $producto['nombre_producto']; ?>" class="img-thumbnail me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    <?php endif; ?>
                                    <span><?php echo $producto['nombre_producto']; ?></span>
                                </div>
                            </td>
                            <td>€<?php echo number_format($producto['precio'], 2, ',', '.'); ?></td>
                            <td><?php echo $producto['cantidad']; ?></td>
                            <td>€<?php echo number_format($producto['subtotal'], 2, ',', '.'); ?></td>
                            <td>
                                <a href="index.php?action=carrito&accion=eliminar&id=<?php echo $producto['id_producto']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este producto?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total:</td>
                        <td class="fw-bold">€<?php echo number_format($total_carrito, 2, ',', '.'); ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="index.php?action=pagina-productos" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Seguir comprando
            </a>
            <a href="index.php?action=checkout" class="btn btn-success">
                Proceder al pago <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    <?php endif; ?>
</div>
