-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2024 a las 22:19:53
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto5`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_sesiones`
--

CREATE TABLE `historial_sesiones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `nombre` varchar(50) DEFAULT NULL,
  `exito` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial_sesiones`
--

INSERT INTO `historial_sesiones` (`id`, `id_usuario`, `fecha_hora`, `nombre`, `exito`) VALUES
(1, 5, '2024-10-14 19:56:32', 'Jhonny', 1),
(2, 6, '2024-10-14 20:01:23', 'Carlo', 1),
(3, 6, '2024-10-14 20:12:26', 'Carlo', 1),
(4, 5, '2024-10-15 19:33:09', 'Jhonny', 1),
(5, 7, '2024-10-15 19:35:10', 'Melvin', 1),
(6, 5, '2024-10-15 19:43:22', 'Jhonny', 1),
(7, 5, '2024-10-15 19:47:58', 'Jhonny', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `id` int(11) NOT NULL,
  `nombre_equipo` varchar(100) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `Frecuencia` varchar(50) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `fecha_sig_mant` date DEFAULT NULL,
  `reprogramacion` varchar(20) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `horas_invertidas` int(11) DEFAULT NULL,
  `comentario` varchar(100) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`id`, `nombre_equipo`, `descripcion`, `Frecuencia`, `fecha_inicio`, `fecha_fin`, `fecha_sig_mant`, `reprogramacion`, `estado`, `horas_invertidas`, `comentario`, `id_usuario`) VALUES
(1, 'Desbarbadora-1', 'limpiadora de semillas -1', '6', '2024-10-03', '2024-10-07', '2024-10-10', 'Si', 'Activo', 9, 'maquinaria le falta engrase', NULL),
(4, 'Cortadora', 'cable roto', '5', '2024-10-15', '2024-10-16', '2024-10-16', 'No', 'Proceso', 12, '', 6),
(5, 'soldadora', 'capacitor', '8', '2024-10-19', '2024-10-25', '2024-10-31', 'No', 'Finalizado', 6, '', 6),
(7, 'maquina soldar', 'No encuende', '5', '2024-10-16', '2024-10-16', '2024-11-09', 'Si', 'Activo', 4, '', 6),
(8, 'Pulidora', 'Carbones', '2', '2024-10-21', '2024-10-23', '2024-10-25', 'No', 'Proceso', 3, '', 6),
(9, 'maquina soldar', 'Cable tierra', '2', '2024-10-26', '2024-10-27', '2024-10-31', 'No', 'Activo', 8, '', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinarias`
--

CREATE TABLE `maquinarias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `numero_serie` varchar(50) DEFAULT NULL,
  `fecha_adquisicion` date DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `maquinarias`
--

INSERT INTO `maquinarias` (`id`, `nombre`, `tipo`, `modelo`, `numero_serie`, `fecha_adquisicion`, `estado`, `ubicacion`) VALUES
(1, 'Pulidora', 'Corte', 'pulidora 2000', '481833', '2024-10-09', 'Intermedio', 'Bodega de Semillas 1'),
(2, 'maquina soldar', 'Soldadura', 'mode-202020', '14155', '2024-10-06', 'Intermedio', 'Bodega de Semillas 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(240) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `tipo_usuario` varchar(25) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `clave`, `tipo_usuario`, `nombre`) VALUES
(5, 'jhonny@gmail.com', '12345', 'Admin', 'Jhonny'),
(6, 'carlos@gmail.com', '1234567', 'Usuario', 'Carlo'),
(7, 'melvin@gmail.com', '12345', 'Usuario', 'Melvin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `historial_sesiones`
--
ALTER TABLE `historial_sesiones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maquinarias`
--
ALTER TABLE `maquinarias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo_unico` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `historial_sesiones`
--
ALTER TABLE `historial_sesiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `maquinarias`
--
ALTER TABLE `maquinarias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial_sesiones`
--
ALTER TABLE `historial_sesiones`
  ADD CONSTRAINT `historial_sesiones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
