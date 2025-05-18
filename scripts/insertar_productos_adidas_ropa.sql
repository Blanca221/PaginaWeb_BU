-- Script para insertar productos de ropa Adidas
-- Fecha: 14-05-2025

-- Primero, insertamos los productos en la tabla 'producto'
-- Nota: Asumimos que la categoría de ropa deportiva tiene id_categoria = 2 y Adidas tiene id_marca = 2

-- Producto: Chaqueta Adidas Adicolor Azul
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES (
    'Chaqueta Adidas Adicolor Azul',
    'Chaqueta deportiva Adidas Adicolor en color azul. Diseño clásico con las tres rayas características. Perfecta para un estilo deportivo casual.',
    89.99,
    30,
    2, -- Categoría: Ropa Deportiva
    'Azul',
    'M',
    CURDATE(),
    'activo',
    2  -- Marca: Adidas
);

-- Obtenemos el ID del producto recién insertado para las imágenes
SET @id_producto_adicolor_azul = LAST_INSERT_ID();

-- Insertamos las imágenes para el producto Adicolor Azul
INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES
(@id_producto_adicolor_azul, 'imagenes/Productos/adidas/ropa/adicolor-azul/1.png', 1, 1, NOW()),
(@id_producto_adicolor_azul, 'imagenes/Productos/adidas/ropa/adicolor-azul/2.png', 0, 2, NOW()),
(@id_producto_adicolor_azul, 'imagenes/Productos/adidas/ropa/adicolor-azul/3.png', 0, 3, NOW());

-- Producto: Chaqueta Adidas Adicolor Verde
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES (
    'Chaqueta Adidas Adicolor Verde',
    'Chaqueta deportiva Adidas Adicolor en color verde. Diseño clásico con las tres rayas características. Perfecta para un estilo deportivo casual.',
    89.99,
    25,
    2, -- Categoría: Ropa Deportiva
    'Verde',
    'L',
    CURDATE(),
    'activo',
    2  -- Marca: Adidas
);

-- Obtenemos el ID del producto recién insertado para las imágenes
SET @id_producto_adicolor_verde = LAST_INSERT_ID();

-- Insertamos las imágenes para el producto Adicolor Verde
INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES
(@id_producto_adicolor_verde, 'imagenes/Productos/adidas/ropa/adicolor-verde/1.png', 1, 1, NOW()),
(@id_producto_adicolor_verde, 'imagenes/Productos/adidas/ropa/adicolor-verde/2.png', 0, 2, NOW()),
(@id_producto_adicolor_verde, 'imagenes/Productos/adidas/ropa/adicolor-verde/3.png', 0, 3, NOW());

-- Producto: Chaqueta Adidas Firebird Azul
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES (
    'Chaqueta Adidas Firebird Azul',
    'Chaqueta deportiva Adidas Firebird en color azul. Modelo clásico con cierre completo y cuello alto. Ideal para actividades deportivas y uso casual.',
    95.99,
    20,
    2, -- Categoría: Ropa Deportiva
    'Azul',
    'M',
    CURDATE(),
    'activo',
    2  -- Marca: Adidas
);

-- Obtenemos el ID del producto recién insertado para las imágenes
SET @id_producto_firebird_azul = LAST_INSERT_ID();

-- Insertamos las imágenes para el producto Firebird Azul
INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES
(@id_producto_firebird_azul, 'imagenes/Productos/adidas/ropa/firebird-azul/1.png', 1, 1, NOW()),
(@id_producto_firebird_azul, 'imagenes/Productos/adidas/ropa/firebird-azul/2.png', 0, 2, NOW()),
(@id_producto_firebird_azul, 'imagenes/Productos/adidas/ropa/firebird-azul/3.png', 0, 3, NOW());

-- Producto: Chaqueta Adidas Firebird Marrón
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES (
    'Chaqueta Adidas Firebird Marrón',
    'Chaqueta deportiva Adidas Firebird en color marrón. Modelo clásico con cierre completo y cuello alto. Ideal para actividades deportivas y uso casual.',
    95.99,
    15,
    2, -- Categoría: Ropa Deportiva
    'Marrón',
    'L',
    CURDATE(),
    'activo',
    2  -- Marca: Adidas
);

-- Obtenemos el ID del producto recién insertado para las imágenes
SET @id_producto_firebird_marron = LAST_INSERT_ID();

-- Insertamos las imágenes para el producto Firebird Marrón
INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES
(@id_producto_firebird_marron, 'imagenes/Productos/adidas/ropa/firebird-marron/1.png', 1, 1, NOW()),
(@id_producto_firebird_marron, 'imagenes/Productos/adidas/ropa/firebird-marron/2.png', 0, 2, NOW()),
(@id_producto_firebird_marron, 'imagenes/Productos/adidas/ropa/firebird-marron/3.png', 0, 3, NOW());
