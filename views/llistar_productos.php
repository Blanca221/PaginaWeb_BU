<ul>
    <?php foreach ($productos as $producto) : ?>
        <li>
            <h3><?php echo $producto['id_producto'] ?> </h3>
            <p><?php echo $producto['nombre_producto'] ?></p>
            <img src="/PaginaWeb_BU/public/PAGwebBlack/<?php echo$producto['imagen_url'] ?>">
            <p> <?php echo$producto['imagen_url'] ?></p>
        </li>
    <?php endforeach; ?>
</u++l>