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
        $consulta = $conection->prepare("
            SELECT p.*, pi.url_imagen 
            FROM producto p 
            LEFT JOIN Producto_Imagenes pi ON p.id_producto = pi.id_producto 
            WHERE pi.es_principal = TRUE OR pi.es_principal IS NULL
        ");
        $consulta->execute();
        $resultat = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    
    return $resultat;
}

/**
 * Obtiene un producto específico por su ID
 *
 * @param PDO $conection Conexión a la base de datos
 * @param int $id_producto ID del producto
 * @return array Datos del producto
 */
function getProductById($conection, $id_producto) {
    try {
        // Obtener información del producto
        $consulta = $conection->prepare("
            SELECT p.*, c.nombre_cat as categoria_nombre, m.nombre_marca
            FROM producto p
            LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
            LEFT JOIN marca m ON p.id_marca = m.id_marca
            WHERE p.id_producto = ?
        ");
        $consulta->bindParam(1, $id_producto, PDO::PARAM_INT);
        $consulta->execute();
        $producto = $consulta->fetch(PDO::FETCH_ASSOC);

        // Si el producto existe, obtener sus imágenes
        if ($producto) {
            $consulta_imagenes = $conection->prepare("
                SELECT url_imagen, es_principal
                FROM producto_imagenes
                WHERE id_producto = ?
                ORDER BY es_principal DESC, orden ASC
            ");
            $consulta_imagenes->bindParam(1, $id_producto, PDO::PARAM_INT);
            $consulta_imagenes->execute();
            $producto['imagenes'] = $consulta_imagenes->fetchAll(PDO::FETCH_ASSOC);
        }

        return $producto;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

?>