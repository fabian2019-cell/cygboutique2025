-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 31-01-2025 a las 18:04:51
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `boutique`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_categoria`
--

CREATE TABLE `tb_categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_categoria`
--

INSERT INTO `tb_categoria` (`id_categoria`, `nombre`, `descripcion`) VALUES
(1, 'Vestidos/Graduacion', 'pantalones de mujer'),
(4, 'Jeans Levis', 'jeans solo marca levis'),
(5, 'Faldas Lona', 'variedad de faldas en lona'),
(6, 'Jeans Kalua', 'toda talla en Kalua'),
(7, 'Falda Short', 'Variedad de faldas en diversos colores'),
(8, 'Camisetas', 'Diversos estilos de camisetas sin botones'),
(9, 'Enterizo', 'enterizo /short'),
(10, 'carteras', 'carteras de diversas marcas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombres` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `dui` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(16) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_cliente`
--

INSERT INTO `tb_cliente` (`id_cliente`, `nombres`, `apellidos`, `dui`, `telefono`, `fecha_registro`) VALUES
(1, 'Esmeralda', 'Portillo', '00001234-6', '7858-5544', '2024-06-19'),
(6, 'Mirna', 'Cortez', '00000000-3', '7089-1246', '2024-06-29'),
(8, 'No', 'Especificado', '00000000-0', '0000-0000', '2024-07-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_compra`
--

CREATE TABLE `tb_compra` (
  `id_compra` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `proveedor` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `tel_proveedor` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `total_compra` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_empleado`
--

CREATE TABLE `tb_empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombres` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `dui` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(16) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `cargo_emp` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_empleado`
--

INSERT INTO `tb_empleado` (`id_empleado`, `nombres`, `apellidos`, `dui`, `direccion`, `telefono`, `estado`, `cargo_emp`) VALUES
(1, 'Esmeralda', 'Rivera', '00001234-5', 'cojutepeques', '7858-5555', 1, 'auxiliar'),
(4, 'Carlos', 'Fabian', '05520829-7', 'Cojutepeque 2', '7356-4482', 1, 'Supervisor'),
(6, 'Juana', 'Contreras', 'na', 'Cojutepeque9', '7777-4444', 0, 'vendedora'),
(7, 'Armando', 'Soliz', 'na', 'San Vicente', '6565-7777', 1, 'Ing de Ventas'),
(8, 'Carolina', 'Boutique', 'na', 'Barrio El Calvario, Cojutepeque.', '77430029', 1, 'Gerente de Sucursal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_producto`
--

CREATE TABLE `tb_producto` (
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `estilo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `marca` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `color` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `tallas` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `costo` double(10,2) NOT NULL,
  `cantidad_gan` double(10,2) NOT NULL COMMENT 'cantidad a ganar en dolares',
  `categoria_idcat` int(11) NOT NULL,
  `proveedor` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `stock_minimo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_producto`
--

INSERT INTO `tb_producto` (`id_producto`, `codigo`, `estilo`, `nombre`, `marca`, `color`, `tallas`, `descripcion`, `costo`, `cantidad_gan`, `categoria_idcat`, `proveedor`, `stock_minimo`) VALUES
(2, '000000-0-0-00-0008', '', 'Vestido', 'Prada', '', 'm', 'Vestido color negro', 70.00, 40.00, 1, '', 0),
(3, '000000-0-0-00-0007', '', 'Vestido de noche', 'tommy', '', 's', 'tommy nigth', 40.00, 25.00, 1, '', 0),
(5, '000000-0-0-00-0088', '', 'JEANs', 'kalua', '', '', 'sajdjasdjkas', 30.00, 30.00, 6, '', 0),
(44, '004-1212-0033010-01', '1212', 'jeans', 'levis', 'levis', 'XL', 'asja', 23.00, 10.00, 4, '', 0),
(45, '004-1212-0033010-02', '1212', 'jeans', 'levis', 'levis', 'XL', 'asja', 23.00, 10.00, 4, '', 0),
(46, '004-1212-0040010-01', '1212', 'jeans', 'levis', 'levis', 'M', 'jhjhj', 30.00, 10.00, 4, '', 0),
(47, '004-1212-0040010-02', '1212', 'jeans', 'levis', 'levis', 'M', 'jhjhj', 30.00, 10.00, 4, '', 0),
(48, '004-1212-0032010-01', '1212', 'jeans', 'levis', 'levis', 'L', 'fdsdsf', 22.00, 10.00, 4, '', 0),
(49, '004-1212-0032010-02', '1212', 'jeans', 'levis', 'levis', 'L', 'fdsdsf', 22.00, 10.00, 4, '', 0),
(53, '004-1212-0030010-01', '1212', 'jeans', 'levis', 'blanco', 'XXL', 'dsds', 23.00, 7.00, 4, '', 0),
(54, '004-1212-0030010-02', '1212', 'jeans', 'levis', 'blanco', 'XXL', 'dsds', 23.00, 7.00, 4, '', 0),
(55, '004-1212-0030010-03', '1212', 'jeans', 'levis', 'blanco', 'XXL', 'dsds', 23.00, 7.00, 4, '', 0),
(56, '004-1212-0024010-01', '1212', 'jeans', 'levis', 'rojo', 'S', 'jksahjsk', 12.00, 12.00, 4, '', 0),
(57, '004-1212-0024010-02', '1212', 'jeans', 'levis', 'rojo', 'S', 'jksahjsk', 12.00, 12.00, 4, '', 0),
(58, '004-1212-0025010-01', '1212', 'jeans', 'levis', 'Gris', 'XXXL', 'kaskds', 12.00, 13.00, 4, '', 0),
(59, '004-1212-0025010-02', '1212', 'jeans', 'levis', 'Gris', 'XXXL', 'kaskds', 12.00, 13.00, 4, '', 0),
(60, '004-1212-0043010-01', '1212', 'jeans', 'levis', 'mostaza', 'XXL', 'asds', 22.00, 21.00, 4, '', 0),
(61, '004-1212-0043010-02', '1212', 'jeans', 'levis', 'mostaza', 'XXL', 'asds', 22.00, 21.00, 4, '', 0),
(62, '004-1212-0022010-01', '1212', 'jeans', 'levis', 'rojo', 'XXL', 'jkhjkas', 12.00, 10.00, 4, '', 0),
(63, '004-1212-0022010-02', '1212', 'jeans', 'levis', 'rojo', 'XXL', 'jkhjkas', 12.00, 10.00, 4, '', 0),
(64, '004-1212-0022010-01', '1212', 'jeans', 'levis', 'rojo', 'XXL', 'jkhjkas', 12.00, 10.00, 4, '', 2),
(65, '004-1212-0022010-02', '1212', 'jeans', 'levis', 'rojo', 'XXL', 'jkhjkas', 12.00, 10.00, 4, '', 0),
(66, '004-1212-0022010-01', '1212', 'jeans', 'levis', 'rojo', 'XXL', 'jkhjkas', 12.00, 10.00, 4, '', 0),
(67, '004-1212-0022010-02', '1212', 'jeans', 'levis', 'rojo', 'XXL', 'jkhjkas', 12.00, 10.00, 4, '', 0),
(68, '04-1212-0035010-01', '1212', 'jeans', 'levis', 'celeste', 'L', 'jfhjfhjd', 15.00, 20.00, 4, '', 0),
(69, '04-1212-0035010-02', '1212', 'jeans', 'levis', 'celeste', 'L', 'jfhjfhjd', 15.00, 20.00, 4, '', 0),
(70, '04-1212-0035010-03', '1212', 'jeans', 'levis', 'celeste', 'L', 'jfhjfhjd', 15.00, 20.00, 4, '', 0),
(71, '04-1212-0035010-04', '1212', 'jeans', 'levis', 'celeste', 'L', 'jfhjfhjd', 15.00, 20.00, 4, '', 0),
(72, '04-1212-0035010-05', '1212', 'jeans', 'levis', 'celeste', 'L', 'jfhjfhjd', 15.00, 20.00, 4, '', 0),
(73, '04-1212-0022010-01', '1212', 'jeans', 'levis', 'Gris', 'L', 'jkkdj', 12.00, 10.00, 4, '', 0),
(74, '04-1212-0022010-01', '1212', 'jeans', 'levis', 'Gris', 'L', 'jkkdj', 12.00, 10.00, 4, '', 0),
(75, '04-1212-0022010-01', '1212', 'jeans', 'levis', 'Gris', 'L', 'jkkdj', 12.00, 10.00, 4, '', 0),
(76, '04-1212-0022010-02', '1212', 'jeans', 'levis', 'Gris', 'L', 'jkkdj', 12.00, 10.00, 4, '', 0),
(77, '04-1212-0022010-03', '1212', 'jeans', 'levis', 'Gris', 'L', 'jkkdj', 12.00, 10.00, 4, '', 0),
(78, '01-1212-0046010-01', '1212', 'jeans', 'levas', 'negro', 'M', 'prueba con agregado de prov', 31.00, 15.00, 1, 'AccesoriosDiversos SA de CV', 0),
(79, '01-1212-0046010-02', '1212', 'jeans', 'levas', 'negro', 'M', 'prueba con agregado de prov', 31.00, 15.00, 1, 'AccesoriosDiversos SA de CV', 0),
(80, '01-1212-0046010-03', '1212', 'jeans', 'levas', 'negro', 'M', 'prueba con agregado de prov', 31.00, 15.00, 1, 'AccesoriosDiversos SA de CV', 0),
(81, '04-1212-0033010-01', '1212', 'jeans', 'levis', 'negro', 'M', 'ghggh', 30.00, 3.00, 4, 'AccesoriosDiversos SA de CV', 0),
(82, '04-1212-0033010-02', '1212', 'jeans', 'levis', 'negro', 'M', 'ghggh', 30.00, 3.00, 4, 'AccesoriosDiversos SA de CV', 0),
(88, '05-1111-0014010-082', '1111', 'minifalda', 'Guess', 'negro', 'S', 'minifaldas de lona', 8.00, 6.00, 5, 'Confecciones Lainez ', 0),
(89, '05-1111-0014010-083', '1111', 'minifalda', 'Guess', 'negro', 'S', 'minifaldas de lona', 8.00, 6.00, 5, 'Confecciones Lainez ', 0),
(90, '05-1111-0014010-084', '1111', 'minifalda', 'Guess', 'negro', 'S', 'minifaldas de lona', 8.00, 6.00, 5, 'Confecciones Lainez ', 0),
(91, '08-1515-0016010-090', '1515', 'camiseta', 'Polo', 'gris', 'M', 'Estampados diversos', 9.00, 7.00, 8, 'Distribuidora Modern', 0),
(92, '08-1515-0016010-091', '1515', 'camiseta', 'Polo', 'gris', 'M', 'Estampados diversos', 9.00, 7.00, 8, 'Distribuidora Modern', 0),
(93, '08-1515-0016010-092', '1515', 'camiseta', 'Polo', 'gris', 'M', 'Estampados diversos', 9.00, 7.00, 8, 'Distribuidora Modern', 0),
(94, '08-1515-0016010-093', '1515', 'camiseta', 'Polo', 'gris', 'M', 'Estampados diversos', 9.00, 7.00, 8, 'Distribuidora Modern', 0),
(95, '08-1515-0016010-094', '1515', 'camiseta', 'Polo', 'gris', 'M', 'Estampados diversos', 9.00, 7.00, 8, 'Distribuidora Modern', 0),
(96, '08-1515-0016010-095', '1515', 'camiseta', 'Polo', 'gris', 'M', 'Estampados diversos', 9.00, 7.00, 8, 'Distribuidora Modern', 0),
(97, '08-1515-0016010-096', '1515', 'camiseta', 'Polo', 'gris', 'M', 'Estampados diversos', 9.00, 7.00, 8, 'Distribuidora Modern', 0),
(98, '08-1515-0016010-097', '1515', 'camiseta', 'Polo', 'gris', 'M', 'Estampados diversos', 9.00, 7.00, 8, 'Distribuidora Modern', 0),
(99, '08-1515-0016010-098', '1515', 'camiseta', 'Polo', 'gris', 'M', 'Estampados diversos', 9.00, 7.00, 8, 'Distribuidora Modern', 0),
(100, '08-1515-0016010-099', '1515', 'camiseta', 'Polo', 'gris', 'M', 'Estampados diversos', 9.00, 7.00, 8, 'Distribuidora Modern', 0),
(101, '08-1515-0016010-0100', '1515', 'camiseta', 'Polo', 'gris', 'M', 'Estampados diversos', 9.00, 7.00, 8, 'Distribuidora Modern', 0),
(102, '08-1515-0016010-0101', '1515', 'camiseta', 'Polo', 'gris', 'M', 'Estampados diversos', 9.00, 7.00, 8, 'Distribuidora Modern', 0),
(103, '09-bb-jst404-0045010-0102', 'bb-jst404', 'Vestido', 'bebe', 'cafe', 'L', 'desmangado, cuello chino', 20.00, 25.00, 9, 'Confecciones Lainez ', 0),
(104, '09-bb-jst404-0045010-0103', 'bb-jst404', 'Vestido', 'bebe', 'cafe', 'L', 'desmangado, cuello chino', 20.00, 25.00, 9, 'Confecciones Lainez ', 0),
(105, '09-bb-jst404-0025010-0104', 'bb-jst404', 'Vestido', 'bebe', 'beige', 'M', 'desmangado cuello chino', 20.00, 5.00, 9, 'Confecciones Lainez ', 2),
(106, '09-bb-jst404-0025010-0105', 'bb-jst404', 'Vestido', 'bebe', 'beige', 'M', 'desmangado cuello chino', 20.00, 5.00, 9, 'Confecciones Lainez ', 0),
(107, '09-bb-jst404-004610-0106', 'bb-jst404', 'Vestido', 'supreme', 'verde', 'L', 'enterizo desmangado', 18.00, 7.00, 9, 'Confecciones Lopez', 0),
(110, '05-1515-001910-0108', '1515', 'cartera', 'MK', 'azul', 'XL', 'faldas strech', 12.00, 7.00, 5, 'Confecciones Lopez', 0),
(111, '05-1515-001910-0109', '1515', 'cartera', 'MK', 'azul', 'XL', 'faldas strech', 12.00, 7.00, 5, 'Confecciones Lopez', 0),
(112, '05-1212-001210-0111', '1212', 'falda', 'lacost', 'negro', 'S', 'faldas lona rigida', 8.00, 4.00, 5, 'Confecciones Lopez', 1),
(113, '05-1212-001210-0112', '1212', 'falda', 'lacost', 'negro', 'S', 'faldas lona rigida', 8.00, 4.00, 5, 'Confecciones Lainez ', 0),
(114, '09-bb-jst404-002210-0113', 'bb-jst404', 'enterizo', 'bebe', 'gris', 'M', 'enterizo desmangado', 12.00, 10.00, 9, 'Confecciones Lopez', 0),
(115, '09-bb-jst404-002210-0114', 'bb-jst404', 'enterizo', 'bebe', 'gris', 'M', 'enterizo desmangado', 12.00, 10.00, 9, 'Confecciones Lopez', 1),
(116, '09-bb-jst404-002210-0115', 'bb-jst404', 'enterizo', 'bebe', 'gris', 'M', 'enterizo desmangado', 12.00, 10.00, 9, 'Confecciones Lopez', 0),
(117, '09-bb-jst404-002810-0116', 'bb-jst404', 'enterizo', 'bebe', 'negro', 'XXL', 'enterizo desmangado', 18.00, 10.00, 9, 'Confecciones Lainez ', 0),
(118, '09-bb-jst404-002810-0117', 'bb-jst404', 'enterizo', 'bebe', 'negro', 'XXL', 'enterizo desmangado', 18.00, 10.00, 9, 'Confecciones Lainez ', 0),
(119, '09-bb-jst404-002810-0118', 'bb-jst404', 'enterizo', 'bebe', 'negro', 'L', 'enterizo desmangado', 18.00, 10.00, 9, 'Confecciones Lopez', 1),
(120, '09-bb-jst404-002810-0119', 'bb-jst404', 'enterizo', 'bebe', 'negro', 'L', 'enterizo desmangado', 18.00, 10.00, 9, 'Confecciones Lopez', 0),
(121, '09-bb-jst404-002810-0120', 'bb-jst404', 'enterizo', 'bebe', 'negro', 'L', 'enterizo desmangado', 18.00, 10.00, 9, 'Confecciones Lopez', 1),
(122, '09-bb-jst404-003010-0121', 'bb-jst404', 'enterizo', 'bebe', 'blanco', 'S', 'enterizo desmangado', 18.00, 12.00, 9, 'Confecciones Lopez', 1),
(123, '09-bb-jst404-003010-0122', 'bb-jst404', 'enterizo', 'bebe', 'blanco', 'S', 'enterizo desmangado', 18.00, 12.00, 9, 'Confecciones Lopez', 0),
(124, '09-bb-jst404-003010-0123', 'bb-jst404', 'enterizo', 'bebe', 'blanco', 'S', 'enterizo desmangado', 18.00, 12.00, 9, 'Confecciones Lopez', 1),
(125, '09-bb-jst404-003010-0124', 'bb-jst404', 'enterizo', 'bebe', 'blanco', 'S', 'enterizo desmangado', 18.00, 12.00, 9, 'Confecciones Lopez', 1),
(126, '09-bb-jst404-003010-0125', 'bb-jst404', 'enterizo', 'bebe', 'azul', 'M', 'enterizo desmangado', 18.00, 12.00, 9, 'Confecciones Lopez', 1),
(127, '09-bb-jst404-003010-0126', 'bb-jst404', 'enterizo', 'bebe', 'azul', 'M', 'enterizo desmangado', 18.00, 12.00, 9, 'Confecciones Lopez', 1),
(128, '09-bb-jst404-003010-0127', 'bb-jst404', 'enterizo', 'bebe', 'rosado', 'M', 'enterizo desmangado', 18.00, 12.00, 9, 'Confecciones Lopez', 1),
(129, '09-bb-jst404-003010-0128', 'bb-jst404', 'enterizo', 'bebe', 'morado', 'XL', 'enterizo desmangado', 18.00, 12.00, 9, 'Confecciones Lopez', 1),
(130, '09-bb-jst404-003010-0129', 'bb-jst404', 'enterizo', 'bebe', 'morado', 'XL', 'enterizo desmangado', 18.00, 12.00, 9, 'Confecciones Lopez', 0),
(131, '09-bb-jst404-003010-0130', 'bb-jst404', 'enterizo', 'bebe', 'negro', 'L', 'enterizo desmangado', 18.00, 12.00, 9, 'Confecciones Lopez', 0),
(132, '06-jst404-003210-0131', 'jst404', 'jeans', 'Kalua', 'negro', 'L', 'jeans rotos', 20.00, 12.00, 6, 'Distribuidora Modern', 1),
(133, '06-jst404-003210-0132', 'jst404', 'jeans', 'Kalua', 'negro', 'L', 'jeans rotos', 20.00, 12.00, 6, 'Distribuidora Modern', 0),
(134, '06-jst404-005310-0133', 'jst404', 'jeans', 'Kalua', 'celeste', 'S', 'jeans roto', 20.00, 33.00, 6, 'Distribuidora Modern', 1),
(135, '06-jst404-005310-0134', 'jst404', 'jeans', 'Kalua', 'celeste', 'S', 'jeans roto', 20.00, 33.00, 6, 'Distribuidora Modern', 0),
(136, '06-jst404-005310-0135', 'jst404', 'jeans', 'Kalua', 'celeste', 'S', 'jeans liso', 20.00, 33.00, 6, 'Distribuidora Modern', 0),
(137, '06-jst404-005310-0136', 'jst404', 'jeans', 'Kalua', 'celeste', 'S', 'jeans liso', 20.00, 33.00, 6, 'Distribuidora Modern', 0),
(138, '06-jst404-005310-0137', 'jst404', 'jeans', 'Kalua', 'celeste', 'S', 'jeans liso', 20.00, 33.00, 6, 'Distribuidora Modern', 1),
(139, '06-jst404-003310-0138', 'jst404', 'jeans', 'Kalua', 'blanco', 'S', 'jeans liso', 20.00, 13.00, 6, 'Distribuidora Modern', 0),
(140, '06-jst404-003310-0139', 'jst404', 'jeans', 'Kalua', 'blanco', 'S', 'jeans liso', 20.00, 13.00, 6, 'Distribuidora Modern', 0),
(141, '010-jst404-003010-0140', 'jst404', 'cartera', 'cg', 'rojo', 'S', 'carteras peque;as', 20.00, 10.00, 10, 'AccesoriosDiversos SA de CV', 1),
(142, '010-jst404-003010-0141', 'jst404', 'cartera', 'cg', 'rojo', 'S', 'carteras peque;as', 20.00, 10.00, 10, 'AccesoriosDiversos SA de CV', 1),
(143, '010-jst404-003010-0142', 'jst404', 'cartera', 'cg', 'blanco', 'S', 'carteras peque;as', 20.00, 10.00, 10, 'AccesoriosDiversos SA de CV', 1),
(144, '010-jst404-003010-0143', 'jst404', 'cartera', 'cg', 'blanco', 'S', 'carteras peque;as', 20.00, 10.00, 10, 'AccesoriosDiversos SA de CV', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_producto_compra`
--

CREATE TABLE `tb_producto_compra` (
  `id` int(11) NOT NULL,
  `producto_idproducto` int(11) NOT NULL,
  `compra_idcompra` int(11) NOT NULL,
  `precio_producto` double(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_proveedor`
--

CREATE TABLE `tb_proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_comp` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `empresa` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_proveedor`
--

INSERT INTO `tb_proveedor` (`id_proveedor`, `nombre_comp`, `empresa`, `telefono`) VALUES
(1, 'Susana Garcia', 'AccesoriosDiversos SA de CV', '2323-3322'),
(3, 'Somi  Alfaro', 'Distribuidora Modern', '7858-0022'),
(4, 'Carlos Suria', 'Confecciones Lainez ', '2323-2323'),
(5, 'Azucena Lopez', 'Confecciones Lopez', '7777-4482');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `rol` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasena` varchar(256) COLLATE utf8_spanish2_ci NOT NULL,
  `dui` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `empleado` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `rol`, `usuario`, `contrasena`, `dui`, `empleado`, `estado`) VALUES
('20215615565800000058', 'vendedor', 'tony2023', '$2y$10$DWem0vXZfIOJLHzMJgTiOOxx33xpOqJ.cTd2X226epnvbHFCnFgoS', '00001234-5', 1, 1),
('20243629364300000043-2', 'administrador', 'tony2024', '$2y$10$L6q8Cykbti24naLDE5fP2./1XSmfPIf4fwq1glDBQcSUmglpsyGjy', '05520829-7', 4, 1),
('20244823480000000000-3', 'administrador', 'esme2025', '$2y$10$6u3gf6d/PU0emxGyrZJWTeLMjLop4HdAb1Dxzc04Qhvs5iCqICWL2', '00000005-5', 1, 1),
('20250131011700000017-4', 'administrador', 'CYGBoutique', '$2y$10$KQnbJe7JKy/xn.siM/gCF.tISlN5KIRejkd0i76hplNaTaXGgZLUe', '98765432-1', 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_venta`
--

CREATE TABLE `tb_venta` (
  `id_venta` int(11) NOT NULL,
  `fecha_venta` datetime NOT NULL,
  `cliente` int(11) NOT NULL,
  `empleado` int(11) NOT NULL,
  `total_venta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_venta`
--

INSERT INTO `tb_venta` (`id_venta`, `fecha_venta`, `cliente`, `empleado`, `total_venta`) VALUES
(2, '2024-08-03 13:09:23', 6, 1, '0.00'),
(3, '2024-08-03 03:32:53', 1, 6, '0.00'),
(4, '2024-08-03 03:45:36', 1, 4, '0.00'),
(5, '2024-08-03 03:50:22', 1, 4, '0.00'),
(6, '2024-08-03 03:52:42', 6, 6, '0.00'),
(7, '2024-08-03 03:53:39', 1, 4, '0.00'),
(8, '2024-08-03 03:58:04', 1, 6, '0.00'),
(9, '2024-08-03 08:11:30', 1, 4, '0.00'),
(10, '2024-08-03 08:14:04', 6, 6, '0.00'),
(11, '2024-08-03 08:28:00', 8, 7, '0.00'),
(12, '2024-08-03 08:59:38', 8, 6, '0.00'),
(13, '2024-08-03 09:00:54', 8, 7, '0.00'),
(14, '2024-08-03 09:08:48', 8, 4, '0.00'),
(15, '2024-08-03 09:20:36', 8, 7, '0.00'),
(16, '2024-08-03 09:24:00', 8, 4, '68.00'),
(17, '2024-08-04 09:30:36', 8, 4, '66.00'),
(18, '2024-08-04 10:50:05', 8, 1, '60.00'),
(19, '2024-08-04 08:10:16', 8, 7, '30.00'),
(20, '2024-08-05 10:45:47', 6, 7, '16.00'),
(22, '2024-08-05 10:57:08', 1, 7, '16.00'),
(23, '2024-08-05 11:13:26', 8, 4, '48.00'),
(24, '2024-08-05 11:15:30', 8, 7, '32.00'),
(25, '2024-08-05 11:19:14', 8, 4, '51.00'),
(26, '2024-08-05 11:42:11', 6, 6, '33.00'),
(27, '2024-08-05 11:44:59', 8, 4, '32.00'),
(28, '2024-08-05 11:52:22', 1, 4, '0.00'),
(29, '2024-08-05 11:53:41', 1, 4, '0.00'),
(30, '2024-08-05 11:55:00', 1, 4, '0.00'),
(31, '2024-08-05 11:57:19', 1, 4, '0.00'),
(32, '2024-08-05 11:59:56', 1, 4, '105.00'),
(33, '2024-08-06 10:01:45', 8, 1, '85.00'),
(34, '2024-08-06 10:06:09', 8, 7, '55.00'),
(35, '2024-08-06 10:10:58', 6, 4, '20.00'),
(36, '2024-08-06 10:24:27', 8, 1, '62.00'),
(37, '2024-08-06 10:28:05', 8, 1, '82.00'),
(38, '2024-08-06 10:45:54', 8, 1, '65.00'),
(39, '2024-08-22 04:19:33', 8, 7, '70.00'),
(40, '2024-08-30 02:09:29', 8, 6, '65.00'),
(41, '2024-08-31 09:47:06', 8, 6, '113.00'),
(42, '2024-09-01 09:08:33', 6, 6, '158.00'),
(43, '2024-09-03 08:13:59', 8, 4, '49.00'),
(44, '2024-09-03 08:14:53', 1, 7, '60.00'),
(45, '2024-09-03 09:06:37', 8, 1, '78.00'),
(46, '2024-09-05 11:18:08', 8, 1, '142.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_venta_producto`
--

CREATE TABLE `tb_venta_producto` (
  `id` int(11) NOT NULL,
  `idencabezado_v` int(11) NOT NULL,
  `producto_idproducto` int(11) NOT NULL,
  `precio_venta` double(10,2) NOT NULL COMMENT 'costo mas ganacia',
  `cantidad_des` double(10,2) NOT NULL COMMENT 'cantidad descontada',
  `cantidad` int(11) NOT NULL,
  `sub_total` double(10,2) NOT NULL COMMENT 'cantidad por precio_venta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_venta_producto`
--

INSERT INTO `tb_venta_producto` (`id`, `idencabezado_v`, `producto_idproducto`, `precio_venta`, `cantidad_des`, `cantidad`, `sub_total`) VALUES
(2, 13, 47, 30.00, 0.00, 1, 30.00),
(3, 13, 48, 22.00, 0.00, 1, 22.00),
(4, 14, 81, 33.00, 0.00, 1, 33.00),
(5, 14, 82, 33.00, 0.00, 1, 33.00),
(6, 15, 79, 46.00, 0.00, 1, 46.00),
(7, 15, 80, 46.00, 0.00, 1, 46.00),
(8, 16, 77, 22.00, 0.00, 1, 22.00),
(9, 16, 78, 46.00, 0.00, 1, 46.00),
(10, 17, 73, 22.00, 0.00, 1, 22.00),
(11, 17, 74, 22.00, 0.00, 1, 22.00),
(12, 17, 75, 22.00, 0.00, 1, 22.00),
(13, 18, 88, 14.00, 0.00, 1, 14.00),
(14, 18, 89, 14.00, 0.00, 1, 14.00),
(15, 18, 101, 16.00, 0.00, 1, 16.00),
(16, 18, 102, 16.00, 0.00, 1, 16.00),
(17, 19, 90, 14.00, 0.00, 1, 14.00),
(18, 19, 100, 16.00, 0.00, 1, 16.00),
(19, 20, 99, 16.00, 0.00, 1, 16.00),
(20, 22, 98, 16.00, 5.00, 1, 11.00),
(21, 23, 92, 16.00, 1.00, 1, 15.00),
(22, 23, 95, 16.00, 1.00, 1, 15.00),
(23, 23, 96, 16.00, 1.00, 1, 15.00),
(24, 24, 91, 16.00, 1.00, 1, 15.00),
(25, 24, 94, 16.00, 1.00, 1, 15.00),
(26, 25, 72, 35.00, 2.06, 1, 32.94),
(27, 25, 93, 16.00, 0.94, 1, 15.06),
(28, 26, 76, 22.00, 2.89, 1, 19.11),
(29, 26, 97, 16.00, 2.11, 1, 13.89),
(30, 27, 71, 35.00, 3.00, 1, 32.00),
(31, 28, 68, 35.00, 0.00, 1, 35.00),
(32, 28, 69, 35.00, 0.00, 1, 35.00),
(33, 28, 70, 35.00, 0.00, 1, 35.00),
(34, 29, 68, 35.00, 0.00, 1, 35.00),
(35, 29, 69, 35.00, 0.00, 1, 35.00),
(36, 29, 70, 35.00, 0.00, 1, 35.00),
(37, 30, 68, 35.00, 0.00, 1, 35.00),
(38, 30, 69, 35.00, 0.00, 1, 35.00),
(39, 30, 70, 35.00, 0.00, 1, 35.00),
(40, 31, 68, 35.00, 0.00, 1, 35.00),
(41, 31, 69, 35.00, 0.00, 1, 35.00),
(42, 31, 70, 35.00, 0.00, 1, 35.00),
(43, 32, 68, 35.00, 0.00, 1, 35.00),
(44, 32, 69, 35.00, 0.00, 1, 35.00),
(45, 32, 70, 35.00, 0.00, 1, 35.00),
(46, 33, 49, 32.00, 0.74, 1, 31.26),
(47, 33, 54, 30.00, 0.69, 1, 29.31),
(48, 33, 58, 25.00, 0.57, 1, 24.43),
(49, 34, 55, 30.00, 0.00, 1, 30.00),
(50, 34, 59, 25.00, 0.00, 1, 25.00),
(51, 35, 66, 22.00, 2.00, 1, 20.00),
(52, 36, 46, 40.00, 0.00, 1, 40.00),
(53, 36, 63, 22.00, 0.00, 1, 22.00),
(54, 37, 61, 43.00, 2.47, 1, 40.53),
(55, 37, 62, 22.00, 1.26, 1, 20.74),
(56, 37, 65, 22.00, 1.26, 1, 20.74),
(57, 38, 104, 45.00, 3.21, 1, 41.79),
(58, 38, 106, 25.00, 1.79, 1, 23.21),
(59, 39, 103, 45.00, 0.00, 1, 45.00),
(60, 39, 107, 25.00, 0.00, 1, 25.00),
(61, 40, 60, 43.00, 0.00, 1, 43.00),
(62, 40, 67, 22.00, 0.00, 1, 22.00),
(63, 41, 53, 30.00, 0.78, 1, 29.22),
(64, 41, 137, 53.00, 1.37, 1, 51.63),
(65, 41, 140, 33.00, 0.85, 1, 32.15),
(66, 42, 111, 19.00, 0.00, 1, 19.00),
(67, 42, 135, 53.00, 0.00, 1, 53.00),
(68, 42, 136, 53.00, 0.00, 1, 53.00),
(69, 42, 139, 33.00, 0.00, 1, 33.00),
(70, 43, 110, 19.00, 0.00, 1, 19.00),
(71, 43, 131, 30.00, 0.00, 1, 30.00),
(72, 44, 113, 12.00, 0.75, 1, 11.25),
(73, 44, 114, 22.00, 1.38, 1, 20.62),
(74, 44, 123, 30.00, 1.88, 1, 28.12),
(75, 45, 116, 22.00, 1.07, 1, 20.93),
(76, 45, 117, 28.00, 1.37, 1, 26.63),
(77, 45, 133, 32.00, 1.56, 1, 30.44),
(78, 46, 5, 60.00, 1.64, 1, 58.36),
(79, 46, 118, 28.00, 0.77, 1, 27.23),
(80, 46, 120, 28.00, 0.77, 1, 27.23),
(81, 46, 130, 30.00, 0.82, 1, 29.18);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `tb_compra`
--
ALTER TABLE `tb_compra`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indices de la tabla `tb_empleado`
--
ALTER TABLE `tb_empleado`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `tb_producto`
--
ALTER TABLE `tb_producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_categoria_id` (`categoria_idcat`);

--
-- Indices de la tabla `tb_producto_compra`
--
ALTER TABLE `tb_producto_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_id` (`producto_idproducto`),
  ADD KEY `fk_compra_id` (`compra_idcompra`);

--
-- Indices de la tabla `tb_proveedor`
--
ALTER TABLE `tb_proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_empleado` (`empleado`);

--
-- Indices de la tabla `tb_venta`
--
ALTER TABLE `tb_venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_cliente` (`cliente`),
  ADD KEY `fk_empleado` (`empleado`);

--
-- Indices de la tabla `tb_venta_producto`
--
ALTER TABLE `tb_venta_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productoventa_id` (`producto_idproducto`),
  ADD KEY `fk_encabezado_venta` (`idencabezado_v`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tb_compra`
--
ALTER TABLE `tb_compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tb_empleado`
--
ALTER TABLE `tb_empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tb_producto`
--
ALTER TABLE `tb_producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT de la tabla `tb_producto_compra`
--
ALTER TABLE `tb_producto_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tb_proveedor`
--
ALTER TABLE `tb_proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tb_venta`
--
ALTER TABLE `tb_venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `tb_venta_producto`
--
ALTER TABLE `tb_venta_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_producto`
--
ALTER TABLE `tb_producto`
  ADD CONSTRAINT `fk_categoria_id` FOREIGN KEY (`categoria_idcat`) REFERENCES `tb_categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tb_producto_compra`
--
ALTER TABLE `tb_producto_compra`
  ADD CONSTRAINT `fk_compra_id` FOREIGN KEY (`compra_idcompra`) REFERENCES `tb_compra` (`id_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_id` FOREIGN KEY (`producto_idproducto`) REFERENCES `tb_producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD CONSTRAINT `fk_usuario_empleado` FOREIGN KEY (`empleado`) REFERENCES `tb_empleado` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tb_venta`
--
ALTER TABLE `tb_venta`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`cliente`) REFERENCES `tb_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_empleado` FOREIGN KEY (`empleado`) REFERENCES `tb_empleado` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tb_venta_producto`
--
ALTER TABLE `tb_venta_producto`
  ADD CONSTRAINT `fk_encabezado_venta` FOREIGN KEY (`idencabezado_v`) REFERENCES `tb_venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productoventa_id` FOREIGN KEY (`producto_idproducto`) REFERENCES `tb_producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
