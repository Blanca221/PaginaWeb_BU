<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/home.php';
require_once __DIR__ . '/../model/productos.php';

$conection = DB::getInstance();
$heroes = getHomeHeros($conection);
$banners = getHomeBanners($conection);
$productos_destacados = getProductosAleatorios($conection, 4);

// Incluir la vista de la portada
require_once __DIR__ . '/../views/portada.php';
?>