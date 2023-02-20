-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2023 a las 06:08:25
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemainventarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracion`
--

CREATE TABLE `administracion` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administracion`
--

INSERT INTO `administracion` (`id`, `usuario`, `password`) VALUES
(1, 'carlos', '2023');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prendas`
--

CREATE TABLE `prendas` (
  `id` int(11) NOT NULL,
  `tipo_prenda` varchar(50) NOT NULL,
  `codigo` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prendas`
--

INSERT INTO `prendas` (`id`, `tipo_prenda`, `codigo`) VALUES
(1, 'BUZO NEGRO', 20231),
(2, 'BUZO AZUL OSCURO', 20232),
(3, 'BUZO GRIS', 20233),
(4, 'ROMPEVIENTOS NEGRA', 20234),
(5, 'CHAQUETA AZUL OSCURA', 20235),
(6, 'CHAQUETA AZUL CLARA', 20236),
(7, 'POLO BLANCA', 20237),
(8, 'PANTALON', 20238),
(9, 'BONO CALZADO', 20239),
(10, 'CHALECO', 20240),
(11, 'GORRA', 20241);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `identificacion` int(11) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `descripcion_niv` varchar(50) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `sede` varchar(40) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `genero` varchar(16) NOT NULL,
  `talla` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `identificacion`, `nombres`, `apellidos`, `fecha_inicio`, `descripcion_niv`, `cargo`, `sede`, `ciudad`, `genero`, `talla`) VALUES
(2, 1000540349, 'GERALDINE VANESA', 'ABADIA AVELLANEDA', '2021-10-19', 'CANAL DIGITAL', 'RAC VENTAS', 'ROYAL', 'BOGOTA D.C.', 'F', 'S'),
(1, 1103096629, 'JANNIER EDUARDO', 'ABAD TORRES', '2019-04-24', 'HELPDESK', 'INGENIERO JUNIOR', 'MEDELLIN', 'MEDELLIN', 'M', 'L');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administracion`
--
ALTER TABLE `administracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prendas`
--
ALTER TABLE `prendas`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `indice` (`id`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`identificacion`),
  ADD KEY `indice` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administracion`
--
ALTER TABLE `administracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `prendas`
--
ALTER TABLE `prendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
