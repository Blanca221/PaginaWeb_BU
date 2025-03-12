<?php
/**
 * Modelo para gestionar el contenido de la página principal
 * Incluye funciones para obtener heros y banners
 */

function getHomeHeros($conection) {
    try {
        $consulta = $conection->prepare("
            SELECT *, 
                   CONCAT('/PaginaWeb_BU/public/', url_imagen) as url_imagen_completa 
            FROM Home_Content 
            WHERE tipo = 'hero' 
            AND estado = 'activo'
            ORDER BY orden ASC
        ");
        $consulta->execute();
        $heroes = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
        // Verificar que las imágenes existen
        foreach ($heroes as &$hero) {
            $ruta_fisica = __DIR__ . '/../public/' . $hero['url_imagen'];
            if (!file_exists($ruta_fisica)) {
                error_log("Imagen no encontrada: " . $ruta_fisica);
                // Asignar una imagen por defecto si la original no existe
                $hero['url_imagen'] = 'imagenes/home/default-hero.png';
            }
        }
        
        return $heroes;
    } catch(PDOException $e) {
        error_log("Error en getHomeHeros: " . $e->getMessage());
        return [];
    }
}

function getHomeBanners($conection) {
    try {
        // Obtiene todos los banners activos ordenados por orden
        $consulta = $conection->prepare("
            SELECT * 
            FROM Home_Content 
            WHERE tipo = 'banner' 
            AND estado = 'activo'
            AND (fecha_fin IS NULL OR fecha_fin >= CURRENT_DATE)
            ORDER BY orden ASC
        ");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error en getHomeBanners: " . $e->getMessage());
        return [];
    }
}

function getAllHomeContent($conection) {
    try {
        // Obtiene todo el contenido activo ordenado por tipo y orden
        $consulta = $conection->prepare("
            SELECT * 
            FROM Home_Content 
            WHERE estado = 'activo'
            AND (fecha_fin IS NULL OR fecha_fin >= CURRENT_DATE)
            ORDER BY tipo, orden ASC
        ");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error en getAllHomeContent: " . $e->getMessage());
        return [];
    }
}

function getActiveHomeContentByType($conection, $tipo) {
    try {
        // Obtiene contenido específico por tipo
        $consulta = $conection->prepare("
            SELECT * 
            FROM Home_Content 
            WHERE tipo = :tipo 
            AND estado = 'activo'
            AND (fecha_fin IS NULL OR fecha_fin >= CURRENT_DATE)
            ORDER BY orden ASC
        ");
        $consulta->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error en getActiveHomeContentByType: " . $e->getMessage());
        return [];
    }
}

/**
 * Obtiene un elemento específico del home por su ID
 */
function getHomeContentById($conection, $id) {
    try {
        $consulta = $conection->prepare("
            SELECT * 
            FROM Home_Content 
            WHERE id_content = :id
        ");
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error en getHomeContentById: " . $e->getMessage());
        return null;
    }
}

/**
 * Verifica si una imagen existe en el servidor
 */
function verificarImagen($url_imagen) {
    $ruta_completa = __DIR__ . '/../public/' . $url_imagen;
    return file_exists($ruta_completa);
}

/**
 * Obtiene la URL por defecto si la imagen no existe
 */
function getImagenPorDefecto($tipo) {
    switch ($tipo) {
        case 'hero':
            return 'imagenes/home/default-hero.jpg';
        case 'banner':
            return 'imagenes/home/default-banner.jpg';
        default:
            return 'imagenes/home/default.jpg';
    }
}
?>