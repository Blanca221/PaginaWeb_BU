<?php
/**
 * Controlador para verificar la disponibilidad de email
 * 
 * Este controlador verifica si un email ya está registrado en la base de datos.
 * 
 * @requires ../model/connectaDb.php
 */

require_once __DIR__ . '/../model/connectaDb.php';

/**
 * Verifica si un email ya existe en la base de datos
 *
 * @param string $email Email a verificar
 * @return string 'exists' si el email existe, 'available' si está disponible, 'error' en caso de error
 */
function checkEmail($email) {
    try {
        $conection = DB::getInstance();
        $consulta = $conection->prepare("SELECT COUNT(*) as count FROM Cliente WHERE email = ?");
        $consulta->bindParam(1, $email, PDO::PARAM_STR);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        
        return $resultado['count'] > 0 ? 'exists' : 'available';
    } catch(PDOException $e) {
        return 'error';
    }
}

if(isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    echo checkEmail($email);
}