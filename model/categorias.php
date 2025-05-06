<?php
/**
 * Funciones para la gestión de categorías
 * 
 * Este archivo contiene todas las funciones relacionadas con la gestión de categorías
 * y subcategorías de productos.
 */

/**
 * Obtiene todas las categorías disponibles
 *
 * @param PDO $conection Conexión a la base de datos
 * @return array Lista de categorías
 */
function obtenerTodasCategorias($conection) {
    try {
        $consulta = $conection->prepare("SELECT * FROM categoria ORDER BY nombre_cat");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error en obtenerTodasCategorias: " . $e->getMessage());
        return [];
    }
}

/**
 * FUNCIÓN: OBTENER SUBCATEGORÍAS HOMBRE
 * Obtiene exactamente las tres categorías específicas para hombre
 */
function obtenerSubcategoriasHombre($conection) {
    try {
        $consulta = $conection->prepare("
            SELECT * FROM categoria 
            WHERE nombre_cat IN ('Ropa de Hombre', 'Calzado de Hombre', 'Accesorios Hombre') 
            ORDER BY nombre_cat
        ");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error en obtenerSubcategoriasHombre: " . $e->getMessage());
        return [];
    }
}

/**
 * FUNCIÓN: OBTENER SUBCATEGORÍAS MUJER
 * Obtiene exactamente las tres categorías específicas para mujer
 */
function obtenerSubcategoriasMujer($conection) {
    try {
        $consulta = $conection->prepare("
            SELECT * FROM categoria 
            WHERE nombre_cat IN ('Ropa de Mujer', 'Calzado de Mujer', 'Accesorios Mujer') 
            ORDER BY nombre_cat
        ");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error en obtenerSubcategoriasMujer: " . $e->getMessage());
        return [];
    }
}

/**
 * FUNCIÓN: OBTENER SUBCATEGORÍAS NIÑOS
 * Obtiene exactamente las tres categorías específicas para niños
 */
function obtenerSubcategoriasNinos($conection) {
    try {
        $consulta = $conection->prepare("
            SELECT * FROM categoria 
            WHERE nombre_cat IN ('Ropa de Niños', 'Calzado de Niños', 'Accesorios Niños') 
            ORDER BY nombre_cat
        ");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error en obtenerSubcategoriasNinos: " . $e->getMessage());
        return [];
    }
}

/**
 * Obtiene productos destacados por categoría
 *
 * @param PDO $conection Conexión a la base de datos
 * @param string $categoria Nombre de la categoría
 * @param int $limite Número de productos a obtener
 * @return array Lista de productos destacados
 */
function obtenerProductosDestacadosPorCategoria($conection, $categoria, $limite = 4) {
    try {
        $consulta = $conection->prepare("
            SELECT p.*, i.url_imagen
            FROM producto p
            JOIN categoria c ON p.id_categoria = c.id_categoria
            LEFT JOIN producto_imagenes i ON p.id_producto = i.id_producto AND i.es_principal = 1
            WHERE c.nombre_cat LIKE :categoria 
            AND p.estado = 'activo'
            ORDER BY p.fecha DESC
            LIMIT :limite
        ");
        $categoriaParam = '%' . $categoria . '%';
        $consulta->bindParam(':categoria', $categoriaParam, PDO::PARAM_STR);
        $consulta->bindParam(':limite', $limite, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error en obtenerProductosDestacadosPorCategoria: " . $e->getMessage());
        return [];
    }
}

/**
 * FUNCIÓN: OBTENER BANNERS HOMBRE
 * Obtiene los banners activos de la categoría hombre
 */
function obtenerBannersHombre($conection) {
    try {
        $consulta = $conection->prepare("
            SELECT * FROM home_content 
            WHERE tipo = 'banner' 
            AND url_enlace LIKE '%categoria-hombre%'
            AND estado = 'activo'
            ORDER BY orden ASC
        ");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error en obtenerBannersHombre: " . $e->getMessage());
        return [];
    }
}

/**
 * FUNCIÓN: OBTENER BANNERS MUJER
 * Obtiene los banners activos de la categoría mujer
 */
function obtenerBannersMujer($conection) {
    try {
        $consulta = $conection->prepare("
            SELECT * FROM home_content 
            WHERE tipo = 'banner' 
            AND url_enlace LIKE '%categoria-mujer%'
            AND estado = 'activo'
            ORDER BY orden ASC
        ");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error en obtenerBannersMujer: " . $e->getMessage());
        return [];
    }
}

/**
 * FUNCIÓN: OBTENER BANNERS NIÑOS
 * Obtiene los banners activos de la categoría niños
 */
function obtenerBannersNinos($conection) {
    try {
        $consulta = $conection->prepare("
            SELECT * FROM home_content 
            WHERE tipo = 'banner' 
            AND url_enlace LIKE '%categoria-ninos%'
            AND estado = 'activo'
            ORDER BY orden ASC
        ");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error en obtenerBannersNinos: " . $e->getMessage());
        return [];
    }
}

/**
 * NUEVA FUNCIÓN: Obtiene subcategorías específicas por su nombre
 *
 * @param PDO $conection Conexión a la base de datos
 * @param array $nombres Lista de nombres de categorías a buscar
 * @return array Lista de subcategorías encontradas
 */
function obtenerSubcategoriasPorNombre($conection, $nombres) {
    try {
        $placeholders = rtrim(str_repeat('?,', count($nombres)), ',');
        $sql = "SELECT * FROM categoria WHERE nombre_cat IN ($placeholders) ORDER BY nombre_cat";
        
        $consulta = $conection->prepare($sql);
        
        $index = 1;
        foreach ($nombres as $nombre) {
            $consulta->bindValue($index++, $nombre, PDO::PARAM_STR);
        }
        
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error en obtenerSubcategoriasPorNombre: " . $e->getMessage());
        return [];
    }
}

/**
 * Inserta una nueva subcategoría en la base de datos
 * 
 * @param PDO $conection Conexión a la base de datos
 * @param string $nombre Nombre de la subcategoría
 * @param string $descripcion Descripción de la subcategoría
 * @param string $imagen_url URL de la imagen
 * @return bool True si la inserción fue exitosa, False en caso contrario
 */
function insertarSubcategoria($conection, $nombre, $descripcion, $imagen_url) {
    try {
        $consulta = $conection->prepare("
            INSERT INTO categoria (nombre_cat, descripcion, imagen_url) 
            VALUES (:nombre, :descripcion, :imagen_url)
        ");
        $consulta->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $consulta->bindParam(':imagen_url', $imagen_url, PDO::PARAM_STR);
        return $consulta->execute();
    } catch(PDOException $e) {
        error_log("Error en insertarSubcategoria: " . $e->getMessage());
        return false;
    }
}
?> 