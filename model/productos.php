<?php

function getProductsByCategory($conection, $categoria) {

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

?>