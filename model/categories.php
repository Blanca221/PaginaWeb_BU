<?php
//Ejercicio resuelto y Ejercicio3
function getCategories($conection) {

    try {
        $consulta_graus = $conection->prepare("SELECT nombre, descripcion FROM CATEGORY");
        $consulta_graus->execute();
        $resultat_graus = $consulta_graus->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    
    return $resultat_graus;
}

?>