-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2026 a las 13:30:45
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
-- Base de datos: `deburger`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `intento_fallido` (IN `correo` VARCHAR(255))   BEGIN

    UPDATE clientes
    SET intentos_fallidos = intentos_fallidos + 1 WHERE email = correo  AND bloqueado = FALSE;

    UPDATE clientes
    SET bloqueado = TRUE  WHERE email = correo AND intentos_fallidos >= 3;

END$$

DELIMITER ;
/*
Con este codigo quitamos el bloqueo

UPDATE clientes
SET intentos_fallidos = 0
WHERE email = 'ana@ana';*/

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL CHECK (`nombre` in ('hamburguesas','bebidas','combos','acompañamiento'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'hamburguesas'),
(2, 'bebidas'),
(3, 'combos'),
(4, 'acompañamiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `intentos_fallidos` int(11) DEFAULT 0,
  `bloqueado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `telefono`, `email`, `pass`, `fecha_nacimiento`, `intentos_fallidos`, `bloqueado`) VALUES
(1, 'Ana', 'Reyes', 1131169015, 'ana@ana', '276b6c4692e78d4799c12ada515bc3e4', '8345-09-17', 3, 1),
(4, 'fede', 'Reyes', 2147483647, 'fede@fede', 'c4ca4238a0b923820dcc509a6f75849b', '0000-00-00', 2, 0),
(5, 'Tamara', 'Britez', 0, 'tami@gmail.com', 'a2a0ac851d64e96e659198bdef179228', '2008-08-22', 0, 0),
(6, 'pablo', 'fiscella', 2147483647, 'p@p', '83878c91171338902e0fe0fb97a8c47a', '5653-02-04', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL CHECK (`cantidad` > 0),
  `id_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id_detalle`, `id_pedido`, `cantidad`, `id_producto`) VALUES
(1, 1, 1, 4),
(2, 1, 1, 3),
(3, 2, 1, 1),
(4, 3, 1, 4),
(5, 4, 1, 5),
(6, 5, 2, 2),
(7, 5, 1, 3);

--
-- Disparadores `detalle_pedidos`
--
DELIMITER $$
CREATE TRIGGER `calcular_total_pedido` AFTER INSERT ON `detalle_pedidos` FOR EACH ROW BEGIN
    UPDATE pedidos
    SET total = (
        SELECT SUM(dp.cantidad * p.precio)
        FROM detalle_pedidos dp
        INNER JOIN productos p
            ON dp.id_producto = p.id_producto
        WHERE dp.id_pedido = NEW.id_pedido
    )
    WHERE id_pedido = NEW.id_pedido;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `evitar_producto_pedido_cancelado` BEFORE INSERT ON `detalle_pedidos` FOR EACH ROW BEGIN
    DECLARE estado_pedido VARCHAR(255);

    SELECT estado
    INTO estado_pedido
    FROM pedidos
    WHERE id_pedido = NEW.id_pedido;

    IF estado_pedido = 'Cancelado' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se pueden agregar productos a un pedido cancelado';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `validar_cantidad_producto` BEFORE INSERT ON `detalle_pedidos` FOR EACH ROW BEGIN

    IF NEW.cantidad <= 0 THEN

        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La cantidad debe ser mayor a 0';

    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha` date DEFAULT curdate(),
  `tipo_pago` varchar(255) DEFAULT NULL CHECK (`tipo_pago` in ('Efectivo','Tarjeta')),
  `total` decimal(10,2) DEFAULT NULL CHECK (`total` >= 0),
  `estado` varchar(255) DEFAULT NULL CHECK (`estado` in ('Pendiente','Preparando','Entregado','Cancelado')),
  `tipo_entrega` varchar(20) DEFAULT NULL CHECK (`tipo_entrega` in ('Delivery','Retiro'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_cliente`, `fecha`, `tipo_pago`, `total`, `estado`, `tipo_entrega`) VALUES
(1, 1, '2026-07-03', 'Tarjeta', 3700.00, 'Entregado', 'Delivery'),
(2, 1, '2026-07-03', 'Efectivo', 2500.00, 'Preparando', 'Retiro'),
(3, 4, '2026-07-03', 'Tarjeta', 3500.00, 'Pendiente', 'Delivery'),
(4, 4, '2026-07-03', 'Efectivo', 1200.00, 'Cancelado', 'Retiro'),
(5, 1, '2026-07-03', 'Tarjeta', 5000.00, 'Entregado', 'Delivery');

--
-- Disparadores `pedidos`
--
DELIMITER $$
CREATE TRIGGER `evitar_modificar_pedido_entregado` BEFORE UPDATE ON `pedidos` FOR EACH ROW BEGIN
    IF OLD.estado = 'Entregado' AND NEW.estado <> 'Entregado' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede modificar un pedido que ya fue entregado';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL CHECK (`precio` >= 0),
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `id_categoria`, `precio`, `descripcion`) VALUES
(1, 'Hamburguesa Clásica', 1, 5000.00, 'Carne, lechuga, tomate y queso'),
(2, 'Hamburguesa Doble', 1, 6000.00, 'Doble carne y queso'),
(3, 'Coca Cola', 2, 900.00, 'Bebida 500ml'),
(4, 'Combo Clásico', 3, 9500.00, 'Hamburguesa + papas + bebida'),
(5, 'Papas Fritas', 4, 2200.00, 'Porción grande de papas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `detalle_pedidos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
