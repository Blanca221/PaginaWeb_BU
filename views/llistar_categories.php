

<ul>
    <!-- /**
        * Vista para mostrar la lista de categorías
        * 
        * Esta vista muestra una lista de categorías con sus detalles:
        * - Nombre de la categoría
        * - Descripción de la categoría
        * 
        * @var array $categorias Array de categorías con toda su información
        */ -->
    <?php foreach ($categories as $categoria) : //ejercicio 3?>
        <li>
            <h3><?php echo $categoria['nombre_cat'] ?> </h3>
            <p><?php echo htmlspecialchars($categoria['descripcion']) ?></p>
        </li>
    <?php endforeach; ?>
</ul>