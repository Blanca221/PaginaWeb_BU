<?php
/**
 * Controlador para mostrar las novedades
 * 
 * Este controlador maneja la visualización de productos de novedades,
 * asegurando que no haya duplicados por nombre de producto.
 */
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';

try {
    // Obtener la conexión a la base de datos
    $conection = DB::getInstance();
    
    // Título para la página
    $tituloPagina = 'Novedades Especiales';
    
    // Obtener todos los productos sin duplicados por nombre y con precios consistentes
    // Usamos una consulta personalizada que identifica y agrupa productos similares
    $consulta = $conection->prepare("
        WITH ProductosBase AS (
            SELECT 
                p.id_producto,
                p.nombre_producto,
                p.descripcion,
                p.precio,
                p.stock,
                p.id_categoria,
                p.id_marca,
                p.fecha,
                p.estado,
                m.nombre_marca,
                CASE
                    -- Para gorras Nike, usar siempre el mismo precio independientemente de la categoría
                    WHEN p.nombre_producto LIKE 'Gorra Nike%' THEN 'gorra_nike'
                    -- Para guantes de boxeo, usar siempre el mismo precio
                    WHEN p.nombre_producto LIKE 'Guantes de Boxeo%' THEN 'guantes_boxeo'
                    -- Para patinetes, usar siempre el mismo precio
                    WHEN p.nombre_producto LIKE 'Patinete%' THEN 'patinete'
                    -- Para raquetas de padel, usar siempre el mismo precio
                    WHEN p.nombre_producto LIKE 'Raqueta de Padel%' THEN 'raqueta_padel'
                    -- Para el resto de productos, usar una combinación de marca y nombre
                    ELSE CONCAT(m.nombre_marca, '_', p.nombre_producto)
                END AS producto_grupo
            FROM producto p
            LEFT JOIN marca m ON p.id_marca = m.id_marca
            WHERE p.estado = 'activo'
        ),
        ProductosUnicos AS (
            SELECT 
                MIN(pb.id_producto) as id_producto,
                pb.nombre_producto,
                pb.descripcion,
                -- Usar el precio más bajo para cada grupo de productos similares
                MIN(pb.precio) as precio,
                pb.stock,
                pb.id_categoria,
                pb.id_marca,
                pb.fecha,
                pb.estado,
                pb.nombre_marca
            FROM ProductosBase pb
            GROUP BY pb.producto_grupo
        )
        SELECT 
            pu.id_producto, 
            pu.nombre_producto, 
            pu.descripcion, 
            pu.precio, 
            pu.stock, 
            pu.id_categoria, 
            pu.id_marca, 
            pu.fecha, 
            pu.estado, 
            pi.url_imagen, 
            pu.nombre_marca
        FROM ProductosUnicos pu
        LEFT JOIN Producto_Imagenes pi ON pu.id_producto = pi.id_producto AND (pi.es_principal = TRUE OR pi.es_principal IS NULL)
        ORDER BY pu.nombre_producto
    ");
    $consulta->execute();
    $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
    // Verificar si hay productos duplicados por nombre y eliminarlos
    $productos_unicos = [];
    $nombres_vistos = [];
    
    foreach ($productos as $producto) {
        // Normalizamos el nombre para evitar problemas con mayúsculas/minúsculas y espacios
        $nombre_completo = strtolower(trim($producto['nombre_marca'] . ' ' . $producto['nombre_producto']));
        
        // Verificamos si ya hemos visto este producto (por su nombre completo)
        if (!in_array($nombre_completo, $nombres_vistos)) {
            $nombres_vistos[] = $nombre_completo;
            $productos_unicos[] = $producto;
        }
    }
    
    $productos = $productos_unicos;
} catch (PDOException $e) {
    // Registrar el error pero no mostrarlo al usuario
    error_log("Error en mostrar_novedades.php: " . $e->getMessage());
    $productos = [];
}

// Incluir la vista de productos
include __DIR__ . '/../views/novedades.php';
?>
