<?php
/**
 * Controlador para mostrar las ofertas
 */
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';

// Obtener la conexión a la base de datos
$conection = DB::getInstance();

// Obtener todos los productos en oferta
// Aquí podrías implementar una lógica específica para obtener solo productos en oferta
// Por ahora, simplemente mostramos todos los productos
$productos = getAllProducts($conection);

// Incluir la vista de productos
include __DIR__ . '/../views/ofertas.php';
?>
