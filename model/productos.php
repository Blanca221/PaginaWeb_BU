<?php

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

//funcion para obtener todos los productos activos
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