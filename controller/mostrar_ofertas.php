<?php
/**
 * Controlador para mostrar las ofertas
 * 
 * Este controlador maneja la visualización de productos en oferta,
 * asegurando que no haya duplicados por nombre de producto.
 */
require_once __DIR__ . '/../model/connectaDb.php';
require_once __DIR__ . '/../model/productos.php';

try {
    // Obtener la conexión a la base de datos
    $conection = DB::getInstance();
    
    // Título para la página
    $tituloPagina = 'Ofertas Especiales';
    
    // Obtener todos los productos sin duplicados por nombre
    // Usamos una consulta personalizada que agrupa por nombre_producto para evitar duplicados
    $consulta = $conection->prepare("
        SELECT MIN(p.id_producto) as id_producto, p.nombre_producto, p.descripcion, p.precio, p.stock, 
               p.id_categoria, p.id_marca, p.fecha, p.estado, pi.url_imagen, m.nombre_marca
        FROM producto p 
        LEFT JOIN Producto_Imagenes pi ON p.id_producto = pi.id_producto AND (pi.es_principal = TRUE OR pi.es_principal IS NULL)
        LEFT JOIN marca m ON p.id_marca = m.id_marca
        WHERE p.estado = 'activo'
        GROUP BY p.nombre_producto, m.nombre_marca
        ORDER BY p.nombre_producto
    ");
    $consulta->execute();
    $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
    // Verificar si hay productos duplicados por nombre y eliminarlos
    $productos_unicos = [];
    $nombres_vistos = [];
    
    foreach ($productos as $producto) {
        $nombre_completo = $producto['nombre_marca'] . ' ' . $producto['nombre_producto'];
        
        if (!in_array($nombre_completo, $nombres_vistos)) {
            $nombres_vistos[] = $nombre_completo;
            $productos_unicos[] = $producto;
        }
    }
    
    $productos = $productos_unicos;
} catch (PDOException $e) {
    // Registrar el error pero no mostrarlo al usuario
    error_log("Error en mostrar_ofertas.php: " . $e->getMessage());
    $productos = [];
}

// Incluir la vista de productos
include __DIR__ . '/../views/ofertas.php';
?>
