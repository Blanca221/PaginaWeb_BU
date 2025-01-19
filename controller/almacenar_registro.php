
<!--[5] (M) Guarda en $_SESSION todos los datos del registro, al hacer clic en el boton "Enviar" (Sin ajax)
        Una vez guardados, muestra una pagina de que los datos se han guardado correctamente y los datos introducidos.-->

<!--6.Crea una validacion de servidor antes de guardar los datos en $_SESSION igual que la validacion del cliente.
        Los campos tienen que cumplir los siguientes requisitos.
                username: debe tener entre 4 y 20 caracteres
                password: debe tener entre 4 y 20 caracteres
                first_name: debe tener entre 4 y 40 caracteres
                email: debe tener un formato de email
                postal: debe tener 5 catacteres !!numericos!!
                "TODOS": deben ser obligatorio.
        Pista: utiliza la funcion "filter_var" y "strlen"-->


        <?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

if (isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['first_name']) &&
    isset($_POST['email']) &&
    isset($_POST['postal_code']) &&
    isset($_POST['pregunta_seguridad']) &&
    isset($_POST['respuesta_seguridad'])
    ) {
    
    if ((strlen($_POST['username']) >= 4 &&
        strlen($_POST['username']) <= 20 &&
        strlen($_POST['password']) >= 4 &&
        strlen($_POST['password']) <= 20 &&
        strlen($_POST['first_name']) >= 4 &&
        strlen($_POST['first_name']) <= 40 &&
        filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
        strlen($_POST['postal_code']) == 5)
        ) {
        
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['first_name'] = $_POST['first_name'];
        $_SESSION['second_name'] = $_POST['second_name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['direccion'] = $_POST['direccion'];
        $_SESSION['postal_code'] = $_POST['postal_code'];
        $_SESSION['telefono'] = $_POST['telefono'];
        $_SESSION['pregunta_seguridad'] = $_POST['pregunta_seguridad'];
        $_SESSION['respuesta_seguridad'] = $_POST['respuesta_seguridad'];
        
        $password = password_hash($_SESSION['password'], PASSWORD_DEFAULT);
        
        $conection = DB::getInstance();
        $registre = registrar($conection, 
            $_SESSION['username'], 
            $password, 
            $_SESSION['first_name'],
            $_SESSION['second_name'],
            $_SESSION['email'],
            $_SESSION['direccion'], 
            $_SESSION['postal_code'], 
            $_SESSION['telefono'],
            $_SESSION['pregunta_seguridad'] ?? null,
            $_SESSION['respuesta_seguridad'] ?? null
        );
        if ($registre) {
            $mensaje = "Registro correcto";
        } else {
            $mensaje = "Error en el registro al almacenar en la base de datos.";
        }
    } else {
        $mensaje = "Error en el registro, los campos no cumplen los requisitos.";
    }
} else {
    $mensaje = "Error en el registro, faltan campos.";
}

include __DIR__ . '/../views/llistar_registre.php';