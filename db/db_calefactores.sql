-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2026 a las 21:05:33
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_calefactores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calefactores`
--

CREATE TABLE `calefactores` (
  `id_calefactor` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `potencia` int(10) UNSIGNED NOT NULL,
  `peso` decimal(10,2) UNSIGNED NOT NULL,
  `precio` decimal(10,2) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calefactores`
--

INSERT INTO `calefactores` (`id_calefactor`, `id_modelo`, `nombre`, `tipo`, `potencia`, `peso`, `precio`, `stock`, `fecha_creacion`) VALUES
(6, 2, 'XLM', 'Gas', 2500, '60.50', '455999.99', 12, '0000-00-00 00:00:00'),
(7, 2, 'EcoHome', 'Gas', 2000, '8.00', '400000.00', 25, '2026-05-01 00:00:00'),
(8, 2, 'Domus', 'Electrico', 1500, '7.00', '350000.00', 15, '2026-05-04 00:00:00'),
(9, 3, 'Comerk', 'Electrico', 1300, '5.00', '270000.00', 17, '2026-05-09 14:15:00'),
(10, 3, 'OrbanPesado', 'gas', 2500, '8.00', '400320.00', 6, '2026-05-09 14:16:17'),
(11, 4, 'CalderaMax', 'Gas', 10000, '45.00', '1000000.00', 3, '2026-05-09 14:17:38'),
(12, 4, 'IndustrialPro', 'Gas', 10000, '50.00', '1200000.00', 3, '2026-05-09 14:18:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `id_modelo` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` text,
  `categoria` varchar(100) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id_modelo`, `nombre`, `descripcion`, `categoria`, `imagen`) VALUES
(2, 'Orban plus', 'Linea premium de bajo consumo', 'domestico', 'assets/img/domestico.jpeg'),
(3, 'inulocal', 'Excelente para espacios modernos', 'comercial', 'assets/img/comercial.jpeg'),
(4, 'termoblock', 'Pensados para galpones o espacios amplios', 'industrial', 'assets/img/industrial.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `contraseña`, `rol`) VALUES
(1, 'webadmin', 'webadmin@gmail', '$2y$10$2DVOET6GnefFcseh0wr3Q.fDEhHhVFLy2eRrZnXs6S6gm1OXrBQUi', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calefactores`
--
ALTER TABLE `calefactores`
  ADD PRIMARY KEY (`id_calefactor`),
  ADD KEY `fk_modelo` (`id_modelo`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id_modelo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calefactores`
--
ALTER TABLE `calefactores`
  MODIFY `id_calefactor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calefactores`
--
ALTER TABLE `calefactores`
  ADD CONSTRAINT `fk_modelo` FOREIGN KEY (`id_modelo`) REFERENCES `modelos` (`id_modelo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
