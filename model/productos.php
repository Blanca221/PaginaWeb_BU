<?php
/**
 * Funciones para la gestión de productos
 * 
 * Este archivo contiene todas las funciones relacionadas con la gestión
 * de productos, incluyendo consultas por categoría y listados generales.
 */

function getProductsByCategory($conection, $categoria) { // Antiguo no usar tal cual (modificar)

    try {
        $consulta = $conection->prepare("SELECT product_name, stock FROM PRODUCT WHERE category_id = ?");
        $consulta->bindParam(1, $categoria, PDO::PARAM_INT);
        $consulta->execute();
        $resultat = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    
    return $resultat;
}

/**
 * Obtiene todos los productos de la base de datos
 *
 * @param PDO $conection Conexión a la base de datos
 * @return array Lista de todos los productos
 * @throws PDOException Si hay un error en la consulta
 */
function getAllProducts($conection) {

    try {
        $consulta = $conection->prepare("SELECT * FROM PRODUCTO");
        $consulta->execute();
        $resultat = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    
    return $resultat;
}

/**
 * Obtiene todos los productos activos
 *
 * @param PDO $conection Conexión a la base de datos
 * @return array Lista de productos con estado 'activo'
 * @throws PDOException Si hay un error en la consulta
 */
function obtenerProductos($conection) {
    try {
        $consulta = $conection->prepare("SELECT * FROM producto WHERE estado = 'activo'");
        $consulta->execute();
        $resultat = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    return $resultat;
}

?>