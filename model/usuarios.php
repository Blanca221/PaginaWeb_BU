<?php
/**
 * Funciones para la gestión de usuarios
 * 
 * Este archivo contiene todas las funciones relacionadas con la gestión de usuarios,
 * incluyendo registro, login, verificación de roles y gestión de contraseñas.
 */

//funcion pra registrarnos
/**
 * Registra un nuevo usuario en la base de datos
 *
 * @param PDO $conection Conexión a la base de datos
 * @param string $usuario Nombre de usuario
 * @param string $password Contraseña hasheada del usuario
 * @param string $first_name Nombre del usuario
 * @param string|null $second_name Apellido del usuario
 * @param string $email Correo electrónico
 * @param string $direccion Dirección postal
 * @param string $postal Código postal
 * @param string $telefono Número de teléfono
 * @param string|null $pregunta_seguridad Pregunta de seguridad
 * @param string|null $respuesta_seguridad Respuesta a la pregunta de seguridad
 * @param string $rol Rol del usuario
 * @return bool True si el registro fue exitoso, False en caso contrario
 */
function registrar($conection, $usuario, $password, $first_name, $second_name, $email, $direccion, $postal, $telefono, $pregunta_seguridad = null, $respuesta_seguridad = null, $rol = 'usuario') {
    try {
        // Preparamos la consulta SQL incluyendo todos los campos necesarios
        $consulta = $conection->prepare("INSERT INTO Cliente (username, password, first_name, second_name, email, direccion, postal, telefono, rol, pregunta_seguridad, respuesta_seguridad) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Vinculamos los parámetros en el mismo orden que aparecen en la consulta
        $consulta->bindValue(1, $usuario, PDO::PARAM_STR);
        $consulta->bindValue(2, $password, PDO::PARAM_STR);
        $consulta->bindValue(3, $first_name, PDO::PARAM_STR);
        $consulta->bindValue(4, $second_name, PDO::PARAM_STR);
        $consulta->bindValue(5, $email, PDO::PARAM_STR);
        $consulta->bindValue(6, $direccion, PDO::PARAM_STR);
        $consulta->bindValue(7, $postal, PDO::PARAM_STR);
        $consulta->bindValue(8, $telefono, PDO::PARAM_STR);
        $consulta->bindValue(9, $rol, PDO::PARAM_STR);
        $consulta->bindValue(10, $pregunta_seguridad, PDO::PARAM_STR);
        $consulta->bindValue(11, $respuesta_seguridad, PDO::PARAM_STR);
        
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
/**
 * Verifica las credenciales del usuario e inicia sesión
 *
 * @param PDO $conection Conexión a la base de datos
 * @param string $usuario Nombre de usuario
 * @param string $password Contraseña sin hashear
 * @return bool True si el login fue exitoso, False en caso contrario
 */
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
/**
 * Verifica si el usuario actual tiene rol de administrador
 *
 * @return bool True si es administrador, False en caso contrario
 */
function esAdmin() {
    return isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador';
}

// Función para verificar si el usuario está logueado
/**
 * Verifica si hay una sesión activa de usuario
 *
 * @return bool True si el usuario está logueado, False en caso contrario
 */
function estaLogueado() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}

// Función para cerrar sesión
/**
 * Cierra la sesión actual del usuario y redirecciona al login
 *
 * @return void
 */
function cerrarSesion() {
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
    exit();
}

//Funciones para restablecer la contraseña del Usuario
/**
 * Obtiene la pregunta de seguridad de un usuario
 *
 * @param PDO $conection Conexión a la base de datos
 * @param string $username Nombre de usuario
 * @return array|false Array con la pregunta de seguridad o False si hay error
 */
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

/**
 * Verifica si la respuesta de seguridad proporcionada es correcta
 *
 * @param PDO $conection Conexión a la base de datos
 * @param string $username Nombre de usuario
 * @param string $respuesta Respuesta proporcionada
 * @return bool True si la respuesta es correcta, False en caso contrario
 */
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

/**
 * Actualiza la contraseña de un usuario
 *
 * @param PDO $conection Conexión a la base de datos
 * @param string $username Nombre de usuario
 * @param string $newPassword Nueva contraseña sin hashear
 * @return bool True si la actualización fue exitosa, False en caso contrario
 */
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
