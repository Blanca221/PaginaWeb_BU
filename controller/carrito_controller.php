<?php
/**
 * Controlador para el carrito de compras
 */
require_once __DIR__ . '/../model/connectaDB.php';
require_once __DIR__ . '/../model/carrito.php';

// Verificar si hay una acción específica
$accion = $_GET['accion'] ?? 'mostrar';

// Verificar si el usuario está logueado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php?action=pagina-login');
    exit;
}

// Obtener el ID del cliente
$id_cliente = $_SESSION['id_cliente'];

// Conectar a la base de datos
$conection = DB::getInstance();

// Procesar la acción
switch ($accion) {
    case 'agregar':
        // Verificar datos
        if (!isset($_POST['id_producto']) || !isset($_POST['cantidad'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        
        // Obtener datos
        $id_producto = filter_input(INPUT_POST, 'id_producto', FILTER_VALIDATE_INT);
        $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);
        
        // Agregar al carrito
        agregarAlCarrito($conection, $id_cliente, $id_producto, $cantidad);
        
        // Redirigir
        header('Location: index.php?action=carrito');
        exit;
        break;
        
    case 'eliminar':
        // Verificar datos
        if (!isset($_GET['id'])) {
            header('Location: index.php?action=carrito');
            exit;
        }
        
        // Obtener datos
        $id_producto = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        // Eliminar del carrito
        eliminarDelCarrito($conection, $id_cliente, $id_producto);
        
        // Redirigir
        header('Location: index.php?action=carrito');
        exit;
        break;
        
    case 'mostrar':
    default:
        // Obtener productos del carrito
        $productos_carrito = obtenerCarrito($conection, $id_cliente);
        
        // Calcular total
        $total_carrito = calcularTotalCarrito($conection, $id_cliente);
        
        // Incluir vista
        require_once __DIR__ . '/../views/carrito.php';
        break;
}
?>
