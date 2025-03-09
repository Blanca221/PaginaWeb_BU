<?php
/**
 * Funciones para la gestión de categorías
 * 
 * Este archivo contiene las funciones relacionadas con la obtención
 * y gestión de categorías de productos.
 */

/**
 * Obtiene todas las categorías de la base de datos
 *
 * @param PDO $conection Conexión a la base de datos
 * @return array Lista de categorías con su nombre y descripción
 * @throws PDOException Si hay un error en la consulta
 */
function getCategories($conection) {

    try {
        $consulta_graus = $conection->prepare("SELECT nombre_cat, descripcion FROM categoria");
        $consulta_graus->execute();
        $resultat_graus = $consulta_graus->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    
    return $resultat_graus;
}

?>