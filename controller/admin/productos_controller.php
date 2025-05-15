<?php
require_once __DIR__ . '/../../model/connectaDB.php';
require_once __DIR__ . '/../../model/productos.php';
$conection = DB::getInstance();

if (!esAdmin()) {
    header('Location: index.php');
    exit();
}

$errores = [];
$mensaje = '';

// Procesar formularios POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si es eliminar, no validar nada más
    if ($subaction === 'eliminar-producto' && isset($_POST['id_producto'])) {
        if (eliminarProducto($conection, $_POST['id_producto'])) {
            $mensaje = "Producto eliminado exitosamente";
            header('Location: index.php?action=Pagina-administracion');
            exit();
        } else {
            $errores[] = "Error al eliminar el producto";
        }
    } else {
        // Validación del lado del servidor SOLO para crear/editar
        if (empty($_POST['nombre_producto'])) {
            $errores[] = "El nombre del producto es obligatorio";
        }
        if (!isset($_POST['precio']) || !is_numeric($_POST['precio']) || $_POST['precio'] <= 0) {
            $errores[] = "El precio debe ser un número mayor que 0";
        }
        if (!isset($_POST['stock']) || !is_numeric($_POST['stock']) || $_POST['stock'] < 0) {
            $errores[] = "El stock debe ser un número no negativo";
        }
        if (empty($_POST['id_categoria'])) {
            $errores[] = "La categoría es obligatoria";
        }
        
        // Si no hay errores, procesar la acción
        if (empty($errores)) {
            switch ($subaction) {
                case 'crear-producto':
                    if (crearProducto($conection, $_POST)) {
                        $mensaje = "Producto creado exitosamente";
                    } else {
                        $errores[] = "Error al crear el producto";
                    }
                    break;
                    
                    case 'editar-producto':
                        if (actualizarProducto($conection, $_POST)) {
                            header('Location: index.php?action=Pagina-administracion&subaction=listar-productos');
                            exit();
                        } else {
                            $errores[] = "Error al actualizar el producto";
                        }
                        break;
            }
        }
    }
}

// Cargar datos necesarios para los formularios
$categorias = obtenerCategorias($conection);
$marcas = obtenerMarcas($conection);

// Cargar la vista correspondiente
switch ($subaction) {
    case 'crear-producto':
        include __DIR__ . '/../../views/admin/productos/crear.php';
        break;
        
    case 'editar-producto':
        $id_producto = $_GET['id'] ?? null;
        if ($id_producto) {
            $producto = getProductById($conection, $id_producto);
            if ($producto) {
                include __DIR__ . '/../../views/admin/productos/editar.php';
            } else {
                $errores[] = "Producto no encontrado";
                include __DIR__ . '/../../views/admin/panel.php';
            }
        }
        break;
        
    default:
        $productos = listarProductos($conection);
        include __DIR__ . '/../../views/admin/productos/listar.php';
        break;
}
?> 