-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-11-2020 a las 20:11:15
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
  `Clave` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`Usuario`, `Clave`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3'),
('Ketal', '4badaee57fed5610012a296273158f5f'),
('Fidalga', 'e10adc3949ba59abbe56e057f20f883e'),
('Hipermaxi', '4d186321c1a7f0f354b297e8914ab240');

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
('14489245', 'cheito', 'Sergio Ariel', 'Candia Barriga', '4d186321c1a7f0f354b297e8914ab240', 'La Paz, Avenida Bush', 70167309, 'cheito2673@gmail.com');

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
(1, 'PRO-001', 1),
(2, 'PRO-002', 1),
(2, 'PRO-002', 1),
(3, 'KET-001', 1),
(6, 'KET-001', 1),
(6, 'KET-002', 1),
(6, 'KET-003', 1),
(7, 'KET-001', 1),
(7, 'KET-002', 1);

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
('KET-001', 'Leche Natural', 'CAT-001', '6.50', 'Pil', 29, 'leche.jpg', 'Ketal'),
('KET-002', 'Biogurt Frutilla 1LT', 'CAT-001', '14.50', 'Pil', 42, 'yogurt.jpg', 'Ketal'),
('KET-003', 'Leche Chocolatada', 'CAT-001', '8.00', 'Pil', 38, 'lechechoco.jpg', 'Ketal'),
('KET-004', 'Leche Vaquita', 'CAT-001', '1.00', 'Pil', 169, 'chocolatada.jpg', 'Ketal'),
('KET-005', 'Dulce de Leche 500Gr', 'CAT-001', '16.00', 'Pil', 92, 'dulcedeleche.jpg', 'Ketal'),
('KET-006', 'Jaom Sandwichero X Kilo', 'CAT-002', '48.90', 'Sofia', 56, 'jamon.jpg', 'Ketal'),
('KET-007', 'Salchicha Sin Piel 500 Gr', 'CAT-002', '45.20', 'Stege', 41, 'salchicha.jpg', 'Ketal'),
('KET-008', 'Pate de Higado Pollo', 'CAT-002', '12.50', 'Sofia', 36, 'pate.jpg', 'Ketal'),
('KET-009', 'Chorizo Parrillero 500Gr', 'CAT-002', '29.90', 'Osfim', 47, 'chorizo.jpg', 'Ketal'),
('KET-010', 'Mortadela Cervecero 140 Gr', 'CAT-002', '20.50', 'Stege', 26, 'mortadela.jpg', 'Ketal'),
('KET-011', 'Ades Manzana 1L', 'CAT-003', '10.00', 'Ades', 84, 'ades.jpg', 'Ketal'),
('KET-012', 'Camel Activate 20Uni', 'CAT-003', '17.90', 'Camel', 125, 'camelA.jpg', 'Ketal'),
('KET-013', 'Agua 7L', 'CAT-003', '13.00', 'Villa Santa', 74, 'agua.jpg', 'Ketal'),
('KET-014', 'Cerveza 620Ml', 'CAT-003', '14.00', 'Paceña', 28, 'cerveza.jpg', 'Ketal'),
('KET-015', 'Coca Cola 3L', 'CAT-003', '12.90', 'Coca Cola', 99, 'coca3.jpg', 'Ketal'),
('FID-001', 'Ron Añejo 1L', 'CAT-003', '83.90', 'Ron Abuelo', 223, 'ron.jpg', 'Fidalga'),
('FID-002', 'Chocolate Vizzio', 'CAT-004', '23.50', 'Costa', 104, 'vizzio.jpg', 'Fidalga'),
('FID-003', 'Chocolate Sapito 30 Uni', 'CAT-004', '18.90', 'Sapito', 64, 'sapito.jpg', 'Fidalga'),
('FID-004', 'Doritos de Queso 200Gr', 'CAT-004', '19.90', 'Doritos', 76, 'dorito.jpg', 'Fidalga'),
('FID-005', 'Galletas Oreo Six Pack', 'CAT-004', '10.50', 'Oreo', 56, 'oreo.jpg', 'Fidalga'),
('FID-006', 'Chocolate M&M 150Gr', 'CAT-004', '27.80', 'M&M', 38, 'MYM.jpg', 'Fidalga'),
('FID-007', 'Alfajor 6Uni', 'CAT-005', '11.90', 'Shopon', 29, 'alfajor.jpg', 'Fidalga'),
('FID-008', 'Pan Sarna Bolsa 10Uni', 'CAT-005', '0.70', 'Shopon', 44, 'Pan.jpg', 'Fidalga'),
('FID-009', 'Cunape Abiscochado', 'CAT-005', '13.50', 'Monona', 77, 'cunape.jpg', 'Fidalga'),
('FID-010', 'Queque Chocolate 220 Gr', 'CAT-005', '9.90', 'La Suprema', 83, 'queque.jpg', 'Fidalga'),
('FID-011', 'Jabon Liquido 360Ml', 'CAT-006', '12.00', 'Liz', 365, 'jabonliquido.jpg', 'Fidalga'),
('FID-012', 'Papel Clasico 12Uni', 'CAT-006', '23.00', 'Nacional', 556, 'papel.jpg', 'Fidalga'),
('FID-013', 'Jabon Original', 'CAT-006', '8.90', 'Dove', 180, 'jabon.jpg', 'Fidalga'),
('FID-014', 'Crema Peinar Rizos Obedientes', 'CAT-006', '16.70', 'Sedal', 137, 'crema.jpg', 'Fidalga'),
('FID-015', 'Colgate MaxWhite', 'CAT-006', '19.60', 'Colgate', 18, 'colgate.jpg', 'Fidalga');

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
('2020-11-06 16:04:28', 'admin', 'Administrador', 'Registrar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `NumPedido` int(20) NOT NULL AUTO_INCREMENT,
  `Fecha` varchar(150) NOT NULL,
  `NIT` varchar(30) NOT NULL,
  `Descuento` int(20) NOT NULL,
  `TotalPagar` decimal(30,2) NOT NULL,
  `Estado` varchar(150) NOT NULL,
  `NombreAdmin` varchar(30) NOT NULL,
  PRIMARY KEY (`NumPedido`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`NumPedido`, `Fecha`, `NIT`, `Descuento`, `TotalPagar`, `Estado`, `NombreAdmin`) VALUES
(1, '20-10-2020', '6962296', 0, '6.50', 'Entregado', 'Ketal'),
(2, '26-10-2020', '6962296', 0, '40.00', 'Cancelado', 'Fidalga'),
(3, '06-11-2020', '6962296', 0, '6.50', 'Cancelado', 'Ketal'),
(4, '06-11-2020', '6962296', 0, '6.50', 'Cancelado', 'Ketal'),
(5, '06-11-2020', '6962296', 0, '6.50', 'Cancelado', 'Ketal'),
(6, '06-11-2020', '6962296', 0, '29.00', 'Cancelado', 'Ketal'),
(7, '06-11-2020', '6962296', 0, '21.00', 'Pendiente', 'Ketal');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
