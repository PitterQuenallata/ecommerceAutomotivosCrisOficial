-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2024 a las 12:30:01
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
-- Base de datos: `repuestoscris`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos`
--

CREATE TABLE `carritos` (
  `id_carrito` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `fecha_agregado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `img_categoria` text NOT NULL,
  `date_created_categoria` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_categoria` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `img_categoria`, `date_created_categoria`, `date_updated_categoria`) VALUES
(1, 'filtros', '', '2024-06-09 15:36:55', '2024-06-09 15:36:55'),
(2, 'frenos', '', '2024-06-09 15:36:55', '2024-06-09 15:36:55'),
(3, 'motor', '', '2024-06-09 15:36:55', '2024-06-09 15:36:55'),
(4, 'suspension', '', '2024-06-09 15:36:55', '2024-06-09 15:36:55'),
(5, 'amortiguadores', '', '2024-06-09 15:36:55', '2024-06-09 15:36:55'),
(6, 'bujias', '', '2024-06-09 15:36:55', '2024-06-09 15:36:55'),
(7, 'carreras, cadenas, rodillos', '', '2024-06-09 15:36:55', '2024-06-09 15:36:55'),
(8, 'embrague', '', '2024-06-09 15:36:55', '2024-06-09 15:36:55'),
(9, 'rodamientos', '', '2024-06-09 15:36:55', '2024-06-09 15:36:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `user_cliente` varchar(255) NOT NULL,
  `password_cliente` varchar(255) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `apellido_cliente` varchar(255) DEFAULT NULL,
  `nit_ci_cliente` varchar(255) DEFAULT NULL,
  `telefono_cliente` varchar(255) DEFAULT NULL,
  `compra_cliente` int(11) DEFAULT NULL,
  `direccion_cliente` varchar(255) DEFAULT NULL,
  `email_cliente` varchar(255) DEFAULT NULL,
  `estado_cliente` tinyint(1) NOT NULL DEFAULT 1,
  `date_created_cliente` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_cliente` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `user_cliente`, `password_cliente`, `nombre_cliente`, `apellido_cliente`, `nit_ci_cliente`, `telefono_cliente`, `compra_cliente`, `direccion_cliente`, `email_cliente`, `estado_cliente`, `date_created_cliente`, `date_updated_cliente`) VALUES
(1, 'benjo1234', '$2a$07$azybxcags23425sdg23sdem1CFT2u/A.0JOm/IXWxebxaQOkjS85C', 'John', 'Doe', '12345678', '555123456', 0, '123 Main St', 'jdoe@example.com', 1, '2024-08-12 09:06:42', '2024-08-12 10:23:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `codigo_compra` text NOT NULL,
  `fecha_compra` date NOT NULL,
  `monto_total_compra` decimal(10,2) NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `date_created_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_compra` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_compras`
--

CREATE TABLE `detalles_compras` (
  `id_detalle_compra` int(11) NOT NULL,
  `id_compra` int(11) DEFAULT NULL,
  `id_repuesto` int(11) DEFAULT NULL,
  `cantidad_detalleCompra` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `date_created_detalle_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_detalle_compra` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_ventas`
--

CREATE TABLE `detalles_ventas` (
  `id_detalleVenta` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_repuesto` int(11) NOT NULL,
  `cantidad_detalleVenta` int(11) NOT NULL,
  `precio_unitario_detalleVenta` decimal(10,2) NOT NULL,
  `date_updated_detalleVenta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_created_detalleVenta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(255) NOT NULL,
  `estado_marca` tinyint(4) DEFAULT 1,
  `date_created_marca` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_marca` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre_marca`, `estado_marca`, `date_created_marca`, `date_updated_marca`) VALUES
(1, 'toyota', 1, '2024-06-09 15:31:22', '2024-06-09 15:31:22'),
(2, 'nissan', 1, '2024-06-09 15:31:22', '2024-06-09 15:31:22'),
(3, 'suzuki', 1, '2024-06-09 15:31:22', '2024-06-09 15:31:22'),
(4, 'ford', 1, '2024-06-09 15:31:22', '2024-06-09 15:31:22'),
(5, 'renault', 1, '2024-06-09 15:31:22', '2024-06-09 15:31:22'),
(6, 'chevrolet', 1, '2024-06-09 15:31:22', '2024-06-09 15:31:22'),
(7, 'hyundai', 1, '2024-06-09 15:31:22', '2024-06-09 15:31:22'),
(8, 'kia', 1, '2024-06-09 15:31:22', '2024-06-09 15:31:22'),
(9, 'chery', 1, '2024-06-09 15:31:22', '2024-06-09 15:31:22'),
(10, 'mazda', 1, '2024-06-09 15:31:22', '2024-06-09 15:31:22'),
(11, 'mitsubishi', 1, '2024-06-09 15:31:22', '2024-06-09 15:31:22'),
(12, 'honda', 1, '2024-06-09 15:31:22', '2024-06-09 15:31:22'),
(14, 'foton', 1, '2024-06-09 15:36:28', '2024-06-09 15:36:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `id_modelo` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `nombre_modelo` varchar(255) NOT NULL,
  `version_modelo` varchar(255) DEFAULT NULL,
  `anio_inicio_modelo` year(4) DEFAULT NULL,
  `anio_fin_modelo` year(4) DEFAULT NULL,
  `estado_modelo` tinyint(4) DEFAULT 1,
  `date_created_modelo` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_modelo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id_modelo`, `id_marca`, `nombre_modelo`, `version_modelo`, `anio_inicio_modelo`, `anio_fin_modelo`, `estado_modelo`, `date_created_modelo`, `date_updated_modelo`) VALUES
(1, 1, 'Corolla', 'Base', '2010', '2020', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(2, 1, 'Hilux', 'SR5', '2015', '2022', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(3, 1, 'Prado', 'VX', '2020', '2024', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(4, 2, 'Sentra', 'Advance', '2008', '2018', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(5, 2, 'Patrol', 'LE', '2012', '2020', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(6, 2, 'Frontier', 'SE', '2016', '2022', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(7, 3, 'Vitara', 'GL', '2011', '2015', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(8, 3, 'Swift', 'GA', '2013', '2017', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(9, 3, 'Celerio', 'GS', '2017', '2021', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(10, 4, 'Ranger', 'XL', '2014', '2017', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(11, 4, 'Ecosport', 'Titanium', '2016', '2019', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(12, 4, 'Explorer', 'Limited', '2018', '2023', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(13, 5, 'Duster', 'Zen', '2013', '2015', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(14, 5, 'Kwid', 'Life', '2017', '2019', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(15, 5, 'Logan', 'Intense', '2020', '2024', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(16, 6, 'Aveo', 'LS', '2011', '2013', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(17, 6, 'Spark', 'LT', '2014', '2016', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(18, 6, 'Cruze', 'Premier', '2018', '2022', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(19, 7, 'Accent', 'GL', '2012', '2016', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(20, 7, 'Tucson', 'GLS', '2015', '2020', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(21, 7, 'Santa Fe', 'Limited', '2020', '2024', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(22, 8, 'Sportage', 'LX', '2014', '2016', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(23, 8, 'Rio', 'EX', '2017', '2019', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(24, 8, 'Sorento', 'SXL', '2019', '2023', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(25, 9, 'Tiggo', 'Comfort', '2012', '2016', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(26, 9, 'Arrizo', 'Luxury', '2014', '2020', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(27, 9, 'QQ', 'Basic', '2018', '2024', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(28, 10, 'CX-5', 'Touring', '2013', '2017', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(29, 10, 'Mazda3', 'Sedan', '2015', '2020', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(30, 10, 'Mazda6', 'Sport', '2019', '2023', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(31, 11, 'Lancer', 'GLS', '2010', '2014', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(32, 11, 'Montero', 'GLX', '2014', '2018', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(33, 11, 'Outlander', 'Sport', '2018', '2024', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(34, 12, 'Civic', 'EX', '2011', '2016', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(35, 12, 'CR-V', 'Touring', '2013', '2018', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(36, 12, 'Accord', 'Sport', '2017', '2022', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(37, 14, 'Tunland', 'Standard', '2012', '2015', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(38, 14, 'View CS2', 'Luxury', '2015', '2020', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37'),
(39, 14, 'Aumark', 'Cargo', '2018', '2023', 1, '2024-08-11 13:23:37', '2024-08-11 13:23:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo_repuestos`
--

CREATE TABLE `modelo_repuestos` (
  `id_modelo` int(11) NOT NULL,
  `id_repuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelo_repuestos`
--

INSERT INTO `modelo_repuestos` (`id_modelo`, `id_repuesto`) VALUES
(1, 3),
(1, 5),
(1, 12),
(1, 18),
(1, 21),
(1, 25),
(1, 37),
(1, 40),
(1, 43),
(1, 63),
(1, 71),
(2, 2),
(2, 7),
(2, 10),
(2, 16),
(2, 37),
(2, 51),
(2, 56),
(2, 65),
(3, 4),
(3, 9),
(3, 10),
(3, 14),
(3, 16),
(3, 26),
(3, 32),
(3, 40),
(3, 58),
(3, 66),
(3, 68),
(4, 1),
(4, 7),
(4, 19),
(4, 20),
(4, 29),
(4, 38),
(4, 42),
(4, 44),
(4, 45),
(4, 46),
(4, 50),
(4, 54),
(4, 59),
(4, 63),
(4, 66),
(5, 2),
(5, 9),
(5, 10),
(5, 13),
(5, 14),
(5, 39),
(5, 41),
(5, 48),
(5, 49),
(5, 52),
(5, 54),
(5, 56),
(5, 57),
(5, 58),
(5, 59),
(5, 64),
(5, 67),
(5, 70),
(6, 3),
(6, 9),
(6, 15),
(6, 25),
(6, 29),
(6, 42),
(6, 47),
(6, 53),
(6, 59),
(7, 5),
(7, 12),
(7, 14),
(7, 24),
(7, 25),
(7, 32),
(7, 38),
(7, 48),
(7, 53),
(7, 54),
(7, 61),
(7, 72),
(8, 1),
(8, 3),
(8, 14),
(8, 16),
(8, 32),
(8, 35),
(8, 40),
(8, 49),
(8, 55),
(8, 71),
(9, 3),
(9, 7),
(9, 8),
(9, 11),
(9, 17),
(9, 20),
(9, 30),
(9, 31),
(9, 45),
(9, 46),
(9, 48),
(9, 50),
(9, 52),
(9, 55),
(9, 68),
(10, 15),
(10, 18),
(10, 21),
(10, 26),
(10, 27),
(10, 29),
(10, 45),
(10, 47),
(10, 55),
(10, 62),
(10, 64),
(10, 65),
(10, 66),
(11, 2),
(11, 4),
(11, 12),
(11, 13),
(11, 23),
(11, 42),
(11, 52),
(12, 4),
(12, 12),
(12, 13),
(12, 25),
(12, 26),
(12, 33),
(12, 40),
(12, 44),
(12, 46),
(13, 2),
(13, 5),
(13, 7),
(13, 23),
(13, 28),
(13, 30),
(13, 34),
(13, 42),
(13, 43),
(13, 44),
(13, 46),
(13, 55),
(13, 59),
(13, 60),
(13, 63),
(14, 6),
(14, 16),
(14, 18),
(14, 20),
(14, 28),
(14, 48),
(14, 56),
(14, 61),
(14, 62),
(15, 1),
(15, 6),
(15, 15),
(15, 27),
(15, 28),
(15, 30),
(15, 38),
(15, 39),
(15, 46),
(15, 47),
(15, 48),
(15, 58),
(15, 60),
(15, 67),
(16, 6),
(16, 13),
(16, 17),
(16, 19),
(16, 22),
(16, 23),
(16, 33),
(16, 39),
(16, 49),
(16, 60),
(16, 62),
(16, 69),
(17, 5),
(17, 9),
(17, 19),
(17, 20),
(17, 30),
(17, 37),
(17, 40),
(17, 50),
(17, 56),
(17, 60),
(17, 61),
(17, 70),
(18, 2),
(18, 6),
(18, 8),
(18, 10),
(18, 13),
(18, 25),
(18, 30),
(18, 31),
(18, 41),
(18, 43),
(18, 50),
(18, 63),
(19, 17),
(19, 18),
(19, 21),
(19, 24),
(19, 27),
(19, 31),
(19, 33),
(19, 36),
(19, 39),
(19, 49),
(19, 57),
(19, 68),
(19, 72),
(20, 15),
(20, 16),
(20, 17),
(20, 22),
(20, 29),
(20, 41),
(20, 50),
(20, 53),
(20, 64),
(20, 67),
(21, 6),
(21, 8),
(21, 11),
(21, 19),
(21, 22),
(21, 28),
(21, 33),
(21, 34),
(21, 35),
(21, 42),
(21, 51),
(21, 52),
(21, 53),
(21, 60),
(21, 67),
(21, 68),
(21, 69),
(22, 34),
(22, 57),
(23, 5),
(23, 19),
(23, 21),
(23, 27),
(23, 36),
(23, 47),
(23, 57),
(23, 58),
(23, 69),
(23, 72),
(24, 7),
(24, 9),
(24, 11),
(24, 14),
(24, 21),
(24, 22),
(24, 41),
(24, 44),
(24, 65),
(24, 71),
(25, 1),
(25, 18),
(25, 20),
(25, 24),
(25, 27),
(25, 29),
(25, 35),
(25, 36),
(25, 51),
(25, 54),
(25, 56),
(25, 58),
(25, 59),
(25, 63),
(25, 64),
(25, 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motores`
--

CREATE TABLE `motores` (
  `id_motor` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `nombre_motor` varchar(255) NOT NULL,
  `cilindrada_motor` varchar(255) DEFAULT NULL,
  `especificaciones_motor` text DEFAULT NULL,
  `date_created_motor` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_motor` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `motores`
--

INSERT INTO `motores` (`id_motor`, `id_modelo`, `nombre_motor`, `cilindrada_motor`, `especificaciones_motor`, `date_created_motor`, `date_updated_motor`) VALUES
(1, 1, '1.8L 4-Cilindros', '1798 cc', '140 HP @ 6000 RPM', '2024-08-11 13:37:48', '2024-08-11 13:37:48'),
(2, 1, '2.0L 4-Cilindros', '1998 cc', '158 HP @ 6200 RPM', '2024-08-11 13:37:48', '2024-08-11 13:37:48'),
(3, 2, '2.4L 4-Cilindros', '2393 cc', '150 HP @ 3400 RPM', '2024-08-11 13:37:48', '2024-08-11 13:37:48'),
(4, 2, '2.8L Diesel', '2755 cc', '201 HP @ 3400 RPM', '2024-08-11 13:37:48', '2024-08-11 13:37:48'),
(5, 3, '4.0L V6', '3956 cc', '271 HP @ 5600 RPM', '2024-08-11 13:37:48', '2024-08-11 13:37:48'),
(6, 3, '2.7L 4-Cilindros', '2694 cc', '164 HP @ 5200 RPM', '2024-08-11 13:37:48', '2024-08-11 13:37:48'),
(7, 4, '1.6L 4-Cilindros', '1598 cc', '113 HP @ 5600 RPM', '2024-08-11 13:37:48', '2024-08-11 13:37:48'),
(8, 4, '2.0L Turbo', '1998 cc', '188 HP @ 5600 RPM', '2024-08-11 13:37:48', '2024-08-11 13:37:48'),
(9, 5, '4.0L V6', '3956 cc', '275 HP @ 5600 RPM', '2024-08-11 13:37:48', '2024-08-11 13:37:48'),
(10, 5, '5.6L V8', '5552 cc', '400 HP @ 5800 RPM', '2024-08-11 13:37:48', '2024-08-11 13:37:48'),
(11, 6, '1.5L 4-Cilindros', '1498 cc', '109 HP @ 6000 RPM', '2024-08-11 13:40:19', '2024-08-11 13:40:19'),
(12, 6, '1.6L 4-Cilindros', '1598 cc', '120 HP @ 5600 RPM', '2024-08-11 13:40:19', '2024-08-11 13:40:19'),
(13, 7, '2.0L 4-Cilindros', '1998 cc', '140 HP @ 6000 RPM', '2024-08-11 13:40:19', '2024-08-11 13:40:19'),
(14, 7, '2.4L 4-Cilindros', '2393 cc', '170 HP @ 6000 RPM', '2024-08-11 13:40:19', '2024-08-11 13:40:19'),
(15, 8, '1.4L Turbo', '1364 cc', '138 HP @ 6000 RPM', '2024-08-11 13:40:19', '2024-08-11 13:40:19'),
(16, 8, '1.6L 4-Cilindros', '1596 cc', '158 HP @ 6000 RPM', '2024-08-11 13:40:19', '2024-08-11 13:40:19'),
(17, 9, '1.8L 4-Cilindros', '1798 cc', '130 HP @ 6000 RPM', '2024-08-11 13:40:19', '2024-08-11 13:40:19'),
(18, 9, '2.0L 4-Cilindros', '1999 cc', '150 HP @ 6000 RPM', '2024-08-11 13:40:19', '2024-08-11 13:40:19'),
(19, 10, '2.2L Diesel', '2198 cc', '160 HP @ 6000 RPM', '2024-08-11 13:40:19', '2024-08-11 13:40:19'),
(20, 10, '2.4L Diesel', '2399 cc', '180 HP @ 6000 RPM', '2024-08-11 13:40:19', '2024-08-11 13:40:19'),
(21, 11, '2.0L 4-Cilindros', '1998 cc', '143 HP @ 6000 RPM', '2024-08-11 13:41:27', '2024-08-11 13:41:27'),
(22, 11, '2.5L 4-Cilindros', '2488 cc', '170 HP @ 6000 RPM', '2024-08-11 13:41:27', '2024-08-11 13:41:27'),
(23, 12, '1.0L 3-Cilindros', '999 cc', '68 HP @ 5500 RPM', '2024-08-11 13:41:27', '2024-08-11 13:41:27'),
(24, 12, '1.2L 4-Cilindros', '1198 cc', '79 HP @ 5500 RPM', '2024-08-11 13:41:27', '2024-08-11 13:41:27'),
(25, 13, '1.6L 4-Cilindros', '1598 cc', '113 HP @ 6000 RPM', '2024-08-11 13:41:27', '2024-08-11 13:41:27'),
(26, 13, '2.0L 4-Cilindros', '1998 cc', '143 HP @ 6000 RPM', '2024-08-11 13:41:27', '2024-08-11 13:41:27'),
(27, 14, '1.4L Turbo', '1364 cc', '138 HP @ 6000 RPM', '2024-08-11 13:41:27', '2024-08-11 13:41:27'),
(28, 14, '1.6L 4-Cilindros', '1598 cc', '158 HP @ 6000 RPM', '2024-08-11 13:41:27', '2024-08-11 13:41:27'),
(29, 15, '1.2L 3-Cilindros', '1199 cc', '78 HP @ 5500 RPM', '2024-08-11 13:41:27', '2024-08-11 13:41:27'),
(30, 15, '1.4L 4-Cilindros', '1399 cc', '98 HP @ 6000 RPM', '2024-08-11 13:41:27', '2024-08-11 13:41:27'),
(31, 16, '1.6L 4-Cilindros', '1598 cc', '138 HP @ 6000 RPM', '2024-08-11 13:42:34', '2024-08-11 13:42:34'),
(32, 16, '1.8L 4-Cilindros', '1798 cc', '158 HP @ 6000 RPM', '2024-08-11 13:42:34', '2024-08-11 13:42:34'),
(33, 17, '1.2L 4-Cilindros', '1199 cc', '78 HP @ 5500 RPM', '2024-08-11 13:42:34', '2024-08-11 13:42:34'),
(34, 17, '1.4L 4-Cilindros', '1399 cc', '98 HP @ 6000 RPM', '2024-08-11 13:42:34', '2024-08-11 13:42:34'),
(35, 18, '1.0L 3-Cilindros', '999 cc', '68 HP @ 5500 RPM', '2024-08-11 13:42:34', '2024-08-11 13:42:34'),
(36, 18, '1.2L 4-Cilindros', '1198 cc', '78 HP @ 5500 RPM', '2024-08-11 13:42:34', '2024-08-11 13:42:34'),
(37, 19, '1.6L 4-Cilindros', '1598 cc', '113 HP @ 6000 RPM', '2024-08-11 13:42:34', '2024-08-11 13:42:34'),
(38, 19, '1.8L 4-Cilindros', '1798 cc', '140 HP @ 6000 RPM', '2024-08-11 13:42:34', '2024-08-11 13:42:34'),
(39, 20, '2.0L 4-Cilindros', '1998 cc', '170 HP @ 6000 RPM', '2024-08-11 13:42:34', '2024-08-11 13:42:34'),
(40, 20, '2.4L 4-Cilindros', '2398 cc', '190 HP @ 6000 RPM', '2024-08-11 13:42:34', '2024-08-11 13:42:34'),
(41, 21, '2.0L 4-Cilindros', '1998 cc', '143 HP @ 6000 RPM', '2024-08-11 13:43:48', '2024-08-11 13:43:48'),
(42, 21, '2.5L 4-Cilindros', '2488 cc', '175 HP @ 6000 RPM', '2024-08-11 13:43:48', '2024-08-11 13:43:48'),
(43, 22, '1.6L 4-Cilindros', '1598 cc', '138 HP @ 6000 RPM', '2024-08-11 13:43:48', '2024-08-11 13:43:48'),
(44, 22, '1.8L 4-Cilindros', '1798 cc', '158 HP @ 6000 RPM', '2024-08-11 13:43:48', '2024-08-11 13:43:48'),
(45, 23, '2.0L 4-Cilindros', '1998 cc', '170 HP @ 6000 RPM', '2024-08-11 13:43:48', '2024-08-11 13:43:48'),
(46, 23, '2.4L 4-Cilindros', '2398 cc', '190 HP @ 6000 RPM', '2024-08-11 13:43:48', '2024-08-11 13:43:48'),
(47, 24, '2.0L 4-Cilindros', '1998 cc', '170 HP @ 6000 RPM', '2024-08-11 13:43:48', '2024-08-11 13:43:48'),
(48, 24, '2.4L 4-Cilindros', '2398 cc', '190 HP @ 6000 RPM', '2024-08-11 13:43:48', '2024-08-11 13:43:48'),
(49, 25, '1.6L 4-Cilindros', '1598 cc', '138 HP @ 6000 RPM', '2024-08-11 13:43:48', '2024-08-11 13:43:48'),
(50, 25, '1.8L 4-Cilindros', '1798 cc', '158 HP @ 6000 RPM', '2024-08-11 13:43:48', '2024-08-11 13:43:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motor_repuestos`
--

CREATE TABLE `motor_repuestos` (
  `id_motor` int(11) NOT NULL,
  `id_repuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(255) NOT NULL,
  `nit_ci_proveedor` int(11) NOT NULL,
  `telefono_proveedor` varchar(255) NOT NULL,
  `direccion_proveedor` varchar(255) NOT NULL,
  `email_proveedor` text NOT NULL,
  `date_created_proveedor` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_proveedor` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuestos`
--

CREATE TABLE `repuestos` (
  `id_repuesto` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nombre_repuesto` varchar(255) NOT NULL,
  `descripcion_repuesto` text DEFAULT NULL,
  `oem_repuesto` varchar(255) DEFAULT NULL,
  `codigo_tienda_repuesto` varchar(255) NOT NULL,
  `img_repuesto` text DEFAULT NULL,
  `stock_repuesto` int(11) DEFAULT NULL,
  `precio_repuesto` decimal(10,2) DEFAULT NULL,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  `marca_repuesto` varchar(255) DEFAULT NULL,
  `venta_repuesto` int(11) NOT NULL,
  `estado_repuesto` tinyint(4) DEFAULT 1,
  `date_created_repuesto` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_repuesto` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `repuestos`
--

INSERT INTO `repuestos` (`id_repuesto`, `id_categoria`, `nombre_repuesto`, `descripcion_repuesto`, `oem_repuesto`, `codigo_tienda_repuesto`, `img_repuesto`, `stock_repuesto`, `precio_repuesto`, `precio_compra`, `marca_repuesto`, `venta_repuesto`, `estado_repuesto`, `date_created_repuesto`, `date_updated_repuesto`) VALUES
(1, 1, 'Filtro de Aire Toyota Corolla', 'Filtro de Aire Toyota Corolla adecuado para modelos específicos.', 'OEM85224', '1000', 'views/dist/images/repuestos/suspension.png', 435, 193.43, 154.74, 'MarcaZ', 167, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(2, 1, 'Filtro de Aceite Nissan Sentra', 'Filtro de Aceite Nissan Sentra adecuado para modelos específicos.', 'OEM82305', '1001', 'views/dist/images/repuestos/suspension.png', 293, 87.17, 69.74, 'MarcaZ', 86, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(3, 1, 'Filtro de Combustible Ford Ranger', 'Filtro de Combustible Ford Ranger adecuado para modelos específicos.', 'OEM65162', '1002', 'views/dist/images/repuestos/suspension.png', 420, 61.22, 48.98, 'MarcaY', 39, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(4, 1, 'Filtro de Cabina Hyundai Tucson', 'Filtro de Cabina Hyundai Tucson adecuado para modelos específicos.', 'OEM48916', '1003', 'views/dist/images/repuestos/suspension.png', 384, 60.19, 48.15, 'MarcaX', 97, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(5, 1, 'Filtro de Transmisión Kia Sportage', 'Filtro de Transmisión Kia Sportage adecuado para modelos específicos.', 'OEM63002', '1004', 'views/dist/images/repuestos/suspension.png', 458, 142.73, 114.18, 'MarcaX', 88, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(6, 1, 'Filtro de Aceite Renault Duster', 'Filtro de Aceite Renault Duster adecuado para modelos específicos.', 'OEM54263', '1005', 'views/dist/images/repuestos/suspension.png', 307, 145.44, 116.35, 'MarcaZ', 76, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(7, 1, 'Filtro de Combustible Chevrolet Aveo', 'Filtro de Combustible Chevrolet Aveo adecuado para modelos específicos.', 'OEM44282', '1006', 'views/dist/images/repuestos/suspension.png', 224, 162.41, 129.93, 'MarcaX', 158, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(8, 1, 'Filtro de Aire Mazda CX-5', 'Filtro de Aire Mazda CX-5 adecuado para modelos específicos.', 'OEM31932', '1007', 'views/dist/images/repuestos/suspension.png', 208, 100.16, 80.13, 'MarcaY', 200, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(9, 2, 'Bujía NGK LFR5A-11', 'Bujía NGK LFR5A-11 adecuado para modelos específicos.', 'OEM91761', '1008', 'views/dist/images/repuestos/suspension.png', 383, 151.76, 121.41, 'MarcaX', 93, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(10, 2, 'Bobina de Encendido Bosch 0221504470', 'Bobina de Encendido Bosch 0221504470 adecuado para modelos específicos.', 'OEM82820', '1009', 'views/dist/images/repuestos/suspension.png', 386, 151.69, 121.35, 'MarcaX', 11, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(11, 2, 'Cable de Bujía Denso', 'Cable de Bujía Denso adecuado para modelos específicos.', 'OEM66971', '1010', 'views/dist/images/repuestos/suspension.png', 356, 135.23, 108.18, 'MarcaY', 18, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(12, 2, 'Inyector de Combustible Bosch', 'Inyector de Combustible Bosch adecuado para modelos específicos.', 'OEM60061', '1011', 'views/dist/images/repuestos/suspension.png', 113, 125.77, 100.62, 'MarcaY', 148, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(13, 2, 'Sensor de Oxígeno Denso', 'Sensor de Oxígeno Denso adecuado para modelos específicos.', 'OEM34605', '1012', 'views/dist/images/repuestos/suspension.png', 420, 166.16, 132.93, 'MarcaY', 179, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(14, 2, 'Bujía NGK IZFR6K-11S', 'Bujía NGK IZFR6K-11S adecuado para modelos específicos.', 'OEM72118', '1013', 'views/dist/images/repuestos/suspension.png', 430, 47.29, 37.83, 'MarcaY', 110, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(15, 2, 'Bobina de Encendido Delphi GN10241', 'Bobina de Encendido Delphi GN10241 adecuado para modelos específicos.', 'OEM75156', '1014', 'views/dist/images/repuestos/suspension.png', 427, 171.43, 137.14, 'MarcaZ', 82, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(16, 2, 'Inyector Siemens Deka', 'Inyector Siemens Deka adecuado para modelos específicos.', 'OEM88086', '1015', 'views/dist/images/repuestos/suspension.png', 243, 143.51, 114.81, 'MarcaY', 118, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(17, 3, 'Pastillas de Freno Brembo P06028', 'Pastillas de Freno Brembo P06028 adecuado para modelos específicos.', 'OEM79031', '1016', 'views/dist/images/repuestos/suspension.png', 175, 168.59, 134.87, 'MarcaY', 151, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(18, 3, 'Disco de Freno ATE PowerDisc', 'Disco de Freno ATE PowerDisc adecuado para modelos específicos.', 'OEM62683', '1017', 'views/dist/images/repuestos/suspension.png', 272, 185.92, 148.74, 'MarcaX', 143, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(19, 3, 'Caliper de Freno TRW', 'Caliper de Freno TRW adecuado para modelos específicos.', 'OEM82413', '1018', 'views/dist/images/repuestos/suspension.png', 220, 88.54, 70.83, 'MarcaX', 142, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(20, 3, 'Tambor de Freno Brembo', 'Tambor de Freno Brembo adecuado para modelos específicos.', 'OEM64510', '1019', 'views/dist/images/repuestos/suspension.png', 349, 123.03, 98.42, 'MarcaY', 147, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(21, 3, 'Sensor ABS Bosch', 'Sensor ABS Bosch adecuado para modelos específicos.', 'OEM45508', '1020', 'views/dist/images/repuestos/suspension.png', 301, 182.14, 145.71, 'MarcaY', 147, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(22, 3, 'Pastillas de Freno Bosch BP976', 'Pastillas de Freno Bosch BP976 adecuado para modelos específicos.', 'OEM10299', '1021', 'views/dist/images/repuestos/suspension.png', 364, 164.11, 131.29, 'MarcaX', 53, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(23, 3, 'Disco de Freno TRW DF2802', 'Disco de Freno TRW DF2802 adecuado para modelos específicos.', 'OEM96035', '1022', 'views/dist/images/repuestos/suspension.png', 135, 28.99, 23.19, 'MarcaZ', 38, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(24, 3, 'Caliper de Freno ACDelco', 'Caliper de Freno ACDelco adecuado para modelos específicos.', 'OEM72531', '1023', 'views/dist/images/repuestos/suspension.png', 464, 163.75, 131.00, 'MarcaY', 47, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(25, 4, 'Amortiguador KYB Excel-G', 'Amortiguador KYB Excel-G adecuado para modelos específicos.', 'OEM82003', '1024', 'views/dist/images/repuestos/suspension.png', 361, 131.29, 105.03, 'MarcaY', 57, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(26, 4, 'Muelles de Suspensión Eibach', 'Muelles de Suspensión Eibach adecuado para modelos específicos.', 'OEM49816', '1025', 'views/dist/images/repuestos/suspension.png', 423, 199.80, 159.84, 'MarcaZ', 130, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(27, 4, 'Barra Estabilizadora Moog', 'Barra Estabilizadora Moog adecuado para modelos específicos.', 'OEM57477', '1026', 'views/dist/images/repuestos/suspension.png', 457, 142.63, 114.10, 'MarcaY', 180, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(28, 4, 'Bujes de Suspensión Febi Bilstein', 'Bujes de Suspensión Febi Bilstein adecuado para modelos específicos.', 'OEM74210', '1027', 'views/dist/images/repuestos/suspension.png', 86, 25.36, 20.29, 'MarcaZ', 90, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(29, 4, 'Resorte de Suspensión Lesjofors', 'Resorte de Suspensión Lesjofors adecuado para modelos específicos.', 'OEM83363', '1028', 'views/dist/images/repuestos/suspension.png', 352, 154.15, 123.32, 'MarcaY', 45, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(30, 4, 'Amortiguador Bilstein B6', 'Amortiguador Bilstein B6 adecuado para modelos específicos.', 'OEM96598', '1029', 'views/dist/images/repuestos/suspension.png', 268, 129.82, 103.86, 'MarcaX', 63, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(31, 4, 'Muelles de Suspensión H&R', 'Muelles de Suspensión H&R adecuado para modelos específicos.', 'OEM73198', '1030', 'views/dist/images/repuestos/suspension.png', 419, 56.50, 45.20, 'MarcaX', 21, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(32, 4, 'Barra Estabilizadora Meyle', 'Barra Estabilizadora Meyle adecuado para modelos específicos.', 'OEM87876', '1031', 'views/dist/images/repuestos/suspension.png', 124, 41.98, 33.58, 'MarcaZ', 35, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(33, 5, 'Correa de Distribución Continental CTAM', 'Correa de Distribución Continental CTAM adecuado para modelos específicos.', 'OEM11812', '1032', 'views/dist/images/repuestos/suspension.png', 99, 55.75, 44.60, 'MarcaY', 61, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(34, 5, 'Correa de Accesorios Gates', 'Correa de Accesorios Gates adecuado para modelos específicos.', 'OEM62266', '1033', 'views/dist/images/repuestos/suspension.png', 419, 89.23, 71.38, 'MarcaY', 170, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(35, 5, 'Tensor de Correa SKF', 'Tensor de Correa SKF adecuado para modelos específicos.', 'OEM94067', '1034', 'views/dist/images/repuestos/suspension.png', 260, 186.40, 149.12, 'MarcaZ', 29, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(36, 5, 'Polea de Correa INA', 'Polea de Correa INA adecuado para modelos específicos.', 'OEM58682', '1035', 'views/dist/images/repuestos/suspension.png', 333, 133.51, 106.81, 'MarcaY', 161, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(37, 5, 'Kit de Correas Dayco', 'Kit de Correas Dayco adecuado para modelos específicos.', 'OEM76935', '1036', 'views/dist/images/repuestos/suspension.png', 412, 107.69, 86.15, 'MarcaY', 187, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(38, 5, 'Correa de Distribución Bosch', 'Correa de Distribución Bosch adecuado para modelos específicos.', 'OEM44201', '1037', 'views/dist/images/repuestos/suspension.png', 312, 48.45, 38.76, 'MarcaY', 199, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(39, 5, 'Correa de Accesorios ContiTech', 'Correa de Accesorios ContiTech adecuado para modelos específicos.', 'OEM97202', '1038', 'views/dist/images/repuestos/suspension.png', 67, 137.89, 110.31, 'MarcaX', 148, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(40, 5, 'Polea de Correa Gates', 'Polea de Correa Gates adecuado para modelos específicos.', 'OEM56692', '1039', 'views/dist/images/repuestos/suspension.png', 88, 139.23, 111.38, 'MarcaX', 153, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(41, 6, 'Radiador Denso', 'Radiador Denso adecuado para modelos específicos.', 'OEM54380', '1040', 'views/dist/images/repuestos/suspension.png', 327, 197.14, 157.71, 'MarcaY', 10, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(42, 6, 'Termostato Wahler', 'Termostato Wahler adecuado para modelos específicos.', 'OEM53911', '1041', 'views/dist/images/repuestos/suspension.png', 124, 149.28, 119.42, 'MarcaZ', 172, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(43, 6, 'Bomba de Agua Aisin', 'Bomba de Agua Aisin adecuado para modelos específicos.', 'OEM72699', '1042', 'views/dist/images/repuestos/suspension.png', 286, 154.34, 123.47, 'MarcaX', 58, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(44, 6, 'Ventilador de Radiador Valeo', 'Ventilador de Radiador Valeo adecuado para modelos específicos.', 'OEM82215', '1043', 'views/dist/images/repuestos/suspension.png', 383, 198.78, 159.02, 'MarcaY', 60, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(45, 6, 'Manguera de Radiador Gates', 'Manguera de Radiador Gates adecuado para modelos específicos.', 'OEM82562', '1044', 'views/dist/images/repuestos/suspension.png', 337, 165.97, 132.78, 'MarcaZ', 75, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(46, 6, 'Radiador Nissens', 'Radiador Nissens adecuado para modelos específicos.', 'OEM21693', '1045', 'views/dist/images/repuestos/suspension.png', 394, 52.23, 41.78, 'MarcaZ', 51, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(47, 6, 'Termostato Behr', 'Termostato Behr adecuado para modelos específicos.', 'OEM42174', '1046', 'views/dist/images/repuestos/suspension.png', 368, 62.34, 49.87, 'MarcaX', 109, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(48, 6, 'Bomba de Agua Graf', 'Bomba de Agua Graf adecuado para modelos específicos.', 'OEM68212', '1047', 'views/dist/images/repuestos/suspension.png', 467, 22.47, 17.98, 'MarcaY', 51, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(49, 7, 'Embrague LUK', 'Embrague LUK adecuado para modelos específicos.', 'OEM15378', '1048', 'views/dist/images/repuestos/suspension.png', 71, 198.92, 159.14, 'MarcaZ', 125, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(50, 7, 'Disco de Embrague Sachs', 'Disco de Embrague Sachs adecuado para modelos específicos.', 'OEM53782', '1049', 'views/dist/images/repuestos/suspension.png', 298, 158.88, 127.10, 'MarcaZ', 167, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(51, 7, 'Plato de Presión Valeo', 'Plato de Presión Valeo adecuado para modelos específicos.', 'OEM87688', '1050', 'views/dist/images/repuestos/suspension.png', 130, 174.05, 139.24, 'MarcaX', 159, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(52, 7, 'Rodamiento de Embrague SKF', 'Rodamiento de Embrague SKF adecuado para modelos específicos.', 'OEM82861', '1051', 'views/dist/images/repuestos/suspension.png', 390, 94.58, 75.66, 'MarcaX', 71, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(53, 7, 'Cilindro Maestro de Embrague Aisin', 'Cilindro Maestro de Embrague Aisin adecuado para modelos específicos.', 'OEM40331', '1052', 'views/dist/images/repuestos/suspension.png', 456, 26.14, 20.91, 'MarcaX', 81, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(54, 7, 'Embrague Exedy', 'Embrague Exedy adecuado para modelos específicos.', 'OEM36867', '1053', 'views/dist/images/repuestos/suspension.png', 58, 25.89, 20.71, 'MarcaX', 100, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(55, 7, 'Disco de Embrague Aisin', 'Disco de Embrague Aisin adecuado para modelos específicos.', 'OEM41067', '1054', 'views/dist/images/repuestos/suspension.png', 346, 125.10, 100.08, 'MarcaX', 80, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(56, 7, 'Plato de Presión Sachs', 'Plato de Presión Sachs adecuado para modelos específicos.', 'OEM20686', '1055', 'views/dist/images/repuestos/suspension.png', 452, 173.57, 138.86, 'MarcaY', 172, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(57, 8, 'Batería Bosch S4', 'Batería Bosch S4 adecuado para modelos específicos.', 'OEM47503', '1056', 'views/dist/images/repuestos/suspension.png', 298, 148.80, 119.04, 'MarcaX', 31, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(58, 8, 'Alternador Denso', 'Alternador Denso adecuado para modelos específicos.', 'OEM92236', '1057', 'views/dist/images/repuestos/suspension.png', 129, 46.13, 36.90, 'MarcaY', 180, 1, '2024-08-11 14:17:10', '2024-08-11 14:17:10'),
(59, 8, 'Motor de Arranque Valeo', 'Motor de Arranque Valeo adecuado para modelos específicos.', 'OEM38602', '1058', 'views/dist/images/repuestos/suspension.png', 362, 112.89, 90.31, 'MarcaY', 86, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11'),
(60, 8, 'Regulador de Voltaje Hella', 'Regulador de Voltaje Hella adecuado para modelos específicos.', 'OEM69650', '1059', 'views/dist/images/repuestos/suspension.png', 222, 69.24, 55.39, 'MarcaY', 98, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11'),
(61, 8, 'Cableado Eléctrico NGK', 'Cableado Eléctrico NGK adecuado para modelos específicos.', 'OEM67318', '1060', 'views/dist/images/repuestos/suspension.png', 240, 109.07, 87.26, 'MarcaY', 67, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11'),
(62, 8, 'Batería Varta Blue Dynamic', 'Batería Varta Blue Dynamic adecuado para modelos específicos.', 'OEM11583', '1061', 'views/dist/images/repuestos/suspension.png', 473, 153.46, 122.77, 'MarcaZ', 107, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11'),
(63, 8, 'Alternador Bosch', 'Alternador Bosch adecuado para modelos específicos.', 'OEM59902', '1062', 'views/dist/images/repuestos/suspension.png', 50, 193.55, 154.84, 'MarcaY', 192, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11'),
(64, 8, 'Motor de Arranque Bosch', 'Motor de Arranque Bosch adecuado para modelos específicos.', 'OEM22471', '1063', 'views/dist/images/repuestos/suspension.png', 146, 199.70, 159.76, 'MarcaY', 88, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11'),
(65, 9, 'Faro Delantero Hella', 'Faro Delantero Hella adecuado para modelos específicos.', 'OEM29548', '1064', 'views/dist/images/repuestos/suspension.png', 155, 129.87, 103.90, 'MarcaY', 154, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11'),
(66, 9, 'Luz Trasera Magneti Marelli', 'Luz Trasera Magneti Marelli adecuado para modelos específicos.', 'OEM54856', '1065', 'views/dist/images/repuestos/suspension.png', 463, 109.34, 87.47, 'MarcaY', 100, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11'),
(67, 9, 'Espejo Lateral TYC', 'Espejo Lateral TYC adecuado para modelos específicos.', 'OEM54959', '1066', 'views/dist/images/repuestos/suspension.png', 184, 133.90, 107.12, 'MarcaZ', 112, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11'),
(68, 9, 'Parachoques Delantero KLOKKERHOLM', 'Parachoques Delantero KLOKKERHOLM adecuado para modelos específicos.', 'OEM84535', '1067', 'views/dist/images/repuestos/suspension.png', 193, 160.77, 128.62, 'MarcaY', 12, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11'),
(69, 9, 'Parrilla Delantera Johns', 'Parrilla Delantera Johns adecuado para modelos específicos.', 'OEM26797', '1068', 'views/dist/images/repuestos/suspension.png', 396, 99.31, 79.45, 'MarcaZ', 80, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11'),
(70, 9, 'Faro Delantero Bosch', 'Faro Delantero Bosch adecuado para modelos específicos.', 'OEM86781', '1069', 'views/dist/images/repuestos/suspension.png', 352, 142.38, 113.90, 'MarcaY', 141, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11'),
(71, 9, 'Luz Trasera Valeo', 'Luz Trasera Valeo adecuado para modelos específicos.', 'OEM35995', '1070', 'views/dist/images/repuestos/suspension.png', 83, 73.50, 58.80, 'MarcaZ', 98, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11'),
(72, 9, 'Espejo Lateral ULO', 'Espejo Lateral ULO adecuado para modelos específicos.', 'OEM91329', '1071', 'views/dist/images/repuestos/suspension.png', 396, 164.08, 131.26, 'MarcaZ', 33, 1, '2024-08-11 14:17:11', '2024-08-11 14:17:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(255) DEFAULT NULL,
  `apellido_usuario` varchar(255) DEFAULT NULL,
  `user_usuario` varchar(255) DEFAULT NULL,
  `foto_usuario` varchar(255) DEFAULT NULL,
  `email_usuario` varchar(255) DEFAULT NULL,
  `password_usuario` varchar(255) DEFAULT NULL,
  `rol_usuario` varchar(255) DEFAULT NULL,
  `estado_usuario` tinyint(4) DEFAULT 1,
  `date_created_usuario` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated_usuario` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `user_usuario`, `foto_usuario`, `email_usuario`, `password_usuario`, `rol_usuario`, `estado_usuario`, `date_created_usuario`, `date_updated_usuario`) VALUES
(1, 'benjamin', 'canaviri', 'benjo1234', 'views/assets/media/avatars/usuarios/benjo1234/713.jpg', 'benjo@gmail.com', '$2a$07$azybxcags23425sdg23sdem1CFT2u/A.0JOm/IXWxebxaQOkjS85C', 'administrador', 1, '2024-06-09 15:27:08', '2024-08-11 04:35:28'),
(2, 'pitter', 'kevin', 'pitter123', 'views/assets/media/avatars/usuarios/pitter123/696.jpg', 'pitter@gmail.com', '$2a$07$azybxcags23425sdg23sdexDgBwF1Wba.r8oVb3KiQPBr8fPcAQBe', 'venta', 1, '2024-07-25 03:06:26', '2024-07-25 03:06:26'),
(3, 'david', 'apaza', 'tonkis123', 'views/assets/media/avatars/usuarios/tonkis123/570.jpg', 'tonkis@gmail.com', '$2a$07$azybxcags23425sdg23sdeqJpRVasxIvNizan7dQx1M6JQIJEH4vK', 'venta', 1, '2024-07-29 23:17:47', '2024-07-29 23:18:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `codigo_venta` int(11) NOT NULL,
  `monto_total_venta` decimal(10,2) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado_venta` varchar(50) DEFAULT NULL,
  `date_created_venta` date DEFAULT NULL,
  `date_updated_venta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalles_compras`
--
ALTER TABLE `detalles_compras`
  ADD PRIMARY KEY (`id_detalle_compra`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_repuesto` (`id_repuesto`);

--
-- Indices de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  ADD PRIMARY KEY (`id_detalleVenta`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_repuesto` (`id_repuesto`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id_modelo`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `modelo_repuestos`
--
ALTER TABLE `modelo_repuestos`
  ADD PRIMARY KEY (`id_modelo`,`id_repuesto`),
  ADD KEY `id_repuesto` (`id_repuesto`);

--
-- Indices de la tabla `motores`
--
ALTER TABLE `motores`
  ADD PRIMARY KEY (`id_motor`),
  ADD KEY `fk_modelo_motor` (`id_modelo`);

--
-- Indices de la tabla `motor_repuestos`
--
ALTER TABLE `motor_repuestos`
  ADD PRIMARY KEY (`id_motor`,`id_repuesto`),
  ADD KEY `id_repuesto` (`id_repuesto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD PRIMARY KEY (`id_repuesto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carritos`
--
ALTER TABLE `carritos`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_compras`
--
ALTER TABLE `detalles_compras`
  MODIFY `id_detalle_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  MODIFY `id_detalleVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `motores`
--
ALTER TABLE `motores`
  MODIFY `id_motor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  MODIFY `id_repuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD CONSTRAINT `carritos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `detalles_compras`
--
ALTER TABLE `detalles_compras`
  ADD CONSTRAINT `detalles_compras_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id_compra`),
  ADD CONSTRAINT `detalles_compras_ibfk_2` FOREIGN KEY (`id_repuesto`) REFERENCES `repuestos` (`id_repuesto`);

--
-- Filtros para la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  ADD CONSTRAINT `detalles_ventas_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `detalles_ventas_ibfk_2` FOREIGN KEY (`id_repuesto`) REFERENCES `repuestos` (`id_repuesto`);

--
-- Filtros para la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `modelos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`);

--
-- Filtros para la tabla `modelo_repuestos`
--
ALTER TABLE `modelo_repuestos`
  ADD CONSTRAINT `modelo_repuestos_ibfk_1` FOREIGN KEY (`id_modelo`) REFERENCES `modelos` (`id_modelo`),
  ADD CONSTRAINT `modelo_repuestos_ibfk_2` FOREIGN KEY (`id_repuesto`) REFERENCES `repuestos` (`id_repuesto`);

--
-- Filtros para la tabla `motores`
--
ALTER TABLE `motores`
  ADD CONSTRAINT `fk_modelo_motor` FOREIGN KEY (`id_modelo`) REFERENCES `modelos` (`id_modelo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `motor_repuestos`
--
ALTER TABLE `motor_repuestos`
  ADD CONSTRAINT `motor_repuestos_ibfk_1` FOREIGN KEY (`id_motor`) REFERENCES `motores` (`id_motor`),
  ADD CONSTRAINT `motor_repuestos_ibfk_2` FOREIGN KEY (`id_repuesto`) REFERENCES `repuestos` (`id_repuesto`);

--
-- Filtros para la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD CONSTRAINT `repuestos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
