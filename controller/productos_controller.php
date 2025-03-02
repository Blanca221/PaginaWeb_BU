<?php
/**
 * Controlador principal de productos
 * 
 * Este controlador se encarga de obtener los productos activos
 * y pasarlos a la vista correspondiente.
 * 
 * @requires ../model/connectaDb.php
 * @requires ../model/productos.php
 */

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';

$conection = DB::getInstance();
$productos = obtenerProductos($conection);
include __DIR__ . '/../views/productos_view.php';

?> 