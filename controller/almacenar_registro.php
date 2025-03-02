/**
 * Script para procesar y almacenar el registro de usuarios
 * 
 * Este script maneja el proceso de registro de usuarios, validando los datos
 * del formulario y almacenándolos en la base de datos.
 * 
 * @requires ../model/connectaDb.php
 * @requires ../model/usuarios.php
 */

<?php
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/usuarios.php';

/**
 * Validación y procesamiento de datos del formulario de registro
 * 
 * Comprueba que todos los campos requeridos estén presentes y cumplan
 * con los criterios de validación:
 * - Username: 4-20 caracteres
 * - Password: 4-20 caracteres
 * - Nombre: 4-40 caracteres
 * - Email: formato válido
 * - Código postal: 5 caracteres
 */

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

/**
 * Almacenamiento de datos en la sesión y base de datos
 * 
 * Si la validación es exitosa:
 * 1. Almacena los datos en la sesión
 * 2. Hashea la contraseña
 * 3. Intenta registrar al usuario en la base de datos
 * 4. Establece un mensaje de éxito o error según el resultado
 */

/**
 * Inclusión de la vista
 * 
 * @see ../views/llistar_registre.php Para la presentación del resultado
 */
include __DIR__ . '/../views/llistar_registre.php';