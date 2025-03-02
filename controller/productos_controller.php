<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';

$conection = DB::getInstance();
$productos = obtenerProductos($conection);
include __DIR__ . '/../views/productos_view.php';

?> 