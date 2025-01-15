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
        $consulta_graus = $conection->prepare("SELECT password FROM USERS WHERE username = ?");//? es un parametro
        $consulta_graus->bindParam(1, $usuario, PDO::PARAM_STR);//el binparam esta vinculado a este parametro ?
        $consulta_graus->execute();
        $resultat_graus = $consulta_graus->fetchAll(PDO::FETCH_ASSOC);

        if (password_verify($password, $resultat_graus[0]['password'])) {//verifica la base de datos
            return true;
        } else {
            return false;
        }

    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }

    return false;
}

?>
