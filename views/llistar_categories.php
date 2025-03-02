/**
 * Vista para mostrar el listado de categorías
 * 
 * @var array $categories Array de categorías con sus nombres y descripciones
 */

<ul>
    <?php foreach ($categories as $categoria) : //ejercicio 3?>
        <li>
            <h3><?php echo $categoria['nombre'] ?> </h3>
            <p><?php echo htmlspecialchars($categoria['descripcion']) ?></p>
        </li>
    <?php endforeach; ?>
</ul>