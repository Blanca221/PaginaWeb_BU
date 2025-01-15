<?php
//Ejercicio 3
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/categories.php';

$conection = DB::getInstance();//Variable que contiene la conexion con la BD que es esta en una función.
$categories = getCategories($conection);

include __DIR__ . '/../views/llistar_categories.php';

?>  