<?php
/**
 * Controlador para el cambio de contraseña
 * 
 * Este controlador procesa la solicitud de cambio de contraseña,
 * verifica los datos recibidos y actualiza la contraseña del usuario.
 * 
 * @requires ../model/connectaDb.php
 * @requires ../model/usuarios.php
 */

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

if(isset($_POST['username_final']) && isset($_POST['new_password'])) {
    $username = filter_var($_POST['username_final'], FILTER_SANITIZE_STRING);
    $newPassword = $_POST['new_password'];
    
    $conection = DB::getInstance();
    $actualizado = actualizarPassword($conection, $username, $newPassword);
    //aqui tengo que añadir una view para que muestre un mensaje de actualizacion
    if($actualizado) {
        header('Location: ?action=pagina-login&message=password_updated');
    } else {
        header('Location: ?action=Pagina-restablecerPassword&error=1');
    }
}