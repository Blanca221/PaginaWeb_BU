<?php
//funcion pra registrarnos
function registrar($conection, $usuario, $password, $first_name, $second_name, $email, $direccion, $postal, $telefono, $pregunta_seguridad = null, $respuesta_seguridad = null) {
    try {
        // Preparamos la consulta SQL incluyendo todos los campos necesarios
        $consulta = $conection->prepare("INSERT INTO Cliente (username, password, first_name, second_name, email, direccion, postal, telefono, rol, pregunta_seguridad, respuesta_seguridad) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'usuario', ?, ?)");
        
        // Vinculamos los parámetros en el mismo orden que aparecen en la consulta
        $consulta->bindValue(1, $usuario, PDO::PARAM_STR);
        $consulta->bindValue(2, $password, PDO::PARAM_STR);
        $consulta->bindValue(3, $first_name, PDO::PARAM_STR);
        $consulta->bindValue(4, $second_name, PDO::PARAM_STR);
        $consulta->bindValue(5, $email, PDO::PARAM_STR);
        $consulta->bindValue(6, $direccion, PDO::PARAM_STR);
        $consulta->bindValue(7, $postal, PDO::PARAM_STR);
        $consulta->bindValue(8, $telefono, PDO::PARAM_STR);
        $consulta->bindValue(9, $pregunta_seguridad, PDO::PARAM_STR);
        $consulta->bindValue(10, $respuesta_seguridad, PDO::PARAM_STR);
        
        // Ejecutamos la consulta
        $consulta->execute();

        return true;
    } catch(PDOException $e) {
        // En caso de error, mostramos el mensaje
        echo "Error: " . $e->getMessage();
        return false;
    }
}

//funcion para iniciar session
function login($conection, $usuario, $password) {
    try {
        // Cambiado a tabla Cliente
        $consulta_graus = $conection->prepare("SELECT * FROM Cliente WHERE username = ?");
        $consulta_graus->bindParam(1, $usuario, PDO::PARAM_STR);
        $consulta_graus->execute();
        $resultat_graus = $consulta_graus->fetch(PDO::FETCH_ASSOC);

        if ($resultat_graus && password_verify($password, $resultat_graus['password'])) {
            // Guardamos los datos importantes en sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['id_cliente'] = $resultat_graus['id_cliente'];
            $_SESSION['username'] = $resultat_graus['username'];
            $_SESSION['rol'] = $resultat_graus['rol'];
            
            return true;
        }
        return false;

    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Función para verificar si es administrador
function esAdmin() {
    return isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador';
}

// Función para verificar si el usuario está logueado
function estaLogueado() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}

// Función para cerrar sesión
function cerrarSesion() {
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
    exit();
}

//Funciones para restablecer la contraseña del Usuario
function obtenerPreguntaSeguridad($conection, $username) {
    try {
        $consulta = $conection->prepare("SELECT pregunta_seguridad FROM Cliente WHERE username = ?");
        $consulta->bindParam(1, $username, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return false;
    }
}

function verificarRespuestaSeguridad($conection, $username, $respuesta) {
    try {
        $consulta = $conection->prepare("SELECT id_cliente FROM Cliente WHERE username = ? AND respuesta_seguridad = ?");
        $consulta->bindParam(1, $username, PDO::PARAM_STR);
        $consulta->bindParam(2, $respuesta, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetch() ? true : false;
    } catch(PDOException $e) {
        return false;
    }
}

function actualizarPassword($conection, $username, $newPassword) {
    try {
        $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $consulta = $conection->prepare("UPDATE Cliente SET password = ? WHERE username = ?");
        $consulta->bindParam(1, $password_hash, PDO::PARAM_STR);
        $consulta->bindParam(2, $username, PDO::PARAM_STR);
        return $consulta->execute();
    } catch(PDOException $e) {
        return false;
    }
}


?>
