<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/home.php';

$conection = DB::getInstance();
$heroes = getHomeHeros($conection);
$banners = getHomeBanners($conection);

// Incluir la vista de la portada
require_once __DIR__ . '/../views/portada.php';
?>