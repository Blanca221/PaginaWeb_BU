<?php
/**
 * Funciones para la gestión de mensajes del sistema
 * 
 * Este archivo contiene las funciones relacionadas con la obtención
 * de mensajes del sistema desde la base de datos.
 */

/**
 * Obtiene un mensaje específico de la base de datos
 *
 * @param PDO $conection Conexión a la base de datos
 * @param int $id_info Identificador del mensaje
 * @return array Retorna el mensaje encontrado
 * @throws PDOException Si hay un error en la consulta
 */
function getMensaje($conection, $id_info) {

    try {
        $consulta_graus = $conection->prepare("SELECT mensaje FROM MENSAJES WHERE id_info = :id_info"); 
        $consulta_graus->bindParam(':id_info', $id_info, PDO::PARAM_INT); 
        $consulta_graus->execute();
        $resultat_graus = $consulta_graus->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }

    return $resultat_graus[0];
}

?>