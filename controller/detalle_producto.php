<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';

// Obtener el ID del producto de la URL
$id_producto = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Obtener la conexión
$conection = DB::getInstance();

// Obtener los datos del producto
$producto = getProductById($conection, $id_producto);

// Si no existe el producto, redirigir a la lista de productos
if (!$producto) {
    header('Location: /PaginaWeb_BU/resource_productos.php');
    exit;
}

// Cargar la vista
require_once __DIR__ . '/../views/detalle_producto.php';
?> 