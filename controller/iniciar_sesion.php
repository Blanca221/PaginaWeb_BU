<!--11] (M) Crea una pagina para iniciar sesion y que sea funcional. Tienes que comprobar si el usuario y la password corresponde con las
        que hayas creado anteriormente.

-->
<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

$conection = DB::getInstance();

$ok = login($conection, $_POST["username"], $_POST["password"]);//son las variables del formulario

if ($ok) {
    $_SESSION["username"] = $_POST["username"];
    include __DIR__ . '/../views/login_ok.php';
} else {
    $error = "Usuari o contrasenya incorrectes";
    include __DIR__ . '/../views/login_bad.php';
}

?>