<!--11] (M) Crea una pagina para iniciar sesion y que sea funcional. Tienes que comprobar si el usuario y la password corresponde con las
        que hayas creado anteriormente.

-->
<?php
/**
 * Controlador para el inicio de sesión
 * 
 * Este controlador maneja la autenticación de usuarios,
 * verificando las credenciales y estableciendo la sesión.
 * 
 * @requires ../model/connectaDb.php
 * @requires ../model/usuarios.php
 */

require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

session_start();

$conection = DB::getInstance();

$ok = login($conection, $_POST["username"], $_POST["password"]);

if ($ok) {
    // Si el usuario es administrador, redirigir al panel de administración
    if (esAdmin()) {
        header("Location: index.php?action=Pagina-administracion");
        exit();
    } else {
        // Si es un usuario normal, redirigir a la página principal
        header("Location: index.php");
        exit();
    }
} else {
    // Guardar el mensaje de error en la sesión
    $_SESSION['login_error'] = "Usuario o contraseña incorrectos";
    
    // Redirigir de vuelta a la página de login
    header("Location: index.php?action=pagina-login");
    exit();
}
?>