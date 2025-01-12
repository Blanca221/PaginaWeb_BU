-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS tienda_deportiva;
USE tienda_deportiva;

-- Tabla Cliente
CREATE TABLE Cliente (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    direccion TEXT,
    telefono VARCHAR(20),
    contrasena VARCHAR(255) NOT NULL,
    fecha_registro DATE DEFAULT CURRENT_DATE,
    rol ENUM('usuario', 'administrador') DEFAULT 'usuario',
    pregunta_seguridad VARCHAR(255),
    respuesta_seguridad VARCHAR(255)
);

-- Tabla Categoria
CREATE TABLE Categoria (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nombre_cat VARCHAR(100) NOT NULL,
    descripcion TEXT
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

-- Insertar un usuario administrador de prueba
-- Contraseña: admin123 (deberás hashearla en la aplicación real)
INSERT INTO Cliente (nombre, apellido, email, contrasena, rol) 
VALUES ('Admin', 'Sistema', 'admin@tienda.com', '\$2y\$10$YourHashedPasswordHere', 'administrador');

-- Insertar algunas categorías de ejemplo
INSERT INTO Categoria (nombre_cat, descripcion) VALUES 
('Zapatillas', 'Todo tipo de calzado deportivo'),
('Ropa Deportiva', 'Camisetas, pantalones y más'),
('Accesorios', 'Complementos deportivos');