-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-10-2020 a las 02:28:32
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoiii`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `NIT` varchar(50) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `ApellidoPaterno` varchar(100) NOT NULL,
  `ApellidoMaterno` varchar(100) NOT NULL,
  `Celular` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `FRegistro` datetime NOT NULL,
  PRIMARY KEY (`NIT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`NIT`, `Nombre`, `ApellidoPaterno`, `ApellidoMaterno`, `Celular`, `Password`, `FRegistro`) VALUES
('14489245', 'Sergio Ariel', 'Candia', 'Barriga', '70167309', 'hellodah', '2019-06-12 15:27:27'),
('6962296', 'Alejandro', 'Aranibar', 'Abularach', '67141109', 'mayonesa12', '2020-10-13 01:31:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `ci` varchar(10) DEFAULT NULL,
  `Pass` varchar(50) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `Sistema_Principal` varchar(10) DEFAULT NULL,
  `Sistema_Secundario` varchar(10) DEFAULT NULL,
  KEY `ci` (`ci`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`ci`, `Pass`, `fecha`, `Sistema_Principal`, `Sistema_Secundario`) VALUES
('14489245', 'hola', '2019-05-28 05:46:29', 'UPW001', 'UPW001'),
('2443472', '3125', '2019-05-11 16:21:19', 'UPW004', 'UPW006'),
('12345678', '7034', '2019-05-15 18:37:22', 'UPW001', 'UPW001'),
('5084', '7737', '2019-05-15 18:38:50', 'UPW003', 'UPW006'),
('8080', '3833', '2019-05-15 18:39:52', 'UPW003', 'UPW006'),
('5050', 'hola2', '2019-05-15 18:56:16', 'UPW004', 'UPW003'),
('6060', '8437', '2019-05-24 18:38:01', 'UPW006', 'UPW004');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `CodCarrito` varchar(50) NOT NULL,
  `fechaPedido` datetime DEFAULT NULL,
  `CodCliente` varchar(50) DEFAULT NULL,
  `NombresProductos` varchar(800) DEFAULT NULL,
  `CantidadProductos` varchar(200) DEFAULT NULL,
  `Pago` int(11) DEFAULT NULL,
  `EstadoPedido` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CodCarrito`),
  KEY `CodCliente` (`CodCliente`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`CodCarrito`, `fechaPedido`, `CodCliente`, `NombresProductos`, `CantidadProductos`, `Pago`, `EstadoPedido`) VALUES
('CP1861275', '2020-10-15 15:35:38', '14489245', '|leche|CocaCola', '|3|3', 45, 'Espera'),
('CP4283282', '2020-10-13 02:07:36', '6962296', '-leche', '-1', 5, 'Espera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE IF NOT EXISTS `personas` (
  `CI` varchar(10) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Ap_paterno` varchar(30) NOT NULL,
  `Ap_materno` varchar(30) NOT NULL,
  `Direccion` varchar(150) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Celular` varchar(15) NOT NULL,
  `whatsaap` tinyint(1) NOT NULL,
  `Fecha_Nacimiento` varchar(12) NOT NULL,
  `Genero` varchar(1) NOT NULL,
  `T_Sangre` varchar(5) NOT NULL,
  `Nacionalidad` varchar(40) NOT NULL,
  `Correo` varchar(150) NOT NULL,
  `Foto` varchar(350) NOT NULL,
  PRIMARY KEY (`CI`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`CI`, `Nombre`, `Ap_paterno`, `Ap_materno`, `Direccion`, `Telefono`, `Celular`, `whatsaap`, `Fecha_Nacimiento`, `Genero`, `T_Sangre`, `Nacionalidad`, `Correo`, `Foto`) VALUES
('2443472', 'sonia', 'Barriga', 'arancibia', 'La Paz, Avenida Bush', '2221550', '71921639', 0, '1952-09-10', '1', 'orh', 'Bolivia', 'cheito2673@gmail.com', 'https://img.icons8.com/color/1600/circled-user-male-skin-type-1-2.png'),
('12345678', 'Juan', 'Martinez', 'Quiroz', 'asd', '123456789', '12345678', 0, '2019-05-02', '0', 'orh', 'La Paz', 'pepe12', 'asdasd'),
('5084', 'Juan', 'Quiroga', 'Quiroz', 'Pando', '777664', '9898983', 0, '2019-05-02', '0', 'orh-', 'ecuador', '1@gmail.com', ''),
('8080', 'Pepe', 'Mollo', 'Martines', 'beni', '555333', '65656565', 0, '2019-05-02', '0', 'a+', 'Bolivia', '', 'https://image.flaticon.com/icons/png/512/23/23716.png'),
('5050', 'Hector', 'PeÃ±a', 'Loza', 'Miraflores', '987654', '999987', 1, '2019-05-17', '0', 'a+', 'peru', '', ''),
('6060', 'Juan', 'Perez', 'Lopez', 'la paz', '22222', '65778014', 0, '2019-01-02', '0', 'a+', 'chile', 'h@gmail.com', ''),
('14489245', 'Sergio Ariel', 'Candia', 'Barriga', 'San Borja', '2221550', '70167309', 0, '1999-08-26', '0', 'orh+', 'Bolivia', 'cheito2673@gmail.com', 'https://img.icons8.com/color/1600/circled-user-male-skin-type-1-2.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `CodProducto` varchar(15) NOT NULL,
  `Nombre` varchar(35) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Precio` int(11) DEFAULT NULL,
  PRIMARY KEY (`CodProducto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`CodProducto`, `Nombre`, `Cantidad`, `Precio`) VALUES
('001', 'leche', 81, 5),
('003', 'Yogurt', 288, 15),
('002', 'Galletas', 300, 8),
('004', 'Queso', 100, 5),
('005', 'CocaCola', 497, 10),
('006', 'Fanta', 150, 10),
('007', 'Azucar', 1000, 8),
('008', 'Pan', 350, 1),
('009', 'Colgate', 130, 14),
('010', 'Fernet', 500, 69),
('011', 'Fourloko', 1000, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_personas`
--

DROP TABLE IF EXISTS `tipo_personas`;
CREATE TABLE IF NOT EXISTS `tipo_personas` (
  `Codigo_Tipo_Persona` varchar(10) NOT NULL,
  `Nombre_TPersona` varchar(30) NOT NULL,
  `Permisos` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_personas`
--

INSERT INTO `tipo_personas` (`Codigo_Tipo_Persona`, `Nombre_TPersona`, `Permisos`) VALUES
('UPW001', 'SuperUsuario', '111111\0\0\0\0'),
('UPW002', 'Administrador', '110011'),
('UPW003', 'Nivel3', '100011\0\0\0\0'),
('UPW004', 'Nivel4', '000111'),
('UPW005', 'Nivel3v', '0000001'),
('UPW006', 'Ninguno', '0000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `CodVenta` varchar(25) DEFAULT NULL,
  `CodFactura` varchar(25) DEFAULT NULL,
  `CodCarrito` varchar(50) DEFAULT NULL,
  `CodCliente` varchar(50) DEFAULT NULL,
  `fechaCompra` datetime DEFAULT NULL,
  `pago` int(11) DEFAULT NULL,
  `Productos` varchar(800) DEFAULT NULL,
  `cantidadProductos` varchar(200) DEFAULT NULL,
  KEY `CodCarrito` (`CodCarrito`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`CodVenta`, `CodFactura`, `CodCarrito`, `CodCliente`, `fechaCompra`, `pago`, `Productos`, `cantidadProductos`) VALUES
('CV7265665', 'CF3673355', 'CP1861275', '14489245', '2019-06-12 15:37:52', 40, '-leche-Yogurt', '-2-2'),
('CV2190301', 'CF523066', 'CP4283282', '6962296', '2020-10-13 02:05:45', 5, '-leche', '-1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
