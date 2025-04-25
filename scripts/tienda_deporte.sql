-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2025 a las 19:59:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_deporte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `fecha_agregado` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_cat` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_cat`, `descripcion`, `imagen_url`) VALUES
(1, 'Zapatillas', 'Sneakers y zapatillas lifestyle', NULL),
(2, 'Ropa Deportiva', 'Sudaderas, camisetas, pantalones y más', NULL),
(3, 'Accesorios', 'Gorras, mochilas y complementos', NULL),
(10, 'Ropa de Hombre', 'Encuentra tu estilo deportivo', 'imagenes/categoria/hombre/ropa de hombre.webp'),
(11, 'Calzado de Hombre', 'El mejor calzado deportivo para hombre', 'imagenes/categoria/hombre/calzado de hombre.webp'),
(12, 'Accesorios Hombre', 'Complementa tu look deportivo', 'imagenes/categoria/hombre/accesorios de hombre.webp'),
(13, 'Ropa de Mujer', 'Diseño y rendimiento para ella', 'imagenes/categoria/mujer/cat ropa mujer.webp'),
(14, 'Calzado de Mujer', 'El mejor calzado deportivo para mujer', 'imagenes/categoria/mujer/cat calzado mujer.webp'),
(15, 'Accesorios Mujer', 'Complementa tu estilo deportivo', 'imagenes/categoria/mujer/cat accesorios mujer.webp'),
(16, 'Ropa de Niños', 'Moda deportiva para los más pequeños', 'imagenes/categoria/ninos/cat ropa niños.webp'),
(17, 'Calzado de Niños', 'El mejor calzado deportivo para niños', 'imagenes/categoria/ninos/cat calzado niños.webp'),
(18, 'Accesorios Niños', 'Complementos deportivos para niños', 'imagenes/categoria/ninos/cat accesorios niños.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `second_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` text DEFAULT NULL,
  `postal` varchar(5) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `rol` enum('usuario','administrador') DEFAULT 'usuario',
  `pregunta_seguridad` varchar(255) DEFAULT NULL,
  `respuesta_seguridad` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `username`, `password`, `first_name`, `second_name`, `email`, `direccion`, `postal`, `telefono`, `rol`, `pregunta_seguridad`, `respuesta_seguridad`) VALUES
(3, 'bema', '$2y$10$lZUt2gF7oQtSxVg2dgCwbORHYz5XZ5fyJ.bSJWDQCJ9tU81KPw5Ai', 'Blanca', 'Esmeraldaa', 'esmeralda@gmail.com', 'caller roselles', '08050', '638866890', 'usuario', '¿Cuál es el nombre de tu primera mascota?', 'lori'),
(4, 'manolo', '$2y$10$TmJtf6FItGMssD9V9WUn7uaCy783QlnFL/IPjBHCOshbjnew42mYi', 'Manolo', 'Mario', 'manolo@gmail.com', 'caller rosell', '08050', '638866870', 'usuario', '¿En qué ciudad naciste?', 'barcelona'),
(6, 'u.arjona', '$2y$10$/W5w58biYzBmOrZh/4l7.e6xSs4091SOdLFI23Z70yP19iPmybney', 'Juanma', 'Manuel', 'unaxarjoverde6@gmail.com', 'meridiana', '08945', '69854896', 'usuario', '¿Cuál es el nombre de tu primera mascota?', 'pez'),
(7, 'u.arjona', '$2y$10$/W5w58biYzBmOrZh/4l7.e6xSs4091SOdLFI23Z70yP19iPmybney', 'Unax', 'Arjona', 'unaxarjoverde7@gmail.com', 'Carrer Mayor 39 Bajos', '08921', '0661351439', 'usuario', '¿Cuál es el nombre de tu primera mascota?', 'sara');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `home_content`
--

CREATE TABLE `home_content` (
  `id_content` int(11) NOT NULL,
  `tipo` enum('hero','banner','promocion') NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `subtitulo` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `url_imagen` varchar(255) NOT NULL,
  `url_enlace` varchar(255) DEFAULT NULL,
  `orden` int(11) NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `home_content`
--

INSERT INTO `home_content` (`id_content`, `tipo`, `titulo`, `subtitulo`, `descripcion`, `url_imagen`, `url_enlace`, `orden`, `estado`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'hero', 'Nueva Colección Deportiva', 'Descubre lo último en moda deportiva', NULL, 'imagenes/home/hero-principal1.png', '/PaginaWeb_BU/resource_productos.php', 1, 'activo', NULL, NULL),
(2, 'hero', 'Nueva Colección Deportiva', 'Descubre lo último en moda deportiva', NULL, 'imagenes/home/hero-principal1.png', '/PaginaWeb_BU/resource_productos.php', 1, 'activo', NULL, NULL),
(3, 'hero', 'Nueva Colección Deportiva', 'Descubre lo último en moda deportiva', NULL, 'imagenes/home/hero-principal2.png', '/PaginaWeb_BU/resource_productos.php', 2, 'activo', NULL, NULL),
(4, 'hero', 'Nueva Colección Deportiva', 'Descubre lo último en moda deportiva', NULL, 'imagenes/home/hero-principal3.png', '/PaginaWeb_BU/resource_productos.php', 3, 'activo', NULL, NULL),
(5, 'banner', 'Novedad en Zapatillas', '¡Hasta 40% de descuento!', NULL, 'imagenes/home/banner2.png', '/PaginaWeb_BU/resource_productos.php?categoria=1', 4, 'activo', NULL, NULL),
(6, 'banner', 'No te pierda lo ultimo', '¡Hasta 20% de descuento!', NULL, 'imagenes/home/banner1.png', '/PaginaWeb_BU/resource_productos.php?categoria=1', 5, 'activo', NULL, NULL),
(7, 'hero', 'Nueva Colección Deportiva', 'Descubre lo último en moda deportiva', NULL, '/PaginaWeb_BU/public/imagenes/home/hero-principal1.png', '/PaginaWeb_BU/resource_productos.php', 1, 'activo', NULL, NULL),
(8, 'hero', 'Nueva Colección Deportiva', 'Descubre lo último en moda deportiva', NULL, '/PaginaWeb_BU/public/imagenes/home/hero-principal2.png', '/PaginaWeb_BU/resource_productos.php', 2, 'activo', NULL, NULL),
(9, 'hero', 'Nueva Colección Deportiva', 'Descubre lo último en moda deportiva', NULL, '/PaginaWeb_BU/public/imagenes/home/hero-principal3.png', '/PaginaWeb_BU/resource_productos.php', 3, 'activo', NULL, NULL),
(10, 'banner', 'Novedad en Zapatillas', '¡Hasta 40% de descuento!', NULL, '/PaginaWeb_BU/public/imagenes/home/banner2.png', '/PaginaWeb_BU/resource_productos.php?categoria=1', 4, 'activo', NULL, NULL),
(11, 'banner', 'No te pierdas lo último', '¡Hasta 20% de descuento!', NULL, '/PaginaWeb_BU/public/imagenes/home/banner1.png', '/PaginaWeb_BU/resource_productos.php?categoria=1', 5, 'activo', NULL, NULL),
(12, 'banner', 'Moda Hombre', 'Descubre la nueva colección', NULL, 'imagenes/categoria/hombre/banner_hombre.webp', '/PaginaWeb_BU/index.php?action=categoria-hombre', 1, 'activo', NULL, NULL),
(13, 'banner', 'Estilo Deportivo', 'Para hombres activos', NULL, 'imagenes/categoria/hombre/banner_hombre1.webp', '/PaginaWeb_BU/index.php?action=categoria-hombre', 2, 'activo', NULL, NULL),
(14, 'banner', 'Tendencias', 'Lo último en moda masculina', NULL, 'imagenes/categoria/hombre/banner_hombre2.webp', '/PaginaWeb_BU/index.php?action=categoria-hombre', 3, 'activo', NULL, NULL),
(15, 'banner', 'Moda Mujer', 'Descubre la nueva colección', NULL, 'imagenes/categoria/mujer/banner mujer.webp', '/PaginaWeb_BU/index.php?action=categoria-mujer', 4, 'activo', NULL, NULL),
(16, 'banner', 'Estilo Deportivo', 'Para mujeres activas', NULL, 'imagenes/categoria/mujer/banner mujer1.webp', '/PaginaWeb_BU/index.php?action=categoria-mujer', 5, 'activo', NULL, NULL),
(17, 'banner', 'Tendencias', 'Lo último en moda femenina', NULL, 'imagenes/categoria/mujer/banner mujer2.webp', '/PaginaWeb_BU/index.php?action=categoria-mujer', 6, 'activo', NULL, NULL),
(18, 'banner', 'Moda Infantil', 'Colección para niños', NULL, 'imagenes/categoria/ninos/banner niños.webp', '/PaginaWeb_BU/index.php?action=categoria-ninos', 7, 'activo', NULL, NULL),
(19, 'banner', 'Estilo Junior', 'Deportes para todas las edades', NULL, 'imagenes/categoria/ninos/banner niños 1.webp', '/PaginaWeb_BU/index.php?action=categoria-ninos', 8, 'activo', NULL, NULL),
(20, 'banner', 'Moda Kids', 'Lo último en ropa infantil', NULL, 'imagenes/categoria/ninos/banner niños 2.webp', '/PaginaWeb_BU/index.php?action=categoria-ninos', 9, 'activo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(100) NOT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `nombre_marca`, `logo_url`, `estado`) VALUES
(1, 'Nike', NULL, 'activo'),
(2, 'adidas', NULL, 'activo'),
(3, 'New Balance', NULL, 'activo'),
(4, 'Puma', NULL, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_info` int(11) NOT NULL,
  `mensaje` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_info`, `mensaje`) VALUES
(1, 'Bienvenido a la tienda'),
(2, 'Pagina de registro'),
(3, 'Has hecho click en el boton');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha_pedido` date DEFAULT curdate(),
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','procesando','enviado','entregado','cancelado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `id_categoria` int(11) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `talla` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT curdate(),
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `id_marca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `stock`, `id_categoria`, `color`, `talla`, `fecha`, `estado`, `id_marca`) VALUES
(2, 'Adidas Campus Amarillas', 'Zapatillas deportivas Adidas Campus en color amarillo, perfectas para un estilo casual y deportivo', 59.99, 50, 1, 'Amarillo', '42', '2025-03-09', 'activo', 2),
(3, 'Adidas Campus Grises', 'Zapatillas deportivas Adidas Campus en color gris, diseño clásico y versátil perfecto para cualquier ocasión', 120.99, 60, 1, 'Gris', '42', '2025-03-09', 'activo', 2),
(4, 'Adidas Campus Marrones', 'Zapatillas deportivas Adidas Campus en color marrón, un diseño clásico con un toque elegante y casual', 100.99, 30, 1, 'Marrón', '40', '2025-03-09', 'activo', 2),
(5, 'Adidas Campus Negras', 'Zapatillas deportivas Adidas Campus en color negras, perfectas para un estilo casual y deportivo', 120.99, 100, 1, 'Negras', '40', '2025-03-11', 'activo', 2),
(6, 'Adidas Campus Verdes', 'Zapatillas deportivas Adidas Campus en color verde, perfectas para un estilo casual y deportivo', 115.99, 50, 1, 'Verde', '43', '2025-03-12', 'activo', 2),
(10, 'Nike Air Force', 'Zapatillas deportivas Nike Air Force en color blanco, perfectas para un estilo casual y deportivo', 75.99, 56, 1, 'Blancas', '46', '2025-03-12', 'activo', 1),
(11, 'Nike Jordan Negras', 'Zapatillas deportivas Nike Jordan en color Negro, perfectas para un estilo casual y deportivo', 59.99, 50, 1, 'Negra', '40', '2025-03-14', 'activo', 1),
(12, 'Nike Air Force Azul', 'Zapatillas deportivas Nike Air Force en color Azul, perfectas para un estilo casual y deportivo', 69.99, 43, 1, 'Azul', '42', '2025-03-18', 'activo', 1),
(13, 'Nike Air Force Blancas', 'Zapatillas deportivas Nike Air Force en color Blanco, perfectas para un estilo casual y deportivo', 79.99, 43, 1, 'Blanco', '48', '2025-03-18', 'activo', 1),
(14, 'Nike Air Force Blancas', 'Zapatillas deportivas Nike Air Force en color Blanco con tonos negros, perfectas para un estilo casual y deportivo', 99.99, 43, 1, 'Blanco', '45', '2025-03-18', 'activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_imagenes`
--

CREATE TABLE `producto_imagenes` (
  `id_imagen` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `url_imagen` varchar(255) NOT NULL,
  `es_principal` tinyint(1) DEFAULT 0,
  `orden` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_imagenes`
--

INSERT INTO `producto_imagenes` (`id_imagen`, `id_producto`, `url_imagen`, `es_principal`, `orden`, `fecha_creacion`) VALUES
(1, 2, 'imagenes/productos/adidas/zapatillas/campus-amarillas/1.png', 1, 1, '2025-03-09 16:18:58'),
(4, 2, 'imagenes/productos/adidas/zapatillas/campus-amarillas/2.png', 0, 2, '2025-03-09 16:34:10'),
(5, 2, 'imagenes/productos/adidas/zapatillas/campus-amarillas/3.png', 0, 3, '2025-03-09 16:34:10'),
(6, 3, 'imagenes/productos/adidas/zapatillas/campus-grises/1.png', 1, 1, '2025-03-09 16:42:31'),
(7, 3, 'imagenes/productos/adidas/zapatillas/campus-grises/2.png', 0, 2, '2025-03-09 16:42:31'),
(8, 3, 'imagenes/productos/adidas/zapatillas/campus-grises/3.png', 0, 3, '2025-03-09 16:42:31'),
(9, 4, 'imagenes/productos/adidas/zapatillas/campus-marrones/1.png', 1, 1, '2025-03-09 16:52:30'),
(10, 4, 'imagenes/productos/adidas/zapatillas/campus-marrones/2.png', 0, 2, '2025-03-09 16:52:30'),
(11, 4, 'imagenes/productos/adidas/zapatillas/campus-marrones/3.png', 0, 3, '2025-03-09 16:52:30'),
(12, 5, 'imagenes/productos/adidas/zapatillas/campus-negras/1.png', 1, 1, '2025-03-11 16:33:16'),
(13, 5, 'imagenes/productos/adidas/zapatillas/campus-negras/2.png', 0, 2, '2025-03-11 16:36:07'),
(14, 5, 'imagenes/productos/adidas/zapatillas/campus-negras/3.png', 0, 3, '2025-03-11 16:36:28'),
(15, 6, 'imagenes/productos/adidas/zapatillas/campus-verdes/1.png', 1, 1, '2025-03-12 15:14:45'),
(16, 6, 'imagenes/productos/adidas/zapatillas/campus-verdes/2.png', 0, 2, '2025-03-12 15:16:28'),
(17, 6, 'imagenes/productos/adidas/zapatillas/campus-verdes/3.png', 0, 3, '2025-03-12 15:19:26'),
(18, 10, 'imagenes/productos/nike/zapatillas/jordan-blanca/1.png', 1, 1, '2025-03-12 15:48:31'),
(19, 10, 'imagenes/productos/nike/zapatillas/jordan-blanca/2.png', 0, 2, '2025-03-12 15:49:23'),
(20, 10, 'imagenes/productos/nike/zapatillas/jordan-blanca/3.png', 0, 3, '2025-03-12 15:49:37'),
(21, 11, 'imagenes/productos/nike/zapatillas/jordan-negra/1.png', 1, 1, '2025-03-18 16:00:05'),
(22, 11, 'imagenes/productos/nike/zapatillas/jordan-negra/2.png', 0, 2, '2025-03-18 16:02:33'),
(23, 11, 'imagenes/productos/nike/zapatillas/jordan-negra/3.png', 0, 3, '2025-03-18 16:02:34'),
(37, 14, 'imagenes/productos/nike/zapatillas/nike-air-force-blanconegro/1.png', 1, 1, '2025-03-18 16:50:12'),
(38, 14, 'imagenes/productos/nike/zapatillas/nike-air-force-blanconegro/2.png', 0, 2, '2025-03-18 16:50:12'),
(39, 14, 'imagenes/productos/nike/zapatillas/nike-air-force-blanconegro/3.png', 0, 3, '2025-03-18 16:50:23'),
(48, 12, 'imagenes/productos/nike/zapatillas/nike-air-force-azul/1.png', 1, 1, '2025-03-18 17:53:36'),
(49, 12, 'imagenes/productos/nike/zapatillas/nike-air-force-azul/2.png', 0, 2, '2025-03-18 17:53:36'),
(50, 12, 'imagenes/productos/nike/zapatillas/nike-air-force-azul/3.png', 0, 3, '2025-03-18 17:53:36'),
(51, 13, 'imagenes/productos/nike/zapatillas/nike-air-force-blanca/1.png', 1, 1, '2025-03-18 17:54:10'),
(52, 13, 'imagenes/productos/nike/zapatillas/nike-air-force-blanca/2.png', 0, 2, '2025-03-18 17:54:10'),
(53, 13, 'imagenes/productos/nike/zapatillas/nike-air-force-blanca/3.png', 0, 3, '2025-03-18 17:54:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token_recuperacion`
--

CREATE TABLE `token_recuperacion` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `fecha_expiracion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_cliente`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `home_content`
--
ALTER TABLE `home_content`
  ADD PRIMARY KEY (`id_content`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_info`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `token_recuperacion`
--
ALTER TABLE `token_recuperacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `home_content`
--
ALTER TABLE `home_content`
  MODIFY `id_content` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `token_recuperacion`
--
ALTER TABLE `token_recuperacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD CONSTRAINT `detalles_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalles_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD CONSTRAINT `producto_imagenes_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `token_recuperacion`
--
ALTER TABLE `token_recuperacion`
  ADD CONSTRAINT `token_recuperacion_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
