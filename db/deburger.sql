-- ============================================================
--  DEBURGER - Base de datos completa (un solo archivo)
--  Compatible con MySQL 8+ y MariaDB 10.4+
--  Uso: importar este archivo completo (phpMyAdmin > Importar,
--  o desde consola:  mysql -u root -p < deburger.sql)
-- ============================================================

SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS `deburger`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `deburger`;

-- ------------------------------------------------------------
-- TABLAS
-- ------------------------------------------------------------

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`),
  CONSTRAINT `chk_categoria_nombre`
    CHECK (`nombre` IN ('hamburguesas','bebidas','combos','acompañamiento'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `intentos_fallidos` int(11) DEFAULT 0,
  `bloqueado` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `chk_producto_precio` CHECK (`precio` >= 0),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`)
    REFERENCES `categorias` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha` date DEFAULT (CURRENT_DATE),
  `tipo_pago` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `tipo_entrega` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `chk_pedido_tipo_pago` CHECK (`tipo_pago` IN ('Efectivo','Tarjeta')),
  CONSTRAINT `chk_pedido_total` CHECK (`total` >= 0),
  CONSTRAINT `chk_pedido_estado` CHECK (`estado` IN ('Pendiente','Preparando','Entregado','Cancelado')),
  CONSTRAINT `chk_pedido_entrega` CHECK (`tipo_entrega` IN ('Delivery','Retiro')),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`)
    REFERENCES `clientes` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `detalle_pedidos` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `chk_detalle_cantidad` CHECK (`cantidad` > 0),
  CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`)
    REFERENCES `pedidos` (`id_pedido`),
  CONSTRAINT `detalle_pedidos_ibfk_2` FOREIGN KEY (`id_producto`)
    REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- DATOS DE EJEMPLO
-- (se cargan antes de crear los triggers para que se conserven
--  los totales tal cual estan)
-- ------------------------------------------------------------

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'hamburguesas'),
(2, 'bebidas'),
(3, 'combos'),
(4, 'acompañamiento');

-- Las contraseñas estan en MD5 (igual que usa login.php / register.php)
INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `telefono`, `email`, `pass`, `fecha_nacimiento`, `intentos_fallidos`, `bloqueado`) VALUES
(1, 'Ana',     'Reyes',    '1131169015', 'ana@ana',         '276b6c4692e78d4799c12ada515bc3e4', '8345-09-17', 3, 1),
(4, 'fede',    'Reyes',    '2147483647', 'fede@fede',       'c4ca4238a0b923820dcc509a6f75849b', NULL,         2, 0),
(5, 'Tamara',  'Britez',   '0',          'tami@gmail.com',  'a2a0ac851d64e96e659198bdef179228', '2008-08-22', 0, 0),
(6, 'pablo',   'fiscella', '2147483647', 'p@p',             '83878c91171338902e0fe0fb97a8c47a', '5653-02-04', 0, 0);

INSERT INTO `productos` (`id_producto`, `nombre`, `id_categoria`, `precio`, `descripcion`) VALUES
(1, 'Hamburguesa Clásica', 1, 5000.00, 'Carne, lechuga, tomate y queso'),
(2, 'Hamburguesa Doble',   1, 6000.00, 'Doble carne y queso'),
(3, 'Coca Cola',           2,  900.00, 'Bebida 500ml'),
(4, 'Combo Clásico',       3, 9500.00, 'Hamburguesa + papas + bebida'),
(5, 'Papas Fritas',        4, 2200.00, 'Porción grande de papas');

INSERT INTO `pedidos` (`id_pedido`, `id_cliente`, `fecha`, `tipo_pago`, `total`, `estado`, `tipo_entrega`) VALUES
(1, 1, '2026-07-03', 'Tarjeta',  3700.00, 'Entregado',  'Delivery'),
(2, 1, '2026-07-03', 'Efectivo', 2500.00, 'Preparando', 'Retiro'),
(3, 4, '2026-07-03', 'Tarjeta',  3500.00, 'Pendiente',  'Delivery'),
(4, 4, '2026-07-03', 'Efectivo', 1200.00, 'Cancelado',  'Retiro'),
(5, 1, '2026-07-03', 'Tarjeta',  5000.00, 'Entregado',  'Delivery');

INSERT INTO `detalle_pedidos` (`id_detalle`, `id_pedido`, `cantidad`, `id_producto`) VALUES
(1, 1, 1, 4),
(2, 1, 1, 3),
(3, 2, 1, 1),
(4, 3, 1, 4),
(5, 4, 1, 5),
(6, 5, 2, 2),
(7, 5, 1, 3);

-- ------------------------------------------------------------
-- PROCEDIMIENTO Y TRIGGERS
-- ------------------------------------------------------------

DELIMITER $$

CREATE PROCEDURE `intento_fallido` (IN `correo` VARCHAR(255))
BEGIN
    UPDATE clientes
    SET intentos_fallidos = intentos_fallidos + 1
    WHERE email = correo AND bloqueado = FALSE;

    UPDATE clientes
    SET bloqueado = TRUE
    WHERE email = correo AND intentos_fallidos >= 3;
END$$

CREATE TRIGGER `calcular_total_pedido` AFTER INSERT ON `detalle_pedidos`
FOR EACH ROW
BEGIN
    UPDATE pedidos
    SET total = (
        SELECT SUM(dp.cantidad * p.precio)
        FROM detalle_pedidos dp
        INNER JOIN productos p ON dp.id_producto = p.id_producto
        WHERE dp.id_pedido = NEW.id_pedido
    )
    WHERE id_pedido = NEW.id_pedido;
END$$

CREATE TRIGGER `evitar_producto_pedido_cancelado` BEFORE INSERT ON `detalle_pedidos`
FOR EACH ROW
BEGIN
    DECLARE estado_pedido VARCHAR(255);

    SELECT estado INTO estado_pedido
    FROM pedidos
    WHERE id_pedido = NEW.id_pedido;

    IF estado_pedido = 'Cancelado' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se pueden agregar productos a un pedido cancelado';
    END IF;
END$$

CREATE TRIGGER `validar_cantidad_producto` BEFORE INSERT ON `detalle_pedidos`
FOR EACH ROW
BEGIN
    IF NEW.cantidad <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La cantidad debe ser mayor a 0';
    END IF;
END$$

CREATE TRIGGER `evitar_modificar_pedido_entregado` BEFORE UPDATE ON `pedidos`
FOR EACH ROW
BEGIN
    IF OLD.estado = 'Entregado' AND NEW.estado <> 'Entregado' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede modificar un pedido que ya fue entregado';
    END IF;
END$$

DELIMITER ;

-- Para desbloquear una cuenta:
-- UPDATE clientes SET intentos_fallidos = 0, bloqueado = 0 WHERE email = 'ana@ana';
