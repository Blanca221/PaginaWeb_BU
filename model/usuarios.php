<?php
//funcion pra registrarnos
function registrar($conection, $usuario, $password, $first_name, $second_name, $email, $direccion, $postal, $telefono) {
    try {
        // Preparamos la consulta SQL incluyendo todos los campos
        $consulta = $conection->prepare("INSERT INTO cliente (username, password, first_name, second_name, email, direccion, postal, telefono) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Vinculamos todos los parámetros
        $consulta->bindValue(1, $usuario, PDO::PARAM_STR);
        $consulta->bindValue(2, $password, PDO::PARAM_STR);
        $consulta->bindValue(3, $first_name, PDO::PARAM_STR);
        $consulta->bindValue(4, $second_name, PDO::PARAM_STR);
        $consulta->bindValue(5, $email, PDO::PARAM_STR);
        $consulta->bindValue(6, $direccion, PDO::PARAM_STR);
        $consulta->bindValue(7, $postal, PDO::PARAM_STR);
        $consulta->bindValue(8, $telefono, PDO::PARAM_STR);
        
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

?>
