<ul>
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
        <li>
            <h3><?php echo $producto['id_producto'] ?> </h3>
            <p><?php echo $producto['nombre_producto'] ?></p>
            <img src="/PaginaWeb_BU/public/PAGwebBlack/<?php echo$producto['imagen_url'] ?>">
            <p> <?php echo$producto['imagen_url'] ?></p>
        </li>
    <?php endforeach; ?>
</ul>