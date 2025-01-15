<ul>
    <?php foreach ($productos as $producto) : ?>
        <li>
            <h3><?php echo $producto['product_name'] ?> </h3>
            <p><?php echo htmlspecialchars($producto['stock']) ?></p>
        </li>
    <?php endforeach; ?>
</ul>