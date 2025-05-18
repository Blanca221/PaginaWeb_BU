-- Script para insertar productos Nike
-- Fecha: 14-05-2025

-- Primero, insertamos los productos de ropa Nike
-- Nota: Asumimos que la categoría de ropa deportiva tiene id_categoria = 2 y Nike tiene id_marca = 1

-- Producto: Camiseta Nike Authorised
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES (
    'Camiseta Nike Authorised',
    'Camiseta Nike Authorised con diseño moderno y tejido transpirable. Perfecta para uso diario y actividades deportivas.',
    39.99,
    40,
    2, -- Categoría: Ropa Deportiva
    'Negro',
    'M',
    CURDATE(),
    'activo',
    1  -- Marca: Nike
);

-- Obtenemos el ID del producto recién insertado para las imágenes
SET @id_producto_nike_authorised = LAST_INSERT_ID();

-- Insertamos las imágenes para la Camiseta Nike Authorised
INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES
(@id_producto_nike_authorised, 'imagenes/Productos/nike/ropa/Nike-Camiseta-Authorised/1.png', 1, 1, NOW()),
(@id_producto_nike_authorised, 'imagenes/Productos/nike/ropa/Nike-Camiseta-Authorised/2.png', 0, 2, NOW()),
(@id_producto_nike_authorised, 'imagenes/Productos/nike/ropa/Nike-Camiseta-Authorised/3.png', 0, 3, NOW());

-- Producto: Camiseta Nike Core
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES (
    'Camiseta Nike Core',
    'Camiseta Nike Core con diseño clásico y logo Nike. Fabricada con tejido de algodón suave y duradero.',
    34.99,
    35,
    2, -- Categoría: Ropa Deportiva
    'Blanco',
    'L',
    CURDATE(),
    'activo',
    1  -- Marca: Nike
);

-- Obtenemos el ID del producto recién insertado para las imágenes
SET @id_producto_nike_core = LAST_INSERT_ID();

-- Insertamos las imágenes para la Camiseta Nike Core
INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES
(@id_producto_nike_core, 'imagenes/Productos/nike/ropa/Nike-Camiseta-Core/1.png', 1, 1, NOW()),
(@id_producto_nike_core, 'imagenes/Productos/nike/ropa/Nike-Camiseta-Core/2.png', 0, 2, NOW()),
(@id_producto_nike_core, 'imagenes/Productos/nike/ropa/Nike-Camiseta-Core/3.png', 0, 3, NOW());

-- Producto: Sudadera Nike Tech Fleece Zip
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES (
    'Sudadera Nike Tech Fleece Zip',
    'Sudadera Nike Tech Fleece con cremallera completa. Tejido Tech Fleece ligero y cálido. Diseño moderno con bolsillos laterales.',
    89.99,
    25,
    2, -- Categoría: Ropa Deportiva
    'Gris',
    'M',
    CURDATE(),
    'activo',
    1  -- Marca: Nike
);

-- Obtenemos el ID del producto recién insertado para las imágenes
SET @id_producto_nike_tech_fleece = LAST_INSERT_ID();

-- Insertamos las imágenes para la Sudadera Nike Tech Fleece
INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES
(@id_producto_nike_tech_fleece, 'imagenes/Productos/nike/ropa/Nike-Tech-Fleece-Zip/1.png', 1, 1, NOW()),
(@id_producto_nike_tech_fleece, 'imagenes/Productos/nike/ropa/Nike-Tech-Fleece-Zip/2.png', 0, 2, NOW()),
(@id_producto_nike_tech_fleece, 'imagenes/Productos/nike/ropa/Nike-Tech-Fleece-Zip/3.png', 0, 3, NOW());

-- Producto: Chaqueta Nike Tech Woven Full Zip Hooded
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES (
    'Chaqueta Nike Tech Woven Full Zip Hooded',
    'Chaqueta Nike Tech Woven con capucha y cremallera completa. Tejido resistente al agua y al viento. Perfecta para actividades al aire libre.',
    109.99,
    20,
    2, -- Categoría: Ropa Deportiva
    'Negro',
    'L',
    CURDATE(),
    'activo',
    1  -- Marca: Nike
);

-- Obtenemos el ID del producto recién insertado para las imágenes
SET @id_producto_nike_tech_woven = LAST_INSERT_ID();

-- Insertamos las imágenes para la Chaqueta Nike Tech Woven
INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES
(@id_producto_nike_tech_woven, 'imagenes/Productos/nike/ropa/Nike-Tech-Woven-Full-Zip-Hooded-Jacket/1.png', 1, 1, NOW()),
(@id_producto_nike_tech_woven, 'imagenes/Productos/nike/ropa/Nike-Tech-Woven-Full-Zip-Hooded-Jacket/2.png', 0, 2, NOW()),
(@id_producto_nike_tech_woven, 'imagenes/Productos/nike/ropa/Nike-Tech-Woven-Full-Zip-Hooded-Jacket/3.png', 0, 3, NOW());

-- Producto: Sudadera Nike Club Gris
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES (
    'Sudadera Nike Club Gris',
    'Sudadera Nike Club en color gris. Diseño clásico con logo Nike bordado. Tejido suave y cálido ideal para uso diario.',
    59.99,
    30,
    2, -- Categoría: Ropa Deportiva
    'Gris',
    'M',
    CURDATE(),
    'activo',
    1  -- Marca: Nike
);

-- Obtenemos el ID del producto recién insertado para las imágenes
SET @id_producto_nike_club = LAST_INSERT_ID();

-- Insertamos las imágenes para la Sudadera Nike Club
INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES
(@id_producto_nike_club, 'imagenes/Productos/nike/ropa/nike-club-gris/1.png', 1, 1, NOW()),
(@id_producto_nike_club, 'imagenes/Productos/nike/ropa/nike-club-gris/2.png', 0, 2, NOW()),
(@id_producto_nike_club, 'imagenes/Productos/nike/ropa/nike-club-gris/3.png', 0, 3, NOW());

-- Ahora, insertamos los productos de zapatillas Nike que no estén ya en la base de datos
-- Nota: Según los datos proporcionados, algunas zapatillas ya están en la base de datos

-- Producto: Nike Air Force Negras
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES (
    'Nike Air Force Negras',
    'Zapatillas Nike Air Force en color negro. Diseño icónico con suela Air. Perfectas para uso diario y estilo urbano.',
    109.99,
    40,
    1, -- Categoría: Zapatillas
    'Negro',
    '42',
    CURDATE(),
    'activo',
    1  -- Marca: Nike
);

-- Obtenemos el ID del producto recién insertado para las imágenes
SET @id_producto_airforce_negra = LAST_INSERT_ID();

-- Insertamos las imágenes para Nike Air Force Negras
INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES
(@id_producto_airforce_negra, 'imagenes/Productos/nike/zapatillas/nike-air-force-negra/1.png', 1, 1, NOW()),
(@id_producto_airforce_negra, 'imagenes/Productos/nike/zapatillas/nike-air-force-negra/2.png', 0, 2, NOW()),
(@id_producto_airforce_negra, 'imagenes/Productos/nike/zapatillas/nike-air-force-negra/3.png', 0, 3, NOW());

-- Producto: Nike Air Force Rojas
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES (
    'Nike Air Force Rojas',
    'Zapatillas Nike Air Force en color rojo. Diseño icónico con suela Air. Perfectas para destacar con un estilo urbano único.',
    119.99,
    35,
    1, -- Categoría: Zapatillas
    'Rojo',
    '43',
    CURDATE(),
    'activo',
    1  -- Marca: Nike
);

-- Obtenemos el ID del producto recién insertado para las imágenes
SET @id_producto_airforce_roja = LAST_INSERT_ID();

-- Insertamos las imágenes para Nike Air Force Rojas
INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES
(@id_producto_airforce_roja, 'imagenes/Productos/nike/zapatillas/nike-air-force-rojas/1.png', 1, 1, NOW()),
(@id_producto_airforce_roja, 'imagenes/Productos/nike/zapatillas/nike-air-force-rojas/2.png', 0, 2, NOW()),
(@id_producto_airforce_roja, 'imagenes/Productos/nike/zapatillas/nike-air-force-rojas/3.png', 0, 3, NOW());
