<?php
/**
 * Controlador para verificar la respuesta de seguridad
 * 
 * Este controlador verifica si la respuesta de seguridad proporcionada
 * por el usuario coincide con la almacenada en la base de datos.
 * 
 * @requires ../model/connectaDb.php
 * @requires ../model/usuarios.php
 */

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

if(isset($_POST['username']) && isset($_POST['respuesta'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $respuesta = filter_var($_POST['respuesta'], FILTER_SANITIZE_STRING);
    
    $conection = DB::getInstance();
    $verificado = verificarRespuestaSeguridad($conection, $username, $respuesta);
    
    echo json_encode(['success' => $verificado]);
}