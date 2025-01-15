<?php

function registrar($conection, $usuario, $password) {
 //[8] (M) Despues de guardar los datos en el $_SESSION crea una sentencia INSERT para guardar SOLO el nombre y la
 //contraseña del usuario en la base de datos.

    try {
        // Inicia una transacción
        //$conection->beginTransaction();

        $consulta_graus = $conection->prepare("INSERT INTO USERS (username, password) VALUES (?, ?)");
        $consulta_graus->bindValue(1, $usuario, PDO::PARAM_STR);
        $consulta_graus->bindValue(2, $password, PDO::PARAM_STR);
        $consulta_graus->execute();


        // Confirma la transacción
        //$conection->commit();

        return true;
    } catch(PDOException $e){
        // Si hay un error, revierte la transacción
        $conection->rollBack();
        echo "Error: " . $e->getMessage();
    }

    return false;
}

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
