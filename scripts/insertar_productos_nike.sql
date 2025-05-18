-- Insertar productos Nike restantes

-- Nike Air Force Blanco/Negro
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES ('Nike Air Force Blanco/Negro', 'Zapatillas deportivas Nike Air Force en combinación blanco y negro, perfectas para un estilo casual y deportivo', 89.99, 45, 1, 'Blanco/Negro', '42', CURDATE(), 'activo', 1);

SET @last_product_id = LAST_INSERT_ID();

INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES 
(@last_product_id, 'imagenes/productos/nike/zapatillas/nike-air-force-blanconegro/1.png', 1, 1, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/zapatillas/nike-air-force-blanconegro/2.png', 0, 2, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/zapatillas/nike-air-force-blanconegro/3.png', 0, 3, CURRENT_TIMESTAMP);

-- Nike Air Force Negra
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES ('Nike Air Force Negra', 'Zapatillas deportivas Nike Air Force en color negro, un clásico atemporal con estilo urbano', 95.99, 35, 1, 'Negro', '41', CURDATE(), 'activo', 1);

SET @last_product_id = LAST_INSERT_ID();

INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES 
(@last_product_id, 'imagenes/productos/nike/zapatillas/nike-air-force-negra/1.png', 1, 1, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/zapatillas/nike-air-force-negra/2.png', 0, 2, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/zapatillas/nike-air-force-negra/3.png', 0, 3, CURRENT_TIMESTAMP);

-- Nike Air Force Roja
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES ('Nike Air Force Roja', 'Zapatillas deportivas Nike Air Force en color rojo vibrante, perfectas para destacar con estilo', 92.99, 30, 1, 'Rojo', '43', CURDATE(), 'activo', 1);

SET @last_product_id = LAST_INSERT_ID();

INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES 
(@last_product_id, 'imagenes/productos/nike/zapatillas/nike-air-force-rojas/1.png', 1, 1, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/zapatillas/nike-air-force-rojas/2.png', 0, 2, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/zapatillas/nike-air-force-rojas/3.png', 0, 3, CURRENT_TIMESTAMP);

-- Nike Camiseta Authorised
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES ('Nike Camiseta Authorised', 'Camiseta Nike Authorised, diseño moderno y cómodo para uso diario', 29.99, 50, 2, 'Negro', 'M', CURDATE(), 'activo', 1);

SET @last_product_id = LAST_INSERT_ID();

INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES 
(@last_product_id, 'imagenes/productos/nike/ropa/Nike-Camiseta-Authorised/1.png', 1, 1, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/ropa/Nike-Camiseta-Authorised/2.png', 0, 2, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/ropa/Nike-Camiseta-Authorised/3.png', 0, 3, CURRENT_TIMESTAMP);

-- Nike Camiseta Core
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES ('Nike Camiseta Core', 'Camiseta Nike Core, esencial para tu guardarropa deportivo con máxima comodidad', 24.99, 60, 2, 'Blanco', 'L', CURDATE(), 'activo', 1);

SET @last_product_id = LAST_INSERT_ID();

INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES 
(@last_product_id, 'imagenes/productos/nike/ropa/Nike-Camiseta-Core/1.png', 1, 1, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/ropa/Nike-Camiseta-Core/2.png', 0, 2, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/ropa/Nike-Camiseta-Core/3.png', 0, 3, CURRENT_TIMESTAMP);

-- Nike Tech Fleece Zip
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES ('Nike Tech Fleece Zip', 'Sudadera Nike Tech Fleece con cierre, tecnología avanzada para máximo confort', 89.99, 40, 2, 'Gris', 'L', CURDATE(), 'activo', 1);

SET @last_product_id = LAST_INSERT_ID();

INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES 
(@last_product_id, 'imagenes/productos/nike/ropa/Nike-Tech-Fleece-Zip/1.png', 1, 1, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/ropa/Nike-Tech-Fleece-Zip/2.png', 0, 2, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/ropa/Nike-Tech-Fleece-Zip/3.png', 0, 3, CURRENT_TIMESTAMP);

-- Nike Tech Woven Full Zip Hooded Jacket
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES ('Nike Tech Woven Jacket', 'Chaqueta Nike Tech Woven con capucha y cierre completo, perfecta para cualquier clima', 119.99, 30, 2, 'Negro', 'M', CURDATE(), 'activo', 1);

SET @last_product_id = LAST_INSERT_ID();

INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES 
(@last_product_id, 'imagenes/productos/nike/ropa/Nike-Tech-Woven-Full-Zip-Hooded-Jacket/1.png', 1, 1, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/ropa/Nike-Tech-Woven-Full-Zip-Hooded-Jacket/2.png', 0, 2, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/ropa/Nike-Tech-Woven-Full-Zip-Hooded-Jacket/3.png', 0, 3, CURRENT_TIMESTAMP);

-- Nike Club Gris
INSERT INTO producto (nombre_producto, descripcion, precio, stock, id_categoria, color, talla, fecha, estado, id_marca)
VALUES ('Nike Club Gris', 'Sudadera Nike Club en gris, diseño clásico y cómodo para uso diario', 49.99, 45, 2, 'Gris', 'L', CURDATE(), 'activo', 1);

SET @last_product_id = LAST_INSERT_ID();

INSERT INTO producto_imagenes (id_producto, url_imagen, es_principal, orden, fecha_creacion)
VALUES 
(@last_product_id, 'imagenes/productos/nike/ropa/nike-club-gris/1.png', 1, 1, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/ropa/nike-club-gris/2.png', 0, 2, CURRENT_TIMESTAMP),
(@last_product_id, 'imagenes/productos/nike/ropa/nike-club-gris/3.png', 0, 3, CURRENT_TIMESTAMP);
