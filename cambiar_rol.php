<?php
require_once __DIR__ . '/model/connectaDB.php';

// Conexión a la base de datos
$conection = DB::getInstance();

// Usuario que quieres convertir en administrador
$username = 'bema'; // Cambiar por el usuario que quieras

try {
    $consulta = $conection->prepare("UPDATE Cliente SET rol = 'administrador' WHERE username = ?");
    $consulta->bindParam(1, $username, PDO::PARAM_STR);
    
    if ($consulta->execute()) {
        echo "¡Rol actualizado con éxito! El usuario '$username' ahora es administrador.";
    } else {
        echo "Error al actualizar el rol.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Verificar el cambio
try {
    $consulta = $conection->prepare("SELECT username, rol FROM Cliente WHERE username = ?");
    $consulta->bindParam(1, $username, PDO::PARAM_STR);
    $consulta->execute();
    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
    
    if ($usuario) {
        echo "<br><br>Información actual del usuario:<br>";
        echo "Usuario: " . $usuario['username'] . "<br>";
        echo "Rol: " . $usuario['rol'];
    }
} catch(PDOException $e) {
    echo "Error en la verificación: " . $e->getMessage();
}

// Por seguridad, elimina este archivo después de usarlo
?> 