
<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

if(isset($_POST['username']) && isset($_POST['respuesta'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $respuesta = filter_var($_POST['respuesta'], FILTER_SANITIZE_STRING);
    
    $conection = DB::getInstance();
    $verificado = verificarRespuestaSeguridad($conection, $username, $respuesta);
    
    echo json_encode(['success' => $verificado]);
}