<?php
/**
 * Funciones para la gestión del carrito de compras
 */

/**
 * Añade un producto al carrito
 *
 * @param PDO $conection Conexión a la base de datos
 * @param int $id_cliente ID del cliente
 * @param int $id_producto ID del producto
 * @param int $cantidad Cantidad del producto
 * @return bool True si se añadió correctamente
 */
function agregarAlCarrito($conection, $id_cliente, $id_producto, $cantidad = 1) {
    try {
        // Verificar que los parámetros sean válidos
        if (!$id_cliente || !$id_producto || $cantidad <= 0) {
            return false;
        }
        
        // Verificar si el producto existe
        $consulta_producto = $conection->prepare("SELECT id_producto FROM producto WHERE id_producto = ?");
        $consulta_producto->bindParam(1, $id_producto, PDO::PARAM_INT);
        $consulta_producto->execute();
        
        if (!$consulta_producto->fetch()) {
            return false; // El producto no existe
        }
        
        // Verificar si ya existe en el carrito
        $consulta = $conection->prepare("SELECT cantidad FROM carrito WHERE id_cliente = ? AND id_producto = ?");
        $consulta->bindParam(1, $id_cliente, PDO::PARAM_INT);
        $consulta->bindParam(2, $id_producto, PDO::PARAM_INT);
        $consulta->execute();
        
        if ($item = $consulta->fetch(PDO::FETCH_ASSOC)) {
            // Actualizar cantidad
            $nueva_cantidad = $item['cantidad'] + $cantidad;
            $consulta = $conection->prepare("UPDATE carrito SET cantidad = ? WHERE id_cliente = ? AND id_producto = ?");
            $consulta->bindParam(1, $nueva_cantidad, PDO::PARAM_INT);
            $consulta->bindParam(2, $id_cliente, PDO::PARAM_INT);
            $consulta->bindParam(3, $id_producto, PDO::PARAM_INT);
        } else {
            // Insertar nuevo
            $consulta = $conection->prepare("INSERT INTO carrito (id_cliente, id_producto, cantidad) VALUES (?, ?, ?)");
            $consulta->bindParam(1, $id_cliente, PDO::PARAM_INT);
            $consulta->bindParam(2, $id_producto, PDO::PARAM_INT);
            $consulta->bindParam(3, $cantidad, PDO::PARAM_INT);
        }
        
        $resultado = $consulta->execute();
        
        if (!$resultado) {
            // Para depuración
            error_log("Error al agregar al carrito: " . json_encode($consulta->errorInfo()));
        }
        
        return $resultado;
    } catch(PDOException $e) {
        error_log("Excepción al agregar al carrito: " . $e->getMessage());
        return false;
    }
}

/**
 * Elimina un producto del carrito
 *
 * @param PDO $conection Conexión a la base de datos
 * @param int $id_cliente ID del cliente
 * @param int $id_producto ID del producto
 * @return bool True si se eliminó correctamente
 */
function eliminarDelCarrito($conection, $id_cliente, $id_producto) {
    try {
        $consulta = $conection->prepare("DELETE FROM carrito WHERE id_cliente = ? AND id_producto = ?");
        $consulta->bindParam(1, $id_cliente, PDO::PARAM_INT);
        $consulta->bindParam(2, $id_producto, PDO::PARAM_INT);
        return $consulta->execute();
    } catch(PDOException $e) {
        return false;
    }
}

/**
 * Obtiene los productos en el carrito
 *
 * @param PDO $conection Conexión a la base de datos
 * @param int $id_cliente ID del cliente
 * @return array Lista de productos en el carrito
 */
function obtenerCarrito($conection, $id_cliente) {
    try {
        // Verificar que el cliente exista
        if (!$id_cliente) {
            return [];
        }
        
        $consulta = $conection->prepare("
            SELECT c.id_producto, c.cantidad, p.nombre_producto, p.precio, 
                   (p.precio * c.cantidad) as subtotal,
                   pi.url_imagen
            FROM carrito c
            JOIN producto p ON c.id_producto = p.id_producto
            LEFT JOIN Producto_Imagenes pi ON p.id_producto = pi.id_producto AND (pi.es_principal = TRUE OR pi.es_principal IS NULL)
            WHERE c.id_cliente = ?
            GROUP BY c.id_producto
        ");
        $consulta->bindParam(1, $id_cliente, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        // Para depuración, puedes descomentar la siguiente línea
        // echo "Error en obtenerCarrito: " . $e->getMessage();
        return [];
    }
}

/**
 * Calcula el total del carrito
 *
 * @param PDO $conection Conexión a la base de datos
 * @param int $id_cliente ID del cliente
 * @return float Total del carrito
 */
function calcularTotalCarrito($conection, $id_cliente) {
    try {
        $consulta = $conection->prepare("
            SELECT SUM(p.precio * c.cantidad) as total
            FROM carrito c
            JOIN producto p ON c.id_producto = p.id_producto
            WHERE c.id_cliente = ?
        ");
        $consulta->bindParam(1, $id_cliente, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] ?? 0;
    } catch(PDOException $e) {
        return 0;
    }
}

/**
 * Cuenta los productos en el carrito
 *
 * @param PDO $conection Conexión a la base de datos
 * @param int $id_cliente ID del cliente
 * @return int Número de productos
 */
function contarProductosCarrito($conection, $id_cliente) {
    try {
        $consulta = $conection->prepare("SELECT COUNT(*) as cantidad FROM carrito WHERE id_cliente = ?");
        $consulta->bindParam(1, $id_cliente, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        return $resultado['cantidad'] ?? 0;
    } catch(PDOException $e) {
        return 0;
    }
}

/**
 * Vacía el carrito de un cliente
 *
 * @param PDO $conection Conexión a la base de datos
 * @param int $id_cliente ID del cliente
 * @return bool True si se vació correctamente
 */
function vaciarCarrito($conection, $id_cliente) {
    try {
        $consulta = $conection->prepare("DELETE FROM carrito WHERE id_cliente = ?");
        $consulta->bindParam(1, $id_cliente, PDO::PARAM_INT);
        return $consulta->execute();
    } catch(PDOException $e) {
        return false;
    }
}
?>
