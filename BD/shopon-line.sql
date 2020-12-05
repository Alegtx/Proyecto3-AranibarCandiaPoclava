-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-12-2020 a las 03:04:14
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shopon-line`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `Usuario` varchar(30) NOT NULL,
  `Clave` text NOT NULL,
  `Imagen` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`Usuario`, `Clave`, `Imagen`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', ''),
('Ketal', '4badaee57fed5610012a296273158f5f', '2020-11-27_19.59.06_KETAL.png'),
('Fidalga', 'e10adc3949ba59abbe56e057f20f883e', 'default-shopon-line.png'),
('Hipermaxi', '4d186321c1a7f0f354b297e8914ab240', 'default-shopon-line.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `CodigoCat` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`CodigoCat`, `Nombre`, `Descripcion`) VALUES
('CAT-001', 'Lacteos', 'Leche, queso, etc.'),
('CAT-002', 'Embutidos', 'Mortadela, carne fria, salchichas, etc'),
('CAT-003', 'Bebidas, Licores Y Tabacos', 'Ron, Coca Cola, Camel,etc'),
('CAT-004', 'Chocolates, Dulces y Galletas', 'Oreo, Chubi, etc'),
('CAT-005', 'Panaderia y Pasteleria', 'Pan molde, Queque, Tostada, etc'),
('CAT-006', 'Cuidado Personal', 'Shampoo, Cepillo, Jabon, etc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `NIT` varchar(30) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `Apellidos` varchar(70) NOT NULL,
  `Clave` text NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Telefono` int(20) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`NIT`, `Usuario`, `Nombre`, `Apellidos`, `Clave`, `Direccion`, `Telefono`, `Email`) VALUES
('6962296', 'Alegtx', 'Alejandro', 'Aranibar', '24e646123f3da203f7fb7437e06112e9', 'Av. Busch', 67141109, 'alejandroa453@mail.com'),
('14489245', 'cheito', 'Sergio Ariel', 'Candia Barriga', '4d186321c1a7f0f354b297e8914ab240', 'La Paz, Avenida Bush', 70167309, 'cheito2673@gmail.com'),
('1527788', 'Jasonex', 'Jeison', 'Zabaleta', '6c44e5cd17f0019c64b042e4a745412a', 'Villa el carmen', 67142360, 'a@a.com'),
('1695048', 'Duty', 'Alejandro', 'Machaca Piza', '4badaee57fed5610012a296273158f5f', 'Villa Copacabana', 67117320, 'duty@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

DROP TABLE IF EXISTS `detalle`;
CREATE TABLE IF NOT EXISTS `detalle` (
  `NumPedido` int(20) NOT NULL,
  `CodigoProd` varchar(30) NOT NULL,
  `CantidadProductos` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`NumPedido`, `CodigoProd`, `CantidadProductos`) VALUES
(3, 'KET-001', 1),
(6, 'KET-001', 1),
(6, 'KET-002', 1),
(6, 'KET-003', 1),
(7, 'KET-001', 1),
(7, 'KET-002', 1),
(8, 'FID-001', 1),
(8, 'FID-008', 1),
(8, 'FID-013', 1),
(11, 'KET-001', 4),
(11, 'KET-005', 5),
(11, 'KET-008', 3),
(12, 'KET-001', 6),
(13, 'KET-001', 4),
(13, 'KET-005', 4),
(13, 'KET-008', 2),
(13, 'KET-012', 5),
(14, 'KET-002', 3),
(14, 'KET-007', 2),
(14, 'KET-013', 3),
(14, 'KET-015', 3),
(15, 'HIP-002', 4),
(16, 'FID-007', 2),
(16, 'FID-015', 3),
(16, 'FID-014', 8),
(16, 'FID-013', 4),
(16, 'FID-010', 3),
(16, 'FID-009', 1),
(17, 'FID-009', 4),
(17, 'FID-010', 3),
(17, 'FID-001', 1),
(17, 'FID-004', 2),
(18, 'KET-002', 3),
(18, 'KET-004', 3),
(18, 'KET-001', 1),
(18, 'KET-011', 5),
(18, 'KET-009', 5),
(18, 'KET-003', 3),
(18, 'KET-010', 2),
(19, 'KET-011', 1),
(19, 'KET-013', 1),
(21, 'KET-011', 2),
(21, 'KET-014', 5),
(21, 'KET-015', 3),
(21, 'KET-009', 6),
(21, 'KET-006', 3),
(23, 'KET-011', 3),
(23, 'KET-002', 3),
(23, 'KET-015', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `CodigoProd` varchar(30) NOT NULL,
  `NombreProd` varchar(30) NOT NULL,
  `CodigoCat` varchar(30) NOT NULL,
  `Precio` decimal(30,2) NOT NULL,
  `Marca` varchar(30) NOT NULL,
  `Stock` int(20) NOT NULL,
  `Imagen` varchar(150) NOT NULL,
  `NombreAdmin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`CodigoProd`, `NombreProd`, `CodigoCat`, `Precio`, `Marca`, `Stock`, `Imagen`, `NombreAdmin`) VALUES
('KET-001', 'Leche Natural', 'CAT-001', '6.50', 'Pil', 15, '2020-11-27_20.00.37_leche.jpg', 'Ketal'),
('KET-002', 'Biogurt Frutilla 1LT', 'CAT-001', '14.50', 'Pil', 33, 'yogurt.jpg', 'Ketal'),
('KET-003', 'Leche Chocolatada', 'CAT-001', '8.00', 'Pil', 35, 'lechechoco.jpg', 'Ketal'),
('KET-004', 'Leche Vaquita', 'CAT-001', '1.00', 'Pil', 166, 'chocolatada.jpg', 'Ketal'),
('KET-005', 'Dulce de Leche 500Gr', 'CAT-001', '16.00', 'Pil', 83, 'dulcedeleche.jpg', 'Ketal'),
('KET-006', 'Jaom Sandwichero X Kilo', 'CAT-002', '48.90', 'Sofia', 53, 'jamon.jpg', 'Ketal'),
('KET-007', 'Salchicha Sin Piel 500 Gr', 'CAT-002', '45.20', 'Stege', 39, 'salchicha.jpg', 'Ketal'),
('KET-008', 'Pate de Higado Pollo', 'CAT-002', '12.50', 'Sofia', 31, 'pate.jpg', 'Ketal'),
('KET-009', 'Chorizo Parrillero 500Gr', 'CAT-002', '29.90', 'Osfim', 36, 'chorizo.jpg', 'Ketal'),
('KET-010', 'Mortadela Cervecero 140 Gr', 'CAT-002', '20.50', 'Stege', 24, 'mortadela.jpg', 'Ketal'),
('KET-011', 'Ades Manzana 1L', 'CAT-003', '10.00', 'Ades', 73, 'ades.jpg', 'Ketal'),
('KET-012', 'Camel Activate 20Uni', 'CAT-003', '17.90', 'Camel', 120, 'camelA.jpg', 'Ketal'),
('KET-013', 'Agua 7L', 'CAT-003', '13.00', 'Villa Santa', 70, 'agua.jpg', 'Ketal'),
('KET-014', 'Cerveza 620Ml', 'CAT-003', '14.00', 'Paceña', 23, 'cerveza.jpg', 'Ketal'),
('KET-015', 'Coca Cola 3L', 'CAT-003', '12.90', 'Coca Cola', 86, 'coca3.jpg', 'Ketal'),
('FID-001', 'Ron Añejo 1L', 'CAT-003', '83.90', 'Ron Abuelo', 221, 'ron.jpg', 'Fidalga'),
('FID-002', 'Chocolate Vizzio', 'CAT-004', '23.50', 'Costa', 104, 'vizzio.jpg', 'Fidalga'),
('FID-003', 'Chocolate Sapito 30 Uni', 'CAT-004', '18.90', 'Sapito', 64, 'sapito.jpg', 'Fidalga'),
('FID-004', 'Doritos de Queso 200Gr', 'CAT-004', '19.90', 'Doritos', 74, 'dorito.jpg', 'Fidalga'),
('FID-005', 'Galletas Oreo Six Pack', 'CAT-004', '10.50', 'Oreo', 56, 'oreo.jpg', 'Fidalga'),
('FID-006', 'Chocolate M&M 150Gr', 'CAT-004', '27.80', 'M&M', 38, 'MYM.jpg', 'Fidalga'),
('FID-007', 'Alfajor 6Uni', 'CAT-005', '11.90', 'Shopon', 27, 'alfajor.jpg', 'Fidalga'),
('FID-008', 'Pan Sarna Bolsa 10Uni', 'CAT-005', '0.70', 'Shopon', 43, 'Pan.jpg', 'Fidalga'),
('FID-009', 'Cunape Abiscochado', 'CAT-005', '13.50', 'Monona', 72, 'cunape.jpg', 'Fidalga'),
('FID-010', 'Queque Chocolate 220 Gr', 'CAT-005', '9.90', 'La Suprema', 77, 'queque.jpg', 'Fidalga'),
('FID-011', 'Jabon Liquido 360Ml', 'CAT-006', '12.00', 'Liz', 365, 'jabonliquido.jpg', 'Fidalga'),
('FID-012', 'Papel Clasico 12Uni', 'CAT-006', '23.00', 'Nacional', 556, 'papel.jpg', 'Fidalga'),
('FID-013', 'Jabon Original', 'CAT-006', '8.90', 'Dove', 175, 'jabon.jpg', 'Fidalga'),
('FID-014', 'Crema Peinar Rizos Obedientes', 'CAT-006', '16.70', 'Sedal', 129, 'crema.jpg', 'Fidalga'),
('FID-015', 'Colgate MaxWhite', 'CAT-006', '19.60', 'Colgate', 15, 'colgate.jpg', 'Fidalga'),
('HIP-002', 'Sprite 3L', 'CAT-003', '10.00', 'Coca-Cola', 26, '2020-11-27_20.04.19_sprite-3l.jpg', 'Hipermaxi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

DROP TABLE IF EXISTS `registro`;
CREATE TABLE IF NOT EXISTS `registro` (
  `Fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `NombreAdmin` varchar(30) NOT NULL,
  `Tabla` varchar(30) NOT NULL,
  `Accion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`Fecha`, `NombreAdmin`, `Tabla`, `Accion`) VALUES
('2020-10-30 15:12:58', 'Ketal', 'Producto', 'Registrar'),
('2020-10-30 15:15:21', 'Ketal', 'Producto', 'Eliminar'),
('2020-10-30 15:15:33', 'Ketal', 'Producto', 'Registrar'),
('2020-10-30 15:15:45', 'Ketal', 'Producto', 'Eliminar'),
('2020-10-30 15:19:26', 'Ketal', 'Venta', 'Actualizar'),
('2020-10-30 15:22:36', 'admin', 'Administrador', 'Registrar'),
('2020-11-06 16:01:49', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-06 16:04:28', 'admin', 'Administrador', 'Registrar'),
('2020-11-12 14:51:49', 'Ketal', 'Producto', 'Actualizar'),
('2020-11-16 20:10:38', 'Fidalga', 'Venta', 'Actualizar'),
('2020-11-16 20:18:14', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-16 20:18:19', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-16 20:18:33', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-16 20:23:55', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-16 20:24:55', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-20 21:26:46', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-20 21:38:49', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-20 21:39:57', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-20 21:40:17', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-20 21:40:37', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-20 21:41:11', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-20 21:41:26', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-23 14:52:32', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-23 14:55:54', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-23 14:58:17', 'Hipermaxi', 'Producto', 'Registrar'),
('2020-11-23 14:59:33', 'Hipermaxi', 'Producto', 'Actualizar'),
('2020-11-23 15:02:52', 'Hipermaxi', 'Producto', 'Registrar'),
('2020-11-23 15:03:15', 'Hipermaxi', 'Producto', 'Eliminar'),
('2020-11-23 15:03:59', 'Hipermaxi', 'Categoria', 'Registrar'),
('2020-11-23 15:04:35', 'Hipermaxi', 'Categoria', 'Actualizar'),
('2020-11-23 15:08:02', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-23 15:17:20', 'Ketal', 'Categoria', 'Eliminar'),
('2020-11-23 15:25:26', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 19:50:57', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 19:51:06', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 20:40:35', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 20:44:00', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 20:44:34', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 20:44:42', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 20:53:55', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 20:54:52', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 20:55:42', 'Ketal', 'Producto', 'Actualizar'),
('2020-11-26 20:57:38', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-26 21:02:01', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-26 22:23:21', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-26 23:22:19', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 23:22:29', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 23:22:58', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 23:25:23', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 23:25:33', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-26 23:34:40', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-26 23:34:54', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-26 23:36:26', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-27 15:59:06', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-27 15:59:48', 'Ketal', 'Venta', 'Actualizar'),
('2020-11-27 16:00:37', 'Ketal', 'Administrador', 'Modificar'),
('2020-11-27 16:01:46', 'Ketal', 'Producto', 'Actualizar'),
('2020-11-27 16:04:19', 'Hipermaxi', 'Administrador', 'Modificar'),
('2020-11-30 14:49:37', 'Fidalga', 'Venta', 'Actualizar'),
('2020-11-30 20:33:12', 'Hipermaxi', 'Venta', 'Actualizar'),
('2020-11-30 20:34:13', 'Fidalga', 'Venta', 'Actualizar'),
('2020-12-04 19:02:14', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:05:52', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:09:26', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:16:39', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:18:16', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:22:37', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:23:15', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:23:41', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:32:37', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:32:37', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:32:54', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:44:24', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:45:02', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:45:44', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:49:56', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:50:14', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 19:52:38', 'Fidalga', 'Venta', 'Actualizar'),
('2020-12-04 20:23:04', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 22:47:42', 'Ketal', 'Venta', 'Actualizar'),
('2020-12-04 22:57:43', 'Ketal', 'Venta', 'Actualizar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `NumPedido` int(20) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `NIT` varchar(30) NOT NULL,
  `TotalPagar` decimal(30,2) NOT NULL,
  `Estado` varchar(150) NOT NULL,
  `NombreAdmin` varchar(30) NOT NULL,
  `FechaEntrega` varchar(30) NOT NULL DEFAULT '-',
  `FechaRecogo` varchar(30) NOT NULL DEFAULT '-',
  `MotivoCancelacion` varchar(150) NOT NULL DEFAULT '-',
  PRIMARY KEY (`NumPedido`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`NumPedido`, `Fecha`, `NIT`, `TotalPagar`, `Estado`, `NombreAdmin`, `FechaEntrega`, `FechaRecogo`, `MotivoCancelacion`) VALUES
(3, '2020-11-06 15:12:58', '6962296', '6.50', 'Entregado', 'Ketal', '-', '-', '-'),
(15, '2020-11-23 16:12:58', '1527788', '40.00', 'Entregado', 'Hipermaxi', '2020-11-30 20:33:12', '-', '-'),
(6, '2020-11-06 15:15:58', '6962296', '29.00', 'Entregado', 'Ketal', '2020-12-04 19:49:56', '-', '-'),
(7, '2020-11-06 18:12:58', '6962296', '21.00', 'Entregado', 'Ketal', '2020-12-04 19:50:14', '-', '-'),
(8, '2020-11-09 15:03:58', '1527788', '93.50', 'Entregado', 'Fidalga', '-', '-', '-'),
(11, '2020-11-17 09:12:03', '1527788', '143.50', 'Cancelado', 'Ketal', '-', '-', 'Nos falta stock de todos los productos que nos pidio.'),
(12, '2020-11-17 17:12:58', '1527788', '39.00', 'Pendiente', 'Ketal', '-', '-', '-'),
(13, '2020-11-17 17:55:58', '1527788', '204.50', 'Entregado', 'Ketal', '2020-11-27 15:59:48', '-', '-'),
(14, '2020-11-17 20:12:58', '1527788', '211.60', 'Entregado', 'Ketal', '2020-11-26 23:36:26', '-', '-'),
(16, '2020-11-26 22:29:51', '6962296', '261.50', 'Cancelado', 'Fidalga', '-', '-', 'Nos falta stock de la mayoria de productos que solicito'),
(17, '2020-11-30 14:45:26', '1695048', '207.40', 'Entregado', 'Fidalga', '2020-11-30 14:49:37', '-', '-'),
(18, '2020-12-04 20:10:14', '6962296', '353.10', 'Entregado', 'Ketal', '2020-12-04 20:23:04', '2020-12-07', '-'),
(19, '2020-12-04 22:44:45', '6962296', '23.00', 'Entregado', 'Ketal', '2020-12-04 22:47:42', '2020-12-13', '-'),
(21, '2020-12-04 22:49:39', '6962296', '454.80', 'Cancelado', 'Ketal', '-', '2020-12-08', 'No tenemos stock suficiente.'),
(23, '2020-12-04 23:03:25', '6962296', '181.80', 'Pendiente', 'Ketal', '-', '2020-12-13', '-');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
