

<div class="productos-grid">
    <!-- /**
        * Vista para mostrar la cuadrícula de productos
        * 
        * Esta vista muestra los productos en un formato de cuadrícula
        * con imágenes y detalles de cada producto.
        * 
        * @var array $productos Array de productos con toda su información
        */ -->
    <?php foreach($productos as $producto): ?>
        <div class="producto-card">
            <img class="producto-imagen" 
                 src="/PaginaWeb_BU/<?php echo htmlspecialchars($producto['imagen_url']); ?>" 
                 alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>"
                 style="width: 200px; height: auto;"
            >
            <p>Ruta de imagen: <?php echo htmlspecialchars($producto['imagen_url']); ?></p>
            
            <h3><?php echo htmlspecialchars($producto['nombre_producto']); ?></h3>
            <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
            <p>Precio: €<?php echo number_format($producto['precio'], 2); ?></p>
            <p>Color: <?php echo htmlspecialchars($producto['color']); ?></p>
            <p>Talla: <?php echo htmlspecialchars($producto['talla']); ?></p>
        </div>
    <?php endforeach; ?>
</div> 