<?php
/**
 * Funciones para la gestión de productos
 * 
 * Este archivo contiene todas las funciones relacionadas con la gestión
 * de productos, incluyendo consultas por categoría y listados generales.
 */

/**
 * Obtiene productos por ID de categoría
 *
 * @param PDO $conection Conexión a la base de datos
 * @param int $id_categoria ID de la categoría
 * @return array Lista de productos de la categoría
 */
function getProductsByCategory($conection, $id_categoria) {
    try {
        // Si la categoría es de calzado (IDs 11, 14, 17), mostrar todos los productos de la categoría 1 (Zapatillas)
        // para que aparezcan los mismos productos en todas las categorías de calzado
        if (in_array($id_categoria, [11, 14, 17])) {
            $consulta = $conection->prepare("
                SELECT p.*, pi.url_imagen, m.nombre_marca, 
                       (CASE 
                           WHEN ? = 11 THEN 'Calzado de Hombre'
                           WHEN ? = 14 THEN 'Calzado de Mujer'
                           WHEN ? = 17 THEN 'Calzado de Niños'
                           ELSE c.nombre_cat 
                       END) as categoria_nombre
                FROM producto p 
                LEFT JOIN Producto_Imagenes pi ON p.id_producto = pi.id_producto AND (pi.es_principal = TRUE OR pi.es_principal IS NULL)
                LEFT JOIN marca m ON p.id_marca = m.id_marca
                LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
                WHERE p.id_categoria = 1 AND p.estado = 'activo'
                GROUP BY p.id_producto
                ORDER BY p.nombre_producto
            ");
            $consulta->bindParam(1, $id_categoria, PDO::PARAM_INT);
            $consulta->bindParam(2, $id_categoria, PDO::PARAM_INT);
            $consulta->bindParam(3, $id_categoria, PDO::PARAM_INT);
        } else {
            // Para otras categorías, mostrar solo los productos de esa categoría específica
            $consulta = $conection->prepare("
                SELECT p.*, pi.url_imagen, m.nombre_marca, c.nombre_cat as categoria_nombre
                FROM producto p 
                LEFT JOIN Producto_Imagenes pi ON p.id_producto = pi.id_producto AND (pi.es_principal = TRUE OR pi.es_principal IS NULL)
                LEFT JOIN marca m ON p.id_marca = m.id_marca
                LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
                WHERE p.id_categoria = ? AND p.estado = 'activo'
                GROUP BY p.id_producto
                ORDER BY p.nombre_producto
            ");
            $consulta->bindParam(1, $id_categoria, PDO::PARAM_INT);
        }
        
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        error_log("Error en getProductsByCategory: " . $e->getMessage());
        return [];
    }
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
                SELECT CONCAT('/PaginaWeb_BU/public/', url_imagen) as url_imagen, es_principal
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

/**
 * Obtiene los productos destacados limitados a una cantidad específica
 *
 * @param PDO $conection Conexión a la base de datos
 * @param int $limit Número máximo de productos a retornar
 * @return array Lista de productos destacados
 */
function getProductosDestacados($conection, $limit = 3) {
    try {
        $consulta = $conection->prepare("
            SELECT p.*, pi.url_imagen, m.nombre_marca as marca
            FROM producto p 
            LEFT JOIN Producto_Imagenes pi ON p.id_producto = pi.id_producto 
            LEFT JOIN marca m ON p.id_marca = m.id_marca
            WHERE pi.es_principal = TRUE OR pi.es_principal IS NULL
            ORDER BY p.fecha_creacion DESC
            LIMIT ?
        ");
        $consulta->bindParam(1, $limit, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        return [];
    }
}

/**
 * Obtiene productos aleatorios para mostrar en la portada
 *
 * @param PDO $conection Conexión a la base de datos
 * @param int $limit Número máximo de productos a retornar
 * @return array Lista de productos aleatorios
 */
function getProductosAleatorios($conection, $limit = 4) {
    try {
        $consulta = $conection->prepare("
            SELECT p.id_producto, 
                   p.nombre_producto as nombre, 
                   p.precio, 
                   m.nombre_marca as marca, 
                   CONCAT('/PaginaWeb_BU/public/', pi.url_imagen) as url_imagen
            FROM producto p 
            LEFT JOIN Producto_Imagenes pi ON p.id_producto = pi.id_producto 
            LEFT JOIN marca m ON p.id_marca = m.id_marca
            WHERE pi.es_principal = TRUE 
            ORDER BY RAND()
            LIMIT ?
        ");
        $consulta->bindParam(1, $limit, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        return [];
    }
}

/**
 * Lista todos los productos con información adicional para el panel de administración
 *
 * @param PDO $conection Conexión a la base de datos
 * @return array Lista de productos con información completa
 */
function listarProductos($conection) {
    try {
        $consulta = $conection->prepare("
            SELECT p.*, c.nombre_cat, m.nombre_marca
            FROM producto p
            LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
            LEFT JOIN marca m ON p.id_marca = m.id_marca
            ORDER BY p.id_producto DESC
        ");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

/**
 * Crea un nuevo producto en la base de datos
 *
 * @param PDO $conection Conexión a la base de datos
 * @param array $datos Datos del producto
 * @return bool True si se creó correctamente, False en caso contrario
 */
function crearProducto($conection, $datos) {
    try {
        $consulta = $conection->prepare("
            INSERT INTO producto (
                nombre_producto, descripcion, precio, stock, 
                id_categoria, id_marca, color, talla, estado
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'activo')
        ");
        
        $consulta->bindParam(1, $datos['nombre_producto'], PDO::PARAM_STR);
        $consulta->bindParam(2, $datos['descripcion'], PDO::PARAM_STR);
        $consulta->bindParam(3, $datos['precio'], PDO::PARAM_STR);
        $consulta->bindParam(4, $datos['stock'], PDO::PARAM_INT);
        $consulta->bindParam(5, $datos['id_categoria'], PDO::PARAM_INT);
        $consulta->bindParam(6, $datos['id_marca'], PDO::PARAM_INT);
        $consulta->bindParam(7, $datos['color'], PDO::PARAM_STR);
        $consulta->bindParam(8, $datos['talla'], PDO::PARAM_STR);
        
        return $consulta->execute();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

/**
 * Actualiza un producto existente
 *
 * @param PDO $conection Conexión a la base de datos
 * @param array $datos Datos del producto
 * @return bool True si se actualizó correctamente, False en caso contrario
 */
function actualizarProducto($conection, $datos) {
    try {
        $consulta = $conection->prepare("
            UPDATE producto SET 
                nombre_producto = ?,
                descripcion = ?,
                precio = ?,
                stock = ?,
                id_categoria = ?,
                id_marca = ?,
                color = ?,
                talla = ?,
                estado = ?
            WHERE id_producto = ?
        ");
        
        $consulta->bindParam(1, $datos['nombre_producto'], PDO::PARAM_STR);
        $consulta->bindParam(2, $datos['descripcion'], PDO::PARAM_STR);
        $consulta->bindParam(3, $datos['precio'], PDO::PARAM_STR);
        $consulta->bindParam(4, $datos['stock'], PDO::PARAM_INT);
        $consulta->bindParam(5, $datos['id_categoria'], PDO::PARAM_INT);
        $consulta->bindParam(6, $datos['id_marca'], PDO::PARAM_INT);
        $consulta->bindParam(7, $datos['color'], PDO::PARAM_STR);
        $consulta->bindParam(8, $datos['talla'], PDO::PARAM_STR);
        $consulta->bindParam(9, $datos['estado'], PDO::PARAM_STR);
        $consulta->bindParam(10, $datos['id_producto'], PDO::PARAM_INT);
        
        return $consulta->execute();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

/**
 * Elimina un producto de la base de datos
 *
 * @param PDO $conection Conexión a la base de datos
 * @param int $id_producto ID del producto a eliminar
 * @return bool True si se eliminó correctamente, False en caso contrario
 */
function eliminarProducto($conection, $id_producto) {
    try {
        $consulta = $conection->prepare("DELETE FROM producto WHERE id_producto = ?");
        $consulta->bindParam(1, $id_producto, PDO::PARAM_INT);
        return $consulta->execute();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

/**
 * Obtiene todas las categorías para el formulario de productos
 *
 * @param PDO $conection Conexión a la base de datos
 * @return array Lista de categorías
 */
function obtenerCategorias($conection) {
    try {
        $consulta = $conection->prepare("SELECT id_categoria, nombre_cat FROM categoria ORDER BY nombre_cat");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

/**
 * Obtiene todas las marcas para el formulario de productos
 *
 * @param PDO $conection Conexión a la base de datos
 * @return array Lista de marcas
 */
function obtenerMarcas($conection) {
    try {
        $consulta = $conection->prepare("SELECT id_marca, nombre_marca FROM marca WHERE estado = 'activo' ORDER BY nombre_marca");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

/**
 * Busca productos por nombre o marca
 *
 * @param PDO $conection Conexión a la base de datos
 * @param string $termino Término de búsqueda
 * @return array Lista de productos que coinciden con la búsqueda
 */
function buscarProductos($conection, $termino) {
    try {
        // Preparar el término de búsqueda para usar en LIKE
        $terminoBusqueda = "%" . $termino . "%";
        
        $consulta = $conection->prepare("
            SELECT p.*, pi.url_imagen, m.nombre_marca 
            FROM producto p 
            LEFT JOIN Producto_Imagenes pi ON p.id_producto = pi.id_producto 
            LEFT JOIN marca m ON p.id_marca = m.id_marca
            WHERE (pi.es_principal = TRUE OR pi.es_principal IS NULL)
            AND (p.nombre_producto LIKE ? OR m.nombre_marca LIKE ?)
            ORDER BY p.nombre_producto
        ");
        
        $consulta->bindParam(1, $terminoBusqueda, PDO::PARAM_STR);
        $consulta->bindParam(2, $terminoBusqueda, PDO::PARAM_STR);
        $consulta->execute();
        
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

?>