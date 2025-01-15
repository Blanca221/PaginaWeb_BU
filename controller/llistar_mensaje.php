<?php
/*2.
    Mofifica el "resource_portada", agrega el mensaje con el id 1 de la tabla MENSAJES.
    Dentro del div con el id "mensaje-1".
    (Obligatorio MVC, vista tiene que devolver el mensaje dentro de un parrafo <p>)
*/
//CONECTA A LA BASE DE DATOS LLAMA AL MODEL DONDE TIENE UNA CLASE
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/mensajes.php';

$conection = DB::getInstance();
$mensaje = getMensaje($conection, 1);

include __DIR__ . '/../views/llistar_mensaje.php';

?>