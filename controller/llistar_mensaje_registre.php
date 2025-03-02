<?php
/**
 * Controlador para mostrar mensajes de registro
 * 
 * Este controlador se encarga de obtener el mensaje de registro
 * correspondiente de la base de datos y pasarlo a la vista.
 * 
 * @requires ../model/connectaDb.php
 * @requires ../model/mensajes.php
 */

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/mensajes.php';

$conection = DB::getInstance();
$mensaje = getMensaje($conection, 2);

include __DIR__ . '/../views/llistar_mensaje_registre.php';

?>