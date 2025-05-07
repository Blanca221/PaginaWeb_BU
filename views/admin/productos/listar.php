<?php
if (!esAdmin()) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Productos - Panel de Administración</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php?action=Pagina-administracion">Panel de Administración</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Listado de Productos</h1>
            <a href="index.php?action=Pagina-administracion&subaction=crear-producto" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Producto
            </a>
        </div>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-success"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <?php if (!empty($errores)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errores as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Marca</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto['id_producto']; ?></td>
                            <td><?php echo htmlspecialchars($producto['nombre_producto']); ?></td>
                            <td><?php echo number_format($producto['precio'], 2); ?>€</td>
                            <td><?php echo $producto['stock']; ?></td>
                            <td><?php echo htmlspecialchars($producto['nombre_cat']); ?></td>
                            <td><?php echo htmlspecialchars($producto['nombre_marca']); ?></td>
                            <td>
                                <span class="badge badge-<?php echo $producto['estado'] === 'activo' ? 'success' : 'danger'; ?>">
                                    <?php echo ucfirst($producto['estado']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="index.php?action=Pagina-administracion&subaction=editar-producto&id=<?php echo $producto['id_producto']; ?>" 
                                   class="btn btn-sm btn-info" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmarEliminar(<?php echo $producto['id_producto']; ?>)" 
                                        class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function confirmarEliminar(idProducto) {
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'index.php?action=Pagina-administracion&subaction=eliminar-producto';
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id_producto';
                input.value = idProducto;
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html> 