-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS tienda_deporte;
USE tienda_deporte;

-- Tabla Cliente
CREATE TABLE Cliente (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,-- nombre de usuario
    password VARCHAR(255) NOT NULL,-- Password
    first_name VARCHAR(100) NOT NULL,-- Nombre
    second_name VARCHAR(100) NOT NULL,-- Apellido
    email VARCHAR(100) UNIQUE NOT NULL,--Email
    direccion TEXT,-- direccion no es obligatoria
    postal VARCHAR(5),-- codigo postal no es obligatorio
    telefono VARCHAR(20),-- telefono no es obligatoria
    rol ENUM('usuario', 'administrador') DEFAULT 'usuario',
    -- define una columna que permite clasificar a los usuarios en diferentes categorías (roles) y asigna el rol de 'usuario' como valor por defecto.
    -- Esta columna es fundamental para implementar un sistema de control de acceso y personalizar la experiencia del usuario en tu aplicación.
    pregunta_seguridad VARCHAR(255),-- preguntas
    respuesta_seguridad VARCHAR(255)-- respuestas
);

-- Tabla Categoria
CREATE TABLE Categoria (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nombre_cat VARCHAR(100) NOT NULL,-- Nombre de la categoria
    descripcion TEXT--descripcion de la categoria
);

-- Tabla Producto
CREATE TABLE Producto (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre_producto VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    id_categoria INT,
    color VARCHAR(50),
    talla VARCHAR(50),
    imagen_url VARCHAR(255),
    fecha DATE DEFAULT CURRENT_DATE,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    FOREIGN KEY (id_categoria) REFERENCES Categoria(id_categoria)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- Tabla Carrito
CREATE TABLE Carrito (
    id_cliente INT,
    id_producto INT,
    cantidad INT NOT NULL DEFAULT 1,
    fecha_agregado DATE DEFAULT CURRENT_DATE,
    PRIMARY KEY (id_cliente, id_producto),
    FOREIGN KEY (id_cliente) REFERENCES Cliente(id_cliente)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES Producto(id_producto)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Tabla Pedido
CREATE TABLE Pedido (
    id_pedido INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT,
    fecha_pedido DATE DEFAULT CURRENT_DATE,
    total DECIMAL(10, 2) NOT NULL,
    estado ENUM('pendiente', 'procesando', 'enviado', 'entregado', 'cancelado') DEFAULT 'pendiente',
    FOREIGN KEY (id_cliente) REFERENCES Cliente(id_cliente)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- Tabla detalles_pedido
CREATE TABLE detalles_pedido (
    id_detalle INT PRIMARY KEY AUTO_INCREMENT,
    id_pedido INT,
    id_producto INT,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES Pedido(id_pedido)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES Producto(id_producto)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- Tabla para tokens de recuperación de contraseña
CREATE TABLE token_recuperacion (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT,
    token VARCHAR(255) NOT NULL,
    fecha_expiracion DATETIME NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES Cliente(id_cliente)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
CREATE TABLE IF NOT EXISTS MENSAJES(
    id_info INT auto_increment,
    mensaje VARCHAR(255) not null,
    CONSTRAINT mensajes_pk PRIMARY KEY (id_info)
);

INSERT INTO MENSAJES (mensaje) VALUES ('Bienvenido a la tienda');
INSERT INTO MENSAJES (mensaje) VALUES ('Pagina de registro');
INSERT INTO MENSAJES (mensaje) VALUES ('Has hecho click en el boton');

-- Insertar un usuario administrador de prueba
INSERT INTO Cliente (
    username, 
    password, 
    first_name, 
    second_name, 
    email, 
    direccion, 
    postal, 
    telefono, 
    rol, 
    pregunta_seguridad, 
    respuesta_seguridad
) 
VALUES (
    'usuario_prueba', 
    'password123', 
    'Juan', 
    'Pérez', 
    'juan.perez@example.com', 
    'Calle Falsa 123', 
    '12345', 
    '555-1234', 
    'usuario', 
    '¿Cuál es tu color favorito?', 
    'Azul'
);

-- Insertar algunas categorías de ejemplo
INSERT INTO Categoria (nombre_cat, descripcion) VALUES 
('Zapatillas', 'Todo tipo de calzado deportivo'),
('Ropa Deportiva', 'Camisetas, pantalones y más'),
('Accesorios', 'Complementos deportivos');

-- Insert de categoria zapatilla
-- INSERT INTO `producto` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `stock`, `id_categoria`, `color`, `talla`, `imagen_url`, `fecha`, `estado`) VALUES -- imagen_url es la ruta de la imagen pero lo quitamos
-- (1, 'Adidas Campus Amarillas', 'Zapatillas deportivas de la marca Adidas, modelo Campus en color amarillo.', 59.99, 50, 1, 'Amarillo', '42', 'ZAPATOS/ADIDAS CAMPUS AMARILLAS/1.png\r\n', '2025-01-20', 'activo'),
-- (2, 'Adidas Campus Grises', 'Zapatillas deportivas de la marca Adidas, modelo Campus en color gris.', 59.99, 50, 1, 'Gris', '42', 'ZAPATOS/ADIDAS CAMPUS GRISES/1.png\r\n', '2025-01-20', 'activo');

-- Cambios en la base de datos

-- Tabla Producto_Imagenes para almacenar las imagenes de los productos
CREATE TABLE Producto_Imagenes (
    id_imagen INT PRIMARY KEY AUTO_INCREMENT,
    id_producto INT,
    url_imagen VARCHAR(255) NOT NULL,
    es_principal BOOLEAN DEFAULT FALSE,
    orden INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_producto) REFERENCES Producto(id_producto)
        ON DELETE CASCADE
);
--Eliminar la columna imagen_url de la tabla Producto hay que eliminar esta columna de la tabla producto (esto sol la primera vez)

ALTER TABLE Producto DROP COLUMN imagen_url;

-- Categoria de marca
CREATE TABLE Marca (
    id_marca INT PRIMARY KEY AUTO_INCREMENT,
    nombre_marca VARCHAR(100) NOT NULL,
    logo_url VARCHAR(255),
    estado ENUM('activo', 'inactivo') DEFAULT 'activo'
);

-- Insertar las 4 marcas principales
INSERT INTO Marca (nombre_marca) VALUES
('Nike'),
('adidas'),
('New Balance'),
('Puma');

-- 1. Primero insertamos el producto Adidas Campus Amarillas
INSERT INTO Producto (
    nombre_producto, 
    descripcion, 
    precio, 
    stock, 
    id_categoria,
    id_marca, 
    color, 
    talla,
    estado
) VALUES (
    'Adidas Campus Amarillas',
    'Zapatillas deportivas Adidas Campus en color amarillo, perfectas para un estilo casual y deportivo',
    59.99,
    50,
    1,  -- id_categoria (Zapatillas)
    2,  -- id_marca (Adidas)
    'Amarillo',
    '42',
    'activo'
);
-- Hay 2 fromas de insertar las imagenes la primera es hacer el insert normal y la segunda es hacer el insert de la imagen secundaria despues de probar la ruta del producto 2
--opcion1.Luego insertamos las imagenes  secundarias  despues de probar la rutadel producto 2
--(@ultimo_id, 'images/productos/adidas/zapatillas/campus-grises/1.jpg', TRUE, 1)
-- INSERT INTO Producto_Imagenes (id_producto, url_imagen, es_principal, orden) VALUES
-- (1, 'imagenes/productos/adidas/zapatillas/campus-amarillas/1.png',TRUE, 1);
-- (2, 'imagenes/productos/adidas/zapatillas/campus-amarillas/2.png', FALSE, 2),
-- (2, 'imagenes/productos/adidas/zapatillas/campus-amarillas/3.png', FALSE, 3);

-- opcion2. Verifica la ruta en  la tabla productos_imagnes antes dePara el producto 2
INSERT INTO Producto_Imagenes (id_producto, url_imagen, es_principal, orden)
SELECT 
    2, -- id_producto cambiado a 2
    'imageness/productos/adidas/zapatillas/campus-grises/1.png', -- ruta actualizada para el nuevo producto
    TRUE,
    1
WHERE EXISTS (
    SELECT 1 
    FROM Producto 
    WHERE id_producto = 2  -- también cambiado a 2
);

-- 3.Verificar que se guardó
SELECT url_imagen FROM Producto_Imagenes WHERE id_producto = 2;

