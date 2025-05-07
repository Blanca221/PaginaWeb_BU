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
    <title>Editar Producto - Panel de Administración</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php?action=Pagina-administracion">Panel de Administración</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Editar Producto</h1>

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

        <form action="index.php?action=Pagina-administracion&subaction=editar-producto" method="POST" onsubmit="return validarFormulario()">
            <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
            
            <div class="form-group">
                <label for="nombre_producto">Nombre del Producto *</label>
                <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" 
                       value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="precio">Precio *</label>
                    <input type="number" class="form-control" id="precio" name="precio" step="0.01" 
                           value="<?php echo $producto['precio']; ?>" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="stock">Stock *</label>
                    <input type="number" class="form-control" id="stock" name="stock" 
                           value="<?php echo $producto['stock']; ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="id_categoria">Categoría *</label>
                    <select class="form-control" id="id_categoria" name="id_categoria" required>
                        <option value="">Seleccione una categoría</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo $categoria['id_categoria']; ?>" 
                                    <?php echo $categoria['id_categoria'] == $producto['id_categoria'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($categoria['nombre_cat']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="id_marca">Marca *</label>
                    <select class="form-control" id="id_marca" name="id_marca" required>
                        <option value="">Seleccione una marca</option>
                        <?php foreach ($marcas as $marca): ?>
                            <option value="<?php echo $marca['id_marca']; ?>" 
                                    <?php echo $marca['id_marca'] == $producto['id_marca'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($marca['nombre_marca']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" id="color" name="color" 
                           value="<?php echo htmlspecialchars($producto['color']); ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="talla">Talla</label>
                    <input type="text" class="form-control" id="talla" name="talla" 
                           value="<?php echo htmlspecialchars($producto['talla']); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select class="form-control" id="estado" name="estado">
                    <option value="activo" <?php echo $producto['estado'] === 'activo' ? 'selected' : ''; ?>>Activo</option>
                    <option value="inactivo" <?php echo $producto['estado'] === 'inactivo' ? 'selected' : ''; ?>>Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="index.php?action=Pagina-administracion" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function validarFormulario() {
            const nombre = document.getElementById('nombre_producto').value;
            const precio = document.getElementById('precio').value;
            const stock = document.getElementById('stock').value;
            const categoria = document.getElementById('id_categoria').value;
            const marca = document.getElementById('id_marca').value;
            
            let errores = [];
            
            if (!nombre || nombre.trim() === '') {
                errores.push('El nombre del producto es obligatorio');
            }
            
            if (!precio || isNaN(precio) || precio <= 0) {
                errores.push('El precio debe ser un número mayor que 0');
            }
            
            if (!stock || isNaN(stock) || stock < 0) {
                errores.push('El stock debe ser un número no negativo');
            }
            
            if (!categoria) {
                errores.push('Debe seleccionar una categoría');
            }
            
            if (!marca) {
                errores.push('Debe seleccionar una marca');
            }
            
            if (errores.length > 0) {
                alert(errores.join('\n'));
                return false;
            }
            
            return true;
        }
    </script>
</body>
</html> 