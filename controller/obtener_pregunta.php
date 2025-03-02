<?php
/**
 * Controlador para obtener la pregunta de seguridad
 * 
 * Este controlador obtiene la pregunta de seguridad asociada
 * a un nombre de usuario específico.
 * 
 * @requires ../model/connectaDb.php
 * @requires ../model/usuarios.php
 */

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

if(isset($_POST['username'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $conection = DB::getInstance();
    
    $resultado = obtenerPreguntaSeguridad($conection, $username);
    
    if($resultado) {
        echo json_encode([
            'success' => true,
            'pregunta' => $resultado['pregunta_seguridad']
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Usuario no encontrado'
        ]);
    }
}