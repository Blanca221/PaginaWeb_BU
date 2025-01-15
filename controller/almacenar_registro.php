
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
        isset($_POST['postal_code'])
        ) {
        //(validacion ejer.6)
        if ((strlen($_POST['username']) >= 4 &&//entre 4 y 20 caracteres
            strlen($_POST['username']) <= 20 &&

            strlen($_POST['password']) >= 4 &&
            strlen($_POST['password']) <= 20 &&

            strlen($_POST['first_name']) >= 4 &&
            strlen($_POST['first_name']) <= 40 &&

            filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
            strlen($_POST['postal_code']) == 5)
            ) {
            //almacena las variables envidas del formulario (ejer.5)
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['first_name'] = $_POST['first_name'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['postal_code'] = $_POST['postal_code'];
            
            //Contraseña hasheada(ejer.8)

            $password = password_hash($_SESSION['password'], PASSWORD_DEFAULT);
            //Conexion a la base de datos
            $conection = DB::getInstance();
            //aqui llama a la funcion de registrar del model usuario.php ESTA LINEA ES LA IMORTANTE
            $registre = registrar($conection, $_SESSION['username'], $password);

            if ($registre) {
                $mensaje = "Registro correcto";
            } else {
                $mensaje = "Error en el registr al almacenar en la base de datos.";
            }

        } else {
            $mensaje = "Error en el registro, los campos no cumple los requisitos.";
        }
    } else {
        $mensaje = "Error en el registro, faltan campos.";
    }
    //Llama la vista de llistar registro
    include __DIR__ . '/../views/llistar_registre.php';
?>