<?php
/**
 * Controlador para el listado de categorías
 * 
 * Este controlador se encarga de obtener todas las categorías
 * de la base de datos y pasarlas a la vista correspondiente.
 * 
 * @requires ../model/connectaDb.php
 * @requires ../model/categories.php
 */

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/categories.php';

$conection = DB::getInstance();//Variable que contiene la conexion con la BD que es esta en una función.
$categories = getCategories($conection);

include __DIR__ . '/../views/llistar_categories.php';

?>  